<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cert extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->model('mschool'); //load MODEL
		$this->load->model('mcert'); //load MODEL
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
		if($this->session->userdata('logged_in')==FALSE){ 
			redirect(base_url().'login/', 'location');
		}
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->mcert->query_cert_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_sch_id'] = $item->sch_id;
				$data['e_name'] = $item->name;
				$data['e_matric'] = $item->matric;
				$data['e_dept'] = $item->dept;
				$data['e_admit'] = $item->admit;	
				$data['e_graduate'] = $item->graduate;
				$data['e_gp'] = $item->gp;
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->mcert->delete_cert($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//check if ready for post
		if($_POST){
			$cert_id = $_POST['cert_id'];
			$sch_id = $_POST['sch_id'];
			$name = $_POST['name'];
			$matric = $_POST['matric'];
			$dept = $_POST['dept'];
			$admit = $_POST['admit'];
			$graduate = $_POST['graduate'];
			$gp = $_POST['gp'];
			
			//check for update
			if($cert_id != ''){
				$upd_data = array(
					'sch_id' => $sch_id,
					'name' => $name,
					'matric' => $matric,
					'dept' => $dept,
					'admit' => $admit,
					'graduate' => $graduate,
					'gp' => $gp
				);
				
				if($this->mcert->update_cert($cert_id, $upd_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
				}
			} else {
				$reg_data = array(
					'sch_id' => $sch_id,
					'name' => $name,
					'matric' => $matric,
					'dept' => $dept,
					'admit' => $admit,
					'graduate' => $graduate,
					'gp' => $gp
				);
				
				if($this->mcert->reg_insert($reg_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
				}
			}
		}
		
		$data['allsch'] = $this->mschool->query_school();
		$data['allup'] = $this->mcert->query_cert();
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Certificate | Certificate Verification';
		$data['page_act'] = 'schedule';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('cert', $data);
	  	$this->load->view('designs/footer', $data);
	}
}