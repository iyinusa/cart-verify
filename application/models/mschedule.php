<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mschedule extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_schedule', $data);
			return $this->db->insert_id();
		}
		
		public function query_schedule() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_schedule');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_schedule_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_schedule');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_schedule_user($data) {
			$query = $this->db->where('user_id', $data);
			$query = $this->db->get('bz_schedule');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function update_schedule($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_schedule', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_schedule($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_schedule');
			return $this->db->affected_rows();
		}
	}