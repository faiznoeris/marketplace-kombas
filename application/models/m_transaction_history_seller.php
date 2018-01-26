<?php
class m_transaction_history_seller extends CI_Model{

	function insert($data) {

		if($this->db->insert("transaction_history_seller", $data)){
			return true;
		}

		return false;
	}

	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("transaction_history_seller");
		$this->db->where("id_".$kondisi,$id);

		return $this->db->get();
	}

	function select2($kondisi,$kondisi2,$id,$id2){
		$this->db->select("*");
		$this->db->from("transaction_history_seller");
		$this->db->where("id_".$kondisi,$id);
		$this->db->where("id_".$kondisi2,$id2);

		return $this->db->get();
	}

	function edit($data, $id, $id2){
		$this->db->set($data);
		$this->db->where('id_transaction', $id);
		$this->db->where('id_shop', $id2);
		if($this->db->update('transaction_history_seller')){

			return true;
		}
		return false;
	}


}
?>