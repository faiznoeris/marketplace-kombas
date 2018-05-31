<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Shopping extends CI_Model{

	function get_product($id_product){
		return $this->db
		->where('id_product', $id_product)
		->limit(1)
		->get('products')
		->row();
	}

	function get_shop($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->limit(1)
		->get('shops')
		->row();
	}

	function get_user($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users')
		->row();
	}

	function insert_cart($id_product, $user_type){
		$harga = 0;
		$product = $this->get_product($id_product);
		$shop = $this->get_shop($product->id_shop);
		$seller = $this->get_user($shop->id_user);

		if($user_type == "promo"){
			$harga = $product->harga * $product->discount_promo;
			$harga = $harga / 100;
			$harga = $product->harga - $harga;	
		}else if($user_type == "reseller"){
			$harga = $product->harga * $product->discount_reseller;
			$harga = $harga / 100;
			$harga = $product->harga - $harga;	
		}else if($user_type == "reguler"){
			$harga = $product->harga;
		}else{
			return "type_not_recognized";
		}

		$data = array(
			'id' => 'productID_'.$product->id_product,
			'qty' => '1',
			'price' => $harga,
			'sampul' => $product->sampul_path,
			'name' => $product->nama_product,
			'seller' => $seller->username,
			'asal' => $shop->kota_asal,
			'berat' => $product->berat,
			'id_shop' => $product->id_shop,
			'id_prod' => $product->id_product,
			'url' => $product->url,
			'realprice' => $product->harga
		);

		$this->cart->insert($data);

		return "success";
	}

	function update_cart($row_id, $qty, $id_product){
		$product = $this->get_product($id_product);
		$berat = $product->berat * $qty;

		$data = array(
			'rowid'  => $row_id,
			'qty'    => $qty,
			'berat'  => $berat
		);

		if($berat > 30000){ //max 30kg
			return "weight_max";
		}else{
			$this->cart->update($data);
			return "success";
		}
	}

	function stoknotif_on($id_product, $id_user){
		$user_type = $this->get_user($id_user)->id_userlevel;

		if($user_type == "5"){//is reseller
			$reseller = $this->get_user($id_user);

			$data = array('id_product' => $id_product, 'id_user' => $id_user);

			if($this->db->insert('stock_notification', $data)){
				return "success";
			}else{
				return $this->db->_error_message();
			}
			
		}else{
			return "not_reseller";
		}
	}

	function stoknotif_off($id_product, $id_user){
		$user_type = $this->get_user($id_user)->id_userlevel;

		if($user_type == "5"){//is reseller

			$this->db->where('id_product', $id_product);
			$this->db->where('id_user', $id_user);

			if($this->db->delete('stock_notification')){
				return "success";
			}else{
				return $this->db->_error_message();
			}
			
		}else{
			return "not_reseller";
		}
	}

	function assc_array_count_values( $array, $key ) {
		foreach( $array as $row ) {
			$new_array[] = $row[$key];
		}

		return array_count_values( $new_array );
	}

	public $last_idtransaksi;

	function setlast_idtransaksi($id_transaksi){
		$this->last_idtransaksi = $id_transaksi;
	}

	function getlast_idtransaksi(){
		return $this->last_idtransaksi;
	}

	function get_transactionhistory($id_transaksi){
		return $this->db
		->where('id_transaction', $id_transaksi)
		->limit(1)
		->get('transaction_history');
	}

	function get_address($id_address){
		return $this->db
		->where('id_address', $id_address)
		->limit(1)
		->get('address');
	}

	function insert_order($input){
		date_default_timezone_set('Asia/Jakarta');

		if(!empty($input)){

			/* transaction_history */

			$totalongkir = 0;
			$totalprice = 0;
			$totalqty = 0;

			$date = date('Y-m-d H:i:s');
			$cart = $this->cart->contents();
			// $totalprice = $input['total_trf'];
			$kodeunik = $input['kode_trf'];
			$totalpricebarang = $input['total_brg'];
			$incl_saldo = $input['incl_saldo'];

			if($incl_saldo == 'on'){

				if(($totalpricebarang - $input['from_saldo']) > 0){
					$totalpricebarang = $totalpricebarang - $input['from_saldo']; 
				}else if($totalongkir - $input['from_saldo'] > 0){
					$totalongkir = $totalongkir - $input['from_saldo'];
				}

				$user = $this->get_user($this->session->userdata('id_user'));

				$new_saldo = $user->saldo - $input['from_saldo'];

				$this->db->where('id_user', $this->session->userdata('id_user'));
				$this->db->update('users', array('saldo' => $new_saldo));
			}

			function sort_byname($a, $b){
				$a = $a['seller'];
				$b = $b['seller'];

				if ($a == $b) return 0;
				return ($a < $b) ? -1 : 1;
			}

			usort($cart, 'sort_byname'); //sort cart by seller name

			foreach ($cart as $items){
				$ongkir = $input['tipepaket'.$items['id_prod']];

				$ongkir = explode('|',$ongkir);
				
				$totalqty += $items['qty'];
				$totalongkir += $ongkir[3];
			}

			$data = array(
				'id_address' => $input['alamat'],
				'qty' => $totalqty,
				'id_user' => $this->session->userdata('id_user'),
				'date' => $date,
				'totalprice' => $totalpricebarang,
				'totalongkir' => $totalongkir,
				'kode_unik' => $kodeunik,
				'cart' => serialize($cart)
			);

			/* transaction_history */

			if($this->db->insert('transaction_history', $data)){

				/* transaction_history_product */

				$id_transaksi = $this->db->insert_id();
				$this->setlast_idtransaksi($id_transaksi);
				$totalprodperseller = $this->assc_array_count_values($cart, 'seller');


				// $totalharga = 0;
				$totalongkir = 0;
				$totalqty = 0;
				$sellercount = 1;

				$first = true;
				$insertdata = true;

				$lastseller = "";
				// $prods = "";
				$cour = "";
				$jenis_paket = "";

				foreach ($cart as $items){

					$data = array(
						'id_transaction' => $id_transaksi,
						'id_shop' =>  $items['id_shop'],
						'id_product' => $items['id_prod'],
						'qty' => $items['qty'],
						'berat' => $items['berat'],
						'harga' => $items['price'] * $items['qty']
					);

					/* transaction_history_product */

					if($this->db->insert('transaction_history_product', $data)){

						/* transaction_history_seller */

						// $prods .= $items['id_prod'].",";
						// $totalharga += $items['price'];
						$totalqty += $items['qty'];

						$ongkir = $input['tipepaket'.$items['id_prod']];
						$kurir = $input['kurir'.$items['id_prod']];

						$kurir = explode('|', $kurir);
						$ongkir = explode('|',$ongkir);

						$totalongkir += $ongkir[3];

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

						$lastseller = $items['seller'];

						$ongkir = $input['tipepaket'.$items['id_prod']];

						$ongkir = explode('|',$ongkir);

						$jenis_paket = $ongkir[2];

						if($insertdata){

							$temp = $cart;

							foreach ($temp as $key => $value) {
								if($value['id_shop'] != $items['id_shop']){
									unset($temp[$key]);
								}
							}

							// print_r($temp);
							$data = array(
								'id_transaction' => $id_transaksi,
								'id_shop' =>  $items['id_shop'],
								'id_user' => $this->session->userdata('id_user'),
								'totalharga' => $totalpricebarang,
								'totalongkir' => $totalongkir,
								'totalqty' => $totalqty,
								'kode_unik' => $kodeunik,
								'kurir' => $cour,
								'jenis_paket' => $jenis_paket,
								'status' => 'Pending',
								'cart' => serialize($temp),
								'show_notif_neworder' => '0'
							);

							if($this->db->insert('transaction_history_seller', $data)){
								$prods = "";
								$totalharga = 0;
								$totalongkir = 0;
								$totalqty = 0;
								$cour = "";

								$q_prod = $this->get_product($items['id_prod']);
								$newstok = $q_prod->stok - 1;

								$data_update = array('stok' => $newstok);

								$this->db->where('id_product', $items['id_prod']);
								$this->db->update('products', $data_update);

							}else{
								exit();
								return $this->db->_error_message();
							}
						}

						/* transaction_history_seller */

					}else{
						exit();
						return $this->db->_error_message();
					}
				}//end loop items

				return "success";

			}else{
				return $this->db->_error_message();
			}

		}else{
			return "empty_data";
		}
	}

	function get_reseller($id_product){
		return $this->db
		->where('id_product', $id_product)
		->get('stock_notification');
	}

	// function get_bank(){
	// 	return $this->db
	// 	->get("banks");
	// }

}
?>