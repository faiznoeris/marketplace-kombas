<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_address'));
	}


	function add(){
		$nama = $this->input->post('nama_alamat');
		$atasnama = $this->input->post('atas_nama');
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');
		$provinsi = $this->input->post('provinsi');
		$negara = $this->input->post('negara');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$this->m_address->insert($id_user, $nama, $atasnama, $alamat, $kecamatan, $kabupaten, $provinsi, $negara, $kodepos, $telephone);

		redirect('account');
	}

	function edit(){
		$id_alamat = $this->uri->segment(3);

		$nama = $this->input->post('nama_alamat');
		$atasnama = $this->input->post('atas_nama');
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');
		$provinsi = $this->input->post('provinsi');
		$negara = $this->input->post('negara');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$data = array(
			'namaalamat' => $nama,
			'atasnama' => $atasnama,
			'alamat' => $alamat,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten,
			'provinsi' => $provinsi,
			'negara' => $negara,
			'kodepos' => $kodepos,
			'telephone' => $telephone
		);

		$this->m_address->update($id_alamat, $data);

		redirect('account/alamat/ubahalamat/'.$id_alamat);
	}

	function delete(){
		$id = $this->uri->segment(3);

		$this->m_address->delete($id);

		redirect('account');
	}
}