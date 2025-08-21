<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilRefill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

   public function nill_fill_data() {
    if (!$this->session->userdata('user_id')) {
        redirect('login');
    }

    $this->load->model('Permission_model');

    $user_id = $this->session->userdata('user_id');
    $route = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());

    if (!$this->Permission_model->is_allowed($route, $user_id)) {
        // Show modal by setting access_denied flag
        $data = [
            'access_denied' => true,
            'method' => 'nil_refill_report',
            'page_title' => 'Nil Refill Report',
            'report_date' => date('d-M-Y H:i:s')
        ];
        $this->load->view('website_dashboard', $data);
        return;
    }

    $all_customers = $this->CustomerRegister_model->get_nillrefill_data();
    $stats = $this->CustomerRegister_model->get_nillrefill_stats($all_customers);

    $data = [
        'stats' => $stats['data'],
        'total_consumers' => $stats['total_consumers'] ?? 0,
        'all_customers' => $all_customers,
        'method' => 'nil_refill_report',
        'page_title' => 'Nil Refill Report',
        'report_date' => date('d-M-Y H:i:s'),
        'access_denied' => false
    ];

    $this->load->view('website_dashboard', $data);
}

}