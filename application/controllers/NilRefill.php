<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilRefill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

    public function nill_fill_data() {
        // Get all customers data
        $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
        
        // Calculate statistics
        $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);
        
        
        // Prepare data for view
        $data = [
            'stats' => $stats,
            'all_customers' => $all_customers,
            'method' => 'nil_refill_report' 
        ];
        
        
        $this->load->view('website_dashboard', $data);
    }
}