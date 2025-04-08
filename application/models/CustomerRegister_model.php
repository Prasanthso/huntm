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
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where_in('consumer_sub_status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
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
    
    public function get_customer_status_counts() {
        $this->db->select("scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where_in('consumer_sub_status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $counts = [
                'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ];
            
            foreach ($result as $row) {
                $scheme = ($row['scheme_selected'] == 'Ujjwala') ? 'pmuy' : 'non_pmuy';
                $status = strtolower($row['consumer_sub_status']);
                
                if (isset($counts[$status])) {
                    $counts[$status][$scheme]++;
                    $counts[$status]['total']++;
                }
                
                $counts['total'][$scheme]++;
                $counts['total']['total']++;
            }
            
            return $counts;
        }
        
        return [
            'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
        ];
    } 
    
    //Nill fill data
    protected $table = 'customer_register'; // Replace with your actual table name

    public function get_nillrefill_data() {
        $this->db->select([
            'area_name', 
            'consumer_number', 
            'consumer_name', 
            'phone_number',
            'scheme_selected',
            'last_refill_date',
            'consumer_category'
        ]);
        
        $this->db->where('consumer_category', 'domestic');
        $this->db->order_by('last_refill_date', 'ASC');
        
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            
            foreach ($result as &$row) {
                // Standardize scheme names
                $row['scheme_selected'] = ($row['scheme_selected'] == 'Ujjwala') ? 'PMUY' : 'Non PMUY';
                
                // Calculate time since last refill
                if (!empty($row['last_refill_date'])) {
                    $last_refill = new DateTime($row['last_refill_date']);
                    $current_date = new DateTime();
                    $interval = $current_date->diff($last_refill);
                    $row['days_since_refill'] = $interval->days;
                    $row['months_since_refill'] = $interval->y * 12 + $interval->m;
                } else {
                    $row['days_since_refill'] = null;
                    $row['months_since_refill'] = null;
                }
                
                // Ensure area_name is not null
                $row['area_name'] = $row['area_name'] ?: 'Unknown';
            }
            
            return $result;
        }
        
        return [];
    }

    public function get_nillrefill_stats($customers) {
        $counts = [
            'greater_than_3_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'greater_than_6_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'greater_than_1_year' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'total_consumers' => count($customers)
        ];
        
        foreach ($customers as $row) {
            if (!empty($row['days_since_refill'])) {
                $is_pmuy = ($row['scheme_selected'] === 'PMUY');
                $days = $row['days_since_refill'];
                
                if ($days > 365) { // > 1 year
                    $counts['greater_than_1_year'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_1_year']['total']++;
                } elseif ($days > 180) { // > 6 months
                    $counts['greater_than_6_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_6_months']['total']++;
                } elseif ($days > 90) { // > 3 months
                    $counts['greater_than_3_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_3_months']['total']++;
                }
            }
        }
        
        // Calculate percentages
        $stats = [];
        foreach ($counts as $period => $data) {
            if ($period === 'total_consumers') continue;
            
            $stats[$period] = [
                'pmuy' => [
                    'qty' => $data['pmuy'],
                    'percent' => $counts['total_consumers'] > 0 ? round(($data['pmuy'] / $counts['total_consumers']) * 100, 2) : 0
                ],
                'non_pmuy' => [
                    'qty' => $data['non_pmuy'],
                    'percent' => $counts['total_consumers'] > 0 ? round(($data['non_pmuy'] / $counts['total_consumers']) * 100, 2) : 0
                ],
                'total' => [
                    'qty' => $data['total'],
                    'percent' => $counts['total_consumers'] > 0 ? round(($data['total'] / $counts['total_consumers']) * 100, 2) : 0
                ]
            ];
        }
        
        return $stats;
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
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected,  tube_change_date,tube_change_due_date");
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
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, consumer_type");
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
    
    public function get_sbc_status_counts() {
        $this->db->select("scheme_selected");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('consumer_type', 'Single Bottle Connection');
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $counts = [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0
            ];
            
            foreach ($result as $row) {
                $scheme = ($row['scheme_selected'] == 'Ujjwala') ? 'pmuy' : 'non_pmuy';
                $counts[$scheme]++;
                $counts['total']++;
            }
            
            return $counts;
        }
        
        return [
            'pmuy' => 0,
            'non_pmuy' => 0,
            'total' => 0
        ];
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