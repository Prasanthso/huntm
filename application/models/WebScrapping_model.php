<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebScrapping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        return $this->db->insert_batch('invoiced_orders', $data); 
    }

    // public function openorder($data) {
    //     return $this->db->openorder_data('open_orders', $data);
    // }

    public function get_all_data() {
        $userid = $this->session->userdata('id');
        $this->db->select('area_name, cashmemo_generated, status');
        $this->db->from('invoiced_orders');
        $this->db->where('userid', $userid);
        $query = $this->db->get();
        log_message('debug', 'Query Result: ' . print_r($query->result_array(), true)); 
        return $query->result_array();
    }
}
