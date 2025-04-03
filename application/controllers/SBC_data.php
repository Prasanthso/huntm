<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SBC_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerRegister_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function sbc_data() {
        // Sample data - you might want to fetch this from your model/database
        $pmuy_qty = 100;
        $non_pmuy_qty = 50;
        $total_qty = $pmuy_qty + $non_pmuy_qty;
        
        // Calculate percentages
        $pmuy_percentage = ($total_qty > 0) ? number_format(($pmuy_qty / $total_qty) * 100, 2) . '%' : '0%';
        $non_pmuy_percentage = ($total_qty > 0) ? number_format(($non_pmuy_qty / $total_qty) * 100, 2) . '%' : '0%';
        $total_percentage = '100%';

        $data['sbc_data'] = array(
            'pmuy_qty' => $pmuy_qty,
            'non_pmuy_qty' => $non_pmuy_qty,
            'total_qty' => $total_qty,
            'pmuy_percentage' => $pmuy_percentage,
            'non_pmuy_percentage' => $non_pmuy_percentage,
            'total_percentage' => $total_percentage
        );

        $this->load->view('SBC_data_view', $data);
    }

    public function send_sms($customer_name = '') {
        if (empty($customer_name)) {
            $response = array('status' => 'error', 'message' => 'Customer name is required');
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Here you would implement actual SMS sending logic
        // Example: using a third-party SMS gateway
        /*
        $sms_api = new SMS_API(); // Hypothetical SMS service
        $result = $sms_api->send($customer_name, "Your message here");
        */

        $response = array(
            'status' => 'success',
            'message' => 'SMS sent successfully to ' . htmlspecialchars($customer_name)
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function send_whatsapp($customer_name = '') {
        if (empty($customer_name)) {
            $response = array('status' => 'error', 'message' => 'Customer name is required'); // Fixed quote syntax
            $this->output->set_content_type('application/json')->set_output(json_encode($response)); // Fixed missing quote
            return;
        }

        // Here you would implement actual WhatsApp sending logic
        // Example: using WhatsApp Business API
        /*
        $whatsapp_api = new WhatsApp_API(); // Hypothetical WhatsApp service
        $result = $whatsapp_api->send($customer_name, "Your message here");
        */

        $response = array(
            'status' => 'success',
            'message' => 'WhatsApp message sent successfully to ' . htmlspecialchars($customer_name)
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function send_voice($customer_name = '') {
        if (empty($customer_name)) {
            $response = array('status' => 'error', 'message' => 'Customer name is required');
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Here you would implement actual voice call logic
        // Example: using a telephony service
        /*
        $voice_api = new Voice_API(); // Hypothetical voice service
        $result = $voice_api->call($customer_name);
        */

        $response = array(
            'status' => 'success',
            'message' => 'Voice call initiated to ' . htmlspecialchars($customer_name)
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}