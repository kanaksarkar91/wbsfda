<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sports_infrastructure extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/msports_infrastructure'); 

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
		$data['sports_infrastructures'] = $this->msports_infrastructure->get_sports_infrastructure();
		// print_r($data['sports_infrastructures']);die;
		$data['content'] = 'admin/sports_infrastructure/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addsports_infrastructure()
	{
		$data = array();
		$data['content'] = 'admin/sports_infrastructure/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editsports_infrastructure($sports_infrastructure_id)
	{
		$data['sports_infrastructure'] = $this->msports_infrastructure->edit_sports_infrastructure($sports_infrastructure_id);
		$data['content'] = 'admin/sports_infrastructure/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitsports_infrastructure()
	{
		$sports_infrastructure_name=$this->input->post('sports_infrastructure_name');
		$status=$this->input->post('status'); 
			$data = array(
				'sports_infrastructure_name' => $sports_infrastructure_name,
				'status' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->msports_infrastructure->submit_sports_infrastructure($data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Sports Infrastructure Added Successfully');
				redirect("admin/sports_infrastructure");
			}
	}

	public function updatesports_infrastructure()
	{
		$sports_infrastructure_id=$this->input->post('sports_infrastructure_id');
		$sports_infrastructure_name=$this->input->post('sports_infrastructure_name');
		$status=$this->input->post('status');
			$data = array(
				'sports_infrastructure_name' => $sports_infrastructure_name,
				'status' => $status,
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			$condition = array('sports_infrastructure_id' => $sports_infrastructure_id);
			
			$result = $this->msports_infrastructure->update_sports_infrastructure($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Sports Infrastructure Updated Successfully');
				redirect("admin/sports_infrastructure");
			}
	}

	public function deletesports_infrastructure($sports_infrastructure_id)
	{
			$data = array('status' => '2');
			$condition = array('sports_infrastructure_id' => $sports_infrastructure_id);

			$result = $this->msports_infrastructure->delete_sports_infrastructure($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Sports Infrastructure Deleted Successfully');
				redirect("admin/sports_infrastructure");
			}
	}
	

}
