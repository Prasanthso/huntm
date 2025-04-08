<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_login_model extends CI_Model {

    public function login($data) {
        $url = $data['url']; // Login endpoint
        $userId = $data['userId'];
        $password = $data['password'];

        // Prepare data to send via POST
        $postData = [
            'username' => $userId,      // Change to actual field names expected by the login endpoint
            'password' => $password
        ];

        // Initialize cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Optional: store cookies in a file if session is needed
        curl_setopt($ch, CURLOPT_COOKIEJAR, FCPATH . 'cookies.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, FCPATH . 'cookies.txt');

        // Execute the request
        $response = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            log_message('error', 'Auto login failed: ' . $error);
        } else {
            log_message('debug', 'Auto login response: ' . $response);
        }
    }
}
