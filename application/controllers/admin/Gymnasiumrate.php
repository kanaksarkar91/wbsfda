<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gymnasiumrate extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mgymnasiumrate'); 
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
		$data['fieldunits'] = $this->mgymnasiumrate->get_fieldunit();
		$data['effective_years'] = $this->mgymnasiumrate->get_effective_years();
		// $data['gymnasium_rates'] = $this->mgymnasiumrate->get_gymnasium_rates();

		// print_r($data['locations']);die;
		$data['content'] = 'admin/gymnasium_rate/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit_rate($rate_id)
	{
		$gymnasium_schedule_count = $this->mgymnasiumrate->gymnasium_schedule_count($rate_id);

		if($gymnasium_schedule_count >0){
			$this->session->set_flashdata('error_msg', 'Booking has been done in this rate');
			redirect("admin/gymnasiumrate");
		}

		$data['gymnasium_rate'] = $this->mgymnasiumrate->edit_rate($rate_id);
		$data['effective_years'] = $this->mgymnasiumrate->get_effective_years();
		$data['content'] = 'admin/gymnasium_rate/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitgymnasiumrate()
	{
		$gymnasium_rate_count = $this->mgymnasiumrate->gymnasium_rate_count($this->input->post('sports_facilities_id'),$this->input->post('effective_year_id'),$this->input->post('user_type'));
		if($gymnasium_rate_count >0){
			$this->session->set_flashdata('error_msg', 'Rate already exist against the effective financial year ');
			redirect("admin/gymnasiumrate");
		}
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
			$result = $this->mgymnasiumrate->submit_gymnasiumrate($data);
			if($result)	{
				$this->session->set_flashdata('success_msg', 'Gymnasium Rate Added Successfully');	
			}else{
				$this->session->set_flashdata('error_msg', 'OOps !. Some thing went wrong.');
			}
			redirect("admin/gymnasiumrate");
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

			$condition = array('gymnasium_rate_id' => $this->input->post('gymnasium_rate_id'));
			
			$result = $this->mgymnasiumrate->update_rate($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Gymnasium Rate Updated Successfully');
				redirect("admin/gymnasiumrate");
			}
	}

	public function getlocation()
	{
		$data = array();
		$fieldunit_id=$this->input->post('fieldunit_id');
		$data = $this->mgymnasiumrate->get_location($fieldunit_id);
		echo json_encode($data); 
	}

	public function getGymnasiums()
	{
		$data = array();
		$location_id=$this->input->post('location_id');
		$slug=$this->input->post('slug');
		$data = $this->mgymnasiumrate->get_gymnasiums($location_id,$slug);
		echo json_encode($data); 
	}


	public function getpreviousrate()
	{
		$data = array();
		$sports_facilities_id=$this->input->post('sports_facilities_id');
		$gymnasium_rates = $this->mgymnasiumrate->get_gymnasium_rates($sports_facilities_id);

		echo json_encode(array('status'=>true,'gymnasium_rates'=>$gymnasium_rates)); 
	}

	

	
	

}
