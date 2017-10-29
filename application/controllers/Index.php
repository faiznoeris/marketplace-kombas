<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{

	function home(){

		$data["title"]			=	$GLOBALS["webname"];
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		= 	"v_home";
		// $data["active"]			=	"home";

		$this->load->view('v_template-frontend', $data);

	}

	function category(){

		$data["title"]			=	"Category";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_category";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}

	function product(){

		$data["title"]			=	"Product";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_product-details";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);
	}

	function cart(){

		$data["title"]			=	"Cart";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_cart";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}

	function checkout(){

		$data["title"]			=	"Checkout";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_checkout";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}


	function login(){

		$data["title"]			=	"Login";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_login";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}

	function register(){

		$data["title"]			=	"Register";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_register";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}

	function account(){

		$data["title"]			=	"Account Settings";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"] 		= 	"v_account";
		// $data["active"]			=	"category";

		$this->load->view('v_template-frontend',$data);

	}

	function dashboard(){

		$data["title"]			=	"Dashboard";
		$data["webname"]		= 	$GLOBALS["webname"];
		// $data["active"]			=	"dashboard";
		//$data["content"]		=	"pages/v_home";

		$this->load->view('v_dashboard',$data);

	}

	function blog(){

		$data["title"]			=	"Blog";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"v_blog";

		$this->load->view('v_template-frontend',$data);

	}

	function about(){

		$data["title"]			=	"About Us";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"v_about";

		$this->load->view('v_template-frontend',$data);

	}

	function search(){

		$data["title"]			=	"Search";
		$data["webname"]		= 	$GLOBALS["webname"];
		$data["content"]		=	"v_search";

		$this->load->view('v_template-frontend',$data);

	}




}
?>
