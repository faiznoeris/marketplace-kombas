<?php
class M_user_level extends CI_Model{

	function select($id){
		$this->db->select("*");
		$this->db->from("user_level");
		$this->db->where("id_userlevel",$id);

		return $this->db->get();
	}


}
?>