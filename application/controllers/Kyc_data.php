<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function kyc_data() {
        $data['kyc_data'] = [
            ["PMUY" => 0, "Non_PMUY" => 1211, "Total" => 1211, "PMUY_Pending" => 0, "Non_PMUY_Pending" => 11.75, "Total_Pending" => 11.75],
            // ["PMUY" => 120, "Non_PMUY" => 180, "Total" => 300, "PMUY_Pending" => 40, "Non_PMUY_Pending" => 90, "Total_Pending" => 130],
        ];

        $data['kycdata'] = $this->CustomerRegister_model->get_kyc_data();

        if (empty($data['kycdata'])) {
            $data['kycdata'] = [];
        }
        $this->load->view('kyc_data_view', $data);
    }
}
?>