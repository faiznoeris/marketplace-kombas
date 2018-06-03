<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Index_Dashboard extends CI_Model{

	/* EDIT PROFILE */
	function get_admin($id_admin){
		return $this->db
		->where('id_admin', $id_admin)
		->limit(1)
		->get('admins');
	}
	/* EDIT PROFILE */

	function data_admin_sellerhistory($id_transaction, $id_shop){
		$this->db->select("*");
		$this->db->from("transaction_history_seller");
		$this->db->where("id_transaction",$id_transaction);
		$this->db->where("id_shop",$id_shop);
		return $this->db->get();
	}

	function data_admin_sellerhistorynoshop($id_transaction){
		$this->db->select("*");
		$this->db->from("transaction_history_seller");
		$this->db->where("id_transaction",$id_transaction);
		return $this->db->get();
	}

	function data_admin_historydetail($id_transaction){
		$this->db->select("*");
		$this->db->from("transaction_history");
		$this->db->where("transaction_history.id_transaction",$id_transaction);

		return $this->db->get();
	}

	function data_confirmation($id_transaction, $id_user){
		$this->db->select("*");
		$this->db->from("confirmation");		
		$this->db->where("id_transaction",$id_transaction);
		$this->db->where("id_user",$id_user);

		return $this->db->get();
	}

	// **** //

	function get_bank($id_bank){
		return $this->db
		->where('id_bank', $id_bank)
		->get('banks');
	}

	function get_allusers(){
		$this->db->select("*, user_level.name as tipeuser");
		$this->db->from("users");
		$this->db->join("user_level","user_level.id_userlevel = users.id_userlevel");

		return $this->db->get();
	}

	function get_sellerpending(){
		$this->db->select("*,DATE_FORMAT(pending_approval.date, '%d - %M - %Y') as date2");
		$this->db->from("pending_approval");
		$this->db->join('users', 'pending_approval.id_user = users.id_user');
		$this->db->where("pending_approval.type", 'seller');
		$this->db->where("type", 'seller');
		
		return $this->db->get();
	}

	function get_resellerpending(){
		$this->db->select("*,DATE_FORMAT(pending_approval.date, '%d - %M - %Y') as date2");
		$this->db->from("pending_approval");
		$this->db->join('users', 'pending_approval.id_user = users.id_user');
		$this->db->where("pending_approval.type", 'reseller');
		$this->db->where("type", 'reseller');

		return $this->db->get();
	}

	function get_exceed(){
		return $this->db->query("SELECT *, DATE_FORMAT(transaction_history.date, '%e - %M - %Y') as date_ordered FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history_seller.warning = '0'");
	}

	function get_transaction(){
		return $this->db->query("SELECT *, DATE_FORMAT(transaction_history.date, '%e - %M - %Y') as date_ordered FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction GROUP BY transaction_history.id_transaction");
	}

	function get_transactioncancelled_all(){
		return $this->db
		->get('transaction_cancelled');
	}

	function get_allwithdrawal(){
		return $this->db
		->get('withdrawal');
	}

	function counttopcategories(){
		return $this->db
		->query("SELECT products.views, category.nama_category FROM products JOIN category ON category.id_category = products.id_category ORDER BY category.nama_category DESC");
	}

	function latesttransaction(){
		return $this->db
		->select('*, user_level.name as nama_userlevel')
		->join('users', 'users.id_user = transaction_history.id_user')
		->join('user_level', 'user_level.id_userlevel = users.id_userlevel')
		->order_by('date', 'DESC')
		->limit(5)
		->get('transaction_history');
	}
}
?>