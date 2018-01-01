<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_users','m_seller_pending_approval','m_products','m_category'));
	}





	function addcategory(){

		$nama				= 	$this->input->post('nama_category');

		$data = array(
			'nama_category' => $nama
		);
		
		if($this->m_category->insert($data)){

			$this->session->set_flashdata('info','Category berhasil ditambahkan!');
			redirect('dashboard/listcategory');
			
		}else{

			$this->session->set_flashdata('error','Terjadi kesalahan');
			redirect('dashboard/addcategory/gagal');

		}

	}

	function deletecategory(){
		$id = $this->uri->segment(3);
		
		$this->m_category->delete($id);

		redirect("dashboard/listcategory");
	}





	//add edit delete product

	function save_editproduct(){

	}

	function deleteproduct(){
		$id_product = $this->uri->segment(3);

		$this->m_products->delete($id_product);

		redirect("dashboard/daftarproduct");
	}

	function addproduct(){
		// $id_product = $this->uri->segment(3);

		$nama_product				= 	$this->input->post('nama_product');
		$deskripsi_product			= 	$this->input->post('deskripsi_product');
		$harga_product 				= 	$this->input->post('harga_product');
		$disc_dropshipper			= 	$this->input->post('disc_dropshipper');

		$sku						= 	$this->input->post('kode_product');
		$minimal_order				= 	$this->input->post('minimal_order');
		$berat 						= 	$this->input->post('berat_product');
		//$sampul 					= 	$this->input->post('sampul_product');

		$data = array(
			//'id_user' => $id_user,
			'nama_product' => $nama_product,
			'deskripsi_product' => $deskripsi_product,
			'harga' => $harga_product,
			'disc_dropshipper' => $disc_dropshipper,
			'sku' => $sku,
			'minimal_order' => $minimal_order,
			'berat' => $berat
			//'sampul_path' => $sampul
		);
		
		if($this->m_products->insert($data)){

			$idprod = $this->m_products->getProdLastId();
			$up_path = "./assets/images/products/";
			$name = "product";
			$element_name = "sampul_product";

			if($this->uploadfoto($idprod,$up_path,$name,$element_name,"product")){
				$this->session->set_flashdata('info','Product berhasil ditambahkan!');
				redirect('dashboard/addproduct/sukses');
			}else{
				$this->m_products->delete($idprod);
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('dashboard/addproduct/gagal');
			}

			
		}else{
			$this->session->set_flashdata('error','Terjadi kesalahan');
			redirect('dashboard/addproduct/gagal');
		}

	}




	function approveseller(){
		$id_user = $this->uri->segment(3);

		$data = array(
			'user_lvl' => '3'
		);

		$data_2 =  array(
			'status' => 'Approved' 
		);

		$this->m_users->update($id_user,$data);
		$this->m_seller_pending_approval->update($id_user,$data_2);

		redirect('dashboard/sellerpending');


	}

	function adduser(){
		$first_name					= 	$this->input->post('first_name');
		$last_name					= 	$this->input->post('last_name');
		$username 					= 	$this->input->post('username');
		$email 						= 	$this->input->post('email');
		$telephone					= 	$this->input->post('telephone');
		$password					= 	$this->input->post('password');

		$password_hash 				= 	$this->encryptPassword($password);

		

		if ($this->m_users->get_field("username","",$username,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Username sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}	

		if ($this->m_users->get_field("email","",$email,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Email sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}

		if ($this->m_users->get_field("telephone","",$telephone,"")->num_rows() == 1){
			$this->session->set_flashdata('error','*Telephone sudah terdaftar!');
			redirect('dashboard/adduser/gagal');
		}	



		$this->m_users->add_user($first_name,$last_name,$username,$email,$telephone,$password_hash);
		$this->session->set_flashdata('info','User berhasil ditambahkan!');
		redirect('dashboard/adduser/sukses');

	}

}