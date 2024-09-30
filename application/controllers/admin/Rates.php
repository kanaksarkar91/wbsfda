<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rates extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/Properties', 'admin/mproperty', 'admin/Accommodations', 'admin/Rate_category_master', 'admin/Rate_master'));
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
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['accommodations'] = $this->Accommodations->get();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['content'] = 'admin/rates/index';
		$this->load->view('admin/layouts/index', $data);
	}

	public function getFilterData()
	{
		//echo '<pre>'; print_r($this->input->get()); die;
		$where = array();
		if($this->input->get('property_id')){
			$where['rm.property_id'] = $this->input->get('property_id');
		}
		if($this->input->get('accommodation_id')){
			$where['rm.accommodation_id'] = $this->input->get('accommodation_id');
		}
		if($this->input->get('rate_category_id')){
			$where['rm.rate_category_id'] = $this->input->get('rate_category_id');
		}
		$result = $this->Rate_master->get($where);
		$response = array(
			'success' => TRUE,
			'data'=> $result
		);

		echo json_encode($response); exit;
	}

	public function add()
	{
		$data = array();
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['accommodations'] = $this->Accommodations->get();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['content'] = 'admin/rates/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitRateData()
	{
		$result = array();
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('accommodation_id','Accommodation','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
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
					$data = array(
						'property_id' => $this->input->post('property_id'),
						'accommodation_id' => $this->input->post('accommodation_id'),
						'plan_id' => ($this->input->post('rate_category_id') != '') ? $this->input->post('rate_category_id') : 1,
						'rate_category_id' => ($this->input->post('rate_category_id') != '') ? $this->input->post('rate_category_id') : 1,
						'base_price' => $this->input->post('base_rate'),
	
						'mon_method' => $this->input->post('method') ? $this->input->post('method')[0] : 0,
						'mon_per' => $this->input->post('percentage') ? $this->input->post('percentage')[0] : 0,
						'mon_price' => $this->input->post('price') ? $this->input->post('price')[0] : 0,
	
						'tue_method' => $this->input->post('method') ? $this->input->post('method')[1] : 0,
						'tue_per' => $this->input->post('percentage') ? $this->input->post('percentage')[1] : 0,
						'tue_price' => $this->input->post('price') ? $this->input->post('price')[1] : 0,
	
						'wed_method' => $this->input->post('method') ? $this->input->post('method')[2] : 0,
						'wed_per' => $this->input->post('percentage') ? $this->input->post('percentage')[2] : 0,
						'wed_price' => $this->input->post('price') ? $this->input->post('price')[2] : 0,
						
						'thu_method' => $this->input->post('method') ? $this->input->post('method')[3] : 0,
						'thu_per' => $this->input->post('percentage') ? $this->input->post('percentage')[3] : 0,
						'thu_price' => $this->input->post('price') ? $this->input->post('price')[3] : 0,
	
						'fri_method' => $this->input->post('method') ? $this->input->post('method')[4] : 0,
						'fri_per' => $this->input->post('percentage') ? $this->input->post('percentage')[4] : 0,
						'fri_price' => $this->input->post('price') ? $this->input->post('price')[4] : 0,
	
						'sat_method' => $this->input->post('method') ? $this->input->post('method')[5] : 0,
						'sat_per' => $this->input->post('percentage') ? $this->input->post('percentage')[5] : 0,
						'sat_price' => $this->input->post('price') ? $this->input->post('price')[5] : 0,
	
						'sun_method' => $this->input->post('method') ? $this->input->post('method')[6] : 0,
						'sun_per' => $this->input->post('percentage') ? $this->input->post('percentage')[6] : 0,
						'sun_price' => $this->input->post('price') ? $this->input->post('price')[6] : 0,
	
						'extra_bed' => $this->input->post('extra_bed'),
						'mon_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[0] : 0,
						'tue_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[1] : 0,
						'wed_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[2] : 0,
						'thu_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[3] : 0,
						'fri_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[4] : 0,
						'sat_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[5] : 0,
						'sun_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[6] : 0,
	
						'food_rate' => $this->input->post('food_rate'),
						'mon_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[0] : 0,
						'tue_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[1] : 0,
						'wed_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[2] : 0,
						'thu_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[3] : 0,
						'fri_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[4] : 0,
						'sat_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[5] : 0,
						'sun_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[6] : 0,
	
						'child_rate' => $this->input->post('child_rate'),
						'mon_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[0] : 0,
						'tue_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[1] : 0,
						'wed_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[2] : 0,
						'thu_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[3] : 0,
						'fri_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[4] : 0,
						'sat_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[5] : 0,
						'sun_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[6] : 0,
	
						'eff_start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
						'eff_end_date' => $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '9999-12-31',
						'created_by' => 1,
						'created_ts' => date('Y-m-d H:i:s'),
					);
					//echo "<pre>"; print_r($data); die;
					$result = $this->Rate_master->add($data);
					if($result){
						$this->session->set_flashdata('success_msg', 'Rate Details Added Successfully.');
						$response = array(
							'success' => TRUE,
							'message' => 'Rate Details Added Successfully.',
							'data'=> $result
						);
					}else{
						$response = array(
							'success' => FALSE,
							'message' => 'Room Rate conflicts with previous data for this Property, Accomodation, Rate Category and the date range.',
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
				'message' => 'Unable to add data.',
				'data'=> $result
			);
		}
		echo json_encode($response); exit;
	}
	
	public function edit($rate_id = '')
	{
		$data = array();
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['accommodations'] = $this->Accommodations->get();
		$data['rate_categories'] = $this->Rate_category_master->get();
		$data['rate'] = $this->Rate_master->get(array('rm.rate_id'=> $rate_id));
		$data['content'] = 'admin/rates/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateRateData($rate_id = '')
	{
		$result = array();
		if($this->input->post()){
			if($this->input->post()){
				$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
				$this->form_validation->set_rules('accommodation_id','Accommodation','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
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
						$data = array(
							'property_id' => $this->input->post('property_id'),
							'accommodation_id' => $this->input->post('accommodation_id'),
							'plan_id' => ($this->input->post('rate_category_id') != '') ? $this->input->post('rate_category_id') : 1,
							'rate_category_id' => ($this->input->post('rate_category_id') != '') ? $this->input->post('rate_category_id') : 1,
							'base_price' => $this->input->post('base_rate'),
		
							'mon_method' => $this->input->post('method') ? $this->input->post('method')[0] : 0,
							'mon_per' => $this->input->post('percentage') ? $this->input->post('percentage')[0] : 0,
							'mon_price' => $this->input->post('price') ? $this->input->post('price')[0] : 0,
		
							'tue_method' => $this->input->post('method') ? $this->input->post('method')[1] : 0,
							'tue_per' => $this->input->post('percentage') ? $this->input->post('percentage')[1] : 0,
							'tue_price' => $this->input->post('price') ? $this->input->post('price')[1] : 0,
		
							'wed_method' => $this->input->post('method') ? $this->input->post('method')[2] : 0,
							'wed_per' => $this->input->post('percentage') ? $this->input->post('percentage')[2] : 0,
							'wed_price' => $this->input->post('price') ? $this->input->post('price')[2] : 0,
							
							'thu_method' => $this->input->post('method') ? $this->input->post('method')[3] : 0,
							'thu_per' => $this->input->post('percentage') ? $this->input->post('percentage')[3] : 0,
							'thu_price' => $this->input->post('price') ? $this->input->post('price')[3] : 0,
		
							'fri_method' => $this->input->post('method') ? $this->input->post('method')[4] : 0,
							'fri_per' => $this->input->post('percentage') ? $this->input->post('percentage')[4] : 0,
							'fri_price' => $this->input->post('price') ? $this->input->post('price')[4] : 0,
		
							'sat_method' => $this->input->post('method') ? $this->input->post('method')[5] : 0,
							'sat_per' => $this->input->post('percentage') ? $this->input->post('percentage')[5] : 0,
							'sat_price' => $this->input->post('price') ? $this->input->post('price')[5] : 0,
		
							'sun_method' => $this->input->post('method') ? $this->input->post('method')[6] : 0,
							'sun_per' => $this->input->post('percentage') ? $this->input->post('percentage')[6] : 0,
							'sun_price' => $this->input->post('price') ? $this->input->post('price')[6] : 0,
		
							'extra_bed' => $this->input->post('extra_bed'),
							'mon_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[0] : 0,
							'tue_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[1] : 0,
							'wed_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[2] : 0,
							'thu_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[3] : 0,
							'fri_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[4] : 0,
							'sat_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[5] : 0,
							'sun_ex_price' => $this->input->post('ex_bed') ? $this->input->post('ex_bed')[6] : 0,
		
							'food_rate' => $this->input->post('food_rate'),
							'mon_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[0] : 0,
							'tue_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[1] : 0,
							'wed_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[2] : 0,
							'thu_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[3] : 0,
							'fri_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[4] : 0,
							'sat_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[5] : 0,
							'sun_food_rate' => $this->input->post('per_persion') ? $this->input->post('per_persion')[6] : 0,
		
							'child_rate' => $this->input->post('child_rate'),
							'mon_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[0] : 0,
							'tue_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[1] : 0,
							'wed_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[2] : 0,
							'thu_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[3] : 0,
							'fri_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[4] : 0,
							'sat_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[5] : 0,
							'sun_child_rate' => $this->input->post('per_child') ? $this->input->post('per_child')[6] : 0,
		
							'eff_start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
							'eff_end_date' => $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '9999-12-31',
							'updated_by' => 1,
							'updated_ts' => time(),
						);
						$result = $this->Rate_master->update($rate_id, $data);
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
								'message' => 'Home Rate conflicts with previous data for this Property, Accomodation, Rate Category and the date range.',
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

}
