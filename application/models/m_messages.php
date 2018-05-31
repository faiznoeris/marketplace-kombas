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
}
?>