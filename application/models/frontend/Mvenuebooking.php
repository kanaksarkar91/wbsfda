<?php

class Mvenuebooking extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function selectQuery($query) {
		return $this->db->query($query);
	}
	
	function get_property_states($condn = null) {
		$this->db->select('state_master.*');
		$this->db->from('state_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('state_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_property_districts($condn = null) {
		$this->db->select('district_master.*');
		$this->db->from('district_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('district_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_property_types($condn = null) {
		$this->db->select('property_types.*');
		$this->db->from('property_types');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('property_type_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_property_terrains($condn = null) {
		$this->db->select('terrain_master.*');
		$this->db->from('terrain_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('terrain_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_property_facilities($condn = null) {
		$this->db->select('facility_master.*');
		$this->db->from('facility_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('facility_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_landscape_properties($condn = null) {
		$this->db->select('terrain_master.terrain_id, terrain_master.terrain_name, property_master.*, district_master.*');
		$this->db->from('property_master');
		$this->db->join('terrain_master', 'property_master.terrain_id = terrain_master.terrain_id', 'LEFT');
		$this->db->join('district_master', 'property_master.district_id = district_master.district_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('terrain_name','ASC');
		$this->db->order_by('property_name','DESC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_booking_property_list($search_string = '', $from_date = '', $to_date = '', $adult_pax = '', $child_pax = '', $property_district = '', $hotel_types = '', $facilities = '', $rate_category_id = '', $terrain_id = '') {
		$stored_procedure = "CALL get_available_property_list_proc(?,?,?,?,?,?,?,?,?,?);";
        $data = array('p_search_string' => $search_string, 'p_from_date' => $from_date, 'p_to_date ' => $to_date, 'p_adult_pax' => $adult_pax, 'p_child_pax' => $child_pax, 'p_district_id' => $property_district, 'p_hotel_types' => $hotel_types, 'p_facilities' => $facilities, 'p_rate_category_id' => $rate_category_id, 'p_terrain_id' => $terrain_id);
		
        $result = $this->db->query($stored_procedure, $data);
		
        if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result( $this->db->conn_id);
			
            return $response;
        }
        return FALSE;
	}
	
	function get_property_details_for_listing($hotel_types = '', $landmark = 0, $district = 0, $keywords = '', $facilities = '') {
		$stored_procedure = "CALL get_property_list_proc(?,?,?,?,?);";
        $data = array('p_property_type_id' => $hotel_types, 'p_terrain_id' => $landmark, 'p_district_id' => $district, 'p_search_string' => $keywords, 'p_facilities' => $facilities);
		        
		$result = $this->db->query($stored_procedure, $data);
		
        if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
            return $response;
        }
        return FALSE;
	}
	
	function get_property_details($condn = null) {
		$this->db->select('property_master.*');
		$this->db->from('property_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('property_id','ASC');
        $query=$this->db->get();
        return $query->result_array();
	}
	
	function get_booking_property_accommodation_list($property_id, $checkIn_dt, $checkOut_dt, $adult_pax, $child_pax, $rate_category_id) {
		$stored_procedure = "CALL get_property_available_accomm(?,?,?,?,?,?);";
        $data = array('p_property_id' => $property_id, 'p_from_date' => $checkIn_dt, 'p_to_date ' => $checkOut_dt, 'p_adult_pax' => $adult_pax, 'p_child_pax' => $child_pax, 'p_rate_category_id' => $rate_category_id);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
            $response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
			return $response;
        }
        return FALSE;
	}
	
	function get_property_accommodation($condn = null) {
		$this->db->select('accommodation.*, rate_master.*');
		$this->db->from('accommodation');
		$this->db->join('rate_master', 'accommodation.accommodation_id = rate_master.accommodation_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('accommodation.accommodation_id','ASC');
        $query=$this->db->get();
        return $query;
	}
	
	function get_customer_det($condn = null) {
		$this->db->select('customer_master.*');
		$this->db->from('customer_master');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('customer_id','ASC');
        $query=$this->db->get();
        return $query;
	}
	
	function get_booking_header($condn = null) {
		$this->db->select('booking_header.*, property_master.payment_code');
		$this->db->from('booking_header');
		$this->db->join('property_master', 'booking_header.property_id = property_master.property_id', 'LEFT');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_id','ASC');
        $query=$this->db->get();
        return $query;
	}
	
	function update_booking_header($data_record, $condn) {
		return $this->db->update('booking_header', $data_record, $condn);
	}
	
	function add_booking_header($data_record) {
		$this->db->insert('booking_header', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function add_booking_detail($data_record) {
		$this->db->insert('booking_detail', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function add_booking_payment_info($data_record) {
		$this->db->insert('booking_payment', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function update_booking_payment_info($data_record, $condn) {
		return $this->db->update('booking_payment', $data_record, $condn);
	}
	
	function get_booking_payment($condn = null) {
		//print_r ($condn);
		$this->db->select('booking_payment.*, booking_header.booking_no');
		$this->db->from('booking_payment');
		$this->db->join('booking_header', 'booking_payment.booking_id = booking_header.booking_id', 'INNER');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_payment_id','ASC');
        $query=$this->db->get();
		
        return $query;
	}

	function move_booking_to_failed($booking_id){
		
		$this->db->trans_start(); # Starting Transaction

		$move_booking_header_failed_qry = "CALL move_booking_to_failed(".$booking_id.")";
		$run_move_booking_header_failed = $this->db->query($move_booking_header_failed_qry);
		$run_move_booking_header_failed->free_result();
		mysqli_next_result( $this->db->conn_id);
		
		
		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;

		} 
		else { 
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			return true;
		}

		return false;
	}
	
	function get_booking_property_accommodation_gst($query_string) {
		$stored_procedure = "CALL get_gst_perc(?);";
        $data = array($query_string);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
            $response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
			return $response;
        }
        return FALSE;
	}
	
	function get_booking_property_accommodation_availability($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt, $adult_pax = 0, $child_pax = 0, $rate_category_id = 1, $percentage = 0) {
		$stored_procedure = "CALL get_property_available_accomm_id_disc(?,?,?,?,?,?,?,?);";
        $data = array($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt, $adult_pax, $child_pax, $rate_category_id, $percentage);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
            $response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
			return $response;
        }
        return FALSE;
	}
	
	function get_booking_property_accommodation_validate($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt) {
		$stored_procedure = "CALL get_property_accomm_availability_proc(?,?,?,?);";
        $data = array($property_id, $accommodation_id, $checkIn_dt, $checkOut_dt);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
            $response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
			return $response;
        }
        return FALSE;
	}
	
	function update_booking_to_failed($booking_id) {
		$stored_procedure = "CALL move_booking_to_failed(?);";
        $data = array($booking_id);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
			$result->free_result();
			mysqli_next_result( $this->db->conn_id );
			
			return TRUE;
        }
        return FALSE;
	}
	
	function get_booking_coupon($condn = null) {
		$this->db->select('coupon_master.*');
		$this->db->from('coupon_master');
		if (!is_null($condn))
			foreach ($condn as $key => $value)
				$this->db->where($key, $value);
		return $this->db->get();
	}
	
	function add_cron_job_activity_log($data_record) {
		$this->db->insert('activity_log', $data_record);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function getVenueListPropertyWise($where = array()) 
	{   
		$where_tmp=$where;
	
		// Specify the main table to query from
		$this->db->from('venue_rate_master vrm');
		
		// Join with other tables
		$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
		
		// Adjust select based on is_multiple_venues value
		$this->db->select(
			'vrm.*,vrm.is_hourly_booking as is_hourly_booking_rate, vrm.booking_hours as booking_hours_rate,' .
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.venue_name END AS venue_names,'.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN vrm.multiple_venue_ids ELSE vrm.single_venue_id END AS venue_ids,'.
			//'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image1 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image1 END AS image1, '.
			//'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image2 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image2 END AS image2, '.
			//'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image3 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image3 END AS image3, '.
			//'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image4 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image4 END AS image4, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.image1) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.image1 END AS image1, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.image2) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.image2 END AS image2, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.image3) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.image3 END AS image3, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.image4) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.image4 END AS image4, '.
			'v.venue_description as venue_description,v.approx_capacity as approx_capacity,v.available_timming as available_timming,pm.property_name as property_name,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, rcm.rate_category_name as rate_category_name,v.is_hourly_booking as is_hourly_booking,v.booking_hours as booking_hours',
			FALSE
		);
		
		 // Check is_multiple_venues value and adjust join condition
		 $this->db->join('master_venue v', 
		 '(vrm.is_multiple_venues = 0 AND v.venue_id = vrm.single_venue_id)',
		 'LEFT'
	 );
		if(isset($where)){
			if (isset($where['selectedOption'])) {
				// Remove 'selectedOption' from the $where array
				unset($where['selectedOption']);
			}
		}
		// Apply the provided filter conditions
		$this->db->where($where);

		if($where['vrm.is_multiple_venues'] == '0'){
			$this->db->where('v.is_active','1');
		}
		
		  // Check if 'selectedOption' exists in the $where array
		 if(isset($where_tmp))
		 {
			if (isset($where_tmp['selectedOption'])) {
				// Check the value of 'selectedOption'
				if ($where_tmp['selectedOption'] == 1) {
					// Order by 'base_price' in descending order
					$this->db->order_by('vrm.base_price', 'DESC');
				} else {
					// Order by 'base_price' in ascending order (default)
					$this->db->order_by('vrm.base_price', 'ASC');
				}
			} else {
				// 'selectedOption' is not set, order by 'base_price' in ascending order (default)
				$this->db->order_by('vrm.base_price', 'ASC');
			}
		 }
		 
		// Execute the query
		$query = $this->db->get();
		        //echo $this->db->last_query();

		//$results = $query->result();
		$results = $query->result_array();

		$mainResult = array();

		$i = 0;
		foreach($results as $res){

			//Mapped Image Query
			if($res['is_multiple_venues'] == 1){
				$isql = "SELECT image_path FROM venue_image_map WHERE venue_id IN (".$res['venue_ids'].") ORDER BY venue_id ASC";
			} else {
				$isql = "SELECT image_path FROM venue_image_map WHERE venue_id = ".$res['venue_ids']." ORDER BY venue_id ASC";
			}
			$iquery = $this->db->query($isql);
			$irows = $iquery->result_array();

			$mainResult[$i] = $res;
			$mainResult[$i]['venue_image'] = $irows;

			$i++;

		}		

		//echo "<pre>"; print_r($mainResult); die;
	
		// Return the results
		return $mainResult;
	}


	public function getVenueListPropertyWisearray($where = array()) 
	{   
		$where_tmp=$where;
	
		// Specify the main table to query from
		$this->db->from('venue_rate_master vrm');
		
		// Join with other tables
		$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
		
		// Adjust select based on is_multiple_venues value
		$this->db->select(
			'vrm.*,vrm.is_hourly_booking as is_hourly_booking_rate, vrm.booking_hours as booking_hours_rate,' .
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)) ELSE v.venue_name END AS venue_names,'.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN vrm.multiple_venue_ids ELSE vrm.single_venue_id END AS venue_ids,'.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image1 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image1 END AS image1, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image2 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image2 END AS image2, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image3 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image3 END AS image3, '.
			'CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image4 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image4 END AS image4, '.
			'v.venue_description as venue_description,v.approx_capacity as approx_capacity,v.available_timming as available_timming,pm.property_name as property_name,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, rcm.rate_category_name as rate_category_name,v.is_hourly_booking as is_hourly_booking,v.booking_hours as booking_hours',
			FALSE
		);
		
		// Check is_multiple_venues value and adjust join condition
		$this->db->join('master_venue v', '(vrm.is_multiple_venues = 0 AND v.venue_id = vrm.single_venue_id)', 'LEFT');

		if(isset($where)){
			if (isset($where['selectedOption'])) {
				// Remove 'selectedOption' from the $where array
				unset($where['selectedOption']);
			}
		}

		// Apply the provided filter conditions
		$this->db->where($where);
		//$this->db->where('v.is_active','1');

		// Check if 'selectedOption' exists in the $where array
		if(isset($where_tmp))
		{
			if (isset($where_tmp['selectedOption'])) {
				// Check the value of 'selectedOption'
				if ($where_tmp['selectedOption'] == 1) {
					// Order by 'base_price' in descending order
					$this->db->order_by('vrm.base_price', 'DESC');
				} else {
					// Order by 'base_price' in ascending order (default)
					$this->db->order_by('vrm.base_price', 'ASC');
				}
			} else {
				// 'selectedOption' is not set, order by 'base_price' in ascending order (default)
				$this->db->order_by('vrm.base_price', 'ASC');
			}
		}
		 
		// Execute the query
		$query = $this->db->get();
		//echo $this->db->last_query();

		$results = $query->row_array();

		//Mapped Image Query
		if($results['is_multiple_venues'] == 1){
			$isql = "SELECT image_path FROM venue_image_map WHERE venue_id IN (".$results['venue_ids'].") ORDER BY venue_id ASC";
		} else {
			$isql = "SELECT image_path FROM venue_image_map WHERE venue_id = ".$results['venue_ids']." ORDER BY venue_id ASC";
		}
		$iquery = $this->db->query($isql);
        $irows = $iquery->result_array();

		$results['venue_image'] = $irows;

		//echo "<pre>"; print_r($results); die;
	
		// Return the results
		return $results;
	}


	function getVenueBookings($where = array()) {

		// Specify the main table to query from
		$this->db->from('venue_booking vb');		
		// Join with other tables
		$this->db->join('venue_rate_master vrm', 'vb.rate_id = vrm.rate_id');
		$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
		
		// Adjust select based on is_multiple_venues value
		$this->db->select(
			'vrm.*,vb.*,vb.status as booking_status,' .
			'CASE WHEN vrm.is_multiple_venues = 1 
				 THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids))
				 ELSE v.venue_name 
			END AS venue_names,CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image1 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image1 END AS image1, '.
			'v.venue_description as venue_description,v.approx_capacity as approx_capacity,v.available_timming as available_timming,pm.property_name as property_name,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, rcm.rate_category_name as rate_category_name,v.is_hourly_booking as is_hourly_booking,v.booking_hours as booking_hours',
			FALSE
		);
		
		 // Check is_multiple_venues value and adjust join condition
		 $this->db->join('master_venue v', 
		 '(vrm.is_multiple_venues = 0 AND v.venue_id = vrm.single_venue_id)',
		 'LEFT'
	 );
		$this->db->where($where);
		$this->db->order_by('vb.booking_id','DESC');

		$query = $this->db->get();
        //	echo $this->db->last_query(); die;
        //echo "<pre>"; print_r($query->result_array()); die();
        if($query->num_rows() > 0) {
            $result = $query->result_array();
			
            foreach ($result as $key => $q) {
				$this->db->select('*,');
				$this->db->from('venue_booking_details');
				$this->db->where(array('venue_booking_details.booking_id'=>$q['booking_id'])); 
                $query2 = $this->db->get();
				        //echo "<pre>"; print_r($query2->result_array()); 

                $result[$key]['booking_details'] = $query2->result_array();
            }
            // e cho "<pre>"; print_r($result); die();
            return $result;
        }else{
            return [];
        }
    }
	
	public function checkBookingDateAvailabliltyByVenueWise($venueIds) {
		$this->db->from('venue_rate_master');
		$this->db->join('venue_booking', 'venue_rate_master.rate_id = venue_booking.rate_id');
		$this->db->join('venue_booking_details', 'venue_booking.booking_id = venue_booking_details.booking_id');	

		// Check if the venue allows multiple venue IDs
		$this->db->group_start();
		$this->db->where('venue_rate_master.is_multiple_venues', '1');
		if (strpos($venueIds, ',') !== false) {
			$venuesArray = explode(',', $venueIds);
			// Iterate through the array using a foreach loop
			$this->db->group_start();

			foreach ($venuesArray as $venue_id) {
				$this->db->or_where("FIND_IN_SET($venue_id, venue_rate_master.multiple_venue_ids) <> 0");
			}
			$this->db->group_end();

		}
		else {
			$this->db->where("FIND_IN_SET('$venueIds', venue_rate_master.multiple_venue_ids) <> 0");
		}
		//$this->db->where("FIND_IN_SET('$venueIds', venue_rate_master.multiple_venue_ids) <> 0");
		$this->db->group_end();
		
		$this->db->or_group_start();
		$this->db->where('venue_rate_master.is_multiple_venues', '0');
		if (strpos($venueIds, ',') !== false) {
			$venuesArray = explode(',', $venueIds);
			$this->db->group_start();

			// Iterate through the array using a foreach loop
			foreach ($venuesArray as $venue_id) {
				$this->db->or_where('venue_rate_master.single_venue_id', $venue_id);				

			}
			$this->db->group_end();

		}
		else {
			$this->db->where('venue_rate_master.single_venue_id', $venueIds);

			}
		//$this->db->group_start();
		//$this->db->or_where('venue_rate_master.single_venue_id', $venueIds);
		//$this->db->or_where("FIND_IN_SET('$venueIds', venue_rate_master.multiple_venue_ids) <> 0");
		//$this->db->group_end();
		$this->db->group_end();
		// Get the difference in days between start_date and current date (after tomorrow)
		$this->db->where_in('venue_booking.status' , array('1','2','3','4','8'));

		$this->db->select('DATEDIFF(venue_booking_details.start_date, DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS day_difference', false);
		
		$query = $this->db->get();
		//echo $this->db->last_query();die();

		if ($query->num_rows() > 0) {
			 // Filter out rows with null values
			 $result = array_filter($query->result(), function($row) {
				return !is_null($row->day_difference);
			});
			return array_values($result); // Reindex the array
		} else {
			return array(); // No results found
		}
	}

	public function getBlockedVenueDetailsByVenueId($venueIds) {
		$this->db->select('venue_id, from_date, to_date');
		$this->db->from('blocked_venue');
		$this->db->where_in('venue_id', $venueIds);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getGSTSlabByTotalPrice($per_day_rate) {
        // Assuming you have a table named 'venue_gst_slab' to store GST slabs
        $this->db->select('*');
        $this->db->where('startg_price <=', $per_day_rate);
        $this->db->where('ending_price >=', $per_day_rate);
        $query = $this->db->get('venue_gst_slab');
        //echo $this->db->last_query();die;

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false; // No GST slab found for the given total_price
        }
    }

	public function getPaymentParams() {
        // Fetch payment parameters from your database (adjust the query according to your table structure)
		$this->db->select('*');
        $this->db->where('is_active',1);
        $query = $this->db->get('venue_payment_params');
        $paymentParams = $query->row_array();
        return $paymentParams;
    }

	function getCancellationDetails($diff_check_in_out_date){
        $sql = "SELECT COUNT(venue_cancellation_policy_id),ifnull(cancellation_per,0) as cancellation_per FROM  venue_cancellation_policy  WHERE is_active = 0 AND day_from <= {$diff_check_in_out_date} AND day_to >= {$diff_check_in_out_date} group by ifnull(cancellation_per,0)";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;

    }

    function getCancellationRequestDetails($booking_id){
        $sql = "SELECT * FROM venue_cancel_request_tbl WHERE booking_id=".$booking_id." LIMIT 1";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;

    }

	function extra_hours(){
        $sql = "SELECT * FROM venue_extra_hour WHERE is_active = '1'";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;

    }


	/*function bookingDetails($bookingId){

        $sql = "SELECT * FROM venue_booking WHERE booking_id = '".$bookingId."' AND (status = '1' OR status = '2')";
        $query = $this->db->query($sql);
        $result = $query->row_array();


        return $result;

    }*/
	
}