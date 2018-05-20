<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Auth extends CI_Model{

	function get_token($username){
		return $this->db
		->like('username', $this->db->escape_str($username))
		->limit(1)
		->get('users')
		->row()
		->token;
	}

	function username_exist($username){
		$q = $this->db
		->like('username', $this->db->escape_str($username))
		->limit(1)
		->get('users')
		->num_rows();

		if($q == 0){
			return false;
		}else{
			return true;
		}
	}

	function user_alr_login($username){
		$q = $this->db
		->like('username', $this->db->escape_str($username))
		->limit(1)
		->get('users')
		->row()
		->loggedin;

		if($q == '1'){
			return true;
		}else{
			return false;
		}
	}

	function wrong_pwd($password, $username){
		$q = $this->db
		->like('username', $this->db->escape_str($username))
		->like('password', $this->db->escape_str($password))
		->limit(1)
		->get('users')
		->num_rows();

		if($q == 0){
			return true;
		}else{
			return false;
		}
	}

	function is_activated($username){
		$q = $this->db
		->like('username', $this->db->escape_str($username))
		->limit(1)
		->get('users')
		->row()
		->activated;

		if($q == '1'){
			return true;
		}else{
			return false;
		}
	}

	function get_user($username, $password){
		return $this->db
		->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2")
		->like('username', $username)
		->like('password', $password)
		->limit(1)
		->get('users')
		->row();
	}

	function get_shop($id_user){
		return $this->db
		->where('id_user', $id_user)
		->get('shops')
		->row();
	}

	function generate_randomstring($length = 25) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function login($input){

		if(!empty($input)){
			$username = $input['username'];
			$md5 = md5("taesa%#@2%^#" . $input['password'] . "2345#$%@3e");
			$password_hash = sha1($md5);

			if(get_cookie('token') == '' || $this->get_token($username) != get_cookie('token')){

				if(!$this->username_exist($username)){
					return "username_notexist";
				}else if($this->user_alr_login($username)){
					return "already_login";
				}else if($this->wrong_pwd($password_hash, $username)){
					return "wrong_pwd";
				}else if(!$this->is_activated($username)){
					return "not_activated";
				}else{

					$user = $this->get_user($username, $password_hash);

					//set cookie
					$name   = 'token';
					$value  = $this->generate_randomstring();
					$expire = time() + 604800;
					$path  = '/';
					// $secure = FALSE;

					setcookie($name,$value,$expire,$path); 

					//set cookie expire
					$date_expire = strtotime("+7 day"); 
					$date_expire = date('Y-m-d', $date_expire); //expire date

					$data_update = array(
						'loggedin' => '1',
						'token' => $value,
						'token_expired' => $date_expire
					);

					$this->db->where('id_user', $user->id_user);

					if($this->db->update('users', $data_update)){

						$session_data = array(
							'id_user'		=> $user->id_user,
							'email'			=> $user->email,
							'nama_lgkp'		=> $user->first_name." ".$user->last_name,
							'user_lvl'		=> $user->id_userlevel,
							'username'  	=> $user->username,
							'telp'			=> $user->telephone,
							'date_joined' 	=> $user->date_joined2,
							'ava_path' 		=> $user->ava_path,
							'cover_path' 	=> $user->cover_path,
							'loggedin' 		=> TRUE
						);

						if($user->id_userlevel == '4'){ //if seller, add id shop to session

							$seller = $this->get_shop($user->id_user);
							$session_data['id_shop'] = $seller->id_shop;
							
						}

						$this->session->set_userdata($session_data);

						return "success";
					}else{
						setcookie('token','',time() - 3600, '/');
						return $this->db->_error_message();
					}
				}

			}else{ //if cookie is set

				$user = $this->get_user($username, $password_hash);

				$session_data = array(
					'id_user'		=> $user->id_user,
					'email'			=> $user->email,
					'nama_lgkp'		=> $user->first_name." ".$row->last_name,
					'user_lvl'		=> $user->id_userlevel,
					'username'  	=> $user->username,
					'telp'			=> $user->telephone,
					'date_joined' 	=> $user->date_joined2,
					'ava_path' 		=> $user->ava_path,
					'cover_path' 	=> $user->cover_path,
					'loggedin' 		=> TRUE
				);

				if($user->id_userlevel == '4'){ //if seller, add id shop to session

					$seller = $this->get_shop($user->id_user);
					$session_data['id_shop'] = $seller->id_shop;

				}

				$this->session->set_userdata($session_data);

			}
		}else{
			return "empty_data";
		}
	}

	function logout(){
		$data_update = array(
			'loggedin' => '0',
			'token' => '',
			'token_expired' => '0000-00-00'
		);

		$this->db->where('id_user', $this->session->userdata('id_user'));

		if($this->db->update('users', $data_update)){
			setcookie('token','',time() - 3600, '/');
			$this->session->sess_destroy();
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function aktivasi($id_user){
		$data = array('activated' => '1');

		$this->db->where('id_user', $id_user);

		if($this->db->update('users', $data)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function email_exist($email){
		$q = $this->db
		->like('email', $email)
		->limit(1)
		->get('users')
		->num_rows();

		if($q > 0){
			return true;
		}else{
			return false;
		}
	}

	function telp_exist($telp){
		$q = $this->db
		->like('telephone', $telephone)
		->limit(1)
		->get('users')
		->num_rows();

		if($q > 0){
			return true;
		}else{
			return false;
		}
	}

	public $last_registered;

	function set_lastregistered($id_user){
		$this->last_registered = $id_user;
	}

	function get_lastregistered(){
		return $this->last_registered;
	}

	function register($input){

		if ($this->input->post()) {
			if($input['security_code'] == $this->session->userdata('regis_captcha')){

				if($input['password'] == $input['confirm_password']){

					if($this->username_exist($input['username'])){
						return "username_exist";
					}else if($this->email_exist($input['email'])){
						return "email_exist";
					}else if($this->telp_exist($input['telephone'])){
						return "telp_exist";
					}

					$date = date('Y-m-d');
					$md5 = md5("taesa%#@2%^#" . $input['password'] . "2345#$%@3e");
					$password_hash = sha1($md5);

					$data = array(
						'first_name' => $input['first_name'],
						'last_name' => $input['last_name'],
						'username' => $input['username'],
						'email' => $input['email'],
						'telephone' => $input['telephone'],
						'password' => $password_hash,
						'id_userlevel' => '3',
						'date_joined' => $date
					);

					if($this->db->insert('users',$data)){
						$this->set_lastregistered($this->db->insert_id());
						return "success";
					}else{
						return $this->db->_error_message();
					}


				}else{
					return "pwd_notsame";
				}

			}else{
				return "wrong_captcha";
			}
		}else{
			return "empty_data";
		}
	}

	// function forgot_password($input){
	// 	$email						= 	$this->input->post('email');
	// 	$pin						= 	$this->input->post('pin');

	// 	$newpwd 					= 	$this->generatePassword();
	// 	$newpwd_hash 				= 	$this->encryptPassword($newpwd);
	// }
}
?>