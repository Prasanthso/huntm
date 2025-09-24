<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends CI_Controller {

    private $api_key;
    private $base_url;

    public function __construct() {
        parent::__construct();
        $this->load->model('Whatsapp_model');
        $this->load->model('CustomerRegister_model');
        $this->load->library('session');

        $this->api_key  = "EAAEURNpv0l0BPbOMkhIclQTDaXZCKurZCFTYbPWKAsL9fP8uZA1EjkWRd6mUzv8tGpgimx3zXP2kUs1HKMFdlUYCA3Rv62x2XYORdcf2sZAKTboVtoYgeb7Af6eKY9j3WFvwIcotgF6ZCB41d97O6sJLHbBAnuuOZAIsGzIu3PG7lUp9ZCgb5tywoeUMve2sQZDZD";
        $this->base_url = "https://graph.facebook.com/v22.0/";
    }

    public function index() {
        $data['areas'] = $this->Whatsapp_model->get_area_distribution();
        $this->load->view('send_whatsapp', $data);
    }

    public function sending_message() {
    $area = $this->input->get('area');  

    if (!$area) {
        $this->session->set_flashdata('error', 'Area not specified.');
        redirect('whatsapp');
    }

    $template_name = "mi_due_data_template"; 

    $template = $this->Whatsapp_model->get_template_by_name($template_name);

    if (empty($template)) {
        $this->session->set_flashdata('error', "Template not found in DB: {$template_name}");
        redirect('whatsapp');
    }

    $users  = $this->Whatsapp_model->get_users_by_area($area);
    $distributor_number = $this->CustomerRegister_model->get_distributor_number();

    if (empty($users)) {
        $this->session->set_flashdata('error', "No users found in area: {$area}");
        redirect('whatsapp');
    }

    $template_content = $template['template_content'];

    $success = 0;
    $fail    = 0;

    function clean_whatsapp_text($text) {
        $text = preg_replace('/[\r\n\t]+/', ' ', $text);   
        $text = preg_replace('/\s{2,}/', ' ', $text);      
        return trim($text);
    }

    foreach ($users as $user) {
        $recipient = preg_replace('/\D/', '', $user['phone']);

        if (strlen($recipient) < 12) {
            log_message('error', "❌ Invalid phone number for user {$user['id']}: {$user['phone']} (Cleaned: {$recipient})");
            continue;
        }

        $url = $this->base_url . "739878672549065/messages";
        $payload = [
            "messaging_product" => "whatsapp",
            "to" => $recipient,
            "type" => "template",
            "template" => [
                "name" => $template_name,
                "language" => ["code" => "en_US"],
                "components" => [[
                    "type" => "body",
                    "parameters" => [
                        ["type" => "text", "text" => clean_whatsapp_text($user['name'])], 
                        ["type" => "text", "text" => clean_whatsapp_text($user['Consumer_Number'])],
                        ["type" => "text", "text" => clean_whatsapp_text($user['Last_Refill_Date'])],
                        ["type" => "text", "text" => clean_whatsapp_text($template_content)], 
                        ["type" => "text", "text" => clean_whatsapp_text($user['Distributor_Name'])], 
                        ["type" => "text", "text" => clean_whatsapp_text($distributor_number['office_mobile'])], 
                        ["type" => "text", "text" => clean_whatsapp_text($distributor_number['office_mobile2'])]
                    ]
                ]]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->api_key}"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        $api_response = json_decode($response, true);

        if (isset($api_response['messages'][0]['id'])) {
            $this->db->insert('whatsapp_messages', [
                'user_id'    => $user['id'],
                'message_id' => $api_response['messages'][0]['id'],
                'status'     => 'sent',
                'sent_at' => (new DateTime('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d H:i:s')
            ]);
            $success++;
        } else {
            $fail++;
            log_message('error', "❌ Failed to send to {$recipient}. HTTP: {$http_code}, Response: {$response}, CurlError: {$curl_error}");
        }
    }

    $this->session->set_flashdata('success', "✅ Sent to {$success} users in {$area}. ❌ Failed for {$fail}.");
    redirect('whatsapp');
}


    // public function sending_message() {
    //     $user_id = $this->session->userdata('user_id');
    //     $area = $this->input->get('area'); 
    //     $customer_details = $this->CustomerRegister_model->get_customer_details();
    //     $distributor_number   = $this->CustomerRegister_model->get_distributor_number();
    //     $users  = $this->Whatsapp_model->get_users_by_area($area);
    //     $template_name = "sbc_data_template";
    //     $template = $this->CustomerRegister_model->get_template_by_name($template_name);
    //     if (empty($template)) {
    //         $this->session->set_flashdata('error', "Template not found in DB: {$template_name}");
    //         redirect('whatsapp');
    //     }
    //     $template_content = $template['template_content'];
    //     $success = 0;
    //     $fail    = 0;

    //     foreach ($customer_details as $customer) {
    //         // $recipient = "91" . $customer['Phone_Number'];
    //         $recipient = $user['phone'];
    //         $url = $this->base_url . "739878672549065/messages";

    //         $payload = [
    //             "messaging_product" => "whatsapp",
    //             "to" => $recipient,
    //             "type" => "template",
    //             "template" => [
    //                 "name" => $template_name,
    //                 "language" => [
    //                     "code" => "en_US"
    //                 ],
    //                 "components" => [[
    //                     "type" => "body",
    //                     "parameters" => [
    //                         ["type" => "text", "text" => $customer['Consumer_Name']],
    //                         ["type" => "text", "text" => $customer['Consumer_Number']],
    //                         ["type" => "text", "text" => $template_content],
    //                         ["type" => "text", "text" => $distributor_number['office_mobile']],
    //                         ["type" => "text", "text" => $distributor_number['office_mobile2']]
    //                     ]
    //                 ]]
    //             ]
    //         ];

    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //             "Content-Type: application/json",
    //             "Authorization: Bearer {$this->api_key}"
    //         ]);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    //         $response = curl_exec($ch);
    //         curl_close($ch);

    //         $api_response = json_decode($response, true);

    //         // Debugging log (check application/logs/log-*.php if fails)
    //         log_message('error', 'WhatsApp API Response: ' . $response);

    //         if (isset($api_response['messages'][0]['id'])) {
    //             $this->db->insert('whatsapp_messages', [
    //                 'user_id'    => $user_id,
    //                 'message_id' => $api_response['messages'][0]['id'],
    //                 'status'     => 'sent',
    //                 'sent_at'    => date('Y-m-d H:i:s')
    //             ]);
    //             $success++;
    //         } else {
    //             $fail++;
    //         }
    //     }

    //     $this->session->set_flashdata('success', "✅ Sent to {$success} users. ❌ Failed for {$fail}.");
    //     redirect('whatsapp');
    // }
}
