<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users'));
	}

	function aktivasi(){
		$id = $this->uri->segment(3);

		$arrayName = array('activated' => '1');

		$this->m_users->edit($arrayName,$id);

		$this->session->set_flashdata('info','Akun berhasil dikativasi, silahkan login untuk masuk kedalam website.');

		redirect('login');
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


		if ($this->input->post() && ($this->input->post('secutity_code') == $this->session->userdata('mycaptcha'))) {
			// $this->load->view('berhasil.php');

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
				$date 			= date('Y-m-d');

				$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'username' => $username,
					'email' => $email,
					'telephone' => $telephone,
					'password' => $password_hash,
					'id_userlevel' => '3',
					'date_joined' => $date
				);

				$this->m_users->add_user($data);

				$id_user = $this->m_users->getUserLastId();
				$msg = 'Silahkan aktivasi akun anda dengan mengklik link berikut: <a href = '.base_url('Auth/aktivasi/'.$id_user).'>Aktivasi</a>';
				$subject = "Aktivasi Akun - Marketplace Kombas";

				if($this->sendMail($email,$msg,$subject)){
					$this->session->set_flashdata('info','Silahkan cek email anda untuk melakukan aktivasi.');

					redirect('login');
				}else{
					$this->session->set_flashdata('error','*'.$this->email->print_debugger());

					redirect('login');
				}
				
				
			}else{
				$this->session->set_flashdata('error','*Password tidak sama!');
				redirect('register/gagal');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error','*Security Code yang dimasukkan salah!');
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
		}else if ($this->m_users->get_field("activated","",$username,"")->row()->activated == 0){
			$this->session->set_flashdata('error','*Akun belum diaktivasi, silahkan cek email anda untuk melakukan aktivasi!');
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