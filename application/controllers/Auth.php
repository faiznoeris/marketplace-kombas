<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users'));
	}

	function register() {
		$first_name					= 	$this->input->post('first_name');
		$last_name					= 	$this->input->post('last_name');
		$username 					= 	$this->input->post('username');
		$email 						= 	$this->input->post('email');
		$telephone					= 	$this->input->post('telephone');
		$password					= 	$this->input->post('password');
		$confirm_password			= 	$this->input->post('confirm_password');

		// $dropshipper_check 			=	$this->input->post("dropshipper");

		// if($dropshipper_check == "on"){
		// 	$dropshipper = "on";
		// }else{
		// 	$dropshipper = "";
		// }

		$password_hash 				= 	$this->encryptPassword($password);

		

		if ($this->m_users->get_field("username","",$username,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Username sudah terdaftar!');
			redirect('register/gagal');
		}	

		if ($this->m_users->get_field("email","",$email,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Email sudah terdaftar!');
			redirect('register/gagal');
		}

		if ($this->m_users->get_field("telephone","",$telephone,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Telephone sudah terdaftar!');
			redirect('register/gagal');
		}	



		if($password == $confirm_password){
			$this->m_users->add_user($first_name,$last_name,$username,$email,$telephone,$password_hash);
			redirect('login');
		}else{
			$this->session->set_flashdata('error','*Password tidak sama!');
			redirect('register/gagal');
		}

	}


	function login() {
		$username 						= 	$this->input->post('username');
		$password						= 	$this->input->post('password');
		$password_hash 					= 	$this->encryptPassword($password);

		if ($this->m_users->get_field("username","",$username,"")->num_rows() == 0){
			$this->session->set_flashdata('error','*Username tidak terdaftar!');
			redirect('login/gagal');
		}else if ($this->m_users->get_field("loggedin","",$username,"")->row()->loggedin == 1){
			$this->session->set_flashdata('error','*User sudah login!');
			redirect('login/gagal');
		}else if ($this->m_users->get_field("password","username",$password_hash,$username)->num_rows() == 0){
			$this->session->set_flashdata('error','*Password salah');
			redirect('login/gagal');
		}

		if ($this->m_users->update_login($username,$password_hash)){
			redirect(""); //login sukses
		}else{	
			$this->session->set_flashdata('error','*Terjadi kesalahan saat login!');
			redirect("/login/gagal");
		}
	}	

	function logout() {
		$array_items = array('id_user','email','nama_lgkp','user_lvl','username','telp','date_joined','loggedin');
		
		$session = $this->session->all_userdata();

		$this->m_users->update_logout($session['id_user']);

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