<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Safari_booking extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/msafari_service', 'mcommon', 'frontend/msafari_booking'));
		$this->load->helper(array('gst'));

	}
	
	public function index()
	{
		$data = array('menu_id'=> 73);
		$where = [];
		$data['start_date']= $this->input->post('start_date'); 
		$data['end_date']= $this->input->post('end_date');
		$data['safari_type_id']= $this->input->post('safari_type_id');
		$data['division_id']= $this->input->post('division_id');
		$data['safari_service_header_id']= $this->input->post('safari_service_header_id');
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['a.booking_date >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['a.booking_date <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
			if($this->input->post('safari_type_id') != 0){
				$where['a.safari_type_id = '] = $this->input->post('safari_type_id');
			}
			if($this->input->post('division_id') != 0){
				$where['a.division_id = '] = $this->input->post('division_id');
			}
			if($this->input->post('safari_service_header_id') != 0){
				$where['a.safari_service_header_id = '] = $this->input->post('safari_service_header_id');
			}
		}
		$where['a.booking_status != '] = 'F';
		//$order_by = 'bh.booking_id DESC';
		$order_by = 'DATE(a.created_ts) DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['bookings'] = [];
		$safari_service_header_ids = [];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$safari_service_header_ids =  $this->mcommon->get_user_service(array('user_id' => $this->admin_session_data['user_id']));
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($safari_service_header_ids)){
				$data['bookings'] = $this->msafari_service->get_booking($where, $order_by, $safari_service_header_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		
		$data['typeData'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['divisionData'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1), 'division_name', 'ASC');
		
		$data['content'] = 'admin/safari_booking/list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function block()
	{
		$data = array('menu_id'=> 74);
		$where = [];
		$data['start_date']= $this->input->post('start_date'); 
		$data['end_date']= $this->input->post('end_date');
		$data['safari_type_id']= $this->input->post('safari_type_id');
		$data['division_id']= $this->input->post('division_id');
		$data['safari_service_header_id']= $this->input->post('safari_service_header_id');
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['a.booking_date >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['a.booking_date <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
			if($this->input->post('safari_type_id') != 0){
				$where['a.safari_type_id = '] = $this->input->post('safari_type_id');
			}
			if($this->input->post('division_id') != 0){
				$where['a.division_id = '] = $this->input->post('division_id');
			}
			if($this->input->post('safari_service_header_id') != 0){
				$where['a.safari_service_header_id = '] = $this->input->post('safari_service_header_id');
			}
		}
		//$order_by = 'bh.booking_id DESC';
		$order_by = 'DATE(a.created_ts) DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['blockedBookings'] = [];
		$safari_service_header_ids = [];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$safari_service_header_ids =  $this->mcommon->get_user_service(array('user_id' => $this->admin_session_data['user_id']));
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($safari_service_header_ids)){
				$data['blockedBookings'] = $this->msafari_service->get_block_booking($where, $order_by, $safari_service_header_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		
		$data['typeData'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['divisionData'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1), 'division_name', 'ASC');
		
		$data['content'] = 'admin/safari_block/list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function getSlots()
	{
		$data_list = array();
		$safari_service_header_id = $this->input->post('safari_service_header_id');
		$service_period_master_id = $this->input->post('service_period_master_id');
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0 && is_numeric($service_period_master_id) && $service_period_master_id > 0){
			$data_list = $this->msafari_service->getSlotsASC(array('is_active' => 1, 'safari_service_header_id' => $safari_service_header_id, 'service_period_master_id' => $service_period_master_id));
			
			$response = array("status"=> true, "list"=>$data_list);
		}
		else{
			$response = array("status"=> false, "list"=>$data_list);
		}
		
		echo json_encode($response);
		exit;
	}
	public function add_safari_block($pre_data = array())
	{
		$data = array();
		$data['typeData'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['divisionData'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1), 'division_name', 'ASC');
		$data['periods'] = $this->mcommon->getDetailsOrder('safari_service_period_master', array('is_active' => 1), 'service_period_master_id', 'ASC');
		
		$data['content'] = 'admin/safari_block/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submit_block_data()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('safari_type_id','Safari Type','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('division_id','Park','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('safari_service_header_id','Safari', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('service_period_master_id','Period','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('period_slot_dtl_id','Slot','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('block_date','Block Date','trim|required');
			$this->form_validation->set_rules('no_of_person','No. of Person','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('remarks','Remarks','trim|required');
			$this->form_validation->set_rules('status_flag', 'Status', 'trim|required|in_list[1,2]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/safari_booking/block");
			}
			else {
				
				$safari_type_id = $this->input->post('safari_type_id');
				$division_id = $this->input->post('division_id');
				$safari_service_header_id = $this->input->post('safari_service_header_id');
				$service_period_master_id = $this->input->post('service_period_master_id');
				$period_slot_dtl_id = $this->input->post('period_slot_dtl_id');
				$block_date = $this->input->post('block_date');
				$no_of_person = $this->input->post('no_of_person');
				$status_flag = $this->input->post('status_flag');
				$remarks = $this->input->post('remarks');
				
				$safariSlots = $this->msafari_booking->get_booking_slot_list($safari_type_id, $division_id, $safari_service_header_id, $block_date, 1);
				
				$foundSlot = null;
				if(!empty($safariSlots)){
					
					foreach ($safariSlots as $slot) {
						if ($slot['period_slot_dtl_id'] == $period_slot_dtl_id) {
							$foundSlot = $slot;
							break; // Exit the loop if found
						}
					}
					//echo "<pre>"; print_r($foundSlot); die;
				}
				
				if ($foundSlot) {
					if($foundSlot['available_qty'] >= $no_of_person){
						
						$data = array(
							'safari_type_id' => $safari_type_id,
							'division_id' => $division_id,
							'safari_service_header_id' => $safari_service_header_id,
							'period_slot_dtl_id' => $period_slot_dtl_id,
							'block_date' => $block_date,
							'no_of_person' => $no_of_person,
							'remarks' => $remarks,
							'status_flag' => $status_flag,
							'created_by' => $this->admin_session_data['user_id'],
							'created_ts' => date('Y-m-d H:i:s')
						);
						
						//echo '<pre>'; print_r($data); die;
						
						$result = $this->mcommon->insert('safari_sdervice_blocked', $data);
							
						if ($result) {
							$this->session->set_flashdata('success_msg', 'Safari Blocked Successfully');
							redirect("admin/safari_booking/block");
						}
						
					}
					else {
						$this->session->set_flashdata('error_msg', 'Sorry Maximum Seat/s Available '.$foundSlot['available_qty']);
						redirect("admin/safari_booking/block");
					}
				}
			}
		}
		
	}


}
