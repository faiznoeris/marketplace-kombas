<?php
class m_products extends CI_Model{

	public $prod_lastId = "";

	function setProdLastId($id){
		$this->prod_lastId = $id;
	}

	function getProdLastId(){
		return $this->prod_lastId;
	}




	function updatesampulpath($path,$id){
		$this->db->set('sampul_path',$path);
		$this->db->where('id_product', $id);
		if($this->db->update('products')){
			return true;
		}
		return false;
	}


	function delete($id_product){
		if($this->db->delete('products', array('id_product' => $id_product))){
			return true;
		}
		return false;
	}

	function edit($id){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("id_product",$id);

		return $this->db->get();
	}



	function getproduct($id){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("id_product",$id);

		return $this->db->get();
	}

	

	// function select($id_user) {
	function select(){
		$this->db->select("*");
		$this->db->from("products");
		// $this->db->where("id_user",$id_user);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("products", $data)){
			$insert_id = $this->db->insert_id();
			$this->setProdLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>