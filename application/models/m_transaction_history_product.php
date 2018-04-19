<?php
class M_transaction_history_product extends CI_Model{

	function insert($data) {

		if($this->db->insert("transaction_history_product", $data)){
			return true;
		}

		return false;
	}

	function delete($id,$id2){
		if($this->db->delete('transaction_history_product', array('id_transaction' => $id, 'id_shop' => $id2))){
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

	function select3($id_trans){
		$this->db->select("*");
		$this->db->from("transaction_history_product");
		$this->db->where("id_transaction",$id_trans);
		// $this->db->limit(3);  
		return $this->db->get();		
	}

}
?>