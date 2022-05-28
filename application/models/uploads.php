<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Uploads extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_uploads', $data);
			return $this->db->insert_id();
		}
		
		public function check_by_cat($cat) {
			$query = $this->db->get_where('bz_uploads', array('cat' => $cat));
			return $query->num_rows();
		}
		
		public function query_upload() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_uploads');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_upload_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_uploads');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_upload_cat($data) {
			$query = $this->db->get_where('bz_uploads', array('cat' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function update_upload($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_uploads', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_upload($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_uploads');
			return $this->db->affected_rows();
		}
	}