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
        $this->db->select("area_name, consumer_number, consumer_name,phone_number, scheme_selected, consumer_sub_status");
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
        $this->db->select("area_name, consumer_number, consumer_name, phone_number,scheme_selected,last_refill_date");
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

    //KYC data
    public function get_kyc_data() {
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected");
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

    //MI due data
    public function get_mi_due_data() {
        $this->db->select("area_name, consumer_number, consumer_name, phone_number ,scheme_selected,mandatory_inspection_date");
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
    
    //Hose Due Data
    public function get_hose_due_data() {
        $this->db->select("area_name, consumer_id, consumer_name, phone_number, scheme_selected,  tube_change_date,tube_change_due_date");
        $this->db->where('consumer_category', 'domestic'); 
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $today = date('Y-m-d');
            
            foreach ($result as &$row) {
                // Standardize scheme names
                if ($row['scheme_selected'] == 'Ujjwala') {
                    $row['scheme_selected'] = 'PMUY';
                } else {
                    $row['scheme_selected'] = 'Non PMUY';
                }
                
                // Calculate hose due status
                $lastChanged = $row['tube_change_date'] ?? $row['tube_change_due_date'] ?? null;
                $row['tube_change_date'] = $lastChanged;
                
                if (empty($lastChanged)) {
                    // If never changed, consider it due
                    $row['hose_status'] = 'due';
                    $row['days_overdue'] = 'N/A';
                } else {
                    $lastChangedDate = new DateTime($lastChanged);
                    $todayDate = new DateTime($today);
                    $interval = $todayDate->diff($lastChangedDate);
                    $daysSinceChange = $interval->days;
                    
                    // Hose replacement period (2 years = 730 days)
                    $replacementPeriod = 730;
                    
                    if ($daysSinceChange > $replacementPeriod) {
                        $row['hose_status'] = 'due';
                        $row['days_overdue'] = $daysSinceChange - $replacementPeriod;
                    } else {
                        $row['hose_status'] = 'ok';
                        $row['days_remaining'] = $replacementPeriod - $daysSinceChange;
                    }
                }
            }
            return $result;
        }
        return [];
    }

    //SBC Data
    public function get_sbc_data() {
        $this->db->select("area_name, consumer_number, consumer_name, phone_number ,scheme_selected,consumer_type");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where('consumer_type', 'Single Bottle Connection'); 
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
    
    public function get_phone_number_data() {
        $this->db->select("area_name, consumer_number, consumer_name, phone_number , scheme_selected");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where("(phone_number IS NULL OR phone_number = '')", NULL, FALSE); 
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                $row['scheme_selected'] = ($row['scheme_selected'] == 'Ujjwala') ? 'PMUY' : 'Non PMUY';
            }
            return $result;
        }
        return [];
    }
    
}