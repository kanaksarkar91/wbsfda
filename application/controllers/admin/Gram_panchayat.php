<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gram_panchayat extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mgram_panchayat');
		$this->load->model('admin/mdistrict');
		$this->load->model('admin/mpanchayat_samity');
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
		$data = array('menu_id'=> 9);
		$data['gram_panchayats'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['gram_panchayats'] = $this->mgram_panchayat->get_gram_panchayat_list();
		}
		$data['content'] = 'admin/gram_panchayat/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addgram_panchayat() 
	{
		$data = array();
		$data['districts'] = $this->mdistrict->get_district();
		$data['panchayat_samitys'] = $this->mpanchayat_samity->get_panchayat_samity_list();
		$data['content'] = 'admin/gram_panchayat/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitgram_panchayat()
	{
			$district_id = $this->input->post('district_id');
			$parent_unit_id = $this->input->post('panchayat_samity');
			$unit_name = $this->input->post('unit_name');
			$is_active = $this->input->post('is_active');

			$data = array(
				'parent_unit_id' => $parent_unit_id,
				'district_id' => $district_id,
				'unit_name' => $unit_name,
				'unit_level' => 3,
				'is_active' => $is_active
			);
			// echo '<pre>';print_r($data);die;
			$result = $this->mgram_panchayat->submit_gram_panchayat($data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Panchayat Samity Added Successfully');
				redirect("admin/gram_panchayat");
			}

		$this->load->view('admin/layouts/index', $data);
	}

	public function editgram_panchayat($id)
	{	
		$data['districts'] = $this->mdistrict->get_district();
		$data['panchayat_samitys'] = $this->mpanchayat_samity->get_panchayat_samity_list();
		$data['gram_panchayat'] = $this->mgram_panchayat->edit_gram_panchayat($id);
		$data['content'] = 'admin/gram_panchayat/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updategram_panchayat()
	{
		$id = $this->input->post('id');
		$district_id = $this->input->post('district_id');
		$parent_unit_id = $this->input->post('panchayat_samity');
		$unit_name = $this->input->post('unit_name');
		$is_active = $this->input->post('is_active');

			$data = array(
				'parent_unit_id' => $parent_unit_id,
				'district_id' => $district_id,
				'unit_name' => $unit_name,
				'is_active' => $is_active
			);

			$condition = array('id' => $id);
			// echo '<pre>';print_r($data);die;
			$result = $this->mgram_panchayat->update_gram_panchayat($condition,$data);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Panchayat samity Updated Successfully');
				redirect("admin/gram_panchayat");
			}
	}

}
