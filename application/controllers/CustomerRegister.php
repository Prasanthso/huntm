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
                        'Distributor_Code' => isset($row[0]) ? trim($row[0]) : '',
                        'Distributor_Name' => isset($row[1]) ? trim($row[1]) : '',
                        'Consumer_ID' => isset($row[2]) ? trim($row[2]) : '',
                        'Consumer_Number' => isset($row[3]) ? trim($row[3]) : '',
                        'Consumer_Name' => isset($row[4]) ? trim($row[4]) : '',
                        'Address' => isset($row[5]) ? trim($row[5]) : '',
                        'City' => isset($row[6]) ? trim($row[6]) : '',
                        'Area_Name' => isset($row[7]) ? trim($row[7]) : '',
                        'Latitude' => isset($row[8]) ? trim($row[8]) : '',
                        'Longitude' => isset($row[9]) ? trim($row[9]) : '',
                        'Email_Address' => isset($row[10]) ? trim($row[10]) : '',
                        'Phone_Number' => isset($row[11]) ? trim($row[11]) : '',
                        'Consumer_Status' => isset($row[12]) ? trim($row[12]) : '',
                        'Consumer_Sub_Status' => isset($row[13]) ? trim($row[13]) : '',
                        'Consumer_Type' => isset($row[14]) ? trim($row[14]) : '',
                        'Consumer_Category' => isset($row[15]) ? trim($row[15]) : '',
                        'Subsidy_Trans' => isset($row[16]) ? trim($row[16]) : '',
                        'Subsidy_Status' => isset($row[17]) ? trim($row[17]) : '',
                        'KYC_Number' => isset($row[18]) ? trim($row[18]) : '',
                        'KYC_Date' => isset($row[19]) ? trim($row[19]) : '',
                        'SV/TSV' => isset($row[20]) ? trim($row[20]) : '',
                        'Order_date' => isset($row[21]) ? trim($row[21]) : '',
                        'Scheme_Type' => isset($row[22]) ? trim($row[22]) : '',
                        'Scheme_Selected' => isset($row[23]) ? trim($row[23]) : '',
                        'Scheme_Subtype' => isset($row[24]) ? trim($row[24]) : '',
                        'Creation_Channel' => isset($row[25]) ? trim($row[25]) : '',
                        'Product' => isset($row[26]) ? trim($row[26]) : '',
                        'Order_Type' => isset($row[27]) ? trim($row[27]) : '',
                        'Mandatory_Inspection_Date' => isset($row[28]) ? trim($row[28]) : '',
                        'Tube_Change_Date' => isset($row[29]) ? trim($row[29]) : '',
                        'Tube_Change_Due_Date' => isset($row[30]) ? trim($row[30]) : '',
                        'Delivery_Type' => isset($row[31]) ? trim($row[31]) : '',
                        'Scheme_Opted' => isset($row[32]) ? trim($row[32]) : '',
                        'District_Name' => isset($row[33]) ? trim($row[33]) : '',
                        'e-KYC_Type' => isset($row[34]) ? trim($row[34]) : '',
                        'e-KYC_Date' => isset($row[35]) ? trim($row[35]) : '',
                        'e-KYC_Flag' => isset($row[36]) ? trim($row[36]) : '',
                        'BSC_DUE_FLG' => isset($row[37]) ? trim($row[37]) : '',
                        'X_BSC_DT' => isset($row[38]) ? trim($row[38]) : '',
                        'Adhaar_Available' => isset($row[39]) ? trim($row[39]) : '',
                        'Adhaar_Number' => isset($row[40]) ? trim($row[40]) : '',
                        'Ration_Available' => isset($row[41]) ? trim($row[41]) : '',
                        'Ration_Number' => isset($row[42]) ? trim($row[42]) : '',
                        'Last_Refill_Date' => isset($row[43]) ? trim($row[43]) : '',
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