<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session', 'email']);
        $this->load->model('User_model');
        $this->load->model('CustomerRegister_model');
        $this->load->model('WebsiteModel');
        $this->load->model('WebScrapping_model');
        $this->load->model('OpenOrder_model');
        $this->load->model('Permission_model');
        $this->load->database();
        $this->config->load('email');
        $this->load->helper('string');
    }

    // public function index() {
    //     $this->load->view('login_form');
    // }

    public function login() {
        $this->load->view('login_form');
    }

    public function login_user() {
        $login_input = trim($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user_name = $this->User_model->getusername();

        $errors = [];
        if (empty($login_input)) {
            $errors['email'] = 'Email or User ID is required.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }

        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('email', $login_input);
            redirect('loginform');
        }

        $user = $this->User_model->getUserByEmailOrUserID($login_input);
        if ($user && password_verify($password, $user->Password)) {
            $this->session->set_userdata([
                'id' => $user->id,
                'full_name' => $user->full_name
            ]);
            $this->session->set_flashdata('login_success', true);
            redirect('dashboard');
        } else {
            $errors = $user ? ['password' => 'Incorrect password.'] : ['email' => 'No account found with this Email or User ID.'];
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('email', $login_input);
            redirect('login/process_login');
        }
    }
    public function profile() {
        $staff_id = $this->session->userdata('user_id');
        if (!$staff_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        $data['method'] = "profile";
        $data['distributor_data'] = $this->User_model->get_staff_data_by_id($staff_id);
        $data['validation_errors'] = $this->form_validation->error_array();
        $this->load->view('website_dashboard', $data);
    }

    public function add() {
        // Verify user is logged in
        $staff_id = $this->session->userdata('user_id');
        if (!$staff_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[10]|max_length[15]');
            $this->form_validation->set_rules('sap_code', 'SAP Code', 'trim|max_length[500]');
            $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|max_length[500]');
            $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|max_length[500]');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|max_length[500]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|numeric');
            $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('office_mobile', 'Office Mobile', 'trim|numeric|min_length[10]|max_length[15]');

            if ($this->form_validation->run() === FALSE) {
                // Store validation errors and form data
                $this->session->set_flashdata('form_errors', validation_errors());
                $this->session->set_flashdata('form_data', $this->input->post());
                redirect('user/profile');
            } else {
                // Prepare data for update
                $data = [
                    'phone' => $this->input->post('phone', TRUE),
                    'sap_code' => $this->input->post('sap_code', TRUE) ?: NULL,
                    'account_holder_name' => $this->input->post('account_holder_name', TRUE) ?: NULL,
                    'account_number' => $this->input->post('account_number', TRUE) ?: NULL,
                    'ifsc_code' => $this->input->post('ifsc_code', TRUE) ?: NULL,
                    'bank_name' => $this->input->post('bank_name', TRUE) ?: NULL,
                    'address' => $this->input->post('address', TRUE),
                    'pin_code' => $this->input->post('pin_code', TRUE),
                    'city' => $this->input->post('city', TRUE),
                    'office_mobile' => $this->input->post('office_mobile', TRUE) ?: NULL
                ];

                // Check for actual changes
                $current_data = $this->User_model->get_staff_data_by_id($staff_id);
                $changes = array_diff_assoc($data, (array)$current_data);
                
                if (empty($changes)) {
                    $this->session->set_flashdata('info', 'No changes were made to your profile.');
                    redirect('user/profile');
                }

                // Attempt update
                $update = $this->User_model->update_staff_data($staff_id, $data);
                
                if ($update) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                } else {
                    $error = $this->db->error();
                    $error_message = $error['code'] ? 'Database error: ' . $error['message'] : 'No matching record found';
                    log_message('error', 'Profile update failed: ' . $error_message);
                    $this->session->set_flashdata('error', 'Failed to update profile. ' . $error_message);
                }
                redirect('user/profile');
            }
        } else {
            $this->session->set_flashdata('error', 'No data submitted.');
            redirect('user/profile');
        }
    }
    public function logout() {
        $this->session->unset_userdata(['id', 'full_name']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile/login_form');
    }

    public function suggestion_form() {
        $data['method'] = "suggestion";
        $this->load->view('website_dashboard', $data);
    }

    public function submit_suggestion() {
        $application = $this->input->post('application', true);
        $suggestion_type = $this->input->post('suggestion_type', true);
        $message = $this->input->post('message', true);
        $voice_message = $this->input->post('voice_message', true);
        $userid = $this->session->userdata('user_id');

        $errors = [];
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
        $audio_folder = FCPATH . 'application/assets/audio/';
        if (!is_dir($audio_folder) && !mkdir($audio_folder, 0777, true)) {
            $this->session->set_flashdata('errors', ['Failed to create audio folder.']);
            redirect('suggestionform');
        }

        if (!empty($voice_message)) {
            $unique_id = time();
            $audio_filename = 'audio_' . $unique_id . '.wav';
            $audio_path = $audio_folder . $audio_filename;
            $decoded_audio = base64_decode($voice_message, true);
            if ($decoded_audio === false || file_put_contents($audio_path, $decoded_audio) === false) {
                $this->session->set_flashdata('errors', ['Failed to save the audio file.']);
                redirect('suggestionform');
            }
        }

        $data = [
            'application' => $application,
            'suggestion_type' => $suggestion_type,
            'message' => $message,
            'voice_message' => $audio_filename,
            'userid' => $userid
        ];

        if ($this->User_model->insert_suggestion($data)) {
            $this->session->set_flashdata('success', '✅ Suggestion submitted successfully.');
        } else {
            $this->session->set_flashdata('errors', ['Failed to submit suggestion.']);
        }
        redirect('suggestionform');
    }

    public function forgot_password_view() {
        $this->load->view('forgot_password');
    }

    // public function send_otp() {
    //     $email = trim($this->input->post('email', true));

    //     // Form Validation
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors()); // Get all validation errors
    //         $this->session->set_flashdata('email_input', $email); // Keep the entered email
    //         redirect('forgot-password');
    //     }

    //     // Check if email exists in DB
    //     $user = $this->User_model->getUserByEmail($email); // Use the existing getUserByEmail in User_model

    //     if ($user) {
    //         // Generate OTP
    //         $otp = random_string('numeric', 6); // CodeIgniter's random_string helper

    //         // Store OTP in the database with expiry
    //         // You'll need to add columns to your 'user' table:
    //         // - `otp_code` (VARCHAR)
    //         // - `otp_expires_at` (DATETIME)
    //         $this->User_model->store_otp($user->id, $otp); // Pass user ID and OTP to model

    //         // Send Email with OTP
    //         $this->email->from($this->config->item('smtp_user'), 'Your App Name'); // Sender email from config
    //         $this->email->to($email);
    //         $this->email->subject('Password Reset OTP for AMUDHU');
    //         $message = "Dear " . $user->Firstname . ",\n\n";
    //         $message .= "Your One-Time Password (OTP) for resetting your password is: <strong>" . $otp . "</strong>\n\n";
    //         $message .= "This OTP is valid for 15 minutes. Please do not share it with anyone.\n\n";
    //         $message .= "If you did not request a password reset, please ignore this email.\n\n";
    //         $message .= "Regards,\nAmudhu Team";

    //         $this->email->message($message);

    //         if ($this->email->send()) {
    //             $this->session->set_flashdata('success', 'An OTP has been sent to your email address.');
    //             // Redirect to a page where user can enter OTP
    //             redirect('verify-otp-view'); // Create this route and view next
    //         } else {
    //             log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
    //             $this->session->set_flashdata('error', 'Failed to send OTP email. Please try again.');
    //             $this->session->set_flashdata('email_input', $email);
    //             redirect('forgot-password');
    //         }
    //     } else {
    //         $this->session->set_flashdata('error', 'No account found with that email address.');
    //         $this->session->set_flashdata('email_input', $email);
    //         redirect('forgot-password');
    //     }
    // }

    public function send_otp() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('forgot_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->getUserByEmail($email);

            if ($user) {
                $otp = rand(100000, 999999);
                $expiration = date('Y-m-d H:i:s', strtotime('+10 minutes'));

                $this->User_model->store_otp($user->id, $otp, $expiration);

                // --- NEW EMAIL CONFIGURATION WITH SSL CONTEXT ---
                $config = array();
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.googlemail.com'; // No 'ssl://' prefix
                $config['smtp_port'] = 587;
                $config['smtp_user'] = 'arasu5070go@gmail.com';
                $config['smtp_pass'] = 'vhbo wdas qlzt cyuv'; // Your App Password
                $config['smtp_crypto'] = 'tls';
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $config['newline'] = "\r\n";
                $config['crlf'] = "\r\n"; // Fixed the typo here
                $config['smtp_timeout'] = 30;
                $config['smtp_keepalive'] = TRUE;
                $config['smtp_auto_tls'] = TRUE;
                $config['validate'] = TRUE;

                // **CRUCIAL: Add stream context options to explicitly disable SSL verification**
                $config['smtp_opts'] = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $this->email->initialize($config); // Initialize with this new config

                $this->email->from('arasu5070go@gmail.com', 'Your Application Name');
                $this->email->to($email);
                $this->email->subject('Password Reset OTP for Your Application');

                $email_content = '<p>Dear ' . $user->username . ',</p>';
                $email_content .= '<p>Your One-Time Password (OTP) for password reset is: <strong>' . $otp . '</strong></p>';
                $email_content .= '<p>This OTP is valid for 10 minutes. Do not share this with anyone.</p>';
                $email_content .= '<p>If you did not request a password reset, please ignore this email.</p>';
                $email_content .= '<p>Regards,<br>Your Application Team</p>';

                $this->email->message($email_content);

                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'An OTP has been sent to your email address. Please check your inbox and spam folder.');
                    redirect('verify-otp-view');
                } else {
                    $error_message = $this->email->print_debugger(array('headers', 'subject', 'body'));
                    log_message('error', 'Email sending failed for ' . $email . ': ' . $error_message);
                    $this->session->set_flashdata('error', 'Failed to send OTP. Please try again later.');
                    redirect('forgot-password');
                }

            } else {
                $this->session->set_flashdata('error', 'Email address not found.');
                redirect('forgot-password');
            }
        }
    }

    public function dashboardview() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());
        $data['access'] = [
            'customer_strength' => $this->Permission_model->is_allowed($route, $user_id),
            'kyc_data' => $this->Permission_model->is_allowed($route, $user_id),
            'sbc_data' => $this->Permission_model->is_allowed($route, $user_id),
            'nillfill' => $this->Permission_model->is_allowed($route, $user_id),
            'midue' => $this->Permission_model->is_allowed($route, $user_id),
            'hosedue' => $this->Permission_model->is_allowed($route, $user_id),
            'phonenumber' => $this->Permission_model->is_allowed($route, $user_id)
        ];
        $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();
        $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
        $customer_data['total']['percent'] = $total_customers > 0 ? round(($customer_data['total']['total'] / $total_customers) * 100, 2) : 0;

        $phone_stats_raw = $this->CustomerRegister_model->get_phone_missing_stats();
        $phone_stats = [
            'total' => [
                'qty' => $phone_stats_raw['total']['total'] ?? 0,
                'percent' => $total_customers > 0 ? round(($phone_stats_raw['total']['total'] / $total_customers) * 100, 2) : 0,
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

        $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
        $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

        $mi_due_summary = $this->CustomerRegister_model->get_mi_due_summary();
        $total_mi_due = $pmuy_count = $non_pmuy_count = 0;
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

        $sdsms_report = $this->WebScrapping_model->get_merged_order_data();
        $sdsms_stats = !empty($sdsms_report) ? ['total' => count($sdsms_report)] : ['total' => 0, 'areas' => [], 'cashmemo_generated' => 0, 'status_counts' => []];

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
            'sdsms_stats' => $sdsms_stats,
            'websites' => $this->WebsiteModel->get_all_websites()
        ];
        $this->load->view('website_dashboard', $data);
    }
    
    public function stored_website() { 
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        $data['websites'] = $this->WebsiteModel->get_all_websites();
        $data['method'] = 'store_website';
        $this->load->view('website_dashboard', $data);
    }

    public function add_website() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }
        $url = trim($this->input->post('url'));
        $userId = trim($this->input->post('userId'));
        $password = trim($this->input->post('password'));
        $selectwebsitename = $this->input->post('selectwebsitename');
        $loggeduserid = $this->session->userdata('user_id');

        log_message('debug' , 'logged user id :' . ($loggeduserid ?? 'NULL'));
        $errors = [];

        // Ensure user is logged in
        if (empty($loggeduserid)) {
            $this->session->set_flashdata('error', 'You must be logged in to add a website.');
            redirect('login');
            return;
        }

        // Validate logged user exists in user table
        $this->db->where('id', $loggeduserid);
        $query = $this->db->get('user');
        if ($query->num_rows() == 0) {
            $errors['loggeduserid'] = 'Invalid user ID. User does not exist.';
        }

        // Validate URL
        if (!empty($url)) {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $errors['url'] = 'Invalid URL format.';
            }
        } else {
            $errors['url'] = 'Website URL is required.';
        }

        // Validate other inputs
        if (empty($userId)) {
            $errors['userId'] = 'Username is required.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }
        if (empty($selectwebsitename)) {
            $errors['selectwebsitename'] = 'Please select a website.';
        }

        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            $data['method'] = 'store_website';
            $data['websites'] = $this->WebsiteModel->get_all_websites();
            $this->load->view('website_dashboard', $data);
            return;
        }

        // Prepare data for insertion
        $insert_data = [
            'website_userId' => $userId,
            'website_password' => $password,
            'website_url' => $url,
            'selectwebsitename' => $selectwebsitename,
            'userid' => $loggeduserid
        ];

        log_message('debug', 'Insert data: ' . json_encode($insert_data));

        if ($this->WebsiteModel->insert_website($insert_data)) {
            $this->session->set_flashdata('success', 'Website added successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to add website.');
        }
        redirect('storewebsite');
    }

    public function edit_website() {
        $url = $this->input->post('url');
        $website_id = $this->input->post('website_id');
        $selectwebsitename = $this->input->post('selectwebsitename');
        $userId = trim($this->input->post('userId'));
        $password = trim($this->input->post('password'));
        $loggeduserid = $this->session->userdata('user_id');

        $errors = [];
        if (empty($url)) $errors['url'] = 'Website URL is required.';
        if (empty($website_id)) $errors['website_id'] = 'Website ID is required.';
        if (empty($userId)) $errors['userId'] = 'Username is required.';
        if (empty($password)) $errors['password'] = 'Password is required.';
        if (empty($selectwebsitename)) $errors['selectwebsitename'] = 'Please select a website.';
        if (empty($loggeduserid)) $errors['loggeduserid'] = 'Not a valid logged-in user.';

        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            $data['method'] = 'store_website';
            $data['websites'] = $this->WebsiteModel->get_all_websites();
            $this->load->view('website_dashboard', $data);
            return;
        }

        $data = [
            'website_url' => $url,
            'website_userId' => $userId,
            'website_password' => $password,
            'selectwebsitename' => $selectwebsitename
        ];

        if ($this->WebsiteModel->update_website($website_id, $loggeduserid, $data)) {
            $this->session->set_flashdata('success', 'Website updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update website.');
        }
        redirect('storewebsite');
    }

    public function delete_website() {
        $website_id = $this->input->post('website_id');
        $loggeduserid = $this->session->userdata('user_id');

        $errors = [];
        if (empty($website_id)) $errors['website_id'] = 'Website ID is required.';
        if (empty($loggeduserid)) $errors['loggeduserid'] = 'Not a valid logged-in user.';

        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            $data['method'] = 'store_website';
            $data['websites'] = $this->WebsiteModel->get_all_websites();
            $this->load->view('website_dashboard', $data);
            return;
        }

        if ($this->WebsiteModel->delete_website($website_id, $loggeduserid)) {
            $this->session->set_flashdata('success', 'Website deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete website.');
        }
        redirect('storewebsite');
    }

    public function scrape_data() {
        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => strip_tags(validation_errors())
            ]));
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');
        $api_url = 'http://127.0.0.1:5000/data_scraper';
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
            log_message('error', 'CURL Error: ' . $error_msg);
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'API Connection Error',
                'details' => $error_msg
            ]));
        }
        curl_close($ch);

        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Invalid JSON from API: ' . $response);
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Invalid API Response',
                'details' => substr($response, 0, 200)
            ]));
        }

        if ($result['status'] !== 'success') {
            log_message('error', 'API returned error: ' . ($result['message'] ?? 'Unknown error'));
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => $result['message'] ?? 'Scraping failed',
                'api_response' => $result
            ]));
        }

        $user_id = $this->session->userdata('user_id');
        if (empty($user_id)) {
            log_message('error', 'User session expired during scraping');
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]));
        }

        $invoiced_data = !empty($result['data']['invoiced_process_order']) ? array_map(function ($item) use ($user_id) {
            return [
                'area_name' => $item['Area Name'] ?? 'N/A',
                'cashmemo_generated' => $item['CashMemo Generated'] ?? 'N/A',
                'status' => $item['Status'] ?? 'N/A',
                'userid' => $user_id
            ];
        }, $result['data']['invoiced_process_order']) : [];

        $open_data = !empty($result['data']['open_orders']) ? array_map(function ($item) use ($user_id) {
            return [
                'area_name' => $item['Area Name'] ?? '',
                'open_refill_orders' => $item['Open Refill Orders'] ?? 'N/A',
                'userid' => $user_id
            ];
        }, $result['data']['open_orders']) : [];

        $this->db->trans_start();
        $success1 = $this->WebScrapping_model->invoice_order_data($invoiced_data);
        $success2 = $this->WebScrapping_model->open_order_data($open_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Database transaction failed during data save');
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Database operation failed',
                'details' => ['invoiced_success' => $success1, 'open_success' => $success2]
            ]));
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'message' => 'Data scraped successfully',
            'stats' => ['invoiced_records' => count($invoiced_data), 'open_records' => count($open_data)]
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

    public function display_invoice_data() {
        $data['method'] = 'display_invoice_data';
        $data['orders'] = $this->WebScrapping_model->get_all_invoice_order_data();
        $this->load->view('website_dashboard', $data);
    }

    public function display_open_data() {
        $data['method'] = 'display_open_data';
        $data['excel_orders'] = $this->WebScrapping_model->get_all_open_order_data();
        $this->load->view('website_dashboard', $data);
    }

    public function merged_data() {
        $this->load->model('Permission_model');

        $user_id = $this->session->userdata('user_id');
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
            // Load dashboard view with access denied modal trigger
            $data = [
                'access_denied' => true,
                'method' => 'sdms_report',
                'orders' => []
            ];
            $this->load->view('website_dashboard', $data);
            return;
        }

        // Permission allowed
        $data = [
            'method' => 'sdms_report',
            'orders' => $this->WebScrapping_model->get_merged_order_data(),
            'access_denied' => false
        ];
        $this->load->view('website_dashboard', $data);
    }


    public function bireport_scrape_data() {
        $this->form_validation->set_rules('userId', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == NULL) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => strip_tags(validation_errors())
            ]));
        }

        $userId = $this->input->post('userId');
        $password = $this->input->post('password');
        $api_url = 'http://127.0.0.1:5000/bi_report_scraper';
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
            log_message('error', 'CURL Error: ' . $error_msg);
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'API Connection Error',
                'details' => $error_msg
            ]));
        }
        curl_close($ch);

        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Invalid JSON from API: ' . $response);
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Invalid API Response',
                'details' => substr($response, 0, 200)
            ]));
        }

        if (!isset($result['status']) || $result['status'] !== 'success') {
            log_message('error', 'API returned error: ' . ($result['message'] ?? 'Unknown error'));
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => $result['message'] ?? 'Scraping failed',
                'api_response' => $result
            ]));
        }

        $user_id = $this->session->userdata('user_id');
        if (empty($user_id)) {
            log_message('error', 'User session expired during scraping');
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]));
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'message' => 'BI Report scraping completed successfully',
            'data' => $result['data'] ?? []
        ]));
    }


}