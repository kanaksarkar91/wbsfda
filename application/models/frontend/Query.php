<?php
 class Query extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getSportsFacilities($page_type, $location_id=null, $sports_infrastructure_id=null) {
    	$facilities = array();
    	$loc_condition = "WHERE sports_facilities.page_type='{$page_type}'";
    	if($location_id) {
    		$loc_condition = " AND sports_facilities.location_id = {$location_id}";
    	}
    	$sql = "SELECT sports_facilities.*, master_location.location_name FROM sports_facilities INNER JOIN master_location on master_location.location_id = sports_facilities.location_id"." ".$loc_condition;
    	$query = $this->db->query($sql);
        //echo $this->db->last_query(); die();
    	if($query->num_rows() > 0) {
    		$facilities = $query->result_array();
    		foreach($facilities as $key=>$facilitie){
    			$sql = "SELECT * FROM sports_facilities_amenitis fa INNER JOIN master_facilities_amenitis ma ON ma.facilities_amenitis_id = fa.facilities_amenitis_id  WHERE fa.sports_facilities_id={$facilitie['sports_facilities_id']}";
    			$query = $this->db->query($sql);
    			$facilities[$key]['amenitis'] = $query->result_array();

    			$sql1 = "SELECT * FROM sports_facilities_infrastructure fi INNER JOIN master_sports_infrastructure si ON si.sports_infrastructure_id = fi.sports_infrastructure_id  WHERE fi.sports_facilities_id={$facilitie['sports_facilities_id']}";
    			$query1 = $this->db->query($sql1);
    			$facilities[$key]['infrastructure'] = $query1->result_array();

    		}
    	}
    	//echo "<pre>"; print_r($facilities); die();
    	return $facilities;
    }

    function getSportsFacility($sports_facilities_id) {
    	$facilitie = array();
    	$sql = "SELECT sports_facilities.*, master_location.location_name FROM sports_facilities INNER JOIN master_location on master_location.location_id = sports_facilities.location_id WHERE sports_facilities.sports_facilities_id={$sports_facilities_id}";
    	$query = $this->db->query($sql);
    	if($query->num_rows() > 0) {
			$facilitie = $query->row_array();

			$sql = "SELECT * FROM sports_facilities_amenitis fa INNER JOIN master_facilities_amenitis ma ON ma.facilities_amenitis_id = fa.facilities_amenitis_id  WHERE fa.sports_facilities_id={$facilitie['sports_facilities_id']}";
			$query = $this->db->query($sql);
			$facilitie['amenitis'] = $query->result_array();

			$sql1 = "SELECT * FROM sports_facilities_infrastructure fi INNER JOIN master_sports_infrastructure si ON si.sports_infrastructure_id = fi.sports_infrastructure_id  WHERE fi.sports_facilities_id={$facilitie['sports_facilities_id']}";
			$query1 = $this->db->query($sql1);
			$facilitie['infrastructure'] = $query1->result_array();

    	}
    	return $facilitie;
    }

    function getSportsFacilityImages($sports_facilities_id) {
        $sql = "SELECT * FROM sports_facilities_images WHERE sports_facilities_images.sports_facilities_id={$sports_facilities_id}";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getSportsFacilityRates($sports_facilities_id, $start_date = null, $end_date = null) {
        if($start_date && $end_date) {
            //echo 'end date - '.$end_date.'<br>';
            //$end_date = '13-07-2022';
            $start_date = str_replace('/', '-', $start_date);
            $end_date = str_replace('/', '-', $end_date);
            //str_replace('/', '-', '13/07/2022')
            $start_date = date('Y-m-d',strtotime($start_date));
            $end_date = date('Y-m-d',strtotime($end_date));
            //echo $start_date.'<br>';
            //echo $end_date; die();
            $dates = $this->dateRange($start_date, $end_date);
        }else{
            //echo date('Y-m-d');
            $dates = $this->dateRange(date('Y-m-d'), date("Y-m-d",strtotime(date('Y-m-d').' +10 days')));
        }
        if(count($dates) > 0) {
            $result = [];
            foreach ($dates as $key => $date) {
                $sql1 = "SELECT * FROM sports_facilities_rates WHERE effective_start_date <= '{$date}' AND effective_end_date >= '{$date}' AND sports_facilities_rates.sports_facilities_id={$sports_facilities_id}";
                $query2 = $this->db->query($sql1);
                //echo $this->db->last_query().'<br>';
                $result[$date]['rates'] = $query2->result_array();
            }
            //echo "<pre>"; print_r($result); die();
            return $result;
        }else{
            return [];
        }
    }

    function getMyBookings($user_id) {
        $sql = "SELECT *, sports_facilities_booking.status as booking_status FROM sports_facilities_booking
        INNER JOIN sports_facilities ON sports_facilities.sports_facilities_id = sports_facilities_booking.sports_facilities_id
        WHERE user_id={$user_id}
        order by booking_id DESC";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        //echo "<pre>"; print_r($query->result_array()); die();
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo "<pre>"; print_r($query->result_array()); die();
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $key => $q) {
                $sql1 = "SELECT * FROM sports_facilities_booking_details
                INNER JOIN organization_category ON organization_category.organization_category_id = sports_facilities_booking_details.organization_type
                WHERE sports_facilities_booking_details.booking_id={$q['booking_id']}";
                $query2 = $this->db->query($sql1);
                $result[$key]['booking_details'] = $query2->result_array();
            }
            // echo "<pre>"; print_r($result); die();
            return $result;
        }else{
            return [];
        }
    }

    function dateRange($from, $to)
    {
        return array_map(function($arg) {
             return date('Y-m-d', $arg);
        }, range(strtotime($from), strtotime($to), 86400));
    }

    function getGymnasiumRates($sports_facilities_id, $user_type) {
        $current_year = date('Y').'-'.date('Y', strtotime('+1 year'));
        //echo $current_year;
        $sql = "SELECT *, master_effective_year.effective_year as effective_year FROM gymnasium_rates
        INNER JOIN master_effective_year ON master_effective_year.effective_year_id = gymnasium_rates.effective_year_id
        WHERE gymnasium_rates.sports_facilities_id='{$sports_facilities_id}' AND gymnasium_rates.user_type = '{$user_type}' AND master_effective_year.effective_year = '{$current_year}'
        order by gymnasium_rate_id DESC";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
        //echo $this->db->last_query(); die();

    }

    function getMemberDetailsByUser_id($user_id) {
        $sql = "SELECT gymnasium_member.*, master_fieldunit.fieldunit_name, master_location.location_name, sports_facilities.sports_facilities_name FROM gymnasium_member
        INNER JOIN master_fieldunit ON master_fieldunit.fieldunit_id = gymnasium_member.division_id
        INNER JOIN master_location ON master_location.location_id = gymnasium_member.location_id
        INNER JOIN sports_facilities ON sports_facilities.sports_facilities_id = gymnasium_member.facilities_id
        WHERE gymnasium_member.user_id='{$user_id}'
        order by gymnasium_member.gymnasium_member_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function getMemberDetails($gymnasium_member_id) {
        $sql = "SELECT gymnasium_member.*, master_fieldunit.fieldunit_name, master_location.location_name, sports_facilities.sports_facilities_name FROM gymnasium_member
        INNER JOIN master_fieldunit ON master_fieldunit.fieldunit_id = gymnasium_member.division_id
        INNER JOIN master_location ON master_location.location_id = gymnasium_member.location_id
        INNER JOIN sports_facilities ON sports_facilities.sports_facilities_id = gymnasium_member.facilities_id
        WHERE gymnasium_member.gymnasium_member_id='{$gymnasium_member_id}'
        order by gymnasium_member.gymnasium_member_id ASC";
        $query = $this->db->query($sql);
        //echo $this->db->last_query(); die();
        $result = $query->row_array();
        return $result;
    }

    function getBookingDetailsByUser_id($user_id) {
        $sql = "SELECT booking_header.*,property_master.property_name,property_master.image1 FROM booking_header
        LEFT JOIN property_master ON property_master.property_id = booking_header.property_id
        WHERE booking_header.customer_id='{$user_id}'
        order by booking_header.booking_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
	
	function getBookingDetailsByUserIdNew($condn) {
		$this->db->select('booking_header.*,property_master.property_name,property_master.image1');
		$this->db->from('booking_header');
		$this->db->join('property_master', 'property_master.property_id = booking_header.property_id', 'LEFT');
		$this->db->where($condn);
        $result = $this->db->get()->result_array();

		//echo "<pre>"; print_r($result); die;

        return $result;
    }

    function getBookingDetailsOfCustomer($booking_id) {
        $sql = "SELECT customer_master.* FROM customer_master
        LEFT JOIN booking_payment ON booking_payment.created_by = customer_master.customer_id
        WHERE booking_payment.booking_id='{$booking_id}'";
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        $result = $query->row_array();
        return $result;
    }
	
	function getBookingDetailsOfCustomerNew($condn) {
		$this->db->select('customer_master.*,country_master.country_name,state_master.state_name');
		$this->db->from('customer_master');
		$this->db->join('country_master', 'country_master.country_id = customer_master.country_id', 'LEFT');
		$this->db->join('state_master', 'state_master.state_id = customer_master.state_id', 'LEFT');
		$this->db->where($condn);
        $result = $this->db->get()->row_array();
        return $result;
    }

    function getguestDetails($booking_id) {
        $sql = "SELECT check_in_guest.* FROM check_in_header
        LEFT JOIN check_in_detail ON check_in_detail.check_in_id = check_in_header.check_in_id
        LEFT JOIN check_in_guest ON check_in_guest.check_in_detail_id = check_in_detail.check_in_detail_id
        WHERE check_in_header.booking_id='{$booking_id}' order by check_in_guest.check_in_guest_id ASC limit 1";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    function getPropertyDetails($booking_id) {
        $sql = "SELECT property_master.*,district_master.district_name,state_master.state_name FROM booking_header
        LEFT JOIN property_master ON property_master.property_id = booking_header.property_id
        LEFT JOIN district_master ON district_master.district_id = property_master.district_id
        LEFT JOIN state_master ON state_master.state_id = property_master.state_id
        WHERE booking_header.booking_id='{$booking_id}'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    function getBookingHeader($booking_id) {
        $sql = "SELECT * FROM booking_header  WHERE booking_id='{$booking_id}'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    function getCustomerData($created_by) {
        $sql = "SELECT concat(ifnull(customer_title,''),' ', ifnull(first_name,''), ' ',ifnull(middle_name,''), ' ',ifnull(last_name,'')) as full_name,email,mobile  FROM customer_master  WHERE customer_id='{$created_by}'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    function getUserData($created_by) {
        $sql = "SELECT full_name,email,contact_no FROM  master_admin  WHERE user_id='{$created_by}'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    function getCancellationDetails($diff_check_in_out_date){
        $sql = "SELECT COUNT(cancellation_policy_id),ifnull(cancellation_per,0) as cancellation_per FROM  cancellation_policy  WHERE is_active = 0 AND day_from <= {$diff_check_in_out_date} AND day_to >= {$diff_check_in_out_date} group by ifnull(cancellation_per,0)";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;

    }

    function getCancellationRequestDetails($booking_id){
        $sql = "SELECT * FROM cancel_request_tbl WHERE booking_id=".$booking_id." LIMIT 1";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;

    }

    public function get_booking_detail($booking_id){
        
		$sql = "SELECT *
        FROM booking_listing_view
        WHERE booking_id = ".$booking_id.""; 
        $query = $this->db->query($sql);
        return $query->row_array();

    }
	
	public function getGstDetails($booking_id){
		
		$sql = "SELECT bd.*, hsn_sac_master.hsn_sac_code FROM booking_detail bd
				LEFT JOIN hotel_gst_slab ON bd.room_igst_percent = hotel_gst_slab.gst_percentage 
				LEFT JOIN hsn_sac_master ON hotel_gst_slab.hsn_sac_code = hsn_sac_master.hsn_sac_id
				WHERE bd.booking_id = '{$booking_id}' ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        $result = $query->result_array();
        return $result;
		
	}


	function getVenueReservations($customerId) {

		// Specify the main table to query from
		$this->db->from('venue_booking vb');		
		// Join with other tables
		$this->db->join('venue_rate_master vrm', 'vb.rate_id = vrm.rate_id');
		$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
        $this->db->join('master_admin ma_user', 'ma_user.user_id = vb.user_id', 'LEFT'); // Join approved_by admin
        $this->db->join('master_admin ma_noc_upload', 'ma_noc_upload.user_id = vb.noc_uploaded_by', 'LEFT'); 
        $this->db->join('master_admin ma_cancelled', 'ma_cancelled.user_id = vb.cancelled_by', 'LEFT'); 

		// Adjust select based on is_multiple_venues value
		$this->db->select(
			'vrm.*,vb.*,vb.status as booking_status,
            CASE vb.status
            WHEN "1" THEN ma_user.full_name
            WHEN "2" THEN ma_user.full_name
            WHEN "4" THEN ma_noc_upload.full_name
            WHEN "5" THEN ma_cancelled.full_name
            ELSE NULL
        END AS approvedorRejected_by_name,' .
			'CASE WHEN vrm.is_multiple_venues = 1 
				 THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids))
				 ELSE v.venue_name 
			END AS venue_names,
            CASE WHEN vrm.is_multiple_venues = 1 
            THEN vrm.multiple_venue_ids
            ELSE vrm.single_venue_id
       END AS venue_ids,CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image1 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image1 END AS image1, '.
			'v.venue_description as venue_description,pm.property_name as property_name,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, rcm.rate_category_name as rate_category_name,v.is_hourly_booking as is_hourly_booking,v.booking_hours as booking_hours',
			FALSE
		);
		
		 // Check is_multiple_venues value and adjust join condition
		 $this->db->join('master_venue v', 
		 '(vrm.is_multiple_venues = 0 AND v.venue_id = vrm.single_venue_id)',
		 'LEFT'
	 );
        $this->db->where_not_in('vb.status', array('0'));
		$this->db->where('vb.user_id', $customerId);
		$this->db->order_by('vb.booking_id','DESC');

		$query = $this->db->get();
        //echo $this->db->last_query();die;
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
            // echo "<pre>"; print_r($result); die();
            return $result;
        }else{
            return [];
        }
    }


	function getVenueBookings($where = array()) {

		// Specify the main table to query from
		$this->db->from('venue_booking vb');		
		// Join with other tables
		$this->db->join('venue_rate_master vrm', 'vb.rate_id = vrm.rate_id');
		$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
		$this->db->join('customer_master cm', 'cm.customer_id = vb.booked_by');
		$this->db->join('district_master dm', 'dm.district_id = pm.district_id');
		$this->db->join('state_master sm', 'sm.state_id = pm.state_id');
		
		// Adjust select based on is_multiple_venues value
		$this->db->select(
			'vrm.*,vb.*,vb.status as booking_status,vb.created_at as transaction_date,vb.updated_at as transaction_date_update,cm.first_name as booking_by_name,cm.mobile as booking_by_mobile,cm.email as booking_by_email,' .
			'CASE WHEN vrm.is_multiple_venues = 1 
				 THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids))
				 ELSE v.venue_name 
			END AS venue_names,CASE WHEN vrm.is_multiple_venues = 1 THEN (SELECT  v.image1 FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids) LIMIT 1) ELSE v.image1 END AS image1, '.
			'v.venue_description as venue_description,v.approx_capacity as approx_capacity,v.available_timming as available_timming,pm.property_name as property_name,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, pm.city as property_city, dm.district_name as property_district, sm.state_name as property_state, pm.pincode as property_pincode, rcm.rate_category_name as rate_category_name,v.is_hourly_booking as is_hourly_booking,v.booking_hours as booking_hours',
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
				//$this->db->select('*,');
				//$this->db->from('venue_booking_details');
				//$this->db->where(array('venue_booking_details.booking_id'=>$q['booking_id'])); 
               //$query2 = $this->db->get();
				        //echo "<pre>"; print_r($query2->result_array()); 

				$sql2 = "SELECT a.*, (SELECT gst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_gst, (SELECT cgst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_cgst, (SELECT sgst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_sgst, (SELECT igst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_igst, (SELECT c.hsn_sac_code FROM venue_gst_slab b LEFT JOIN venue_hsn_sac_master c ON b.hsn_sac_id = c.hsn_sac_id WHERE a.rate >= b.startg_price AND a.rate <= b.ending_price) as hsn_sac_code FROM venue_booking_details a WHERE a.booking_id = '".$q['booking_id']."'";
				$query2 = $this->db->query($sql2);
        		//$rows = $query->result_array();

                $result[$key]['booking_details'] = $query2->result_array();
            }
            // e cho "<pre>"; print_r($result); die();
            return $result;
        }else{
            return [];
        }
    }
	
	
	public function get_approval_letter($booking_id){ 
        $this->db->select('sfb.*,sfb.created_at as venue_booking_created_at,vrm.*,CASE WHEN vrm.is_multiple_venues = 1 
        THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids))
        ELSE v.venue_name 
        END AS venue_names,pm.property_name as property_name,pm.gst_no as property_gst_no,pm.address_line_1 as property_address_line_1,pm.address_line_2 as property_address_line_2,pm.state_id as property_state_code,sm.state_name,ds.district_name,pm.city as property_city,pm.pincode as property_pincode,pm.phone_no as property_phone_no,pm.mobile_no as property_mobile_no,pm.email as property_email,pm.geo_latitude as property_geo_latitude,pm.geo_longitude as property_geo_longitude,pm.google_map_address as property_google_map_address, u.mobile, u.email, u.first_name,u.middle_name,u.last_name');
        $this->db->select("GROUP_CONCAT(DATE_FORMAT(sfbd.start_date, '%d-%m-%Y')) as start_date", FALSE);
        $this->db->from('venue_booking sfb');
        $this->db->join('venue_booking_details sfbd', 'sfbd.booking_id = sfb.booking_id');
        $this->db->join('customer_master u', 'u.customer_id = sfb.user_id');
        $this->db->join('venue_rate_master vrm', 'vrm.rate_id = sfb.rate_id');
        $this->db->join('master_venue v', '(vrm.is_multiple_venues = 0 AND v.venue_id = vrm.single_venue_id)', 'LEFT');
    	$this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
		$this->db->join('state_master sm', 'pm.state_id = sm.state_id');
		$this->db->join('district_master ds', 'pm.district_id = ds.district_id');
    	$this->db->where('sfb.booking_id', $booking_id);
        
        $query = $this->db->get();
        return $query->row_array();
        
    }


	public function get_booking_slip_details($booking_id){ 
        /*$this->db->select('*');
        $this->db->from('venue_booking_details');
        if($booking_id){
                $this->db->where('booking_id', $booking_id);
            }
        $query=$this->db->get();
        return $query->result_array();*/

		$sql = "SELECT a.*, b.rate_id, CASE WHEN c.is_multiple_venues = 1 
        THEN (SELECT GROUP_CONCAT(v.venue_name) FROM master_venue v WHERE FIND_IN_SET(v.venue_id, c.multiple_venue_ids))
        ELSE (SELECT v.venue_name FROM master_venue v WHERE c.is_multiple_venues = 0 AND v.venue_id = c.single_venue_id) 
        END AS venue_names, (SELECT gst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_gst, (SELECT cgst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_cgst, (SELECT sgst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_sgst, (SELECT igst_percentage FROM venue_gst_slab WHERE a.rate >= startg_price AND a.rate <= ending_price) as v_igst, (SELECT c.hsn_sac_code FROM venue_gst_slab b LEFT JOIN venue_hsn_sac_master c ON b.hsn_sac_id = c.hsn_sac_id WHERE a.rate >= b.startg_price AND a.rate <= b.ending_price) as hsn_sac_code FROM venue_booking_details a LEFT JOIN venue_booking b ON a.booking_id = b.booking_id LEFT JOIN venue_rate_master c ON b.rate_id = c.rate_id WHERE a.booking_id = '".$booking_id."'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		return $rows;
      
    }
	
	
	public function get_payment_details_online($booking_id){ 

        /*$this->db->select('*');
        $this->db->from('venue_payment');
        if($booking_id){
                $this->db->where('booking_id', $booking_id);
            }
        $query=$this->db->get();
        return $query->result_array();*/

		$sql = "SELECT * FROM venue_payment WHERE booking_id = '".$booking_id."' AND status = 'Success'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		return $rows;
       
    }


	public function getVenueEventtype(){ 

		$sql = "SELECT * FROM venue_event_type_master WHERE is_active = 1";
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		return $rows;
       
    }

    

}
