<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admindashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Admindashboard_model');
        $this->load->model('Distributordashboard_model');
        $this->load->model('Superadmindashboard_model');
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
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
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
         $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
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

    // public function create_distributor() {
    //     $admin_id = $this->session->userdata('user_id');
    //     $admin = $this->Admindashboard_model->get_admin($admin_id);
    //     $current_distributor_count = $this->Admindashboard_model->count_distributors($admin_id);

    //     // Check if admin has reached distributor limit
        

    //     $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[distributor.email]');
    //     $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    //     $this->form_validation->set_rules('staff_limit', 'Staff Limit', 'required|integer|greater_than[0]');

    //     if ($this->form_validation->run() == FALSE) {
    //     $data = [
    //         'method' => 'create_distributor',
    //         'distributor_limit' => $admin->distributor_limit,
    //         'current_distributor_count' => $current_distributor_count,
    //         'show_limit_modal' => ($current_distributor_count >= $admin->distributor_limit)
    //     ];
    //     $this->load->view('Admindashboard_view', $data);
    //     } else {
    //         if ($current_distributor_count >= $admin->distributor_limit) {
    //         $this->session->set_flashdata('error', 'You have reached your distributor limit of '.$admin->distributor_limit.'. Cannot create more distributors.');
    //         redirect('Admindashboard/create_distributor');
    //         return;
    //     }
    //         $distributor_data = array(
    //             'full_name' => $this->input->post('full_name'),
    //             'email' => $this->input->post('email'),
    //             'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
    //             'staff_limit' => $this->input->post('staff_limit'),
    //             'created_by' => $admin_id,
    //             'created_by_admin' => $admin_id 
    //         );

    //         $result = $this->Admindashboard_model->create_distributor($distributor_data);
    //         if ($result) {
    //             $this->session->set_flashdata('success', 'Distributor created successfully!');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to create distributor. Please try again.');
    //         }
    //         redirect('Admindashboard/create_distributor');
    //     }
    // }
    public function create_distributor() {
    $admin_id = $this->session->userdata('user_id');
    $admin = $this->Admindashboard_model->get_admin($admin_id);
    $current_distributor_count = $this->Admindashboard_model->count_distributors($admin_id);
    $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);

    // Check if admin has reached distributor limit
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
            'limit_reached' => $limit_reached, // This will trigger the modal
            'current_limit' => $admin->distributor_limit
        ];
        $this->load->view('Admindashboard_view', $data);
    } else {
        $distributor_data = array(
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'role' => 'distributor',
            'staff_limit' => $this->input->post('staff_limit'),
            'created_by' => $admin_id,
            'created_by_admin' => $admin_id 
        );

        $result = $this->Admindashboard_model->create_distributor($distributor_data);
        if ($result) {
            $this->session->set_flashdata('success', 'Distributor created successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to create distributor. Please try again.');
        }
        redirect('Admindashboard/create_distributor');
    }
}

    public function assign_same_pages_to_all_staff() {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) redirect('login');

        $this->load->model('Permission_model');
        $this->load->model('Admindashboard_model');

        if ($this->input->post()) {
            $selected_pages = $this->input->post('page_ids') ?: [];
            $staff_users = $this->Admindashboard_model->get_all_staff_users();

            foreach ($staff_users as $staff) {
                $this->Permission_model->update_staff_permissions($staff->id, $selected_pages);
            }

            $this->session->set_flashdata('success', 'Pages assigned to all staff successfully.');
            redirect('Admindashboard/assign_same_pages_to_all_staff');
        }

        $data['method'] = 'assign_same_pages_to_all_staff';
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['all_pages'] = $this->Permission_model->get_all_pages();
        $data['selected_pages'] = []; 
        $this->load->view('Admindashboard_view', $data);
    }
    
    public function get_distributor_data() {
        $admin_id = $this->session->userdata('user_id');
        $data['distributor_data'] = $this->Admindashboard_model->get_distributor_details($admin_id);
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'get_distributor_data';
        $this->load->view('Admindashboard_view', $data);
    }

    public function showing_distributor_remaining_data($distributor_id) {
         $admin_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        if (!$distributor_id) {
            show_error("Distributor ID is required", 400);
        }

        $data['distributor_data'] = $this->Superadmindashboard_model->get_remaining_distributor_data($distributor_id);
         $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'showing_distributor_remaining_data';
        $this->load->view('Admindashboard_view', $data);
    }

    public function get_staff_limits() {
        $admin_id = $this->session->userdata('user_id');
        $data['get_staff_limits'] = $this->Admindashboard_model->get_staff_limits($admin_id);
        $data['admin_name'] = $this->Admindashboard_model->get_admin($admin_id);
        $data['method'] = 'get_staff_limits';
        $this->load->view('Admindashboard_view', $data);
    }

    public function update_staff_limits() {
        $admin_id = $this->session->userdata('user_id');
        if (!$admin_id) {
            redirect('login');
        }

        $this->form_validation->set_rules('staff_limit', 'Staff Limit', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Invalid input. Please try again.');
            redirect('Admindashboard/get_staff_limits');
        } else {
            $staff_limit = $this->input->post('staff_limit');
            $distributor_id = $this->input->post('distributor_id');

            if ($this->Admindashboard_model->update_staff_limit($distributor_id, $staff_limit)) {
                $this->session->set_flashdata('success', 'Staff limit updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update staff limit. Please try again.');
            }
            redirect('Admindashboard/get_staff_limits');
        }
    }
    
    public function delete_distributor($distributor_id) 
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        if (!$distributor_id) {
            show_error("Distributor ID is required", 400);
        }

        $admin_id = $this->session->userdata('user_id');
        $result = $this->Admindashboard_model->delete_distributor($distributor_id, $admin_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Distributor deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete distributor. Please try again.');
        }

        redirect('Admindashboard/get_distributor_data');
    }

    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile/process_login');
    }
  
}