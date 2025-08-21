<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebScrapping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Handle invoiced orders: delete old and insert new
    public function invoice_order_data($data) {
        $userid = $this->session->userdata('user_id');

        // Delete existing data for the user
        $this->db->where('userid', $userid);
        $this->db->delete('invoiced_process_order');

        // Insert new data only if it's not empty
        if (!empty($data)) {
            return $this->db->insert_batch('invoiced_process_order', $data);
        } else {
            log_message('error', 'invoice_order_data received empty array');
            return false;
        }
    }

    // Handle open orders: delete old and insert new
    public function open_order_data($data) {
        $userid = $this->session->userdata('user_id');

        // Delete existing data for the user
        $this->db->where('userid', $userid);
        $this->db->delete('open_orders');

        // Insert new data only if it's not empty
        if (!empty($data)) {
            return $this->db->insert_batch('open_orders', $data);
        } else {
            log_message('error', 'open_order_data received empty array');
            return false;
        }
    }

    // Get invoiced order data (used in views)
    public function get_all_invoice_order_data() {
        $userid = $this->session->userdata('user_id');
        return $this->db
            ->select('area_name, cashmemo_generated, status')
            ->from('invoiced_process_order')
            ->where('userid', $userid)
            ->group_by('area_name')
            ->get()
            ->result_array();
    }

    // Get open order data (used in views)
    public function get_all_open_order_data() {
        $userid = $this->session->userdata('user_id');
        return $this->db
            ->select('area_name, open_refill_orders')
            ->from('open_orders')
            ->where('userid', $userid)
            ->get()
            ->result_array();
    }

    // Merge both invoiced + open order data by area
    public function get_merged_order_data($userid = null) {
        if ($userid === null) {
            $userid = $this->session->userdata('user_id');
        }

        $this->db->select('i.area_name, i.cashmemo_generated, i.status, o.open_refill_orders');
        $this->db->from('invoiced_process_order i');
        $this->db->join('open_orders o', 'i.area_name = o.area_name AND i.userid = o.userid', 'left');
        $this->db->where('i.userid', $userid);
        $this->db->group_by('i.area_name');
        return $this->db->get()->result_array();
    }
}
