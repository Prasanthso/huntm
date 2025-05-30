<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosedue_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    // public function hose_due_data() {
    //     // Get data from models
    //     $stats = $this->CustomerRegister_model->get_hose_due_stats();
        
    //     // Check if $stats is valid, provide fallback if null or empty
    //     if (!is_array($stats) || empty($stats)) {
    //         log_message('error', 'get_hose_due_stats() returned invalid data');
    //         $stats = [
    //             'Total' => 0,
    //             'PMUY' => 0,
    //             'Non_PMUY' => 0,
    //             'PMUY_Due' => 0,
    //             'Non_PMUY_Due' => 0,
    //             'Total_Due' => 0,
    //             'PMUY_Due_Percent' => 0,
    //             'Non_PMUY_Due_Percent' => 0,
    //             'Total_Due_Percent' => 0
    //         ];
    //     }
        
    //     $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();
        
    //     // Filter only due customers for the detailed view
    //     $due_customers = array_filter($hose_due_customers, function($customer) {
    //         return $customer['hose_status'] === 'Due';
    //     });
        
    //     // Simplified stats for the card, including top-level Total
    //     $hose_stats = [
    //         'Total' => $stats['Total'], // Add top-level Total for the view
    //         'total' => [
    //             'qty' => $stats['Total_Due'],
    //             'percent' => $stats['Total_Due_Percent']
    //         ]
    //     ];
    
    //     // Prepare data for view
    //     $data = [
    //         'table_data' => [
    //             'rows' => [
    //                 'Qty' => [
    //                     $stats['PMUY_Due'],
    //                     $stats['Non_PMUY_Due'],
    //                     $stats['Total_Due']
    //                 ],
    //                 '%' => [
    //                     $stats['PMUY_Due_Percent'],
    //                     $stats['Non_PMUY_Due_Percent'],
    //                     $stats['Total_Due_Percent']
    //                 ]
    //             ]
    //         ],
    //         'hose_due' => array_values($due_customers),
    //         'hose_stats' => $hose_stats,
    //         'method' => 'hosedue',
    //         'page_title' => 'Hose Due Report',
    //         'report_date' => date('d-M-Y H:i:s')
    //     ];
    
    //     $this->load->view('website_dashboard', $data);
    // }
    public function hose_due_data() {
    // Get detailed hose due stats
    $customer_data = $this->CustomerRegister_model->get_hose_due_stats('detailed');
    $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();
    
    // Filter only due customers for the detailed view
    $due_customers = array_values(array_filter($hose_due_customers, function($customer) {
        return $customer['hose_status'] === 'Due';
    }));
    
    // Calculate percentages for display
    $total_customers = $customer_data['total']['total'];
    if ($total_customers > 0) {
        foreach (['active', 'suspended', 'deactivated'] as $status) {
            foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                $customer_data[$status][$type.'_percent'] = 
                    round(($customer_data[$status][$type] / $total_customers) * 100, 2);
            }
        }
        
        // Calculate total percentages
        $customer_data['total']['pmuy_percent'] = round(($customer_data['total']['pmuy'] / $total_customers) * 100, 2);
        $customer_data['total']['non_pmuy_percent'] = round(($customer_data['total']['non_pmuy'] / $total_customers) * 100, 2);
        $customer_data['total']['total_percent'] = round(($customer_data['total']['total'] / $total_customers) * 100, 2);
    } else {
        foreach (['active', 'suspended', 'deactivated'] as $status) {
            foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                $customer_data[$status][$type.'_percent'] = 0;
            }
        }
        
        $customer_data['total']['pmuy_percent'] = 0;
        $customer_data['total']['non_pmuy_percent'] = 0;
        $customer_data['total']['total_percent'] = 0;
    }
    
    $data = [
        'customer_data' => $customer_data,
        'hose_due' => $due_customers,
        'method' => 'hosedue',
        'page_title' => 'Hose Due Report',
        'report_date' => date('d-M-Y H:i:s')
    ];

    $this->load->view('website_dashboard', $data);
}
}