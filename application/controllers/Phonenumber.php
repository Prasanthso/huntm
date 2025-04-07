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
        // Dummy data for SBC Data table
        $data['table_data'] = [
            'main_header' => 'SBC Data',
            'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
            'rows' => [
                'Qty' => ['648', '2759', '3407'],
                '%' => ['28.81', '89.13', '56.21']
            ]
        ];
        
        // Get phone number data from model
        $data['phone_missing_data'] = $this->CustomerRegister_model->get_phone_number_data();

        if (empty($data['phone_missing_data'])) {
            $data['phone_missing_data'] = [];
        }
        
        // $this->load->view('phonenumber_view', $data);
        $data['method'] = 'phonenumber';
        $this->load->view('website_dashboard', $data);
    }
}