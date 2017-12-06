<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users'));
	}

	function saveprofile(){
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$telephone = $this->input->post('telephone');
		$password = $this->input->post('password');

		if(!empty($password)){
			$password_hash = $this->encryptPassword($password);
		}else{
			$password_hash = "";
		}

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'username' => $username,
			'email' => $email,
			'telephone' => $telephone,
			'password' => $password_hash
		);

		$this->m_users->update($id_user, $data);

		redirect('account');
	}

}