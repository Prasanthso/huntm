<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebScrappingData extends CI_Controller {
    private $debug_log;
    private $cookie_path;
    private $curl_log_path;

    public function __construct() {
        parent::__construct();
        $this->load->model('InvoicedOrder_model');
        $this->load->helper(['file', 'url']);
        $this->load->library('session');

        // Initialize paths
        $this->debug_log = APPPATH . 'cache/debug_log.txt';
        $this->cookie_path = APPPATH . 'cache/siebel_cookies.txt';
        $this->curl_log_path = APPPATH . 'cache/curl_log.txt';

        // Ensure cache directory exists
        if (!is_dir(APPPATH . 'cache')) {
            mkdir(APPPATH . 'cache', 0755, true);
        }

        $this->log_message("=== Initializing Controller ===");
    }

    public function index() {
        $this->log_message("\n=== Loading Index Page ===");
        $data['orders'] = $this->InvoicedOrder_model->get_all_orders();
        $data['error'] = $this->session->flashdata('error');
        $this->log_message("Loaded " . count($data['orders']) . " orders from database");

        $this->load->view('invoiced_orders_view', $data);
    }

    public function auto_login() {
        $this->log_message("\n=== Starting Auto-Login Process ===");

        // Configuration
        $base_url = 'https://sdms.px.indianoil.in';
        $login_url = $base_url . '/siebel/app/edealer/enu/';
        $target_url = $base_url . '/siebel/app/edealer/enu/?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View';

        // Initialize cURL session
        $ch = $this->init_curl_session();

        try {
            // Step 1: Get initial login page
            $this->log_message("1. Accessing login page: $login_url");
            curl_setopt($ch, CURLOPT_URL, $login_url);
            $initial_page = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception("CURL Error: " . curl_error($ch));
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->log_message("2. Received login page (HTTP $http_code, length: " . strlen($initial_page) . " bytes)");
            write_file(APPPATH . 'cache/login_page.html', $initial_page);

            // Step 2: Parse login form
            $login_data = $this->parse_login_form($initial_page);
            if (!$login_data) {
                throw new Exception("Could not parse login form");
            }

            // Add additional required fields for Siebel
            $login_data['SWECmd'] = 'Login';
            $login_data['SWERF'] = 1;
            $login_data['SWETS'] = time();

            // Step 3: Submit login credentials
            $this->log_message("3. Submitting login form with fields: " . json_encode(array_keys($login_data)));
            curl_setopt($ch, CURLOPT_URL, $login_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($login_data));
            $login_response = curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->log_message("4. Received login response (HTTP $http_code, length: " . strlen($login_response) . " bytes)");
            write_file(APPPATH . 'cache/login_response.html', $login_response);

            // Step 4: Verify login success
            $redirect_url = $this->check_login_success($login_response);
            if (!$redirect_url && strpos($login_response, 'EPIC Order Summary View') === false) {
                throw new Exception("Login failed - check login_response.html for details");
            }

            // Step 5: Follow redirect after login (if needed)
            if ($redirect_url) {
                $this->log_message("5. Following redirect to: $redirect_url");
                curl_setopt($ch, CURLOPT_URL, $redirect_url);
                curl_setopt($ch, CURLOPT_POST, false);
                $redirect_response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $this->log_message("6. Received redirect response (HTTP $http_code, length: " . strlen($redirect_response) . " bytes)");
                write_file(APPPATH . 'cache/redirect_response.html', $redirect_response);
            }

            // Step 6: Access target page
            $this->log_message("7. Accessing target page: $target_url");
            curl_setopt($ch, CURLOPT_URL, $target_url);
            $target_page = curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->log_message("8. Received target page (HTTP $http_code, length: " . strlen($target_page) . " bytes)");
            write_file(APPPATH . 'cache/target_page.html', $target_page);

            // Step 7: Parse data
            $orders = $this->parse_siebel_data($target_page);
            $this->log_message("9. Found " . count($orders) . " orders in the data");

            if (empty($orders)) {
                throw new Exception("Data parsing failed - no records found. Check target_page.html and debug_log.txt for details.");
            }

            // Step 8: Save to database
            $this->log_message("10. Saving orders to database...");
            $this->InvoicedOrder_model->clear_orders();
            $this->InvoicedOrder_model->save_orders($orders);
            $this->log_message("11. Successfully saved " . count($orders) . " orders");

            $this->session->set_flashdata('error', null);

        } catch (Exception $e) {
            $this->log_message("ERROR: " . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
        } finally {
            curl_close($ch);
            redirect('WebScrappingData');
        }
    }

    private function init_curl_session() {
        $ch = curl_init();

        // Clear previous cookies
        if (file_exists($this->cookie_path)) {
            unlink($this->cookie_path);
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIEJAR => $this->cookie_path,
            CURLOPT_COOKIEFILE => $this->cookie_path,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_VERBOSE => true,
            CURLOPT_STDERR => fopen($this->curl_log_path, 'w+'),
            CURLOPT_HEADER => true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTPHEADER => [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1'
            ]
        ]);

        return $ch;
    }

    private function parse_login_form($html) {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Try different possible username/password field names
        $username_field = $xpath->query("//input[@name='SWEUserName']")->item(0) ? 'SWEUserName' : 
                         ($xpath->query("//input[@name='username']")->item(0) ? 'username' : '');
        $password_field = $xpath->query("//input[@name='SWEPassword']")->item(0) ? 'SWEPassword' : 
                         ($xpath->query("//input[@name='password']")->item(0) ? 'password' : '');

        $this->log_message("Detected form fields:");
        $this->log_message("- Username field: $username_field");
        $this->log_message("- Password field: $password_field");

        if (empty($username_field) || empty($password_field)) {
            return false;
        }

        // Capture hidden form fields
        $hidden_fields = [];
        $inputs = $xpath->query("//input[@type='hidden']");
        foreach ($inputs as $input) {
            $name = $input->getAttribute('name');
            if ($name) {
                $hidden_fields[$name] = $input->getAttribute('value');
            }
        }

        // Load credentials
        $username = getenv('SIEBEL_USERNAME') ?: '0000298013_01';
        $password = getenv('SIEBEL_PASSWORD') ?: 'Reva*1234';

        return array_merge([
            $username_field => $username,
            $password_field => $password
        ], $hidden_fields);
    }

    private function check_login_success($response) {
        // Check for redirect in headers
        if (preg_match('/Location: (.*)/i', $response, $matches)) {
            $redirect_url = trim($matches[1]);
            $this->log_message("Login redirect detected to: $redirect_url");
            return $redirect_url;
        }

        // Check for meta refresh redirect
        $dom = new DOMDocument();
        @$dom->loadHTML($response);
        $xpath = new DOMXPath($dom);
        $meta_refresh = $xpath->query("//meta[@http-equiv='refresh']")->item(0);

        if ($meta_refresh && preg_match('/url=(.*)/i', $meta_refresh->getAttribute('content'), $matches)) {
            $redirect_url = trim($matches[1]);
            $this->log_message("Meta refresh redirect detected to: $redirect_url");
            return $redirect_url;
        }

        // Check for JavaScript redirect
        if (preg_match('/window\.location\.href\s*=\s*["\'](.*?)["\']/', $response, $matches)) {
            $redirect_url = trim($matches[1]);
            $this->log_message("JavaScript redirect detected to: $redirect_url");
            return $redirect_url;
        }

        // Check for success indicators
        $success_indicators = [
            'EPIC Order Summary View',
            'Welcome',
            'Dashboard',
            'Logout',
            'Siebel',
            'Main Menu'
        ];

        foreach ($success_indicators as $indicator) {
            if (stripos($response, $indicator) !== false) {
                $this->log_message("Login success detected by content: $indicator");
                return false; // No redirect needed
            }
        }

        $this->log_message("No login success indicators found. Checking for errors...");
        if (stripos($response, 'error') !== false || stripos($response, 'invalid') !== false) {
            $this->log_message("Possible login error detected in response");
        }

        return false;
    }

    private function parse_siebel_data($html) {
        $this->log_message("=== Starting Data Parsing ===");
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $orders = [];

        // Targeted table selectors based on provided HTML
        $table_selectors = [
            "//table[@id='s_3_l']", // Specific table ID
            "//table[contains(@class, 'ui-jqgrid-btable')]", // jQuery Grid table
            "//table[@summary='Invoiced Orders By Service Area']", // Summary attribute
            "//div[@id='s_S_A3_div']//table", // Within applet div
            "//table[contains(@class, 'siebui')]",
            "//table[@role='grid']",
            "//table" // Fallback
        ];

        $table = null;
        foreach ($table_selectors as $selector) {
            $tables = $xpath->query($selector);
            foreach ($tables as $t) {
                $rows = $xpath->query(".//tr[contains(@class, 'jqgrow')]", $t);
                if ($rows->length > 0) { // Ensure data rows exist
                    $table = $t;
                    $this->log_message("Found table using selector: $selector (ID: " . $t->getAttribute('id') . ", Class: " . $t->getAttribute('class') . ", Rows: " . $rows->length . ")");
                    break 2;
                }
            }
        }

        if (!$table) {
            $this->log_message("ERROR: Could not find data table. Listing all tables:");
            $all_tables = $xpath->query("//table");
            foreach ($all_tables as $t) {
                $rows = $xpath->query(".//tr", $t);
                $this->log_message("- Table ID: " . $t->getAttribute('id') . ", Class: " . $t->getAttribute('class') . ", Rows: " . $rows->length);
            }
            write_file(APPPATH . 'cache/all_tables.html', $dom->saveHTML());
            return $orders;
        }

        // Log table HTML for debugging
        $this->log_message("Table HTML snippet: " . substr($dom->saveHTML($table), 0, 1000) . "...");

        // Select rows with class 'jqgrow' (data rows)
        $rows = $xpath->query(".//tr[contains(@class, 'jqgrow')]", $table);
        $this->log_message("Found " . $rows->length . " data rows");

        foreach ($rows as $i => $row) {
            // Get all <td> elements, excluding hidden checkbox column
            $cells = $xpath->query(".//td[not(@style='text-align:center;display:none;')]", $row);
            $row_data = [];

            foreach ($cells as $j => $cell) {
                $row_data[] = trim($cell->nodeValue);
            }

            $this->log_message("Row $i: " . implode(" | ", $row_data));

            // Map columns: Area Name (0), CashMemo Generated (1), Status (2)
            if (count($row_data) >= 3) {
                $area_name = trim($row_data[0]);
                $cashmemo = (int)trim($row_data[1]);
                $status = trim($row_data[2]);

                if (!empty($area_name)) {
                    $orders[] = [
                        'area_name' => $area_name,
                        'cashmemo_generated' => $cashmemo,
                        'status' => $status
                    ];
                    $this->log_message("Parsed row $i: $area_name, $cashmemo, $status");
                } else {
                    $this->log_message("Row $i skipped: Empty area_name");
                }
            } else {
                $this->log_message("Row $i has insufficient columns: " . json_encode($row_data));
            }
        }

        if (empty($orders)) {
            $this->log_message("WARNING: No valid orders parsed. Possible issues: incorrect column mapping, empty rows, or JavaScript-rendered content.");
        }

        return $orders;
    }

    private function log_message($message) {
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "[$timestamp] $message\n";
        file_put_contents($this->debug_log, $log_entry, FILE_APPEND);
    }
}