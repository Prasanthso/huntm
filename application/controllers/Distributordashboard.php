<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Distributordashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Distributordashboard_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function dashboard(){
        $distributor_id = $this->session->userdata('user_id');
        $data['method'] = "distributordashboard";
        $data['distributor_data'] = $this->Distributordashboard_model->get_distributor_data($distributor_id);
        $this->load->view('distributordashboard_view', $data);
    }

    public function profile() {
        $distributor_id = $this->session->userdata('user_id');
        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'You must be logged in to view this page.');
            redirect('login');
        }
        $data['method'] = "profile";
        $data['distributor_data'] = $this->Distributordashboard_model->get_distributor_data_by_id($distributor_id);
        $data['validation_errors'] = $this->form_validation->error_array();
        $this->load->view('distributordashboard_view', $data);
    }

    public function add() {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'You must be logged in to update your profile.');
            redirect('login');
        }
        
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
                redirect('Distributordashboard/profile');
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

                // Debug POST data (remove after testing)
                // echo '<pre>'; print_r($data); echo '</pre>'; exit;

                $update = $this->Distributordashboard_model->update_distributor_data($distributor_id, $data);
                if ($update) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                    redirect('Distributordashboard/profile');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile. No matching record found or database error.');
                    redirect('Distributordashboard/profile');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'No data submitted.');
            redirect('Distributordashboard/profile');
        }
    }

    public function create_staff() {
        $admin_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            $data['method'] = 'create_staff';
            $this->load->view('Distributordashboard_view', $data);
        } else {
            $admin_data = array(
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'staff',
            );

            $result = $this->Distributordashboard_model->create_staff($admin_data);
            if ($result) {
                $this->session->set_flashdata('success', 'Staff created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create staff. Please try again.');
            }
            redirect('Distributordashboard/create_staff');
        }
    }
}