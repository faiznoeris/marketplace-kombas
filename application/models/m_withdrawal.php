<?php
class M_withdrawal extends CI_Model{

	function delete($whatid,$id){
		if($this->db->delete('withdrawal', array('id_'.$whatid => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_withdraw', $id);
		if($this->db->update('withdrawal')){

			return true;
		}
		return false;
	}

	function select($whatid, $id){
		$this->db->select("*");
		$this->db->from("withdrawal");
		if(!empty($whatid)){
			$this->db->where("id_".$whatid,$id);	
		}
		

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("withdrawal", $data)){
			return true;
		}

		return false;
	}
}
?>