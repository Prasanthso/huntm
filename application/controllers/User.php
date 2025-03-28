<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->model('User_model'); //load model here
        $this->load->database();
		$this->load->model('WebsiteModel');
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
                $this->session->set_userdata('id', $user->id);
                $this->session->set_flashdata('login_success', true); // ✅ Set flashdata for success message
                redirect('suggestionform'); // Redirect to Suggestion Form
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
	
	//here suggestion page section
    public function suggestion_form() {
        $data['method'] = "suggestion";
        $this->load->view('website_dashboard',$data); 
    }

	public function submit_suggestion() {
		$application = $this->input->post('application', true);
		$suggestion_type = $this->input->post('suggestion_type', true);
		$message = $this->input->post('message', true);
		$voice_message = $this->input->post('voice_message', true);
	
		$errors = [];

		//check validation of form
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
			$sanitized_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $name); 
			$sanitized_name = preg_replace('/\s+/', '_', $sanitized_name); 
			$audio_filename = $sanitized_name . '.wav'; 
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
			'voice_message' => $audio_filename
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

	
    
    // // Store website login details in the database
    // public function store() {
    //     $data['users'] = $this->WebsiteModel->get_users();
    //     $data['errors'] = [];

    //     $url = trim($this->input->post('url'));
    //     $userId = trim($this->input->post('userId'));
    //     $password = trim($this->input->post('password'));
    //     $user_id = trim($this->input->post('user_id'));

    //     // Ensure URL starts with http:// or https://
    //     if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
    //         $url = "https://" . $url;
    //     }

    //     // Manual validation
    //     if (empty($url)) $data['errors']['url'] = 'Website URL is required.';
    //     if (empty($userId)) $data['errors']['userId'] = 'Username is required.';
    //     if (empty($password)) $data['errors']['password'] = 'Password is required.';
    //     if (empty($user_id)) $data['errors']['user_id'] = 'Please select a user.';

    //     if (!empty($data['errors'])) {
    //         $this->load->view('add_website', $data);
    //     } else {
    //         // $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Store hashed password

    //         $insert_data = [
    //             'website_userId' => $userId,
    //             'website_password' => $password,
    //             'website_url' => $url,
    //             'user_id' => $user_id
    //         ];

    //         if ($this->WebsiteModel->insert_website($insert_data)) {
    //             $this->session->set_flashdata('success', 'Website added successfully!');
    //             redirect('User/dashboard');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to add website.');
    //             redirect('User/index');
    //         }
    //     }
    // }

    // // Show dashboard with saved websites
    // public function dashboard() {
    //     $data['websites'] = $this->WebsiteModel->get_all_websites();
    //     $data['method'] = "display_website";
    //     $this->load->view('website_dashboard',$data); 
	// }

	//  // Auto-login using cURL and open in a new tab
	//  public function auto_login() {
    //     $url = $this->input->post('url');
    //     $userId = $this->input->post('userId');
    //     $password = $this->input->post('password');

    //     $cookie_file = tempnam(sys_get_temp_dir(), 'cookie'); // Store cookies

    //     // Initialize cURL session
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    //         'username' => $userId,
    //         'password' => $password
    //     ]));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    //     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    //     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    //     $response = curl_exec($ch);
    //     $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // Get final redirected URL
    //     curl_close($ch);

    //     // Open login page in a new tab using JavaScript
    //     if (!empty($final_url)) {
    //         echo "<script>window.open('$final_url');</script>";
    //     } else {
    //         echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('WebsiteController/dashboard')."';</script>";
    //     }
    // }

	// public function websitedashboard() {
    //     $this->load->view('website_dashboard');
    // }

    // public function store_website() {
    //     $this->load->model('WebsiteModel'); 
    //     $data['websites'] = $this->WebsiteModel->get_all_websites();
    
    //     $this->load->view('store_website', $data); // Only load the table, not the full page
    // }

	public function dashboardview(){
		// $this->load->view('website_dashboard');
        $data['method'] = "dashboard";
        $this->load->view('website_dashboard', $data);
	}
    
}
?>
