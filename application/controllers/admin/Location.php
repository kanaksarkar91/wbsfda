<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mlocation'); 

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
		$data['locations'] = $this->mlocation->get_location();
		// print_r($data['locations']);die;
		$data['content'] = 'admin/location/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addlocation()
	{
		$data = array();
		$data['fieldunits'] = $this->mlocation->get_fieldunit();
		$data['content'] = 'admin/location/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editlocation($location_id)
	{
		$data['fieldunits'] = $this->mlocation->get_fieldunit();
		$data['location'] = $this->mlocation->edit_location($location_id);
		$data['content'] = 'admin/location/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitlocation()
	{
		$fieldunit_id=$this->input->post('fieldunit_id');
		$location_name=$this->input->post('location_name');
		$status=$this->input->post('status'); 
			$data = array(
				'fieldunit_id' => $fieldunit_id,
				'location_name' => $location_name,
				'status' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->mlocation->submit_location($data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'location Added Successfully');
				redirect("admin/location");
			}
	}

	public function updatelocation()
	{
		$location_id=$this->input->post('location_id');
		$fieldunit_id=$this->input->post('fieldunit_id');

		$location_name=$this->input->post('location_name');
		$status=$this->input->post('status');
			$data = array(
				'location_name' => $location_name,
				'fieldunit_id' => $fieldunit_id,
				'status' => $status,
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			$condition = array('location_id' => $location_id);
			
			$result = $this->mlocation->update_location($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'location Updated Successfully');
				redirect("admin/location");
			}
	}

	public function deletelocation($location_id)
	{
			$data = array('status' => '2');
			$condition = array('location_id' => $location_id);

			$result = $this->mlocation->delete_location($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'location Deleted Successfully');
				redirect("admin/location");
			}
	}
	

}
