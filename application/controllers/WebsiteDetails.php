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
                'user_id' => $loggeduserid
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
    public function auto_login() {
        $url = $this->input->post('url');
        $userId = $this->input->post('userId');
        $password = $this->input->post('password');

        $cookie_file = tempnam(sys_get_temp_dir(), 'cookie'); // Store cookies

        // Initialize cURL session
        $ch = curl_init();
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

        $response = curl_exec($ch);
        $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // Get final redirected URL
        curl_close($ch);

        // Open login page in a new tab using JavaScript
        if (!empty($final_url)) {
            echo "<script>window.open('$final_url');</script>";
        } else {
            echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('storewebsite')."';</script>";
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
