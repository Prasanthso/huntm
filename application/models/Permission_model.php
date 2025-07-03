<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permission_model extends CI_Model {

    public function get_all_pages() {
        return $this->db->get('pages')->result();
    }

    public function update_staff_permissions($staff_id, $page_ids = []) {
        $this->db->where('staff_id', $staff_id);
        $this->db->delete('user_page_permissions');

        foreach ($page_ids as $pid) {
            $this->db->insert('user_page_permissions', [
                'staff_id' => $staff_id,
                'page_id' => $pid
            ]);
        }
    }

    public function get_staff_permissions($staff_id) {
        $this->db->select('page_id');
        $this->db->where('staff_id', $staff_id);
        $result = $this->db->get('user_page_permissions')->result_array();
        return array_column($result, 'page_id');
    }

    public function is_allowed($route, $user_id) {
        if (!$user_id || !$route) return false;

        $this->db->select('p.route');
        $this->db->from('user_page_permissions upp');
        $this->db->join('pages p', 'p.id = upp.page_id');
        $this->db->where('upp.staff_id', $user_id);
        $this->db->where('LOWER(p.route)', strtolower($route)); // Compare route case-insensitively

        return $this->db->get()->num_rows() > 0;
    }
}
