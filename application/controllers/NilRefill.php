<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilRefill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function nill_fill_data() {
        // Sample data - replace with your actual data
        $data['table_data'] = [
            'greater_than_6_months' => [
                'pmuy' => [
                    'qty' => 30,
                    'percent' => 0.29
                ],
                'non_pmuy' => [
                    'qty' => 359,
                    'percent' => 3.48
                ],
                'total' => [
                    'qty' => 389,
                    'percent' => 3.78
                ]
            ],
            'greater_than_1_year' => [
                'pmuy' => [
                    'qty' => 73,
                    'percent' => 0.7
                ],
                'non_pmuy' => [
                    'qty' => 782,
                    'percent' => 7.59
                ],
                'total' => [
                    'qty' => 855,
                    'percent' => 8.30
                ]
            ]
        ];
        
        $data['nillrefill'] = $this->CustomerRegister_model->get_nillrefill_data();

        if (empty($data['nillrefill'])) {
            $data['nillrefill'] = [];
        }
        $this->load->view('nil_refill_view', $data);
    }
}