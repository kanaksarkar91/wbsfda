<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harbour_buyer extends MY_Controller
{
	//private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mharbour_buyer', 'mcommon'));
		//$this->menu_id = 24;

	}


	public function index()
	{
		
		$curUser = $this->admin_session_data['user_id'];
		
		$data['buyer_list'] = $this->mharbour_buyer->buyer_list($curUser);

		$data['content'] = 'admin/harbour_buyer/list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function add_buyer()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$this->form_validation->set_rules('buyer_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('buyer_type', 'Type', 'trim|required|in_list[B,L]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/harbour_buyer");
			}
			else {
				$propertyId = $this->input->post('property_id');

				$harbourarray = array(
					'harbour_buyer_name' => $this->input->post('buyer_name'),
					'harbour_buyer_mobile'=> $this->input->post('mobile_no'),
					'buyer_type'=> $this->input->post('buyer_type'),
					'created_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mharbour_buyer->hourbour_insert($harbourarray);
	
				if($result){
	
					if($propertyId[0] == '0'){
	
						$allProperty = $this->mharbour_buyer->get_allproperty($curUser);
	
						$getArray = array();
						
						foreach($allProperty as $prop){
	
							$propArray = array();
	
							$propArray['harbour_buyer_id'] = $result;
							$propArray['harbour_id'] = $prop['property_id'];
							$propArray['created_by'] = $this->admin_session_data['user_id'];
	
							$getArray[] = $propArray;
	
						}
	
						$this->mharbour_buyer->hourbour_map_insert($getArray);
	
						if($this->input->post('buyer_type') == 'B'){
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Buyer Successfully Submitted.</div>');
							redirect("admin/harbour_buyer");
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Licensee Successfully Submitted.</div>');
							redirect("admin/harbour_buyer");
						}
						
	
					} else {
	
						$getArray = array();
						
						foreach($propertyId as $prop){
	
							$propArray = array();
	
							$propArray['harbour_buyer_id'] = $result;
							$propArray['harbour_id'] = $prop;
							$propArray['created_by'] = $this->admin_session_data['user_id'];
	
							$getArray[] = $propArray;
	
						}
	
						$this->mharbour_buyer->hourbour_map_insert($getArray);
	
						if($this->input->post('buyer_type') == 'B'){
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Buyer Successfully Submitted.</div>');
							redirect("admin/harbour_buyer");
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Licensee Successfully Submitted.</div>');
							redirect("admin/harbour_buyer");
						}
	
					}
	
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					redirect("admin/harbour_buyer");
				}
			}
		}

		$data['property_list'] = $this->mharbour_buyer->property_list($curUser);

		$data['content'] = 'admin/harbour_buyer/add';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function edit($buyerID)
	{
		
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){
			$this->form_validation->set_rules('buyer_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('buyer_type', 'Type', 'trim|required|in_list[B,L]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/harbour_buyer");
			}
			else {
				$buyer_id = $this->input->post('buyer_id');
				$propertyId = $this->input->post('property_id');
	
				$harbourarray = array(
					'harbour_buyer_name' => $this->input->post('buyer_name'),
					'harbour_buyer_mobile'=> $this->input->post('mobile_no'),
					'buyer_type'=> $this->input->post('buyer_type'),
					'updated_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mharbour_buyer->hourbour_update($harbourarray,$buyer_id);
	
				if($result){
	
					$this->mharbour_buyer->hourbour_map_delete($buyer_id);
	
					if($propertyId[0] == '0'){
	
						$allProperty = $this->mharbour_buyer->get_allproperty($curUser);
	
						$getArray = array();
						
						foreach($allProperty as $prop){
	
							$propArray = array();
	
							$propArray['harbour_buyer_id'] = $buyer_id;
							$propArray['harbour_id'] = $prop['property_id'];
							$propArray['created_by'] = $this->admin_session_data['user_id'];
	
							$getArray[] = $propArray;
	
						}
	
						$this->mharbour_buyer->hourbour_map_insert($getArray);
	
						if($this->input->post('buyer_type') == 'B'){
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Buyer Successfully Updated.</div>');
							redirect("admin/harbour_buyer");
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Licensee Successfully Updated.</div>');
							redirect("admin/harbour_buyer");
						}
						
	
					} else {
	
						$getArray = array();
						
						foreach($propertyId as $prop){
	
							$propArray = array();
	
							$propArray['harbour_buyer_id'] = $buyer_id;
							$propArray['harbour_id'] = $prop;
							$propArray['created_by'] = $this->admin_session_data['user_id'];
	
							$getArray[] = $propArray;
	
						}
	
						$this->mharbour_buyer->hourbour_map_insert($getArray);
	
						if($this->input->post('buyer_type') == 'B'){
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Buyer Successfully Updated.</div>');
							redirect("admin/harbour_buyer");
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Licensee Successfully Updated.</div>');
							redirect("admin/harbour_buyer");
						}
	
					}
	
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					redirect("admin/harbour_buyer");
				}
			}
		}

		$data['buyer_details'] = $this->mharbour_buyer->buyer_details($buyerID);

		$data['property_list'] = $this->mharbour_buyer->property_list($curUser);

		$data['content'] = 'admin/harbour_buyer/edit';
		$this->load->view('admin/layouts/index', $data); 
	}


}
