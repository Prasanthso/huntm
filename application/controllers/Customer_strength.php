<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_strength extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function customer_strength_data() {
        $data['customer_data'] = array(
            'active' => array('pmuy' => 727, 'non_pmuy' => 9336, 'total' => 10063),
            'suspended' => array('pmuy' => 0, 'non_pmuy' => 27, 'total' => 27),
            'deactivated' => array('pmuy' => 0, 'non_pmuy' => 213, 'total' => 213),
            'total' => array('pmuy' => 727, 'non_pmuy' => 9576, 'total' => 10303)
        );

        $data['customers'] = $this->CustomerRegister_model->get_customer_strength_data();

        if (empty($data['customers'])) {
            $data['customers'] = [];
        }

        $this->load->view('customer_strength', $data);
    }
}