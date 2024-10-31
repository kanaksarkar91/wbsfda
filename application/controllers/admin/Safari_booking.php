<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Safari_booking extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/msafari_service', 'mcommon', 'frontend/msafari_booking', 'frontend/query'));
		$this->load->helper(array('gst', 'email'));

	}
	
	public function booking()
	{
		$data = array('menu_id'=> 73);
		$where = [];
		$data['start_date']= $this->input->post('start_date') != '' ? $this->input->post('start_date') : decode_url($this->uri->segment('7')); 
		$data['end_date']= $this->input->post('end_date') != '' ? $this->input->post('end_date') : decode_url($this->uri->segment('7'));
		$data['safari_type_id']= $this->input->post('safari_type_id') != '' ? $this->input->post('safari_type_id') : decode_url($this->uri->segment('4'));
		$data['division_id']= $this->input->post('division_id') != '' ? $this->input->post('division_id') : decode_url($this->uri->segment('5'));
		$data['safari_service_header_id']= $this->input->post('safari_service_header_id') != '' ? $this->input->post('safari_service_header_id') : decode_url($this->uri->segment('6'));
		
		$period_slot_dtl_id = $data['period_slot_dtl_id'] = $this->uri->segment('8') != '' ? decode_url($this->uri->segment('8')) : 0;
		$safari_cat_id = 1;
		
		if($data['start_date']){
			$where['a.booking_date >='] = date('Y-m-d', strtotime($data['start_date']));
		}
		if($data['end_date']){
			$where['a.booking_date <='] = date('Y-m-d', strtotime($data['end_date']));
		}
		if($data['safari_type_id'] != 0){
			$where['a.safari_type_id = '] = $data['safari_type_id'];
		}
		if($data['division_id'] != 0){
			$where['a.division_id = '] = $data['division_id'];
		}
		if($data['safari_service_header_id'] != 0){
			$where['a.safari_service_header_id = '] = $data['safari_service_header_id'];
		}
		if($period_slot_dtl_id != 0){
			$where['a.period_slot_dtl_id = '] = $period_slot_dtl_id;
		}
		$where['a.booking_status != '] = 'F';
		$order_by = 'DATE(a.created_ts) DESC';
		$group_by = NULL;
		$data['bookings'] = [];
		$safari_service_header_ids = [];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$safari_service_header_ids =  $this->mcommon->get_user_service(array('user_id' => $this->admin_session_data['user_id']));
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($safari_service_header_ids)){
				$data['bookings'] = $this->msafari_service->get_booking($where, $order_by, $safari_service_header_ids, $group_by);
			}
			//echo nl2br($this->db->last_query()); die;
			$data['userServices'] = $this->msafari_service->get_user_wise_service($safari_service_header_ids);
			
			$data_list = $this->msafari_booking->get_booking_slot_list($data['safari_type_id'], $data['division_id'], $data['safari_service_header_id'], $data['start_date'], $safari_cat_id);
			//echo "<pre>"; print_r($data_list); die;	
			$data['foundSlot'] = null;
			if(!empty($data_list)){
				foreach ($data_list as $slot) {
					if ($slot['period_slot_dtl_id'] == $period_slot_dtl_id) {
						$data['foundSlot'] = $slot;
						break; // Exit the loop if found
					}
				}
			}
		}
		//echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['userServices']);die;
		
		$data['typeData'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['divisionData'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1), 'division_name', 'ASC');
		
		$data['content'] = 'admin/safari_booking/list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function booking_details($booking_id)
	{
		$data = [];
		$data['cancellation_details'] = [];
		$data['cancellation_request_details'] = [];
		$data = ['menu_id'=> 63];
		$data['cancel_button_visible'] = 'No';
		$data['calcelButtonShowing'] = false;
		
		$booking_id = decode_url($booking_id);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['cancel_button_visible'] = 'Yes';
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$data['cancel_button_visible'] = 'Yes';
			}
		}
		
		$data['booking_details'] = $this->msafari_service->get_safari_booking_details(['booking_id' => $booking_id]);
		$data['booking_payment_details'] = $this->msafari_service->get_safari_booking_payment_details(['booking_id' => $booking_id, 'status' => 'Captured']);
		//echo "<pre>"; print_r($data['booking_payment_details']);die;
		
		if(!empty($data['booking_details'])){
			
			$date = $data['booking_details'][0]['booking_date'];
			// Create DateTime object
			$dateObj = new DateTime($date);
			// Subtract one day
			$dateObj->modify('-1 day');
			// Get the modified date
			$cancelLastDate = $dateObj->format('Y-m-d');

			$dateTime = new DateTime($row['start_time']);
			$closingTime = $dateTime->format('H:i');

			$cancelationLastDateTime = $cancelLastDate . ' ' . $closingTime;
			$currentDateTime = date('Y-m-d H:i');
			if ($cancelationLastDateTime > $currentDateTime) {
				$data['calcelButtonShowing'] = true;
			}
			
			$visitorAgesdata = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_status' => 1]);
			if(!empty($visitorAgesdata)){
				foreach($visitorAgesdata as $vrow){
					$ages[] = $vrow['visitor_age'];
				}
				$data['visitorAges'] = implode(',', $ages);
			}
			
			$data['cancellation_request_details'] = $this->msafari_service->get_safari_booking_cancellation_details(['a.cancel_source' => 'S', 'a.booking_id' => $booking_id, 'a.is_refunded' => 1]);
		}
		
		//echo "<pre>"; print_r($data['cancellation_request_details']);die;
		$data['content'] = 'admin/safari_booking/safari_booking_details';
		$this->load->view('admin/layouts/index', $data);
	}
	public function cancelSafariBooking()
	{
		//echo "<pre>"; print_r($this->input->post()); die;
		$furtherProceed = false;
		$booking_id = decode_url($this->input->post('booking_id'));
		$safari_booking_detail_ids = $this->input->post('safari_booking_detail_ids');
		$visitor_ages = $this->input->post('visitor_ages');

		if (is_numeric($booking_id) && $booking_id > 0 && !empty($safari_booking_detail_ids) && !empty($visitor_ages)) {
			$bookingData = $this->mcommon->getRow('safari_booking_header', ['booking_id' => $booking_id]);

			$visitorsData = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_status' => 1]);
			if(!empty($visitorsData)){
				foreach($visitorsData as $vrow){
					$ages[] = $vrow['visitor_age'];
				}
			}
			
			if(count($ages) != count($this->input->post('visitor_ages'))){
				
				// Create a copy of $array1 for the new array
				$newArray = $ages;
				
				// Loop through $array2 and remove each value once from $newArray
				foreach ($this->input->post('visitor_ages') as $value) {
					// Find the index of the value in $newArray
					$index = array_search($value, $newArray);
					if ($index !== false) {
						// Remove the element from $newArray at the found index
						unset($newArray[$index]);
					}
				}
				
				// Re-index new array to maintain sequential keys
				$newArray = array_values($newArray);
				//echo "<pre>"; print_r($newArray); die;
				// Check if any value in the new array is greater than 18
				$greaterThanOrEqualAdultAge = array_filter($newArray, function($value) {
					return $value >= ADULT_AGE;
				});
				
				if (!empty($greaterThanOrEqualAdultAge)) {
					$furtherProceed = true;
				} else {
					$return_data = array('status' => false, 'msg' => 'No adults are present on this booking!!');
					echo json_encode($return_data);
					die;
				}
			}
			
			$result_decoded = array();
			$cancel_request_data = array();
			$booking_payment_details = $this->db->from('safari_booking_payment')->where('booking_id', $booking_id)->order_by('booking_payment_id', 'DESC')->limit(1)->get()->row_array();

			if (!empty($booking_payment_details)) {

				try {

					$counts = array_count_values($this->input->post('is_free'));
					$count_of_2 = isset($counts[2]) ? $counts[2] : 0;//paid visitor count
					
					$cancellation_details = get_cancellation_percentage($bookingData['booking_date']);
					
					$cancellationDetails = get_cancellation_details($booking_id, $cancellation_details, $count_of_2);
					
					//echo "<pre>"; print_r($cancellationDetails); die;
				
					$cancel_percent = 100;
					$cancel_charge = $basePrice;
					$refund_amt = 0;
					
					if (!empty($cancellationDetails)) {
						//$cancel_percent = $cancellationDetails['cancel_percent'];
						//$cancel_charge = $cancellationDetails['cancel_charge'];
						//$refund_amt = $cancellationDetails['refund_amt'];
						$cancel_percent = $this->input->post('cancel_percent');
						$cancel_charge = $this->input->post('cancel_charge');
						$refund_amt = $this->input->post('refund_amt');
						$safari_net_amount = $cancellationDetails['basePrice'];
						$actual_refund_amt = $cancellationDetails['refund_amt'];
					}
					
					//echo $refund_amt.'<br>'.$safari_net_amount.'<br>'.$actual_refund_amt; die;

					if ($refund_amt > 0 && $refund_amt <= $safari_net_amount) {
						
						$keyId = RAZORPAY_KEY;
						$keySecret = RAZORPAY_KEY_SECRET;
						$url = RAZORPAY_REFUND_URL . $booking_payment_details['razorpay_payment_id'] . "/refund";
						$refendAmtInPaisa = $refund_amt * 100;

						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_USERPWD, $keyId . ':' . $keySecret);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

						// Partial refund data (amount in paise)
						$post_fields = json_encode(array(
							'amount' => $refendAmtInPaisa
						));
						curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
						
						// Set headers for JSON data
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'Content-Type: application/json'
						));

						$response = curl_exec($ch);

						$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

						curl_close($ch);

						$result = json_decode($response, true);
					} else {
						$return_data = array('status' => false, 'msg' => 'The refund amount is more than the actual amount!!');
						echo json_encode($return_data);
						die;
					}


					if (!empty($result) && $http_status == 200) {

						$this->db->trans_start(); # Starting Transaction

						$cancel_remarks = $this->input->post('cancel_remarks');
						$cancel_gst_percent = 5;
						$cancel_request_data = array(
							'cancel_source' => 'S',
							'booking_id' => $booking_id,
							'net_payble_amount' => $this->input->post('paid_amount'),
							'paid_amount' => $bookingData['base_price'],
							'cancel_percent' => $cancel_percent,
							'cancel_charge' => $cancel_charge,
							'cancel_gst_percent' => $cancel_gst_percent,
							'cancel_gst' => number_format(($cancel_charge * $cancel_gst_percent) / 100, 2, ".", ""),
							'actual_refund_amt' => $refund_amt,
							'refund_amt' => $refund_amt,
							'refunded_amount' => $refund_amt,
							'cancel_type' => $count_of_2 == $bookingData['no_of_person'] ? 'F' : 'P',
							'created_by' => $this->admin_session_data['user_id'],
							'created_user_type' => 'U',
							'created_ts' => date('Y-m-d H:i:s'),
							'is_refunded' => ($result['payment_id'] != '') ? 1 : 0,
							'cancel_refund_request_id' => $result['id'],
							'cancel_request_response' => json_encode($result),
							'razorpay_payment_id' => $result['payment_id'],
							'cancellation_remarks' => $cancel_remarks,
							'no_of_person_cancelled' => $count_of_2

						);

						$this->db->insert('cancel_request_tbl', $cancel_request_data);
						//echo nl2br($this->db->last_query()); die;
						$booking_status = $count_of_2 == $bookingData['no_of_person'] ? 'C' : 'A';
						$no_of_person = $count_of_2 == $bookingData['no_of_person'] ? $bookingData['booking_time_visitor_count'] : ($bookingData['no_of_person'] - $count_of_2);
						//update header table
						$this->db->update('safari_booking_header', array('no_of_person' => $no_of_person, 'booking_status' => $booking_status, 'is_refunded' => $cancel_request_data['is_refunded'], 'cancellation_remarks' => $cancel_remarks, 'updated_by' => $this->admin_session_data['user_id'], 'updated_ts' => date('Y-m-d H:i:s')), array('booking_id' => $booking_id));
						//echo nl2br($this->db->last_query()); die;
						//update detail table
						foreach($safari_booking_detail_ids as $drow){
							$this->mcommon->update('safari_booking_detail', ['safari_booking_detail_id' => $drow], ['is_status' => 2]);
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

							/* Booking Cancellation Email Sending */

							$refund_perc = (100 - $cancel_percent);

							$config = email_config();
							$email_from = $config['email_from'];
							unset($config['email_from']);

							$subject = 'PNR No.  ' . $bookingData['booking_number'] . ' has been cancelled.';

							$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
		<center style="width: 100%; background-color: #f1f1f1; font-family: Arial, Helvetica, sans-serif;">
			<div style="max-width: 600px; margin: 0 auto;">
				
				<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
					<tr style="background-color: #FFF;">
						<td valign="top" style="padding: 1em; border: 1px solid #00bdd6;">
							<table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
								<tr>
									<td style="text-align: left;padding:10px; width: 68px;">
										<img src="' . base_url('public/frontend_assets/assets/img/logo.png') . '" width="48" alt="..."></img>
									</td>
									<td style="text-align: center;">
										<h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">' . COM_NAME . '</h3>
										<p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Govt.Notification No. 1130-FR/11M-19/2003, On 10th June -2014</p>
										<h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for cancellation initiated by the concerned party</h2>
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
												We have received your cancellation application for PNR No. ' . $bookingData['booking_number'] . ' and it has been accepted. ' . $refund_perc . '% of the booking amount (excluding GST) will be refunded within 15 days and will be credited to the concerned bank account through which payment has been made at the time of booking. For any further query please get in touch with us at 9734190119.
											</p>
											<p style="margin-bottom:0;">Thanks and Regards,</p>
											<p style="margin-top:0;">WBSFDC</p>
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
								<span>' . COM_ADDRESS . '</span>
							</p>
							<p style="margin-bottom: 5px; margin-top:0;">
								<b>Phone:</b>
								<span>' . COM_PHONE . '</span>
							</p>
							<p style="margin-bottom: 0;margin-top:0;">
								<b>Email Us On:</b>
								<span>' . COM_EMAIL . '</span>
							</p>
						</td>
					</tr>
				</table>
	
				<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;background: #00bdd6;">
					<tr>
						<td style="text-align: center; color: #FFF; padding: 5px 15px; font-size: 12px;">
							<p>
								<span>© ' . date('Y') . ' ' . COM_NAME . '.All right reserved.
								</span>
							</p>
						</td>
					</tr>
				</table>
	
			</div>
		</center>
	</body>';

							$customer_details = $this->db->from('customer_master')->where('customer_id', $bookingData['customer_id'])->get()->row_array();

							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from($email_from, EMAIL_FROM_NAME); // change it to yours
							$this->email->to($customer_details['email']); // change it to yours 

							$this->email->subject($subject);
							$this->email->message($message);
							$this->email->send();

							//$refundPer = $refund_perc . '%';
							//payment_cancelled($booking_det['mobile'], $booking_det['booking_no'], $refundPer);

							$return_data = array('status' => true, 'msg' => 'Booking has been cancelled successfully');
						}
					} else {

						throw new Exception(curl_error($ch));
					}
				} catch (Exception $e) {
					// this will not catch DB related errors. But it will include them, because this is more general. 
					$return_data = array('status' => false, 'msg' => $e->getMessage());
				}
			} else {

				$return_data = array('status' => false, 'msg' => 'Payment info not found');
			}

			echo json_encode($return_data);
			die;
		}

	}
	public function downloadSafariInvoice($booking_id)
	{
		$this->load->library('pdf');
		$data = array();
		$booking_id = decode_url($booking_id);
		
		$condn = array('booking_id' => $booking_id);

		$data['sBooking'] = $this->query->getSafariBookingDetailsByUser($condn);
		$data['sBookingDetail'] = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_free' => 2]);
		$data['sBookingChildDetail'] = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_free' => 1]);
		$data['sBookingPayment'] = $this->mcommon->getRow('safari_booking_payment', ['booking_id' => $booking_id, 'status' => 'Captured']);

		$filename = 'Booking-'.$data['sBooking'][0]['booking_number'];
		$html = $this->load->view('frontend/downloadSafariInvoice', $data, true);
		// $this->pdf->create($html, $filename);
		// echo $html;die;

		$this->pdf->loadHtml($html);
		$this->pdf->set_paper("A4", "landscape");
		$this->pdf->render();

		$this->pdf->stream("" . $filename . ".pdf", array("Attachment" => 0));
	}
	public function block()
	{
		$data = array('menu_id'=> 74);
		$where = [];
		
		$data['start_date']= $this->input->post('start_date') != '' ? $this->input->post('start_date') : decode_url($this->uri->segment('7')); 
		$data['end_date']= $this->input->post('end_date') != '' ? $this->input->post('end_date') : decode_url($this->uri->segment('7'));
		$data['safari_type_id']= $this->input->post('safari_type_id') != '' ? $this->input->post('safari_type_id') : decode_url($this->uri->segment('4'));
		$data['division_id']= $this->input->post('division_id') != '' ? $this->input->post('division_id') : decode_url($this->uri->segment('5'));
		$data['safari_service_header_id']= $this->input->post('safari_service_header_id') != '' ? $this->input->post('safari_service_header_id') : decode_url($this->uri->segment('6'));
		
		$period_slot_dtl_id = $data['period_slot_dtl_id'] = $this->uri->segment('8') != '' ? decode_url($this->uri->segment('8')) : 0;
		$safari_cat_id = 1;
		
		if($data['start_date']){
			$where['a.block_date >='] = date('Y-m-d', strtotime($data['start_date']));
		}
		if($data['end_date']){
			$where['a.block_date <='] = date('Y-m-d', strtotime($data['end_date']));
		}
		if($data['safari_type_id'] != 0){
			$where['a.safari_type_id = '] = $data['safari_type_id'];
		}
		if($data['division_id'] != 0){
			$where['a.division_id = '] = $data['division_id'];
		}
		if($data['safari_service_header_id'] != 0){
			$where['a.safari_service_header_id = '] = $data['safari_service_header_id'];
		}
		if($period_slot_dtl_id != 0){
			$where['a.period_slot_dtl_id = '] = $period_slot_dtl_id;
		}
		//$order_by = 'bh.booking_id DESC';
		$order_by = 'DATE(a.block_date) DESC';
		$group_by = NULL;//'bh.booking_id';
		$blockedBookings = [];
		$safari_service_header_ids = [];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$safari_service_header_ids =  $this->mcommon->get_user_service(array('user_id' => $this->admin_session_data['user_id']));
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($safari_service_header_ids)){
				$blockedBookings = $this->msafari_service->get_block_booking('safari_sdervice_blocked', $where, $order_by, $safari_service_header_ids, $group_by, 'created_by');
				
				$blockedArchivedBookings = $this->msafari_service->get_block_booking('safari_sdervice_blocked_archive', $where, $order_by, $safari_service_header_ids, $group_by, 'archived_by');
				
				$data['mergedArray'] = array_merge($blockedBookings, $blockedArchivedBookings);
			}
			
			$data['userServices'] = $this->msafari_service->get_user_wise_service($safari_service_header_ids);
			
			$data_list = $this->msafari_booking->get_booking_slot_list($data['safari_type_id'], $data['division_id'], $data['safari_service_header_id'], $data['start_date'], $safari_cat_id);
			//echo "<pre>"; print_r($data_list); die;	
			$data['foundSlot'] = null;
			if(!empty($data_list)){
				foreach ($data_list as $slot) {
					if ($slot['period_slot_dtl_id'] == $period_slot_dtl_id) {
						$data['foundSlot'] = $slot;
						break; // Exit the loop if found
					}
				}
			}
		}
		// echo $this->db->last_query(); die;
		//echo '<pre>';
		//print_r($data['mergedArray']);die;
		
		$data['typeData'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['divisionData'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1), 'division_name', 'ASC');
		
		$data['content'] = 'admin/safari_block/list';
		$this->load->view('admin/layouts/index', $data); 
	}
	public function getSlots()
	{
		$data_list = [];
		$response = [];
		$html = '';
		
		if($this->input->post()){
			$safari_type_id = $this->input->post('safari_type_id') != '' ? $this->input->post('safari_type_id') : 0;
			$division_id = $this->input->post('division_id') != '' ? $this->input->post('division_id') : 0;
			$safari_service_header_id = $this->input->post('safari_service_header_id') != '' ? $this->input->post('safari_service_header_id') : 0;
			$saf_booking_date = $this->input->post('block_date') != '' ? date('Y-m-d', strtotime($this->input->post('block_date'))) : '';
			$safari_cat_id = $this->input->post('safari_cat_id') != '' ? $this->input->post('safari_cat_id') : 1;
			$period_slot_dtl_id = $this->input->post('period_slot_dtl_id') != '' ? $this->input->post('period_slot_dtl_id') : 0;
			
			if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0 && is_numeric($division_id) && $division_id > 0 && is_numeric($safari_cat_id) && $safari_cat_id > 0){
				$data_list = $this->msafari_booking->get_booking_slot_list($safari_type_id, $division_id, $safari_service_header_id, $saf_booking_date, $safari_cat_id);
				//echo "<pre>"; print_r($data_list); die;
				
				$foundSlot = null;
				if(!empty($data_list)){
					foreach ($data_list as $slot) {
						if ($slot['period_slot_dtl_id'] == $period_slot_dtl_id) {
							$foundSlot = $slot;
							break; // Exit the loop if found
						}
					}
				}
				//echo "<pre>"; print_r($foundSlot); die;
				if(!empty($foundSlot)){
					$serviceData = $this->msafari_booking->get_service_data(array('safari_service_header_id' => $foundSlot['safari_service_header_id']));
					$html .= '<div class="app-card app-card-settings shadow-sm mb-2 p-3">
								<div class="app-card-body">
									<table class="table app-table-hover table-bordered">
										<tr>
											<th>Division/National Park</th>						
											<th>Safari Type</th>						
											<th>Service Definition</th>
											<th>Status as on</th>
											<th>Time Slot</th>
										</tr>
										<tr>
											<td>'.$serviceData['division_name'].'</td>
											<td>'.$foundSlot['type_name'].'</td>
											<td>'.$serviceData['service_definition'].'</td>
											<td>'.date('h:i A').' of '.date('d-m-Y').' for '.date('d-m-Y', strtotime($saf_booking_date)).'</td>						
											<td>'.$foundSlot['slot_desc'].': '.$foundSlot['start_time'].' to '.$foundSlot['end_time'].'</td>
										</tr>
									</table>
									
					
									<div class="row">
										<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
											<div class="info-box border shadow-none rounded-0 mb-0" >
												<div class="info-box-content text-center">
												<span class="info-box-text fw-bold">Total Capacity</span>
												<span class="fs-5 fw-bold" style="color: #009e60;">'.$foundSlot['capacity'].'</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
											<div class="info-box border shadow-none rounded-0 mb-0" >
												<div class="info-box-content text-center">
												<span class="info-box-text fw-bold">Seats Booked</span>
												<span class="fs-5 fw-bold" style="color: #009e60;">'.$foundSlot['no_of_booked_ticket'].'</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
											<div class="info-box border shadow-none rounded-0 mb-0" >
												<div class="info-box-content text-center">
												<span class="info-box-text fw-bold">Seats Blocked</span>
												<span class="fs-5 fw-bold" style="color: #009e60;">'.$foundSlot['blocked_count'].'</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
											<div class="info-box border shadow-none rounded-0 mb-0" >
												<div class="info-box-content text-center">
												<span class="info-box-text fw-bold">Seats Available</span>
												<span class="fs-5 fw-bold" style="color: #009e60;">'.$foundSlot['available_qty'].'</span>
												</div>
											</div>
										</div>
					
										<div class="clearfix w-100"></div>
										<div class="col-sm-12 mb-3 text-end">
											<a class="btn app-btn-primary" href="'.base_url('admin/safari_booking/booking/'.encode_url($safari_type_id).'/'.encode_url($division_id).'/'.encode_url($safari_service_header_id).'/'.encode_url($saf_booking_date).'/'.encode_url($period_slot_dtl_id)).'" target="_blank">View Booking Details</a>
											<a class="btn app-btn-primary" href="'.base_url('admin/safari_booking/block/'.encode_url($safari_type_id).'/'.encode_url($division_id).'/'.encode_url($safari_service_header_id).'/'.encode_url($saf_booking_date).'/'.encode_url($period_slot_dtl_id)).'" target="_blank">View Block History</a>
										</div>
									</div>
								</div>
							</div>
							
							<div class="app-card app-card-settings shadow-sm mb-2 p-3">
								<div class="app-card-body">
									<div class="row g-3 mb-3">
										<div class="col-lg-3 col-sm-12 col-md-3">
											<label for="" class="form-label">Block Seat<span class="asterisk"> *</span></label>
											<input type="text" class="form-control" name="no_of_person" id="no_of_person" required>
										</div>
										<div class="col-lg-4 col-sm-12 col-md-5">
											<label for="" class="form-label">Upload File<span class="asterisk"> </span></label>
											<input type="file" class="form-control" name="supporting_doc" id="supporting_doc">
										</div>
										<div class="col-lg-7 col-sm-12 col-md-8">
											<label for="remarks" class="form-label">Remarks<span class="asterisk"> *</span></label>
											<textarea type="text" class="form-control" id="remarks" name="remarks" required></textarea>
										</div>
										<div class="col-12">
											<input type="hidden" id="available_qty" value="'.$foundSlot['available_qty'].'" readonly>
											<button type="button" class="btn app-btn-primary" id="block_form_submit_btn">SUBMIT</button>
											<a class="btn app-btn-danger" href="">CANCEL</a>
										</div>
									</div>
								</div>
							</div>';
				}
				
				$response = array("status"=> true, "list"=>$data_list, "html" => $html);
			}
			else{
				$response = array("status"=> false, "list"=>$data_list);
			}
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
		$response = [];
		
		if($this->input->post()){
			$this->form_validation->set_rules('safari_type_id','Safari Type','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('division_id','Park','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('safari_service_header_id','Safari', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('period_slot_dtl_id','Slot','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('block_date','Block Date','trim|required');
			$this->form_validation->set_rules('no_of_person','No. of Person','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('remarks','Remarks','trim|required');
			
			if($this->form_validation->run()==FALSE){
				$response = array(
					'success' => FALSE,
					'message' => validation_errors(),
				);
			}
			else {
				
				$safari_type_id = $this->input->post('safari_type_id');
				$division_id = $this->input->post('division_id');
				$safari_service_header_id = $this->input->post('safari_service_header_id');
				$service_period_master_id = $this->input->post('service_period_master_id');
				$period_slot_dtl_id = $this->input->post('period_slot_dtl_id');
				$block_date = $this->input->post('block_date');
				$safari_cat_id = $this->input->post('safari_cat_id') != '' ? $this->input->post('safari_cat_id') : 1;
				$no_of_person = $this->input->post('no_of_person');
				$status_flag = $this->input->post('status_flag');
				$remarks = $this->input->post('remarks');
				
				$supporting_doc_res = NULL;
				if (!empty($_FILES['supporting_doc']['name'])) {
					$supporting_doc_res = $this->uploadImages('supporting_doc');
				}
				
				$safariSlots = $this->msafari_booking->get_booking_slot_list($safari_type_id, $division_id, $safari_service_header_id, $block_date, $safari_cat_id);
				
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
							'supporting_doc' => !is_null($supporting_doc_res) && $supporting_doc_res['status'] ? $supporting_doc_res['img_path'] : NULL,
							'status_flag' => 1,
							'created_by' => $this->admin_session_data['user_id'],
							'created_ts' => date('Y-m-d H:i:s')
						);
						
						//echo '<pre>'; print_r($data); die;
						
						$result = $this->mcommon->insert('safari_sdervice_blocked', $data);
							
						if ($result) {
							$response = array(
								'success' => TRUE,
								'message' => 'Safari Seat Blocked Successfully.',
								'redirect' => base_url('admin/safari_booking/block')
							);
						}
						
					}
					else {
						$response = array(
							'success' => FALSE,
							'message' => 'Sorry Maximum Seat Available '.$foundSlot['available_qty']
						);
					}
				}
			}
		}
		echo json_encode($response); exit;
	}
	public function blockRevoke()
	{
		$response = [];
		$row = [];
		if($this->input->post()){
			$blocked_id = decode_url($this->input->post('blocked_id'));
			if(is_numeric($blocked_id) && $blocked_id > 0){
				$row = $this->mcommon->getRow('safari_sdervice_blocked', array('blocked_id' => $blocked_id));
				if(!empty($row)){
					$data = array(
						'blocked_id'=> $row['blocked_id'],
						'archive_date' => date('Y-m-d H:i:s'),
						'archived_by' => $this->admin_session_data['user_id'],
						'division_id'=> $row['division_id'],
						'safari_type_id'=> $row['safari_type_id'],
						'safari_service_header_id'=> $row['safari_service_header_id'],
						'period_slot_dtl_id'=> $row['period_slot_dtl_id'],
						'no_of_person'=> $row['no_of_person'],
						'block_date'=> $row['block_date'],
						'remarks'=> $row['remarks'],
						'supporting_doc' => $row['supporting_doc'],
						'created_by' => $row['created_by'],
						'created_ts' => $row['created_ts']
					);
		
					$result = $this->mcommon->insert('safari_sdervice_blocked_archive', $data);
					//echo $this->db->last_query(); die;
				}
				
				if($result){
					$this->mcommon->delete('safari_sdervice_blocked', array('blocked_id' => $blocked_id));
						
					$response = array(
						'success' => TRUE,
						'message' => 'Safari Revoked Successfully.',
						'redirect' => base_url('admin/safari_booking/block/'.encode_url($row['safari_type_id']).'/'.encode_url($row['division_id']).'/'.encode_url($row['safari_service_header_id']).'/'.encode_url($row['block_date']).'/'.encode_url($row['period_slot_dtl_id']))
					);
				}
				else {
					$response = array(
						'success' => FALSE,
						'message' => 'Opps!! Something went wrong.'
					);
				}
			}
		}
		echo json_encode($response); exit;
	}
	function uploadImages($fieldName) {
		
		$dir = 'block_doc';

		$config['upload_path']          = './public/admin_images/' . $dir;
		$config['allowed_types']        = '*';
		$config['max_size']             = 5000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);
		
		$img_ret = array();

		if ($this->upload->do_upload($fieldName)) {
			$upload_data = $this->upload->data();
			$image_path = $dir . '/' . $upload_data['file_name'];
			
			$img_ret = array('status' => true, 'img_path' => $image_path);
		} else {
			$img_ret = array('status' => false, 'error' => $this->upload->display_errors());
		}
		
		return $img_ret;
	}


}
