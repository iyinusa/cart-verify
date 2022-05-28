<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->model('mschool'); //load MODEL
		$this->load->model('mcert'); //load MODEL
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
		if($_POST){
			$sch = $_POST['sch'];
			$name = $_POST['name'];
			
			//get school name
			$gets = $this->mschool->query_school_id($sch);
			if(!empty($gets)){
				foreach($gets as $s){
					$school = $s->name;	
				}
			} else {
				$school = 'Removed';	
			}
			
			$qname = $this->mcert->query_check_cert_name($sch, $name);
			$qmatric = $this->mcert->query_check_cert_matric($sch, $name);
			
			if(!empty($qname) || !empty($qmatric)){
				if(empty($qmatric)){
					$query = $this->mcert->query_check_cert_name($sch, $name);
				} else {
					$query = $this->mcert->query_check_cert_matric($sch, $name);
				}
				
				foreach($query as $item){
					$data['err_msg'] = '
						<div class="alert alert-success">
							<h3><u>Certificate Verified!</u></h3>
							<b>School:</b> '.$school.'<br />
							<b>Name:</b> '.$item->name.'<br />
							<b>Matric No.:</b> '.$item->matric.'<br />
							<b>Department:</b> '.$item->dept.'<br />
							<b>Year Admitted:</b> '.$item->admit.'<br />
							<b>Year Graduated:</b> '.$item->graduate.'<br />
							<b>CGPA:</b> '.$item->gp.'<br />
						</div>
					';
				}
			} else {
				$data['err_msg'] = '<div class="alert alert-danger">Certificate is subject to fake</div>';	
			}
		}
		
		$data['allsch'] = $this->mschool->query_school();
	  
	  	$data['title'] = 'Certificate Verification';

	  	$this->load->view('designs/hm_header', $data);
	  	$this->load->view('check', $data);
	  	$this->load->view('designs/hm_footer', $data);
	}
}