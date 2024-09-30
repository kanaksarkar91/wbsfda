<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mcms'); 

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
		$data = array('menu_id'=> 28);
		$data['cmss'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['cmss'] = $this->mcms->get_cms();
		}
		// print_r($data['cmss']);die;
		$data['content'] = 'admin/cms/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addcms()
	{
		$data = array();
		$data['content'] = 'admin/cms/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editcms($cms_id)
	{
		$data['cms'] = $this->mcms->edit_cms($cms_id);
		$data['content'] = 'admin/cms/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitcms()
	{
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$meta_title=$this->input->post('meta_title');
		$meta_keyword=$this->input->post('meta_keyword');
		$meta_description=$this->input->post('meta_description');
		$slug=$this->input->post('slug');
		$status=$this->input->post('status');

		// Upload folder location***
		$config['upload_path'] = './public/admin_images/cms_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		// load upload library***            
		$this->load->library('upload', $config);
	
		if($this->upload->do_upload('cms_image')) {
			$imgdata = $this->upload->data()['file_name'];
		} else {
			echo $this->upload->display_errors();
		}
		if(!empty($imgdata)){
			$data = array(
				'title' => $title,
				'description' => $description,
				'meta_title' => $meta_title,
				'meta_keyword' => $meta_keyword,
				'meta_description' => $meta_description,
				'cms_image' => $imgdata,
				'slug' => $slug,
				'status' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->mcms->submit_cms($data);
		}
				
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Cms Added Successfully');
			redirect("admin/cms");
		}
	}

	public function updatecms()
	{
		$data=array();
		$cms_id=$this->input->post('cms_id');
		$title=$this->input->post('title');
		$old_cms_image=$this->input->post('old_cms_image');
		$description=$this->input->post('description');
		$meta_title=$this->input->post('meta_title');
		$meta_keyword=$this->input->post('meta_keyword');
		$meta_description=$this->input->post('meta_description');
		$status=$this->input->post('status');
		$data1 = array(
			'title' => $title,
			'description' => $description,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'status' => $status,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		// Upload folder location***
		$config['upload_path'] = './public/admin_images/cms_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		// load upload library***            
		$this->load->library('upload', $config);
	
		if($this->upload->do_upload('cms_image')) {
			$data2 = array('cms_image' => $this->upload->data()['file_name']);
			@unlink('./public/admin_images/cms_images/'.$old_cms_image);
			
		} else {
			$data2 = array('cms_image' => $old_cms_image);
		}
		$data=array_merge($data1,$data2);
		$condition = array('cms_id' => $cms_id);
		
		$result = $this->mcms->update_cms($condition,$data);
				
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Cms Updated Successfully');
			redirect("admin/cms");
		}
	}

	public function deletecms($cms_id)
	{
			$data = array('status' => '2');
			$condition = array('cms_id' => $cms_id);

			$result = $this->mcms->delete_cms($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Division Deleted Successfully');
				redirect("admin/cms");
			}
	}
	

}
