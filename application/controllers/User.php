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
  
//    public function dashboardview() {
//     // Get total domestic customers
//     $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

//     // Customer Strength stats
//     $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
//     $customer_data['total']['percent'] = $total_customers > 0 ? 
//         round(($customer_data['total']['total'] / $total_customers) * 100, 2) : 0;

//     // Phone Missing stats
//     $phone_stats_raw = $this->CustomerRegister_model->get_phone_missing_stats();
//     $phone_stats = [
//         'total' => [
//             'qty' => $phone_stats_raw['Total'] ?? 0,
//             'percent' => $total_customers > 0 ? 
//                 round((($phone_stats_raw['Total'] ?? 0) / $total_customers) * 100, 2) : 0
//         ]
//     ];

//     // Nil Refill stats
//     $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
//     $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

//     // MI Due stats
//     $mi_due_summary = $this->CustomerRegister_model->get_mi_due_summary();
//     $total_mi_due = 0;
//     $pmuy_count = 0;
//     $non_pmuy_count = 0;

//     foreach ($mi_due_summary as $row) {
//         if ($row['scheme_type'] === 'PMUY') {
//             $pmuy_count += $row['count'];
//         } else {
//             $non_pmuy_count += $row['count'];
//         }
//         $total_mi_due += $row['count'];
//     }

//     $mi_stats = [
//         'total' => [
//             'qty' => $total_mi_due,
//             'percent' => $total_customers > 0 ? round(($total_mi_due / $total_customers) * 100, 2) : 0
//         ],
//         'pmuy' => [
//             'qty' => $pmuy_count,
//             'percent' => $total_mi_due > 0 ? round(($pmuy_count / $total_mi_due) * 100, 2) : 0
//         ],
//         'non_pmuy' => [
//             'qty' => $non_pmuy_count,
//             'percent' => $total_mi_due > 0 ? round(($non_pmuy_count / $total_mi_due) * 100, 2) : 0
//         ]
//     ];

//     // Hose Due stats
//     $hose_stats_raw = $this->CustomerRegister_model->get_hose_due_stats('dashboard');
    
//     $hose_stats = [
//         'Total' => $hose_stats_raw['Total'],
//         'total' => [
//             'qty' => $hose_stats_raw['Total_Due'],
//             'percent' => $hose_stats_raw['Total_Due_Percent']
//         ],
//         'pmuy' => [
//             'qty' => $hose_stats_raw['PMUY_Due'],
//             'percent' => $hose_stats_raw['PMUY_Due_Percent']
//         ],
//         'non_pmuy' => [
//             'qty' => $hose_stats_raw['Non_PMUY_Due'],
//             'percent' => $hose_stats_raw['Non_PMUY_Due_Percent']
//         ]
//     ];

//     $data = [
//         'method' => 'dashboard',
//         'customer_data' => $customer_data,
//         'sbc_counts' => $this->CustomerRegister_model->get_sbc_status_counts(),
//         'kyc_stats' => $this->CustomerRegister_model->get_kyc_stats(),
//         'stats' => $stats,
//         'all_customers' => $all_customers,
//         'mi_stats' => $mi_stats,
//         'hose_stats' => $hose_stats,
//         'phone_stats' => $phone_stats,
//         'page_title' => 'Dashboard',
//         'report_date' => date('d-M-Y H:i:s'),
//         'total_customers' => $total_customers
//     ];

//     $this->load->view('website_dashboard', $data); 
// }

    // public function dashboardview() {
    //     // Get user ID from session
    //     $userid = $this->session->userdata('id');
    //     if (empty($userid)) {
    //         redirect('login');
    //     }

    //     // Get total domestic customers
    //     $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

    //     // Customer Strength stats
    //     $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
    //     $customer_data['total']['percent'] = $total_customers > 0 ? 
    //         round(($customer_data['total']['total'] / $total_customers) * 100, 2) : 0;

    //     // Phone Missing stats
    //     $phone_stats_raw = $this->CustomerRegister_model->get_phone_missing_stats();
    //     $phone_stats = [
    //         'total' => [
    //             'qty' => $phone_stats_raw['total']['total'] ?? 0,
    //             'percent' => $phone_stats_raw['total']['total_percent'] ?? 0
    //         ],
    //         'pmuy' => [
    //             'qty' => $phone_stats_raw['total']['pmuy'] ?? 0,
    //             'percent' => $phone_stats_raw['total']['pmuy_percent'] ?? 0
    //         ],
    //         'non_pmuy' => [
    //             'qty' => $phone_stats_raw['total']['non_pmuy'] ?? 0,
    //             'percent' => $phone_stats_raw['total']['non_pmuy_percent'] ?? 0
    //         ],
    //         'active' => [
    //             'qty' => $phone_stats_raw['active']['total'] ?? 0,
    //             'percent' => $phone_stats_raw['active']['total_percent'] ?? 0
    //         ],
    //         'suspended' => [
    //             'qty' => $phone_stats_raw['suspended']['total'] ?? 0,
    //             'percent' => $phone_stats_raw['suspended']['total_percent'] ?? 0
    //         ],
    //         'deactivated' => [
    //             'qty' => $phone_stats_raw['deactivated']['total'] ?? 0,
    //             'percent' => $phone_stats_raw['deactivated']['total_percent'] ?? 0
    //         ]
    //     ];

    //     // Nil Refill stats
    //     $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
    //     $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

    //     // MI Due stats
    //     $mi_due_summary = $this->CustomerRegister_model->get_mi_due_summary();
    //     $total_mi_due = 0;
    //     $pmuy_count = 0;
    //     $non_pmuy_count = 0;

    //     foreach ($mi_due_summary as $row) {
    //         if ($row['scheme_type'] === 'PMUY') {
    //             $pmuy_count += $row['count'];
    //         } else {
    //             $non_pmuy_count += $row['count'];
    //         }
    //         $total_mi_due += $row['count'];
    //     }

    //     $mi_stats = [
    //         'total' => [
    //             'qty' => $total_mi_due,
    //             'percent' => $total_customers > 0 ? round(($total_mi_due / $total_customers) * 100, 2) : 0
    //         ],
    //         'pmuy' => [
    //             'qty' => $pmuy_count,
    //             'percent' => $total_mi_due > 0 ? round(($pmuy_count / $total_mi_due) * 100, 2) : 0
    //         ],
    //         'non_pmuy' => [
    //             'qty' => $non_pmuy_count,
    //             'percent' => $total_mi_due > 0 ? round(($non_pmuy_count / $total_mi_due) * 100, 2) : 0
    //         ]
    //     ];

    //     // Hose Due stats
    //     $hose_stats_raw = $this->CustomerRegister_model->get_hose_due_stats('dashboard');
        
    //     $hose_stats = [
    //         'Total' => $hose_stats_raw['Total'] ?? 0,
    //         'total' => [
    //             'qty' => $hose_stats_raw['Total_Due'] ?? 0,
    //             'percent' => $hose_stats_raw['Total_Due_Percent'] ?? 0
    //         ],
    //         'pmuy' => [
    //             'qty' => $hose_stats_raw['PMUY_Due'] ?? 0,
    //             'percent' => $hose_stats_raw['PMUY_Due_Percent'] ?? 0
    //         ],
    //         'non_pmuy' => [
    //             'qty' => $hose_stats_raw['Non_PMUY_Due'] ?? 0,
    //             'percent' => $hose_stats_raw['Non_PMUY_Due_Percent'] ?? 0
    //         ]
    //     ];

    //     $data = [
    //         'method' => 'dashboard',
    //         'customer_data' => $customer_data,
    //         'sbc_counts' => $this->CustomerRegister_model->get_sbc_status_counts(),
    //         'kyc_stats' => $this->CustomerRegister_model->get_kyc_stats(),
    //         'stats' => $stats,
    //         'all_customers' => $all_customers,
    //         'mi_stats' => $mi_stats,
    //         'hose_stats' => $hose_stats,
    //         'phone_stats' => $phone_stats,
    //         'page_title' => 'Dashboard',
    //         'report_date' => date('d-M-Y H:i:s'),
    //         'total_customers' => $total_customers
    //     ];

    //     $this->load->view('website_dashboard', $data); 
    // }
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
                'percent' =>round(($phone_stats_raw['total']['total'] / $total_customers) * 100, 2),
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
            'total_customers' => $total_customers
            
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
    public function scrape_data() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dashboard');
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');

        // API request
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
            curl_close($ch);
            redirect('dashboard');
        }

        curl_close($ch);

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->session->set_flashdata('error', 'Invalid API response format');
            redirect('dashboard');
        }

        if ($result['status'] === 'success') {
            try {
                $user_id = $this->session->userdata('id');

                // Process invoiced orders
                $insert1 = true;
                if (!empty($result['data']['invoiced_process_order'])) {
                    $invoiced_data = array_map(function ($item) use ($user_id) {
                        return [
                            'area_name' => $item['Area Name'] ?? '',
                            'cashmemo_generated' => $item['CashMemo Generated'] ?? '',
                            'status' => $item['Status'] ?? '',
                            'userid' => $user_id
                        ];
                    }, $result['data']['invoiced_process_order']);

                    $insert1 = $this->WebScrapping_model->invoice_order_data($invoiced_data);
                }

                // Process open orders
                $insert2 = true;
                if (!empty($result['data']['open_orders'])) {
                    $open_data = array_map(function ($item) use ($user_id) {
                        return [
                            'area_name' => $item['Area Name'] ?? '',
                            'open_refill_orders' => $item['Open Refill Orders'] ?? '',
                            'userid' => $user_id
                        ];
                    }, $result['data']['open_orders']);

                    $insert2 = $this->WebScrapping_model->open_order_data($open_data);
                }

                if ($insert1 && $insert2) {
                    $this->session->set_flashdata('success', 'Data scraped and stored successfully!');
                    // $this->save_raw_data($result); // Optional for logging
                } else {
                    $this->session->set_flashdata('error', 'Data scraping succeeded but insertion failed.');
                }

            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Database error: ' . $e->getMessage());
                log_message('error', 'Storage error: ' . $e->getMessage());
            }
        } else {
            $error_message = $result['message'] ?? 'Unknown error occurred';
            $this->session->set_flashdata('error', 'Scraping failed: ' . $error_message);
        }

        redirect('dashboard');
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
    

    
    // Display Forgot Password Page
    
        // Show forgot password form
        // public function forgot_password() {
        //     $this->load->view('forgot_password');
        // }
        
        // // Handle forgot password submission
        // public function send_reset_link() {
        //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        
        //     if ($this->form_validation->run() == FALSE) {
        //         $this->session->set_flashdata('error', validation_errors());
        //         redirect('forgot-password');
        //     }
        
        //     $email = $this->input->post('email', true);
        //     $user = $this->User_model->getUserByEmail($email);
        
        //     if (!$user) {
        //         // Don't reveal whether email exists or not
        //         $this->session->set_flashdata('success', 'If this email exists in our system, you will receive a reset link.');
        //         redirect('forgot-password');
        //     }
        
        //     // Create a simple reset link with user ID (not recommended for production)
        //     // $reset_link = base_url('auth/reset_password/' . $user->id);
        //     $reset_link = base_url('reset-password/' . $user->id);

        //     // Configure email
        //     $this->email->from('noreply@yourdomain.com', 'Your App Name');
        //     $this->email->to($email);
        //     $this->email->subject('Password Reset Request');
        
        //     $message = '<p>Hello,</p>';
        //     $message .= '<p>You requested to reset your password. Click the link below to proceed:</p>';
        //     $message .= '<p><a href="' . $reset_link . '">Reset Password</a></p>';
        //     $message .= '<p>If you didn\'t request this, please ignore this email.</p>';
            
        //     $this->email->message($message);
        
        //     if ($this->email->send()) {
        //         $this->session->set_flashdata('success', 'A password reset link has been sent to your email.');
        //     } else {
        //         log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
        //         $this->session->set_flashdata('error', 'Failed to send email. Please try again later.');
        //     }
        
        //     redirect('forgot-password');
        // }
        
        // // Show reset password form
        // public function reset_password($user_id = null) {
        //     if (!$user_id) {
        //         $this->session->set_flashdata('error', 'Invalid reset link.');
        //         redirect('forgot-password');
        //     }
        
        //     $user = $this->User_model->getUserById($user_id);
        //     if (!$user) {
        //         $this->session->set_flashdata('error', 'Invalid reset link.');
        //         redirect('forgot-password');
        //     }
        
        //     $data['user_id'] = $user_id;
        //     $this->load->view('reset_password', $data);
        // }
        
        // // Handle password reset submission
        // public function update_password() {
        //     $user_id = $this->input->post('user_id', true);
            
        //     $user = $this->User_model->getUserById($user_id);
        //     if (!$user) {
        //         $this->session->set_flashdata('error', 'Invalid user account.');
        //         redirect('forgot-password');
        //     }
        
        //     $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        //     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        
        //     if ($this->form_validation->run() == FALSE) {
        //         $data['user_id'] = $user_id;
        //         $this->load->view('reset_password', $data);
        //         return;
        //     }
        
        //     $new_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
        //     $this->User_model->updatePassword($user_id, $new_password);
        
        //     $this->session->set_flashdata('success', 'Password updated successfully. Please login.');
        //     redirect('loginform');
        // }

        public function send_test_email() {
            $this->load->library('email');
            $this->config->load('email');
            $this->email->initialize($this->config->config);
        
            $this->email->from('arasu5070go@gmail.com', 'Your App');
            $this->email->to('your-valid-email@gmail.com');
            $this->email->subject('Testing Gmail SMTP');
            $this->email->message('<p>This is a test email using Gmail SMTP from XAMPP.</p>');
        
            if ($this->email->send()) {
                echo "✅ Email sent successfully!";
            } else {
                echo "❌ Email failed:<br><pre>";
                print_r($this->email->print_debugger());
                echo "</pre>";
            }
        }
        
        
        
    }
        
?>