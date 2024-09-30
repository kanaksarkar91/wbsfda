<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mreservation', 'admin/msportsfacilitiesrate', 'admin/mbooking', 'admin/mproperty', 'frontend/query', 'mcommon'));
		$this->load->helper(array('sms', 'email', 'common'));
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
		$where = array();
		$data['start_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');
		if ($this->input->post()) {
			if ($this->input->post('start_date')) {
				$where['bh.created_ts >='] = date('Y-m-d 0:0:1', strtotime($this->input->post('start_date')));
			}
			if ($this->input->post('end_date')) {
				$where['bh.created_ts <='] = date('Y-m-d 23:59:50', strtotime($this->input->post('end_date')));
			}
		}
		$order_by = " bh.booking_id DESC";
		$data['reservations'] = $this->mreservation->get($where, $order_by);
		// echo $this->db->last_query(); 
		// echo '<pre>';
		// print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add_booking()
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));

		$data['content'] = 'admin/booking/add_room_booking';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit_accomodation_booking($booking_id = 0)
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));
		
		//for edit booking
		$data['request_data'] = $this->mbooking->getBookingData($booking_id);
		$data['accommodations'] = $this->mbooking->get_getaccommodation($data['request_data']['property_id']);
		//echo '<pre>';print_r($data['request_data']);die;
		//----------------

		$data['content'] = 'admin/booking/edit_room_booking';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add_booking_1()
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//echo '<pre>';print_r($data['properties']);die;
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));

		$data['content'] = 'admin/booking/add_room_booking_1';
		$this->load->view('admin/layouts/index', $data);
	}


	public function booking_details($booking_id)
	{
		$data['content'] = 'admin/booking/booking_details';
		$data['booking_details'] = $this->mbooking->get_booking_details($booking_id);
		$data['booking_payment_details'] = $this->mbooking->get_booking_payment_details($booking_id);
		$data['cancellation_details'] = array();
		$data['cancellation_request_details'] = array();
		$data['booking_source'] = '';
		
		if(!empty($data['booking_details'])){
			
			$check_in_date=date_create($data['booking_details'][0]['check_in']);
			$current_date=date_create(date('Y-m-d'));
			//print_r($current_date);die;
			$diff_check_in_out=date_diff($current_date,$check_in_date);
			$diff_check_in_out_date = $diff_check_in_out->format("%R%a");
			//echo $diff_check_in_out_date;die;
			$data['cancellation_details'] = $this->mbooking->getCancellationDetails($diff_check_in_out_date);
			$data['cancellation_request_details'] = $this->mbooking->getCancellationRequestDetails($booking_id);
			$data['booking_source'] = $data['booking_details'][0]['booking_source'];

		}
		
		//$dates = $this->getDatesFromRange("2014-01-01", "2014-01-10");

		//echo '<pre>';print_r($dates);die;
		$this->load->view('admin/layouts/index', $data);
	}

	public function getaccommodation()
	{
		$data = array();
		$property_id = $this->input->post('property_id');
		$data = $this->mbooking->get_getaccommodation($property_id);
		echo json_encode($data);
	}





	public function register()
	{
		$data = array();
		$reservations = array();
		$data['content'] = 'admin/reservation/register';
		$request_data = array();

		if (!empty($this->input->post())) {

			$request_data['fieldunit_id'] = $this->input->post('fieldunit_id');
			$request_data['location_id'] = $this->input->post('location_id');
			$request_data['sports_facilities_id'] = $this->input->post('sports_facilities_id');
		}

		// $reservation_details = $this->mreservation->get_reservation_booking_details($request_data); 
		// //print_r($reservation_details);die;
		// foreach ($reservation_details as $key => $reservation) { 

		//     $description = '';
		// 	$reservations[$key]['title'] = $reservation["sports_facilities_name"];
		//     $reservations[$key]['start'] = date('Y-m-d',strtotime($reservation["start_date"]));
		//     $reservations[$key]['end'] = NULL;



		// 	$reservations[$key]['backgroundColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 
		// 	$reservations[$key]['borderColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 

		//     $reservations[$key]['textColor'] = "white";
		//     //$reservations[$key]['display'] = "background";
		// 	$reservations[$key]['eventColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 


		// 	$description .= 'Booking ID : Re-'.str_pad($reservation['booking_id'],6,"0",STR_PAD_LEFT);
		// 	$description .= '<br> Fieldunit : '.$reservation["fieldunit_name"];
		// 	$description .= '<br> Location : '.$reservation["location_name"];
		// 	$description .= '<br> Organization Type : '.$reservation["category_name"];
		// 	$description .= '<br> Organization Name : '.$reservation["organization_name"];
		// 	$description .= '<br> Contact No : '.$reservation["contact_no"];
		// 	$description .= '<br> Total Amount : '.$reservation["total_rate"]; 
		// 	$description .= '<br> Status : '.(($reservation['status'] == 1) ? 'Approved' : (($reservation['status'] == 2)?'Rejected':(($reservation['status'] == 3)?'Confirmed':'Pending')));

		// 	$reservations[$key]['description'] = $description;  
		// 	$reservations[$key]['status'] = $reservation['status']; 




		// }


		// $data['reservations'] = $reservations;
		// $data['request_data'] = $request_data;

		// //print_r($data['reservations']);die;

		// $data['fieldunits'] = $this->msportsfacilitiesrate->get_fieldunit();

		$this->load->view('admin/layouts/index', $data);
	}
	public function view_details($booking_id)
	{
		$data = array();
		$data['reservation'] = $this->mreservation->get_reservation_details($booking_id);
		$data['reservation_details'] = $this->mreservation->get_sports_facilities_booking_details($booking_id);
		$data['content'] = 'admin/reservation/view_details';
		$this->load->view('admin/layouts/index', $data);
	}

	public function payment($booking_id)
	{
		$data = array();
		$data['reservation'] = $this->mreservation->get_reservation_details($booking_id);
		$data['reservation_details'] = $this->mreservation->get_sports_facilities_booking_details($booking_id);
		$data['content'] = 'admin/reservation/payment';
		$this->load->view('admin/layouts/index', $data);
	}


	public function book_room_submit()
	{
		//echo '<pre>';print_r($this->input->post());die;
		
		if($this->input->post('booking_id') > 0){
			//booking header data move to history table
			$this->mbooking->update_booking_header_to_history($this->input->post('booking_id'));
			
			//booking detail data move to history table
			$this->mbooking->update_booking_detail_to_history($this->input->post('booking_id'));
		}

		$book_room_qty = $this->input->post('book_room_qty');
		$customer_id = 0;
		$customer_data = array();
		$room_search_data = array();
		
		
		
		/*if (!empty($book_room_qty)) {

			foreach ($book_room_qty as $room_key => $room_qty) {
				for ($i = 1; $i <= $room_qty; $i++) {
				
				}
			}
		}*/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		$search_adult = $this->input->post('adult');
		if(!empty($search_adult)){
			foreach($search_adult as $search_key => $adult){
				$room_search_data[$search_key]['adult'] = $adult;
				$room_search_data[$search_key]['child'] = isset($this->input->post('child')[$search_key])?$this->input->post('child')[$search_key]:0;
				$room_search_data[$search_key]['accommodation_id'] = isset($this->input->post('accommodation_id')[$search_key])?$this->input->post('accommodation_id')[$search_key]:0;
			}
		}

		$this->db->trans_start(); # Starting Transaction

		if (empty($this->input->post('customer_id'))) {
			$check_customer = $this->db->from('customer_master')->where('mobile', $this->input->post('mobile'))->get()->row_array();



			if (!empty($check_customer)) {
				$return_data = array('status' => false, 'msg' => 'Customer mobile number already exist');
				echo json_encode($return_data);
				die;
			}



			$customer_data['customer_title'] = $this->input->post('customer_title');
			$customer_data['first_name'] = $this->input->post('first_name');
			$customer_data['last_name'] = $this->input->post('last_name');
			$customer_data['email'] = $this->input->post('email');
			$customer_data['mobile'] = $this->input->post('mobile');
			$customer_data['customer_type'] = $this->input->post('customer_type');
			$customer_data['company_name'] = $this->input->post('company_name');
			$customer_data['company_email'] = $this->input->post('company_email');
			$customer_data['company_phone'] = $this->input->post('company_phone');
			$customer_data['gst_number'] = $this->input->post('gst_number');
			$customer_data['company_state_id'] = $this->input->post('company_state_id');
			$customer_data['company_country_id'] = $this->input->post('company_country_id');
			$customer_data['company_address'] = $this->input->post('company_address');
			$customer_data['is_active'] = 1;
			$customer_data['created_by'] = $this->admin_session_data['user_id'];
			$customer_data['created_ts'] = date('Y-m-d H:i:s');
			
			

			$this->db->insert('customer_master', $customer_data);
			$customer_id = $this->db->insert_id();
		} else {
			$customer_id = $this->input->post('customer_id');
			$customer_data = $this->db->from('customer_master')->where('customer_id', $customer_id)->get()->row_array();
		}

		$booking_header_data = array(
			'booking_no' => createBookingNo('AB'), 
			'property_id' => $this->input->post('property_id'),
			'room_count' => array_sum($book_room_qty),
			'customer_id' => $customer_id,
			'invoice_generated' => '0',
			'check_in' => $this->input->post('check_in_date'),
			'check_out' => $this->input->post('check_out_date'),
			'booking_for' => !empty($customer_data['customer_type'])?$customer_data['customer_type']:'',
			'customer_title' => !empty($customer_data['customer_title'])?$customer_data['customer_title']:'',
			'first_name' => !empty($customer_data['first_name'])?$customer_data['first_name']:'',
			'last_name' => !empty($customer_data['last_name'])?$customer_data['last_name']:'',
			'email' => !empty($customer_data['email'])?$customer_data['email']:'',
			'mobile' => !empty($customer_data['mobile'])?$customer_data['mobile']:'',
			'personal_address' => '',
			'company_name' => !empty($customer_data['company_name'])?$customer_data['company_name']:'',
			'company_email' => !empty($customer_data['company_email'])?$customer_data['company_email']:'',
			'company_phone' => !empty($customer_data['company_phone'])?$customer_data['company_phone']:'',
			'gst_number' => !empty($customer_data['gst_number'])?$customer_data['gst_number']:'',
			'company_address' => !empty($customer_data['company_address'])?$customer_data['company_address']:'',
			'company_state_id' => !empty($customer_data['company_state_id'])?$customer_data['company_state_id']:'',
			'company_country_id' => !empty($customer_data['company_country_id'])?$customer_data['company_country_id']:'',
			'room_base_price' => $this->input->post('room_base_price'),
			'room_total_discount' => $this->input->post('discount_amount'),
			'room_total_discount_perc' => $this->input->post('discount_perc'),
			'room_price_before_tax' => $this->input->post('room_price_before_tax'),
			'room_total_cgst' => $this->input->post('room_total_cgst'),
			'room_total_sgst' => $this->input->post('room_total_sgst'),
			'room_total_igst' => $this->input->post('room_total_igst'),
			'room_payable_amount' => $this->input->post('total_amount'),
			'net_payable_amount' => $this->input->post('net_amount'),
			'booking_status' => 'A',
			'created_by' => $this->admin_session_data['user_id'],
			'created_user_type' => 'U',
			'created_ts' => date('Y-m-d H:i:s'),
			'booking_source' => 'B',
			'search_text' => json_encode($room_search_data)
		);

		if($this->input->post('booking_id') > 0){
			$bookingHeaderData = $this->mcommon->getRow('booking_header', array('booking_id' => $this->input->post('booking_id')));
			$booking_header_data['edit_count'] = ($bookingHeaderData['edit_count'] + 1);
			$this->mcommon->update('booking_header', array('booking_id' => $this->input->post('booking_id')), $booking_header_data);
		}
		else{
			$this->db->insert('booking_header', $booking_header_data);
			$booking_id  =  $this->db->insert_id();
		}


		if (!empty($book_room_qty)) {

			foreach ($book_room_qty as $room_key => $room_qty) {

				for ($i = 1; $i <= $room_qty; $i++) {

					$booking_detail_data[] = array(
						'booking_id' => ($booking_id != '') ? $booking_id : $this->input->post('booking_id'),
						'accommodation_id' => $this->input->post('book_room_accommodation_id')[$room_key],
						'in_date' => $this->input->post('check_in_date'),
						'out_date' => $this->input->post('check_out_date'),
						'adults' => $this->input->post('select_adult')[$room_key],
						'children' => $this->input->post('select_child')[$room_key],
						'allotment_status' => 'B',
						'rate_category_id' => 1,
						'room_rate' => $this->input->post('book_room_base_price')[$room_key],
						'room_charge' => $this->input->post('book_room_base_price')[$room_key],
						'room_discount_percent' => $this->input->post('room_discount_percent')[$room_key],
						'room_discount_amount' => $this->input->post('room_discount_amount')[$room_key],
						'room_taxable_amount' => $this->input->post('room_taxable_amount')[$room_key],
						'room_cgst' => $this->input->post('room_cgst')[$room_key],
						'room_sgst' => $this->input->post('room_sgst')[$room_key],
						'room_igst' => $this->input->post('room_igst')[$room_key],
						'room_cgst_percent' => $this->input->post('room_cgst_percent')[$room_key],
						'room_sgst_percent' => $this->input->post('room_sgst_percent')[$room_key],
						'room_igst_percent' => $this->input->post('room_igst_percent')[$room_key],
						'room_net_amount' => $this->input->post('book_room_net_amount')[$room_key]
					);
				}
			}
		}

		if (!empty($booking_detail_data)) {
			$this->db->insert_batch('booking_detail', $booking_detail_data);
		}

		

		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			
			$return_data = array('status' => false, 'msg' => 'Oops!Something went wrong...');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();

			/* Online Payment & Booking Confirmation Email Sending */

		$config = email_config();
		$email_from = $config['email_from'];
		unset($config['email_from']);


		$subject = 'Booking ID  ' . $booking_header_data['booking_no'] . ' is Confirmed';

		$message = 'Dear Sir / Madam,

Your Booking (ID   ' . $booking_header_data['booking_no'] . ') is Confirmed.

Please Login to www.prdtourism.in to download the Booking Slip or you may ask for the same to the person on duty at the venue.

For more details please login to www.prdtourism.in

Wish you a happy stay.

Panchayat Tourism
Department of Panchayat & Rural Development
Government of West Bengal';

		$property_details = $this->db->from('property_master')->where('property_id', $this->input->post('property_id'))->get()->row_array();

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($email_from, EMAIL_FROM_NAME); // change it to yours
		$this->email->to($booking_header_data['email']); // change it to yours 
		$cc_email = array();
		if (!empty($property_details) && !empty($property_details['email'])) {
			$cc_email[] = $property_details['email'];
		}
		if (!empty($property_details) && !empty($property_details['contact_person_1_email'])) {
			$cc_email[] = $property_details['contact_person_1_email'];
		}
		if (!empty($property_details) && !empty($property_details['contact_person_2_email'])) {
			$cc_email[] = $property_details['contact_person_2_email'];
		}
		if (!empty($cc_email)) {

			$this->email->cc($cc_email);
		}
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();

		//echo '<pre>'; print_r($this->email->print_debugger());die;

			offline_payment_confirmed($booking_header_data['mobile'], $booking_header_data['booking_no']);

			$return_data = array('status' => true, 'msg' => 'Congratulations!Booking done successfully.');
		}

		echo json_encode($return_data);
		die;
	}

	public function test_mail()
	{

		$config = email_config();
		$email_from = $config['email_from'];
		unset($config['email_from']);


		$subject = 'Booking ID  XXXXX is Confirmed';

		$message = 'Dear Sir / Madam,

		Thank you for your payment of Rs. 500.00 and your Booking (ID XXXXX) is Confirmed.
		
		Please Login to www.prdtourism.in to download the Booking Slip.
		
		You will be allowed to enter the check-in only upon production of the Booking Slip to the person on duty at the venue.
		
		For more details please login to www.prdtourism.in
		
		Wish you a happy stay.
		
		Panchayat Tourism
		Department of Panchayat & Rural Development
		Government of West Bengal';



		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($email_from); // change it to yours
		$this->email->to('arindamkbiswas@gmail.com'); // change it to yours 
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();

		//echo '<pre>'; print_r($this->email->print_debugger());die;

		echo '<pre>';
		print_r($this->email->print_debugger());
		die;
	}


	public function submit_payment()
	{
		//echo '<pre>';print_r($this->input->post());die;
		$booking_id = $this->input->post('booking_id');
		if (!$booking_id) {

			$this->session->set_flashdata('error_msg', 'Booking ID is required');
			redirect("admin/booking");
		}

		$booking_header_data = $this->db->from('booking_header')->where('booking_id', $booking_id)->get()->row_array();


		$data = array(
			'booking_id' => $booking_id,
			'customer_id' => $booking_header_data['customer_id'],
			'payment_date' => $this->input->post('payment_date'),
			'payment_mode' => $this->input->post('payment_mode'),
			'amount' => $booking_header_data['net_payable_amount'],
			// 'check_draft_no' => $this->input->post('check_draft_no'),
			// 'branch_name' => $this->input->post('branch_name'),
			// 'bank_name' => $this->input->post('bank_name'),
			// 'check_draft_date' => date('Y-m-d',strtotime($this->input->post('check_draft_date'))),
			'status' => 'success',
			'remarks' => $this->input->post('remarks'),
			'created_by' => $this->admin_session_data['user_id'],
			'created_ts' => date('Y-m-d H:i:s')
		);

		$booking_payment = $this->db->insert('booking_payment', $data);



		if ($booking_payment) {
			$this->session->set_flashdata('success_msg', 'Payment Collected Successfully');
			redirect("admin/booking/booking_details/" . $booking_id);
		}
	}

	public function check_not_responded_booking()
	{

		$not_responded_booking = $this->mreservation->check_not_responded_booking();
		if (!empty($not_responded_booking)) {

			foreach ($not_responded_booking as $not_responded) {
				$updateArray[] = array(
					'status' => '5',
					'not_responded_ts' => date('Y-m-d H:i:s'),
					'booking_id' => $not_responded['booking_id']
				);
			}

			$this->db->update_batch('sports_facilities_booking', $updateArray, 'booking_id');
		}

		echo 'Executed Successfully';
		die;
	}


	public function search_room()
	{
		$request_data = $this->input->post();
		//echo '<pre>'; print_r($this->input->post()); die;
		
		//room availability check
		$this->load->model('admin/maccommodation');
		$startDate = $request_data['check_in_date'];
		$endDate = $request_data['check_out_date'];
		if($startDate != '' && $endDate != '') {
			$startDt = strtotime($request_data['check_in_date']);
			$endDt = strtotime($request_data['check_out_date']);
			
			$rangArray = [];
			
			$i = 0;
			for ($currentDate = $startDt; $currentDate < $endDt; $currentDate += (86400)) {                               
				$rangArray[$i]['date'] = date('jS M Y', $currentDate);
				$rangArray[$i]['day'] = date('l', $currentDate);
				$i++;
			}
			
			
			$accomodation_availability = array();
			
			$accomms = $this->maccommodation->get_accommodation_list_property_id($request_data['property_id']);
			//echo '<pre>'; print_r($accomms); die;
			
			$i = 0;
			foreach ($accomms as $accomm) {
				$accomm_availibility = $this->maccommodation->get_property_accomm_availability($accomm["property_id"], $accomm["accommodation_id"], $startDate, $endDate);
				
				$accomodation_availability[$i]['accommodation'] = $accomm;
				$accomodation_availability[$i]['availability'] = $accomm_availibility;
				
				$i++;
			}
			
			
			$html = '';
			if (isset($accomodation_availability)) {
				
				$html .= '<table class="table table-striped table-hover table_custom" id="avs_table">
						<thead>
							<tr id="calhead2">
								<th align="center" valign="middle">Accommodation<br><small>Category</small></th>';
								if (isset($rangArray)) {
									foreach ($rangArray as $d) {
									$html .= '<th align="center" valign="middle">'.$d['date'].'<br><small>'.$d['day'].'</small></th>';
									}
								}
				$html .= '	</tr>
						</thead>
						<tbody id="list_tbl_body_id">';
							foreach ($accomodation_availability as $accomm) { 
								$r = $accomm['accommodation'];
								$r1 = $accomm['availability'][0];
								
								$html .= '<tr>
											<td align="center" valign="middle" class="roomtype"><a href="#">'.$r['accommodation_name'].'</a>										</td>';
								foreach ($accomm['availability'] as $rr) {
									$html .= '<td align="center" valign="middle">
												<p><a href="#" class="f12 label label-success">Available:'.$rr['available_room_cnt'].' </a></p>
											</td>';
								}
								$html .= '</tr>';
							}
				$html .= '</tbody>
					</table>';
			}
		}
		//end check room availability
		//echo $html; die;
		
		$check_in_date = date_create($request_data['check_in_date']);
		$check_out_date = date_create($request_data['check_out_date']);
		$diff_check_in_out = date_diff($check_in_date, $check_out_date);
		$diff_check_in_out_nights = $diff_check_in_out->format("%a Nights");
		$request_data['discount_perc'] = isset($request_data['discount_perc']) && !empty($request_data['discount_perc']) ? $request_data['discount_perc'] : 0;
		$select_room_qty = $request_data['select_room_qty'];
		$select_accommodation_id = $request_data['select_accommodation_id'];

		$select_final_accommodation_id = array(); 
		$select_final_accommodation_qty = array(); 
		foreach($select_room_qty as $select_room_qty_key => $qty){
			if($qty > 0){
				$select_final_accommodation_id[] = $select_accommodation_id[$select_room_qty_key];
				$select_final_accommodation_qty[] = $qty;
			}
		}
		//echo '<pre>'; print_r($select_final_accommodation_id);die;
		
		
		$search_room_data = $this->mbooking->search_room($request_data);
		//echo '<pre>'; print_r($search_room_data);die;

		$search_room_data_key = array();

		if (!empty($request_data['adult'])) {

			foreach ($request_data['adult'] as $adult_key => $adult) {

				$array_search_params = array(
					'adult' => $adult,
					'child' => isset($request_data['child'][$adult_key]) ? $request_data['child'][$adult_key] : '',
					'accommodation_id' => isset($request_data['accommodation_id'][$adult_key]) ? $request_data['accommodation_id'][$adult_key] : '',
					'select_final_accommodation_id' => $select_final_accommodation_id
				);

				$array_search_function = $this->array_search_function($search_room_data, $array_search_params);
				//print_r($array_search_function);die;
				if ($array_search_function) {

					$search_room_data_key = array_merge($search_room_data_key, $array_search_function);
				}
			}
		}

		
		//echo '<pre>'; print_r(array_unique($search_room_data_key)); die;
		$search_room_data = array_values(array_intersect_key($search_room_data, array_flip(array_unique($search_room_data_key))));
		foreach ($search_room_data as $search_room_key => $search_room) {
			
			foreach($select_room_qty as $select_room_qty_key => $qty){
				if($qty > 0 && $search_room['accommodation_id'] == $select_accommodation_id[$select_room_qty_key]){
					$search_room_data[$search_room_key]['select_room_qty'] =  $qty;
				}
			}

		}
		//echo '<pre>'; print_r($search_room_data); die;

		$return_data = array('status' => true, 'search_room_data' => $search_room_data, 'diff_check_in_out_nights' => $diff_check_in_out_nights, 'accommodation_available' => $html);
		echo json_encode($return_data);
	}


	private function array_search_function($products, $array_search_params)
	{
		$return_key_array = array();

		foreach ($products as $key => $product) {
			$search_params_result = 1;

			foreach ($array_search_params as $array_search_params_key => $array_search_params_value) {

				if (!empty($array_search_params_value)) {

					if (in_array($array_search_params_key, array("adult", "child")) && ($product[$array_search_params_key] < $array_search_params_value)) {

						$search_params_result = 0;
					}
					if (in_array($array_search_params_key, array("accommodation_id")) && ($product[$array_search_params_key] != $array_search_params_value)) {

						$search_params_result = 0;
					}

					if (($array_search_params_key == "select_final_accommodation_id") && (!in_array($product['accommodation_id'],$array_search_params_value))) {

						$search_params_result = 0;
					}

					
				}
			}

			if ($search_params_result == 1) {
				$return_key_array[] = $key;
			}
		}
		return $return_key_array;
	}

	public function downloadInvoice($booking_id)
	{
		
		// echo "We are working on it. When it's completed then you can use this functionality. Thanks !";exit();
		$this->load->library('pdf');
		$data = array();

		$data['booking_header'] = $this->query->getBookingHeader($booking_id);
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
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);
		// $data['customer_details'] = $this->query->getBookingDetailsOfCustomer($this->session->userdata('customer_id'));
		// $data['countries'] = $this->mcommon->getDetails('country_master', array());
		// $data['booking_details'] = $this->mcommon->getRow('booking_listing_view', array('booking_id' => $booking_id));
		// $data['guest_details'] = $this->query->getguestDetails($booking_id);
		// $data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id));
		// $data['content'] = 'frontend/downloadInvoiceNew';
		//echo '<pre>';print_r($data);die;
		$filename = 'invoice-' . time(); 
		$html = $this->load->view('frontend/downloadInvoiceNew', $data, true);
		// $this->pdf->create($html, $filename);
		// echo $html;die;

		$this->pdf->loadHtml($html);
		$this->pdf->set_paper("a4", "landscape");
		$this->pdf->render();

		$this->pdf->stream("" . $filename . ".pdf", array("Attachment" => 0));
	}

	/**
	 * @request input booking_id, reason
	 * response json
	 */
	public function cancel_booking()
	{
		//echo '<pre>';print_r($this->input->post());die;
		if (empty($this->input->post('booking_id'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking ID is required.',
			);
			echo json_encode($response);
			exit;
		}

		if (empty($this->input->post('reason'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking Cancellation reason is required.',
			);
			echo json_encode($response);
			exit;
		}

		if (empty($this->input->post('booking_source'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking source is required.',
			);
			echo json_encode($response);
			exit;
		}


		$booking_id = $this->input->post('booking_id');
		$cancel_request_details = $this->db->from('cancel_request_tbl')->where('booking_id', $booking_id)->order_by('cancel_request_id', 'DESC')->limit(1)->get()->row_array();

		if (!empty($cancel_request_details)) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking Already Cancelled.',
			);
			echo json_encode($response);
			exit;
		}

		$booking_payment_details = $this->db->from('booking_payment')->where('booking_id', $booking_id)->order_by('booking_payment_id', 'DESC')->limit(1)->get()->row_array();
		$booking_det = $this->mbooking->get_booking_detail($booking_id);

		$cancel_request_data = array();
		$result_decoded = array();
		if($this->input->post('booking_source')){
			if (!empty($booking_payment_details)) {

				// key|command|var1|salt
				$hash_string  = _STAGE_MERCHANT_KEY . '|' . 'cancel_refund_transaction' . '|' . $booking_payment_details['transaction_ref_id'];
				$hash_string .= '|' . _STAGE_SALT;
	
	
				$payu_hash =  hash("sha512", $hash_string);
	
				$token_ID = _STAGE_MERCHANT_KEY . $booking_id . mt_rand();
	
				/* Endpoint */
				$url = _STAGE_PAYU_API_BASE_URL;
	
				try {
	
					if ($booking_det['booking_status'] == 'A' && $this->input->post('refund_amt') > 0 && $this->input->post('booking_source') == 'F') {
	
						/* eCurl */
						$curl = curl_init($url);
	
						/* Data */
						$data = [
							'key' => _STAGE_MERCHANT_KEY,
							'command' => 'cancel_refund_transaction',
							'hash' => $payu_hash,
							'var1' => $booking_payment_details['transaction_ref_id'], //Payu ID (mihpayid) of transaction
							'var2' => $token_ID, //Token ID (unique token from merchant) for the refund request
							'var3' => $this->input->post('refund_amt'), //This parameter should contain the amount which needs to be refunded
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
	
						$result_decoded = json_decode($result, true);
						$result_decoded['is_refunded'] = 0;

					} else {
	
						$result_decoded['status'] = 1;
						$result_decoded['request_id'] = '';
						$result_decoded['is_refunded'] = 1;
					}
	
					//echo '<pre>';print_r($result_decoded);
					if (!empty($result_decoded) && $result_decoded['status'] == 1) {
	
						$cancel_gst_percent = CANCEL_GST_PERC;
						$cancel_request_data = array(
							'booking_id' => $booking_id,
							'net_payble_amount' => $this->input->post('net_payble_amount'),
							'paid_amount' => $this->input->post('paid_amount'),
							'cancel_percent' => $this->input->post('cancel_percent'),
							'cancel_charge' => $this->input->post('cancel_charge'),
							'cancel_gst_percent' => $cancel_gst_percent,
							'cancel_gst' => $this->input->post('gst_charge_show'),
							'refund_amt' => $this->input->post('refund_amt'),
							'refunded_amount' => $this->input->post('refund_amt'),
							'cancel_type' => 'F',
							'created_by' => $this->admin_session_data['user_id'],
							'created_user_type' => 'U',
							'created_ts' => date('Y-m-d H:i:s'),
							'is_refunded' => $result_decoded['is_refunded'],
							'cancel_refund_request_id' => $result_decoded['request_id'],
							'cancel_request_response' => $result
	
						);
						//echo '<pre>'; print_r($cancel_request_data);die;
	
					} else {
	
						throw new Exception($result_decoded['msg']);
					}
	
					// {"status":1,"msg":"Refund Request Queued","request_id":"134555708","bank_ref_num":null,"mihpayid":403993715527389777,"error_code":102}
	
	
	
				} catch (Exception $e) {
					// this will not catch DB related errors. But it will include them, because this is more general. 
					$response = array('status' => false, 'message' => $e->getMessage());
					echo json_encode($response);
					exit;
				}
			} else {
	
				$response = array('status' => false, 'message' => 'Payment info not found');
				echo json_encode($response);
				exit;
			}

		}
		

		$this->db->trans_start(); # Starting Transaction
		if (!empty($cancel_request_data)) {

			$this->db->insert('cancel_request_tbl', $cancel_request_data);
		}

		$update_array = array(
			'booking_status' => 'C',
			'is_refunded' => $cancel_request_data['is_refunded'],
			'cancellation_remarks' => $this->input->post('reason'),
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_user_type' => 'U',
			'updated_ts' => date('Y-m-d H:i:s')
		);
		$result = $this->mbooking->update_booking_details($booking_id, $update_array);

		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$response = array('status' => false, 'message' => 'Unable to Cancel booking.');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();

			/* Booking Cancellation Email Sending */

			$config = email_config();
			$email_from = $config['email_from'];
			unset($config['email_from']);

			$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled';

			$message = 'Dear Sir / Madam,
			
			Your Booking (ID ' . $booking_det['booking_no'] . ') has been cancelled. Refund (if any) will be initiated shortly.

For more details please login to www.prdtourism.in

Panchayat Tourism
Department of Panchayat & Rural Development
Government of West Bengal';

			$property_details = $this->db->from('property_master')->where('property_id', $booking_det['property_id'])->get()->row_array();


			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($email_from, EMAIL_FROM_NAME); // change it to yours
			$this->email->to($booking_det['customer_email']); // change it to yours 
			$cc_email = array();
			if (!empty($property_details) && !empty($property_details['email'])) {
				$cc_email[] = $property_details['email'];
			}
			if (!empty($property_details) && !empty($property_details['contact_person_1_email'])) {
				$cc_email[] = $property_details['contact_person_1_email'];
			}
			if (!empty($property_details) && !empty($property_details['contact_person_2_email'])) {
				$cc_email[] = $property_details['contact_person_2_email'];
			}
			if (!empty($cc_email)) {

				$this->email->cc($cc_email);
			}
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();





			//echo '<pre>'; print_r($this->email->print_debugger());die;

			payment_cancelled($booking_det['mobile'], $booking_det['booking_no']);


			$response = array('success' => true, 'message' => 'Booking has been cancelled successfully');
		}

		echo json_encode($response);
		exit;
	}
	
	
	/**
	 * @request by admin
	 * @request input booking_id, reason
	 * response json
	 */
	public function cancel_booking_admin()
	{
		//echo '<pre>';print_r($this->input->post());die;
		if (empty($this->input->post('booking_id'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking ID is required.',
			);
			echo json_encode($response);
			exit;
		}

		if (empty($this->input->post('reason'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking Cancellation reason is required.',
			);
			echo json_encode($response);
			exit;
		}

		if (empty($this->input->post('booking_source'))) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking source is required.',
			);
			echo json_encode($response);
			exit;
		}


		$booking_id = $this->input->post('booking_id');
		$cancel_request_details = $this->db->from('cancel_request_tbl')->where('booking_id', $booking_id)->order_by('cancel_request_id', 'DESC')->limit(1)->get()->row_array();

		if (!empty($cancel_request_details)) {
			$response = array(
				'success' => FALSE,
				'message' => 'Booking Already Cancelled.',
			);
			echo json_encode($response);
			exit;
		}

		$booking_payment_details = $this->db->from('booking_payment')->where('booking_id', $booking_id)->order_by('booking_payment_id', 'DESC')->limit(1)->get()->row_array();
		$booking_det = $this->mbooking->get_booking_detail($booking_id);

		$cancel_request_data = array();
		$result_decoded = array();
		
		if($this->input->post('booking_source')){
	
			$result_decoded['status'] = 1;
			$result_decoded['request_id'] = '';
			$result_decoded['is_refunded'] = 1;

			//echo '<pre>';print_r($result_decoded);
			if (!empty($result_decoded) && $result_decoded['status'] == 1) {

				$cancel_request_data = array(
					'booking_id' => $booking_id,
					'net_payble_amount' => '0.00',
					'paid_amount' => '0.00',
					'cancel_percent' => '0.00',
					'cancel_charge' => '0.00',
					'cancel_gst_percent' => '0.00',
					'cancel_gst' => '0.00',
					'refund_amt' => '0.00',
					'refunded_amount' => '0.00',
					'cancel_type' => 'F',
					'created_by' => $this->admin_session_data['user_id'],
					'created_user_type' => 'U',
					'created_ts' => date('Y-m-d H:i:s'),
					'is_refunded' => $result_decoded['is_refunded'],
					'cancel_refund_request_id' => $result_decoded['request_id'],
					'cancel_request_response' => $result

				);
				//echo '<pre>'; print_r($cancel_request_data);die;

			}

		}
		

		if (!empty($cancel_request_data)) {

			$this->db->insert('cancel_request_tbl', $cancel_request_data);
		}

		$update_array = array(
			'booking_status' => 'C',
			'is_refunded' => $cancel_request_data['is_refunded'],
			'cancellation_remarks' => $this->input->post('reason'),
			'updated_by' => $this->admin_session_data['user_id'],
			'updated_user_type' => 'U',
			'updated_ts' => date('Y-m-d H:i:s')
		);
		$result = $this->mbooking->update_booking_details($booking_id, $update_array);

		if($result){

			/* Booking Cancellation Email Sending */

			$config = email_config();
			$email_from = $config['email_from'];
			unset($config['email_from']);

			$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled';

			$message = 'Dear Sir / Madam,
			
			Your Booking (ID ' . $booking_det['booking_no'] . ') has been cancelled. Refund (if any) will be initiated shortly.

For more details please login to www.prdtourism.in

Panchayat Tourism
Department of Panchayat & Rural Development
Government of West Bengal';

			$property_details = $this->db->from('property_master')->where('property_id', $booking_det['property_id'])->get()->row_array();


			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($email_from, EMAIL_FROM_NAME); // change it to yours
			$this->email->to($booking_det['customer_email']); // change it to yours 
			$cc_email = array();
			if (!empty($property_details) && !empty($property_details['email'])) {
				$cc_email[] = $property_details['email'];
			}
			if (!empty($property_details) && !empty($property_details['contact_person_1_email'])) {
				$cc_email[] = $property_details['contact_person_1_email'];
			}
			if (!empty($property_details) && !empty($property_details['contact_person_2_email'])) {
				$cc_email[] = $property_details['contact_person_2_email'];
			}
			if (!empty($cc_email)) {

				$this->email->cc($cc_email);
			}
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();





			//echo '<pre>'; print_r($this->email->print_debugger());die;

			payment_cancelled($booking_det['mobile'], $booking_det['booking_no']);


			$response = array('success' => true, 'message' => 'Booking has been cancelled successfully');
			
		}

		echo json_encode($response);
		exit;
	}
	
	function getDatesFromRange($start, $end){
		$dates = array($start);
		while(end($dates) < $end){
			$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
		}
		return $dates;
	}
	
	
}
