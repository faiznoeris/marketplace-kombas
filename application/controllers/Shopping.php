<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('cart');
		$this->load->model(array('m_products','m_transaction_history'));
	}


	function placeorder(){
		//id_transaction	id_product	qty	id_user	date	totalprice	paymentmethod	status
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$session = $this->session->all_userdata();

		$payment = $this->input->post('paymentmethod');

		foreach ($this->cart->contents() as $items){

			$arr = explode('productID_', $items['id']);
			$id = $arr[1];

			$data = array(
				'id_product' => $id,
				'qty' => $items['qty'],
				'id_user' => $session['id_user'],
				'date' => $date,
				'totalprice' => $items['price'] * $items['qty'],
				'paymentmethod' => $payment,
				'status' => 'Pending'
			);

			$this->m_transaction_history->insert($data);

		}

		$this->cart->destroy();

		redirect('');

	}


	function destroycart(){
		$this->cart->destroy();
		redirect('');
	}

	function updatecart(){

		$id = $this->uri->segment(3);
		$qty = $this->uri->segment(4);

		$data = array(
			'rowid'  => $id,
			'qty'    => $qty
		);

		$this->cart->update($data);
		redirect('cart');
		// echo $id . " _ " . $qty;

	}

	function removecartitem(){

		$id = $this->uri->segment(3);

		// $data = array(
		// 	'id'   => $id,
		// 	'qty'     => 0
		// );

		$this->cart->remove($id);
		redirect('cart');
	}

	function addtocart(){

		// if($this->logged_in()){

		// 	redirect('login');

		// }else{

		$id = $this->uri->segment(3);
		$whobuy = $this->uri->segment(4);

		$harga = 0;

		$prod = $this->m_products->getproduct($id)->row();

		if($whobuy == "promo"){
			$harga = $prod->harga * $prod->discount_promo;
			$harga = $harga / 100;
			$harga = $prod->harga - $harga;	
		}else if($whobuy == "reseller"){
			$harga = $prod->harga * $prod->discount_reseller;
			$harga = $harga / 100;
			$harga = $prod->harga - $harga;	
		}else{
			$harga = $prod->harga;
		}

		$data = array(
			'id'      => 'productID_'.$prod->id_product,
			'qty'     => '1',
			'price'   => $harga,
			'sampul'  => $prod->sampul_path,
			'name'    => $prod->nama_product
		);

		//$this->cart->product_name_rules = '[:print:]';
		$this->cart->insert($data);

		redirect('');

		// }
	}

}

?>