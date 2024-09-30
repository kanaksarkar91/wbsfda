<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hsn_sac extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mhsn_sac'); 
		$this->load->model('admin/mtax');
		$this->load->model('mcommon');
	}
	
	public function index()
	{
		$data = array('menu_id'=> 16);
		$data['slug'] =  $this->input->get('slug');
		$data['hsns'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['hsns'] = $this->mhsn_sac->get_hsn_sac();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/hsn/list';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add_hsn_sac() 
	{
		$data = array();
		$data['slug'] =  $this->input->get('slug');
		$data['content'] = 'admin/hsn/add';
		$data['taxes'] = $this->mtax->get_tax(array('tax_master.is_active' => 1));
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_hsn_sac()
	{
		$this->form_validation->set_rules('hsn_sac_code','Hsn Code','trim|required|alpha_numeric_spaces');
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect("admin/hsn_sac");
		}
		else{
			$tax_name = $this->input->post('tax_name');
			$hsn_sac_code = $this->input->post('hsn_sac_code');
			$status = $this->input->post('status'); 
			
			$data = array(
				'tax_id' => $tax_name,
				'hsn_sac_code' => $hsn_sac_code,
				'is_active' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->mhsn_sac->submit_hsn_sac($data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'HSN/SAC Details Added Successfully');
				redirect("admin/hsn_sac");
			}
		}
	}
	
	public function edit_hsn_sac($hsn_sac_id)
	{
		$data['hsn'] = $this->mhsn_sac->edit_hsn_sac($hsn_sac_id);
		$data['taxes'] = $this->mtax->get_tax(array('tax_master.is_active' => 1));
		$data['content'] = 'admin/hsn/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update_hsn_sac() 
	{
		$hsn_sac_id = $this->input->post('hsn_sac_id');
		$tax_name = $this->input->post('tax_name');
		$hsn_sac_code = $this->input->post('hsn_sac_code');
		$status = $this->input->post('status');
		
		$data = array(
			'tax_id' => $tax_name,
			'hsn_sac_code' => $hsn_sac_code,
			'is_active' => $status,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		
		$condition = array('hsn_sac_id' => $hsn_sac_id);
		
		$result = $this->mhsn_sac->update_hsn_sac($condition, $data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'HSN/SAC Details Updated Successfully');
			redirect("admin/hsn_sac");
		}
	}
}