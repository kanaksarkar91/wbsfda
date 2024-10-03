<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Safari_service extends MY_Controller
{
	
	var $session_data;

	public function __construct()
	{
		parent::__construct();
		$this->session_data = $this->session->userdata('admin');
		$this->load->model(array('mcommon', 'admin/muser', 'admin/msafari_service'));
		$this->load->helper('email');
	}
	
	public function index($value1 = null)
	{
		$where = [];
		$data['services'] = [];
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['divisions'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1, 'state_id' => 41), 'division_name', 'ASC');
			$data['division_id']= $this->input->post('division_id') != '' ? $this->input->post('division_id') : ""; 
			
			if($this->input->post()){
				if($this->input->post('division_id')){
					$where['a.division_id'] = $this->input->post('division_id');
				}
			}
			$data['services'] = in_array($this->session_data['role_id'], array(2)) ? $this->msafari_service->get_services($where) : $this->mproperty->get_user_property_details($this->session_data['user_id']);
		}
		$data['content'] = 'admin/safari_service/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function getDivision()
	{
		$data_list = array();
		$district_id = $this->input->post('district_id');
		if(is_numeric($district_id) && $district_id > 0){
			$data_list = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1, 'district_id' => $district_id), 'division_name', 'ASC');
			$response = array("status"=> true, "list"=>$data_list);
		}
		else{
			$response = array("status"=> false, "list"=>$data_list);
		}
		
		echo json_encode($response);
		exit;
	}	
	public function add_safari_service() 
	{
		$data = array();
		//state_id=41 for West Bengal
		$data['districts'] = $this->mcommon->getDetailsOrder('district_master', array('is_active' => 1, 'state_id' => 41), 'district_name', 'ASC');
		$data['safariTypes'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['periods'] = $this->mcommon->getDetailsOrder('safari_service_period_master', array('is_active' => 1), 'service_period_master_id', 'ASC');
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['content'] = 'admin/safari_service/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_service()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('district_id','District','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('division_id','Division','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('safari_type_id','Safari Type', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('service_definition','Service Definition','trim|required');
			$this->form_validation->set_rules('start_point','Start Point','trim|required');
			$this->form_validation->set_rules('end_point','End Point','trim|required');
			$this->form_validation->set_rules('reporting_place','Reporting Place','trim|required');
			$this->form_validation->set_rules('route_desc','Routr Description','trim|required');
			$this->form_validation->set_rules('additional_info','Additional Information','trim');
			$this->form_validation->set_rules('service_status', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/safari_service");
			}
			else {
				
				$district_id = $this->input->post('district_id');
				$division_id = $this->input->post('division_id');
				$safari_type_id = $this->input->post('safari_type_id');
				$service_definition = $this->input->post('service_definition');
				$service_route = $this->input->post('service_route');
				$start_point = $this->input->post('start_point');
				$end_point = $this->input->post('end_point');
				$reporting_place = $this->input->post('reporting_place');	
				$route_desc = $this->input->post('route_desc');
				$additional_info = $this->input->post('additional_info');
				$service_status = $this->input->post('service_status');
				$start_date = $this->input->post('start_date');
				$end_date = $this->input->post('end_date');
				$period_desc = $this->input->post('period_desc');
				
				/*$img1_res = $img2_res = $img3_res = $img4_res = $img5_res = NULL;
				
				if (!empty($_FILES['image1']['name'])) {
					$img1_res = $this->uploadImages('image1');
				}
				if (!empty($_FILES['image2']['name'])) {
					$img2_res = $this->uploadImages('image2');
				}
				if (!empty($_FILES['image3']['name'])) {
					$img3_res = $this->uploadImages('image3');
				}
				if (!empty($_FILES['image4']['name'])) {
					$img4_res = $this->uploadImages('image4');
				}
				if (!empty($_FILES['image5']['name'])) {
					$img5_res = $this->uploadImages('image5');
				}*/
				
				$data = array(
					'district_id' => $district_id,
					'division_id' => $division_id,
					'safari_type_id' => $safari_type_id,
					'service_definition' => $service_definition,
					'service_route' => $service_route,
					'start_point' => $start_point,
					'end_point' => $end_point,
					'reporting_place' => $reporting_place,
					'route_desc' => $route_desc,
					'additional_info' => $additional_info,
					'service_status' => $service_status,
					/*'image1' => !is_null($img1_res) && $img1_res['status'] ? $img1_res['img_path'] : NULL,
					'image2' => !is_null($img2_res) && $img2_res['status'] ? $img2_res['img_path'] : NULL,
					'image3' => !is_null($img3_res) && $img3_res['status'] ? $img3_res['img_path'] : NULL,
					'image4' => !is_null($img4_res) && $img4_res['status'] ? $img4_res['img_path'] : NULL,
					'image5' => !is_null($img5_res) && $img5_res['status'] ? $img5_res['img_path'] : NULL,*/
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				
				//echo '<pre>'; print_r($data); die;
				
				$result = $this->mcommon->insert('safari_service_header', $data);
					
				if ($result) {
					//Start safari_service_period_slot_mapping Data Save
					$service_period_master_id = $this->input->post('service_period_master_id');
			
					foreach($service_period_master_id as $key => $val){
						
						$slot_desc = $this->input->post('slot_desc'.($key + 1));
						$start_time = $this->input->post('start_time'.($key + 1));
						$end_time = $this->input->post('end_time'.($key + 1));
						$reporting_time = $this->input->post('reporting_time'.($key + 1));
						$ticket_sale_closing_flag = $this->input->post('ticket_sale_closing_flag'.($key + 1));
						$ticket_sale_closing_time = $this->input->post('ticket_sale_closing_time'.($key + 1));
						
						$slot_mapping_insert = $this->mcommon->insert('safari_service_period_slot_mapping', array('safari_service_header_id' => $result, 'service_period_master_id' => $val));
						if($slot_mapping_insert){
							
							for ($i = 0; $i < sizeof($slot_desc); $i++) {
				
								if ($slot_desc[$i] != '' && $start_time[$i] != '' && $end_time[$i] != '' && $reporting_time[$i] != '' && $ticket_sale_closing_time[$i] != '') {
									
									// Convert times to DateTime objects for comparison
									$start = DateTime::createFromFormat('h:i A', $start_time[$i]);
									$end = DateTime::createFromFormat('h:i A', $end_time[$i]);
									
									 // Check if End Time is greater than Start Time
									if($end > $start){
										$slot_data = array(
											'safari_service_header_id' => $result,
											'service_period_master_id' => $val,
											'slot_desc' => $slot_desc[$i],
											'start_time' => $start_time[$i],
											'end_time' => $end_time[$i],
											'reporting_time' => $reporting_time[$i],
											'ticket_sale_closing_flag' => $ticket_sale_closing_flag[$i] == '' ? 1 : 2,
											'ticket_sale_closing_time' => $ticket_sale_closing_time[$i],
											'created_by' => $this->admin_session_data['user_id'],
											'created_ts' => date('Y-m-d H:i:s')
										);
						
										$this->mcommon->insert('safari_service_period_slot_detail', $slot_data);
									}
									
								}
							}
							
						}
					}
					//End safari_service_period_slot_mapping Data Save
					
					$this->session->set_flashdata('success_msg', 'Service Details Added Successfully');
					redirect("admin/safari_service");
				}
				
			}
		}
		
	}
	
	public function edit_safari_service($_safari_service_header_id)
	{
		$data = [];
		$service = [];
		$safari_service_header_id = decode_url($_safari_service_header_id);
		
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0){
			//$data['user_property_det'] = $user_property_det = $this->mproperty->get_user_property_details($this->session_data['user_id']);
			$data['user'] = $this->muser->edit_user($this->session_data['user_id']);
			$data['districts'] = $this->mcommon->getDetailsOrder('district_master', array('is_active' => 1, 'state_id' => 41), 'district_name', 'ASC');
			$data['divisions'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1, 'state_id' => 41), 'division_name', 'ASC');
			$data['safariTypes'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
			$data['periods'] = $this->mcommon->getDetailsOrder('safari_service_period_master', array('is_active' => 1), 'service_period_master_id', 'ASC');
			$service = $this->mcommon->getRow('safari_service_header', array('safari_service_header_id' => $safari_service_header_id));
			
			if(!empty($service)){
				$data['service'] = $service;
				
				$service_period_slot_mapping = $this->mcommon->getDetailsOrder('safari_service_period_slot_mapping', array('safari_service_header_id' => $safari_service_header_id), 'service_period_master_id', 'ASC');
		
				if(!empty($service_period_slot_mapping)){
					foreach($service_period_slot_mapping as $row){
						$service_details = $this->mcommon->getDetails('safari_service_period_slot_detail', array('safari_service_header_id' => $safari_service_header_id, 'service_period_master_id' => $row['service_period_master_id']));
						
						$data['safari_service_details'][] = array(
							'safari_service_header_id' => $safari_service_header_id,
							'service_period_master_id' => $row['service_period_master_id'],
							'service_details' => $service_details
						);
						
					}
				}
				else {
					$data['safari_service_details'] = array();
				}
			}
			$data['content'] = 'admin/safari_service/edit';
			$this->load->view('admin/layouts/index', $data);
		}
	}
	
	public function update_service() 
	{
		if($this->input->post()){
			$this->form_validation->set_rules('district_id','District','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('division_id','Division','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('safari_type_id','Safari Type', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('service_definition','Service Definition','trim|required');
			$this->form_validation->set_rules('start_point','Start Point','trim|required');
			$this->form_validation->set_rules('end_point','End Point','trim|required');
			$this->form_validation->set_rules('reporting_place','Reporting Place','trim|required');
			$this->form_validation->set_rules('route_desc','Routr Description','trim|required');
			$this->form_validation->set_rules('additional_info','Additional Information','trim');
			$this->form_validation->set_rules('service_status', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/safari_service");
			}
			else {
				
				$safari_service_header_id = decode_url($this->input->post('safari_service_header_id'));
				$district_id = $this->input->post('district_id');
				$division_id = $this->input->post('division_id');
				$safari_type_id = $this->input->post('safari_type_id');
				$service_definition = $this->input->post('service_definition');
				$service_route = $this->input->post('service_route');
				$start_point = $this->input->post('start_point');
				$end_point = $this->input->post('end_point');
				$reporting_place = $this->input->post('reporting_place');	
				$route_desc = $this->input->post('route_desc');
				$additional_info = $this->input->post('additional_info');
				$service_status = $this->input->post('service_status');
				$start_date = $this->input->post('start_date');
				$end_date = $this->input->post('end_date');
				$period_desc = $this->input->post('period_desc');
				
				$data = array(
					'district_id' => $district_id,
					'division_id' => $division_id,
					'safari_type_id' => $safari_type_id,
					'service_definition' => $service_definition,
					'service_route' => $service_route,
					'start_point' => $start_point,
					'end_point' => $end_point,
					'reporting_place' => $reporting_place,
					'route_desc' => $route_desc,
					'additional_info' => $additional_info,
					'service_status' => $service_status,
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);
				
				$condition = array('safari_service_header_id' => $safari_service_header_id);
				
				$result = $this->mcommon->update('safari_service_header', $condition, $data);
					
				if ($result) {
					
					//Start safari_service_period_slot_mapping Data Save
					$service_period_master_id = $this->input->post('service_period_master_id');
					
					if(!empty($service_period_master_id)){
						foreach($service_period_master_id as $key => $val){
							
							$slot_desc = $this->input->post('slot_desc'.($key + 1));
							$start_time = $this->input->post('start_time'.($key + 1));
							$end_time = $this->input->post('end_time'.($key + 1));
							$reporting_time = $this->input->post('reporting_time'.($key + 1));
							$ticket_sale_closing_flag = $this->input->post('ticket_sale_closing_flag'.($key + 1));
							$ticket_sale_closing_time = $this->input->post('ticket_sale_closing_time'.($key + 1));
							
							$slot_mapping_insert = $this->mcommon->insert('safari_service_period_slot_mapping', array('safari_service_header_id' => $result, 'service_period_master_id' => $val));
							if($slot_mapping_insert){
								
								for ($i = 0; $i < sizeof($slot_desc); $i++) {
					
									if ($slot_desc[$i] != '' && $start_time[$i] != '' && $end_time[$i] != '' && $reporting_time[$i] != '' && $ticket_sale_closing_time[$i] != '') {
										
										// Convert times to DateTime objects for comparison
										$start = DateTime::createFromFormat('h:i A', $start_time[$i]);
										$end = DateTime::createFromFormat('h:i A', $end_time[$i]);
										
										 // Check if End Time is greater than Start Time
										if($end > $start){
											$slot_data = array(
												'safari_service_header_id' => $safari_service_header_id,
												'service_period_master_id' => $val,
												'slot_desc' => $slot_desc[$i],
												'start_time' => $start_time[$i],
												'end_time' => $end_time[$i],
												'reporting_time' => $reporting_time[$i],
												'ticket_sale_closing_flag' => $ticket_sale_closing_flag[$i] == '' ? 1 : 2,
												'ticket_sale_closing_time' => $ticket_sale_closing_time[$i],
												'created_by' => $this->admin_session_data['user_id'],
												'created_ts' => date('Y-m-d H:i:s')
											);
							
											$this->mcommon->insert('safari_service_period_slot_detail', $slot_data);
										}
										
									}
								}
								
							}
						}
					}
					//End safari_service_period_slot_mapping Data Save
					
					//EDIT MODE
					$season_id = $this->input->post('season_id');
					if(!empty($season_id)){
						foreach($season_id as $key => $val){
							
							$slot_desc = $this->input->post('slot_desc'.($key + 1));
							$start_time = $this->input->post('start_time'.($key + 1));
							$end_time = $this->input->post('end_time'.($key + 1));
							$reporting_time = $this->input->post('reporting_time'.($key + 1));
							$ticket_sale_closing_flag = $this->input->post('ticket_sale_closing_flag'.($key + 1));
							$ticket_sale_closing_time = $this->input->post('ticket_sale_closing_time'.($key + 1));
							
							for ($i = 0; $i < sizeof($slot_desc); $i++) {
				
								if ($slot_desc[$i] != '' && $start_time[$i] != '' && $end_time[$i] != '' && $reporting_time[$i] != '' && $ticket_sale_closing_time[$i] != '') {
									
									// Convert times to DateTime objects for comparison
									$start = DateTime::createFromFormat('h:i A', $start_time[$i]);
									$end = DateTime::createFromFormat('h:i A', $end_time[$i]);
									
									 // Check if End Time is greater than Start Time
									if($end > $start){
										$slot_data = array(
											'safari_service_header_id' => $safari_service_header_id,
											'service_period_master_id' => $val,
											'slot_desc' => $slot_desc[$i],
											'start_time' => $start_time[$i],
											'end_time' => $end_time[$i],
											'reporting_time' => $reporting_time[$i],
											'ticket_sale_closing_flag' => $ticket_sale_closing_flag[$i] == '' ? 1 : 2,
											'ticket_sale_closing_time' => $ticket_sale_closing_time[$i],
											'created_by' => $this->admin_session_data['user_id'],
											'created_ts' => date('Y-m-d H:i:s')
										);
						
										$this->mcommon->insert('safari_service_period_slot_detail', $slot_data);
									}
									
								}
							}
						}
					}
					//
					
					$this->session->set_flashdata('success_msg', 'Service Details Updated Successfully');
					redirect("admin/safari_service");
				}
				
			}
		}
		
	}
	
	function uploadImages($fieldName) {
		
		$dir = 'service_images';

		$config['upload_path']          = './public/admin_images/' . $dir;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 5000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);
		
		$img_ret = array();

		if ($this->upload->do_upload($fieldName)) {
			$upload_data = $this->upload->data();
			$image_path = $dir . '/' . $upload_data['file_name'];
			
			$img_ret = array('status' => true, 'img_path' => $image_path);
		} else {
			$img_ret = array('status' => false, 'error' => $this->upload->display_errors());
		}
		
		return $img_ret;
	}
}