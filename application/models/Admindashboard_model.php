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
        return $query->row(); // ✅ Returns a single object
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

    public function update_admin_data($admin_id, $data) {
        $this->db->where('id', $admin_id);
        return $this->db->update('admin', $data);
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
    // public function create_distributor($data) {
    //     // First check distributor limit
    //     $admin_id = $this->session->userdata('user_id');
    //     $admin = $this->get_admin_data($admin_id);
    //     $current_count = $this->count_distributors_created_by($admin_id);
        
    //     if ($current_count >= $admin->distributor_limit) {
    //         return false; // Limit reached
    //     }

    //     // Add default staff_limit if not set
    //     if (!isset($data['staff_limit'])) {
    //         $data['staff_limit'] = 5; // Default value
    //     }
    //     $data['created_by'] = $admin_id;
        
    //     return $this->db->insert('distributor', $data);
    // }
    public function create_distributor($data) {
    return $this->db->insert('distributor', $data);
}

    public function count_distributors_created_by($admin_id) {
        $this->db->where('created_by', $admin_id);
        return $this->db->count_all_results('distributor');
    }

    public function get_distributor($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('distributor');
        return $query->row();
    }

    public function get_all_staff_users() {
        return $this->db->get('user')->result();
    }

    public function get_admin($id) {
    return $this->db->get_where('admin', ['id' => $id])->row();
}

public function count_distributors($admin_id) {
    return $this->db->where('created_by_admin', $admin_id)
                   ->count_all_results('distributor');
}

    public function get_distributor_details($admin_id){
        $this->db->select('*');
        $this->db->from('distributor');
        $this->db->where('created_by', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_staff_limits($admin_id){
        $this->db->select('id,full_name, email, role, staff_limit');
        $this->db->from('distributor');
        $this->db->where('created_by_admin', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function update_staff_limit($distributor_id, $staff_limit) {
        $this->db->where('id', $distributor_id);
        return $this->db->update('distributor', ['staff_limit' => $staff_limit]);
    }

    public function delete_distributor($distributor_id) {
        $this->db->where('id', $distributor_id);
        return $this->db->delete('distributor');
    }

    public function get_assigned_pages_to_staff($staff_id) {
        $query = $this->db
            ->select('page_id')
            ->from('user_page_permissions')
            ->where('staff_id', $staff_id)
            ->get();

        return array_column($query->result_array(), 'page_id');
    }

}

