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

    public function auto_login() {
        // Start logging
        echo "<script>console.log('=== AUTO LOGIN PROCESS STARTED ===');</script>";
        
        // Get form inputs
        $url = $this->input->post('url');
        $userId = $this->input->post('userId');
        $password = $this->input->post('password');
        
        echo "<script>console.log('1. Received form inputs:');</script>";
        echo "<script>console.log('   - URL: ' + ".json_encode($url).");</script>";
        echo "<script>console.log('   - User ID: ' + ".json_encode($userId).");</script>";
        echo "<script>console.log('   - Password: [HIDDEN FOR SECURITY]');</script>";
        
        // Validate inputs
        if (empty($url) || empty($userId) || empty($password)) {
            echo "<script>console.log('2. Validation Failed: All fields are required!');</script>";
            echo "<script>alert('⚠️ All fields are required!'); window.location.href='".site_url('storewebsite')."';</script>";
            return;
        }
        echo "<script>console.log('2. Validation Passed: All fields are present');</script>";
        
        // Create cookie file
        $cookie_file = tempnam(sys_get_temp_dir(), 'cookie');
        echo "<script>console.log('3. Created temporary cookie file at: ' + ".json_encode($cookie_file).");</script>";
        
        // Initialize cURL
        $ch = curl_init();
        echo "<script>console.log('4. cURL session initialized');</script>";
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'username' => $userId,
            'password' => $password
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        
        echo "<script>console.log('5. cURL options set:');</script>";
        echo "<script>console.log('   - Target URL: ' + ".json_encode($url).");</script>";
        echo "<script>console.log('   - POST data: username=' + ".json_encode($userId)." + '&password=[HIDDEN]');</script>";
        echo "<script>console.log('   - Following redirects: true');</script>";
        echo "<script>console.log('   - Using cookie file: ' + ".json_encode($cookie_file).");</script>";
        
        // SSL settings
        if ($this->isLiveServer()) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            echo "<script>console.log('6. SSL verification ENABLED (production server)');</script>";
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            echo "<script>console.log('6. SSL verification DISABLED (local server)');</script>";
        }
        
        // Execute cURL request
        echo "<script>console.log('7. Sending login request to server...');</script>";
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            echo "<script>console.log('8. cURL ERROR: ' + ".json_encode($error_msg).");</script>";
            curl_close($ch);
            echo "<script>alert('⚠️ cURL Error: ".addslashes($error_msg)."'); window.location.href='".site_url('storewebsite')."';</script>";
            return;
        }
        echo "<script>console.log('8. Request completed successfully');</script>";
        
        // Get response info
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        
        echo "<script>console.log('9. Response details:');</script>";
        echo "<script>console.log('   - HTTP Status Code: ' + ".json_encode($httpCode).");</script>";
        echo "<script>console.log('   - Final URL after redirects: ' + ".json_encode($final_url).");</script>";
        
        // Clean up cookie file
        if (file_exists($cookie_file)) {
            unlink($cookie_file);
            echo "<script>console.log('10. Temporary cookie file deleted');</script>";
        }
        
        // Check if login was successful
        if (!empty($final_url) && $httpCode < 400) {
            echo "<script>console.log('11. Login SUCCESS - Redirecting to target page');</script>";
            echo "<script>
                console.log('12. Attempting to open new tab with the final URL');
                var newWindow = window.open('about:blank', '_blank');
                if (newWindow) {
                    newWindow.location.href = '$final_url';
                    console.log('13. New tab successfully opened with the final URL');
                } else {
                    console.log('13. Popup blocked - Falling back to same tab');
                    alert('Please allow popups for this site');
                    window.location.href = '$final_url';
                }
            </script>";
        } else {
            echo "<script>console.log('11. Login FAILED - Invalid credentials or server error');</script>";
            echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('storewebsite')."';</script>";
        }
        
        echo "<script>console.log('=== AUTO LOGIN PROCESS COMPLETED ===');</script>";
    }
    
    private function isLiveServer() {
        $isLive = ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != '127.0.0.1');
        echo "<script>console.log('Server check: Is live server? ' + ".json_encode($isLive ? 'Yes' : 'No').");</script>";
        return $isLive;
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
