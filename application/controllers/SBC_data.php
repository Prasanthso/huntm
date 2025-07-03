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

    // Initialize default customer_data structure
    $default_customer_data = [
        'active' => [
            'pmuy' => 0,
            'non_pmuy' => 0,
            'total' => 0
        ],
        'suspended' => [
            'pmuy' => 0,
            'non_pmuy' => 0,
            'total' => 0
        ],
        'deactivated' => [
            'pmuy' => 0,
            'non_pmuy' => 0,
            'total' => 0
        ],
        'total' => [
            'pmuy' => 0,
            'non_pmuy' => 0,
            'total' => 0
        ]
    ];

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        $data = [
            'access_denied' => true,
            'method' => 'sbc_data_display',
            'sbc_data' => [],
            'customer_data' => $default_customer_data // Use default structure
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }
    
    $sbc_data = $this->CustomerRegister_model->get_sbc_data();
    $customer_data = $this->CustomerRegister_model->get_sbc_status_counts();

    // Ensure the customer_data has all required keys
    $customer_data = array_merge($default_customer_data, (array)$customer_data);

    $data = [
        'sbc_data' => $sbc_data ?: [],
        'customer_data' => $customer_data,
        'method' => 'sbc_data_display',
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}

}