<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model {

    public function get_users() {
        return $this->db->get('users')->result_array();
    }

    public function get_users_by_area($area) {
        return $this->db->get_where('users', ['area' => $area])->result_array();
    }

    public function get_area_distribution() {
        $this->db->select('area, COUNT(*) as total');
        $this->db->group_by('area');
        return $this->db->get('users')->result_array();
    }

    public function get_staff_phone_number() {
        $this->db->select('phone');
        $this->db->from('user');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();   // returns ['phone' => '...']
    }

    public function get_template_content() {
        $this->db->select('template_content, template_name');
        $this->db->from('template');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();   // returns ['details' => '...']
    }
 public function get_template_by_name($template_name) {
        return $this->db->where('template_name', $template_name)
                        ->get('template')
                        ->row_array();
    }
    

}
