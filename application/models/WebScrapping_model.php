<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebScrapping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        // Clear old data for this user first
        $this->db->where('userid', $this->session->userdata('id'));
        $this->db->truncate('invoiced_process_order');
        $this->db->group_by('area_name'); 
        
        // Insert new data
        return $this->db->insert_batch('invoiced_process_order', $data);
    }

    public function get_all_data() {
        $userid = $this->session->userdata('id');
        return $this->db
            ->select('area_name, cashmemo_generated, status')
            ->from('invoiced_process_order')
            ->where('userid', $userid)
            ->group_by('area_name')
            // ->order_by('created_at', 'DESC')
            ->get()
            ->result_array();
    }

    public function clear_user_data($user_id) {
        $this->db->where('userid', $user_id);
        $this->db->delete('invoiced_process_order'); 
        return $this->db->affected_rows();
    }
}
?>