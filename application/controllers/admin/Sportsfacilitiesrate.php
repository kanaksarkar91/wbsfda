<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sportsfacilitiesrate extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/msportsfacilitiesrate'); 
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
		$data['fieldunits'] = $this->msportsfacilitiesrate->get_fieldunit();
		$data['organization_categories'] = $this->msportsfacilitiesrate->get_organization_category();
		$data['sports_facilities_rates'] = $this->msportsfacilitiesrate->get_sports_facilities_rates();

		// print_r($data['locations']);die;
		$data['content'] = 'admin/sports_facilities_rate/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit_rate($rate_id)
	{
		
		$data['sports_facilities_rate'] = $this->msportsfacilitiesrate->edit_rate($rate_id);
		$data['content'] = 'admin/sports_facilities_rate/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submit_rate()
	{
		//echo '<pre>';print_r($this->input->post());die;
		if(empty($this->input->post('rate')) || empty($this->input->post('effective_start_date'))){

			$return_data = array('status'=> false,'msg'=>'Missing required parameters');
			echo json_encode($return_data); exit;
		}
		$sports_facilities_rates = $this->msportsfacilitiesrate->get_sports_facilities_previous_rate($this->input->post('sports_facilities_id'),$this->input->post('organization_category_id'));

			if(!empty($sports_facilities_rates)){

				foreach($sports_facilities_rates as $sports_facilities_rate){

					if(strtotime($sports_facilities_rate['effective_start_date']) >= strtotime($this->input->post('effective_start_date'))){
						$return_data = array('status'=> false,'msg'=>'Rate already defined previously');
						echo json_encode($return_data); exit;

					}

				}
				$previous_rate_id = $sports_facilities_rates[0]['rate_id'];
				$previous_end_date = date('Y-m-d',strtotime($this->input->post('effective_start_date'). ' -1 day'));
				$this->db->update('sports_facilities_rates',array('effective_end_date'=>$previous_end_date),array('rate_id'=>$previous_rate_id));
			}

			$data = array(
				'organization_type' => $this->input->post('organization_category_id'),
				'rate' => $this->input->post('rate'),
				'sports_facilities_id' => $this->input->post('sports_facilities_id'),
				'effective_start_date' => date('Y-m-d',strtotime($this->input->post('effective_start_date'))),
				'effective_end_date' => '9999-12-31',
				'status' => '0',
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$result = $this->msportsfacilitiesrate->submit_rate($data);
				
			if ($result) {
				$return_data = array('status'=> true,'msg'=>'Rate added successfully');
			} else {
				$return_data = array('status'=> false,'msg'=>'Rate not added');
			}

			echo json_encode($return_data);
	}

	public function update_rate()
	{ 
		
			$data = array(
				'rate' => $this->input->post('rate'),
				'effective_start_date' => date('Y-m-d',strtotime($this->input->post('effective_start_date'))),
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			$condition = array('rate_id' => $this->input->post('rate_id'));
			
			$result = $this->msportsfacilitiesrate->update_rate($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Rate Updated Successfully');
				redirect("admin/sportsfacilitiesrate");
			}
	}

	public function deletelocation($location_id)
	{
			$data = array('status' => '2');
			$condition = array('location_id' => $location_id);

			$result = $this->msportsfacilitiesrate->delete_location($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'location Deleted Successfully');
				redirect("admin/location");
			}
	}

	public function getlocation()
	{
		$data = array();
		$fieldunit_id=$this->input->post('fieldunit_id');
		$data = $this->msportsfacilitiesrate->get_location($fieldunit_id);
		echo json_encode($data); 
	}

	public function getsportsfacilities()
	{
		$data = array();
		$location_id=$this->input->post('location_id');
		$slug=$this->input->post('slug');
		$data = $this->msportsfacilitiesrate->get_sportsfacilities($location_id,$slug);
		echo json_encode($data); 
	}


	public function getpreviousrate()
	{
		$data = array();
		$sports_facilities_id=$this->input->post('sports_facilities_id');
		$organization_category_id=$this->input->post('organization_category_id');
		$sports_facilities_rates = $this->msportsfacilitiesrate->get_sports_facilities_rates($sports_facilities_id,$organization_category_id);

		echo json_encode(array('status'=>true,'sports_facilities_rates'=>$sports_facilities_rates)); 
	}

	

	
	

}
