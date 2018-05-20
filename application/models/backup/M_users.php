<?php
class M_users extends CI_Model{

	public $user_lastId = "";

	function setUserLastId($id){
		$this->user_lastId = $id;
	}

	function getUserLastId(){
		return $this->user_lastId;
	}

	function edit($data,$id){
		$this->db->set($data);
		$this->db->where('id_user', $id);
		if($this->db->update('users')){

			return true;
		}
		return false;
	}


	// function edit($data,$id){
	// 	foreach ($data as $key => $value) {
	// 		if($value != ""){
	// 			$this->db->set($key, $value);
	// 		}
	// 	}
	// 	$this->db->where('id_user', $id);
	// 	if($this->db->update('users')){
	// 		return true;
	// 	}
	// 	return false;
	// }

	function get_field($field,$field2,$data,$data2){
		$this->db->select("token,".$field);
		$this->db->from("users");

		if($field == "loggedin" || $field == "activated"){ //get loggedin value
			$this->db->like("username", $this->db->escape_str($data));
		}else{
			$this->db->like($field, $this->db->escape_str($data));
		}

		if($data2 != ""){
			$this->db->like($field, $this->db->escape_str($data));
			$this->db->like($field2, $this->db->escape_str($data2));
		}

		$this->db->limit(1);
		$res = $this->db->get();

		return $res;
	}

	function profile($username){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("username", $username);

		return $this->db->get();
	}

	function add_user($data) {
		
		

		// if($dropshipper != ""){
		// 	$data = array(
		// 		'id_userlevel' => '4', //dropshiper user elvel = 4
		// 		'first_name' => $first_name,
		// 		'last_name' => $last_name,
		// 		'username' => $username,
		// 		'email' => $email,
		// 		'telephone' => $telephone,
		// 		'password' => $password_hash,
		// 		'date_joined' => $date
		// 	);
		// }else{
		// $data = array(
		// 	'first_name' => $first_name,
		// 	'last_name' => $last_name,
		// 	'username' => $username,
		// 	'email' => $email,
		// 	'telephone' => $telephone,
		// 	'password' => $password_hash,
		// 	'date_joined' => $date 
		// );
		// }

		// $data = array(
		// 	'first_name' => $first_name,
		// 	'last_name' => $last_name,
		// 	'username' => $username,
		// 	'email' => $email,
		// 	'telephone' => $telephone,
		// 	'password' => $password_hash,
		// 	'date_joined' => $date 
		// );


		if($this->db->insert("users", $data)){
			$insert_id = $this->db->insert_id();
			$this->setUserLastId($insert_id);
			return true;
		}

		return false;
	}

	function select($id){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id_user", $id);

		return $this->db->get();
	}


	function getall(){
		$this->db->select("*, user_level.name as tipeuser");
		$this->db->from("users");
		$this->db->join("user_level","user_level.id_userlevel = users.id_userlevel");

		return $this->db->get();
	}

	function generateRandomString($length = 25) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function get_token($token){
		$this->db->select("id_user, token,token_expired");
		$this->db->from("users");
		$this->db->where("token", $token);
		$this->db->limit(1);

		return $this->db->get();
	}

	function update_session($token){
		$this->load->model('M_shop');

		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("users");
		$this->db->where("token", $token);
		$this->db->limit(1);

		$res = $this->db->get();
		$row = $res->row();


		if($row->id_userlevel == '4'){ //if seller, add id shop to session

			$row2 = $this->M_shop->select($row->id_user)->row();

			$newdata = array(
				'id_user'		=> $row->id_user,
				'email'			=> $row->email,
				'nama_lgkp'		=> $row->first_name." ".$row->last_name,
				'user_lvl'		=> $row->id_userlevel,
				'username'  	=> $row->username,
				'telp'			=> $row->telephone,
				'date_joined' 	=> $row->date_joined2,
				'ava_path' 		=> $row->ava_path,
				'cover_path' 	=> $row->cover_path,
				'id_shop'		=> $row2->id_shop,
				'loggedin' 		=> TRUE
			);
		}else{
			$newdata = array(
				'id_user'		=> $row->id_user,
				'email'			=> $row->email,
				'nama_lgkp'		=> $row->first_name." ".$row->last_name,
				'user_lvl'		=> $row->id_userlevel,
				'username'  	=> $row->username,
				'telp'			=> $row->telephone,
				'date_joined' 	=> $row->date_joined2,
				'ava_path' 		=> $row->ava_path,
				'cover_path' 	=> $row->cover_path,
				'loggedin' 		=> TRUE
			);
		}

		$this->session->set_userdata($newdata);

		return true;

	}


	function update_login($uname, $pwd_hash){
		$this->load->model('M_shop');

		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("users");
		$this->db->like("username", $uname);
		$this->db->like("password", $pwd_hash);
		$this->db->limit(1);

		$res = $this->db->get();
		$row = $res->row();

		$this->db->set('loggedin', '1');
		$this->db->where('id_user', $row->id_user);

		if($this->db->update('users')){

			if($row->id_userlevel == '4'){ //if seller, add id shop to session

				$row2 = $this->M_shop->select($row->id_user)->row();

				$newdata = array(
					'id_user'		=> $row->id_user,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_userlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'cover_path' 	=> $row->cover_path,
					'id_shop'		=> $row2->id_shop,
					'loggedin' 		=> TRUE
				);
			}else{
				$newdata = array(
					'id_user'		=> $row->id_user,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_userlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'cover_path' 	=> $row->cover_path,
					'loggedin' 		=> TRUE
				);
			}
			
			$name   = 'token';
			$value  = $this->generateRandomString();
			$expire = time() + 604800;
			$path  = '/';
			$secure = FALSE;

			setcookie($name,$value,$expire,$path); 

			$date_expire = strtotime("+7 day");
			$date_expire = date('Y-m-d', $date_expire); //expire date

			$update = array(
				'token' => $value,
				'token_expired' => $date_expire
			);

			$this->db->where('id_user', $row->id_user);
			$this->db->update('users', $update);

			$this->session->set_userdata($newdata);

			return true;
		}

		return false;
	}



	function update($id_user, $data){ //update user
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		//$this->db->set($data);
		$this->db->where('id_user', $id_user);
		if($this->db->update('users')){
			return true;
		}
		return false;
	}


	function update_logout($id_user){
		$this->db->set('loggedin', '0');
		$this->db->set('token', '');
		$this->db->set('token_expired', '0000-00-00');
		$this->db->where('id_user', $id_user);
		$this->db->update('users');

		setcookie('token','',time() - 3600, '/');
	}












	function update_password($email, $pin, $newpwd_hash, $newpwd){
		$this->db->select("email");
		$this->db->from("users");
		$this->db->like("email", $email);
		$this->db->limit(1);
		$res_chkemail = $this->db->get();

		$this->db->select("email,pin");
		$this->db->from("users");
		$this->db->like("email", $email);
		$this->db->like("pin", $pin);
		$this->db->limit(1);
		$res_chkcombination = $this->db->get();

		if($res_chkemail->num_rows() == 0){
			$this->session->set_flashdata('error','*Email tidak terdaftar!');
			return false;
		}

		if($res_chkcombination->num_rows() == 0){
			$this->session->set_flashdata('error','*Kombinasi email dan pin tidak cocok!');	
			return false;
		}

		$this->db->set('password', $newpwd_hash);
		$this->db->where('email', $email);
		$this->db->where('pin', $pin);	

		if($this->db->update('users')){
			return true;
		} 

		return false;
	}




	// EDIT PROFILE

	function get_user($id_user) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id_user", $id_user);

		return $this->db->get()->row();
	}

	function update_user($uname,$email,$pin,$pwd,$hash){
		$this->db->select("username");
		$this->db->from("users");
		$this->db->where("username",$uname);
		$this->db->limit(1);

		$res_chkexist = $this->db->get();

		if($res_chkexist->num_rows() == 1){
			$this->session->set_userdata('error','User dengan username '.$uname.' sudah ada!');	
			return false;
		}else{
			if($uname != ""){
				$this->db->set('username', $uname);
			}
			if($email != ""){
				$this->db->set('email', $email);
			}
			if($pin != ""){
				$this->db->set('pin', $pin);
			}
			if($pwd != ""){
				$this->db->set('password', $hash);
			}
			$this->db->where('id_user', $this->session->userdata('id_user'));
			if($this->db->update('users')){
				$this->session->set_userdata('username', $uname);	
				return true;
			}

		}
		return false;
	}

	function update_avapath($avapath){
		$this->db->set('ava_path', $avapath);
		$this->db->where('id_user', $this->session->userdata('id_user'));
		if($this->db->update('users')){
			$this->session->set_userdata('ava_path', $avapath);
			return true;
		}else{
			return false;
		}
	}

	function update_coverpath($coverpath){
		$this->db->set('cover_path', $coverpath);
		$this->db->where('id_user', $this->session->userdata('id_user'));
		if($this->db->update('users')){
			$this->session->set_userdata('cover_path', $coverpath);
			return true;
		}else{
			return false;
		}
	}


	// ADD USER


	function insert_user($uname,$email,$pin,$pwd,$hash) {
		//check if username exist on database
		$this->db->select("username");
		$this->db->from("users");
		$this->db->like("username", $this->db->escape_str($uname));
		$this->db->limit(1);
		$res_chkuname = $this->db->get();

		//check if email exist on database
		$this->db->select("email");
		$this->db->from("users");
		$this->db->like("email", $email);
		$this->db->limit(1);
		$res_chkemail = $this->db->get();

		if ($res_chkuname->num_rows() == 1){
			$this->session->set_flashdata('error','Username sudah terdaftar!');
			return false;
		}	

		if ($res_chkemail->num_rows() == 1){
			$this->session->set_flashdata('error','Email sudah terdaftar!');
			return false;
		}			

		$date = date('Y-m-d');

		$data = array(
			'username' => $uname,
			'email' => $email,
			'password' => $hash,
			'pin' => $pin,
			'date_joined' => $date 
		);

		if($this->db->insert("users", $data)){
			return true;
		}

		return false;
	}


	//
	//	GET ALL USER
	//

	function get_alluser() {
		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("users");
		return $this->db->get();
	}

	function delete($id) {
		if($this->db->delete('users', array('id_user' => $id))){
			return true;
		}
		return false;
	}
}
?>