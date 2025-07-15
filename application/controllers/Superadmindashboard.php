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
        $data['admin'] = $admin_data; // Changed from 'admin_data' to 'admin' to match view
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function create_admin() {
        $superadmin_id = $this->session->userdata('user_id');
        
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
                'created_by_admin' => $superadmin_id // Using new column name
            );

            if ($this->Superadmindashboard_model->create_admin($admin_data)) {
                $this->session->set_flashdata('success', 'Admin created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create admin. Please try again.');
            }
            redirect('Superadmindashboard/create_admin');
        }
    }

    public function get_admin_data() {
        // $admin_id = $this->session->userdata('user_id');
        $data['admin_data'] = $this->Superadmindashboard_model->get_admin_data();
        $data['method'] = 'get_admin_data';
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
        $data['method'] = 'showing_admin_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function get_distributor_data() {
        //  $distributor_id = $this->session->userdata('user_id');
        $data['distributor_data'] = $this->Superadmindashboard_model->get_distributor_data();
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
        $data['method'] = 'showing_distributor_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }

    public function get_staff_data(){
        $data['staff_data'] = $this->Superadmindashboard_model->get_staff_data();
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
        $data['method'] = 'showing_staff_remaining_data';
        $this->load->view('Superadmindashboard_view', $data);
    }
}