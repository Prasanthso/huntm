<?php 
class User_model extends CI_Model {
    public function store($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function getUser($email) {
        return $this->db->where('email', $email)->get('user')->row();
    }

    public function oldPasswordMatches($id, $old_password) {
        $query = $this->db->where('id', $id)
                         ->where('password', $old_password)
                         ->get('user');
        return $query->num_rows() > 0;
    }

    public function getUserByEmail($email) {
        return $this->db->where('email', $email)->get('user')->row();
    }

    public function getUserById($id) {
        return $this->db->where('id', $id)->get('user')->row();
    }

    public function updatePassword($user_id, $password) {
        return $this->db->where('id', $user_id)
                       ->update('user', ['password' => $password]);
    }

    public function insert_suggestion($data) {
        return $this->db->insert('suggestions', $data);
    }
}