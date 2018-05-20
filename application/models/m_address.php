<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Address extends CI_Model{

	public $address_old_name = "";

	function setAddressOldName($name){
		$this->address_old_name = $name;
	}

	function getAddressOldName(){
		return $this->address_old_name;
	}


	function get_one($id_address){
		return $this->db
		->where("id_address", $id_address)
		->limit(1)
		->get('address');
	}

	function insert($id_user, $input) {
		$data = array(
			'id_user' => $id_user,
			'namaalamat' => $input['nama_alamat'],
			'atasnama' => $input['atas_nama'],
			'alamat' => $input['alamat'],
			'kabupaten' => $input['kabupaten'],
			'provinsi' => $input['provinsi'],
			'kodepos' => $input['kodepos'],
			'telephone' => $input['telephone']
		);

		if($this->db->insert("address", $data)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function update($id_address, $input, $id_user){
		$data = array(
			// 'id_user' => $id_user,
			'namaalamat' => $input['nama_alamat'],
			'atasnama' => $input['atas_nama'],
			'alamat' => $input['alamat'],
			'kabupaten' => $input['kabupaten'],
			'provinsi' => $input['provinsi'],
			'kodepos' => $input['kodepos'],
			'telephone' => $input['telephone']
		);

		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}

		$rows = $this->get_one($id_address)->num_rows();

		if($rows > 0){ //is it found

			$address_old = $this->get_one($id_address)->row();

			if($address_old->id_user == $id_user){ //check if the address belong to the current user

				$this->db->where('id_address', $id_address);

				if($this->db->update('address')){
					$this->setAddressOldName($address_old->namaalamat);
					return "success";
				}else{
					return $this->db->_error_message();
				}

			}else{
				return "address_not_belong";
			}

		}else{
			return "address_not_found";
		}


	}

	function delete($id_address, $id_user) {

		$rows = $this->get_one($id_address)->num_rows();

		if($rows > 0){ //is it found

			$address_old = $this->get_one($id_address)->row();

			if($address_old->id_user == $id_user){ //check if the address belong to the current user

				$this->setAddressOldName($address_old->namaalamat);
				$this->db->where('id_address', $id_address);

				if($this->db->delete('address')){
					return "success";
				}else{
					return $this->db->_error_message();
				}

			}else{
				return "address_not_belong";
			}

		}else{
			return "address_not_found";
		}
	}







	function select($kondisi,$id){
		$this->db->select("*");
		$this->db->from("address");
		$this->db->where("id_".$kondisi, $id);

		return $this->db->get();
	}
}
?>