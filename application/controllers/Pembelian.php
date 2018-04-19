<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_transaction_history_seller','m_transaction_history_product','m_shop','m_users','m_confirmation','m_users','m_products','m_stok_notification'));
	}

	function konfirmasitrf(){
		$id_transaction = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);
		$id_shop = $this->uri->segment(5);
		$jmlproduk = $this->uri->segment(6);
		$id_bank = $this->input->post('select_bank');
		$from_bank = $this->input->post('frombank');
		$atasnama = $this->input->post('atasnama');
		$no_rekening = $this->input->post('norekening');
		$bukti_path = '-';

		$data = array(
			'id_transaction' => $id_transaction,
			'id_user' => $id_user,
			'id_bank' => $id_bank,
			'from_bank' => $from_bank,
			'atasnama' => $atasnama,
			'no_rekening' => $no_rekening,
			'bukti_path' => $bukti_path
		);

		$this->m_confirmation->insert($data);

		$idprod = $this->m_confirmation->getConfLastId();
		$up_path = "./assets/images/bukti_transfer/";
		$name = "bukti_transfer";
		$element_name = "bukti_trf";


		if($this->uploadfoto($idprod,$up_path,$name,$element_name,"confirmation")){ 

			$data2 = array(
				'status' => "Transfer Confirmed By User"
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
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-pembelian-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect('dashboard/pembelian');
		}else{
			$this->m_confirmation->delete($idprod);

			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Gagal melakukan konfirmasi transfer '.$this->upload->display_errors().'.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-pembelian-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-error', 3);

			redirect('dashboard/pembelian');
		}



		


		
	}


	function barangditerima(){
		$id = $this->uri->segment(3);
		$id2 = $this->uri->segment(4);
		$saldo = $this->uri->segment(5);
		$saldobuyer = $this->uri->segment(6);
		$admin = $this->uri->segment(7);
		$id_user = $this->uri->segment(8);



		$data = array(
			'status' => "Delivered"
		);

		$this->m_transaction_history_seller->edit($data,$id,$id2);

		$id_seller = $this->m_shop->selectidshop($id2)->row()->id_user;

		$oldsaldo = $this->m_users->select($id_seller)->row()->saldo;

		$saldo = $saldo + $oldsaldo;

		$data = array(
			'saldo' => $saldo
		);

		$this->m_users->edit($data,$id_seller);

		$data = array(
			'saldo' => $saldobuyer
		);


		if(!empty($admin)){
			$this->m_users->edit($data,$id_user);
		}else{
			$this->m_users->edit($data,$_SESSION['id_user']);
		}


		$transaction_product = $this->m_transaction_history_product->select3($id)->result();

		foreach ($transaction_product as $row) {
			$barang = $this->m_products->getproduct($row->id_product)->row();
			$stok = $barang->stok;

			$newstok = $stok - $row->qty;

			$data = array('stok' => $newstok);

			$this->m_products->edit($data, $row->id_product);


			$stok_notif = $this->m_stok_notification->selectWthProd($row->id_product)->result();

			$i = 0;
			foreach ($stok_notif as $row) {

				if($i == 30){
					sleep(10);
				}

				$email = $this->m_users->select($row->id_user)->row()->email;

				$msg = 'Stok Untuk Barang <a href="'.base_url('product/'.$row->id_product).'"><b><i>'.$barang->nama_product.'</i></b></a> saat ini adalah <b><i>'.$newstok.'</i></b> barang';
				$subject = "Notifikasi Stok - Marketplace Kombas";

				$this->sendMail($email,$msg,$subject);		
				$i++;		
			}
		}


		if(!empty($admin)){
			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil melakukan konfirmasi barang diterima.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-excredreports-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect('dashboard/reports/exceeddeadline/delivered');
		}else{
			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil melakukan konfirmasi barang diterima.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-pembelian-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect('dashboard/pembelian');
		}
	}


}

?>