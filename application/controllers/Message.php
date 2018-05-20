<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	private $notif_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Messages'));
		$this->notif_data['header'] = 'Message';
		$this->notif_data['duration'] = '3000';
		$this->notif_data['sticky'] = 'false';
		$this->notif_data['container'] = '#jGrowl-'.$this->session->userdata('id_user');
	}

	function send(){
		$id_convo = $this->uri->segment(3);
		$id_receiver = $this->uri->segment(4);
		$id_sender = $this->session->userdata('id_user');
		$user_lvl = $this->session->userdata('user_lvl');

		if($this->isLoggedin()){

			$q = $this->M_Messages->send_msg($this->input->post(), $id_receiver, $id_sender, $id_convo, $user_lvl);

			if($q == "success"){
				$this->notif_data['message'] = 'Pesan berhasil dikirim.';
				$this->notif_data['theme'] = 'bg-success alert-styled-left';
				$this->notif_data['group'] = 'alert-success';
			}else if($q == "empty_data"){
				$this->notif_data['message'] = 'Data masih kosong';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
				$this->notif_data($this->notif_data);

				redirect('account/messages');
			}else if($q == "is_admin"){
				$this->notif_data['message'] = 'Admin tidak dapat mengirim pesan untuk saat ini.';
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
				$this->notif_data($this->notif_data);

				redirect('account/messages');
			}else{
				$this->notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$this->notif_data['theme'] = 'bg-danger alert-styled-left';
				$this->notif_data['group'] = 'alert-danger';
			}	

			$this->notif_data($this->notif_data);

			redirect('account/messages/convo/'.$id_convo);

		}else{
			redirect('');
		}	
	}

}
?>