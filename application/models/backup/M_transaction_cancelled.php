<?php
class M_transaction_cancelled extends CI_Model{


	public $trans_lastId = "";

	function setTransLastId($id){
		$this->trans_lastId = $id;
	}

	function getTransLastId(){
		return $this->trans_lastId;
	}


	function delete($id){
		if($this->db->delete('transaction_cancelled', array('id_transaction' => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_transaction', $id);
		if($this->db->update('transaction_cancelled')){

			return true;
		}
		return false;
	}

	function getall(){
		$this->db->select("*");
		$this->db->from("transaction_cancelled");

		return $this->db->get();
	}

	function select($id){
		$this->db->select("*");
		$this->db->from("transaction_cancelled");
		$this->db->where('id_user',$id);	

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("transaction_cancelled", $data)){
			$insert_id = $this->db->insert_id();
			$this->setTransLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>