<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->model('User_model'); //load model here
        $this->load->database();
        $this->load->model('CustomerRegister_model');
		// $this->load->model('WebsiteModel');
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
    
    public function dashboardview() {
      
      
        // Get total domestic customers
        $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

        // Customer Strength stats
        $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
        $customer_data['total']['percent'] = $total_customers > 0 ? round(($customer_data['total']['total'] / $total_customers) * 100, 2) : 0;

        // Phone Missing stats
        $phone_stats_raw = $this->CustomerRegister_model->get_phone_missing_stats();
        $phone_stats = [
            'total' => [
                'qty' => $phone_stats_raw['Total'],
                'percent' => $total_customers > 0 ? round(($phone_stats_raw['Total'] / $total_customers) * 100, 2) : 0
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
        $hose_stats_raw = $this->CustomerRegister_model->get_hose_due_stats();
        $hose_stats = [
            'total' => [
                'qty' => $hose_stats_raw['Total_Due'],
                'percent' => $hose_stats_raw['Total_Due_Percent']
            ]
        ];

        // Prepare data for view
        $data = [
            'method' => 'dashboard',
            'customer_data' => $customer_data,
            'sbc_counts' => $this->CustomerRegister_model->get_sbc_status_counts(),
            'kyc_stats' => $this->CustomerRegister_model->get_kyc_stats(),
            'stats' => $stats, // Nil Refill
            'all_customers' => $all_customers,
            'mi_stats' => $mi_stats,
            'hose_stats' => $hose_stats,
            'phone_stats' => $phone_stats,
            'page_title' => 'Dashboard',
            'report_date' => date('d-M-Y H:i:s'),
            'total_customers' => $total_customers
        ];

        $this->load->view('website_dashboard', $data);
    }   
    
    
      // Forgot Password Page
// public function forgot_password() {
//     $this->load->view('forgot_password');
// }

// // Handle Forgot Password Submission
// public function send_reset_link() {
//     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

//     if ($this->form_validation->run() == FALSE) {
//         $this->session->set_flashdata('errors', validation_errors());
//         redirect('forgot-password');
//     }

//     $email = $this->input->post('email', true);
//     $user = $this->User_model->getUserByEmail($email);

//     if (!$user) {
//         $this->session->set_flashdata('errors', 'No account exists with this email.');
//         redirect('forgot-password');
//     }

//     // Generate reset link (using user ID for simplicity)
//     $reset_link = base_url('reset-password/' . $user->id);

//     // Email configuration
//     $this->load->library('email');
//     $config['mailtype'] = 'html';
//     $this->email->initialize($config);
    
//     $this->email->from('no-reply@yourdomain.com', 'Your App Name');
//     $this->email->to($email);
//     $this->email->subject('Password Reset Request');
    
//     $message = '<p>Click the following link to reset your password:</p>';
//     $message .= '<p><a href="'.$reset_link.'">'.$reset_link.'</a></p>';
//     $message .= '<p>If you didn\'t request this, please ignore this email.</p>';
    
//     $this->email->message($message);

//     if ($this->email->send()) {
//         $this->session->set_flashdata('success', 'A password reset link has been sent to your email.');
//     } else {
//         log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
//         $this->session->set_flashdata('errors', 'Failed to send email. Please try again.');
//     }
    
//     redirect('forgot-password');
// }

// // Reset Password Page
// public function reset_password($user_id = null) {
//     if (!$user_id) {
//         $this->session->set_flashdata('errors', 'Invalid reset link.');
//         redirect('forgot-password');
//     }

//     $user = $this->db->where('id', $user_id)->get('user')->row();
    
//     if (!$user) {
//         $this->session->set_flashdata('errors', 'Invalid reset link.');
//         redirect('forgot-password');
//     }

//     $data['user_id'] = $user_id;
//     $this->load->view('reset_password', $data);
// }

// // Handle Password Reset Submission
// public function update_password() {
//     $user_id = $this->input->post('user_id', true);
    
//     // Verify user exists
//     $user = $this->db->where('id', $user_id)->get('user')->row();
//     if (!$user) {
//         $this->session->set_flashdata('errors', 'Invalid user account.');
//         redirect('forgot-password');
//     }

//     $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
//     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

//     if ($this->form_validation->run() == FALSE) {
//         $this->session->set_flashdata('errors', validation_errors());
//         $data['user_id'] = $user_id;
//         $this->load->view('reset_password', $data);
//         return;
//     }

//     $new_password = password_hash($this->input->post('new_password', true), PASSWORD_BCRYPT);
//     $this->User_model->changeUserPassword($user_id, $new_password);

//     $this->session->set_flashdata('success', 'Password updated successfully. Please login.');
//     redirect('loginform');
// }


    //Display Forgot Password Page
    // public function forgot_password() {
    //     $this->load->view('forgot_password');
    // }

    // // Handle Forgot Password Submission
    // public function send_reset_link() {
    //     // Set form validation rules
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //         redirect('forgot-password');
    //     }

    //     $email = $this->input->post('email', TRUE);
    //     $user = $this->User_model->getUserByEmail($email);

    //     if (!$user) {
    //         $this->session->set_flashdata('errors', 'No account exists with this email.');
    //         redirect('forgot-password');
    //     }

    //     // Generate reset link using user ID
    //     $reset_link = base_url('reset-password/' . $user->id);

    //     // Initialize email with config from email.php
    //     // $this->email->initialize($this->config->item('email'));

    //     $this->email->from('arasu5070go@gmail.com', 'Your App Name');
    //     $this->email->to($email);
    //     $this->email->subject('Password Reset Request');

    //     $message = '<p>Click the following link to reset your password:</p>';
    //     $message .= '<p><a href="' . $reset_link . '">' . $reset_link . '</a></p>';
    //     $message .= '<p>If you didn\'t request this, please ignore this email.</p>';

    //     $this->email->message($message);

    //     if ($this->email->send()) {
    //         $this->session->set_flashdata('success', 'A password reset link has been sent to your email.');
    //     } else {
    //         $error = $this->email->print_debugger(['headers', 'subject', 'body']);
    //         log_message('error', 'Email sending failed: ' . $error);
    //         $this->session->set_flashdata('errors', 'Failed to send email: ' . $error);
    //     }

    //     redirect('forgot-password');
    // }

    // // Reset Password Page
    // public function reset_password($user_id = null) {
    //     if (!$user_id) {
    //         $this->session->set_flashdata('errors', 'Invalid reset link.');
    //         redirect('forgot-password');
    //     }

    //     $user = $this->db->where('id', $user_id)->get('user')->row();

    //     if (!$user) {
    //         $this->session->set_flashdata('errors', 'Invalid reset link.');
    //         redirect('forgot-password');
    //     }

    //     $data['user_id'] = $user_id;
    //     $this->load->view('reset_password', $data);
    // }

    // // Handle Password Reset Submission
    // public function update_password() {
    //     $user_id = $this->input->post('user_id', TRUE);

    //     // Verify user exists
    //     $user = $this->db->where('id', $user_id)->get('user')->row();
    //     if (!$user) {
    //         $this->session->set_flashdata('errors', 'Invalid user account.');
    //         redirect('forgot-password');
    //     }

    //     // Set form validation rules
    //     $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
    //     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //         $data['user_id'] = $user_id;
    //         $this->load->view('reset_password', $data);
    //         return;
    //     }

    //     // Update password
    //     $new_password = password_hash($this->input->post('new_password', TRUE), PASSWORD_BCRYPT);
    //     $this->User_model->changeUserPassword($user_id, $new_password);

    //     $this->session->set_flashdata('success', 'Password updated successfully. Please login.');
    //     redirect('loginform');
    // }

    // Test Email Function (for debugging)
    public function send_email()
    {
        $this->load->library('email');
        // $this->config->load('email', TRUE); // Ensure the email config is loaded
        $config = $this->config->item('email');
        if (!$config) {
        // Configuration array
        $config = [
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.gmail.com',
            'smtp_port'   => 587,
            'smtp_user'   => 'arasu5070go@gmail.com',
            'smtp_pass'   => 'mvjs krhj gkdb bjkg',
            'smtp_crypto' => 'tls',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'wordwrap'    => TRUE,
            'newline'     => "\r\n",
            'smtp_timeout' => 30,
            'smtp_options' => [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                ]
            ]
        ];
    }
        $this->email->initialize($config);
        
        $this->email->from('arasu5070go@gmail.com', 'Poovarasan');
        $this->email->to('ceit35poovarasan24@gmail.com');
        $this->email->subject('Email Test');
        $this->email->message('<p>This is a test email.</p>');
        
        if ($this->email->send()) {
            echo 'Email sent successfully!';
        } else {
            echo 'Email failed: ';
            echo $this->email->print_debugger();
        }
    }
    

    
    

    
}
?>