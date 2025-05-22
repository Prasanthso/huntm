<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteDetails extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('WebsiteModel');
        $this->load->model('WebScrapping_model');
        $this->load->model('OpenOrder_model');
        $this->load->helper(array('form', 'url', 'download'));
        $this->load->library('session');
        $this->load->database();
    }

    //Display add website form
    public function addwebsite() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];
        $data['method'] = "add_website";
        $this->load->view('website_dashboard', $data);
    }

    //Store website details
    // Validate and insert website details
    public function store() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];

        $url = trim($this->input->post('url'));
        $userId = trim($this->input->post('userId'));
        $password = trim($this->input->post('password'));
        $loggeduserid = $this->session->userdata('id');

        if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }

        if (empty($url)) $data['errors']['url'] = 'Website URL is required.';
        if (empty($userId)) $data['errors']['userId'] = 'Username is required.';
        if (empty($password)) $data['errors']['password'] = 'Password is required.';
        if (empty($loggeduserid)) $data['errors']['loggeduserid'] = 'Not a valid logged-in user.';

        if (!empty($data['errors'])) {
            $data['method'] = 'add_website';
            $this->load->view('website_dashboard', $data);
        } else {
            $insert_data = [
                'website_userId' => $userId,
                'website_password' => $password,
                'website_url' => $url,
                'userid' => $loggeduserid
            ];

            if ($this->WebsiteModel->insert_website($insert_data)) {
                $this->session->set_flashdata('success', 'Website added successfully!');
                redirect('storewebsite');
            } else {
                $this->session->set_flashdata('error', 'Failed to add website.');
                redirect('addwebsite');
            }
        }
    }

    //Display all stored websites
    public function stored_website() {
        $data['websites'] = $this->WebsiteModel->get_all_websites();
        $data['method'] = 'store_website';
        $this->load->view('website_dashboard', $data);
        
    }

    //Scrape data from the website
    public function scrape_data() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('storewebsite');
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');
        
        // Prepare API request
        $api_url = 'http://127.0.0.1:5000/scrape';

        $post_data = [
            'username' => $userId,
            'password' => $password
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT => 300,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            $this->session->set_flashdata('error', 'API Connection Error: ' . curl_error($ch));
            redirect('storewebsite');
        }
        
        curl_close($ch);

        $result = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->session->set_flashdata('error', 'Invalid API response format');
            redirect('storewebsite');
        }

        if ($result['status'] === 'success') {
            try {
                // Process invoiced orders
                if (!empty($result['data']['invoiced_process_order'])) {
                    $invoiced_data = array_map(function($item) {
                        return [
                            'area_name' => $item['Area Name'] ?? '',
                            'cashmemo_generated' => $item['CashMemo Generated'] ?? '',
                            'status' => $item['Status'] ?? '',
                            'userid' => $this->session->userdata('id'),
                            // 'created_at' => date('Y-m-d H:i:s')
                        ];
                    }, $result['data']['invoiced_process_order']);
                    
                    $this->WebScrapping_model->insert_data($invoiced_data);
                }

                // Process open orders
                if (!empty($result['data']['open_orders'])) {
                    $open_data = array_map(function($item) {
                        return [
                            'area_name' => $item['Area Name'] ?? '',
                            'open_refill_orders' => $item['Open Refill Orders'] ?? '',
                            'userid' => $this->session->userdata('id'),
                            // 'created_at' => date('Y-m-d H:i:s')
                        ];
                    }, $result['data']['open_orders']);
                    
                    $this->OpenOrder_model->insert_data($open_data);
                }

                $this->session->set_flashdata('success', 'Data scraped and stored successfully!');
                $this->save_raw_data($result);
                
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Database error: ' . $e->getMessage());
                log_message('error', 'Storage error: ' . $e->getMessage());
            }
        } else {
            $error_message = $result['message'] ?? 'Unknown error occurred';
            $this->session->set_flashdata('error', 'Scraping failed: ' . $error_message);
        }

        redirect('storewebsite');
    }

    private function save_raw_data($result) {
        $data_dir = FCPATH . 'data/';
        if (!is_dir($data_dir)) {
            mkdir($data_dir, 0755, true);
        }
        
        $filename = $data_dir . 'scraped_data_' . date('Ymd_His') . '.json';
        file_put_contents($filename, json_encode($result, JSON_PRETTY_PRINT));
    }

     //Display invoice data in website
    public function display_invoice_data() {
        $data['method'] = 'display_invoice_data';
        $data['orders'] = $this->WebScrapping_model->get_all_data();
        $this->load->view('website_dashboard', $data);
    }

    //Display open process data in website
    public function display_open_data() {
        $data['method'] = 'display_open_data';
        $data['excel_orders'] = $this->OpenOrder_model->get_all_data();
        $this->load->view('website_dashboard', $data);
    }

}