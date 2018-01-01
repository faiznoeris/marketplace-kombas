<?php
class m_seller_pending_approval extends CI_Model{

	function update($id_user, $data){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}

		$this->db->where('id_user', $id_user);
		if($this->db->update('seller_pending_approval')){
			return true;
		}
		return false;
	}

	function select($kondisi,$id_user){

		$this->db->select("*,DATE_FORMAT(seller_pending_approval.date, '%d - %M - %Y') as date2");
		$this->db->from("seller_pending_approval");

		if($kondisi == "joinuser"){

			$this->db->join('users', 'seller_pending_approval.id_user = users.id_user');

			if($id_user != ""){
				$this->db->where("seller_pending_approval.id_user", $id_user);
			}

		}else{

			if($id_user != ""){
				$this->db->where("id_user", $id_user);
			}

		}

		
		return $this->db->get();

	}

	function insert($id_user) {
		
		$date = date('Y-m-d');

		$data = array(
			'id_user' => $id_user,
			'status' => 'Pending',
			'date' => $date
		);

		if($this->db->insert("seller_pending_approval", $data)){
			return true;
		}

		return false;
	}
}
?>