<?php
class M_transaction_history_seller extends CI_Model{

	function insert($data) {

		if($this->db->insert("transaction_history_seller", $data)){
			return true;
		}

		return false;
	}

	function delete($id,$id2){
		if($this->db->delete('transaction_history_seller', array('id_transaction' => $id, 'id_shop' => $id2))){
			return true;
		}
		return false;
	}

	function datapembelianuser($id){
		return $this->db->query("SELECT transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, transaction_history.cart FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history.id_user = ".$id." GROUP BY transaction_history.id_transaction ORDER BY transaction_history.id_transaction DESC");
	}

	function getall(){
		return $this->db->query("SELECT transaction_history.totalprice, transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, DATE_FORMAT(transaction_history_seller.date_delivered, '%e - %M - %Y') as date_delivered, DATE_FORMAT(transaction_history.date, '%e - %M - %Y') as date_ordered, transaction_history.id_user, transaction_history_seller.warning, transaction_history.cart FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction GROUP BY transaction_history.id_transaction");
	}

	function checkdeadline(){
		return $this->db->query("SELECT transaction_history.totalprice, transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, DATE_FORMAT(transaction_history_seller.date_delivered, '%e - %M - %Y') as date_delivered, DATE_FORMAT(transaction_history.date, '%e - %M - %Y') as date_ordered, transaction_history.id_user, transaction_history_seller.warning, transaction_history.cart FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction GROUP BY transaction_history.id_transaction");
	}

	function checkdeadlineforseller($id){
		return $this->db->query("SELECT transaction_history_seller.id_transaction, transaction_history_seller.id_shop, transaction_history_seller.totalongkir, transaction_history_seller.totalqty, transaction_history_seller.kurir, transaction_history_seller.jenis_paket, transaction_history_seller.resi, transaction_history_seller.status, transaction_history_seller.totalharga, transaction_history_seller.totalongkir, DATE_FORMAT(transaction_history_seller.date_delivered, '%Y-%m-%d') as date_delivered, DATE_FORMAT(transaction_history.date, '%Y-%m-%d') as date_ordered, transaction_history.id_user, transaction_history_seller.warning, transaction_history.id_address FROM transaction_history_seller JOIN transaction_history ON transaction_history_seller.id_transaction = transaction_history.id_transaction WHERE transaction_history_seller.id_shop = '".$id."'");
	}

	


	function select($kondisi,$id){
		$this->db->select("transaction_history_seller.*, transaction_history.id_address");
		$this->db->from("transaction_history_seller");
		$this->db->join('transaction_history','id_transaction');
		$this->db->where("transaction_history_seller.id_".$kondisi,$id);
		// $this->db->limit(3);  
		return $this->db->get();
	}

	function select2($kondisi,$kondisi2,$id,$id2){
		$this->db->select("*");
		$this->db->from("transaction_history_seller");
		$this->db->where("id_".$kondisi,$id);
		$this->db->where("id_".$kondisi2,$id2);

		return $this->db->get();
	}

	function edit($data, $id, $id2){
		$this->db->set($data);
		$this->db->where('id_transaction', $id);
		
		if(!empty($id2)){
			$this->db->where('id_shop', $id2);
		}
		
		if($this->db->update('transaction_history_seller')){

			return true;
		}
		return false;
	}


}
?>