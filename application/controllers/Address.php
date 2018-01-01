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
		// $kabupaten = $this->input->post('kabupaten');
		// $provinsi = $this->input->post('provinsi');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$data = array(
			'id_user' => $id_user,
			'namaalamat' => $nama,
			'atasnama' => $atasnama,
			'alamat' => $alamat,
			'kodepos' => $kodepos,
			'telephone' => $telephone
		);

		$this->m_address->insert($data);

		redirect('dashboard/alamat');
	}

	function edit(){
		$id_alamat = $this->uri->segment(3);

		$nama = $this->input->post('nama_alamat');
		$atasnama = $this->input->post('atas_nama');
		$alamat = $this->input->post('alamat');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$data = array(
			'namaalamat' => $nama,
			'atasnama' => $atasnama,
			'alamat' => $alamat,
			'kodepos' => $kodepos,
			'telephone' => $telephone
		);

		$this->m_address->update($id_alamat, $data);

		redirect('dashboard/alamat/edit/'.$id_alamat);
	}

	function delete(){
		$id = $this->uri->segment(3);

		$this->m_address->delete($id);

		redirect('dashboard/alamat');
	}
}