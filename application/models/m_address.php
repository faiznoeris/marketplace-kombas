<?php
class m_address extends CI_Model{

	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("alamat");
		$this->db->where("id_".$kondisi, $id);

		return $this->db->get();
	}

	function insert($data) {


		if($this->db->insert("alamat", $data)){
			return true;
		}

		return false;
	}

	function update($id_alamat, $data){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		//$this->db->set($data);
		$this->db->where('id_alamat', $id_alamat);
		if($this->db->update('alamat')){
			return true;
		}
		return false;
	}

	function delete($id) {
		if($this->db->delete('alamat', array('id_alamat' => $id))){
			return true;
		}
		return false;
	}

}
?>