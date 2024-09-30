<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zilla_parishad extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mzilla_parishad'); 
		$this->load->model('admin/mdistrict'); 
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
		$data = array('menu_id'=> 7);
		$data['zilla_parishads'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['zilla_parishads'] = $this->mzilla_parishad->get_zilla_parishad_list();
		}
		// echo '<pre>',print_r($data['accommodation']);die;
		$data['content'] = 'admin/zilla_parishad/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addzilla_parishad() 
	{
		$data = array();
		$data['districts'] = $this->mdistrict->get_district();
		$data['content'] = 'admin/zilla_parishad/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitzilla_parishad()
	{
			$district_id = $this->input->post('district_id');
			$unit_name = $this->input->post('unit_name');
			$is_active = $this->input->post('is_active');

			$data = array(
				'district_id' => $district_id,
				'unit_name' => $unit_name,
				'unit_level' => 1,
				'is_active' => $is_active
			);
			// echo '<pre>';print_r($data);die;
			$result = $this->mzilla_parishad->submit_zilla_parishad($data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Zilla Parishad Added Successfully');
				redirect("admin/zilla_parishad");
			}

		$this->load->view('admin/layouts/index', $data);
	}

	public function editzilla_parishad($id)
	{	
		$data['districts'] = $this->mdistrict->get_district();
		$data['zilla_parishad'] = $this->mzilla_parishad->edit_zilla_parishad($id);
		$data['content'] = 'admin/zilla_parishad/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updatezilla_parishad()
	{
		$id = $this->input->post('id');
		$district_id = $this->input->post('district_id');
		$unit_name = $this->input->post('unit_name');
		$is_active = $this->input->post('is_active');

			$data = array(
				'district_id' => $district_id,
				'unit_name' => $unit_name,
				'is_active' => $is_active
			);

			$condition = array('id' => $id);
			// echo '<pre>';print_r($data);die;
			$result = $this->mzilla_parishad->update_zilla_parishad($condition,$data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Zilla Parishad Updated Successfully');
				redirect("admin/zilla_parishad");
			}
	}


}
