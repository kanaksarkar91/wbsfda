<?php

class Mbooking extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function search_room($request_data)
	{


		$sql = "CALL get_property_available_accomm_disc (" . $request_data['property_id'] . ",'" . $request_data['check_in_date'] . "','" . $request_data['check_out_date'] . "',0,0,1," . $request_data['discount_perc'] . ");";
		//echo $sql;die;



		// SELECT bd.booking_id,count(bd.booking_detail_id),a.*
		// FROM accommodation a 
		// INNER JOIN booking_detail bd ON bd.accommodation_id = a.accommodation_id AND bd.in_date 
		// WHERE a.property_id = 1 AND (bd.in_date NOT BETWEEN '2022-09-10' AND '2022-09-11') AND () AND is_active = 1 GROUP BY a.accommodation_id ORDER BY bd.booking_id DESC;


		$query = $this->db->query($sql);
		$search_room_results = $query->result_array();
		return $search_room_results;
	}

	function selectQuery($query)
	{
		return $this->db->query($query);
	}

	function get_property_states($condn = null)
	{
		$this->db->select('state_master.*');
		$this->db->from('state_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_property_districts($condn = null)
	{
		$this->db->select('district_master.*');
		$this->db->from('district_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('district_name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_property_types($condn = null)
	{
		$this->db->select('property_types.*');
		$this->db->from('property_types');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('property_type_name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_property_terrains($condn = null)
	{
		$this->db->select('terrain_master.*');
		$this->db->from('terrain_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('terrain_name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_property_facilities($condn = null)
	{
		$this->db->select('facility_master.*');
		$this->db->from('facility_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('facility_name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_landscape_properties($condn = null)
	{
		$this->db->select('terrain_master.terrain_id, terrain_master.terrain_name, property_master.*, district_master.*');
		$this->db->from('property_master');
		$this->db->join('terrain_master', 'property_master.terrain_id = terrain_master.terrain_id', 'LEFT');
		$this->db->join('district_master', 'property_master.district_id = district_master.district_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('terrain_name', 'ASC');
		$this->db->order_by('property_name', 'ASC');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		return $query->result_array();
	}

	function get_booking_property_list($search_string = '', $from_date = '', $to_date = '', $adult_pax = '', $child_pax = '', $property_district = '', $hotel_types = '', $facilities = '', $rate_category_id = '', $terrain_id = '')
	{
		$stored_procedure = "CALL get_available_property_list_proc(?,?,?,?,?,?,?,?,?,?);";
		$data = array('p_search_string' => $search_string, 'p_from_date' => $from_date, 'p_to_date ' => $to_date, 'p_adult_pax' => $adult_pax, 'p_child_pax' => $child_pax, 'p_district_id' => $property_district, 'p_hotel_types' => $hotel_types, 'p_facilities' => $facilities, 'p_rate_category_id' => $rate_category_id, 'p_terrain_id' => $terrain_id);

		$result = $this->db->query($stored_procedure, $data);
		// echo $this->db->last_query();
		// die;

		if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function get_property_details_for_listing($hotel_types = '', $landmark = 0, $district = 0, $keywords = '', $facilities = '')
	{
		$stored_procedure = "CALL get_property_list_proc(?,?,?,?,?);";
		$data = array('p_property_type_id' => $hotel_types, 'p_terrain_id' => $landmark, 'p_district_id' => $district, 'p_search_string' => $keywords, 'p_facilities' => $facilities);

		$result = $this->db->query($stored_procedure, $data);

		if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function get_property_details($condn = null)
	{
		$this->db->select('property_master.*');
		$this->db->from('property_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('property_id', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_booking_property_accommodation_list($property_id, $checkIn_dt, $checkOut_dt, $adult_pax, $child_pax, $rate_category_id)
	{
		$stored_procedure = "CALL get_property_available_accomm(?,?,?,?,?,?);";
		$data = array('p_property_id' => $property_id, 'p_from_date' => $checkIn_dt, 'p_to_date ' => $checkOut_dt, 'p_adult_pax' => $adult_pax, 'p_child_pax' => $child_pax, 'p_rate_category_id' => $rate_category_id);
		$result = $this->db->query($stored_procedure, $data);
		if ($result !== NULL) {
			$response = $result->result_array();

			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function get_property_accommodation($condn = null)
	{
		$this->db->select('accommodation.*, rate_master.*');
		$this->db->from('accommodation');
		$this->db->join('rate_master', 'accommodation.accommodation_id = rate_master.accommodation_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('accommodation.accommodation_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	function get_customer_det($condn = null)
	{
		$this->db->select('customer_master.*');
		$this->db->from('customer_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('customer_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	function get_booking_header($condn = null)
	{
		$this->db->select('booking_header.*, property_master.payment_code, property_master.property_name');
		$this->db->from('booking_header');
		$this->db->join('property_master', 'booking_header.property_id = property_master.property_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	function update_booking_header($data_record, $condn)
	{
		return $this->db->update('booking_header', $data_record, $condn);
	}

	function add_booking_header($data_record)
	{
		$this->db->insert('booking_header', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function add_booking_detail($data_record)
	{
		$this->db->insert('booking_detail', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function add_booking_payment_info($data_record)
	{
		$this->db->insert('booking_payment', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function update_booking_payment_info($data_record, $condn)
	{
		return $this->db->update('booking_payment', $data_record, $condn);
	}

	function get_booking_payment($condn = null)
	{
		//print_r ($condn);
		$this->db->select('booking_payment.*, booking_header.booking_no, c.MERCHANT_ID, c.WORKING_KEY, c.ACCESS_CODE, c.BASE_URL, c.API_BASE_URL ');
		$this->db->from('booking_payment');
		$this->db->join('booking_header', 'booking_payment.booking_id = booking_header.booking_id', 'INNER');
		$this->db->join('property_master c', 'booking_header.property_id = c.property_id', 'INNER');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_payment_id', 'ASC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query;
	}

	function move_booking_to_failed($booking_id)
	{

		$this->db->trans_start(); # Starting Transaction

		$move_booking_header_failed_qry = "CALL move_booking_to_failed(" . $booking_id . ")";
		$run_move_booking_header_failed = $this->db->query($move_booking_header_failed_qry);
		$run_move_booking_header_failed->free_result();
		mysqli_next_result($this->db->conn_id);


		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			return true;
		}

		return false;
	}

	function get_booking_property_accommodation_gst($query_string)
	{
		$stored_procedure = "CALL get_gst_perc(?);";
		$data = array($query_string);
		$result = $this->db->query($stored_procedure, $data);
		if ($result !== NULL) {
			$response = $result->result_array();

			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function get_booking_property_accommodation_availability($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt, $adult_pax = 0, $child_pax = 0, $rate_category_id = 1, $percentage = 0)
	{
		$stored_procedure = "CALL get_property_available_accomm_id_disc(?,?,?,?,?,?,?,?);";
		$data = array($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt, $adult_pax, $child_pax, $rate_category_id, $percentage);
		$result = $this->db->query($stored_procedure, $data);
		//echo $this->db->last_query(); die;
		if ($result !== NULL) {
			$response = $result->result_array();

			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function get_booking_property_accommodation_validate($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt)
	{
		$stored_procedure = "CALL get_property_accomm_availability_proc(?,?,?,?);";
		$data = array($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt);
		$result = $this->db->query($stored_procedure, $data);
		if ($result !== NULL) {
			$response = $result->result_array();

			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return $response;
		}
		return FALSE;
	}

	function update_booking_to_failed($booking_id)
	{
		$stored_procedure = "CALL move_booking_to_failed(?);";
		$data = array($booking_id);
		$result = $this->db->query($stored_procedure, $data);
		if ($result !== NULL) {
			$result->free_result();
			mysqli_next_result($this->db->conn_id);

			return TRUE;
		}
		return FALSE;
	}

	function get_booking_coupon($condn = null)
	{
		$this->db->select('coupon_master.*');
		$this->db->from('coupon_master');
		if (!is_null($condn))
			foreach ($condn as $key => $value)
				$this->db->where($key, $value);
		return $this->db->get();
	}

	function add_cron_job_activity_log($data_record)
	{
		$this->db->insert('activity_log', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function update_booking_payment_to_failed($order_id)
	{
		$sql = "INSERT INTO booking_payment_failed SELECT * FROM booking_payment WHERE order_id = '" . $order_id . "' ";
		$rs = $this->db->query($sql);
		if ($rs) {
			$sql_del = "DELETE FROM booking_payment WHERE order_id = '" . $order_id . "' ";
			$rs_del = $this->db->query($sql_del);
		}
	}

	function get_ips_data_property_wise($condn = null)
	{
		$this->db->select('a.booking_id, c.MERCHANT_ID, c.WORKING_KEY, c.ACCESS_CODE, c.BASE_URL, c.API_BASE_URL');
		$this->db->from('booking_payment a');
		$this->db->join('booking_header b', 'a.booking_id = b.booking_id', 'LEFT');
		$this->db->join('property_master c', 'b.property_id = c.property_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);

		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_pos_booking_payment($condn = null)
	{
		$this->db->select('booking_payment_id, booking_id, customer_id, payment_date, txnid, order_id, device_id, transaction_ref_id, bank_ref_num, amount, payment_mode, response_txt, cheque_no, cheque_date, cheque_bank_name, transfar_bank_id, money_receipt_no, money_receipt_date, edc_terminal, remarks, error_message, status, created_by, created_ts, updated_by, updated_ts, sale_order_id, cronjob_data, cronjob_status, cronjob_start_time, cronjob_end_time');
		$this->db->from('booking_payment');
		$this->db->where('device_id !=', '');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);

		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}
}
