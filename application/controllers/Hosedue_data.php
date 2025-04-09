<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosedue_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function hose_due_data() {
        // Get data from models
        $stats = $this->CustomerRegister_model->get_hose_due_stats();
        $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();
        
        // Filter only due customers for the detailed view
        $due_customers = array_filter($hose_due_customers, function($customer) {
            return $customer['hose_status'] === 'Due';
        });
        
        // Prepare data for view
        $data = [
            'table_data' => [
                'rows' => [
                    'Qty' => [
                        $stats['PMUY_Due'],
                        $stats['Non_PMUY_Due'],
                        $stats['Total_Due']
                    ],
                    '%' => [
                        $stats['PMUY_Due_Percent'] . '%',
                        $stats['Non_PMUY_Due_Percent'] . '%',
                        $stats['Total_Due_Percent'] . '%'
                    ]
                ]
            ],
            'hose_due' => array_values($due_customers), // Re-index array after filtering
            'method' => 'hosedue',
            'page_title' => 'Hose Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];

        $this->load->view('website_dashboard', $data);
    }
}