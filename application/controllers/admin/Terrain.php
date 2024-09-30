<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terrain extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mterrain'); 
		$this->load->model('mcommon');
	}
	
	public function index()
	{
		$data = array('menu_id'=> 10);
		$data['slug'] =  $this->input->get('slug');
		$data['terrains'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['terrains'] = $this->mterrain->get_terrain();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/terrain/list';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add_terrain() 
	{
		$data = array();
		$data['slug'] =  $this->input->get('slug');
		$data['content'] = 'admin/terrain/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_terrain()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('terrain_name','Landscape Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/terrain");
			}
			else {
				
				$terrain_name = $this->input->post('terrain_name');
				$status = $this->input->post('status');
				
				$terrainDataFound = $this->mcommon->getRow('terrain_master', array('terrain_name'=>$terrain_name));
				
				if(!$terrainDataFound){
					
					$data = array(
						'terrain_name' => $terrain_name,
						'is_active' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					// Upload folder location***
					$config['upload_path'] = './public/admin_images/landscape_images';
					// Allowed file type***
					$config['allowed_types'] = '*';
					$config['encrypt_name'] = TRUE;
					// load upload library***            
					$this->load->library('upload', $config);
			
					if ($this->upload->do_upload('landscape_image')) {
						$data['landscape_image'] = $this->upload->data()['file_name'];
					}
			
					$result = $this->mterrain->submit_terrain($data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Location Details Added Successfully');
						redirect("admin/terrain");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Location Found!');
					redirect("admin/terrain");
				}
				
				
			}
		}
		
	}
	
	public function edit_terrain($terrain_id)
	{
		$data['terrain'] = $this->mterrain->edit_terrain($terrain_id);
		$data['content'] = 'admin/terrain/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update_terrain() 
	{
		if($this->input->post()){
			$this->form_validation->set_rules('terrain_name','Landscape Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/terrain");
			}
			else {
				
				$terrain_id = $this->input->post('terrain_id');
				$landscape_image_old = $this->input->post('landscape_image_old');
				$terrain_name = $this->input->post('terrain_name');
				$status = $this->input->post('status');
				
				$terrainDataFound = $this->mcommon->getRow('terrain_master', array('terrain_id !=' => $terrain_id, 'terrain_name'=>$terrain_name));
				
				if(!$terrainDataFound) {
					
					$data = array(
						'terrain_name' => $terrain_name,
						'is_active' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
			
					// Upload folder location***
					$config['upload_path'] = './public/admin_images/landscape_images';
					// Allowed file type***
					$config['allowed_types'] = '*';
					$config['encrypt_name'] = TRUE;
					// load upload library***            
					$this->load->library('upload', $config);
			
					if ($this->upload->do_upload('landscape_image')) {
						$data['landscape_image'] = $this->upload->data()['file_name'];
						@unlink('./public/admin_images/landscape_images/' . $landscape_image_old);
					} else {
						$data['landscape_image'] = $landscape_image_old;
					}
					
					$condition = array('terrain_id' => $terrain_id);
					
					$result = $this->mterrain->update_terrain($condition, $data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Location Details Updated Successfully');
						redirect("admin/terrain");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Location Found.');
					redirect("admin/terrain");
				}
				
			}
		}
		
	}
	
	
}