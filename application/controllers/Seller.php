<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_shop','m_users','m_seller_pending_approval','m_products','m_category'));
	}

	//toko

	function edittoko(){
		if($this->isLoggedin() == true){

			$id 				= 	$this->uri->segment(3);
			$toko_buka			= 	$this->input->post('toko_buka');
			$kota_asal			= 	$this->input->post('kota_asal');
			$rekening 			= 	$this->input->post('rekening');
			$jne 				=	$this->input->post('jne');
			$tiki 				=	$this->input->post('tiki');
			$pos 				=	$this->input->post('pos');

			$row = $this->m_shop->select($_SESSION["id_user"])->row();
			$cour_array = explode(',',$row->kurir);

			if($toko_buka == 'on'){
				$buka = '1';
			}else{
				$buka = '0';
			}

			// $kurir = $row->kurir;

			if($jne == 'on'){

				$jne_already_on = false;

				foreach ($cour_array as $row) {
					if($row == "jne" && $jne_already_on == false){
						// $kurir = $kurir.'jne,';
						$jne_already_on = true;
					}
				}

				if($jne_already_on == false){
					array_push($cour_array, "jne");
				}


			}else{
				
				foreach ($cour_array as $row => $name) {
					// echo $name;
					if($name == "jne"){
						// echo "string";
						unset($cour_array[$row]);
						// $kurir = implode(",",$cour_array);
					}
				}

			}

			if($tiki == 'on'){
				
				$tiki_already_on = false;

				foreach ($cour_array as $row) {
					if($row == "tiki" && $tiki_already_on == false){
						// $kurir = $kurir.'jne,';
						$tiki_already_on = true;
					}
				}

				if($tiki_already_on == false){
					array_push($cour_array, "tiki");
				}

			}else{
				
				foreach ($cour_array as $row => $name) {
					// echo $name;
					if($name == "tiki"){
						// echo "string";
						unset($cour_array[$row]);
						// $kurir = implode(",",$cour_array);
					}
				}

			}

			if($pos == 'on'){
				
				$pos_already_on = false;

				foreach ($cour_array as $row) {
					if($row == "pos" && $pos_already_on == false){
						// $kurir = $kurir.'jne,';
						$pos_already_on = true;
					}
				}

				if($pos_already_on == false){
					array_push($cour_array, "pos");
				}

			}else{
				
				foreach ($cour_array as $row => $name) {
					// echo $name;
					if($name == "pos"){
						// echo "string";
						unset($cour_array[$row]);
						// $kurir = implode(",",$cour_array);
					}
				}

			}


			$kurir = implode(",",$cour_array);

			$data = array(
				'toko_buka' => $buka,
				'kota_asal' => $kota_asal,
				'kurir' => $kurir,
				'rekening' => $rekening
			);

			if($this->m_shop->edit($data,$id)){

				$this->session->set_flashdata('info','Setting toko berhasil dirubah!');

				$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
				$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
				$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menyimpan perubahan pada setting toko anda.', 3);
				$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
				$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
				$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
				$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-shop-'.$_SESSION['id_user'] , 3);
				$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

				redirect('dashboard/shop');
				// print_r($cour_array);

			}else{
				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/shop');
			}
		}else{
			redirect('');
		}
	}

	//toko-end


	//products

	function editproduct(){
		if($this->isLoggedin() == true){
			$id 						= 	$this->uri->segment(3);

			$nama_product				= 	$this->input->post('nama_product');
			$deskripsi_product			= 	$this->input->post('deskripsi_product');
			$sku						= 	$this->input->post('kode_product');
			$harga_product 				= 	$this->input->post('harga_product');
			$discount_reseller			= 	$this->input->post('discount_reseller');
			$discount_promo				= 	$this->input->post('discount_promo');
			$berat 						= 	$this->input->post('berat_product');
			$category 					=	$this->input->post('category');
			$promo_aktif				=	$this->input->post('promo_aktif');

			if ($promo_aktif == "on") {
				$promo = '1';
			}else{
				$promo = '0';
			}

			$data = array(
				'nama_product' => $nama_product,
				'deskripsi_product' => $deskripsi_product,
				'sku' => $sku,
				'harga' => $harga_product,
				'discount_reseller' => $discount_reseller,
				'discount_promo' => $discount_promo,
				'berat' => $berat,
				'id_category' => $category,
				'promo_aktif' => $promo
			);

			if($this->m_products->edit($data,$id)){

				// $idprod = $this->m_products->getProdLastId();
				$up_path = "./assets/images/products/";
				$name = "product";
				$element_name = "sampul_product";

				//upload sampulfoto
				if($_FILES['sampul_product']['size'] != 0){
					$this->uploadfoto($id,$up_path,$name,$element_name,"product");
				}

				
				//upload galerifoto
				for ($i=1; $i <= 5; $i++) { 

					if($_FILES['galeri_'.$i]['size'] != 0){

						$up_path = "./assets/images/products/gallery/";
						$name = "product_gallery";
						$element_name = "galeri_".$i;

						$this->uploadfoto($idprod,$up_path,$name,$element_name,"product-gallery");
					}

				}

				$this->session->set_flashdata('info','Product berhasil dirubah!');

				$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
				$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
				$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menyimpan perubahan pada product dengan nama '.$nama_product.'.', 3);
				$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
				$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
				$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
				$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-product-'.$_SESSION['id_user'] , 3);
				$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);


				redirect('dashboard/products/edit/'.$id);
				


			}else{
				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/products/edit/'.$id.'/gagal');
			}
		}else{
			redirect('');
		}
	}

	function addproduct(){
		if($this->isLoggedin() == true && !empty($_POST)){
			$id 						= 	$this->uri->segment(3);

			$nama_product				= 	$this->input->post('nama_product');
			$deskripsi_product			= 	$this->input->post('deskripsi_product');
			$sku						= 	$this->input->post('kode_product');
			$harga_product 				= 	$this->input->post('harga_product');
			$discount_reseller			= 	$this->input->post('discount_reseller');
			$discount_promo				= 	$this->input->post('discount_promo');
			$berat 						= 	$this->input->post('berat_product');
			$category 					=	$this->input->post('category');
			$promo_aktif				=	$this->input->post('promo_aktif');

			if ($promo_aktif == "on") {
				$promo = '1';
			}else{
				$promo = '0';
			}

			$data = array(
				'id_shop' => $id,
				'nama_product' => $nama_product,
				'deskripsi_product' => $deskripsi_product,
				'sku' => $sku,
				'harga' => $harga_product,
				'discount_reseller' => $discount_reseller,
				'discount_promo' => $discount_promo,
				'berat' => $berat,
				'id_category' => $category,
				'promo_aktif' => $promo
			);

			if($this->m_products->insert($data)){

				$idprod = $this->m_products->getProdLastId();
				$up_path = "./assets/images/products/";
				$name = "product";
				$element_name = "sampul_product";

				//upload sampulfoto
				if($this->uploadfoto($idprod,$up_path,$name,$element_name,"product")){ 
					//upload galerifoto
					for ($i=1; $i <= 5; $i++) { 

						if($_FILES['galeri_'.$i]['size'] != 0){

							$up_path = "./assets/images/products/gallery/";
							$name = "product_gallery";
							$element_name = "galeri_".$i;

							$this->uploadfoto($idprod,$up_path,$name,$element_name,"product-gallery");
						}

					}

					$this->session->set_flashdata('info','Product berhasil ditambahkan!');

					$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
					$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
					$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menambah product dengan nama '.$nama_product.'.', 3);
					$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
					$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
					$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
					$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-product-'.$_SESSION['id_user'] , 3);
					$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);


					redirect('dashboard/products');
				}else{
					$this->m_products->delete($idprod);
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('dashboard/products/add/gagal');
				}


			}else{
				$this->session->set_flashdata('error','Terjadi kesalahan');
				redirect('dashboard/products/add/gagal');
			}
		}else{
			redirect('');
		}	

	}

	function deleteproduct(){
		if($this->isLoggedin() == true){
			$id_product = $this->uri->segment(3);

			$this->m_products->delete($id_product);

			$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
			$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
			$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menghapus user dengan id '.$id_product.'.', 3);
			$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
			$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
			$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
			$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-product-'.$_SESSION['id_user'] , 3);
			$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

			redirect("dashboard/products");
		}else{
			redirect('');
		}
	}

	//products-end

}