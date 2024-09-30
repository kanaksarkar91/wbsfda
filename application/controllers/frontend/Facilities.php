<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') {
			$this->load->model('mcommon');
			$this->load->model('frontend/query');
		//}else{
			//redirect(base_url());
		//}
		
	}

	public function viewDetails($sports_facilities_id) {
		//echo $sports_facilities_id;
		$data['facilities'] = $this->query->getSportsFacility($sports_facilities_id);
		$data['facilitY_images'] = $this->query->getSportsFacilityImages($sports_facilities_id);
		$data['content'] = 'frontend/viewFacilitiyDetails';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function viewGymnasiumDetails($sports_facilities_id) {
		$data['facilities'] = $this->query->getSportsFacility($sports_facilities_id);
		$data['facilitY_images'] = $this->query->getSportsFacilityImages($sports_facilities_id);
		$data['content'] = 'frontend/viewGymnasiumDetails';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function checkAvailableRate($sports_facilities_id) {
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		//echo $start_date.'<br>';
		//echo $end_date.'<br>'; die();
		$data['sports_facilities_id'] = $sports_facilities_id;
		$data['facilities'] = $this->query->getSportsFacility($sports_facilities_id);
		if($data['facilities']) {
			//echo "<pre>"; print_r($data['facilities']); die();
			$data['rates'] = $this->query->getSportsFacilityRates($sports_facilities_id, $start_date, $end_date);
			$data['content'] = 'frontend/checkAvailableRate';
			$this->load->view('frontend/layouts/index', $data);
		}
		
	}

	public function reserveFacility($sports_facilities_id) {
		//echo "<pre>"; print_r($this->session->userdata()); die();
		if($this->session->userdata('organization_type')) {
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$data['facilities'] = $this->query->getSportsFacility($sports_facilities_id);
			//echo "<pre>"; print_r($data['facilities']); die();
			//echo "<pre>"; print_r($this->session->userdata('organization_type')); die();
			$data['sports_facilities_id'] = $sports_facilities_id;
			$data['rates'] = $this->query->getSportsFacilityRates($sports_facilities_id, $start_date, $end_date);
			$data['content'] = 'frontend/reserveFacility';
			$this->load->view('frontend/layouts/index', $data);
		}else{
			redirect(base_url('create-profile'));
		}
		
	}

	public function bookingFacility() {
		//echo "<pre>"; print_r($this->input->post());
		if($this->input->post()) {
			$form = array();
			foreach($this->input->post('form_data') as $key=>$formm) {
				$form[$formm['name']] = $formm['value'];
			}
			$form['user_id'] = $this->session->userdata('user_id');
			//echo "<pre>"; print_r($form);
			$form['total_rate'] = $this->input->post('total_price');
			
			$booking_id = $this->mcommon->insert('sports_facilities_booking', $form);

			foreach($this->input->post('date') as $key => $date){
				$form2 = array(
					'booking_id' => $booking_id,
					'organization_type' => $this->session->userdata('organization_type'),
					'rate_id' => $this->input->post('rate_id')[$key],
					'rate' => $this->input->post('prices')[$key],
					'start_date' => $date,
					'status' => '0'
				);
				$sub_booking_id = $this->mcommon->insert('sports_facilities_booking_details', $form2);
			}
			echo json_encode(array('booking_id'=>$booking_id));
		}else{
			echo false;
		}
	}

	public function myBookings() {
		$data['bookings'] = $this->query->getMyBookings($this->session->userdata('user_id'));
		$data['content'] = 'frontend/myBooking';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function generateTxnid() {
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$booking_id = $this->input->post('booking_id');
		$this->mcommon->update('sports_facilities_booking', array('booking_id'=>$booking_id), array('txnid'=>$txnid));
		echo json_encode(array('txnid'=>$txnid));
	}

}