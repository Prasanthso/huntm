<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phonenumber extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

public function phonenumber_data() {
   $this->load->model('Permission_model');

    $user_id = $this->session->userdata('user_id');
    $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        show_error('403 - Access Denied');
        return;
    }
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