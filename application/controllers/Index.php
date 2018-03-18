<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{

	function cekkabupaten(){
		$this->cek_kabupaten();
	}
	function getalamat(){
		$this->get_alamat();
	}
	function getongkir(){
		$this->get_ongkir();
	}

//	___  ___      _         _____                    _       _       
//	|  \/  |     (_)       |_   _|                  | |     | |      
//	| .  . | __ _ _ _ __     | | ___ _ __ ___  _ __ | | __ _| |_ ___ 
//	| |\/| |/ _` | | '_ \    | |/ _ \ '_ ` _ \| '_ \| |/ _` | __/ _ \
//	| |  | | (_| | | | | |   | |  __/ | | | | | |_) | | (_| | ||  __/
//	\_|  |_/\__,_|_|_| |_|   \_/\___|_| |_| |_| .__/|_|\__,_|\__\___|
//	                                          | |                    
//	                                          |_|                    

//
// main pages                                                         
//

	function home(){

		$this->load->model(array('m_products','m_category','m_shop'));	

		$data["title"]			=	$GLOBALS["webname"];
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		= 	"main/v_home";
		$data["active"]			=	"home";
		$data["data_product"]	=	$this->m_products->topweekly('')->result();
		$data["data_promo"]		=	$this->m_products->topviewspromo()->result();
		$data["data_user"]		=	$this->session->all_userdata();
		$data["data_cat"]		= 	$this->m_category->select()->result();

		// $data["data_header"]	=	$this->m_promo_headers->select('')->result();
		
		if($this->isLoggedin()){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template', $data);

	}

	function category(){
		$this->load->model(array('m_category','m_products','m_shop'));

		$id = $this->uri->segment(2);

		$data["title"]			=	"Category";
		$data["active"]			=	"shop";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["data_cat"]		= 	$this->m_category->select()->result();
		$data["data_user"]		=	$this->session->all_userdata();

		if(!empty($id)){

			$data["content"] 		= 	"main/v_category";
			$data["data_product"]	=	$this->m_products->topweekly($id)->result();

			$config = array();
			$config["base_url"] = base_url() . "category/".$id;
			$config["total_rows"] = $this->m_products->topweekly($id)->num_rows();
			$config["per_page"] = 12;
			$config["uri_segment"] = 3;
			$choice = ceil($config['total_rows']/$config['total_rows']);
			$config["num_links"] = round($choice);

			$config['first_link'] = false; 
			$config['last_link']  = false;

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["results"] = $this->m_products->fetch_topweekly($config["per_page"], $page, $id);
			$data["links"] = $this->pagination->create_links();

		}else{
			$data["content"] 		= 	"main/v_maincategory";
			$data["data_product"]	=	$this->m_products->topviews()->result();
		}
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		if(!empty($id)){
			$this->load->view('v_template',$data);
		}else{
			$this->load->view('v_template',$data);
		}
	}
	
	// function blog(){

	// 	$data["title"]			=	"Blog";
	// 	$data["webname"]		= 	$GLOBALS["webname"];
	// 	$data["content"]		=	"main/v_blog";

	// 	if($this->isLoggedin() == true){
	// 		$data["loggedin"]		=	true;
	// 	}else{
	// 		$data["loggedin"]		=	false;
	// 	}

	// 	$this->load->view('v_template',$data);

	// }

	function about(){

		$data["title"]			=	"About Us";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"main/v_about";
		$data["active"]			=	"aboutus";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}
	

//
// auth pages                                                     
//


	function login(){

		$data["title"]			=	"Login";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"auth/v_login";
		$data["active"]			=	"login";

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

	function register(){

		$data["title"]			=	"Register";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"auth/v_register";
		$data["active"]			=	"login";
		
		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}


//
// shopping pages
//


	function cart(){

		$data["title"]			=	"Cart";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"transaction/v_cart";
		$data["active"]			=	"shop";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

	function checkout(){

		$this->load->model(array('m_address','m_shop'));

		$data["title"]			=	"Checkout";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"transaction/v_checkout";
		$data["active"]			=	"shop";

		//add alamat data

		$session = $this->session->all_userdata();

		$data["data_alamat"] 	=	$this->m_address->select("user",$session['id_user'])->result();

		if($this->m_address->select("user",$session['id_user'])->num_rows() == 0){
			redirect('dashboard/alamat');
		}

		$data["data_user"]		=	$session;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template',$data);
		}else{
			redirect('login');
		}
	}

	function orderdetails(){
		$this->load->model(array('m_transaction_history','m_transaction_history_seller','m_transaction_history_product','m_address','m_products','m_shop','m_users','m_banks'));

		$id = $this->uri->segment(3);

		$data["title"]			=	"Order Details";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"transaction/v_orderdetails";
		$data["active"]			=	"shop";
		$data["data_bank"]		= 	$this->m_banks->select()->result();

		$data["trans_history"]  		=	$this->m_transaction_history->select("orderdetails",$id)->row();
		$data["trans_history_prod"] 	=	$this->m_transaction_history_product->select("transaction",$id)->result();
		$data["trans_history_seller"]  	=	$this->m_transaction_history_seller->select("transaction",$id)->result();

		$data["shipment"]		=	$this->m_address->select("address",$data["trans_history"]->id_address)->row();

		// $session = $this->session->all_userdata();


		if($this->isLoggedin() == true){

			if($data["trans_history"]->id_user != $_SESSION['id_user']){
				$data["loggedin"]		=	false;
				redirect('');
			}else{
				$data["loggedin"]		=	true;
				$this->load->view('v_template',$data);
			}

			
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

		

	}

	function product_view(){
		$this->load->model(array('m_products','m_shop','m_users','m_category','m_reviews'));

		$id = $this->uri->segment(2);

		$data["data_product"]	=	$this->m_products->getproduct($id)->row();
		$data["data_user"]		=	$this->session->all_userdata();
		$data["shop"] 					= 	$this->m_shop->selectidshop($data["data_product"]->id_shop)->row();
		$shop 					= 	$this->m_shop->selectidshop($data["data_product"]->id_shop)->row();
		$data["data_seller"]	=	$this->m_users->select($shop->id_user)->row();
		$data["category"]		= 	$this->m_category->get($data["data_product"]->id_category)->row();
		$data["related_prod"] 	=	$this->m_products->related_prod($data["category"]->id_category)->result();


		$data["tot_review"] 	= 	$this->m_reviews->select($data["data_product"]->id_product)->num_rows();
		$data["data_review"] 	= 	$this->m_reviews->select($data["data_product"]->id_product)->result();

		$data["data_bintang1"] 	= 	$this->m_reviews->bintang_satu($data["data_product"]->id_product)->row()->bintang_satu;
		$data["data_bintang2"] 	= 	$this->m_reviews->bintang_dua($data["data_product"]->id_product)->row()->bintang_dua;
		$data["data_bintang3"] 	= 	$this->m_reviews->bintang_tiga($data["data_product"]->id_product)->row()->bintang_tiga;
		$data["data_bintang4"] 	= 	$this->m_reviews->bintang_empat($data["data_product"]->id_product)->row()->bintang_empat;
		$data["data_bintang5"] 	= 	$this->m_reviews->bintang_lima($data["data_product"]->id_product)->row()->bintang_lima;

		$data["title"]			=	$data["data_product"]->nama_product;
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"shop";
		$data["content"] 		= 	"product/v_product-details";

		$config = array();
		$config["base_url"] = base_url() . "product/".$id;
		$config["total_rows"] = $data["tot_review"];
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);

		$config['first_link'] = false; 
		$config['last_link']  = false;


		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->m_reviews->fetch($config["per_page"], $page, $id);
		$data["links"] = $this->pagination->create_links();


		if(isset($data["data_user"]['id_shop'])){
			if($data["data_product"]->id_shop != $data["data_user"]['id_shop']){

				$array = array('views' => $data["data_product"]->views + 1);
				$this->m_products->edit($array,$id);

			}
		}else{
			$array = array('views' => $data["data_product"]->views + 1);
			$this->m_products->edit($array,$id);
		}

		$hari = strtolower(date('l'));
		// $hari = 'monday';

		//views weekly and total views
		if(isset($data["data_user"]['id_shop'])){
			if($data["data_product"]->id_shop != $data["data_user"]['id_shop']){

				if($data["data_product"]->view_weekly_active == $hari){
					$array = array($hari => $data["data_product"]->$hari + 1);
					$this->m_products->edit($array,$id);
				}else{
					$array = array('view_weekly_active' => $hari, $hari => '1');
					$this->m_products->edit($array,$id);
				}

			}
		}else{

			if($data["data_product"]->view_weekly_active == $hari){
				$array = array($hari => $data["data_product"]->$hari + 1);
				$this->m_products->edit($array,$id);
			}else{
				$array = array('view_weekly_active' => $hari, $hari => '1');
				$this->m_products->edit($array,$id);
			}
		}
		

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);
	}










// ______          _     _                         _   _____                    _       _       
// |  _  \        | |   | |                       | | |_   _|                  | |     | |      
// | | | |__ _ ___| |__ | |__   ___   __ _ _ __ __| |   | | ___ _ __ ___  _ __ | | __ _| |_ ___ 
// | | | / _` / __| '_ \| '_ \ / _ \ / _` | '__/ _` |   | |/ _ \ '_ ` _ \| '_ \| |/ _` | __/ _ \
// | |/ / (_| \__ \ | | | |_) | (_) | (_| | | | (_| |   | |  __/ | | | | | |_) | | (_| | ||  __/
// |___/ \__,_|___/_| |_|_.__/ \___/ \__,_|_|  \__,_|   \_/\___|_| |_| |_| .__/|_|\__,_|\__\___|
//                                                                       | |                    
//                                                                       |_|                    


	function dashboard(){
		$this->load->model(array('m_user_level','m_users','m_messages','m_transaction_cancelled','m_products','m_transaction_history_product','m_transaction_history_product','m_transaction_history_seller'));	

		$data["title"]			=	"Dashboard";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"dashboard";
		$data["content"]		=	"v_dashboard";
		// $data["jstheme"]		=	"jstheme/dashboard";
		$data["jstheme"]		=	"jstheme/datatable_basic";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($data['user_lvl_name'] == 'User'){
			$data["cancelled_order"] = $this->m_transaction_cancelled->select($data["session"]["id_user"])->result();
		}else if($data['user_lvl_name'] == 'Seller'){
			$data["data_exceed"]	= 	$this->m_transaction_history_seller->checkdeadlineforseller($_SESSION['id_shop'])->result();
		}

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		$data["data_connection"] = $this->m_messages->select('connection',$data["session"]["id_user"],'')->result();

		$data["data_connection_limited"] = $this->m_messages->select('connection-limited',$data["session"]["id_user"],'')->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}


	function msg_view(){
		$this->load->model(array('m_user_level','m_users','m_messages'));	

		$data["title"]			=	"Dashboard - Message";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"dashboard";
		$data["content"]		=	"dashboard/v_msg";
		$data["jstheme"]		=	"jstheme/profile";

		$data["session"]		=	$this->session->all_userdata();

		if(!empty($data["session"])){
			$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;	
		}else{
			$data["user_lvl_name"]	= 	"";
		}
		

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();


		$id_receiver = $this->uri->segment(3);
		$data["data_msg"]		= 	$this->m_messages->select('',$data["session"]["id_user"],$id_receiver)->result();
		$data["data_connection"] = $this->m_messages->select('connection',$data["session"]["id_user"],'')->result();

		$data["data_connection_limited"] = $this->m_messages->select('connection-limited',$data["session"]["id_user"],'')->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}


//
// admin                                                               
//



	// headers

	function headers(){
		$this->load->model(array('m_user_level','m_users','m_messages','m_transaction_cancelled','m_products','m_transaction_history_product','m_transaction_history_product','m_transaction_history_seller','m_promo_headers'));	

		$data["title"]			=	"Dashboard - Promo Headers";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"web-settings";
		$data["content"]		=	"dashboard/admin/v_header_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["data_header"]		= 	$this->m_promo_headers->select('')->result();


		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}


	function header_add(){
		$this->load->model(array('m_user_level','m_users','m_messages','m_transaction_cancelled','m_products','m_transaction_history_product','m_transaction_history_product','m_transaction_history_seller','m_promo_headers'));	

		$data["title"]			=	"Dashboard - Website Settings";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"web-settings";
		$data["content"]		=	"dashboard/admin/v_header_add";
		// $data["jstheme"]		=	"jstheme/dashboard";
		$data["jstheme"]		=	"jstheme/form_input";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}


		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}


	// headers end


 	// bank

	function bank_list(){
		$this->load->model(array("m_banks","m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Bank List";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"bank";
		$data["content"]		=	"dashboard/admin/v_bank_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		// $data["jstheme2"]		=	"jstheme/modal";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["data_cat"]		= 	$this->m_banks->select()->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	function bank_add(){
		$this->load->model(array("m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Add Bank";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"bank";
		$data["content"]		=	"dashboard/admin/v_bank_add";
		$data["jstheme"]		=	"jstheme/form_input";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function bank_edit(){
		$this->load->model(array("m_user_level","m_banks","m_users"));

		$id = $this->uri->segment(4);

		$data["title"]			=	"Dashboard - Edit Bank";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"bank";
		$data["content"]		=	"dashboard/admin/v_bank_edit";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["data_bank"]		= 	$this->m_banks->get($id)->row();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

 	// bank end


	// reports


	function exceeddelivered(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_confirmation','m_transaction_cancelled'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Delivered Exceed Deadline Reports";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"exceddeliveredreports";
		$data["content"]		=	"dashboard/admin/v_reports_exceed_delivered";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		$data["data_exceed"]	= 	$this->m_transaction_history_seller->checkdeadline()->result();

		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}


	function exceeddelivery(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_confirmation','m_transaction_cancelled'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Delivery Exceed Reports";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"exceddeliveryreports";
		$data["content"]		=	"dashboard/admin/v_reports_exceed_delivery";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		$data["data_exceed"]	= 	$this->m_transaction_history_seller->checkdeadline()->result();

		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}



	function refundreports(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_confirmation','m_transaction_cancelled'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Refund Reports";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"refund";
		$data["content"]		=	"dashboard/admin/v_reports_refund";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		// $shop_id = $this->m_shop->select($data["session"]["id_user"])->row()->id_shop;
		$data["cancelled_order"]	= 	$this->m_transaction_cancelled->getall()->result();

		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function transactionreports(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_confirmation','m_banks'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Transaction Reports";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"transactionreports";
		$data["content"]		=	"dashboard/admin/v_reports_trans";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		// $shop_id = $this->m_shop->select($data["session"]["id_user"])->row()->id_shop;
		$data["data_pembelian"]	= 	$this->m_transaction_history_seller->getall()->result();
		$data["data_jmlproduk"]	= 	$this->m_transaction_history->select('dataadmin','')->result();


		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function withdrawreports(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_confirmation','m_withdrawal'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Withdraw Reports";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"withdrawreports";
		$data["content"]		=	"dashboard/admin/v_reports_withdraw";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		// $data["jstheme4"]		=	"jstheme/form_basic";

		$data["data_withdraw"]	= 	$this->m_withdrawal->select('','')->result();


		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	// reports end


	//category

	function cat_list(){
		$this->load->model(array("m_category","m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Category List";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"category";
		$data["content"]		=	"dashboard/admin/v_cat_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		// $data["jstheme2"]		=	"jstheme/modal";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["data_cat"]		= 	$this->m_category->select()->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	function cat_add(){
		$this->load->model(array("m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Add Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"category";
		$data["content"]		=	"dashboard/admin/v_cat_add";
		$data["jstheme"]		=	"jstheme/form_input";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function cat_edit(){
		$this->load->model(array("m_user_level","m_category","m_users"));

		$id = $this->uri->segment(4);

		$data["title"]			=	"Dashboard - Edit Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"category";
		$data["content"]		=	"dashboard/admin/v_cat_edit";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["data_category"]	= 	$this->m_category->get($id)->row();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	//category-end

	//users management

	function user_list(){

		$this->load->model(array('m_users','m_user_level'));

		$data["title"]				=	"Dashboard - Daftar User";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"userlist";
		$data["content"]			=	"dashboard/admin/v_users_list";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["jstheme2"]			=	"jstheme/notification";
		$data["data_user"] 			=	$this->m_users->getall()->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function user_add(){

		$this->load->model(array('m_user_level',"m_users"));

		$data["title"]			=	"Dashboard - Add New User";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"userlist";
		$data["content"]		=	"dashboard/admin/v_users_add";
		$data["jstheme"]		=	"jstheme/form_basic";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;


		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function user_edit(){

		$this->load->model(array('m_user_level','m_users'));

		$id = $this->uri->segment(4);

		$data["title"]			=	"Dashboard - Edit User";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"userlist";
		$data["content"]		=	"dashboard/admin/v_users_edit";
		$data["jstheme"]		=	"jstheme/form_basic";
		$data["data_user"]		= 	$this->m_users->select($id)->row();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;


		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	//users management-end




	function sellerpending(){

		$this->load->model(array('m_seller_pending_approval','m_user_level',"m_users"));

		$data["title"]				=	"Dashboard - Seller Pending Approval";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"sellerapproval";
		$data["content"]			=	"dashboard/admin/v_pending_seller";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["data_sellerpending"] =	$this->m_seller_pending_approval->select("joinuser","")->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function resellerpending(){

		$this->load->model(array('m_reseller_pending_approval','m_user_level',"m_users"));

		$data["title"]				=	"Dashboard - Re-Seller Pending Approval";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"resellerapproval";
		$data["content"]			=	"dashboard/admin/v_pending_reseller";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["data_resellerpending"] =	$this->m_reseller_pending_approval->select("joinuser","")->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

//
// user                                                                                                
//


	// alamat

	function alamat_list(){

		$this->load->model(array('m_address','m_user_level',"m_users"));

		$data["title"]				=	"Dashboard - Address List";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"alamat";
		$data["content"]			=	"dashboard/user/v_address_list";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["jstheme2"]			=	"jstheme/notification";

		$data["session"]			=	$this->session->all_userdata();
		$data["user_lvl_name"]		= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["alamat"]				= 	$this->m_address->select("user",$data["session"]["id_user"])->result();

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function alamat_edit(){
		$this->load->model(array("m_address","m_user_level","m_users"));

		$id = $this->uri->segment(4);

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Edit Address";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"alamat";
		$data["content"]		=	"dashboard/user/v_address_edit";
		$data["jstheme"]		=	"jstheme/form_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["alamat"]			= 	$this->m_address->select("address",$id)->row();

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function alamat_add(){

		$this->load->model(array("m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Add Address";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"alamat";
		$data["content"]		=	"dashboard/user/v_address_add";
		$data["jstheme"]		=	"jstheme/form_input";

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	//alamat-end



//
// seller                                                                                                
//


	//withdraw

	function withdraw(){

		$this->load->model(array("m_user_level","m_category","m_users","m_withdrawal"));

		$data["title"]			=	"Dashboard - Withdraw";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"withdraw";
		$data["content"]		=	"dashboard/seller/v_withdraw";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["jstheme2"]		=	"jstheme/datatable_basic";
		$data["jstheme3"]		=	"jstheme/notification";
		// $data["jstheme3"]		=	"jstheme/tags";
		



		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		$data["data_withdraw"]	= 	$this->m_withdrawal->select('shop',$data["session"]["id_shop"])->result();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	//withdraw end

	//penjualan

	function penjualan(){
		$this->load->model(array('m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_address'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Penjualan";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"penjualan";
		$data["content"]		=	"dashboard/seller/v_penjualan";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		$shop_id = $this->m_shop->select($data["session"]["id_user"])->row()->id_shop;
		$data["data_pembelian"]	= 	$this->m_transaction_history_seller->select("shop",$shop_id)->result();

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();


		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	//penjualan end


	//shop

	function shop(){
		$this->load->model(array('m_transaction_history','m_user_level','m_shop',"m_users"));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Shop";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"shop";
		$data["content"]		=	"dashboard/seller/v_shop";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/form_basic";
		$data["jstheme3"]		=	"jstheme/checkbox_radio";
		$data["jstheme4"]		=	"jstheme/notification";

		$data["data_pembelian"]	= 	$this->m_transaction_history->select("fortoko",$data["session"]["id_user"])->result();
		$data["data_shop"]		= 	$this->m_shop->select($data["session"]["id_user"])->row();

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	//shop-end

	//product

	function product_list(){
		$this->load->model(array("m_products","m_user_level","m_users"));

		$data["title"]			=	"Dashboard - Products";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"listproduct";
		$data["content"]		=	"dashboard/seller/v_product_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		// $data["jstheme2"]		=	"jstheme/modal";
		$data["jstheme2"]		=	"jstheme/notification";

		$data["session"]		=	$this->session->all_userdata();

		$data["data_product"]	= 	$this->m_products->get($data["session"]["id_shop"])->result();

		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function product_add(){

		$this->load->model(array("m_user_level","m_category","m_users"));

		$data["title"]			=	"Dashboard - Add Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"addproduct";
		$data["content"]		=	"dashboard/seller/v_product_add";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["jstheme2"]		=	"jstheme/editor";
		$data["jstheme3"]		=	"jstheme/checkbox_radio";
		// $data["jstheme3"]		=	"jstheme/tags";
		$data["data_cat"]		= 	$this->m_category->select()->result();



		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	function product_edit(){
		$this->load->model(array("m_products","m_user_level","m_category","m_users"));

		$id_product = $this->uri->segment(4);

		$data["title"]			=	"Dashboard - Edit Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"listproduct";
		$data["content"]		=	"dashboard/seller/v_product_edit";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["jstheme2"]		=	"jstheme/editor";
		$data["jstheme3"]		=	"jstheme/notification";
		$data["jstheme4"]		=	"jstheme/thumbnail";
		$data["jstheme5"]		=	"jstheme/checkbox_radio";
		// $data["jstheme5"]		=	"jstheme/tags";
		$data["data_product"]   = 	$this->m_products->getproduct($id_product)->row();
		$data["data_cat"]		= 	$this->m_category->select()->result();

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	//product-end

	


//
// reseller                                                                                                
//


	




	










	//biodata

	function biodata(){
		$this->load->model(array("m_users","m_user_level"));

		$id_product = $this->uri->segment(3);

		$data["title"]			=	"Dashboard - Biodata";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"biodata";
		$data["content"]		=	"dashboard/v_biodata";
		$data["jstheme"]		=	"jstheme/form_basic";
		
		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["user"]			= 	$this->m_users->select($data["session"]["id_user"])->row();

		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();


		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}

	//biodata-end


	function pembelian(){
		$this->load->model(array('m_transaction_history','m_transaction_history_product','m_transaction_history_seller','m_user_level','m_shop','m_products','m_users','m_banks'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Dashboard - Pembelian";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"pembelian";
		$data["content"]		=	"dashboard/user/v_pembelian";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/notification";
		$data["jstheme3"]		=	"jstheme/modal";
		$data["jstheme4"]		=	"jstheme/form_basic";

		// $shop_id = $this->m_shop->select($data["session"]["id_user"])->row()->id_shop;
		$data["data_pembelian"]	= 	$this->m_transaction_history_seller->datapembelianuser($data["session"]["id_user"])->result();
		$data["data_jmlproduk"]	= 	$this->m_transaction_history->select('pembelianuser',$data["session"]["id_user"])->result();
		$data["data_bank"]		= 	$this->m_banks->select()->result();


		$data["user_data"]		= 	$this->m_users->select($data["session"]["id_user"])->row();
		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}



	



	


//  __  __ ___ ____   ____ 
// |  \/  |_ _/ ___| / ___|
// | |\/| || |\___ \| |    
// | |  | || | ___) | |___ 
// |_|  |_|___|____/ \____|               
// misc


	function search(){
		$this->load->model(array('m_products'));

		$keyword = $this->input->post('search');
		
		$data["title"]			=	"Searching for ".$keyword;
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"v_search";
		$data["active"]			=	"home";
		$data["data_user"]		=	$this->session->all_userdata();

		$data["data_search"] = $this->m_products->search($keyword)->result();
		$data["keyword"]  = $keyword;
		$data["totalfound"] = $this->m_products->search($keyword)->num_rows();


		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

}
?>
