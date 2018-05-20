<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array('m_shop','m_users','m_seller_pending_approval','m_products','m_category','m_transaction_history_seller','m_transaction_history_product','m_transaction_history','m_withdrawal','m_transaction_cancelled'));
		$this->load->model(array('M_Seller'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '4000';
		$this->notif_data['sticky'] = 'false';
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function withdraw(){
		$id_shop = $this->uri->segment(3);

		if($this->isLoggedin()){
			$q = $this->M_Seller->insert_withdraw($this->input->post(), $id_shop);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengajukan withdraw saldo.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "saldo_tdkcukup"){
				$this->notif_data['message'] = 'Saldo tidak mencukupi!';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
				$this->session->set_flashdata('error','*Saldo tidak mencukupi untuk withdraw!');
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong!';
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

	function cancelorder(){
		$id_transaksi = $this->uri->segment(3);
		$jmlproduk = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Seller->insert_cancelorder($id_transaksi, $jmlproduk);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil membatalkan order.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
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

	function barangdikirim(){
		$id_transaksi = $this->uri->segment(3);
		$jmlproduk = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Seller->update_brgdikirim($this->input->post(), $id_transaksi, $jmlproduk);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengupdate stasus order menjadi "On Delivery".';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong!';
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

	function updateresi(){
		$id_transaksi = $this->uri->segment(3);
		$jmlproduk = $this->uri->segment(4);

		if($this->isLoggedin()){
			$q = $this->M_Seller->update_resi($this->input->post(), $id_transaksi, $jmlproduk);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengupdate stasus order menjadi "On Delivery".';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong!';
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

	function edittoko(){
		$id_shop = $this->uri->segment(3);
		if($this->isLoggedin()){
			$q = $this->M_Seller->update_toko($this->input->post(), $id_shop);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengupdate toko.';
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
				$this->session->set_flashdata('error','Terjadi kesalahan Error: '.$q);
			}

			$this->notif_data($this->notif_data);
			redirect('account/profile#pengaturan');

		}else{
			redirect('');
		}
	}

	function editproduct(){
		$id_product = $this->uri->segment(3);
		if($this->isLoggedin()){
			$q = $this->M_Seller->update_product($this->input->post(), $id_product);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengupdate product.';
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
				$this->session->set_flashdata('error','Terjadi kesalahan Error: '.$q);

				$this->notif_data($this->notif_data);
				redirect('account/product/edit/'.$id_product.'/gagal');
			}

			$this->notif_data($this->notif_data);
			redirect('account/product/edit/'.$id_product);
		}else{
			redirect('');
		}
	}

	function addproduct(){
		$id_shop = $this->uri->segment(3);
		if($this->isLoggedin()){
			$q = $this->M_Seller->insert_product($this->input->post(), $id_shop);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil menambah product.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else if($q == "shop_notfound"){
				$this->notif_data['message'] = 'Toko tidak ditemukan.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
				$this->session->set_flashdata('error','Terjadi kesalahan Error: '.$q);
			}

			$this->notif_data($this->notif_data);
			redirect('account/profile#riwayat');	
		}else{
			redirect('');
		}	

	}

	function deleteproduct(){
		$id_product = $this->uri->segment(3);
		if($this->isLoggedin() == true){
			$q = $this->M_Seller->delete_product($id_product);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil menghapus product.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);
			redirect("dashboard/products");
		}else{
			redirect('');
		}
	}
}
?>