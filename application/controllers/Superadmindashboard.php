<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmindashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Superadmindashboard_model');
        $this->load->model('Admindashboard_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function login() {
        $this->load->view('Superadmin_loginpage');
    }

    public function process_login() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $email = trim($this->input->post('email', true));
        $password = $this->input->post('password', true);

        $user = $this->Superadmindashboard_model->validate_email($email, $password);
        
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
            redirect('super-admin-dashboard');
        } 
        else {
            // Invalid credentials
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('super-admin-login');
        }
    }

    public function dashboard() {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            $this->session->set_flashdata('error', 'You must be logged in to view this page.');
            redirect('login');
        }
        $admin_data = $this->Admindashboard_model->get_admin_data($admin_id);
        
        if (!$admin_data) {
            $this->session->set_flashdata('error', 'Unable to load admin data.');
            redirect('login');
        }
        
        $data['method'] = "superadmindashboard";
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['admin'] = $admin_data;
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function create_admin() {
        $superadmin_id = $this->session->userdata('user_id');
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('distributor_limit', 'Distributor Limit', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['method'] = 'create_admin';
            $this->load->view('Superadmindashboard_view', $data);
        } else {
            $admin_data = array(
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'admin',
                'distributor_limit' => $this->input->post('distributor_limit'),
                'created_by_super_admin' => $superadmin_id // Using new column name
            );

            if ($this->Superadmindashboard_model->create_admin($admin_data)) {
                $this->session->set_flashdata('success', 'Admin created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create admin. Please try again.');
            }
            redirect('super-admin-create-admin');
        }
    }

    public function get_admin_data() {
        // $admin_id = $this->session->userdata('user_id');
        $data['admin_data'] = $this->Superadmindashboard_model->get_admin_data();
        $data['method'] = 'get_admin_data';
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function showing_admin_remaining_data($admin_id) {
        // $admin_id = $this->session->userdata('user_id');
        if(!$this->session->userdata('user_id')){
            redirect('login');
        }
        if (!$admin_id) {
            show_error("Student ID is required", 400);
        }

        $data['admin_data'] = $this->Superadmindashboard_model->get_remaining_admin_data($admin_id);
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'showing_admin_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function delete_admin($admin_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (!$admin_id) {
            show_error("Admin ID is required", 400);
        }

        $deleted = $this->Superadmindashboard_model->delete_admin($admin_id);
        if ($deleted) {
            $this->session->set_flashdata('success', 'Admin deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete admin. Please try again.');
        }
        redirect('get-admin-data');
    }

    public function get_distributor_data() {
        //  $distributor_id = $this->session->userdata('user_id');
        $data['distributor_data'] = $this->Superadmindashboard_model->get_distributor_data();
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'get_distributor_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function showing_distributor_remaining_data($distributor_id) {
        // $distributor_id = $this->session->userdata('user_id');
        if(!$this->session->userdata('user_id')){
            redirect('login');
        }
        if (!$distributor_id) {
            show_error("Student ID is required", 400);
        }
        $data['distributor_data'] = $this->Superadmindashboard_model->get_remaining_distributor_data($distributor_id);
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'showing_distributor_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function delete_distributor($distributor_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (!$distributor_id) {
            show_error("Distributor ID is required", 400);
        }

        $deleted = $this->Superadmindashboard_model->delete_distributor($distributor_id);
        if ($deleted) {
            $this->session->set_flashdata('success', 'Distributor deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete distributor. Please try again.');
        }
        redirect('get-distributors-data');
    }

    public function get_staff_data(){
        $data['staff_data'] = $this->Superadmindashboard_model->get_staff_data();
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'get_staff_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function showing_staff_remaining_data($staff_id) {
        // $distributor_id = $this->session->userdata('user_id');
        if(!$this->session->userdata('user_id')){
            redirect('login');
        }
        if (!$staff_id) {
            show_error("Staff ID is required", 400);
        }
        $data['staff_data'] = $this->Superadmindashboard_model->get_remaining_staff_data($staff_id);
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'showing_staff_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function delete_staff($staff_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (!$staff_id) {
            show_error("Staff ID is required", 400);
        }

        $deleted = $this->Superadmindashboard_model->delete_staff($staff_id);
        if ($deleted) {
            $this->session->set_flashdata('success', 'Staff deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete staff. Please try again.');
        }
        redirect('get-staff-data');
    }

    public function get_distributor_limits()
    {
        $admin_id = $this->session->userdata('user_id');
        $data['get_distributor_limits'] = $this->Superadmindashboard_model->get_distributor_limits($admin_id);
        $data['superadmin_data'] = $this->Superadmindashboard_model->get_superadmin_data();
        $data['method'] = 'get_distributor_limits';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function update_distributor_limits()
    {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            redirect('login');
        }

        $this->form_validation->set_rules('distributor_limit', 'Distributor Limit', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('distributor_id', 'Distributor ID', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('get-distributor-limits');
        } else {
            $distributor_limit = $this->input->post('distributor_limit');
            $distributor_id = $this->input->post('distributor_id');

            $updated = $this->Superadmindashboard_model->update_distributor_limit($distributor_id, $distributor_limit);

            if ($updated) {
                $this->session->set_flashdata('success', 'Distributor limit updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'No changes made or failed to update distributor limit.');
            }
            redirect('get-distributor-limits');
        }
    }
    
    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('super-admin-login');
    }
}