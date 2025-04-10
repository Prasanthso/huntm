<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
        $this->db->select('id, CONCAT(Firstname, " ", Lastname) AS name'); 
        $query = $this->db->get('user');
        return $query->result_array();
    }
    

    // Insert new website data
    public function insert_website($data) {
        return $this->db->insert('website_table', $data);
    }

    // public function insert_website($data) {
    //     $this->db->insert('website', $data);
        
    //     // Check for errors
    //     if ($this->db->error()) {
    //         log_message('error', 'Database error: ' . print_r($this->db->error(), true));
    //         return false;
    //     }
        
    //     return $this->db->affected_rows() > 0;
    // }

    // Fetch all websites with user information
    // public function get_websites() {
    //     $this->db->select('website_table.*, users.name as user_name');
    //     $this->db->from('website_table');
    //     $this->db->join('users', 'website_table.user_id = users.id', 'left');
    //     return $this->db->get()->result_array();
    // }

    public function get_all_websites() {
		$loggeduserid = $this->session->userdata('id');
        $this->db->select('website_Id, website_userId, website_password, website_url');
        $this->db->from('website_table');
		$this->db->where('userid', $loggeduserid);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
