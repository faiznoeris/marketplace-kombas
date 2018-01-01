<?php
class m_category extends CI_Model{

	public $cat_lastId = "";

	function setCatLastId($id){
		$this->cat_lastId = $id;
	}

	function getCatLastId(){
		return $this->cat_lastId;
	}



	function delete($id){
		if($this->db->delete('category', array('id_category' => $id))){
			return true;
		}
		return false;
	}

	function edit($id){
		$this->db->select("*");
		$this->db->from("category");
		$this->db->where("id_category",$id);

		return $this->db->get();
	}





	

	function select(){
		$this->db->select("*");
		$this->db->from("category");

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("category", $data)){
			$insert_id = $this->db->insert_id();
			$this->setCatLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>