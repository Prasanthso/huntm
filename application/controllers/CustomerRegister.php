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
    }

    public function customerregister_data() {
        $data['message'] = 'Please upload an Excel file (.xlsx, .xls, or .csv)';
        $data['method'] = 'customer_register';
        $this->load->view('website_dashboard', $data);
    }

    public function upload_excel() {
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
            // First delete all existing data
            $delete_result = $this->CustomerRegister_model->delete_all_data();
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
                        'district_name' => isset($row[0]) ? trim($row[0]) : '',
                        'distributor_code' => isset($row[1]) ? trim($row[1]) : '',
                        'distributor_name' => isset($row[2]) ? trim($row[2]) : '',
                        'address' => isset($row[3]) ? trim($row[3]) : '',
                        'city' => isset($row[4]) ? trim($row[4]) : '',
                        'phone_number' => isset($row[5]) ? trim($row[5]) : '',
                        'consumer_id' => isset($row[6]) ? trim($row[6]) : '',
                        'kyc_number' => isset($row[7]) ? trim($row[7]) : '',
                        'scheme_subtype' => isset($row[8]) ? trim($row[8]) : '',
                        'mandatory_inspection_date' => isset($row[9]) ? trim($row[9]) : '',
                        'email_address' => isset($row[10]) ? trim($row[10]) : '',
                        'tube_change_date' => isset($row[11]) ? trim($row[11]) : '',
                        'tube_change_due_date' => isset($row[12]) ? trim($row[12]) : '',
                        'delivery_type' => isset($row[13]) ? trim($row[13]) : '',
                        'creation_channel' => isset($row[14]) ? trim($row[14]) : '',
                        'product' => isset($row[15]) ? trim($row[15]) : '',
                        'scheme_opted' => isset($row[16]) ? trim($row[16]) : '',
                        'scheme_selected' => isset($row[17]) ? trim($row[17]) : '',
                        'consumer_type' => isset($row[18]) ? trim($row[18]) : '',
                        'consumer_category' => isset($row[19]) ? trim($row[19]) : '',
                        'consumer_sub_status' => isset($row[20]) ? trim($row[20]) : '',
                        'consumer_name' => isset($row[21]) ? trim($row[21]) : '',
                        'consumer_number' => isset($row[22]) ? trim($row[22]) : '',
                        'consumer_status' => isset($row[23]) ? trim($row[23]) : '',
                        'area_name' => isset($row[24]) ? trim($row[24]) : '',
                        'subsidy_trans' => isset($row[25]) ? trim($row[25]) : '',
                        'kyc_date' => isset($row[26]) ? trim($row[26]) : '',
                        'subsidy_status' => isset($row[27]) ? trim($row[27]) : '',
                        'scheme_type' => isset($row[28]) ? trim($row[28]) : '',
                        'latitude' => isset($row[29]) ? trim($row[29]) : '',
                        'longitude' => isset($row[30]) ? trim($row[30]) : '',
                        'e_kyc_type' => isset($row[31]) ? trim($row[31]) : '',
                        'e_kyc_date' => isset($row[32]) ? trim($row[32]) : '',
                        'e_kyc_flag' => isset($row[33]) ? trim($row[33]) : '',
                        'order_type' => isset($row[34]) ? trim($row[34]) : '',
                        'order_date' => isset($row[35]) ? trim($row[35]) : '',
                        'sv_tsv_order_number' => isset($row[36]) ? trim($row[36]) : '',
                        'x_rel_type' => isset($row[37]) ? trim($row[37]) : '',
                        'bsc_due_flg' => isset($row[38]) ? trim($row[38]) : '',
                        'x_bsc_dt' => isset($row[39]) ? trim($row[39]) : '',
                        'adhaar_available' => isset($row[40]) ? trim($row[40]) : '',
                        'adhaar_number' => isset($row[41]) ? trim($row[41]) : '',
                        'ration_available' => isset($row[42]) ? trim($row[42]) : '',
                        'ration_number' => isset($row[43]) ? trim($row[43]) : '',
                        'last_refill_date' => isset($row[44]) ? trim($row[44]) : '',
                    );
                }
            }

            if (!empty($insert_data)) {
                $result = $this->CustomerRegister_model->insert_data($insert_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data refreshed successfully. Rows inserted: ' . count($insert_data));
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