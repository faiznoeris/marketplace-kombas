<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Ajax'));
	}


	// function testnodejs(){
	// 	$response = array('success' => FALSE);

	// 	header('Content-Type: application/json');
	// 	echo json_encode($response);
	// }


	/* IMAGE UPLOADING (ADD PRODUCT) */

	private $upload_path = "./assets/images/products";

	function uploadimage(){
		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}
		}
	}

	function deleteimage(){
		unlink($this->upload_path . "/" .urldecode($this->uri->segment(3)));
	}

	/* IMAGE UPLOADING (ADD PRODUCT) */

	/* DETAIL TRANSAKSI (ACCOUNT EXCEED DEADLINE) */

	function getdetailtransaksi(){
		$id_transaction = $this->uri->segment(3);
		$id_shop = $this->uri->segment(4);
		$options = '';
		$q_transaction = $this->M_Ajax->get_detailtransaksi($id_transaction, $id_shop);

		if (!is_numeric($id_transaction)|| empty($id_transaction) || !is_numeric($id_shop)|| empty($id_shop) || $q_transaction->num_rows() == 0){
			$response = array('success' => FALSE);
		}else {
			$cart = unserialize($q_transaction->row()->cart);

			$options .= '
			<div class="table-responsive">
			<table class="table table-lg">
			<thead>
			<tr>
			<th>Produk</th>
			<th class="col-sm-1">Jumlah</th>
			<th class="col-sm-3">Berat</th>
			<th class="col-sm-3">Total</th>
			</tr>
			</thead>
			<tbody>';

			foreach ($cart as $value) {
				if(!empty($value['realprice'])){
					$realprice = $value['realprice'];
					$price = $value['price'];
				}else{
					$realprice = $value['price'];
					$price = $value['price'];
				}

				$options .= '
				<tr>
				<td>
				<div class="media">
				<a target="_blank" href="'.base_url($value["url"]).'" class="media-left">
				<img src="'.base_url($value["sampul"]).'" height="60" class="" alt="">
				</a>
				<br>
				<div class="media-body media-middle">
				<a target="_blank" href="" class="text-semibold">'.$value['name'].'</a>
				</div>
				</div>

				</td>
				<td>'.$value['qty'].'</td>
				<td>'.number_format($value['berat'], 0, ',', '.').' gram</td>
				<td>
				<span class="text-semibold">';
				
				if($realprice != $price){
					$options .= 'Rp. '. number_format($price, 0, ',', '.')  .'<br><strike style="font-size: 12px !important;">Rp. '. number_format($realprice, 0, ',', '.') .'</strike>';
				}else{
					$options .= 'Rp. '. number_format($price, 0, ',', '.');
				}

				$options .='
				</span>
				</td>
				</tr>';
			}

			$options .= '
			</tbody>
			</table>
			</div>
			';

			$total = $q_transaction->row()->totalharga + $q_transaction->row()->totalongkir;
			$total = substr($total, 0, -3).$q_transaction->row()->kode_unik;

			$options .= '
			<br><br>
			<div class="col-sm-6">
			</div>
			<div class="col-sm-6">
			<div class="table-responsive no-border">
			<table class="table">
			<tbody>
			<tr>
			<th>Subtotal:</th>
			<td class="text-right">Rp. '. number_format($q_transaction->row()->totalharga, 0, ',', '.').'</td>
			</tr>
			<tr>
			<th>Ongkir: <span class="text-regular"></span></th>
			<td class="text-right">Rp. '. number_format($q_transaction->row()->totalongkir, 0, ',', '.').'</td>
			</tr>
			<tr>
			<th>Kode Unik: <span class="text-regular"></span></th>
			<td class="text-right">Rp. '. number_format($q_transaction->row()->kode_unik, 0, ',', '.').'</td>
			</tr>
			<tr>
			<th>Total:</th>
			<td class="text-right text-primary"><h5 class="text-semibold">Rp. '. number_format($total, 0, ',', '.').'</h5></td>
			</tr>
			</tbody>
			</table>
			</div>
			</div>

			<br><br>
			';

			$title = "Detail Transaksi ID #".$id_transaction;

			$response = array(
				'success' => TRUE,
				'options' => $options,
				'title' => $title
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* DETAIL TRANSAKSI (ACCOUNT EXCEED DEADLINE) */

	/* DASHBOARD DATA */

	function gettotaluser(){
		$q_user = $this->M_Ajax->count_user();
		$q_seller = $this->M_Ajax->count_seller();
		$q_reseller = $this->M_Ajax->count_reseller();

		$response = array(
			'success' => TRUE,
			'user' => $q_user,
			'seller' => $q_seller,
			'reseller' => $q_reseller
		);

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function getweekoftrans(){
		$start_date = $this->uri->segment(3);
		// $start_date = "2018-05-17";

		$date_replace = str_replace('-', '/', $start_date);

		$date_1st = date('Y-m-d',strtotime($date_replace));
		$datetime_1st = DateTime::createFromFormat("Y-m-d", $date_1st);
		$date_2nd = date('Y-m-d',strtotime($date_replace . "+1 days"));
		$datetime_2nd = DateTime::createFromFormat("Y-m-d", $date_2nd);
		$date_3rd = date('Y-m-d',strtotime($date_replace . "+2 days"));
		$datetime_3rd = DateTime::createFromFormat("Y-m-d", $date_3rd);
		$date_4th = date('Y-m-d',strtotime($date_replace . "+3 days"));
		$datetime_4th = DateTime::createFromFormat("Y-m-d", $date_4th);
		$date_5th = date('Y-m-d',strtotime($date_replace . "+4 days"));
		$datetime_5th = DateTime::createFromFormat("Y-m-d", $date_5th);
		$date_6th = date('Y-m-d',strtotime($date_replace . "+5 days"));
		$datetime_6th = DateTime::createFromFormat("Y-m-d", $date_6th);
		$date_7th = date('Y-m-d',strtotime($date_replace . "+6 days"));
		$datetime_7th = DateTime::createFromFormat("Y-m-d", $date_7th);

		$array = array(
			0 => array(
				'day' => $datetime_1st->format('l'),
				'value' => 0,
			),
			1 => array(
				'day' => $datetime_2nd->format('l'),
				'value' => 0,
			), 
			2 => array(
				'day' => $datetime_3rd->format('l'),
				'value' => 0,
			),
			3 => array(
				'day' => $datetime_4th->format('l'),
				'value' => 0,
			), 
			4 => array(
				'day' => $datetime_5th->format('l'),
				'value' => 0,
			), 
			5 => array(
				'day' => $datetime_6th->format('l'),
				'value' => 0,
			),
			6 => array(
				'day' => $datetime_7th->format('l'),
				'value' => 0,
			),
		);

		$q_trans = $this->M_Ajax->weekoftrans($start_date)->result();

		// foreach ($array as $key => $value) {
		// 	echo $value["value"];
		// }

		foreach ($q_trans as $value) {
			if ($value->date == $start_date) {
				$array[0]['value']++;
			}else if($value->date == $date_2nd){
				$array[1]['value']++;
			}else if($value->date == $date_3rd){
				$array[2]['value']++;
			}else if($value->date == $date_4th){
				$array[3]['value']++;
			}else if($value->date == $date_5th){
				$array[4]['value']++;
			}else if($value->date == $date_5th){
				$array[5]['value']++;
			}else if($value->date == $date_7th){
				$array[6]['value']++;
			}
		}

		$response = array(
			'success' => TRUE,
			'trans' => $array
		);

		// header('Content-Type: application/json');
		echo json_encode($array);
	}

	/* DASHBOARD DATA */

	/* ACCOUNT DATA */

	function getordercancelled(){
		$id_shop = $this->uri->segment(3);
		$q_order = $this->M_Ajax->data_order($id_shop);
		$q_ordercancelled = $this->M_Ajax->data_ordercancelled($id_shop);
		$order_total = $q_order->num_rows();
		$order_cancelled = $q_ordercancelled->num_rows();
		$order_total = $order_total + $order_cancelled;

		if($q_ordercancelled->num_rows() > 0){
			$persen = $order_cancelled / $order_total;
			$response = array(
				'success' => TRUE,
				'ordercancelled' => substr($persen, 0, 5)
			);
		}else{
			$response = array(
				'success' => FALSE
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);		
	}

	function getorderprocessed(){
		$id_shop = $this->uri->segment(3);
		$q_order = $this->M_Ajax->data_order($id_shop);
		$q_ordercancelled = $this->M_Ajax->data_ordercancelled($id_shop);
		$order_total = $q_order->num_rows();
		$order_cancelled = $q_ordercancelled->num_rows();
		$order_total = $order_total + $order_cancelled;
		$order_processed = 0;

		if($q_order->num_rows() > 0){
			foreach ($q_order->result() as $value) {
				if($value->status == "On Delivery"){
					$order_processed = $order_processed + 1;
				}
			}
			$persen = $order_processed / $order_total;
			$response = array(
				'success' => TRUE,
				'orderprocessed' => substr($persen, 0, 5)
			);
		}else{
			$response = array(
				'success' => FALSE
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function getordershipped(){
		$id_shop = $this->uri->segment(3);
		$q_order = $this->M_Ajax->data_order($id_shop);
		$q_ordercancelled = $this->M_Ajax->data_ordercancelled($id_shop);
		$order_total = $q_order->num_rows();
		$order_cancelled = $q_ordercancelled->num_rows();
		$order_total = $order_total + $order_cancelled;
		$order_shipped = 0;

		if($q_order->num_rows() > 0){
			foreach ($q_order->result() as $value) {
				if($value->status == "Delivered"){
					$order_shipped = $order_shipped + 1;
				}
			}
			$persen = $order_shipped  / $order_total;
			$response = array(
				'success' => TRUE,
				'ordershipped' => substr($persen, 0, 5)
			);
		}else{
			$response = array(
				'success' => FALSE
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function getorderpending(){
		$id_shop = $this->uri->segment(3);
		$q_order = $this->M_Ajax->data_order($id_shop);
		$q_ordercancelled = $this->M_Ajax->data_ordercancelled($id_shop);
		$order_total = $q_order->num_rows();
		$order_cancelled = $q_ordercancelled->num_rows();
		$order_total = $order_total + $order_cancelled;
		$order_pending = 0;

		if($q_order->num_rows() > 0){
			foreach ($q_order->result() as $value) {
				if($value->status == "Pending"){
					$order_pending = $order_pending + 1;
				}
			}
			$persen = $order_pending  / $order_total;
			$response = array(
				'success' => TRUE,
				'orderpending' => substr($persen, 0, 5)
			);
		}else{
			$response = array(
				'success' => FALSE
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function getsaldohistory(){
		$id_shop = $this->uri->segment(3);
		$q_order = $this->M_Ajax->data_ceksaldohistory($id_shop);
		$saldo = array();
		$date = array();
		$i = 0;

		if($q_order->num_rows() > 0){
			foreach ($q_order->result() as $value) {
				if(is_null($value->totalongkir) && is_null($value->kode_unik)){ //make sure the looped data came from withdrawal table
					$saldoo = $value->totalharga * 2;
					$saldoo = $value->totalharga - $saldoo;
					$saldo[$i] = $saldoo;
					$date[$i] = $value->date_delivered;
				}else{
					$total = $value->totalharga + $value->totalongkir + $value->kode_unik;
					$total = substr($total, 0, -3) . '000';
					$saldo[$i] = $total;
					$date[$i] = $value->date_delivered;
				}
				$i++;
			}
			$response = array(
				'success' => TRUE,
				'saldo' => $saldo,
				'date' => $date
			);
		}else{
			$response = array(
				'success' => FALSE
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* ACCOUNT DATA */

	/* CHECK IF DELVIERY EXCEED DEADLINE */

	function cekdeliverydeadline(){
		$q_exceed = $this->M_Ajax->get_exceed()->result();
		$options = "";
		$error = false;

		foreach ($q_exceed as $trans) {
			date_default_timezone_set('Asia/Jakarta'); //set timezone to jakarta
			$datenow = date('Y-m-d');

			$datetime1 = new DateTime($trans->date_ordered);
			$datetime2 = new DateTime($datenow);

			$interval = $datetime1->diff($datetime2);

			$daydistance = $interval->format('%a');

			if($daydistance > $GLOBALS["delivery_exceed_deadline"] && $trans->status == "Pending" && $trans->status != "Canceled"){
				$q_warn = $this->M_Ajax->warn_seller($trans->id_transaction,$trans->id_shop);

				$q_shop = $this->M_Ajax->get_shop($trans->id_shop)->row();
				$q_seller = $this->M_Ajax->get_user($q_shop->id_user)->row();

				$data["seller"] = $q_seller;
				$data["id_transaction"] = $trans->id_transaction;

				$msg = $this->load->view('template/v_sellerwarning', $data, true);
				$subject = "Peringatan - Marketplace Kombas";

				$this->sendMail($q_seller->email,$msg,$subject);

				if($q_warn != "success"){
					$response = array('success' => FALSE);
					$error = true;
					break;
				}
			}	
		}

		if(!$error){
			$response = array('success' => TRUE);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* CHECK IF DELVIERY EXCEED DEADLINE */

	/* CHECK NOTIF MSG & ORDER */

	function ceknotifneworder(){
		$notif_header = "";
		$notif_duration = "";
		$notif_sticky = "";
		$notif_container = "";
		$notif_message = "";
		$notif_theme = "";
		$notif_group = "";
		$error = false;
		$id_user = $this->session->userdata('id_user');
		$q_shop_check = $this->M_Ajax->get_shop_byuser($id_user);

		if($q_shop_check->num_rows() > 0){
			$q_order = $this->M_Ajax->cek_order($q_shop_check->row()->id_shop)->result();
			foreach ($q_order as $value) {
				if($value->show_notif_neworder == '0'){
					$q_shop = $this->M_Ajax->get_shop($value->id_shop)->row();
					$q_seller = $this->M_Ajax->get_user($q_shop->id_user)->row();
					$notif_header = 'New Order';
					$notif_duration = '4000';
					$notif_sticky = true;
					$notif_container = '#jGrowl-'.$q_seller->id_user;
					$notif_message = 'Anda mendapat pesanan baru dengan ID Transaksi: #'.$value->id_transaction.'.';
					$notif_theme = 'bg-success alert-styled-left';
					$notif_group = 'alert-success';
					$q_update_order = $this->M_Ajax->setorder_show_notif($value->id_transaction, $value->id_shop);

					if($q_update_order != "success"){
						$response = array('success' => FALSE);
						$error = true;
						break;
					}
				}
			}
		}

		if(!$error){
			$response = array(
				'success' => TRUE,
				'notif_header' => $notif_header,
				'notif_duration' => $notif_duration,
				'notif_sticky' => $notif_sticky,
				'notif_container' => $notif_container,
				'notif_message' => $notif_message,
				'notif_theme' => $notif_theme,
				'notif_group' => $notif_group
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function ceknotifmsg(){
		$id_user = $this->uri->segment(3);
		$options = "";
		$notif_header = "";
		$notif_duration = "";
		$notif_sticky = "";
		$notif_container = "";
		$notif_message = "";
		$notif_theme = "";
		$notif_group = "";
		$error = false;

		if (!is_numeric($id_user)|| empty($id_user)){
			$response = array('success' => FALSE);
		}else {
			$q_msg = $this->M_Ajax->cek_msg($id_user)->result();

			foreach ($q_msg as $value) {
				$q_sender = $this->M_Ajax->get_user_sender($value->id_user)->row();
				$notif_header = 'Message';
				$notif_duration = '3000';
				$notif_sticky = false;
				$notif_container = '#jGrowl-'.$id_user;
				$notif_message = 'Pesan dari '.$q_sender->username.'.';
				$notif_theme = 'bg-success alert-styled-left';
				$notif_group = 'alert-success';
				$q_update_msg = $this->M_Ajax->setmsg_show_notif($value->id_msg);

				$options .= '
				<li class="media">
				<div class="media-left">
				<a href="'.base_url("u/".$q_sender->username) .'">
				<img src="'. base_url($q_sender->ava_path) .'" class="img-circle img-md" alt="">
				</a>
				</div>
				<div class="media-body">
				<div class="media-content">'.$value->msg .'</div>';

				date_default_timezone_set('Asia/Jakarta');
				$now = date('Y-m-d');
				$now_week = date('oW', strtotime($now));
				$now_month = date('Y-m');
				$now_year = date('Y');

				$tocheck_week = date('oW', strtotime($value->date_tocheck));
				$tocheck_month = date('Y-m', strtotime($value->date_tocheck));
				$tocheck_year = date('Y', strtotime($value->date_tocheck));

				$show_d = date('D', strtotime($value->date_tocheck));
				$show_m = date('D - M');
				$show_clean = date('Y - M - d', strtotime($value->date_tocheck));

				if($now == $value->date_tocheck){
					$options .= '<span class="media-annotation display-block mt-10">'.$value->time.'</span>';
				}else if($now_week == $tocheck_week && $now != $row->date_tocheck){
					$options .= '<span class="media-annotation display-block mt-10">'. $show_d .'</span>';
				}elseif($now_month != $tocheck_month && $now_year == $tocheck_year){
					$options .= '<span class="media-annotation display-block mt-10">'.$show_m .'</span>';
				}else{
					$options .= '<span class="media-annotation display-block mt-10">'. $show_clean .'</span>';
				}

				$options .= '
				</div>
				</li>
				';

				if($q_update_msg != "success"){
					$response = array('success' => FALSE);
					$error = true;
					break;
				}
			}

			if(!$error){
				$response = array(
					'success' => TRUE,
					'notif_header' => $notif_header,
					'notif_duration' => $notif_duration,
					'notif_sticky' => $notif_sticky,
					'notif_container' => $notif_container,
					'notif_message' => $notif_message,
					'notif_theme' => $notif_theme,
					'notif_group' => $notif_group,
					'options' => $options
				);
			}
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* CHECK NOTIF MSG & ORDER */

	/* ACCOUNT (SELLER) ALAMAT PENGIRIMAN MODAL DYNAMIC */

	function getmodalalamat(){
		$id_address = $this->uri->segment(3);
		$q_alamat = $this->M_Ajax->get_address($id_address);
		$options = "";

		if (!is_numeric($id_address)|| $q_alamat->num_rows() == 0){
			$response = array('success' => FALSE);
		}else {
			$alamat = $q_alamat->row();

			$options .= "
			<p class='card-text'><b>Nama Penerima:</b><br>". $alamat->atasnama ."<br><br>
			<b>Alamat:</b><br>". $alamat->alamat ."<br><b>Provinsi:</b><br>";

			$curl = curl_init();	
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$alamat->provinsi,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"key: e5629870cbd922e9156805e0ffe6625c"
				),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			$data = json_decode($response, true);

			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				if($data['rajaongkir']['results'][$i]['city_id'] == $alamat->kabupaten){
					$options .= $data['rajaongkir']['results'][$i]['city_name'];
					break;
				}
			}

			$options .= "<br><b>Kabupaten / Kota:</b><br>";


			$curl = curl_init();	
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"key: e5629870cbd922e9156805e0ffe6625c"
				),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			$data = json_decode($response, true);


			for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
				if($data['rajaongkir']['results'][$i]['province_id'] == $alamat->provinsi){
					$options .= $data['rajaongkir']['results'][$i]['province'];
				}
			}

			$options .= "
			<br>
			<b>Kode Pos:</b><br>". $alamat->kodepos ."

			<br><br>
			<b>Telephone: </b>". $alamat->telephone ."
			</p>
			<br>";

			$response = array(
				'success' => TRUE,
				'options' => $options
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	/* ACCOUNT (SELLER) ALAMAT PENGIRIMAN MODAL DYNAMIC */

	/* AUTO CHECK RESI * COOKIES */

	function cekresi(){
		ini_set('max_execution_time', 300); //set max execution to 5 minutes
		$q_ondelivery = $this->M_Ajax->get_ondelivery();

		//PENDING TO ON PROCESS I THINK NOT NECESSARY CUZ THE SELLER ALREADY HAVE TO UPDATE THE RESI MANUALLY SO NO NEED TO CHECK AGAIN

		// $q_confirmbyadmin = $this->M_Ajax->get_confirmbyadmin();

		// if($q_confirmbyadmin != "empty"){
		// 	foreach($q_confirmbyadmin as $value){
		// 		if($value->resi != ""){
		// 			$this->curl_data[CURLOPT_URL] = "https://api.rajaongkir.com/basic/waybill";
		// 			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "POST";
		// 			$this->curl_data[CURLOPT_POSTFIELDS] = "waybill=".$value->resi."&courier=".$value->kurir;

		// 			$data = $this->get_curl($this->curl_data);

		// 			if($data['rajaongkir']['result']['delivery_status']['status'] == "ON PROCESS"){
		// 				$data = array('status' => 'On Delivery');
		// 				$q_update_status = $this->M_Ajax->update_status($data, $value->id_trans_seller);

		// 				if($q_update_status != "success"){
		// 					// $response = array('success' => FALSE);
		// 					exit();
		// 				}
		// 			}
		// 		}
		// 	}
		// }

		if($q_ondelivery != "empty"){
			foreach ($q_ondelivery as $value) {
				if($value->resi != ""){
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
										$data = array();
										$msg = $this->load->view('template/v_stoknotification', $data, true);
										$subject = "Notifikasi Stok - Marketplace Kombas";

										$this->sendMail($email,$msg,$subject);		
										$i++;		
									}
								}
							}
						}
					}
				}
			}
		}
		$response = array('success' => TRUE);

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