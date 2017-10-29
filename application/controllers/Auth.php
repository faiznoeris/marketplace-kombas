<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('cart');
		// $this->load->model('billing_model');
	}

	function login() {
		$uname 						= 	$this->input->post('username');
		$pwd						= 	$this->input->post('password');
		$pwd_hash 					= 	$this->encryptPassword($pwd);

		if ($this->m_user->update_login($uname,$pwd_hash)){
			redirect("/dashboard"); //login sukses
		}else{	
			redirect("/login/gagal");
		}
	}	

	function logout() {
		$array_items = array('id_user','email','user_lvl','username','date_joined','loggedin');
		
		$session = $this->session->all_userdata();

		$this->m_user->update_logout($session['id_user']);

		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		
		redirect("");
	}

	function forgotpassword() {
		$email						= 	$this->input->post('email');
		$pin						= 	$this->input->post('pin');

		$newpwd 					= 	$this->generatePassword();
		$newpwd_hash 				= 	$this->encryptPassword($newpwd);

		if ($this->m_user->update_password($email, $pin, $newpwd_hash, $newpwd)){
			$msg = "Password baru anda adalah <b>".$newpwd."</b>. <br>Silahkan login dan kemudian ganti password anda agar memudahkan dalam proses login selanjutnya.";
			$subject = "Password baru anda. - SMK Ma'arif NU 1 Sumpiuh";
			if($this->sendMail($email,$msg,$subject)){
				$this->session->set_flashdata('emailsent',$email);
				redirect("/login/forgotpassword/sukses"); 
			}else{
				redirect("/login/forgotpassword/gagal");
			}
		}else{	
			redirect("/login/forgotpassword/gagal");
		}
	}	
}