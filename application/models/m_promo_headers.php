<?php
class m_promo_headers extends CI_Model{

	public $slider_lastId = "";

	function setSliderLastId($id){
		$this->slider_lastId = $id;
	}

	function getSliderLastId(){
		return $this->slider_lastId;
	}

	function updateheaderpath($path,$id){
		$this->db->set('header_path',$path);
		$this->db->where('id_header', $id);
		if($this->db->update('promo_header')){
			return true;
		}
		return false;
	}

	function delete($id){
		if($this->db->delete('promo_header', array('id_header' => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_header', $id);
		if($this->db->update('promo_header')){
			return true;
		}
		return false;
	}

	function select($id){
		$this->db->select("*");
		$this->db->from("promo_header");

		if(!empty($id)){
			$this->db->where("id_header", $id);
		}

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("promo_header", $data)){
			$insert_id = $this->db->insert_id();
			$this->setSliderLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>