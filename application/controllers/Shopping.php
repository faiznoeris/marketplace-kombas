<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('cart');
		// $this->load->model('billing_model');
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

		$data = array(
			'id'      => 'sku_123ABC',
			'qty'     => 1,
			'price'   => 500000,
			'name'    => 'Salvo Sepatu Pria Slip On Shoes A-01 / Size 39-4.',
			'options' => array('Size' => 'L', 'Color' => 'Red')
		);

		$this->cart->product_name_rules = '[:print:]';
		$this->cart->insert($data);

		redirect('');

		// }
	}

}

?>