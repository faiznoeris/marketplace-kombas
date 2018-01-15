<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{

	function cekkabupaten(){
		$this->cek_kabupaten();
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

		$this->load->model('m_products');	

		$data["title"]			=	$GLOBALS["webname"];
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		= 	"main/v_home";
		$data["data_product"]	=	$this->m_products->select()->result();
		$data["data_user"]		=	$this->session->all_userdata();
		
		if($this->isLoggedin()){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template', $data);

	}

	function category(){

		$data["title"]			=	"Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"main/v_category";
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}
	
	function blog(){

		$data["title"]			=	"Blog";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"main/v_blog";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

	function about(){

		$data["title"]			=	"About Us";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"main/v_about";

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

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

	function checkout(){

		$this->load->model('m_address');

		$data["title"]			=	"Checkout";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"transaction/v_checkout";

		//add alamat data

		$session = $this->session->all_userdata();

		$data["data_alamat"] 	=	$this->m_address->select("user",$session['id_user'])->row();

		if($this->m_address->select("user",$session['id_user'])->num_rows() == 0){
			redirect('dashboard/alamat');
		}

		$data["data_user"]		=	$session;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template',$data);
		}else{
			redirect('');
		}
	}

	function product_view(){
		$this->load->model(array('m_products'));

		$id = $this->uri->segment(2);

		$data["data_product"]	=	$this->m_products->getproduct($id)->row();

		$data["title"]			=	$data["data_product"]->nama_product;
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"product/v_product-details";

		
		
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
		$this->load->model('m_user_level');	

		$data["title"]			=	"Dashboard";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"dashboard";
		$data["content"]		=	"v_dashboard";
		$data["jstheme"]		=	"jstheme/dashboard";

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
// admin                                                               
//

	//category

	function cat_list(){
		$this->load->model(array("m_category","m_user_level"));

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
		$this->load->model(array("m_user_level"));

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
		$this->load->model(array("m_user_level","m_category"));

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

		$this->load->model(array('m_user_level'));

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

		$this->load->model(array('m_seller_pending_approval','m_user_level'));

		$data["title"]				=	"Dashboard - Seller Pending Approval";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"sellerapproval";
		$data["content"]			=	"dashboard/v_seller_pending";
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


//
// user                                                                                                
//


	// alamat

	function alamat_list(){

		$this->load->model(array('m_address','m_user_level'));

		$data["title"]				=	"Dashboard - Address List";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"alamat";
		$data["content"]			=	"dashboard/user/v_address_list";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["jstheme2"]			=	"jstheme/notification";

		$data["session"]			=	$this->session->all_userdata();
		$data["user_lvl_name"]		= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["alamat"]				= 	$this->m_address->select("user",$data["session"]["id_user"])->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}

	}

	function alamat_edit(){
		$this->load->model(array("m_address","m_user_level"));

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

		$this->load->model(array("m_user_level"));

		$data["title"]			=	"Dashboard - Add Address";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"alamat";
		$data["content"]		=	"dashboard/user/v_address_add";
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

	//alamat-end



//
// seller                                                                                                
//


	//shop

	function shop(){
		$this->load->model(array('m_transaction_history','m_user_level','m_shop'));

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
		$this->load->model(array("m_products","m_user_level"));

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

		$this->load->model(array("m_user_level","m_category"));

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
		$this->load->model(array("m_products","m_user_level","m_category"));

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





	function shop_konfirmasitrf(){

		$this->load->model(array('m_transaction_history','m_user_level'));

		$id = $this->uri->segment(4);

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Konfirmasi Transfer";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"toko";
		$data["content"]		=	"dashboard/v_toko_confirmtrf";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["data_trans"]		=	$this->m_transaction_history->select("forbuktitrftoko",$id)->row();

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

	function shop_konfirmasibrg(){

		$this->load->model(array('m_transaction_history','m_user_level'));

		$id = $this->uri->segment(4);

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Konfirmasi Transfer";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"toko";
		$data["content"]		=	"dashboard/v_toko_confirmbrgdikirim";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["data_trans"]		=	$this->m_transaction_history->select("forbuktitrftoko",$id)->row();

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

	function shop_editresi(){

		$this->load->model(array('m_transaction_history','m_user_level'));

		$id = $this->uri->segment(4);

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Update Resi";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"toko";
		$data["content"]		=	"dashboard/v_toko_editresi";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["data_trans"]		=	$this->m_transaction_history->select("forbuktitrftoko",$id)->row();

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
		$this->load->model(array('m_transaction_history','m_user_level'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Pembelian";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"pembelian";
		$data["content"]		=	"dashboard/v_pembelian";
		$data["jstheme"]		=	"jstheme/datatable_basic";

		$data["data_pembelian"]	= 	$this->m_transaction_history->select("withproductdetails",$data["session"]["id_user"])->result();


		

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

	function pembelian_konfirmasitrf(){

		$this->load->model(array('m_transaction_history','m_user_level'));

		$data["session"]		=	$this->session->all_userdata();
		$data["user_lvl_name"]	= 	$this->m_user_level->select($data["session"]["user_lvl"])->row()->name;

		$data["title"]			=	"Konfirmasi Transfer";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"pembelian";
		$data["content"]		=	"dashboard/v_pembelian_confirmtrf";
		$data["jstheme"]		=	"jstheme/form_input";

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

		$data["title"]			=	"Search";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"v_search";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);

	}

}
?>
