<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gst_slab extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mgst_slab'); 
		$this->load->model('admin/mhsn_sac');
		$this->load->model('mcommon');
	}
	
	public function index()
	{
		$data = array('menu_id'=> 17);
		$data['slug'] =  $this->input->get('slug');
		$data['gst_slabs'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['gst_slabs'] = $this->mgst_slab->get_gst_slab();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/gst-slab/list';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add_gst_slab() 
	{
		$data = array();
		$data['slug'] =  $this->input->get('slug');
		$data['content'] = 'admin/gst-slab/add';
		$data['hsns'] = $this->mhsn_sac->get_hsn_sac(array('hsn_sac_master.is_active' => 1));
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_gst_slab()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('hsn_sac_code','Tax Name','trim|required|numeric');
			$this->form_validation->set_rules('gst_percentage', 'GST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('cgst_percentage', 'CGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('sgst_percentage', 'SGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('igst_percentage', 'IGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('start_price', 'Starting Price', 'trim|required|numeric');
			$this->form_validation->set_rules('end_price', 'Ending Price', 'trim|required|numeric');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/gst_slab");
			}
			else {
				$hsn_sac_code = $this->input->post('hsn_sac_code');
				$gst_percentage = $this->input->post('gst_percentage');
				$cgst_percentage = $this->input->post('cgst_percentage');
				$sgst_percentage = $this->input->post('sgst_percentage');
				$igst_percentage = $this->input->post('igst_percentage');
				$eff_startg_date = $this->input->post('eff_startg_date');
				$start_price = $this->input->post('start_price');
				$end_price = $this->input->post('end_price');
				$status = $this->input->post('status'); 
				
				$data = array(
					'hsn_sac_code' => $hsn_sac_code,
					'gst_percentage' => $gst_percentage,
					'cgst_percentage' => $cgst_percentage,
					'sgst_percentage' => $sgst_percentage,
					'igst_percentage' => $igst_percentage,
					'eff_start_date' => $eff_startg_date,
					'startg_price' => $start_price,
					'ending_price' => $end_price,
					'is_active' => $status,
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				$result = $this->mgst_slab->add_gst_slab($data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'GST Slab Details Added Successfully');
					redirect("admin/gst_slab");
				}
			}
		}
	}
	
	public function edit_gst_slab($hotel_gst_slab_id)
	{
		$data['gst_slab'] = $this->mgst_slab->edit_gst_slab($hotel_gst_slab_id);
		$data['hsns'] = $this->mhsn_sac->get_hsn_sac(array('hsn_sac_master.is_active' => 1));
		$data['content'] = 'admin/gst-slab/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update_gst_slab() 
	{
		if($this->input->post()){
			$this->form_validation->set_rules('hsn_sac_code','Tax Name','trim|required|numeric');
			$this->form_validation->set_rules('gst_percentage', 'GST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('cgst_percentage', 'CGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('sgst_percentage', 'SGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('igst_percentage', 'IGST Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('start_price', 'Starting Price', 'trim|required|numeric');
			$this->form_validation->set_rules('end_price', 'Ending Price', 'trim|required|numeric');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/gst_slab");
			}
			else {
				$hotel_gst_slab_id = $this->input->post('hotel_gst_slab_id');
				$hsn_sac_code = $this->input->post('hsn_sac_code');
				$gst_percentage = $this->input->post('gst_percentage');
				$cgst_percentage = $this->input->post('cgst_percentage');
				$sgst_percentage = $this->input->post('sgst_percentage');
				$igst_percentage = $this->input->post('igst_percentage');
				$eff_startg_date = $this->input->post('eff_startg_date');
				$start_price = $this->input->post('start_price');
				$end_price = $this->input->post('end_price');
				$status = $this->input->post('status'); 
				
				$data = array(
					'hsn_sac_code' => $hsn_sac_code,
					'gst_percentage' => $gst_percentage,
					'cgst_percentage' => $cgst_percentage,
					'sgst_percentage' => $sgst_percentage,
					'igst_percentage' => $igst_percentage,
					'eff_start_date' => $eff_startg_date,
					'startg_price' => $start_price,
					'ending_price' => $end_price,
					'is_active' => $status,
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);
				
				$condition = array('hotel_gst_slab_id' => $hotel_gst_slab_id);
				
				$result = $this->mgst_slab->update_gst_slab($condition, $data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'GST Slab Details Updated Successfully');
					redirect("admin/gst_slab");
				}
			}
		}
	}
	
	
}