<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function termofuse() {
        $this->load->view('terms_of_use');
    }

    public function termsandconditions() {
        $this->load->view('terms_and_conditions');
    }

    public function privacy_policy() {
        $this->load->view('privacy_policy');
    }

}