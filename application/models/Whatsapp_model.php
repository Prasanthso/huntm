<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model {

    // Get all users
    public function get_users() {
        return $this->db->get('users')->result_array();
    }

    // Get a single user by ID
    public function get_user_by_id($id) {
        return $this->db->where('id', $id)->get('users')->row_array();
    }
}
