<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmindashboard_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function validate_email($email,$password){
        $this->db->where('email', $email);
        $query = $this->db->get('super_admin');

        if ($query->num_rows() == 1) {
            $user = $query->row();

            if (password_verify($password, $user->password)) {
                return $user; 
            }
        }
        return false; 
    }
    public function get_superadmin_data(){
        $row = $this->db->select('full_name, price_per_message')->get('super_admin')->row();
        if (!$row) {
            // Return default object to prevent undefined property
            return (object)[
                'full_name' => '',
                'price_per_message' => 0
            ];
        }
        return $row;
    }
    public function create_admin($admin_data) {
        return $this->db->insert('admin', $admin_data);
    }

    public function get_admin_data(){
        $this->db->select('*');
        $this->db->from('admin');
        // $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    public function get_admin($admin_id) {
        $this->db->where('id', $admin_id);
        $query = $this->db->get('admin');
        return $query->row();
    }

    public function count_distributors_created_by($admin_id) {
        $this->db->where('created_by', $admin_id);
        return $this->db->count_all_results('distributor');
    }

    public function get_remaining_admin_data($user_id) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    
    public function delete_admin($admin_id) {
        $this->db->where('id', $admin_id);
        return $this->db->delete('admin');
    }

    public function get_distributor_data(){
        $this->db->select('*');
        $this->db->from('distributor');
        // $this->db->where('id', $distributor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_remaining_distributor_data($distributor_id) {
        $this->db->select('*');
        $this->db->from('distributor'); // replace with your actual distributor table name
        $this->db->where('id', $distributor_id);
        $query = $this->db->get();

        return $query->result(); // returns array of distributor objects
    }
    public function delete_distributor($distributor_id) {
        $this->db->where('id', $distributor_id);
        return $this->db->delete('distributor');
    }
    public function get_staff_data() {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_remaining_staff_data($staff_id) {
        $this->db->select('*');
        $this->db->from('user'); 
        $this->db->where('id', $staff_id);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function delete_staff($staff_id) {
        $this->db->where('id', $staff_id);
        return $this->db->delete('user');
    }
    
    public function get_distributor_limits($admin_id)
    {
        $this->db->select('id, full_name, email, role, distributor_limit');
        $this->db->from('admin');
        $this->db->where('created_by_super_admin', $admin_id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    public function update_distributor_limit($distributor_id, $distributor_limit)
    {
        $this->db->where('id', $distributor_id);
        $this->db->update('admin', ['distributor_limit' => $distributor_limit]);

        return $this->db->affected_rows() >= 0;
    }

    public function add_amount($client_data) {
        return $this->db->insert('amount_transactions', $client_data);
    }
    
    public function get_all_transactions() {
        $query = $this->db->order_by('id', 'DESC')->get('amount_transactions');
        return $query->result_array();
    }

    // Get all credited amounts with date
    public function get_credited_amounts() {
        $this->db->order_by('credited_at', 'ASC');
        return $this->db->get('amount_transactions')->result();
    }

    // Get daily pricing summary
    public function get_daily_pricing_summary() {
        $price_per_message = $this->get_price_per_message();

        $this->db->select("DATE(sent_at) as date, COUNT(id) as total_messages");
        $this->db->from('whatsapp_messages');
        $this->db->group_by("DATE(sent_at)");
        $this->db->order_by("DATE(sent_at)", "ASC");
        $query = $this->db->get();
        $daily_data = $query->result();

        $credits = $this->get_credited_amounts();
        $balance = 0;
        $result = [];
        $credit_index = 0;

        foreach ($daily_data as $row) {
            $current_date = $row->date;
            $credited_today = 0;
            $credited_note = '';

            while (
                $credit_index < count($credits) &&
                date('Y-m-d', strtotime($credits[$credit_index]->credited_at)) <= $current_date
            ) {
                $credited_today += $credits[$credit_index]->amount;
                $balance += $credits[$credit_index]->amount;
                $credited_note .= '₹' . number_format($credits[$credit_index]->amount, 2) .
                    ' (' . date('d-m-Y', strtotime($credits[$credit_index]->credited_at)) . ') ';
                $credit_index++;
            }

            $row->price_per_message = $price_per_message;
            $row->total_cost = $row->total_messages * $price_per_message;

            $balance -= $row->total_cost;

            $row->credited_amount = $credited_today;
            $row->credited_note = $credited_note ?: '-';
            $row->available_balance = $balance;

            $result[] = $row;
        }

        return array_reverse($result);
    }

    // Get current price per message
    public function get_price_per_message() {
        $row = $this->db->select('price_per_message')->get('super_admin')->row();
        if (!$row || !isset($row->price_per_message)) {
            return 0;
        }
        return $row->price_per_message;
    }

    // Update price per message
    public function update_price_per_message($price) {
        return $this->db->update('super_admin', ['price_per_message' => $price]);
    }

    public function get_all_distributors() {
        $this->db->select('id, full_name,email,phone');
        $this->db->from('distributor'); 
        return $this->db->get()->result();
    }

}