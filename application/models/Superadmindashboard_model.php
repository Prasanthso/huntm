<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmindashboard_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function create_admin($admin_data) {
        return $this->db->insert('admin', $admin_data);
    }

    public function get_admin_data(){
        $this->db->select('*');
        $this->db->from('admin');
        // $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    public function get_admin($admin_id) {
        $this->db->where('id', $admin_id);
        $query = $this->db->get('admin');
        return $query->row();
    }
    public function count_distributors_created_by($admin_id) {
        $this->db->where('created_by', $admin_id);
        return $this->db->count_all_results('distributor');
    }
    public function get_remaining_admin_data($user_id) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    
    public function get_distributor_data(){
        $this->db->select('*');
        $this->db->from('distributor');
        // $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_remaining_distributor_data($distributor_id) {
        $this->db->select('*');
        $this->db->from('distributor'); // replace with your actual distributor table name
        $this->db->where('id', $distributor_id);
        $query = $this->db->get();

        return $query->result(); // returns array of distributor objects
    }

}