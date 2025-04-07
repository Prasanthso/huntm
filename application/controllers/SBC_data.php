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
        // Dummy data for SBC Data table
        $data['table_data'] = [
            'main_header' => 'SBC Data',
            'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
            'rows' => [
                'Qty' => ['648', '2759', '3407'],
                '%' => ['28.81', '89.13', '56.21']
            ],
            // 'table_title' => 'KYC Data Report'
        ];
        
        $data['sbc_data'] = $this->CustomerRegister_model->get_sbc_data();

        if (empty($data['sbc_data'])) {
            $data['sbc_data'] = [];
        }
        // $this->load->view('SBC_data_view', $data);
        $data['method'] = 'sbc_data_display';
        $this->load->view('website_dashboard', $data);
    }
}