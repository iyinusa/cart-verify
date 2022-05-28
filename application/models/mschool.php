<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mschool extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_school', $data);
			return $this->db->insert_id();
		}
		
		public function query_school() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_school');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_school_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_school');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function update_school($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_school', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_school($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_school');
			return $this->db->affected_rows();
		}
	}