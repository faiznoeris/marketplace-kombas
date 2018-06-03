<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Ajax extends CI_Model{

	/* DASHBOARD DATA */

	function count_user(){
		return $this->db
		->where('id_userlevel','3')
		->get('users')
		->num_rows();
	}

	function count_seller(){
		return $this->db
		->where('id_userlevel','4')
		->get('users')
		->num_rows();
	}

	function count_reseller(){
		return $this->db
		->where('id_userlevel','5')
		->get('users')
		->num_rows();
	}

	function weekoftrans($start_date){
		return $this->db
		->query("SELECT DATE_FORMAT(date, '%Y-%m-%d') as date FROM `transaction_history` WHERE `date` > '".$start_date."'");
	}

	/* DASHBOARD DATA */

	/* ACCOUNT DATA */

	function data_order($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('transaction_history_seller');
	}

	function data_ordercancelled($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->get('transaction_cancelled');
	}

	function data_ceksaldohistory($id_shop){
		return $this->db
		->query("
			SELECT id_shop, DATE_FORMAT(date_delivered, '%d - %M - %Y') as date_delivered, totalharga, totalongkir, kode_unik FROM transaction_history_seller WHERE id_shop = '".$id_shop."' AND status = 'Delivered'
			UNION
			SELECT id_shop, DATE_FORMAT(date, '%d - %M - %Y') as date_delivered, amount, NULL as col4, NULL as col5 FROM withdrawal WHERE id_shop = '".$id_shop."' AND status = 'Approved'
			
			LIMIT 7
			");
	}

	/* ACCOUNT DATA */

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

	function get_confirmbyadmin(){
		$q = $this->db
		->where('status', "Transfer Confirmed By Admin")
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


	/* CHECK DELIVERY EXCEED DEADLINE */

	function get_exceed(){
		return $this->db->query("SELECT *, DATE_FORMAT(transaction_history.date, '%e - %M - %Y') as date_ordered FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history_seller.warning = '0'");
	}

	function warn_seller($id_transaction, $id_shop){
		$data = array('warning' => '1');

		$this->db->set($data);
		$this->db->where('id_transaction', $id_transaction);
		$this->db->where('id_shop', $id_shop);
		
		if($this->db->update('transaction_history_seller')){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	/* CHECK DELIVERY EXCEED DEADLINE */

	/* CHECK NOTIF MSG & ORDER */

	function cek_order($id_shop){
		return $this->db
		->where('id_shop', $id_shop)
		->where('show_notif_neworder', '0')
		->order_by('id_transaction', 'DESC')
		->get('transaction_history_seller');
	}

	function setorder_show_notif($id_transaction, $id_shop){
		$data_update = array('show_notif_neworder' => '1');
		$this->db->where('id_transaction', $id_transaction);
		$this->db->where('id_shop', $id_shop);
		if($this->db->update('transaction_history_seller', $data_update)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	function get_shop_byuser($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('shops');
	}

	function cek_msg($id_user){
		return $this->db
		->select('*, DATE_FORMAT(date, "%Y-%m-%d") AS date_tocheck, DATE_FORMAT(date, "%H:%i") AS time')
		->where('id_receiver', $id_user)
		->where('show_notif', '0')
		->order_by('id_msg', 'DESC')
		->get('messages');
	}

	function get_user_sender($id_user){
		return $this->db
		->where('id_user', $id_user)
		->limit(1)
		->get('users');
	}

	function setmsg_show_notif($id_msg){
		$data_update = array('show_notif' => '1');
		$this->db->where('id_msg', $id_msg);
		if($this->db->update('messages', $data_update)){
			return "success";
		}else{
			return $this->db->_error_message();
		}
	}

	/* CHEC KNOTIF MSG & ORDER */

	/* DETAIL TRANSAKSI (FOR MODAL EXCEED DELIVERY IN ACCOUNT) */

	function get_detailtransaksi($id_transaction, $id_shop){
		return $this->db
		->where('id_transaction', $id_transaction)
		->where('id_shop', $id_shop)
		->limit(1)
		->get('transaction_history_seller');
	}

	/* DETAIL TRANSAKSI (FOR MODAL EXCEED DELIVERY IN ACCOUNT) */
}
?>