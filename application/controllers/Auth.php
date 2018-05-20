<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array('m_users','m_admins'));
		$this->load->model(array('M_Auth'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '4000';
		$this->notif_data['sticky'] = 'false';
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function login() {

		$q = $this->M_Auth->login($this->input->post());

		if($q == "success"){
			$this->notif_data['message'] = 'Berhasil login.';
			$this->notif_data['theme'] = 'bg-success alert-styled-left';
			$this->notif_data['group'] = 'alert-success';

			$this->notif_data($this->notif_data);

			redirect('');
		}else if($q == "username_notexist"){
			$this->session->set_flashdata('error','*Username tidak terdaftar!');
		}else if($q == "already_login"){
			$this->session->set_flashdata('error','*User sudah login!');
		}else if($q == "wrong_pwd"){
			$this->session->set_flashdata('error','*Password salah');
		}else if($q == "not_activated"){
			$this->session->set_flashdata('error','*Akun belum diaktivasi, silahkan cek email anda untuk melakukan aktivasi!');
		}else if($q == "empty_data"){
			redirect('');
		}else{
			$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$q);
		}
		redirect('login/gagal');
	}	

	function logout() {
		$q = $this->M_Auth->logout();

		if($q == "success"){
			redirect('');
		}else{
			$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
			$this->notif_data['theme'] = 'bg-danger alert-styled-left';
			$this->notif_data['group'] = 'alert-danger';
		}

		$this->notif_data($this->notif_data);
		redirect('');
	}

	function aktivasi(){
		$id_user = $this->uri->segment(3);

		$q = $this->M_Auth->aktivasi($id_user);

		if($q == "success"){
			$this->session->set_flashdata('info','Akun berhasil dikativasi, silahkan login untuk masuk kedalam website.');
		}else{
			$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$q);
		}
		
		redirect('login');
	}

	function register() {
		$q = $this->M_Auth->register($this->input->post());

		if($q == "success"){
			$id_user = $this->M_Auth->get_lastregistered();
			$msg = 'Silahkan aktivasi akun anda dengan mengklik link berikut: <a href = '.base_url('Auth/aktivasi/'.$id_user).'>Aktivasi</a>';
			$subject = "Aktivasi Akun - Marketplace Kombas";

			if($this->sendMail($email,$msg,$subject)){
				$this->session->set_flashdata('info','Silahkan cek email anda untuk melakukan aktivasi.');
				redirect('login');
			}else{
				$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$this->email->print_debugger());
				redirect('login');
			}
		}else if($q == "username_exist"){
			$this->session->set_flashdata('error','*Username sudah terdaftar!');
		}else if($q == "email_exist"){
			$this->session->set_flashdata('error','*Email sudah terdaftar!');
		}else if($q == "telp_exist"){
			$this->session->set_flashdata('error','*Telephone sudah terdaftar!');
		}else if($q == "pwd_notsame"){
			$this->session->set_flashdata('error','*Password tidak sama!');
		}else if($q == "wrong_captcha"){
			$this->session->set_flashdata('error','*Security Code yang dimasukkan salah!');
		}else if($q == "empty_data"){
			$this->session->set_flashdata('error','*Data masih kosong!');
		}else{
			$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$q);
		}

		redirect('register/gagal');

	}
	
	// function forgotpassword() {
	// 	$q = $this->M_Auth->forgot_password($this->input->post());


	// 	if($q == "success"){
	// 		$msg = "Password baru anda adalah <b>".$newpwd."</b>. <br>Silahkan login dan kemudian ganti password anda agar memudahkan dalam proses login selanjutnya.";
	// 		$subject = "Password baru anda. - SMK Ma'arif NU 1 Sumpiuh";
	// 		if($this->sendMail($email,$msg,$subject)){
	// 			$this->session->set_flashdata('emailsent',$email);
	// 			redirect("/login/forgotpassword/sukses"); 
	// 		}else{
	// 			redirect("/login/forgotpassword/gagal");
	// 		}
	// 	}else{
	// 		$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$q);
	// 		redirect("/login/forgotpassword/gagal");
	// 	}
	// }	
}