<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users','m_seller_pending_approval','m_reseller_pending_approval'));
	}

	function upgradereseller(){
		$id_user = $this->uri->segment(3);
		
		if($this->m_reseller_pending_approval->select("",$id_user)->num_rows() < 1){
			$this->m_reseller_pending_approval->insert($id_user);
			redirect('dashboard');
		}else{
			//already in table
			redirect('dashboard');
		}

	}

	function upgradeseller(){
		$id_user = $this->uri->segment(3);
		
		if($this->m_seller_pending_approval->select("",$id_user)->num_rows() < 1){
			$this->m_seller_pending_approval->insert($id_user);
			redirect('dashboard');
		}else{
			//already in table
			redirect('dashboard');
		}

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


		$datasession = array(
			'nama_lgkp'		=> $first_name." ".$last_name,
			'username'  	=> $username,
			'email' => $email,
			'telp' => $telephone
		);

		$this->session->set_userdata($datasession);

		$this->m_users->update($id_user, $data);

		if($this->uploadavatar()){
			redirect('dashboard/biodata');
		}else{
			$this->session->set_flashdata('error',$this->upload->display_errors());
			redirect('dashboard/biodata');
		}
		

		redirect('dashboard/biodata');
	}


	function uploadavatar(){
		$config = array(
			'upload_path' => "./assets/images/user_avatar/",
			'allowed_types' => "*",
			'overwrite' => TRUE,
			'max_size' => "1024000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "250",
			'max_width' => "250",
			'file_name' => "avatar". $this->session->userdata('id_user') . "-" . rand(0,1000)
		);

		$this->upload->initialize($config);

		if($_FILES['avatar']['size'] == 0){
			return true;
		}else if($this->upload->do_upload('avatar')){
			$avapath 				= 	$this->upload->data();
			$avapath 				= 	$avapath["full_path"];
			$avapath 				= 	substr($avapath, 31);

			if(strpos($this->session->userdata('ava_path'), 'default') == false){
				unlink('.'.$this->session->userdata('ava_path'));
			}


			if($this->m_users->update_avapath($avapath)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}