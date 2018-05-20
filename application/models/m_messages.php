<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Messages extends CI_Model{

	function get_lastmsg(){
		return $this->db
		->order_by('id_msg', 'DESC')
		->limit(1)
		->get('messages');
	}

	function send_msg($input, $id_receiver, $id_sender, $id_convo, $user_level){
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');

		if($user_lvl != "1" || $user_lvl != "2"){
			if(!empty($input)){

				if($id_convo == "new"){
					$id_before = $this->get_lastmsg()->row()->id_convo; //check last convo id in table to avoid duplicate convo id
					$id_convo = "CID-".rand(999,999999); //create new convo id

					while($id_convo == $id_before){ //if convo id already exist, make new one
						$id_convo = "CID-".rand(999,999999);
					}
				}

				$data = array(
					'id_receiver' => $id_receiver,
					'id_user' => $id_sender,
					'id_convo' => $id_convo,
					'date' => $date,
					'msg' => $input['message']
				);

				if($this->db->insert('messages', $data)){
					return "success";
				}else{
					return $this->db->_error_message();
				}

			}else{
				return "empty_data";
			}
		}else{
			return "is_admin";
		}
	}



















	function delete($whatid,$id){
		if($this->db->delete('messages', array('id_'.$whatid => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id, $id2){
		$this->db->set($data);
		$this->db->where('id_msg', $id);
		$this->db->where('id_receiver', $id2);
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
			return $this->db->query("SELECT * FROM `messages` WHERE id_receiver = '".$id."' OR id_user = '".$id."' GROUP BY id_receiver");
		}else if($kondisi == "connection-limited"){
			return $this->db->query("SELECT m1.*,DATE_FORMAT(m1.date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(m1.date, '%H:%i') AS time FROM messages AS m1 LEFT JOIN messages AS m2 ON (m1.id_convo = m2.id_convo AND m1.id_msg < m2.id_msg) WHERE m2.id_msg IS NULL AND (m1.id_receiver = '".$id."' OR m1.id_user = '".$id."') ORDER by date DESC LIMIT 10");
		}else if($kondisi == "checknewmsg"){
			return $this->db->query("SELECT * FROM messages WHERE id_receiver = '".$id."' AND viewed = '0' ORDER BY date DESC LIMIT 1");
		}else if($kondisi == "countmsg"){
			return $this->db->query("SELECT * FROM messages WHERE id_convo = '".$id."' AND id_receiver = '".$id2."' AND viewed = '0' ORDER BY date DESC");
		}else if($kondisi == "convo"){
			return $this->db->query("SELECT *,DATE_FORMAT(date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(date, '%H:%i') AS time FROM messages WHERE id_convo = '".$id."' ORDER BY date ASC");
		}else if($kondisi == "lastmsgintable"){
			return $this->db->query("SELECT * FROM messages ORDER BY id_msg DESC LIMIT 1");
		}else{
			return $this->db->query("SELECT m1.*,DATE_FORMAT(m1.date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(m1.date, '%H:%i') AS time FROM messages AS m1 LEFT JOIN messages AS m2 ON (m1.id_convo = m2.id_convo AND m1.id_msg < m2.id_msg) WHERE m2.id_msg IS NULL AND (m1.id_receiver = '".$id."' OR m1.id_user = '".$id."') ORDER by date DESC");
		}
	}

	function check_convo_exist($id_receiver,$id_sender){
		return $this->db->query("SELECT * FROM messages WHERE (id_user = '".$id_receiver."' OR id_receiver = '".$id_receiver."') AND (id_user = '".$id_sender."' OR id_receiver = '".$id_sender."') LIMIT 1");
	}

	function insert($data) {

		if($this->db->insert("messages", $data)){
			return true;
		}

		return false;
	}
}
?>