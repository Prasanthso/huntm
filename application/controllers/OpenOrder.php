<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load PhpSpreadsheet library manually (Without Composer)
require_once APPPATH . 'libraries/PhpSpreadsheet/autoload.php';
require_once APPPATH . 'libraries/Psr/SimpleCache/CacheInterface.php';
require_once APPPATH . 'libraries/Composer/Pcre/Preg.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OpenOrder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('OpenOrder_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');  // Ensure session is loaded
    }

    public function openorder_data() {
        $data['message'] = 'Please upload an Excel file (.xlsx, .xls, or .csv)';
        $data['method'] = 'open_order';
        $this->load->view('website_dashboard', $data);
    }

    public function upload_excel() {
        if (!isset($_FILES['excel_file']['name']) || empty($_FILES['excel_file']['name'])) {
            $this->session->set_flashdata('error', 'No file uploaded.');
            redirect('uploadfile_openorder');
        }

        $file_name = $_FILES['excel_file']['tmp_name'];
        $file_ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
        $allowed_ext = array('xls', 'xlsx', 'csv');

        if (!in_array(strtolower($file_ext), $allowed_ext)) {
            $this->session->set_flashdata('error', 'Invalid file format. Only XLS, XLSX, and CSV files are allowed.');
            redirect('uploadfile_openorder');
        }

        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'File upload failed. Error code: ' . $_FILES['excel_file']['error']);
            redirect('uploadfile_openorder');
        }

        try {
            $spreadsheet = IOFactory::load($file_name);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            if (empty($sheetData) || count($sheetData) < 2) {
                $this->session->set_flashdata('error', 'The uploaded file is empty or has no valid data.');
                redirect('uploadfile_openorder');
            }

            $insert_data = array();
            $header = true;

            foreach ($sheetData as $row) {
                if ($header) {
                    $header = false;
                    continue;
                }

                if (count($row) >= 2 && !empty(trim($row[0]))) {
                    $insert_data[] = array(
                        'area_name' => trim($row[0]),
                        'open_refill_order' => trim($row[1])
                    );
                }
            }

            if (!empty($insert_data)) {
                $result = $this->OpenOrder_model->insert_data($insert_data);
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

        redirect('uploadfile_openorder');
    }
}