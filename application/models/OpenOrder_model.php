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
}
