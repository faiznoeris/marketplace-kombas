<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_Dashboard extends MY_Controller{

	private $notif_data = array();

	public function __construct(){
		parent::__construct();
		$this->load->model(array('M_Index_Dashboard','M_Index'));
		$this->notif_data['header'] = 'Notification';
		$this->notif_data['duration'] = '4000';
		$this->notif_data['sticky'] = false;
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

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
			$data["active"]	= "login";
			$data["loggedin"] = false;

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			if($this->M_Index->login_gettoken_admin(get_cookie('token'))->num_rows() > 0){
				if ($this->M_Index->login_updatesession_admin(get_cookie('token'))){
					redirect("dashboard"); //login sukses
				}else{	
					$this->session->set_flashdata('error','*Terjadi kesalahan saat login!');
					redirect("/login/gagal");
				}
			}

			$this->load->view('dashboard/v_adminlogin',$data);
		}
	}

	function dashboard(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	=	"dashboard";
			$data["content"] = "dashboard/v_dashboard";
			$data["jstheme"] = array("jstheme/limitless_5/dashboard");
			$data["loggedin"] = true;
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;
			$data["user_data"] = $this->M_Index->data_order_getuser($data["data_session"]["id_user"])->row();

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	function account(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Account";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "account";
			$data["content"] = "dashboard/admin/v_account";
			$data["jstheme"] = array("jstheme/limitless_5/account_dash");
			$data["loggedin"] = true;
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;
			$data["user_data"] = $this->M_Index_Dashboard->get_admin($data["data_session"]["id_admin"])->row();

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	 	// bank

	function bank_list(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Bank List";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "bank";
			$data["content"] = "dashboard/admin/v_bank_list";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification");
			$data["loggedin"] =	true;
			$data["data_cat"] = $this->M_Index->data_order_getbank()->result();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}	

			$this->load->view('template/dashboard/v_template_dash',$data);

		}
	}

	function bank_edit(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$id_bank = $this->uri->segment(4);
			$q_bank = $this->M_Index_Dashboard->get_bank($id_bank);

			if($q_bank->num_rows() == 0){
				$this->notif_data['message'] = "Data tidak ditemukan!";
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
				$this->notif_data($this->notif_data);
				redirect('dashboard');
			}

			$data["title"] = "Dashboard - Edit Bank";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "bank";
			$data["content"] = "dashboard/admin/v_bank_edit";
			$data["jstheme"] = array("jstheme/limitless_5/form_input");
			$data["loggedin"] = true;
			$data["data_bank"] = $q_bank->row();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

 	// bank end


	//category

	function cat_list(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Category List";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "category";
			$data["content"] = "dashboard/admin/v_cat_list";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification");
			$data["loggedin"] = true;
			$data["data_cat"] =	$this->M_Index->data_home_category()->result();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}


	function cat_edit(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$id_category 					= 	$this->uri->segment(4);
			$q_category = $this->M_Index->data_productview_getcategory($id_category);

			if($q_category->num_rows() == 0){
				$this->notif_data['message'] = "Data tidak ditemukan!";
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
				$this->notif_data($this->notif_data);
				redirect('dashboard');
			}

			$data["title"] = "Dashboard - Edit Category";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "category";
			$data["content"] = "dashboard/admin/v_cat_edit";
			$data["jstheme"] = array("jstheme/limitless_5/form_input");
			$data["loggedin"] = true;
			$data["data_category"] = $q_category->row();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}
			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	//category-end


	//users management

	function user_list(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Daftar User";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "userlist";
			$data["content"] = "dashboard/admin/v_users_list";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification");
			$data["loggedin"] = true;
			$data["users"] = $this->M_Index_Dashboard->get_allusers()->result();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	function user_edit(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$id_user = $this->uri->segment(4);
			$q_user = $this->M_Index->data_productview_getuser($id_user);

			if($q_user->num_rows() == 0){
				$this->notif_data['message'] = "Data tidak ditemukan!";
				$this->notif_data['theme'] = 'bg-warning alert-styled-left';
				$this->notif_data['group'] = 'alert-warning';
				$this->notif_data($this->notif_data);
				redirect('dashboard');
			}

			$data["title"] = "Dashboard - Edit User";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "userlist";
			$data["content"] = "dashboard/admin/v_users_edit";
			$data["jstheme"] = array("jstheme/limitless_5/form_basic");
			$data["loggedin"] = true;
			$data["user"] =	$q_user->row();
			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			if(isset($_SESSION['error'])){
				$data["error"]		=	$_SESSION['error'];
			}

			if(isset($_SESSION['info'])){
				$data["info"]		=	$_SESSION['info'];
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	//users management-end




	function sellerpending(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Seller Pending Approval";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "sellerapproval";
			$data["content"] = "dashboard/admin/v_pending_seller";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic");
			$data["loggedin"] = true;
			$data["data_sellerpending"] = $this->M_Index_Dashboard->get_sellerpending()->result();

			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	function resellerpending(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Re-Seller Pending Approval";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "resellerapproval";
			$data["content"] = "dashboard/admin/v_pending_reseller";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic");
			$data["loggedin"] = true;
			$data["data_resellerpending"] =	$this->M_Index_Dashboard->get_resellerpending()->result();

			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}


	// reports

	// function exceeddelivered(){
	// 	if(!$this->isLoggedin()){
	// 		redirect('dashboard/login');
	// 	}else{
	// 		$data["title"] = "Dashboard - Delivered Exceed Deadline Reports";
	// 		$data["webname"] = $GLOBALS["webname"];
	// 		$data["active"]	= "exceddeliveredreports";
	// 		$data["content"] = "dashboard/admin/v_reports_exceed_delivered";
	// 		$data["jstheme"] = array("jstheme/limitless_5/order_history", "jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification", "jstheme/limitless_5/modal", "jstheme/limitless_5/form_basic");
	// 		$data["loggedin"] = true;
	// 		$data["data_exceed"] = $this->M_Index_Dashboard->get_exceed()->result();

	// 		$data["data_session"] = $this->session->all_userdata();
	// 		$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

	// 		if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
	// 			redirect('account/profile');
	// 		}

	// 		$this->load->view('template/dashboard/v_template_dash',$data);
	// 	}
	// }


	// function exceeddelivery(){
	// 	if(!$this->isLoggedin()){
	// 		redirect('dashboard/login');
	// 	}else{
	// 		$data["title"] = "Dashboard - Delivery Exceed Reports";
	// 		$data["webname"] = $GLOBALS["webname"];
	// 		$data["active"]	= "exceddeliveryreports";
	// 		$data["content"] = "dashboard/admin/v_reports_exceed_delivery";
	// 		$data["jstheme"] = array("jstheme/limitless_5/order_history", "jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification", "jstheme/limitless_5/modal", "jstheme/limitless_5/form_basic");
	// 		$data["loggedin"] = true;
	// 		$data["data_exceed"] = $this->M_Index_Dashboard->get_exceed()->result();

	// 		$data["data_session"] = $this->session->all_userdata();
	// 		$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

	// 		if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
	// 			redirect('account/profile');
	// 		}

	// 		$this->load->view('template/dashboard/v_template_dash',$data);
	// 	}
	// }

	function transactionreports(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Transaction Reports";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "transactionreports";
			$data["content"] = "dashboard/admin/v_reports_trans";
			$data["jstheme"] = array("jstheme/limitless_5/order_history", "jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification", "jstheme/limitless_5/modal", "jstheme/limitless_5/form_basic");
			$data["loggedin"] = true;
			$data["data_pembelian"]	= $this->M_Index_Dashboard->get_transaction()->result();
			// $data["data_jmlproduk"]	= $this->M_Index_Dashboard->get_transactioncount()->result();

			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}



	function refundreports(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Refund Reports";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "refund";
			$data["content"] = "dashboard/admin/v_reports_refund";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic","jstheme/limitless_5/notification","jstheme/limitless_5/modal","jstheme/limitless_5/form_basic");
			$data["loggedin"] = true;

			$data["cancelled_order"]	= 	$this->M_Index_Dashboard->get_transactioncancelled_all()->result();

			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);

		}
	}



	function withdrawreports(){
		if(!$this->isLoggedin()){
			redirect('dashboard/login');
		}else{
			$data["title"] = "Dashboard - Withdraw Reports";
			$data["webname"] = $GLOBALS["webname"];
			$data["active"]	= "withdrawreports";
			$data["content"] = "dashboard/admin/v_reports_withdraw";
			$data["jstheme"] = array("jstheme/limitless_5/datatable_basic", "jstheme/limitless_5/notification", "jstheme/limitless_5/modal");
			$data["loggedin"] = true;

			$data["data_withdraw"] = $this->M_Index_Dashboard->get_allwithdrawal()->result();

			$data["data_session"] = $this->session->all_userdata();
			$data["user_lvl_name"] = $this->M_Index->data_productview_getuserlevel($data["data_session"]["user_lvl"])->row()->name;

			if($data['user_lvl_name'] != 'Admin' && $data['user_lvl_name'] != 'Super Admin'){
				redirect('account/profile');
			}

			$this->load->view('template/dashboard/v_template_dash',$data);
		}
	}

	// reports end

}
?>
