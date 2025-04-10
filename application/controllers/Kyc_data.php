<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function kyc_data() {
        $kyc_stats = $this->CustomerRegister_model->get_kyc_stats();
        $kyc_data = $this->CustomerRegister_model->get_kyc_data();
        // $customer_data = $this->CustomerRegister_model->get_customer_strength_data(); 
    
        $data = [
            'kyc_stats' => $kyc_stats,
            'kyc_data' => $kyc_data,
            // 'customer_data' => $customer_data, 
            'method' => 'kyc_data',
            'page_title' => 'KYC Status Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
    
        $this->load->view('website_dashboard', $data);
    }
    
}