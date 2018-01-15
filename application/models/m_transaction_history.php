<?php
class m_transaction_history extends CI_Model{


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
		}else if($kondisi == "fortoko"){
			$this->db->where("transaction_history.id_toko",$id);
			$this->db->join('products', 'products.id_product = transaction_history.id_product');
		}else if($kondisi == "forbuktitrftoko"){
			$this->db->where("transaction_history.id_transaction",$id);
			$this->db->join('products', 'products.id_product = transaction_history.id_product');
			$this->db->join('users', 'users.id_user = transaction_history.id_user');
		}else{
			$this->db->where("transaction_history.id_toko",$id);
		}

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("transaction_history", $data)){
			return true;
		}

		return false;
	}
}
?>