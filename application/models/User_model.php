<?php
class User_model extends CI_Model {
    public function store($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }


    public function getUser($email) {
        return $this->db->where('email', $email)->get('user')->row();
    }


    // public function oldPasswordMatches($id, $old_password) {
    //     $query = $this->db->where('id', $id)
    //                      ->where('password', $old_password)
    //                      ->get('user');
    //     return $query->num_rows() > 0;
    // }

     public function oldPasswordMatches($id, $old_password_unhashed) {
        $user = $this->db->where('userID', $id)->get('user')->row(); // Assuming 'userID' is the user ID column

        if ($user && password_verify($old_password_unhashed, $user->Password)) { // Assuming 'Password' is the hashed password column
            return TRUE;
        }
        return FALSE;
    }


    public function getUserByEmail($email) {
        return $this->db->where('email', $email)->get('user')->row();
    }


    public function getUserByEmailOrUserID($input) {
        return $this->db->where('Email', $input)
                    // ->or_where('userID', $input)
                    ->get('user')
                    ->row();
}


    public function getUserById($id) {
        return $this->db->where('userID', $id)->get('user')->row();
    }

    public function get_staff_data_by_id($staff_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $staff_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    public function update_staff_data($staff_id, $data) {
        $this->db->where('id', $staff_id);
        $this->db->update('user', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            log_message('error', 'Update failed: ' . $this->db->last_query() . ' | Error: ' . json_encode($this->db->error()));
            return FALSE;
        }
    }
    // public function updatePassword($user_id, $password) {
    //     return $this->db->where('id', $user_id)
    //                    ->update('user', ['password' => $password]);
    // }

     public function updatePassword($user_id, $new_password_unhashed) {
        $hashed_password = password_hash($new_password_unhashed, PASSWORD_DEFAULT);
        return $this->db->where('userID', $user_id) // Assuming 'userID' is the user ID column
                        ->update('user', ['Password' => $hashed_password]); // Assuming 'Password' is the password column
    }


    public function insert_suggestion($data) {
        return $this->db->insert('suggestions', $data);
    }

    public function store_otp($user_id, $otp) {
        $data = [
            'otp_code' => $otp,
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+15 minutes')) // OTP valid for 15 minutes
        ];
        // Ensure 'id' is the primary key column for the user table
        return $this->db->where('id', $user_id)->update('user', $data);
    }

     public function verify_otp($user_id, $otp) {
        $current_time = date('Y-m-d H:i:s');
        $query = $this->db->where('id', $user_id)
                          ->where('otp_code', $otp)
                          ->where('otp_expires_at >', $current_time)
                          ->get('user');
        return $query->row();
    }

     public function clear_otp($user_id) {
        $data = [
            'otp_code' => NULL,
            'otp_expires_at' => NULL
        ];
        return $this->db->where('id', $user_id)->update('user', $data);
    }
}
