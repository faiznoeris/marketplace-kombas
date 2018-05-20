<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Ajax extends CI_Model{

	/* CEK RESI (AUTOMATIC TRACKING EVERY 12 HOURS) */

	function get_ondelivery(){
		$q = $this->db
		->where('status', "On Delivery")
		->get('transaction_history_seller');

		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return "empty";
		}
	}

	function get_pending(){
		$q = $this->db
		->where('status', "Pending")
		->get('transaction_history_seller');

		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return "empty";
		}
	}

	function update_status($data, $id_trans_seller){
		$this->db->where('id_trans_seller', $id_trans_seller);
		if($this->db->update('transaction_history_seller', $data)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function get_user($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users');
	}

	function get_shop($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->limit(1)
		->get('shops');
	}

	function update_saldo($id_shop, $id_user, $saldo_buyer, $saldo_seller){
		$buyer = $this->get_user($id_user)->row();
		$shop = $this->get_shop($id_shop)->row();
		$seller = $this->get_user($shop->id_user)->row();

		$saldo_seller_new = $saldo_seller + $seller->saldo;
		$saldo_buyer_new = $saldo_buyer + $buyer->saldo;

		$data = array('saldo' => $saldo_seller_new);
		$this->db->where('id_user', $seller->id_user);
		if($this->db->update('users', $data)){

			$data = array('saldo' => $saldo_buyer_new);
			$this->db->where('id_user', $buyer->id_user);
			if($this->db->update('users', $data)){
				return "success";
			}else{
				return $this->db->_error_message();
			}

		}else{
			return $this->db->_error_message();
		}
	}

	function get_product($id_product){
		return $this->db
		->where('id_product', $id_product)
		->limit(1)
		->get('products');
	}

	function update_product($id_product, $data){
		$this->db->where('id_product', $id_product);
		if($this->db->update('products',$data)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function get_notiflist($id_product){
		return $this->db
		->where('id_product', $id_product)
		->get('stocK_notification');
	}

	function get_token($token){
		return $this->db
		->where('token', $token)
		->limit(1)
		->get('users');
	}

	function update_user($data, $id_user){
		$this->db->where('id_user', $id_user);
		if($this->db->update('users', $data)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	/* CEK RESI (AUTOMATIC TRACKING EVERY 12 HOURS) */




	/* RAJAONGKIR API (PROVINSI,KABUPATEN) */

	function get_address($id_address){
		return $this->db
		->where('id_address', $id_address)
		->limit(1)
		->get('address');
	}

	/* RAJAONGKIR API (PROVINSI,KABUPATEN) */

}
?>