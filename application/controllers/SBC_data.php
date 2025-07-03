<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SBC_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function sbc_data_report() {
        $this->load->model('Permission_model');

        $user_id = $this->session->userdata('user_id');
        $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

        if (!$this->Permission_model->is_allowed($route, $user_id)) {
            show_error('403 - Access Denied');
            return;
        }
        
        $sbc_data = $this->CustomerRegister_model->get_sbc_data();
        $customer_data = $this->CustomerRegister_model->get_sbc_status_counts();
        
        $data = [
            'sbc_data' => $sbc_data ?: [],
            'customer_data' => $customer_data,
            'method' => 'sbc_data_display'
        ];

        $this->load->view('website_dashboard', $data);
    }
}