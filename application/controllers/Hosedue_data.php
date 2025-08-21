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
    $this->load->model('Permission_model');

    $user_id = $this->session->userdata('user_id');
    $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        // Access Denied: Load dashboard with modal trigger
        $data = [
            'access_denied' => true,
            'customer_data' => [],
            'hose_due' => [],
            'method' => 'hosedue',
            'page_title' => 'Hose Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    // Allowed: proceed with data
    $customer_data = $this->CustomerRegister_model->get_hose_due_stats('detailed');
    $hose_due_customers = $this->CustomerRegister_model->get_hose_due_data();

    $due_customers = array_values(array_filter($hose_due_customers, function($customer) {
        return $customer['hose_status'] === 'Due';
    }));

    $total_customers = $customer_data['total']['total'];

    if ($total_customers > 0) {
        foreach (['active', 'suspended', 'deactivated'] as $status) {
            foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                $customer_data[$status][$type . '_percent'] =
                    round(($customer_data[$status][$type] / $total_customers) * 100, 2);
            }
        }

        $customer_data['total']['pmuy_percent'] = round(($customer_data['total']['pmuy'] / $total_customers) * 100, 2);
        $customer_data['total']['non_pmuy_percent'] = round(($customer_data['total']['non_pmuy'] / $total_customers) * 100, 2);
        $customer_data['total']['total_percent'] = round(($customer_data['total']['total'] / $total_customers) * 100, 2);
    } else {
        foreach (['active', 'suspended', 'deactivated'] as $status) {
            foreach (['pmuy', 'non_pmuy', 'total'] as $type) {
                $customer_data[$status][$type . '_percent'] = 0;
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
        'report_date' => date('d-M-Y H:i:s'),
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}

}