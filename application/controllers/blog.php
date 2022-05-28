<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->model('blogs'); //load MODEL
		$this->load->helper('text'); //for content limiter
		$this->load->library('form_validation'); //load form validate rules
		$this->load->library('image_lib'); //load image library
		
		//mail config settings
		$this->load->library('email'); //load email library
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);
    }
	
	public function index() {
		//query uploads
		$data['allblog'] = $this->blogs->query_blog();
		
		//get recent posts
		$data['h_allblog'] = $this->blogs->query_blog();
		
		//check for view
		$get_v = $this->input->get('v');
		if($get_v != ''){
			$query = $this->blogs->query_blog_slug($get_v);
			$data['view'] = 1;
			
			if(!empty($query)){
				foreach($query as $single){
					$data['id'] = $single->id;
					$data['post_id'] = $single->post_id;
					$data['cat_id'] = $single->cat_id;
					$data['post_date'] = $single->post_date;
					$data['blog_title'] = $single->title;
					$data['slug'] = $single->slug;
					$data['details'] = $single->details;
					$data['pics'] = $single->pics;
					$data['views'] = $single->views;
					
					//get category
					$gc = $this->blogs->query_blog_cat_id($single->cat_id);
					if(!empty($gc)){
						foreach($gc as $citem){
							$data['scat'] = $citem->cat;	
						}
					}
					
					$new_view = $single->views + 1;
					
					//update view
					$upd_data = array(
						'views' => $new_view
					);
					
					if($this->blogs->update_blog($single->id, $upd_data) > 0){}
				}
			}
		} else {$data['view'] = 0;}
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Manage Blog | Brandszevous';
		$data['page_act'] = 'blog';

	  	$this->load->view('designs/hm_header', $data);
	  	$this->load->view('blog/blog', $data);
	  	$this->load->view('designs/hm_footer', $data);
	}
	
	public function add() {
		if($this->session->userdata('logged_in')==FALSE){ 
			redirect(base_url().'login/', 'location');
		}
		
		//query blog categories
		$data['allcat'] = $this->blogs->query_blog_cat();
		
		$log_user_id = $this->session->userdata('log_user_id');
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->blogs->query_blog_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_post_id'] = $item->post_id;
				$data['e_cat_id'] = $item->cat_id;
				$data['e_post_date'] = $item->post_date;
				$data['e_title'] = $item->title;
				$data['e_slug'] = $item->slug;
				$data['e_details'] = $item->details;
				$data['e_pics'] = $item->pics;
				$data['e_pics_small'] = $item->pics_small;
				$data['e_pics_square'] = $item->pics_square;
				$data['e_views'] = $item->views;	
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->blogs->delete_blog($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('cat','Category','trim|required|xss_clean');
		$this->form_validation->set_rules('title','Title','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$blog_id = $_POST['blog_id'];
				$cat = $_POST['cat'];
				$title = $_POST['title'];
				$details = $_POST['details'];
				$pics = $_POST['pics'];
				$pics_small = $_POST['pics_small'];
				$pics_square = $_POST['pics_square'];
				$stamp = time();
				$save_path = '';
				$save_path400 = '';
				$save_path100 = '';
				
				//===get nicename and convert to seo friendly====
				$slug = strtolower($title);
				$slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
				$slug = preg_replace("/[\s-]+/", " ", $slug);
				$slug = preg_replace("/[\s_]/", "-", $slug);
				//================================================
				
				if(isset($_FILES['up_file']['name'])){
					$path = 'img/blogs';
					 
					if (!is_dir($path))
						mkdir($path, 0755);
	 
					$pathMain = './img/blogs';
					if (!is_dir($pathMain))
						mkdir($pathMain, 0755);
	 
					$result = $this->do_upload("up_file", $pathMain);
	 
					if (!$result['status']){
						$data['err_msg'] ='<div class="alert alert-info"><h5>Can not upload Image, try another</h5></div>';
					} else {
						$save_path = $path . '/' . $result['upload_data']['file_name'];
						
						//if size not up to 400px above
						if($result['image_width'] >= 400){
							if($result['image_width'] >= 400 || $result['image_height'] >= 400) {
								if($this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $stamp .'-400.gif','400','400', $result['image_width'], $result['image_height'])){
									$resize400 = $pathMain . '/' . $stamp.'-400.gif';
									$resize400_dest = $resize400;
									
									if($this->crop_image($resize400, $resize400_dest,'400','220')){
										$save_path400 = $path . '/' . $stamp .'-400.gif';
									}
								}
							}
								
							if($result['image_width'] >= 200 || $result['image_height'] >= 200){
								if($this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $stamp .'-150.gif','200','200', $result['image_width'], $result['image_height'])){
									$resize100 = $pathMain . '/' . $stamp.'-150.gif';
									$resize100_dest = $resize100;	
									
									if($this->crop_image($resize100, $resize100_dest,'150','150')){
										$save_path100 = $path . '/' . $stamp .'-150.gif';
									}
								}
							}
							
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>Must be at least 400px in Width</h5></div>';
						}
					}
				}
				
				//check if images loads
				if($pics && $pics_small && $pics_square){
					$save_path = $pics;
					$save_path400 = $pics_small;
					$save_path100 = $pics_square;
				}
				
				//prepare insert record
				if($save_path=='' && $save_path400=='' && $save_path100==''){
					if($blog_id != ''){
						$upd_data = array(
							'post_id' => $log_user_id,
							'cat_id' => $cat,
							'title' => $title,
							'slug' => $slug,
							'details' => $details
						);
						
						if($this->blogs->update_blog($blog_id, $upd_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
						}
					}
				} else {
					//check for update
					if($blog_id != ''){
						$upd_data = array(
							'post_id' => $log_user_id,
							'cat_id' => $cat,
							'title' => $title,
							'slug' => $slug,
							'details' => $details,
							'pics' => $save_path,
							'pics_small' => $save_path400,
							'pics_square' => $save_path100
						);
						
						if($this->blogs->update_blog($blog_id, $upd_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
						}
					} else {
						$reg_data = array(
							'post_id' => $log_user_id,
							'cat_id' => $cat,
							'title' => $title,
							'slug' => $slug,
							'details' => $details,
							'pics' => $save_path,
							'pics_small' => $save_path400,
							'pics_square' => $save_path100,
							'post_date' => date('j M Y H:ma')
						);
						
						if($this->blogs->reg_insert($reg_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
						}
					}
				}
			}
		}
		
		//query uploads
		$data['allblog'] = $this->blogs->query_blog();
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Manage Blog | Brandszevous';
		$data['page_act'] = 'blog';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('blog/add', $data);
	  	$this->load->view('designs/footer', $data);
	}
	
	public function category() {
		if($this->session->userdata('logged_in')==FALSE){ 
			redirect(base_url().'login/', 'location');
		}
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->blogs->query_blog_cat_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_cat'] = $item->cat;
				$data['e_slug'] = $item->slug;	
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->blogs->delete_blog_cat($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('cat','Category','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$cat_id = $_POST['cat_id'];
				$cat = $_POST['cat'];
				
				//===get nicename and convert to seo friendly====
				$slug = strtolower($cat);
				$slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
				$slug = preg_replace("/[\s-]+/", " ", $slug);
				$slug = preg_replace("/[\s_]/", "-", $slug);
				//================================================
				
				//check for update
				if($cat_id != ''){
					$upd_data = array(
						'cat' => $cat,
						'slug' => $slug
					);
					
					if($this->blogs->update_blog_cat($cat_id, $upd_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
					}
				} else {
					$reg_data = array(
						'cat' => $cat,
						'slug' => $slug
					);
					
					if($this->blogs->reg_insert_cat($reg_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
					}
				}
			}
		}
		
		//query records
		$data['allcat'] = $this->blogs->query_blog_cat();
	  
	  	$data['log_username'] = $this->session->userdata('log_username');
		$data['title'] = 'Manage Blog Category | Brandszevous';
		$data['page_act'] = 'blog';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('blog/category', $data);
	  	$this->load->view('designs/footer', $data);
	}
	
	function do_upload($htmlFieldName, $path)
    {
        $config['file_name'] = time();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|tif';
        $config['max_size'] = '10000';
        $config['max_width'] = '6000';
        $config['max_height'] = '6000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        unset($config);
        if (!$this->upload->do_upload($htmlFieldName))
        {
            return array('error' => $this->upload->display_errors(), 'status' => 0);
        } else
        {
            $up_data = $this->upload->data();
			return array('status' => 1, 'upload_data' => $this->upload->data(), 'image_width' => $up_data['image_width'], 'image_height' => $up_data['image_height']);
        }
    }
	
	function resize_image($sourcePath, $desPath, $width = '500', $height = '500', $real_width, $real_height)
    {
        $this->image_lib->clear();
		$config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
		$config['width'] = $width;
        $config['height'] = $height;
		
		$dim = (intval($real_width) / intval($real_height)) - ($config['width'] / $config['height']);
		$config['master_dim'] = ($dim > 0)? "height" : "width";
		
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->resize())
            return true;
        return false;
    }
	
	function crop_image($sourcePath, $desPath, $width = '320', $height = '320')
    {
        $this->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
		$config['x_axis'] = '20';
		$config['y_axis'] = '20';
        
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->crop())
            return true;
        return false;
    }
}