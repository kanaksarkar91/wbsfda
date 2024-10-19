<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mreservation', 'admin/mbooking', 'admin/mproperty', 'frontend/query', 'mcommon'));
		$this->load->helper(array('sms', 'email', 'common', 'crypto', 'otp'));
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
		// 
		// print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add_booking()
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));
		$data['nationalities'] = $this->mcommon->getDetailsOrder('nationality', array('status_flag' => 1), 'nationality', 'ASC');

		$data['content'] = 'admin/booking/add_room_booking';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit_accomodation_booking($booking_id = 0)
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));
		$data['nationalities'] = $this->mcommon->getDetailsOrder('nationality', array('status_flag' => 1), 'nationality', 'ASC');
		
		//for edit booking
		$data['request_data'] = $this->mbooking->getBookingData($booking_id);
		$data['accommodations'] = $this->mbooking->get_getaccommodation($data['request_data']['property_id']);
		$data['selected_customer_details'] = $this->mcommon->getRow('customer_master', array('customer_id' => $data['request_data']['customer_id']));
		//print_r($data['request_data']);die;
		//----------------

		$data['content'] = 'admin/booking/edit_room_booking';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function change_room($booking_id = 0, $booking_detail_id = 0)
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));
		
		//for edit booking
		$data['request_data'] = $this->mbooking->getBookingData($booking_id);
		$data['detail_request_data'] = $this->mcommon->getRow('booking_detail', array('booking_detail_id' => $booking_detail_id));
		$data['accommodations'] = $this->mbooking->get_getaccommodation($data['request_data']['property_id']);
		$data['selected_customer_details'] = $this->mcommon->getRow('customer_master', array('customer_id' => $data['request_data']['customer_id']));
		$data['booking_detail_id'] = $booking_detail_id;
		//print_r($data['detail_request_data']);die;
		//----------------

		$data['content'] = 'admin/booking/change_room_booking';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add_booking_1()
	{
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//print_r($data['properties']);die;
		$data['customer_list'] = $this->mbooking->get_customer_list();
		$data['states'] = $this->mbooking->get_property_state(array('state_master.country_id' => 101, 'is_active' => 1));
		$data['countries'] = $this->mbooking->get_property_country(array('country_id' => 101));

		$data['content'] = 'admin/booking/add_room_booking_1';
		$this->load->view('admin/layouts/index', $data);
	}


	public function booking_details($booking_id)
	{
		$data = array();
		$data = array('menu_id'=> 78);
		$data['cancel_button_visible'] = 'No';
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['cancel_button_visible'] = 'Yes';
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$data['cancel_button_visible'] = 'Yes';
			}
		}
		
		$data['content'] = 'admin/booking/booking_details';
		$data['booking_details'] = $this->mbooking->get_booking_details($booking_id);
		$data['booking_payment_details'] = $this->mbooking->get_booking_payment_details($booking_id);
		$data['cancellation_details'] = array();
		$data['cancellation_request_details'] = array();
		$data['booking_source'] = '';
		$data['payable_amount'] = $this->mbooking->get_payable_amt($booking_id);
		
		$data['booking_documents'] = $this->mcommon->getDetails('booking_documents', array('booking_id' => $booking_id));
		
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

		//print_r($data['booking_details']);die;
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
		//echo "<pre>"; print_r($this->input->post());die;
		//print_r($_FILES['supporting_doc']['name']); die;
		
		if($this->input->post('booking_id') > 0){
			//booking header data move to history table
			//$this->mbooking->update_booking_header_to_history($this->input->post('booking_id'));
			
			//booking detail data move to history table
			$this->mbooking->update_booking_detail_to_history($this->input->post('booking_id'));
		}
		
		//echo $this->db->last_query(); die;

		$book_room_qty = $this->input->post('book_room_qty');
		$customer_id = 0;
		$customer_data = array();
		$room_search_data = array();
		$day_wise_rates_json = '';
		$day_wise_rates_decode_data = array();
		$room_cgst_percent = '';
		$room_sgst_percent = '';
		$room_igst_percent = '';
		
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
			
			if($this->input->post('customer_type') == 'P'){
				$check_customer = $this->db->from('customer_master')->where('mobile', $this->input->post('mobile'))->get()->row_array();
				
				$this->form_validation->set_rules('first_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
				$this->form_validation->set_rules('email','Email','trim|required|valid_email');
				$this->form_validation->set_rules('designation','Designation','trim|regex_match[/^([a-z ])+$/i]');
			}
			else if($this->input->post('customer_type') == 'B'){
				$check_customer = $this->db->from('customer_master')->where('company_phone', $this->input->post('company_phone'))->get()->row_array();
				
				$this->form_validation->set_rules('company_name','Company Name','trim|required|regex_match[/^([a-z ])+$/i]');
				$this->form_validation->set_rules('company_phone', 'Company Phone', 'trim|required|numeric|min_length[10]|max_length[10]');
				$this->form_validation->set_rules('company_email','Company Email','trim|required|valid_email');
			}
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				$return_data = array('status' => false, 'msg' => validation_errors());
				echo json_encode($return_data);
				die;
			}
			else{
				if (!empty($check_customer)) {
					$return_data = array('status' => false, 'msg' => 'Customer / Business mobile number already exist');
					echo json_encode($return_data);
					die;
				}
	
				$splitName = explode(' ', $this->input->post('first_name'));
	
				$customer_data['customer_title'] = $this->input->post('customer_title');
				$customer_data['first_name'] = $this->input->post('first_name');
				//$customer_data['last_name'] = $splitName[1];
				$customer_data['designation'] = $this->input->post('designation');
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
			}
		} else {
			$customer_id = $this->input->post('customer_id');
		}
		
		$customer_data = $this->db->from('customer_master')->where('customer_id', $customer_id)->get()->row_array();
		
		if($this->input->post('booking_id') > 0){
			$bookingHeaderData = $this->mcommon->getRow('booking_header', array('booking_id' => $this->input->post('booking_id')));
			$booking_header_data['edit_count'] = ($bookingHeaderData['edit_count'] + 1);
			$splitBookingNo = explode('-', $bookingHeaderData['booking_no']);
			$booking_header_data['booking_no'] = $splitBookingNo[0].'-'.str_pad($booking_header_data['edit_count'],5,"0",STR_PAD_LEFT);
			
			$booking_header_data['previous_room_base_price'] = $bookingHeaderData['room_base_price'];
			$booking_header_data['previous_room_total_discount'] = $bookingHeaderData['room_total_discount'];
			$booking_header_data['previous_room_price_before_tax'] = $bookingHeaderData['room_price_before_tax'];
			$booking_header_data['previous_room_total_igst'] = $bookingHeaderData['room_total_igst'];
			$booking_header_data['previous_room_payable_amount'] = $bookingHeaderData['room_payable_amount'];
			$booking_header_data['previous_net_payable_amount'] = $bookingHeaderData['net_payable_amount'];
			
			$booking_header_data['updated_ts'] = date('Y-m-d H:i:s');
			$booking_header_data['updated_by'] = $this->admin_session_data['user_id'];
			$booking_header_data['updated_user_type'] = 'U';
			//echo "<pre>"; print_r($booking_header_data); die;
			$this->mcommon->update('booking_header', array('booking_id' => $this->input->post('booking_id')), $booking_header_data);
		}
		else{
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
				'booking_status' => 'A',
				'remarks' => $this->input->post('remarks'),
				//'supporting_doc' => $supporting_doc,
				'created_by' => $this->admin_session_data['user_id'],
				'created_user_type' => 'U',
				'created_ts' => date('Y-m-d H:i:s'),
				'booking_source' => 'B',
				'search_text' => json_encode($room_search_data)
			);
			
			$this->db->insert('booking_header', $booking_header_data);
			$booking_id  =  $this->db->insert_id();
		}

		if (!empty($book_room_qty)) {
			
			foreach ($book_room_qty as $room_key => $room_qty) {
				for ($i = 1; $i <= $room_qty; $i++) {
					
					$day_wise_rates_json = str_replace("'",'"',$this->input->post('day_wise_rates_json')[$room_key]);
					$day_wise_rates_decode_data = json_decode($day_wise_rates_json, true);
					
					foreach($day_wise_rates_decode_data as $row){
						
						$room_cgst_percent = (($row['cgst_amount'] / $row['base_price']) *100);
						$room_sgst_percent = (($row['sgst_amount'] / $row['base_price']) *100);
						$room_igst_percent = (($row['igst_amount'] / $row['base_price']) *100);
						
						$extra_bed_price = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? ($row['extra_bed_price_b4_disc']) : '0.00';
						$room_cgst = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? ($row['tax_amount_base_plus_extra'] / 2) : $row['cgst_amount'];
						$room_sgst = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? ($row['tax_amount_base_plus_extra'] / 2) : $row['sgst_amount'];
						$room_igst = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? $row['tax_amount_base_plus_extra'] : $row['igst_amount'];
						$room_taxable_amount = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? ($row['base_price'] + $row['extra_bed_price_b4_disc']) : $row['base_price'];
						
						$_adult = ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? ($this->input->post('adult')[$room_key] + 1) : $this->input->post('adult')[$room_key];
						
						$day_wise_extra_pax = ($room_qty * $this->input->post('is_select_extra_bed')[$room_key]);
						
						$booking_detail_data[] = array(
							'booking_id' => ($booking_id != '') ? $booking_id : $this->input->post('booking_id'),
							'accommodation_id' => $this->input->post('book_room_accommodation_id')[$room_key],
							'is_select_extra_bed' => ($i <= $this->input->post('is_select_extra_bed')[$room_key]) ? 1 : 0,
							'in_date' => $row['temp_date'],
							'out_date' => date('Y-m-d', strtotime("+1 day", strtotime($row['temp_date']))),
							'adults' => $_adult,
							'children' => $this->input->post('child')[$room_key],
							'allotment_status' => 'B',
							'rate_category_id' => 1,
							'extra_bed_rate' => $extra_bed_price,
							'room_rate' => $row['base_price_b4_disc'],
							'room_charge' => $row['base_price_b4_disc'],
							'room_discount_percent' => $this->input->post('room_discount_percent')[$room_key],
							'room_discount_amount' => $row['disc_amt_on_base'],
							'room_taxable_amount' => $room_taxable_amount,
							'room_cgst' => $room_cgst,
							'room_sgst' => $room_sgst,
							'room_igst' => $room_igst,
							'room_cgst_percent' => number_format($room_cgst_percent,2),
							'room_sgst_percent' => number_format($room_sgst_percent,2),
							'room_igst_percent' => number_format($room_igst_percent,2),
							'room_net_amount' => ($room_taxable_amount + $room_igst),
							'same_line_item' => $room_key.''.$i
						);
						
					}
					
				}
			}
			
			//echo "<pre>"; print_r($day_wise_rates_decode_data);
			//echo "<pre>"; print_r($booking_detail_data); die;
		}

		if (!empty($booking_detail_data)) {
			$this->db->insert_batch('booking_detail', $booking_detail_data);
		}
		
		//update header amount section
		$bookingDetailData = $this->mbooking->get_booking_detail_sum_data(array('booking_id' => ($booking_id != '') ? $booking_id : $this->input->post('booking_id')));
		
		$update_header_data['room_base_price'] = $bookingDetailData['tot_room_charge'];
		$update_header_data['room_total_discount'] = $bookingDetailData['tot_room_discount_amount'];
		$update_header_data['room_price_before_tax'] = $bookingDetailData['tot_room_taxable_amount'];
		$update_header_data['room_total_cgst'] = $bookingDetailData['tot_room_cgst'];
		$update_header_data['room_total_sgst'] = $bookingDetailData['tot_room_sgst'];
		$update_header_data['room_total_igst'] = $bookingDetailData['tot_room_igst'];
		$update_header_data['room_payable_amount'] = $bookingDetailData['tot_room_net_amount'];
		$update_header_data['net_payable_amount'] = $bookingDetailData['tot_room_net_amount'];
		
		$this->mcommon->update('booking_header', array('booking_id' => ($booking_id != '') ? $booking_id : $this->input->post('booking_id')), $update_header_data);
		//end update header amount section
		
		//Supporting Documents Upload
		if (!empty($_FILES['supporting_doc']['name'])) {
			
			$filesCount = count($_FILES['supporting_doc']['name']);
			
			//echo $filesCount; die;
			
			for($f = 0; $f < $filesCount; $f++){ 
				
				$_FILES['file']['name']     = $_FILES['supporting_doc']['name'][$f]; 
				$_FILES['file']['type']     = $_FILES['supporting_doc']['type'][$f]; 
				$_FILES['file']['tmp_name'] = $_FILES['supporting_doc']['tmp_name'][$f]; 
				$_FILES['file']['error']    = $_FILES['supporting_doc']['error'][$f]; 
				$_FILES['file']['size']     = $_FILES['supporting_doc']['size'][$f];
				
				$config['upload_path']          = './public/admin_images/booking_supporting_doc';
				$config['allowed_types']        = '*';
				$config['max_size']             = 5000;
				$config['encrypt_name'] 		= TRUE;
				
				// Load and initialize upload library 
				$this->load->library('upload', $config); 
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){ 
					// Uploaded file data 
					$fileData = $this->upload->data(); 
					
					$uploadData['booking_id'] = ($booking_id != '') ? $booking_id : $this->input->post('booking_id'); 
					$uploadData['doc_file'] = $fileData['file_name']; 
					$uploadData['created_ts'] = date("Y-m-d H:i:s");
					$uploadData['created_by'] = $this->admin_session_data['user_id'];
					
					$this->mcommon->insert('booking_documents', $uploadData);
				}
				
			}
		}
		//

		
		//if foreigner
		if($this->input->post('guest_type_foreign') == 1){
			
			$foreigner_name=$this->input->post('foreigner_name');
			$foreigner_age=$this->input->post('foreigner_age');
			$foreigner_gender=$this->input->post('foreigner_gender');
			$foreigner_nationality=$this->input->post('foreigner_nationality');
			
			//Start Information dtl Save
			for ($f = 0; $f < sizeof($foreigner_name); $f++) {

				if ($foreigner_name[$f] != '' && $foreigner_age[$f] != '' && $foreigner_gender[$f] != '' && $foreigner_nationality[$f] != '') 				{

					$foreigner_data = array(
						'booking_id' => ($booking_id != '') ? $booking_id : $this->input->post('booking_id'),
						'foreigner_name' => $foreigner_name[$f],
						'foreigner_age' => $foreigner_age[$f],
						'foreigner_gender' => $foreigner_gender[$f],
						'foreigner_nationality' => $foreigner_nationality[$f]
					);

					$this->mcommon->insert('booking_foreigner_details', $foreigner_data);
				}
			}
			//End Information dtl Save
			
		}
		//
		

		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			
			$return_data = array('status' => false, 'msg' => 'Oops!Something went wrong...');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();

			//Booking Slip PDF generate
			$_booking_id = ($booking_id != '') ? $booking_id : $this->input->post('booking_id');
			
			$this->load->library('pdf');
	
			$data['booking_header'] = $this->query->getBookingHeader($_booking_id);
			$data['customer_details'] = $this->query->getBookingDetailsOfCustomer($_booking_id);
			$data['booking_details'] = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $_booking_id));
			$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $_booking_id, 'status' => 'Success'));
			$data['property_details'] = $this->query->getPropertyDetails($_booking_id);
			
			$filename = 'booking-'.time().'-'.$booking_id;
			$html=$this->load->view('frontend/emailAttachment', $data,true);
			// $this->pdf->create($html, $filename);
			// echo $html;die;
	
			$this->pdf->loadHtml($html);
			$this->pdf->set_paper("A4", "landscape" );
			$this->pdf->render();
			
			$output = $this->pdf->output();
			file_put_contents(FCPATH. 'public/booking_confirmation_pdf/'.$filename.'.pdf', $output);

			$attach_file = base_url() . 'public/booking_confirmation_pdf/' . $filename . '.pdf';
			//End PDF
			
			/* Online Payment & Booking Confirmation Email Sending */

				$config = email_config();
				$email_from = $config['email_from'];
				unset($config['email_from']);
		
		
				$subject = 'Booking ID  ' . $booking_header_data['booking_no'] . ' is Confirmed.';
		
				$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
    <center style="width: 100%; background-color: #f1f1f1; font-family: Arial, Helvetica, sans-serif;">
        <div style="max-width: 600px; margin: 0 auto;">
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr style="background-color: #FFF;">
                    <td valign="top" style="padding: 1em; border: 1px solid #00bdd6;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
                            <tr>
                                <td style="text-align: left;padding:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="..."></img>
                                </td>
                                <td style="text-align: center;">
                                    <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                                    <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                                    <h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for confirmation of booking</h2>
                                </td>
                                <td style="text-align: right;padding-right:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="48" alt="..." style="margin-top:16px;"></img>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #FFF;border-left: 1px solid #00bdd6; border-right: 1px solid #00bdd6;">
                            <tr>
                                <td>
                                    <div style="text-align: left; padding: 0 15px; font-size: 13px; line-height: 1.5;">
                                        <p>Sir/Madam</p>
                                        
                                        <p style="margin-bottom:0;">
                                            Thank you for booking with SFDC at '.$data['property_details']['property_name'].', ('.$data['property_details']['address_line_1'].'). The booking confirmation receipt is attached herewith. Kindly produce the hard copy at the time of check-in. We aspire you to have a delightful sojourn with us.
                                        </p>
                                        <p style="margin-bottom:0;">Thanks and Regards,</p>
                                        <p style="margin-top:0;">The S.F.D.C.Ltd.</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #e9e9e9;">
                <tr>
                    <td style="text-align: left; color: #000000; padding: 15px; font-size: 12px; border: 1px solid #00bdd6;">
                        <p style="margin-top: 0; margin-bottom: 5px;">
                            <b>Address:</b>
                            <span>Bikash Bhawan, North Block,1st Floor, Salt Lake, Kolkata-700091</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Head Office:</b>
                            <span>(033) 23583123</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Guest House Booking:</b>
                            <span>(033) 23376469</span>
                        </p>
                        <p style="margin-bottom: 0;margin-top:0;">
                            <b>Email Us On:</b>
                            <span>headoffice@wbsfdcltd.com / tourism@wbsfdcltd.com</span>
                        </p>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #00bdd6;">
                <tr>
                    <td style="text-align: center; color: #FFF; padding: 5px 15px; font-size: 12px;">
                        <p>
                            <span>© '.date('Y').' The State Fisheries Development Corporation Limited<br>  (Government of West Bengal Undertaking).All right reserved.
                            </span>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
    </center>
</body>';
		
				$property_details = $this->db->from('property_master')->where('property_id', $this->input->post('property_id'))->get()->row_array();
		
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($email_from, EMAIL_FROM_NAME); // change it to yours
				$this->email->to($booking_header_data['email']); // change it to yours 
				
				/*$cc_email = array();
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
				}*/
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->attach($attach_file);
				$this->email->send();
		
				//print_r($this->email->print_debugger());die;
				
				$bookingDates = $booking_header_data['check_in'].'%20To%20'.$booking_header_data['check_out'];
				payment_confirmed($booking_header_data['mobile'], $data['property_details']['property_name'], $$bookingDates, $booking_header_data['booking_no']);

			$return_data = array('status' => true, 'msg' => 'Congratulations!Booking done successfully.');
		}

		echo json_encode($return_data);
		die;
	}
	
	public function change_room_submit()
	{
		//print_r($this->input->post());die;
		
		$book_room_qty = $this->input->post('book_room_qty');
		$customer_id = 0;
		$customer_data = array();
		$room_search_data = array();
		$day_wise_rates_json = '';
		$day_wise_rates_decode_data = array();
		$room_cgst_percent = '';
		$room_sgst_percent = '';
		$room_igst_percent = '';
		
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
		
		/*$bookingHeaderData = $this->mcommon->getRow('booking_header', array('booking_id' => $this->input->post('booking_id')));
		
		$booking_header_data = array(
			//'edit_count' => ($bookingHeaderData['edit_count'] + 1),
			'room_base_price' => ($bookingHeaderData['room_base_price'] + $this->input->post('room_base_price')),
			'room_price_before_tax' => ($bookingHeaderData['room_price_before_tax'] + $this->input->post('room_price_before_tax')),
			'room_total_igst' => ($bookingHeaderData['room_total_igst'] + $this->input->post('room_total_igst')),
			'room_payable_amount' => ($bookingHeaderData['room_payable_amount'] + $this->input->post('total_amount')),
			'net_payable_amount' => ($bookingHeaderData['net_payable_amount'] + $this->input->post('net_amount')),
			'updated_by' => $this->admin_session_data['user_id'],
			'created_user_type' => 'U',
			'updated_ts' => date('Y-m-d H:i:s'),
			'booking_source' => 'B'
		);
		
		$this->mcommon->update('booking_header', array('booking_id' => $this->input->post('booking_id')), $booking_header_data);*/

		//print_r($book_room_qty); die;
		if (!empty($book_room_qty)) {

			foreach ($book_room_qty as $room_key => $room_qty) {
				for ($i = 1; $i <= $room_qty; $i++) {
					
					$day_wise_rates_json = str_replace("'",'"',$this->input->post('day_wise_rates_json')[$room_key]);
					$day_wise_rates_decode_data = json_decode($day_wise_rates_json, true);
					
					foreach($day_wise_rates_decode_data as $row){
						
						$room_cgst_percent = (($row['cgst_amount'] / $row['base_price']) *100);
						$room_sgst_percent = (($row['sgst_amount'] / $row['base_price']) *100);
						$room_igst_percent = (($row['igst_amount'] / $row['base_price']) *100);
						
						$booking_detail_data = array(
							'booking_id' => $this->input->post('booking_id'),
							'accommodation_id' => $this->input->post('book_room_accommodation_id')[$room_key],
							'in_date' => $row['temp_date'],
							'out_date' => date('Y-m-d', strtotime("+1 day", strtotime($row['temp_date']))),
							'adults' => $this->input->post('select_adult')[$room_key],
							'children' => $this->input->post('child')[$room_key],
							'allotment_status' => 'I',
							'rate_category_id' => 1,
							'room_rate' => $row['base_price_b4_disc'],
							'room_charge' => $row['base_price_b4_disc'],
							'room_discount_percent' => $this->input->post('room_discount_percent')[$room_key],
							'room_discount_amount' => $row['disc_amt_on_base'],
							'room_taxable_amount' => $row['base_price'],
							'room_cgst' => $row['cgst_amount'],
							'room_sgst' => $row['sgst_amount'],
							'room_igst' => $row['igst_amount'],
							'room_cgst_percent' => number_format($room_cgst_percent,2),
							'room_sgst_percent' => number_format($room_sgst_percent,2),
							'room_igst_percent' => number_format($room_igst_percent,2),
							'room_net_amount' => ($row['base_price'] + $row['igst_amount']),
							'same_line_item' => $room_key.''.$i
						);
						
					}
					
				}
			}
			
			//print_r($day_wise_rates_decode_data);
			//print_r($booking_detail_data); die;
		}

		if (!empty($booking_detail_data)) {
			$rs = $this->mcommon->insert('booking_detail', $booking_detail_data);
			
			if($rs){
				$this->mcommon->update('booking_detail', array('booking_detail_id' => $this->input->post('booking_detail_id')), array('out_date' => $this->input->post('check_in_date'), 'allotment_status' => 'O'));
				
				$actual_checkout_time = $this->input->post('check_in_date').' '.date('H:i:s');
				$this->mcommon->update('check_in_detail', array('booking_detail_id' => $this->input->post('booking_detail_id')), array('out_date' => $this->input->post('check_in_date'), 'actual_checkout_time' => $actual_checkout_time, 'allotment_status' => 'O'));
				
				//data insert in check_in_detail table
				$checkInDetailsData = $this->mcommon->getRow('check_in_detail', array('booking_detail_id' => $this->input->post('booking_detail_id')));
				
				$rcp = (($this->input->post('room_total_cgst') / $this->input->post('room_base_price')) *100);
				$rsp = (($this->input->post('room_total_sgst') / $this->input->post('room_base_price')) *100);
				$rip = (($this->input->post('room_total_igst') / $this->input->post('room_base_price')) *100);
				
				$cdetailsArr['check_in_id'] = $checkInDetailsData['check_in_id'];
				$cdetailsArr['booking_detail_id'] = $rs;
				$cdetailsArr['accommodation_id'] = $this->input->post('book_room_accommodation_id')[0];
				$cdetailsArr['room_no'] = $this->input->post('room_number');
				$cdetailsArr['in_date'] = $this->input->post('check_in_date');
				$cdetailsArr['out_date'] = $this->input->post('check_out_date');
				$cdetailsArr['adults'] = $this->input->post('adult')[0];
				$cdetailsArr['children'] = $this->input->post('child')[0];
				//$cdetailsArr['extra_bed_cnt'] = $b_details['extra_bed_cnt'];
				$cdetailsArr['allotment_status'] = 'I';
				//$cdetailsArr['extra_bed_rate'] = $b_details['extra_bed_rate'];
				$cdetailsArr['room_rate'] = $this->input->post('room_price_before_tax');
				$cdetailsArr['room_charge'] = $this->input->post('room_price_before_tax');
				$cdetailsArr['room_discount_percent'] = $this->input->post('discount_perc');
				$cdetailsArr['room_discount_amount'] = $this->input->post('discount_amount');
				$cdetailsArr['room_taxable_amount'] = $this->input->post('room_base_price');
				$cdetailsArr['room_cgst'] = $this->input->post('room_total_cgst');
				$cdetailsArr['room_sgst'] = $this->input->post('room_total_sgst');
				$cdetailsArr['room_igst'] = $this->input->post('room_total_igst');
				$cdetailsArr['room_cgst_percent'] = $rcp;
				$cdetailsArr['room_sgst_percent'] = $rsp;
				$cdetailsArr['room_igst_percent'] = $rip;
				$cdetailsArr['room_net_amount'] = $this->input->post('net_amount');
				
				$this->mcommon->insert('check_in_detail', $cdetailsArr);
			}
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

			$return_data = array('status' => true, 'msg' => 'Congratulations! Room Change successfully.', 'rederict_link' => base_url('admin/reservation/checkin_details/'.$this->input->post('booking_id')));
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

		//print_r($this->email->print_debugger());die;

	}


	public function submit_payment()
	{
		//print_r($this->input->post());die;
		if($this->input->post()){
			$this->form_validation->set_rules('payment_mode','Payment Mode','trim|required|in_list[Cash,EDC,Standalone EDC]');
			$booking_id = $this->input->post('booking_id');
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				//redirect("admin/pos/receive_against_pos/".$this->input->post('sale_order_id'));
				$link = base_url()."admin/booking/booking_details/".$booking_id;
				$return_data = array('success' => false, 'msg' => validation_errors(), 'redirect_link' => $link);
			}
			else {
				$booking_header_data = $this->db->from('booking_header')->where('booking_id', $booking_id)->get()->row_array();
				
				$booking_payment_details = $this->mbooking->get_booking_payment_details($booking_id);
				$payable_amount = $this->mbooking->get_payable_amt($booking_id);
				$pos_details = $this->mbooking->get_pos_details($booking_id);
				
				foreach($booking_payment_details as $payment_key => $booking_payment_detail){
					if(strtolower($booking_payment_detail['status']) =='success'){
						$total_payment_amount +=$booking_payment_detail['amount'];
					}
				}
				
				if(!empty($pos_details)){
					foreach($pos_details as $pos_key => $pos_detail){
						$_pos_amount = round($pos_detail['net_bill_amount']);
						$pos_net_amt += $_pos_amount;
					}
				}
				$payableAmt = ($payable_amount['payable_amt'] + $pos_net_amt);
				$dueAmt = round($payableAmt - $total_payment_amount);		
				
				if($this->input->post('payment_mode') == 'Cash' || $this->input->post('payment_mode') == 'Standalone EDC'){
					if($this->input->post('amount') <= $dueAmt){
						$data = array(
							'booking_id' => $booking_id,
							'customer_id' => $booking_header_data['customer_id'],
							'payment_date' => $this->input->post('payment_date').' '.date('H:i:s'),
							'payment_mode' => $this->input->post('payment_mode'),
							'amount' => $this->input->post('amount'),
							'money_receipt_no' => $this->input->post('money_receipt_no'),
							'money_receipt_date' => $this->input->post('money_receipt_date'),
							// 'check_draft_no' => $this->input->post('check_draft_no'),
							// 'branch_name' => $this->input->post('branch_name'),
							// 'bank_name' => $this->input->post('bank_name'),
							// 'check_draft_date' => date('Y-m-d',strtotime($this->input->post('check_draft_date'))),
							'status' => 'SUCCESS',
							'remarks' => $this->input->post('remarks'),
							'created_by' => $this->admin_session_data['user_id'],
							'created_ts' => date('Y-m-d H:i:s')
						);
				
						$booking_payment = $this->db->insert('booking_payment', $data);
						
						$this->session->set_flashdata('success_msg', 'Payment Collected Successfully');
						$link = base_url()."admin/booking/booking_details/".$booking_id;
						$return_data = array('success' => true, 'msg' => 'Payment Collected Successfully', 'redirect_link' => $link, 'payment_mode' => $this->input->post('payment_mode'));
					}
					else{
						$this->session->set_flashdata('error_msg', 'Amount is greater than Due Amount');
						$link = base_url()."admin/booking/booking_details/".$booking_id;
						$return_data = array('error' => true, 'msg' => 'Amount is greater than Due Amount', 'redirect_link' => $link, 'payment_mode' => $this->input->post('payment_mode'));
					}
				}
				else {
					
					redirect("index/api_to_send_pos_bridge_notification_on_paytm_device/".base64_encode($this->encryption->encrypt(serialize(array('booking_id' => $booking_id, 'property_id' => $booking_header_data['property_id'], 'amount' => $this->input->post('amount'), 'mode' => $this->input->post('payment_mode'), 'receive_from' => 'property', 'customer_id' => $booking_header_data['customer_id'], 'remarks' => $this->input->post('remarks'))))));
					
				}
			}
			
			echo json_encode($return_data);
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
		//echo "<pre>"; print_r($this->input->post()); die;
		
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
			//print_r($accomms); die;
			
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
		$choose_extra_pax = $request_data['choose_extra_pax'];
		
		//print_r($choose_extra_pax); die;

		$select_final_accommodation_id = array(); 
		$select_final_accommodation_qty = array();
		if(!empty($select_room_qty)){
			foreach($select_room_qty as $select_room_qty_key => $qty){
				if($qty > 0){
					$select_final_accommodation_id[] = $select_accommodation_id[$select_room_qty_key];
					$select_final_accommodation_qty[] = $qty;
				}
			}
		}
		//print_r($select_final_accommodation_id);die;
		//print_r($request_data); die;
		//echo $select_final_accommodation_id[0]; die;
		
		$available_rooms = $this->mreservation->get_available_room($select_final_accommodation_id[0], $startDate, $endDate);
		
		$search_room_data = $this->mbooking->search_room($request_data);
		//print_r($search_room_data);die;

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

		
		//print_r(array_unique($search_room_data_key)); die;
		$search_room_data = array_values(array_intersect_key($search_room_data, array_flip(array_unique($search_room_data_key))));
		foreach ($search_room_data as $search_room_key => $search_room) {
			
			foreach($select_room_qty as $select_room_qty_key => $qty){
				if($qty > 0 && $search_room['accommodation_id'] == $select_accommodation_id[$select_room_qty_key]){
					$search_room_data[$search_room_key]['select_room_qty'] =  $qty;
				}
			}
			
				
			$search_room_data[$search_room_key]['choose_extra_pax'] =  $choose_extra_pax[$search_room_key];

		}
		//echo "<pre>"; print_r($search_room_data); die;
		//echo $search_room_data[0]['choose_extra_pax']; die;
		
		//$available_rooms = $this->mreservation->get_available_room($search_room_data[0]['accommodation_id'], date('Y-m-d'));

		$return_data = array('status' => true, 'search_room_data' => $search_room_data, 'diff_check_in_out_nights' => $diff_check_in_out_nights, 'accommodation_available' => $html, 'available_rooms' => $available_rooms);
		echo json_encode($return_data);
	}


	private function array_search_function($products, $array_search_params)
	{
		$return_key_array = array();

		foreach ($products as $key => $product) {
			$search_params_result = 1;

			foreach ($array_search_params as $array_search_params_key => $array_search_params_value) {

				if (!empty($array_search_params_value)) {

					/*if (in_array($array_search_params_key, array("adult", "child")) && ($product[$array_search_params_key] < $array_search_params_value)) {

						$search_params_result = 0;
					}*/
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

	public function downloadInvoice($_booking_id)
	{
		
		// echo "We are working on it. When it's completed then you can use this functionality. Thanks !";exit();
		$this->load->library('pdf');
		$data = array();
		
		$booking_id = decode_url($_booking_id);

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
		$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id, 'status' => 'Success'));
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);
		//$data['primary_guest_details'] = $this->query->getguestDetails($booking_id);
		$data['primary_guest_details'] = $this->mcommon->getDetails('check_in_guest', array('booking_id' => $booking_id));
		$data['gst_details'] = $this->query->getGstDetails($booking_id);
		$data['check_in_out_details'] = $this->mreservation->checkin_checkout_details(array('check_in_header.booking_id' => $booking_id));
		// $data['customer_details'] = $this->query->getBookingDetailsOfCustomer($this->session->userdata('customer_id'));
		// $data['countries'] = $this->mcommon->getDetails('country_master', array());
		// $data['booking_details'] = $this->mcommon->getRow('booking_listing_view', array('booking_id' => $booking_id));
		// $data['guest_details'] = $this->query->getguestDetails($booking_id);
		// $data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id));
		// $data['content'] = 'frontend/downloadInvoiceNew';
		//print_r($data['check_in_out_details']);die;
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
		//print_r($this->input->post());die;
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
		$propertyIpsData = $this->mcommon->getRow('property_master', array('property_id' => $booking_det['property_id']));
		

		$cancel_request_data = array();
		$result_decoded = array();
		if($this->input->post('booking_source')){
			if (!empty($booking_payment_details)) {

				$working_key = $propertyIpsData['WORKING_KEY'];
				$access_code = $propertyIpsData['ACCESS_CODE'];
				$refund_refe_no = substr(hash('sha256', rand_string(6) . microtime()), 0, 20);
	
				try {
	
					if ($booking_det['booking_status'] == 'A' && $this->input->post('refund_amt') >= 0 && $this->input->post('booking_source') == 'F') {
	
						$merchant_json_data =
						array(
							'reference_no' => $booking_payment_details['transaction_ref_id'],
							'refund_amount' => $this->input->post('refund_amt'),
							'refund_ref_no' => $refund_refe_no
						);
						
						$merchant_data = json_encode($merchant_json_data);
						$encrypted_data = encrypt($merchant_data, $working_key);
						$final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=refundOrder&request_type=JSON&response_type=JSON';
						
						
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $propertyIpsData['API_BASE_URL']);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_VERBOSE, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json') ;
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
						// Get server response ...
						$result = curl_exec($ch);
						$info = curl_getinfo($ch);
						curl_close($ch);
						$status = '';
						$information = explode('&', $result);
						
						$dataSize = sizeof($information);
						for ($i = 0; $i < $dataSize; $i++) {
							$info_value = explode('=', $information[$i]);
							if ($info_value[0] == 'enc_response') {
								$status = decrypt(trim($info_value[1]), $working_key);
								
							}
						}
						
						$result_decoded = json_decode($status,true);

					}
	
					//print_r($information); die;
					if(!empty($result_decoded) && $result_decoded['Refund_Order_Result']['refund_status'] == 0){
	
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
							'is_refunded' => ($result_decoded['Refund_Order_Result']['refund_status'] == 0) ? 1 : 0,
							'cancel_refund_request_id'=>$refund_refe_no,
							'cancel_request_response'=>json_encode($result_decoded)
	
						);
						// print_r($cancel_request_data);die;
	
					} else {
	
						throw new Exception($result_decoded['Refund_Order_Result']['reason']);
					}
	
	
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

			$property_details = $this->db->from('property_master')->where('property_id', $booking_det['property_id'])->get()->row_array();
	
			$config = email_config();
			$email_from = $config['email_from'];
			unset($config['email_from']);

			$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled & initiated by WBSFDC';

			$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
<center style="width: 100%; background-color: #f1f1f1; font-family: Arial, Helvetica, sans-serif;">
	<div style="max-width: 600px; margin: 0 auto;">
		
		<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
			<tr style="background-color: #FFF;">
				<td valign="top" style="padding: 1em; border: 1px solid #00bdd6;">
					<table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
						<tr>
							<td style="text-align: left;padding:10px; width: 68px;">
								<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="..."></img>
							</td>
							<td style="text-align: center;">
								<h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
								<p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
								<h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for cancellation initiated by WBSFDC</h2>
							</td>
							<td style="text-align: right;padding-right:10px; width: 68px;">
								<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="48" alt="..." style="margin-top:16px;"></img>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td>
					<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #FFF;border-left: 1px solid #00bdd6; border-right: 1px solid #00bdd6;">
						<tr>
							<td>
								<div style="text-align: left; padding: 0 15px; font-size: 13px; line-height: 1.5;">
									<p>Dear Sir/Madam,</p>
									
									<p style="margin-bottom:0;">
										Your Booking (ID '.$booking_det['booking_no'].' ) at '.$property_details['property_name'].' from '.$booking_det['check_in'].' to '.$booking_det['check_out'].' is now stand cancelled. The amount of refund, if applicable/eligible, will be initiated by today itself according to the Cancellation & Refund Policy as stated in the www.sfdcltd.com.
									</p>
									<p style="margin-bottom:0;">Thanks and Regards,</p>
									<p style="margin-top:0;">The S.F.D.C.Ltd.</p>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #e9e9e9;">
			<tr>
				<td style="text-align: left; color: #000000; padding: 15px; font-size: 12px; border: 1px solid #00bdd6;">
					<p style="margin-top: 0; margin-bottom: 5px;">
						<b>Address:</b>
						<span>Bikash Bhawan, North Block,1st Floor, Salt Lake, Kolkata-700091</span>
					</p>
					<p style="margin-bottom: 5px; margin-top:0;">
						<b>Head Office:</b>
						<span>(033) 23583123</span>
					</p>
					<p style="margin-bottom: 5px; margin-top:0;">
						<b>Guest House Booking:</b>
						<span>(033) 23376469</span>
					</p>
					<p style="margin-bottom: 0;margin-top:0;">
						<b>Email Us On:</b>
						<span>headoffice@wbsfdcltd.com / tourism@wbsfdcltd.com</span>
					</p>
				</td>
			</tr>
		</table>

		<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #00bdd6;">
			<tr>
				<td style="text-align: center; color: #FFF; padding: 5px 15px; font-size: 12px;">
					<p>
						<span>© '.date('Y').' The State Fisheries Development Corporation Limited<br>  (Government of West Bengal Undertaking).All right reserved.
						</span>
					</p>
				</td>
			</tr>
		</table>

	</div>
</center>
</body>';


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

			payment_cancelled_by_admin($booking_det['mobile'], $booking_det['booking_no']);

			$response = array('success' => true, 'message' => 'Booking has been cancelled successfully');
		}

		echo json_encode($response);
		exit;
	}
	
	
	public function cancel_booking_before_refunr_api()
	{
		//print_r($this->input->post());die;
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
	
						if ($booking_det['booking_status'] == 'A' && $this->input->post('refund_amt') >= 0 && $this->input->post('booking_source') == 'B') {
		
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
								'is_refunded' => '0',
								'cancel_refund_request_id' => $result_decoded['request_id'],
								'cancel_request_response' => $result
		
							);
							// print_r($cancel_request_data);die;
		
						// {"status":1,"msg":"Refund Request Queued","request_id":"134555708","bank_ref_num":null,"mihpayid":403993715527389777,"error_code":102}
		
				} else {
		
					$response = array('status' => false, 'message' => 'Payment info not found');
					echo json_encode($response);
					exit;
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
	
	
			if($result) {
	
				/* Booking Cancellation Email Sending */
				$property_details = $this->db->from('property_master')->where('property_id', $booking_det['property_id'])->get()->row_array();
	
				$config = email_config();
				$email_from = $config['email_from'];
				unset($config['email_from']);
	
				$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled & initiated by WBSFDC';
	
				$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
    <center style="width: 100%; background-color: #f1f1f1; font-family: Arial, Helvetica, sans-serif;">
        <div style="max-width: 600px; margin: 0 auto;">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr style="background-color: #FFF;">
                    <td valign="top" style="padding: 1em; border: 1px solid #00bdd6;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
                            <tr>
                                <td style="text-align: left;padding:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="..."></img>
                                </td>
                                <td style="text-align: center;">
                                    <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                                    <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                                    <h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for cancellation initiated by WBSFDC</h2>
                                </td>
                                <td style="text-align: right;padding-right:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="48" alt="..." style="margin-top:16px;"></img>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end tr -->
                <tr>
                    <td>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #FFF;border-left: 1px solid #00bdd6; border-right: 1px solid #00bdd6;">
                            <tr>
                                <td>
                                    <div style="text-align: left; padding: 0 15px; font-size: 13px; line-height: 1.5;">
                                        <p>Sir/Madam</p>
                                        
                                        <p style="margin-bottom:0;">
                                            Owing to certain unavoidable reasons, we need to cancel your booking with us at '.$property_details['property_name'].' complex vide booking number '.$booking_det['booking_no'].' for dates '.$booking_det['check_in'].' To '.$booking_det['check_out'].' . The full booking amount, along with the G.S.T. paid, if any, would
                                            be refunded to the concerned bank account, within 15 days. We deeply regret the discomfort caused to you. For any query kindly call us at (033) 23376469.
                                        </p>
                                        <p style="margin-bottom:0;">Thanks and Regards,</p>
                                        <p style="margin-top:0;">The S.F.D.C.Ltd.</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #e9e9e9;">
                <tr>
                    <td style="text-align: left; color: #000000; padding: 15px; font-size: 12px; border: 1px solid #00bdd6;">
                        <p style="margin-top: 0; margin-bottom: 5px;">
                            <b>Address:</b>
                            <span>Bikash Bhawan, North Block,1st Floor, Salt Lake, Kolkata-700091</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Head Office:</b>
                            <span>(033) 23583123</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Guest House Booking:</b>
                            <span>(033) 23376469</span>
                        </p>
                        <p style="margin-bottom: 0;margin-top:0;">
                            <b>Email Us On:</b>
                            <span>headoffice@wbsfdcltd.com / tourism@wbsfdcltd.com</span>
                        </p>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #00bdd6;">
                <tr>
                    <td style="text-align: center; color: #FFF; padding: 5px 15px; font-size: 12px;">
                        <p>
                            <span>© '.date('Y').' The State Fisheries Development Corporation Limited<br>  (Government of West Bengal Undertaking).All right reserved.
                            </span>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
    </center>
</body>';
	
	
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
	
				// print_r($this->email->print_debugger());die;
	
				//payment_cancelled_by_admin($booking_det['mobile'], $booking_det['booking_no']);
	
	
				$response = array('success' => true, 'message' => 'Booking has been cancelled successfully');
			}
			
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
		//print_r($this->input->post());die;
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

			//print_r($result_decoded);
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
				// print_r($cancel_request_data);die;

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
			$property_details = $this->db->from('property_master')->where('property_id', $booking_det['property_id'])->get()->row_array();

			$config = email_config();
			$email_from = $config['email_from'];
			unset($config['email_from']);

			$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled & initiated by WBSFDC';
	
				$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
    <center style="width: 100%; background-color: #f1f1f1; font-family: Arial, Helvetica, sans-serif;">
        <div style="max-width: 600px; margin: 0 auto;">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr style="background-color: #FFF;">
                    <td valign="top" style="padding: 1em; border: 1px solid #00bdd6;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
                            <tr>
                                <td style="text-align: left;padding:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="..."></img>
                                </td>
                                <td style="text-align: center;">
                                    <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                                    <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                                    <h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for cancellation initiated by WBSFDC</h2>
                                </td>
                                <td style="text-align: right;padding-right:10px; width: 68px;">
                                    <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="48" alt="..." style="margin-top:16px;"></img>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end tr -->
                <tr>
                    <td>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #FFF;border-left: 1px solid #00bdd6; border-right: 1px solid #00bdd6;">
                            <tr>
                                <td>
                                    <div style="text-align: left; padding: 0 15px; font-size: 13px; line-height: 1.5;">
                                        <p>Dear Sir/Madam,</p>
                                        
                                        <p style="margin-bottom:0;">
                                            Your Booking ('.$booking_det['booking_no'].') at '.$property_details['property_name'].' from '.$booking_det['check_in'].' to '.$booking_det['check_out'].' is now stand cancelled. 
                                        </p>
                                        <p style="margin-bottom:0;">Thanks and Regards,</p>
                                        <p style="margin-top:0;">The S.F.D.C.Ltd.</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #e9e9e9;">
                <tr>
                    <td style="text-align: left; color: #000000; padding: 15px; font-size: 12px; border: 1px solid #00bdd6;">
                        <p style="margin-top: 0; margin-bottom: 5px;">
                            <b>Address:</b>
                            <span>Bikash Bhawan, North Block,1st Floor, Salt Lake, Kolkata-700091</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Head Office:</b>
                            <span>(033) 23583123</span>
                        </p>
                        <p style="margin-bottom: 5px; margin-top:0;">
                            <b>Guest House Booking:</b>
                            <span>(033) 23376469</span>
                        </p>
                        <p style="margin-bottom: 0;margin-top:0;">
                            <b>Email Us On:</b>
                            <span>headoffice@wbsfdcltd.com / tourism@wbsfdcltd.com</span>
                        </p>
                    </td>
                </tr>
            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #00bdd6;">
                <tr>
                    <td style="text-align: center; color: #FFF; padding: 5px 15px; font-size: 12px;">
                        <p>
                            <span>© '.date('Y').' The State Fisheries Development Corporation Limited<br>  (Government of West Bengal Undertaking).All right reserved.
                            </span>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
    </center>
</body>';


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





			// print_r($this->email->print_debugger());die;

			payment_cancelled_by_admin($booking_det['mobile'], $booking_det['booking_no']);


			$response = array('success' => true, 'message' => 'Booking has been cancelled successfully');
			
		}

		echo json_encode($response);
		exit;
	}
	
	public function viewBookingSlip($booking_id)
	{
		$data = array();
		$booking_id = decode_url($booking_id);
		$data['booking_header'] = $this->query->getBookingHeader($booking_id);
		//if($data['booking_header']['booking_status']=='A'){
			if($data['booking_header']['created_user_type']=='C'){
				$data['Initiated_by'] = $this->query->getCustomerData($data['booking_header']['created_by']);

			}else if($data['booking_header']['created_user_type']=='U'){
				$data['Initiated_by'] = $this->query->getUserData($data['booking_header']['created_by']);
			}

		//}
		$data['customer_details'] = $this->query->getBookingDetailsOfCustomer($booking_id);
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		$data['booking_details'] = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $booking_id));
		//$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id, 'status' => 'Success'));
		//$data['booking_payment_listing'] = $this->mbooking->getDataFromBookingPaymentListingView($booking_id);
		$data['booking_payment_listings'] = $this->mbooking->get_booking_payment_details($booking_id);
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);
		$data['primary_guest_details'] = $this->query->getguestDetails($booking_id);

		$check_in_date=date_create($data['booking_header']['check_in']);
		$current_date=date_create(date('Y-m-d'));
		//print_r($current_date);die;
		$diff_check_in_out=date_diff($current_date,$check_in_date);
		$diff_check_in_out_date = $diff_check_in_out->format("%R%a");
		//echo $diff_check_in_out_date;die;
		$data['cancellation_details'] = $this->query->getCancellationDetails($diff_check_in_out_date);
		$data['cancellation_request_details'] = $this->query->getCancellationRequestDetails($booking_id, 'G');
		//print_r($data['booking_details']);die;  
		// $data['content'] = 'frontend/viewInvoiceNew';
		$this->load->view('frontend/viewInvoiceNew', $data);
	}
	
	public function viewPaymentDetails($booking_id)
	{
		$this->load->library('pdf');
		
		$data = array();
		$booking_id = decode_url($booking_id);
		
		$data['booking_details'] = $this->mbooking->get_booking_details($booking_id);
		$data['booking_payment_details'] = $this->mbooking->get_booking_payment_details($booking_id);
		$data['cancellation_details'] = array();
		$data['cancellation_request_details'] = array();
		$data['booking_source'] = '';
		$data['payable_amount'] = $this->mbooking->get_payable_amt($booking_id);
		
		$data['pos_details'] = $this->mbooking->get_pos_details($booking_id);
		
		$data['booking_documents'] = $this->mcommon->getDetails('booking_documents', array('booking_id' => $booking_id));
		
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
		
		$filename = 'payment-details-' . time(); 
		$html = $this->load->view('admin/booking/download_payment_details', $data, true);
		// $this->pdf->create($html, $filename);
		// echo $html;die;

		$this->pdf->loadHtml($html);
		$this->pdf->set_paper("a4", "landscape");
		$this->pdf->render();

		$this->pdf->stream("" . $filename . ".pdf", array("Attachment" => 0));
	}
	
	public function multiple_file_upload(){
		
		//Supporting Documents Upload
		if (!empty($_FILES['supporting_doc']['name'])) {
			
			$filesCount = count($_FILES['supporting_doc']['name']);
			
			//echo $filesCount; die;
			
			for($f = 0; $f < $filesCount; $f++){ 
				
				$_FILES['file']['name']     = $_FILES['supporting_doc']['name'][$f]; 
				$_FILES['file']['type']     = $_FILES['supporting_doc']['type'][$f]; 
				$_FILES['file']['tmp_name'] = $_FILES['supporting_doc']['tmp_name'][$f]; 
				$_FILES['file']['error']    = $_FILES['supporting_doc']['error'][$f]; 
				$_FILES['file']['size']     = $_FILES['supporting_doc']['size'][$f];
				
				$config['upload_path']          = './public/admin_images/booking_supporting_doc';
				$config['allowed_types']        = '*';
				$config['max_size']             = 5000;
				$config['encrypt_name'] 		= TRUE;
				
				// Load and initialize upload library 
				$this->load->library('upload', $config); 
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){ 
					// Uploaded file data 
					$fileData = $this->upload->data(); 
					
					$uploadData['booking_id'] = $this->input->post('booking_id'); 
					$uploadData['doc_file'] = $fileData['file_name']; 
					$uploadData['created_ts'] = date("Y-m-d H:i:s");
					$uploadData['created_by'] = $this->admin_session_data['user_id'];
					
					$this->mcommon->insert('booking_documents', $uploadData);
				}
				
			}
			$this->session->set_flashdata('success_msg', 'File Uploaded Successfully');
			redirect("admin/booking/booking_details/".$this->input->post('booking_id'));
		}
		//
		
	}
	
	function getDatesFromRange($start, $end){
		$dates = array($start);
		while(end($dates) < $end){
			$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
		}
		return $dates;
	}
	
	function uploadImages($fieldName, $folder_name)
	{

		$config['upload_path']          = './public/admin_images/' . $folder_name;
		$config['allowed_types']        = '*';
		$config['max_size']             = 5000;
		$config['encrypt_name'] = TRUE;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);

		$img_ret = array();

		if ($this->upload->do_upload($fieldName)) {
			$upload_data = $this->upload->data();
			$image_path = $upload_data['file_name'];

			$img_ret = array('status' => true, 'img_path' => $image_path);
		} else {
			$img_ret = array('status' => false, 'error' => $this->upload->display_errors());
		}

		return $img_ret;
	}
	
	
}
