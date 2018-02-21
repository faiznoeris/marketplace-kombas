<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Review extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_reviews','m_users','m_products','m_shop'));
	}

	function addreview(){

		$id_product = $this->uri->segment(3);
		$id_user = $_SESSION['id_user'];
		$ulasan = $this->input->post('ulasan');
		$bintang = $this->input->post('bintang');

		$date = date('Y-m-d');

		$data = array(
			'id_user' => $id_user,
			'id_product' => $id_product,
			'ulasan' => $ulasan,
			'date' => $date,
			$bintang => '1'
		);

		$this->m_reviews->insert($data);

		redirect('product/'.$id_product);

	}

}