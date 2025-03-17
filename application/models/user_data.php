<?php
class User_data extends CI_Model {

		public function store($data){
			$this->db->insert('users',$data);
			return true;
		}
}
?>
