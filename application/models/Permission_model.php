<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permission_model extends CI_Model {

    public function is_allowed($route, $admin_id = null, $distributor_id = null) {
        $this->db->select('p.route');
        $this->db->from('user_page_permissions upp');
        $this->db->join('pages p', 'p.id = upp.page_id');

        if ($admin_id) {
            $this->db->where('upp.admin_id', $admin_id);
        }
        if ($distributor_id) {
            $this->db->where('upp.distributor_id', $distributor_id);
        }

        $this->db->where('p.route', $route);
        return $this->db->get()->num_rows() > 0;
    }

    public function get_all_pages() {
        return $this->db->get('pages')->result();
    }

    public function get_permissions($distributor_id) {
        $this->db->select('page_id');
        $this->db->from('user_page_permissions');
        $this->db->where('distributor_id', $distributor_id);
        return array_column($this->db->get()->result_array(), 'page_id');
    }

    public function update_permissions($admin_id = null, $staff_id = null, $distributor_id = null, $page_ids = []) {
        // Delete existing permissions for this distributor/admin/staff
        if ($admin_id !== null) {
            $this->db->where('admin_id', $admin_id);
        }
        if ($staff_id !== null) {
            $this->db->where('staff_id', $staff_id);
        }
        if ($distributor_id !== null) {
            $this->db->where('distributor_id', $distributor_id);
        }
        // $this->db->delete('user_page_permissions');

        // Insert new permissions
        foreach ($page_ids as $pid) {
            $data = ['page_id' => $pid];
            if ($admin_id !== null) {
                $data['admin_id'] = $admin_id;
            }
            if ($staff_id !== null) {
                $data['staff_id'] = $staff_id;
            }
            if ($distributor_id !== null) {
                $data['distributor_id'] = $distributor_id;
            }
            $this->db->insert('user_page_permissions', $data);
        }
    }
}
