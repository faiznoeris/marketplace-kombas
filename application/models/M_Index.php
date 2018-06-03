<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Index extends CI_Model{

	/* DATA TAKEN FROM VIEW */

	function data_account_countproduct($id_shop, $id_transaction){
		$this->db->select("*");
		$this->db->from("transaction_history_product");
		$this->db->where("id_shop",$id_shop);
		$this->db->where("id_transaction",$id_transaction);
		return $this->db->get();
	}

	function data_account_getaddress($id_address){
		return $this->db
		->where('id_address', $id_address)
		->get('address');
	}

	function data_account_countproductnoshop($id_transaction){
		$this->db->select("*");
		$this->db->from("transaction_history_product");
		$this->db->where("id_transaction",$id_transaction);
		return $this->db->get();
	}


	/* DATA TAKEN FROM VIEW */

	/* DATA MSG / NAVBAR */

	function data_msg_navbar($id_user){
		return $this->db->query("SELECT m1.*,DATE_FORMAT(m1.date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(m1.date, '%H:%i') AS time FROM messages AS m1 LEFT JOIN messages AS m2 ON (m1.id_convo = m2.id_convo AND m1.id_msg < m2.id_msg) WHERE m2.id_msg IS NULL AND (m1.id_receiver = '".$id_user."' OR m1.id_user = '".$id_user."') ORDER by date DESC LIMIT 10");
	}

	function data_msg_navbarnew($id_user){
		return $this->db->query("SELECT * FROM messages WHERE id_receiver = '".$id_user."' AND viewed = '0' ORDER BY date DESC LIMIT 1");
	}

	function data_navbarmsg_countmsg($id_convo, $id_user){
		return $this->db->query("SELECT * FROM messages WHERE id_convo = '".$id_convo."' AND id_receiver = '".$id_user."' AND viewed = '0' ORDER BY date DESC");
	}

	/* DATA MSG / NAVBAR */

	/* DATA HOME */

	function data_home_product_topweekly(){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			JOIN category ON category.id_category = products.id_category
			JOIN shops ON shops.id_shop = products.id_shop
			GROUP BY products.id_product
			ORDER BY seminggu DESC
			");
	}

	function data_home_product_toppromo(){
		/*
		SELECT *
		FROM products
		JOIN category ON category.id_category = products.id_category
		JOIN shops ON shops.id_shop = products.id_shop
		LEFT JOIN reviews ON reviews.id_product = products.id_product
		WHERE products.promo_aktif = '1'
		GROUP BY products.id_product
		ORDER BY products.views DESC	
		LIMIT 6
		*/
		return $this->db->query("
			SELECT *
			FROM products
			JOIN category ON category.id_category = products.id_category
			JOIN shops ON shops.id_shop = products.id_shop
			WHERE products.promo_aktif = '1'
			GROUP BY products.id_product
			ORDER BY products.views DESC	
			LIMIT 6
			");
	}

	function data_home_category(){
		return $this->db
		->get("category");
	}

	/* DATA HOME */

	/* DATA SHOPPING */

	function data_shopping_category_byname($nama_category){
		return $this->db
		->where("nama_category", $nama_category)
		->get("category");
	}

	function data_shopping_product_topweekly_bycatid($id_category){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			JOIN category ON category.id_category = products.id_category
			JOIN shops ON shops.id_shop = products.id_shop
			WHERE products.id_category = '".$id_category."' 
			GROUP BY products.id_product
			ORDER BY seminggu DESC
			");
	}

	function data_shopping_product_topweekly(){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			JOIN category ON category.id_category = products.id_category
			JOIN shops ON shops.id_shop = products.id_shop
			GROUP BY products.id_product
			ORDER BY seminggu DESC
			");
	}

	function data_shopping_product_topweekly_bycatid_fetch($limit, $start, $id_category){
		$this->db->select("*, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu");
		$this->db->from("products");
		$this->db->join('category', 'category.id_category = products.id_category');
		$this->db->join('shops', 'shops.id_shop = products.id_shop');
		$this->db->where('products.id_category',$id_category);
		$this->db->group_by('products.id_product');
		$this->db->order_by('seminggu', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return null;
	}

	function data_shopping_product_topweekly_fetch($limit, $start){
		$this->db->select("*, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu");
		$this->db->from("products");
		$this->db->join('category', 'category.id_category = products.id_category');
		$this->db->join('shops', 'shops.id_shop = products.id_shop');
		$this->db->group_by('products.id_product');
		$this->db->order_by('seminggu', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return null;
	}

	/* DATA SHOPPING */

	/* DATA LOGIN */

	function login_gettoken($token){
		$this->db->select("id_user, token,token_expired");
		$this->db->from("users");
		$this->db->where("token", $token);
		$this->db->limit(1);

		return $this->db->get();
	}

	function login_getshop_byiduser($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('shops');
	}

	function login_updatesession($token){
		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("users");
		$this->db->where("token", $token);
		$this->db->limit(1);

		$res = $this->db->get();

		if($res->num_rows() > 0){
			$row = $res->row();

			if($row->id_userlevel == '4'){ //if seller, add id shop to session
				$row2 = $this->login_getshop_byiduser($row->id_user)->row();

				$newdata = array(
					'id_user'		=> $row->id_user,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_userlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'cover_path' 	=> $row->cover_path,
					'id_shop'		=> $row2->id_shop,
					'loggedin' 		=> TRUE
				);
			}else{
				$newdata = array(
					'id_user'		=> $row->id_user,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_userlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'cover_path' 	=> $row->cover_path,
					'loggedin' 		=> TRUE
				);
			}

			$this->session->set_userdata($newdata);

			return true;
		}else{
			return false;
		}
	}

	//ADMIN

	function login_gettoken_admin($token){
		$this->db->select("id_admin, token,token_expired");
		$this->db->from("admins");
		$this->db->where("token", $token);
		$this->db->limit(1);

		return $this->db->get();
	}

	function login_updatesession_admin($token){
		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("admins");
		$this->db->where("token", $token);
		$this->db->limit(1);

		$res = $this->db->get();

		if($res->num_rows() > 0){
			$row = $res->row();

			$session_data = array(
				'id_user'		=> '',
				'id_admin'		=> $row->id_admin,
				'email'			=> $row->email,
				'nama_lgkp'		=> $row->nama,
				'user_lvl'		=> $row->id_userlevel,
				'username'  	=> $row->username,
				'telp'			=> '',
				'date_joined' 	=> $row->date_joined2,
				'ava_path' 		=> $row->ava_path,
				'cover_path' 	=> '',
				'loggedin' 		=> TRUE
			);

			$this->session->set_userdata($session_data);

			return true;
		}else{
			return false;
		}
	}

	//ADMIN

	/* DATA LOGIN */


	/* DATA ORDER */

	function data_order_getaddress($id_user){
		return $this->db
		->where('id_user', $id_user)
		// ->limit(1) //user can have multiple address so ill just comment this
		->get('address');
	}

	function data_order_getbank(){
		return $this->db
		->get('banks');
	}

	function data_order_getuser($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users');
	}

	/* DATA ORDER */

	/* DATA ORDERDETAILS */

	function data_details_transhistory($id_transaction){
		return $this->db
		->where('id_transaction', $id_transaction)
		->limit(1)
		->get('transaction_history');
	}

	function data_details_shipment($id_address){
		return $this->db
		->where('id_address', $id_address)
		->limit(1)
		->get('address');
	}

	function data_details_confirmation($id_transaction){
		return $this->db
		->where('id_transaction', $id_transaction)
		->limit(1)
		->get('confirmation');
	}

	function data_details_getbank($id_bank){
		return $this->db
		->where('id_bank', $id_bank)
		->limit(1)
		->get('banks');
	}

	/* DATA ORDERDETAILS */

	/* DATA PRODUCT VIEW */

	function data_productview_product_byurl($url_product){
		return $this->db
		->join('category', 'category.id_category = products.id_category')
		->join('shops', 'shops.id_shop = products.id_shop')
		->where('products.url', $url_product)
		->limit(1)
		->get('products');
	}

	function data_productview_getuserlevel($id_userlevel){
		return $this->db
		->where('id_userlevel', $id_userlevel)
		->limit(1)
		->get('user_level');
	}

	function data_productview_getstoknotif($id_product, $id_user){
		return $this->db
		->where('id_product', $id_product)
		->where('id_user', $id_user)
		->get('stock_notification');
	}

	function data_productview_getshop($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->limit(1)
		->get('shops');
	}

	function data_productview_getuser($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users');
	}

	function data_productview_getcategory($id_category){
		return $this->db
		->where('id_category', $id_category)
		->limit(1)
		->get('category');
	}

	function data_productview_relatedprod($id_category,$id_product){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			JOIN category ON category.id_category = products.id_category
			JOIN shops ON shops.id_shop = products.id_shop
			WHERE NOT products.id_product = '".$id_product."'
			AND products.id_category = '".$id_category."' 
			GROUP BY products.id_product
			ORDER BY seminggu DESC
			LIMIT 4
			");
	}

	function data_productview_getreview($id_product){
		return $this->db
		->where('id_product', $id_product)
		->get('reviews');
	}

	function data_productview_getreview_bintang($bintang, $id_product){
		return $this->db->query("SELECT COUNT(bintang_".$bintang.") as bintang_".$bintang." FROM `reviews` WHERE id_product = '".$id_product."' AND bintang_".$bintang." = 1");
	}

	function data_productview_getreview_fetch($limit, $start, $id_product) {
		$q = $this->db
		->join('users', 'reviews.id_user = users.id_user')
		->where('reviews.id_product', $id_product)
		->limit($limit, $start)
		->get('reviews');

		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return null;
	}

	function data_productview_editproduct($data, $id_product){
		$this->db->where('id_product', $id_product);
		if($this->db->update('products', $data)){
			return true;
		}else{
			return false;
		}
	}

	/* DATA PRODUCT VIEW */

	/* DATA ALAMAT */

	function data_alamat_getaddress($id_user, $id_address){
		return $this->db
		->where('id_address', $id_address)
		->where('id_user', $id_user)
		->limit(1)
		->get('address');
	}

	/* DATA ALAMAT */

	/* DATA PROFILE */

	function data_profile_getprofile($username){
		return $this->db
		->like('username', $username)
		->limit(1)
		->get('users');
	}

	function data_profile_getproducts_byshop($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('products');
	}

	function data_profile_product_fetch($limit, $start, $id_shop){
		$q = $this->db
		->where('id_shop', $id_shop)
		->limit($limit, $start)
		->get('products');

		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return null;
	}

	/* DATA PROFILE */

	/* DATA ACCOUNT */ 

	function data_account_datapenjualan($id_shop){
		$this->db->select("transaction_history_seller.*, transaction_history.id_address");
		$this->db->from("transaction_history_seller");
		$this->db->join('transaction_history','id_transaction');
		$this->db->where("transaction_history_seller.id_shop",$id_shop);
		return $this->db->get();
	}

	function data_account_dataproduct($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('products');
	}

	function data_account_datawithdrawal($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('withdrawal');
	}

	function data_account_exceeddelivery($id_shop){
		// return $this->db->query("SELECT *, DATE_FORMAT(transaction_history.date, '%d - %M - %Y') as date_ordered FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction JOIN users ON transaction_history.id_user = users.id_user WHERE transaction_history_seller.id_shop = '".$id_shop."' AND transaction_history_seller.status = 'Transfer Received By Admin' AND transaction_history_seller.warning = '1'");
		return $this->db->query("SELECT *, DATE_FORMAT(transaction_history.date, '%d - %M - %Y') as date_ordered FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction JOIN users ON transaction_history.id_user = users.id_user WHERE transaction_history_seller.id_shop = '".$id_shop."' AND transaction_history_seller.warning = '1'");
	}

	function data_account_datapembelian($id_user){
		return $this->db->query("SELECT transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, transaction_history.cart FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history.id_user = ".$id_user." GROUP BY transaction_history.id_transaction ORDER BY transaction_history.id_transaction DESC");
	}

	function data_account_cancelledorder($id_user){
		return $this->db
		->select('*, DATE_FORMAT(transaction_cancelled.date, "%d - %M - %Y") as date_ordered')
		->where('transaction_cancelled.id_user', $id_user)
		->join('shops', 'transaction_cancelled.id_shop = shops.id_shop')
		->join('users', 'shops.id_user = users.id_user')
		->get('transaction_cancelled');
	}

	function data_account_msg($id_user){
		return $this->db->query("SELECT m1.*,DATE_FORMAT(m1.date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(m1.date, '%H:%i') AS time FROM messages AS m1 LEFT JOIN messages AS m2 ON (m1.id_convo = m2.id_convo AND m1.id_msg < m2.id_msg) WHERE m2.id_msg IS NULL AND (m1.id_receiver = '".$id_user."' OR m1.id_user = '".$id_user."') ORDER by date DESC");
	}

	function data_account_totalorder($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('transaction_history_seller');
	}

	function data_account_totalordercancelled($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('transaction_cancelled');
	}

	function data_account_totalproductviews($id_shop){
		return $this->db
		->select('views')
		->where('id_shop', $id_shop)
		->get('products');
	}

	function data_account_totalproductreview($id_shop){
		return $this->db
		->join('reviews', 'reviews.id_product = products.id_product')
		->where('products.id_shop', $id_shop)
		->get('products');
	}

	function data_account_totalordershipped($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->where('status', "Delivered")
		->get('transaction_history_seller');
	}

	function data_account_totalorderprocessed($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->where('status', "On Delivery")
		->get('transaction_history_seller');
	}

	function data_account_totalorderpending($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->where('status', "Pending")
		->get('transaction_history_seller');
	}

	function data_account_totalorderonprocess($id_shop){
		$where = "(status = 'Transfer Confirmed By User' OR status = 'Transfer Received By Admin')";
		return $this->db
		->where('id_shop', $id_shop)
		->where($where)
		->get('transaction_history_seller');
	}

	function data_account_pendingapproval($id_user){
		return $this->db
		->where('id_user', $id_user)
		->get('pending_approval')
		->num_rows();
	}

	/* DATA ACCOUNT */

	/* DATA MESSAGE */

	function data_message_convolimitone($id_convo){
		return $this->db
		->where('id_convo', $id_convo)
		->limit(1)
		->get('messages');
	}

	function data_message_convo($id_convo){
		return $this->db->query("SELECT *,DATE_FORMAT(date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(date, '%H:%i') AS time FROM messages WHERE id_convo = '".$id_convo."' ORDER BY date ASC");
	}

	function data_message_checkconvoexist($id_receiver, $id_sender){
		return $this->db->query("SELECT * FROM messages WHERE (id_user = '".$id_receiver."' OR id_receiver = '".$id_receiver."') AND (id_user = '".$id_sender."' OR id_receiver = '".$id_sender."') LIMIT 1");
	}

	function data_message_setviewed($data, $id_message, $id_receiver){
		$this->db->set($data);
		$this->db->where('id_msg', $id_message);
		$this->db->where('id_receiver', $id_receiver);
		if($this->db->update('messages')){
			return true;
		}
		return $this->db->_error_message();
	}

	/* DATA MESSAGE */

	/* DATA PRODUCT EDIT */

	function data_productedit_getproduct($id_product){
		return $this->db
		->where('id_product', $id_product)
		->get('products');
	}

	/* DATA PRODUCT EDIT */

	/* DATA SEARCH */

	public function fetch_search($limit, $start, $keyword) {
		$sql = 'select *,0 as bintang from products JOIN category ON category.id_category = products.id_category where products.nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function fetch_search_cat($limit, $start, $keyword, $cat) {
		$sql = 'select *,0 as bintang from products JOIN category ON category.id_category = products.id_category where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public $totalfound = 0;

	function addtotalfound(){
		$this->totalfound = $this->totalfound + 1;
	}

	function gettotalfound(){
		return $this->totalfound;
	}

	public function fetch_search_rat($limit, $start, $keyword, $rat) {
		$case = "";
		$rating_query = "";
		$i = 1;

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_satu = '1'";
					}else{
						$rating_query .= " bintang_satu = '1' OR ";
					}
				}else if($rating == 2){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_dua = '1'";
					}else{
						$rating_query .= " bintang_dua = '1' OR ";
					}
				}else if($rating == 3){				
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_tiga = '1'";
					}else{
						$rating_query .= " bintang_tiga = '1' OR ";
					}
				}else if($rating == 4){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_empat = '1'";
					}else{
						$rating_query .= " bintang_empat = '1' OR ";
					}
				}else if($rating == 5){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_lima = '1'";
					}else{
						$rating_query .= " bintang_lima = '1' OR ";
					}
				}
				$i++;
			}
		}else{
			if($rat[0] == 1){
				$rating_query .= "bintang_satu = '1'";		
			}else if($rat[0] == 2){
				$rating_query .= "bintang_dua = '1'";
			}else if($rat[0] == 3){
				$rating_query .= "bintang_tiga = '1'";
			}else if($rat[0] == 4){
				$rating_query .= "bintang_empat = '1'";
			}else if($rat[0] == 5){
				$rating_query .= "bintang_lima = '1'";
			}
		}

		$sql = 'SELECT * FROM reviews JOIN products ON products.id_product = reviews.id_product JOIN category ON category.id_category = products.id_category WHERE products.nama_product like "%'.$keyword.'%" AND ('.$rating_query.') GROUP BY reviews.id_product LIMIT '.$limit.' OFFSET '.$start;

		//terus diloop datanya, itung persentage reviewnya (yg ad di home/shopping), kalo sesuai ama yang dicari masukin ke array

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$persentage = 0;
				$found = 0;

				$totalreview = $this->data_productview_getreview($row->id_product)->num_rows();

				$data_bintang1 = $this->data_productview_getreview_bintang("satu", $row->id_product)->row()->bintang_satu;
				$data_bintang2 = $this->data_productview_getreview_bintang("dua", $row->id_product)->row()->bintang_dua;
				$data_bintang3 = $this->data_productview_getreview_bintang("tiga", $row->id_product)->row()->bintang_tiga;
				$data_bintang4 = $this->data_productview_getreview_bintang("empat", $row->id_product)->row()->bintang_empat;
				$data_bintang5 = $this->data_productview_getreview_bintang("lima", $row->id_product)->row()->bintang_lima;

				if($totalreview != 0){
					$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);
				}

				if(sizeof($rat) > 1){
					foreach ($rat as $rating) {
						if($rating == 1){

							if($percentage >= 1 && $percentage < 2){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 2){

							if($percentage >= 2 && $percentage < 3){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 3){

							if($percentage >= 3 && $percentage < 4){
								$found++;
								$data[] = $row;
							}
							
						}else if($rating == 4){
							
							if($percentage >= 4 && $percentage < 5){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 5){
							
							if($percentage >= 5){
								$found++;
								$data[] = $row;
							}

						}
					}	
				}else{
					if($rat[0] == 1){

						if($percentage >= 1 && $percentage < 2){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 2){

						if($percentage >= 2 && $percentage < 3){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 3){

						if($percentage >= 3 && $percentage < 4){
							$found++;
							$data[] = $row;
						}
						
					}else if($rat[0] == 4){
						
						if($percentage >= 4 && $percentage < 5){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 5){
						
						if($percentage >= 5){
							$found++;
							$data[] = $row;
						}

					}
				}	
			}
			if($found > 0){return $data;}else{ return false;}
		}
		return false;
	}

	public function fetch_search_cat_rat($limit, $start, $keyword, $cat, $rat) {
		$case = "";
		$rating_query = "";
		$i = 1;

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}


		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_satu = '1'";
					}else{
						$rating_query .= " bintang_satu = '1' OR ";
					}
				}else if($rating == 2){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_dua = '1'";
					}else{
						$rating_query .= " bintang_dua = '1' OR ";
					}
				}else if($rating == 3){				
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_tiga = '1'";
					}else{
						$rating_query .= " bintang_tiga = '1' OR ";
					}
				}else if($rating == 4){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_empat = '1'";
					}else{
						$rating_query .= " bintang_empat = '1' OR ";
					}
				}else if($rating == 5){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_lima = '1'";
					}else{
						$rating_query .= " bintang_lima = '1' OR ";
					}
				}
				$i++;
			}
		}else{
			if($rat[0] == 1){
				$rating_query .= "bintang_satu = '1'";		
			}else if($rat[0] == 2){
				$rating_query .= "bintang_dua = '1'";
			}else if($rat[0] == 3){
				$rating_query .= "bintang_tiga = '1'";
			}else if($rat[0] == 4){
				$rating_query .= "bintang_empat = '1'";
			}else if($rat[0] == 5){
				$rating_query .= "bintang_lima = '1'";
			}
		}

		$sql = 'SELECT * FROM reviews JOIN products ON products.id_product = reviews.id_product JOIN category ON category.id_category = products.id_category WHERE products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'" AND ('.$rating_query.') GROUP BY reviews.id_product LIMIT '.$limit.' OFFSET '.$start;

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$persentage = 0;
				$found = 0;

				$totalreview = $this->data_productview_getreview($row->id_product)->num_rows();

				$data_bintang1 = $this->data_productview_getreview_bintang("satu", $row->id_product)->row()->bintang_satu;
				$data_bintang2 = $this->data_productview_getreview_bintang("dua", $row->id_product)->row()->bintang_dua;
				$data_bintang3 = $this->data_productview_getreview_bintang("tiga", $row->id_product)->row()->bintang_tiga;
				$data_bintang4 = $this->data_productview_getreview_bintang("empat", $row->id_product)->row()->bintang_empat;
				$data_bintang5 = $this->data_productview_getreview_bintang("lima", $row->id_product)->row()->bintang_lima;

				if($totalreview != 0){
					$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);
				}

				if(sizeof($rat) > 1){
					foreach ($rat as $rating) {
						if($rating == 1){

							if($percentage >= 1 && $percentage < 2){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 2){

							if($percentage >= 2 && $percentage < 3){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 3){

							if($percentage >= 3 && $percentage < 4){
								$found++;
								$data[] = $row;
							}
							
						}else if($rating == 4){
							
							if($percentage >= 4 && $percentage < 5){
								$found++;
								$data[] = $row;
							}

						}else if($rating == 5){
							
							if($percentage >= 5){
								$found++;
								$data[] = $row;
							}

						}
					}	
				}else{
					if($rat[0] == 1){

						if($percentage >= 1 && $percentage < 2){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 2){

						if($percentage >= 2 && $percentage < 3){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 3){

						if($percentage >= 3 && $percentage < 4){
							$found++;
							$data[] = $row;
						}
						
					}else if($rat[0] == 4){
						
						if($percentage >= 4 && $percentage < 5){
							$found++;
							$data[] = $row;
						}

					}else if($rat[0] == 5){
						
						if($percentage >= 5){
							$found++;
							$data[] = $row;
						}
					}
				}	
			}
			if($found > 0){return $data;}else{ return false;}
		}
		return false;
	}

	function search($keyword){
		return $this->db->query('Select *,0 as bintang from products JOIN category ON category.id_category = products.id_category where products.nama_product like "%'.$keyword.'%"');
	}

	function search_cat($keyword, $cat){
		return $this->db->query('Select *,0 as bintang from products JOIN category ON category.id_category = products.id_category where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'"');
	}

	function search_rat($keyword, $rat) {
		$case = "";
		$rating_query = "";
		$i = 1;

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_satu = '1'";
					}else{
						$rating_query .= " bintang_satu = '1' OR ";
					}
				}else if($rating == 2){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_dua = '1'";
					}else{
						$rating_query .= " bintang_dua = '1' OR ";
					}
				}else if($rating == 3){				
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_tiga = '1'";
					}else{
						$rating_query .= " bintang_tiga = '1' OR ";
					}
				}else if($rating == 4){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_empat = '1'";
					}else{
						$rating_query .= " bintang_empat = '1' OR ";
					}
				}else if($rating == 5){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_lima = '1'";
					}else{
						$rating_query .= " bintang_lima = '1' OR ";
					}
				}
				$i++;
			}
		}else{
			if($rat[0] == 1){
				$rating_query .= "bintang_satu = '1'";		
			}else if($rat[0] == 2){
				$rating_query .= "bintang_dua = '1'";
			}else if($rat[0] == 3){
				$rating_query .= "bintang_tiga = '1'";
			}else if($rat[0] == 4){
				$rating_query .= "bintang_empat = '1'";
			}else if($rat[0] == 5){
				$rating_query .= "bintang_lima = '1'";
			}
		}

		$sql = 'SELECT * FROM reviews JOIN products ON products.id_product = reviews.id_product JOIN category ON category.id_category = products.id_category WHERE products.nama_product like "%'.$keyword.'%" AND ('.$rating_query.') GROUP BY reviews.id_product';

		//terus diloop datanya, itung persentage reviewnya (yg ad di home/shopping), kalo sesuai ama yang dicari masukin ke array

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$persentage = 0;

				$totalreview = $this->data_productview_getreview($row->id_product)->num_rows();

				$data_bintang1 = $this->data_productview_getreview_bintang("satu", $row->id_product)->row()->bintang_satu;
				$data_bintang2 = $this->data_productview_getreview_bintang("dua", $row->id_product)->row()->bintang_dua;
				$data_bintang3 = $this->data_productview_getreview_bintang("tiga", $row->id_product)->row()->bintang_tiga;
				$data_bintang4 = $this->data_productview_getreview_bintang("empat", $row->id_product)->row()->bintang_empat;
				$data_bintang5 = $this->data_productview_getreview_bintang("lima", $row->id_product)->row()->bintang_lima;

				if($totalreview != 0){
					$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);
				}

				if(sizeof($rat) > 1){
					foreach ($rat as $rating) {
						if($rating == 1){

							if($percentage >= 1 && $percentage < 2){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 2){

							if($percentage >= 2 && $percentage < 3){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 3){

							if($percentage >= 3 && $percentage < 4){
								$data[] = $row;
								$this->addtotalfound();
							}
							
						}else if($rating == 4){
							
							if($percentage >= 4 && $percentage < 5){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 5){
							
							if($percentage >= 5){
								$data[] = $row;
								$this->addtotalfound();
							}

						}
					}	
				}else{
					if($rat[0] == 1){

						if($percentage >= 1 && $percentage < 2){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 2){

						if($percentage >= 2 && $percentage < 3){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 3){

						if($percentage >= 3 && $percentage < 4){
							$this->addtotalfound();
							$data[] = $row;
						}
						
					}else if($rat[0] == 4){
						
						if($percentage >= 4 && $percentage < 5){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 5){
						
						if($percentage >= 5){
							$data[] = $row;
							$this->addtotalfound();
						}

					}
				}	
			}
			// return $data;
		}
		// return false;
	}

	function search_cat_rat($keyword, $cat, $rat) {
		$case = "";
		$rating_query = "";
		$i = 1;

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}


		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_satu = '1'";
					}else{
						$rating_query .= " bintang_satu = '1' OR ";
					}
				}else if($rating == 2){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_dua = '1'";
					}else{
						$rating_query .= " bintang_dua = '1' OR ";
					}
				}else if($rating == 3){				
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_tiga = '1'";
					}else{
						$rating_query .= " bintang_tiga = '1' OR ";
					}
				}else if($rating == 4){					
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_empat = '1'";
					}else{
						$rating_query .= " bintang_empat = '1' OR ";
					}
				}else if($rating == 5){
					if(sizeof($rat) == $i){
						$rating_query .= " bintang_lima = '1'";
					}else{
						$rating_query .= " bintang_lima = '1' OR ";
					}
				}
				$i++;
			}
		}else{
			if($rat[0] == 1){
				$rating_query .= "bintang_satu = '1'";		
			}else if($rat[0] == 2){
				$rating_query .= "bintang_dua = '1'";
			}else if($rat[0] == 3){
				$rating_query .= "bintang_tiga = '1'";
			}else if($rat[0] == 4){
				$rating_query .= "bintang_empat = '1'";
			}else if($rat[0] == 5){
				$rating_query .= "bintang_lima = '1'";
			}
		}

		$sql = 'SELECT * FROM reviews JOIN products ON products.id_product = reviews.id_product JOIN category ON category.id_category = products.id_category WHERE products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'" AND ('.$rating_query.') GROUP BY reviews.id_product';

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$persentage = 0;

				$totalreview = $this->data_productview_getreview($row->id_product)->num_rows();

				$data_bintang1 = $this->data_productview_getreview_bintang("satu", $row->id_product)->row()->bintang_satu;
				$data_bintang2 = $this->data_productview_getreview_bintang("dua", $row->id_product)->row()->bintang_dua;
				$data_bintang3 = $this->data_productview_getreview_bintang("tiga", $row->id_product)->row()->bintang_tiga;
				$data_bintang4 = $this->data_productview_getreview_bintang("empat", $row->id_product)->row()->bintang_empat;
				$data_bintang5 = $this->data_productview_getreview_bintang("lima", $row->id_product)->row()->bintang_lima;

				if($totalreview != 0){
					$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);
				}

				if(sizeof($rat) > 1){
					foreach ($rat as $rating) {
						if($rating == 1){

							if($percentage >= 1 && $percentage < 2){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 2){

							if($percentage >= 2 && $percentage < 3){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 3){

							if($percentage >= 3 && $percentage < 4){
								$data[] = $row;
								$this->addtotalfound();
							}
							
						}else if($rating == 4){
							
							if($percentage >= 4 && $percentage < 5){
								$data[] = $row;
								$this->addtotalfound();
							}

						}else if($rating == 5){
							
							if($percentage >= 5){
								$data[] = $row;
								$this->addtotalfound();
							}

						}
					}	
				}else{
					if($rat[0] == 1){

						if($percentage >= 1 && $percentage < 2){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 2){

						if($percentage >= 2 && $percentage < 3){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 3){

						if($percentage >= 3 && $percentage < 4){
							$data[] = $row;
							$this->addtotalfound();
						}
						
					}else if($rat[0] == 4){
						
						if($percentage >= 4 && $percentage < 5){
							$data[] = $row;
							$this->addtotalfound();
						}

					}else if($rat[0] == 5){
						
						if($percentage >= 5){
							$data[] = $row;
							$this->addtotalfound();
						}

					}
				}	
			}
			// return $data;
		}
		// return false;
	}

	/* DATA SEARCH */

}
?>