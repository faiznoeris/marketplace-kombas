<?php
class M_stok_notification extends CI_Model{

	function select($product,$user){
		$this->db->select("*");
		$this->db->from("stock_notification");
		$this->db->where("id_product", $product);
		$this->db->where('id_user', $user);

		return $this->db->get();
	}

	function selectWthProd($product){
		$this->db->select("*");
		$this->db->from("stock_notification");
		$this->db->where("id_product", $product);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("stock_notification", $data)){
			return true;
		}

		return false;
	}

	function update($idproduct, $iduser, $data){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		//$this->db->set($data);
		$this->db->where('id_product', $idproduct);
		$this->db->where('id_user', $iduser);
		if($this->db->update('stock_notification')){
			return true;
		}
		return false;
	}

	function delete($id_product, $id_user) {
		if($this->db->delete('stock_notification', array('id_product' => $id_product, 'id_user' => $id_user))){
			return true;
		}
		return false;
	}

}
?>