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
    // public function signup_form(){
    //     $this->load->view('User_profile_view');
    // }

    // public function process_signup() {
    //     $this->load->library('form_validation');
    //     $this->load->library('session'); 

    //     $this->form_validation->set_rules('full_name', 'Full Name', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    //     $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    //     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
    //     $this->form_validation->set_rules('role', 'Role', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->signup_form();
    //     } else {
    //         $data = array(
    //             'full_name' => $this->input->post('full_name'),
    //             'email' => $this->input->post('email'),
    //             'password' => $this->input->post('password'), 
    //             'role' => $this->input->post('role')
    //         );

    //         try {
    //         $user_id = $this->User_profile_model->insert_user($data);
    //         if ($user_id) {
    //             $this->session->set_flashdata('success', 'User registered successfully!');
    //             redirect('user_profile_login');
    //         } else {
    //             throw new Exception('Database insertion failed');
    //         }
    //     } catch (Exception $e) {
    //         $this->session->set_flashdata('error', 'Registration failed: ' . $e->getMessage());
    //         redirect('user_profile_signup');
    //     }
    //  }
    // }

    public function login_form() {
        $this->load->view('user_profile_login');
    }

    public function process_login()
{
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,distributor,staff]');

    $email = trim($this->input->post('email', true));
    $password = $this->input->post('password', true);
    $role = $this->input->post('role', true);

    echo "POST Data: Email = $email, Role = $role<br>";

    if ($this->form_validation->run() == FALSE) {
        echo "Form validation failed.<br>";
        echo validation_errors();
        return;
    }

    $this->load->model('User_profile_model');
    $user = $this->User_profile_model->validate_email($email, $password, $role);

    if ($user) {
        echo "✅ Login Success!<br>";
        print_r($user);

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
        echo "❌ Login Failed: Invalid email or password<br>";
    }
}


    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'role', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile/process_login');
    }
}