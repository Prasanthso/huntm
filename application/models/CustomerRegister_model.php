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
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $query = $this->db->get($this->table);
        
        $result = $query->row_array();
        return $result['total'] ?? 0;
    }

/////////////////////////////Customer Strength Data and Stats///////////////////////////
    //Customer strength data
    public function get_customer_strength_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("Area_Name, Consumer_Number, Consumer_Name, Phone_Number, Scheme_Selected, Consumer_Sub_Status");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid); 
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('Consumer_ID'); 
        $query = $this->db->get($this->table);
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                if ($row['Scheme_Selected'] == 'Ujjwala' || $row['Scheme_Selected'] == 'Ujjwala - Extended') {
                    $row['Scheme_Selected'] = 'PMUY';
                }
                else {
                    $row['Scheme_Selected'] = 'Non PMUY';
                }
            }
            return $result;
        }
        return [];
    }
    // Get customer status counts
    public function get_customer_status_counts() {
        $userid = $this->session->userdata('id');
        
        // First get distinct Consumer_ID to avoid counting duplicates
        $this->db->select('Consumer_ID, Scheme_Selected, Consumer_Sub_Status');
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('Consumer_ID'); // Group by Consumer_ID to remove duplicates
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
                $scheme = ($row['Scheme_Selected'] == 'Ujjwala' || $row['Scheme_Selected'] == 'Ujjwala - Extended') ? 'pmuy' : 'non_pmuy';

                $status = strtolower($row['Consumer_Sub_Status']);
                
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
    
    public function get_nillrefill_data() {
        $userid = $this->session->userdata('id');
        if (!$userid) {
            return [];
        }

        $this->db->select([
            'Consumer_ID',
            'Area_Name',
            'Consumer_Number',
            'Consumer_Name',
            'Phone_Number',
            'Scheme_Selected',
            'Last_Refill_Date',
            'Consumer_Category',
            'Consumer_Sub_Status'
        ]);
        
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where('Last_Refill_Date IS NOT NULL');
        $this->db->order_by('Last_Refill_Date', 'ASC');
        $this->db->group_by('Consumer_ID');
        
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            
            foreach ($result as &$row) {
                $row['Scheme_Selected'] = $this->normalize_scheme($row['Scheme_Selected']);
                
                try {
                    $last_refill = new DateTime($row['Last_Refill_Date']);
                    $current_date = new DateTime();
                    $interval = $current_date->diff($last_refill);
                    $row['days_since_refill'] = $interval->days;
                    $row['months_since_refill'] = $interval->y * 12 + $interval->m;
                } catch (Exception $e) {
                    $row['days_since_refill'] = null;
                    $row['months_since_refill'] = null;
                }
                
                $row['Area_Name'] = $row['Area_Name'] ?: 'Unknown';
                $row['Consumer_Sub_Status'] = $row['Consumer_Sub_Status'] ? strtoupper($row['Consumer_Sub_Status']) : 'UNKNOWN';
            }
            
            return $result;
        }
        
        return [];
    }

    public function get_nillrefill_stats($customers) {
        $counts = [
            'active' => [
                'greater_than_3_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_6_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_1_year' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ],
            'suspended' => [
                'greater_than_3_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_6_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_1_year' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ],
            'deactivated' => [
                'greater_than_3_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_6_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_1_year' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ],
            'overall_total' => [
                'greater_than_3_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_6_months' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'greater_than_1_year' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ],
            'total_consumers' => count($customers)
        ];
    
        foreach ($customers as $row) {
            if (!empty($row['days_since_refill']) && !empty($row['Consumer_Sub_Status'])) {
                $is_pmuy = ($row['Scheme_Selected'] === 'PMUY');
                $days = $row['days_since_refill'];
                $status = strtolower($row['Consumer_Sub_Status']);
                
                if (!isset($counts[$status])) {
                    continue;
                }
    
                if ($days > 90 && $days <= 180) {
                    $counts[$status]['greater_than_3_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts[$status]['greater_than_3_months']['total']++;
                    $counts['overall_total']['greater_than_3_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['overall_total']['greater_than_3_months']['total']++;
                }
                if ($days > 180 && $days <= 365) {
                    $counts[$status]['greater_than_6_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts[$status]['greater_than_6_months']['total']++;
                    $counts['overall_total']['greater_than_6_months'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['overall_total']['greater_than_6_months']['total']++;
                }
                if ($days > 365) {
                    $counts[$status]['greater_than_1_year'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts[$status]['greater_than_1_year']['total']++;
                    $counts['overall_total']['greater_than_1_year'][$is_pmuy ? 'pmuy' : 'non_pmuy']++;
                    $counts['overall_total']['greater_than_1_year']['total']++;
                }
            }
        }
    
        // Calculate percentages
        $stats = [];
        foreach (['active', 'suspended', 'deactivated', 'overall_total'] as $status) {
            foreach (['greater_than_3_months', 'greater_than_6_months', 'greater_than_1_year'] as $period) {
                $stats[$status][$period] = [
                    'pmuy' => [
                        'qty' => $counts[$status][$period]['pmuy'],
                        'percent' => $counts['total_consumers'] > 0 ? round(($counts[$status][$period]['pmuy'] / $counts['overall_total'][$period]['total']) * 100, 2) : 0
                    ],
                    'non_pmuy' => [
                        'qty' => $counts[$status][$period]['non_pmuy'],
                        'percent' => $counts['total_consumers'] > 0 ? round(($counts[$status][$period]['non_pmuy'] / $counts['overall_total'][$period]['total']) * 100, 2) : 0
                    ],
                    'total' => [
                        'qty' => $counts[$status][$period]['total'],
                        'percent' => $counts['total_consumers'] > 0 ? round(($counts[$status][$period]['total'] / $counts['overall_total'][$period]['total']) * 100, 2) : 0
                    ]
                ];
            }
        }
        
        return [
            'data' => $stats,
            'total_consumers' => $counts['total_consumers']
        ];
    }

/////////////////////////////KYC Data and Stats///////////////////////////
     //KYC data
    public function get_kyc_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("Area_Name, Consumer_Number, Consumer_Name, Phone_Number, Scheme_Selected, KYC_Number, Consumer_Sub_Status");
        $this->db->where('Consumer_Category', 'domestic'); 
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('Consumer_ID'); 
        $this->db->where('KYC_Number', '');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                // Standardize scheme names
                $row['Scheme_Selected'] = (in_array($row['Scheme_Selected'], ['Ujjwala', 'Ujjwala - Extended'])) ? 'PMUY' : 'Non PMUY';
                // Determine KYC status
                $row['kyc_status'] = empty($row['KYC_Number']) ? 'Pending' : 'Completed';
                // Normalize status
                $row['consumer_status'] = strtoupper($row['Consumer_Sub_Status'] ?? 'ACTIVE');
            }
            return $result;
        }
        return [];
    }
    //KYC Stats
    public function get_kyc_stats() {
        $userid = $this->session->userdata('id');
        
        // Get total domestic customers
        $total_domestic = $this->get_total_domestic_customers();
        
        // Get PMUY and Non-PMUY pending counts
        $this->db->select("CASE WHEN Scheme_Selected IN ('Ujjwala', 'Ujjwala - Extended') THEN 'PMUY' ELSE 'Non_PMUY' END AS category, COUNT(DISTINCT Consumer_ID) AS count");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('KYC_Number', '');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('category');
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        
        // Initialize stats array
        $stats = [
            'Total' => $total_domestic,
            'PMUY_Pending' => 0,
            'Non_PMUY_Pending' => 0,
            'Total_Pending' => 0,
            'PMUY_Pending_Percent' => 0,
            'Non_PMUY_Pending_Percent' => 0,
            'Total_Pending_Percent' => 0
        ];
        
        // Process query results
        foreach ($result as $row) {
            if ($row['category'] === 'PMUY') {
                $stats['PMUY_Pending'] = $row['count'];
            } else {
                $stats['Non_PMUY_Pending'] = $row['count'];
            }
            $stats['Total_Pending'] += $row['count'];
        }
        
        // Calculate percentages
        $stats['PMUY_Pending_Percent'] = $stats['Total_Pending'] > 0 ? round(($stats['PMUY_Pending'] / $stats['Total_Pending']) * 100, 2) : 0;
        $stats['Non_PMUY_Pending_Percent'] = $stats['Total_Pending'] > 0 ? round(($stats['Non_PMUY_Pending'] / $stats['Total_Pending']) * 100, 2) : 0;
        $stats['Total_Pending_Percent'] = $stats['Total'] > 0 ? round(($stats['Total_Pending'] / $stats['Total']) * 100, 2) : 0;
        
        return $stats;
    }
    //KYC Status Counts
    public function get_kyc_status_counts() {
        $userid = $this->session->userdata('id');
        $this->db->select("Scheme_Selected, Consumer_Sub_Status, KYC_Number");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('Consumer_ID');
        $this->db->where('KYC_Number', '');
        $query = $this->db->get($this->table);
        
        // Initialize counts array
        $counts = [
            'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
        ];
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            
            foreach ($result as $row) {
                // Skip if KYC is completed
                if (!empty($row['KYC_Number'])) continue;
                
                $scheme = $this->normalize_scheme($row['Scheme_Selected']);
                $status = strtolower($row['Consumer_Sub_Status']);
                $scheme_key = ($scheme === 'PMUY') ? 'pmuy' : 'non_pmuy';
                
                // Count by status
                if (isset($counts[$status])) {
                    $counts[$status][$scheme_key]++;
                    $counts[$status]['total']++;
                }
                
                // Count totals
                $counts['total'][$scheme_key]++;
                $counts['total']['total']++;
            }
        }
        
        return $counts;
    }
    //KYC Area wise data
    public function get_area_breakdown($scheme = 'Total') {
        $kyc_data = $this->get_kyc_data();
        $area_counts = [];
        
        foreach ($kyc_data as $row) {
            // Skip if KYC is completed
            if ($row['kyc_status'] === 'Completed') continue;
            
            // Check scheme filter
            if ($scheme !== 'Total' && $row['Scheme_Selected'] !== $scheme) continue;
            
            $area = $row['Area_Name'] ?: 'Unknown';
            
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
    // Get customers by area and scheme
    public function get_customers_by_area($area, $scheme = 'Total') {
        $kyc_data = $this->get_kyc_data();
        $filtered = [];

        foreach ($kyc_data as $row) {
            // Skip if KYC is completed
            if ($row['kyc_status'] === 'Completed') continue;
            
            // Check area match
            $row_area = $row['Area_Name'] ?: 'Unknown';
            if ($row_area !== $area) continue;
            
            // Check scheme filter
            if ($scheme !== 'Total' && $row['Scheme_Selected'] !== $scheme) continue;
            
            $filtered[] = $row;
        }

        // Sort by consumer number
        usort($filtered, function($a, $b) {
            return strcmp($a['Consumer_Number'], $b['Consumer_Number']);
        });

        return $filtered;
    }

/////////////////////////Mandatory Inspection (MI) Due Data///////////////////////////
    //MI due data
    public function get_pending_mi_area_scheme_wise() {
        $userid = $this->session->userdata('id');
        $this->db->select("COALESCE(Area_Name, 'Unknown') AS Area_Name, 
                        Consumer_Number, Consumer_Name, Phone_Number,
                        CASE 
                            WHEN LOWER(TRIM(Scheme_Selected)) IN ('ujjwala', 'ujjwala - extended') THEN 'PMUY'
                            ELSE 'Non PMUY'
                        END AS scheme_type,
                        Consumer_Sub_Status AS status");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->group_by('Consumer_ID'); 
        
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(Mandatory_Inspection_Date, '%Y-%m-%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(Mandatory_Inspection_Date, '%Y/%m/%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(Mandatory_Inspection_Date, '%d/%m/%Y') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->group_end();
        
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        
        // Normalize status values
        foreach ($result as &$row) {
            $row['status'] = strtoupper($row['status'] ?? 'ACTIVE');
        }
        
        return $result;
    }
    // Get MI due summary
    public function get_mi_due_summary() {
        $userid = $this->session->userdata('id');
        $this->db->select("
            CASE 
                WHEN LOWER(TRIM(Scheme_Selected)) IN ('ujjwala', 'ujjwala - extended') THEN 'PMUY'
                ELSE 'Non PMUY'
            END AS scheme_type,
            Consumer_Sub_Status,
            COUNT(DISTINCT Consumer_ID) as count");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        
        $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
        $today = date('Y-m-d');
        
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(Mandatory_Inspection_Date, '%Y-%m-%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(Mandatory_Inspection_Date, '%Y/%m/%d') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->or_where("STR_TO_DATE(Mandatory_Inspection_Date, '%d/%m/%Y') BETWEEN '$fiveYearsAgo' AND '$today'");
        $this->db->group_end();
        
        $this->db->group_by('scheme_type, Consumer_Sub_Status');
        $query = $this->db->get($this->table);
        
        return $query->result_array();
    }
    // Get MI due status counts
    public function get_mi_due_status_counts() {
        $result = $this->get_mi_due_summary();
        
        $counts = [
            'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
        ];
        
        foreach ($result as $row) {
            $scheme_key = ($row['scheme_type'] === 'PMUY') ? 'pmuy' : 'non_pmuy';
            $status = strtolower($row['Consumer_Sub_Status']);
            
            if (isset($counts[$status])) {
                $counts[$status][$scheme_key] += $row['count'];
                $counts[$status]['total'] += $row['count'];
            }
            
            $counts['total'][$scheme_key] += $row['count'];
            $counts['total']['total'] += $row['count'];
        }
        
        return $counts;
    }

///////////////////////////Hose Due Data///////////////////////////
    //Hose Due Data
    public function get_hose_due_data() {
        $userid = $this->session->userdata('id');
        if (empty($userid)) {
            log_message('error', 'User ID is empty in get_hose_due_data');
            return [];
        }
        
        $this->db->select("Consumer_ID, Area_Name, Consumer_Number, Consumer_Name, Phone_Number, 
                        Scheme_Selected, Consumer_Sub_Status as status, Tube_Change_Date,Tube_Change_Due_Date");
        $this->db->where('Consumer_Category', 'domestic'); 
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->where('userid', $userid);
        $this->db->group_by('Consumer_ID'); 
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $today = date('Y-m-d');

            foreach ($result as &$row) {
                // Normalize scheme name
                $scheme = strtolower(trim($row['Scheme_Selected']));
                $row['Scheme_Selected'] = in_array($scheme, ['ujjwala', 'ujjwala - extended']) ? 'PMUY' : 'NON_PMUY';
                
                // Normalize status
                $row['status'] = strtoupper($row['status']);
                
                // Calculate hose status
                $lastChanged = $row['Tube_Change_Date'] ?? $row['Tube_Change_Due_Date'] ?? null;
                $row['last_change_date'] = $lastChanged;

                if (empty($lastChanged)) {
                    $row['hose_status'] = 'Due';
                    $row['days_overdue'] = 'N/A';
                } else {
                    $lastChangedDate = new DateTime($lastChanged);
                    $todayDate = new DateTime($today);
                    $interval = $todayDate->diff($lastChangedDate);
                    $daysSinceChange = $interval->days;

                    $row['hose_status'] = ($daysSinceChange > 730) ? 'Due' : 'OK';
                    $row['days'] = ($daysSinceChange > 730) ? $daysSinceChange - 730 : 730 - $daysSinceChange;
                }
            }
            return $result;
        }
        return [];
    }
    // Get hose due stats
    public function get_hose_due_stats($return_type = 'dashboard') {
        $hose_data = $this->get_hose_due_data();
        $total_domestic = $this->get_total_domestic_customers();
        
        if ($return_type === 'dashboard') {
            // Dashboard format
            $stats = [
                'Total' => $total_domestic,
                'PMUY_Due' => 0,
                'Non_PMUY_Due' => 0,
                'Total_Due' => 0,
                'PMUY_Due_Percent' => 0,
                'Non_PMUY_Due_Percent' => 0,
                'Total_Due_Percent' => 0
            ];
            
            foreach ($hose_data as $row) {
                if ($row['hose_status'] === 'Due') {
                    $stats['Total_Due']++;
                    if ($row['Scheme_Selected'] === 'PMUY') {
                        $stats['PMUY_Due']++;
                    } else {
                        $stats['Non_PMUY_Due']++;
                    }
                }
            }
            
            // Calculate percentages
            if ($stats['Total_Due'] > 0) {
                $stats['PMUY_Due_Percent'] = round(($stats['PMUY_Due'] / $stats['Total_Due']) * 100, 2);
                $stats['Non_PMUY_Due_Percent'] = round(($stats['Non_PMUY_Due'] / $stats['Total_Due']) * 100, 2);
            }
            $stats['Total_Due_Percent'] = $stats['Total'] > 0 ? round(($stats['Total_Due'] / $stats['Total']) * 100, 2) : 0;
            
            return $stats;
        } else {
            // Detailed report format
            $counts = [
                'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
                'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
            ];
            
            foreach ($hose_data as $row) {
                if ($row['hose_status'] === 'Due') {
                    $scheme = ($row['Scheme_Selected'] === 'PMUY') ? 'pmuy' : 'non_pmuy';
                    $status = strtolower($row['status']);
                    
                    if (isset($counts[$status])) {
                        $counts[$status][$scheme]++;
                        $counts[$status]['total']++;
                    }
                    
                    $counts['total'][$scheme]++;
                    $counts['total']['total']++;
                }
            }
            
            return $counts;
        }
    }   

//////////////////////Single Bottle Connection (SBC) Data//////////////////////
     //SBC Data
     // Add these methods to your existing model
    public function get_sbc_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("Consumer_ID, Area_Name, Consumer_Number, Consumer_Name, Phone_Number, 
                        Scheme_Selected, Consumer_Type, Consumer_Sub_Status");
        $this->db->where('Consumer_Category', 'domestic'); 
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->where('Consumer_Type', 'Single Bottle Connection'); 
        $this->db->group_by('Consumer_ID'); 

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                // Normalize data
                $row['Scheme_Selected'] = $this->normalize_scheme($row['Scheme_Selected']);
                $row['Consumer_Sub_Status'] = strtoupper($row['Consumer_Sub_Status']);
                // echo $row['Scheme_Selected'];
            }
            return $result;
        }
        return [];
    }
    // Get SBC stats
    public function get_sbc_status_counts() {
        $userid = $this->session->userdata('id');
        $this->db->select("Scheme_Selected, Consumer_Sub_Status");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'DEACTIVATED', 'SUSPENDED']);
        $this->db->where('Consumer_Type', 'Single Bottle Connection');
        $this->db->group_by('Consumer_ID'); 
        $query = $this->db->get($this->table);
        
        // Initialize counts array
        $counts = [
            'active' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'suspended' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'deactivated' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0],
            'total' => ['pmuy' => 0, 'non_pmuy' => 0, 'total' => 0]
        ];
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            
            foreach ($result as $row) {
                $scheme = $this->normalize_scheme($row['Scheme_Selected']);
                // echo $scheme;
                $status = strtolower($row['Consumer_Sub_Status']);
                $scheme_key = strtolower($scheme);
                
                // Count by status
                if (isset($counts[$status])) {
                    $counts[$status][$scheme_key]++;
                    $counts[$status]['total']++;
                }
                
                $counts['total'][$scheme_key]++;
                $counts['total']['total']++;
            }
        }
        
        return $counts;
    }
    // Normalize scheme names
    private function normalize_scheme($scheme) {
        if($scheme === 'Ujjwala' || $scheme === 'Ujjwala - Extended') {
            // echo $scheme;
            return 'PMUY';
        }
        else {
            // echo $scheme;
            return 'NON_PMUY';
        }
    }

 /////////////////////////////Phone Missing Stats/////////////////////////////////////   
    // Phone Missing Stats
    public function get_phone_missing_stats() {
        $phone_missing_data = $this->get_phone_number_data();
        $total_customers = $this->get_total_domestic_customers();

        // Initialize complete stats structure
        $stats = [
            'total' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0,
                'pmuy_percent' => 0,
                'non_pmuy_percent' => 0,
                'total_percent' => 0
            ],
            'active' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0,
                'pmuy_percent' => 0,
                'non_pmuy_percent' => 0,
                'total_percent' => 0
            ],
            'suspended' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0,
                'pmuy_percent' => 0,
                'non_pmuy_percent' => 0,
                'total_percent' => 0
            ],
            'deactivated' => [
                'pmuy' => 0,
                'non_pmuy' => 0,
                'total' => 0,
                'pmuy_percent' => 0,
                'non_pmuy_percent' => 0,
                'total_percent' => 0
            ]
        ];

        if (!empty($phone_missing_data)) {
            foreach ($phone_missing_data as $customer) {
                $scheme = $this->normalize_scheme($customer['Scheme_Selected']);
                $status = strtolower($customer['Consumer_Sub_Status']);

                // Validate status
                if (!in_array($status, ['active', 'suspended', 'deactivated'])) {
                    continue;
                }

                $scheme_key = ($scheme === 'PMUY') ? 'pmuy' : 'non_pmuy';

                // Count totals
                $stats['total']['total']++;
                $stats['total'][$scheme_key]++;

                // Count by status
                $stats[$status]['total']++;
                $stats[$status][$scheme_key]++;
            }

            // Calculate percentages based on total customers with missing phone numbers
            $total_missing = $stats['total']['total'];
            if ($total_missing > 0) {
                // Total percentages
                $stats['total']['total_percent'] = 100; // Always 100% for total
                $stats['total']['pmuy_percent'] = round(($stats['total']['pmuy'] / $total_missing) * 100, 2);
                $stats['total']['non_pmuy_percent'] = round(($stats['total']['non_pmuy'] / $total_missing) * 100, 2);

                // Status-specific percentages
                foreach (['active', 'suspended', 'deactivated'] as $status) {
                    $stats[$status]['total_percent'] = round(($stats[$status]['total'] / $total_missing) * 100, 2);
                    $stats[$status]['pmuy_percent'] = round(($stats[$status]['pmuy'] / $total_missing) * 100, 2);
                    $stats[$status]['non_pmuy_percent'] = round(($stats[$status]['non_pmuy'] / $total_missing) * 100, 2);
                }
            }
        }

        return $stats;
    }
    // Get phone number data
    public function get_phone_number_data() {
        $userid = $this->session->userdata('id');
        $this->db->select("Area_Name, Consumer_Number, Consumer_Name, Phone_Number, Scheme_Selected, Consumer_Sub_Status");
        $this->db->where('Consumer_Category', 'domestic');
        $this->db->where('userid', $userid);
        $this->db->where_in('Consumer_Sub_Status', ['ACTIVE', 'SUSPENDED', 'DEACTIVATED']);
        $this->db->where("(Phone_Number IS NULL OR Phone_Number = '')", NULL, FALSE);
        $this->db->group_by('Consumer_ID');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as &$row) {
                $row['Scheme_Selected'] = $this->normalize_scheme($row['Scheme_Selected']);
                $row['Consumer_Sub_Status'] = strtoupper($row['Consumer_Sub_Status']);
            }
            return $result;
        }
        return [];
    }

    
}