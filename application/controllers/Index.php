<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{

	private $config_pagination = array();
	private $notif_data = array();

	public function __construct(){
		parent::__construct();
	$this->load->model(array('M_Index'/*,'M_address','M_banks','M_category','M_confirmation','M_messages','M_products','M_reseller_pending_approval','M_Reviews','M_seller_pending_approval','M_shop','M_stok_notification','M_transaction_cancelled','M_transaction_history','M_transaction_history_product','M_transaction_history_seller','M_user_level','M_users','M_withdrawal','M_admins','M_reviews'*/));

	$this->notif_data['header'] = 'Notification';
	$this->notif_data['duration'] = '4000';
	$this->notif_data['sticky'] = 'false';
	$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');

	$this->config_pagination['full_tag_open'] = "<ul class='pagination'>";
	$this->config_pagination['full_tag_close'] = '</ul>';
	$this->config_pagination['num_tag_open'] = '<li>';
	$this->config_pagination['num_tag_close'] = '</li>';
	$this->config_pagination['cur_tag_open'] = '<li class="active"><a href="#">';
	$this->config_pagination['cur_tag_close'] = '</a></li>';
	$this->config_pagination['prev_tag_open'] = '<li>';
	$this->config_pagination['prev_tag_close'] = '</li>';
	$this->config_pagination['first_link'] = '&lsaquo;&lsaquo;';
	$this->config_pagination['first_tag_open'] = '<li>';
	$this->config_pagination['first_tag_close'] = '</li>';
	$this->config_pagination['last_link'] = '&rsaquo;&rsaquo;';
	$this->config_pagination['last_tag_open'] = '<li>';
	$this->config_pagination['last_tag_close'] = '</li>';

	$this->config_pagination['prev_link'] = '&larr;';
	$this->config_pagination['prev_tag_open'] = '<li>';
	$this->config_pagination['prev_tag_close'] = '</li>';

	$this->config_pagination['next_link'] = '&rarr;';
	$this->config_pagination['next_tag_open'] = '<li>';
	$this->config_pagination['next_tag_close'] = '</li>';
}

	/***
 	*      _      _____ __  __ _____ _______ _      ______  _____ _____   __ 
 	*     | |    |_   _|  \/  |_   _|__   __| |    |  ____|/ ____/ ____| /_ |
 	*     | |      | | | \  / | | |    | |  | |    | |__  | (___| (___    | |
 	*     | |      | | | |\/| | | |    | |  | |    |  __|  \___ \\___ \   | |
 	*     | |____ _| |_| |  | |_| |_   | |  | |____| |____ ____) |___) |  | |
 	*     |______|_____|_|  |_|_____|  |_|  |______|______|_____/_____/   |_|
 	*                                                                        
 	*                                                                        
 	*/

	/***
 	*      __  __          _____ _   _   _____        _____ ______  _____ 
	*     |  \/  |   /\   |_   _| \ | | |  __ \ /\   / ____|  ____|/ ____|
 	*     | \  / |  /  \    | | |  \| | | |__) /  \ | |  __| |__  | (___  
 	*     | |\/| | / /\ \   | | | . ` | |  ___/ /\ \| | |_ |  __|  \___ \ 
 	*     | |  | |/ ____ \ _| |_| |\  | | |  / ____ \ |__| | |____ ____) |
 	*     |_|  |_/_/    \_\_____|_| \_| |_| /_/    \_\_____|______|_____/ 
 	*                                                                     
 	*                                                                     
 	*/

	//
	// main pages                                                         
	//

 	function home(){
 		$data["title"] = $GLOBALS["webname"];
 		$data["webname"] = $GLOBALS["webname"];
 		$data["content"] = "main/v_home";
 		$data["active"] = "shopping";

 		$data["data_user"] = $this->session->all_userdata();
 		$data["data_product"] = $this->M_Index->data_home_product_topweekly()->result();
 		$data["data_promo"] = $this->M_Index->data_home_product_toppromo()->result();
 		$data["data_cat"] = $this->M_Index->data_home_category()->result();

 		if($this->isLoggedin()){
 			$data["loggedin"] = true;
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 		}else{
 			$data["loggedin"] = false;
 		}

 		$this->load->view('template/v_template', $data);
 	}

 	function shopping(){
 		$data["title"] = "Shopping";
 		$data["webname"] = $GLOBALS["webname"];
 		$data["content"] = "main/v_shopping";
 		$data["active"]	= "shopping";

 		$data["data_user"] = $this->session->all_userdata();
 		$data["data_cat"] = $this->M_Index->data_home_category()->result();

 		// $id			= 	$this->uri->segment(3);
 		$nama_category = urldecode($this->uri->segment(3));

 		if(is_numeric($nama_category)){
 			$nama_category = '';
 		}

 		$q_cat = $this->M_Index->data_shopping_category_byname($nama_category);

 		if($q_cat->num_rows() > 0 && !empty($nama_category)){
 			$id_category = $q_cat->row()->id_category;
 		}else{
 			$id_category = '-';
 		}
 		
 		$data["data_product"] = $this->M_Index->data_shopping_product_topweekly_bycatid($id_category)->result();

 		/* CI Pagination */
 		if(!empty($nama_category)){
 			$this->config_pagination["base_url"] = base_url() . "shopping/category/".$this->uri->segment(3);
 			$this->config_pagination["total_rows"] = $this->M_Index->data_shopping_product_topweekly_bycatid($id_category)->num_rows();
 			$this->config_pagination["uri_segment"] = 4;
 		}else{
 			$this->config_pagination["base_url"] = base_url() . "shopping/all";
 			$this->config_pagination["total_rows"] = $this->M_Index->data_shopping_product_topweekly()->num_rows();
 			$this->config_pagination["uri_segment"] = 3;
 		}
 		
 		$this->config_pagination["per_page"] = 12;
 		$this->config_pagination["num_links"] = 4;
 		$this->config_pagination['use_page_numbers'] = TRUE;

 		$this->pagination->initialize($this->config_pagination);

 		if(!empty($nama_category)){
 			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 			$segment = $this->uri->segment(4);
 		}else{
 			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 			$segment = $this->uri->segment(3);
 		}

 		$segment = $segment > 0 ? (($segment - 1) * $this->config_pagination["per_page"]) : $segment;

 		if(!empty($nama_category)){
 			$data["results"] = $this->M_Index->data_shopping_product_topweekly_bycatid_fetch($this->config_pagination["per_page"], $segment, $id_category);
 		}else{
 			$data["results"] = $this->M_Index->data_shopping_product_topweekly_fetch($this->config_pagination["per_page"], $segment);
 		}
 		$data["links"] = $this->pagination->create_links();
 		/* /CI Pagination */

 		if($this->isLoggedin()){
 			$data["loggedin"] = true;
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 		}else{
 			$data["loggedin"] = false;
 		}

 		$this->load->view('template/v_template', $data);
 	}

 	// function about(){

 	// 	$data["title"]			=	"About Us";
 	// 	$data["webname"]		= 	$GLOBALS["webname"];
 	// 	$data["content"]		=	"main/v_about";
 	// 	$data["active"]			=	"aboutus";

 	// 	if($this->isLoggedin() == true){
 	// 		$data["loggedin"]		=	true;
 	// 	}else{
 	// 		$data["loggedin"]		=	false;
 	// 	}

 	// 	$this->load->view('template/v_template',$data);

 	// }

	/***
 	*              _    _ _______ _    _ 
 	*         /\  | |  | |__   __| |  | |
 	*        /  \ | |  | |  | |  | |__| |
 	*       / /\ \| |  | |  | |  |  __  |
 	*      / ____ \ |__| |  | |  | |  | |
 	*     /_/    \_\____/   |_|  |_|  |_|
 	*                                    
 	*                                    
 	*/

	//	
	// auth pages                                                     
	//

 	function adminlogin(){
 		if($this->isLoggedin()){
 			if($this->session->userdata('user_lvl') != "1" || $this->session->userdata('user_lvl') != "2"){
 				redirect('account/profile');
 			}else{
 				redirect('dashboard');
 			}
 		}else{
 			$data["title"] = "Login";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["content"] = "auth/v_login";
 			$data["active"]	= "login";
 			$data["loggedin"] = false;

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}

 			$this->load->view('v_adminlogin',$data);
 		}
 	}

 	function login(){
 		if($this->isLoggedin()){
 			if($this->session->userdata('user_lvl') != "1" || $this->session->userdata('user_lvl') != "2"){
 				redirect('account/profile');
 			}else{
 				redirect('dashboard');
 			}
 		}else{
 			$data["title"] = "Login";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["content"] = "auth/v_login";
 			$data["active"]	= "login";
 			$data["loggedin"] = false;

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}
 			
 			if($this->M_Index->login_gettoken(get_cookie('token'))->num_rows() > 0){
 				if ($this->M_Index->login_updatesession(get_cookie('token'))){
					redirect(""); //login sukses
				}else{	
					$this->session->set_flashdata('error','*Terjadi kesalahan saat login!');
					redirect("/login/gagal");
				}
			}

			$this->load->view('template/v_template',$data);
		}
	}

	function register(){
		if($this->isLoggedin()){
			if($this->session->userdata('user_lvl') != "1" || $this->session->userdata('user_lvl') != "2"){
				redirect('account/profile');
			}else{
				redirect('dashboard');
			}
		}else{
			$data["title"] = "Register";
			$data["webname"] = $GLOBALS["webname"];
			$data["content"] = "auth/v_register";
			$data["active"]	= "login";
			$data["loggedin"] = false;

			$config_captcha = array(
				'img_path' => './assets/images/captcha/',
				'img_url' => base_url().'assets/images/captcha/',
				'img_width' => '150',
				'img_height' => 45,
				'word_length' => 4,
				'font_path' => FCPATH.'/assets/fonts/Roboto-Bold.ttf',
				'font_size' => '20',
				'expiration' => 7200,
				'pool' => '0123456789',
				'colors' => array(
					'background' => array(255, 255, 255),
					'border' => array(255, 255, 255),
					'text' => array(0, 0, 0),
					'grid' => array(229, 115, 115)
				)
			);

        	// create captcha image
			$captcha = create_captcha($config_captcha);
        	// store image html code in a variable
			$data['image'] = $captcha['image'];
        	// store the captcha word in a session
			$this->session->set_userdata('regis_captcha', $captcha['word']);

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			$this->load->view('template/v_template',$data);
		}
	}

	/***
 	*       _____ _    _  ____  _____  _____ _____ _   _  _____ 
 	*      / ____| |  | |/ __ \|  __ \|  __ \_   _| \ | |/ ____|
 	*     | (___ | |__| | |  | | |__) | |__) || | |  \| | |  __ 
 	*      \___ \|  __  | |  | |  ___/|  ___/ | | | . ` | | |_ |
 	*      ____) | |  | | |__| | |    | |    _| |_| |\  | |__| |
 	*     |_____/|_|  |_|\____/|_|    |_|   |_____|_| \_|\_____|
 	*                                                           
 	*                                                           
 	*/

	//
	// shopping pages
	//

 	function cart(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$data["data_user"] = $this->session->all_userdata();

 			if($data["data_user"]["user_lvl"] == "1" || $data["data_user"]["user_lvl"] == "2" || $data["data_user"]["user_lvl"] == "4"){
 				redirect('');
 			}

 			$data["title"] = "Shopping Cart";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["content"] = "shopping/v_cart";
 			$data["active"]	= "shopping";
 			$data["loggedin"] = true;

 			if(count($this->cart->contents()) > 0){
 				$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/city";
 				$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";
 				$json = $this->get_curl($this->curl_data);
 				$data["rajaongkir_kota"] = $json['rajaongkir']['results'];
 			}
 			
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}

 	function order(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			if(count($this->cart->contents()) > 0){
 				$data["title"] = "Order";
 				$data["webname"] = $GLOBALS["webname"];
 				$data["content"] = "shopping/v_order";
 				$data["active"]	= "order";
 				$data["loggedin"] = true;
 				$data["data_user"] = $this->session->all_userdata();

 				$q_address = $this->M_Index->data_order_getaddress($data["data_user"]["id_user"]);

 				if($q_address->num_rows() == 0){
 					$this->notif_data['message'] = 'Silahkan tambah alamat pengiriman terlebih dahulu sebelum melakukan pemesanan.';
 					$this->notif_data['theme'] = 'bg-warning alert-styled-left';
 					$this->notif_data['group'] = 'alert-warning';
 					$this->notif_data($this->notif_data);
 					redirect('account/profile#pengaturan');
 				}

 				$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/city";
 				$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";
 				$json = $this->get_curl($this->curl_data);

 				$data["data_alamat"] = $q_address->result();
 				$data["data_bank"] = $this->M_Index->data_order_getbank()->result();
 				$data["saldo"] = $this->M_Index->data_order_getuser($data['data_user']['id_user'])->row()->saldo;
 				$data["rajaongkir_kota"] = $json['rajaongkir']['results'];

 				$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 				$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 				$this->load->view('template/v_template',$data);
 			}else{
 				redirect('');
 			}
 		}
 	}

 	function orderdetails(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$id_transaction = $this->uri->segment(3);
 			$data["data_user"] = $this->session->all_userdata();
 			$data["trans_history"] = $this->M_Index->data_details_transhistory($id_transaction)->row();
 			if($data["trans_history"]->id_user !=$data['data_user']['id_user']){
 				redirect('');
 			}else{
 				$data["title"] = "Order Details";
 				$data["webname"] = $GLOBALS["webname"];
 				$data["content"] = "shopping/v_orderdetails";
 				$data["active"]	= "shopping";
 				$data["data_bank"] = $this->M_Index->data_order_getbank()->result();
 				$data["loggedin"] =	true;

 				// $data["trans_history_prod"] 	=	$this->m_transaction_history_product->select("transaction",$id)->result();
 				// $data["trans_history_seller"]  	=	$this->m_transaction_history_seller->select("transaction",$id)->result();

 				$data["shipment"] = $this->M_Index->data_details_shipment($data["trans_history"]->id_address)->row();

 				$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 				$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 				
 				$this->load->view('template/v_template',$data);
 			}

 		}

 	}

 	function product_view(){
 		$url_product = urldecode($this->uri->segment(2));
 		$q_product = $this->M_Index->data_productview_product_byurl($url_product);
 		$data["data_user"] = $this->session->all_userdata();	

 		if($this->isLoggedin()){
 			$data["loggedin"] = true;
 		}else{
 			$data["loggedin"] = false;
 		}

 		if($q_product->num_rows() == 0 ){
 			$data["found"] = false;
 			$data["title"] = "Product";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"]	= "product";
 			$data["content"] = "product/v_product_details";
 		}else{
 			$data["found"] = true;
 			$data["data_product"] = $q_product->row();
 			$data["title"] = $q_product->row()->nama_product;
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"] = "product";
 			$data["content"] = "product/v_product_details";

 			if(!empty($data["data_user"]["user_lvl"])){
 				$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 				$data['notif'] = $this->M_Index->data_productview_getstoknotif($data["data_product"]->id_product,$data["data_user"]['id_user'])->num_rows();
 			}
 			if(empty($data["data_user"]["id_shop"])){
 				$data["data_user"]["id_shop"] = "notseller";
 			}

 			$data["shop"] =	$this->M_Index->data_productview_getshop($data["data_product"]->id_shop)->row();
 			$data["data_seller"] = $this->M_Index->data_productview_getuser($data["shop"]->id_user)->row();
 			$data["category"] = $this->M_Index->data_productview_getcategory($data["data_product"]->id_category)->row();
 			$data["related_prod"] 	=	$this->M_Index->data_productview_relatedprod($data["category"]->id_category)->result();

 			$q_review =	$this->M_Index->data_productview_getreview($data["data_product"]->id_product);

 			$data["tot_review"] = $q_review->num_rows();
 			$data["data_review"] = $q_review->result();

 			$data["data_bintang1"] 	= 	$this->M_Index->data_productview_getreview_bintang("satu", $data["data_product"]->id_product)->row()->bintang_satu;
 			$data["data_bintang2"] 	= 	$this->M_Index->data_productview_getreview_bintang("dua", $data["data_product"]->id_product)->row()->bintang_dua;
 			$data["data_bintang3"] 	= 	$this->M_Index->data_productview_getreview_bintang("tiga", $data["data_product"]->id_product)->row()->bintang_tiga;
 			$data["data_bintang4"] 	= 	$this->M_Index->data_productview_getreview_bintang("empat", $data["data_product"]->id_product)->row()->bintang_empat;
 			$data["data_bintang5"] 	= 	$this->M_Index->data_productview_getreview_bintang("lima", $data["data_product"]->id_product)->row()->bintang_lima;

 			/* CI Pagination */
 			$this->config_pagination["base_url"] = base_url() . "product/".$this->uri->segment(2);
 			$this->config_pagination["total_rows"] = $data["tot_review"];
 			$this->config_pagination["per_page"] = 5;
 			$this->config_pagination["num_links"] = 4;
 			$this->config_pagination["uri_segment"] = 3;
 			$this->config_pagination['use_page_numbers'] = TRUE;

 			$this->pagination->initialize($this->config_pagination);

 			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 			$data["results"] = $this->M_Index->data_productview_getreview_fetch($this->config_pagination["per_page"], $page, $data["data_product"]->id_product);
 			$data["links"] = $this->pagination->create_links();
 			/* CI Pagination */

 			$hari = strtolower(date('l'));
			// $hari = 'monday';

 			//total views
 			if(isset($data["data_user"]['id_shop'])){
 				if($data["data_product"]->id_shop != $data["data_user"]['id_shop']){
 					$array = array('views' => $data["data_product"]->views + 1);
 					$this->M_Index->data_productview_editproduct($array,$data["data_product"]->id_product);
 				}
 			}else{
 				$array = array('views' => $data["data_product"]->views + 1);
 				$this->M_Index>data_productview_editproduct($array,$id);
 			}

			//views weekly and total views
 			if(isset($data["data_user"]['id_shop'])){
 				if($data["data_product"]->id_shop != $data["data_user"]['id_shop']){
 					if($data["data_product"]->view_weekly_active == $hari){
 						$array = array($hari => $data["data_product"]->$hari + 1);
 						$this->M_Index->data_productview_editproduct($array,$data["data_product"]->id_product);
 					}else{
 						$array = array('view_weekly_active' => $hari, $hari => '1');
 						$this->M_Index->data_productview_editproduct($array,$data["data_product"]->id_product);
 					}
 				}
 			}else{
 				if($data["data_product"]->view_weekly_active == $hari){
 					$array = array($hari => $data["data_product"]->$hari + 1);
 					$this->M_products->edit($array,$id);
 				}else{
 					$array = array('view_weekly_active' => $hari, $hari => '1');
 					$this->M_products->edit($array,$id);
 				}
 			}
 		}


 		if($this->isLoggedin()){
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 		}

 		$this->load->view('template/v_template',$data);
 	}

	// alamat

 	function alamat_add(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/province";
 			$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

 			$data["title"] = "Tambah Alamat";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"]	= "alamat";
 			$data["content"] = "alamat/v_address_add";
 			$data["loggedin"] = true;
 			$data["data_user"] = $this->session->all_userdata();
 			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();
 			$data["rajaongkir_provinsi"] = $this->get_curl($this->curl_data);

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}

 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}


 	function alamat_edit(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$id_address = $this->uri->segment(4);
 			$data["data_user"] = $this->session->all_userdata();

 			$q_address = $this->M_Index->data_alamat_getaddress($data["data_user"]["id_user"],$id_address);

 			if($q_address->num_rows() == 0){
 				$this->notif_data['message'] = "Alamat pengiriman yang ingin anda ubah tidak ditemukan / bukan milik anda!";
 				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
 				$this->notif_data['group'] = 'alert-warning';
 				$this->notif_data($this->notif_data);
 				redirect('account/profile#pengaturan');
 			}else{
 				$this->curl_data[CURLOPT_URL] = "http://api.rajaongkir.com/starter/province";
 				$this->curl_data[CURLOPT_CUSTOMREQUEST] = "GET";

 				$data["loggedin"] = true;
 				$data["alamat"]	= $q_address->row();
 				$data["title"] = "Ubah Alamat";
 				$data["webname"] = $GLOBALS["webname"];
 				$data["active"] = "alamat";
 				$data["content"] = "alamat/v_address_edit";
 				$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 				$data["user_data"] = $this->M_Index->data_productview_getuser($data["data_user"]["id_user"])->row();
 				$data["rajaongkir_provinsi"] = $this->get_curl($this->curl_data);

 				if(isset($_SESSION['error'])){
 					$data["error"]		=	$_SESSION['error'];
 				}
 				if(isset($_SESSION['info'])){
 					$data["info"]		=	$_SESSION['info'];
 				}

 				$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 				$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 				$this->load->view('template/v_template',$data);
 			}
 		}
 	}

	//alamat-end

 	function profile(){
 		$username = $this->uri->segment(2);

 		$data["title"] = "Profile - ".$username;
 		$data["webname"] = $GLOBALS["webname"];
 		$data["active"]	= "profile";
 		$data["content"] = "v_profile";
 		$data["data_user"] = $this->session->all_userdata();
 		$data["user_data"] = $this->M_Index->data_profile_getprofile($username)->row();
 		$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 		
 		$id_shop = $this->M_Index->login_getshop_byiduser($data["user_data"]->id_user)->row()->id_shop;
 		$q_product =  $this->M_Index->data_profile_getproducts_byshop($id_shop);

 		/* CI Pagination */
 		$this->config_pagination["base_url"] = base_url() . "u/".$username;
 		$this->config_pagination["total_rows"] = $q_product->num_rows();
 		$this->config_pagination["per_page"] = 12;
 		$this->config_pagination["num_links"] = 4;
 		$this->config_pagination["uri_segment"] = 3;
 		$this->config_pagination['use_page_numbers'] = TRUE;

 		$this->pagination->initialize($this->config_pagination);

 		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 		$data["results"] = $this->M_Index->data_profile_product_fetch($this->config_pagination["per_page"], $page, $id_shop);
 		$data["links"] = $this->pagination->create_links();
 		/* CI Pagination */

 		if($this->isLoggedin() == true){
 			$data["loggedin"] =	true;
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 		}else{
 			$data["loggedin"] = false;
 		}

 		$this->load->view('template/v_template',$data);
 	}

	/***
 	*      _      _____ __  __ _____ _______ _      ______  _____ _____   _____ 
 	*     | |    |_   _|  \/  |_   _|__   __| |    |  ____|/ ____/ ____| | ____|
 	*     | |      | | | \  / | | |    | |  | |    | |__  | (___| (___   | |__  
 	*     | |      | | | |\/| | | |    | |  | |    |  __|  \___ \\___ \  |___ \ 
 	*     | |____ _| |_| |  | |_| |_   | |  | |____| |____ ____) |___) |  ___) |
 	*     |______|_____|_|  |_|_____|  |_|  |______|______|_____/_____/  |____/ 
 	*                                                                           
 	*                                                                           
 	*/

	/***
 	*      _____           _____ _    _ ____   ____          _____  _____  
 	*     |  __ \   /\    / ____| |  | |  _ \ / __ \   /\   |  __ \|  __ \ 
 	*     | |  | | /  \  | (___ | |__| | |_) | |  | | /  \  | |__) | |  | |
 	*     | |  | |/ /\ \  \___ \|  __  |  _ <| |  | |/ /\ \ |  _  /| |  | |
 	*     | |__| / ____ \ ____) | |  | | |_) | |__| / ____ \| | \ \| |__| |
 	*     |_____/_/    \_\_____/|_|  |_|____/ \____/_/    \_\_|  \_\_____/ 
 	*                                                                      
 	*                                                                      
 	*/

 	function account(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$data["title"] = "Account";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"] = "account";
 			$data["content"] = "v_account";
 			$data["loggedin"] = true;
 			$data["data_user"] = $this->session->all_userdata();
 			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();
 			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;

 			if($data['user_lvl_name'] == 'Admin'){
 				redirect('dashboard');
 			}

 			if($data["user_lvl_name"] == "Seller"){

 				$data["data_shop"] = $this->M_Index->login_getshop_byiduser($data["data_user"]["id_user"])->row();
 				$data["data_pembelian"]	= $this->M_Index->data_account_datapenjualan($data["data_shop"]->id_shop)->result();
 				$data["shop_product"] =	$this->M_Index->data_account_dataproduct($data["data_shop"]->id_shop)->result();
 				$data["data_withdraw"] = $this->M_Index->data_account_datawithdrawal($data["data_shop"]->id_shop)->result();
 				$data["data_exceed"] = $this->M_Index->data_account_exceeddelivery($data["data_user"]['id_shop'])->result();

 			}else{

 				$data["data_pembelian"]	= $this->M_Index->data_account_datapembelian($data["data_user"]["id_user"])->result();
 				// $data["data_jmlproduk"]	= $this->M_transaction_history->select('pembelianuser',$data["data_user"]["id_user"])->result();
 				$data["data_bank"] = $this->M_Index->data_order_getbank()->result();
 				$data["data_alamat"] = $this->M_Index->data_order_getaddress($data["data_user"]["id_user"])->result();
 				$data["cancelled_order"] = $this->M_Index->data_account_cancelledorder($data["data_user"]["id_user"])->result();

 			}

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}
 			
 			$data["data_msg"] = $this->M_Index->data_account_msg($data["data_user"]["id_user"])->result();
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}




// ______          _     _                         _   _____                    _       _       
// |  _  \        | |   | |                       | | |_   _|                  | |     | |      
// | | | |__ _ ___| |__ | |__   ___   __ _ _ __ __| |   | | ___ _ __ ___  _ __ | | __ _| |_ ___ 
// | | | / _` / __| '_ \| '_ \ / _ \ / _` | '__/ _` |   | |/ _ \ '_ ` _ \| '_ \| |/ _` | __/ _ \
// | |/ / (_| \__ \ | | | |_) | (_) | (_| | | | (_| |   | |  __/ | | | | | |_) | | (_| | ||  __/
// |___/ \__,_|___/_| |_|_.__/ \___/ \__,_|_|  \__,_|   \_/\___|_| |_| |_| .__/|_|\__,_|\__\___|
//                                                                       | |                    
//                                                                       |_|                    


 	function msg_all(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$data["title"] = "Messages";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"]	= "account";
 			$data["content"] = "v_msg";
 			$data["loggedin"] = true;
 			$data["data_user"] = $this->session->all_userdata();
 			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();

 			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;

 			$data["data_msg"] = $this->M_Index->data_account_msg($data["data_user"]["id_user"])->result();
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}


 	function msg_convo(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$id_convo = $this->uri->segment(4);
 			$q_convo = $this->M_Index->data_message_convolimitone($id_convo)->row();
 			$data["data_user"] = $this->session->all_userdata();
 			if($q_convo->id_receiver == $data["data_user"]["id_user"] || $q_convo->id_user == $data["data_user"]["id_user"]){
 				
 				$data["webname"] = $GLOBALS["webname"];
 				$data["active"]	= "account";
 				$data["content"] = "v_msg_convo";
 				$data["loggedin"] = true;

 				$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 				$data["data_msg"] = $this->M_Index->data_message_convo($id_convo)->result();
 				$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();

 				if($this->uri->segment(3) == "new"){
 					$data["new"] = true;
 					$data["data_receiver"] = $this->M_Index->data_order_getuser($id_convo)->row();
 					$data["title"] = "Conversation with ".$data["data_receiver"]->username;

 					$q = $this->M_Index->data_message_checkconvoexist($data["data_receiver"]->id_user, $data["data_user"]["id_user"]);
 					if($q->num_rows() > 0){
 						redirect("account/messages/convo/".$q->row()->id_convo);
 					}

 				}else if($this->uri->segment(3) == "convo"){
 					$data["new"] = false;
 					$data_viewed = array('viewed' => '1');

 					foreach($data["data_msg"] as $row){
 						$q_update = $this->M_Index->data_message_setviewed($data_viewed, $row->id_msg, $data["data_user"]["id_user"]);
 						
 						if(!$q_update){
 							$this->notif_data['message'] = 'Terjadi kesalahan.';
 							$this->notif_data['theme'] = 'bg-warning alert-styled-left';
 							$this->notif_data['group'] = 'alert-warning';
 							$this->notif_data($this->notif_data);
 							redirect('account/messages');
 						}
 					}

 					foreach($data["data_msg"] as $row){
 						if($row->id_receiver != $data["data_user"]["id_user"]){
 							$id_receiver = $row->id_receiver;
 						}else{
 							$id_receiver = $row->id_user;
 						}
 					}

 					$data["data_receiver"] = $this->M_Index->data_order_getuser($id_receiver)->row();
 					$data["title"] = "Conversation with ".$data["data_receiver"]->username;

 					$q = $this->M_Index->data_message_checkconvoexist($data["data_receiver"]->id_user, $data["data_user"]["id_user"]);
 					if($q->num_rows() == 0){
 						redirect("account/messages");
 					}
 				}

 				$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 				$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 				$this->load->view('template/v_template',$data);
 			}else{
 				redirect('account/messages');
 			}
 		}
 	}

 	function product_add(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$data["title"] = "Tambah Product Baru";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"]	= "addproduct";
 			$data["content"] = "product/v_product_add";
 			$data["loggedin"] =	true;
 			$data["data_cat"] = $this->M_Index->data_home_category()->result();
 			$data["data_user"] = $this->session->all_userdata();
 			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}
 			
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}

 	function product_edit(){
 		if(!$this->isLoggedin()){
 			redirect('');
 		}else{
 			$id_product = $this->uri->segment(4);
 			$data["data_user"] = $this->session->all_userdata();
 			$data["data_product"] = $this->M_Index->data_productedit_getproduct($id_product)->row();
 			$q_shop = $this->M_Index->login_getshop_byiduser($data["data_user"]["id_user"])->row();

 			if($data["data_product"]->id_shop != $q_shop->id_shop){
 				$this->notif_data['message'] = 'Terjadi kesalahan.';
 				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
 				$this->notif_data['group'] = 'alert-warning';
 				$this->notif_data($this->notif_data);
 				redirect('account/profile#riwayat');
 			}

 			$data["title"] = "Edit Product";
 			$data["webname"] = $GLOBALS["webname"];
 			$data["active"] = "editproduct";
 			$data["content"] = "product/v_product_edit";
 			$data["loggedin"] = true;

 			$data["data_cat"] =	$this->M_Index->data_home_category()->result();
 			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_user"]["user_lvl"])->row()->name;
 			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_user"]["id_user"])->row();

 			if(isset($_SESSION['error'])){
 				$data["error"]		=	$_SESSION['error'];
 			}
 			if(isset($_SESSION['info'])){
 				$data["info"]		=	$_SESSION['info'];
 			}

 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();

 			$this->load->view('template/v_template',$data);
 		}
 	}

//  __  __ ___ ____   ____ 
// |  \/  |_ _/ ___| / ___|
// | |\/| || |\___ \| |    
// | |  | || | ___) | |___ 
// |_|  |_|___|____/ \____|               
// misc

 	function search(){
 		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

 		$query_string = preg_replace('/&page=\w+/', '', $this->input->server('QUERY_STRING'));

 		$keyword = $this->input->get('search');

 		if(!empty($this->input->get('category'))){
 			$cat = $this->input->get('category');
 		}
 		if(!empty($this->input->get('rating'))){
 			$r = $this->input->get('rating');
 			$rating = "";
 			foreach($r as $rate){
 				$rating .= $rate.",";
 			}
 		}

 		$data["title"]			=	"Searching for ".$keyword;
 		$data["webname"]		= 	$GLOBALS["webname"];
 		$data["content"]		=	"v_search";
 		$data["active"]			=	"search";
 		$data["data_user"]		=	$this->session->all_userdata();
 		$data["keyword"]  		= 	$keyword;
 		$data["data_cat"]		= 	$this->M_Index->data_home_category()->result();

 		if(!empty($this->input->get('category'))){
 			if(!empty($this->input->get('rating'))){
 				$data["totalfound"] = $this->M_Index->search_cat_rat($keyword,$cat,$rating)->num_rows();
 			}else{
 				$data["totalfound"] = $this->M_Index->search_cat($keyword,$cat)->num_rows();
 			}
 		}else if(!empty($this->input->get('rating'))){
 			$data["totalfound"] = $this->M_Index->search_rat($keyword,$rating)->num_rows();
 		}else{
 			$data["totalfound"] = $this->M_Index->search($keyword)->num_rows();
 		}

 		/* CI Pagination */
 		$this->config_pagination["base_url"] = base_url() . "search?".$query_string;
 		$this->config_pagination["total_rows"] = $data["totalfound"];
 		$this->config_pagination["per_page"] = 12;
 		$this->config_pagination["num_links"] = 4;
 		$this->config_pagination["uri_segment"] = 2;
 		$this->config_pagination['enable_query_strings'] = TRUE;
 		$this->config_pagination['page_query_string'] = TRUE;
 		$this->config_pagination['use_page_numbers'] = TRUE;
 		$this->config_pagination['query_string_segment'] = 'page';

 		$this->pagination->initialize($this->config_pagination);

 		$page = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $this->config_pagination["per_page"] ) : 0;

 		if(!empty($this->input->get('category'))){
 			if(!empty($this->input->get('rating'))){
 				$data["results"] = $this->M_Index->fetch_search_cat_rat($this->config_pagination["per_page"], $page, $keyword, $cat, $rating);
 			}else{
 				$data["results"] = $this->M_Index->fetch_search_cat($this->config_pagination["per_page"], $page, $keyword, $cat);
 			}

 		}else if(!empty($this->input->get('rating'))){
 			$data["results"] = $this->M_Index->fetch_search_rat($this->config_pagination["per_page"], $page, $keyword, $rating);
 		}else{
 			$data["results"] = $this->M_Index->fetch_search($this->config_pagination["per_page"], $page, $keyword);	
 		}

 		$data["links"] = $this->pagination->create_links();
 		/* CI Pagination */ 

 		if($this->isLoggedin() == true){
 			$data["loggedin"] = true;
 			$data["data_msg_limited"] = $this->M_Index->data_msg_navbar($data["data_user"]["id_user"])->result();
 			$data["data_msg_new"] = $this->M_Index->data_msg_navbarnew($data["data_user"]["id_user"])->num_rows();
 		}else{
 			$data["loggedin"] = false;
 		}

 		$this->load->view('template/v_template',$data);
 	}

 }
 ?>
