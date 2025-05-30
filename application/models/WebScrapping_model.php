<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebScrapping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function invoice_order_data($data) {
        $userid = $this->session->userdata('id');

        // Delete existing user data
        $this->db->where('userid', $userid);
        $this->db->delete('invoiced_process_order');

        // Insert new batch
        return $this->db->insert_batch('invoiced_process_order', $data);
    }

    public function open_order_data($data) {
        $userid = $this->session->userdata('id');

        $this->db->where('userid', $userid);
         $this->db->delete('open_orders');

        return $this->db->insert_batch('open_orders', $data);
    }

    public function get_all_invoice_order_data() {
        $userid = $this->session->userdata('id');
        return $this->db
            ->select('area_name, cashmemo_generated, status')
            ->from('invoiced_process_order')
            ->where('userid', $userid)
            ->group_by('area_name')
            ->get()
            ->result_array();
    }

    public function get_all_open_order_data() {
        $userid = $this->session->userdata('id');
        return $this->db
            ->select('area_name, open_refill_orders')
            ->from('open_orders')
            ->where('userid', $userid)
            ->get()
            ->result_array();
    }

    public function get_merged_order_data($userid = null) {
        if ($userid === null) {
            $userid = $this->session->userdata('id');
        }

        $this->db->select('i.area_name, i.cashmemo_generated, i.status, o.open_refill_orders');
        $this->db->from('invoiced_process_order i');
        $this->db->join('open_orders o', 'i.area_name = o.area_name AND i.userid = o.userid', 'left');
        $this->db->where('i.userid', $userid);
        $this->db->group_by('i.area_name');
        return $this->db->get()->result_array();
    }
}
