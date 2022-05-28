<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->helper('text'); //for content limiter
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
		
		
		$this->form_validation->set_rules('username','Username/Email','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]|xss_clean|md5');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
		
		if ($this->form_validation->run() == FALSE) {
			$data['err_msg'] = '';
		} else {
			//check if ready for post
			if($_POST) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				if(isset($_POST['remind'])){$remind='';}else{$remind='';}
				
				if($this->user->check_auth($username, $password) <= 0) {
					$data['err_msg'] = '<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Invalid authentication.</div>';		
				} else {
					$query = $this->user->check_auth($username, $password);
					if(!empty($query)) {
						foreach($query as $row) {
							//update status
							$now = date("Y-m-d H:i:s");
							$first_log = $row->lastlog; //to check first time user
							$now = date("Y-m-d H:i:s");
							$status_update = array('status'=>1, 'lastlog'=>$now);
							$this->user->update_user($row->user_id,$status_update);
							
							//add data to session
							$s_data = array (
								'log_user_id' => $row->user_id,
								'log_username' => $row->username,
								'log_email' => $row->email,
								'log_reg_date' => $row->reg_date,
								'log_lastlog' => $row->lastlog,
								'log_status' => $row->status,
								'log_firstname' => $row->firstname,
								'log_lastname' => $row->lastname,
								'log_organization_id' => $row->organization_id,
								'log_pics' => $row->pics,
								'log_pics_small' => $row->pics_small,
								'log_country' => $row->country,
								'log_bio' => $row->bio,
								'log_sex' => $row->sex,
								'log_address' => $row->address,
								'log_city' => $row->city,
								'log_dob_day' => $row->dob_day,
								'log_dob_month' => $row->dob_month,
								'log_dob_year' => $row->dob_year,
								'log_phone' => $row->phone,
								'log_website' => $row->website,
								'log_fb_page' => $row->fb_page,
								'log_twitter_page' => $row->twitter_page,
								'log_linkedin_page' => $row->linkedin_page,
								'itc_user_role' => $row->role,
								'logged_in' => TRUE
							);
						}
						
						$check = $this->session->set_userdata($s_data);
						
						$data['err_msg'] = '<div class="alert alert-success no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Successful! - Thanks for signing in.</div>';
						
						redirect(base_url().'dashboard', 'location');
						
						//if first time logged, push to group page to select group(s)
						//if($first_log==''){
//							redirect(base_url().'setting/profile', 'location');
//						} else {
//							$red_profile = $this->session->userdata('log_username');
//							redirect(base_url().'member/'.$red_profile, 'location');
//						}
					}
				}
			}
		}
	  
	  	$data['title'] = 'SignIn to Certificate Verification';

	  	$this->load->view('designs/hm_header', $data);
	  	$this->load->view('login', $data);
	  	$this->load->view('designs/hm_footer', $data);
	}
}