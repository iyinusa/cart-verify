<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_user', $data);
			return $this->db->insert_id();
		}
		
		public function query_user() {
			$query = $this->db->order_by('user_id', 'desc');
			$query = $this->db->get('bz_user');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_by_username($user) {
			$query = $this->db->get_where('bz_user', array('username' => $user));
			return $query->num_rows();
		}
		
		public function check_by_email($email) {
			$query = $this->db->get_where('bz_user', array('email' => $email));
			return $query->num_rows();
		}
		
		public function check_user($email, $pass) {
			$query = $this->db->get_where('bz_user', array('email' => $email, 'password' => $pass));
			return $query->num_rows();
		}
		
		public function check_auth($user, $pass) {
			$query = $this->db->query("SELECT * FROM bz_user WHERE (username='$user' OR email='$user') AND password='$pass' LIMIT 1");
			if($query->num_rows() > 0) {
				return $query->result();
			}	
		}
		
		public function check_activation($stamp, $email) {
			$query = $this->db->get_where('bz_user', array('regstamp' => $stamp, 'email' => $email));
			return $query->num_rows();	
		}
		
		public function query_user_id($data) {
			$query = $this->db->where('user_id', $data);
			$query = $this->db->get('bz_user');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function activate($email, $data) {
			$this->db->where('email', $email);
			$this->db->update('bz_user', $data);
			return $this->db->affected_rows();	
		}
		
		public function update_user($id, $data) {
			$this->db->where('user_id', $id);
			$this->db->update('bz_user', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_user($id) {
			$this->db->where('user_id', $id);
			$this->db->delete('bz_user');
			return $this->db->affected_rows();
		}
	}