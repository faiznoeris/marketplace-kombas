<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users'));
	}

	function adduser(){
		$first_name					= 	$this->input->post('first_name');
		$last_name					= 	$this->input->post('last_name');
		$username 					= 	$this->input->post('username');
		$email 						= 	$this->input->post('email');
		$telephone					= 	$this->input->post('telephone');
		$password					= 	$this->input->post('password');

		$password_hash 				= 	$this->encryptPassword($password);

		

		if ($this->m_users->get_field("username","",$username,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Username sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}	

		if ($this->m_users->get_field("email","",$email,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Email sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}

		if ($this->m_users->get_field("telephone","",$telephone,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Telephone sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}	



		$this->m_users->add_user($first_name,$last_name,$username,$email,$telephone,$password_hash);
		$this->session->set_flashdata('info','User berhasil ditambahkan!');
		redirect('dashboard/adduser/sukses');

	}

}