<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Admins extends CI_Model{
	/* REPORTS */

	function warn_seller($data, $id_transaction, $id_shop, $user_lvl){
		$this->db->set($data);
		$this->db->where('id_transaction', $id_transaction);
		$this->db->where('id_shop', $id_shop);

		if($user_lvl == "1" || $user_lvl == "2"){
			if($this->db->update('transaction_history_seller')){
				return "success";
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "not_admin";
		}
	}

	function acc_withdraw($data, $id_withdraw, $user_lvl){
		$this->db->set($data);
		$this->db->where('id_withdraw', $id_withdraw);

		if($user_lvl == "1" || $user_lvl == "2"){
			if($this->db->update('withdrawal')){
				return "success";
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "not_admin";
		}
	}

	function acc_refund($data, $jumlahproduk, $id_transaction, $user_lvl){
		$this->db->set($data);
		$this->db->where('id_transaction', $id_transaction);

		if($user_lvl == "1" || $user_lvl == "2"){
			if($this->db->update('transaction_cancelled')){
				return "success";
			}else{
				return $this->db->_error_message();
			}
		}else{
			return "not_admin";
		}
	}

	function acc_transfer($data, $id_transaction, $id_user, $id_shop, $jmlproduk, $user_lvl){ //currently id_user is not used
		$this->db->set($data);
		$this->db->where('id_transaction', $id_transaction);
		$this->db->where('id_shop', $id_shop);

		if($user_lvl == "1" || $user_lvl == "2"){

			$status = "";

			if($jmlproduk > 1){
				for ($i=0; $i < $jmlproduk; $i++) { 
					if($this->db->update('transaction_history_seller')){
						$status = "OK";
					}else{
						$status = "BAD";
						break;
					}
				}
			}else{
				if($this->db->update('transaction_history_seller')){
					$status = "OK";
				}else{
					$status = "BAD";
				}
			}

			if($status == "OK"){
				return "success";
			}else{
				return "Status: ".$status." | ".$this->db->_error_message();
			}
		}else{
			return "not_admin";
		}
	}

	/* REPORTS */

	/* SETTINGS */

	public $newbankname = "";

	function setNewBankName($name){
		$this->newbankname = $name;
	}

	function getNewBankName(){
		return $this->newbankname;
	}

	function get_one_bank($id_bank){
		return $this->db
		->where("id_bank", $id_bank)
		->limit(1)
		->get('banks');
	}

	public $newcategoryname = "";

	function setNewCategoryName($name){
		$this->newcategoryname = $name;
	}

	function getNewCategoryName(){
		return $this->newcategoryname;
	}

	function get_one_category($id_category){
		return $this->db
		->where("id_category", $id_category)
		->limit(1)
		->get('category');
	}

	function add_category($input, $user_lvl) {
		if($user_lvl == "1" || $user_lvl == "2"){
			if(!empty($input)){
				$data = array('nama_category' => $input['nama_category']);

				if($this->db->insert("category", $data)){
					$this->setNewCategoryName($data['nama_category']);
					return "success";
				}else{
					return $this->db->_error_message();
				}

			}else{
				return "empty_data";
			}
		}else{
			return "not_admin";
		}
	}

	function edit_category($input, $id_category, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){
			if(!empty($input)){
				$this->db->set('nama_category', 'nama_category');				
				$this->db->where('id_category', $id_category);

				if($this->db->update('category')){
					return "success";
				}else{
					return $this->db->_error_message();
				}
			}else{
				return "empty_data";
			}
		}else{
			return "not_admin";
		}
	}

	function get_username($id_user){
		return $this->db
		->where("id_user", $id_user)
		->limit(1)
		->get('users')
		->row()
		->username;
	}

	function delete_category($id_category, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){
			$this->db->where('id_category', $id_category);

			if($this->db->delete('category')){
				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{
			return "not_admin";
		}
	}

	/* SETTINGS */

	/* USER MANAGEMENT */

	function username_exist($username){
		$rows = $this->db
		->where("username", $username)
		->get('users')
		->num_rows();

		if($rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function email_exist($email){
		$rows = $this->db
		->where("email", $email)
		->get('users')
		->num_rows();

		if($rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function telephone_exist($telephone){
		$rows = $this->db
		->where("telephone", $telephone)
		->get('users')
		->num_rows();

		if($rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function shop_exist($id_user){
		$rows = $this->db
		->where("id_user", $id_user)
		->get('shops')
		->num_rows();

		if($rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function get_shop($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('shops')
		->rows();
	}

	function get_product($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('products');
	}

	function add_user($input, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){
			if(!empty($input)){

				$date = date('Y-m-d');
				$md5 = md5("taesa%#@2%^#" . $input['password'] . "2345#$%@3e");
				$password_hash = sha1($md5);

				$data = array(
					'first_name' => $input['first_name'],
					'last_name' => $input['last_name'],
					'username' => $input['username'],
					'email' => $input['email'],
					'telephone' => $input['telephone'],
					'password' => $password_hash,
					'id_userlevel' => $input['usertype'],
					'date_joined' => $date
				);

				if($this->username_exist($input['username']) || $this->email_exist($input['email']) || $this->telephone_exist($input['telephone'])){
					return "username_email_or_telephone_exist";
				}else{

					if($this->db->insert("users", $data)){
						$insert_id = $this->db->insert_id();

						if($input['usertype'] == "4"){ //if selected user type is 4 or seller, create a shops
							$data_shops = array('id_user' => $insert_id);

							if($this->db->insert("shops", $data_shops)){
								return "success";
							}else{
								return $this->db->_error_message();
							}

						}else{
							return "success";
						}

					}else{
						return $this->db->_error_message();
					}

				}
			}else{
				return "empty_data";
			}
		}else{
			return "not_admin";
		}
	}

	function edit_user($input, $id_user, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){
			if(!empty($input)){

				$date = date('Y-m-d');
				$md5 = md5("taesa%#@2%^#" . $input['password'] . "2345#$%@3e");
				$password_hash = sha1($md5);

				$data = array(
					'first_name' => $input['first_name'],
					'last_name' => $input['last_name'],
					'username' => $input['username'],
					'email' => $input['email'],
					'telephone' => $input['telephone'],
					'password' => $password_hash,
					// 'id_userlevel' => $input['usertype']
				);

				if($this->username_exist($input['username']) || $this->email_exist($input['email']) || $this->telephone_exist($input['telephone'])){
					return "username_email_or_telephone_exist";
				}else{

					$this->db->where('id_user', $id_user);
					if($this->db->update("users", $data)){ //update users

						if($input['usertype'] == "3" || $input['usertype'] == "5"){ //if change from seller to anything beside seller, delete the shops
							
							if($this->shop_exist($id_user)){
								
								$id_shop = $this->get_shop($id_user)->id_shop;
								$products = $this->get_product($id_shop)->result();
								$status = "";

								foreach ($products as $value) { //delete all product

									$this->db->where('id_product', $value->id_product);
									if($this->db->delete('products')){
										$status = "OK";
									}else{
										$status = "BAD";
									}

								}

								if($status == "OK"){
									$this->db->where('id_shop', $value->id_shop);
									if($this->db->delete('shops')){
										return "success";
									}else{
										return $this->db->_error_message();
									}
								}else{
									return $this->db->_error_message();
								}

								//TO-DO : 1. Delete all transaction history or any other data related to the shop id (trans_canceled,history(maybe check the cart),product,seller,withdrawal,reviews,notification(stok), messages, confirmation, )

							}else{
								return "success";
							}

						}else if($input['usertype'] == "4"){
							
							if($this->shop_exist($id_user)){
								$data_shops = array('id_user' => $insert_id);

								if($this->db->insert("shops", $data_shops)){
									return "success";
								}else{
									return $this->db->_error_message();
								}
							}else{
								return "success";
							}

						}

					}else{
						return $this->db->_error_message();
					}

				}
			}else{
				return "empty_data";
			}
		}else{
			return "not_admin";
		}
	}

	function delete_user($id_user, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){
			$this->db->where('id_user', $id_user);

			if($this->db->delete('users')){


				// if($row->id_userlevel == '4'){
				// 	$this->m_shop->delete('user',$id);
				// }

				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{
			return "not_admin";
		}
	}

	function acc_upgrade($data_users, $data_pending_approval, $id_user, $user_lvl){
		if($user_lvl == "1" || $user_lvl == "2"){

			$this->db->where('id_user', $id_user);

			if($this->db->update('users', $data_users)){

				$this->db->where('id_user', $id_user);
				if($this->db->update('pending_approval', $data_pending_approval)){
					return "success";	
				}else{
					return $this->db->_error_message();
				}

			}else{
				return $this->db->_error_message();
			}

		}else{
			return "not_admin";
		}
	}

	function getUsername($id_user){
		return $this->db
		->where("id_users", $id_user)
		->limit(1)
		->get('users')
		->row()
		->username;
	}

	/* USER MANAGEMENT */















	function get_field($field,$field2,$data,$data2){
		$this->db->select($field);
		$this->db->from("admins");

		if($field == "loggedin" || $field == "activated"){ //get loggedin value
			$this->db->like("username", $this->db->escape_str($data));
		}else{
			$this->db->like($field, $this->db->escape_str($data));
		}

		if($data2 != ""){
			$this->db->like($field, $this->db->escape_str($data));
			$this->db->like($field2, $this->db->escape_str($data2));
		}

		$this->db->limit(1);
		$res = $this->db->get();

		return $res;
	}


	function update_login($uname, $pwd_hash){
		$this->load->model('m_shop');

		$this->db->select("*, DATE_FORMAT(date_joined, '%d - %M - %Y') as date_joined2");
		$this->db->from("admins");
		$this->db->like("username", $uname);
		$this->db->like("password", $pwd_hash);
		$this->db->limit(1);

		$res = $this->db->get();
		$row = $res->row();

		$this->db->set('loggedin', '1');
		$this->db->where('id_admin', $row->id_admin);

		if($this->db->update('users')){

			if($row->id_adminlevel == '4'){ //if seller, add id shop to session

				$row2 = $this->m_shop->select($row->id_admin)->row();

				$newdata = array(
					'id_admin'		=> $row->id_admin,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_adminlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'id_shop'		=> $row2->id_shop,
					'loggedin' 		=> TRUE
				);
			}else{
				$newdata = array(
					'id_admin'		=> $row->id_admin,
					'email'			=> $row->email,
					'nama_lgkp'		=> $row->first_name." ".$row->last_name,
					'user_lvl'		=> $row->id_adminlevel,
					'username'  	=> $row->username,
					'telp'			=> $row->telephone,
					'date_joined' 	=> $row->date_joined2,
					'ava_path' 		=> $row->ava_path,
					'loggedin' 		=> TRUE
				);
			}

			

			$this->session->set_userdata($newdata);

			return true;
		}

		return false;
	}






	function update_logout($id_admin){
		$this->db->set('loggedin', '0');
		$this->db->where('id_admin', $id_admin);
		$this->db->update('users');
	}


}
?>