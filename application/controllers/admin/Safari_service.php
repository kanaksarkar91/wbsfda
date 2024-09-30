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
		$data['services'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['services'] = in_array($this->session_data['role_id'], array(1,2,18)) ? $this->msafari_service->get_property($condn) : $this->mproperty->get_user_property_details($this->session_data['user_id']);
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
	
	public function edit_property($property_id)
	{
		$data = array();
		
		//$data['user_property_det'] = $user_property_det = $this->mproperty->get_user_property_details($this->session_data['user_id']);
		$data['user'] = $this->muser->edit_user($this->session_data['user_id']);
		$data['property_types'] = $this->mproperty->get_property_type(array('is_active' => 1));
		$data['states'] = $this->mproperty->get_property_state(array('state_id' => 41, 'is_active' => 1));
		$data['districts'] = $this->mproperty->get_property_district(array('district_master.state_id' => 41, 'is_active' => 1));
		$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['facilities'] = $this->mproperty->get_property_facility(array('facility_master.status' => 1, 'facility_master.facility_type' => 'P'));
		$data['terrain_types'] = $this->mproperty->get_property_terrain(array('is_active' => 1));
		$data['property'] = $this->mproperty->edit_property($property_id);
		$data['content'] = 'admin/property/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update_property() 
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_name','Property','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('property_type','Property Type','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('terrain_type','Landscapes','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('property_gstin','GSTIN','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('property_description','Property Description','trim|required');
			$this->form_validation->set_rules('property_phn_no','Contact No 1','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('property_mobile_no','Contact No 2','trim|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('property_email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('property_address_line_1','Address Line 1','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('property_address_line_2','Address Line 2','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('property_city','City/Village','trim|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('property_state', 'State', 'trim|required|in_list[41]');
			$this->form_validation->set_rules('property_district','District','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('property_pin_code','Pin Code','trim|required|numeric|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('property_status', 'Status', 'trim|required|in_list[1,0]');
			$this->form_validation->set_rules('property_search_keywords','Search Keywords','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('location_name','Google Map Location','trim|callback_check_textbox_with_some_special_character');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/property");
			}
			else {
				
				$property_id = $this->input->post('property_id');
				$property_name = $this->input->post('property_name');
				$property_type = $this->input->post('property_type');
				$property_description = $this->input->post('property_description');
				$property_phn_no = $this->input->post('property_phn_no');
				$property_mobile_no = $this->input->post('property_mobile_no');
				$property_email = $this->input->post('property_email');
				$property_address_line_1 = $this->input->post('property_address_line_1');
				//$property_address_line_2 = $this->input->post('property_address_line_2');
				$property_city = $this->input->post('property_city');	
				$property_state = $this->input->post('property_state');
				$property_district = $this->input->post('property_district');
				$property_pin_code = $this->input->post('property_pin_code');
				$property_zp = $this->input->post('property_zp');
				$property_terrain = $this->input->post('terrain_type');
				$property_gstin = $this->input->post('property_gstin');
				$property_status = $this->input->post('property_status');
				$property_facilities = $this->input->post('property_facilities');
				$property_search_keywords = $this->input->post('property_search_keywords');
				$property_location_name = $this->input->post('location_name');
				$geo_latitude = $this->input->post('geo_latitude');
				$geo_longitude = $this->input->post('geo_longitude');
				$youtube_video_link = $this->input->post('youtube_video_link');
				$checkin_time = $this->input->post('checkin_time');
				$checkout_time = $this->input->post('checkout_time');
				
				$district = $this->mproperty->get_property_district(array('district_id' => $property_district));
				$districtName = $district[0]['district_name'];
				$facilityIds = (!empty($property_facilities)) ? implode(',', $property_facilities) : 0;
				$facilities = $this->mproperty->get_property_facility(array("facility_id IN($facilityIds)" => NULL));
				$facilityNames = implode(' ', array_column($facilities, 'facility_name'));
				
				$search_string = $property_name . ' ' . $property_location_name . ' ' . $property_search_keywords . ' ' . $districtName . ' ' . $property_city . ' ' .$facilityNames;
				
				$data = array(
					'property_name' => $property_name,
					'address_line_1' => $property_address_line_1,
					//'address_line_2' => $property_address_line_2,
					'state_id' => $property_state,
					'district_id' => $property_district,
					'city' => $property_city,
					'pincode' => $property_pin_code,
					'phone_no' => $property_phn_no,
					'mobile_no' => $property_mobile_no,
					'email' => $property_email,
					'property_type_id' => $property_type,
					'terrain_id' => $property_terrain,
					'property_desc' => $property_description,
					'gst_no' => $property_gstin,
					'gst_applicable' => 1,
					'geo_latitude' => $geo_latitude,
					'geo_longitude' => $geo_longitude,
					'google_map_address' => $property_location_name,
					'facilities' => $facilityIds,
					'search_keywords' => $property_search_keywords,
					'search_string' => $search_string,
					'youtube_video_link' => $youtube_video_link,
					'checkin_time' => $checkin_time,
					'checkout_time' => $checkout_time,
					'is_active' => $property_status,
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);
				
				$img1_res = $img2_res = $img3_res = $img4_res = NULL; 
				
				if (!empty($_FILES['image1']['name'])) {
					$img1_res = $this->uploadImages('image1');
					if (!is_null($img1_res) && $img1_res['status'] && isset($img1_res['img_path']))
						$data['image1'] = $img1_res['img_path'];
				}
				if (!empty($_FILES['image2']['name'])) {
					$img2_res = $this->uploadImages('image2');
					if (!is_null($img2_res) && $img2_res['status'] && isset($img2_res['img_path']))
						$data['image2'] = $img2_res['img_path'];
				}
				if (!empty($_FILES['image3']['name'])) {
					$img3_res = $this->uploadImages('image3');
					if (!is_null($img3_res) && $img3_res['status'] && isset($img3_res['img_path']))
						$data['image3'] = $img3_res['img_path'];
				}
				if (!empty($_FILES['image4']['name'])) {
					$img4_res = $this->uploadImages('image4');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image4'] = $img4_res['img_path'];
				}
				if (!empty($_FILES['image5']['name'])) {
					$img5_res = $this->uploadImages('image5');
					if (!is_null($img5_res) && $img5_res['status'] && isset($img5_res['img_path']))
						$data['image5'] = $img5_res['img_path'];
				}
				if (!empty($_FILES['image6']['name'])) {
					$img4_res = $this->uploadImages('image6');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image6'] = $img4_res['img_path'];
				}
				if (!empty($_FILES['image7']['name'])) {
					$img4_res = $this->uploadImages('image7');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image7'] = $img4_res['img_path'];
				}
				if (!empty($_FILES['image8']['name'])) {
					$img4_res = $this->uploadImages('image8');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image8'] = $img4_res['img_path'];
				}
				if (!empty($_FILES['image9']['name'])) {
					$img4_res = $this->uploadImages('image9');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image9'] = $img4_res['img_path'];
				}
				if (!empty($_FILES['image10']['name'])) {
					$img4_res = $this->uploadImages('image10');
					if (!is_null($img4_res) && $img4_res['status'] && isset($img4_res['img_path']))
						$data['image10'] = $img4_res['img_path'];
				}
				
				$condition = array('property_id' => $property_id);
				
				$result = $this->mproperty->update_property($condition, $data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Property Details Updated Successfully');
					redirect("admin/property");
				}
				
			}
		}
		
	}
	
	public function ajaxPropertyLocationHandler() {
		$return_data = array();
		
		$action_type = $this->input->post('action_type');
		$parent_unit_id = $this->input->post('parent_id');
		$property_unit_master_id = $this->input->post('property_unit_master_id');
		$unit_id = $this->input->post('unit_id');

		//echo "<pre>"; print_r($this->input->post()); die;
		
		if (strtoupper($action_type) == 'ZILLA_PARISHAD') {
			$zps = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
			$return_data = array("status"=> true, "ZPlist"=>$zps);
			echo json_encode($return_data);
			exit;
		}
				
		if (strtoupper($action_type) == 'PANCHAYAT_SAMITI') {
			$condn = !is_null($unit_id) && $unit_id != '' ? array('id' => $unit_id, 'parent_unit_id' => $parent_unit_id) : array('parent_unit_id' => $parent_unit_id);
			$pss = $this->mproperty->get_property_unit($condn);
			$return_data = array("status"=> true, "PSlist"=>$pss);
			echo json_encode($return_data);
			exit;
		}
		
		if (strtoupper($action_type) == 'GRAM_PANCHAYAT') {
			$condn = !is_null($unit_id) && $unit_id != '' ? array('id' => $unit_id, 'parent_unit_id' => $parent_unit_id) : array('parent_unit_id' => $parent_unit_id);
			$pss = $this->mproperty->get_property_unit($condn);
			$return_data = array("status"=> true, "GPlist"=>$pss);
			echo json_encode($return_data);
			exit;
		}
		if (strtoupper($action_type) == 'PROPERTY_UNIT_MASTER') {
			$pss = $this->mproperty->get_property(array('property_master.is_active' => 1));
			$return_data = array("status"=> true, "list"=>$pss);
			echo json_encode($return_data);
			exit;
		}
		if (strtoupper($action_type) == 'PROPERTY_POS_MASTER') {
			$property_ids = $this->input->post('property_ids');
			$property_id_comma_seperated = implode(',', $property_ids);
			
			$pos = $this->muser->get_pos($property_id_comma_seperated);
			$return_data = array("status"=> true, "list"=>$pos);
			echo json_encode($return_data);
			exit;
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