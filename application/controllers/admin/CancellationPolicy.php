<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CancellationPolicy extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mcancellationpolicy');
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
		$data = array('menu_id'=> 18);
		$data['plicies'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['plicies'] = $this->mcancellationpolicy->get();
		}
		$data['content'] = 'admin/cancellation-policy/index';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add($pre_data = array())
	{
		$data = array();
		$data['content'] = 'admin/cancellation-policy/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function edit($id)
	{
		$data = array();
		$data['policy'] = $this->mcancellationpolicy->get(array('cancellation_policy_id' => $id));
		$data['policy'] = !empty($data['policy']) ? $data['policy'][0] : array();
		$data['content'] = 'admin/cancellation-policy/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function save()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('day_from','Days From','trim|required|numeric');
			$this->form_validation->set_rules('day_to', 'Days To', 'trim|required|numeric');
			$this->form_validation->set_rules('cancellation_per', 'Cancellation Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/CancellationPolicy/add");
			}
			else {
				$data = array(
					'day_from' => $this->input->post('day_from'),
					'day_to' => $this->input->post('day_to'),
					'cancellation_per' => $this->input->post('cancellation_per'),
					'is_active' => $this->input->post('is_active'),
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				$result = $this->mcancellationpolicy->add($data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Cancellation Policy Added Successfully');
					redirect('admin/CancellationPolicy/index');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add Cancellation Policy');
					redirect('admin/CancellationPolicy/add');
				}
			}
		}
		
	}

	public function update($id = '')
	{
		if($this->input->post()){
			$this->form_validation->set_rules('day_from','Days From','trim|required|numeric');
			$this->form_validation->set_rules('day_to', 'Days To', 'trim|required|numeric');
			$this->form_validation->set_rules('cancellation_per', 'Cancellation Percentage', 'trim|required|numeric');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/CancellationPolicy/index");
			}
			else {
				$data = array(
					'day_from' => $this->input->post('day_from'),
					'day_to' => $this->input->post('day_to'),
					'cancellation_per' => $this->input->post('cancellation_per'),
					'is_active' => $this->input->post('is_active'),
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);			
				$result = $this->mcancellationpolicy->update($id, $data);
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Cancellation Policy Updated Successfully');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to Update Cancellation Policy');
				}
		
				redirect('admin/CancellationPolicy/index');
			}
		}
		
	}
	
	public function delete($id)
	{
		$data = array(
			'is_active' => 2,
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_ts' => date('Y-m-d H:i:s')
		);
		$result = '';
		// $result = $this->mcancellationpolicy->update($id, $data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Cancellation Policy Deleted Successfully');
		}else{
			$this->session->set_flashdata('error_msg', 'Unable to Deleted Cancellation Policy');
		}

		redirect('admin/CancellationPolicy/index');
	}
	
}
