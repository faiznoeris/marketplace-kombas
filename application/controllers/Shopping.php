<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model(array('M_Shopping'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '4000';
		$this->notif_data['sticky'] = true;
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function destroycart(){
		if($this->isLoggedin()){
			$this->cart->destroy();
		}
		redirect('');
	}

	function addtocart(){
		$id_product = $this->uri->segment(3);
		$user_type = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Shopping->insert_cart($id_product, $user_type);

			if($q == "success"){
				$this->notif_data['message'] = 'Barang telah ditambahkan ke kantong belanja.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "type_not_recognized"){
				$this->notif_data['message'] = 'Tipe user tidak diketahui!';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);

			redirect('shopping/cart');

		}else{
			redirect('');
		}
	}

	function updatecart(){
		$row_id = $this->uri->segment(3);
		$qty = $this->uri->segment(4);
		$id_product = $this->uri->segment(5);

		if($this->isLoggedin()){
			$q = $this->M_Shopping->update_cart($row_id, $qty, $id_product);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengupdate kantong belanja.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "weight_max"){
				$this->notif_data['message'] = 'Berat melebihi kapasitas pengiriman!';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);

			redirect('shopping/cart');

		}else{
			redirect('');
		}
	}

	function removecartitem(){
		$row_id = $this->uri->segment(3);

		if($this->isLoggedin()){
			$this->cart->remove($row_id);

			$this->notif_data['message'] = 'Berhasil menghapus barang dari kantong belanja.';
			$this->notif_data['theme'] = 'bg-success alert-styled-left';
			$this->notif_data['group'] = 'alert-success';

			$this->notif_data($this->notif_data);

			redirect('shopping/cart');
		}else{
			redirect('');
		}
	}

	function turnsontoknotif(){
		$id_product = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Shopping->stoknotif_on($id_product, $id_user);
			$product = $this->M_Shopping->get_product($id_product);

			if($q == "success"){
				$reseller = $this->M_Shopping->get_user($id_user);
				$data["reseller"] = $reseller;
				$data["product"] = $product;

				$msg = $this->load->view('template/v_stoknotification', $data, true);
				$subject = "Notifikasi Stok - Marketplace Kombas";

				if($this->sendMail($reseller->email,$msg,$subject)){
					$this->notif_data['message'] = 'Berhasil menyalakan notifikasi stok barang.';
					$this->notif_data['theme'] = 'bg-success alert-styled-left';
					$this->notif_data['group'] = 'alert-success';
				}else{
					$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$this->email->print_debugger();
					$this->notif_data['theme'] = 'bg-danger alert-styled-left';
					$this->notif_data['group'] = 'alert-danger';
				}

				
			}else if($q == "not_reseller"){
				$this->notif_data['message'] = 'Hanya reseller yang dapat menyalakan notifikasi stok barang untuk saat ini.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);

			redirect('product/'.$product->nama_product);

		}else{
			redirect('');
		}
	}

	function turnsofftoknotif(){
		$id_product = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Shopping->stoknotif_off($id_product, $id_user);
			$product = $this->M_Shopping->get_product($id_product);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mematikan notifikasi stok barang.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "not_reseller"){
				$this->notif_data['message'] = 'Hanya reseller yang dapat menyalakan notifikasi stok barang untuk saat ini.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);

			redirect('product/'.$product->nama_product);

		}else{
			redirect('');
		}
	}

	function placeorder(){
		$q = $this->M_Shopping->insert_order($this->input->post());

		if($this->isLoggedin()){

			if($q == "success"){

				$user = $this->M_Shopping->get_user($this->session->userdata('id_user'));

				// $data['bank'] = $this->M_Shopping->get_bank()->result();
				$data['id_transaksi'] = $this->M_Shopping->getlast_idtransaksi();
				$data['trans_history'] = $this->M_Shopping->get_transactionhistory($data['id_transaksi'])->row();
				$data['shipment'] = $this->M_Shopping->get_address($data['trans_history']->id_address)->row();

				$msg = $this->load->view('template/v_orderdetail', $data, true);
				$subject = "Invoice Transaksi #".$data['id_transaksi']." - Marketplace Kombas";

				if(!empty($user->email)){
					$this->sendMail($user->email,$msg,$subject);
				}

				/* SEND EMAIL NOTIF STOK TO RESELLER */

				$cart = unserialize($data["trans_history"]->cart);
				$sellerbefore = "";

				foreach ($cart as $items) {
					$q_reseller = $this->M_Shopping->get_reseller($items['id_prod'])->result();
					$product = $this->M_Shopping->get_product($items['id_prod']);

					$q_shop = $this->M_Shopping->get_shop($items['id_shop']);
					$q_seller= $this->M_Shopping->get_user($q_shop->id_user);

					$data["seller"] = $q_seller;
					$data["id_transaction"] = $data["id_transaksi"];

					$msg = $this->load->view('template/v_sellerneworder', $data, true);
					$subject = "Anda mendapat pesanan baru - Marketplace Kombas";

					if($sellerbefore != $q_seller->username){
						$this->sendMail($q_seller->email,$msg,$subject);
					}
					$sellerbefore = $q_seller->username;

					foreach ($q_reseller as $value) {
						$reseller = $this->M_Shopping->get_user($value->id_user);
						$data["reseller"] = $reseller;
						$data["product"] = $product;

						$msg = $this->load->view('template/v_stoknotification', $data, true);
						$subject = "Notifikasi Stok - Marketplace Kombas";

						$this->sendMail($reseller->email,$msg,$subject);
					}
				}

				/* SEND EMAIL NOTIF STOK TO RESELLER */

				$this->notif_data['message'] = 'Berhasil melakukan pemesanan barang!';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';

				$this->cart->destroy();

				$this->notif_data($this->notif_data);

				redirect('order/details/'.$data['id_transaksi']);
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

			redirect('');

		}else{
			redirect('');
		}
	}


}

?>