<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admindashboard_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_admin_data($admin_id){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
   
    public function get_admin_name($admin_id){
         $this->db->select('full_name');
        $this->db->from('admin');
        $this->db->where('id', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->full_name;
        }
        return '';
    }
    public function get_admin_data_by_id($admin_id) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    public function update_admin_data($admin_id, $data) {
        $this->db->where('id', $admin_id);
        $this->db->update('admin', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            log_message('error', 'Update failed: ' . $this->db->last_query() . ' | Error: ' . json_encode($this->db->error()));
            return FALSE;
        }
    }

    public function create_distributor($data) {
        $this->db->insert('distributor', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            log_message('error', 'Insert failed: ' . $this->db->last_query() . ' | Error: ' . json_encode($this->db->error()));
            return FALSE;
        }
    }

    public function get_all_staff_users() {
    return $this->db->get('user')->result(); // Uses the separate staff table
}

}