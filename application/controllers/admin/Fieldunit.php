<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fieldunit extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mfieldunit'); 

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
		$data['fieldunits'] = $this->mfieldunit->get_fieldunit();
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/fieldunit/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addfieldunit()
	{
		$data = array();
		$data['content'] = 'admin/fieldunit/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editfieldunit($fieldunit_id)
	{
		$data['fieldunit'] = $this->mfieldunit->edit_fieldunit($fieldunit_id);
		$data['content'] = 'admin/fieldunit/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitfieldunit()
	{
		$fieldunit_name=$this->input->post('fieldunit_name');
		$billing_unit_no=$this->input->post('billing_unit_no');
		$status=$this->input->post('status'); 
			$data = array(
				'fieldunit_name' => $fieldunit_name,
				'billing_unit_no' => $billing_unit_no,
				'status' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->mfieldunit->submit_fieldunit($data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Division Added Successfully');
				redirect("admin/fieldunit");
			}
	}

	public function updatefieldunit()
	{
		$fieldunit_id=$this->input->post('fieldunit_id');
		$fieldunit_name=$this->input->post('fieldunit_name');
		$billing_unit_no=$this->input->post('billing_unit_no');
		$status=$this->input->post('status');
			$data = array(
				'fieldunit_name' => $fieldunit_name,
				'billing_unit_no' => $billing_unit_no,
				'status' => $status,
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			$condition = array('fieldunit_id' => $fieldunit_id);
			
			$result = $this->mfieldunit->update_fieldunit($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Division Updated Successfully');
				redirect("admin/fieldunit");
			}
	}

	public function deletefieldunit($fieldunit_id)
	{
			$data = array('status' => '2');
			$condition = array('fieldunit_id' => $fieldunit_id);

			$result = $this->mfieldunit->delete_fieldunit($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Division Deleted Successfully');
				redirect("admin/fieldunit");
			}
	}
	

}
