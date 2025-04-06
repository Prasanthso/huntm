<?php 
class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->model('User_model'); //load model here
        $this->load->database();
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
                $this->session->set_userdata('id', $user->id);
                $this->session->set_flashdata('login_success', true); // ✅ Set flashdata for success message
                redirect('dashboard'); // Redirect to Suggestion Form
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
        // $this->load->view('suggestion_form');
    }

	public function submit_suggestion() {
        $application = $this->input->post('application', true);
        $suggestion_type = $this->input->post('suggestion_type', true);
        $message = $this->input->post('message', true);
        $voice_message = $this->input->post('voice_message', true);
    
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
            'voice_message' => $audio_filename // Store unique filename in DB
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
    
	public function dashboardview(){
		// $this->load->view('website_dashboard');
        $data['method'] = "dashboard";
        $this->load->view('website_dashboard', $data);
	}
    
}
?>