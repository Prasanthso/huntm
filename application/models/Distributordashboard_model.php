<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distributordashboard_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_distributor_data($distributor_id){
        $this->db->select('*');
        $this->db->from('distributor');
        $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    
    public function get_distributor_data_by_id($distributor_id) {
        $this->db->select('*');
        $this->db->from('distributor');
        $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    public function update_distributor_data($distributor_id, $data) {
        $this->db->where('id', $distributor_id);
        $this->db->update('distributor', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            log_message('error', 'Update failed: ' . $this->db->last_query() . ' | Error: ' . json_encode($this->db->error()));
            return FALSE;
        }
    }

    public function create_staff($data) {
        // First check if email already exists
        $this->db->where('email', $data['email']);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return false; // Email already exists
        }

        return $this->db->insert('user', $data);
    }

    public function count_staff($distributor_id) {
        $this->db->where('created_by', $distributor_id);
        return $this->db->count_all_results('user');
    }

    public function get_staff_data($admin_id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('created_by', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_remaining_staff_data($distributor_id) {
        $this->db->select('*');
        $this->db->from('user'); // replace with your actual distributor table name
        $this->db->where('id', $distributor_id);
        $query = $this->db->get();

        return $query->result(); // returns array of distributor objects
    }
}