<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trainingcenterrate extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mtrainingcenterrate'); 
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
		$data['fieldunits'] = $this->mtrainingcenterrate->get_fieldunit();
		$data['effective_years'] = $this->mtrainingcenterrate->get_effective_years();

		// print_r($data['locations']);die;
		$data['content'] = 'admin/training_center_rate/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit_rate($rate_id)
	{
		$data['trainingcenter_rate'] = $this->mtrainingcenterrate->edit_rate($rate_id);
		$data['effective_years'] = $this->mtrainingcenterrate->get_effective_years();
		$data['content'] = 'admin/training_center_rate/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submittrainingcenterrate()
	{
			$data = array(
				'sports_facilities_id' => $this->input->post('sports_facilities_id'),
				'user_type' => $this->input->post('user_type'),
				'registration_fee' => $this->input->post('registration_fee'),
				'monthly_subscription_fee' => $this->input->post('monthly_subscription_fee'),
				'effective_year_id' => $this->input->post('effective_year_id'),
				'status' => '0',
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			// echo '<pre>';print_r($data);die;
			$result = $this->mtrainingcenterrate->submit_trainingcenterrate($data);
			if($result)	{
				$this->session->set_flashdata('success_msg', 'Trainingcenter Rate Added Successfully');	
			}else{
				$this->session->set_flashdata('error_msg', 'OOps !. Some thing went wrong.');
			}
			redirect("admin/trainingcenterrate");
	}

	public function update_rate()
	{ 
		
			$data = array(
				'user_type' => $this->input->post('user_type'),
				'registration_fee' => $this->input->post('registration_fee'),
				'monthly_subscription_fee' => $this->input->post('monthly_subscription_fee'),
				'effective_year_id' => $this->input->post('effective_year_id'),
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			$condition = array('trainingcenter_rate_id' => $this->input->post('trainingcenter_rate_id'));
			
			$result = $this->mtrainingcenterrate->update_rate($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Training Center Rate Updated Successfully');
				redirect("admin/trainingcenterrate");
			}
	}

	public function getlocation()
	{
		$data = array();
		$fieldunit_id=$this->input->post('fieldunit_id');
		$data = $this->mtrainingcenterrate->get_location($fieldunit_id);
		echo json_encode($data); 
	}

	public function getTrainingcenters()
	{
		$data = array();
		$location_id=$this->input->post('location_id');
		$slug=$this->input->post('slug');
		$data = $this->mtrainingcenterrate->get_trainingcenters($location_id,$slug);
		echo json_encode($data); 
	}


	public function getpreviousrate()
	{
		$data = array();
		$sports_facilities_id=$this->input->post('sports_facilities_id');
		$trainingcenter_rates = $this->mtrainingcenterrate->get_training_center_rates($sports_facilities_id);

		echo json_encode(array('status'=>true,'trainingcenter_rates'=>$trainingcenter_rates)); 
	}

}
