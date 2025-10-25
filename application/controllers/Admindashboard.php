<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admindashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Admindashboard_model');
        $this->load->model('Distributordashboard_model');
        $this->load->model('Superadmindashboard_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    // ✅ Reusable session check to prevent repetition
    private function check_session() {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            $this->session->set_flashdata('error', 'Your session has expired. Please log in again.');
            redirect('user_profile_login');
            exit;
        }
        return $admin_id;
    }

    // Dashboard
    public function dashboard(){
        $admin_id = $this->check_session();

        $admin_data = $this->Admindashboard_model->get_admin_data($admin_id);
        if (!$admin_data) {
            $this->session->set_flashdata('error', 'Unable to retrieve admin data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['method'] = "admindashboard";
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['admin_data'] = $admin_data;
        $this->load->view('admindashboard_view', $data);
    }

    // Profile View
    public function profile() {
        $admin_id = $this->check_session();

        $admin_data = $this->Admindashboard_model->get_admin_data_by_id($admin_id);
        if (!$admin_data) {
            $this->session->set_flashdata('error', 'Unable to retrieve profile data. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $data['method'] = "profile";
        $data['admin_data'] = $admin_data;
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['validation_errors'] = $this->form_validation->error_array();
        $this->load->view('admindashboard_view', $data);
    }

    // Profile Update
    public function add() {
        $admin_id = $this->check_session();

        if ($this->input->post()) {
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
                redirect('admin-profile');
            } else {
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
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile. Please try again.');
                }
                redirect('admin-profile');
            }
        } else {
            $this->session->set_flashdata('error', 'No data submitted.');
            redirect('admin-profile');
        }
    }

    // Create Distributor
    public function create_distributor() {
        $admin_id = $this->check_session();

        $admin = $this->Admindashboard_model->get_admin($admin_id);
        if (!$admin) {
            $this->session->set_flashdata('error', 'Unable to retrieve admin details. Please log in again.');
            redirect('user_profile_login');
            return;
        }

        $current_distributor_count = $this->Admindashboard_model->count_distributors($admin_id);
        $limit_reached = ($current_distributor_count >= $admin->distributor_limit);

        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[distributor.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('staff_limit', 'Staff Limit', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() == FALSE || $limit_reached) {
            $data = [
                'method' => 'create_distributor',
                'admin_name' => $this->Admindashboard_model->get_admin($admin_id),
                'distributor_limit' => $admin->distributor_limit,
                'current_distributor_count' => $current_distributor_count,
                'limit_reached' => $limit_reached, 
                'current_limit' => $admin->distributor_limit
            ];
            $this->load->view('admindashboard_view', $data);
        } else {
            $distributor_data = [
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'distributor',
                'staff_limit' => $this->input->post('staff_limit'),
                'created_by' => $admin_id,
                'created_by_admin' => $admin_id 
            ];

            $result = $this->Admindashboard_model->create_distributor($distributor_data);
            if ($result) {
                $this->session->set_flashdata('success', 'Distributor created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create distributor. Please try again.');
            }
            redirect('create-distributor');
        }
    }

    // Assign Same Pages to All Staff
    public function assign_same_pages_to_all_staff() {
        $admin_id = $this->check_session();

        $this->load->model('Permission_model');

        if ($this->input->post()) {
            $selected_pages = $this->input->post('page_ids') ?: [];
            $staff_users = $this->Admindashboard_model->get_all_staff_users();
            foreach ($staff_users as $staff) {
                $this->Permission_model->update_staff_permissions($staff->id, $selected_pages);
            }
            $this->session->set_flashdata('success', 'Pages assigned to all staff successfully.');
            redirect('assign-same-pages-to-all-staff');
        }

        $first_staff = $this->Admindashboard_model->get_first_staff_user();
        $selected_pages = [];
        if ($first_staff) {
            $selected_pages = $this->Permission_model->get_staff_permissions($first_staff->id);
        }

        $data = [
            'method' => 'assign_same_pages_to_all_staff',
            'admin_name' => $this->Admindashboard_model->get_admin($admin_id),
            'all_pages' => $this->Permission_model->get_all_pages(),
            'selected_pages' => $selected_pages
        ];
        $this->load->view('admindashboard_view', $data);
    }

    // Get Distributor Data
    public function get_distributor_data() {
        $admin_id = $this->check_session();

        $data['distributor_data'] = $this->Admindashboard_model->get_distributor_details($admin_id);
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'get_distributor_data';
        $this->load->view('admindashboard_view', $data);
    }

    // Show Remaining Distributor Data
    public function showing_distributor_remaining_data($distributor_id) {
        $admin_id = $this->check_session();

        if (!$distributor_id) {
            show_error("Distributor ID is required", 400);
        }

        $data['distributor_data'] = $this->Superadmindashboard_model->get_remaining_distributor_data($distributor_id);
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'showing_distributor_remaining_data';
        $this->load->view('admindashboard_view', $data);
    }

    // Get and Update Staff Limits
    public function get_staff_limits() {
        $admin_id = $this->check_session();

        $data['get_staff_limits'] = $this->Admindashboard_model->get_staff_limits($admin_id);
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'get_staff_limits';
        $this->load->view('admindashboard_view', $data);
    }

    public function update_staff_limits() {
        $admin_id = $this->check_session();

        $this->form_validation->set_rules('staff_limit', 'Staff Limit', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Invalid input. Please try again.');
            redirect('get-staff-limits');
        } else {
            $staff_limit = $this->input->post('staff_limit');
            $distributor_id = $this->input->post('distributor_id');

            if ($this->Admindashboard_model->update_staff_limit($distributor_id, $staff_limit)) {
                $this->session->set_flashdata('success', 'Staff limit updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update staff limit. Please try again.');
            }
            redirect('get-staff-limits');
        }
    }

    // Delete Distributor
    public function delete_distributor($distributor_id) {
        $admin_id = $this->check_session();

        if (!$distributor_id) {
            show_error("Distributor ID is required", 400);
        }

        $result = $this->Admindashboard_model->delete_distributor($distributor_id, $admin_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Distributor deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete distributor. Please try again.');
        }
        redirect('get-distributor-data');
    }

    // Template Management
    public function get_template_content() {
        $admin_id = $this->check_session();

        $data['templates'] = $this->Admindashboard_model->get_template_content();
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'get_template_content';
        $this->load->view('admindashboard_view', $data);
    }

    public function update_template_content() {
        $admin_id = $this->check_session();

        $this->form_validation->set_rules('template_id', 'Template ID', 'required|trim');
        $this->form_validation->set_rules('template_name', 'Template Name', 'required|trim');
        $this->form_validation->set_rules('template_content', 'Template Content', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'All fields are required.');
            redirect('get-template');
        } else {
            $template_id = $this->input->post('template_id');
            $template_name = $this->input->post('template_name');
            $template_content = $this->input->post('template_content');

            if ($this->Admindashboard_model->update_template_content($template_id, $template_name, $template_content)) {
                $this->session->set_flashdata('success', 'Template updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update template. Please try again.');
            }
            redirect('get-template');
        }
    }

    public function add_template() {
        $admin_id = $this->check_session();

        $this->form_validation->set_rules('template_name', 'Template Name', 'required|trim');
        $this->form_validation->set_rules('template_content', 'Template Content', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'All fields are required.');
        } else {
            $template_name = $this->input->post('template_name');
            $template_content = $this->input->post('template_content');

            if ($this->Admindashboard_model->add_template($template_name, $template_content)) {
                $this->session->set_flashdata('success', 'Template added successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to add template. Please try again.');
            }
        }
        redirect('get-template');
    }

    // Logout
    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile_login');
    }
}
