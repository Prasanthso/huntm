<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerRegister_model extends CI_Model {

    private $table = 'customer_register';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
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
    
    //Total Customer details
    public function get_total_domestic_customers() {
        $userid = $this->session->userdata('id');
        $this->db->select('COUNT(*) as total');
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $query = $this->db->get($this->table);
        
        $result = $query->row_array();
        return $result['total'] ?? 0;
    }

    //Customer strength data
    public function get_customer_strength_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, consumer_sub_status");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid); 
        $this->db->where_in('consumer_sub_status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('consumer_id'); 
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
        
        // First get distinct consumer_ids to avoid counting duplicates
        $this->db->select('consumer_id, scheme_selected, consumer_sub_status');
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('consumer_sub_status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('consumer_id'); // Group by consumer_id to remove duplicates
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
    
    public function get_nillrefill_data() {
        $userid = $this->session->userdata('id');
        $this->db->select([
            'consumer_id',
            'area_name', 
            'consumer_number', 
            'consumer_name', 
            'phone_number',
            'scheme_selected',
            'last_refill_date',
            'consumer_category'
        ]);
        
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where('last_refill_date IS NOT NULL');
        $this->db->order_by('last_refill_date', 'ASC');
        $this->db->group_by('consumer_id');
        
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
    
                // Count for > 3 months
                if ($days > 90) {
                    $counts['greater_than_3_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_3_months']['total']++;
                }
                // Count for > 6 months
                if ($days > 180) {
                    $counts['greater_than_6_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_6_months']['total']++;
                }
                // Count for > 1 year
                if ($days > 365) {
                    $counts['greater_than_1_year'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['greater_than_1_year']['total']++;
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
        $this->db->group_by('consumer_id'); 
        $this->db->where('kyc_number', '');
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
        $userid = $this->session->userdata('id');
        
        // Get total domestic customers count
        $total_domestic = $this->get_total_domestic_customers();
        
        // Get PMUY and Non-PMUY pending counts
        $this->db->select("CASE WHEN scheme_selected = 'Ujjwala' THEN 'PMUY' ELSE 'Non_PMUY' END AS category, COUNT(DISTINCT consumer_id) AS count");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('kyc_number', '');
        $this->db->where('userid', $userid);
        $this->db->group_by('category');
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        
        // Initialize stats array
        $stats = [
            'PMUY' => 0,
            'Non_PMUY' => 0,
            'Total' => $total_domestic,
            'PMUY_Pending' => 0,
            'Non_PMUY_Pending' => 0,
            'Total_Pending' => 0
        ];
        
        // Process query results
        foreach ($result as $row) {
            if ($row['category'] === 'PMUY') {
                $stats['PMUY_Pending'] = $row['count'];
                $stats['PMUY'] = $this->get_scheme_count('Ujjwala'); // Get total PMUY count
            } else {
                $stats['Non_PMUY_Pending'] = $row['count'];
                $stats['Non_PMUY'] = $total_domestic - $stats['PMUY']; // Non-PMUY is total minus PMUY
            }
            $stats['Total_Pending'] += $row['count'];
        }
        
        // Calculate percentages
        $stats['PMUY_Pending_Percent'] = $stats['PMUY'] > 0 ? round(($stats['PMUY_Pending'] / $stats['PMUY']) * 100, 2) : 0;
        $stats['Non_PMUY_Pending_Percent'] = $stats['Non_PMUY'] > 0 ? round(($stats['Non_PMUY_Pending'] / $stats['Non_PMUY']) * 100, 2) : 0;
        $stats['Total_Pending_Percent'] = $total_domestic > 0 ? round(($stats['Total_Pending'] / $total_domestic) * 100, 2) : 0;
        
        // Add additional percentage for dashboard view
        $stats['Pending_Percent_Of_Total'] = $total_domestic > 0 ? round(($stats['Total_Pending'] / $total_domestic) * 100, 2) : 0;
        
        return $stats;
    }
    
    // Helper function to get total count for a scheme
    // private function get_scheme_count($scheme) {
    //     $userid = $this->session->userdata('id');
    //     $this->db->where('consumer_category', 'domestic');
    //     $this->db->where('userid', $userid);
    //     $this->db->where('scheme_selected', $scheme);
    //     return $this->db->count_all_results($this->table);
    // }

    public function get_area_breakdown($scheme = 'Total') {
        $kyc_data = $this->get_kyc_data();
        $area_counts = [];
        $userid = $this->session->userdata('id');
        $this->db->group_by('consumer_id'); 
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
        $userid = $this->session->userdata('id');
        $this->db->group_by('consumer_id'); 
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
        $this->db->select("COALESCE(area_name, 'Unknown') AS area_name, 
                          CASE 
                              WHEN LOWER(TRIM(scheme_selected)) = 'ujjwala' THEN 'PMUY'
                              ELSE 'Non PMUY'
                          END AS scheme_type,
                          consumer_number, consumer_name, phone_number");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->group_by('consumer_id'); 
        
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%Y-%m-%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(mandatory_inspection_date, '%Y/%m/%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(mandatory_inspection_date, '%d/%m/%Y') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->group_end();
        
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    public function get_mi_due_summary() {
        $userid = $this->session->userdata('id');
        $this->db->select("
            CASE 
                WHEN LOWER(TRIM(scheme_selected)) = 'ujjwala' THEN 'PMUY'
                ELSE 'Non PMUY'
            END AS scheme_type,
            COUNT(*) as count");
        $this->db->where('consumer_category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->group_by('consumer_id'); 
        
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(mandatory_inspection_date, '%Y-%m-%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(mandatory_inspection_date, '%Y/%m/%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(mandatory_inspection_date, '%d/%m/%Y') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->group_end();
        
        $this->db->group_by('scheme_type');
        $query = $this->db->get($this->table);
        
        return $query->result_array();
    }
    
    //Hose Due Data
    public function get_hose_due_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("area_name, consumer_number, consumer_name, phone_number, scheme_selected, tube_change_date, tube_change_due_date");
        $this->db->where('consumer_category', 'domestic'); 
        $this->db->where('userid', $userid);
        $this->db->group_by('consumer_id'); 
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
        $this->db->group_by('consumer_id'); 
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
        $this->db->group_by('consumer_id'); 
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
        $this->db->group_by('consumer_id'); 
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