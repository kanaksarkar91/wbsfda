<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accommodation extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/maccommodation', 'admin/mproperty', 'admin/muser'));
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
	public function index($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$property_id = $this->input->post('property_id');
			
			$search_condn = array();
			$search_condn = $property_id != '' ? array_merge($search_condn, array('property_id' => $property_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/accommodation/index/' . $value1));
		}
		
		$data = array('menu_id'=> 13);
		$data['accommodations'] = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if (isset($link_condn['property_id']) && !is_null($link_condn['property_id'])) {
			$condn['property_master.property_id'] = $link_condn['property_id'];
			$data['d_property_id'] = $link_condn['property_id'];
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['accommodations'] = $this->maccommodation->get_accommodation_list($condn);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['accommodations'] = $this->maccommodation->get_accommodation_list_property_id($parent_properties);
				}
			}
		}
		 //echo '<pre>',print_r($data['accommodations']);die;
		$data['content'] = 'admin/accommodation/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addaccommodation()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->maccommodation->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		// echo '<pre>';print_r($data); die;
		$data['accomm_class'] = $this->maccommodation->get_accomm_class();
		$data['accomm_type'] = $this->maccommodation->get_accomm_type();
		$data['content'] = 'admin/accommodation/add';
		$data['slug'] = 'accommodation';
		$data['facilities'] = $this->maccommodation->get_property_facility(array('facility_master.status' => 1, 'facility_master.facility_type' => 'R'));
		// $data['facility_dropdown'] = $this->maccommodation->get_facilities();

		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertaccommodation() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('accommodation_name','Accommodation Name','trim|required');
			$this->form_validation->set_rules('accommodation_information','Accommodation Detail Information','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('accomm_class_id','Accommodation Classification','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('accomm_type_id','Accommodation Type','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('no_of_accomm','No. of Accommodation','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('adult','Allowed Adult','trim|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('child','Allowed Child','trim|numeric|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/accommodation");
			}
			else {
				
				$accommodation_name = $this->input->post('accommodation_name');
				$property_id = $this->input->post('property_id');
				$accomm_class_id = $this->input->post('accomm_class_id');
				$accomm_type_id = $this->input->post('accomm_type_id');
				$no_of_accomm = $this->input->post('no_of_accomm');
				$accommodation_information = $this->input->post('accommodation_information');
				//$extra_bed = $this->input->post('extra_bed');
				$adult = ($this->input->post('accomm_type_id') != 9) ? $this->input->post('adult') : 1;
				//$max_adult = $this->input->post('max_adult');
				$child = ($this->input->post('accomm_type_id') != 9) ? $this->input->post('child') : 1;
				$status = $this->input->post('is_active');
				$room_no = $this->input->post('room_no');
				$property_facilities = $this->input->post('property_facilities');
				$facilityIds = (!empty($property_facilities)) ? implode(',', $property_facilities) : '';
				// $facilities = $this->mproperty->get_property_facility(array("facility_id IN($facilityIds)" => NULL));
				// $facilityNames = implode(' ', array_column($facilities, 'facility_name'));
				
				$accomoDataFound = $this->mcommon->getRow('accommodation', array('property_id'=>$property_id, 'accommodation_name' =>$accommodation_name));
				
				if(!$accomoDataFound) {
					
					$img1_res = $img2_res = $img3_res = $img4_res = NULL;
	
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
		
					$data = array(
						'accommodation_name' => $accommodation_name,
						'property_id' => $property_id,
						'accomm_class_id' => $accomm_class_id,
						'accomm_type_id' => $accomm_type_id,
						'no_of_accomm' => $no_of_accomm,
						'accommodation_information' => $accommodation_information,
						//'extra_bed' => !empty($extra_bed) ? $extra_bed : 0,
						'adult' => ($adult != '') ? $adult : 0,
						//'max_adult' => $max_adult,
						'child' => !empty($child) ? $child : 0,
						'is_active' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s'),
						'image1' => !is_null($img1_res) && $img1_res['status'] ? $img1_res['img_path'] : NULL,
						'image2' => !is_null($img2_res) && $img2_res['status'] ? $img2_res['img_path'] : NULL,
						'image3' => !is_null($img3_res) && $img3_res['status'] ? $img3_res['img_path'] : NULL,
						'image4' => !is_null($img4_res) && $img4_res['status'] ? $img4_res['img_path'] : NULL,
						'facilities' => $facilityIds,
						'is_dormitory' => ($this->input->post('accomm_type_id') != 9) ? 'No' : 'Yes'
					);
					 //echo '<pre>';print_r($data);die;
					$result = $this->maccommodation->submit_accommodation($data);
					if ($result) {
						
						//Start Room Save
						for ($i = 0; $i < sizeof($room_no); $i++) {
		
							if ($room_no[$i] != '') {
								
								$checkRoomData = $this->mcommon->getRow('accommodation_room_mapping', array('room_no' => $room_no[$i], 'property_id' => $property_id));
								if(empty($checkRoomData)) {
									
									$room_data = array(
										'accomodation_id' => $result,
										'room_no' => $room_no[$i],
										'property_id' => $property_id,
										'status' => 1
									);
			
									$this->mcommon->insert('accommodation_room_mapping', $room_data);
									
								}
							}
						}
						//End Room Save
						
						$this->session->set_flashdata('success_msg', 'Accommodation Details Added Successfully');
						redirect("admin/accommodation");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Accommodation Found In Same Property.');
					redirect("admin/accommodation");
				}
			}
		}
	
	}

	public function editaccommodation($accommodation_id)
	{
		// $data['property_details'] = $this->maccommodation->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['accomm_class'] = $this->maccommodation->get_accomm_class();
		$data['accomm_type'] = $this->maccommodation->get_accomm_type();
		$data['facilities'] = $this->maccommodation->get_property_facility(array('facility_master.status' => 1, 'facility_master.facility_type' => 'R'));
		$data['accommodation'] = $this->maccommodation->edit_accommodation($accommodation_id);
		$data['accomo_room_mapping_dtl'] = $this->mcommon->getDetails('accommodation_room_mapping', array('accomodation_id' => $accommodation_id));
		//echo '<pre>',print_r($data['accommodation']);die;
		$data['content'] = 'admin/accommodation/edit';
		$data['slug'] = 'accommodation';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateaccommodation()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('accommodation_name','Accommodation Name','trim|required');
			$this->form_validation->set_rules('accommodation_information','Accommodation Detail Information','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('accomm_class_id','Accommodation Classification','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('accomm_type_id','Accommodation Type','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('no_of_accomm','No. of Accommodation','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('adult','Allowed Adult','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('child','Allowed Child','trim|required|numeric|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/accommodation");
			}
			else {
				
				$accommodation_id = $this->input->post('accommodation_id');
				$accommodation_name = $this->input->post('accommodation_name');
				$property_id = $this->input->post('property_id');
				$accomm_class_id = $this->input->post('accomm_class_id');
				$accomm_type_id = $this->input->post('accomm_type_id');
				$no_of_accomm = $this->input->post('no_of_accomm');
				$accommodation_information = $this->input->post('accommodation_information');
				//$extra_bed = $this->input->post('extra_bed');
				$adult = $this->input->post('adult');
				//$max_adult = $this->input->post('max_adult');
				$child = $this->input->post('child');
				$status = $this->input->post('is_active');
				$room_no = $this->input->post('room_no');
				$property_facilities = $this->input->post('property_facilities');
				$facilityIds = implode(',', $property_facilities);
				// $facilities = $this->mproperty->get_property_facility(array("facility_id IN($facilityIds)" => NULL));
				// $facilityNames = implode(' ', array_column($facilities, 'facility_name'));
				
				$accomoDataFound = $this->mcommon->getRow('accommodation', array('accommodation_id !=' => $accommodation_id, 'accommodation_name'=>$accommodation_name, 'property_id' =>$property_id));
				
				if(!$accomoDataFound) {
					
					$data = array(
						'accommodation_name' => $accommodation_name,
						'property_id' => $property_id,
						'accomm_class_id' => $accomm_class_id,
						//'accomm_type_id' => $accomm_type_id,
						//'no_of_accomm' => $no_of_accomm,
						'accommodation_information' => $accommodation_information,
						//'extra_bed' => $extra_bed,
						'adult' => ($adult != '') ? $adult : 0,
						//'max_adult' => $max_adult,
						'child' => !empty($child) ? $child : 0,
						'is_active' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s'),
						'facilities' => $facilityIds
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
					$condition = array('accommodation_id' => $accommodation_id);
					// echo '<pre>';print_r($data);die;
					$result = $this->maccommodation->update_accommodation($condition,$data);
					if ($result) {
						
						$this->mcommon->delete('accommodation_room_mapping', array('accomodation_id' => $accommodation_id));
						//Start Room Save
						for ($i = 0; $i < sizeof($room_no); $i++) {
		
							if ($room_no[$i] != '') {
								
								$checkRoomData = $this->mcommon->getRow('accommodation_room_mapping', array('room_no' => $room_no[$i], 'property_id' => $property_id));
								if(empty($checkRoomData)) {
									
									$room_data = array(
										'accomodation_id' => $accommodation_id,
										'room_no' => $room_no[$i],
										'property_id' => $property_id,
										'status' => 1
									);
			
									$this->mcommon->insert('accommodation_room_mapping', $room_data);
									
								}
							}
						}
						//End Room Save
						
						$this->session->set_flashdata('success_msg', 'Accommodation Details Updated Successfully');
						redirect("admin/accommodation");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Accommodation Found In Same Property.');
					redirect("admin/accommodation");
				}
				
			}
		}
		
	}

	function uploadImages($fieldName)
	{

		$dir = 'room_images';

		$config['upload_path']          = './public/admin_images/' . $dir;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 5000;
		$config['encrypt_name'] = TRUE;
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

	public function getAccommodationByProperty()
	{
		$data_list = $this->maccommodation->get_accommodation_list_property_id($this->input->get('property_id'));
		$response = array("status"=> true, "list"=>$data_list);
		echo json_encode($response);
		exit;
	}
	
	public function get_add_row_html()
	{
		$return_data = array();
		$total_rows = $this->input->post('no_of_accomm');
		$counter = 1;
		
		$html = '';
		
		for($x = 1; $x <= $total_rows; $x++){

		$counter++;
		
		$html .= '<tr class="text-box">
						<td><input type="text" class="form-control" name="room_no[]" id="room_no'.$counter.'" placeholder="Accommodation No." onchange="return check_room_no_availability('.$counter.');" required>
						<span id="show_msg'.$counter.'"></span>
						</td>
						
				  </tr>';
		}
		
		
		$return_data = array("status"=> true, "html"=>$html);
		echo json_encode($return_data); exit;
		
	}
	
	public function checkRoomNo()
	{
		$data = array();
		$checkRoomData = array();
		if($this->input->post('room_no') == ''){
			$this->session->set_flashdata('error_msg', 'Please Enter Room No!');
			$response = array(
				'success' => FALSE,
				'message' => 'Please Enter Room No!',
			);
			echo json_encode($response); exit;
		}
		if($this->input->post('property_id') == ''){
			$this->session->set_flashdata('error_msg', 'Please Select Property!');
			$response = array(
				'success' => FALSE,
				'message' => 'Please Select Property!',
			);
			echo json_encode($response); exit;
		}
		try{
			$room_no = $this->input->post('room_no');
			$property_id = $this->input->post('property_id');
			
			$checkRoomData = $this->mcommon->getRow('accommodation_room_mapping', array('room_no' => $room_no, 'property_id' => $property_id));
			if(!empty($checkRoomData)) {
				$response = array(
					'success' => FALSE,
					'message' => 'Duplicate Accommodation Found!!',
					'data'=> $checkRoomData
				);
			}
			else {
				$response = array(
					'success' => TRUE,
					'message' => 'Accommodation Available.',
					'data'=> $checkRoomData
				);
			}
			
		}catch(Exception $ex){
			$response = array(
				'success' => FALSE,
				'message' => 'Something went wrong.',
				'data'=> $result
			);
		}
		
		echo json_encode($response); exit;
		
	}

}
