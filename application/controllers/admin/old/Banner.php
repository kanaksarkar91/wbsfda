<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mbanner'); 

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
		$data = array('menu_id'=> 27);
		$data['banners'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['banners'] = $this->mbanner->get_banner();
		}
		// print_r($data['banners']);die;
		$data['content'] = 'admin/banner/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addbanner()
	{
		$data = array();
		$data['content'] = 'admin/banner/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editbanner($banner_id)
	{
		$data['banner'] = $this->mbanner->edit_banner($banner_id);
		$data['content'] = 'admin/banner/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitbanner()
	{
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$slug=$this->input->post('slug');
		$status=$this->input->post('status');

		// Upload folder location***
		$config['upload_path'] = './public/admin_images/banner_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		// load upload library***            
		$this->load->library('upload', $config);
	
		if($this->upload->do_upload('banner_image')) {
			$imgdata = $this->upload->data()['file_name'];
		} else {
			echo $this->upload->display_errors();
		}
		if(!empty($imgdata)){
			$data = array(
				'title' => $title,
				'description' => $description,
				'banner_image' => $imgdata,
				'slug' => $slug,
				'status' => $status,
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->mbanner->submit_banner($data);
		}	
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Banner Added Successfully');
			redirect("admin/banner");
		}
	}

	public function updatebanner()
	{
		$data=array();
		$banner_id=$this->input->post('banner_id');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$old_banner_image=$this->input->post('old_banner_image');
		$status=$this->input->post('status');
		$data1 = array(
			'title' => $title,
			'description' => $description,
			'status' => $status,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		// Upload folder location***
		$config['upload_path'] = './public/admin_images/banner_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		// load upload library***            
		$this->load->library('upload', $config);
	
		if($this->upload->do_upload('banner_image')) {
			$data2 = array('banner_image' => $this->upload->data()['file_name']);
			@unlink('./public/admin_images/banner_images/'.$old_banner_image);
			
		} else {
			$data2 = array('banner_image' => $old_banner_image);
		}
		$data=array_merge($data1,$data2);
		$condition = array('banner_id' => $banner_id);
		
		$result = $this->mbanner->update_banner($condition,$data);

		if ($result) {
			$this->session->set_flashdata('success_msg', 'Banner Updated Successfully');
			redirect("admin/banner");
		}

	}

	public function deletebanner($banner_id)
	{
			$data = array('status' => '2');
			$condition = array('banner_id' => $banner_id);

			$result = $this->mbanner->delete_banner($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Banner Deleted Successfully');
				redirect("admin/banner");
			}
	}
	

}
