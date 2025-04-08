<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_strength extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function customer_strength_data() {
        // Get customer data from model
        $customers = $this->CustomerRegister_model->get_customer_strength_data();
        $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
        
        // Prepare data for view
        $data = [
            'customer_data' => $customer_data,
            'customers' => $customers ?: [],
            'method' => 'customer_strength'
        ];
        
        $this->load->view('website_dashboard', $data);
    }
}