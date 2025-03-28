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

    public function openorder($data) {
        return $this->db->openorder_data('open_orders', $data);
    }
}
