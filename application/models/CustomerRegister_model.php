<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerRegister_model extends CI_Model {

    private $table = 'customer_register';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        $this->db->trans_start();
        $this->db->insert_batch($this->table, $data);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    //Customer strength data
    public function get_customer_strength_data() {
        $this->db->select("area_name, consumer_id, consumer_name, scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic'); 
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                if ($row['scheme_selected'] == 'Ujjwala') {
                    $row['scheme_selected'] = 'PMUY';
                } else {
                    $row['scheme_selected'] = 'Non PMUY';
                }
            }
            return $result;
        }
        return [];
    }  
    
    //Nill fill data
    public function get_nillrefill_data() {
        $this->db->select("area_name, consumer_id, consumer_name, scheme_selected,last_refill_date");
        $this->db->where('consumer_category', 'domestic'); 
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                if ($row['scheme_selected'] == 'Ujjwala') {
                    $row['scheme_selected'] = 'PMUY';
                } else {
                    $row['scheme_selected'] = 'Non PMUY';
                }
            }
            return $result;
        }
        return [];
    }  
    
}