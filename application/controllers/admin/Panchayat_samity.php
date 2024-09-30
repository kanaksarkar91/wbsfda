<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panchayat_samity extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mpanchayat_samity');
		$this->load->model('admin/mzilla_parishad');
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
		$data = array('menu_id'=> 8);
		$data['panchayat_samitys'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['panchayat_samitys'] = $this->mpanchayat_samity->get_panchayat_samity_list();
		}
		// echo '<pre>',print_r($data['accommodation']);die;
		$data['content'] = 'admin/panchayat_samity/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addpanchayat_samity() 
	{
		$data = array();
		$data['zilla_parishads'] = $this->mzilla_parishad->get_zilla_parishad_list();
		$data['content'] = 'admin/panchayat_samity/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitpanchayat_samity()
	{
			$parent_unit_id = $this->input->post('zilla_parishad');
			$district_id = $this->input->post('district_id');
			$unit_name = $this->input->post('unit_name');
			$is_active = $this->input->post('is_active');

			$data = array(
				'parent_unit_id' => $parent_unit_id,
				'district_id' => $district_id,
				'unit_name' => $unit_name,
				'unit_level' => 2,
				'is_active' => $is_active
			);
			// echo '<pre>';print_r($data);die;
			$result = $this->mpanchayat_samity->submit_panchayat_samity($data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Panchayat Samity Added Successfully');
				redirect("admin/panchayat_samity");
			}

		$this->load->view('admin/layouts/index', $data);
	}

	public function editpanchayat_samity($id)
	{	
		$data['zilla_parishads'] = $this->mzilla_parishad->get_zilla_parishad_list();
		$data['panchayat_samity'] = $this->mpanchayat_samity->edit_panchayat_samity($id);
		$data['content'] = 'admin/panchayat_samity/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updatepanchayat_samity()
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
			$result = $this->mpanchayat_samity->update_panchayat_samity($condition,$data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Panchayat samity Updated Successfully');
				redirect("admin/panchayat_samity");
			}
	}

	public function fetch_district()
	{	
		$zilla_parishad = $this->input->post('zilla_parishad');
		$district_details = $this->mpanchayat_samity->fetch_district($zilla_parishad);
		// echo '<pre>';print_r($district_details);die;
		echo json_encode(array('status'=>true,'district_details'=>$district_details));
	}

}
