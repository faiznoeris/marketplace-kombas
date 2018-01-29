<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_messages'));
	}


	function send(){
		$date = date('Y-m-d H:i:s');

		$id_receiver = $this->uri->segment(3);
		$id_sender = $_SESSION['id_user'];
		$msg = $this->input->post('message');

		$data = array(
			'id_sender' => $id_sender,
			'id_receiver' => $id_receiver,
			// 'id_user' => $id_sender,
			'date' => $date,
			'msg' => $msg
		);

		$this->m_messages->insert($data);

		// $this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
		// $this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], 'Notification', 3);
		// $this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], 'Berhasil menambah alamat.', 3);
		// $this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], '5000', 3);
		// $this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], 'bg-primary', 3);
		// $this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], 'false', 3);
		// $this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], '#jGrowl-address-'.$_SESSION['id_user'] , 3);
		// $this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], 'alert-success', 3);

		redirect('dashboard/messages/'.$id_receiver);
	}

}