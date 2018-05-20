<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Review extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array('m_reviews','m_users','m_products','m_shop'));
		$this->load->model(array('M_Review'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '3500';
		$this->notif_data['sticky'] = 'false';
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}
	
	function addreview(){
		$id_product = $this->uri->segment(3);
		$id_user = $this->session->userdata('id_user');

		if($this->isLoggedin()){
			$q = $this->M_Review->add_review($this->input->post(), $id_product, $id_user);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil memberikan ulasan.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "not_buy_yet"){
				$this->notif_data['message'] = 'Untuk memberikan ulasan anda harus membeli produk tersebut terlebih dahulu.';
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
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

			redirect('product/'.$id_product);

		}else{
			redirect('');
		}
	}

}
?>