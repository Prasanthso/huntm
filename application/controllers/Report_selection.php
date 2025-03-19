<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_selection extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('download', 'url'));
    }

    public function index() {
        // Load the view with download buttons
        $this->load->view('download_view');
    }

    public function fetch_report($report_name = NULL) {
        // Validate report name
        if (empty($report_name)) {
            show_error('Report name is required.', 400);
            return;
        }

        // Sanitize and decode report name
        $report_name = urldecode(filter_var($report_name, FILTER_SANITIZE_STRING));
        
        // Prevent directory traversal attacks
        if (strpos($report_name, '..') !== false || strpos($report_name, '/') !== false) {
            show_error('Invalid report name.', 400);
            return;
        }

        // Construct the CSV download URL with proper encoding
        $params = array(
            'PortalPath' => '/shared/LPG/_portal/Distributor Reports',
            'Path' => "/shared/Custom/LPG/{$report_name}",
            'Style' => 'Alta',
            'Done' => 'Dashboard',
            'Action' => 'Prompt',
            'Format' => 'CSV'
        );
        $url = "https://reports.px.indianoil.in/analytics/saw.dll?PortalGo&" . http_build_query($params);

        // Initialize cURL with improved settings
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_COOKIEJAR => FCPATH . 'application/cache/cookie.txt',
            CURLOPT_COOKIEFILE => FCPATH . 'application/cache/cookie.txt',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            CURLOPT_HEADER => false
        ));

        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        // Log response for debugging (optional)
        if (ENVIRONMENT === 'development') {
            file_put_contents(FCPATH . 'application/logs/debug_response_' . time() . '.html', $data);
        }

        // Handle cURL errors
        if ($data === false) {
            log_message('error', 'cURL error: ' . $curl_error);
            show_error('Failed to fetch report. Please try again later.', 500);
            return;
        }

        // Check response validity
        if ($http_code !== 200) {
            show_error('Server returned an error: HTTP ' . $http_code, $http_code);
            return;
        }

        if (empty($data) || strpos($content_type, 'text/csv') === false) {
            show_error('Invalid report format received. Please check your credentials.', 403);
            return;
        }

        // Set headers and force download
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $report_name) . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($data));
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo $data;
        exit;
    }
}