<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load PhpSpreadsheet library manually (Without Composer)
require_once APPPATH . 'libraries/PhpSpreadsheet/autoload.php';
require_once APPPATH . 'libraries/Psr/SimpleCache/CacheInterface.php';
require_once APPPATH . 'libraries/Composer/Pcre/Preg.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class WebScrapping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WebScrapping_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function webscrapping_data() {
        $data['message'] = 'Please upload an Excel file (.xlsx, .xls, or .csv) with columns: Area Name, CashMemo Generated, Status.';
        $data['method'] = 'invoice_order';
        $this->load->view('website_dashboard', $data);
    }

    public function upload_excel() {
        if (!isset($_FILES['excel_file']['name']) || empty($_FILES['excel_file']['name'])) {
            $this->session->set_flashdata('error', 'No file uploaded.');
            redirect('WebScrapping');
        }

        $file_name = $_FILES['excel_file']['tmp_name'];

        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'File upload failed. Error code: ' . $_FILES['excel_file']['error']);
            redirect('WebScrapping');
        }

        try {
            $spreadsheet = IOFactory::load($file_name);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            // Debug: Log the raw sheet data
            error_log('Sheet Data: ' . print_r($sheetData, true));

            $insert_data = array();
            $header = true;

            foreach ($sheetData as $row) {
                if ($header) {
                    $header = false;
                    continue;
                }

                // Debug: Log each row
                error_log('Processing Row: ' . print_r($row, true));

                if (count($row) >= 3 && !empty($row[0])) {
                    $insert_data[] = array(
                        'area_name' => $row[0],
                        'cashmemo_generated' => $row[1],
                        'status' => $row[2]
                    );
                }
            }

            // Debug: Log the final insert data
            error_log('Insert Data: ' . print_r($insert_data, true));

            if (!empty($insert_data)) {
                $result = $this->WebScrapping_model->insert_data($insert_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data imported successfully. Rows inserted: ' . count($insert_data));
                } else {
                    $this->session->set_flashdata('error', 'Failed to insert data into database.');
                }
            } else {
                $this->session->set_flashdata('error', 'No valid data found in the file.');
            }

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
        }

        redirect('WebScrapping');
    }

    //Display data from invoice order data in website
    public function display_invoice_data(){
        $data['method'] = 'display_invoice_data';
        $data['orders'] = $this->WebScrapping_model->get_all_data(); 
        $this->load->view('website_dashboard', $data);
    }
}
