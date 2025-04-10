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
        $stats = $this->CustomerRegister_model->get_phone_missing_stats();
        
        $data['table_data'] = [
            'main_header' => 'Phone Missing',
            'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
            'rows' => [
                'Qty' => [$stats['PMUY'], $stats['Non_PMUY'], $stats['Total']],
                '%' => [$stats['PMUY_Percent'] . '%', $stats['Non_PMUY_Percent'] . '%', '100%']
            ]
        ];
        
        $data['phone_missing_data'] = $this->CustomerRegister_model->get_phone_number_data();
        $data['method'] = 'phonenumber';
        $data['page_title'] = 'Phone Number Missing Report';
        $data['report_date'] = date('d-M-Y H:i:s');
        
        // Add debug data
        $data['debug_count'] = count($data['phone_missing_data']);
        
        $this->load->view('website_dashboard', $data);
    }
}