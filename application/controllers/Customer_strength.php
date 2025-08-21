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
            'total' => 0,
            'percent' => 0
        ]
    ];

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        $data = [
            'customer_data' => $default_customer_data, // Use the default structure
            'customers' => [],
            'method' => 'customer_strength',
            'access_denied' => true
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    // Load customer data
    $customers = $this->CustomerRegister_model->get_customer_strength_data();
    $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
    $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

    // Ensure the customer_data has all required keys
    $customer_data = array_merge($default_customer_data, (array)$customer_data);
    
    // Calculate percentage safely
    $customer_data['total']['percent'] = 0;
    if ($total_customers > 0 && isset($customer_data['total']['total'])) {
        $customer_data['total']['percent'] = round(($customer_data['total']['total'] / $total_customers) * 100, 2);
    }

    $data = [
        'customer_data' => $customer_data,
        'customers' => $customers ?: [],
        'method' => 'customer_strength',
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}

}