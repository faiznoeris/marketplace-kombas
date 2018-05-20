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
			GROUP BY id_product
			ORDER BY seminggu DESC
			");
	}

	function data_home_product_toppromo(){
		return $this->db->query("
			SELECT *
			FROM products
			WHERE promo_aktif = '1'
			GROUP BY id_product
			ORDER BY views DESC
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
			WHERE id_category = '".$id_category."' 
			GROUP BY id_product
			ORDER BY seminggu DESC
			");
	}

	function data_shopping_product_topweekly(){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			GROUP BY id_product
			ORDER BY seminggu DESC
			");
	}

	function data_shopping_product_topweekly_bycatid_fetch($limit, $start, $id_category){
		$this->db->select("*, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu");
		$this->db->from("products");
		$this->db->where('id_category',$id_category);
		$this->db->group_by('id_product');
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
		$this->db->group_by('id_product');
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

	/* DATA ORDERDETAILS */

	/* DATA PRODUCT VIEW */

	function data_productview_product_byurl($url_product){
		return $this->db
		->where('url', $url_product)
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

	function data_productview_relatedprod($id_category){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			WHERE id_category = '".$id_category."' 
			GROUP BY id_product
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
		->where('id_product', $id_product)
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
		return $this->db->query("SELECT transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, DATE_FORMAT(transaction_history_seller.date_delivered, '%Y-%m-%d') as date_delivered, DATE_FORMAT(transaction_history.date, '%Y-%m-%d') as date_ordered, transaction_history.id_user, transaction_history_seller.warning, transaction_history.id_address FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history_seller.id_shop = '".$id_shop."'");
	}

	function data_account_datapembelian($id_user){
		return $this->db->query("SELECT transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, transaction_history.cart FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history.id_user = ".$id_user." GROUP BY transaction_history.id_transaction ORDER BY transaction_history.id_transaction DESC");
	}

	function data_account_cancelledorder($id_user){
		return $this->db
		->where('id_user', $id_user)
		->get('transaction_cancelled');
	}

	function data_account_msg($id_user){
		return $this->db->query("SELECT m1.*,DATE_FORMAT(m1.date, '%Y-%m-%d') AS date_tocheck, DATE_FORMAT(m1.date, '%H:%i') AS time FROM messages AS m1 LEFT JOIN messages AS m2 ON (m1.id_convo = m2.id_convo AND m1.id_msg < m2.id_msg) WHERE m2.id_msg IS NULL AND (m1.id_receiver = '".$id_user."' OR m1.id_user = '".$id_user."') ORDER by date DESC");
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
		$sql = 'select *,0 as bintang from products where nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
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
		$sql = 'select *,0 as bintang from products where nama_product like "%'.$keyword.'%" AND id_category = "'.$cat.'" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function fetch_search_rat($limit, $start, $keyword, $rat) {
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		
		// $sql = 'SELECT * FROM products LEFT JOIN (SELECT id_product, COUNT(bintang_satu) as bintang1, null as bintang2, null as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_satu = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product, null bintang1, COUNT(bintang_dua) as bintang2, null as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_dua = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product, null bintang1, null as bintang3, COUNT(bintang_empat) as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_tiga = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product,  null bintang1, null as bintang3, null as bintang3, COUNT(bintang_empat) as bintang4, null as bintang5  FROM reviews WHERE bintang_empat = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product,  null bintang1, null as bintang3, null as bintang3, null as bintang4, COUNT(bintang_lima) as bintang5  FROM reviews WHERE bintang_lima = 1 GROUP BY id_product) reviews ON reviews.id_product = products.id_product WHERE products.nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;

		// $sql = 'SELECT * FROM products WHERE products.nama_product LIKE "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}



	public function fetch_search_cat_rat($limit, $start, $keyword, $cat, $rat) {
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'"  LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function search($keyword){
		return $this->db->query('Select *,0 as bintang from products where nama_product like "%'.$keyword.'%"');
	}

	function search_cat($keyword, $cat){
		return $this->db->query('Select *,0 as bintang from products where nama_product like "%'.$keyword.'%" AND id_category = "'.$cat.'"');
	}

	function search_rat($keyword, $rat){
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%"';
		return $this->db->query($sql);
		// return $sql;
	}

	function search_cat_rat($keyword, $cat, $rat){
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'"';
		return $this->db->query($sql);
		// return $sql;
	}

	/* DATA SEARCH */

}
?>