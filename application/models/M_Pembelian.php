<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Pembelian extends CI_Model{

	function insert_konfirmasitrf($input, $id_transaction, $id_user, $jmlproduk){
		if(!empty($input)){

			$data = array(
				'id_transaction' => $id_transaction,
				'id_user' => $id_user,
				'id_bank' => $input['select_bank'],
				'from_bank' => $input['frombank'],
				'atasnama' => $input['atasnama'],
				'no_rekening' => $input['norekening'],
				'bukti_path' => "-"
			);

			if($this->db->insert('confirmation', $data)){ 

				$config = array(
					'allowed_types' => "gif|jpg|png",
					'overwrite' => TRUE,
				);

				$config['upload_path'] = "./assets/images/bukti_transfer/";
				$config['max_size'] = "1024";
				$config['file_name'] = "bukti_transfer-". $this->db->insert_id() . "-" . rand(0,1000);
				$upload_bukti = $this->upload($this->db->insert_id(), $config, 'bukti_trf', 'bukti_path');

				if($upload_bukti == "success"){

					$data_update = array('status' => "Transfer Confirmed By User");

					if($jmlproduk > 1){
						for ($i=0; $i < $jmlproduk; $i++) { 
							$this->db->where('id_transaction', $id_transaction);
							if(!$this->db->update('transaction_history_seller', $data_update)){
								return "gagal_update_loop ".$this->db->_error_message();
							}
						}
					}else{
						$this->db->where('id_transaction', $id_transaction);
						if($this->db->update('transaction_history_seller', $data_update)){
							return "success";	
						}else{
							return "gagal_update ".$this->db->_error_message();
						}
					}

					return "success";
				}else{
					return "gagal_upload ".$this->upload->display_errors();
				}

			}else{
				return "gagal_insert ".$this->db->_error_message();
			}

		}else{
			return "empty_data";
		}
	}

	function upload($id_confirmation,$config,$input_name,$column_name){

		$this->upload->initialize($config);

		if($this->upload->do_upload($input_name)){
			$path 				= 	$this->upload->data();
			$path 				= 	$path["full_path"];
			$path 				= 	substr($path, 31);

			$this->db->set($column_name, $path);
			$this->db->where('id_confirmation', $id_confirmation);

			if($this->db->update('confirmation')){
				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{
			return $this->upload->display_errors();
		}
	}

	// function update_brgditerima(){

	// }

}
?>