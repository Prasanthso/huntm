<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteDetails extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WebsiteModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->database();
    }

    // Display form and websites list
    // public function index() {
    //     $data['users'] = $this->WebsiteModel->get_users();
    //     $data['errors'] = [];
    //     $this->load->view('add_website', $data);
    // }

	 // Add Website section
     public function addwebsite() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];
        $data['method'] = "add_website"; 
        $this->load->view('website_dashboard',$data); 
    }

    // Store website login details in the database
    public function store() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];

        $url = trim($this->input->post('url'));
        $userId = trim($this->input->post('userId'));
        $password = trim($this->input->post('password'));
        $loggeduserid = $this->session->userdata('id');

        // Ensure URL starts with http:// or https://
        if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }

        // Manual validation
        if (empty($url)) $data['errors']['url'] = 'Website URL is required.';
        if (empty($userId)) $data['errors']['userId'] = 'Username is required.';
        if (empty($password)) $data['errors']['password'] = 'Password is required.';
        if (empty($loggeduserid)) $data['errors'] = 'Not a valid logged in user.';

        if (!empty($data['errors'])) {
            $this->load->view('add_website', $data);
        } else {
            // $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Store hashed password

            $insert_data = [
                'website_userId' => $userId,
                'website_password' => $password,
                'website_url' => $url,
                'userid' => $loggeduserid
            ];

            if ($this->WebsiteModel->insert_website($insert_data)) {
                $this->session->set_flashdata('success', 'Website added successfully!');
                redirect('storewebsite');
            } else {
                $this->session->set_flashdata('error', 'Failed to add website.');
                redirect('addwebsite');
            }
        }
    }
    
    // Show dashboard with saved websites
    public function stored_website() {

        $data['websites'] = $this->WebsiteModel->get_all_websites();
        $data['method'] = 'store_website';
        $this->load->view('website_dashboard',$data); 
    }

    // Auto-login using cURL and open in a new tab
    // public function auto_login() {
    //     $url = $this->input->post('url');
    //     $userId = $this->input->post('userId');
    //     $password = $this->input->post('password');

    //     $cookie_file = tempnam(sys_get_temp_dir(), 'cookie'); // Store cookies

    //     // Initialize cURL session
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    //         'username' => $userId,
    //         'password' => $password
    //     ]));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    //     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    //     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    //     $response = curl_exec($ch);
    //     $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // Get final redirected URL
    //     curl_close($ch);

    //     // Open login page in a new tab using JavaScript
    //     if (!empty($final_url)) {
    //         echo "<script>window.open('$final_url');</script>";
    //     } else {
    //         echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('storewebsite')."';</script>";
    //     }
    // }

    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutoLogin extends CI_Controller {

    public function auto_login() {
        $step = 1;
        $this->log_step($step++, "AUTO LOGIN PROCESS STARTED");

        // Get form data
        $url = $this->input->post('url');
        $userId = $this->input->post('userId');
        $password = $this->input->post('password');

        $this->log_step($step++, "Received form inputs");
        $this->log("   - URL: $url");
        $this->log("   - User ID: $userId");
        $this->log("   - Password: [HIDDEN]");

        // Validate inputs
        if (empty($url) || empty($userId) || empty($password)) {
            $this->log_step($step++, "Validation Failed: Missing fields");
            echo "<script>alert('⚠️ All fields are required!'); window.location.href='".site_url('storewebsite')."';</script>";
            return;
        }
        $this->log_step($step++, "Validation Passed");

        // Create cookie file
        $cookie_file = tempnam(sys_get_temp_dir(), 'cookie');
        $this->log_step($step++, "Created cookie file: $cookie_file");

        // Initialize cURL
        $ch = curl_init();
        $this->log_step($step++, "Initialized cURL");

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'username' => $userId,
            'password' => $password
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        // Handle SSL depending on environment
        if ($this->isLiveServer()) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For debugging: set to true when SSL is valid
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);     // Set to 2 when SSL is valid
            $this->log_step($step++, "SSL verification DISABLED for now (LIVE SERVER)");
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $this->log_step($step++, "SSL verification DISABLED (LOCAL SERVER)");
        }

        // Execute login request
        $this->log_step($step++, "Sending login request to server...");
        $response = curl_exec($ch);

        // Handle cURL errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            $this->log_step($step++, "cURL ERROR: $error_msg");
            curl_close($ch);
            echo "<script>alert('⚠️ cURL Error: ".addslashes($error_msg)."'); window.location.href='".site_url('storewebsite')."';</script>";
            return;
        }

        $this->log_step($step++, "Request completed successfully");

        // Get response info
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        $this->log_step($step++, "Response received");
        $this->log("   - HTTP Status: $httpCode");
        $this->log("   - Final URL: $final_url");

        // Optional response preview for debugging
        $this->log("   - Response Preview: " . substr(strip_tags($response), 0, 500));

        // Cleanup
        if (file_exists($cookie_file)) {
            unlink($cookie_file);
            $this->log_step($step++, "Deleted temporary cookie file");
        }

        // Decide outcome
        if (!empty($final_url) && $httpCode < 400) {
            $this->log_step($step++, "Login SUCCESS - Redirecting...");
            echo "<script>
                var win = window.open('about:blank', '_blank');
                if (win) {
                    win.location.href = '$final_url';
                } else {
                    alert('Popup blocked. Please allow popups.');
                    window.location.href = '$final_url';
                }
            </script>";
        } else {
            $this->log_step($step++, "Login FAILED - Invalid credentials or server error");
            echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('storewebsite')."';</script>";
        }

        $this->log_step($step++, "AUTO LOGIN PROCESS COMPLETED");
    }

    // Helper to print log with step and time
    private function log_step($step, $message) {
        $time = date("H:i:s");
        echo "<script>console.log('[$time] [$step] $message');</script>";
        error_log("[$time] [$step] $message");
        print("[$time] [$step] $message<br>");
    }

    // Helper to print additional debug info
    private function log($message) {
        $time = date("H:i:s");
        echo "<script>console.log('   $message');</script>";
        error_log("[$time] $message");
        print("   $message<br>");
    }

    // Check if running on live server
    private function isLiveServer() {
        $host = $_SERVER['HTTP_HOST'];
        $isLive = ($host !== 'localhost' && $host !== '127.0.0.1');
        $this->log("Server check: Is live server? " . ($isLive ? 'Yes' : 'No'));
        return $isLive;
    }
}



    // public function websitedashboard() {
    //          // Get customer data from model
    //          $customers = $this->CustomerRegister_model->get_customer_strength_data();
    //          $customer_data = $this->CustomerRegister_model->get_customer_status_counts();
             
    //          // Prepare data for view
    //          $data = [
    //              'customer_data' => $customer_data,
    //              'customers' => $customers ?: [],
    //              'method' => 'customer_strength'
    //          ];
     
    //          // echo '<pre>';
    //          // print_r($data);
    //          // echo '</pre>';
             
    //          $this->load->view('website_dashboard', $data);
    //     // $this->load->view('website_dashboard');

    // }

   
}
?> 
