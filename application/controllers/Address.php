<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Address'));
		$this->notif_data['header'] = 'Address Notification';
		$this->notif_data['duration'] = '3000';
		$this->notif_data['sticky'] = false;
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function add(){
		if($this->isLoggedin()){ //check if alr logged in or id_user is match with the id_user in session 

			$id_user = $this->session->userdata('id_user');

			$q = $this->M_Address->insert($id_user, $this->input->post());

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil menambah alamat pengiriman.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}

			$this->notif_data($this->notif_data);
			
			redirect('account/profile#pengaturan');
		}else{
			redirect('');
		}

	}

	function edit(){
		$id_address = $this->uri->segment(3);
		$id_user = $this->session->userdata('id_user');

		if($this->isLoggedin()){ //check if alr logged in 

			$q = $this->M_Address->update($id_address, $this->input->post(), $id_user);
			$address_new = $this->M_Address->get_one($id_address)->row();

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil mengubah data alamat pengiriman (nama alamat: '.$this->M_Address->getAddressOldName().' menjadi: '.$address_new->namaalamat.').';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "address_not_belong"){
				$this->notif_data['message'] = 'Terjadi Kesalahan, alamat milik akun yang lain!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}else if($q == "address_not_found"){
				$this->notif_data['message'] = 'Data alamat tidak ditemukan!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
				$this->session->set_flashdata('error',$q);
			}

			$this->notif_data($this->notif_data);

			redirect('account/alamat/edit/'.$id_address);

		}else{ //not logged in
			redirect('');
		}
		
	}

	function delete(){
		$id_address = $this->uri->segment(3);
		$id_user = $this->session->userdata('id_user');

		if($this->isLoggedin()){ //check if alr logged in 

			$q = $this->M_Address->delete($id_address, $id_user);

			if($q == "success"){
				$this->notif_data['message'] = 'Berhasil menghapus alamat (nama alamat: '.$this->M_Address->getAddressOldName().').';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "address_not_belong"){
				$this->notif_data['message'] = 'Terjadi Kesalahan, alamat milik akun yang lain!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}else if($q == "address_not_found"){
				$this->notif_data['message'] = 'Data alamat tidak ditemukan!';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
				$this->session->set_flashdata('error',$q);
			}

			$this->notif_data($this->notif_data);

			redirect('account/profile#pengaturan');

		}else{ //not logged in
			redirect('');
		}

	}
}
?>