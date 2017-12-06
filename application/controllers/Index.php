<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{

	function home(){

		$data["title"]			=	$GLOBALS["webname"];
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		= 	"front_end/main/v_home";
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend', $data);

	}

	function category(){

		$data["title"]			=	"Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/main/v_category";
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function product(){

		$data["title"]			=	"Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/product/v_product-details";
		
		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);
	}

	function cart(){

		$data["title"]			=	"Cart";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/transaction/v_cart";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function checkout(){

		$data["title"]			=	"Checkout";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/transcation/v_checkout";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}


	function login(){

		$data["title"]			=	"Login";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/auth/v_login";

		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function register(){

		$data["title"]			=	"Register";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/auth/v_register";
		
		if(isset($_SESSION['error'])){
			$data["error"]		=	$_SESSION['error'];
		}

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function account(){

		$this->load->model(array('m_address','m_users'));

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$data["title"]			=	"Account Settings";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/user_account/v_account";
		$data["alamat"]			= 	$this->m_address->select("user",$id_user)->result();
		$data["user"]			= 	$this->m_users->select($id_user)->row();

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}


	function add_address(){

		$data["title"]			=	"Account Settings - Tambah Alamat";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/user_account/v_add_alamat";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function edit_address(){

		$this->load->model('m_address');

		$id_alamat = $this->uri->segment(4);

		$data["title"]			=	"Account Settings - Ubah Alamat";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"front_end/user_account/v_edit_alamat";
		$data["alamat"]			= 	$this->m_address->select("alamat",$id_alamat)->row();


		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function dashboard(){

		$data["title"]			=	"Dashboard";
		$data["webname"]		= 	$GLOBALS["webname"];

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('back_end/dashboard/v_dashboard',$data);

	}


	function adduser(){

		$data["title"]			=	"Dashboard - Add New User";
		$data["webname"]		= 	$GLOBALS["webname"];

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

		$this->load->view('back_end/dashboard/v_add_user',$data);

	}

	function sellerpending(){

		$data["title"]			=	"Dashboard - Seller Pending Approval";
		$data["webname"]		= 	$GLOBALS["webname"];

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('back_end/dashboard/v_seller_pending',$data);

	}

	function blog(){

		$data["title"]			=	"Blog";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"front_end/main/v_blog";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function about(){

		$data["title"]			=	"About Us";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"front_end/main/v_about";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}

	function search(){

		$data["title"]			=	"Search";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"front_end/v_search";

		if($this->isLoggedin() == true){
			$data["loggedin"]		=	true;
		}else{
			$data["loggedin"]		=	false;
		}

		$this->load->view('front_end/v_template-frontend',$data);

	}




}
?>
