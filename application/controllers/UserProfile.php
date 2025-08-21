<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserProfile extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->model('User_model'); //load model here
        $this->load->model('WebsiteModel');
        $this->load->database();
    }


   
    // FOR THIS SIGN UP
        public function signupform() {
            $this->load->view('signup_form'); //this is my signup page view
        }


   //this is register submit form    
   public function submit() {
    $data = $this->input->post();
    $errors = [];


    // Validation rules
    if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address';
    }


    if (empty($data['firstname'])) {
        $errors['firstname'] = 'Firstname is required';
    }


    if (empty($data['lastname'])) {
        $errors['lastname'] = 'Lastname is required';
    }


    if (empty($data['phone'])) {
        $errors['phone'] = 'Phone number is required';
    } elseif (!is_numeric($data['phone'])) {
        $errors['phone'] = 'Enter a valid phone number';
    }

    if (empty($data['sap_code'])) {
        $errors['sap_code'] = 'SAP Code is required';
    } 

    if (empty($data['bank_details'])) {
        $errors['bank_details'] = 'Bank Details is required';
    } 


    if (empty($data['userID'])) {
        $errors['userID'] = 'UserID is required';
    } elseif (!preg_match('/^\d{10}_\d{2}$/', $data['userID'])) {
        $errors['userID'] = 'UserID must be in format 0000000000_00 (10 digits, underscore, 2 digits)';
    }


    if (empty($data['password'])) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($data['password']) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long';
    }


    if (empty($data['role'])) {
        $errors['role'] = 'Role is required';
    }


    if (empty($data['address'])) {
        $errors['address'] = 'Address is required';
    }


    if (empty($data['pincode'])) {
        $errors['pincode'] = 'Pincode is required';
    } elseif (!is_numeric($data['pincode'])) {
        $errors['pincode'] = 'Enter a valid Pincode';
    }


    if (empty($data['city'])) {
        $errors['city'] = 'City is required';
    }


    if (empty($data['officemaplink'])) {
        $errors['officemaplink'] = 'Office map link is required';
    }


    if (empty($data['officenumber'])) {
        $errors['officenumber'] = 'Office mobile number is required';
    } elseif (!is_numeric($data['officenumber'])) {
        $errors['officenumber'] = 'Enter a valid office mobile number';
    }


    if (!empty($errors)) {
        $this->session->set_flashdata('errors', $errors);
        $this->session->set_flashdata('old_data', $data);
        redirect('signup');
        return;
    }


    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);


    $response = $this->User_model->store($data);


    if ($response) {
        $this->session->set_flashdata('success', 'Registration successful! You can now login.');
        redirect('loginform');
    } else {
        $this->session->set_flashdata('error', 'Registration failed. Please try again.');
        $this->session->set_flashdata('old_data', $data);
        redirect('signup');
    }
}






}
?>
