<?php
class M_confirmation extends CI_Model{


	public $conf_lastId = "";

	function setConfLastId($id){
		$this->conf_lastId = $id;
	}

	function getConfLastId(){
		return $this->conf_lastId;
	}



	function updatebuktipath($path,$id){
		$this->db->set('bukti_path',$path);
		$this->db->where('id_confirmation', $id);
		if($this->db->update('confirmation')){
			return true;
		}
		return false;
	}


	function delete($id){
		if($this->db->delete('confirmation', array('id_confirmation' => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_confirmation', $id);
		if($this->db->update('confirmation')){

			return true;
		}
		return false;
	}	

	function select($id){
		$this->db->select("*");
		$this->db->from("confirmation");		
		$this->db->where("id_confirmation",$id);

		return $this->db->get();
	}

	function selectforadmin($id_transaction,$id_user){
		$this->db->select("*");
		$this->db->from("confirmation");		
		$this->db->where("id_transaction",$id_transaction);
		$this->db->where("id_user",$id_user);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("confirmation", $data)){
			$insert_id = $this->db->insert_id();
			$this->setConfLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>