<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Property extends MY_Controller
{
	
	var $session_data;

	public function __construct()
	{
		parent::__construct();
		$this->session_data = $this->session->userdata('admin');
		$this->load->model(array('mcommon', 'admin/muser', 'admin/mproperty'));
		$this->load->helper('email');
	}
	
	public function index($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$district_id = $this->input->post('district_id');
			
			$search_condn = array();
			$search_condn = $district_id != '' ? array_merge($search_condn, array('district_id' => $district_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/property/index/' . $value1));
		}
		
		$data = array('menu_id'=> 12);
		$data['slug'] =  $this->input->get('slug');
		//$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['districtsData'] = $this->mcommon->getDetailsOrder('district_master', array('is_active' => '1'), 'district_name', 'ASC');
		
		$condn = array('property_master.is_deleted' => '0');
		if (isset($link_condn['district_id']) && !is_null($link_condn['district_id'])) {
			$condn['property_master.district_id'] = $link_condn['district_id'];
			$data['d_district_id'] = $link_condn['district_id'];
		}
		
		$data['properties'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['properties'] = in_array($this->session_data['role_id'], array(1,2,18)) ? $this->mproperty->get_property($condn) : $this->mproperty->get_user_property_details($this->session_data['user_id']);
		}
		$data['content'] = 'admin/property/list';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add_property() 
	{
		$data = array();
		
		//$data['user_property_det'] = $user_property_det = $this->mproperty->get_user_property_details($this->session_data['user_id']);
		$data['slug'] =  $this->input->get('slug');
		$data['property_types'] = $this->mproperty->get_property_type(array('is_active' => 1));
		$data['states'] = $this->mproperty->get_property_state(array('state_id' => 41, 'is_active' => 1));
		$data['districts'] = $this->mproperty->get_property_district(array('district_master.state_id' => 41, 'is_active' => 1));
		//$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['facilities'] = $this->mproperty->get_property_facility(array('facility_master.status' => 1, 'facility_master.facility_type' => 'P'));
		$data['terrain_types'] = $this->mproperty->get_property_terrain(array('is_active' => 1));
		$data['content'] = 'admin/property/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_property()
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
				
				$img1_res = $img2_res = $img3_res = $img4_res = $img5_res = $img6_res = $img7_res = $img8_res = $img9_res = $img10_res = NULL;
				
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
				}
				if (!empty($_FILES['image6']['name'])) {
					$img6_res = $this->uploadImages('image6');
				}
				if (!empty($_FILES['image7']['name'])) {
					$img7_res = $this->uploadImages('image7');
				}
				if (!empty($_FILES['image8']['name'])) {
					$img8_res = $this->uploadImages('image8');
				}
				if (!empty($_FILES['image9']['name'])) {
					$img9_res = $this->uploadImages('image9');
				}
				if (!empty($_FILES['image10']['name'])) {
					$img10_res = $this->uploadImages('image10');
				}
				
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
					'property_unit_master_id' => 9999,
					'property_type_id' => $property_type,
					'terrain_id' => $property_terrain,
					'property_desc' => $property_description,
					'gst_no' => $property_gstin,
					'gst_applicable' => 1,
					'geo_latitude' => $geo_latitude,
					'geo_longitude' => $geo_longitude,
					'google_map_address' => $property_location_name,
					'facilities' => $facilityIds,
					'image1' => !is_null($img1_res) && $img1_res['status'] ? $img1_res['img_path'] : NULL,
					'image2' => !is_null($img2_res) && $img2_res['status'] ? $img2_res['img_path'] : NULL,
					'image3' => !is_null($img3_res) && $img3_res['status'] ? $img3_res['img_path'] : NULL,
					'image4' => !is_null($img4_res) && $img4_res['status'] ? $img4_res['img_path'] : NULL,
					'image5' => !is_null($img5_res) && $img5_res['status'] ? $img5_res['img_path'] : NULL,
					'image6' => !is_null($img6_res) && $img6_res['status'] ? $img6_res['img_path'] : NULL,
					'image7' => !is_null($img7_res) && $img7_res['status'] ? $img7_res['img_path'] : NULL,
					'image8' => !is_null($img8_res) && $img8_res['status'] ? $img8_res['img_path'] : NULL,
					'image9' => !is_null($img9_res) && $img9_res['status'] ? $img9_res['img_path'] : NULL,
					'image10' => !is_null($img10_res) && $img10_res['status'] ? $img10_res['img_path'] : NULL,
					'search_keywords' => $property_search_keywords,
					'search_string' => $search_string,
					'youtube_video_link' => $youtube_video_link,
					'checkin_time' => $checkin_time,
					'checkout_time' => $checkout_time,
					'is_active' => $property_status,
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				
				//echo '<pre>'; print_r($data); die;
				
				$result = $this->mproperty->submit_property($data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Property Details Added Successfully');
					redirect("admin/property");
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
		
		$dir = 'property_images';

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