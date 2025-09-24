<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilRefill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
        $this->api_key  = "EAAEURNpv0l0BPbOMkhIclQTDaXZCKurZCFTYbPWKAsL9fP8uZA1EjkWRd6mUzv8tGpgimx3zXP2kUs1HKMFdlUYCA3Rv62x2XYORdcf2sZAKTboVtoYgeb7Af6eKY9j3WFvwIcotgF6ZCB41d97O6sJLHbBAnuuOZAIsGzIu3PG7lUp9ZCgb5tywoeUMve2sQZDZD";
        $this->base_url = "https://graph.facebook.com/v22.0/";
    }

   public function nill_fill_data() {
    if (!$this->session->userdata('user_id')) {
        redirect('login');
    }

    $this->load->model('Permission_model');

    $user_id = $this->session->userdata('user_id');
    $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        // Show modal by setting access_denied flag
        $data = [
            'access_denied' => true,
            'method' => 'nil_refill_report',
            'page_title' => 'Nil Refill Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
    $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

    $data = [
        'stats' => $stats['data'],
        'total_consumers' => $stats['total_consumers'] ?? 0,
        'all_customers' => $all_customers,
        'method' => 'nil_refill_report',
        'page_title' => 'Nil Refill Report',
        'report_date' => date('d-M-Y H:i:s'),
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}

    public function sending_messaging() {
        $user_id = $this->session->userdata('user_id');

        // Get filter parameters from URL
        $status = $this->input->get('status');
        $period = $this->input->get('period');
        $scheme = $this->input->get('scheme');
        $area = $this->input->get('area');

        // Get all customer details
        $all_customers = $this->CustomerRegister_model->get_nillrefill_data();

        // Filter customers
        $customer_details = array_filter($all_customers, function($customer) use ($status, $period, $scheme, $area) {
            $status_match = ($status === 'overall_total' || $status === 'ALL') ? true : 
                            strtolower($customer['Consumer_Sub_Status']) === $status;

            $days = isset($customer['days_since_refill']) ? (int)$customer['days_since_refill'] : 0;
            $period_match = true;

            if ($period === 'greater_than_3_months') {
                $period_match = $days > 90 && $days <= 180;
            } else if ($period === 'greater_than_6_months') {
                $period_match = $days > 180 && $days <= 365;
            } else if ($period === 'greater_than_1_year') {
                $period_match = $days > 365;
            }

            $normalized_scheme = $this->normalize_scheme($customer['Scheme_Selected']);
            $scheme_match = ($scheme === 'total' || $scheme === 'ALL') ? true : 
                            $normalized_scheme === strtoupper($scheme);

            $area_match = ($area === 'ALL' || empty($area)) ? true : 
                        $customer['Area_Name'] === $area;

            return $status_match && $period_match && $scheme_match && $area_match;
        });

        $customer_details = array_values($customer_details);

        if (empty($customer_details)) {
            $this->session->set_flashdata('error', "No customers found for the selected filters.");
            redirect('NilRefill/nill_fill_data');
        }

        $distributor_number = $this->CustomerRegister_model->get_distributor_number();
        $template_name = "nilrefill_customer_template";
        $template = $this->CustomerRegister_model->get_template_by_name($template_name);

        if (empty($template)) {
            $this->session->set_flashdata('error', "Template not found in DB: {$template_name}");
            redirect('NilRefill/nill_fill_data');
        }

        $template_content = $template['template_content'];
        $success = 0;
        $fail = 0;

        function clean_whatsapp_text($text) {
            $text = preg_replace('/[\r\n\t]+/', ' ', $text);   
            $text = preg_replace('/\s{2,}/', ' ', $text);      
            return trim($text);
        }

        foreach ($customer_details as $customer) {
            if (empty($customer['Phone_Number'])) {
                $fail++;
                continue;
            }

            $recipient = "91" . $customer['Phone_Number'];
            
            $distributor_name = "ESHA INDANE GAS AGENCY";

            $url = $this->base_url . "739878672549065/messages";

            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $recipient,
                "type" => "template",
                "template" => [
                    "name" => $template_name,
                    "language" => [
                        "code" => "en_US"
                    ],
                    "components" => [[
                        "type" => "body",
                        "parameters" => [
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Consumer_Name'])],
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Consumer_Number'])],
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Last_Refill_Date'])],
                            ["type" => "text", "text" => clean_whatsapp_text($template_content)],
                            ["type" => "text", "text" => clean_whatsapp_text($distributor_name)],
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
            $curl_error = curl_error($ch);
            curl_close($ch);

            $api_response = json_decode($response, true);

            if (isset($api_response['messages'][0]['id'])) {
                $this->db->insert('whatsapp_messages', [
                    'user_id'       => $user_id,
                    'message_id'    => $api_response['messages'][0]['id'],
                    'status'        => 'sent',
                    'sent_at'       => date('Y-m-d H:i:s'),
                    'filter_status' => $status,
                    'filter_period' => $period,
                    'filter_scheme' => $scheme,
                    'filter_area'   => $area
                ]);
                $success++;
            } else {
                $fail++;
            }
        }

        $filter_info = "";
        if ($status !== 'overall_total' && $status !== 'ALL') $filter_info .= "Status: $status, ";
        if ($period !== 'ALL') $filter_info .= "Period: $period, ";
        if ($scheme !== 'total' && $scheme !== 'ALL') $filter_info .= "Scheme: $scheme, ";
        if (!empty($area) && $area !== 'ALL') $filter_info .= "Area: $area, ";

        if (!empty($filter_info)) {
            $filter_info = rtrim($filter_info, ', ');
            $filter_info = " (Filter: $filter_info)";
        }

        $this->session->set_flashdata('success', "✅ Sent to {$success} users{$filter_info}. ❌ Failed for {$fail}.");
        redirect('NilRefill/nill_fill_data');
    }

    // Helper method to normalize scheme names
    private function normalize_scheme($scheme) {
        $scheme = strtoupper(trim($scheme));
        if ($scheme === 'UJJWALA' || $scheme === 'UJJWALA - EXTENDED') {
            return 'PMUY';
        } else {
            return 'NON_PMUY';
        }
    }

}