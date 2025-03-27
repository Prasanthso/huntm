<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv_import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url')); // Load helpers
        $this->load->library('session'); // Load session library
        $this->load->model('Csv_model'); // Load model
    }

    public function index() {
        $this->load->view('csv_import_view'); // Load view
    }

    public function import_csv() {
        if (!empty($_FILES['csv_file']['name'])) {
            $filePath = $_FILES['csv_file']['tmp_name'];

            if ($this->Csv_model->import_csv($filePath)) {
                $this->session->set_flashdata('success', 'CSV imported successfully.');
            } else {
                $this->session->set_flashdata('error', 'CSV import failed.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please select a valid CSV file.');
        }

        redirect(base_url('Csv_import'));
    }

    public function clear_data() {
        $this->Csv_model->clear_table(); // Clear data
        $this->session->set_flashdata('success', 'Data cleared successfully.');
        redirect(base_url('Csv_import'));
    }
}
