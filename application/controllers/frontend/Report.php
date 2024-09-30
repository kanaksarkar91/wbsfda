<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mtax'); 
		$this->load->model('mcommon');
	}
	
	public function index()
	{
		$data = array('menu_id'=> 15);
		$data['slug'] =  $this->input->get('slug');
		$data['taxes'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['taxes'] = $this->mtax->get_tax();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/tax/list';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add_tax() 
	{
		$data = array();
		$data['slug'] =  $this->input->get('slug');
		$data['content'] = 'admin/tax/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_tax()
	{
		$tax_name = $this->input->post('tax_name');
		$tax_percentage = $this->input->post('tax_percentage');
		$cgst_percentage = $this->input->post('cgst_percentage');
		$sgst_percentage = $this->input->post('sgst_percentage');
		$eff_start_date = $this->input->post('eff_start_date');
		$tax_status = $this->input->post('tax_status'); 
		
		$data = array(
			'tax_name' => $tax_name,
			'tax_percentage' => $tax_percentage,
			'cgst_percentage' => $cgst_percentage,
			'sgst_percentage' => $sgst_percentage,
			'eff_start_date' => $eff_start_date,
			'is_active' => $tax_status,
			'created_by' => $this->admin_session_data['user_id'],
			'created_ts' => date('Y-m-d H:i:s')
		);
		$result = $this->mtax->submit_tax($data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Tax Details Added Successfully');
			redirect("admin/tax");
		}
	}
	
	public function edit_tax($tax_id)
	{
		$data['tax'] = $this->mtax->edit_tax($tax_id);
		$data['content'] = 'admin/tax/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update_tax() 
	{
		$tax_id = $this->input->post('tax_id');
		$tax_name = $this->input->post('tax_name');
		$tax_percentage = $this->input->post('tax_percentage');
		$cgst_percentage = $this->input->post('cgst_percentage');
		$sgst_percentage = $this->input->post('sgst_percentage');
		$eff_start_date = $this->input->post('eff_start_date');
		$tax_status = $this->input->post('tax_status'); 
		
		$data = array(
			'tax_name' => $tax_name,
			'tax_percentage' => $tax_percentage,
			'cgst_percentage' => $cgst_percentage,
			'sgst_percentage' => $sgst_percentage,
			'eff_start_date' => $eff_start_date,
			'is_active' => $tax_status,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		
		$condition = array('tax_id' => $tax_id);
		
		$result = $this->mtax->update_tax($condition, $data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Tax Details Updated Successfully');
			redirect("admin/tax");
		}
	}
}