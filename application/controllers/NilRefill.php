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

    public function get_customers_for_messaging() {
        try {
            $status = $this->input->get('status');
            $period = $this->input->get('period');
            $scheme = $this->input->get('scheme');
            $area = $this->input->get('area');
            
            log_message('debug', "get_customers_for_messaging called with params: " . 
                    "status=$status, period=$period, scheme=$scheme, area=$area");
            
            // Validate parameters
            if ($status === null || $period === null || $scheme === null) {
                throw new Exception('Missing required parameters');
            }
            
            $total_customers = $this->CustomerRegister_model->get_filtered_nilrefill_customers_count($status, $period, $scheme, $area);
            
            log_message('debug', "Total customers found: " . $total_customers);
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'total_customers' => $total_customers,
                    'filters' => [
                        'status' => $status,
                        'period' => $period,
                        'scheme' => $scheme,
                        'area' => $area
                    ]
                ]));
                
        } catch (Exception $e) {
            log_message('error', 'Error in get_customers_for_messaging: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            $this->output
                ->set_status_header(500)
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
            $period = $this->input->post('period');
            $scheme = $this->input->post('scheme');
            $area = $this->input->post('area');
            $total_customers = $this->input->post('total_customers') ? intval($this->input->post('total_customers')) : 0;
            
            log_message('debug', "=== BATCH START ===");
            log_message('debug', "Batch: $current_batch, Size: $batch_size, Total: $total_customers");
            log_message('debug', "Filters - Status: $status, Period: $period, Scheme: $scheme, Area: $area");

            // Get customers in chunks
            $offset = $current_batch * $batch_size;
            // In the send_batch_messages method, update this part:
            $batch_customers = $this->CustomerRegister_model->get_filtered_nilrefill_customers_chunk(
                $status, $period, $scheme, $area, $batch_size, $offset
            );

            log_message('debug', "Retrieved batch customers: " . count($batch_customers) . " from offset: $offset");

            // Check if we have any customers in this batch
            if (empty($batch_customers)) {
                log_message('debug', "=== BATCH COMPLETE == No more customers found at batch $current_batch");
                
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => true,
                        'completed' => true,
                        'message' => 'All batches completed',
                        'total_processed' => $offset,
                        'final_success_count' => $successCount,
                        'final_fail_count' => $failCount
                    ]));
                return;
            }

            $distributor_number = $this->CustomerRegister_model->get_distributor_number();
            $template_name = "nilrefill_customer_template";
            $template = $this->CustomerRegister_model->get_template_by_name($template_name);

            if (empty($template)) {
                log_message('error', "Template not found: $template_name");
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
            
            log_message('debug', "Starting to send messages for batch $current_batch");
            
            foreach ($batch_customers as $index => $customer) {
                if ($rate_limit_hit) {
                    $fail_count++;
                    log_message('warning', "Rate limit hit - skipping remaining customers");
                    $results[] = [
                        'customer' => $customer['Consumer_Name'] ?? 'Unknown',
                        'status' => 'failed',
                        'error' => 'Stopped due to rate limiting'
                    ];
                    continue;
                }
                
                $customer_number = $customer['Phone_Number'] ?? '';
                $consumer_name = $customer['Consumer_Name'] ?? 'Unknown';
                $consumer_id = $customer['Consumer_Number'] ?? 'N/A';
                
                log_message('debug', "Processing customer: $consumer_name ($consumer_id) - $customer_number");
                
                if (empty($customer_number) || !preg_match('/^[0-9]{10}$/', $customer_number)) {
                    $fail_count++;
                    log_message('warning', "Invalid phone number for customer: $consumer_name - $customer_number");
                    $results[] = [
                        'customer' => $consumer_name,
                        'status' => 'failed',
                        'error' => 'Invalid phone number'
                    ];
                    continue;
                }
                
                $result = $this->send_single_message($customer, $template_name, $template_content, $distributor_number, $user_id, $status, $period, $scheme, $area);
                
                if ($result['success']) {
                    $success_count++;
                    log_message('info', "✅ Message sent successfully to: $consumer_name - $customer_number");
                } else {
                    $fail_count++;
                    log_message('error', "❌ Failed to send to: $consumer_name - $customer_number - Error: " . $result['error']);
                    
                    // Check for rate limiting errors
                    if (strpos($result['error'], 'rate limit') !== false || 
                        strpos($result['error'], '429') !== false ||
                        strpos($result['error'], '80007') !== false) {
                        $rate_limit_hit = true;
                        log_message('error', "🚨 RATE LIMIT HIT at customer $index. Stopping batch.");
                    }
                }
                
                $results[] = $result;
                
                // Dynamic delay
                $delay = $this->calculate_dynamic_delay($current_batch, $success_count, $fail_count, $rate_limit_hit);
                if ($index < count($batch_customers) - 1 && !$rate_limit_hit) {
                    log_message('debug', "Waiting $delay seconds before next message");
                    sleep($delay);
                }
            }
            
            $total_processed = $offset + count($batch_customers);
            $completion_percentage = $total_customers > 0 ? round(($total_processed / $total_customers) * 100, 2) : 0;
            
            // Check if we've processed all customers
            $completed = ($total_processed >= $total_customers);
            
            log_message('debug', "=== BATCH $current_batch SUMMARY ===");
            log_message('debug', "Success: $success_count, Failed: $fail_count");
            log_message('debug', "Total processed: $total_processed/$total_customers ($completion_percentage%)");
            log_message('debug', "Rate limit hit: " . ($rate_limit_hit ? 'YES' : 'NO'));
            log_message('debug', "Completed: " . ($completed ? 'YES' : 'NO'));
            
            $response_data = [
                'success' => true,
                'batch_number' => $current_batch + 1,
                'total_batches' => $total_customers > 0 ? ceil($total_customers / $batch_size) : 0,
                'processed_in_batch' => count($batch_customers),
                'success_count' => (int)$success_count,
                'fail_count' => (int)$fail_count,
                'total_processed' => (int)$total_processed,
                'total_customers' => (int)$total_customers,
                'completion_percentage' => (float)$completion_percentage,
                'completed' => $completed,
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
            log_message('error', '🚨 EXCEPTION in send_batch_messages: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'error' => 'Server exception: ' . $e->getMessage()
                ]));
        }
    }
    
    private function send_single_message($customer, $template_name, $template_content, $distributor_number, $user_id, $status, $period, $scheme, $area) {
        $customer_number = $customer['Phone_Number'];
        $consumer_name = $customer['Consumer_Name'] ?? 'Unknown';
        
        $recipient = "91" . $customer_number;
        
        $distributor_name = "ESHA INDANE GAS AGENCY";

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
                        ["type" => "text", "text" => $this->clean_whatsapp_text($customer['Last_Refill_Date'] ?? 'N/A')],
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
            // Insert into database with safe approach
            $insert_data = [
                'user_id'       => $user_id,
                'message_id'    => $api_response['messages'][0]['id'],
                'status'        => 'sent',
                'sent_at'       => date('Y-m-d H:i:s'),
                'filter_status' => $status,
                'filter_period' => $period,
                'filter_scheme' => $scheme,
                'filter_area'   => $area
            ];
            
            // Try to add customer info if columns exist
            try {
                $insert_data['consumer_number'] = $customer['Consumer_Number'] ?? '';
                $insert_data['consumer_name'] = $consumer_name;
                $this->db->insert('whatsapp_messages', $insert_data);
            } catch (Exception $e) {
                // If columns don't exist, insert without them
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
        // Base delay
        $delay = 3; // 3 seconds base
        
        // Increase delay if we're in later batches (warm-up period)
        if ($current_batch > 10) {
            $delay = 4;
        }
        if ($current_batch > 50) {
            $delay = 5;
        }
        
        // Increase delay if we're hitting failures (rate limiting)
        if ($fail_count > 0 && $success_count > 0) {
            $failure_rate = $fail_count / ($success_count + $fail_count);
            if ($failure_rate > 0.1) { // More than 10% failure rate
                $delay += 2;
            }
        }
        
        // Significant delay if rate limit was hit
        if ($rate_limit_hit) {
            $delay = 10; // 10 seconds if rate limited
        }
        
        return min($delay, 15); // Cap at 15 seconds maximum
    }
    
    private function calculate_remaining_time($processed, $total, $batch_size) {
        if ($processed <= 0 || $total <= 0) return 'Calculating...';
        
        $remaining = $total - $processed;
        $batches_remaining = ceil($remaining / $batch_size);
        
        // Estimate 5 seconds per batch (2 messages × 2.5 seconds average delay + processing)
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

    public function debug_customers_count() {
    try {
        // Test with basic parameters first
        $test_params = [
            'status' => 'active',
            'period' => 'greater_than_3_months', 
            'scheme' => 'pmuy',
            'area' => 'ALL'
        ];
        
        log_message('debug', 'Testing with params: ' . print_r($test_params, true));
        
        $count = $this->CustomerRegister_model->get_filtered_nilrefill_customers_count(
            $test_params['status'], 
            $test_params['period'], 
            $test_params['scheme'], 
            $test_params['area']
        );
        
        echo "Test count: " . $count . "<br>";
        echo "If this works, the issue is in the JavaScript parameters.";
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        log_message('error', 'Debug error: ' . $e->getMessage());
    }
}
}