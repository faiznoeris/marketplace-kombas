<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array('m_transaction_history_seller','m_transaction_history_product','m_shop','m_users','m_confirmation','m_users','m_products','m_stok_notification'));
		$this->load->model(array('M_Pembelian'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '4000';
		$this->notif_data['sticky'] = 'false';
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function konfirmasitrf(){
		$id_transaction = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);
		// $id_shop = $this->uri->segment(5);
		$jmlproduk = $this->uri->segment(5);

		if($this->isLoggedin()){
			$q = $this->M_Pembelian->insert_konfirmasitrf($this->input->post(), $id_transaction, $id_user, $jmlproduk);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengkonfirmasi pembayaran.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);
			redirect('account/profile#riwayat');

		}else{
			redirect('');
		}
		
	}

















	// function barangditerima(){
	// 	$id = $this->uri->segment(3);
	// 	$id2 = $this->uri->segment(4);
	// 	$saldo = $this->uri->segment(5);
	// 	$saldobuyer = $this->uri->segment(6);
	// 	$admin = $this->uri->segment(7);
	// 	$id_user = $this->uri->segment(8);



	// 	$data = array(
	// 		'status' => "Delivered"
	// 	);

	// 	$this->m_transaction_history_seller->edit($data,$id,$id2);

	// 	$id_seller = $this->m_shop->selectidshop($id2)->row()->id_user;

	// 	$oldsaldo = $this->m_users->select($id_seller)->row()->saldo;

	// 	$saldo = $saldo + $oldsaldo;

	// 	$data = array(
	// 		'saldo' => $saldo
	// 	);

	// 	$this->m_users->edit($data,$id_seller);

	// 	$data = array(
	// 		'saldo' => $saldobuyer
	// 	);


	// 	if(!empty($admin)){
	// 		$this->m_users->edit($data,$id_user);
	// 	}else{
	// 		$this->m_users->edit($data,$_SESSION['id_user']);
	// 	}


	// 	$transaction_product = $this->m_transaction_history_product->select3($id)->result();

	// 	foreach ($transaction_product as $row) {
	// 		$barang = $this->m_products->getproduct($row->id_product)->row();
	// 		$stok = $barang->stok;

	// 		$newstok = $stok - $row->qty;

	// 		$data = array('stok' => $newstok);

	// 		$this->m_products->edit($data, $row->id_product);


	// 		$stok_notif = $this->m_stok_notification->selectWthProd($row->id_product)->result();

	// 		$i = 0;
	// 		foreach ($stok_notif as $row) {

	// 			if($i == 30){
	// 				sleep(10);
	// 			}

	// 			$email = $this->m_users->select($row->id_user)->row()->email;

	// 			$msg = 'Stok Untuk Barang <a href="'.base_url('product/'.$row->id_product).'"><b><i>'.$barang->nama_product.'</i></b></a> saat ini adalah <b><i>'.$newstok.'</i></b> barang';
	// 			$subject = "Notifikasi Stok - Marketplace Kombas";

	// 			$this->sendMail($email,$msg,$subject);		
	// 			$i++;		
	// 		}
	// 	}


	// 	if(!empty($admin)){
	// 		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
	// 		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
	// 		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil melakukan konfirmasi barang diterima.', 3);
	// 		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
	// 		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
	// 		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
	// 		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-excredreports-'.$_SESSION['id_user'] , 3);
	// 		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

	// 		redirect('dashboard/reports/exceeddeadline/delivered');
	// 	}else{
	// 		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
	// 		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
	// 		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil melakukan konfirmasi barang diterima.', 3);
	// 		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
	// 		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
	// 		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
	// 		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-pembelian-'.$_SESSION['id_user'] , 3);
	// 		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

	// 		redirect('dashboard/pembelian');
	// 	}
	// }


}

?>