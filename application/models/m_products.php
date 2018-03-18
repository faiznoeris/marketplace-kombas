<?php
class m_products extends CI_Model{

	public $prod_lastId = "";

	function setProdLastId($id){
		$this->prod_lastId = $id;
	}

	function getProdLastId(){
		return $this->prod_lastId;
	}


	function search($keyword){
		return $this->db->query('Select * from products where nama_product like "%'.$keyword.'%"');
	}


	function updatesampulpath($path,$id){
		$this->db->set('sampul_path',$path);
		$this->db->where('id_product', $id);
		if($this->db->update('products')){
			return true;
		}
		return false;
	}


	function updategaleripath($path,$id){
		$this->db->set('galeri_path',$path);
		$this->db->where('id_product', $id);
		if($this->db->update('products')){
			return true;
		}
		return false;
	}


	function delete($id_product){
		if($this->db->delete('products', array('id_product' => $id_product))){
			return true;
		}
		return false;
	}

	function edit($data,$id){
		foreach ($data as $key => $value) {
			if($value != ""){
				$this->db->set($key, $value);
			}
		}
		$this->db->where('id_product', $id);
		if($this->db->update('products')){
			return true;
		}
		return false;
	}


	function related_prod($category){
		return $this->db->query("
			SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
			FROM products
			WHERE id_category = '".$category."' 
			GROUP BY id_product
			ORDER BY seminggu DESC
			LIMIT 3
			");
	}

	function topviews(){
		return $this->db->query("
			SELECT *
			FROM products
			GROUP BY id_product
			ORDER BY views DESC
			LIMIT 9
			");
	}

	function topviewspromo(){
		return $this->db->query("
			SELECT *
			FROM products
            WHERE promo_aktif = '1'
			GROUP BY id_product
			ORDER BY views DESC
			LIMIT 6
			");
	}


	public function fetch_topweekly($limit, $start, $id) {
		$this->db->select("*, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu");
		$this->db->from("products");

		if(!empty($id)){
			$this->db->where('id_category',$id);
		}

		$this->db->group_by('id_product');
		$this->db->order_by('seminggu', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function topweekly($id){
		if(!empty($id)){
			return $this->db->query("
				SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
				FROM products
				WHERE id_category = '".$id."' 
				GROUP BY id_product
				ORDER BY seminggu DESC
				");
		}else{
			return $this->db->query("
				SELECT *, (SUM(sunday)+SUM(monday)+SUM(tuesday)+SUM(wednesday)+SUM(thursday)+SUM(friday)+SUM(saturday)) AS seminggu
				FROM products
				GROUP BY id_product
				ORDER BY seminggu DESC
				LIMIT 12
				");
		}
	}


	function getproduct($id){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("id_product",$id);

		return $this->db->get();
	}

	function get($id){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("id_shop",$id);

		return $this->db->get();
	}

	// function select($id_user) {
	function select(){
		$this->db->select("*");
		$this->db->from("products");
		// $this->db->where("id_user",$id_user);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("products", $data)){
			$insert_id = $this->db->insert_id();
			$this->setProdLastId($insert_id);
			return true;
		}

		return false;
	}
}
?>