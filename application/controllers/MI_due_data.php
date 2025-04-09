<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MI_due_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function midue_data() {
        // Get all pending MI data
        $pending_mi_data = $this->CustomerRegister_model->get_pending_mi_area_scheme_wise();
        
        // Calculate actual counts from the detailed data
        $pmuy_count = 0;
        $non_pmuy_count = 0;
        
        foreach ($pending_mi_data as $item) {
            if ($item['scheme_type'] === 'PMUY') {
                $pmuy_count++;
            } else {
                $non_pmuy_count++;
            }
        }
        
        $total = $pmuy_count + $non_pmuy_count;
        $pmuy_percentage = $total > 0 ? round(($pmuy_count / $total) * 100, 2) : 0;
        $non_pmuy_percentage = $total > 0 ? round(($non_pmuy_count / $total) * 100, 2) : 0;

        // Prepare data for view
        $data = [
            'table_data' => [
                'main_header' => 'MI Due',
                'sub_headers' => ['PMUY', 'Non PMUY', 'Total'],
                'rows' => [
                    'Qty' => [$pmuy_count, $non_pmuy_count, $total],
                    '%' => [$pmuy_percentage . '%', $non_pmuy_percentage . '%', '100%']
                ]
            ],
            'mi_due' => $pending_mi_data,
            'method' => 'midue',
            'page_title' => 'MI Due Report',
            'report_date' => date('d-M-Y H:i:s')
        ];

        log_message('debug', 'PMUY Count: ' . $pmuy_count);
        log_message('debug', 'Non PMUY Count: ' . $non_pmuy_count);
        log_message('debug', 'Total Count: ' . $total);
        log_message('debug', 'First MI Due Record: ' . json_encode($pending_mi_data[0] ?? 'No data'));

        $this->load->view('website_dashboard', $data);
    }
}