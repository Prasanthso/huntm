<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenOrder_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database is loaded
    }

    public function insert_data($data) {
        return $this->db->insert_batch('open_orders', $data); // Bulk insert
    }

    public function get_all_data() {
        $this->db->select('area_name, open_refill_orders');
        $this->db->from('open_orders');
        $query = $this->db->get();
        log_message('debug', 'Query Result: ' . print_r($query->result_array(), true)); 
        return $query->result_array();
    }
}
