<?php
 class Query extends CI_Model {
    function __construct(){
        parent::__construct();
    }

	function dateRange($from, $to)
    {
        return array_map(function($arg) {
             return date('Y-m-d', $arg);
        }, range(strtotime($from), strtotime($to), 86400));
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

    function getCancellationRequestDetails($booking_id, $cancel_source){
        $sql = "SELECT * FROM cancel_request_tbl WHERE booking_id=".$booking_id." AND cancel_source = '".$cancel_source."' LIMIT 1";
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
	
	function getSafariBookingDetailsByUser($condn) {
		$this->db->select('a.*, c.type_name, d.division_name, e.service_definition, e.start_point, e.end_point, e.reporting_place, s.slot_desc, s.start_time, s.end_time, s.reporting_time, s.ticket_sale_closing_flag, s.ticket_sale_closing_time, p.showing_desc, f.cat_name, cu.first_name, cu.email, cu.mobile');
		$this->db->from('safari_booking_header a');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'LEFT');
		$this->db->join('division_master d', 'a.division_id = d.division_id', 'LEFT');
		$this->db->join('safari_service_header e', 'a.safari_service_header_id = e.safari_service_header_id', 'LEFT');
		$this->db->join('safari_service_period_slot_detail s', 'a.period_slot_dtl_id = s.period_slot_dtl_id', 'LEFT');
		$this->db->join('safari_service_period_master p', 's.service_period_master_id = p.service_period_master_id', 'LEFT');
		$this->db->join('safari_category_master f', 'a.safari_cat_id = f.safari_cat_id', 'LEFT');
		$this->db->join('customer_master cu', 'a.customer_id = cu.customer_id', 'LEFT');
		$this->db->where($condn);
        $result = $this->db->get()->result_array();

		//echo "<pre>"; print_r($result); die;

        return $result;
    }
	
	function route_details($where = []) {
		$this->db->select('a.safari_service_header_id, a.service_period_master_id, b.service_definition, b.reporting_place');
		$this->db->from('safari_service_period_slot_detail a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->group_by('safari_service_header_id');
		$this->db->order_by('service_period_master_id','ASC');
		$query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        $rows = $query->result_array();
		
		if(!empty($rows)){
			$i = 0;
			foreach($rows as $row){
				$this->db->select('c.*');
				$this->db->from('safari_service_period_slot_detail c');
				$this->db->where('safari_service_header_id', $row['safari_service_header_id']);
				$this->db->where('service_period_master_id', $row['service_period_master_id']);
				$query1=$this->db->get();
				//echo nl2br($this->db->last_query());die;
				$rows1 = $query1->result_array();
				
				$result[$i] = $row;
				$result[$i][$row['service_definition']] = $rows1;
	
				$i++;
			}
			
			if($result){
				return $result;
			} else {
				return false;
			}
		}
    }

    

}
