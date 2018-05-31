<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {

	private $notif_data_reports = array();
	private $notif_data_settings = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Admins'));
		$this->notif_data_reports['header'] = 'Reports Notification';
		$this->notif_data_reports['duration'] = '4000';
		$this->notif_data_reports['sticky'] = false;
		$this->notif_data_reports['container'] = '#jGrowl-'.$this->session->userdata('id_admin');

		$this->notif_data_settings['header'] = 'Settings Notification';
		$this->notif_data_settings['duration'] = '3000';
		$this->notif_data_settings['sticky'] = false;
		$this->notif_data_settings['container'] = '#jGrowl-'.$this->session->userdata('id_admin');
	}

	/* REPORTS */

	// function warnseller(){
	// 	$id_transaction = $this->uri->segment(3);
	// 	$id_shop = $this->uri->segment(4);

	// 	if($this->isLoggedin()){
	// 		$user_lvl = $this->session->userdata('user_lvl');
	// 		$data = array('warning' => '1');

	// 		$q = $this->M_Admins->warn_seller($data,$id_transaction,$id_shop, $user_lvl);

	// 		if($q == "success"){

	// 			$q_shop = $this->M_Admins->get_shop_byshop($id_shop);
	// 			$q_seller = $this->M_Admins->get_user_byuser($q_shop->id_user);

	// 			$data["seller"] = $q_seller;
	// 			$data["id_transaction"] = $id_transaction;

	// 			$msg = $this->load->view('template/v_sellerwarning', $data, true);
	// 			$subject = "Peringatan - Marketplace Kombas";

	// 			if($this->sendMail($q_seller->email,$msg,$subject)){
	// 				$this->notif_data_reports['message'] = 'Seller telah diberi peringatan untuk segera mengirim barang.';
	// 				$this->notif_data_reports['theme'] = 'bg-success alert-styled-left';
	// 				$this->notif_data_reports['group'] = 'alert-success';
	// 			}else{
	// 				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$this->email->print_debugger();
	// 				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
	// 				$this->notif_data['group'] = 'alert-danger';
	// 			}

	// 		}else if($q == "not_admin"){
	// 			redirect('');
	// 		}else{
	// 			$this->notif_data_reports['message'] = 'Terdapat kesalahan! Error: '.$q;
	// 			$this->notif_data_reports['theme'] = 'bg-danger alert-styled-left';
	// 			$this->notif_data_reports['group'] = 'alert-danger';
	// 		}

	// 		$this->notif_data_admin($this->notif_data_reports);

	// 		redirect('dashboard/reports/exceeddeadline/delivery');

	// 	}else{
	// 		redirect('');
	// 	}

	// }

	function accwithdraw(){ 
		$id_withdraw = $this->uri->segment(3);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$data = array('status' => "Approved");

			$q = $this->M_Admins->acc_withdraw($data,$id_withdraw,$user_lvl);

			if($q == "success"){
				$this->notif_data_reports['message'] = 'Pengajuan withdrawal telah berhasil dikonfirmasi.';
				$this->notif_data_reports['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_reports['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_reports['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_reports);

			redirect('dashboard/reports/withdraw');

		}else{
			redirect('');
		}
	}

	function accrefund(){
		$id_transaction = $this->uri->segment(3);
		$user_lvl = $this->session->userdata('user_lvl');

		$data = array('refund' => "1");

		if($this->isLoggedin()){
			$data = array('status' => "Approved");

			$q = $this->M_Admins->acc_refund($data,$id_transaction,$user_lvl);

			if($q == "success"){
				$this->notif_data_reports['message'] = 'Refund telah berhasil dikonfirmasi.';
				$this->notif_data_reports['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_reports['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_reports['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_reports);

			redirect('dashboard/reports/refund');

		}else{
			redirect('');
		}
	}

	function acctransfer(){
		$id_transaction = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);
		// $id_shop = $this->uri->segment(5);
		$jmlproduk = $this->uri->segment(5);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$data = array('status' => "Transfer Received By Admin");

			$q = $this->M_Admins->acc_transfer($data,$id_transaction,$id_user,$jmlproduk,$user_lvl);

			if($q == "success"){

				$q_transhistory = $this->M_Admins->get_transactionhistory($id_transaction)->result();

				foreach ($q_transhistory as $value) {
					$q_shop = $this->M_Admins->get_shop_byshop($value->id_shop);
					$q_seller = $this->M_Admins->get_user_byuser($q_shop->id_user);

					$data["seller"] = $q_seller;
					$data["id_transaction"] = $id_transaction;

					$msg = $this->load->view('template/v_sellerneedship', $data, true);
					$subject = "Pesanan perlu dikirim - Marketplace Kombas";

					$this->sendMail($q_seller->email,$msg,$subject);
				}

				$this->notif_data_reports['message'] = 'Berhasil mengkonfirmasi transfer untuk ID Transaksi #'.$id_transaction.' .';
				$this->notif_data_reports['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-success';

			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_reports['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_reports['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_reports['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_reports);

			redirect('dashboard/reports/transaction');

		}else{
			redirect('');
		}
	}

	/* REPORTS */

	/* SETTINGS */

	function addbank(){
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){

			$q = $this->M_Admins->add_bank($this->input->post(), $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil menambah bank baru (nama bank: '.$this->M_Admins->getNewBankName().').';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data_settings['message'] = 'Data input masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-warning';
				$this->session->set_flashdata('error','Data masih kosong.');
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);

				$this->notif_data_admin($this->notif_data_settings);

				redirect('dashboard/bank/add/gagal');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/bank');
		}else{
			redirect('');
		}	
	}

	function editbank(){
		$id_bank = $this->uri->segment(3);	
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin() == true){
			$bank_old = $this->M_Admins->get_one_bank($id_bank)->row();
			$q = $this->M_Admins->edit_bank($this->input->post(), $id_bank, $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil mengubah data bank (nama bank: '.$bank_old->nama_bank.' menjadi: '.$this->M_Admins->getNewBankName().').';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data_settings['message'] = 'Data input masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-warning';
				$this->session->set_flashdata('error','Data masih kosong.');
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);

				$this->notif_data_admin($this->notif_data_settings);

				redirect('dashboard/bank/edit/'.$id_bank.'/gagal');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/bank');
		}else{
			redirect('');
		}
	}

	function deletebank(){
		$id_bank = $this->uri->segment(3);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$bank_old = $this->M_Admins->get_one_bank($id_bank)->row();
			$q = $this->M_Admins->delete_bank($id_bank, $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil menghapus bank (nama bank: '.$bank_old->nama_bank.' ).';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/bank');
		}else{
			redirect('');
		}
	}

	function addcategory(){
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){

			$q = $this->M_Admins->add_category($this->input->post(), $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil menambah category baru (nama category: '.$this->M_Admins->getNewCategoryName().').';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data_settings['message'] = 'Data input masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-warning';
				$this->session->set_flashdata('error','Data masih kosong.');
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);

				$this->notif_data_admin($this->notif_data_settings);

				redirect('dashboard/category/add/gagal');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/category');
		}else{
			redirect('');
		}	
	}

	function editcategory(){
		$id_category = $this->uri->segment(3);	
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin() == true){
			$category_old = $this->M_Admins->get_one_category($id_category)->row();
			$q = $this->M_Admins->edit_category($this->input->post(), $id_category, $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil mengubah data category (nama category: '.$category_old->nama_category.' menjadi: '.$this->M_Admins->getNewCategoryName().').';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data_settings['message'] = 'Data input masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-warning';
				$this->session->set_flashdata('error','Data masih kosong.');
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);

				$this->notif_data_admin($this->notif_data_settings);

				redirect('dashboard/category/edit/'.$id_category.'/gagal');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/category');
		}else{
			redirect('');
		}
	}

	function deletecategory(){
		$id_category = $this->uri->segment(3);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$category_old = $this->M_Admins->get_one_category($id_category)->row();
			$q = $this->M_Admins->delete_category($id_category, $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil menghapus category (nama category: '.$category_old->nama_category.' ).';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/category');
		}else{
			redirect('');
		}
	}

	/* SETTINGS */

	/* USER MANAGEMENT */

	function adduser(){
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){

			if(!empty($this->input->post())){

				$q = $this->M_Admins->add_users($this->input->post(), $user_lvl);

				if($q == "success"){
					$this->notif_data_settings['message'] = 'Berhasil menambah user baru (username: '.$this->M_Admins->getLastAddedUser()->username.' | tipe user: '.$this->M_Admins->getLastAddedUser()->tipeuser.').';
					$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-success';						
				}else if($q == "empty_data"){
					$this->notif_data_settings['message'] = 'Data input masih kosong!';
					$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-warning';
					$this->session->set_flashdata('error','Data masih kosong.');
				}else if($q == "not_admin"){
					redirect('');
				}else{
					$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
					$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-danger';
					$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);
				}

			}else{
				$this->notif_data_settings['message'] = 'Data masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Data masih kosong!');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/users/add');

		}else{
			redirect('');
		}
	}

	function edituser(){
		$id_user = $this->uri->segment(3);	
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){

			if(!empty($this->input->post())){

				$q = $this->M_Admins->edit_users($this->input->post(), $id_user, $user_lvl);

				if($q == "success"){
					$this->notif_data_settings['message'] = 'Berhasil menambah user baru (username: '.$this->M_Admins->getLastAddedUser()->username.' | tipe user: '.$this->M_Admins->getLastAddedUser()->tipeuser.').';
					$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-success';						
				}else if($q == "empty_data"){
					$this->notif_data_settings['message'] = 'Data input masih kosong!';
					$this->notif_data_settings['theme'] = 'bg-warning alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-warning';
					$this->session->set_flashdata('error','Data masih kosong.');
				}else if($q == "not_admin"){
					redirect('');
				}else{
					$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
					$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
					$this->notif_data_settings['group'] = 'alert-danger';
					$this->session->set_flashdata('error','Terjadi kesalahan! Error: '.$q);
				}

			}else{
				$this->notif_data_settings['message'] = 'Data masih kosong!';
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Data masih kosong!');
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/users');
			// redirect('dashboard/users/edit/'.$id.'/gagal');
		}else{
			redirect('');
		}
	}

	function deleteuser(){
		$id_user = $this->uri->segment(3);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$username = $this->M_Admins->get_username($id_user);
			$q = $this->M_Admins->delete_user($id_user, $user_lvl);

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil menghapus user (username: '.$username.' ).';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/users');
		}else{
			redirect('');
		}
	}

	function accupgrade(){
		$id_user = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){
			$data_pending_approval =  array('status' => 'Approved');

			if($type == "seller"){
				$data_users = array('id_userlevel' => '4');

				$q = $this->M_Admins->acc_upgrade($data_users, $data_pending_approval, $id_user, $user_lvl);

			}else if($type == "reseller"){
				$data_users = array('id_userlevel' => '5');

				$q = $this->M_Admins->acc_upgrade($data_users, $data_pending_approval, $id_user, $user_lvl);

			}else{
				$this->notif_data_settings['message'] = 'Tipe user yang akan diupgrade tidak diketahui!';
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';

				$this->notif_data_admin($this->notif_data_settings);

				redirect('dashboard/pendingapproval/'.$type);
			}

			if($q == "success"){
				$this->notif_data_settings['message'] = 'Berhasil mengkonfirmasi upgrade akun menjadi Reseller untuk akun dengan username: '.$this->M_Admins->getUsername($id_user).'.';
				$this->notif_data_settings['theme'] = 'bg-success alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-success';
			}else if($q == "not_admin"){
				redirect('');
			}else{
				$this->notif_data_settings['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data_settings['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data_settings['group'] = 'alert-danger';
			}

			$this->notif_data_admin($this->notif_data_settings);

			redirect('dashboard/pendingapproval/'.$type);

		}else{
			redirect('');
		}
	}

	/* USER MANAGEMENT */

	/* AUTH */

	function login() {
		$q = $this->M_Admins->login($this->input->post());

		if($q == "success"){
			$this->notif_data['message'] = 'Berhasil login.';
			$this->notif_data['theme'] = 'bg-success alert-styled-left';
			$this->notif_data['group'] = 'alert-success';

			$this->notif_data_admin($this->notif_data);

			redirect('dashboard');
		}else if($q == "username_notexist"){
			$this->session->set_flashdata('error','*Username tidak terdaftar!');
		}else if($q == "already_login"){
			$this->session->set_flashdata('error','*User sudah login!');
		}else if($q == "wrong_pwd"){
			$this->session->set_flashdata('error','*Password salah');
		}else if($q == "empty_data"){
			redirect('');
		}else{
			$this->session->set_flashdata('error','*Terdapat kesalahan! Error: '.$q);
		}
		redirect('dashboard/login/gagal');
	}	

	function logout() {
		$this->M_Admins->logout();

		redirect("");
	}

	/* AUTH */
}
?>