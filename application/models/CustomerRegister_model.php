<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerRegister_model extends CI_Model {

    private $table = 'customer_register';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        // Batch insert for better performance
        $this->db->trans_start();
        $this->db->insert_batch($this->table, $data);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    // public function get_all_data() {
    //     $query = $this->db->get($this->table);
    //     return $query->result_array();
    // }
}