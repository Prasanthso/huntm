<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MI_due_data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->library('session');
        // Ensure user is authenticated
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function midue_data() {
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
            'mi_due' => [],
            'customer_data' => $default_customer_data, // Use the default structure
            'method' => 'midue',
            'page_title' => 'MI Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    $mi_due_data = $this->CustomerRegister_model->get_pending_mi_area_scheme_wise();
    $customer_data = $this->CustomerRegister_model->get_mi_due_status_counts();

    // Ensure the customer_data has all required keys
    $customer_data = array_merge($default_customer_data, (array)$customer_data);

    $data = [
        'mi_due' => $mi_due_data ?: [],
        'customer_data' => $customer_data,
        'method' => 'midue',
        'page_title' => 'MI Due Report',
        'report_date' => date('d-M-Y H:i:s')
    ];

    $this->load->view('website_dashboard', $data);
}
}