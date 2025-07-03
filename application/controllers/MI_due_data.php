<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MI_due_data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->library('session');
        // Ensure user is authenticated
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function midue_data() {
        $this->load->model('Permission_model');

        $user_id = $this->session->userdata('user_id');
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
            show_error('403 - Access Denied');
            return;
        }
        $mi_due_data = $this->CustomerRegister_model->get_pending_mi_area_scheme_wise();
        $customer_data = $this->CustomerRegister_model->get_mi_due_status_counts();

        $data = [
            'mi_due' => $mi_due_data ?: [],
            'customer_data' => $customer_data,
            'method' => 'midue',
            'page_title' => 'MI Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];

        $this->load->view('website_dashboard', $data);
    }
}