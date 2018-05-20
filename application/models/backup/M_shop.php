<?php
class M_shop extends CI_Model{

	function delete($whatid,$id){
		if($this->db->delete('shops', array('id_'.$whatid => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_shop', $id);
		if($this->db->update('shops')){

			return true;
		}
		return false;
	}

	

	function select($id){
		$this->db->select("*");
		$this->db->from("shops");
		$this->db->where("id_user",$id);

		return $this->db->get();
	}


	function selectidshop($id){
		$this->db->select("*");
		$this->db->from("shops");
		$this->db->where("id_shop",$id);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("shops", $data)){
			return true;
		}

		return false;
	}
}
?>