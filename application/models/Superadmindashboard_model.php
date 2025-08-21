<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmindashboard_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function validate_email($email,$password){
        $this->db->where('email', $email);
        $query = $this->db->get('super_admin');

        if ($query->num_rows() == 1) {
            $user = $query->row();

            if (password_verify($password, $user->password)) {
                return $user; 
            }
        }
        return false; 
    }
    public function get_superadmin_data(){
        $this->db->select('full_name');
        $this->db->from('super_admin');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return $query->row();;
        }
        return array();
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
    
    public function delete_admin($admin_id) {
        $this->db->where('id', $admin_id);
        return $this->db->delete('admin');
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
    public function delete_distributor($distributor_id) {
        $this->db->where('id', $distributor_id);
        return $this->db->delete('distributor');
    }
    public function get_staff_data() {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_remaining_staff_data($staff_id) {
        $this->db->select('*');
        $this->db->from('user'); 
        $this->db->where('id', $staff_id);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function delete_staff($staff_id) {
        $this->db->where('id', $staff_id);
        return $this->db->delete('user');
    }
    
    public function get_distributor_limits($admin_id)
    {
        $this->db->select('id, full_name, email, role, distributor_limit');
        $this->db->from('admin');
        $this->db->where('created_by_super_admin', $admin_id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    public function update_distributor_limit($distributor_id, $distributor_limit)
    {
        $this->db->where('id', $distributor_id);
        $this->db->update('admin', ['distributor_limit' => $distributor_limit]);

        return $this->db->affected_rows() >= 0;
    }
}