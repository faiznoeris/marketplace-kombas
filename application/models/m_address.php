<?php
class M_address extends CI_Model{

	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("address");
		$this->db->where("id_".$kondisi, $id);

		return $this->db->get();
	}

	function insert($data) {


		if($this->db->insert("address", $data)){
			return true;
		}

		return false;
	}

	function update($id_address, $data){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		//$this->db->set($data);
		$this->db->where('id_address', $id_address);
		if($this->db->update('address')){
			return true;
		}
		return false;
	}

	function delete($id) {
		if($this->db->delete('address', array('id_address' => $id))){
			return true;
		}
		return false;
	}

}
?>