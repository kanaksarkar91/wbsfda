<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "third_party/razorpay-php/Razorpay.php";

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Safari_booking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'frontend/query', 'admin/msafari_service', 'admin/mcancellationpolicy', 'frontend/msafari_booking', 'frontend/mbooking'));
		$this->load->helper(array('sms', 'email', 'common_helper', 'crypto', 'otp', 'gst'));
	}

	public function searchAvailability()
	{
		$data = [];
		$safari_type_id = $this->input->post('safari_type_id') != '' ? $this->input->post('safari_type_id') : 1;
		$division_id = $this->input->post('division_id') != '' ? $this->input->post('division_id') : NULL;
		$safari_service_header_id = $this->input->post('safari_service_header_id') != '' ? $this->input->post('safari_service_header_id') : NULL;
		$saf_booking_date = $this->input->post('saf_booking_date') != '' ? date('Y-m-d', strtotime($this->input->post('saf_booking_date'))) : NULL;
		$safari_cat_id = $this->input->post('safari_cat_id') != '' ? $this->input->post('safari_cat_id') : NULL;
		
		$data = array('safari_type_id' => $safari_type_id, 'division_id' => $division_id, 'safari_service_header_id' => $safari_service_header_id, 'saf_booking_date' => $saf_booking_date, 'safari_cat_id' => $safari_cat_id);

		$data['divisionData'] = $this->msafari_service->get_services_home(array('a.safari_type_id' => $safari_type_id));
		$data['safariServices'] = $this->mcommon->getDetailsOrder('safari_service_header', array('safari_type_id' => $safari_type_id, 'division_id' => $division_id, 'service_status' => 1));
		$data['safariCat'] = $this->mcommon->getDetailsOrder('safari_category_master', array('is_active' => 1));
		
		$data['content'] = 'frontend/safari_booking/search';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function searchAvailabilityProcess()
	{
		$response = [];
		$data = [];
		$serviceData = [];
		$html = '';
		$safari_type_id = $this->input->post('safari_type_id') != '' ? $this->input->post('safari_type_id') : '';
		$division_id = $this->input->post('division_id') != '' ? $this->input->post('division_id') : '';
		$safari_service_header_id = $this->input->post('safari_service_header_id') != '' ? $this->input->post('safari_service_header_id') : '';
		$saf_booking_date = $this->input->post('saf_booking_date') != '' ? date('Y-m-d', strtotime($this->input->post('saf_booking_date'))) : '';
		$safari_cat_id = $this->input->post('safari_cat_id') != '' ? $this->input->post('safari_cat_id') : '';
		
		$today = date('Y-m-d');
		$curTime = date('H:i');
		$curDateTime = date('Y-m-d H:i');
		
		if($saf_booking_date >= $today){
			$slots = $this->msafari_booking->get_booking_slot_list($safari_type_id, $division_id, $safari_service_header_id, $saf_booking_date, $safari_cat_id);
			$serviceData = $this->msafari_booking->get_service_data(array('safari_service_header_id' => $safari_service_header_id));
			
			//echo "<pre>"; print_r($slots); die;
			
			if(!empty($slots)){
					
					$html .= '<li class="mb-4">
									<div class="d-flex flex-column flex-lg-row justify-content-md-between align-items-center">
										<h3 class="fw-bold">'.$serviceData['division_name'].'</h3><h3> <span class="badge bg-dark">Safari Date: '.date('d F Y', strtotime($saf_booking_date)).'</span></h3>
									</div>
									<p></p>
									<div class="card border-0 shadow-sm">
										<div class="card-header light-grn-bg">
											<h5 class="fw-bold mb-0 thm-txt">'.$serviceData['service_definition'].'</h5>
										</div>
										<div class="card-body">
											<div class="row m-0">
												<div class="col-12 col-sm-12 col-md-4 col-lg-4 bg-light border p-2">
													<strong>Starting Point</strong>
													<div>
														'.$serviceData['start_point'].'
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-4 col-lg-4 bg-light border p-2">
													<strong>End Point</strong>
													<div>
														'.$serviceData['end_point'].'
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-4 col-lg-4 bg-light border p-2">
													<strong>Reporting Place</strong>
													<div>
														'.$serviceData['reporting_place'].'
													</div>
												</div>
												<div class="col-12 bg-light border p-2">
													<strong>Route</strong>
													<div>
														'.$serviceData['route_desc'].'
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="table-responsive border border-bottom-0 my-3">
													<table class="table table-hover table-sm align-middle mb-0">
														<thead>
															<tr>
																<th class="text-center light-grn-bg">Select Slot</th>
																<th class="light-grn-bg">Slot Time</th>
																<th class="light-grn-bg">Reporting Time</th>
																<th class="light-grn-bg text-center">Seat Available</th>
																<th class="light-grn-bg text-end">Rate per Person (Rs.)</th>
															</tr>
														</thead>
														<tbody>';
														
														foreach($slots as $key => $row){
															$checked = $key == 0 ? 'checked' : '';
															
															$dateTime = new DateTime($row['ticket_sale_closing_time']);
															$closingTime = $dateTime->format('H:i');
															
															//Start Get Ticket Sale Closing Date & Time
															if($row['ticket_sale_closing_flag'] == 2){//for previous day
																$date = $saf_booking_date;
																$dateObj = new DateTime($date);
																$dateObj->modify('-1 day');
																$PreviousDayDate = $dateObj->format('Y-m-d');
																
																$maxTicketSaleClosingDateTime = $PreviousDayDate.' '.$closingTime;
																
																
															}
															else {//for same day
																$maxTicketSaleClosingDateTime = $saf_booking_date.' '.$closingTime;
																
															}
															//End Get Ticket Sale Closing Date & Time
															
															$disable = ($maxTicketSaleClosingDateTime < $curDateTime) ? 'class="disabled" style="pointer-events: none;"' : ' style="cursor:pointer;"';
															
															$html .='<tr '.$disable.'>
																<td class="text-center bg-light">
																	<input class="form-check-input table-input-check" type="radio" name="period_slot_dtl_id" id="slotType1" value="'.$row['period_slot_dtl_id'].'" autocomplete="off">
																</td>
																<td>'.$row['slot_desc'].': '.$row['start_time'].' to '.$row['end_time'].'</td>
																<td>'.$row['reporting_time'].'</td>
																<td class="text-center fw-bold">'.$row['available_qty'].'</td>
																<td class="text-end fw-bold">'.$row['base_price'].'</td>
															</tr>';
														}
														$html .='</tbody>
													</table>
												</div>
											</div>
			
											<div class="row">
												<div class="col-12 mt-3">
													<h6 class="fw-bold">Important Information:</h6>
													<p class="fst-italic small">
														<b class="thm-txt">'.$serviceData['division_name'].':</b><br>
														<span>'.$serviceData['additional_info'].'</span>
													</p>
			
												</div>
											</div>
										</div>
									</div>
								</li>
								</ul>
							</div>
							<div class="col-12">
								<div class="form-group d-flex flex-column flex-md-row align-items-center">
									<label class="fs-6 me-3">Add Number of Persons <i class="req">*</i></label>
									<div>
									<input type="number" min="1" max="6" name="no_of_visitor" id="no_of_visitor" class="form-control form-control-lg" autocomplete="off">
									</div>
								</div>
								<span class="small req">*Enter no. of person less than seven(7).</span>
							</div>
							<div class="col-lg-12 col-sm-12">
								<div class="form-group">
									<input id="checkbox" name="terms_condition" type="checkbox" checked="checked" class="checkbox-custom checkbox" autocomplete="off">
									<label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTerms">I accept Terms & Conditions, Privacy Policy and Cancellation Rules.</a></label>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-start">
									<button type="button" class="btn btn-green px-4" id="" data-bs-toggle="modal" data-bs-target="#bookingindemnitydeclaration">Proceed to Book</button>
								</div>
							</div>';
								
					$response = array('success' => true, 'result' => $html);
			}
			else {
				$html .= '<li class="mb-4">
							<div class="d-flex flex-column flex-lg-row justify-content-md-between align-items-center">
								<h3 class="fw-bold">'.$serviceData['division_name'].'</h3><h3> <span class="badge bg-dark">Safari Date: '.date('d F Y', strtotime($saf_booking_date)).'</span></h3>
							</div>
							<p></p>
							<div class="card border-0 shadow-sm">
								<div class="alert alert-danger text-center">
									<h5 class="fw-bold mb-0 thm-txt">'.$serviceData['service_definition'].' Slots Not Found.</h5>
								</div>
							</div>
							</li>
							</ul>
							</div>';
				$response = array('success' => false, 'result' => $html);
			}
		
			
		}
		
		echo json_encode($response);
		exit;
	}
	public function init_booking()
	{
		$proceedToNextStep = false;
		$period_slot_dtl_id = $this->input->post('period_slot_dtl_id');
		$division_id = $this->input->post('division_id');
		$safari_type_id = $this->input->post('safari_type_id');
		$safari_service_header_id = $this->input->post('safari_service_header_id');
		$saf_booking_date = $this->input->post('saf_booking_date') != '' ? date('Y-m-d', strtotime($this->input->post('saf_booking_date'))) : '';
		$safari_cat_id = $this->input->post('safari_cat_id');
		$no_of_visitor = $this->input->post('no_of_visitor');
		$max_no_visitor = $safari_type_id == 1 ? 6: 4;

		$response = array('success' => false);

		$today = date('Y-m-d');
		$curTime = date('H:i');
		$curDateTime = date('Y-m-d H:i');
		
		if($no_of_visitor <= $max_no_visitor){
			
			if($saf_booking_date >= $today){
				$safariSlots = $this->msafari_booking->get_booking_slot_list($safari_type_id, $division_id, $safari_service_header_id, $saf_booking_date, $safari_cat_id);
				
				$foundSlot = null;
				if(!empty($safariSlots)){
					foreach ($safariSlots as $slot) {
						if ($slot['period_slot_dtl_id'] == $period_slot_dtl_id) {
							$foundSlot = $slot;
							break; // Exit the loop if found
						}
					}
				}
				
				if ($foundSlot) {
					if($foundSlot['available_qty'] >= $no_of_visitor){
						
						$dateTime = new DateTime($foundSlot['ticket_sale_closing_time']);
						$closingTime = $dateTime->format('H:i');
						
						//Start Get Ticket Sale Closing Date & Time
						if($foundSlot['ticket_sale_closing_flag'] == 2){//for previous day
							$date = $saf_booking_date;
							$dateObj = new DateTime($date);
							$dateObj->modify('-1 day');
							$PreviousDayDate = $dateObj->format('Y-m-d');
							
							$maxTicketSaleClosingDateTime = $PreviousDayDate.' '.$closingTime;
						}
						else {//for same day
							$maxTicketSaleClosingDateTime = $saf_booking_date.' '.$closingTime;
						}
						//End Get Ticket Sale Closing Date & Time
						
						$response = ($maxTicketSaleClosingDateTime < $curDateTime) ? array('success' => false, 'msg' => 'Online ticket selling time is over for selected date. Please choose another date.') : '';
						$proceedToNextStep = ($maxTicketSaleClosingDateTime < $curDateTime) ? false : true;
						
					}
					else{
						$response = array('success' => false, 'msg' => 'Now '.$foundSlot['available_qty'].' seat available for selected slot.');
					}
					//echo $foundSlot['available_qty'];
					//echo "<pre>"; print_r($foundSlot); die;
				} else {
					$response = array('success' => false, 'msg' => 'No seat available for search criteria.');
				}
			}
			else{
				$response = array('success' => false, 'msg' => 'No seat available for selected date.');
			}
		}
		else{
			$response = array('success' => false, 'msg' => 'No seat available!!');
		}
		
		if($proceedToNextStep == true){
			$response = array('success' => true, 'link' => base_url('safari-booking-information-entry/' . base64_encode($this->encryption->encrypt(serialize(array('period_slot_dtl_id' => $period_slot_dtl_id, 'division_id' => $division_id, 'safari_type_id' => $safari_type_id, 'safari_service_header_id' => $safari_service_header_id, 'saf_booking_date' => $saf_booking_date, 'safari_cat_id' => $safari_cat_id, 'no_of_visitor' => $no_of_visitor, 'slotData' => $foundSlot))))));
		}
		
		echo json_encode($response);
		exit;
	}
	public function safari_booking_information_entry($param)
	{
		$data = [];
		$safariSlots = [];
		$where = [];
		$det_arr = unserialize($this->encryption->decrypt(base64_decode($param)));
		
		$data['serviceData'] = $this->msafari_booking->get_service_data(array('safari_service_header_id' => $det_arr['safari_service_header_id']));
		$data['saf_booking_date'] = date('d F Y', strtotime($det_arr['saf_booking_date']));
		$data['no_of_visitor'] = $det_arr['no_of_visitor'];
		$data['safariCatData'] = $this->mcommon->getRow('safari_category_master', array('safari_cat_id' => $det_arr['safari_cat_id']));
		
		$safariSlots = $this->msafari_booking->get_booking_slot_list($det_arr['safari_type_id'], $det_arr['division_id'], $det_arr['safari_service_header_id'], $det_arr['saf_booking_date'], $det_arr['safari_cat_id']);
			
		$foundSlot = null;
		if(!empty($safariSlots)){
			foreach ($safariSlots as $slot) {
				if ($slot['period_slot_dtl_id'] == $det_arr['period_slot_dtl_id']) {
					$foundSlot = $slot;
					break; // Exit the loop if found
				}
			}
		}
		
		if ($foundSlot) {
			$data['foundSlot'] = $foundSlot;
			
			$data['price'] = $foundSlot['base_price'] * $det_arr['no_of_visitor'];
			
			$gstData = getSafariGstPercentage($data['price']);
			$data['gstAmt'] = (($data['price'] * $gstData['igst_percentage']) / 100);
			$data['payable_amount'] = $data['price'] + $data['gstAmt'];
			
			$this->load->library('form_validation');
			
			$visitor_name = $this->input->post('visitor_name');
			$visitor_gender = $this->input->post('visitor_gender');
			$visitor_age = $this->input->post('visitor_age');
			$visitor_id_type = $this->input->post('visitor_id_type');
			$visitor_id_no = $this->input->post('visitor_id_no');
			
			$child_name = $this->input->post('child_name');
			$child_gender = $this->input->post('child_gender');
			$child_age = $this->input->post('child_age');
			$child_id_type = $this->input->post('child_id_type');
			$child_id_no = $this->input->post('child_id_no');
			
			if (is_array($visitor_name) && is_array($visitor_gender)) {
				for ($v = 0; $v < count($visitor_name); $v++) {
					// Validate visitor name
					$this->form_validation->set_rules(
						'visitor_name['.$v.']', 
						'Visitor Name', 
						'required|trim',
						array(
							'required' => 'Visitor Name is required'
						)
					);
	
					// Validate visitor gender
					$this->form_validation->set_rules(
						'visitor_gender['.$v.']', 
						'Visitor Gender', 
						'required|in_list[Male,Female,Transgender]',
						array(
							'required' => 'Visitor Gender is required',
							'in_list' => 'Please select a valid gender'
						)
					);
					
					// Validate visitor age
					$this->form_validation->set_rules(
						'visitor_age['.$v.']', 
						'Visitor Age', 
						'required|trim|is_natural_no_zero|callback_check_age',
						array(
							'required' => 'Visitor Age is required'
						)
					);
					
					// Validate ID type
					$this->form_validation->set_rules(
						'visitor_id_type['.$v.']', 
						'ID Type', 
						'required|in_list[Voter ID,Aadhar Card,Passport,Driving Licence,Photo ID card issued by Central/State Govt.]',
						array(
							'required' => 'ID Type is required',
							'in_list' => 'Please select a valid ID Type'
						)
					);
					
					// Validate ID Number
					$this->form_validation->set_rules(
						'visitor_id_no['.$v.']', 
						'ID Number', 
						'required|trim',
						array(
							'required' => 'ID Number is required'
						)
					);
				}
				
			}
			
			if (!empty($child_name) && !empty($child_gender)) {
				$this->form_validation->set_rules('child_name[]', 'Child Name', 'required|trim');
				$this->form_validation->set_rules('child_gender[]', 'Child Gender', 'required|in_list[Male,Female,Transgender]');
				$this->form_validation->set_rules('child_age[]', 'Child Age', 'required|trim|is_natural_no_zero');
			}
			
			if ($this->form_validation->run()) {
			
				$proceedToPayment = false;
				
				$this->db->trans_start();
				
				if($foundSlot['available_qty'] >= $det_arr['no_of_visitor']){
					$curDateTime = date('Y-m-d H:i');
					$dateTime = new DateTime($foundSlot['ticket_sale_closing_time']);
					$closingTime = $dateTime->format('H:i');
					
					//Start Get Ticket Sale Closing Date & Time
					if($foundSlot['ticket_sale_closing_flag'] == 2){//for previous day
						$date = $det_arr['saf_booking_date'];
						$dateObj = new DateTime($date);
						$dateObj->modify('-1 day');
						$PreviousDayDate = $dateObj->format('Y-m-d');
						
						$maxTicketSaleClosingDateTime = $PreviousDayDate.' '.$closingTime;
					}
					else {//for same day
						$maxTicketSaleClosingDateTime = $det_arr['saf_booking_date'].' '.$closingTime;
					}
					//End Get Ticket Sale Closing Date & Time
					
					if($maxTicketSaleClosingDateTime < $curDateTime){
						$this->session->set_flashdata('slot_avlbl_err', "Online ticket selling time is over for selected date. Please choose another date.");
						redirect(base_url('safari-booking-information-entry/' . $param));
					}
					$proceedToPayment = ($maxTicketSaleClosingDateTime < $curDateTime) ? false : true;
					
					if($proceedToPayment == true){
						
						$customer_id = $this->session->userdata('customer_id') != '' ? $this->session->userdata('customer_id') : 0;
						
						$booking_number = createBookingNo('SB');
						
						$booking_header = array(
							'division_id' => $det_arr['division_id'],
							'safari_type_id' => $det_arr['safari_type_id'],
							'safari_cat_id' => $det_arr['safari_cat_id'],
							'safari_service_header_id' => $det_arr['safari_service_header_id'],
							'period_slot_dtl_id' => $det_arr['period_slot_dtl_id'],
							'booking_date' => $det_arr['saf_booking_date'],
							'booking_number' => $booking_number,
							'customer_id' => $customer_id,
							'no_of_person' => $det_arr['no_of_visitor'],
							'base_price' => $data['price'],
							'gst_amount' => $data['gstAmt'],
							'total_price' => $data['payable_amount'],
							'source' => 'F',
							'booking_status' => 'I',
							'created_by' => $customer_id,
							'created_ts' => date('Y-m-d H:i:s'),
							'booking_time_visitor_count' => $det_arr['no_of_visitor'],
						);
						
						$booking_id = $this->mcommon->insert('safari_booking_header', $booking_header);
						
						if($booking_id){
							//visitor detail data save
							for ($i = 0; $i < sizeof($visitor_name); $i++) {
			
								if ($visitor_name[$i] != '' && $visitor_id_no[$i] != '') {
			
									$booking_detail_data[] = array(
										'is_free' => 2,
										'booking_id' => $booking_id,
										'visitor_name' => $visitor_name[$i],
										'visitor_gender' => $visitor_gender[$i],
										'visitor_age' => $visitor_age[$i],
										'visitor_id_type' => $visitor_id_type[$i],
										'visitor_id_no' => $visitor_id_no[$i]
									);
								}
							}
							
							if (!empty($booking_detail_data)) {
								$this->msafari_booking->bookingDetailBatchInsert($booking_detail_data);
							}
							//end visitor detail data save
							
							//child detail data save
							for ($j = 0; $j < sizeof($child_name); $j++) {
			
								if ($child_name[$j] != '' && $child_gender[$j] != '') {
			
									$booking_child_detail_data[] = array(
										'is_free' => 1,
										'booking_id' => $booking_id,
										'visitor_name' => $child_name[$j],
										'visitor_gender' => $child_gender[$j],
										'visitor_age' => $child_age[$j],
										'visitor_id_type' => $child_id_type[$j],
										'visitor_id_no' => $child_id_no[$j]
									);
								}
							}
							
							//print_r($booking_child_detail_data); die;
							
							if (!empty($booking_child_detail_data)) {
								$this->msafari_booking->bookingDetailBatchInsert($booking_child_detail_data);
							}
							//end child detail data save
						}
					}
					
					$this->db->trans_complete();
					if ($this->db->trans_status()) {
						$data_record = array_merge($det_arr, array('booking_id' => $booking_id, 'total_amount' => round($data['payable_amount'])));
		
						redirect(base_url('frontend/safari_booking/booking_payment/' . base64_encode($this->encryption->encrypt(serialize($data_record)))));
					} else {
						$this->session->set_flashdata('err_msg', "Booking process unsuccessful. Please try again.");
						redirect(base_url('safari-booking-information-entry/' . $param));
					}
					
				}
				
			}
			
		}
		
		//echo "<pre>"; print_r($foundSlot); die;
		$data['err_msg'] = $this->session->flashdata('slot_avlbl_err');
		
		$data['customer_det'] = $this->session->userdata('customer_id') != '' ? $this->mbooking->get_customer_det(array('customer_master.customer_id' => $this->session->userdata('customer_id')))->last_row() : NULL;
		
		$data['content'] = 'frontend/safari_booking/safari_booking_details_entry';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function booking_payment($param1)
	{
		$post_fields = array();
		$data_record = unserialize($this->encryption->decrypt(base64_decode($param1)));
		$customer_id = $this->session->userdata('customer_id') != '' ? $this->session->userdata('customer_id') : 0;
		
		//echo '<pre>'; print_r($data_record); die;
		
		$post_fields['entity_name'] = $this->session->userdata('first_name');
		$post_fields['email'] = $this->session->userdata('email');
		$post_fields['phone'] = $this->session->userdata('mobile');
		$post_fields['amount'] = $data_record['total_amount'];
		$post_fields['currency'] = "INR";
		$post_fields['receipt_id'] = substr(hash('sha256', rand_string(6) . microtime()), 0, 20);
		$post_fields['callback_url'] 	= base_url('safari-booking-payment-success');
		$post_fields['cancel_url'] 	= base_url('safari-booking-payment-failure');
		$post_fields['checkout_url'] 	= RAZORPAY_CHECKOUT_URL;
		$post_fields['key_id'] = RAZORPAY_KEY;
		//$post_fields['entity_name'] = $this->session->userdata('first_name');
		//$post_fields['industrial_park'] = $application_detail['industrial_park'];
		//$post_fields['memo_reference_no'] = $application_detail['memo_reference_no'];
		
		
		$params1 = array();
		$params1['amount'] = $data_record['total_amount'];
		$params1['currency'] = $post_fields['currency'];
		$params1['receipt_id'] = $post_fields['receipt_id'];
		$params1['user_name'] = ucwords($this->session->userdata('first_name'));
		$params1['email'] = $this->session->userdata('email');
		$params1['phone'] = $this->session->userdata('mobile');
		//$params1['entity_name'] = $this->session->userdata('first_name');
		//$params1['industrial_park'] = $application_detail['industrial_park'];
		//$params1['memo_reference_no'] = $application_detail['memo_reference_no'];
		
		$razorpay_returnvalue = $this->genRazorpayPayment($params1);
		$razorpay_order_id = $razorpay_returnvalue["order_id"];
		
		$post_fields['order_id'] = $razorpay_returnvalue["order_id"];
		
		//echo $razorpay_order_id; die;
		
		if($razorpay_order_id != ''){
			$this->db->trans_start();
	
			$payment_data = array(
				'booking_id' => $data_record['booking_id'],
				'customer_id' => $customer_id,
				'payment_date' => date('Y-m-d H:i:s'),
				'txnid' => $post_fields['receipt_id'],
				'order_id' => $razorpay_order_id,
				'razorpay_payment_id' => NULL,
				'amount' => $data_record['total_amount'],
				'payment_mode' => '',
				'remarks' => '',
				'status' => 'PENDING',
				'created_ts' => date('Y-m-d H:i:s'),
			);
			$payment_id = $this->mcommon->insert('safari_booking_payment', $payment_data);
	
			$txn_data = $this->mcommon->update('safari_booking_header', array('booking_id' => $data_record['booking_id']), array('txnid' => $post_fields['receipt_id'], 'order_id' => $razorpay_order_id));
	
			$this->db->trans_complete();
			
			$data['razorpaydata'] = $post_fields;
			$data['content'] = 'frontend/safari_payment/safari_booking_payment';
			$this->load->view('frontend/layouts/index', $data);
		}

	}
	public function genRazorpayPayment($option)
	{
		$keyId = RAZORPAY_KEY;
		$keySecret = RAZORPAY_KEY_SECRET;

		$api = new Api($keyId, $keySecret);

		$recipt_id = $option['receipt_id'];
		$order_currencey = $option['currency'];
		$amount = $option['amount'];
		$user = $option['user_name'];

		$orderData = array(
			'receipt'         => $recipt_id,
			'amount'          => $amount * 100, // rupees in paise
			'currency'        => $order_currencey,
			'payment_capture' => 1 // auto capture
		);
		$razorpayOrder = $api->order->create($orderData);
		$razorpayOrderId = $razorpayOrder['id'];
		
		//echo "<pre>"; print_r($razorpayOrder); die;

		$payable_amount = $orderData['amount'];
		$data = array(
			"key"               => $keyId,
			"amount"            => $payable_amount,
			"image"             => base_url()."public/frontend_assets/assets/img/logo.png",
			/*"notes"           => array(
				"entity_name"              => $option['entity_name'],
				"industrial_park"             => $option['industrial_park'],
				"memo_reference_no"           => $option['memo_reference_no'],
			),*/
			"prefill"           => array(
				"name"              => $user,
				"email"             => $option['email'],
				"contact"           => $option['phone'],
			),

			"theme"             => array(
				"color"             => "#F37254"
			),
			"order_id"          => $razorpayOrderId,
		);

		return $data;

	}
	public function paymentSuccess(){
		$success = false;
		$razorpay_posted_data = $this->input->post();
		$razorpay_posted_data['keyId'] = RAZORPAY_KEY;
		$razorpay_posted_data['keySecret'] = RAZORPAY_KEY_SECRET;
		
		//echo "<pre>"; print_r($razorpay_posted_data); die;
		
		$api = new Api($razorpay_posted_data['keyId'], $razorpay_posted_data['keySecret']);
		
		$bookingData = $this->mcommon->getRow('safari_booking_header', array('order_id' => $razorpay_posted_data['razorpay_order_id']));
		
		if(!empty($bookingData)){
			
			if($razorpay_posted_data['razorpay_payment_id'] != '' && $razorpay_posted_data['razorpay_order_id'] != ''){
			
				//Customer details set in session------------------------------
				$user_data = $this->mcommon->getRow('customer_master', array('customer_id' => $bookingData['customer_id']));
				$session_data = $user_data;
				$session_data['user_type'] = 'frontend';
				$session_data['logged_in'] = TRUE;
				$this->session->set_userdata($session_data);
				//end Customer details set in session--------------------------
				
				$generated_signature = hash_hmac('sha256', $bookingData['order_id'] ."|". $razorpay_posted_data['razorpay_payment_id'], $razorpay_posted_data['keySecret']);
				
				if($generated_signature == $razorpay_posted_data['razorpay_signature']){
					try {
						// Please note that the razorpay order ID must
						// come from a trusted source (session here, but
						// could be database or something else)
						$attributes = array(
							'razorpay_order_id' => $razorpay_posted_data['razorpay_order_id'],
							'razorpay_payment_id' => $razorpay_posted_data['razorpay_payment_id'],
							'razorpay_signature' => $razorpay_posted_data['razorpay_signature']
						);
						
						//print_r($attributes); die;
			
						$api->utility->verifyPaymentSignature($attributes);
						$success = true;
					} catch (SignatureVerificationError $e) {
						$success = false;
						$error = 'Razorpay Error : ' . $e->getMessage();
					}
				}
				
				if ($success === true) {
					$this->mcommon->update('safari_booking_payment', array('order_id' => $razorpay_posted_data['razorpay_order_id']), array('razorpay_payment_id' => $razorpay_posted_data['razorpay_payment_id'], 'razorpay_signature' => $razorpay_posted_data['razorpay_signature']));
					
					$param = array();
					$param['payment_id'] = $razorpay_posted_data['razorpay_payment_id'];
					$param['order_id'] = $razorpay_posted_data['razorpay_order_id'];
					$check_payment_status = $this->booking_payment_verify($param);
					
					//echo "<pre>"; print_r($check_payment_status); die;
					
					if($check_payment_status['rtn'] === true){
						$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'SUCCESS', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
						$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
						$this->load->view('frontend/layouts/index', $data);
					}
					else{
						$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
						$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
						$this->load->view('frontend/layouts/index', $data);
					}
				} else {
					$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
					$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
					$this->load->view('frontend/layouts/index', $data);
				}
			
			}
			else {
				//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
				$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
				//echo $responseMetadata['payment_id']; die;
				$this->mcommon->update('safari_booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));
				
				//Customer details set in session------------------------------
				$appData = $this->mcommon->getRow('safari_booking_header', array('order_id' => $responseMetadata['order_id']));
				$user_data = $this->mcommon->getRow('customer_master', array('customer_id' => $appData['customer_id']));
				$session_data = $user_data;
				$session_data['user_type'] = 'frontend';
				$session_data['logged_in'] = TRUE;
				$this->session->set_userdata($session_data);
				//end Customer details set in session--------------------------
				
				$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
				$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
				$this->load->view('frontend/layouts/index', $data);
			}
		}
		else {
			//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
			$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
			//echo $responseMetadata['payment_id']; die;
			$this->mcommon->update('safari_booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));
			
			//Customer details set in session------------------------------
			$appData = $this->mcommon->getRow('safari_booking_header', array('order_id' => $responseMetadata['order_id']));
			$user_data = $this->mcommon->getRow('customer_master', array('customer_id' => $appData['customer_id']));
			$session_data = $user_data;
			$session_data['user_type'] = 'frontend';
			$session_data['logged_in'] = TRUE;
			$this->session->set_userdata($session_data);
			//end Customer details set in session--------------------------
				
			$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
			$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
			$this->load->view('frontend/layouts/index', $data);
		}
	}
	public function paymentFailure(){
		
		$razorpay_posted_data = $this->input->post();  // Escapes the string to prevent SQL injection
		
		//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
		$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
		//echo $responseMetadata['payment_id']; die;
		$this->mcommon->update('safari_booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));
		
		//Customer details set in session------------------------------
		$appData = $this->mcommon->getRow('safari_booking_header', array('order_id' => $responseMetadata['order_id']));
		$user_data = $this->mcommon->getRow('customer_master', array('customer_id' => $appData['customer_id']));
		$session_data = $user_data;
		$session_data['user_type'] = 'frontend';
		$session_data['logged_in'] = TRUE;
		$this->session->set_userdata($session_data);
		//end Customer details set in session--------------------------
			
		$data['redirect'] = base_url('frontend/safari_booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
		$data['content'] = 'frontend/safari_payment/safari_booking_confirmation';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function booking_payment_complete($value1)
	{
		if (is_null($value1))
			redirect(base_url());

		$det = unserialize($this->encryption->decrypt(base64_decode($value1)));

		$data['status'] = $det['status'];
		$data['payment_status'] = $det['payment_status'];
		//$data['payment'] = $det['posted_data'];
		$data['booking_det'] = $this->msafari_booking->get_booking_payment_info(array('a.order_id' => $det['order_id']));
		
		if(strtolower($data['booking_det']['status']) == 'failure'){ 
			$this->msafari_booking->move_booking_to_failed($det['booking_id']);
		}

		$data['content'] = 'frontend/safari_payment/safari_booking_payment_complete';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function booking_payment_verify($option){
		$return  = array();
		$keyId = RAZORPAY_KEY;
		$keySecret = RAZORPAY_KEY_SECRET;

		$api = new Api($keyId, $keySecret);
		
		try {
			// Fetch order details
			$order = $api->order->fetch($option['order_id'])->payments();
			//echo $order->items[0]->id;
			//echo "<pre>"; print_r($order); die;
			// Fetch payment ID from order
			$payment_id = $order->items[0]->id;
			
			// Capture the payment
			$payment = $api->payment->fetch($payment_id);
			$getPaymentData = $this->mcommon->getRow('safari_booking_payment', array('order_id' => $option['order_id']));
			$capturedAmount = ($payment->amount / 100);
			//echo "<pre>"; print_r($payment); die;
			//$payJson = json_encode(serialize($payment));
			//$payObject = unserialize(json_decode($payJson));
		
			/*echo "Payment ID: " . $payment->id . "\n";
			echo "Amount Captured: " . $payment->amount . "\n";
			echo "Status: " . $payment->status . "\n";
			echo "Captured: " . $payment->captured . "\n";
			echo "method: " . $payment->method . "\n";
			echo "email: " . $payment->email . "\n";
			echo "contact: " . $payment->contact . "\n";
			echo "created_at: " . date('m/d/Y H:i:s', $payment->created_at) . "\n";
			echo "auth_code: " . $payment->acquirer_data->auth_code . "\n";*/
			
			if(!empty($payment)){
				if(($payment->status == 'captured' && $payment->captured == 1) && ($payment->order_id != '') && ($getPaymentData['amount'] == $capturedAmount)){ //Success Payment
					$payment_data = array(
						'payment_date' => date('Y-m-d H:i:s', $payment->created_at),
						'razorpay_payment_id' => $payment->id,
						'payment_mode' => $payment->method,
						'remarks' => 'Payment Successful',
						'status' => ucwords($payment->status),
						'updated_ts' => date('Y-m-d H:i:s'),
					);
					
					$booking_header_condn = array('booking_status' => 'A', 'payment_status' => 1);
					
					if($option['type'] == 'Cron'){
						$payment_data['cronjob_data'] = json_encode(serialize($payment));
						$payment_data['cronjob_status'] = 'COMPLETED';
						$payment_data['cronjob_end_time'] = date('Y-m-d H:i:s');
					} else{
						$payment_data['response_txt'] = json_encode(serialize($payment));
					}
					
					$update = $this->mcommon->update('safari_booking_payment', array('order_id' => $payment->order_id), $payment_data);
					if($update){
						$this->mcommon->update('safari_booking_header', array('order_id' => $payment->order_id), $booking_header_condn);
						
						$return['status'] = $payment->status;
						$return['rtn'] = true;
						return $return;
					}
				}
				else{ //Failed Payment
					$payment_data = array(
						'payment_date' => date('Y-m-d H:i:s', $payment->created_at),
						'razorpay_payment_id' => $payment->id,
						'response_txt' => json_encode(serialize($payment)),
						'remarks' => 'Payment Failed',
						'status' => ucwords($payment->status),
						'updated_ts' => date('Y-m-d H:i:s'),
					);
					
					$booking_header_condn = array('booking_status' => 'F', 'payment_status' => 0);
					
					$update = $this->mcommon->update('safari_booking_payment', array('order_id' => $payment->order_id), $payment_data);
					if($update){
						$this->mcommon->update('safari_booking_header', array('order_id' => $payment->order_id), $booking_header_condn);
						
						if($option['type'] == 'Cron'){
							if($getPaymentData['payment_mode'] == 'NEFT'){//for NEFT mode
								$start_date = strtotime($payment->created_ts);
								$end_date = strtotime("+8 day", $start_date);
								$last_date = date('Y-m-d', $end_date);
										
								if((date('Y-m-d') > $last_date) && ($payment->status != 'captured')){
									$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
								}
							}
							else{//for others mode
								
								if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020) && ($payment->status != 'captured')) {
									$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
								}
							}
						}
						
						$return['status'] = $payment->status;
						return $return;
					}
				}
			}
			else{
				
				if($option['type'] == 'Cron'){
					if($getPaymentData['payment_mode'] == 'NEFT'){//for NEFT mode
						$start_date = strtotime($getPaymentData['created_ts']);
						$end_date = strtotime("+8 day", $start_date);
						$last_date = date('Y-m-d', $end_date);
								
						if(date('Y-m-d') > $last_date){
							$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
						}
					}
					else{//for others mode
						
						if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020)) {
							$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
						}
					}
				}
				
				$return['status'] = 'Payment Not Found';
				$return['rtn'] = false;
				return $return;
			}
			
		} catch (Exception $e) {
			$getPaymentData = $this->mcommon->getRow('safari_booking_payment', array('order_id' => $option['order_id']));
			if($option['type'] == 'Cron'){
				if($getPaymentData['payment_mode'] == 'NEFT'){//for NEFT mode
					$start_date = strtotime($getPaymentData['created_ts']);
					$end_date = strtotime("+8 day", $start_date);
					$last_date = date('Y-m-d', $end_date);
							
					if(date('Y-m-d') > $last_date){
						$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
					}
				}
				else{//for others mode
					
					if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020)) {
						$booking_failed_det = $this->msafari_booking->move_booking_to_failed($getPaymentData['booking_id']);
					}
				}
			}
			
			// Handle any exceptions that occur during the capture process
			$error = "Error capturing payment: " . $e->getMessage();
			$return['status'] = $error;
			$return['rtn'] = false;
			return $return;
		}
	
	}
	public function safariBookingPaymentVerifyCron(){
		$param = array();
		$payments = $this->msafari_booking->get_booking_payment(array("status IN ('PENDING','NOT-FOUND','FAILURE', 'Failure', 'FAILED','AWAITED','INITIATED','UNSUCCESSFUL','Aborted', 'TIMEOUT') OR status IS NULL" => NULL, "safari_booking_header.booking_status IN ('I','F')" => NULL));
		//$payments = $this->mcommon->getDetails('payment_info', array('payment_id' => 46));
		if ($payments->num_rows() > 0) {
			foreach ($payments->result() as $payment) {
				if($payment->order_id != ''){
					$cron_det = $this->mcommon->update('safari_booking_payment', array('order_id' => $payment->order_id), array('cronjob_start_time' => date('Y-m-d H:i:s')));
					$param['payment_id'] = $payment->razorpay_payment_id;
					$param['order_id'] = $payment->order_id;
					$param['type'] = 'Cron';
					$check_app_payment_status = $this->booking_payment_verify($param);
					if($check_app_payment_status){
						$cron_status = "Update Successful for ORDER ID: " . $payment->order_id;
					}
				}
				else{
					$cron_status = "No Payment ID found";
				}
				
				$add_data = $this->mcommon->insert('activity_log', array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'safari-booking-payment-verify-cron', 'log_desc' => $cron_status));
				echo $cron_status . "<br>";
			}
		}else{
			$cron_status .= " No Pending transactions found.";
			$add_data = $this->mcommon->insert('activity_log', array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'safari-booking-payment-verify-cron', 'log_desc' => $cron_status));
			echo $cron_status . "<br>";
		}
	
	}
	public function check_age($age) {
		// Assuming $age is an array of ages
		$ages = $this->input->post('visitor_age');
		foreach ($ages as $a) {
			if ($a >=18) {
				return TRUE; // At least one age is above 18
			}
		}
		$this->form_validation->set_message('check_age', 'At least one visitor must be 18 years.');
		return FALSE;
	}
	
}
