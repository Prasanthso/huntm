<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SBC_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->api_key  = "EAAEURNpv0l0BPbOMkhIclQTDaXZCKurZCFTYbPWKAsL9fP8uZA1EjkWRd6mUzv8tGpgimx3zXP2kUs1HKMFdlUYCA3Rv62x2XYORdcf2sZAKTboVtoYgeb7Af6eKY9j3WFvwIcotgF6ZCB41d97O6sJLHbBAnuuOZAIsGzIu3PG7lUp9ZCgb5tywoeUMve2sQZDZD";
        $this->base_url = "https://graph.facebook.com/v22.0/";
    }

    public function sbc_data_report() {
        $this->load->model('Permission_model');

        $user_id = $this->session->userdata('user_id');
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        $default_customer_data = [
            'active' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0
            ],
            'suspended' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0
            ],
            'deactivated' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0
            ],
            'total' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0
            ]
        ];

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
            $data = [
                'access_denied' => true,
                'method' => 'sbc_data_display',
                'sbc_data' => [],
                'customer_data' => $default_customer_data
            ];
            $this->load->view('website_dashboard', $data);
            return;
        }
        
        $sbc_data = $this->CustomerRegister_model->get_sbc_data();
        $customer_data = $this->CustomerRegister_model->get_sbc_status_counts();

        $customer_data = array_merge($default_customer_data, (array)$customer_data);

        $data = [
            'sbc_data' => $sbc_data ?: [],
            'customer_data' => $customer_data,
            'method' => 'sbc_data_display',
            'access_denied' => false
        ];

        $this->load->view('website_dashboard', $data);
    }

    public function sending_messaging() {
        $user_id = $this->session->userdata('user_id');
        
        $status = $this->input->get('status');
        $scheme = $this->input->get('scheme');
        $area = $this->input->get('area');
        
        $all_customers = $this->CustomerRegister_model->get_sbc_customer_details();
        
        $customer_details = array_filter($all_customers, function($customer) use ($status, $scheme, $area) {
            $status_match = ($status === 'ALL') ? true : $customer['Consumer_Sub_Status'] === $status;
            
            $normalized_scheme = $this->normalize_scheme($customer['Scheme_Selected']);
            $scheme_match = ($scheme === 'ALL') ? true : $normalized_scheme === $scheme;
            
            $area_match = ($area === 'ALL' || empty($area)) ? true : $customer['Area_Name'] === $area;
            
            return $status_match && $scheme_match && $area_match;
        });
        
        $customer_details = array_values($customer_details);
        
        if (empty($customer_details)) {
            $this->session->set_flashdata('error', "No customers found for the selected filters.");
            redirect('SBC_data/sbc_data_report');
        }
        
        $distributor_number = $this->CustomerRegister_model->get_distributor_number();
        $template_name = "sbc_data_template";
        $template = $this->CustomerRegister_model->get_template_by_name($template_name);
        
        if (empty($template)) {
            $this->session->set_flashdata('error', "Template not found in DB: {$template_name}");
            redirect('SBC_data/sbc_data_report');
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
            $recipient = "91" . $customer['Phone_Number'];
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
                            ["type" => "text", "text" => clean_whatsapp_text($template_content)],
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Distributor_Name'])],
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
            curl_close($ch);

            $api_response = json_decode($response, true);

            log_message('error', 'WhatsApp API Response: ' . $response);

            if (isset($api_response['messages'][0]['id'])) {
                $this->db->insert('whatsapp_messages', [
                    'user_id'    => $user_id,
                    'message_id' => $api_response['messages'][0]['id'],
                    'status'     => 'sent',
                    'sent_at'    => date('Y-m-d H:i:s'),
                    'filter_status' => $status,
                    'filter_scheme' => $scheme,
                    'filter_area' => $area
                ]);
                $success++;
            } else {
                $fail++;
            }
        }

        $filter_info = "";
        if ($status !== 'ALL') $filter_info .= "Status: $status, ";
        if ($scheme !== 'ALL') $filter_info .= "Scheme: $scheme, ";
        if (!empty($area) && $area !== 'ALL') $filter_info .= "Area: $area, ";
        
        if (!empty($filter_info)) {
            $filter_info = rtrim($filter_info, ', ');
            $filter_info = " (Filter: $filter_info)";
        }
        
        $this->session->set_flashdata('success', "✅ Sent to {$success} users{$filter_info}. ❌ Failed for {$fail}.");
        redirect('SBC_data/sbc_data_report');
    }

    private function normalize_scheme($scheme) {
        $scheme = strtoupper(trim($scheme));
        if ($scheme === 'UJJWALA' || $scheme === 'UJJWALA - EXTENDED') {
            return 'PMUY';
        } else {
            return 'NON_PMUY';
        }
    }
}
