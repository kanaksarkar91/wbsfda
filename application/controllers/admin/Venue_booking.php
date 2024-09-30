<?php
defined('BASEPATH') or exit('No direct script access allowed');

//class Venue_booking extends CI_Controller
class Venue_booking extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcommon');
		$this->load->model('frontend/query');
		$this->load->model('admin/mvenuebooking');
		$this->load->model('admin/mbooking');
		$this->load->model('admin/mvenue_reservation');
		$this->load->model('frontend/mbooking');
		$this->load->model('admin/mcancellationpolicy');
		$this->load->helper(array('sms', 'email', 'common_helper', 'crypto', 'url', 'otp'));
	}

	public function index()
	{ 
		$data = array();
		$data['landscape_properties'] = $this->mvenuebooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1, 'property_master.is_venue' => 1));
		$data['property_types'] = $this->mvenuebooking->get_property_types(array('is_active' => 1));
		$data['content'] = 'admin/venue_booking/add_venue_booking';
		$this->load->view('admin/layouts/index', $data);
	}

	public function search()
	{
		$search_keywords = $this->input->get('wish') != '' ? $this->input->get('wish') : NULL;
		$landscape = $this->input->get('landscape_property') != '' ? $this->input->get('landscape_property') : NULL;
		$property_type = $this->input->get('venue_type') != '' ? $this->input->get('venue_type') : NULL;
		$check_in_dt = $this->input->get('checkindt_venue') != '' ? $this->input->get('checkindt_venue') : NULL;
		$check_out_dt = $this->input->get('checkoutdt_venue') != '' ? $this->input->get('checkoutdt_venue') : NULL;

		//$stay_date_range_arr = explode(' - ', $stay_date_range);
		$from_date = $check_in_dt != '' ? date('d/m/Y', strtotime(substr($check_in_dt, 4) . '-' . substr($check_in_dt, 2, -4) . '-' . substr($check_in_dt, 0, -6))) : '';
		$to_date = $check_out_dt != '' ? date('d/m/Y', strtotime(substr($check_out_dt, 4) . '-' . substr($check_out_dt, 2, -4) . '-' . substr($check_out_dt, 0, -6))) : '';

		$data = array('search_keywords' => $search_keywords, 'landscape' => $landscape, 'property_type' => $property_type,'checkin' => $check_in_dt, 'checkout' => $check_out_dt, 'from_date' => $from_date, 'to_date' => $to_date);

		$data['landscape_properties'] = $this->mvenuebooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1, 'property_master.is_venue' => 1));
		$data['property_types'] = $this->mvenuebooking->get_property_types(array('is_active' => 1));
		$data['content'] = 'admin/venue_booking/venue_search';
		$this->load->view('admin/layouts/index', $data);
	}

	public function searchProcess()
	{
		$venues=array();
		$search_type = $this->input->post('type') != '' ? $this->input->post('type') : '';
		$keywords = $this->input->post('keywords') != '' ? $this->input->post('keywords') : '';
		$landscape = $this->input->post('landscape_property') != '' ? $this->input->post('landscape_property') : '';
		$stay_date_range = $this->input->post('date_range') != '' ? $this->input->post('date_range') : '';
		$selectedOption = $this->input->post('selectedOption') != '' ? $this->input->post('selectedOption') : '';

		$response = array('success' => false,);

		if ($search_type == '1') {
			$landscape = $landscape != '' ? $landscape : 0;
			$where = array();
			if($landscape){
			$where['vrm.property_id'] = $landscape;
		}
			$venues = $this->mvenuebooking->getVenueListPropertyWise( $where);
			$response = array('success' => true, 'check_in_dt' => '', 'check_out_dt' => '', 'result' => $venues);
		}
		if ($search_type == '2') {
			$from_date = $to_date = '';
			
			if (isset($stay_date_range) && $stay_date_range != '') {
				$stay_date_range_arr = explode(' - ', $stay_date_range);
				$form_date_arr = explode('/', $stay_date_range_arr[0]);
				$from_date = date('Y-m-d', strtotime($form_date_arr[2] . '-' . $form_date_arr[1] . '-' . $form_date_arr[0]));
				$to_date_arr = explode('/', $stay_date_range_arr[1]);
				$to_date = date('Y-m-d', strtotime($to_date_arr[2] . '-' . $to_date_arr[1] . '-' . $to_date_arr[0]));
			}
			if($landscape){
				$where['vrm.property_id'] = $landscape;
			}
			if ($from_date) {
				$where['vrm.eff_start_date <='] = $from_date;
			}
			if($to_date){
				$where['vrm.eff_end_date >='] = $to_date;
			}
			if($selectedOption)
			{
				$where['selectedOption'] = $selectedOption;
			}
			$venues = $this->mvenuebooking->getVenueListPropertyWise($where);
			/*$properties = array();
			
			foreach ($properties_arr as $p) {
				var_dump($p);
				if ($p['is_active'] == '1' && $p['is_deleted'] == '0')
					array_push($properties, $p);
			}*/

			$response = array('success' => true, 'check_in_dt' => date('dmY', strtotime($from_date)), 'check_out_dt' => date('dmY', strtotime($to_date)), 'result' => $venues);
		}

		echo json_encode($response);
	}


	public function property_details($property_id,$rate_id, $checkIn_dt = null, $checkOut_dt = null)
	{
		//$property_det = $this->mbooking->get_property_details(array('property_id' => $property_id));

		if($property_id){
			$where['vrm.property_id'] = $property_id;
		}
		if ($rate_id) {
			$where['vrm.rate_id'] = $rate_id;
		}

		$venues= $this->mvenuebooking->getVenueListPropertyWise($where);
		$data['venues'] =$venues;

		$check_in_dt = $checkIn_dt != '' ? date('Y-m-d', strtotime(substr($checkIn_dt, 4) . '-' . substr($checkIn_dt, 2, -4) . '-' . substr($checkIn_dt, 0, -6))) : date('Y-m-d', strtotime('+1 day'));
		$check_out_dt = $checkOut_dt != '' ? date('Y-m-d', strtotime(substr($checkOut_dt, 4) . '-' . substr($checkOut_dt, 2, -4) . '-' . substr($checkOut_dt, 0, -6))) : date('Y-m-d', strtotime('+2 days'));


		$data['rate_category_id'] = $rate_category_id = 1;

		//$data['property'] = $property = $property_det[0];

		//if (!is_null($checkIn_dt) && !is_null($checkOut_dt) && !is_null($adult_pax) && !is_null($child_pax)) {

		//}


		$data['property_id'] = $property_id;
		$data['rate_id']=$rate_id;
		$data['check_in_date'] = $check_in_dt != '' ? date('d/m/Y', strtotime($check_in_dt)) : '';
		$data['check_out_date'] = $check_out_dt != '' ? date('d/m/Y', strtotime($check_out_dt)) : '';
		$data['check_in_date_formatted'] = $check_in_dt != '' ? date('dmY', strtotime($check_in_dt)) : '';
		$data['check_out_date_formatted'] = $check_out_dt != '' ? date('dmY', strtotime($check_out_dt)) : '';
		//$data['no_of_nights'] = $this->calculateBookingNights($check_in_dt, $check_out_dt);

		
		/*$youtube_url = $property['youtube_video_link'];
		$value = explode("v=", $youtube_url);
    	$data['videoId'] = $value[1];*/

		$data['content'] = 'admin/venue_booking/property_details';
		$this->load->view('admin/layouts/index', $data);
	}

	public function checkAvailableRate($rate_id, $checkIn_dt = null, $checkOut_dt = null) {
		$check_in_dt = $checkIn_dt != '' ? date('Y-m-d', strtotime(substr($checkIn_dt, 4) . '-' . substr($checkIn_dt, 2, -4) . '-' . substr($checkIn_dt, 0, -6))) : date('Y-m-d', strtotime('+1 day'));
		$check_out_dt = $checkOut_dt != '' ? date('Y-m-d', strtotime(substr($checkOut_dt, 4) . '-' . substr($checkOut_dt, 2, -4) . '-' . substr($checkOut_dt, 0, -6))) : date('Y-m-d', strtotime('+2 days'));

		$stay_date_range = $this->input->post('date_range') != '' ? $this->input->post('date_range') : '';
		$start_date = $end_date = '';

		if (isset($stay_date_range) && $stay_date_range != '') {
			$stay_date_range_arr = explode(' - ', $stay_date_range);
			$form_date_arr = explode('/', $stay_date_range_arr[0]);
			$start_date = date('Y-m-d', strtotime($form_date_arr[2] . '-' . $form_date_arr[1] . '-' . $form_date_arr[0]));
			$to_date_arr = explode('/', $stay_date_range_arr[1]);
			$end_date = date('Y-m-d', strtotime($to_date_arr[2] . '-' . $to_date_arr[1] . '-' . $to_date_arr[0]));
		}
		//echo $start_date.'<br>';
		//echo $end_date.'<br>'; die();
		$data['rate_id'] = $rate_id;
		if($rate_id){
			$where['vrm.rate_id'] = $rate_id;
		}

		if ($start_date) {
			$where['vrm.eff_start_date <='] = $check_in_dt;
		}
		if($end_date){
			$where['vrm.eff_end_date >='] = $check_out_dt ;
		}

		$data['venues']=$venues = $this->mvenuebooking->getVenueListPropertyWise($where);
		$venueIds=($venues)?$venues[0]->venue_ids:'';
		$data['dayDiff'] = $this->mvenuebooking->checkBookingDateAvailabliltyByVenueWise($venueIds);
		$data['blockedVenueData'] = $this->mvenuebooking->getBlockedVenueDetailsByVenueId($venueIds);
		$from_date = $checkIn_dt != '' ? date('d/m/Y', strtotime(substr($checkIn_dt, 4) . '-' . substr($checkIn_dt, 2, -4) . '-' . substr($checkIn_dt, 0, -6))) : '';
		$to_date = $checkOut_dt != '' ? date('d/m/Y', strtotime(substr($checkOut_dt, 4) . '-' . substr($checkOut_dt, 2, -4) . '-' . substr($checkOut_dt, 0, -6))) : '';

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['from_date_dt'] = $checkIn_dt;
		$data['to_date_dt'] = $checkOut_dt;
		//echo $data['check_in_date'] .' ///'.$data['check_out_date'];die;

		//echo "<pre>"; print_r($data['venues']); die;

		$data['content'] = 'admin/venue_booking/checkAvailableRate';
		$this->load->view('admin/layouts/index', $data);		
	}

	
	public function reserveVenue($rate_id) {
		//echo "<pre>"; print_r($this->session->userdata()); die();
			$tmp_start_date=$start_date = $this->input->get('start_date');
			$tmp_end_date=$end_date = $this->input->get('end_date');
			$data['rate_id'] = $rate_id;
			if($rate_id){
				$where['vrm.rate_id'] = $rate_id;
			}
	
			if ($start_date) {
				$start_date =  date('Y-m-d', strtotime(str_replace('/', '-', $start_date)));
				$where['vrm.eff_start_date <='] = $start_date;
			}
			if($end_date){
				$end_date =  date('Y-m-d', strtotime(str_replace('/', '-', $end_date)));
				$where['vrm.eff_end_date >='] = $end_date;
			}
	
			$data['extra_hours'] = $this->mvenuebooking->extra_hours();
			$data['venues'] =$venues= $this->mvenuebooking->getVenueListPropertyWise($where);
			$venueIds=($venues)?$venues[0]->venue_ids:'';	
			$data['dayDiff'] = $this->mvenuebooking->checkBookingDateAvailabliltyByVenueWise($venueIds);
			$data['blockedVenueData'] = $this->mvenuebooking->getBlockedVenueDetailsByVenueId($venueIds);
			$data['customer_details'] = $this->mcommon->getRow('customer_master', array('customer_id' => $this->session->userdata('customer_id')));
			$data['from_date'] = $tmp_start_date;
			$data['to_date'] = $tmp_end_date;
			$data['customer_list'] = $this->mbooking->get_customer_list();
			$data['content'] = 'admin/venue_booking/reserveVenue';
			$this->load->view('admin/layouts/index', $data);
		
	}



	public function bookingVenue() {

		//echo "<pre>"; print_r($this->input->post()); die;

		if($this->input->post()) {
			$form = array();
			$cust_data=array();
			$is_individual=($this->input->post('selected_tab_value')=='1') ? 1 : 0;
			$user_id= 0;			

			foreach($this->input->post('form_data') as $key=>$formm) {
				if($is_individual==1)
				{
						if($formm['name']=='customer_id')
						{
							$form['user_id'] = $formm['value'];
							$user_id=$formm['value'];
						}
						elseif($formm['name']=='indivisual_full_name')
						{
							$form[$formm['name']] = $formm['value'];
							$cust_data['first_name']=$formm['value'];
						}
						elseif($formm['name']=='indivisual_email')
						{
							$form[$formm['name']] = $formm['value'];
							$cust_data['email']=$formm['value'];
						}
						elseif($formm['name']=='indivisual_contact_no')
						{
							$form[$formm['name']] = $formm['value'];
							$cust_data['mobile']=$formm['value'];
						}
						elseif($formm['name']=='indivisual_full_address')
						{
							$form[$formm['name']] = $formm['value'];
							$cust_data['address']=$formm['value'];
						}
						else
							$form[$formm['name']] = $formm['value'];					
				}
				else{
					if($formm['name']=='business_full_name')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['company_name']=$formm['value'];
					}
					elseif($formm['name']=='business_email')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['company_email']=$formm['value'];
					}
					elseif($formm['name']=='business_contact_no')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['company_phone']=$formm['value'];
					}
					elseif($formm['name']=='business_gst_no')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['gst_number']=$formm['value'];
					}
					elseif($formm['name']=='business_full_address')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['company_address']=$formm['value'];
					}
					elseif($formm['name']=='contact_person_name')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['contact_person_name']=$formm['value'];
						$cust_data['first_name']=$formm['value'];
					}
					elseif($formm['name']=='contact_person_email')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['contact_person_email']=$formm['value'];
						$cust_data['email']=$formm['value'];
					}
					elseif($formm['name']=='contact_person_contact_no')
					{
						$form[$formm['name']] = $formm['value'];
						$cust_data['contact_person_mobile']=$formm['value'];
						$cust_data['mobile']=$formm['value'];
					}

					elseif($formm['name']=='customer_id')
					{
						$form['user_id'] = $formm['value'];
						$user_id=$formm['value'];
					}
					else
						$form[$formm['name']] = $formm['value'];
				}			
			}

			$cust_data['customer_type']=($this->input->post('selected_tab_value')=='1') ? 'I' : 'B';
			$cust_data['updated_ts']=date('Y-m-d H:i:s');
			$cust_data['updated_by']=$this->session->userdata('admin')['user_id'];

			//echo "<pre>"; print_r($cust_data); die;

			$netAmt = $this->input->post('net_amt');
			$advAmt = $this->input->post('adv_amt');
			$receiptNo = $this->input->post('receiptNo');
			$paymentDate = $this->input->post('paymentDate').' '.date('H:i:s');
			$paymentMode = $this->input->post('paymentMode');
			$paymentRemarks = $this->input->post('paymentRemarks');

			if($advAmt == '0' || $advAmt == $netAmt){
				$finalAmount = $netAmt;
				$finalStatus = '2';
			} else if($advAmt < $netAmt) {
				$finalAmount = $advAmt;
				$finalStatus = '1';
			}

			$cust_id=0;

			if($user_id>0 && ($user_id))
				$cust_id = $this->mcommon->update('customer_master', array('customer_id'=>$user_id),$cust_data);
			else
				$cust_id = $this->mcommon->insert('customer_master', $cust_data);

			$form['user_id'] =($user_id>0 && ($user_id))? $user_id : $cust_id;
			
			$form['total_rate'] = $this->input->post('total_price');
			$form['total_extra_hours'] = $this->input->post('total_extra_hours');
			$form['total_extra_rate'] = $this->input->post('total_extra_hours') * 1000;
			$form['gst_amount'] = $this->input->post('gst_amt');
			$form['net_amount'] = $this->input->post('net_amt');
			$form['gst_percentage'] = $this->input->post('gst_perc');
			$form['cgst_percent'] = $this->input->post('cgst_perc');
			$form['sgst_percent'] = $this->input->post('sgst_perc');
			$form['igst_percent'] = $this->input->post('igst_perc');
			$form['cgst_amount'] = $this->input->post('cgst_amt');
			$form['sgst_amount'] = $this->input->post('sgst_amt');
			$form['igst_amount'] = $this->input->post('igst_amt');
			$form['discount_percentage'] = $this->input->post('dis_perc');
			$form['discount_amount'] = $this->input->post('disc_amt');
			$form['discount_given_by'] = $this->session->userdata('admin')['user_id'];
			$form['discount_given_ts'] = date('Y-m-d H:i:s');
			$form['amount_after_discount'] = $this->input->post('totalPriceAfterDiscount');
			$form['advance_amount'] = $this->input->post('adv_amt');
			$form['is_indivisual'] = ($this->input->post('selected_tab_value')=='1') ? 1 : 0;
			$form['rate_id'] = $this->input->post('rate_id');
			//$form['status'] = ($this->input->post('net_amt')>0)?'8':'3';
			$form['order_id'] = rand('1000000000', '9999999999');
			$form['status'] = $finalStatus;
			$form['created_at'] = date('Y-m-d H:i:s');
			$form['booking_from'] = 'A';
			$form['booked_by'] = $this->session->userdata('admin')['user_id'];

			$bookingDates = $this->input->post('date');

			if(count($bookingDates) > 1){
				// Get the value of the first index
				$bookingStartdate = date("Y-m-d", strtotime(reset($bookingDates)));
				$bookingEnddate = date("Y-m-d", strtotime(end($bookingDates)));
			} else {
				// Get the value of the first index
				$bookingStartdate = date("Y-m-d", strtotime(reset($bookingDates)));
				$bookingEnddate = date("Y-m-d", strtotime(reset($bookingDates)));
			}

			$form['booking_start_date'] = $bookingStartdate;
			$form['booking_end_date'] = $bookingEnddate;

			//echo "<pre>"; print_r($form); die;		

			$booking_id = $this->mcommon->insert('venue_booking', $form);

			// Get the JSON data from the POST request
			$jsonDataArr = $this->input->post('json_data_arr');

			// Decode the JSON data into an array
			$data_arrr = json_decode($jsonDataArr, true);

			if($this->input->post('hidden_extra') == '1'){

				foreach ($data_arrr as $index => $elements) {
					if (isset($elements['extra_hour']) && $elements['extra_hour'] == '0') {
						unset($data_arrr[$index]);
					}
				}

				$data_arr = array_values($data_arrr);

			} else {

				$data_arr = $data_arrr;

			}						
			
			//echo "<pre>"; print_r(array_values($data_arr)); die;			

			// Loop through $data_arr and insert values into the database or perform other actions
			foreach ($data_arr as $item) {
				$disc_amt=($item['price']*$form['discount_percentage'])/100;
				$gst_amt=($item['price']*$item['gst_perc'])/100;

				$form2 = array(
					'booking_id' => $booking_id,
					'rate' => $item['price'],
					'extra_hours' => $item['extra_hour'],
					'extra_rate' => $item['extra_hour'] * 1000,
					'start_date' => date('Y-m-d H:i:s',strtotime($item['date'])),
					'status' => '8',
					'discount_percentage' => $form['discount_percentage'],
					'discount_amount' =>$disc_amt,
					'rate_after_discount' => $item['price']-$disc_amt,
					'gst_percentage' =>  $item['gst_perc'],
					'cgst_percentage' =>  $item['cgst_each'],
					'sgst_percentage' =>  $item['sgst_each'],
					'rate_after_discount_gst' => ($item['price']-$disc_amt)+$gst_amt
				);
				$sub_booking_id = $this->mcommon->insert('venue_booking_details', $form2);				
			}

			//echo "<pre>"; print_r($form2); die;

			/**Payment Related Data**/
			$booking_data = $this->db->from('venue_booking')->where('booking_id', $booking_id)->get()->row_array();

			$paymentdata = array(
				'booking_id' => $booking_id,
				'customer_id' => $booking_data['user_id'],
				'receipt_no' => $receiptNo,
				'payment_date' => $paymentDate,
				'order_id' => $booking_data['order_id'],
				'payment_mode' => $paymentMode,
				'amount' => $finalAmount,
				'status' => 'Success',
				'remarks' => $paymentRemarks,
				'created_by' => $this->session->userdata('admin')['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
	
			$this->db->insert('venue_payment', $paymentdata);
			/**Payment Related Data**/


			$mappingData = array(
				'booking_id' => $booking_id,
				'status' => $finalStatus,
				'action_by' =>$this->session->userdata('admin')['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);	
			$venue_booking_status_mapping_id = $this->mcommon->insert('venue_booking_status_mapping', $mappingData);

			echo json_encode(array('status'=>true,'booking_id'=>$booking_id,'message' => 'Booking completed successfully Booking-ID with '.$booking_id));
		}else{
			echo json_encode(array('status'=>false));
		}
	}
	

	public function myVenueBookingList(){
		$where=array();
		$booking_id=$this->input->post('booking_id');
		if($booking_id>0){
			if($this->session->userdata('customer_id')){
				$where['vb.user_id'] = $this->session->userdata('customer_id');
			}
			$where['vb.booking_id'] = $booking_id;
			$data['bookings'] = $this->mvenuebooking->getVenueBookings($where);
				echo json_encode(array('status'=>true,'booking_list'=>$data['bookings']));
			}else{
				echo (array('status'=>false));
			}		
	}

	public function venueBookingList() {
		$where=array();
			if($this->session->userdata('customer_id')){
				$where['vb.user_id'] = $this->session->userdata('customer_id');
			
			$data['bookings'] = $this->mvenuebooking->getVenueBookings($where);
			$data['content'] = 'admin/venue_booking/myBooking';
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/*public function approval_letter($booking_id)
	{
		$data['approval_letter'] = $this->mvenue_reservation->get_approval_letter($booking_id);
		//print_r($data['reservations']);die;
		$this->load->view('frontend/venue_booking/approval_letter',$data); 
	}*/

	public function booking_slip($booking_id)
	{
		$data['booking_slip'] = $this->mvenue_reservation->get_approval_letter($booking_id);
		$data['booking_slip_details'] = $this->mvenue_reservation->get_booking_slip_details($booking_id);
		$data['payment_details_offline'] = $this->mvenue_reservation->get_payment_details_offline($booking_id);
		if(!empty($data['booking_slip']['payment_id']) || ($data['booking_slip']['payment_id'] !=null)){
			$data['payment_details_online'] = $this->mvenue_reservation->get_payment_details_online($booking_id);
		}
		else{
			$data['payment_details_online']=array();
		}

		
		// print_r($data['payment_details_offline']);print_r($data['payment_details_online']);die;
		$this->load->view('frontend/venue_booking/booking_slip',$data); 
	}
	
	public function generateTxnid() {
		$txnid = substr(hash('sha256', rand_string(6) . microtime()), 0, 20);
		$booking_id = $this->input->post('booking_id');
		$total_rate=0.00;
		$is_advance_payment=0;
		$booking_details = $this->mcommon->getRow('venue_booking', array('booking_id'=>$booking_id));
		$booking_payment_mapping=$this->mcommon->getRow('venue_bookingwise_payment_mapping', array('booking_id'=>$booking_id,'is_advance_payment<>'=>7));
		if($booking_details) {
			if ($booking_payment_mapping) {
				$row_count =count($booking_payment_mapping);
				if($row_count>0 && $booking_payment_mapping['is_advance_payment']==1)
				{
					$total_rate=$booking_details['net_amount']-$booking_details['advance_amount'];
					$is_advance_payment=2;
				}
			}
			elseif($booking_details['advance_amount']>0)
			{
				$total_rate=$booking_details['advance_amount'];
				$is_advance_payment=1;
			}
			elseif($booking_details['advance_amount']==0.00 || $booking_details['advance_amount']==null)
			{
				$total_rate=$booking_details['net_amount'];
				$is_advance_payment=0;
			}

			$session_data['total_rate'] = $total_rate;
			$session_data['surl'] = $this->input->post('surl');
			$session_data['furl'] = $this->input->post('furl');
			$session_data['txnid'] = $txnid;
			$session_data['booking_id'] =  $this->input->post('booking_id');

			//$session_data['is_advance_pay'] = $this->input->post('is_advance_pay');
			$session_data['adv_perc'] = $this->input->post('adv_perc');
			$session_data['net_amt'] = $this->input->post('net_amt');
			$session_data['adv_pay_status'] = $is_advance_payment;

			$this->session->set_userdata($session_data);
			$this->mcommon->update('venue_booking', array('booking_id'=>$booking_id), array('txnid'=>$txnid));
			echo json_encode(array('txnid'=>$txnid));	
		}else{
			return false;
			//echo json_encode(array());
		}
	}

	public function proceedPayment() {
		$postdata = $this->input->post();
        $postdatanew = array();
        foreach($postdata as $key=>$val){
            $postdatanew[$key] = isset($postdata[$key]) ? $val : '';
        }
       
		//echo "<pre>"; print_r($this->session->userdata('adv_pay_status')); die();
        //$payu['amount'] = $postdatanew['grand_total'];
        $ccavenue['tid'] = $this->session->userdata('txnid');
		$ccavenue['merchant_id'] = TEST_CCAVENUE_MERCHANT_DATA;
		$ccavenue['order_id'] = crc32(time().uniqid());
        $ccavenue['amount'] = $this->session->userdata('total_rate');
		$ccavenue['currency'] = "INR";
        $ccavenue['redirect_url']=base_url('frontend/venue_booking/paymentBookingSuccess');
        $ccavenue['cancel_url'] 	= base_url('frontend/venue_booking/paymentBookingFailure');
		$ccavenue['language'] = 'EN';
		$ccavenue['billing_name'] = $this->session->userdata['first_name'].($this->session->userdata['middle_name'])?' '.$this->session->userdata['middle_name']:''.' '.$this->session->userdata['last_name'];
        $ccavenue['billing_email'] = $this->session->userdata['email'];
        $ccavenue['billing_tel'] = $this->session->userdata['mobile'];
        
		$merchant_data = '2';
		$working_key = TEST_CCAVENUE_WORKING_KEY;
		$data['access_code'] = TEST_CCAVENUE_ACCESS_CODE;
		$data['ccavenue_redirect_url'] = TEST_CCAVENUE_BASE_URL;
		$ccavenue['merchant_param1'] = $this->session->userdata('customer_id');
		$ccavenue['merchant_param2'] = $this->session->userdata('adv_perc');
        $ccavenue['merchant_param3'] = $this->session->userdata('adv_pay_status');
        $ccavenue['merchant_param4'] = $this->session->userdata('net_amt');
       $booking_id=$this->session->userdata('booking_id');

		foreach ($ccavenue as $key => $value){
			$merchant_data.=$key.'='.$value.'&';
		}
		//echo $merchant_data; die;
		$data['encrypted_data'] = encrypt($merchant_data,$working_key); // Method for encrypting the data.
	
		
		$this->db->trans_start();
		$payment_data = array(
			'booking_id' => $booking_id,
			'customer_id' =>$this->session->userdata('customer_id'),
			'payment_date' => date('Y-m-d'),
			'txnid' => $ccavenue['tid'],
			'order_id' => $ccavenue['order_id'],
			'transaction_ref_id' => NULL,
			'bank_ref_num' => NULL,
			'amount' => $ccavenue['amount'],
			'payment_mode' => '',
			'remarks' => '',
			'status' => 'PENDING',
			'created_by' =>$this->session->userdata('customer_id'),
			'created_ts' => date('Y-m-d H:i:s'),
		);
       /* $generate_payment = array(
        	'txnid'=>$payu['txnid'],
        	'net_amount_debit'=>$payu['amount'],
        	'total_amount'=>$payu['amount']
        );*/
        $this->mcommon->insert('venue_payment', $payment_data);
		$this->mcommon->update('venue_booking', array('booking_id'=>$booking_id), array('txnid' => $ccavenue['tid'],'order_id' => $ccavenue['order_id']));

        $this->db->trans_complete();
        //$data['payudata'] = $payu;
		
        $data['content'] = 'admin/venue_booking/previewpay';
		$this->load->view('admin/layouts/index', $data);
	}

	public function paymentBookingSuccess()
	{
		$working_key = TEST_CCAVENUE_WORKING_KEY;
		$access_code = TEST_CCAVENUE_ACCESS_CODE;
		$encResponse = $this->input->post('encResp');
		$rcvdString = decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
	
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			$responseMap [$information [0]] = $information [1];
			if($i==3)	$order_status=$information[1];
		}
		
		//echo $rcvdString; die;
		//echo '<pre>'; print_r($responseMap); die;
		
		$date = str_replace('/', '-', $responseMap['trans_date']);
		$transaction_date =  date('Y-m-d H:i:s', strtotime($date));
		
		if ($order_status==="Success") {
			
			$txnid = $responseMap['tid'];
			$order_id = $responseMap['order_id'];

			$payment_details = $this->mcommon->getDetails('venue_payment', array('order_id'=>$order_id));
			$data['venue_booking'] = $this->mcommon->getDetails('venue_booking', array('order_id'=>$order_id));
			$user_id = $data['venue_booking'][0]['user_id'];
			$booking_id=$data['venue_booking'][0]['booking_id'];
			$customer_det = $this->mcommon->getRow('customer_master', array('customer_id' => $user_id));
			$session_data = $customer_det;
			$session_data['user_type'] = 'frontend';
			$session_data['logged_in'] = TRUE;
			
			//end user details set in session--------------------------

			if ($data['venue_booking'] && (isset($data['venue_booking'][0]))|| $data['venue_booking'][0]['status'] == '0' ) {

				$payment_data = array();
				$amount_val=$data['venue_booking'][0]['net_amount'];
				$pay_status = $responseMap['merchant_param3'];
				if($pay_status==1)
				{
					$amount_val=$data['venue_booking'][0]['advance_amount'];
				}
				elseif($pay_status==2)
				{
					$amount_val=$amount_val-$data['venue_booking'][0]['advance_amount'];
				}
				$pay_perc = $responseMap['merchant_param2'];

				if ($responseMap['amount'] == $amount_val) {
					$payment_data = array(
						'booking_id' => $booking_id,
						'customer_id' => $user_id,
						'payment_date' => $transaction_date,
						'order_id' => $order_id,
						'transaction_ref_id' => $responseMap['tracking_id'],
						'bank_ref_num' => $responseMap['bank_ref_no'],
						'amount' => $responseMap['amount'],
						'payment_mode' => $responseMap['payment_mode'],
						'response_txt' => json_encode($responseMap),
						'remarks' => 'Payment Successful',
						'status' => $responseMap['order_status'],
						'updated_by' => $user_id,
						'updated_ts' => date('Y-m-d H:i:s'),
					);

					//payment_confirmed($booking_det->mobile, $posted_data['amount'], $booking_det->booking_no);
					$status_adv ='0';
						if($pay_status==0 || $pay_status==2)
						{
							$status_adv='2';
						}
						elseif($pay_status==1){
							$status_adv='1';
						}
					$payment_id = $this->mcommon->update('venue_payment', array('order_id'=>$order_id),$payment_data);
					$this->mcommon->update('venue_booking', array('order_id'=>$order_id), array('payment_id'=>$payment_id, 'status'=>$status_adv,'payment_method'=>'Online'));

					$mappingBooking_PayData = array(
							'booking_id' => $booking_id,
							'payment_id'=>$payment_id,
							'txnid'=>$txnid,
							'order_id'=>$order_id,
							'amount'=>$responseMap['amount'],
							'advance_payment_percentage'=>$pay_perc,
							'is_advance_payment' =>$pay_status,
							'created_by' =>$this->session->userdata('customer_id'),
							'created_ts' => date('Y-m-d H:i:s')
						);	
						$venue_bookingwise_payment_mapping_id = $this->mcommon->insert('venue_bookingwise_payment_mapping', $mappingBooking_PayData);

				} else {

					$payment_data = array(
						'booking_id' => $booking_id,
						'customer_id' => $user_id,
						'payment_date' => $transaction_date,
						//'txnid' => $txnid,
						'transaction_ref_id' => $responseMap['tracking_id'],
						'bank_ref_num' => $responseMap['bank_ref_no'],
						'amount' => $responseMap['amount'],
						'payment_mode' => $responseMap['payment_mode'],
						'response_txt' => json_encode($responseMap),
						'remarks' => 'Payment Failed',
						'status' => 'FAILURE',
						'updated_by' => $user_id,
						'updated_ts' => date('Y-m-d H:i:s'),
					);

					$payment_id = $this->mcommon->update('venue_payment', array('order_id'=>$order_id),$payment_data);
					$this->mcommon->update('venue_booking', array('order_id'=>$order_id), array('payment_id'=>$payment_id, 'status'=>'7'));
					$mappingBooking_PayData = array(
							'booking_id' => $booking_id,
							'payment_id'=>$payment_id,
							'txnid'=>$txnid,
							'order_id'=>$order_id,
							'amount'=>$responseMap['amount'],
							'advance_payment_percentage'=>$pay_perc,
							'is_advance_payment' => 7,
							'created_by' =>$this->session->userdata('customer_id'),
							'created_ts' => date('Y-m-d H:i:s')
						);	
						$venue_bookingwise_payment_mapping_id = $this->mcommon->insert('venue_bookingwise_payment_mapping', $mappingBooking_PayData);

				}



				$data['redirect'] = base_url('admin/venue_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'SUCCESS', 'payment_status' => $responseMap['order_status'], 'booking_id' => $booking_id)))));
				$data['content'] = 'admin/venue_booking/booking_payment_confirmation';

				/* Online Payment & Booking Confirmation Email Sending */

					$config = email_config(); 
				$email_from = $config['email_from'];
				unset($config['email_from']);

				$subject = 'Booking ID  ' . $booking_id . ' is Confirmed';

				$message = 'Dear Sir / Madam,

				Thank you for your payment of Rs. ' . number_format($responseMap['amount'],2) . ' and your Booking (ID ' . $booking_id . ') is Confirmed.

				Please Login to wbsfdc.devserv.in to download the Booking Slip.

				You will be allowed to enter the check-in only upon production of the Booking Slip to the person on duty at the venue.

				For more details please login to wbsfdc.devserv.in

				Wish you a happy stay.

				THE STATE FISHERIES DEVELOPMENT CORPORATION LIMITED
				Department of Fishery
				Government of West Bengal';
				$cc_email = array();
				$email='';
				$contact_email='';
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($email_from,EMAIL_FROM_NAME); // change it to yours
				if(!empty($data['venue_booking']) && !empty($data['venue_booking'][0]))
					{
						$email=($data['venue_booking'][0]['is_indivisual']==1)? $data['venue_booking'][0]['indivisual_email']:$data['venue_booking'][0]['business_email'];
						$contact_email=($data['venue_booking'][0]['contact_person_email'])? $data['venue_booking'][0]['contact_person_email']:'';
					}	
				$this->email->to($email); // change it to yours 

			
					
				/*if(!empty($$email)){
					$cc_email[]=$email;
				}*/
				if(!empty($contact_email)){
					$cc_email[]=$contact_email;
				}
				
				if(!empty($cc_email)){
					
					$this->email->cc($cc_email);

				}
				
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();  

					$this->load->view('admin/layouts/index', $data);

			}

		} else {
			//redirect(base_url('my-booking'));
			
			$txnid = $responseMap['tid'];
			$order_id = $responseMap['order_id'];

			$data['venue_booking'] = $this->mcommon->getDetails('venue_booking', array('order_id'=>$order_id));
							
			if ($data['venue_booking'] && isset($data['venue_booking'])) {
				
				$booking_id = $data['venue_booking'][0]['booking_id'];
				$user_id = $data['venue_booking'][0]['user_id'];
				
				$saved_remarks = '';
				$status_send_to_next_page = '';
				$payment_date = '';
				
				if($order_status==="Aborted"){
					$saved_remarks = 'Payment Canceled';
					$status_send_to_next_page = 'CANCELED';
					$payment_date = date('Y-m-d H:i:s');
				}
				else {
					$saved_remarks = 'Payment Failed';
					$status_send_to_next_page = 'FAILURE';
					$payment_date = $transaction_date;
				}
				
				$payment_data = array(
					'payment_date' => $payment_date,
					//'txnid' => $txnid,
					'transaction_ref_id' => $responseMap['tracking_id'],
					'bank_ref_num' => $responseMap['bank_ref_no'],
					//'amount' => $posted_data['amount'],
					'payment_mode' => $responseMap['payment_mode'],
					'response_txt' => json_encode($responseMap),
					'remarks' => $saved_remarks,
					'status' => $responseMap['order_status'],
					//'created_by' => $user_id,
					//'created_ts' => date('Y-m-d H:i:s'),
				);
				
				$payment_id = $this->mcommon->update('venue_payment', array('order_id' => $order_id), $payment_data);
				$this->mcommon->update('venue_booking', array('order_id'=>$order_id), array('payment_id'=>$payment_id, 'status'=>'7'));

				
				//user details set in session------------------------------
				$customer_det = $this->mcommon->getRow('customer_master', array('customer_id' => $user_id));
				$session_data = $customer_det;
				$session_data['user_type'] = 'frontend';
				$session_data['logged_in'] = TRUE;
				$this->session->set_userdata($session_data);
				//end user details set in session--------------------------
				
				$data['redirect'] = base_url('admin/venue_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => $status_send_to_next_page, 'payment_status' => $responseMap['order_status'], 'booking_id' => $booking_id)))));
				$data['content'] = 'admin/booking/booking_payment_confirmation';
				$this->load->view('admin/layouts/index', $data);
			} else {
				
				//user details set in session------------------------------
				$customer_det = $this->mcommon->getRow('customer_master', array('customer_id' => $user_id));
				$session_data = $customer_det;
				$session_data['user_type'] = 'frontend';
				$session_data['logged_in'] = TRUE;
				$this->session->set_userdata($session_data);
				//end user details set in session--------------------------
				
				$data['redirect'] = base_url('admin/venue_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $responseMap['order_status'], 'booking_id' => $booking_id, 'msg' => 'Payment failed! Wrong transaction ID.')))));
				$data['content'] = 'admin/venue_booking/booking_payment_confirmation';
				$this->load->view('admin/layouts/index', $data);
			}
		}
	}
	public function paymentBookingFailure()
	{
		if (empty($_POST)) {
			redirect(base_url('admin/venue_reservation'));
		}
		
		$working_key = TEST_CCAVENUE_WORKING_KEY;
		$encResponse = $this->input->post('encResp');
		$rcvdString = decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			$responseMap [$information [0]] = $information [1];
			if($i==3)	$order_status=$information[1];
		}
		
		//echo '<pre>'; print_r($responseMap); die;
		
		if (!empty($responseMap)) {
			
			$order_id = $responseMap['order_id'];
			$txnid = $responseMap['tid'];

			$data['venue_booking'] = $this->mcommon->getDetails('venue_booking', array('order_id'=>$order_id));
			$booking_id=$data['venue_booking'][0]['booking_id'];
			$user_id = $data['venue_booking'][0]['user_id'];
			
			if ($data['venue_booking'] && (isset($data['venue_booking'][0]))) {
				
				$date = str_replace('/', '-', $responseMap['trans_date']);
				$transaction_date =  date('Y-m-d H:i:s', strtotime($date));
				
				$saved_remarks = '';
				$status_send_to_next_page = '';
				$payment_date = '';
				
				if($order_status==="Aborted"){
					$saved_remarks = 'Payment Canceled';
					$status_send_to_next_page = 'CANCELED';
					$payment_date = date('Y-m-d H:i:s');
				}
				else {
					$saved_remarks = 'Payment Failed';
					$status_send_to_next_page = 'FAILURE';
					$payment_date = $transaction_date;
				}
				
				$payment_data = array(
					'booking_id' => $booking_id,
					'customer_id' => $user_id,
					'payment_date' => $payment_date,
					//'txnid' => $txnid,
					'transaction_ref_id' => $responseMap['tracking_id'],
					'bank_ref_num' => $responseMap['bank_ref_no'],
					'amount' => $responseMap['amount'],
					'payment_mode' => $responseMap['payment_mode'],
					'response_txt' => json_encode($responseMap),
					'remarks' => $saved_remarks,
					'status' => strtoupper($responseMap['order_status']),
					'created_by' => $user_id,
					'created_ts' => date('Y-m-d H:i:s'),
				);
				
					$payment_id = $this->mcommon->update('venue_payment', array('order_id'=>$order_id),$payment_data);
				
					$this->mcommon->update('venue_booking', array('order_id'=>$order_id), array('payment_id'=>$payment_id, 'status'=>'7'));
				
				$data['customer_det'] = $this->mbooking->get_customer_det(array('customer_master.customer_id' => $user_id))->last_row();

				//user details set in session------------------------------
				$customer_det = $this->mcommon->getRow('customer_master', array('customer_id' => $user_id));
				$session_data = $customer_det;
				$session_data['user_type'] = 'frontend';
				$session_data['logged_in'] = TRUE;
				$this->session->set_userdata($session_data);
				//end user details set in session--------------------------
			}

			$data['redirect'] = base_url('admin/venue_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => $status_send_to_next_page, 'payment_status' => $responseMap['order_status'], 'booking_id' => $booking_id)))));
			$data['content'] = 'admin/venue_booking/booking_payment_confirmation';
			$this->load->view('admin/layouts/index', $data);
		} else {
			redirect(base_url('admin/venue_reservation'));
		}
	}

	public function booking_payment_complete($value1)
	{
		if (is_null($value1))
			redirect(base_url('admin/venue_reservation'));

		$det = unserialize($this->encryption->decrypt(base64_decode($value1)));

		$data['status'] = $det['status'];
		$data['payment_status'] = $det['payment_status'];
		$data['payment'] = $det['posted_data'];
		$data['booking_id']=$det['booking_id'];
		/*$data['booking_det'] = $this->mbooking->get_booking_payment(array('venue_payment.booking_id' => $det['booking_id']))->last_row();
		
		if(strtolower($data['booking_det']->status) == 'failure'){ 
			$this->mbooking->move_booking_to_failed($det['booking_id']);
		}*/


		$data['content'] = 'admin/venue_booking/booking_payment_complete';
		$this->load->view('admin/layouts/index', $data);
	}

	public function getGSTSlab() {
        $per_day_rate = $this->input->post('per_day_rate');
		//echo $per_day_rate;
        // Call the model to get GST slab data
        $gst_slab = $this->mvenuebooking->getGSTSlabByTotalPrice($per_day_rate);
        if ($gst_slab) {
            // Return GST slab data as JSON response
            $this->output->set_content_type('application/json')->set_output(json_encode($gst_slab));
        } else {
            // No GST slab found for the given total_price
            $this->output->set_status_header(404)->set_output('No GST slab found.');
        }
    }
	

	public function getAdvancedAmountOrNot() {
        // Get the selected dates from the AJAX request
        $numberOfDays = $this->input->post('numberOfDays');
		$net_amount = $this->input->post('net_amount');
		$response=array();
        // Fetch the no_of_days and advance_payment_percentage from the database (you'll need to adapt this to your specific table)
        $paymentParams = $this->mvenuebooking->getPaymentParams();
        $noOfDaysThreshold = $paymentParams['no_of_days'];
        $advancePaymentPercentage = $paymentParams['advance_payment_percentage'];

        // Calculate advanced amount if conditions are met
        $advancedAmount = 0;
        if ($numberOfDays > $noOfDaysThreshold) {
            // Calculate the advanced amount
            $advancedAmount = ($advancePaymentPercentage / 100) * $net_amount;
			// Return the calculated advanced amount as JSON response
			$response = array(
				'status' => true,
				'num_of_days' => $numberOfDays,
				'noOfDaysThreshold'=>$noOfDaysThreshold,
				'advancePaymentPercentage'=> $advancePaymentPercentage,
				'advanced_amount' => $advancedAmount
			);
        }
		else
		{
			$response = array(
				'status' => false,
				'num_of_days' => $numberOfDays
			);
		}
        
        echo json_encode($response);
    }

	public function cancelBooking($booking_id)
	{
		$data = array();
		$booking_id = decode_url($booking_id);
		/*$data['booking_header'] = $this->query->getBookingHeader($booking_id);
		if($data['booking_header']['booking_status']=='A'){
			if($data['booking_header']['created_user_type']=='C'){
				$data['Initiated_by'] = $this->query->getCustomerData($data['booking_header']['created_by']);

			}else if($data['booking_header']['created_user_type']=='A'){
				$data['Initiated_by'] = $this->query->getUserData($data['booking_header']['created_by']);
			}

		}
		$data['customer_details'] = $this->query->getBookingDetailsOfCustomer($booking_id);
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		$data['booking_details'] = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $booking_id));
		$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id));
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);*/
		$data['bookings'] =array();
		if($booking_id>0){
			if($this->session->userdata('customer_id')){
				$where['vb.user_id'] = $this->session->userdata('customer_id');
			}
			$where['vb.booking_id'] = $booking_id;
			$data['bookings'] = $this->mvenuebooking->getVenueBookings($where);
		}
		

		// Initialize variables to store the minimum and maximum dates
		$minDate = null;
			$maxDate = null;
		if($data['bookings']){
			// Loop through the booking details
			foreach ($data['bookings'][0]['booking_details'] as $bookingDetail) {
				// Extract the start date and convert it to a DateTime object
				$startDate = new DateTime($bookingDetail['start_date']);

				// Update the minimum and maximum dates
				if ($minDate === null || $startDate < $minDate) {
					$minDate = $startDate;
				}
				if ($maxDate === null || $startDate > $maxDate) {
					$maxDate = $startDate;
				}
			}

		// Format the minimum and maximum dates as 'Y-m-d'
		$minDateFormatted = $minDate ? date_create($minDate->format('Y-m-d')) : null;
		$data['minDate']=$minDate;
			$current_date=date_create(date('Y-m-d'));
			//print_r($current_date);die;
			$diff_check_in_out=date_diff($current_date,$minDateFormatted);
			$diff_check_in_out_date = $diff_check_in_out->format("%R%a");
			//echo $diff_check_in_out_date;die;
			$data['cancellation_details'] = $this->mvenuebooking->getCancellationDetails($diff_check_in_out_date);
			$data['cancellation_request_details'] = $this->mvenuebooking->getCancellationRequestDetails($booking_id);
		}

		//echo '<pre>';print_r($data['cancellation_details']);die;  
		$data['content'] = 'admin/venue_booking/cancelBooking';
		$this->load->view('admin/layouts/index', $data);
	}

	
	public function cancel_booking_refund_process(){

		$booking_id = $this->input->post('booking_id');

		$cancel_request_details = $this->db->from('venue_cancel_request_tbl')->where('booking_id', $booking_id)->order_by('venue_cancel_request_id', 'DESC')->limit(1)->get()->row_array();
	
		if(!empty($cancel_request_details)){
			$return_data = array('status'=>false,'msg'=>'Booking Already Cancelled');
			echo json_encode($return_data);die;
		}
		

		$result_decoded = array();
		$cancel_request_data = array();
		$booking_payment_details = $this->db->from('venue_bookingwise_payment_mapping')->where('booking_id',$booking_id)->order_by('payment_id','ASC')->get()->result_array();
		$where['vb.booking_id'] = $booking_id;
		$booking_det = $this->mvenuebooking->getVenueBookings($where)[0];

		//echo '<pre>';print_r($booking_payment_details);die;
		if(!empty($booking_payment_details)){
			$row_count=count($booking_payment_details);
	
			foreach ($booking_payment_details as $bookingPayDetail) { 		
				// key|command|var1|salt
				$hash_string  = _STAGE_MERCHANT_KEY . '|' . 'cancel_refund_transaction' . '|' . $bookingPayDetail['mihpayid'];
				$hash_string .= '|'._STAGE_SALT;

				
				$payu_hash =  hash("sha512", $hash_string);

				$token_ID = _STAGE_MERCHANT_KEY.$booking_id.rand_string(6);
				
				/* Endpoint */
				$url = _STAGE_PAYU_API_BASE_URL;

				try {
		
				if($this->input->post('refund_amt') > 0){

					/* eCurl */
				$curl = curl_init($url);
				$refund_amount=$this->input->post('refund_amt');
				if($row_count==2)
				{
					$paid_amount=$this->input->post('paid_amount');
					$perc=($bookingPayDetail['amount']/$paid_amount)*100;
					$refund_amount=($refund_amount*$perc)/100;
				}
			
				/* Data */
				$data = [
					'key'=> _STAGE_MERCHANT_KEY, 
					'command'=>'cancel_refund_transaction',
					'hash'=> $payu_hash,
					'var1'=> $bookingPayDetail['mihpayid'], //Payu ID (mihpayid) of transaction
					'var2'=> $token_ID, //Token ID (unique token from merchant) for the refund request
					'var3'=> $refund_amount, //This parameter should contain the amount which needs to be refunded
				];
		
				//echo '<pre>'; print_r($data);die;
				/* Set JSON data to POST */
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					
				/* Return json */
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($curl, CURLOPT_FAILONERROR, true); 
					
				/* make request */
				$result = curl_exec($curl);
			
				/* close curl */
				curl_close($curl);

				$result_decoded = json_decode($result,true);
				$result_decoded['is_refunded'] = 0;
				} else {

					$result_decoded['status'] = 1;
					$result_decoded['request_id'] = '';
					$result_decoded['is_refunded'] = 1;

				}
				//echo '<pre>';print_r($result_decoded);
				if(!empty($result_decoded) && $result_decoded['status'] == 1){

					$this->db->trans_start(); # Starting Transaction
				
				$cancel_remarks = $this->input->post('cancel_remarks');
				$cancel_gst_percent = 18;
				$cancel_request_data = array(
					'booking_id' => $booking_id,
					'net_payble_amount' => $this->input->post('paid_amount'),
					'paid_amount' => $this->input->post('paid_amount'),
					'cancel_percent' => $this->input->post('cancel_percent'),
					'cancel_charge' => $this->input->post('cancel_charge'),
					'cancel_gst_percent' => $cancel_gst_percent,
					'cancel_gst' => number_format(($this->input->post('cancel_charge') * $cancel_gst_percent)/100,2,".",""),
					'refund_amt' => $this->input->post('refund_amt'),
					'refunded_amount' => $this->input->post('refund_amt'),
					'cancel_type' => 'F',
					'refunded_amount' => $this->input->post('refund_amt'),
					'created_by'=>$this->session->userdata('customer_id'),
					'created_user_type'=>'C',
					'created_ts'=>date('Y-m-d H:i:s'),
					'is_refunded'=>$result_decoded['is_refunded'],
					'cancel_refund_request_id'=>$result_decoded['request_id'],
					'cancel_request_response'=>$result
					
				);
				//echo '<pre>'; print_r($cancel_request_data);die;
				$this->db->insert('cancel_request_tbl',$cancel_request_data);
				//echo $this->db->last_query();
				//$this->db->update('booking_header',array('booking_status'=>'C','is_refunded'=>$cancel_request_data['is_refunded'],'cancellation_remarks'=>$cancel_remarks,'updated_by'=>$this->session->userdata('customer_id'),'updated_user_type'=>'C','updated_ts'=>date('Y-m-d H:i:s')),array('booking_id'=>$booking_id));
				$this->db->update('venue_booking',array('status'=>'5','cancellation_reason'=>$cancel_remarks,'updated_by'=>$this->session->userdata('customer_id'),'updated_user_type'=>'C','updated_ts'=>date('Y-m-d H:i:s')),array('booking_id'=>$booking_id));
				$this->db->update('venue_bookingwise_payment_mapping',array('is_refunded'=>$cancel_request_data['is_refunded'],'updated_by'=>$this->session->userdata('customer_id'),'updated_ts'=>date('Y-m-d H:i:s')),array('txnid'=>$bookingPayDetail['txnid']));

				
				//echo $this->db->last_query();die;
				$this->db->trans_complete(); # Completing transaction
		
				if ($this->db->trans_status() === FALSE) {
					# Something went wrong.
					$this->db->trans_rollback();
					$return_data = array('status'=>false,'msg'=> 'Oops!Something went wrong...');
		
				} 
				else { 
					# Everything is Perfect. 
					# Committing data to the database.
					$this->db->trans_commit();
					
										/* Booking Cancellation Email Sending */
							
					$config = email_config(); 
					$email_from = $config['email_from'];
					unset($config['email_from']);

					$subject = 'Booking ID  '.$booking_id.' has been cancelled';

					$message = 'Dear Sir / Madam,

					Your Booking (ID '.$booking_id.') has been cancelled.Refund (if any) will be initiated shortly.

					For more details please login to https://wbsfdc.devserv.in/

					THE STATE FISHERIES DEVELOPMENT CORPORATION LIMITED
					Government of West Bengal';
					$cc_email = array();
					$email='';
					$contact_email='';
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from($email_from,EMAIL_FROM_NAME); // change it to yours
					if(!empty($booking_det ))
						{
							$email=($booking_det['is_indivisual']==1)? $booking_det['indivisual_email']:$booking_det['business_email'];
							$contact_email=($booking_det['contact_person_email'])? $booking_det['contact_person_email']:'';
						}	
					$this->email->to($email); // change it to yours 


						
					/*if(!empty($$email)){
						$cc_email[]=$email;
					}*/
					if(!empty($contact_email)){
						$cc_email[]=$contact_email;
					}

					if(!empty($cc_email)){
						
						$this->email->cc($cc_email);

					}

					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->send();  
								
		
				
			//echo '<pre>'; print_r($this->email->print_debugger());die;
			
			//payment_cancelled($booking_det['mobile'], $booking_det['booking_no']);


					$return_data = array('status'=>true,'msg'=>'Booking has been cancelled successfully');

				}

				} else {

					throw new Exception($result_decoded['msg']);
				}
				
				// {"status":1,"msg":"Refund Request Queued","request_id":"134555708","bank_ref_num":null,"mihpayid":403993715527389777,"error_code":102}

				
			
			} catch (Exception $e) {
				// this will not catch DB related errors. But it will include them, because this is more general. 
				$return_data = array('status'=>false,'msg'=> $e->getMessage());
			}

		} }else {

			$return_data = array('status'=>false,'msg'=>'Payment info not found');
		}
		
		echo json_encode($return_data);die;
		
		}
}
 