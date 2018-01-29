<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users','m_shop','m_seller_pending_approval','m_products','m_category','m_transaction_history_seller','m_withdrawal'));
	}

	//reports

	//withdraw reports

	function approvewithdraw(){
		$id_withdraw = $this->uri->segment(3);

		$data = array('status' => "Approved");

		$this->m_withdrawal->edit($data,$id_withdraw);

		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil meng-approve withdraw.', 3);
		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-witreports-'.$_SESSION['id_user'] , 3);
		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/reports/withdraw');
	}

	//withdraw reports end


	function acctrf(){
		$id_transaction = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);
		$id_shop = $this->uri->segment(5);
		$jmlproduk = $this->uri->segment(6);


		$data2 = array(
			'status' => "Transfer Received By Admin"
		);


		if($jmlproduk > 1){
			for ($i=0; $i < $jmlproduk; $i++) { 
				$this->m_transaction_history_seller->edit($data2,$id_transaction,'');
			}
		}else{
			$this->m_transaction_history_seller->edit($data2,$id_transaction,'');
		}

		// $this->m_transaction_history_seller->edit($data2,$id_transaction,$id_shop);

		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil melakukan konfirmasi transfer.', 3);
		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-trareports-'.$_SESSION['id_user'] , 3);
		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/reports');
	}

	//reports


	//category

	function addcategory(){
		if($this->isLoggedin() == true && !empty($_POST)){

			$nama = $this->input->post('nama_category');
			$data = array(
				'nama_category' => $nama
			);

			if($this->m_category->insert($data)){

				$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
				$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
				$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menambah category '.$nama.'.', 3);
				$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
				$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
				$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
				$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-category-'.$_SESSION['id_user'] , 3);
				$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);


				redirect('dashboard/category');

			}else{

				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/category/add/gagal');

			}

		}else{
			redirect('');
		}	
	}

	function editcategory(){

		if($this->isLoggedin() == true){

			$id = $this->uri->segment(3);	
			$nama =	$this->input->post('nama_category');

			$data = array(
				'nama_category' => $nama
			);

			if($this->m_category->edit($data,$id)){

				$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
				$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
				$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil mengubah nama category menjadi '.$nama.'.', 3);
				$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
				$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
				$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
				$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-category-'.$_SESSION['id_user'] , 3);
				$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

				redirect('dashboard/category');

			}else{

				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/category/edit/'.$id.'/gagal');

			}

		}else{
			redirect('');
		}
	}

	function deletecategory(){
		if($this->isLoggedin() == true){
			$id = $this->uri->segment(3);

			$this->m_category->delete($id);

			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menghapus category dengan id '.$id.'.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-category-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect("dashboard/category");
		}else{
			redirect('');
		}
	}

	//category-end


	//user management

	function adduser(){
		if($this->isLoggedin() == true && !empty($_POST)){
			$date 			= date('Y-m-d');

			$first_name		= 	$this->input->post('first_name');
			$last_name		= 	$this->input->post('last_name');
			$username 		= 	$this->input->post('username');
			$email 			= 	$this->input->post('email');
			$telephone		= 	$this->input->post('telephone');
			$password		= 	$this->input->post('password');
			$usertype		= 	$this->input->post('user_type');

			$password_hash 	= 	$this->encryptPassword($password);

			if ($this->m_users->get_field("username","",$username,"")->num_rows() == 1){
				$this->session->set_flashdata('error','*Username sudah terdaftar!');
				redirect('dashboard/users/add/gagal');
			}	

			if ($this->m_users->get_field("email","",$email,"")->num_rows() == 1){
				$this->session->set_flashdata('error','*Email sudah terdaftar!');
				redirect('dashboard/users/add/gagal');
			}

			if ($this->m_users->get_field("telephone","",$telephone,"")->num_rows() == 1){
				$this->session->set_flashdata('error','*Telephone sudah terdaftar!');
				redirect('dashboard/users/add/gagal');
			}	

			$data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'username' => $username,
				'email' => $email,
				'telephone' => $telephone,
				'password' => $password_hash,
				'id_userlevel' => $usertype,
				'date_joined' => $date
			);

			$usertype_string = "";
			if($usertype == '3'){
				$usertype_string = "User";
			}else if($usertype == '4'){
				$usertype_string = "Seller";
			}else if($usertype == '5'){
				$usertype_string = "Re-Seller";
			}

			$this->m_users->add_user($data);
			if($usertype == '4'){
				$data_shop = array(
					'id_user' => $this->m_users->getUserLastId()
				);

				$this->m_shop->insert($data_shop);
			}
			$this->session->set_flashdata('info','User berhasil ditambahkan!');

			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menambah user dengan username '.$username.' sebagai '.$usertype_string.'.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-users-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect('dashboard/users');
		}else{
			redirect('');
		}
	}

	function edituser(){
		if($this->isLoggedin() == true){

			$id 						= 	$this->uri->segment(3);	
			$first_name					= 	$this->input->post('first_name');
			$last_name					= 	$this->input->post('last_name');
			$username 					= 	$this->input->post('username');
			$email 						= 	$this->input->post('email');
			$telephone					= 	$this->input->post('telephone');
			$password					= 	$this->input->post('password');
			$usertype					= 	$this->input->post('user_type');

			$password_hash 				= 	$this->encryptPassword($password);

			$data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'username' => $username,
				'email' => $email,
				'telephone' => $telephone,
				'id_userlevel' => $usertype,
				'password' => $password_hash
			);

			if($this->m_users->edit($data,$id)){

				if($usertype == '3'){
					$shop_available = $this->m_shop->select($id)->num_rows();

					if($shop_available > 0){
						$this->m_shop->delete('user',$id);	
					}
					
				}else if($usertype == '4'){
					$shop_available = $this->m_shop->select($id)->num_rows();

					if($shop_available < 1){
						$data_shop = array(
							'id_user' => $id
						);

						$this->m_shop->insert($data_shop);
					}

				}

				$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
				$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
				$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil mengubah data user '.$username.'.', 3);
				$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
				$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
				$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
				$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-users-'.$_SESSION['id_user'] , 3);
				$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

				redirect('dashboard/users');

			}else{

				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/users/edit/'.$id.'/gagal');

			}

		}else{
			redirect('');
		}
	}

	function deleteuser(){
		if($this->isLoggedin() == true){
			$id = $this->uri->segment(3);

			$row = $this->m_users->select($id)->row();

			if($row->id_userlevel == '4'){
				$this->m_shop->delete('user',$id);
			}

			$this->m_users->delete($id);

			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menghapus user dengan id '.$id.'.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-users-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect("dashboard/users");
		}else{
			redirect('');
		}
	}

	//user management-end


	




	function approveseller(){
		$id_user = $this->uri->segment(3);

		$data = array(
			'user_lvl' => '3'
		);

		$data_2 =  array(
			'status' => 'Approved' 
		);

		$this->m_users->update($id_user,$data);
		$this->m_seller_pending_approval->update($id_user,$data_2);

		redirect('dashboard/sellerpending');


	}



}