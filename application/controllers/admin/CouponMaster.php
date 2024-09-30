<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CouponMaster extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mcoupon'); 
		$this->load->model('admin/mproperty');
	}
	
	public function index()
	{
		$data = array('menu_id'=> 36);
		$data['slug'] =  $this->input->get('slug');
		$data['coupons'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$condition = array();
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$condition = array('created_by' => $this->admin_session_data['user_id']);
			}
			$data['coupons'] = $this->mcoupon->get($condition);
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/couponmaster/index';
		$this->load->view('admin/layouts/index', $data);
	}
		
	public function add() 
	{
		$data = array();
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['content'] = 'admin/couponmaster/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function store()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('coupon_code','Coupon Code','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('coupon_desc', 'Coupon Description', 'trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|in_list[0]');
			$this->form_validation->set_rules('amount', 'Discount Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				echo json_encode(array('success'=> FALSE, 'message'=> validation_errors()));
				exit;
			}
			else {
				$code_availability = $this->mcoupon->get(array('coupon_code'=> $this->input->post('coupon_code')));
				if(!empty($code_availability)){
					echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Coupon code is already added.'));
					exit;
				}
				$data = array(
					'coupon_code' => $this->input->post('coupon_code'),
					'coupon_desc' => $this->input->post('coupon_desc'),
					'property_id' => !empty($this->input->post('property')) ? $this->input->post('property') : 0 ,
					'valid_from_date' => $this->input->post('valid_from_date'),
					'valid_to_date' => $this->input->post('valid_to_date'),
					'offer_perc' => $this->input->post('discount_type') == 0 ? $this->input->post('amount') : null,
					'offer_amount' => $this->input->post('discount_type') == 1 ? $this->input->post('amount') : null,
					'is_active' => $this->input->post('is_active'),
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				$result = $this->mcoupon->submit($data);
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Coupon Code Added Successfully.');
					echo json_encode(array('success'=> TRUE, 'message'=> 'Coupon Code Added Successfully.'));
					exit;
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add Coupon.');
					echo json_encode(array('success'=> FALSE, 'message'=> 'Unable to add Coupon.'));
					exit;
				}
			}
		}
		
		
	}
	
	public function edit($id)
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['coupons'] = $this->mcoupon->get(array('coupon_id'=> $id));
		$data['coupon'] = !empty($data['coupons']) ? $data['coupons'][0] :array();
		$data['content'] = 'admin/couponmaster/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function update($id) 
	{
		if($this->input->post()){
			$this->form_validation->set_rules('coupon_code','Coupon Code','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('coupon_desc', 'Coupon Description', 'trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|in_list[0]');
			$this->form_validation->set_rules('amount', 'Discount Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				echo json_encode(array('success'=> FALSE, 'message'=> validation_errors()));
				exit;
			}
			else {
				$code_availability = $this->mcoupon->get(array('coupon_code'=> $this->input->post('coupon_code'), 'coupon_id !='=> $id));
				if(!empty($code_availability)){
					echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Coupon code is already added.'));
					exit;
				}
				if($this->input->post('discount_type') == '0' && $this->input->post('amount') >= 100){
					echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Invalid discount.'));
					exit;
				}
				$data = array(
					'coupon_code' => $this->input->post('coupon_code'),
					'coupon_desc' => $this->input->post('coupon_desc'),
					'property_id' => !empty($this->input->post('property')) ? $this->input->post('property') : 0 ,
					'valid_from_date' => $this->input->post('valid_from_date'),
					'valid_to_date' => $this->input->post('valid_to_date'),
					'offer_perc' => $this->input->post('discount_type') == 0 ? $this->input->post('amount') : null,
					'offer_amount' => $this->input->post('discount_type') == 1 ? $this->input->post('amount') : null,
					'is_active' => $this->input->post('is_active'),
					'created_by' => $this->admin_session_data['user_id'],
					'created_ts' => date('Y-m-d H:i:s')
				);
				$result = $this->mcoupon->update(array('coupon_id'=> $id), $data);
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Coupon Code Updated Successfully.');
					echo json_encode(array('success'=> TRUE, 'message'=> 'Coupon Code Updated Successfully.'));
					exit;
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to update Coupon.');
					echo json_encode(array('success'=> FALSE, 'message'=> 'Unable to update Coupon.'));
					exit;
				}
			}
		}
		
	}

}