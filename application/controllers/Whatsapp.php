<?php
class Whatsapp extends CI_Controller
{
    private $accessToken = 'EAAVGOItJBl8BPP89pQhfnVJOi59vezPfxZClKII4MEaWiuRPeVZAg3jhEiX5HWCz9tZBFOPWZBZCJi7VEEZCbFAADOJZAw89qlyGZA1ZByeg7vwC9DZAvY5Qiwuz3B9ZC3t83QB7myFxGuMDsJlmxexlPhi5nh44rMCSIj0xjZB1LXi7ZBNxD95FJuo6XqSG04vaCqzOIZAp0wPuAVZAIx29pktoUaCjxUHBTgUGQTCFkKxNVfY82QZD'; // Use token from your screenshot
    private $phoneNumberId = '718395394693618';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
    }

    public function index()
    {
        $data['customers'] = $this->Customer_model->get_customers();
        $this->load->view('whatsapp_view', $data);
    }

    public function send_message($id = null)
{
    echo "DEBUG: Received ID = " . $id . "<br>";

    if (!$id) {
        echo "Customer ID is required.";
        return;
    }

    $customer = $this->Customer_model->get_customer($id);

    if (!$customer) {
        echo "Customer not found.";
        return;
    }

    $phone = $this->format_phone_number($customer->phone);
    if (!$phone) {
        echo "Invalid phone number.";
        return;
    }

    $url = 'https://graph.facebook.com/v19.0/' . $this->phoneNumberId . '/messages';

    $payload = [
        "messaging_product" => "whatsapp",
        "to" => $phone,
        "type" => "template",
        "template" => [
            "name" => "customer_details",
            "language" => ["code" => "en"], // ✅ correct language code
            "components" => [[
                "type" => "body",
                "parameters" => [
                    ["type" => "text", "text" => $customer->name],
                    ["type" => "text", "text" => $customer->customer_id],
                    ["type" => "text", "text" => "₹" . number_format($customer->amount, 2)]
                ]
            ]]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $this->accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
        curl_close($ch);
        return;
    }
    curl_close($ch);

    $result = json_decode($response, true);
    echo "<pre>WhatsApp API Response:\n";
    print_r($result);
}



    private function format_phone_number($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (strlen($phone) === 10) {
            return '+91' . $phone;
        } elseif (strlen($phone) === 12 && substr($phone, 0, 2) === '91') {
            return '+' . $phone;
        }
        return false;
    }
}
