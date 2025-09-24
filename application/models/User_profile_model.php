<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_profile_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data)
    {
        $role = $data['role'];
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        switch ($role) {
            case 'admin':
                $table = 'admin';
                break;
            case 'distributor':
                $table = 'distributor';
                break;
            case 'staff':
                $table = 'user'; 
                break;
            default:
                error_log("Invalid role provided: $role");
                return false;
        }

        if ($this->email_exists($data['email'])) {
            error_log("Email already exists: {$data['email']}");
            return false;
        }

        $result = $this->db->insert($table, $data);
        if ($result) {
            error_log("User inserted successfully into $table: {$data['email']}");
            return $this->db->insert_id();
        }
        error_log("Failed to insert user into $table: " . $this->db->error()['message']);
        return false;
    }

    public function email_exists($email)
    {
        $tables = ['admin', 'distributor', 'user'];
        foreach ($tables as $table) {
            $this->db->where('email', $email);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                error_log("Email found in $table: $email");
                return true;
            }
        }
        error_log("Email not found in any table: $email");
        return false;
    }

    public function validate_email($email, $password)
{
    $tables = [
        'admin' => 'admin',
        'distributor' => 'distributor',
        'staff' => 'user'
    ];

    foreach ($tables as $role => $table) {
        $this->db->where('email', $email);
        $query = $this->db->get($table);

        error_log("Login query for $table: " . $this->db->last_query());

        if ($query->num_rows() > 0) {
            $user = $query->row();
            error_log("User found in $table: " . print_r($user, true));
            
            if (isset($user->password) && (strpos($user->password, '$2y$') === 0 || strpos($user->password, '$2a$') === 0)) {
                if (password_verify($password, $user->password)) {
                    // Add role to user object if not already set
                    if (!isset($user->role)) {
                        $user->role = $role;
                        error_log("Role not set in DB, assigned: $role");
                    }
                    error_log("Login successful for $email in $table");
                    return $user;
                } else {
                    error_log("Password verification failed for $email in $table");
                }
            } else {
                error_log("Invalid password format for $email in $table (not hashed)");
            }
        }
    }
    
    error_log("No user found for $email in any table");
    return false;
}

public function get_user_by_email($email) {
        $tables = ['admin', 'distributor', 'user'];
        foreach ($tables as $table) {
            $this->db->where('email', $email);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }
        return false;
    }

    public function update_password($email, $hashed_pass)
    {
        $tables = ['admin', 'distributor', 'user'];

        foreach ($tables as $table) {
            $this->db->where('email', $email);
            $this->db->set('password', $hashed_pass);
            $this->db->update($table);

            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }

        return false; 
    }


    public function get_user_email()
    {
        return $this->session->tempdata('reset_email');
    }


}