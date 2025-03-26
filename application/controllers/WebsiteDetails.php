<!-- <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WebsiteModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->database();
    }

    // Display form and websites list
    public function index() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];
        $this->load->view('add_website', $data);
    }

    // Store website login details in the database
    public function store() {
        $data['users'] = $this->WebsiteModel->get_users();
        $data['errors'] = [];

        $url = trim($this->input->post('url'));
        $userId = trim($this->input->post('userId'));
        $password = trim($this->input->post('password'));
        $user_id = trim($this->input->post('user_id'));

        // Ensure URL starts with http:// or https://
        if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }

        // Manual validation
        if (empty($url)) $data['errors']['url'] = 'Website URL is required.';
        if (empty($userId)) $data['errors']['userId'] = 'Username is required.';
        if (empty($password)) $data['errors']['password'] = 'Password is required.';
        if (empty($user_id)) $data['errors']['user_id'] = 'Please select a user.';

        if (!empty($data['errors'])) {
            $this->load->view('add_website', $data);
        } else {
            // $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Store hashed password

            $insert_data = [
                'website_userId' => $userId,
                'website_password' => $password,
                'website_url' => $url,
                'user_id' => $user_id
            ];

            if ($this->WebsiteModel->insert_website($insert_data)) {
                $this->session->set_flashdata('success', 'Website added successfully!');
                redirect('WebsiteController/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Failed to add website.');
                redirect('WebsiteController/index');
            }
        }
    }

    // Show dashboard with saved websites
    public function dashboard() {
        $data['websites'] = $this->WebsiteModel->get_all_websites();
        $date['method'] = 'store_website';
        $this->load->view('dashboard_view', $data);
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
            echo "<script>alert('⚠️ Login failed. Please check your credentials!'); window.location.href='".site_url('WebsiteController/dashboard')."';</script>";
        }
    }

    public function websitedashboard() {
        $this->load->view('website_dashboard');
    }

    public function store_website() {
        $this->load->model('WebsiteModel'); 
        $data['websites'] = $this->WebsiteModel->get_all_websites();
    
        $this->load->view('store_website', $data); // Only load the table, not the full page
    }
}
?> -->
