<?php
class m_transaction_history_product extends CI_Model{

	function insert($data) {

		if($this->db->insert("transaction_history_product", $data)){
			return true;
		}

		return false;
	}

	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("transaction_history_product");
		$this->db->where("id_".$kondisi,$id);

		return $this->db->get();
	}


	function select2($kondisi, $kondisi2, $id, $id2){
		$this->db->select("*");
		$this->db->from("transaction_history_product");
		$this->db->where("id_".$kondisi,$id);
		$this->db->where("id_".$kondisi2,$id2);

		return $this->db->get();
	}

}
?>