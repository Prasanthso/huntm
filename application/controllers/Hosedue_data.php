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
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
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

    public function get_customers_for_messaging() {
        try {
            $status = $this->input->get('status');
            $scheme = $this->input->get('scheme');
            $area = $this->input->get('area');
            
            $total_customers = $this->CustomerRegister_model->get_filtered_hose_customers_count($status, $scheme, $area);
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'total_customers' => $total_customers,
                    'filters' => [
                        'status' => $status,
                        'scheme' => $scheme,
                        'area' => $area
                    ]
                ]));
                
        } catch (Exception $e) {
            log_message('error', 'Error in get_customers_for_messaging: ' . $e->getMessage());
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'error' => 'Server error: ' . $e->getMessage()
                ]));
        }
    }

    public function send_batch_messages() {
        set_time_limit(0);
        ignore_user_abort(true);
        
        try {
            $user_id = $this->session->userdata('user_id');
            $batch_size = $this->input->post('batch_size') ? intval($this->input->post('batch_size')) : 2;
            $current_batch = $this->input->post('current_batch') ? intval($this->input->post('current_batch')) : 0;
            $status = $this->input->post('status');
            $scheme = $this->input->post('scheme');
            $area = $this->input->post('area');
            $total_customers = $this->input->post('total_customers') ? intval($this->input->post('total_customers')) : 0;
            
            log_message('debug', "Hose Due Large batch request: batch_size=$batch_size, current_batch=$current_batch, total_customers=$total_customers");

            $offset = $current_batch * $batch_size;
            $batch_customers = $this->CustomerRegister_model->get_filtered_hose_customers_chunk(
                $status, $scheme, $area, $batch_size, $offset
            );

            if (empty($batch_customers)) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => true,
                        'completed' => true,
                        'message' => 'All batches completed',
                        'total_processed' => $offset
                    ]));
                return;
            }

            $distributor_number = $this->CustomerRegister_model->get_distributor_number();
            $template_name = "hose_due_template";
            $template = $this->CustomerRegister_model->get_template_by_name($template_name);
            
            if (empty($template)) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'error' => "Template not found in DB: {$template_name}"
                    ]));
                return;
            }
            
            $template_content = $template['template_content'];
            $success_count = 0;
            $fail_count = 0;
            $results = [];
            $rate_limit_hit = false;
            
            foreach ($batch_customers as $index => $customer) {
                if ($rate_limit_hit) {
                    $fail_count++;
                    $results[] = [
                        'customer' => $customer['Consumer_Name'] ?? 'Unknown',
                        'status' => 'failed',
                        'error' => 'Stopped due to rate limiting'
                    ];
                    continue;
                }
                
                $customer_number = $customer['Phone_Number'] ?? '';
                $consumer_name = $customer['Consumer_Name'] ?? 'Unknown';
                
                if (empty($customer_number) || !preg_match('/^[0-9]{10}$/', $customer_number)) {
                    $fail_count++;
                    $results[] = [
                        'customer' => $consumer_name,
                        'status' => 'failed',
                        'error' => 'Invalid phone number'
                    ];
                    continue;
                }
                
                $result = $this->send_single_message($customer, $template_name, $template_content, $distributor_number, $user_id, $status, $scheme, $area);
                
                if ($result['success']) {
                    $success_count++;
                } else {
                    $fail_count++;
                    
                    if (strpos($result['error'], 'rate limit') !== false || 
                        strpos($result['error'], '429') !== false ||
                        strpos($result['error'], '80007') !== false) {
                        $rate_limit_hit = true;
                        log_message('error', "Rate limit hit at customer $index. Stopping batch.");
                    }
                }
                
                $results[] = $result;
                
                $delay = $this->calculate_dynamic_delay($current_batch, $success_count, $fail_count, $rate_limit_hit);
                if ($index < count($batch_customers) - 1 && !$rate_limit_hit) {
                    sleep($delay);
                }
            }
            
            $total_processed = $offset + count($batch_customers);
            $completion_percentage = $total_customers > 0 ? round(($total_processed / $total_customers) * 100, 2) : 0;
            
            $response_data = [
                'success' => true,
                'batch_number' => $current_batch + 1,
                'total_batches' => $total_customers > 0 ? ceil($total_customers / $batch_size) : 0,
                'processed_in_batch' => count($batch_customers),
                'success_count' => $success_count,
                'fail_count' => $fail_count,
                'total_processed' => $total_processed,
                'total_customers' => $total_customers,
                'completion_percentage' => $completion_percentage,
                'completed' => ($total_processed >= $total_customers),
                'rate_limit_hit' => $rate_limit_hit,
                'estimated_time_remaining' => $this->calculate_remaining_time($total_processed, $total_customers, $batch_size),
                'batch_info' => "Batch " . ($current_batch + 1) . ": " . $completion_percentage . "% complete"
            ];
            
            if ($rate_limit_hit) {
                $response_data['warning'] = 'Rate limit reached. Please wait before continuing.';
            }
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response_data));
                
        } catch (Exception $e) {
            log_message('error', 'Exception in send_batch_messages: ' . $e->getMessage());
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'error' => 'Server exception: ' . $e->getMessage()
                ]));
        }
    }
    
    private function send_single_message($customer, $template_name, $template_content, $distributor_number, $user_id, $status, $scheme, $area) {
        $customer_number = $customer['Phone_Number'];
        $consumer_name = $customer['Consumer_Name'] ?? 'Unknown';
        $distributor_name = !empty($customer['Distributor_Name']) ? $customer['Distributor_Name'] : 'Distributor';
        
        $recipient = "91" . $customer_number;
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
                        ["type" => "text", "text" => $this->clean_whatsapp_text($consumer_name)],
                        ["type" => "text", "text" => $this->clean_whatsapp_text($customer['Consumer_Number'] ?? 'N/A')],
                        ["type" => "text", "text" => $this->clean_whatsapp_text(!empty($customer['Tube_Change_Due_Date']) ? $customer['Tube_Change_Due_Date'] : date('Y-m-d'))],
                        ["type" => "text", "text" => $this->clean_whatsapp_text($template_content)],
                        ["type" => "text", "text" => $this->clean_whatsapp_text($distributor_name)],
                        ["type" => "text", "text" => $this->clean_whatsapp_text($distributor_number['office_mobile'] ?? 'N/A')],
                        ["type" => "text", "text" => $this->clean_whatsapp_text($distributor_number['office_mobile2'] ?? 'N/A')]
                    ]
                ]]
            ]
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->api_key}"
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        $api_response = json_decode($response, true);

        if (isset($api_response['messages'][0]['id'])) {
            $insert_data = [
                'user_id'    => $user_id,
                'message_id' => $api_response['messages'][0]['id'],
                'status'     => 'sent',
                'sent_at'    => date('Y-m-d H:i:s'),
                'filter_status' => $status,
                'filter_scheme' => $scheme,
                'filter_area' => $area
            ];
            
            try {
                $insert_data['consumer_number'] = $customer['Consumer_Number'] ?? '';
                $insert_data['consumer_name'] = $consumer_name;
                $this->db->insert('whatsapp_messages', $insert_data);
            } catch (Exception $e) {
                unset($insert_data['consumer_number']);
                unset($insert_data['consumer_name']);
                $this->db->insert('whatsapp_messages', $insert_data);
            }
            
            return [
                'customer' => $consumer_name,
                'status' => 'success',
                'message_id' => $api_response['messages'][0]['id'],
                'phone' => $customer_number,
                'success' => true
            ];
        } else {
            $error_message = $api_response['error']['message'] ?? 'Unknown error';
            $error_code = $api_response['error']['code'] ?? 'Unknown';
            
            return [
                'customer' => $consumer_name,
                'status' => 'failed',
                'error' => "Code $error_code: $error_message",
                'phone' => $customer_number,
                'success' => false
            ];
        }
    }
    
    private function calculate_dynamic_delay($current_batch, $success_count, $fail_count, $rate_limit_hit) {
        $delay = 3;
        
        if ($current_batch > 10) {
            $delay = 4;
        }
        if ($current_batch > 50) {
            $delay = 5;
        }
        
        if ($fail_count > 0 && $success_count > 0) {
            $failure_rate = $fail_count / ($success_count + $fail_count);
            if ($failure_rate > 0.1) {
                $delay += 2;
            }
        }
        
        if ($rate_limit_hit) {
            $delay = 10;
        }
        
        return min($delay, 15);
    }
    
    private function calculate_remaining_time($processed, $total, $batch_size) {
        if ($processed <= 0 || $total <= 0) return 'Calculating...';
        
        $remaining = $total - $processed;
        $batches_remaining = ceil($remaining / $batch_size);
        $seconds_remaining = $batches_remaining * 5;
        
        if ($seconds_remaining < 60) {
            return $seconds_remaining . ' seconds';
        } else if ($seconds_remaining < 3600) {
            return ceil($seconds_remaining / 60) . ' minutes';
        } else {
            $hours = floor($seconds_remaining / 3600);
            $minutes = ceil(($seconds_remaining % 3600) / 60);
            return $hours . 'h ' . $minutes . 'm';
        }
    }
    
    private function clean_whatsapp_text($text) {
        if (empty($text)) return 'N/A';
        $text = preg_replace('/[\r\n\t]+/', ' ', $text);   
        $text = preg_replace('/\s{2,}/', ' ', $text);      
        return trim($text);
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