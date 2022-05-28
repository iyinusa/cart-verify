<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->helper('text'); //for content limiter
		$this->load->helper('cookie');
    }
	
	public function index()
	{
		if ( ! file_exists(APPPATH.'views/logout.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = 'SignOut from Certificate Verification';
		
		$log_user_id = $this->session->userdata('log_user_id');
		
		$status_update = array('status'=>0);
		if($this->user->update_user($log_user_id,$status_update) > 0){
			$newdata = array(
				'log_user_id' => '',
				'log_username' => '',
				'log_email' => '',
				'log_reg_date' => '',
				'log_lastlog' => '',
				'log_status' => '',
				'log_firstname' => '',
				'log_lastname' => '',
				'log_organization_id' => '',
				'log_pics' => '',
				'log_pics_small' => '',
				'log_country' => '',
				'log_bio' => '',
				'log_sex' => '',
				'log_address' => '',
				'log_city' => '',
				'log_dob_day' => '',
				'log_dob_month' => '',
				'log_dob_year' => '',
				'log_phone' => '',
				'log_website' => '',
				'log_fb_page' => '',
				'log_twitter_page' => '',
				'log_linkedin_page' => '',
				'itc_user_role' => '',
				'logged_in' => FALSE
			);
			$this->session->unset_userdata($newdata);
			//unset($this->session->userdata); 
			$this->session->sess_destroy();
			delete_cookie( config_item('sess_cookie_name') ); 
		}
		
		$data['msg'] = '<div class="alert alert-success no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Successfully Signed Out! - Hope to see you soon. <a href="'.base_url().'">CONTINUE</a></div>';
		
		$this->load->view('designs/hm_header', $data);
		$this->load->view('logout', $data);
		$this->load->view('designs/hm_footer', $data);
		//redirect('/', 'refresh');
	}
}