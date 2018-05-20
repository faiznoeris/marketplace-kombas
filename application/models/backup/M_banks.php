<?php
class M_banks extends CI_Model{

	public $bank_lastId = "";

	function setbankLastId($id){
		$this->bank_lastId = $id;
	}

	function getbankLastId(){
		return $this->bank_lastId;
	}



	function delete($id){
		if($this->db->delete('banks', array('id_bank' => $id))){
			return true;
		}
		return false;
	}

	function edit($data,$id){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		$this->db->where('id_bank', $id);
		if($this->db->update('banks')){
			return true;
		}
		return false;
	}



	function get($id){
		$this->db->select("*");
		$this->db->from("banks");
		$this->db->where("id_bank",$id);

		return $this->db->get();
	}

	

	function select(){
		$this->db->select("*");
		$this->db->from("banks");

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("banks", $data)){
			$insert_id = $this->db->insert_id();
			$this->setbankLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>