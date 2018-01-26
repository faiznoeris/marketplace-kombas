<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('cart');
		$this->load->model(array('m_products','m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_users','m_shop'));
	}

	// function test(){
	// 	$rand = rand(0,999);
	// 	$harga = 9999999;
	// 	$new = substr($harga, 0, -3) . $rand;
	// 	echo $new;
	// }

	function placeorder(){
		//id_transaction	id_product	qty	id_user	date	totalprice	paymentmethod	status
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$session = $this->session->all_userdata();

		$payment = $this->input->post('paymentmethod');
		$address = $this->input->post('alamat');
		$totalongkir = 0;
		$jenis_paket = "";

		$id_prod = "";
		$id_shop = "";
		$cour = "";
		$totalprice = 0;
		$totalqty = 0;

		$cart = $this->cart->contents();

		function sortByName($a, $b)
		{
			$a = $a['seller'];
			$b = $b['seller'];

			if ($a == $b) return 0;
			return ($a < $b) ? -1 : 1;
		}

		usort($cart, 'sortByName');

		foreach ($cart as $items){
			// $arr = explode('productID_', $items['id']);
			// $id = $arr[1];

			$id_prod .= $items['id_prod'].",";
			$id_shop .= $items['id_shop'].",";
			$totalprice += $items['price'] * $items['qty'];
			$totalqty += $items['qty'];

			$ongkir = $this->input->post('tipepaket'.$items['id_prod']);
			$kurir = $this->input->post('kurir'.$items['id_prod']);

			$kurir = explode('|', $kurir);

			if(!empty($kurir[0])){
				$cour .= $kurir[0].",";
			}
			$ongkir = explode('|',$ongkir);

			$totalongkir += $ongkir[1];


		}

		$rand = rand(0,999);
		$totalprice = substr($totalprice, 0, -3) . $rand; //kode unik pembayaran

		
		$data = array(
			'id_product' => $id_prod,
			'id_shop' => $id_shop,
			'id_address' => $address,
			'qty' => $totalqty,
			'id_user' => $session['id_user'],
			'date' => $date,
			'totalprice' => $totalprice,
			'totalongkir' => $totalongkir,
			// 'kurir' => $cour,
			'paymentmethod' => $payment,
			// 'status' => 'Pending'
		);

		$this->m_transaction_history->insert($data);

		$id_transaksi = $this->m_transaction_history->getTransLastId();

		$lastseller = "";
		$first = true;
		$insertdata = true;
		$prods = "";
		$totalharga = 0;
		$totalongkir = 0;
		$totalqty = 0;
		$cour = "";

		function assc_array_count_values( $array, $key ) {
			foreach( $array as $row ) {
				$new_array[] = $row[$key];
			}
							// print_r(array_count_values( $new_array ));
			return array_count_values( $new_array );
		}

		$totalprodperseller = assc_array_count_values($cart, 'seller');

		foreach ($cart as $items){

			$data = array(
				'id_transaction' => $id_transaksi,
				'id_shop' =>  $items['id_shop'],
				'id_product' => $items['id_prod'],
				'qty' => $items['qty'],
				'berat' => $items['berat'],
				'harga' => $items['price'] * $items['qty']
			);

			$this->m_transaction_history_product->insert($data);


			$prods .= $items['id_prod'].",";
			$totalharga += $items['price'];
			$totalqty += $items['qty'];


			$ongkir = $this->input->post('tipepaket'.$items['id_prod']);
			$kurir = $this->input->post('kurir'.$items['id_prod']);

			$kurir = explode('|', $kurir);
			$ongkir = explode('|',$ongkir);

			$totalongkir += $ongkir[1];

			if(!empty($kurir[0])){
				$cour = $kurir[0];
			}

			if($totalprodperseller[$items['seller']] != 1){
				if($lastseller != $items['seller'] && $first == true){
					$first = false;
					$insertdata = false;

				}else if($lastseller != $items['seller'] && $first == false){
					$first = true;
					$insertdata = false;
				}else{
					$insertdata = true;
				}
			}else{
				$insertdata = true;
			}

			$lastseller = $items['seller'];

			$ongkir = $this->input->post('tipepaket'.$items['id_prod']);

			$ongkir = explode('|',$ongkir);

			$jenis_paket = $ongkir[0];


			if($insertdata){
				$totalharga = substr($totalharga, 0, -3) . $rand; //kode unik pembayaran
				$data = array(
					'id_transaction' => $id_transaksi,
					'id_shop' =>  $items['id_shop'],
					'id_product' => $prods,
					'totalharga' => $totalharga,
					'totalongkir' => $totalongkir,
					'totalqty' => $totalqty,
					'kurir' => $cour,
					'jenis_paket' => $jenis_paket,
					// 'paymentmethod' => $payment,
					'status' => 'Pending'
				);

				$this->m_transaction_history_seller->insert($data);

				$prods = "";
				$totalharga = 0;
				$totalongkir = 0;
				$totalqty = 0;
				$cour = "";
			}

		}

		$this->cart->destroy();

		redirect('order/details/'.$id_transaksi);

	}


	function destroycart(){
		$this->cart->destroy();
		redirect('');
	}

	function updatecart(){

		$id = $this->uri->segment(3);
		$qty = $this->uri->segment(4);
		$id_prod = $this->uri->segment(5);

		$prod = $this->m_products->getproduct($id_prod)->row();

		$berat = $prod->berat * $qty;

		$data = array(
			'rowid'  => $id,
			'qty'    => $qty,
			'berat'  => $berat
		);

		if($berat > 30000){
			redirect('cart');
		}else{
			$this->cart->update($data);
			redirect('cart');
		}

		

		// echo $prod->berat*$qty. " - ". $qty;
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

		if($this->isLoggedin() != true){
			redirect('login');
		}else{



			$id = $this->uri->segment(3);
			$whobuy = $this->uri->segment(4);

			$harga = 0;

			$prod = $this->m_products->getproduct($id)->row();
			$shop =	$this->m_shop->selectidshop($prod->id_shop)->row();
			$seller	= $this->m_users->select($shop->id_user)->row();

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
				'name'    => $prod->nama_product,
				'seller'  => $seller->username,
				'asal'	  => $shop->kota_asal,
				'berat'  => $prod->berat,
				'id_shop' => $prod->id_shop,
				'id_prod' => $prod->id_product
			);

		//$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($data);

			redirect('');

		// }
		}
	}

}

?>