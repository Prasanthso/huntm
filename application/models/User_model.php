<?php 
	class User_model extends CI_Model{
		public function store($data){
			$this->db->insert('user',$data);
			return true;
		}

		public function getUser($email){
			return $this->db->where('email',$email)->get('user')->row();
		}

		// public function changeUserPassword($id,$new_password){
		// 	$this->db->set('password',$new_password)->where('id',$id)->update('user');
		
		// }

		public function oldPasswordMatches($id,$old_password){
			$query = $this->db->where('id',$id)->where('password',$old_password)->get('user');
			if($query->num_rows()>0){
				return true;
			}
			return false;
		}

		// public function getUserByEmail($email){
		// 	return $this->db->where('email',$email)->get('user')->row();
		// }

		 // Get user by email
		 public function getUserByEmail($email) {
			return $this->db->where('email', $email)->get('user')->row();
		}

		// Update user password
		public function changeUserPassword($user_id, $new_password) {
			$this->db->where('id', $user_id)->update('user', ['password' => $new_password]);
			return $this->db->affected_rows() > 0;
		}
		
		//Suggestion Data
		public function insert_suggestion($data) {
			return $this->db->insert('suggestions', $data);
		}
	}

	
	
?>