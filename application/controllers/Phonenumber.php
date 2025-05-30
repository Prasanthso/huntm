<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phonenumber extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    // public function phonenumber_data() {
    //     $stats = $this->CustomerRegister_model->get_phone_missing_stats();
    //     $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();
        
    //     // Simplified stats for the card
    //     $phone_stats = [
    //         'total' => [
    //             'qty' => $stats['Total'],
    //             'percent' => $total_customers > 0 ? round(($stats['Total'] / $total_customers) * 100, 2) : 0
    //         ]
    //     ];
    
    //     $data['table_data'] = [
    //         'main_header' => 'Phone Missing',
    //         'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
    //         'rows' => [
    //             'Qty' => [$stats['PMUY'], $stats['Non_PMUY'], $stats['Total']],
    //             '%' => [$stats['PMUY_Percent'] , $stats['Non_PMUY_Percent'] , $stats['Total_Percent']]
    //         ]
    //     ];
        
    //     $data['phone_missing_data'] = $this->CustomerRegister_model->get_phone_number_data();
    //     $data['phone_stats'] = $phone_stats; // Add this for the card
    //     $data['method'] = 'phonenumber';
    //     $data['page_title'] = 'Phone Number Missing Report';
    //     $data['report_date'] = date('d-M-Y H:i:s');
        
    //     // Add debug data
    //     $data['debug_count'] = count($data['phone_missing_data']);
        
    //     $this->load->view('website_dashboard', $data);
    // }
//    public function phonenumber_data() {
//     $userid = $this->session->userdata('id');
//     if (empty($userid)) {
//         redirect('login');
//     }

//     $stats = $this->CustomerRegister_model->get_phone_missing_stats();
//     $phone_missing_data = $this->CustomerRegister_model->get_phone_number_data();
    
//     // Ensure stats is in the expected format
//     $customer_data = $stats ?: [
//         'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0, 'pmuy_percent' => 0, 'non_pmuy_percent' => 0, 'total_percent' => 0],
//         'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0, 'pmuy_percent' => 0, 'non_pmuy_percent' => 0, 'total_percent' => 0],
//         'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0, 'pmuy_percent' => 0, 'non_pmuy_percent' => 0, 'total_percent' => 0],
//         'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0, 'pmuy_percent' => 0, 'non_pmuy_percent' => 0, 'total_percent' => 0]
//     ];

//     // Prepare data for the view
//     $data = [
//         'customer_data' => $customer_data,
//         'phone_missing_data' => $phone_missing_data ?? [],
//         'method' => 'phonenumber',
//         'page_title' => 'Phone Number Missing Report',
//         'report_date' => date('d-M-Y H:i:s'),
//         'debug_count' => count($phone_missing_data ?? [])
//     ];

//     // Load the view
//     $this->load->view('website_dashboard', $data);
// }
//    public function phonenumber_data() {
//     $stats = $this->CustomerRegister_model->get_phone_missing_stats();
//     $phone_missing_data = $this->CustomerRegister_model->get_phone_number_data();
    
//     // Prepare data for view
//     $data = [
//         'customer_data' => $stats,
//         'phone_missing_data' => $phone_missing_data,
//         'method' => 'phonenumber',
//         'page_title' => 'Phone Number Missing Report',
//         'report_date' => date('d-M-Y H:i:s'),
//         'total_customers' => count($phone_missing_data)
//     ];
    
//     // Debug data if needed
//     if (ENVIRONMENT !== 'production') {
//         $data['debug'] = [
//             'stats' => $stats,
//             'sample_records' => array_slice($phone_missing_data, 0, 5)
//         ];
//     }
    
//     $this->load->view('website_dashboard', $data);
// }
public function phonenumber_data() {
    // Get data from model
    $stats = $this->CustomerRegister_model->get_phone_missing_stats();
    $phone_missing_data = $this->CustomerRegister_model->get_phone_number_data();
    $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();
    
    // Prepare data for view
    $data = [
        'customer_data' => $stats,
        'phone_missing_data' => $phone_missing_data,
        'phone_stats' => [
            'total' => [
                'qty' => $stats['total']['total'],
                'percent' => $stats['total']['total_percent'],
                'detailed' => $stats
            ],
            'active' => [
                'qty' => $stats['active']['total'],
                'percent' => $stats['active']['total_percent']
            ],
            'suspended' => [
                'qty' => $stats['suspended']['total'],
                'percent' => $stats['suspended']['total_percent']
            ],
            'deactivated' => [
                'qty' => $stats['deactivated']['total'],
                'percent' => $stats['deactivated']['total_percent']
            ]
        ],
        'method' => 'phonenumber',
        'page_title' => 'Phone Number Missing Report',
        'report_date' => date('d-M-Y H:i:s'),
        'debug_count' => count($phone_missing_data)
    ];
    
    $this->load->view('website_dashboard', $data);
}
}