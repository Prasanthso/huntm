<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosedue_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->api_key  = "EAAEURNpv0l0BPbOMkhIclQTDaXZCKurZCFTYbPWKAsL9fP8uZA1EjkWRd6mUzv8tGpgimx3zXP2kUs1HKMFdlUYCA3Rv62x2XYORdcf2sZAKTboVtoYgeb7Af6eKY9j3WFvwIcotgF6ZCB41d97O6sJLHbBAnuuOZAIsGzIu3PG7lUp9ZCgb5tywoeUMve2sQZDZD";
        $this->base_url = "https://graph.facebook.com/v22.0/";
    }

    public function hose_due_data() {
        $this->load->model('Permission_model');

        $user_id = $this->session->userdata('user_id');
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
            // Access Denied: Load dashboard with modal trigger
            $data = [
                'access_denied' => true,
                'customer_data' => [],
                'hose_due' => [],
                'method' => 'hosedue',
                'page_title' => 'Hose Due Report',
                'report_date' => date('d-M-Y H:i:s')
            ];
            $this->load->view('website_dashboard', $data);
            return;
        }

        // Allowed: proceed with data
        $customer_data = $this->CustomerRegister_model->get_hose_due_stats('detailed');
        $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();

        $due_customers = array_values(array_filter($hose_due_customers, function($customer) {
            return $customer['hose_status'] === 'Due';
        }));

        $total_customers = $customer_data['total']['total'];

        if ($total_customers > 0) {
            foreach (['active', 'suspended', 'deactivated'] as $status) {
                foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                    $customer_data[$status][$type . '_percent'] =
                        round(($customer_data[$status][$type] / $total_customers) * 100, 2);
                }
            }

            $customer_data['total']['pmuy_percent'] = round(($customer_data['total']['pmuy'] / $total_customers) * 100, 2);
            $customer_data['total']['non_pmuy_percent'] = round(($customer_data['total']['non_pmuy'] / $total_customers) * 100, 2);
            $customer_data['total']['total_percent'] = round(($customer_data['total']['total'] / $total_customers) * 100, 2);
        } else {
            foreach (['active', 'suspended', 'deactivated'] as $status) {
                foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                    $customer_data[$status][$type . '_percent'] = 0;
                }
            }

            $customer_data['total']['pmuy_percent'] = 0;
            $customer_data['total']['non_pmuy_percent'] = 0;
            $customer_data['total']['total_percent'] = 0;
        }

        $data = [
            'customer_data' => $customer_data,
            'hose_due' => $due_customers,
            'method' => 'hosedue',
            'page_title' => 'Hose Due Report',
            'report_date' => date('d-M-Y H:i:s'),
            'access_denied' => false
        ];

        $this->load->view('website_dashboard', $data);
    }

    public function sending_messaging() {
        $user_id = $this->session->userdata('user_id');

        $status  = $this->input->get('status');
        $scheme  = $this->input->get('scheme');
        $area    = $this->input->get('area');

        $all_customers = $this->CustomerRegister_model->get_hose_customer_details();

        $customer_details = array_filter($all_customers, function($customer) use ($status, $scheme, $area) {
            return ($customer['hose_status'] === 'Due') &&
                (($status === 'ALL') ? true : $customer['Consumer_Sub_Status'] === $status) &&
                (($scheme === 'ALL') ? true : $this->normalize_scheme($customer['Scheme_Selected']) === $scheme) &&
                (($area === 'ALL' || empty($area)) ? true : $customer['Area_Name'] === $area);
        });
        $customer_details = array_values($customer_details);

        if (empty($customer_details)) {
            $this->session->set_flashdata('error', "No customers found for the selected filters.");
            redirect('Hosedue_data/hose_due_data');
        }

        $distributor_number = $this->CustomerRegister_model->get_distributor_number();
        $template_name = "hose_due_template";
        $template = $this->CustomerRegister_model->get_template_by_name($template_name);

        if (empty($template)) {
            $this->session->set_flashdata('error', "Template not found in DB: {$template_name}");
            redirect('Hosedue_data/hose_due_data');
        }

        $template_content = $template['template_content'];
        $success = 0;
        $fail    = 0;

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

            $recipient        = "91" . $customer['Phone_Number'];
            $distributor_name = !empty($customer['Distributor_Name']) ? $customer['Distributor_Name'] : 'Distributor';
            $url              = $this->base_url . "739878672549065/messages";

            $payload = [
                "messaging_product" => "whatsapp",
                "to"   => $recipient,
                "type" => "template",
                "template" => [
                    "name"     => $template_name,
                    "language" => ["code" => "en_US"],
                    "components" => [[
                        "type" => "body",
                        "parameters" => [
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Consumer_Name'])],
                            ["type" => "text", "text" => clean_whatsapp_text($customer['Consumer_Number'])],
                            ["type" => "text", "text" => clean_whatsapp_text(!empty($customer['Tube_Change_Due_Date']) ? $customer['Tube_Change_Due_Date'] : date('Y-m-d'))],
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

            if (!empty($curl_error)) {
                $fail++;
                continue;
            }

            $api_response = json_decode($response, true);

            if (isset($api_response['messages'][0]['id'])) {
                $this->db->insert('whatsapp_messages', [
                    'user_id'       => $user_id,
                    'message_id'    => $api_response['messages'][0]['id'],
                    'status'        => 'sent',
                    'sent_at'       => date('Y-m-d H:i:s'),
                    'filter_status' => $status,
                    'filter_scheme' => $scheme,
                    'filter_area'   => $area
                ]);
                $success++;
            } else {
                $fail++;
            }
        }

        $filter_info = "";
        if ($status !== 'ALL')  $filter_info .= "Status: $status, ";
        if ($scheme !== 'ALL')  $filter_info .= "Scheme: $scheme, ";
        if (!empty($area) && $area !== 'ALL') $filter_info .= "Area: $area, ";

        if (!empty($filter_info)) {
            $filter_info = rtrim($filter_info, ', ');
            $filter_info = " (Filter: $filter_info)";
        }

        $this->session->set_flashdata('success', "Messages sent. ✅ Sent: {$success}, ❌ Failed: {$fail}{$filter_info}");
        redirect('Hosedue_data/hose_due_data');
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