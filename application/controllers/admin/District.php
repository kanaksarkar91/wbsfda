<?php
defined('BASEPATH') or exit('No direct script access allowed');

class District extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mdistrict'); 
		$this->load->model('admin/maccount'); 

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
		$data = array('menu_id'=> 6);
		$data['districts'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['districts'] = $this->mdistrict->get_district();
		}
		// print_r($data['banners']);die;
		$data['content'] = 'admin/district_master/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add_district()
	{
		$data['states'] = $this->maccount->get_state();
		// print_r($data['banners']);die;
		$data['content'] = 'admin/district_master/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submit_district()
	{
		$district_name = $this->input->post('district_name');
		$district_code = $this->input->post('district_code');
		$state_id = $this->input->post('state_id');
		$is_active = $this->input->post('is_active');
		$data = array(
			'district_name' => $district_name,
			'district_code' => $district_code,
			'state_id' => $state_id,
			'is_active' => $is_active,
			'created_by' => $this->admin_session_data['user_id'],
			'created_ts' => date('Y-m-d H:i:s')
		);
		// Upload folder location***
		$config['upload_path'] = './public/admin_images/district_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;
		// load upload library***            
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('district_image')) {
			$data['district_image'] = $this->upload->data()['file_name'];
		}

		$result = $this->mdistrict->submit_district($data);

		if ($result) {
			$this->session->set_flashdata('success_msg', 'District Added Successfully');
			redirect("admin/district");
		}
	}

	public function edit_district($district_id)
	{
		$data['states'] = $this->maccount->get_state();
		$data['district'] = $this->mdistrict->edit_district($district_id);
		$data['content'] = 'admin/district_master/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function update_district()
	{
		$district_id = $this->input->post('district_id');
		$district_image_old = $this->input->post('district_image_old');
		$district_name = $this->input->post('district_name');
		$district_code = $this->input->post('district_code');
		$state_id = $this->input->post('state_id');
		$is_active = $this->input->post('is_active');
		$data = array(
			'district_name' => $district_name,
			'district_code' => $district_code,
			'state_id' => $state_id,
			'is_active' => $is_active,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		// Upload folder location***
		$config['upload_path'] = './public/admin_images/district_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;
		// load upload library***            
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('district_image')) {
			$data['district_image'] = $this->upload->data()['file_name'];
			@unlink('./public/admin_images/district_images/' . $district_image_old);
		} else {
			$data['district_image'] = $district_image_old;
		}
		$condition = array('district_id' => $district_id);

		$result = $this->mdistrict->update_district($condition, $data);

		if ($result) {
			$this->session->set_flashdata('success_msg', 'District Updated Successfully');
			redirect("admin/district");
		}
	}

	// public function updatedistrictimages()
	// {
	// 	$district_id = $this->input->post('district_id');
	// 	$data = array(
	// 		'updated_by' => $this->admin_session_data['user_id'],
	// 		'updated_ts' => date('Y-m-d H:i:s')
	// 	);
	// 	// Upload folder location***
	// 	$config['upload_path'] = './public/admin_images/district_images';
	// 	// Allowed file type***
	// 	$config['allowed_types'] = '*';
	// 	$config['encrypt_name'] = TRUE;
	// 	// load upload library***            
	// 	$this->load->library('upload', $config);

	// 	if ($this->upload->do_upload('district_image')) {
	// 		$data['district_image'] = $this->upload->data()['file_name'];
	// 	}
	// 	$condition = array('district_id' => $district_id);

	// 	$result = $this->mdistrict->update_district_images($condition, $data);

	// 	if ($result) {
	// 		echo json_encode(array('status'=>true,'msg'=>'Image Uploaded Successfully'));
	// 	}
	// }
	
}
