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
       
        $sbc_data = $this->CustomerRegister_model->get_sbc_data();
        $counts = $this->CustomerRegister_model->get_sbc_status_counts();
        $customer_counts = $this->CustomerRegister_model->get_customer_status_counts();
    
        
        $pmuy_percent = $counts['total'] ? round(($counts['pmuy'] / $counts['total']) * 100, 2) : 0;
        $non_pmuy_percent = $counts['total'] ? round(($counts['non_pmuy'] / $counts['total']) * 100, 2) : 0;
    
       
        $total_customer_count = $customer_counts['total']['total'] ?? 0;
        $total_percent = ($total_customer_count > 0) ? round(($counts['total'] / $total_customer_count) * 100, 2) : 0;
    
        
        $data = [
            'table_data' => [
                'main_header' => 'SBC Data',
                'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
                'rows' => [
                    'Qty' => [
                        $counts['pmuy'],
                        $counts['non_pmuy'],
                        $counts['total']
                    ],
                    '%' => [
                        $pmuy_percent,
                        $non_pmuy_percent,
                        $total_percent
                    ]
                ]
            ],
            'sbc_data' => $sbc_data ?: [],
            'method' => 'sbc_data_display'
        ];
    
        $this->load->view('website_dashboard', $data);
    }
    
}