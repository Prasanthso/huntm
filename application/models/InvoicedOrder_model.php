<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoicedOrder_model extends CI_Model {
    private $table = 'invoiced_process_order';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function clear_orders() {
        $this->db->truncate($this->table);
    }

    public function save_orders($orders) {
        if (!empty($orders)) {
            return $this->db->insert_batch($this->table, $orders);
        }
        return false;
    }

    public function get_all_orders() {
        $this->db->order_by('cashmemo_generated', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}