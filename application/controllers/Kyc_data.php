
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    // public function kyc_data() {
    //     $kyc_stats = $this->CustomerRegister_model->get_kyc_stats();
    //     $kyc_data = $this->CustomerRegister_model->get_kyc_data();
    //     // $customer_data = $this->CustomerRegister_model->get_customer_strength_data(); 
    
    //     $data = [
    //         'kyc_stats' => $kyc_stats,
    //         'kyc_data' => $kyc_data,
    //         // 'customer_data' => $customer_data, 
    //         'method' => 'kyc_data',
    //         'page_title' => 'KYC Status Report',
    //         'report_date' => date('d-M-Y H:i:s')
    //     ];
    
    //     $this->load->view('website_dashboard', $data);
    // }

   public function kyc_data() {
    $this->load->model('Permission_model');

    $user_id = $this->session->userdata('user_id');
    $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

    // Default structure for customer_data to prevent undefined index errors
    $default_customer_data = [
        'total' => ['total' => 0, 'pmuy' => 0, 'non_pmuy' => 0],
        'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
        'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
        'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
    ];

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        // Access denied: return dashboard view with modal trigger
        $data = [
            'access_denied' => true,
            'kyc_data' => [],
            'kyc_stats' => [],
            'customer_data' => $default_customer_data, // Use default structure
            'method' => 'kyc_data',
            'page_title' => 'KYC Status Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    // Allowed: load KYC data
    $kyc_data = $this->CustomerRegister_model->get_kyc_data() ?: [];
    $kyc_stats = $this->CustomerRegister_model->get_kyc_stats() ?: [];
    $customer_data = $this->CustomerRegister_model->get_kyc_status_counts() ?: $default_customer_data;

    $data = [
        'kyc_data' => $kyc_data,
        'kyc_stats' => $kyc_stats,
        'customer_data' => $customer_data,
        'method' => 'kyc_data',
        'page_title' => 'KYC Status Report',
        'report_date' => date('d-M-Y H:i:s'),
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}


    
}
