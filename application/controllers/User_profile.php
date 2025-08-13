<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class User_profile extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_profile_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('User_profile_login');
    }

    public function login_form() {
        $this->load->view('user_profile_login');
    }

    public function process_login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $email = trim($this->input->post('email', true));
        $password = $this->input->post('password', true);


        $this->load->model('User_profile_model');
        $user = $this->User_profile_model->validate_email($email, $password);

        if ($user) {
            
            $session_data = [
                'user_id' => $user->id,
                'email' => $user->email,
                'full_name' => isset($user->full_name) ? $user->full_name : 'User',
                'role' => $user->role,
                'logged_in' => TRUE
            ];

            $this->session->set_userdata($session_data);
            error_log("Session: " . print_r($session_data, true));

            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    redirect('admindashboard/dashboard');
                    break;
                case 'distributor':
                    redirect('distributordashboard/dashboard');
                    break;
                case 'staff':
                    redirect('dashboard');  // make sure this route exists
                    break;
                default:
                    echo "Unknown role: " . $user->role;
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('user_profile/login_form'); // or your login route
        }

    }


    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile/process_login');
    }
}