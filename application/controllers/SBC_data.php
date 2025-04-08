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
        // Get SBC data from model
        $sbc_data = $this->CustomerRegister_model->get_sbc_data();
        $counts = $this->CustomerRegister_model->get_sbc_status_counts();
        
        // Calculate percentages
        $pmuy_percent = $counts['total'] ? round(($counts['pmuy'] / $counts['total']) * 100, 2) : 0;
        $non_pmuy_percent = $counts['total'] ? round(($counts['non_pmuy'] / $counts['total']) * 100, 2) : 0;
        
        // Prepare data for view
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
                        '100'
                    ]
                ]
            ],
            'sbc_data' => $sbc_data ?: [],
            'method' => 'sbc_data_display'
        ];
        
        $this->load->view('website_dashboard', $data);
    }
}