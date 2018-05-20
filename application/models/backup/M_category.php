<?php
class M_category extends CI_Model{

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

	function edit($data,$id){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		$this->db->where('id_category', $id);
		if($this->db->update('category')){
			return true;
		}
		return false;
	}



	function get($id){
		$this->db->select("*");
		$this->db->from("category");
		$this->db->where("id_category",$id);

		return $this->db->get();
	}


	function get_name($name){
		$this->db->select("*");
		$this->db->from("category");
		$this->db->where("nama_category",$name);
		$this->db->limit(1);

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