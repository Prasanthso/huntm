<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/PhpSpreadsheet/autoload.php';
require_once APPPATH . 'libraries/Psr/SimpleCache/CacheInterface.php';
require_once APPPATH . 'libraries/Composer/Pcre/Preg.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CustomerRegister extends CI_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        
        // Check if user is logged in for all methods except customerregister_data
        // if (!$this->session->userdata('logged_in') && $this->router->fetch_method() != 'customerregister_data') {
        //     redirect('login');
        // }
    }

    public function customerregister_data() {
        $data['message'] = 'Please upload an Excel file (.xlsx, .xls, or .csv)';
        $data['method'] = 'customer_register';
        $this->load->view('website_dashboard', $data);
    }

    public function upload_excel() {
        // Get logged-in user's ID
        $userid = $this->session->userdata('id');
        
        if (!isset($_FILES['excel_file']['name']) || empty($_FILES['excel_file']['name'])) {
            $this->session->set_flashdata('error', 'No file uploaded.');
            redirect('customerregister');
        }

        $file_name = $_FILES['excel_file']['tmp_name'];
        $file_ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
        $allowed_ext = array('xls', 'xlsx', 'csv');

        if (!in_array(strtolower($file_ext), $allowed_ext)) {
            $this->session->set_flashdata('error', 'Invalid file format. Only XLS, XLSX, and CSV files are allowed.');
            redirect('customerregister');
        }

        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'File upload failed. Error code: ' . $_FILES['excel_file']['error']);
            redirect('customerregister');
        }

        try {
            // Delete only records belonging to this user
            $delete_result = $this->CustomerRegister_model->delete_user_data($userid);
            if (!$delete_result) {
                $this->session->set_flashdata('error', 'Failed to clear existing data.');
                redirect('customerregister');
            }

            // Process new file upload
            $spreadsheet = IOFactory::load($file_name);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            if (empty($sheetData) || count($sheetData) < 2) {
                $this->session->set_flashdata('error', 'The uploaded file is empty or has no valid data.');
                redirect('customerregister');
            }

            $insert_data = array();
            $header = true;

            foreach ($sheetData as $row) {
                if ($header) {
                    $header = false;
                    continue;
                }

                if (!empty(trim($row[0]))) {
                    $insert_data[] = array(
                        'userid' => $userid, // Add the user ID to each record
                        'Distributor Code' => isset($row[0]) ? trim($row[0]) : '',
                        'Distributor Name' => isset($row[1]) ? trim($row[1]) : '',
                        'Consumer ID' => isset($row[2]) ? trim($row[2]) : '',
                        'Consumer Number' => isset($row[3]) ? trim($row[3]) : '',
                        'Consumer Name' => isset($row[4]) ? trim($row[4]) : '',
                        'Address' => isset($row[5]) ? trim($row[5]) : '',
                        'City' => isset($row[6]) ? trim($row[6]) : '',
                        'Area Name' => isset($row[7]) ? trim($row[7]) : '',
                        'Latitude' => isset($row[8]) ? trim($row[8]) : '',
                        'Longitude' => isset($row[9]) ? trim($row[9]) : '',
                        'Email Address (Register)' => isset($row[10]) ? trim($row[10]) : '',
                        'Phone Number' => isset($row[11]) ? trim($row[11]) : '',
                        'Consumer Status' => isset($row[12]) ? trim($row[12]) : '',
                        'Consumer Sub Status' => isset($row[13]) ? trim($row[13]) : '',
                        'Consumer Type' => isset($row[14]) ? trim($row[14]) : '',
                        'Consumer Category' => isset($row[15]) ? trim($row[15]) : '',
                        'Subsidy Trans' => isset($row[16]) ? trim($row[16]) : '',
                        'Subsidy Status' => isset($row[17]) ? trim($row[17]) : '',
                        'KYC Number' => isset($row[18]) ? trim($row[18]) : '',
                        'KYC Date' => isset($row[19]) ? trim($row[19]) : '',
                        'SV/TSV (Order Number)' => isset($row[20]) ? trim($row[20]) : '',
                        'Order date' => isset($row[21]) ? trim($row[21]) : '',
                        'Scheme Type' => isset($row[22]) ? trim($row[22]) : '',
                        'Scheme Selected' => isset($row[23]) ? trim($row[23]) : '',
                        'Scheme Subtype' => isset($row[24]) ? trim($row[24]) : '',
                        'Creation Channel' => isset($row[25]) ? trim($row[25]) : '',
                        'Product' => isset($row[26]) ? trim($row[26]) : '',
                        'Order Type' => isset($row[27]) ? trim($row[27]) : '',
                        'Mandatory Inspection Date' => isset($row[28]) ? trim($row[28]) : '',
                        'Tube Change Date' => isset($row[29]) ? trim($row[29]) : '',
                        'Tube Change Due Date' => isset($row[30]) ? trim($row[30]) : '',
                        'Delivery Type' => isset($row[31]) ? trim($row[31]) : '',
                        'Scheme Opted' => isset($row[32]) ? trim($row[32]) : '',
                        'District Name' => isset($row[33]) ? trim($row[33]) : '',
                        'e-KYC Type' => isset($row[34]) ? trim($row[34]) : '',
                        'e-KYC Date' => isset($row[35]) ? trim($row[35]) : '',
                        'e-KYC Flag' => isset($row[36]) ? trim($row[36]) : '',
                        'BSC_DUE_FLG' => isset($row[37]) ? trim($row[37]) : '',
                        'X_BSC_DT' => isset($row[38]) ? trim($row[38]) : '',
                        'Adhaar Available' => isset($row[39]) ? trim($row[39]) : '',
                        'Adhaar Number' => isset($row[40]) ? trim($row[40]) : '',
                        'Ration Available' => isset($row[41]) ? trim($row[41]) : '',
                        'Ration Number' => isset($row[42]) ? trim($row[42]) : '',
                        'Last Refill Date' => isset($row[43]) ? trim($row[43]) : '',
                        // 'last_refill_date' => isset($row[44]) ? trim($row[44]) : '',
                    );
                }
            }

            if (!empty($insert_data)) {
                $result = $this->CustomerRegister_model->insert_data($insert_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data uploaded successfully. Rows inserted: ' . count($insert_data));
                } else {
                    $this->session->set_flashdata('error', 'Failed to insert data into database.');
                }
            } else {
                $this->session->set_flashdata('error', 'No valid data found in the file.');
            }

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
        }

        redirect('customerregister');
    }
}