<?php
class M_reviews extends CI_Model{

	function delete($whatid,$id){
		if($this->db->delete('reviews', array('id_'.$whatid => $id))){
			return true;
		}
		return false;
	}

	function edit($data, $id){
		$this->db->set($data);
		$this->db->where('id_review', $id);
		if($this->db->update('reviews')){
			return true;
		}
		return false;
	}

	function bintang_satu($id){
		return $this->db->query("SELECT COUNT(bintang_satu) as bintang_satu FROM `reviews` WHERE id_product = '".$id."' AND bintang_satu = 1");
	}

	function bintang_dua($id){
		return $this->db->query("SELECT COUNT(bintang_dua) as bintang_dua FROM `reviews` WHERE id_product = '".$id."' AND bintang_dua = 1");
	}

	function bintang_tiga($id){
		return $this->db->query("SELECT COUNT(bintang_tiga) as bintang_tiga FROM `reviews` WHERE id_product = '".$id."' AND bintang_tiga = 1");
	}

	function bintang_empat($id){
		return $this->db->query("SELECT COUNT(bintang_empat) as bintang_empat FROM `reviews` WHERE id_product = '".$id."' AND bintang_empat = 1");
	}

	function bintang_lima($id){
		return $this->db->query("SELECT COUNT(bintang_lima) as bintang_lima FROM `reviews` WHERE id_product = '".$id."' AND bintang_lima = 1");
	}

	public function fetch($limit, $start, $id) {
		$this->db->select("*");
		$this->db->from("reviews");

		if(!empty($id)){
			$this->db->where('id_product',$id);
		}

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

	function select($id){
		$this->db->select("*");
		$this->db->from("reviews");
		$this->db->where("id_product",$id);

		return $this->db->get();
	}

	function insert($data) {

		if($this->db->insert("reviews", $data)){
			return true;
		}

		return false;
	}
}
?>