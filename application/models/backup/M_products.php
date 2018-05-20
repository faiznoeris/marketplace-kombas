<?php
class M_products extends CI_Model{

	public $prod_lastId = "";

	function setProdLastId($id){
		$this->prod_lastId = $id;
	}

	function getProdLastId(){
		return $this->prod_lastId;
	}


	function search($keyword){
		return $this->db->query('Select *,0 as bintang from products where nama_product like "%'.$keyword.'%"');
	}

	function search_cat($keyword, $cat){
		return $this->db->query('Select *,0 as bintang from products where nama_product like "%'.$keyword.'%" AND id_category = "'.$cat.'"');
	}

	function search_rat($keyword, $rat){
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%"';
		return $this->db->query($sql);
		// return $sql;
	}

	function search_cat_rat($keyword, $cat, $rat){
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'"';
		return $this->db->query($sql);
		// return $sql;
	}


	public function fetch_search($limit, $start, $keyword) {
		$sql = 'select *,0 as bintang from products where nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function fetch_search_cat($limit, $start, $keyword, $cat) {
		$sql = 'select *,0 as bintang from products where nama_product like "%'.$keyword.'%" AND id_category = "'.$cat.'" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function fetch_search_rat($limit, $start, $keyword, $rat) {
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		
		// $sql = 'SELECT * FROM products LEFT JOIN (SELECT id_product, COUNT(bintang_satu) as bintang1, null as bintang2, null as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_satu = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product, null bintang1, COUNT(bintang_dua) as bintang2, null as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_dua = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product, null bintang1, null as bintang3, COUNT(bintang_empat) as bintang3, null as bintang4, null as bintang5 FROM reviews WHERE bintang_tiga = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product,  null bintang1, null as bintang3, null as bintang3, COUNT(bintang_empat) as bintang4, null as bintang5  FROM reviews WHERE bintang_empat = 1 GROUP BY id_product
		// UNION ALL
		// SELECT id_product,  null bintang1, null as bintang3, null as bintang3, null as bintang4, COUNT(bintang_lima) as bintang5  FROM reviews WHERE bintang_lima = 1 GROUP BY id_product) reviews ON reviews.id_product = products.id_product WHERE products.nama_product like "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;

		// $sql = 'SELECT * FROM products WHERE products.nama_product LIKE "%'.$keyword.'%" LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}



	public function fetch_search_cat_rat($limit, $start, $keyword, $cat, $rat) {
		$case = "";

		$rat = explode(",", $rat);

		foreach ($rat as $key => $value) {
			if(empty($value)){
				unset($rat[$key]);
			}
		}

		if(sizeof($rat) > 1){
			foreach ($rat as $rating) {
				if($rating == 1){
					$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
				}else if($rating == 2){
					$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
				}else if($rating == 3){
					$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
				}else if($rating == 4){
					$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
				}else if($rating == 5){
					$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
				}

			}
		}else{
			if($rat[0] == 1){
				$case .= " WHEN reviews.bintang_satu > reviews.bintang_dua AND reviews.bintang_satu > reviews.bintang_tiga AND reviews.bintang_satu > reviews.bintang_empat AND reviews.bintang_satu > reviews.bintang_lima THEN reviews.bintang_satu ";
			}else if($rat[0] == 2){
				$case .= " WHEN reviews.bintang_dua > reviews.bintang_satu AND reviews.bintang_dua > reviews.bintang_tiga AND reviews.bintang_dua > reviews.bintang_empat AND reviews.bintang_dua > reviews.bintang_lima THEN reviews.bintang_dua ";
			}else if($rat[0] == 3){
				$case .= " WHEN reviews.bintang_tiga > reviews.bintang_satu AND reviews.bintang_tiga > reviews.bintang_dua AND reviews.bintang_tiga > reviews.bintang_empat AND reviews.bintang_tiga > reviews.bintang_lima THEN reviews.bintang_tiga ";
			}else if($rat[0] == 4){
				$case .= " WHEN reviews.bintang_empat > reviews.bintang_satu AND reviews.bintang_empat > reviews.bintang_dua AND reviews.bintang_empat > reviews.bintang_tiga AND reviews.bintang_empat > reviews.bintang_lima THEN reviews.bintang_empat ";
			}else if($rat[0] == 5){
				$case .= " WHEN reviews.bintang_lima > reviews.bintang_satu AND reviews.bintang_lima > reviews.bintang_dua AND reviews.bintang_lima > reviews.bintang_tiga AND reviews.bintang_lima > reviews.bintang_empat THEN reviews.bintang_lima ";
			}
		}

		$sql = 'SELECT (CASE
		'.$case.'
		END) 
		as bintang, products.* 
		FROM reviews LEFT JOIN products ON products.id_product = reviews.id_product where products.nama_product like "%'.$keyword.'%" AND products.id_category = "'.$cat.'"  LIMIT '.$limit.' OFFSET '.$start;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
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
			LIMIT 4
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
				");
		}
	}


	function getproduct($id){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("id_product",$id);

		return $this->db->get();
	}

	function getproduct_name($name){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where("nama_product",$name);

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