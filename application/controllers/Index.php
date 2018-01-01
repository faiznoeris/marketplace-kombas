<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{


//  __  __    _    ___ _   _   ____   _    ____ _____ ____  
// |  \/  |  / \  |_ _| \ | | |  _ \ / \  / ___| ____/ ___| 
// | |\/| | / _ \  | ||  \| | | |_) / _ \| |  _|  _| \___ \ 
// | |  | |/ ___ \ | || |\  | |  __/ ___ \ |_| | |___ ___) |
// |_|  |_/_/   \_\___|_| \_| |_| /_/   \_\____|_____|____/ 
// main pages                                                         


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
	



//     _   _   _ _____ _   _   ____   _    ____ _____ ____  
//    / \ | | | |_   _| | | | |  _ \ / \  / ___| ____/ ___| 
//   / _ \| | | | | | | |_| | | |_) / _ \| |  _|  _| \___ \ 
//  / ___ \ |_| | | | |  _  | |  __/ ___ \ |_| | |___ ___) |
// /_/   \_\___/  |_| |_| |_| |_| /_/   \_\____|_____|____/ 
// auth pages                                                     


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


//  ____  _   _  ___  ____  ____ ___ _   _  ____   ____   _    ____ _____ ____  
// / ___|| | | |/ _ \|  _ \|  _ \_ _| \ | |/ ___| |  _ \ / \  / ___| ____/ ___| 
// \___ \| |_| | | | | |_) | |_) | ||  \| | |  _  | |_) / _ \| |  _|  _| \___ \ 
//  ___) |  _  | |_| |  __/|  __/| || |\  | |_| | |  __/ ___ \ |_| | |___ ___) |
// |____/|_| |_|\___/|_|   |_|  |___|_| \_|\____| |_| /_/   \_\____|_____|____/ 
// shopping pages


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

		$data["title"]			=	"Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"product/v_product-details";
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template',$data);
	}


//     _    ____  __  __ ___ _   _   ____   _    ____ _____ ____  
//    / \  |  _ \|  \/  |_ _| \ | | |  _ \ / \  / ___| ____/ ___| 
//   / _ \ | | | | |\/| || ||  \| | | |_) / _ \| |  _|  _| \___ \ 
//  / ___ \| |_| | |  | || || |\  | |  __/ ___ \ |_| | |___ ___) |
// /_/   \_\____/|_|  |_|___|_| \_| |_| /_/   \_\____|_____|____/ 
// admin pages                                                               


	function adduser(){

		$data["title"]			=	"Dashboard - Add New User";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"adduser";
		$data["content"]		=	"dashboard/v_users_add";
		$data["jstheme"]		=	"jstheme/form_basic";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		$this->load->view('v_template_dash',$data);

	}

	function daftaruser(){

		$this->load->model('m_users');

		$data["title"]				=	"Dashboard - Daftar User";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"daftaruser";
		$data["content"]			=	"dashboard/v_users_list";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["data_user"] 			=	$this->m_users->getall()->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


	function sellerpending(){

		$this->load->model('m_seller_pending_approval');

		$data["title"]				=	"Dashboard - Seller Pending Approval";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"sellerapproval";
		$data["content"]			=	"dashboard/v_seller_pending";
		$data["jstheme"]			=	"jstheme/datatable_basic";
		$data["data_sellerpending"] =	$this->m_seller_pending_approval->select("joinuser","")->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


//     _    ____ ____ ___  _   _ _   _ _____   ____    _    ____  _   _ ____   ___    _    ____  ____  
//    / \  / ___/ ___/ _ \| | | | \ | |_   _| |  _ \  / \  / ___|| | | | __ ) / _ \  / \  |  _ \|  _ \ 
//   / _ \| |  | |  | | | | | | |  \| | | |   | | | |/ _ \ \___ \| |_| |  _ \| | | |/ _ \ | |_) | | | |
//  / ___ \ |__| |__| |_| | |_| | |\  | | |   | |_| / ___ \ ___) |  _  | |_) | |_| / ___ \|  _ <| |_| |
// /_/   \_\____\____\___/ \___/|_| \_| |_|   |____/_/   \_\____/|_| |_|____/ \___/_/   \_\_| \_\____/ 
// account dashboard                                                                                                     


	function dashboard(){
		$this->load->model('m_user_level');	

		$data["title"]			=	"Dashboard";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"dashboard";
		$data["content"]		=	"v_dashboard";
		$data["jstheme"]		=	"jstheme/dashboard";


		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
			$this->load->view('v_template_dash',$data);
		}else{
			$data["loggedin"]		=	false;
			redirect('');
		}
	}




	function toko(){
		$this->load->model(array('m_transaction_history','m_user_level'));

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		$data["title"]			=	"Toko";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"toko";
		$data["content"]		=	"dashboard/v_toko";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["jstheme2"]		=	"jstheme/form_basic";

		$data["data_pembelian"]	= 	$this->m_transaction_history->select("withproductdetails",$session["id_user"])->result();


		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}








	function alamat_list(){

		$this->load->model(array('m_address','m_user_level'));

		$data["title"]				=	"Dashboard - Daftar User";
		$data["webname"]			= 	$GLOBALS["webname"];
		$data["active"]				=	"alamat";
		$data["content"]			=	"dashboard/v_address_list";
		$data["jstheme"]			=	"jstheme/datatable_basic";

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		$data["alamat"]			= 	$this->m_address->select("user",$session["id_user"])->result();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


	function alamat_edit(){
		$this->load->model(array("m_address","m_user_level"));

		$id = $this->uri->segment(4);

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		$data["title"]			=	"Edit Alamat";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"alamat";
		$data["content"]		=	"dashboard/v_address_edit";
		$data["jstheme"]		=	"jstheme/form_basic";
		$data["alamat"]			= 	$this->m_address->select("alamat",$id)->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


	function alamat_add(){

		$this->load->model(array("m_user_level"));

		$data["title"]			=	"Add Alamat";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"alamat";
		$data["content"]		=	"dashboard/v_address_add";
		$data["jstheme"]		=	"jstheme/form_input";

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


	function biodata_edit(){
		$this->load->model(array("m_users","m_user_level"));

		$id_product = $this->uri->segment(3);

		$data["title"]			=	"Edit Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"biodata";
		$data["content"]		=	"dashboard/v_biodata_edit";
		$data["jstheme"]		=	"jstheme/form_basic";
		
		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		$data["user"]			= 	$this->m_users->select($session["id_user"])->row();


		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}


	function pembelian(){
		$this->load->model(array('m_transaction_history','m_user_level'));

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

		$data["title"]			=	"Pembelian";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"pembelian";
		$data["content"]		=	"dashboard/v_pembelian";
		$data["jstheme"]		=	"jstheme/datatable_basic";

		$data["data_pembelian"]	= 	$this->m_transaction_history->select("withproductdetails",$session["id_user"])->result();


		

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function pembelian_konfirmasitrf(){

		$this->load->model(array('m_transaction_history','m_user_level'));

		$session = $this->session->all_userdata();

		$data["data_user"]		=	$session;
		$data["user_lvl"]		= 	$this->m_user_level->select($session["user_lvl"])->row()->name;

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
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function cat_add(){

		$data["title"]			=	"Add Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"category";
		$data["content"]		=	"dashboard/v_cat_add";
		$data["jstheme"]		=	"jstheme/form_input";

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function cat_list(){
		$this->load->model("m_category");

		$data["title"]			=	"Category List";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"category";
		$data["content"]		=	"dashboard/v_cat_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["data_cat"]	= 	$this->m_category->select()->result();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function product_add(){

		$data["title"]			=	"Add Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"addproduct";
		$data["content"]		=	"dashboard/v_product_add";
		$data["jstheme"]		=	"jstheme/form_input";
		$data["jstheme2"]		=	"jstheme/editor";
		$data["jstheme3"]		=	"jstheme/tags";

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function product_edit(){
		$this->load->model("m_products");

		$id_product = $this->uri->segment(3);

		$data["title"]			=	"Edit Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"editproduct";
		$data["content"]		=	"dashboard/v_product_edit";
		$data["jstheme"]		=	"jstheme/form_basic";
		$data["data_product"]   = 	$this->m_products->edit($id_product)->row();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

	}

	function product_list(){
		$this->load->model("m_products");

		$data["title"]			=	"List Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["active"]			=	"listproduct";
		$data["content"]		=	"dashboard/v_product_list";
		$data["jstheme"]		=	"jstheme/datatable_basic";
		$data["data_product"]	= 	$this->m_products->select()->result();

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if(isset($_SESSION['info'])){
			$data["info"]		=	$_SESSION['info'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('v_template_dash',$data);

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
