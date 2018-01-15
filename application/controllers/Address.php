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
		$kabupaten = $this->input->post('kabupaten');
		$provinsi = $this->input->post('provinsi');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$data = array(
			'id_user' => $id_user,
			'namaalamat' => $nama,
			'atasnama' => $atasnama,
			'alamat' => $alamat,
			'kabupaten' => $kabupaten,
			'provinsi' => $provinsi,
			'kodepos' => $kodepos,
			'telephone' => $telephone
		);

		$this->m_address->insert($data);

		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menambah alamat.', 3);
		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-address-'.$_SESSION['id_user'] , 3);
		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/alamat');
	}

	function edit(){
		$id_alamat = $this->uri->segment(3);

		$nama = $this->input->post('nama_alamat');
		$atasnama = $this->input->post('atas_nama');
		$alamat = $this->input->post('alamat');
		$kabupaten = $this->input->post('kabupaten');
		$provinsi = $this->input->post('provinsi');
		$kodepos = $this->input->post('kodepos');
		$telephone = $this->input->post('telephone');

		$session = $this->session->all_userdata();
		$id_user = $session['id_user'];

		$data = array(
			'id_user' => $id_user,
			'namaalamat' => $nama,
			'atasnama' => $atasnama,
			'alamat' => $alamat,
			'kabupaten' => $kabupaten,
			'provinsi' => $provinsi,
			'kodepos' => $kodepos,
			'telephone' => $telephone
		);

		$this->m_address->update($id_alamat, $data);

		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil mengubah alamat.', 3);
		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-address-'.$_SESSION['id_user'] , 3);
		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/alamat/edit/'.$id_alamat);
	}

	function delete(){
		$id = $this->uri->segment(3);

		$this->m_address->delete($id);

		$this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		$this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		$this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menghapus alamat.', 3);
		$this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		$this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		$this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		$this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-address-'.$_SESSION['id_user'] , 3);
		$this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/alamat');
	}
}