<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Blogs extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_blog', $data);
			return $this->db->insert_id();
		}
		
		public function reg_insert_cat($data) {
			$this->db->insert('bz_blog_cat', $data);
			return $this->db->insert_id();
		}
		
		public function reg_insert_comment($data) {
			$this->db->insert('bz_blog_comment', $data);
			return $this->db->insert_id();
		}
		
		public function check_by_slug($slug) {
			$query = $this->db->get_where('bz_blog', array('slug' => $slug));
			return $query->num_rows();
		}
		
		public function check_exist($slug) {
			$query = $this->db->get_where('bz_blog', array('slug' => $slug));
			return $query->num_rows();
		}
		
		public function check_exist_cat($slug) {
			$query = $this->db->get_where('bz_blog_cat', array('slug' => $slug));
			return $query->num_rows();
		}
		
		public function check_user($email, $pass) {
			$query = $this->db->get_where('bz_user', array('email' => $email, 'password' => $pass));
			return $query->num_rows();
		}
		
		public function query_blog() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_blog');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_slug($data) {
			$query = $this->db->where('slug', $data);
			$query = $this->db->get('bz_blog');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_blog');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_cat() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_blog_cat');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_cat_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_blog_cat');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_comment() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('bz_blog_comment');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_blog_comment_id($data) {
			$query = $this->db->where('id', $data);
			$query = $this->db->get('bz_blog_comment');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function update_blog($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_blog', $data);
			return $this->db->affected_rows();	
		}
		
		public function update_blog_cat($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_blog_cat', $data);
			return $this->db->affected_rows();	
		}
		
		public function update_blog_comment($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('bz_blog_comment', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_blog($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_blog');
			return $this->db->affected_rows();
		}
		
		public function delete_blog_cat($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_blog_cat');
			return $this->db->affected_rows();
		}
		
		public function delete_blog_comment($id) {
			$this->db->where('id', $id);
			$this->db->delete('bz_blog_comment');
			return $this->db->affected_rows();
		}
	}