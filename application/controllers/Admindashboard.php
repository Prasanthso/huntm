<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admindashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Admindashboard_model');
        $this->load->model('Distributordashboard_model');
        // $this->load->;
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function dashboard(){
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            $this->session->set_flashdata('error', 'You must be logged in to view this page.');
            redirect('login');
        }
        $data['method'] = "admindashboard";
        $data['admin_name'] = $this->Admindashboard_model->get_admin_name($admin_id);
        $data['admin_data'] = $this->Admindashboard_model->get_admin_data($admin_id);
        $this->load->view('admindashboard_view', $data);
    }

    public function profile() {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            $this->session->set_flashdata('error', 'You must be logged in to view this page.');
            redirect('login');
        }
        $data['method'] = "profile";
        $data['admin_data'] = $this->Admindashboard_model->get_admin_data_by_id($admin_id);
        $data['validation_errors'] = $this->form_validation->error_array();
        $this->load->view('admindashboard_view', $data);
    }

    public function add() {
        $admin_id = $this->session->userdata('user_id');

        // if (!$admin_id) {
        //     $this->session->set_flashdata('error', 'You must be logged in to update your profile.');
        //     redirect('login');
        // }
        
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|min_length[10]|max_length[15]');
            $this->form_validation->set_rules('sap_code', 'SAP Code', 'trim|alpha_numeric');
            $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|alpha_numeric');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('address', 'Address', 'trim');
            $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|numeric|exact_length[6]');
            $this->form_validation->set_rules('city', 'City', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('office_mobile', 'Office Mobile', 'trim|numeric|min_length[10]|max_length[15]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Please correct the errors in the form.');
                redirect('AdminDashboard/profile');
            } 
            else {
                $data = [
                    'phone' => $this->input->post('phone', TRUE) ?: NULL,
                    'sap_code' => $this->input->post('sap_code', TRUE) ?: NULL,
                    'account_holder_name' => $this->input->post('account_holder_name', TRUE) ?: NULL,
                    'account_number' => $this->input->post('account_number', TRUE) ?: NULL,
                    'ifsc_code' => $this->input->post('ifsc_code', TRUE) ?: NULL,
                    'bank_name' => $this->input->post('bank_name', TRUE) ?: NULL,
                    'address' => $this->input->post('address', TRUE) ?: NULL,
                    'pin_code' => $this->input->post('pin_code', TRUE) ?: NULL,
                    'city' => $this->input->post('city', TRUE) ?: NULL,
                    'office_mobile' => $this->input->post('office_mobile', TRUE) ?: NULL
                ];


                $update = $this->Admindashboard_model->update_admin_data($admin_id, $data);
                if ($update) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                    redirect('AdminDashboard/profile');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile. No matching record found or database error.');
                    redirect('AdminDashboard/profile');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'No data submitted.');
            redirect('AdminDashboard/profile');
        }
    }

    public function create_distributor() {
        $admin_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            $data['method'] = 'create_distributor';
            $this->load->view('Admindashboard_view', $data);
        } else {
            $admin_data = array(
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'distributor',
            );

            $result = $this->Admindashboard_model->create_distributor($admin_data);
            if ($result) {
                $this->session->set_flashdata('success', 'Distributor created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create distributor. Please try again.');
            }
            redirect('Admindashboard/create_distributor');
        }
    }

    public function assign_distributor_pages($distributor_id = null) {
        $admin_id = $this->session->userdata('user_id');
        $staff_id = $this->session->userdata('user_id'); 
        $distributor_id = $this->session->userdata('user_id');

        if (!$admin_id && !$staff_id) {
            $this->session->set_flashdata('error', 'You must be logged in to view this page.');
            redirect('login');
        }

        $this->load->model('Permission_model');

        if ($this->input->post()) {
            $selected_pages = $this->input->post('page_ids') ?: [];

            // Debug log with all possible IDs
            log_message('debug', "Assigning permissions: Admin ID = $admin_id, Staff ID = $staff_id, Distributor ID = $distributor_id");

            // Update permissions with all possible IDs
            $this->Permission_model->update_permissions($admin_id, $staff_id, $distributor_id, $selected_pages);

            $this->session->set_flashdata('success', 'Permissions updated successfully.');
            redirect('Admindashboard/assign_distributor_pages/' . $distributor_id);
        }

        $data['method'] = 'assign_distributor_pages';
        $data['all_pages'] = $this->Permission_model->get_all_pages();
        $data['selected_pages'] = $this->Permission_model->get_permissions($distributor_id);
        $data['distributor_id'] = $distributor_id;

        $this->load->view('Admindashboard_view', $data);
    }



    
}