<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginIntoAnotherWebsite extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

   
    public function index()
    {
        $this->load->view('login_into_another_website'); // Load the login form
    }

    // Function to log in to the provided website
    public function login()
    {
        // Get input values from the form
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $login_url = $this->input->post('login_url');

        if (!$user_id || !$password || !$login_url) {
            echo "Please enter all required fields!";
            return;
        }

        // Store in session (optional)
        $this->session->set_userdata('user_id', $user_id);
        $this->session->set_userdata('password', $password);
        $this->session->set_userdata('login_url', $login_url);

        // POST Data
        $postData = [
            'username' => $user_id,
            'password' => $password
        ];

        // cURL setup
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $login_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); // Save session cookies
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

        $response = curl_exec($ch);
        curl_close($ch);

        // Redirect to the external website after login
        if ($response) {
            echo "<script>
                    alert('Login successful! Redirecting...');
                    window.open('$login_url', '_blank');
                  </script>";
        } else {
            echo "<script>alert('Login failed! Please check your credentials.'); window.history.back();</script>";
        }
    }
}
?>