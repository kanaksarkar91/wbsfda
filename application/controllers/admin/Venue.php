<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venue extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mvenue');
		$this->load->model('admin/mproperty');
		$this->load->model('admin/muser');
		$this->load->helper('otp');
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

		if($this->input->post()){

			$data = array('menu_id'=> 19);
			$data['property_id']= $this->input->post('property_id') != '' ? $this->input->post('property_id') : ''; 
			$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
			/*if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
				$data['venues'] = $this->mvenue->get_venue_list();
			}else{
				$data['venues'] = array();
				if(check_user_permission($data['menu_id'], 'delete_flag')){
					$parent_properties = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
					$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
					if(!empty($parent_properties)){
						$data['venues'] = $this->mvenue->get_venue_list_property_id($parent_properties);
					}
				}
			}*/

			$data['venues'] = $this->mvenue->get_venue_list_property_id($this->input->post('property_id'));

		} else {

			$data = array('menu_id'=> 19);
			$data['property_id']= $this->input->post('property_id') != '' ? $this->input->post('property_id') : ''; 
			$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
				$data['venues'] = $this->mvenue->get_venue_list();
			}else{
				$data['venues'] = array();
				if(check_user_permission($data['menu_id'], 'delete_flag')){
					$parent_properties = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
					$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
					if(!empty($parent_properties)){
						$data['venues'] = $this->mvenue->get_venue_list_property_id($parent_properties);
					}
				}
			}

		}	
		// echo '<pre>',print_r($data['venue']);die;
		$data['content'] = 'admin/venue/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addvenue()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->mvenue->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		// echo '<pre>';print_r($data); die;
		// Fetch active hourly booking options
		//$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/venue/add';
		$data['slug'] = 'venue';
		// $data['facility_dropdown'] = $this->mvenue->get_facilities();

		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('venue_name','Venue Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('contact','Contact No','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('alt_contact','Alternaitve Contact No','trim|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('alt_email','Alternaitve Email','trim|valid_email');
			$this->form_validation->set_rules('desc','Description','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('approx_capacity','Approx Capacity','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('available_timming','Available Timming','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('available_facilities','Available Facilities','trim|callback_check_textbox_with_some_special_character');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/venue");
			}
			else{
				$venue_name = $this->input->post('venue_name');
				$property_id = $this->input->post('property_id');
				$contact = $this->input->post('contact');
				$alt_contact = $this->input->post('alt_contact');
				$email = $this->input->post('email');
				$alt_email = $this->input->post('alt_email');
				$desc = $this->input->post('desc');
				$available_facilities = $this->input->post('available_facilities');
				$approx_capacity=$this->input->post('approx_capacity');
				$available_timming=$this->input->post('available_timming');
	
				//$is_hourly_booking=$this->input->post('hourly_booking_applicable');
	
				//echo $is_hourly_booking;
				$img1_res = NULL;
				$img2_res = NULL;
				$img3_res = NULL;
				$img4_res = NULL;
	
				/*if (!empty($_FILES['image1']['name'])) {
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
				}*/
	
	
				$dir = 'venue_images';
	
				if (!empty($_FILES['venue_image']['name'][0])) {
	
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][0];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][0];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][0];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][0];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][0];
	
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
	
					$this->load->library('upload', $config);				
	
					if ($this->upload->do_upload('file')) {
						$upload_data1 = $this->upload->data();
						$image_path1 = $dir . '/' . $upload_data1['file_name'];
	
						$img1_res =  $image_path1;
					} else {
						//echo $this->upload->display_errors();
					}
	
				}
	
				if (!empty($_FILES['venue_image']['name'][1])) {
	
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][1];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][1];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][1];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][1];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][1];
	
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
	
					$this->load->library('upload', $config);				
	
					if ($this->upload->do_upload('file')) {
						$upload_data2 = $this->upload->data();
						$image_path2 = $dir . '/' . $upload_data2['file_name'];
	
						$img2_res =  $image_path2;
					} else {
						//echo $this->upload->display_errors();
					}
	
				}
	
				if (!empty($_FILES['venue_image']['name'][2])) {
	
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][2];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][2];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][2];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][2];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][2];
	
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
	
					$this->load->library('upload', $config);				
	
					if ($this->upload->do_upload('file')) {
						$upload_data3 = $this->upload->data();
						$image_path3 = $dir . '/' . $upload_data3['file_name'];
	
						$img3_res =  $image_path3;
					} else {
						//echo $this->upload->display_errors();
					}
	
				}
	
				if (!empty($_FILES['venue_image']['name'][3])) {				
	
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][3];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][3];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][3];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][3];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][3];
	
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
	
					$this->load->library('upload', $config);				
	
					if ($this->upload->do_upload('file')) {
						$upload_data4 = $this->upload->data();
						$image_path4 = $dir . '/' . $upload_data4['file_name'];
	
						$img4_res =  $image_path4;
					} else {
						//echo $this->upload->display_errors();
					}
	
				}
	
	
				$data = array(
					'venue_name' => $venue_name,
					'property_id' => $property_id,
					'contact_no' => $contact,
					'alternative_contact_no' => $alt_contact,
					'email' => $email,
					'alternative_email' => $alt_email,
					/*'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
					'booking_hours' => ($is_hourly_booking === 'yes') ? $this->input->post('number_of_hours') : 0,*/	
					'venue_description' => $desc,
					'available_facilities' => $available_facilities,
					'approx_capacity' => $approx_capacity,
					'available_timming' => $available_timming,
					//'image1' => !is_null($img1_res) && $img1_res['status'] ? $img1_res['img_path'] : NULL,
					//'image2' => !is_null($img2_res) && $img2_res['status'] ? $img2_res['img_path'] : NULL,
					//'image3' => !is_null($img3_res) && $img3_res['status'] ? $img3_res['img_path'] : NULL,
					//'image4' => !is_null($img4_res) && $img4_res['status'] ? $img4_res['img_path'] : NULL,
					'image1' => !is_null($img1_res) ? $img1_res : NULL,
					'image2' => !is_null($img2_res) ? $img2_res : NULL,
					'image3' => !is_null($img3_res) ? $img3_res : NULL,
					'image4' => !is_null($img4_res) ? $img4_res : NULL,
					'created_by' => $this->session->userdata('admin')['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				 //echo '<pre>';print_r($data);die;
				$result = $this->mvenue->submit_venue($data);
				if ($result) {
	
					// If files are selected to upload 
					$dataFiles = array();
	
					if(!empty($_FILES['venue_image']['name'][0])){
	
						$count = count($_FILES['venue_image']['name']);
	
						for($j=0;$j<$count;$j++){
	
							$_FILES['file']['name'] = $_FILES['venue_image']['name'][$j];			  
							$_FILES['file']['type'] = $_FILES['venue_image']['type'][$j];			  
							$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][$j];			  
							$_FILES['file']['error'] = $_FILES['venue_image']['error'][$j];			  
							$_FILES['file']['size'] = $_FILES['venue_image']['size'][$j];		  
					
				
							$config['upload_path']   = './public/admin_images/' . $dir;			  
							$config['allowed_types'] = 'jpg|jpeg|png';			  
							$config['max_size'] = '5000';			  
							$config['file_name'] = $_FILES['venue_image']['name'][$j];
							$config['encrypt_name'] = TRUE;
	
							$this->load->library('upload',$config); 		  
							$this->upload->initialize( $config );
			  
							if($this->upload->do_upload('file')){
				
								$uploadData = $this->upload->data();			  
								$filename = $uploadData['file_name'];
								$image_path = $dir . '/' . $filename;	
	
								$dataFiles['image_path'] = $image_path;
								$dataFiles['venue_id'] = $result;
	
								$this->mvenue->insert_venue_image($dataFiles);
				
							}
	
						}
	
					}
	
	
					$this->session->set_flashdata('success_msg', 'Venue Details Added Successfully');
					redirect("admin/venue");
				}
			}
		}

		$this->load->view('admin/layouts/index', $data);
	}

	public function editvenue($venue_id)
	{
		// $data['property_details'] = $this->mvenue->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		$data['venue'] = $this->mvenue->edit_venue($venue_id);
		//$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/venue/edit';
		$data['slug'] = 'venue';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updatevenue()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('venue_name','Venue Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('contact','Contact No','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('alt_contact','Alternaitve Contact No','trim|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('alt_email','Alternaitve Email','trim|valid_email');
			$this->form_validation->set_rules('desc','Description','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('approx_capacity','Approx Capacity','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('available_timming','Available Timming','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('available_facilities','Available Facilities','trim|callback_check_textbox_with_some_special_character');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/venue");
			}
			else{
				$venue_id = $this->input->post('venue_id');
				$venue_name = $this->input->post('venue_name');
				$property_id = $this->input->post('property_id');
				$contact = $this->input->post('contact');
				$alt_contact = $this->input->post('alt_contact');
				$email = $this->input->post('email');
				$alt_email = $this->input->post('alt_email');
				$desc = $this->input->post('desc');
				$status = $this->input->post('is_active');
				$available_facilities = $this->input->post('available_facilities');
				$is_hourly_booking=$this->input->post('hourly_booking_applicable');
				$approx_capacity=$this->input->post('approx_capacity');
				$available_timming=$this->input->post('available_timming');
		
		
				$data = array(
					'venue_name' => $venue_name,
					'property_id' => $property_id,
					'contact_no' => $contact,
					'alternative_contact_no' => $alt_contact,
					'email' => $email,
					'alternative_email' => $alt_email,
					/*'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
					'booking_hours' => ($is_hourly_booking === 'yes') ? $this->input->post('number_of_hours') : 0,*/	
					'venue_description' => $desc,
					'available_facilities' => $available_facilities,
					'approx_capacity' => $approx_capacity,
					'available_timming' => $available_timming,
					'is_active' => intval($status),
					'updated_by' => $this->session->userdata('admin')['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);
		
				/*$img1_res = NULL;
				$img2_res = NULL;
				$img3_res = NULL;
				$img4_res = NULL;
		
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
				}*/
		
		
				$dir = 'venue_images';
		
				if (!empty($_FILES['venue_image']['name'][0])) {
		
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][0];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][0];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][0];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][0];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][0];
		
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
		
					$this->load->library('upload', $config);				
		
					if ($this->upload->do_upload('file')) {
						$upload_data1 = $this->upload->data();
						$image_path1 = $dir . '/' . $upload_data1['file_name'];
		
						$data['image1'] = $image_path1;
					} else {
						//echo $this->upload->display_errors();
					}
		
				}
		
				if (!empty($_FILES['venue_image']['name'][1])) {
		
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][1];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][1];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][1];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][1];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][1];
		
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
		
					$this->load->library('upload', $config);				
		
					if ($this->upload->do_upload('file')) {
						$upload_data2 = $this->upload->data();
						$image_path2 = $dir . '/' . $upload_data2['file_name'];
		
						$data['image2'] = $image_path2;
					} else {
						//echo $this->upload->display_errors();
					}
		
				}
		
				if (!empty($_FILES['venue_image']['name'][2])) {
		
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][2];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][2];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][2];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][2];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][2];
		
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
		
					$this->load->library('upload', $config);				
		
					if ($this->upload->do_upload('file')) {
						$upload_data3 = $this->upload->data();
						$image_path3 = $dir . '/' . $upload_data3['file_name'];
		
						$data['image3'] = $image_path3;
					} else {
						//echo $this->upload->display_errors();
					}
		
				}
		
				if (!empty($_FILES['venue_image']['name'][3])) {				
		
					$_FILES['file']['name'] = $_FILES['venue_image']['name'][3];			  
					$_FILES['file']['type'] = $_FILES['venue_image']['type'][3];			  
					$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][3];			  
					$_FILES['file']['error'] = $_FILES['venue_image']['error'][3];			  
					$_FILES['file']['size'] = $_FILES['venue_image']['size'][3];
		
					$config['upload_path']          = './public/admin_images/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 5000;
					$config['encrypt_name'] = TRUE;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
		
					$this->load->library('upload', $config);				
		
					if ($this->upload->do_upload('file')) {
						$upload_data4 = $this->upload->data();
						$image_path4 = $dir . '/' . $upload_data4['file_name'];
		
						//$img4_res =  $image_path4;
						$data['image4'] = $image_path4;
					} else {
						//echo $this->upload->display_errors();
					}
		
				}
		
				$condition = array('venue_id' => $venue_id);
				// echo '<pre>';print_r($data);die;
				$result = $this->mvenue->update_venue($condition,$data);
				if ($result) {			
		
					// If files are selected to upload 
					$dataFiles = array();
		
					if(!empty($_FILES['venue_image']['name'][0])){
		
						//Delete Venue Mapped Image
						//$this->mvenue->delete_venue_image($venue_id);
		
						$count = count($_FILES['venue_image']['name']);
		
						for($j=0;$j<$count;$j++){
		
							$_FILES['file']['name'] = $_FILES['venue_image']['name'][$j];			  
							$_FILES['file']['type'] = $_FILES['venue_image']['type'][$j];			  
							$_FILES['file']['tmp_name'] = $_FILES['venue_image']['tmp_name'][$j];			  
							$_FILES['file']['error'] = $_FILES['venue_image']['error'][$j];			  
							$_FILES['file']['size'] = $_FILES['venue_image']['size'][$j];		  
					
				
							$config['upload_path']   = './public/admin_images/' . $dir;			  
							$config['allowed_types'] = 'jpg|jpeg|png';			  
							$config['max_size'] = '5000';			  
							$config['file_name'] = $_FILES['venue_image']['name'][$j];
							$config['encrypt_name'] = TRUE;
		
							$this->load->library('upload',$config); 		  
							$this->upload->initialize( $config );
			  
							if($this->upload->do_upload('file')){
				
								$uploadData = $this->upload->data();			  
								$filename = $uploadData['file_name'];
								$image_path = $dir . '/' . $filename;	
		
								$dataFiles['image_path'] = $image_path;
								$dataFiles['venue_id'] = $venue_id;
		
								$this->mvenue->insert_venue_image($dataFiles);
				
							}
		
						}
		
					}
		
					$this->session->set_flashdata('success_msg', 'Venue Details Updated Successfully');
					redirect("admin/venue");
				}
			}
		}
		
	}


	public function deletevenue($imageId,$venueId)
	{
		
		$result = $this->mvenue->delete_venue_image($imageId);

		if($result){

			$this->session->set_flashdata('success_msg', 'Venue Image Successfully Deleted.');
			redirect("admin/venue/editvenue/".$venueId);

		} else {
			$this->session->set_flashdata('error_msg', 'Something is Wrong. Try again.');
			redirect("admin/venue/editvenue/".$venueId);
		}

	}

	function uploadImages($fieldName)
	{

		$dir = 'venue_images';

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

	public function getVenueByProperty()
	{
		$data_list = $this->mvenue->get_venue_list_property_id($this->input->get('property_id'));
		$response = array("status"=> true, "list"=>$data_list);
		echo json_encode($response);
		exit;
	}
	// Controller Method to Get Venues by Property ID
	public function getVenuesListByProperty()
	{
		$property_id = $this->input->get('property_id');
		// Get venues by property ID from the model
		$venues = $this->mvenue->getVenuesByPropertyId($property_id);
		// Send JSON response back to the client
		header('Content-Type: application/json');
		echo json_encode($venues);
	}
	public function addMultivenue()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->mvenue->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		// echo '<pre>';print_r($data); die;
		// Fetch active hourly booking options
		$data['content'] = 'admin/MultiVenue/add';
		$data['slug'] = 'venue';
		$this->load->view('admin/layouts/index', $data);

		
	}

	
	public function saveVenueMapping() {
		$property_id = $this->input->post('property_id');
		$selected_venues = $this->input->post('selected_venues');
	
		if (!$property_id || !$selected_venues) {
			echo json_encode(array('success' => false, 'message' => 'Invalid data'));
			return;
		}
		
		// Check if the combination already exists
		if ($this->mvenue->isCombinationExists($property_id, $selected_venues)) {
			echo json_encode(array('success' => false, 'message' => 'Combination already exists! Please choose another combinations.'));
			return;
		}
	
		// Save the venue mapping
		$uniqueID = $this->generateUniqueID();
		$this->mvenue->saveVenueMapping($property_id, $selected_venues,$uniqueID);
	
		echo json_encode(array('success' => true, 'message' => 'Mapping saved successfully'));
	}
	
	// Generate a unique ID between 0 and 99999999
	function generateUniqueID() {
		return rand_string(10);
	}

	public function multiVenueList()
	{
		$data = array('menu_id'=> 19);
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['multivenues'] = $this->mvenue->getPropertyWiseVenues();
		}else{
			$data['multivenues'] = array();
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['multivenues'] = $this->mvenue->getPropertyWiseVenuesByPropertyId($parent_properties);
				}
			}
		}
		// echo '<pre>',print_r($data['venue']);die;
		$data['content'] = 'admin/MultiVenue/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function editMapping($mappingUniqueId) {

        $mappingData = $this->mvenue->getMappingByUniqueId($mappingUniqueId);
		$propertyDetails = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

        if ($mappingData) {
            // Fetch all venues for the property
            $venuesForProperty = $this->mvenue->getVenuesByPropertyId($mappingData['property_id']);


            $data = array(
                'mappingData' => $mappingData,
                'propertyDetails' => $propertyDetails,
                'venuesForProperty' => $venuesForProperty
            );

            $data['content'] = 'admin/MultiVenue/edit';
			$this->load->view('admin/layouts/index', $data);
        } else {
            // Handle if mapping not found
            // Redirect or show error
        }
    }

	public function updateVenueMapping() {
		$property_id = $this->input->post('property_id');
		$selected_venues = $this->input->post('selected_venues');
		$mapping_unique_id = $this->input->post('mapping_unique_id');

		if (!$property_id || !$selected_venues) {
			echo json_encode(array('success' => false, 'message' => 'Invalid data'));
			return;
		}
		
		// Check if the combination already exists
		if ($this->mvenue->isCombinationExists($property_id, $selected_venues)) {
			echo json_encode(array('success' => false, 'message' => 'Combination already exists! Please choose another combinations.'));
			return;
		}
	
		// Save the venue mapping
		$uniqueID = $this->generateUniqueID();
		$this->mvenue->saveVenueMapping($property_id, $selected_venues,$uniqueID);
		$data = array(
			'is_active' => 0,
			'updated_by' => $this->session->userdata('admin')['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		
		$condition = array('mapping_unique_id' => $mapping_unique_id);
		$this->mvenue->update_venueMapping($condition, $data);

		echo json_encode(array('success' => true, 'message' => 'Mapping saved successfully'));
	}

	public function checkVenueMapping() {
        $venueId = $this->input->post('venue_id');
        $propertyId = $this->input->post('property_id');

        $isMapped = $this->mvenue->isVenueMappedAndActive($venueId, $propertyId);

        echo json_encode(array('is_mapped' => $isMapped));
    }

}
