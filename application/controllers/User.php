<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->library('email'); // Load email library
        $this->load->model('User_model'); //load model here
        $this->load->database();
        $this->load->model('CustomerRegister_model');
		$this->load->model('WebsiteModel');
        $this->load->model('WebScrapping_model');
        $this->load->model('OpenOrder_model');
    }

    public function index()
    {
        $this->load->view('login_form');
    }

	//Login page 
    public function login() {
        $this->load->view('login_form');
    }

	public function login_user() {
		$this->load->model('User_model');
	
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
	
		$errors = [];
	
		if (empty($email)) {
			$errors['email'] = 'Email field is required.';
		}
		if (empty($password)) {
			$errors['password'] = 'Password field is required.';
		}
	
		if (!empty($errors)) {
			$this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('email', $email);
			redirect('loginform');
		}
	
		$user = $this->User_model->getUser($email);
		
        if ($user) {
            if (password_verify($password, $user->Password)) {  
                $userid = $this->session->set_userdata('id', $user->id);
				$userid = $this->session->set_userdata('username', $user->Firstname);
                $this->session->set_flashdata('login_success', true); // ✅ Set flashdata for success message
				
                redirect('dashboard'); // Redirect to Suggestion Form
				echo '<pre>';
				print_r($data);
				echo '</pre>';
            } else {
                $errors['password'] = 'Incorrect password.';
                $this->session->set_flashdata('errors', $errors);
                redirect('loginform');
            }
        } else {
            $errors['email'] = 'No account exists with this email.';
            $this->session->set_flashdata('errors', $errors);
            redirect('loginform');
        }
    }
	public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('loginform'); 
    }

	//here suggestion page section
    public function suggestion_form() {
        $data['method'] = "suggestion";
        $this->load->view('website_dashboard',$data); 
        // $this->load->view('suggestion_form');
    }

	public function submit_suggestion() {
        $application = $this->input->post('application', true);
        $suggestion_type = $this->input->post('suggestion_type', true);
        $message = $this->input->post('message', true);
        $voice_message = $this->input->post('voice_message', true);
		$userid = $this->session->userdata('id');
		    
        $errors = [];
    
        // Check validation of form
        if (empty($application)) {
            $errors['application'] = 'Application field is required.';
        }
        if (empty($suggestion_type)) {
            $errors['suggestion_type'] = 'Suggestion type field is required.';
        }
        if (empty($message)) {
            $errors['message'] = 'Message field is required.';
        }
    
        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            redirect('suggestionform');
        }
    
        $audio_filename = null;
        $audio_folder = FCPATH . 'application/assets/audio/'; // Audio folder path
    
        if (!is_dir($audio_folder)) {
            if (!mkdir($audio_folder, 0777, true)) {
                $this->session->set_flashdata('errors', ['Failed to create audio folder.']);
                redirect('suggestionform');
            }
        }
    
        if (!empty($voice_message)) {
            // Generate a unique filename
            $unique_id = time(); // You can also use uniqid() for more uniqueness
            $audio_filename = 'audio_' . $unique_id . '.wav'; 
            $audio_path = $audio_folder . $audio_filename;
    
            $decoded_audio = base64_decode($voice_message, true);
            if ($decoded_audio === false) {
                $this->session->set_flashdata('errors', ['Base64 decoding failed. Please check the provided audio data.']);
                redirect('suggestionform');
            }
    
            if (file_put_contents($audio_path, $decoded_audio) === false) {
                $this->session->set_flashdata('errors', ['Failed to save the audio file. Please check file permissions.']);
                redirect('suggestionform');
            }
        }
    
        $data = [
            'application' => $application,
            'suggestion_type' => $suggestion_type,
            'message' => $message,
            'voice_message' => $audio_filename, // Store unique filename in DB
			'userid' => $userid
        ];
    
        $inserted = $this->User_model->insert_suggestion($data);
    
        if ($inserted) {
            $this->session->set_flashdata('success', '✅ Suggestion submitted successfully.');
            redirect('suggestionform');
        } else {
            log_message('error', 'Database insertion failed: ' . print_r($this->db->error(), true));
            $this->session->set_flashdata('errors', ['Failed to submit suggestion.']);
            redirect('suggestionform');
        }
    }

    //Dashboard view
    public function dashboardview() {
        // Get total domestic customers
        $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

        // Customer Strength stats
        $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
        $customer_data['total']['percent'] = $total_customers > 0 ? 
            round(($customer_data['total']['total'] / $total_customers) * 100, 2) : 0;

        // Phone Missing stats
        $phone_stats_raw = $this->CustomerRegister_model->get_phone_missing_stats();
        $phone_stats = [
            'total' => [
                'qty' => $phone_stats_raw['total']['total'] ?? 0,
                'percent' => $total_customers > 0 
                    ? round(($phone_stats_raw['total']['total'] / $total_customers) * 100, 2) 
                    : 0,

                'detailed' => $phone_stats_raw
            ],
            'active' => [
                'qty' => $phone_stats_raw['active']['total'] ?? 0,
                'percent' => $phone_stats_raw['active']['total_percent'] ?? 0
            ],
            'suspended' => [
                'qty' => $phone_stats_raw['suspended']['total'] ?? 0,
                'percent' => $phone_stats_raw['suspended']['total_percent'] ?? 0
            ],
            'deactivated' => [
                'qty' => $phone_stats_raw['deactivated']['total'] ?? 0,
                'percent' => $phone_stats_raw['deactivated']['total_percent'] ?? 0
            ]
        ];

        // Nil Refill stats
        $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
        $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

        // MI Due stats
        $mi_due_summary = $this->CustomerRegister_model->get_mi_due_summary();
        $total_mi_due = 0;
        $pmuy_count = 0;
        $non_pmuy_count = 0;

        foreach ($mi_due_summary as $row) {
            if ($row['scheme_type'] === 'PMUY') {
                $pmuy_count += $row['count'];
            } else {
                $non_pmuy_count += $row['count'];
            }
            $total_mi_due += $row['count'];
        }

        $mi_stats = [
            'total' => [
                'qty' => $total_mi_due,
                'percent' => $total_customers > 0 ? round(($total_mi_due / $total_customers) * 100, 2) : 0
            ],
            'pmuy' => [
                'qty' => $pmuy_count,
                'percent' => $total_mi_due > 0 ? round(($pmuy_count / $total_mi_due) * 100, 2) : 0
            ],
            'non_pmuy' => [
                'qty' => $non_pmuy_count,
                'percent' => $total_mi_due > 0 ? round(($non_pmuy_count / $total_mi_due) * 100, 2) : 0
            ]
        ];

        // Hose Due stats
        $hose_stats_raw = $this->CustomerRegister_model->get_hose_due_stats('dashboard');
        
        $hose_stats = [
            'Total' => $hose_stats_raw['Total'],
            'total' => [
                'qty' => $hose_stats_raw['Total_Due'],
                'percent' => $hose_stats_raw['Total_Due_Percent']
            ],
            'pmuy' => [
                'qty' => $hose_stats_raw['PMUY_Due'],
                'percent' => $hose_stats_raw['PMUY_Due_Percent']
            ],
            'non_pmuy' => [
                'qty' => $hose_stats_raw['Non_PMUY_Due'],
                'percent' => $hose_stats_raw['Non_PMUY_Due_Percent']
            ]
        ];

        //SDSM Report stats
        $sdsms_report = $this->WebScrapping_model->get_merged_order_data();
        $sdsms_stats = [];
        if (!empty($sdsms_report)) {
            $sdsms_stats = [
                'total' => count($sdsms_report),
            ];
        } else {
            $sdsms_stats = [
                'total' => 0,
                'areas' => [],
                'cashmemo_generated' => 0,
                'status_counts' => []
            ];
        }
        // Prepare data for the view
        $data = [
            'method' => 'dashboard',
            'customer_data' => $customer_data,
            'sbc_counts' => $this->CustomerRegister_model->get_sbc_status_counts(),
            'kyc_stats' => $this->CustomerRegister_model->get_kyc_stats(),
            'stats' => $stats,
            'all_customers' => $all_customers,
            'mi_stats' => $mi_stats,
            'hose_stats' => $hose_stats,
            'phone_stats' => $phone_stats,
            'page_title' => 'Dashboard',
            'report_date' => date('d-M-Y H:i:s'),
            'total_customers' => $total_customers,
            'sdsms_stats' => $sdsms_stats  
        ];
         $data['websites'] = $this->WebsiteModel->get_all_websites();
        $this->load->view('website_dashboard', $data); 
    }

    public function stored_website() {
        $data['websites'] = $this->WebsiteModel->get_all_websites();
        $data['method'] = 'store_website';
        $this->load->view('website_dashboard', $data); 
    }

    //Scrape data from the website
    public function scrape_data(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => strip_tags(validation_errors())
                ]));
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');

        $api_url = 'http://127.0.0.1:5000/scrape';
        $post_data = ['username' => $userId, 'password' => $password];

        $ch = curl_init();
        ini_set('max_execution_time', 300);
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
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            log_message('error', 'CURL Error: '.$error_msg);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'API Connection Error',
                    'details' => $error_msg
                ]));
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Invalid JSON from API: '.$response);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid API Response',
                    'details' => substr($response, 0, 200) // First 200 chars of response
                ]));
        }

        if ($result['status'] !== 'success') {
            log_message('error', 'API returned error: '.($result['message'] ?? 'Unknown error'));
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $result['message'] ?? 'Scraping failed',
                    'api_response' => $result
                ]));
        }

        $user_id = $this->session->userdata('id');
        if (empty($user_id)) {
            log_message('error', 'User session expired during scraping');
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Session expired. Please login again.'
                ]));
        }

        // Prepare data with better error handling
        $invoiced_data = [];
        if (!empty($result['data']['invoiced_process_order'])) {
            $invoiced_data = array_map(function ($item) use ($user_id) {
                return [
                    'area_name' => $item['Area Name'] ?? 'N/A',
                    'cashmemo_generated' => $item['CashMemo Generated'] ?? 'N/A',
                    'status' => $item['Status'] ?? 'N/A',
                    'userid' => $user_id
                ];
            }, $result['data']['invoiced_process_order']);
        }

        $open_data = [];
        if (!empty($result['data']['open_orders'])) {
            $open_data = array_map(function ($item) use ($user_id) {
                return [
                    'area_name' => $item['Area Name'] ?? 'N/A',
                    'open_refill_orders' => $item['Open Refill Orders'] ?? 'N/A',
                    'userid' => $user_id
                ];
            }, $result['data']['open_orders']);
        }

        // Save data with transaction
        $this->db->trans_start();
        $success1 = $this->WebScrapping_model->invoice_order_data($invoiced_data);
        $success2 = $this->WebScrapping_model->open_order_data($open_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Database transaction failed during data save');
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Database operation failed',
                    'details' => [
                        'invoiced_success' => $success1,
                        'open_success' => $success2,
                        'transaction_error' => true
                    ]
                ]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'Data processed successfully',
                'stats' => [
                    'invoiced_records' => count($invoiced_data),
                    'open_records' => count($open_data)
                ]
            ]));
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
        $data['orders'] = $this->WebScrapping_model->get_all_invoice_order_data();
        $this->load->view('website_dashboard', $data);
    }

    //Display open process data in website
    public function display_open_data() {
        $data['method'] = 'display_open_data';
        $data['excel_orders'] = $this->WebScrapping_model->get_all_open_order_data();
        $this->load->view('website_dashboard', $data);
    }

    //Display merged data
    public function merged_data() {
        $userid = $this->session->userdata('id');
        $data['method'] = 'sdms_report';
        $data['orders'] = $this->WebScrapping_model->get_merged_order_data();
        $this->load->view('website_dashboard', $data);
    }
   
    // public function bireport_store_data(){
    //      $data['bireport'] = $this->WebsiteModel->get_all_websites();
    //     $data['method'] = 'store_website';
    //     $this->load->view('website_dashboard', $data); 
    // }

    public function bireport_scrape_data(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => strip_tags(validation_errors())
                ]));
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');

        $api_url = 'http://127.0.0.1:5000/bi_report_scraper'; // Your Flask scraper endpoint
        $post_data = ['username' => $userId, 'password' => $password];

        $ch = curl_init();
        ini_set('max_execution_time', 300); // Extend timeout in PHP

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
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            log_message('error', 'CURL Error: '.$error_msg);

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'API Connection Error',
                    'details' => $error_msg
                ]));
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Invalid JSON from API: '.$response);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid API Response',
                    'details' => substr($response, 0, 200)
                ]));
        }

        if (!isset($result['status']) || $result['status'] !== 'success') {
            log_message('error', 'API returned error: '.($result['message'] ?? 'Unknown error'));
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $result['message'] ?? 'Scraping failed',
                    'api_response' => $result
                ]));
        }

        // Check if user session exists
        $user_id = $this->session->userdata('id');
        if (empty($user_id)) {
            log_message('error', 'User session expired during scraping');
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Session expired. Please login again.'
                ]));
        }

        // ✅ SUCCESS RESPONSE
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'BI Report scraping completed successfully.',
                'data' => $result['data'] ?? [] // Optional, depends on your Flask API response
            ]));
    }

    
    }
        
?>