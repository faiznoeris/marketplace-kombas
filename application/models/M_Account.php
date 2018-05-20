<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Account extends CI_Model{

	/* PENDING APPROVAL */

	function get_one($id_user){
		return $this->db
		->where("id_user", $id_user)
		->limit(1)
		->get('pending_approval');
	}

	function insert($data){

		if($this->get_one($data["id_user"])->num_rows() == 0){

			if($this->db->insert("pending_approval", $data)){
				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{

			if($this->get_one($data["id_user"])->row()->status == "Approved"){
				return "already_approved";
			}else{
				return "already_in_db";
			}
		}

	}

	/* PENDING APPROVAL */

	/* ACCOUNT */
	
	function update_account($id_user, $input, $cover_file, $ava_file){

		if(!empty($input['password'])){
			$md5 = md5("taesa%#@2%^#" . $input['password'] . "2345#$%@3e");
			$password_hash = sha1($md5);
		}else{
			$password_hash = "";
		}

		$data = array(
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'username' => $input['username'],
			'email' => $input['email'],
			'telephone' => $input['telephone'],
			'password' => $input['password_hash']
		);

		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}

		$this->db->where('id_user', $id_user);

		if($this->db->update('users')){

			$config = array(
				'allowed_types' => "gif|jpg|png",
				'overwrite' => TRUE,
			);

			if($ava_file != 0){
				$config['upload_path'] = "./assets/images/user_avatar/";
				$config['max_size'] = "1024";
				$config['file_name'] = "avatar". $id_user . "-" . rand(0,1000);
				$upload_ava = $this->upload($id_user,$config,'avatar','ava_path');
			}else{
				$upload_ava = "success";
			}

			if($cover_file != 0){
				$config['upload_path'] = "./assets/images/user_cover/";
				$config['max_size'] = "3096";
				$config['file_name'] = "cover". $id_user . "-" . rand(0,1000);
				$upload_cover = $this->upload($id_user,$config,'cover','cover_path');
			}else{
				$upload_cover = "success";
			}

			if($upload_ava == "success" && $upload_cover == "success"){

				$data_session = array(
					'nama_lgkp' => $input['first_name']." ".$input['last_name'],
					'username' => $input['username'],
					'email' => $input['email'],
					'telp' => $input['telephone']
				);

				$this->session->set_userdata($data_session);

				return "success";

			}else{

				if($upload_ava == "success"){
					return $upload_cover;
				}else if($upload_cover == "success"){
					return $upload_ava;
				}

			}

		}else{
			return $this->db->_error_message();
		}

	}

	function upload($id_user,$config,$input_name,$column_name){

		$this->upload->initialize($config);

		$old_file = $this->session->userdata($column_name); //store old link/path of file to variable

		if($this->upload->do_upload($input_name)){
			$path 				= 	$this->upload->data();
			$path 				= 	$path["full_path"];
			$path 				= 	substr($path, 31);

			$this->db->set($column_name, $path);
			$this->db->where('id_user', $id_user);

			if($this->db->update('users')){
				
				if(strpos($old_file, 'default') == false){ //check if user still use the default ava / cover
					// unlink('.'.$this->session->userdata('ava_path'));
					unlink($old_file); //delete file
				}

				$this->session->set_userdata($column_name, $path);

				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{
			return $this->upload->display_errors();
		}
	}

	/* ACCOUNT */
}
?>