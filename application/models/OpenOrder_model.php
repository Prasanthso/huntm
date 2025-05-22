<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenOrder_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

      public function insert_data($data) {
        // Clear old data for this user first
        $this->db->where('userid', $this->session->userdata('id'));
        $this->db->truncate('open_orders');
        
        // Insert new data
        return $this->db->insert_batch('open_orders', $data);
    }

    public function get_all_data() {
        $userid = $this->session->userdata('id');
        return $this->db
            ->select('area_name, open_refill_orders')
            ->from('open_orders')
            ->where('userid', $userid)
            // ->order_by('created_at', 'DESC')
            ->get()
            ->result_array();
    }

    public function clear_user_data($user_id) {
        $this->db->where('userid', $user_id);
        $this->db->delete('open_orders'); 
        return $this->db->affected_rows();
    }
}
?>