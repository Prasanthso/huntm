<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Distributordashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Distributordashboard_model');
        $this->load->helper('url');
        $this->load->library(['session', 'form_validation']);
    }

    // ---------------- Dashboard ----------------
    public function dashboard() {
        $distributor_id = $this->session->userdata('user_id');

        // ✅ Session check
        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        // ✅ Get distributor and validate
        $distributor = $this->Distributordashboard_model->get_distributor_data($distributor_id);
        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['method'] = "distributordashboard";
        $data['distributor_data'] = $distributor;
        $this->load->view('distributordashboard_view', $data);
    }

    // ---------------- Profile View ----------------
    public function profile() {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $distributor = $this->Distributordashboard_model->get_distributor_data_by_id($distributor_id);
        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['method'] = "profile";
        $data['distributor_data'] = $distributor;
        $data['validation_errors'] = $this->form_validation->error_array();
        $this->load->view('distributordashboard_view', $data);
    }

    // ---------------- Profile Update ----------------
    public function add() {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $distributor = $this->Distributordashboard_model->get_distributor_data_by_id($distributor_id);
        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        if ($this->input->post()) {
            // Clean inputs
            $_POST['phone']         = preg_replace('/\D/', '', $_POST['phone']);
            $_POST['office_mobile'] = preg_replace('/\D/', '', $_POST['office_mobile']);
            $_POST['office_mobile2'] = preg_replace('/\D/', '', $_POST['office_mobile2']);

            // Validation rules
            $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|exact_length[10]');
            $this->form_validation->set_rules('sap_code', 'SAP Code', 'trim|alpha_numeric');
            $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|alpha_numeric');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('address', 'Address', 'trim');
            $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|numeric|exact_length[6]');
            $this->form_validation->set_rules('city', 'City', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('office_mobile', 'Office Mobile', 'trim|numeric|exact_length[10]');
            $this->form_validation->set_rules('office_mobile2', 'Office Mobile 2', 'trim|numeric|exact_length[10]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Please correct the errors in the form.');
                redirect('Distributordashboard/profile');
                return;
            }

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
                'office_mobile' => $this->input->post('office_mobile', TRUE) ?: NULL,
                'office_mobile2' => $this->input->post('office_mobile2', TRUE) ?: NULL
            ];

            $update = $this->Distributordashboard_model->update_distributor_data($distributor_id, $data);

            if ($update) {
                $this->session->set_flashdata('success', 'Profile updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update profile. Please try again.');
            }

            redirect('Distributordashboard/profile');
        } else {
            $this->session->set_flashdata('error', 'No data submitted.');
            redirect('Distributordashboard/profile');
        }
    }

    // ---------------- Staff Creation ----------------
    public function create_staff() {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $distributor = $this->Distributordashboard_model->get_distributor_data_by_id($distributor_id);
        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['distributor_data'] = $distributor;
        $current_count = $this->Distributordashboard_model->count_staff($distributor_id);

        // Validation
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            $data['method'] = 'create_staff';
            $data['staff_limit'] = $distributor->staff_limit;
            $data['current_staff_count'] = $current_count;
            $this->load->view('distributordashboard_view', $data);
        } else {
            if ($current_count >= $distributor->staff_limit) {
                $this->session->set_flashdata('error', 'You have reached your staff limit of '.$distributor->staff_limit);
                redirect('Distributordashboard/create_staff');
                return;
            }

            $staff_data = [
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'created_by' => $distributor_id,
                'role' => 'staff'
            ];

            $result = $this->Distributordashboard_model->create_staff($staff_data);

            if ($result) {
                $this->session->set_flashdata('success', 'Staff created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create staff. Please try again.');
            }

            redirect('Distributordashboard/create_staff');
        }   
    }

    // ---------------- Staff List ----------------
    public function get_staff_data() {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $distributor = $this->Distributordashboard_model->get_distributor_data($distributor_id);
        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['staff_data'] = $this->Distributordashboard_model->get_staff_data($distributor_id);
        $data['distributor_data'] = $distributor;
        $data['method'] = 'get_staff_data';
        $this->load->view('distributordashboard_view', $data);
    }

    // ---------------- Remaining Staff Details ----------------
    public function showing_staff_remaining_data($staff_id) {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        if (!$staff_id) {
            show_error("Staff ID is required", 400);
        }

        $distributor_id = $this->session->userdata('user_id');
        $distributor = $this->Distributordashboard_model->get_distributor_data($distributor_id);

        if (!$distributor) {
            $this->session->set_flashdata('error', 'Unable to retrieve distributor data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['staff_data'] = $this->Distributordashboard_model->get_remaining_staff_data($staff_id);
        $data['distributor_data'] = $distributor;
        $data['method'] = 'showing_staff_remaining_data';
        $this->load->view('distributordashboard_view', $data);
    }

    // ---------------- Staff Delete ----------------
    public function delete_staff($staff_id) {
        $distributor_id = $this->session->userdata('user_id');

        if (!$distributor_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        if (!$staff_id) {
            show_error("Staff ID is required", 400);
        }

        $result = $this->Distributordashboard_model->delete_staff($staff_id, $distributor_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Staff deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete staff. Please try again.');
        }

        redirect('Distributordashboard/get_staff_data');
    }

    // ---------------- Logout ----------------
    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile_login');
    }
}
