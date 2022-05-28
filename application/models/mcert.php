<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mcert extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_cert', $data);
			return $this->db->insert_id();
		}
		
		public function check_by_cat($cat) {
			$query = $this->db->get_where('bz_cert', array('cat' => $cat));
			return $query->num_rows();
		}
		
		public function query_cert() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_cert');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_cert_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_cert');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_check_cert_name($data,$name) {
			$query = $this->db->where('sch_id', $data);
			$query = $this->db->where('name', $name);
			$query = $this->db->get('bz_cert');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_check_cert_matric($data,$matric) {
			$query = $this->db->where('sch_id', $data);
			$query = $this->db->where('matric', $matric);
			$query = $this->db->get('bz_cert');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function update_cert($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_cert', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_cert($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_cert');
			return $this->db->affected_rows();
		}
	}