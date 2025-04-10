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

    public function delete_user_data($userid) {
        $this->db->where('userid', $userid);
        return $this->db->delete('customer_register');
    }
    

    //Customer strength data
    public function get_customer_strength_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid); 
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
        $userid = $this->session->userdata('id');
        $this->db->select("scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid); 
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
    
    
    // protected $table = 'customer_register'; // Replace with actual table name

    public function get_nillrefill_data() {
        // $userid = $this->session->userdata('id');
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
        // $this->db->where('userid', $userid);
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
        // $userid = $this->session->userdata('id');
        // $this->db->where('userid', $userid);
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
    
                // Count for > 1 year
                if ($days > 365) {
                    $counts['greater_than_1_year'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_1_year']['total']++;
                }
                // Count for > 6 months (includes > 1 year)
                if ($days > 180) {
                    $counts['greater_than_6_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_6_months']['total']++;
                }
                // Count for > 3 months (includes > 6 months and > 1 year)
                if ($days > 90) {
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
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, kyc_number");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where('userid', $userid);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                // Standardize scheme names
                $row['scheme_selected'] = ($row['scheme_selected'] == 'Ujjwala') ? 'PMUY' : 'Non PMUY';
                
                // Determine KYC status
                $row['kyc_status'] = empty($row['kyc_number']) ? 'Pending' : 'Completed';
            }
            return $result;
        }
        return [];
    }

    public function get_kyc_stats() {
        $kyc_data = $this->get_kyc_data();
        
        // Initialize statistics array
        $stats = [
            'PMUY' => 0,
            'Non_PMUY' => 0,
            'Total' => count($kyc_data),
            'PMUY_Pending' => 0,
            'Non_PMUY_Pending' => 0,
            'Total_Pending' => 0
        ];

        foreach ($kyc_data as $row) {
            if ($row['scheme_selected'] === 'PMUY') {
                $stats['PMUY']++;
                if ($row['kyc_status'] === 'Pending') {
                    $stats['PMUY_Pending']++;
                }
            } else {
                $stats['Non_PMUY']++;
                if ($row['kyc_status'] === 'Pending') {
                    $stats['Non_PMUY_Pending']++;
                }
            }
            
            if ($row['kyc_status'] === 'Pending') {
                $stats['Total_Pending']++;
            }
        }

        // Calculate percentages
        $stats['PMUY_Pending_Percent'] = $stats['PMUY'] > 0 ? round(($stats['PMUY_Pending'] / $stats['PMUY']) * 100, 2) : 0;
        $stats['Non_PMUY_Pending_Percent'] = $stats['Non_PMUY'] > 0 ? round(($stats['Non_PMUY_Pending'] / $stats['Non_PMUY']) * 100, 2) : 0;
        $stats['Total_Pending_Percent'] = $stats['Total'] > 0 ? round(($stats['Total_Pending'] / $stats['Total']) * 100, 2) : 0;

        return $stats;
    }

    public function get_area_breakdown($scheme = 'Total') {
        $kyc_data = $this->get_kyc_data();
        $area_counts = [];

        foreach ($kyc_data as $row) {
            // Skip if KYC is completed
            if ($row['kyc_status'] === 'Completed') continue;
            
            // Check scheme filter
            if ($scheme !== 'Total' && $row['scheme_selected'] !== $scheme) continue;
            
            $area = $row['area_name'] ?: 'Unknown';
            
            if (!isset($area_counts[$area])) {
                $area_counts[$area] = 0;
            }
            $area_counts[$area]++;
        }

        // Convert to array of objects and sort by count descending
        $result = [];
        foreach ($area_counts as $area => $count) {
            $result[] = ['area' => $area, 'count' => $count];
        }

        usort($result, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        return $result;
    }

    public function get_customers_by_area($area, $scheme = 'Total') {
        $kyc_data = $this->get_kyc_data();
        $filtered = [];

        foreach ($kyc_data as $row) {
            // Skip if KYC is completed
            if ($row['kyc_status'] === 'Completed') continue;
            
            // Check area match
            $row_area = $row['area_name'] ?: 'Unknown';
            if ($row_area !== $area) continue;
            
            // Check scheme filter
            if ($scheme !== 'Total' && $row['scheme_selected'] !== $scheme) continue;
            
            $filtered[] = $row;
        }

        // Sort by consumer number
        usort($filtered, function($a, $b) {
            return strcmp($a['consumer_number'], $b['consumer_number']);
        });

        return $filtered;
    }

    //MI due data
    public function get_pending_mi_area_scheme_wise() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, 
                          CASE 
                              WHEN scheme_selected = 'Ujjwala' THEN 'PMUY'
                              ELSE 'Non PMUY'
                          END AS scheme_type,
                          consumer_number, consumer_name, phone_number");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        // Convert MM/DD/YYYY format to date for comparison
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%m/%d/%Y') >=", $fiveYearsAgo);
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%m/%d/%Y') <", $today);
        
        $query = $this->db->get($this->table);
        
        $result = $query->result_array();
        
        log_message('debug', 'Pending MI Raw Data Count: ' . count($result));
        if (count($result) > 0) {
            log_message('debug', 'First Pending MI Record: ' . json_encode($result[0]));
        }
        
        return $result;
    }
    
    public function get_mi_due_summary() {
        $userid = $this->session->userdata('id');
        $this->db->select("
            CASE 
                WHEN scheme_selected = 'Ujjwala' THEN 'PMUY'
                ELSE 'Non PMUY'
            END AS scheme_type,
            COUNT(*) as count");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        // Convert MM/DD/YYYY format to date for comparison
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%m/%d/%Y') >=", $fiveYearsAgo);
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%m/%d/%Y') <", $today);
        
        $this->db->group_by('scheme_type');
        $query = $this->db->get($this->table);
        
        $result = $query->result_array();
        
        log_message('debug', 'MI Due Summary Data: ' . json_encode($result));
        
        return $result;
    }

    public function get_total_domestic_customers() {
        $userid = $this->session->userdata('id');
        $this->db->select('COUNT(*) as total');
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $query = $this->db->get($this->table);
        
        $result = $query->row_array();
        return $result['total'] ?? 0;
    }

    //Hose Due Data
    public function get_hose_due_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, tube_change_date, tube_change_due_date");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where('userid', $userid);
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $today = date('Y-m-d');
            $twoYearsAgo = date('Y-m-d', strtotime('-2 years'));
            
            foreach ($result as &$row) {
                // Standardize scheme names
                $row['scheme_selected'] = ($row['scheme_selected'] == 'Ujjwala') ? 'PMUY' : 'Non PMUY';
                
                // Determine which date to use (prefer tube_change_date if available)
                $lastChanged = $row['tube_change_date'] ?? $row['tube_change_due_date'] ?? null;
                $row['last_change_date'] = $lastChanged;
                
                if (empty($lastChanged)) {
                    // If never changed, consider it due
                    $row['hose_status'] = 'Due';
                    $row['days_overdue'] = 'N/A';
                } else {
                    $lastChangedDate = new DateTime($lastChanged);
                    $todayDate = new DateTime($today);
                    $interval = $todayDate->diff($lastChangedDate);
                    $daysSinceChange = $interval->days;
                    
                    // Hose replacement period (2 years = 730 days)
                    if ($daysSinceChange > 730) {
                        $row['hose_status'] = 'Due';
                        $row['days_overdue'] = $daysSinceChange - 730;
                    } else {
                        $row['hose_status'] = 'OK';
                        $row['days_remaining'] = 730 - $daysSinceChange;
                    }
                }
            }
            return $result;
        }
        return [];
    }
    
    public function get_hose_due_stats() {
        $hose_data = $this->get_hose_due_data();
        
        $stats = [
            'PMUY' => 0,
            'Non_PMUY' => 0,
            'Total' => 0,
            'PMUY_Due' => 0,
            'Non_PMUY_Due' => 0,
            'Total_Due' => 0
        ];
    
        foreach ($hose_data as $row) {
            if ($row['scheme_selected'] === 'PMUY') {
                $stats['PMUY']++;
                if ($row['hose_status'] === 'Due') {
                    $stats['PMUY_Due']++;
                }
            } else {
                $stats['Non_PMUY']++;
                if ($row['hose_status'] === 'Due') {
                    $stats['Non_PMUY_Due']++;
                }
            }
            
            if ($row['hose_status'] === 'Due') {
                $stats['Total_Due']++;
            }
        }
        
        $stats['Total'] = $stats['PMUY'] + $stats['Non_PMUY'];
        
        // Calculate percentages
        $stats['PMUY_Due_Percent'] = $stats['PMUY'] > 0 ? round(($stats['PMUY_Due'] / $stats['PMUY']) * 100, 2) : 0;
        $stats['Non_PMUY_Due_Percent'] = $stats['Non_PMUY'] > 0 ? round(($stats['Non_PMUY_Due'] / $stats['Non_PMUY']) * 100, 2) : 0;
        $stats['Total_Due_Percent'] = $stats['Total'] > 0 ? round(($stats['Total_Due'] / $stats['Total']) * 100, 2) : 0;
    
        return $stats;
    }

    //SBC Data
    public function get_sbc_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, consumer_type");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where('userid', $userid);
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
        $userid = $this->session->userdata('id');
        $this->db->select("scheme_selected");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
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
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
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
    
    public function get_phone_missing_stats() {
        $phone_missing_data = $this->get_phone_number_data();
        
        $stats = [
            'PMUY' => 0,
            'Non_PMUY' => 0,
            'Total' => count($phone_missing_data)
        ];
        
        foreach ($phone_missing_data as $row) {
            if ($row['scheme_selected'] === 'PMUY') {
                $stats['PMUY']++;
            } else {
                $stats['Non_PMUY']++;
            }
        }
        
        $stats['PMUY_Percent'] = $stats['Total'] > 0 ? round(($stats['PMUY'] / $stats['Total']) * 100, 2) : 0;
        $stats['Non_PMUY_Percent'] = $stats['Total'] > 0 ? round(($stats['Non_PMUY'] / $stats['Total']) * 100, 2) : 0;
        
        return $stats;
    }
    
}