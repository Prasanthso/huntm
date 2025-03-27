<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Csv_model extends CI_Model {




    public function __construct() {
        parent::__construct();
        // $this->Csv_import_model = new \App\Models\Csv_model(); // Use correct namespace
        $this->load->database();

    }
    

    public function import_csv($file_path) {
        $csvData = array_map('str_getcsv', file($file_path));
        array_shift($csvData); // Remove CSV header

        foreach ($csvData as $row) {
            $data = array(
                'district_name' => $row[0],
                'distributor_code' => $row[1],
                'distributor_name' => $row[2],
                'address' => $row[3],
                'city' => $row[4],
                'phone_number' => $row[5],
                'consumer_id' => $row[6],
                'kyc_number' => $row[7],
                'scheme_subtype' => $row[8],
                'mandatory_inspection_date' => $row[9],
                'email_address' => $row[10],
                'tube_change_date' => $row[11],
                'tube_change_due_date' => $row[12],
                'delivery_type' => $row[13],
                'creation_channel' => $row[14],
                'product' => $row[15],
                'scheme_opted' => $row[16],
                'scheme_selected' => $row[17],
                'consumer_type' => $row[18],
                'consumer_category' => $row[19],
                'consumer_sub_status' => $row[20],
                'name' => $row[21],
                'consumer_number' => $row[22],
                'consumer_status' => $row[23],
                'area_name' => $row[24],
                'subsidy_trans' => $row[25],
                'kyc_date' => $row[26],
                'subsidy_status' => $row[27],
                'scheme_type' => $row[28],
                'latitude' => $row[29],
                'longitude' => $row[30],
                'e_kyc_type' => $row[31],
                'e_kyc_date' => $row[32],
                'e_kyc_flag' => $row[33],
                'order_type' => $row[34],
                'order_date' => $row[35],
                'sv_tsv_order_number' => $row[36],
                'x_rel_type' => $row[37],
                'bsc_due_flg' => $row[38],
                'x_bsc_dt' => $row[39],
                'adhaar_available' => $row[40],
                'adhaar_number' => $row[41],
                'ration_available' => $row[42],
                'ration_number' => $row[43],
                'last_refill_date' => $row[44],
            );

            $this->db->insert('consumers', $data);
        }
        return true;
    }
    public function clear_table() {
        $this->db->empty_table('consumers'); // Replace 'your_table_name' with your actual table
    }
}
