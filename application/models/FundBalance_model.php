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
}