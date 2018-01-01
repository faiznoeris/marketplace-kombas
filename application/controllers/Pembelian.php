<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_transaction_history'));
	}

	function trfreceived(){
		$id = $this->uri->segment(3);

		$data = array(
			'trf_received_sts_seller' => "1",
			'status' => 'Confirmed By Seller'
		);

		if($this->m_transaction_history->edit($data,$id)){

			$up_path = "./assets/images/bukti_transfer/";
			$name = "bukti_trf";
			$element_name = "bukti_trf";

			if($this->uploadfoto($id,$up_path,$name,$element_name,"transaction_history")){
				$this->session->set_flashdata('info','Bukti transfer berhasil dikirim, dan akan dicek oleh seller untuk konfirmasi selanjutnya.');
				redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
			}else{
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
			}
		}else{
			$this->session->set_flashdata('error',"Terjadi kesalahan.");
			redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
		}
	}


	function trfsend(){
		$id = $this->uri->segment(3);

		$data = array(
			'trf_received_sts_buyer' => "1",
			'status' => 'Waiting Seller Confirmation'
		);

		

		if($this->m_transaction_history->edit($data,$id)){

			$up_path = "./assets/images/bukti_transfer/";
			$name = "bukti_trf";
			$element_name = "bukti_trf";

			if($this->uploadfoto($id,$up_path,$name,$element_name,"transaction_history")){
				$this->session->set_flashdata('info','Bukti transfer berhasil dikirim, dan akan dicek oleh seller untuk konfirmasi selanjutnya.');
				redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
			}else{
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
			}
		}else{
			$this->session->set_flashdata('error',"Terjadi kesalahan.");
			redirect('dashboard/pembelian/konfirmasitransfer/'.$id);
		}

		
	}

	function barangditerima(){
		$id = $this->uri->segment(3);

		$data = array(
			'barang_diterima' => "1"
		);

		$this->m_transaction_history->edit($data,$id);

		redirect('dashboard/pembelian');
	}


}

?>