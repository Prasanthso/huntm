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

    public function get_remaining_distributor_data($user_id) {
        $this->db->select('*');
        $this->db->from('distributor');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
}