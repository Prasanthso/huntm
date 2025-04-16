<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MI_due_data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->library('session');
        // Ensure user is authenticated
        if (!$this->session->userdata('id')) {
            redirect('login');
        }
    }

    public function midue_data() {
        // Get total domestic customers
        $total_customers = $this->CustomerRegister_model->get_total_domestic_customers();

        // Get MI due summary for counts
        $mi_due_summary = $this->CustomerRegister_model->get_mi_due_summary();
        $pmuy_count = 0;
        $non_pmuy_count = 0;
        $total = 0;

        foreach ($mi_due_summary as $row) {
            if ($row['scheme_type'] === 'PMUY') {
                $pmuy_count += $row['count'];
            } else {
                $non_pmuy_count += $row['count'];
            }
            $total += $row['count'];
        }

        // Calculate percentages
        $pmuy_percentage = $total > 0 ? round(($pmuy_count / $total) * 100, 2) : 0;
        $non_pmuy_percentage = $total > 0 ? round(($non_pmuy_count / $total) * 100, 2) : 0;
        $total_percentage = $total_customers > 0 ? round(($total / $total_customers) * 100, 2) : 0;

        // Get detailed pending MI data for table
        $pending_mi_data = $this->CustomerRegister_model->get_pending_mi_area_scheme_wise();

        // Prepare data for view
        $data = [
            'table_data' => [
                'main_header' => 'MI Due',
                'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
                'rows' => [
                    'Qty' => [$pmuy_count, $non_pmuy_count, $total],
                    '%' => [$pmuy_percentage . '%', $non_pmuy_percentage . '%', $total_percentage . '%']
                ]
            ],
            'mi_due' => $pending_mi_data,
            'mi_stats' => [
                'total' => [
                    'qty' => $total,
                    'percent' => $total_percentage
                ],
                'pmuy' => [
                    'qty' => $pmuy_count,
                    'percent' => $pmuy_percentage
                ],
                'non_pmuy' => [
                    'qty' => $non_pmuy_count,
                    'percent' => $non_pmuy_percentage
                ]
            ],
            'method' => 'midue',
            'page_title' => 'MI Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];

        // Debug logging
        log_message('debug', 'PMUY Count: ' . $pmuy_count);
        log_message('debug', 'Non-PMUY Count: ' . $non_pmuy_count);
        log_message('debug', 'Total MI Due: ' . $total);
        log_message('debug', 'First 5 records: ' . json_encode(array_slice($pending_mi_data, 0, 5)));

        $this->load->view('website_dashboard', $data);
    }
}