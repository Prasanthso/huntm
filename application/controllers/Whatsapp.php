<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends CI_Controller {

    private $api_key;
    private $base_url;

    public function __construct() {
        parent::__construct();
        $this->load->model('Whatsapp_model');
        $this->load->library('session');

        // ✅ Authentication & Base URL
        $this->api_key  = "08fc4fffd6d31a01e1a180b7616d8e96790358b67adc064554fed640f91bccb7aa53f60b022e8adccb668554691d6ae8";
        $this->base_url = "https://api.talkingshops.com/v1";
    }

    // Load users
    public function index() {
        $data['users'] = $this->Whatsapp_model->get_users();
        $this->load->view('send_whatsapp', $data);
    }

    // Send free-form text message
    public function send_message() {
        $user_id = $this->input->post('user_id');
        $user = $this->Whatsapp_model->get_user_by_id($user_id);

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('whatsapp');
        }

        $recipient = $user['phone']; // number with country code

        // ✅ TalkingShops text message endpoint
        $url = $this->base_url . "/messages/text";

        // ✅ Payload for free-form text
        $payload = [
            "recipient" => $recipient,
            "message"   => "Hello " . $user['name'] . ", this is a test message from TalkingShops API."
        ];

        // 🔥 CURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "x-tenant-api-key: {$this->api_key}"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $api_response = json_decode($response, true);

        // ✅ Save to DB if success
        if (isset($api_response['message_id'])) {
            $data_insert = [
                'user_id'    => $user['id'],
                'message_id' => $api_response['message_id'],
                'status'     => isset($api_response['status']) ? $api_response['status'] : 'queued',
                'sent_at'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('whatsapp_messages', $data_insert);
        }

        // ✅ Show response
        if (in_array($httpcode, [200,201,202])) {
            $this->session->set_flashdata('success', 'Message sent successfully. Name: ' . $user['name']);
        } else {
            $this->session->set_flashdata('error', 'Failed to send message: ' . $response);
        }

        redirect('whatsapp');
    }
}
