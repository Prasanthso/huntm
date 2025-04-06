<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosedue_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function hose_due_data() {  // Changed from hosedue_data() to index()
        // Get data from model
        $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();
        
        // Prepare data for the view in the expected format
        $data['hose_due'] = $hose_due_customers ?: []; // Customers data
        
        // Calculate summary data (example - adjust with your actual calculations)
        $pmuy_count = 0;
        $non_pmuy_count = 0;
        
        foreach ($hose_due_customers as $customer) {
            if ($customer['scheme_selected'] === 'PMUY') {
                $pmuy_count++;
            } else {
                $non_pmuy_count++;
            }
        }
        
        $total_count = $pmuy_count + $non_pmuy_count;
        
        $data['table_data'] = [
            'rows' => [
                'Qty' => [
                    $pmuy_count,
                    $non_pmuy_count,
                    $total_count
                ],
                '%' => [
                    $total_count > 0 ? round(($pmuy_count/$total_count)*100, 2) : 0,
                    $total_count > 0 ? round(($non_pmuy_count/$total_count)*100, 2) : 0,
                    100
                ]
            ]
        ];
        
        // Load the view with data
        // $this->load->view('hosedue_data_view', $data);
        $data['method'] = 'hosedue';
        $this->load->view('website_dashboard', $data);
    }
}