<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities_amenitis extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/mfacilities_amenitis')); 

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
		$data = array('menu_id'=> 11);
		$data['facilities_amenitiss'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['facilities_amenitiss'] = $this->mfacilities_amenitis->get_facilities_amenitis();
		}
		// print_r($data['facilities_amenitiss']);die;
		$data['content'] = 'admin/facilities_amenitis/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addfacilities_amenitis()
	{
		$data = array();
		$data['content'] = 'admin/facilities_amenitis/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editfacilities_amenitis($facilities_amenitis_id)
	{
		$data['facilities_amenitis'] = $this->mfacilities_amenitis->edit_facilities_amenitis($facilities_amenitis_id);
		$data['content'] = 'admin/facilities_amenitis/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitfacilities_amenitis()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('facilities_amenitis_name','Facilities','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			$this->form_validation->set_rules('facility_type', 'Type', 'trim|required|in_list[P,R]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/facilities_amenitis");
			}
			else {
				
				$facilities_amenitis_name=$this->input->post('facilities_amenitis_name');
				$status=$this->input->post('status');
				$facility_type=$this->input->post('facility_type');
				
				$facilityDataFound = $this->mcommon->getRow('facility_master', array('facility_name'=>$facilities_amenitis_name, 'facility_type' => $facility_type));
				
				if(!$facilityDataFound) {
					
					$data = array(
						'facility_name' => $facilities_amenitis_name,
						'status' => $status,
						'facility_type' => $facility_type,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					$result = $this->mfacilities_amenitis->submit_facilities_amenitis($data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Facilities Amenities Added Successfully');
						redirect("admin/facilities_amenitis");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Facilities Amenities Found!');
					redirect("admin/facilities_amenitis");
				}
					
			}
		}
		
	}

	public function updatefacilities_amenitis()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('facilities_amenitis_name','Facilities','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			$this->form_validation->set_rules('facility_type', 'Type', 'trim|required|in_list[P,R]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/facilities_amenitis");
			}
			else {
				
				$facilities_amenitis_id=$this->input->post('facilities_amenitis_id');
				$facilities_amenitis_name=$this->input->post('facilities_amenitis_name');
				$status=$this->input->post('status');
				$facility_type=$this->input->post('facility_type');
				
				$facilityDataFound = $this->mcommon->getRow('facility_master', array('facility_id !=' => $facilities_amenitis_id, 'facility_name'=>$facility_name, 'facility_type' => $facility_type));
				
				if(!$facilityDataFound) {
					
					$data = array(
						'facility_name' => $facilities_amenitis_name,
						'status' => $status,
						'facility_type' => $facility_type,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
		
					$condition = array('facility_id' => $facilities_amenitis_id);
					
					$result = $this->mfacilities_amenitis->update_facilities_amenitis($condition,$data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Facilities Amenities Updated Successfully');
						redirect("admin/facilities_amenitis");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Facilities Amenities Found!');
					redirect("admin/facilities_amenitis");
				}
					
			}
		}
		
	}

	public function deletefacilities_amenitis($facilities_amenitis_id)
	{
			$data = array('status' => '2');
			$condition = array('facility_id' => $facilities_amenitis_id);

			$result = $this->mfacilities_amenitis->delete_facilities_amenitis($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Facilities Amenitis Deleted Successfully');
				redirect("admin/facilities_amenitis");
			}
	}
	

}
