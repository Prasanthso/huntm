<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        // $this->load->model('User_model'); //load model here
        // $this->load->database();
		// $this->load->model('WebsiteModel');
		
    }

	public function show()
	{
		$this->load->view('dashboard');
	}

}
?>
