<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Seller extends CI_Model{

	function get_shop($id_shop){
		return $this->db
		->where('id_shop',$id_shop)
		->limit(1)
		->get('shops');
	}

	function get_user($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users');
	}

	function insert_withdraw($input, $id_shop){

		if(!empty($input)){
			$date = date('Y-m-d H:i:s');

			$shop = $this->get_shop($id_shop)->row();
			$seller = $this->get_user($shop->id_user)->row();

			$data_withdrawal = array(
				'id_shop' => $id_shop,
				'date' => $date,
				'amount' => $input['amount'],
				'status' => 'Pending'
			);

			$saldo_afterwithdraw = $seller->saldo - $input['amount'];

			$data_user = array(
				'saldo' => $saldo_afterwithdraw
			);

			if($saldo_afterwithdraw < 0){
				return 'saldo_tdkcukup';
			}else{

				if($this->db->insert('withdrawal', $data_withdrawal)){

					$this->db->where('id_user', $seller->id_user);
					if($this->db->update('users', $data_user)){
						return "success";
					}else{
						return $this->db->_error_message();
					}

				}else{
					return $this->db->_error_message();
				}
			}
		}else{
			return "empty_data";
		}
	}

	function get_dataold($id_transaksi){
		return $this->db
		->where('id_transaction', $id_transaksi)
		->limit(1)
		->get('transaction_history');
	}

	function get_datatotal($id_transaksi, $id_shop){
		return $this->db
		->where("id_transaction",$id_transaksi)
		->where("id_shop",$id_shop)
		->get('transaction_history_seller');
	}

	function insert_cancelorder($id_transaksi, $jmlproduk){
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');

		$dataold = $this->get_dataold($id_transaksi)->row();
		$datatotal = $this->get_datatotal($id_transaksi,$this->session->userdata('id_shop'))->row();

		if($datatotal->status == "Pending"){
			$refund = '1';
		}else{
			$refund = '0';
		}

		$data = array(
			'id_transaction' => $id_transaksi,
			'id_user' => $dataold->id_user,
			'id_shop' => $this->session->userdata('id_shop'),
			'cart'	=> 	serialize($dataold->cart),
			'total'	=> $datatotal->totalharga + $dataold->totalongkir + $dataold->kode_unik,
			'last_status' => $datatotal->status,
			'date' => $date,
			'refund' => $refund
		);

		if($this->db->insert('transaction_cancelled', $data)){
			if($jmlproduk > 1){
				for ($i=0; $i < $jmlproduk; $i++) { 

					if($this->db->delete('transaction_history_seller', array('id_transaction' => $id_transaksi, 'id_shop' => $this->session->userdata('id_shop')))){
						if($this->db->delete('transaction_history_product', array('id_transaction' => $id_transaksi, 'id_shop' => $this->session->userdata('id_shop')))){

						}else{
							return $this->db->_error_message();
						}					
					}else{
						return $this->db->_error_message();
					}
				}

				return "success";
			}else{
				if($this->db->delete('transaction_history_seller', array('id_transaction' => $id_transaksi, 'id_shop' => $this->session->userdata('id_shop')))){
					if($this->db->delete('transaction_history_product', array('id_transaction' => $id_transaksi, 'id_shop' => $this->session->userdata('id_shop')))){
						return "success";
					}else{
						return $this->db->_error_message();
					}					
				}else{
					return $this->db->_error_message();
				}
			}
		}else{
			return $this->db->_error_message();
		}
	}

	function update_brgdikirim($input, $id_transaksi, $jmlproduk){

		if(!empty($input)){
			$date = date('Y-m-d H:i:s');
			$resi = $input['resi'];

			$data = array(
				'resi' => $resi,
				'status' => 'On Delivery', 
				'date_delivered' => $date, 
				'warning' => '0'
			);

			if($jmlproduk > 1){
				for ($i=0; $i < $jmlproduk; $i++) { 

					$this->db->where('id_transaction', $id_transaksi);
					$this->db->where('id_shop', $this->session->userdata('id_shop'));

					if($this->db->update('transaction_history_seller', $data)){

					}else{
						return $this->db->_error_message();
					}

				}

				return "success";
			}else{
				$this->db->where('id_transaction', $id_transaksi);
				$this->db->where('id_shop', $this->session->userdata('id_shop'));

				if($this->db->update('transaction_history_seller', $data)){
					return "success";
				}else{
					return $this->db->_error_message();
				}
			}

		}else{
			return "empty_data";
		}
	}

	function update_resi($input, $id_transaksi, $jmlproduk){
		if(!empty($input)){
			$resi = $input['resi'];
			$data = array('resi' => $resi);

			if($jmlproduk > 1){
				for ($i=0; $i < $jmlproduk; $i++) { 

					$this->db->where('id_transaction', $id_transaksi);
					$this->db->where('id_shop', $this->session->userdata('id_shop'));

					if($this->db->update('transaction_history_seller', $data)){

					}else{
						return $this->db->_error_message();
					}

				}

				return "success";
			}else{
				$this->db->where('id_transaction', $id_transaksi);
				$this->db->where('id_shop', $this->session->userdata('id_shop'));

				if($this->db->update('transaction_history_seller', $data)){
					return "success";
				}else{
					return $this->db->_error_message();
				}
			}

		}else{
			return "empty_data";
		}
	}

	function update_toko($input, $id_shop){
		if(!empty($input)){
			$toko_buka = $input['toko_buka'];
			$kota_asal = $input['kota_asal'];
			$bank = $input['bank'];
			$rekening = $input['rekening'];
			$jne = $input['jne'];
			$tiki = $input['tiki'];
			$pos = $input['pos'];

			$shop = $this->get_shop($id_shop)->row();
			$cour_array = explode(',',$shop->kurir);

			if($toko_buka == 'on'){
				$buka = '1';
			}else{
				$buka = '0';
			}

			if($jne == 'on'){ //if jne is checked
				$jne_already_on = false; //variable to check if jne is already set in the table of the shop
				foreach ($cour_array as $row) { //loop the the array courier (jne, tiki, pos) < example
					if($row == "jne" && $jne_already_on == false){ //if jne found in the array, we set the variable that mark if jne is available in the table to true
						$jne_already_on = true;
					}
				}
				if($jne_already_on == false){
					array_push($cour_array, "jne");
				}
			}else{ //if jne is not checked, remvoe them from the array
				foreach ($cour_array as $row => $name) {
					if($name == "jne"){
						unset($cour_array[$row]);
					}
				}
			}

			if($tiki == 'on'){
				$tiki_already_on = false;
				foreach ($cour_array as $row) {
					if($row == "tiki" && $tiki_already_on == false){
						$tiki_already_on = true;
					}
				}
				if($tiki_already_on == false){
					array_push($cour_array, "tiki");
				}
			}else{
				foreach ($cour_array as $row => $name) {
					if($name == "tiki"){
						unset($cour_array[$row]);
					}
				}
			}

			if($pos == 'on'){
				$pos_already_on = false;
				foreach ($cour_array as $row) {
					if($row == "pos" && $pos_already_on == false){
						$pos_already_on = true;
					}
				}
				if($pos_already_on == false){
					array_push($cour_array, "pos");
				}
			}else{
				foreach ($cour_array as $row => $name) {
					if($name == "pos"){
						unset($cour_array[$row]);
					}
				}
			}

			$kurir = implode(",",$cour_array);
			$data = array(
				'toko_buka' => $buka,
				'kota_asal' => $kota_asal,
				'kurir' => $kurir,
				'rekening' => $rekening,
				'bank' => $bank
			);

			$this->db->where('id_shop', $id_shop);
			if($this->db->update('shops', $data)){
				return "success";
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "empty_data";
		}
	}

	function get_product($id_product){
		return $this->db
		->where('id_product', $id_product)
		->limit(1)
		->get('products');
	}

	function update_product($input, $id_product){
		if(!empty($input)){
			if(!empty($input['promo_aktif'])){
				$promo_aktif = $input['promo_aktif'];
			}else{
				$promo_aktif = "";
			}

			if ($promo_aktif == "on") {
				$promo = '1';
			}else{
				$promo = '0';
			}

			$data = array(
				'nama_product' => $input['nama_product'],
				'deskripsi_product' => $input['deskripsi_product'],
				'sku' => $input['kode_product'],
				'stok' => $input['stok_product'],
				'harga' => $input['harga_product'],
				'discount_reseller' => $input['discount_reseller'],
				'discount_promo' => $input['discount_promo'],
				'berat' => $input['berat_product'],
				'id_category' => $input['category'],
				'promo_aktif' => $promo
			);

			$old_file_sampul = $this->get_product($id_product)->row()->sampul_path;

			$this->db->where('id_product', $id_product);
			if($this->db->update('products', $data)){

				$config = array(
					'allowed_types' => "gif|jpg|png",
					'overwrite' => TRUE,
				);

				$config['upload_path'] = "./assets/images/products/";
				$config['max_size'] = "1024";
				$config['file_name'] = "product-". $id_product . "-" . rand(0,1000);
				$upload_sampul = $this->upload($id_product,$config,'sampul','sampul_path', $old_file_sampul);


				$galeri_path = $this->M_Seller->get_product($id_product)->row()->galeri_path;
				$galeri_explode = explode(',', $galeri_path);

				$galeri = array();
				$i = 1;

				foreach ($galeri_explode as $value) {
					if(!empty($value)){
						$galeri[$i] = $value;
						$i++;
					}
				}

				$config_galeri = array(
					'allowed_types' => "gif|jpg|png",
					'overwrite' => TRUE,
				);

				for ($i=1; $i < 6; $i++) { 
					if($_FILES['galeri_'.$i]['size'] != 0){

						$rand = rand(0, 1000);

						$config_galeri['upload_path'] = "./assets/images/products/gallery/";
						$config_galeri['max_size'] = "1024";
						$config_galeri['file_name'] = "product_gallery-". $id_product . "-" . $rand;
						$upload__galeri = $this->M_Seller->upload($id_product,$config_galeri,'galeri_'.$i,'galeri_path', $galeri[$i]);

						$array = explode('.', $_FILES['galeri_'.$i]['name']);
						$extension = end($array);

						$galeri[$i] = "assets/images/products/gallery/product_gallery-".$id_product."-".$rand.".".$extension;

					}else if(!empty($input['cbdelpict_'.$i]) && $input['cbdelpict_'.$i] == "on"){
						unlink($galeri[$i]);
						unset($galeri[$i]);
					}
				}

				$final_galeri_path = "";
				foreach($galeri as $value){
					if(!empty($value)){
						$final_galeri_path .= $value.",";
					}
				}

				$this->db->set('galeri_path', $final_galeri_path);
				$this->db->where('id_product', $id_product);
				if($this->db->update('products')){
					return "success";
				}else{
					return $this->db->_error_message();
				}
				
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "empty_data";
		}
	}

	public $product_lastid;

	public function set_productlastid($id_product){
		$this->product_lastid = $id_product;
	}

	public function get_productlastid(){
		return $this->product_lastid;
	}

	function insert_product($input, $id_shop){
		if(!empty($input)){
			// $promo_aktif				=	$input['promo_aktif'];

			if (!empty($input['promo_aktif']) && $input['promo_aktif'] == "on") {
				$promo = '1';
			}else{
				$promo = '0';
			}

			$data = array(
				'id_shop' => $id_shop,
				'nama_product' => $input['nama_product'],
				'deskripsi_product' => $input['deskripsi_product'],
				'sku' => $input['kode_product'],
				'stok' => $input['stok_product'],
				'harga' => $input['harga_product'],
				'discount_reseller' => $input['discount_reseller'],
				'discount_promo' => $input['discount_promo'],
				'berat' => $input['berat_product'],
				'id_category' => $input['category'],
				'promo_aktif' => $promo
			);

			if($this->db->insert('products', $data)){
				$this->set_productlastid($this->db->insert_id());
				$id_insert = $this->db->insert_id();

				$files = get_filenames("./assets/images/products");
				$json = array();
				foreach ($files as &$file) {
					if(strpos($file, "PRODUCTADD_".$this->session->userdata('id_user')."_") !== false){
						array_push($json, $file);
					}
				}
				$galeri = "";
				$sampul = "";
				$i = 1;
				foreach ($json as $value) {
					$pos = strrpos($value, '.');
					if ($pos === false){
						$ext = "";
					}else{
						$ext = substr($value, $pos);
					}

					$rand = rand(0, 1000);

					if($i == 1){
						$sampul = "assets/images/products/product-".$id_insert."-".$rand.$ext;
						rename("./assets/images/products/".$value, "./assets/images/products/product-".$id_insert."-".$rand.$ext);
					}else{
						$galeri .= "assets/images/products/gallery/product_gallery-".$id_insert."-".$rand.$ext.",";
						rename("./assets/images/products/".$value, "./assets/images/products/gallery/product_gallery-".$id_insert."-".$rand.$ext);
					}
					
					$i++;
				}

				$data_update = array('sampul_path' => $sampul, 'galeri_path' => $galeri);
				$this->db->set($data_update);
				$this->db->where('id_product', $id_insert);
				if($this->db->update('products', $data_update)){
					return "success";
				}else{
					return $this->db->_error_message();
				}

				// return "success";
				
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "empty_data";
		}
	}

	function delete_product($id_product){
		if($this->db->delete('products', array('id_product' => $id_product))){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function upload($id_product,$config,$input_name,$column_name,$old_file){

		$this->upload->initialize($config);

		if($this->upload->do_upload($input_name)){
			$path 				= 	$this->upload->data();
			$path 				= 	$path["full_path"];
			$path 				= 	substr($path, 31);

			if($column_name != "galeri_path"){
				$this->db->set($column_name, $path);
				$this->db->where('id_product', $id_product);

				if($this->db->update('products')){
					if(!empty($old_file)){
						unlink($old_file); //delete file
					}
					return "success";
				}else{
					return $this->db->_error_message();
				}
			}else{
				unlink($old_file);
				return "success";
			}

		}else{
			return $this->upload->display_errors();
		}
	}

}
?>