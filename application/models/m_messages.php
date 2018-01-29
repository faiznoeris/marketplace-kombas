<?php
class m_messages extends CI_Model{

	function delete($whatid,$id){
		if($this->db->delete('messages', array('id_'.$whatid => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_msg', $id);
		if($this->db->update('messages')){

			return true;
		}
		return false;
	}

	function select($kondisi,$id,$id2){
		// $this->db->select("*");
		// $this->db->from("messages");

		// $this->db->where("id_sender",$id);
		// $this->db->or_where("id_receiver",$id2);

		// $this->db->group_by('id_receiver');
		// if(!empty($id2)){
		// 	$this->db->or_where("id_receiver",$id2);	
		// }else{
		// 	$this->db->group_by('id_receiver');
		// }
		

		// return $this->db->get();
		if($kondisi == "connection"){
			return $this->db->query("SELECT * FROM `messages` WHERE id_receiver = '".$id."' OR id_sender = '".$id."' GROUP BY id_receiver");
		}else if($kondisi == "connection-limited"){
			return $this->db->query("SELECT * FROM (SELECT id_receiver, MAX(date) AS date FROM messages WHERE id_receiver = '".$id."' OR id_sender = '".$id."' GROUP BY id_receiver) AS x JOIN messages USING (id_receiver, date) LIMIT 10");
		}else{
			return $this->db->query("SELECT * FROM `messages` WHERE (id_receiver = '".$id2."' OR id_receiver = '".$id."') AND (id_sender = '".$id2."' OR id_sender = '".$id."')");
		}
	}

	function insert($data) {

		if($this->db->insert("messages", $data)){
			return true;
		}

		return false;
	}
}
?>