<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->admin_session_data=$this->session->userdata('admin');
		if(!$this->admin_session_data['user_id']){
			redirect('admin/login');
		}
		
		//after 15 min of inactivity auto logout
		if ($this->session->userdata('last_activity') && (time() - $this->session->userdata('last_activity')) > 1800) {
			$this->session->unset_userdata('admin');
			$this->session->sess_destroy();
			redirect('admin/login'); // redirect to login page
		}
		$this->session->set_userdata('last_activity',time());
		//
		
		$this->csrf = array(
		  'name' => $this->security->get_csrf_token_name(),
		  'hash' => $this->security->get_csrf_hash()
		);
	}
	protected function is_logged_in() {
		if (!empty($this->session->userdata('admin'))) {
			redirect('admin/dashboard', 'refresh');
		}
	}
	protected function redirect_guest() {
		if (!$this->session->userdata('admin')) {
			redirect('admin/index', 'refresh');
		}
	}
	protected function is_logged_in_user() {
		return $this->session->userdata('front_end_user') ? 1 : 0;
	}
	protected function redirect_guest_user() {
		if (!$this->session->userdata('front_end_user')) {
			redirect('index', 'refresh');
		}
	}
	
	public function check_strong_password($str) {
       if($str != ''){
		   if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $str)) {
			 return TRUE;
		   }
		   $this->form_validation->set_message('check_strong_password', 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.');
		   return FALSE;
	   }
    }
	
	public function check_textbox_with_some_special_character($str) {
       if($str != ''){
		   if (preg_match('/^[\w\- .,&-:()\/]+$/', $str)) {
			 return TRUE;
		   }
		   $this->form_validation->set_message('check_textbox_with_some_special_character', '%s Not Allowed Special Character.');
		   return FALSE;
	   }
    }
	

}
