<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_transaction_history_seller','m_shop','m_users'));
	}

	function barangditerima(){
		$id = $this->uri->segment(3);
		$id2 = $this->uri->segment(4);
		$saldo = $this->uri->segment(5);

		$data = array(
			'status' => "Delivered"
		);

		$this->m_transaction_history_seller->edit($data,$id,$id2);

		$id_seller = $this->m_shop->selectidshop($id2)->row()->id_user;

		$data = array(
			'saldo' => $saldo
		);

		$this->m_users->edit($data,$id_seller);

		redirect('dashboard/pembelian');
	}


}

?>