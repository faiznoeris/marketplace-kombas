<?php
class m_transaction_history extends CI_Model{


	public $trans_lastId = "";

	function setTransLastId($id){
		$this->trans_lastId = $id;
	}

	function getTransLastId(){
		return $this->trans_lastId;
	}


	function updatesampulpath($path,$id){
		$this->db->set('buktitrf_path',$path);
		$this->db->where('id_transaction', $id);
		if($this->db->update('transaction_history')){
			return true;
		}
		return false;
	}


	function delete($id){
		if($this->db->delete('transaction_history', array('id_transaction' => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_transaction', $id);
		if($this->db->update('transaction_history')){

			return true;
		}
		return false;
	}

	

	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("transaction_history");
		

		if($kondisi == "withproductdetails"){
			$this->db->where("transaction_history.id_user",$id);
			$this->db->join('products', 'products.id_product = transaction_history.id_product');
		// }else if($kondisi == "fortoko"){
		// 	$this->db->where("transaction_history.id_shop",$id);
		// 	$this->db->join('products', 'products.id_product = transaction_history.id_product');
		// }
		}else if($kondisi == "forbuktitrftoko"){
			$this->db->where("transaction_history.id_transaction",$id);
			$this->db->join('products', 'products.id_product = transaction_history.id_product');
			$this->db->join('users', 'users.id_user = transaction_history.id_user');
		}else if($kondisi == "orderdetails"){
			$this->db->where("transaction_history.id_transaction",$id);
		}else if($kondisi == "pembelianuser"){
			$this->db->where("transaction_history.id_user",$id);
		}else{
			$this->db->where("transaction_history.id_shop",$id);
		}

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("transaction_history", $data)){
			$insert_id = $this->db->insert_id();
			$this->setTransLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>