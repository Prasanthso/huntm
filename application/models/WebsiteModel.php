<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users() {
        try {
            $this->db->select('id, CONCAT(Firstname, " ", Lastname) AS name');
            $query = $this->db->get('user');
            
            if ($this->db->error()['code']) {
                throw new Exception('Database error: ' . $this->db->error()['message']);
            }
            
            return $query->result_array();
            
        } catch (Exception $e) {
            log_message('error', 'Error in get_users: ' . $e->getMessage());
            return [];
        }
    }

    public function insert_website($data) {
        try {
            if (empty($data)) {
                throw new Exception('Empty data provided for insert');
            }
            
            $this->db->insert('website_table', $data);
            
            if ($this->db->error()['code']) {
                throw new Exception('Database error: ' . $this->db->error()['message']);
            }
            
            return $this->db->affected_rows() > 0;
            
        } catch (Exception $e) {
            log_message('error', 'Error in insert_website: ' . $e->getMessage());
            return false;
        }
    }

    public function get_all_websites() {
        try {
            $loggeduserid = $this->session->userdata('id');
            
            if (empty($loggeduserid)) {
                throw new Exception('No logged-in user ID found in session');
            }
            
            $this->db->select('website_id, website_userId, website_password, website_url');
            $this->db->from('website_table');
            $this->db->where('userid', $loggeduserid);
            $query = $this->db->get();
            
            if ($this->db->error()['code']) {
                throw new Exception('Database error: ' . $this->db->error()['message']);
            }
            
            log_message('debug', 'get_all_websites query: ' . $this->db->last_query());
            $result = $query->result_array();
            log_message('debug', 'get_all_websites result count: ' . count($result));
            
            return $result;
            
        } catch (Exception $e) {
            log_message('error', 'Error in get_all_websites: ' . $e->getMessage());
            return [];
        }
    }

    // public function get_website_by_id($website_id) {
    //     try {
    //         if (empty($website_id) || !is_numeric($website_id)) {
    //             throw new Exception('Invalid website ID provided');
    //         }
            
    //         $this->db->select('website_id, website_userId, website_password, website_url, userid');
    //         $this->db->from('website_table');
    //         $this->db->where('website_id', $website_id);
    //         $query = $this->db->get();
            
    //         if ($this->db->error()['code']) {
    //             throw new Exception('Database error: ' . $this->db->error()['message']);
    //         }
            
    //         log_message('debug', 'get_website_by_id query: ' . $this->db->last_query());
    //         $result = $query->row_array();
            
    //         if (empty($result)) {
    //             log_message('debug', 'No website found with ID: ' . $website_id);
    //             return false;
    //         }
            
    //         return $result;
            
    //     } catch (Exception $e) {
    //         log_message('error', 'Error in get_website_by_id: ' . $e->getMessage());
    //         return false;
    //     }
    // }
}
?>