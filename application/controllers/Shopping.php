<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('cart');
		$this->load->model(array('m_products','m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_users','m_shop','m_banks','m_address','m_stok_notification'));
	}

	// function test(){

	// 	// $rand = rand(0,999);
	// 	// $harga = 9999999;
	// 	// $new = substr($harga, 0, -3) . $rand;
	// 	// echo $new;

	// 	$msg = '

	// 	ASIU
	// 	';
	// 	$subject = "Invoice Transaksi # - Marketplace Kombas";

	// 	$session = $this->session->all_userdata();
	// 	$rowemail = $this->m_users->select($session['id_user'])->row()->email;

	// 	if(!empty($rowemail)){
	// 		$this->sendMail($rowemail,$msg,$subject);
	// 		echo "asu";
	// 	}else{
	// 		echo "string";
	// 	}
	// }

	function turnsontoknotif(){

		$id_product = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);

		$data = array('id_product' => $id_product, 'id_user' => $id_user);

		$this->m_stok_notification->insert($data);

		$email = $this->m_users->select($id_user)->row()->email;
		$barang = $this->m_products->getproduct($id_product)->row();

		$msg = 'Stok Untuk Barang <a href="'.base_url('product/'.$id_product).'"><b><i>'.$barang->nama_product.'</i></b></a> saat ini adalah <b><i>'.$barang->stok.'</i></b> barang';
		$subject = "Notifikasi Stok - Marketplace Kombas";

		$this->sendMail($email,$msg,$subject);

		redirect('product/'.$id_product);

	}

	function turnsofftoknotif(){

		$id_product = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);

		$this->m_stok_notification->delete($id_product, $id_user);

		redirect('product/'.$id_product);

	}

	function placeorder(){
		//id_transaction	id_product	qty	id_user	date	totalprice	paymentmethod	status
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$session = $this->session->all_userdata();

		// $payment = $this->input->post('paymentmethod');
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
			cart => serialize($cart)
			// 'kurir' => $cour,
			// 'paymentmethod' => $payment,
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
			
			return array_count_values( $new_array );
		}

		$totalprodperseller = assc_array_count_values($cart, 'seller');

		$sellercount = 1;

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

				if($totalprodperseller[$items['seller']] > 2){

					if($sellercount == $totalprodperseller[$items['seller']]){
						$insertdata = true;
					}else{
						$sellercount++;
						$insertdata = false;
					}


				}else{

					if($lastseller != $items['seller'] && $first == true){
						$first = false;
						$insertdata = false;

					}else if($lastseller != $items['seller'] && $first == false){
						$first = true;
						$insertdata = false;
					}else{
						$sellercount++;
						$insertdata = true;
					}

				}
			}else{
				$insertdata = true;
			}

			// if($totalprodperseller[$items['seller']] != 1){
			// 	if($lastseller != $items['seller'] && $first == true){
			// 		$first = false;
			// 		$insertdata = false;

			// 	}else if($lastseller != $items['seller'] && $first == false){
			// 		$first = true;
			// 		$insertdata = false;
			// 	}else{
			// 		$insertdata = true;
			// 	}
			// }else{
			// 	$insertdata = true;
			// }

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

		$rowemail = $this->m_users->select($session['id_user'])->row()->email;

		$data_bank		= 	$this->m_banks->select()->result();

		$trans_history		=	$this->m_transaction_history->select("orderdetails",$id_transaksi)->row();
		$trans_history_prod 	=	$this->m_transaction_history_product->select("transaction",$id_transaksi)->result();
		$trans_history_seller  	=	$this->m_transaction_history_seller->select("transaction",$id_transaksi)->result();

		$shipment		=	$this->m_address->select("address",$trans_history->id_address)->row();

		$msg = '

		<div class="container">

		<center><h2>Order Details <br><span style="font-size: 17px; font-style: italic;">#<b> '.$trans_history->id_transaction.'</b> &emsp;|&emsp; placed on: <b>'. $trans_history->date .'</b></span></h2></center><br>

		<div class="row">

		<div class="col-sm-12 rounded bg-light" style="padding: 10px 10px 10px 10px;">

		<div class="row">
		<div class="col-sm-6">
		<center>
		<h5>Shipping Information</h5>
		<hr class="featurette-divider w-25" style="margin-top: 15px; margin-bottom: 25px;">
		<span>
		a.n '. $shipment->atasnama .'<br>
		'. $shipment->alamat .', '. $shipment->kodepos .'<br>
		'. $shipment->telephone .'
		</span>
		</center>
		</div>

		</div>

		<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

		<div class="row">

		<center>
		<table class="table table-responsive w-75">
		<thead class="thead-default">
		<tr>
		<th width="5%">#</th>
		<th width="15%">Seller</th>
		<th width="20%">Gambar</th>
		<th width="45%">Nama Barang</th>
		<th width="15%">Jumlah</th>
		<th width="25%">Harga</th>
		</tr>
		</thead>
		<tbody>';


		$i = 1; 

		foreach($trans_history_prod as $prods){

			$prod_detail = $this->m_products->getproduct($prods->id_product)->row();
			$id_seller = $this->m_shop->selectidshop($prod_detail->id_shop)->row()->id_user;
			$seller = $this->m_users->select($id_seller)->row()->username;

			$msg .='
			<tr>
			<td>'. $i .'</td>
			<td>'. $seller .'</td>
			<td><img src="'. base_url($prod_detail->sampul_path) .'" width="130" height="130"></td>
			<td><a href="'. base_url('product/'.$prods->id_product) .'">'. $prod_detail->nama_product .' ('. number_format($prods->berat, 0, ',', '.') .' gram)</a></td>
			<td>'. $prods->qty .'</td>
			<td>Rp. '. number_format($prods->harga, 0, ',', '.') .'</td>

			</tr>';

			$i++;
		}

		$msg = $msg.'<tr>
		<th scope="row"></th>
		<td colspan="4" class="text-center"><b>SUB-TOTAL</b></td>
		<td colspan="5"><b>Rp. '. number_format($trans_history->totalprice, 0, ',', '.') .'</b></td>
		</tr>


		<tr>
		<th scope="row"></th>
		<td colspan="4" class="text-center"><b>ONGKIR</b></td>
		<td colspan="5"><b>Rp. '. number_format($trans_history->totalongkir, 0, ',', '.') .'</b></td>
		</tr>


		<tr>
		<th scope="row"></th>
		<td colspan="4" class="text-center"><b>TOTAL HARGA + ONGKIR</b></td>
		<td colspan="5"><b>Rp. '. number_format($trans_history->totalprice + $trans_history->totalongkir, 0, ',', '.') .'</b></td>
		</tr>
		</tbody>
		</table>
		</center>

		</div> <!-- /row -->

		<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

		<center>
		<h2>Transfer</h2>
		<span>Pilih salah satu dari rekening bank dibawah <br>untuk mentransfer dana pembelian<br>*<b>Semua rekening Atas Nama: PT. Kombas</b></span><br><br>
		<table>';


		foreach($data_bank as $row){
			$msg = $msg.'
			<tr>
			<td class="text-center" style="padding-right:10px">'. $row->no_rekening .'</td>
			<td class="text-center">'. $row->nama_bank .'</td>
			</tr>';
		}

		$msg = $msg.'</table>
		<br>
		<span style="font-size: 25px;"><b>Rp. '. number_format($trans_history->totalprice + $trans_history->totalongkir, 0, ',', '.') .'</b></span>
		<br>
		<span>Harap melakukan Transfer <br>sesuai dengan jumlah yang ada diatas</span>
		</center>

		<div class="row">

		<div class="col-sm-6">

		</div>

		<div class="col-sm-6">

		</div>

		</div>

		<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

		<div class="text-center">
		<a class="btn btn-primary" href="'. base_url("dashboard/pembelian") .'">Konfirmasi</a>
		<a class="btn btn-primary" href="'. base_url("category") .'">Lanjut Belanja</a>
		</div>

		<br>

		</div>
		</div>



		</div> 

		';
		$subject = "Invoice Transaksi #".$id_transaksi." - Marketplace Kombas";

		if(!empty($rowemail)){
			$this->sendMail($rowemail,$msg,$subject);
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

			redirect('cart');

// }
		}
	}

}

?>