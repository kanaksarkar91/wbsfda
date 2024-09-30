<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Change_password extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mchange_password'); 
		$this->load->model('mcommon'); 

	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['content'] = 'admin/change_password/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function updatepassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password');
		
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/account");
			}
			else{
			
				$old_password=$this->input->post('old_password');
				$password=$this->input->post('password');
				$confirm_password=$this->input->post('confirm_password');
				$check_old_password_count = $this->mchange_password->check_old_password($old_password,$this->admin_session_data['user_id']);
				if($check_old_password_count <= 0){
					$this->session->set_flashdata('error_msg', 'Old password is not correct');
					redirect("admin/account");
				} 
				if($password != $confirm_password){
					$this->session->set_flashdata('error_msg', 'New password does not match with confirm password');
					redirect("admin/account");
				} 
					
					$data = array(
						'password' => password_hash($password, PASSWORD_BCRYPT, array('cost' => 12))
					);
	
				$condition = array('user_id' => $this->admin_session_data['user_id']);
				
				$result = $this->mchange_password->update_password($condition,$data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Password Updated Successfully');
					redirect("admin/account");
				}
			
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

}
