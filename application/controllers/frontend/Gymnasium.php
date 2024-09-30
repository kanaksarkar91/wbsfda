<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gymnasium extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') {
			$this->load->model('mcommon');
			$this->load->model('frontend/query');
		}else{
			redirect(base_url());
		}
		
	}


	public function saveProfile() {
		if($this->input->post('eligiblegym')=='yes') {
			$is_employee = 1;
		}else{
			$is_employee = 0;
		}
		if(!$is_employee) {
			$data = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'is_employee'		=> $is_employee,
				'sports_facilities_id'=> $this->input->post('sports_facilities_id'),
				'name'				=> $this->input->post('gym_no_name'),
				'full_address'		=> $this->input->post('gym_no_full_address'),
				'gender'			=> $this->input->post('gym_no_radio_gender'),
				'dob'				=> $this->input->post('gym_no_dob'),
				'age'				=> $this->input->post('gym_no_age'),
				'profession_id'		=> $this->input->post('gym_no_profession'),
				'email'				=> $this->input->post('gym_no_email'),
				'phone'				=> $this->session->userdata('mobile'),
				'payment_status'	=> 0
			);
			//echo "<pre>"; print_r($data); die();
			
		}else{
			$data = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'is_employee'		=> $is_employee,
				'sports_facilities_id'=> $this->input->post('sports_facilities_id'),
				'name'				=> $this->input->post('gym_yes_name'),
				'gender'			=> $this->input->post('gym_yes_radio_gender'),
				'dob'				=> $this->input->post('gym_yes_dob'),
				'age'				=> $this->input->post('gym_yes_age'),
				'employee_id'		=> $this->input->post('gym_yes_employee_id'),
				'division_id'		=> $this->input->post('gym_yes_division'),
				'department'		=> $this->input->post('gym_yes_department'),
				'designation'		=> $this->input->post('gym_yes_designation'),
				'billing_unit'		=> $this->input->post('gym_yes_billing_unit'),
				'email'				=> $this->input->post('gym_yes_email'),
				'phone'				=> $this->session->userdata('mobile'),
				'booking_status'	=> 0
			);

		}
		$user_details = $this->mcommon->getRow('users_gymnasium', array('user_id'=>$this->session->userdata('user_id')));
		if(!$user_details) {
			$this->mcommon->insert('users_gymnasium', $data);
		}else{
			$this->mcommon->update('users_gymnasium', array('phone'=>$this->session->userdata('mobile')), $data);
		}
		
		$session_data = array_merge($this->session->userdata(), array('gymnasium'=>$data));
		$this->session->set_userdata($session_data);

		$this->session->set_flashdata('success_msg', 'Gymnasium Profile been updated.');
		if(!$is_employee) {
			redirect(base_url('apply-gymnasium'));
		}else{
			redirect(base_url('create-profile?source=gymnasium'));
		}
	}

	


	public function applyGymnasium() {
		$is_employee = $this->session->userdata('gymnasium')['is_employee'];
		if($is_employee) {
			$emp = 'Employees';
		}else{
			$emp = 'Non-employees';
		}
		$data['user_details'] = $this->mcommon->getRow('users_gymnasium', array('user_id'=>$this->session->userdata('user_id')));
		$data['gymnasium_rates'] = $this->query->getGymnasiumRates($this->session->userdata('gymnasium')['sports_facilities_id'], $emp);
		//if($data['gymnasium_rates']) {
			$data['content'] = 'frontend/applyGymnasium';
			$this->load->view('frontend/layouts/index', $data);
		//}
	}


	public function addMemberToGymnasium() {
		//echo "<pre>"; print_r($this->input->post()); die();
		if($this->input->post('member_name')) {
			foreach($this->input->post('member_name') as $key => $member_name){
				$data = array(
					'user_id'=>$this->session->userdata('user_id'),
					'member_name'=>$member_name,
					'relation'=>$this->input->post('relation')[$key],
					'division_id'=>$this->input->post('division')[$key],
					'location_id'=>$this->input->post('location')[$key],
					'facilities_id'=>$this->input->post('facilities_id')[$key]
				);
				$this->mcommon->insert('gymnasium_member', $data);
			}
			$this->session->set_flashdata('success_msg', 'Member has been added successfully.');
			redirect(base_url('create-profile?source=gymnasium'));
		}else{
			$this->session->set_flashdata('error_msg', 'Please add member and submit');
			redirect(base_url('create-profile?source=gymnasium'));
		}	
	}

	public function generateSchedule() {
		//echo "<pre>"; print_r($this->input->post('schedule_data')); die();
		if($this->input->post('schedule_data')) {
			
			$schedule_data = $this->input->post('schedule_data');
			$user_id = $this->input->post('user_id');
			$gymnasium_rate_id = $this->input->post('gymnasium_rate_id');
			$total_payment = $this->input->post('total_payment');

			// $payment_id = $this->mcommon->insert('payment', array(
			// 	'user_id'=>$this->input->post('user_id'),
			// 	'total_amount'=>$this->input->post('total_payment')
			// ));
			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

			$this->mcommon->update('users_gymnasium',array('user_id'=>$this->input->post('user_id')),array('gymnasium_registration_fee'=>$this->input->post('total_payment')));

			foreach($schedule_data as $schedule) {
				if($schedule['check'] == 'yes') {
					$insert_data = array(
						'user_id'=>$user_id,
						'gymnasium_rate_id'=>$gymnasium_rate_id,
						'txnid'=>$txnid,
						'month_year'=>$schedule['date'],
						'subscription_amount'=>$schedule['amount'],
						'payment_status'=>0
					);
				}else{
					$insert_data = array(
						'user_id'=>$user_id,
						'gymnasium_rate_id'=>$gymnasium_rate_id,
						'txnid'=>$txnid,
						'month_year'=>$schedule['date'],
						'subscription_amount'=>$schedule['amount'],
						'payment_status'=>1
					);
				}
				$this->mcommon->insert('gymnasium_schedule_temp', $insert_data);
			}
			// $this->session->set_flashdata('success_msg', 'Payment Schedule has been generated');
			// redirect(base_url('generate-schedule'));
			echo json_encode(array('txnid'=>$txnid));

		}else{
			$this->session->set_flashdata('error_msg', 'Please select one month to generate schedule');
			redirect(base_url('generate-schedule'));
		}
	}

	public function paymentSchedule() {
		if($this->input->post('schedule_data')) {
			$schedule_data = $this->input->post('schedule_data');
			//echo "<pre>"; print_r($schedule_data); die();
			$user_id = $this->input->post('user_id');
			$gymnasium_rate_id = $this->input->post('gymnasium_rate_id');
			$total_payment = $this->input->post('total_payment');

			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

			foreach($schedule_data as $schedule) {
				if($schedule['check'] == 'yes') {
					$insert_data = array(
						'gs_id'=>$schedule['gymnasium_schedule_id'],
						'user_id'=>$user_id,
						'gymnasium_rate_id'=>$gymnasium_rate_id,
						'txnid'=>$txnid,
						'month_year'=>$schedule['date'],
						'subscription_amount'=>$schedule['amount'],
						'payment_status'=>0
					);
					//echo "<pre>"; print_r($insert_data);
					$this->mcommon->insert('gymnasium_schedule_temp', $insert_data);
				}
			}
			echo json_encode(array('txnid'=>$txnid));
			//die();
		}
	}

	public function proceedPayment() {
		$postdata = $this->input->post();
        $postdatanew = array();
        foreach($postdata as $key=>$val){
            $postdatanew[$key] = isset($postdata[$key]) ? $val : '';
        }
        //echo "<pre>"; print_r($this->session->userdata()); die();
        $payu['amount'] = $postdatanew['grand_total'];
        $payu['surl'] 	= $postdatanew['surl'];
        $payu['furl'] 	= $postdatanew['furl'];
        $payu['productinfo'] = 'subscription';
        $payu['firstname'] = $this->session->userdata('gymnasium')['name'];
        $payu['email'] = $this->session->userdata('gymnasium')['email'];
        $payu['phone'] = $this->session->userdata('mobile');
        
        $payu['MERCHANT_KEY'] = _STAGE_MERCHANT_KEY;
        $payu['SALT'] = _STAGE_SALT;
        $payu['PAYU_BASE_URL'] = _STAGE_PAYU_BASE_URL;

        if(empty($postdatanew['txnid'])) {
        	// Generate random transaction id
            $payu['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
            $payu['txnid'] = $postdatanew['txnid'];
        }

        $hashSequence = "key|txnid|amount|productinfo|firstname|email|||||||||||SALT";  
        $hash_string  = $payu['MERCHANT_KEY'].'|'.$payu['txnid'].'|'.$postdatanew['grand_total'].'|'.$payu['productinfo'].'|'.$payu['firstname'].'|'.$payu['email'];
        $hash_string .= '|||||||||||'.$payu['SALT'];
        $payu['hash'] =  hash("sha512", $hash_string);
        
        $data['payudata'] = $payu;
        $data['content'] = 'frontend/previewpay';
		$this->load->view('frontend/layouts/index', $data);
	}
	// function test(){
	// 	//echo "string";die();
	// 	$data['content'] = 'frontend/previewpay';
	// 	$this->load->view('frontend/layouts/index', $data);
	// }
	

	public function mySubscription() {
		//echo "<pre>"; print_r($this->session->userdata());
		$data['user_details'] = $this->mcommon->getRow('users_gymnasium', array('user_id'=>$this->session->userdata('user_id')));
		$is_employee = $this->session->userdata('gymnasium')['is_employee'];
		if($is_employee) {
			$emp = 'Employees';
		}else{
			$emp = 'Non-employees';
		}
		$data['user_details'] = $this->mcommon->getRow('users_gymnasium', array('user_id'=>$this->session->userdata('user_id')));
		$data['gymnasium_rates'] = $this->query->getGymnasiumRates($this->session->userdata('gymnasium')['sports_facilities_id'], $emp);
		//echo "<pre>"; print_r($data['gymnasium_rates']); die();

		if($data['user_details']['is_employee']==1){
			$data['members'] = $this->query->getMemberDetailsByUser_id($this->session->userdata('user_id'));
			//echo "<pre>"; print_r($data['members']); die();
			$data['content'] = 'frontend/myMembers';
			$this->load->view('frontend/layouts/index', $data);
		}else{
			$data['subscription'] = $this->mcommon->getDetails('gymnasium_schedule', array('user_id'=>$this->session->userdata('user_id')));
			$data['content'] = 'frontend/mySubscription';
			$this->load->view('frontend/layouts/index', $data);
		}
	}

	public function memberSubscription($gymnasium_member_id) {
		$data['member'] = $this->query->getMemberDetails($gymnasium_member_id);
		$data['subscription'] = $this->mcommon->getDetails('gymnasium_schedule', array('gymnasium_member_id'=>$gymnasium_member_id));
		$data['content'] = 'frontend/memberSubscription';
		$this->load->view('frontend/layouts/index', $data);

	}
}