<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreservation extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_reservations(){
        $sql = "SELECT sfb.*,sf.sports_facilities_name,oc.category_name,ml.location_name,mf.fieldunit_name
        FROM sports_facilities_booking sfb
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = sfb.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        INNER JOIN users u ON u.user_id = sfb.user_id
        order by sfb.booking_id DESC"; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_reservation_details($booking_id){
        $sql = "SELECT sfb.*,
        ifnull(ma.full_name,'') as discount_given_by,date_format(discount_given_ts,'%d-%m-%Y %H:%i:%s') as discount_given_ts,
        ifnull(ma1.full_name,'') as approved_by,date_format(approved_ts,'%d-%m-%Y %H:%i:%s') as approved_ts,date_format(approval_valid_till,'%d-%m-%Y %H:%i:%s') as approval_valid_till,
        ifnull(ma2.full_name,'') as rejected_by,date_format(rejected_ts,'%d-%m-%Y %H:%i:%s') as rejected_ts,
        sf.sports_facilities_name,oc.category_name,ml.location_name,mf.fieldunit_name,u.mobile,(SELECT IF(MIN(DATE(sfbd.start_date)) < CURDATE(),1,0) FROM sports_facilities_booking_details sfbd WHERE sfbd.booking_id = sfb.booking_id) as is_event_started
        FROM sports_facilities_booking sfb
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = sfb.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        INNER JOIN users u ON u.user_id = sfb.user_id
        LEFT JOIN master_admin ma ON ma.user_id = sfb.discount_given_by
        LEFT JOIN master_admin ma1 ON ma1.user_id = sfb.approved_by
        LEFT JOIN master_admin ma2 ON ma2.user_id = sfb.rejected_by
        WHERE sfb.booking_id = '".$booking_id."'"; 
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function check_not_responded_booking(){
        $sql = "SELECT sfb.booking_id,sfbd.start_date,IF(MIN(DATE(sfbd.start_date)) < CURDATE(),1,0) as is_event_started,sfb.status 
        FROM sports_facilities_booking_details sfbd  
        INNER JOIN sports_facilities_booking sfb ON sfb.booking_id = sfbd.booking_id
        WHERE sfb.status NOT IN ('3','4','5')
        GROUP BY sfbd.booking_id HAVING is_event_started = 1"; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    

    public function get_reservation_booking_details($request_data = array()){  
        $sql = "SELECT bh.*,pm.property_name  
        
        FROM booking_header bh
        INNER JOIN property_master pm ON pm.property_id = bh.property_id";
        
        //INNER JOIN booking_detail bd ON bd.booking_id=bh.booking_id WHERE bh.booking_id > 0";
        if(!empty($request_data['property_id'])){
            $sql .=" AND pm.property_id IN('".$request_data['property_id']."')";
        }
        if(!empty($request_data['booking_status'])){
            $sql .=" AND bh.booking_status ='".$request_data['booking_status']."'";
        }
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_properties(){
        $sql = "SELECT *
        FROM property_master
        WHERE is_active = 1"; 
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    

    public function get_sports_facilities_booking_details($booking_id){ 
        $sql = "SELECT *
        FROM sports_facilities_booking_details
        WHERE booking_id = '".$booking_id."'"; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    

    public function submit_fieldunit($data){
        $this->db->insert('master_fieldunit', $data);
        return $this->db->insert_id();
    }

    public function edit_fieldunit($fieldunit_id){
        $this->db->select('fieldunit_id,fieldunit_name,status');
        $this->db->from('master_fieldunit');
		$this->db->where('fieldunit_id',$fieldunit_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_reservation($data,$condition){
        $result=$this->db->update('sports_facilities_booking', $data, $condition);
        return $result;
    }

    public function delete_fieldunit($condition,$data){
        $result=$this->db->update('master_fieldunit', $data, $condition);
        return $result;
    }

    public function get($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('bh.*, CONCAT(ifnull(bh.customer_title,""), " ", ifnull(bh.first_name,""), " ", ifnull(bh.middle_name,""), " ", bh.last_name) customer_name, pm.property_name, customer_master.designation, get_accomm_names(bh.booking_id) accommodation_name')
                                ->from('booking_header bh')
								->join('customer_master', 'bh.customer_id = customer_master.customer_id', 'LEFT')
                                ->join('property_master pm', 'pm.property_id=bh.property_id');
								
								
        //$sql = $this->db->select('DISTINCT(bh.booking_id), bh.*, CONCAT(ifnull(bh.customer_title,""), " ", ifnull(bh.first_name,""), " ", ifnull(bh.middle_name,""), " ", bh.last_name) customer_name, pm.property_name, accommodation.accommodation_name')
        //                        ->from('booking_header bh')
        //                        ->join('property_master pm', 'pm.property_id=bh.property_id')
		//						->join('booking_detail bd', 'bh.booking_id = bd.booking_id')
		//						->join('accommodation', 'bd.accommodation_id = accommodation.accommodation_id');
		//						
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($property_ids) && is_array($property_ids)){
            $this->db->where_in('pm.property_id', $property_ids);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }
	
	public function get_foreigner($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('bh.*, pm.property_name, get_accomm_names(bh.booking_id) accommodation_name, bfd.foreigner_name, bfd.foreigner_age, bfd.foreigner_gender, bfd.foreigner_nationality')
                                ->from('booking_header bh')
                                ->join('property_master pm', 'pm.property_id=bh.property_id')
								->join('booking_foreigner_details bfd', 'bfd.booking_id=bh.booking_id');
								
								
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($property_ids) && is_array($property_ids)){
            $this->db->where_in('pm.property_id', $property_ids);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }

    public function get_booking_details($booking_id){

        $result = array();

        $sql = "SELECT a.*, b.property_name, b.property_type_id, c.property_type_name, c.is_hall FROM booking_header a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN property_types c ON b.property_type_id = c.id WHERE a.booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        $sql1 = "SELECT a.*, b.accommodation_name FROM booking_detail a LEFT JOIN accommodation b ON a.accommodation_id = b.accommodation_id WHERE a.booking_id = ".$booking_id."";
        $query1 = $this->db->query($sql1);
        $rows = $query1->result_array();
        
        $result = $row;
        $result['b_details'] = $rows;

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }

    public function get_booking_details_cdetails($booking_id){

        $result = array();

        $sql = "SELECT a.*, b.property_name, b.property_type_id, b.checkin_time AS p_checkin_time, b.checkout_time AS p_checkout_time, c.property_type_name, c.is_hall FROM booking_header a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN property_types c ON b.property_type_id = c.id WHERE a.booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        $sql1 = "SELECT a.*, b.accommodation_name, c.room_no FROM booking_detail a LEFT JOIN accommodation b ON a.accommodation_id = b.accommodation_id LEFT JOIN check_in_detail c ON a.booking_detail_id = c.booking_detail_id WHERE a.booking_id = ".$booking_id." ORDER BY booking_detail_id ASC, in_date ASC, out_date ASC";
        $query1 = $this->db->query($sql1);
        $rows = $query1->result_array();
		
		$sql2 = "SELECT SUM(room_net_amount) AS payable_amt FROM booking_detail WHERE booking_id=".$booking_id." GROUP BY booking_id ";
        $query2 = $this->db->query($sql2);
        $row2 = $query2->row_array();
		
		$sql3 = "SELECT * FROM check_in_guest WHERE booking_id = ".$booking_id."";
        $query3 = $this->db->query($sql3);
        $rows2 = $query3->result_array();
        
        $result = $row;
        $result['b_details'] = $rows;
		$result['payable'] = $row2;
		$result['guest_details'] = $rows2;

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }

    public function get_booking_headers($booking_id){

        $sql = "SELECT * FROM booking_header WHERE booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        //echo "<pre>"; print_r($result); die;

        return $row;
        
    }

    public function get_bookingdetails($bd_id){

        $sql = "SELECT * FROM booking_detail WHERE booking_detail_id = ".$bd_id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        //echo "<pre>"; print_r($result); die;

        return $row;
        
    }

    public function check_checkin($booking_id){

        $sql = "SELECT * FROM check_in_header WHERE booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if($num > 0){
            return true;
        } else {
            return false;
        }

    }

    public function insert_checkin_headers($data_header){

        $sql = "INSERT INTO check_in_header (booking_id, property_id, room_count, customer_id, check_in, check_out, room_base_price, room_total_discount, room_price_before_tax, room_total_cgst, room_total_sgst, room_total_igst, room_payable_amount, net_payable_amount, created_by, created_ts, updated_by) VALUES ('".$data_header['booking_id']."', '".$data_header['property_id']."', '".$data_header['room_count']."', '".$data_header['customer_id']."', '".$data_header['check_in']."', '".$data_header['check_out']."', '".$data_header['room_base_price']."', '".$data_header['room_total_discount']."', '".$data_header['room_price_before_tax']."', '".$data_header['room_total_cgst']."', '".$data_header['room_total_sgst']."', '".$data_header['room_total_igst']."', '".$data_header['room_payable_amount']."', '".$data_header['net_payable_amount']."', '".$data_header['created_by']."', '".$data_header['created_ts']."', '".$data_header['updated_by']."')";
        $query = $this->db->query($sql);
        $insert_id = $this->db->insert_id();	
        
        if($query){
            //$usql = "UPDATE booking_header SET booking_status = 'A' WHERE booking_id = ".$data_header['booking_id']."";
            //$uquery = $this->db->query($usql);

            $usql1 = "UPDATE booking_detail SET allotment_status = 'I' WHERE booking_id = ".$data_header['booking_id']."";
            $uquery1 = $this->db->query($usql1);

            return $insert_id;
        }
        
    }

    public function insert_checkin_details($data_details, $is_hall, $booking_id){

        $sql = $this->db->insert_batch('check_in_detail', $data_details);

        if($sql){

            $usql3 = "UPDATE booking_header SET checked_in = 1 WHERE booking_id = ".$booking_id."";
            $uquery3 = $this->db->query($usql3);

            return true;
        }

    }

    public function guest_booking_details($booking_id){

        $sql = "SELECT a.*, b.accommodation_name, c.room_no, c.check_in_detail_id, (SELECT SUM(adults+children+infants) FROM check_in_detail WHERE booking_detail_id = a.booking_detail_id) as total_guest FROM booking_detail a LEFT JOIN accommodation b ON a.accommodation_id = b.accommodation_id LEFT JOIN check_in_detail c ON a.booking_detail_id = c.booking_detail_id WHERE a.booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $rows = $query->result_array();

        //echo "<pre>"; print_r($rows); die;

        return $rows;
        
    }

    public function insert_guest_details($data_details, $booking_id){
        $sql = $this->db->insert_batch('check_in_guest', $data_details);
		return true;
    }

    public function checkout_submit($data){

        $usql = "UPDATE check_in_detail SET allotment_status = 'O', actual_checkout_time = '".$data['actual_checkout_time']."' WHERE booking_detail_id = ".$data['booking_details_id']."";
        $uquery = $this->db->query($usql);

        if($uquery){

            $usql1 = "UPDATE booking_detail SET allotment_status = 'O' WHERE booking_detail_id = ".$data['booking_details_id']."";
            $uquery1 = $this->db->query($usql1);

            if($uquery1){

                $csql = "SELECT * FROM booking_detail WHERE booking_id = ".$data['booking_id']." AND allotment_status = 'I'";
                $cquery = $this->db->query($csql);
                $num = $cquery->num_rows(); 

                if($num > 0){
                    return true;
                } else {

                    $usql3 = "UPDATE booking_header SET booking_status = 'O', updated_ts = '".date('Y-m-d H:i:s')."' WHERE booking_id = ".$data['booking_id']."";
                    $uquery3 = $this->db->query($usql3);
					
					if($uquery3){
						$usql4 = "UPDATE booking_header SET invoice_no = '".$data['invoice_no']."' WHERE booking_id = ".$data['booking_id']."";
                    	$uquery4 = $this->db->query($usql4);
						
						return true;
					}

                    

                }

            }

        }
        
    }

    public function checkin_guest_details($booking_id){

        $result = array();
        
        $sql = "SELECT a.*, b.property_name, (SELECT CONCAT(adults, '-', children) FROM booking_detail WHERE booking_detail.booking_id = a.booking_id GROUP BY booking_id ) AS adult_children FROM booking_header a LEFT JOIN property_master b ON a.property_id = b.property_id WHERE a.booking_id = ".$booking_id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        $sql1 = "SELECT * FROM check_in_guest WHERE booking_id = ".$booking_id."";
        $query1 = $this->db->query($sql1);
        $rows = $query1->result_array();

        $result = $row;
        $result['guest_details'] = $rows;

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }

	function checkin_checkout_details($condn = null) {
		$this->db->select('check_in_header.*, check_in_detail.*, booking_header.*, property_master.*, check_in_header.created_ts AS check_in_date_time');
		$this->db->from('check_in_header');
		$this->db->join('check_in_detail', 'check_in_header.check_in_id = check_in_detail.check_in_id', 'LEFT');
		//$this->db->join('booking_detail', 'check_in_detail.booking_detail_id = booking_detail.booking_detail_id', 'LEFT');
		$this->db->join('booking_header', 'check_in_header.booking_id = booking_header.booking_id', 'LEFT');
		$this->db->join('property_master', 'booking_header.property_id = property_master.property_id', 'LEFT');
		if (!is_null($condn))
			foreach ($condn as $key => $value)
				$this->db->where($key, $value);
		$result = $this->db->get();
		return $result->result();
	}
	
	public function get_failed_txn($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('bh.*, CONCAT(ifnull(bh.customer_title,""), " ", ifnull(bh.first_name,""), " ", ifnull(bh.middle_name,""), " ", bh.last_name) customer_name, pm.property_name, get_accomm_names(bh.booking_id) accommodation_name')
		->from('booking_header_failed bh')
		->join('property_master pm', 'pm.property_id=bh.property_id');
								
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($property_ids) && is_array($property_ids)){
            $this->db->where_in('pm.property_id', $property_ids);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }
	
	    public function move_failed_txn_to_main($booking_id){

			if($booking_id){
				//$sql = "call failed_txn_to_main_table(".$booking_id.");";				
				//$sql_result = $this->db->query($sql);
				return true;
			}

    }
	
	public function get_booking_detail_details($booking_id){

        $sql1 = "SELECT a.*, b.accommodation_name FROM booking_detail a LEFT JOIN accommodation b ON a.accommodation_id = b.accommodation_id WHERE a.booking_id = ".$booking_id."";
        $query1 = $this->db->query($sql1);
        $rows = $query1->result_array();
        

        return $rows;
        
    }
	
	public function get_available_room_bak($accommodation_id = 0, $today = ''){
		$sql = "SELECT *
				  FROM accommodation_room_mapping AS arm
				 WHERE arm.room_no NOT IN(
					SELECT cd.room_no
					  FROM check_in_detail AS cd
					 WHERE cd.in_date <= '".$today."'
					   AND cd.out_date >   '".$today."'
					    AND allotment_status ='I'
					    AND cd.accommodation_id = '".$accommodation_id."'
				   )
				   
				  AND arm.accomodation_id = '".$accommodation_id."'
				";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        $rows = $query->result_array();
		
		return $rows;
	}
	
	public function get_available_room($accommodation_id = 0, $in_date = '', $out_date = ''){
		$sql = "SELECT * FROM accommodation_room_mapping AS arm
				WHERE arm.accomodation_id='".$accommodation_id."'
				AND NOT exists (
				SELECT cd.room_no
				  FROM check_in_detail AS cd
				 WHERE cd.in_date between '".$in_date."'  and '".$out_date."' 
					AND allotment_status ='I'
					and arm.room_no=cd.room_no
					AND cd.accommodation_id = arm.accomodation_id
				)
				AND NOT EXISTS
				( SELECT ba.room_no FROM blocked_accommodation AS ba 
					WHERE (ba.from_date >= '".$in_date."' AND ba.from_date < '".$out_date."' OR ba.to_date >= '".$in_date."' AND ba.to_date < '".$out_date."')
					AND arm.room_no=ba.room_no AND ba.accommodation_id = arm.accomodation_id 
				)
				";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        $rows = $query->result_array();
		
		return $rows;
	}
	
	public function get_booking_guests($booking_id = 0){
		$sql = "SELECT (adults + children) AS guests FROM booking_detail WHERE booking_id = ".$booking_id." AND adults != '' ORDER BY adults DESC LIMIT 1";
		/*$sql = "SELECT *
        FROM booking_listing_view
        WHERE booking_id = ".$booking_id."";*/
		
		$query = $this->db->query($sql);
        $row = $query->row_array();
		
		return $row['guests'];
	}
	
	public function get_first_child_same_line_item($booking_id = 0, $accommodation_id = 0, $same_line_item = 0){
		$sql = "SELECT booking_detail_id FROM booking_detail WHERE booking_id = ".$booking_id." AND accommodation_id = ".$accommodation_id ." AND same_line_item = ".$same_line_item." GROUP BY same_line_item ORDER BY booking_detail_id ASC LIMIT 1 ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query($sql);
        $row = $query->row_array();
		
		return $row;
	}
	
	public function getMaxInvoiceNo($property_id = 0, $financialStartYear = ''){
		/*$sql = "SELECT * FROM (SELECT MAX(CAST(SUBSTRING_INDEX(invoice_no, '/', -1) AS UNSIGNED)) AS highest_invoice_number, MAX(invoice_no) AS invNo, CASE WHEN MONTH(MAX(updated_ts)) >= 4 THEN DATE_FORMAT(updated_ts, '%y') ELSE DATE_FORMAT(updated_ts, '%y') - 1 END AS financial_year FROM booking_header WHERE property_id = ".$property_id." AND booking_status = 'O' ) AS temp WHERE temp.financial_year = '".$financialStartYear."' ";*/
		
		$sql = "SELECT * FROM (SELECT MAX(invoice_no) AS highest_invoice_number, CASE WHEN MONTH(MAX(updated_ts)) >= 4 THEN DATE_FORMAT(updated_ts, '%y') ELSE DATE_FORMAT(updated_ts, '%y') - 1 END AS financial_year FROM booking_header WHERE property_id = ".$property_id." AND booking_status = 'O' ) AS temp WHERE temp.financial_year = '".$financialStartYear."' ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query($sql);
        $row = $query->row_array();
		
		return $row;
	}
	
	
}