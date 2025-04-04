<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MI_due_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function midue_data() {
        // Dummy data for MI Due table
        $data['table_data'] = [
            'main_header' => 'MI Due',
            'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
            'rows' => [
                'Qty' => ['436', '4039', '4475'],
                '%' => ['9.74', '90.26', '43.43']
            ],
            // 'table_title' => 'KYC Data Report'
        ];
        
        $data['mi_due'] = $this->CustomerRegister_model->get_mi_due_data();

        if (empty($data['mi_due'])) {
            $data['mi_due'] = [];
        }
        $this->load->view('MI_due_view', $data);
    }
}