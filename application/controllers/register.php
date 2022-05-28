<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->library('form_validation'); //load form validate rules
		$this->load->helper('captcha'); //load CAPTCHA library
		
		//mail config settings
		$this->load->library('email'); //load email library
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);
    }
	
	public function index() {
		if($this->session->userdata('logged_in') == TRUE){ 
			redirect(base_url(), 'location');
		}
		
		if ( ! file_exists(APPPATH.'views/login.php')) {
		  	// Whoops, we don't have a page for that!
		  	show_404();
	  	}
		
		//set form input rules 
		$this->form_validation->set_rules('username','User name','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]|xss_clean|md5');
		$this->form_validation->set_rules('confirm','Confirm Password','trim|required|matches[password]|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST) {
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$role = 'Member';
				//===get nicename and convert to seo friendly====
				$nicename = strtolower($username);
				$nicename = preg_replace("/[^a-z0-9_\s-]/", "", $nicename);
				$nicename = preg_replace("/[\s-]+/", " ", $nicename);
				$nicename = preg_replace("/[\s_]/", "-", $nicename);
				//================================================
				
				if($this->user->check_by_email($email) > 0 || $this->user->check_by_username($username) > 0) {
					$data['err_msg'] = '<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>Member already exist with this username or email address</div>';
				} else {
					$time = time();
					$now = date("Y-m-d H:i:s");
					
					$reg_data = array(
						'username' => $nicename,
						'email' => $email,
						'password' => $password,
						'role' => $role,
						'reg_date' => $now,
						'regstamp' => $time,
						'activate' => 0,
						'status' => 0
					);
					
					//email notification processing
					$this->email->clear(); //clear initial email variables
					$this->email->to($email);
					$this->email->from('ceo@tehilahbase.com','BaseRANT');
					$this->email->subject('Activate Email Address');
					
					//compose html body of mail
					$mail_stamp = $time;
					$mail_subhead = 'Email Activation';
					$body_msg = '
						Thanks for registering on BaseRANT.<br /><br />
						Kindly <a href="'.base_url().'activate?stamp='.$mail_stamp.'&amp;email='.$email.'">Activate your email address</a><br /><br />Thanks
					';
					
					$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
					$this->email->set_mailtype("html"); //use HTML format
					$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
 
					$this->email->message($mail_design);
					
					if($this->email->send()) {
						$data['err_msg'] = '<div class="alert alert-success no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>Please activate your Email Address to complete registration. Click on link sent to '.$email.' (NB: Check SPAM if not in INBOX)</div>';
												
						$this->user->reg_insert($reg_data); //save records in database
						
						/////////////////////////////////////////////////////////////////////////////////////
						//send notification mail to admin
						$this->email->clear(); //clear initial email variables
						$this->email->to('ceo@tehilahbase.com');
						$this->email->from($email,'BaseRANT');
						$this->email->subject('New Member');
						
						//compose html body of mail
						$mail_stamp = $time;
						$mail_subhead = 'New Account Creation';
						$body_msg = '
							This is to notify you that BaseRANT now has new member.<br /><br />
							Check <a href="'.base_url().'member/'.$nicename.'">'.$name.'</a> Profile<br /><br />Thanks
						';
						
						$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
						$this->email->set_mailtype("html"); //use HTML format
						$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
	 
						$this->email->message($mail_design);
						
						if($this->email->send()) {}						
					} else {
						$data['err_msg'] = '<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>Problem sending email this time. You will need to try again with valid Email Address.</div>';
					}
					
					//$this->user->reg_insert($reg_data);
				}
			}
		}
		
		$data['title'] = 'Create Account for Result Verification';

	  	$this->load->view('designs/hm_header', $data);
	  	$this->load->view('register', $data);
	  	$this->load->view('designs/hm_footer', $data);
	}
}