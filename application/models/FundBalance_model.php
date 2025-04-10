<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FundBalance_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        // First, clear the existing data
        $this->db->empty_table('fund_balance');
        
        // Then insert the new data
        return $this->db->insert_batch('fund_balance', $data);
    }

    public function get_all_data() {
		$loggeduserid = $this->session->userdata('id');
        $this->db->select('cca, balance, risk_category_code, risk_category_description');
        $this->db->from('fund_balance');
		$this->db->where('userid', $loggeduserid);
        $query = $this->db->get();
        log_message('debug', 'Query Result: ' . print_r($query->result_array(), true)); 
        return $query->result_array();
    }
}
