<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcommon');
//
		if (!empty($this->session->userdata('admin'))) {
			redirect('admin/dashboard', 'refresh');
		}
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
		$this->load->view('admin/login');
	}

	public function submitlogin()
	{
		$condition=array();
		if($this->input->post()){
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[25]|callback_check_strong_password');
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				$this->load->view('admin/login');
			}else{
				$condition['email']=$this->input->post('email');
				$user_details=$this->mcommon->getRow('master_admin',$condition);
				if (password_verify($this->input->post('password'), $user_details['password'])) {
					if(empty($user_details)){
						$this->session->set_flashdata('error_msg','Invalid email or password');
						redirect('admin/login');
					}else{
						if($user_details['status'] !='0'){
							$this->session->set_flashdata('error_msg','Your account is pending.check your email to activate account');
							redirect('admin/login');
						}
						$this->session->set_userdata('admin',$user_details);
						$this->session->set_userdata('last_activity',time());
						redirect('admin/dashboard');
					}
				}
				else{
					$this->session->set_flashdata('error_msg','Invalid email or password');
					redirect('admin/login');
				}
			}
		}else{
			redirect('admin/login');
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
