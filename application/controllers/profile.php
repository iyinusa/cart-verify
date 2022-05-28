<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->library('form_validation'); //load form validate rules
		
		//mail config settings
		$this->load->library('email'); //load email library
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);
    }
	
	public function index() {

		if($this->session->userdata('logged_in')==FALSE){ 
			redirect(base_url().'login/', 'location');
		}
		
		$log_user_id = $this->session->userdata('log_user_id');
		$log_username = $this->session->userdata('log_username');
		
		//set form input rules 
		$this->form_validation->set_rules('old','Old password','trim|required|min_length[4]|max_length[32]|xss_clean|md5');
		$this->form_validation->set_rules('new','New password','trim|required|min_length[4]|max_length[32]|xss_clean|md5');
		$this->form_validation->set_rules('confirm','Confirm password','trim|required|matches[new]|xss_clean');
		
		//error delimeter
		$this->form_validation->set_error_delimiters('<h5 id="pass-info" class="alert alert-info">', '</h5>');
		
		if ($this->form_validation->run() == FALSE){
			$data['err_msg'] = '';
		} else {
			//check if ready for post
			if($_POST) {
				$old = $_POST['old'];
				$new = $_POST['new'];
				$confirm = $_POST['confirm'];
				
				if($this->user->check_auth($log_username, $old) <= 0) {
					$data['err_msg'] = '<h5 class="alert alert-danger">Password not associated to your account</h5>';		
				} else {
					$update_data = array(
						'password' => $new
					);
					
					if($this->user->update_user($log_user_id, $update_data) > 0){
						$data['err_msg'] = '<h5 class="alert alert-info">Password changed successfully</h5>';
					} else {
						$data['err_msg'] = '<h5 class="alert alert-info">There is problem this time. Try later</h5>';
					}
				}
			}
		}
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Profile | Certificate Verification';
		$data['page_act'] = 'dashboard';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('profile', $data);
	  	$this->load->view('designs/footer', $data);
	}
}