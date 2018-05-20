<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Ajax'));
	}

	/* IMAGE UPLOADING (ADD PRODUCT) */

	private $upload_path = "./assets/images/products";

	function uploadimage(){
		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			// $config['file_name'] = 'PRODUCT_ADD_0';
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}
		}
	}

	function deleteimage(){
		// $file = $this->input->post("file");
		// if ($file && file_exists($this->upload_path . "/" . $file)) {
		// 	unlink($this->upload_path . "/" . $file);
		// }
		unlink($this->upload_path . "/" .urldecode($this->uri->segment(3)));
	}

	// public function list_files()
	// {
	// 	$files = get_filenames("./assets/images/products");
	// 	$json = array();
	// 	foreach ($files as &$file) {
	// 		if(strpos($file, "PRODUCTADD_".$this->session->userdata('id_user')."_") !== false){
	// 			array_push($json, $file);
	// 		}
	// 	}
	// 	$i = 1;
	// 	print_r($json);
	// 	foreach ($json as $value) {

	// 		$pos = strrpos($value, '.');
	// 		if ($pos === false){
	// 			$ext = "";
	// 		}else{
	// 			$ext = substr($value, $pos);
	// 		}

	// 		if($this->db)

	// 		rename($this->upload_path."/".$value, $this->upload_path."/product-7-".$i.$ext);
	// 		$i++;
	// 	}

	// }

	/* IMAGE UPLOADING (ADD PRODUCT) */

	/* AUTO CHECK RESI * COOKIES */

	function cekresi(){
		$q_ondelivery = $this->M_Ajax->get_ondelivery();
		$q_pending = $this->M_Ajax->get_pending();

		if ($q_ondelivery == "empty" || $q_pending == "empty"){
			$response = array('success' => FALSE);
		}else {

			foreach($q_pending as $value){
				$this->curl_data[CURLOPT_URL] = "https://api.rajaongkir.com/basic/waybill";
				$this->curl_data[CURLOPT_CUSTOMREQUEST] = "POST";
				$this->curl_data[CURLOPT_POSTFIELDS] = "waybill=".$value->resi."&courier=".$value->kurir;

				$data = $this->get_curl($this->curl_data);

				if($data['rajaongkir']['result']['delivery_status']['status'] == "ON PROCESS"){
					$data = array('status' => 'On Delivery');
					$q_update_status = $this->M_Ajax->update_status($data, $value->id_trans_seller);

					if($q_update_status != "success"){
						// $response = array('success' => FALSE);
						exit();
					}
				}
			}

			foreach ($q_ondelivery as $value) {
				$this->curl_data[CURLOPT_URL] = "https://api.rajaongkir.com/basic/waybill";
				$this->curl_data[CURLOPT_CUSTOMREQUEST] = "POST";
				$this->curl_data[CURLOPT_POSTFIELDS] = "waybill=".$value->resi."&courier=".$value->kurir;

				$data = $this->get_curl($this->curl_data);

				if($data['rajaongkir']['result']['delivery_status']['status'] == "DELIVERED"){
					$data = array('status' => 'Delivered');
					$q_update_status = $this->M_Ajax->update_status($data, $value->id_trans_seller);

					if($q_update_status != "success"){
						// $response = array('success' => FALSE);
						exit();
					}else{
						$harga = $value->totalharga + $value->totalongkir + $value->kode_unik;
						$saldo_buyer = substr($harga, -3);
						$saldo_seller = substr($harga, 0, -3) . '000';

						$q_update_saldo = $this->M_Ajax->update_saldo($value->id_shop, $value->id_user, $saldo_buyer, $saldo_seller);

						if($q_update_saldo != "success"){
							// $response = array('success' => FALSE);
							exit();
						}else{
							$cart = unserialize($value->cart);

							foreach ($cart as $items) {
								$barang = $this->M_Ajax->get_product($items['id_prod'])->row();
								$stok = $barang->stok;

								$newstok = $stok - $items['qty'];

								$data = array('stok' => $newstok);

								$q_update_stok = $this->M_Ajax->update_product($items['id_prod'], $data);

								$stok_notif = $this->M_Ajax->get_notiflist($items['id_prod'])->result();

								$i = 0;
								foreach ($stok_notif as $row) {

									if($i == 30){
										sleep(10);
										$i = 0;
									}

									$email = $this->M_Ajax->get_user($row->id_user)->row()->email;

									// $msg = 'Stok Untuk Barang <a href="'.base_url('product/'.$row->id_product).'"><b><i>'.$barang->nama_product.'</i></b></a> saat ini adalah <b><i>'.$newstok.'</i></b> barang';
									$data = array();
									$msg = $this->load->view('template/v_stoknotification', $data, true);
									$subject = "Notifikasi Stok - Marketplace Kombas";

									$this->sendMail($email,$msg,$subject);		
									$i++;		
								}//end foreach
							}//end foreach
						}//end if
					}//end if
				}//end if
			}//end foreach
			$response = array('success' => TRUE);
		}
		header('Content-Type: application/json');
		echo json_encode($response);   
	}

	function cektoken(){
		date_default_timezone_set('Asia/Jakarta');
		$token = $this->uri->segment(3);
		$q = $this->M_Ajax->get_token($token);

		if (!isset($token) || $q->num_rows() == 0){
			$response = array('success' => FALSE,);
		}else {
			$date_expire = $q->row()->token_expired;
			$date_now = date('Y-m-d');

			if($date_expire == $date_now){
				$data = array('loggedin' => '0');
				$q_update = $this->M_Ajax->update_user($data, $q->row()->id_user);

				if($q_update != "success"){
					$response = array('success' => FALSE);
				}
			}

			$response = array(
				'success' => TRUE,
				'date' => $date_expire
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* AUTO CHECK RESI * COOKIES */






	/* RAJAONGKIR API (PROVINSI,KABUPATEN)  */

	function getkabupaten(){
		$id_provinsi = $this->uri->segment(3);
		$options = "";

		if (!isset($id_provinsi)){
			$response = array('success' => FALSE);
		}else {
			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/city?province=".$id_provinsi;
			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

			$data = $this->get_curl($this->curl_data);

			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				$options .= "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}

			$response = array(
				'success' => TRUE,
				'options' => $options
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function getongkir(){
		$kurir = $this->uri->segment(3);
		$asal = $this->uri->segment(4);
		$kabupaten = $this->uri->segment(5);
		$berat = $this->uri->segment(6);     
		$id_prod = $this->uri->segment(7);   
		$total_barang = $this->uri->segment(8);   

		if (!isset($kurir) || !isset($asal) || !isset($kabupaten) || !isset($berat) || !isset($id_prod) || !isset($total_barang) || !is_numeric($id_prod) || !is_numeric($total_barang)){
			$response = array('success' => FALSE);
		}else {
			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/cost";
			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "POST";
			$this->curl_data[CURLOPT_POSTFIELDS] = "origin=".$asal."&destination=".$kabupaten."&weight=".$berat."&courier=".$kurir;

			$data = $this->get_curl($this->curl_data);

			$options = '<div class="form-group">';
			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
				for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
					if($j == 0){
						$options .= '
						<div class="radio">
						<label>
						<input class="tipepaket styled required" type="radio" name="tipepaket'.$id_prod.'" value="'.$kurir.'|'.$id_prod.'|'.$data['rajaongkir']['results'][$i]["costs"][$j]["service"].'|'.$data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"].'|'. $total_barang .'">&emsp;'.$data['rajaongkir']['results'][$i]["costs"][$j]["service"]."\n"; 

						$options .=  "(".$data['rajaongkir']['results'][$i]["costs"][$j]["description"].")\n"; 
						$options .=  " <br><b style='font-size: 17px !important;'>Rp. ". number_format($data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"], 0, ',', '.')."</b>
						</label>
						</div>";
					}else{
						$options .= '
						<div class="radio">
						<label>
						<input class="tipepaket styled" type="radio" name="tipepaket'.$id_prod.'" value="'.$kurir.'|'.$id_prod.'|'.$data['rajaongkir']['results'][$i]["costs"][$j]["service"].'|'.$data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"].'|'. $total_barang .'">&emsp;'.$data['rajaongkir']['results'][$i]["costs"][$j]["service"]."\n"; 

						$options .=  "(".$data['rajaongkir']['results'][$i]["costs"][$j]["description"].")\n"; 
						$options .=  " <br><b style='font-size: 17px !important;'>Rp. ". number_format($data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"], 0, ',', '.')."</b>
						</label>
						</div>";
					}
				}
			}
			$options .= "</div>";

			$response = array(
				'success' => TRUE,
				'options' => $options
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}












	function getalamat(){
		$id_address = $this->uri->segment(3);

		if (!isset($id_address) || !is_numeric($id_address)){
			$response = array('success' => FALSE);
		}else {
			$address = $this->M_Ajax->get_address($id_address)->row();

			/* KOTA ASAL */

			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/city";
			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

			$json = $this->get_curl($this->curl_data);

			$rajaongkir_kota = $json['rajaongkir']['results'];

			/* KOTA ASAL */

			/* KABUPATEN */

			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/city?province=".$address->provinsi;
			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

			$data = $this->get_curl($this->curl_data);
			
			$kabupaten = "-";
			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				if($data['rajaongkir']['results'][$i]['city_id'] == $address->kabupaten){
					$kabupaten = $data['rajaongkir']['results'][$i]['city_name'];
				}
			}

			/* KABUPATEN */

			/* PROVINSI */

			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/province";
			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

			$data = $this->get_curl($this->curl_data);

			$provinsi = "-";
			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				if($data['rajaongkir']['results'][$i]['province_id'] == $address->provinsi){
					$provinsi = $data['rajaongkir']['results'][$i]['province'];
				}
			}

			/* PROVINSSI */

			$options = '

			<table class="table">
			<tbody>
			<tr>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Nama Penerima</b></td>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Alamat Lengkap</b></td>
			</tr>
			<tr>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $address->atasnama .'</td>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $address->alamat .'</td>
			</tr>
			<tr>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>No. Telepon</b></td>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Provinsi</b></td>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Kabupaten / Kota</b></td>
			<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Kode Pos</b></td>
			</tr>
			<tr>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $address->telephone .'</td>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $provinsi .'</td>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $kabupaten .'</td>
			<td style="border-top: none !important; padding-bottom: 0 !important;">'. $address->kodepos .'</td>
			</tr>
			</tbody>
			</table>';

			/* ONGKIR */

			$i = 1; 
			$total = 0;
			$totaloneprod = 0;
			$sellercount = 1;
			$cart = $this->cart->contents();
			$showongkir = true;
			$lastseller = "";

			$id_prod_for_refresh_select2 = "";

			$options2 = "";

			function sortByName($a, $b)
			{
				$a = $a['seller'];
				$b = $b['seller'];

				if ($a == $b) return 0;
				return ($a < $b) ? -1 : 1;
			}

			usort($cart, 'sortByName');

			$berat = 0;
			$first = true;

			function assc_array_count_values( $array, $key ) {
				foreach( $array as $row ) {
					$new_array[] = $row[$key];
				}
				return array_count_values( $new_array );
			}

			$totalprodperseller = assc_array_count_values($cart, 'seller');

			foreach ($cart as $items){
				$berat = $berat + $items['berat'];

				if($totalprodperseller[$items['seller']] != 1){

					if($totalprodperseller[$items['seller']] > 2){

						if($sellercount == $totalprodperseller[$items['seller']]){
							$showongkir = true;
						}else{
							$sellercount++;
							$showongkir = false;
						}


					}else{

						if($lastseller != $items['seller'] && $first == true){
							$first = false;
							$showongkir = false;

						}else if($lastseller != $items['seller'] && $first == false){
							$first = true;
							$showongkir = false;
						}else{
							$sellercount++;
							$showongkir = true;
						}

					}
				}else{
					$showongkir = true;
				}

				$lastseller = $items['seller'];

				$totaloneprod = $items['price'] * $items['qty'];
				$total += $totaloneprod;
				$totaloneprod = 0;

				if($showongkir){
					$shop = $this->M_Ajax->get_shop($items['id_shop'])->row();

					$kurir = explode(',',$shop->kurir);

					$options2 .= "
					<tr>

					<td style='border-top: none !important;'><a href='".base_url('/product/'.$items['id_prod'])."' class='text-semibold' style='color: black !important;'><img src='". base_url($items['sampul']) ."' width='130' height='130'> &emsp; ". $items['name'] ."</a></td>
					<td style='border-top: none !important;'>".$items['qty']."</td>
					<td style='border-top: none !important;'>Rp. ". number_format($items['price'], 0, ',', '.') ." <b style='font-size: 17px !important;'>x ". $items['qty'] ."</b></td>
					<td style='border-top: none !important;'><b>Rp. ". number_format($items['price']*$items['qty'], 0, ',', '.') ."</b></td>

					<td style='border-top: none !important;'>
					<div class='form-group'>
					<select data-placeholder='Pilih kurir pengiriman' id='kurir".$items['id_prod']."' name='kurir".$items['id_prod']."' class='kurir select required form-control'>
					<option></option>";



					foreach ($kurir as $row) {

						if(!empty($row)){

							$options2 .= "<option value='".$row."|".$items['asal']."|".$address->kabupaten."|".$berat."|".$items['id_prod']."|".$total."'>".$row."</option>";
						}
					}

					$id_prod_for_refresh_select2 .= "|".$items['id_prod'];

					$berat = 0;

					$options2 .= "</select></div></td>
					<td style='border-top: none !important;'>
					<span id='ongkir_". $items['id_prod']."'></span>

					</td><tr>
					";




					$options2 .= "
					<tr>
					<td colspan='6' style='border-bottom: 1px solid #ddd; border-top: none !important; background-color: #fcfcfc !important;'>
					<div class='panel-footer' style='border-top: none !important; padding: 0 !important'>
					<div class='heading-elements'>

					";

					$kota_toko = '-';
					for ($i=0; $i < count($rajaongkir_kota); $i++) { 
						if($rajaongkir_kota[$i]['city_id'] == $items['asal']){
							$kota_toko = $rajaongkir_kota[$i]['city_name'];
						}
					}

					$options2 .="
					<span class='heading-text text-semibold'>". number_format($items['berat'], 0, ',', '.') ."gr &emsp; | &emsp; Dikirim oleh: ". $items['seller'] ." &emsp; | &emsp; <i class='icon-location4'></i> ". $kota_toko ."</span>
					</div>
					</div>
					</td>
					</tr>";

				}else{
					$options2 .= "
					<tr>

					<td><a href='".base_url('/product/'.$items['id_prod'])."' class='text-semibold' style='color: black !important;'><img src='". base_url($items['sampul']) ."' width='130' height='130'> &emsp; ". $items['name'] ."</a></td>
					<td>".$items['qty']."</td>
					<td>Rp. ". number_format($items['price'], 0, ',', '.') ." <b style='font-size: 17px !important;'>x ". $items['qty'] ."</b></td>
					<td><b>Rp. ". number_format($items['price']*$items['qty'], 0, ',', '.') ."</b></td>
					<td></td>
					<td></td>

					</tr>";
				}




				$i++;
			}




			$options2 .= "
			<tr>
			<td></td>
			<td></td>
			<td class='text-center'><b>TOTAL HARGA</b></td>
			<td><b>Rp. ".number_format($total, 0, ',', '.') ."</b></td>
			<td></td>
			<td></td>
			</tr>
			";

			/* ONGKIR */


			$response = array(
				'success' => TRUE,
				'options' => $options,
				'options2' => $options2,
				'list_id_prod' => $id_prod_for_refresh_select2
			);

		}

		header('Content-Type: application/json');
		echo json_encode($response);

	}


	

	/* RAJAONGKIR API (PROVINSI,KABUPATEN) */

}
?>