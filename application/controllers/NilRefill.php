<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilRefill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url', 'date'));
    }

    public function nill_fill_data() {
        // Get all raw customer data
        $raw_data = $this->CustomerRegister_model->get_nillrefill_data();
        
        // Calculate statistics
        $stats = $this->CustomerRegister_model->get_nillrefill_stats($raw_data);
        
        // Prepare data for view
        $data = [
            'all_customers' => $raw_data,
            'stats' => $stats,
            'page_title' => 'Nil Refill Report',
            'report_date' => date('d-M-Y H:i:s'),
            'method' => 'nillrefil'
        ];
        
        $this->load->view('website_dashboard', $data);
    }
}