<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "third_party/razorpay-php/Razorpay.php";

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Booking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'frontend/query', 'frontend/mbooking', 'admin/mcancellationpolicy'));
		$this->load->helper(array('sms', 'email', 'common_helper', 'crypto', 'otp', 'gst'));
	}

	public function property()
	{
		$data = array();
		$data['districts'] = $this->mbooking->get_property_districts(array('is_active' => 1, 'district_id <>' => 21));
		$data['terrains'] = $this->mbooking->get_property_terrains(array('is_active' => 1));
		$data['landscape_properties'] = $this->mbooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1));
		$data['property_types'] = $this->mbooking->get_property_types(array('is_active' => 1, 'is_hall' => 0));
		$data['content'] = 'frontend/booking/booking_property';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function hall()
	{
		$data = array();
		$data['districts'] = $this->mbooking->get_property_districts(array('is_active' => 1, 'district_id <>' => 21));
		$data['terrains'] = $this->mbooking->get_property_terrains(array('is_active' => 1));
		$data['landscape_properties'] = $this->mbooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1));
		$data['property_types'] = $this->mbooking->get_property_types(array('is_active' => 1, 'is_hall' => 1));
		$data['content'] = 'frontend/booking/booking_hall';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function search()
	{
		$search_keywords = $this->input->get('wish') != '' ? $this->input->get('wish') : NULL;
		$landscape = $this->input->get('landscape') != '' ? $this->input->get('landscape') : NULL;
		// $district = $this->input->get('district') != '' ? $this->input->get('district') : NULL;
		// $property_type = $this->input->get('type') != '' ? $this->input->get('type') : NULL;
		// $destination = $this->input->get('destination') != '' ? $this->input->get('destination') : NULL;
		$check_in_dt = $this->input->get('checkindt') != '' ? $this->input->get('checkindt') : NULL;
		$_check_out_dt = $this->input->get('checkoutdt') != '' ? $this->input->get('checkoutdt') : NULL;
		$nationality = $this->input->get('nationality') != '' ? $this->input->get('nationality') : NULL;
		// $adult_pax = $this->input->get('adults') != '' ? $this->input->get('adults') : NULL;
		// $child_pax = $this->input->get('children') != '' ? $this->input->get('children') : NULL;

		$__check_in_dt = date('Y-m-d', strtotime(substr($check_in_dt, 4) . '-' . substr($check_in_dt, 2, -4) . '-' . substr($check_in_dt, 0, -6)));
		$__check_out_dt = date('Y-m-d', strtotime(substr($_check_out_dt, 4) . '-' . substr($_check_out_dt, 2, -4) . '-' . substr($_check_out_dt, 0, -6)));
		$checkOutDt = date('Y-m-d', strtotime($__check_in_dt . ' +1 day'));
		$__checkOutDt = date('dmY', strtotime($checkOutDt));

		$check_out_dt = ($__check_out_dt <= $__check_in_dt) ? $__checkOutDt : $_check_out_dt;


		if (in_array($property_type, array(7, 8, 9, 14))) {
			$adult_pax = 5000;
		}

		//$stay_date_range_arr = explode(' - ', $stay_date_range);
		$from_date = $check_in_dt != '' ? date('d/m/Y', strtotime(substr($check_in_dt, 4) . '-' . substr($check_in_dt, 2, -4) . '-' . substr($check_in_dt, 0, -6))) : '';
		$to_date = $check_out_dt != '' ? date('d/m/Y', strtotime(substr($check_out_dt, 4) . '-' . substr($check_out_dt, 2, -4) . '-' . substr($check_out_dt, 0, -6))) : '';

		$data = array(
			'search_keywords' => $search_keywords,
			'landscape' => $landscape,
			// 'district' => $district,
			// 'property_type' => $property_type,
			// 'destination' => $destination,
			'checkin' => $check_in_dt,
			'checkout' => $check_out_dt,
			'from_date' => $from_date,
			'to_date' => $to_date,
			// 'adult_pax' => $adult_pax,
			// 'child_pax' => $child_pax,
			'nationality' => $nationality
		);

		$data['terrains'] = $this->mbooking->get_property_terrains(array('is_active' => 1, 'is_safari' => 2));
		$data['districts'] = $this->mbooking->get_property_districts(array('is_active' => 1));
		$data['property_types'] = $this->mbooking->get_property_types(array('is_active' => 1));
		$data['facilities'] = $this->mbooking->get_property_facilities(array('facility_type' => 'P', 'status' => 1));
		$data['landscape'] = $landscape;
		// echo "<pre>";
		// print_r($data);
		// die;
		$data['content'] = 'frontend/booking/search';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function searchProcess()
	{
		// echo "<pre>";
		// print_r($_POST);
		// die;
		$search_type = $this->input->post('type') != '' ? $this->input->post('type') : '';
		$keywords = $this->input->post('keywords') != '' ? $this->input->post('keywords') : '';
		$landscape = $this->input->post('landscape') != '' ? $this->input->post('landscape') : '';
		$nationality = $this->input->post('nationality') != '' ? $this->input->post('nationality') : '';
		//$property_type_id = $this->input->post('property_type') != '' ? $this->input->post('property_type') : '0';
		$search_string = $this->input->post('search_string') != '' ? $this->input->post('search_string') : '';
		//$from_date = $this->input->post('from_date');
		//$to_date = $this->input->post('to_date');
		$stay_date_range = $this->input->post('date_range') != '' ? $this->input->post('date_range') : '';
		$adult_pax = $this->input->post('adult_pax') != '' ? $this->input->post('adult_pax') : '0';
		$child_pax = $this->input->post('child_pax') != '' ? $this->input->post('child_pax') : '0';
		$property_district = $this->input->post('property_district') != '' ? $this->input->post('property_district') : '0';
		$hotel_types = $this->input->post('property_type') != '' ? $this->input->post('property_type') : '';
		$facilities = $this->input->post('facilities') != '' ? $this->input->post('facilities') : '';
		$rate_category_id = $this->input->post('rate_category_id') != '' ? $this->input->post('rate_category_id') : '1';

		$response = array('success' => false,);

		if ($search_type == '1') {
			$property_type_id = $hotel_types != '' ? $hotel_types : '';
			$landscape = $landscape != '' ? $landscape : 0;
			$property_district = $property_district != '' ? $property_district : 0;

			$properties = $this->mbooking->get_property_details_for_listing($hotel_types, $landscape, $property_district, $keywords, $facilities);

			$response = array('success' => true, 'check_in_dt' => '', 'check_out_dt' => '', 'adult' => '', 'child' => '', 'result' => $properties, 'nationality' => '');
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

			// echo $search_string . '<br>' . $from_date . '<br>' . $to_date . '<br>' . $adult_pax . '<br>' . $child_pax . '<br>' . $property_district . '<br>' . $hotel_types . '<br>' . $facilities . '<br>' . $landscape;
			// die;

			$properties = $this->mbooking->get_booking_property_list($search_string, $from_date, $to_date, $adult_pax, $child_pax, $property_district, $hotel_types, $facilities, 1, $landscape);

			/*$properties = array();
			
			foreach ($properties_arr as $p) {
				var_dump($p);
				if ($p['is_active'] == '1' && $p['is_deleted'] == '0')
					array_push($properties, $p);
			}*/

			// echo "<pre>";
			// print_r($properties);
			// die;

			$response = array('success' => true, 'check_in_dt' => date('dmY', strtotime($from_date)), 'check_out_dt' => date('dmY', strtotime($to_date)), 'adult' => $adult_pax, 'child' => $child_pax, 'result' => $properties, 'nationality' => $nationality);
		}

		echo json_encode($response);
	}

	public function property_details($property_id, $checkIn_dt = null, $checkOut_dt = null, $adult_pax = null, $child_pax = null, $nationality = null)
	{
		$property_det = $this->mbooking->get_property_details(array('property_id' => $property_id));

		$check_in_dt = $checkIn_dt != '' ? date('Y-m-d', strtotime(substr($checkIn_dt, 4) . '-' . substr($checkIn_dt, 2, -4) . '-' . substr($checkIn_dt, 0, -6))) : date('Y-m-d', strtotime('+1 day'));
		$check_out_dt = $checkOut_dt != '' ? date('Y-m-d', strtotime(substr($checkOut_dt, 4) . '-' . substr($checkOut_dt, 2, -4) . '-' . substr($checkOut_dt, 0, -6))) : date('Y-m-d', strtotime('+2 days'));
		$adult_pax = $adult_pax != '' ? $adult_pax : 1;
		$child_pax = $child_pax != '' ? $child_pax : 0;

		if ($check_in_dt  >= date('Y-m-d') && $check_out_dt >= $check_in_dt) {
			//room availability check
			$this->load->model('admin/maccommodation');
			$startDate = $check_in_dt;
			$endDate = $check_out_dt;
			if ($startDate != '' && $endDate != '') {
				$startDt = strtotime($check_in_dt);
				$endDt = strtotime($check_out_dt);

				$rangArray = [];

				$i = 0;
				for ($currentDate = $startDt; $currentDate < $endDt; $currentDate += (86400)) {
					$rangArray[$i]['date'] = date('jS M Y', $currentDate);
					$rangArray[$i]['day'] = date('l', $currentDate);
					$i++;
				}


				$accomodation_availability = array();

				$accomms = $this->maccommodation->get_accommodation_list_property_id($property_id);
				// print_r($accomms); die;

				$i = 0;
				foreach ($accomms as $accomm) {
					$accomm_availibility = $this->maccommodation->get_property_accomm_availability($accomm["property_id"], $accomm["accommodation_id"], $startDate, $endDate);

					$accomodation_availability[$i]['accommodation'] = $accomm;
					$accomodation_availability[$i]['availability'] = $accomm_availibility;

					$i++;
				}

				// print_r($accomodation_availability); die;

				$html = '';
				if (isset($accomodation_availability)) {

					$html .= '<table class="table table-hover table-borderless table_custom" id="avs_table">
							<thead>
								<tr id="calhead2">
									<th align="center" valign="middle">Accommodation<br><small>Category</small></th>';
					if (isset($rangArray)) {
						foreach ($rangArray as $d) {
							$html .= '<th align="center" valign="middle">' . $d['date'] . '<br><small>' . $d['day'] . '</small></th>';
						}
					}
					$html .= '	</tr>
							</thead>
							<tbody id="list_tbl_body_id">';
					foreach ($accomodation_availability as $accomm) {
						$r = $accomm['accommodation'];
						$r1 = $accomm['availability'][0];
						if ($r['is_offline'] == 2) {
						} else {

							$html .= '<tr>
												<td align="center" valign="middle" class="roomtype"><a href="#">' . $r['accommodation_name'] . '</a>										</td>';
							foreach ($accomm['availability'] as $rr) {
								$endDate = date('Y-m-d', strtotime('+1 day', strtotime($rr['available_date'])));
								$accom_rate = $this->mbooking->get_booking_property_accommodation_availability($rr["property_id"], $rr["accommodation_id"], $rr['available_date'], $endDate, 0, 0, 1, 0);
								// print_r($accom_rate);

								$html .= '<td align="center" valign="middle">';
								if ($rr['available_room_cnt'] == 0) {
									$html .= '<p><a href="#" class="f12 label label-disable">Not Available</a></p>';
								} else {
									$html .= '<p><a href="#" class="f12 label label-success">Available: ' . $rr['available_room_cnt'] . ' </a></p><p>&#x20b9; ' . $accom_rate[0]['base_price'] . '</p>';
								}

								$html .= '</td>';
							}
							$html .= '</tr>';
						}
					}
					$html .= '</tbody>
						</table>';
				}
			}

			$data['available_html'] = $html;
			//end check room availability
			//echo $html; die;


			$data['rate_category_id'] = $rate_category_id = 1;

			$data['property'] = $property = $property_det[0];
			$data['facilities'] = $this->mbooking->get_property_facilities(array("facility_id IN(" . $property['facilities'] . ")" => NULL));

			//if (!is_null($checkIn_dt) && !is_null($checkOut_dt) && !is_null($adult_pax) && !is_null($child_pax)) {

			$data['accommodations'] = $accommodations = $this->mbooking->get_booking_property_accommodation_list($property_id, $check_in_dt, $check_out_dt, $adult_pax, $child_pax, $rate_category_id);
			//}

			//print_r($data['accommodations']); die;

			$this->session->unset_userdata('accommodation_cart');
			$this->session->unset_userdata('day_wise_rates_json');
			unset($_SESSION['coupon']['coupon_id']);

			$this->load->library('form_validation');

			//$this->form_validation->set_rules('dates', 'Stay Date', 'trim|required');
			$this->form_validation->set_rules('checkIn', 'Check-In Date', 'trim|required');
			$this->form_validation->set_rules('checkOut', 'Check-Out Date', 'trim|required');
			$this->form_validation->set_rules('adults', 'No. of Adult', 'trim|is_natural');
			$this->form_validation->set_rules('children', 'No. of Child', 'trim|is_natural');

			if ($this->form_validation->run()) {
				//$dates = $this->input->post('dates');
				$checkIn = $this->input->post('checkIn');
				$checkOut = $this->input->post('checkOut');
				$adults = $this->input->post('adults') != '' ? $this->input->post('adults') : 1;
				$children = $this->input->post('children') != '' ? $this->input->post('children') : 0;
				$nationality = $this->input->post('nationality');

				/*$stay_date_range_arr = explode(' - ', $dates);
				$form_date_arr = explode('/', $stay_date_range_arr[0]);
				$from_date = date('dmY', strtotime($form_date_arr[2] . '-' . $form_date_arr[1] . '-' . $form_date_arr[0]));
				$to_date_arr = explode('/', $stay_date_range_arr[1]);
				$to_date = date('dmY', strtotime($to_date_arr[2] . '-' . $to_date_arr[1] . '-' . $to_date_arr[0]));*/

				$form_date_arr = explode('/', $checkIn);
				$from_date = date('dmY', strtotime($form_date_arr[2] . '-' . $form_date_arr[1] . '-' . $form_date_arr[0]));
				$to_date_arr = explode('/', $checkOut);
				$to_date = date('dmY', strtotime($to_date_arr[2] . '-' . $to_date_arr[1] . '-' . $to_date_arr[0]));

				redirect(base_url('frontend/booking/property_details/' . $property_id . '/' . $from_date . '/' . $to_date . '/' . $adults . '/' . $children . '/' . $nationality));
			}

			$data['property_id'] = $property_id;
			$data['check_in_date'] = $check_in_dt != '' ? date('d/m/Y', strtotime($check_in_dt)) : '';
			$data['check_out_date'] = $check_out_dt != '' ? date('d/m/Y', strtotime($check_out_dt)) : '';
			$data['nationality'] = $nationality;
			$data['no_of_nights'] = $this->calculateBookingNights($check_in_dt, $check_out_dt);
			$data['adult_pax'] = $adult_pax;
			$data['child_pax'] = $child_pax;

			$youtube_url = $property['youtube_video_link'];
			$value = explode("v=", $youtube_url);
			$data['videoId'] = $value[1];

			// echo "<pre>";
			// print_r($data);
			// die;

			$data['content'] = 'frontend/booking/property_details';
			$this->load->view('frontend/layouts/index', $data);
		}
	}

	private function calculateBookingNights($checkInDate, $checkOutDate)
	{
		$checkInDt = date('Y-m-d', strtotime($checkInDate));
		$checkOutDt = date('Y-m-d', strtotime($checkOutDate));

		$checkInDtObj = new DateTime($checkInDt);
		$checkOutDtObj = new DateTime($checkOutDt);

		$checkInDtObj->format('Y-m-d');
		$checkOutDtObj->format('Y-m-d');
		$interval = $checkInDtObj->diff($checkOutDtObj);
		$no_of_nights = $interval->format('%a');

		return $no_of_nights;
	}

	public function accomodationAvailability()
	{
		$property_id = $this->input->post('property_id');
		$checkIn_dt = $this->input->post('checkIn_dt');
		$checkOut_dt = $this->input->post('checkOut_dt');
		$adult_pax = $this->input->post('adult_pax');
		$child_pax = $this->input->post('child_pax');
		$rate_category_id = $this->input->post('rate_category_id');

		$checkIn_dt_arr = explode('-', $checkIn_dt);
		$checkIn_dt = date('Y-m-d', strtotime($checkIn_dt_arr[2] . '-' . $checkIn_dt_arr[0] . '-' . $checkIn_dt_arr[1]));
		$checkOut_dt_arr = explode('-', $checkOut_dt);
		$checkOut_dt = date('Y-m-d', strtotime($checkOut_dt_arr[2] . '-' . $checkOut_dt_arr[0] . '-' . $checkOut_dt_arr[1]));

		$accommodation = $this->mbooking->get_booking_property_accommodation_list($property_id, $checkIn_dt, $checkOut_dt, $adult_pax, $child_pax, $rate_category_id);

		echo json_encode(array('success' => true, 'result' => $accommodation));
	}

	public function booking_cart()
	{
		$property_id = $this->input->post('property');
		$rate_category_id = $this->input->post('rate_category');
		$stay_dates = $this->input->post('stay_date');
		$adult = $this->input->post('adult');
		$child = $this->input->post('child');
		$room_id = $this->input->post('room');
		$room_count = $this->input->post('roomCount');
		$choose_extra_pax = $this->input->post('choose_extra_pax');
		$is_select_extra_bed = $this->input->post('is_select_extra_bed');

		$stay_dates_arr = explode('-', str_replace(' ', '', $stay_dates));
		$chceckInDt_arr = explode('/', $stay_dates_arr[0]);
		$checkIn_dt = date('Y-m-d', strtotime($chceckInDt_arr[2] . '-' . $chceckInDt_arr[1] . '-' . $chceckInDt_arr[0]));
		$checkOutDt_arr = explode('/', $stay_dates_arr[1]);
		$checkOut_dt = date('Y-m-d', strtotime($checkOutDt_arr[2] . '-' . $checkOutDt_arr[1] . '-' . $checkOutDt_arr[0]));

		$roomCode = 'room_id_' . strval($room_id);

		if (intval($room_count) > 0) {
			$accommodationById = $this->mbooking->get_property_accommodation(array('accommodation.accommodation_id' => $room_id, 'rate_category_id' => 1))->last_row();

			$accommodation_array = array($roomCode => array('property_id' => $accommodationById->property_id, 'accommodation_id' => $accommodationById->accommodation_id, 'quantity' => $room_count, 'base_price' => $accommodationById->base_price, 'is_select_extra_bed' => $is_select_extra_bed));

			// print_r($accommodation_array); die;

			if (!empty($_SESSION["accommodation_cart"])) {
				if (in_array($roomCode, $this->session->userdata('accommodation_cart'))) {
					foreach ($this->session->userdata('accommodation_cart') as $key => $value) {
						if ($roomCode == $key)
							$_SESSION["accommodation_cart"][$key]["quantity"] = $room_count;
					}
				} else {
					$_SESSION["accommodation_cart"] = array_merge($_SESSION["accommodation_cart"], $accommodation_array);
				}
			} else {
				$_SESSION["accommodation_cart"] = $accommodation_array;
			}
		} else {
			if (!empty($_SESSION["accommodation_cart"])) {
				foreach ($_SESSION["accommodation_cart"] as $k => $v) {
					if ($roomCode == $k)
						unset($_SESSION["accommodation_cart"][$k]);
					if (empty($_SESSION["accommodation_cart"]))
						unset($_SESSION["accommodation_cart"]);
				}
			}
		}

		$amounts = $this->calculateAmounts($property_id, $checkIn_dt, $checkOut_dt, $adult, $child, $rate_category_id);

		/*$total_extra_bed_price = 0;
		if($is_select_extra_bed == 1){
			$total_extra_bed_price = $amounts['total_extra_bed_price'];
		}*/

		echo json_encode(array('success' => true, 'amount' => ($amounts['total_amount'] + $amounts['total_extra_bed_price'])));
	}

	private function calculateAmounts($property_id, $checkInDt, $checkOutDt, $adultCount, $childCount, $rate_category_id, $percentage = '')
	{
		$total_amount = 0.00;
		$total_discount = 0.00;
		$total_gst_amount = 0.00;
		$grand_total = 0.00;

		if ($this->session->userdata('accommodation_cart') != '') {
			foreach ($this->session->userdata('accommodation_cart') as $k => $v) {
				$accommodation_id = $_SESSION["accommodation_cart"][$k]['accommodation_id'];
				$accomm_cost = $this->mbooking->get_booking_property_accommodation_availability($property_id, $accommodation_id, $checkInDt, $checkOutDt, $adultCount, $childCount, $rate_category_id, $percentage);
				//echo "<pre>"; print_r($accomm_cost); die;

				$_SESSION["accommodation_cart"][$k]["rate_id"] = $accomm_cost[0]["rate_id"];
				$_SESSION["accommodation_cart"][$k]["base_price"] = $accomm_cost[0]["base_price"];
				$_SESSION["accommodation_cart"][$k]["extra_bed_price"] = $accomm_cost[0]["extra_bed_price"];
				$_SESSION["accommodation_cart"][$k]["disc_amt_on_base"] = $accomm_cost[0]["disc_amt_on_base"];
				$_SESSION["accommodation_cart"][$k]["tax_amount_base_price"] = $accomm_cost[0]["tax_amount_base_price"];
				$_SESSION["accommodation_cart"][$k]["tax_amount_base_plus_extra"] = $accomm_cost[0]["tax_amount_base_plus_extra"];
				$_SESSION["accommodation_cart"][$k]["tax_name"] = $accomm_cost[0]["tax_name"];
				$_SESSION["accommodation_cart"][$k]["hsn_sac_code"] = $accomm_cost[0]["hsn_sac_code"];
				$_SESSION["accommodation_cart"][$k]["hsn_sac_id"] = $accomm_cost[0]["hsn_sac_id"];
				$_SESSION["accommodation_cart"][$k]["tax_id"] = $accomm_cost[0]["tax_id"];
				$_SESSION["accommodation_cart"][$k]["gst_percentage"] = $accomm_cost[0]["gst_percentage"];
				$_SESSION["accommodation_cart"][$k]["cgst_percentage"] = $accomm_cost[0]["cgst_percentage"];
				$_SESSION["accommodation_cart"][$k]["sgst_percentage"] = $accomm_cost[0]["sgst_percentage"];
				$_SESSION["accommodation_cart"][$k]["igst_percentage"] = $accomm_cost[0]["igst_percentage"];

				$base_price = (floatval($accomm_cost[0]['base_price_per_pax']) > 0 && 0) ? ($accomm_cost[0]['base_price_per_pax'] * $adultCount) : $accomm_cost[0]['base_price'];
				$base_discount = $accomm_cost[0]['disc_amt_on_base'];
				$gst_amount = $accomm_cost[0]['tax_amount_base_price'];
				$quantity = $_SESSION["accommodation_cart"][$k]['quantity'];

				$rates_json_arr = $accomm_cost[0]['day_wise_rates_json'];

				$total_amount += floatval($base_price) * $quantity;
				$total_discount += floatval($base_discount) * $quantity;
				$total_gst_amount += floatval($gst_amount) * $quantity;
			}
		}

		$gstPerc = getGstPercentage($total_amount);

		$gstAmt = ($gstPerc['gst_percentage'] * $total_amount) / 100;

		$grand_total = floatval($total_amount) + floatval($gstAmt);

		return array('total_amount' => round($total_amount), 'discount_amount' => round($total_discount), 'gst_amount' => round($gstAmt), 'grand_total' => round($grand_total));
	}

	private function calculateGstAmount($checkIn_dt, $checkOut_dt)
	{
		$gst_amount = 0.00;

		$no_of_nights = $this->calculateBookingNights($checkIn_dt, $checkOut_dt);

		$queryStrArr = array();

		$stayDate = date('Y-m-d', strtotime($checkIn_dt));

		for ($i = 1; $i <= $no_of_nights; $i++) {

			if ($this->session->userdata('accommodation_cart') != '') {
				foreach ($this->session->userdata('accommodation_cart') as $k => $v) {
					$base_price = $_SESSION["accommodation_cart"][$k]['base_price'];
					$quantity = $_SESSION["accommodation_cart"][$k]['quantity'];

					array_push($queryStrArr, '0|' . $stayDate . '|' . ($base_price * $quantity));
				}
			}

			$stayDate = date('Y-m-d', strtotime("+1 day", strtotime($stayDate)));
		}

		$queryStr = implode(',', $queryStrArr);
		$gst_amount_arr = $this->mbooking->get_booking_property_accommodation_gst($queryStr);

		//var_dump($gst_amount_arr);

		foreach ($gst_amount_arr as $gst) {
			$gst_amount += (($gst['booking_amount'] / 100) * $gst['gst_percentage']);
		}

		return $gst_amount;
	}

	public function init_booking()
	{
		$property_id = $this->input->post('property');
		$stay_dates = $this->input->post('stay_date');
		$adult_pax = $this->input->post('adult');
		$child_pax = $this->input->post('child');
		$rate_category_id = $this->input->post('rate_category');

		$response = array('success' => false);

		$adultCount = $childCount = 0;


		$_stay_dates = explode(' - ', $stay_dates);
		$checkIn_dt_arr = explode('/', $_stay_dates[0]);
		$checkInDt = date('Y-m-d', strtotime($checkIn_dt_arr[2] . '-' . $checkIn_dt_arr[1] . '-' . $checkIn_dt_arr[0]));
		$checkOut_dt_arr = explode('/', $_stay_dates[1]);
		$checkOutDt = date('Y-m-d', strtotime($checkOut_dt_arr[2] . '-' . $checkOut_dt_arr[1] . '-' . $checkOut_dt_arr[0]));

		// echo $checkInDt . '<br>' . $checkOutDt;
		// die;
		// print_r($_SESSION["accommodation_cart"]);
		// die;

		if (!empty($_SESSION["accommodation_cart"])) {
			foreach ($_SESSION["accommodation_cart"] as $key => $value) {
				$accommodationById = $this->mbooking->get_property_accommodation(array('accommodation.accommodation_id' => $_SESSION["accommodation_cart"][$key]['accommodation_id'], 'rate_category_id' => 1))->last_row();

				$adultCount += intval($accommodationById->adult);
				$childCount += intval($accommodationById->child);

				$totalPaxCount = ($adultCount + $childCount) * $_SESSION["accommodation_cart"][$key]['quantity'];
			}

			$total_pax = $adult_pax + $child_pax;

			if ($total_pax > $totalPaxCount) {
				$response = array('success' => false, 'msg' => 'Please select more rooms for all the guests.');
			}
			/*if ($adultCount < $adult_pax) {
				$response = array('success' => false, 'msg' => 'Please select more rooms for all the adults.');
			} elseif ($childCount < $child_pax) {
				$response = array('success' => false, 'msg' => 'Please select more rooms for all the children.');
			}*/ else {

				$request_data['property_id'] = $property_id;
				$request_data['check_in_date'] = $checkInDt;
				$request_data['check_out_date'] = $checkOutDt;
				$request_data['discount_perc'] = 0;

				$search_room_data = $this->mbooking->search_room($request_data);

				foreach ($search_room_data as $search_room_key => $search_room) {
					$search_room_data2[$search_room['accommodation_id']] =  $search_room['day_wise_rates_json'];
				}

				$this->session->set_userdata('day_wise_rates_json', $search_room_data2);

				$response = array('success' => true, 'link' => base_url('frontend/booking/booking_information_entry/' . base64_encode($this->encryption->encrypt(serialize(array('property_id' => $property_id, 'stay_dates' => $stay_dates, 'adult' => $adult_pax, 'child' => $child_pax, 'rate_category_id' => $rate_category_id))))));
			}
		} else {
			$response = array('success' => false, 'msg' => 'Please select at least one room before proceeding.');
		}

		echo json_encode($response);
	}

	private function createSerial()
	{
		$timestamp = time() . rand(10000, 99999);

		for ($i = 1; $i <= strlen($timestamp); $i++) {
			$piece = substr($timestamp, $i - 1, 1);
			$shuffle_array[] = $piece;
		}

		shuffle($shuffle_array);

		return implode('', $shuffle_array);
	}

	private function createBookingSerial()
	{
		$year_month_format = date('ym');
		$appl_no_format = 'PB' . $year_month_format;
		$bookingNo = $this->mbooking->selectQuery("SELECT MAX(`booking_no`) AS `max_booking_no` FROM `booking_header` WHERE `booking_no` LIKE '$appl_no_format%'")->last_row();

		$n = str_replace($appl_no_format, '', $bookingNo->max_booking_no);
		$n = str_pad($n + 1, 7, 0, STR_PAD_LEFT);
		$number = $appl_no_format . $n;
		return $number;
	}

	public function booking_information_entry($param1)
	{
		// echo "<pre>";
		// print_r($param1);
		// die;
		$det_arr = unserialize($this->encryption->decrypt(base64_decode($param1)));

		// print_r($this->session->userdata('day_wise_rates_json'));
		// die;

		$property_det = $this->mbooking->get_property_details(array('property_id' => $det_arr['property_id']));

		$data['nationalities'] = $this->mcommon->getDetailsOrder('nationality', array('status_flag' => 1), 'nationality', 'ASC');

		$stay_dates = explode(' - ', $det_arr['stay_dates']);
		$checkIn_dt_arr = explode('/', $stay_dates[0]);
		$checkInDt = date('Y-m-d', strtotime($checkIn_dt_arr[2] . '-' . $checkIn_dt_arr[1] . '-' . $checkIn_dt_arr[0]));
		$checkOut_dt_arr = explode('/', $stay_dates[1]);
		$checkOutDt = date('Y-m-d', strtotime($checkOut_dt_arr[2] . '-' . $checkOut_dt_arr[1] . '-' . $checkOut_dt_arr[0]));

		$checkInDtObj = new DateTime($checkInDt);
		$checkOutDtObj = new DateTime($checkOutDt);

		$data['checkInDt'] = $checkInDtObj->format('Y-m-d');
		$data['checkOutDt'] = $checkOutDtObj->format('Y-m-d');
		$data['interval'] = $interval = $checkInDtObj->diff($checkOutDtObj);
		$data['no_nights'] = $no_nights = $interval->format('%a');
		$data['adultCount'] = $adultCount = $det_arr['adult'];
		$data['childCount'] = $childCount = $det_arr['child'];
		$data['rate_category'] = $rate_category_id = 1;

		$coupon_id = isset($_SESSION['coupon']['coupon_id']) && $_SESSION['coupon']['coupon_id'] != '' ? $_SESSION['coupon']['coupon_id'] : 0;

		$coupon_perc = '';

		if ($coupon_id) {
			$data['coupon_det'] = $this->mbooking->get_booking_coupon(array('coupon_id' => $coupon_id))->row();
			$coupon_perc = $data['coupon_det']->offer_perc;
		}

		$data['amounts'] = $_SESSION['amounts'] = $amounts = $this->calculateAmounts($det_arr['property_id'], $checkInDt, $checkOutDt, $adultCount, $childCount, $rate_category_id, $coupon_perc);

		//print_r($data['amounts']);
		// print_r($data); die;

		$this->load->library('form_validation');

		$this->form_validation->set_rules('guest_type', 'Guest Type', 'trim|required|is_natural');
		$this->form_validation->set_rules('booking_fname', 'Full Name', 'trim|required|regex_match[/^([a-z ])+$/i]');
		//$this->form_validation->set_rules('booking_lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('booking_gender', 'Gender', 'trim|required|in_list[Male,Female,Other]');
		$this->form_validation->set_rules('booking_age', 'Age', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('booking_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('booking_mobile', 'Mobile No.', 'trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('booking_organisation_name', 'Organisation Name', 'trim|max_length[150]|regex_match[/^[A-Za-z0-9_.,\-\s]+$/]');
		$this->form_validation->set_rules('booking_organisation_gstin', 'GSTIN', 'trim|max_length[25]|regex_match[/^[A-Za-z0-9_.,\-\s]+$/]');

		$this->form_validation->set_rules('guest_type_foreign', 'Whether any of the guest is a foreign national?', 'trim|required|is_natural');

		if ($this->form_validation->run()) {
			$booking_guest_type = $this->input->post('guest_type');
			$booking_fname = $this->input->post('booking_fname');
			//$booking_lname = $this->input->post('booking_lname');
			$booking_gender = $this->input->post('booking_gender');
			$booking_age = $this->input->post('booking_age');
			$booking_email = $this->input->post('booking_email');
			$booking_phone = $this->input->post('booking_mobile');
			$booking_country = ''; //$this->input->post('booking_country');
			$booking_state = ''; //$this->input->post('booking_state');
			$booking_city = ''; //$this->input->post('booking_city');
			$booking_address = ''; //$this->input->post('booking_address');
			$booking_organisation_name = $this->input->post('booking_organisation_name') != '' ? $this->input->post('booking_organisation_name') : NULL;
			$booking_organisation_gstin = $this->input->post('booking_organisation_gstin') != '' ? $this->input->post('booking_organisation_gstin') : NULL;

			$total_rooms = 0;

			$booking_for = NULL;

			if ($booking_guest_type == '1') {
				$booking_for = 'P';
			} elseif ($booking_guest_type == '2' && is_null($booking_organisation_gstin)) {
				$booking_for = 'O';
			} elseif ($booking_guest_type == '2' && !is_null($booking_organisation_gstin)) {
				$booking_for = 'B';
			}

			$this->db->trans_start();

			$booking_detail = array();
			$accomm_not_avlbl = array();

			if (!empty($_SESSION["accommodation_cart"])) {
				foreach ($_SESSION["accommodation_cart"] as $key => $value) {
					//$accommodationById = $this->mbooking->get_property_accommodation(array('accommodation.accommodation_id' => $_SESSION["accommodation_cart"][$key]['accommodation_id'], 'rate_category_id' => 1))->last_row();

					$avlblAccommLists = $this->mbooking->get_booking_property_accommodation_validate($det_arr['property_id'], $_SESSION["accommodation_cart"][$key]['accommodation_id'], $checkInDt, $checkOutDt);

					foreach ($avlblAccommLists as $avlblAccomm) {
						if ($avlblAccomm['available_room_cnt'] < $_SESSION["accommodation_cart"][$key]['quantity'])
							array_push($accomm_not_avlbl, $_SESSION["accommodation_cart"][$key]);
					}

					if (count($accomm_not_avlbl) > 0) {
						$this->session->set_flash_data('room_avlbl_err', "Your selected rooms are already booked. Please try again with different selection.");
						redirect(base_rul('frontend/booking/booking_information_entry/' . $param1));
					}

					$accommodation_id = $_SESSION["accommodation_cart"][$key]['accommodation_id'];
					$base_price = $_SESSION["accommodation_cart"][$key]['base_price'];
					$extra_bed_price = $_SESSION["accommodation_cart"][$key]['extra_bed_price'];
					$disc_amount = $_SESSION["accommodation_cart"][$key]["disc_amt_on_base"];
					$rate_id = $_SESSION["accommodation_cart"][$key]['rate_id'];
					$quantity = $_SESSION["accommodation_cart"][$key]['quantity'];
					$cgst_percentage = $_SESSION["accommodation_cart"][$key]["cgst_percentage"];
					$sgst_percetage = $_SESSION["accommodation_cart"][$key]["sgst_percentage"];
					$igst_percentage = $_SESSION["accommodation_cart"][$key]["igst_percentage"];

					$cgst_amount = ($cgst_percentage * $base_price) / 100;
					$sgst_amount = ($sgst_percetage * $base_price) / 100;
					$igst_amount = $_SESSION["accommodation_cart"][$key]["tax_amount_base_price"];

					$total_rooms += intval($_SESSION["accommodation_cart"][$key]['quantity']);

					$is_select_extra_bed = $_SESSION["accommodation_cart"][$key]["is_select_extra_bed"];

					$taxable_amount = $base_price; // OLD Logic ($base_price * $no_nights) (09-01-2023)
					$net_amount = $taxable_amount + $igst_amount;  // OLD Logic $taxable_amount + ($igst_amount * $no_nights) (09-01-2023)

					$split_key = explode('_', $key);

					if ($quantity == $is_select_extra_bed) {

						for ($i = 1; $i <= $quantity; $i++) {

							$adults_after_extra_bed = ($is_select_extra_bed != '') ? ($adultCount + 1) : $adultCount;

							$accommodation = array(
								'accommodation_id' => $accommodation_id,
								'rate_category_id' => $rate_category_id,
								'in_date' => $checkInDt,
								'out_date' => $checkOutDt,
								'adults' => $adults_after_extra_bed,
								'children' => $childCount,
								'extra_bed_cnt' => 0,
								'rate_id' => $rate_id,
								'allotment_status' => 'B',
								'extra_bed_rate' => $extra_bed_price,
								'room_rate' => $base_price / $no_nights, // OLd LOGIC: $base_price (09-01-2023)
								'room_charge' => $base_price, // OLD LOGIC before PROCEDURE ($base_price * $no_nights) (09-01-2023)
								'room_discount_percent' => '0.00',
								'room_discount_amount' => $disc_amount,
								'room_taxable_amount' => $taxable_amount,
								'room_cgst' => $cgst_amount,
								'room_sgst' => $sgst_amount,
								'room_igst' => $igst_amount,
								'room_cgst_percent' => $cgst_percentage,
								'room_sgst_percent' => $sgst_percetage,
								'room_igst_percent' => $igst_percentage,
								'room_net_amount' => $net_amount,
								'is_select_extra_bed' => 1,
								'day_wise_rates_json' => $this->session->userdata('day_wise_rates_json')[$split_key[2]]
							);

							array_push($booking_detail, $accommodation);
						}
					} else {

						for ($i = 1; $i <= $quantity; $i++) {

							$adults_after_extra_bed = ($is_select_extra_bed != '') ? ($adultCount + 1) : $adultCount;

							if ($i <= $is_select_extra_bed) {

								$accommodation = array(
									'accommodation_id' => $accommodation_id,
									'rate_category_id' => $rate_category_id,
									'in_date' => $checkInDt,
									'out_date' => $checkOutDt,
									'adults' => $adults_after_extra_bed,
									'children' => $childCount,
									'extra_bed_cnt' => 0,
									'rate_id' => $rate_id,
									'allotment_status' => 'B',
									'extra_bed_rate' => $extra_bed_price,
									'room_rate' => $base_price / $no_nights, // OLd LOGIC: $base_price (09-01-2023)
									'room_charge' => $base_price, // OLD LOGIC before PROCEDURE ($base_price * $no_nights) (09-01-2023)
									'room_discount_percent' => '0.00',
									'room_discount_amount' => $disc_amount,
									'room_taxable_amount' => $taxable_amount,
									'room_cgst' => $cgst_amount,
									'room_sgst' => $sgst_amount,
									'room_igst' => $igst_amount,
									'room_cgst_percent' => $cgst_percentage,
									'room_sgst_percent' => $sgst_percetage,
									'room_igst_percent' => $igst_percentage,
									'room_net_amount' => $net_amount,
									'is_select_extra_bed' => 1,
									'day_wise_rates_json' => $this->session->userdata('day_wise_rates_json')[$split_key[2]]
								);
							} else {
								$accommodation = array(
									'accommodation_id' => $accommodation_id,
									'rate_category_id' => $rate_category_id,
									'in_date' => $checkInDt,
									'out_date' => $checkOutDt,
									'adults' => $adultCount,
									'children' => $childCount,
									'extra_bed_cnt' => 0,
									'rate_id' => $rate_id,
									'allotment_status' => 'B',
									//'extra_bed_rate' => $extra_bed_price,
									'room_rate' => $base_price / $no_nights, // OLd LOGIC: $base_price (09-01-2023)
									'room_charge' => $base_price, // OLD LOGIC before PROCEDURE ($base_price * $no_nights) (09-01-2023)
									'room_discount_percent' => '0.00',
									'room_discount_amount' => $disc_amount,
									'room_taxable_amount' => $taxable_amount,
									'room_cgst' => $cgst_amount,
									'room_sgst' => $sgst_amount,
									'room_igst' => $igst_amount,
									'room_cgst_percent' => $cgst_percentage,
									'room_sgst_percent' => $sgst_percetage,
									'room_igst_percent' => $igst_percentage,
									'room_net_amount' => $net_amount,
									'is_select_extra_bed' => 0,
									'day_wise_rates_json' => $this->session->userdata('day_wise_rates_json')[$split_key[2]]
								);
							}

							array_push($booking_detail, $accommodation);
						}
					}
				}
			}

			//print_r($booking_detail); die;

			$customer_id = $this->session->userdata('customer_id') != '' ? $this->session->userdata('customer_id') : 0;

			$booking_no = createBookingNo('AB');

			$booking_header = array(
				'booking_no' => $booking_no,
				'property_id' => $det_arr['property_id'],
				'room_count' => $total_rooms,
				'customer_id' => $customer_id,
				'check_in' => $checkInDt,
				'check_out' => $checkOutDt,
				'additional_bed_mattress' => ($this->input->post('additional_bed_mattress') != '') ? $this->input->post('additional_bed_mattress') : 'No',
				'booking_for' => $booking_for,
				'first_name' => $booking_fname,
				//'middle_name' => '',
				//'last_name' => $booking_lname,
				'gender' => $booking_gender,
				'age' => $booking_age,
				'email' => $booking_email,
				'mobile' => $booking_phone,
				'personal_address' => $booking_address,
				'company_name' => $booking_organisation_name,
				'gst_number' => $booking_organisation_gstin,
				'company_state_id' => $booking_state,
				'company_country_id' => $booking_country,
				'special_request' => '',
				'room_base_price' => $amounts['total_amount'],
				'room_total_discount' => '0.00',
				'room_price_before_tax' => $amounts['total_amount'],
				'room_total_cgst' => '0.00',
				'room_total_sgst' => '0.00',
				'room_total_igst' => $amounts['gst_amount'],
				'room_payable_amount' => $amounts['grand_total'],
				'net_payable_amount' => $amounts['grand_total'],
				'booking_status' => 'I',
				'created_by' => $customer_id,
				'created_user_type' => 'C',
				'created_ts' => date('Y-m-d H:i:s'),
				'updated_by' => '',
				'updated_user_type' => '',
				'total_discount' => '0.00',
			);

			$booking_id = $this->mbooking->add_booking_header($booking_header);


			$room_cgst_percent = '';
			$room_sgst_percent = '';
			$room_igst_percent = '';

			foreach ($booking_detail as $key => $bd) {

				$day_wise_rates_json = str_replace("'", '"', $bd['day_wise_rates_json']);
				$day_wise_rates_decode_data = json_decode($day_wise_rates_json, true);

				foreach ($day_wise_rates_decode_data as $row) {

					$room_cgst_percent = (($row['cgst_amount'] / $row['base_price']) * 100);
					$room_sgst_percent = (($row['sgst_amount'] / $row['base_price']) * 100);
					$room_igst_percent = (($row['igst_amount'] / $row['base_price']) * 100);

					$extra_bed_price = ($bd['is_select_extra_bed'] != '') ? $row['extra_bed_price_b4_disc'] : '0.00';
					$room_cgst = ($bd['is_select_extra_bed'] != '') ? ($row['tax_amount_base_plus_extra'] / 2) : $row['cgst_amount'];
					$room_sgst = ($bd['is_select_extra_bed'] != '') ? ($row['tax_amount_base_plus_extra'] / 2) : $row['sgst_amount'];
					$room_igst = ($bd['is_select_extra_bed'] != '') ? $row['tax_amount_base_plus_extra'] : $row['igst_amount'];
					$room_taxable_amount = ($bd['is_select_extra_bed'] != '') ? ($row['base_price'] + $row['extra_bed_price_b4_disc']) : $row['base_price'];

					$booking_detail_data[] = array(
						'booking_id' => $booking_id,
						'accommodation_id' => $bd['accommodation_id'],
						'is_select_extra_bed' => $bd['is_select_extra_bed'],
						'in_date' => $row['temp_date'],
						'out_date' => date('Y-m-d', strtotime("+1 day", strtotime($row['temp_date']))),
						'adults' => $bd['adults'],
						'children' => $bd['children'],
						'allotment_status' => 'B',
						'rate_category_id' => $bd['rate_category_id'],
						'extra_bed_rate' => $extra_bed_price,
						'room_rate' => $row['base_price_b4_disc'],
						'room_charge' => $row['base_price_b4_disc'],
						'room_discount_percent' => $bd['room_discount_percent'],
						'room_discount_amount' => $row['disc_amt_on_base'],
						'room_taxable_amount' => $room_taxable_amount,
						'room_cgst' => $room_cgst,
						'room_sgst' => $room_sgst,
						'room_igst' => $room_igst,
						'room_cgst_percent' => number_format($room_cgst_percent, 2),
						'room_sgst_percent' => number_format($room_sgst_percent, 2),
						'room_igst_percent' => number_format($room_igst_percent, 2),
						'room_net_amount' => ($room_taxable_amount + $room_igst),
						'same_line_item' => ($key + 1)
					);
				}
			}

			//print_r($booking_detail_data); die;

			if (!empty($booking_detail_data)) {
				$this->db->insert_batch('booking_detail', $booking_detail_data);
			}

			//if foreigner
			if ($this->input->post('guest_type_foreign') == 1) {

				$foreigner_name = $this->input->post('foreigner_name');
				$foreigner_age = $this->input->post('foreigner_age');
				$foreigner_gender = $this->input->post('foreigner_gender');
				$foreigner_nationality = $this->input->post('foreigner_nationality');

				//Start Information dtl Save
				for ($f = 0; $f < sizeof($foreigner_name); $f++) {

					if ($foreigner_name[$f] != '' && $foreigner_age[$f] != '' && $foreigner_gender[$f] != '' && $foreigner_nationality[$f] != '') {

						$foreigner_data = array(
							'booking_id' => $booking_id,
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


			/*foreach ($booking_detail as $bd) {
				
				//call admin store procedure
				$request_data['property_id'] = $det_arr['property_id'];
				$request_data['check_in_date'] = $bd['in_date'];
				$request_data['check_out_date'] = $bd['out_date'];
				$request_data['discount_perc'] = $bd['room_discount_percent'];
				$search_room_data = $this->mbooking->search_room($request_data);
				
				$bd['booking_id'] = $booking_id;
				$booking_detail_id = $this->mbooking->add_booking_detail($bd);
			}*/

			$this->db->trans_complete();
			if ($this->db->trans_status()) {
				$data_record = array_merge($det_arr, array('booking_id' => $booking_id, 'total_amount' => $amounts['grand_total']));

				redirect(base_url('frontend/booking/booking_payment/' . base64_encode($this->encryption->encrypt(serialize($data_record)))));
			} else {
				$this->session->set_flashdata('err_msg', "Booking process unsuccessful. Please try again.");
				redirect(base_url('frontend/booking/booking_information_entry/' . $param1));
			}
		}

		$data['err_msg'] = $this->session->flashdata('room_avlbl_err');
		$data['property'] = $property_det[0];
		$data['booking'] = $det_arr;
		//$data['states'] = $this->mbooking->get_property_states(array('is_active' => 1));
		$data['customer_det'] = $this->session->userdata('customer_id') != '' ? $this->mbooking->get_customer_det(array('customer_master.customer_id' => $this->session->userdata('customer_id')))->last_row() : NULL;
		// print_r($data['customer_det']); die;

		//cancellation calculation--------------------------------
		/*$remaining_days = '';
			$from = date('Y-m-d');
			$to = $checkInDtObj->format('Y-m-d');
			$first_date = strtotime($from);
			$second_date = strtotime($to);
			$offset = $second_date-$first_date; 
			$remaining_days = floor($offset/60/60/24);
			
			$plicies = $this->mcancellationpolicy->get();
			if(!empty($plicies)){
				foreach($plicies as $policy) {
					if ( in_array($remaining_days, range($policy->day_from,$policy->day_to)) ) { 
					
						$pID[] = $policy->cancellation_policy_id;
					}
				}
			}
			
			//echo print_r($pID);
			//echo implode("",$pID);
			$data['policyId'] = implode("",$pID);
			
			$data['plicies'] = $plicies;*/
		//end-----------------------------------------------------
		$data['content'] = 'frontend/booking/booking_details_entry';
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
		$post_fields['callback_url'] 	= base_url('frontend/booking/paymentBookingSuccess');
		$post_fields['cancel_url'] 	= base_url('frontend/booking/paymentBookingFailure');
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

		if ($razorpay_order_id != '') {
			$this->db->trans_start();

			$payment_data = array(
				'booking_id' => $data_record['booking_id'],
				'customer_id' => $customer_id,
				'payment_date' => date('Y-m-d'),
				'txnid' => $post_fields['receipt_id'],
				'order_id' => $razorpay_order_id,
				'transaction_ref_id' => NULL,
				'bank_ref_num' => NULL,
				'amount' => $data_record['total_amount'],
				'payment_mode' => '',
				'remarks' => '',
				'status' => 'PENDING',
				'created_ts' => date('Y-m-d H:i:s'),
			);
			$payment_id = $this->mbooking->add_booking_payment_info($payment_data);

			$txn_data = $this->mbooking->update_booking_header(array('booking_header.txnid' => $post_fields['receipt_id'], 'booking_header.order_id' => $razorpay_order_id), array('booking_header.booking_id' => $data_record['booking_id']));

			$this->db->trans_complete();

			$data['razorpaydata'] = $post_fields;
			$data['content'] = 'frontend/booking/booking_payment';
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
			"image"             => base_url() . "public/frontend_assets/assets/img/logo.png",
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

	public function paymentBookingSuccess()
	{
		$success = false;
		$razorpay_posted_data = $this->input->post();
		$razorpay_posted_data['keyId'] = RAZORPAY_KEY;
		$razorpay_posted_data['keySecret'] = RAZORPAY_KEY_SECRET;

		//echo "<pre>"; print_r($razorpay_posted_data); die;

		$api = new Api($razorpay_posted_data['keyId'], $razorpay_posted_data['keySecret']);

		$bookingData = $this->mcommon->getRow('booking_header', array('order_id' => $razorpay_posted_data['razorpay_order_id']));

		if (!empty($bookingData)) {

			if ($razorpay_posted_data['razorpay_payment_id'] != '' && $razorpay_posted_data['razorpay_order_id'] != '') {

				$generated_signature = hash_hmac('sha256', $bookingData['order_id'] . "|" . $razorpay_posted_data['razorpay_payment_id'], $razorpay_posted_data['keySecret']);

				if ($generated_signature == $razorpay_posted_data['razorpay_signature']) {
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
					$this->mcommon->update('booking_payment', array('order_id' => $razorpay_posted_data['razorpay_order_id']), array('razorpay_payment_id' => $razorpay_posted_data['razorpay_payment_id'], 'razorpay_signature' => $razorpay_posted_data['razorpay_signature']));

					$param = array();
					$param['payment_id'] = $razorpay_posted_data['razorpay_payment_id'];
					$param['order_id'] = $razorpay_posted_data['razorpay_order_id'];
					$check_payment_status = $this->booking_payment_verify($param);

					//echo "<pre>"; print_r($check_payment_status); die;

					if ($check_payment_status['rtn'] === true) {
						$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'SUCCESS', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
						$data['content'] = 'frontend/booking/booking_payment_confirmation';
						$this->load->view('frontend/layouts/index', $data);
					} else {
						$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
						$data['content'] = 'frontend/booking/booking_payment_confirmation';
						$this->load->view('frontend/layouts/index', $data);
					}
				} else {
					$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $razorpay_posted_data['razorpay_order_id'])))));
					$data['content'] = 'frontend/booking/booking_payment_confirmation';
					$this->load->view('frontend/layouts/index', $data);
				}
			} else {
				//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
				$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
				//echo $responseMetadata['payment_id']; die;
				$this->mcommon->update('booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));

				$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
				$data['content'] = 'frontend/booking/booking_payment_confirmation';
				$this->load->view('frontend/layouts/index', $data);
			}
		} else {
			//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
			$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
			//echo $responseMetadata['payment_id']; die;
			$this->mcommon->update('booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));

			$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
			$data['content'] = 'frontend/booking/booking_payment_confirmation';
			$this->load->view('frontend/layouts/index', $data);
		}
	}

	public function paymentBookingFailure()
	{
		$razorpay_posted_data = $this->input->post();  // Escapes the string to prevent SQL injection

		//echo "<pre>"; print_r($razorpay_posted_data['error']); die;
		$responseMetadata = json_decode($razorpay_posted_data['error']['metadata'], true);
		//echo $responseMetadata['payment_id']; die;
		$this->mcommon->update('booking_payment', array('order_id' => $responseMetadata['order_id']), array('razorpay_payment_id' => $responseMetadata['payment_id']));

		$data['redirect'] = base_url('frontend/booking/booking_payment_complete/' . base64_encode($this->encryption->encrypt(serialize(array('status' => 'FAILURE', 'payment_status' => $check_payment_status['status'], 'order_id' => $responseMetadata['order_id'])))));
		$data['content'] = 'frontend/booking/booking_payment_confirmation';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function booking_payment_complete($value1)
	{
		if (is_null($value1))
			redirect(base_url('my-booking'));

		$det = unserialize($this->encryption->decrypt(base64_decode($value1)));

		$data['status'] = $det['status'];
		$data['payment_status'] = $det['payment_status'];
		$data['payment'] = $det['posted_data'];
		$data['booking_det'] = $this->mbooking->get_booking_payment(array('booking_payment.order_id' => $det['order_id']))->last_row();

		if (strtolower($data['booking_det']->status) == 'failure') {
			$this->mbooking->move_booking_to_failed($data['booking_det']->booking_id);
		}


		$data['content'] = 'frontend/booking/booking_payment_complete';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function booking_payment_verify($option)
	{
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
			$getPaymentData = $this->mcommon->getRow('booking_payment', array('order_id' => $option['order_id']));
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

			if (!empty($payment)) {
				if (($payment->status == 'captured' && $payment->captured == 1) && ($payment->order_id != '') && ($getPaymentData['amount'] == $capturedAmount)) { //Success Payment
					$payment_data = array(
						'payment_date' => date('Y-m-d H:i:s', $payment->created_at),
						'razorpay_payment_id' => $payment->id,
						'payment_mode' => $payment->method,
						'remarks' => 'Payment Successful',
						'status' => ucwords($payment->status),
						'updated_ts' => date('Y-m-d H:i:s'),
					);

					$booking_header_condn = array('booking_status' => 'A');

					if ($option['type'] == 'Cron') {
						$payment_data['cronjob_data'] = json_encode(serialize($payment));
						$payment_data['cronjob_status'] = 'COMPLETED';
						$payment_data['cronjob_end_time'] = date('Y-m-d H:i:s');
					} else {
						$payment_data['response_txt'] = json_encode(serialize($payment));
					}

					$update = $this->mcommon->update('booking_payment', array('order_id' => $payment->order_id), $payment_data);
					if ($update) {
						$this->mcommon->update('booking_header', array('order_id' => $payment->order_id), $booking_header_condn);

						$return['status'] = $payment->status;
						$return['rtn'] = true;
						return $return;
					}
				} else { //Failed Payment
					$payment_data = array(
						'payment_date' => date('Y-m-d H:i:s', $payment->created_at),
						'razorpay_payment_id' => $payment->id,
						'response_txt' => json_encode(serialize($payment)),
						'remarks' => 'Payment Failed',
						'status' => ucwords($payment->status),
						'updated_ts' => date('Y-m-d H:i:s'),
					);

					$booking_header_condn = array('booking_status' => 'F');

					$update = $this->mcommon->update('booking_payment', array('order_id' => $payment->order_id), $payment_data);
					if ($update) {
						$this->mcommon->update('booking_header', array('order_id' => $payment->order_id), $booking_header_condn);

						if ($option['type'] == 'Cron') {
							if ($getPaymentData['payment_mode'] == 'NEFT') { //for NEFT mode
								$start_date = strtotime($payment->created_ts);
								$end_date = strtotime("+8 day", $start_date);
								$last_date = date('Y-m-d', $end_date);

								if ((date('Y-m-d') > $last_date) && ($payment->status != 'captured')) {
									$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
								}
							} else { //for others mode

								if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020) && ($payment->status != 'captured')) {
									$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
								}
							}
						}

						$return['status'] = $payment->status;
						return $return;
					}
				}
			} else {

				if ($option['type'] == 'Cron') {
					if ($getPaymentData['payment_mode'] == 'NEFT') { //for NEFT mode
						$start_date = strtotime($getPaymentData['created_ts']);
						$end_date = strtotime("+8 day", $start_date);
						$last_date = date('Y-m-d', $end_date);

						if (date('Y-m-d') > $last_date) {
							$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
						}
					} else { //for others mode

						if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020)) {
							$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
						}
					}
				}

				$return['status'] = 'Payment Not Found';
				$return['rtn'] = false;
				return $return;
			}
		} catch (Exception $e) {
			$getPaymentData = $this->mcommon->getRow('booking_payment', array('order_id' => $option['order_id']));
			if ($option['type'] == 'Cron') {
				if ($getPaymentData['payment_mode'] == 'NEFT') { //for NEFT mode
					$start_date = strtotime($getPaymentData['created_ts']);
					$end_date = strtotime("+8 day", $start_date);
					$last_date = date('Y-m-d', $end_date);

					if (date('Y-m-d') > $last_date) {
						$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
					}
				} else { //for others mode

					if (((strtotime(date('Y-m-d H:i:s')) - strtotime($getPaymentData['created_ts'])) > 1020)) {
						$booking_failed_det = $this->mbooking->move_booking_to_failed($getPaymentData['booking_id']);
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

	public function bookingPaymentVerifyCron()
	{
		$param = array();
		$payments = $this->mbooking->get_booking_payment(array("status IN ('PENDING','NOT-FOUND','FAILURE', 'Failure', 'FAILED','AWAITED','INITIATED','UNSUCCESSFUL','Aborted', 'TIMEOUT') OR status IS NULL" => NULL, "booking_header.booking_status IN ('I','F')" => NULL));
		//$payments = $this->mcommon->getDetails('payment_info', array('payment_id' => 46));
		if ($payments->num_rows() > 0) {
			foreach ($payments->result() as $payment) {
				if ($payment->order_id != '') {
					$cron_det = $this->mcommon->update('booking_payment', array('order_id' => $payment->order_id), array('cronjob_start_time' => date('Y-m-d H:i:s')));
					$param['payment_id'] = $payment->razorpay_payment_id;
					$param['order_id'] = $payment->order_id;
					$param['type'] = 'Cron';
					$check_app_payment_status = $this->booking_payment_verify($param);
					if ($check_app_payment_status) {
						$cron_status = "Update Successful for ORDER ID: " . $payment->order_id;
					}
				} else {
					$cron_status = "No Payment ID found";
				}

				$add_data = $this->mcommon->insert('activity_log', array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'booking-payment-verify-cron', 'log_desc' => $cron_status));
				echo $cron_status . "<br>";
			}
		} else {
			$cron_status .= " No Pending transactions found.";
			$add_data = $this->mcommon->insert('activity_log', array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'booking-payment-verify-cron', 'log_desc' => $cron_status));
			echo $cron_status . "<br>";
		}
	}

	public function booking_coupon()
	{
		$propertyId = $this->input->post('propertyId') != '' ? $this->input->post('propertyId') : NULL;
		$coupon = $this->input->post('coupon_code') != '' ? $this->input->post('coupon_code') : NULL;
		$type = $this->input->post('type') != '' ? $this->input->post('type') : NULL;

		$response = array();

		if (strtoupper($type) == 'REMOVE' && isset($_SESSION['coupon']['coupon_id'])) {
			unset($_SESSION['coupon']);

			$response = array('success' => true, 'msg' => 'Coupon Removed');
		} else {
			if (is_null($coupon)) {
				$response = array('success' => false, 'msg' => 'Please enter coupon code.');
			} else {
				$coupon_det = $this->mbooking->get_booking_coupon(array('coupon_code' => $coupon))->row();

				if (($propertyId != $coupon_det->property_id) || (date('Y-m-d') < $coupon_det->valid_from_date) || (date('Y-m-d') > $coupon_det->valid_to_date)) {
					$response = array('success' => false, 'msg' => 'Invalid Coupon');
				} else {
					$_SESSION['coupon']['coupon_id'] = $coupon_det->coupon_id;
					$response = array('success' => true, 'msg' => 'Coupon Applied');
				}
			}
		}

		echo json_encode($response);
	}


	public function testPDF()
	{
		$this->load->library('pdf');
		$booking_id = 57;
		$booking_header = $this->query->getBookingHeader($booking_id);
		$customer_details = $this->query->getBookingDetailsOfCustomer($booking_id);
		$booking_details = $this->mcommon->getDetails('booking_listing_view', array('booking_id' => $booking_id));
		$booking_payment_listing = $this->mcommon->getRow('booking_payment_listing_view', array('booking_id' => $booking_id));
		$property_details = $this->query->getPropertyDetails($booking_id);

		$filename = 'booking-' . time() . '-' . $booking_id;
		$html = $this->load->view('frontend/viewInvoiceNew', $data, true);

		// echo $html;die;


		//$this->pdf->create($html, $filename);
		$this->pdf->loadHtml($html);
		$this->pdf->set_paper("A4", "landscape");
		$this->pdf->render();

		$output = $this->pdf->output();
		file_put_contents(FCPATH . 'public/booking_payment_confirmation_pdf/' . $filename . '.pdf', $output);
	}
}
