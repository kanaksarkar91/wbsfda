<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') {
			$this->load->model(array('mcommon', 'frontend/query', 'admin/mbooking'));
		} else {
			redirect(base_url());
		}

		$this->load->helper(array('sms', 'email', 'crypto', 'otp'));
	}

	public function myProfile()
	{
		$data = array();
		$data['customer_details'] = $this->mcommon->getRow('customer_master', array('customer_id' => $this->session->userdata('customer_id')));
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		// echo "<pre>";
		// print_r($data);
		// die;
		$data['content'] = 'frontend/myProfile';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function myBooking($value1 = null)
	{
		$type = !is_null($value1) ? strtoupper($this->encryption->decrypt(base64_decode($value1))) : '';

		$data = array();

		$condn = array('customer_id' => $this->session->userdata('customer_id'), "booking_status NOT IN('I','F')" => NULL);

		if (is_null($type) || $type == '' || $type == 'ALL')
			$condn = $condn;
		elseif ($type == 'UPCOMING')
			$condn = array_merge($condn, array('booking_header.check_in >=' => date('Y-m-d')));
		elseif ($type == 'PAST')
			$condn = array_merge($condn, array('booking_header.check_in <' => date('Y-m-d')));


		$data['customer_details'] = $this->mcommon->getRow('customer_master', array('customer_id' => $this->session->userdata('customer_id')));
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		$data['booking_details'] = $this->query->getBookingDetailsByUserIdNew($condn);

		$data['safariTypes'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1));
		//echo "<pre>"; print_r($data['booking_details']); die;
		$data['type'] = $type;
		$data['content'] = 'frontend/my_booking';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function getSafariBookingHtml()
	{
		$data_list = [];
		$html = '';
		$calcelButtonVisible = false;
		if ($this->input->post()) {
			$safari_type_id = $this->input->post('safari_type_id');
			$booking_type = $this->input->post('booking_type');
			if (is_numeric($safari_type_id) && $safari_type_id > 0) {
				$condn = array('a.customer_id' => $this->session->userdata('customer_id'), "booking_status NOT IN('I','F')" => NULL);

				if ($booking_type == '' || $booking_type == 'ALL')
					$condn = $condn;
				elseif ($booking_type == 'UPCOMING')
					$condn = array_merge($condn, array('a.booking_date >=' => date('Y-m-d')));
				elseif ($booking_type == 'PAST')
					$condn = array_merge($condn, array('a.booking_date <' => date('Y-m-d')));

				$condn = array_merge($condn, array('a.safari_type_id' => $safari_type_id));
				//echo $safari_type_id; die;
				$safari_booking_details = $this->query->getSafariBookingDetailsByUser($condn);

				if (!empty($safari_booking_details) && is_array($safari_booking_details)) {

					$html .= '<div class="tab-pane fade show active" id="pills-' . $safari_type_id . '" role="tabpanel" aria-labelledby="pills-' . $safari_type_id . '-tab" tabindex="0">
								<div class="dashboard-gravity-list mt-3">
                                    <ul class="p-0 row">';

					foreach ($safari_booking_details as $row) {
						$slotTiming = $row['slot_desc'] . ': ' . $row['start_time'] . ' to ' . $row['end_time'];
						$bookingStatus = ($row['booking_status'] == 'I') ? '<span class="badge bg-primary">Initiate</span>' : (($row['booking_status'] == 'A') ? '<span class="badge bg-success">Approved</span>' : (($row['booking_status'] == 'C') ? '<span class="badge bg-danger">Cancelled</span>' : ''));

						$date = $row['booking_date'];
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
							$calcelButtonVisible = true;
						}

						$html .= '<li class="pending-booking mb-3 col-12 col-lg-6 py-0 border-0">
                                            <div class="list-box-listing bookings border p-3 rounded">
                                                <div class="list-box-listing-content">
                                                    <div class="inner">
                                                        <h3>' . $row['service_definition'] . '&nbsp;&nbsp;' . $bookingStatus . '</h3>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Booking No.:</span><span>' . $row['booking_number'] . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Safari Date:</span><span>' . date('d/m/Y', strtotime($row['booking_date'])) . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Slot Time:</span><span>' . $slotTiming . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Reporting Time:</span><span>' . $row['reporting_time'] . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Reporting Place:</span><span>' . $row['reporting_place'] . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">No. of Visitor:</span><span>' . $row['no_of_person'] . '</span>
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Price:</span><span>₹ ' . formatIndianCurrency($row['total_price']) . '</span>
                                                        </div>
                                                        <div class="mt-3">';
						if ($row['booking_status'] == 'A' && $calcelButtonVisible) {
							$html .= '<a class="btn btn-sm btn-danger" href="' . base_url('view-safari-booking-invoice/' . encode_url($row['booking_id'])) . '/?type=cancel' . '" target="_blank">Cancel Safari</a>';
						}
						
						$html .= '&nbsp;&nbsp;<a class="btn btn-dark btn-sm" href="' . base_url('view-safari-booking-invoice/' . encode_url($row['booking_id'])) . '" target="_blank">View Details</a>';
						
						if($row['booking_status'] != 'C'){
							$html .= '&nbsp;&nbsp;<a class="btn btn-success btn-sm" href="' . base_url('download-safari-booking-invoice/' . encode_url($row['booking_id'])) . '" target="_blank"><i class="fa fa-download"></i> Download</a>';
						}
                                                       $html .= '</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>';
					}

					$html .= '</ul>
                                </div>
							</div>';

					$response = array("status" => true, "html" => $html, "safari_type_id" => $safari_type_id);
				} else {
					$response = array("status" => false, "html" => '<div class="tab-pane fade show active" id="pills-' . $safari_type_id . '" role="tabpanel" aria-labelledby="pills-' . $safari_type_id . '-tab" tabindex="0">No Booking Found!!</div>', "safari_type_id" => $safari_type_id);
				}
			}
			echo json_encode($response);
			exit;
		}
	}

	public function bookingList()
	{
		$type = $this->input->post('type');

		$response = '';

		if (!empty($booking_details)) {
			foreach ($booking_details as $bd) {
				$response .= '<li class="pending-booking mb-3 col-12 col-lg-6 py-0 border-0"><div class="list-box-listing bookings border p-3 rounded"><div class="list-box-listing-content"><div class="inner"><h3>' . $bd['property_name'] . '"<span class=\"booking-status pending\">' . (($bd['booking_status'] == 'I') ? 'Initiate' : (($bd['booking_status'] == 'A') ? 'Approved' : (($bd['booking_status'] == 'C') ? 'Cancelled' : 'Check out'))) . '</span></h3><div class="inner-booking-list"><h5>Booking Date:</h5><ul class="booking-list"><li class="highlighted">' . date('d-m-Y', strtotime($bd['check_in'])) . ' to ' . date('d-m-Y', strtotime($bd['check_out'])) . '</li></ul></div><div class="inner-booking-list"><h5>Price:</h5><ul class="booking-list"><li class="highlighted">₹ ' . $bd['net_payable_amount'] . '</li></ul></div><div class="mt-3">' . (($bd['booking_status'] == 'I' || $bd['booking_status'] == 'A') ? ('<a class="btn btn-sm btn-danger" href="' . base_url('view-invoice/' . $bd['booking_id']) . '">Cancel Booking</a>') : '') . '<a class="btn btn-sm btn-primary" href="' . base_url('view-invoice/' . $bd['booking_id']) . '" target="_blank">View Details</a><a class="btn btn-sm btn-success" href="' . base_url('download-invoice/' . $bd['booking_id']) . '" target="_blank"><i class="fa fa-download"> Download</i></a>' . (($bd['booking_status'] == 'O') ? ('<button type="button" class="btn btn-sm btn-info feed_back" data-booking_id="' .  $bd['booking_id'] . '">Provide Feedback</button>') : '') . '</div></div></div></div></li>';
			}
		}

		echo json_encode($response);
	}


	public function booking_acknoledgement($booking_id)
	{
		//$this->load->library('pdf');

		$data = array();
		$where = array();
		$booking_id = decode_url($booking_id);


		$where['vb.user_id'] = $this->session->userdata('customer_id');
		$where['vb.booking_id'] = $booking_id;

		$data['booking_details'] = $this->query->getVenueBookings($where);

		//echo "<pre>"; print_r($data['booking_details']); die;

		$this->load->view('frontend/viewAcknowledgement', $data);
	}

	public function booking_invoice($booking_id)
	{

		$data = array();
		$booking_id = decode_url($booking_id);


		$data['booking_slip'] = $this->query->get_approval_letter($booking_id);
		$data['booking_slip_details'] = $this->query->get_booking_slip_details($booking_id);

		if (!empty($data['booking_slip']['payment_id']) || ($data['booking_slip']['payment_id'] != null)) {
			$data['payment_details_online'] = $this->query->get_payment_details_online($booking_id);
		} else {
			$data['payment_details_online'] = array();
		}

		//echo "<pre>"; print_r($data['payment_details_online']); die;

		$this->load->view('frontend/viewfinalInvoice', $data);
	}

	public function viewInvoice($booking_id)
	{
		$data = array();
		$booking_id = decode_url($booking_id);
		$data['booking_header'] = $this->query->getBookingHeader($booking_id);
		if ($data['booking_header']['booking_status'] == 'A') {
			if ($data['booking_header']['created_user_type'] == 'C') {
				$data['Initiated_by'] = $this->query->getCustomerData($data['booking_header']['created_by']);
			} else if ($data['booking_header']['created_user_type'] == 'U') {
				$data['Initiated_by'] = $this->query->getUserData($data['booking_header']['created_by']);
			}
		}
		$data['customer_details'] = $this->query->getBookingDetailsOfCustomer($booking_id);
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		$data['booking_details'] = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $booking_id));
		//$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id, 'status' => 'Success'));
		$data['booking_payment_listings'] = $this->mbooking->get_booking_payment_details($booking_id);
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);

		$check_in_date = date_create($data['booking_header']['check_in']);
		$current_date = date_create(date('Y-m-d'));
		//print_r($current_date);die;
		$diff_check_in_out = date_diff($current_date, $check_in_date);
		$diff_check_in_out_date = $diff_check_in_out->format("%R%a");
		//echo $diff_check_in_out_date;die;
		$data['cancellation_details'] = $this->query->getCancellationDetails($diff_check_in_out_date);
		$data['cancellation_request_details'] = $this->query->getCancellationRequestDetails($booking_id, 'G');
		//echo '<pre>';print_r($data['booking_details']);die;  
		// $data['content'] = 'frontend/viewInvoiceNew';
		$this->load->view('frontend/viewInvoiceNew', $data);
	}

	public function viewSafariInvoice($booking_id)
	{
		$data = [];
		$data['safariRoutes'] = [];
		$booking_id = decode_url($booking_id);
		$data['calcelButtonVisible'] = false;

		$condn = array('booking_id' => $booking_id);

		$data['sBooking'] = $this->query->getSafariBookingDetailsByUser($condn);
		$data['sBookingDetail'] = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_free' => 2]);
		$data['sBookingChildDetail'] = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_free' => 1]);
		$data['sBookingPayment'] = $this->mcommon->getRow('safari_booking_payment', ['booking_id' => $booking_id, 'status' => 'Captured']);

		$date = $data['sBooking'][0]['booking_date'];
		// Create DateTime object
		$dateObj = new DateTime($date);
		// Subtract one day
		$dateObj->modify('-1 day');
		// Get the modified date
		$cancelLastDate = $dateObj->format('Y-m-d');

		$dateTime = new DateTime($data['sBooking'][0]['start_time']);
		$closingTime = $dateTime->format('H:i');

		$cancelationLastDateTime = $cancelLastDate . ' ' . $closingTime;
		$currentDateTime = date('Y-m-d H:i');
		if ($cancelationLastDateTime > $currentDateTime) {
			$data['calcelButtonVisible'] = true;
		}

		//echo $cancelationLastDateTime; die;

		$data['cancellation_details'] = get_cancellation_percentage($data['sBooking'][0]['booking_date']);
		$data['visitorDetail'] = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id]);
		
		$visitorAgesdata = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_status' => 1]);
		if(!empty($visitorAgesdata)){
			foreach($visitorAgesdata as $vrow){
				$ages[] = $vrow['visitor_age'];
			}
			$data['visitorAges'] = implode(',', $ages);
		}
		//echo $data['visitorAges'];die;

		$data['cancel_percent'] = 100;
		$data['cancel_charge'] = $data['sBooking'][0]['base_price'];
		$data['refund_amt'] = 0;

		if (!empty($data['cancellation_details'])) {
			$data['cancel_percent'] = $data['cancellation_details']['cancellation_per'];
			$data['cancel_charge'] = intval((($data['sBooking'][0]['base_price'] * $data['cancellation_details']['cancellation_per']) / 100) * 100) / 100;
			$data['refund_amt'] = intval(($data['sBooking'][0]['base_price'] - $data['cancel_charge']) * 100) / 100;
		}

		$data['cancellation_request_details'] = $this->query->getCancellationRequestDetails($booking_id, 'S');

		/*$data['periodMasterData'] = $this->mcommon->getDetailsOrder('safari_service_period_master', ['is_active' => 1], 'service_period_master_id', 'ASC');
		
		if(!empty($data['periodMasterData'])){
			foreach($data['periodMasterData'] as $prow){
				$routeDetails = $this->query->route_details(['a.service_period_master_id' => $prow['service_period_master_id'], 'a.is_active' => 1]);
				
				if(!empty($routeDetails)){
					$data['safariRoutes'][$prow['service_period_master_id']] = $routeDetails;
				}
			}
		}*/

		//echo '<pre>';print_r($data['safariRoutes']);die;

		$this->load->view('frontend/viewSafariBookingInvoice', $data);
	}

	public function downloadInvoice($booking_id)
	{
		// echo "We are working on it. When it's completed then you can use this functionality. Thanks !";exit();
		$this->load->library('pdf');
		$data = array();
		$booking_id = decode_url($booking_id);
		$data['booking_header'] = $this->query->getBookingHeader($booking_id);
		if ($data['booking_header']['booking_status'] == 'A') {
			if ($data['booking_header']['created_user_type'] == 'C') {
				$data['Initiated_by'] = $this->query->getCustomerData($data['booking_header']['created_by']);
			} else if ($data['booking_header']['created_user_type'] == 'A') {
				$data['Initiated_by'] = $this->query->getUserData($data['booking_header']['created_by']);
			}
		}
		$data['customer_details'] = $this->query->getBookingDetailsOfCustomer($booking_id);
		$data['countries'] = $this->mcommon->getDetails('country_master', array());
		$data['booking_details'] = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $booking_id));
		$data['booking_payment_listing'] = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id, 'status' => 'Success'));
		$data['property_details'] = $this->query->getPropertyDetails($booking_id);
		$data['primary_guest_details'] = $this->query->getguestDetails($booking_id);
		$data['gst_details'] = $this->query->getGstDetails($booking_id);

		//echo '<pre>';print_r($data['gst_details']);die;

		$data['content'] = 'frontend/downloadInvoice';
		$filename = 'booking-' . time() . '-' . $booking_id;
		$html = $this->load->view('frontend/downloadInvoiceNew', $data, true);
		// $this->pdf->create($html, $filename);
		// echo $html;die;

		$this->pdf->loadHtml($html);
		$this->pdf->set_paper("A4", "landscape");
		$this->pdf->render();

		$this->pdf->stream("" . $filename . ".pdf", array("Attachment" => 0));
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

	public function getstate()
	{
		$data = array();
		$data = $this->mcommon->getDetails('state_master', array('is_active' => 1, 'country_id' => $this->input->post('country_id')));
		echo json_encode($data);
	}

	public function updateProfile()
	{
		//echo "<pre>"; print_r($this->input->post()); die();
		if ($this->input->post()) {
			$this->form_validation->set_rules('first_name', 'Full Name', 'trim|required');
			//$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('age', 'Age', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
			$this->form_validation->set_rules('state_id', 'State', 'trim|required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'trim|required|numeric|min_length[6]|max_length[6]');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("my-profile");
			} else {

				$splitName = explode(' ', $this->input->post('first_name'));

				$data = array(
					'first_name' => ucwords($this->input->post('first_name')),
					'gender' => $this->input->post('gender'),
					'age' => $this->input->post('age'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'country_id' => $this->input->post('country_id'),
					'state_id' => $this->input->post('state_id'),
					'pincode' => $this->input->post('pincode'),
					'updated_ts' => date('Y-m-d H:i:s')
				);

				if (!empty($_FILES['profile_pic']['name'])) {
					$profile_pic = $this->uploadImages('profile_pic', 'customer_images');
					if (isset($profile_pic['img_path']) && !empty($profile_pic['img_path'])) {
						$data['profile_pic'] = $profile_pic['img_path'];
					}
				}
				//echo $this->session->userdata('mobile'); die();
				$this->mcommon->update('customer_master', array('customer_id' => $this->session->userdata('customer_id')), $data);

				$session_data = $this->mcommon->getRow('customer_master', array('customer_id' => $this->session->userdata('customer_id')));
				$this->session->set_userdata($session_data);

				$this->session->set_flashdata('success_msg', 'Profile has been updated.');
				redirect(base_url('my-profile'));
			}
		}
	}


	function uploadImages($fieldName, $folder_name)
	{


		$config['upload_path']          = './public/' . $folder_name;
		$config['allowed_types']        = 'jpg|jpeg|png';
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

	public function cancel_booking()
	{

		$booking_id = $this->input->post('booking_id');

		$cancel_request_details = $this->db->from('cancel_request_tbl')->where('booking_id', $booking_id)->order_by('cancel_request_id', 'DESC')->limit(1)->get()->row_array();
		if (!empty($cancel_request_details)) {
			$return_data = array('status' => false, 'msg' => 'Booking Already Cancelled');
			echo json_encode($return_data);
			die;
		}


		$result_decoded = array();
		$cancel_request_data = array();
		$booking_payment_details = $this->db->from('booking_payment')->where('booking_id', $booking_id)->order_by('booking_payment_id', 'DESC')->limit(1)->get()->row_array();
		$booking_det = $this->query->get_booking_detail($booking_id);
		$propertyIpsData = $this->mcommon->getRow('property_master', array('property_id' => $booking_det['property_id']));

		if (!empty($booking_payment_details)) {

			$working_key = $propertyIpsData['WORKING_KEY'];
			$access_code = $propertyIpsData['ACCESS_CODE'];
			$refund_refe_no = substr(hash('sha256', rand_string(6) . microtime()), 0, 20);

			try {

				if ($this->input->post('refund_amt') > 0) {

					$merchant_json_data =
						array(
							'reference_no' => $booking_payment_details['transaction_ref_id'],
							'refund_amount' => $this->input->post('refund_amt'),
							'refund_ref_no' => $refund_refe_no,
						);

					$merchant_data = json_encode($merchant_json_data);
					$encrypted_data = encrypt($merchant_data, $working_key);
					$final_data = 'enc_request=' . $encrypted_data . '&access_code=' . $access_code . '&command=refundOrder&request_type=JSON&response_type=JSON';


					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $propertyIpsData['API_BASE_URL']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type: application/json');
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

					$result_decoded = json_decode($status, true);

					//$result_decoded['Refund_Order_Result']['refund_status'] == 0 for success

				}


				if (!empty($result_decoded) && $result_decoded['Refund_Order_Result']['refund_status'] == 0) {

					$this->db->trans_start(); # Starting Transaction

					$cancel_remarks = $this->input->post('cancel_remarks');
					$cancel_gst_percent = 5;
					$cancel_request_data = array(
						'booking_id' => $booking_id,
						'net_payble_amount' => $this->input->post('paid_amount'),
						'paid_amount' => $this->input->post('paid_amount'),
						'cancel_percent' => $this->input->post('cancel_percent'),
						'cancel_charge' => $this->input->post('cancel_charge'),
						'cancel_gst_percent' => $cancel_gst_percent,
						'cancel_gst' => number_format(($this->input->post('cancel_charge') * $cancel_gst_percent) / 100, 2, ".", ""),
						'refund_amt' => $this->input->post('refund_amt'),
						'refunded_amount' => $this->input->post('refund_amt'),
						'cancel_type' => 'F',
						'refunded_amount' => $this->input->post('refund_amt'),
						'created_by' => $this->session->userdata('customer_id'),
						'created_user_type' => 'C',
						'created_ts' => date('Y-m-d H:i:s'),
						'is_refunded' => ($result_decoded['Refund_Order_Result']['refund_status'] == 0) ? 1 : 0,
						'cancel_refund_request_id' => $refund_refe_no,
						'cancel_request_response' => json_encode($result_decoded)

					);

					$this->db->insert('cancel_request_tbl', $cancel_request_data);
					//echo $this->db->last_query();
					$this->db->update('booking_header', array('booking_status' => 'C', 'is_refunded' => $cancel_request_data['is_refunded'], 'cancellation_remarks' => $cancel_remarks, 'updated_by' => $this->session->userdata('customer_id'), 'updated_user_type' => 'C', 'updated_ts' => date('Y-m-d H:i:s')), array('booking_id' => $booking_id));
					//echo $this->db->last_query();die;
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

						$refund_perc = (100 - $this->input->post('cancel_percent'));

						$config = email_config();
						$email_from = $config['email_from'];
						unset($config['email_from']);

						$subject = 'Booking ID  ' . $booking_det['booking_no'] . ' has been cancelled.';

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
                                    <h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px; color: #00bdd6;">Email for cancellation initiated by the concerned party</h2>
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
                                            We have received your cancellation application for booking number ' . $booking_det['booking_no'] . ' and it has been accepted. ' . $refund_perc . '% of the booking amount (excluding GST) will be refunded within 15 days and will be credited to the concerned bank account through which payment has been made at the time of booking. For any further query please get in touch with us at (033) 23376469.
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
                            <span>© ' . date('Y') . ' The State Fisheries Development Corporation Limited<br>  (Government of West Bengal Undertaking).All right reserved.
                            </span>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
    </center>
</body>';

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

						$refundPer = $refund_perc . '%';
						payment_cancelled($booking_det['mobile'], $booking_det['booking_no'], $refundPer);

						$return_data = array('status' => true, 'msg' => 'Booking has been cancelled successfully');
					}
				} else {

					throw new Exception($result_decoded['Refund_Order_Result']['reason']);
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

	public function cancelSafariBooking()
	{
		//echo "<pre>"; print_r($this->input->post()); die;
		$furtherProceed = false;
		$booking_id = decode_url($this->input->post('booking_id'));
		$safari_booking_detail_ids = $this->input->post('safari_booking_detail_ids');
		$visitor_ages = $this->input->post('visitor_ages');

		if (is_numeric($booking_id) && $booking_id > 0 && !empty($safari_booking_detail_ids) && !empty($visitor_ages)) {
			$bookingData = $this->mcommon->getRow('safari_booking_header', ['booking_id' => $booking_id]);
			if ($this->session->userdata('customer_id') == $bookingData['customer_id']) {

				$visitorsData = $this->mcommon->getDetails('safari_booking_detail', ['booking_id' => $booking_id, 'is_status' => 1]);
				if(!empty($visitorsData)){
					foreach($visitorsData as $vrow){
						$ages[] = $vrow['visitor_age'];
					}
				}
				
				if(count($ages) != count($this->input->post('visitor_ages'))){
					
					//$newArray = array_diff($ages, $this->input->post('visitor_ages'));
					
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
							$cancel_percent = $cancellationDetails['cancel_percent'];
							$cancel_charge = $cancellationDetails['cancel_charge'];
							$refund_amt = $cancellationDetails['refund_amt'];
						}
						
						//echo $cancel_percent.'<br>'.$cancel_charge.'<br>'.$refund_amt; die;

						if ($refund_amt > 0) {
							
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
								'created_by' => $this->session->userdata('customer_id'),
								'created_user_type' => 'C',
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
							$this->db->update('safari_booking_header', array('no_of_person' => $no_of_person, 'booking_status' => $booking_status, 'is_refunded' => $cancel_request_data['is_refunded'], 'cancellation_remarks' => $cancel_remarks, 'updated_by' => $this->session->userdata('customer_id'), 'updated_ts' => date('Y-m-d H:i:s')), array('booking_id' => $booking_id));
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

	}

	public function submit_feedback()
	{
		$provide_feedback = $this->input->post('provide_feedback');
		$booking_id = $this->input->post('booking_id');
		$data = array(
			'booking_id' => $booking_id,
			'provide_feedback' => $provide_feedback,
			'created_by' => $this->session->userdata('customer_id'),
			'created_ts' => date('Y-m-d H:i:s')
		);
		// Upload folder location***
		$config['upload_path'] = './public/feedback_images';
		// Allowed file type***
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;
		// load upload library***            
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('feedback_image')) {
			$data['feedback_image'] = $this->upload->data()['file_name'];
		}

		$result = $this->mcommon->insert('user_feedback', $data);

		if ($result) {
			$this->session->set_flashdata('success_msg', 'Thanks for your feedback');
			redirect(base_url('my-booking'));
		}
	}
}
