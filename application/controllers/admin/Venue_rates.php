<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venue_rates extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Properties');
		$this->load->model('admin/mproperty');
		$this->load->model('admin/mvenue');
		$this->load->model('admin/Rate_category_master');
		$this->load->model('admin/venue_rate_master');
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
	 * Access URL base_url/admin/rates
	 */
	public function index()
	{
		$data = array('menu_id'=> 14);
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['content'] = 'admin/venue_rates/index';
		$this->load->view('admin/layouts/index', $data);
	}

	public function getFilterData()
	{
		$where = array();
		if($this->input->get('property_id')){
			$where['vrm.property_id'] = $this->input->get('property_id');
		}
		if($this->input->get('venue_id')){
			$where['vrm.single_venue_id'] = $this->input->get('venue_id');
		}
		if($this->input->get('rate_category_id')){
			$where['vrm.rate_category_id'] = $this->input->get('rate_category_id');
		}
		$result = $this->venue_rate_master->get($where);
		$response = array(
			'success' => TRUE,
			'data'=> $result
		);

		echo json_encode($response); exit;
	}

	public function add()
	{
		$data = array();
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/venue_rates/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitRateData()
	{
		$result = array();
		// Assuming $formSerializedData contains the serialized form data string
		parse_str($this->input->post('formSerializedData'), $formSerializedData);
		//$formSerializedData = $this->input->post('formSerializedData');
		if ($formSerializedData) {
			
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('venue_id','Venue','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('base_rate','Basic Rack Rate','trim|required|numeric|greater_than[0.99]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				$response = array(
					'success' => FALSE,
					'message' => validation_errors()
				);
			}
			else {
				try {
					$is_hourly_booking=$formSerializedData['hourly_booking_applicable'];
	
					$data = array(
						'property_id' => $formSerializedData['property_id'],
						'single_venue_id' => $formSerializedData['venue_id'],
						'plan_id' => $formSerializedData['rate_category_id'],
						'rate_category_id' => $formSerializedData['rate_category_id'],
						'base_price' => $formSerializedData['base_rate'],
	
						'mon_method' => $formSerializedData['method'] ? $formSerializedData['method'][0] : 0,
						'mon_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][0] : 0,
						'mon_price' => $formSerializedData['price'] ? $formSerializedData['price'][0] : 0,
	
						'tue_method' => $formSerializedData['method'] ? $formSerializedData['method'][1] : 0,
						'tue_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][1] : 0,
						'tue_price' => $formSerializedData['price'] ? $formSerializedData['price'][1] : 0,
	
						'wed_method' => $formSerializedData['method'] ? $formSerializedData['method'][2] : 0,
						'wed_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][2] : 0,
						'wed_price' => $formSerializedData['price'] ? $formSerializedData['price'][2] : 0,
						
	
						'thu_method' => $formSerializedData['method'] ? $formSerializedData['method'][3] : 0,
						'thu_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][3] : 0,
						'thu_price' => $formSerializedData['price'] ? $formSerializedData['price'][3] : 0,
	
						'fri_method' => $formSerializedData['method'] ? $formSerializedData['method'][4] : 0,
						'fri_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][4] : 0,
						'fri_price' => $formSerializedData['price'] ? $formSerializedData['price'][4] : 0,
	
						'sat_method' => $formSerializedData['method'] ? $formSerializedData['method'][5] : 0,
						'sat_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][5] : 0,
						'sat_price' => $formSerializedData['price'] ? $formSerializedData['price'][5] : 0,
	
						'sun_method' => $formSerializedData['method'] ? $formSerializedData['method'][6] : 0,
						'sun_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][6] : 0,
						'sun_price' => $formSerializedData['price'] ? $formSerializedData['price'][6] : 0,
						
						'mon_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][0] : 0,
						'tue_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][1] : 0,
						'wed_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][2] : 0,
						'thu_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][3] : 0,
						'fri_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][4] : 0,
						'sat_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][5] : 0,
						'sun_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][6] : 0,
	
						'food_rate' => $formSerializedData['food_rate'],
						'mon_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][0] : 0,
						'tue_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][1] : 0,
						'wed_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][2] : 0,
						'thu_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][3] : 0,
						'fri_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][4] : 0,
						'sat_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][5] : 0,
						'sun_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][6] : 0,
	
						'child_rate' => $formSerializedData['child_rate'],
						'mon_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][0] : 0,
						'tue_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][1] : 0,
						'wed_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][2] : 0,
						'thu_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][3] : 0,
						'fri_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][4] : 0,
						'sat_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][5] : 0,
						'sun_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][6] : 0,
						'is_multiple_venues' => 0,
						'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
						'booking_hours' => ($is_hourly_booking === 'yes') ? $formSerializedData['number_of_hours'] : 0,
						'eff_start_date' => $formSerializedData['start_date'],
						'eff_end_date' => $formSerializedData['end_date'] ? $formSerializedData['end_date'] : '9999-12-31',
						'created_by' => $this->session->userdata('admin')['user_id']
					);
					//print_r($data);
	
					$result = $this->venue_rate_master->add($data);
	
					//echo "<pre>"; print_r($result); die;
	
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Rate Details Added Successfully.');
						$response = array(
							'success' => TRUE,
							'message' => 'Rate Details Added Successfully.',
							'data' => $result
						);
					} else {
						$response = array(
							'success' => FALSE,
							'message' => 'Venue Rate conflicts with previous data for this Property, Venue, Rate Category and the date range.',
							'data' => $result
						);
					}
				} catch (Exception $ex) {
					$response = array(
						'success' => FALSE,
						'message' => 'Something went wrong.',
						'data' => $result
					);
				}
			}
		} else {
			$response = array(
				'success' => FALSE,
				'message' => 'Unable to add data.',
				'data' => $result
			);
		}
	
		// Set proper content type and echo the response as JSON
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
	
	
	public function edit($rate_id = '')
	{
		$data = array();
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['rate'] = $this->venue_rate_master->get(array('vrm.rate_id'=> $rate_id));
		$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/venue_rates/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateRateData($rate_id = '')
	{
		
		$result = array();
		parse_str($this->input->post('formSerializedData'), $formSerializedData);

		if($formSerializedData){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('venue_id','Venue','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('base_rate','Basic Rack Rate','trim|required|numeric|greater_than[0.99]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				$response = array(
					'success' => FALSE,
					'message' => validation_errors()
				);
			}
			else {
				try{
					$is_hourly_booking=$formSerializedData['hourly_booking_applicable'];
	
					$data = array(
						'property_id' => $formSerializedData['property_id'],
						'single_venue_id' => $formSerializedData['venue_id'],
						'plan_id' => $formSerializedData['rate_category_id'],
						'rate_category_id' => $formSerializedData['rate_category_id'],
						'base_price' => $formSerializedData['base_rate'],
	
						'mon_method' => $formSerializedData['method'] ? $formSerializedData['method'][0] : 0,
						'mon_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][0] : 0,
						'mon_price' => $formSerializedData['price'] ? $formSerializedData['price'][0] : 0,
	
						'tue_method' => $formSerializedData['method'] ? $formSerializedData['method'][1] : 0,
						'tue_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][1] : 0,
						'tue_price' => $formSerializedData['price'] ? $formSerializedData['price'][1] : 0,
	
						'wed_method' => $formSerializedData['method'] ? $formSerializedData['method'][2] : 0,
						'wed_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][2] : 0,
						'wed_price' => $formSerializedData['price'] ? $formSerializedData['price'][2] : 0,
						
						'thu_method' => $formSerializedData['method'] ? $formSerializedData['method'][3] : 0,
						'thu_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][3] : 0,
						'thu_price' => $formSerializedData['price'] ? $formSerializedData['price'][3] : 0,
	
						'fri_method' => $formSerializedData['method'] ? $formSerializedData['method'][4] : 0,
						'fri_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][4] : 0,
						'fri_price' => $formSerializedData['price'] ? $formSerializedData['price'][4] : 0,
	
						'sat_method' => $formSerializedData['method'] ? $formSerializedData['method'][5] : 0,
						'sat_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][5] : 0,
						'sat_price' => $formSerializedData['price'] ? $formSerializedData['price'][5] : 0,
	
						'sun_method' => $formSerializedData['method'] ? $formSerializedData['method'][6] : 0,
						'sun_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][6] : 0,
						'sun_price' => $formSerializedData['price'] ? $formSerializedData['price'][6] : 0,
	
						//'extra_bed' => $formSerializedData['extra_bed'],
						'mon_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][0] : 0,
						'tue_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][1] : 0,
						'wed_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][2] : 0,
						'thu_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][3] : 0,
						'fri_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][4] : 0,
						'sat_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][5] : 0,
						'sun_ex_price' => $formSerializedData['ex_bed'] ? $formSerializedData['ex_bed'][6] : 0,
	
						'food_rate' => $formSerializedData['food_rate'],
						'mon_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][0] : 0,
						'tue_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][1] : 0,
						'wed_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][2] : 0,
						'thu_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][3] : 0,
						'fri_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][4] : 0,
						'sat_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][5] : 0,
						'sun_food_rate' => $formSerializedData['per_persion'] ? $formSerializedData['per_persion'][6] : 0,
	
						'child_rate' => $formSerializedData['child_rate'],
						'mon_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][0] : 0,
						'tue_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][1] : 0,
						'wed_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][2] : 0,
						'thu_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][3] : 0,
						'fri_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][4] : 0,
						'sat_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][5] : 0,
						'sun_child_rate' => $formSerializedData['per_child'] ? $formSerializedData['per_child'][6] : 0,
						'is_multiple_venues' => 0,
						'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
						'booking_hours' => ($is_hourly_booking === 'yes') ? $formSerializedData['number_of_hours'] : 0,
						'eff_start_date' => $formSerializedData['start_date'],
						'eff_end_date' => $formSerializedData['end_date'] ? $formSerializedData['end_date'] : '9999-12-31',
						'updated_by' => $this->session->userdata('admin')['user_id'],
						'updated_ts' => time()
					);
	
					$result = $this->venue_rate_master->update($rate_id, $data);
					if($result){
						$this->session->set_flashdata('success_msg', 'Rate Details Updated Successfully.');
						$response = array(
							'success' => TRUE,
							'message' => 'Data updated successfully done.',
							'data'=> $result
						);
					}else{
						$response = array(
							'success' => FALSE,
							'message' => 'Home Rate conflicts with previous data for this Property, Venue, Rate Category and the date range.',
							'data'=> $result
						);
					}
				}
				catch(Exception $ex){
					$response = array(
						'success' => FALSE,
						'message' => 'Something went wrong.',
						'data'=> $result
					);
				}
			}
		}else{
			$response = array(
				'success' => FALSE,				
				'message' => 'Unable to update data.',
				'data'=> $result
			);
		}
		echo json_encode($response); exit;
	}

	public function multi_venue()
	{
		$data = array('menu_id'=> 14);
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['content'] = 'admin/multi_venue_rates/index';
		$this->load->view('admin/layouts/index', $data);
	}

	public function multi_add()
	{
		$data = array();
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/multi_venue_rates/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitRateMultiVenueData()
	{
		$result = array();
		// Assuming $formSerializedData contains the serialized form data string
		parse_str($this->input->post('formSerializedData'), $formSerializedData);
		//$formSerializedData = $this->input->post('formSerializedData');
		if ($formSerializedData) {
			$property_id = $formSerializedData['property_id'];
			$selected_venues = $formSerializedData['selected_venues'];
			// Check if the combination already exists
		if ($this->mvenue->isCombinationMultiVenueExists($property_id, $selected_venues)) {
			$response = array(
				'success' => FALSE,				
				'message' => 'This Property is already mapping with these selected venue combination! Please choose another one.',
				'data'=> $result
			);
		}
		else{
			try{
				$selected_venues = $formSerializedData['selected_venues'];
				sort($selected_venues);
				$commaSeparatedVenueIds = implode(',', $selected_venues);
				$is_hourly_booking=$formSerializedData['hourly_booking_applicable'];

				$data = array(
					'property_id' => $formSerializedData['property_id'],
					'multiple_venue_ids' => $commaSeparatedVenueIds,
					'plan_id' => $formSerializedData['rate_category_id'],
					'rate_category_id' => $formSerializedData['rate_category_id'],
					'base_price' => $formSerializedData['base_rate'],

					'mon_method' => $formSerializedData['method'] ? $formSerializedData['method'][0] : 0,
					'mon_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][0] : 0,
					'mon_price' => $formSerializedData['price'] ? $formSerializedData['price'][0] : 0,

					'tue_method' => $formSerializedData['method'] ? $formSerializedData['method'][1] : 0,
					'tue_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][1] : 0,
					'tue_price' => $formSerializedData['price'] ? $formSerializedData['price'][1] : 0,

					'wed_method' => $formSerializedData['method'] ? $formSerializedData['method'][2] : 0,
					'wed_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][2] : 0,
					'wed_price' => $formSerializedData['price'] ? $formSerializedData['price'][2] : 0,
					

					'thu_method' => $formSerializedData['method'] ? $formSerializedData['method'][3] : 0,
					'thu_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][3] : 0,
					'thu_price' => $formSerializedData['price'] ? $formSerializedData['price'][3] : 0,

					'fri_method' => $formSerializedData['method'] ? $formSerializedData['method'][4] : 0,
					'fri_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][4] : 0,
					'fri_price' => $formSerializedData['price'] ? $formSerializedData['price'][4] : 0,

					'sat_method' => $formSerializedData['method'] ? $formSerializedData['method'][5] : 0,
					'sat_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][5] : 0,
					'sat_price' => $formSerializedData['price'] ? $formSerializedData['price'][5] : 0,

					'sun_method' => $formSerializedData['method'] ? $formSerializedData['method'][6] : 0,
					'sun_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][6] : 0,
					'sun_price' => $formSerializedData['price'] ? $formSerializedData['price'][6] : 0,

					'is_multiple_venues' => 1,
					'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
					'booking_hours' => ($is_hourly_booking === 'yes') ? $formSerializedData['number_of_hours'] : 0,
					'eff_start_date' => $formSerializedData['start_date'],
					'eff_end_date' => $formSerializedData['end_date'] ? $formSerializedData['end_date'] : '9999-12-31',
					'created_by' => $this->session->userdata('admin')['user_id'],
				);
				//print_r($data);

				$result = $this->venue_rate_master->addMulti($data);
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Rate Details Added Successfully.');
					$response = array(
						'success' => TRUE,
						'message' => 'Rate Details Added Successfully.',
						'data' => $result
					);
				} else {
					$response = array(
						'success' => FALSE,
						'message' => 'Venue Rate conflicts with previous data for this Property, Venue, Rate Category and the date range.',
						'data' => $result
					);
				}
			} catch (Exception $ex) {
				$response = array(
					'success' => FALSE,
					'message' => 'Something went wrong.',
					'data' => $result
				);
			}
		} 
	}
	else {
			$response = array(
				'success' => FALSE,
				'message' => 'Unable to add data.',
				'data' => $result
			);
		}
	
		// Set proper content type and echo the response as JSON
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
	
	
	public function multi_edit($rate_id = '',$property_id='')
	{
		$data = array();
		//$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == 39){
			$data['properties'] = $this->mproperty->get_property();
		} else {
			$data['properties'] = $this->mproperty->get_user_property_details($this->session->userdata('admin')['user_id']);
		}

		$data['venues'] = $this->mvenue->get_venue_list_property_id($property_id);
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['rate'] = $this->venue_rate_master->getMultiVenueRate(array('vrm.rate_id'=> $rate_id));
		$data['hourly_options'] = $this->mvenue->get_active_hourly_booking_options();
		$data['content'] = 'admin/multi_venue_rates/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateRateMultiVenueData($rate_id = '')
	{
		$result = array();
		parse_str($this->input->post('formSerializedData'), $formSerializedData);

		if($formSerializedData){
			$property_id = $this->input->post('property_id');
			$selected_venues = $formSerializedData['selected_venues'];

			// Check if the combination already exists
		if ($this->venue_rate_master->isCombinationMultiVenueExists($property_id, $selected_venues,$rate_id)) {
			$response = array(
				'success' => FALSE,				
				'message' => 'This Property is already mapping with these selected venue combination! Please choose another one.',
				'data'=> $result
			);
		}
		else{
			try{
				$selected_venues = $formSerializedData['selected_venues'];
				sort($selected_venues);
				$commaSeparatedVenueIds = implode(',', $selected_venues);
				$is_hourly_booking=$formSerializedData['hourly_booking_applicable'];

				$data = array(
					'property_id' => $property_id,
					'multiple_venue_ids' => $commaSeparatedVenueIds,
					'plan_id' => $formSerializedData['rate_category_id'],
					'rate_category_id' => $formSerializedData['rate_category_id'],
					'base_price' => $formSerializedData['base_rate'],

					'mon_method' => $formSerializedData['method'] ? $formSerializedData['method'][0] : 0,
					'mon_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][0] : 0,
					'mon_price' => $formSerializedData['price'] ? $formSerializedData['price'][0] : 0,

					'tue_method' => $formSerializedData['method'] ? $formSerializedData['method'][1] : 0,
					'tue_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][1] : 0,
					'tue_price' => $formSerializedData['price'] ? $formSerializedData['price'][1] : 0,

					'wed_method' => $formSerializedData['method'] ? $formSerializedData['method'][2] : 0,
					'wed_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][2] : 0,
					'wed_price' => $formSerializedData['price'] ? $formSerializedData['price'][2] : 0,
					
					'thu_method' => $formSerializedData['method'] ? $formSerializedData['method'][3] : 0,
					'thu_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][3] : 0,
					'thu_price' => $formSerializedData['price'] ? $formSerializedData['price'][3] : 0,

					'fri_method' => $formSerializedData['method'] ? $formSerializedData['method'][4] : 0,
					'fri_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][4] : 0,
					'fri_price' => $formSerializedData['price'] ? $formSerializedData['price'][4] : 0,

					'sat_method' => $formSerializedData['method'] ? $formSerializedData['method'][5] : 0,
					'sat_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][5] : 0,
					'sat_price' => $formSerializedData['price'] ? $formSerializedData['price'][5] : 0,

					'sun_method' => $formSerializedData['method'] ? $formSerializedData['method'][6] : 0,
					'sun_per' => $formSerializedData['percentage'] ? $formSerializedData['percentage'][6] : 0,
					'sun_price' => $formSerializedData['price'] ? $formSerializedData['price'][6] : 0,
					'is_multiple_venues' => 1,
					'is_hourly_booking' => ($is_hourly_booking === 'yes') ? 1 : 0,
					'booking_hours' => ($is_hourly_booking === 'yes') ? $formSerializedData['number_of_hours'] : 0,
					'eff_start_date' => $formSerializedData['start_date'],
					'eff_end_date' => $formSerializedData['end_date'] ? $formSerializedData['end_date'] : '9999-12-31',
					'updated_by' => $this->session->userdata('admin')['user_id'],
					'updated_ts' => time()
				);
				$result = $this->venue_rate_master->updateMulti($rate_id, $data);
				if($result){
					$this->session->set_flashdata('success_msg', 'Rate Details Updated Successfully.');
					$response = array(
						'success' => TRUE,
						'message' => 'Data updated successfully done.',
						'data'=> $result
					);
				}else{
					$response = array(
						'success' => FALSE,
						'message' => 'Venue Rate conflicts with previous data for this Property, Venue, Rate Category and the date range.',
						'data'=> $result
					);
				}
			}
			catch(Exception $ex){
				$response = array(
					'success' => FALSE,
					'message' => 'Something went wrong.',
					'data'=> $result
				);
			}
			}
		}else{
			$response = array(
				'success' => FALSE,				
				'message' => 'Unable to update data.',
				'data'=> $result
			);
		}
		echo json_encode($response); exit;
	}

	public function getFilterMultiVenueData()
	{
		$where = array();
		if($this->input->get('property_id')){
			$where['vrm.property_id'] = $this->input->get('property_id');
			$where['is_multiple_venues']=1;
		}
		if($this->input->get('rate_category_id')){
			$where['vrm.rate_category_id'] = $this->input->get('rate_category_id');
		}
		
		$result = $this->venue_rate_master->getMultiVenueRate($where);
		$response = array(
			'success' => TRUE,
			'data'=> $result
		);

		echo json_encode($response); exit;
	}

}
