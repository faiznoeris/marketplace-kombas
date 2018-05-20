<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_Account'));
	}

	/* PENDING APPROVAL */

	function requestupgrade(){
		date_default_timezone_set('Asia/Jakarta'); //set timezone to jkt

		// $id_user = $this->uri->segment(3);

		if($this->isLoggedin() && /*$id_user == $this->session->userdata('id_user') &&*/ ($this->session->userdata('user_lvl') != '1' || $this->session->userdata('user_lvl') != '2' || $this->session->userdata('user_lvl') != '4' || $this->session->userdata('user_lvl') != '5')){ //check if alr logged in or id_user is match with the id_user in session 

			$id_user = $this->session->userdata('id_user');
			$tipe_user = $this->uri->segment(4);
			$date = date('Y-m-d');

			$data = array(
				'id_user' => $id_user,
				'status' => 'Pending',
				'date' => $date
			);

			$notif_data = array(
				'header' => 'Request Approval',
				'duration' => '4500',
				'sticky' => 'false',
				'container' => '#jGrowl-'.$this->session->userdata('id_user')
			);

			//set the value to key'type' in $data array as 'seller' or 'reseller'
			//if none of it is correct, then redirect to account page
			if($tipe_user == "seller" && !is_numeric($tipe_user)){
				$data['type'] = 'seller';
			}else if($tipe_user == "reseller" && !is_numeric($tipe_user)){
				$data['type'] = 'reseller';				
			}else{
				$notif_data['message'] = 'Tipe user tidak diketahui!';
				$notif_data['theme'] = 'bg-warning alert-styled-left';
				$notif_data['group'] = 'alert-warning';

				$this->notif_data($notif_data);

				redirect("account/profile");
			}

			//continue inserting data to db
			$q = $this->M_Account->insert($data);

			if($q == "success"){ //check if the model return success

				$notif_data['message'] = 'Berhasil melakukan pengajuan menjadi '.ucfirst($data['type'].'.');
				$notif_data['theme'] = 'bg-success alert-styled-left';
				$notif_data['group'] = 'alert-success';

			}else if($q == "already_in_db"){

				$notif_data['message'] = 'Anda sudah melakukan pengajuan sebelumnya, proses penyetujuan oleh Admin memakan waktu beberapa hari.';
				$notif_data['theme'] = 'bg-danger alert-styled-left';
				$notif_data['group'] = 'alert-danger';

			}else if($q == "already_approved"){

				$notif_data['message'] = 'Anda sudah melakukan pengajuan sebelumnya, dan telah disetujui oleh Admin!';
				$notif_data['theme'] = 'bg-danger alert-styled-left';
				$notif_data['group'] = 'alert-danger';

			}else{

				$notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
				$notif_data['theme'] = 'bg-danger alert-styled-left';
				$notif_data['group'] = 'alert-danger';

			}

			$this->notif_data($notif_data);

			redirect("account/profile");

		}else{ //not logged in
			redirect("");
		}
	}

	/* PENDING APPROVAL */

	/* EDIT ACCOUNT */

	function editaccount(){

		$notif_data = array(
			'header' => 'Edit Account',
			'duration' => '4500',
			'sticky' => 'false',
			'container' => '#jGrowl-'.$this->session->userdata('id_user')
		);

		if($this->isLoggedin()){ //check if alr logged in

			if(!empty($this->input->post())){ //check if _POST is empty or not
				
				$q = $this->M_Account->update_account($this->session->userdata('id_user'), $this->input->post(), $_FILES['cover']['size'], $_FILES['avatar']['size']);

				if($q == "success"){ //success update to db
					$notif_data['message'] = 'Berhasil mengubah data akun.';
					$notif_data['theme'] = 'bg-success alert-styled-left';
					$notif_data['group'] = 'alert-success';
				}else{ 
					$notif_data['message'] = 'Terdapat kesalahan! Error: '.$q;
					$notif_data['theme'] = 'bg-danger alert-styled-left';
					$notif_data['group'] = 'alert-danger';
					$this->session->set_flashdata('error',$q);
				}

			}else{
				$notif_data['message'] = 'Data masih kosong!';
				$notif_data['theme'] = 'bg-warning alert-styled-left';
				$notif_data['group'] = 'alert-warning';
			}

			$this->notif_data($notif_data);

			redirect('account/profile#pengaturan');
		}else{ //not logged in
			redirect('');
		}
		
	}

	/* EDIT ACCOUNT */
}
?>