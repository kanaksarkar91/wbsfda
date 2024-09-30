<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation extends MY_Controller
{
	private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mreservation', 'admin/mproperty', 'mcommon'));
		$this->load->helper(array('gst'));
		$this->menu_id = 24;

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
		$data = array('menu_id'=> $this->menu_id);
		$where = array();
		$data['start_date']= $this->input->post('start_date'); 
		$data['end_date']= $this->input->post('end_date');
		$data['property_id']= $this->input->post('property_id');
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['bh.check_in >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_in <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
			if($this->input->post('property_id') != 0){
				$where['bh.property_id = '] = $this->input->post('property_id');
			}
		}
		$where['bh.booking_status != '] = 'F';
		//$order_by = 'bh.booking_id DESC';
		$order_by = 'DATE(bh.created_ts) DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['reservations'] = array();
		$property_ids = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$data['reservations'] = $this->mreservation->get($where, $order_by, $property_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function check_in_list()
	{
		$data = array('menu_id'=> 79);
		$where = array();
		$data['start_date']= date('Y-m-d'); 
		//$data['end_date']= $this->input->post('end_date');
		$data['property_id']= $this->input->post('property_id');
		
		if($this->input->post()){
			/*if($this->input->post('start_date')){
				$where['bh.check_in ='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_out <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}*/
			if($this->input->post('property_id') != 0){
				$where['bh.property_id = '] = $this->input->post('property_id');
			}
		}
		$where['bh.check_in ='] = date('Y-m-d');
		$where['bh.booking_status = '] = 'A';
		$order_by = 'bh.booking_id DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['reservations'] = array();
		$property_ids = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$data['reservations'] = $this->mreservation->get($where, $order_by, $property_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/check_in_list';
		$this->load->view('admin/layouts/index', $data); 
	}
	
	public function ta_invoice_list()
	{
		$data = array('menu_id'=> 80);
		$where = array();
		$data['start_date']= date('Y-m-d'); 
		//$data['end_date']= $this->input->post('end_date');
		$data['property_id']= $this->input->post('property_id');
		
		if($this->input->post()){
			/*if($this->input->post('start_date')){
				$where['bh.check_in ='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_out <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}*/
			if($this->input->post('property_id') != 0){
				$where['bh.property_id = '] = $this->input->post('property_id');
			}
		}
		$where['bh.booking_status = '] = 'O';
		$order_by = 'bh.booking_id DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['reservations'] = array();
		$property_ids = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$data['reservations'] = $this->mreservation->get($where, $order_by, $property_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/tax_invoice_list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function foreigner_list()
	{
		$data = array('menu_id'=> 75);
		$where = array();
		$data['start_date']= $this->input->post('start_date'); 
		$data['end_date']= $this->input->post('end_date');
		$data['property_id']= $this->input->post('property_id');
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['bh.check_in >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_out <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
			if($this->input->post('property_id') != 0){
				$where['bh.property_id = '] = $this->input->post('property_id');
			}
		}
		
		$order_by = 'bh.booking_id DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['foreigners'] = array();
		$property_ids = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$data['foreigners'] = $this->mreservation->get_foreigner($where, $order_by, $property_ids, $group_by);
			}
		}
		//echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/foreigner_list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function register()
	{
		$data = array('menu_id'=> $this->menu_id);
		$reservations = array();
		$data['content'] = 'admin/reservation/register'; 
		$request_data = array();


		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$request_data['property_id'] = implode(",",array_column($data['properties'], 'property_id'));

		if(!empty($this->input->post())){
			$request_data['booking_status'] = $this->input->post('booking_status');
			$request_data['property_id'] = $this->input->post('property_id');
		}

		$reservation_details = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			$reservation_details = $this->mreservation->get_reservation_booking_details($request_data);
		} 
		//print_r($reservation_details);die;
		if(!empty($reservation_details)){
			foreach ($reservation_details as $key => $reservation) { 
				
				$description = '';
				$reservations[$key]['title'] = $reservation["property_name"];
				$reservations[$key]['start'] = date('Y-m-d',strtotime($reservation["check_in"]));
				$reservations[$key]['end'] = date('Y-m-d',strtotime($reservation["check_out"]));
				
				

				$reservations[$key]['backgroundColor'] = ($reservation['booking_status'] == 'I') ? 'blue' : (($reservation['booking_status'] == 'C')?'red':(($reservation['booking_status'] == 'A')?'green':'orange')); 
				$reservations[$key]['borderColor'] = ($reservation['booking_status'] == 'I') ? 'blue' : (($reservation['booking_status'] == 'C')?'red':(($reservation['booking_status'] == 'A')?'green':'orange')); 
				
				$reservations[$key]['textColor'] = "white";
				//$reservations[$key]['display'] = "background";
				$reservations[$key]['eventColor'] = ($reservation['booking_status'] == 'I') ? 'blue' : (($reservation['booking_status'] == 'C')?'red':(($reservation['booking_status'] == 'A')?'green':'orange')); 
				

				$description .= 'Booking No. : '.$reservation['booking_no'];
				$description .= '<br> Booking For : '.$reservation["booking_for"];
				$description .= '<br> Customer : '.$reservation["customer_title"].' '.$reservation["first_name"].' '.$reservation["last_name"].'';
				$description .= '<br> Email : '.$reservation["email"];
				$description .= '<br> Contact No : '.$reservation["mobile"];
				$description .= '<br> Total Rooms : '.$reservation["room_count"];
				$description .= '<br> Total Amount : '.$reservation["net_payable_amount"]; 
				$description .= '<br> Status : '.(($reservation['booking_status'] == 'I') ? 'Initiated' : (($reservation['booking_status'] == 'C')?'Cancelled':(($reservation['booking_status'] == 'A')?'Approved':'Checked Out')));

				$reservations[$key]['description'] = $description;  
				$reservations[$key]['booking_status'] = $reservation['booking_status']; 

			
				
			
			}
		}
        $data['reservations'] = $reservations;
		$data['request_data'] = $request_data;

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

	
	public function submitreservation()
	{
		//echo '<pre>';print_r($this->input->post());die;
		
		if($this->input->post('status') == 4){
			
			$condition = array('booking_id'=>$this->input->post('booking_id'));
			$data= array(
				'status' => $this->input->post('status'),
				'cancellation_reason'=>$this->input->post('cancellation_reason'),
				'cancelled_by' => $this->admin_session_data['user_id'],
				'cancelled_ts' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
				
			);
			$result = $this->mreservation->update_reservation($data,$condition);
		} else {

			$data = array(
				'discount' => $this->input->post('discount'),
				'amount_after_discount' => $this->input->post('amount_after_discount'),
				'gst_percentage' => $this->input->post('gst_percentage'),
				'gst_amount' => $this->input->post('gst_amount'),
				'net_amount' => $this->input->post('net_amount'),
				'remarks' => $this->input->post('remarks'),
				'status' => $this->input->post('status'),
				'updated_at' => date('Y-m-d H:i:s')
			);

			

			if($this->input->post('discount') > 0){

				$data['discount_given_by'] = $this->admin_session_data['user_id'];
				$data['discount_given_ts'] = date('Y-m-d H:i:s');
				
			}
			if($this->input->post('status') == 1){ 

				$data['approval_valid_till'] = date('Y-m-d H:i:59',strtotime($this->input->post('approval_valid_till')));
				$data['payment_method'] = $this->input->post('payment_method');
				$data['approved_by'] = $this->admin_session_data['user_id'];
				$data['approved_ts'] = date('Y-m-d H:i:s');


			} elseif($this->input->post('status') == 2){
				
				$data['rejection_reason'] = $this->input->post('rejection_reason');
				$data['rejected_by'] = $this->admin_session_data['user_id'];
				$data['rejected_ts'] = date('Y-m-d H:i:s');

			}

			if($this->input->post('net_amount') == 0){
				$data['status'] = '3';
				$data['payment_method'] = 'Offline';

			}

			if($this->input->post('organization_type') == 5){
				
				$data['payment_method'] = 'Offline';

			}

			

			$condition = array('booking_id'=>$this->input->post('booking_id'));

			$result = $this->mreservation->update_reservation($data,$condition);

		}
			
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Booking Updated Successfully');
				redirect("admin/reservation");
			}
	}


	public function submitpayment()
	{
		//echo '<pre>';print_r($this->input->post());die;
		
		
			$data = array(
				'booking_id' => $this->input->post('booking_id'),
				'check_draft_no' => $this->input->post('check_draft_no'),
				'branch_name' => $this->input->post('branch_name'),
				'bank_name' => $this->input->post('bank_name'),
				'check_draft_date' => date('Y-m-d',strtotime($this->input->post('check_draft_date'))),
				'amount' => $this->input->post('net_amount'),
				'remarks' => $this->input->post('remarks'),
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);

			$this->db->insert('sports_facilities_booking_payments',$data);

			$result = $this->db->update('sports_facilities_booking', array('status'=>'3'), array('booking_id' => $this->input->post('booking_id')));
			
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Payment Collected Successfully');
				redirect("admin/reservation");
			}
	}

	public function check_not_responded_booking()
	{
		
		$not_responded_booking = $this->mreservation->check_not_responded_booking();
		if(!empty($not_responded_booking)){
			
			foreach($not_responded_booking as $not_responded){
				$updateArray[] = array(
					'status'=>'5',
					'not_responded_ts' => date('Y-m-d H:i:s'),
					'booking_id' => $not_responded['booking_id']
				);
			}

			$this->db->update_batch('sports_facilities_booking',$updateArray, 'booking_id'); 
		}

		echo 'Executed Successfully';die;
		
	}

	public function checkin($booking_id)
	{
		$data = array();
		$data['booking_details'] = $this->mreservation->get_booking_details($booking_id);
		//echo '<pre>'; print_r($data['booking_details']['b_details']); die;
		
		if(!empty($data['booking_details']['b_details'])){
			
			foreach($data['booking_details']['b_details'] as $key => $row){
				$available_rooms = $this->mreservation->get_available_room($row['accommodation_id'], $data['booking_details']['check_in'], $data['booking_details']['check_out']);
				$same_line_item = $this->mreservation->get_first_child_same_line_item($row['booking_id'],$row['accommodation_id'], $row['same_line_item']);
				
				$data['booking_details_with_room'][] = array(
					'available_rooms' => $available_rooms,
					'booking_detail_id' => $row['booking_detail_id'],
					'accommodation_name' => $row['accommodation_name'],
					'adults' => $row['adults'],
					'children' => $row['children'],
					'allotment_status' => $row['allotment_status'],
					'in_date' => $row['in_date'],
					'out_date' => $row['out_date'],
					'room_rate' => $row['room_rate'],
					'room_net_amount' => $row['room_net_amount'],
					'accommodation_id' => $row['accommodation_id'],
					'same_line_item' => $row['same_line_item'],
					'first_chield_of_same_line_item' => $same_line_item['booking_detail_id']
					
				);
				
			}
			
		}
		else {
			$data['booking_details_with_room'] = array();
		}
		
		//echo '<pre>'; print_r($data['booking_details_with_room']); die;
		
		$data['content'] = 'admin/reservation/checkin';
		$this->load->view('admin/layouts/index', $data);
	}

	public function checkin_details($booking_id)
	{
		$data = array();
		$data['booking_details'] = $this->mreservation->get_booking_details_cdetails($booking_id);
		//echo '<pre>'; print_r($data['booking_details']); die;
		$data['content'] = 'admin/reservation/checkin_details';
		$this->load->view('admin/layouts/index', $data);
	}

	public function checkin_submit()
	{
		
		//echo "<pre>"; print_r($this->input->post()); die;

		$booking_id = $this->input->post('booking_id');
		$is_hall = $this->input->post('is_hall');

		$check_checkin = $this->mreservation->check_checkin($booking_id);

		if($check_checkin == TRUE){

			$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
			redirect("admin/reservation/checkin_guest/".$booking_id);

			/*if($is_hall == 1){
				$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
				redirect("admin/reservation");
			} else {
				$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
				redirect("admin/reservation/checkin_guest/".$booking_id);
			}*/

		} else {

			$booking_details = $this->mreservation->get_booking_headers($booking_id);

			$data_header = array();

			$data_header['booking_id'] = $booking_details['booking_id'];
			$data_header['property_id'] = $booking_details['property_id'];
			$data_header['room_count'] = $booking_details['room_count'];
			$data_header['customer_id'] = $booking_details['customer_id'];
			$data_header['check_in'] = $booking_details['check_in'];
			$data_header['check_out'] = $booking_details['check_out'];
			$data_header['room_base_price'] = $booking_details['room_base_price'];
			$data_header['room_total_discount'] = $booking_details['room_total_discount'];
			$data_header['room_price_before_tax'] = $booking_details['room_price_before_tax'];
			$data_header['room_total_cgst'] = $booking_details['room_total_cgst'];
			$data_header['room_total_sgst'] = $booking_details['room_total_sgst'];
			$data_header['room_total_igst'] = $booking_details['room_total_igst'];
			$data_header['room_payable_amount'] = $booking_details['room_payable_amount'];
			$data_header['net_payable_amount'] = $booking_details['net_payable_amount'];
			$data_header['created_by'] = $this->session->admin['user_id'];
			$data_header['created_ts'] = date('Y-m-d H:i:s');
			$data_header['updated_by'] = $this->session->admin['user_id'];

			//Need to insert data in checkin_header
			$checkin_id = $this->mreservation->insert_checkin_headers($data_header);

			if($checkin_id){

				$booking_details_id = $this->input->post('selected_checkin');
				$room_number = $this->input->post('room_number');

				$data_details = array();

				$i = 0;
				foreach($booking_details_id as $bd_id){

					$cdetailsArr = array();

					$b_details = $this->mreservation->get_bookingdetails($bd_id);

					$cdetailsArr['check_in_id'] = $checkin_id;
					$cdetailsArr['booking_detail_id'] = $bd_id;
					$cdetailsArr['accommodation_id'] = $b_details['accommodation_id'];
					$cdetailsArr['room_no'] = $room_number[$i];
					$cdetailsArr['in_date'] = $b_details['in_date'];
					$cdetailsArr['out_date'] = $b_details['out_date'];
					//$data_details['actual_checkout_time'] = '';
					//$data_details['chargeable_days'] = '';
					$cdetailsArr['adults'] = $b_details['adults'];
					$cdetailsArr['children'] = $b_details['children'];
					$cdetailsArr['infants'] = $b_details['infants'];
					$cdetailsArr['extra_bed_cnt'] = $b_details['extra_bed_cnt'];
					$cdetailsArr['allotment_status'] = 'I';
					//$data_details['cancelled_by'] = $b_details['booking_id'];
					//$data_details['cancelled_date'] = $b_details['booking_id'];
					$cdetailsArr['extra_bed_rate'] = $b_details['extra_bed_rate'];
					$cdetailsArr['room_rate'] = $b_details['room_rate'];
					$cdetailsArr['room_charge'] = $b_details['room_charge'];
					$cdetailsArr['room_discount_percent'] = $b_details['room_discount_percent'];
					$cdetailsArr['room_discount_amount'] = $b_details['room_discount_amount'];
					$cdetailsArr['room_taxable_amount'] = $b_details['room_taxable_amount'];
					$cdetailsArr['room_cgst'] = $b_details['room_cgst'];
					$cdetailsArr['room_sgst'] = $b_details['room_sgst'];
					$cdetailsArr['room_igst'] = $b_details['room_igst'];
					$cdetailsArr['room_cgst_percent'] = $b_details['room_cgst_percent'];
					$cdetailsArr['room_sgst_percent'] = $b_details['room_sgst_percent'];
					$cdetailsArr['room_igst_percent'] = $b_details['room_igst_percent'];
					$cdetailsArr['room_net_amount'] = $b_details['room_net_amount'];
					
					$data_details[] = $cdetailsArr;

					$i++;

				}

				//Need to insert data in checkin_details
				$this->mreservation->insert_checkin_details($data_details, $is_hall, $booking_id);

				if($is_hall == 1){
					$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
					redirect("admin/reservation");
				} else {
					$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
					redirect("admin/reservation/checkin_guest/".$booking_id);
				}			
				

			} else {
				$this->session->set_flashdata('error_msg', 'Something is wrong. Try again.');
				redirect("admin/reservation/checkin/".$booking_id);
			}

		}

		
	}


	public function checkin_guest($booking_id)
	{
		$data = array();
		
		$data['nationalities'] = $this->mcommon->getDetailsOrder('nationality', array('status_flag' => 1), 'nationality', 'ASC');
		$data['booking_details'] = $this->mreservation->guest_booking_details($booking_id);	
		$data['guests'] = $this->mreservation->get_booking_guests($booking_id);	
		$data['booking_id'] = $booking_id;	
		$data['content'] = 'admin/reservation/checkin_guest';
		$this->load->view('admin/layouts/index', $data);
	}


	public function checkin_guest_submit()
	{

		//echo "<pre>"; print_r($this->input->post()); die;

		$booking_id = $this->input->post('booking_id');
		$checkin_details_id = $this->input->post('checkin_details_id');

		$data_details = array();

		$i = 0;
		foreach($checkin_details_id as $checkin_id){

			$cdetailsArr = array();

			if(!empty($this->input->post('guest_dob')[$i])){
				$from = new DateTime($this->input->post('guest_dob')[$i]);
				$to   = new DateTime('today');
				$age = $from->diff($to)->y;
			} else {
				$age = '';
			}

			$cdetailsArr['booking_id'] = $booking_id;
			$cdetailsArr['check_in_detail_id'] = $checkin_id;
			$cdetailsArr['name'] = $this->input->post('guest_name')[$i];
			$cdetailsArr['dob'] = $this->input->post('guest_dob')[$i];
			$cdetailsArr['nationality'] = $this->input->post('nationality')[$i];
			$cdetailsArr['age'] = $age;
			$cdetailsArr['gender'] = $this->input->post('guest_gender')[$i];
			$cdetailsArr['address'] = $this->input->post('guest_address')[$i];
			$cdetailsArr['relation'] = $this->input->post('guest_relation')[$i];
			$cdetailsArr['aniversary_date'] = $this->input->post('guest_aniversary')[$i];
			$cdetailsArr['phone'] = $this->input->post('guest_contact')[$i];
			$cdetailsArr['coming_from'] = $this->input->post('guest_from')[$i];
			$cdetailsArr['going_to'] = $this->input->post('guest_to')[$i];
			$cdetailsArr['purpose'] = $this->input->post('guest_purpose')[$i];
			$cdetailsArr['document_type'] = $this->input->post('guest_id')[$i];
			$cdetailsArr['document_no'] = $this->input->post('guest_id_number')[$i];
			$cdetailsArr['guest_type'] = $this->input->post('select_primary_hidden')[$i];
			$cdetailsArr['check_in_date'] = $this->input->post('checkin_date')[$i];
			$cdetailsArr['check_out_date'] = $this->input->post('checkout_date')[$i];
			$cdetailsArr['created_by'] = $this->session->admin['user_id'];
			$cdetailsArr['created_ts'] = date('Y-m-d H:i:s');
			$cdetailsArr['updated_ts'] = $this->session->admin['user_id'];

			
			if($_FILES["guest_id_file"]['name'][$i]){
			
				$config[ 'upload_path' ] = './public/guest_id';
				$config[ 'allowed_types' ] = '*';
				$config['file_name'] = "id_".$_FILES["guest_id_file"]['name'][$i];
				$this->load->library( 'upload', $config );
				$this->upload->initialize( $config );
				
				$files = $_FILES;
				$_FILES['guest_id_file[]']['name']= $files['guest_id_file']['name'][$i];	
				$_FILES['guest_id_file[]']['type']= $files['guest_id_file']['type'][$i];	
				$_FILES['guest_id_file[]']['tmp_name']= $files['guest_id_file']['tmp_name'][$i];	
				$_FILES['guest_id_file[]']['error']= $files['guest_id_file']['error'][$i];	
				$_FILES['guest_id_file[]']['size']= $files['guest_id_file']['size'][$i];
				
				if ( $this->upload->do_upload( 'guest_id_file[]' ) ) {
					
					$cimgp = $this->upload->data()[ 'file_name' ];
					$cdetailsArr['doc_file'] = $cimgp;
							
				}

			} else {
				$cdetailsArr['doc_file'] = '';
			}
			
			$data_details[] = $cdetailsArr;

			$i++;

		}

		//echo "<pre>"; print_r(array_unique($data_details)); die;
		//echo $i;
		//echo "<pre>"; print_r($data_details); die;
		
		$this->mreservation->insert_guest_details($data_details, $booking_id);
		
		$updateAdultBookingDetail = $this->mcommon->update('booking_detail', array('booking_id' => $booking_id), array('adults' => $i));
		
		$getCheckInHeaderData = $this->mcommon->getRow('check_in_header' ,array('booking_id' => $booking_id));
		$updateAdultCheckInDetail = $this->mcommon->update('check_in_detail', array('check_in_id' => $getCheckInHeaderData['check_in_id']), array('adults' => $i));

		$this->session->set_flashdata('success_msg', 'Successfully Checked In.');
		redirect("admin/reservation");

	}
	
	public function checkin_guest_update()
	{

		//echo "<pre>"; print_r($this->input->post()); die;

		$check_in_guest_id = $this->input->post('check_in_guest_id');

		$data_details = array();

		$i = 0;
		foreach($check_in_guest_id as $checkin_id){

			$cdetailsArr = array();

			if(!empty($this->input->post('guest_dob')[$i])){
				$from = new DateTime($this->input->post('guest_dob')[$i]);
				$to   = new DateTime('today');
				$age = $from->diff($to)->y;
			} else {
				$age = '';
			}

			$cdetailsArr['name'] = $this->input->post('guest_name')[$i];
			$cdetailsArr['dob'] = $this->input->post('guest_dob')[$i];
			$cdetailsArr['nationality'] = $this->input->post('nationality')[$i];
			$cdetailsArr['age'] = $age;
			$cdetailsArr['gender'] = $this->input->post('guest_gender')[$i];
			$cdetailsArr['address'] = $this->input->post('guest_address')[$i];
			$cdetailsArr['relation'] = $this->input->post('guest_relation')[$i];
			$cdetailsArr['aniversary_date'] = $this->input->post('guest_aniversary')[$i];
			$cdetailsArr['phone'] = $this->input->post('guest_contact')[$i];
			$cdetailsArr['coming_from'] = $this->input->post('guest_from')[$i];
			$cdetailsArr['going_to'] = $this->input->post('guest_to')[$i];
			$cdetailsArr['purpose'] = $this->input->post('guest_purpose')[$i];
			$cdetailsArr['document_type'] = $this->input->post('guest_id')[$i];
			$cdetailsArr['document_no'] = $this->input->post('guest_id_number')[$i];
			$cdetailsArr['guest_type'] = $this->input->post('select_primary_hidden')[$i];
			$cdetailsArr['updated_ts'] = date('Y-m-d H:i:s');

			
			if($_FILES["guest_id_file"]['name'][$i]){
			
				$config[ 'upload_path' ] = './public/guest_id';
				$config[ 'allowed_types' ] = '*';
				$config['file_name'] = "id_".$_FILES["guest_id_file"]['name'][$i];
				$this->load->library( 'upload', $config );
				$this->upload->initialize( $config );
				
				$files = $_FILES;
				$_FILES['guest_id_file[]']['name']= $files['guest_id_file']['name'][$i];	
				$_FILES['guest_id_file[]']['type']= $files['guest_id_file']['type'][$i];	
				$_FILES['guest_id_file[]']['tmp_name']= $files['guest_id_file']['tmp_name'][$i];	
				$_FILES['guest_id_file[]']['error']= $files['guest_id_file']['error'][$i];	
				$_FILES['guest_id_file[]']['size']= $files['guest_id_file']['size'][$i];
				
				if ( $this->upload->do_upload( 'guest_id_file[]' ) ) {
					
					$cimgp = $this->upload->data()[ 'file_name' ];
					$cdetailsArr['doc_file'] = $cimgp;
							
				}

			} else {
				$cdetailsArr['doc_file'] = '';
			}
			
			//$data_details[] = $cdetailsArr;
			
			$this->mcommon->update('check_in_guest', array('check_in_guest_id' => $checkin_id), $cdetailsArr);

			$i++;

		}

		//echo "<pre>"; print_r(array_unique($data_details)); die;
		//echo "<pre>"; print_r($data_details); die;
		
		//$this->mreservation->insert_guest_details($data_details, $booking_id);

		$this->session->set_flashdata('success_msg', 'Guests are successfully Submitted.');
		redirect("admin/reservation/checkin_details/".$this->input->post('booking_id'));

	}

	public function checkout_submit()
	{
		$data = array();
		$bookingHeaderData = array();
		$invoiceData = array();
		$property_wise_serial_no = '';

		$data['booking_id'] = $this->input->post('getBookingid');
		$data['booking_details_id'] = $this->input->post('getDetailsid');
		$data['actual_checkout_time'] = date('Y-m-d H:i:s');
		
		
		$financialStartYear = getFinancialStartYear(date('Y-m-d'));
		
		$bookingHeaderData = $this->mcommon->getRow('booking_header', array('booking_id' => $data['booking_id']));
		$invoiceData = $this->mreservation->getMaxInvoiceNo($bookingHeaderData['property_id'], $financialStartYear);
		$propertyData = $this->mcommon->getRow('property_master', array('property_id' => $bookingHeaderData['property_id']));
		
		if((empty($invoiceData)) || $invoiceData['highest_invoice_number'] == ''){
			$str = 1;
			$property_wise_serial_no = str_pad($str,5,"0",STR_PAD_LEFT);
		}
		else{
			$explode_serial_no = explode('/', $invoiceData['highest_invoice_number']);
			$str = ($explode_serial_no[2] + 1);
			$property_wise_serial_no = str_pad($str,5,"0",STR_PAD_LEFT);
		}
		
		$room_invoice_no_start_from = ($propertyData['room_invoice_no_start_from'] != '') ? $propertyData['room_invoice_no_start_from'] : 'SFDC'.$bookingHeaderData['property_id'];
		
		$data['invoice_no'] = $room_invoice_no_start_from.'/'.$financialStartYear.'/'.$property_wise_serial_no;
		
		//echo $this->db->last_query($sql);
		//print_r($explode_serial_no);
		//echo $data['invoice_no'];
		
		//die;

		$result = $this->mreservation->checkout_submit($data);

		if($result){
			$return_data = array("status"=> true);
			echo json_encode($return_data);

		} else {
			echo 0;
		}

	}


	public function checkin_guest_details($booking_id)
	{
		$data = array();
		
		$data['nationalities'] = $this->mcommon->getDetailsOrder('nationality', array('status_flag' => 1), 'nationality', 'ASC');
		$data['booking_details'] = $this->mreservation->checkin_guest_details($booking_id);		
		$data['content'] = 'admin/reservation/checkin_guest_details';
		$this->load->view('admin/layouts/index', $data);
	}

	public function failed_reservation()
	{
		$data = array('menu_id'=> $this->menu_id);
		$where = array();
		$data['start_date']= $this->input->post('start_date'); 
		$data['end_date']= $this->input->post('end_date');
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['bh.check_in >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_out <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
		}
		$order_by = 'bh.booking_id DESC';
		$group_by = NULL;//'bh.booking_id';
		$data['reservations'] = array();
		$property_ids = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$data['reservations'] = $this->mreservation->get_failed_txn($where, $order_by, $property_ids, $group_by);
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['reservations']);die;
		$data['content'] = 'admin/reservation/list_failed';
		$this->load->view('admin/layouts/index', $data); 
	}
	
	public function edit_booking($booking_id)
	{
		$data = array();
		
		$data['booking_details'] = $this->mreservation->get_booking_details_cdetails($booking_id);
		$data['guests'] = $this->mreservation->get_booking_guests($booking_id);	
		$data['booking_id'] = $booking_id;	
		$data['content'] = 'admin/reservation/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	public function calculate_net_amount_based_on_room_rate()
	{
		$return_data = array();
		$gstData = array();
		$cgstAmt = '';
		$sgstAmt = '';
		$roomGst = '';
		$roomRateAfterGst = '';

		$room_rate = $this->input->post('room_rate');
		
		$gstData = getGstPercentage($room_rate);//function define in gst_helper
		//echo '<pre>'; print_r($gstData); die;
		
		if(!empty(gstData)){
			$cgstAmt = (($room_rate * $gstData['cgst_percentage']) / 100);
			$sgstAmt = (($room_rate * $gstData['sgst_percentage']) / 100);
	
			$roomGst = (($room_rate * $gstData['gst_percentage']) / 100);
			$roomRateAfterGst = ($room_rate + $roomGst);
		}

		if($roomRateAfterGst != ''){
		
			$return_data = array("status"=> true, 'cgstPer' => $gstData['cgst_percentage'], 'sgstPer' => $gstData['sgst_percentage'], 'net_amount' => $roomRateAfterGst, 'cgstAmt' => $cgstAmt, 'sgstAmt' => $sgstAmt);
			
		} else {
			$return_data = array("status"=> false);
		}
		
		echo json_encode($return_data);

	}
	
	
	public function submit_edited_room_rate()
	{
		$return_data = array();
		$gstData = array();
		$cgstAmt = '';
		$sgstAmt = '';
		$roomGst = '';
		$roomRateAfterGst = '';

		$room_rate = $this->input->post('room_rate');
		$booking_detail_id = $this->input->post('bookingDetailId');
		
		$gstData = getGstPercentage($room_rate);//function define in gst_helper
		//echo '<pre>'; print_r($gstData); die;
		
		$cgstAmt = (($room_rate * $gstData['cgst_percentage']) / 100);
		$sgstAmt = (($room_rate * $gstData['sgst_percentage']) / 100);
		$igstAmt = ($cgstAmt + $sgstAmt);

		$roomGst = (($room_rate * $gstData['gst_percentage']) / 100);
		$roomRateAfterGst = ($room_rate + $roomGst);
		
		//echo $roomRateAfterGst; die;
		
		//if($roomRateAfterGst != ''){
			
			$booking_detail_data = array(
				'extra_bed_rate' => '0.00',
				'room_rate' => $room_rate,
				'room_charge' => $room_rate,
				//'room_discount_percent' => $this->input->post('room_discount_percent')[$room_key],
				//'room_discount_amount' => $row['disc_amt_on_base'],
				'room_taxable_amount' => $room_rate,
				'room_cgst' => $cgstAmt,
				'room_sgst' => $sgstAmt,
				'room_igst' => $igstAmt,
				'room_cgst_percent' => $gstData['cgst_percentage'],
				'room_sgst_percent' => $gstData['sgst_percentage'],
				'room_igst_percent' => $gstData['igst_percentage'],
				'room_net_amount' => $roomRateAfterGst
			);
			
			$bd_update = $this->mcommon->update('booking_detail', array('booking_detail_id' => $booking_detail_id), $booking_detail_data);
			
			if($bd_update){
				
				$cd_update = $this->mcommon->update('check_in_detail', array('booking_detail_id' => $booking_detail_id), $booking_detail_data);
				/*$bdData = $this->mcommon->getRow('booking_detail', array('booking_detail_id' => $booking_detail_id));
				if($bdData['room_rate'] > $room_rate) {
					$subtractRoomAmount = ($bdData['room_rate'] - $room_rate);
					$subtractigstAmount = ($bdData['room_total_igst'] - $igstAmt);
					$subtractPayableAmount = ($bdData['room_payable_amount'] - $roomRateAfterGst);
				}
				else if($bdData['room_rate'] == $room_rate) {
					$subtractRoomAmount = 0;
					$subtractigstAmount = 0;
					$subtractPayableAmount = 0;
				}
				else {
					$subtractRoomAmount = ($room_rate - $bdData['room_rate']);
					$subtractigstAmount = ($igstAmt - $bdData['room_total_igst']);
					$subtractPayableAmount = ($roomRateAfterGst - $bdData['room_payable_amount']);
				}
				
				$booking_header_data = array(
					'room_base_price' => ($bdData['room_base_price'] + $subtractRoomAmount),
					'room_price_before_tax' => ($bdData['room_base_price'] + $subtractRoomAmount),
					'room_total_igst' => ($bdData['room_total_igst'] + $subtractigstAmount),
					'room_payable_amount' => ($bdData['room_payable_amount'] + $subtractPayableAmount),
					'net_payable_amount' => ($bdData['net_payable_amount'] + $subtractPayableAmount),
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s'),
				);
				
				$this->mcommon->update('booking_header', array('booking_id' => $bdData['booking_id']), $booking_header_data);*/
				
				$return_data = array("status"=> true, 'msg' => 'Room rate change submitted successfully.');
			}
			else {
				$return_data = array("status"=> false, 'msg' => 'Something went wrong. Please try again!!');
			}
			
		//}
		
		echo json_encode($return_data);

	}
	


}
