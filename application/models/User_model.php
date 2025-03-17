<?php 
	class User_model extends CI_Model{
		public function store($data){
			$this->db->insert('user',$data);
			return true;
		}

		public function getUser($email){
			return $this->db->where('email',$email)->get('user')->row();
		}

		public function changeUserPassword($id,$new_password){
			$this->db->set('password',$new_password)->where('id',$id)->update('user');
		
		}

		public function oldPasswordMatches($id,$old_password){
			$query = $this->db->where('id',$id)->where('password',$old_password)->get('user');
			if($query->num_rows()>0){
				return true;
			}
			return false;
		}

		public function getUserByEmail($email){
			return $this->db->where('email',$email)->get('user')->row();
		}
		
		//Suggestion Data
		public function insert_suggestion($data) {
			return $this->db->insert('suggestions', $data);
		}
	}

	
	
?>