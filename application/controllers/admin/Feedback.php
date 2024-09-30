<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mfeedback'); 

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
		$data = array('menu_id'=> 34);
		$data['feedbacks'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['feedbacks'] = $this->mfeedback->get_feedback();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/feedback/list';
		$this->load->view('admin/layouts/index', $data);
	}
	

}
