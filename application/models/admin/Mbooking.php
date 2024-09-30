<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbooking extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function search_room($request_data){
        
        
        $sql = "CALL get_property_available_accomm_disc (".$request_data['property_id'].",'".$request_data['check_in_date']."','".$request_data['check_out_date']."',0,0,1,".$request_data['discount_perc'].");";
        //echo $sql;die;
        
        

        // SELECT bd.booking_id,count(bd.booking_detail_id),a.*
        // FROM accommodation a 
        // INNER JOIN booking_detail bd ON bd.accommodation_id = a.accommodation_id AND bd.in_date 
        // WHERE a.property_id = 1 AND (bd.in_date NOT BETWEEN '2022-09-10' AND '2022-09-11') AND () AND is_active = 1 GROUP BY a.accommodation_id ORDER BY bd.booking_id DESC;
        
		
        $query=$this->db->query($sql); 
        $search_room_results = $query->result_array();
        return $search_room_results;
    }  

    public function get_properties(){
        $sql = "SELECT *
        FROM property_master
        WHERE is_active = 1"; 
        $query = $this->db->query($sql);
        return $query->result_array();

    }


    public function get_customer_list(){
        $sql = "SELECT *
        FROM customer_master
        WHERE is_active = 1 ORDER BY first_name ASC"; 
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function get_booking_details($booking_id){
        
		$sql = "SELECT *
        FROM booking_listing_view
        WHERE booking_id = ".$booking_id.""; 
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();

    }

    public function get_booking_detail($booking_id){
        
		$sql = "SELECT *
        FROM booking_listing_view
        WHERE booking_id = ".$booking_id.""; 
        $query = $this->db->query($sql);
        return $query->row_array();

    }

    public function get_booking_payment_details($booking_id){
        
		$sql = "SELECT *
        FROM booking_payment_listing_view
        WHERE booking_id = ".$booking_id.""; 
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function get_property_country($condn = null){
        $this->db->select('country_master.*');
        $this->db->from('country_master');
		$this->db->where($condn);
		$this->db->order_by('country_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_property_state($condn = null){
        $this->db->select('state_master.*');
        $this->db->from('state_master');
		$this->db->where($condn);
		$this->db->order_by('state_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_gymnasiumrate($data){
        $this->db->insert('gymnasium_rates', $data);
        return $this->db->insert_id();
    }

    public function edit_rate($rate_id){
        $this->db->select('gr.*,mey.effective_year');
        $this->db->from('gymnasium_rates gr');
        $this->db->join('master_effective_year mey', 'mey.effective_year_id = gr.effective_year_id', 'inner');
        $this->db->where('gr.status','0');
		$this->db->where('gr.gymnasium_rate_id',$rate_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    

    public function update_rate($condition,$data){
        $result=$this->db->update('gymnasium_rates', $data, $condition);
        return $result;
    }

    

    public function get_getaccommodation($property_id){
        $this->db->select('*');
        $this->db->from('accommodation');
        $this->db->where('is_active','1');
        $this->db->where('property_id',$property_id);
		
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_fieldunit(){
        $this->db->select('*');
        $this->db->from('master_fieldunit');
        $this->db->where('status','0');
		$this->db->order_by('fieldunit_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_gymnasiums($location_id,$slug){
        $this->db->select('*');
        $this->db->from('sports_facilities');
        $this->db->where('status','0');
        $this->db->where('location_id',$location_id);
        $this->db->where('slug',$slug);
		$this->db->order_by('sports_facilities_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_effective_years(){
        $this->db->select('*');
        $this->db->from('master_effective_year');
        $this->db->where('status','0');
		$this->db->order_by('effective_year','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function gymnasium_rate_count($sports_facilities_id,$effective_year_id,$user_type){
        $this->db->select('gymnasium_rate_id');
        $this->db->from('gymnasium_rates');
        $this->db->where('user_type',$user_type);
        $this->db->where('sports_facilities_id',$sports_facilities_id);
        $this->db->where('effective_year_id',$effective_year_id);
        $query=$this->db->get();
        $ret = $query->num_rows();
        return $ret;
    }

    public function gymnasium_schedule_count($rate_id){
        $this->db->select('gymnasium_schedule_id');
        $this->db->from('gymnasium_schedule');
        $this->db->where('gymnasium_rate_id',$rate_id);
        $query=$this->db->get();
        $ret = $query->num_rows();
        return $ret;
    }

    public function update_booking_details($booking_id ='', $data = array()){
        try{
            $this->db->where('booking_id', $booking_id)->update('booking_header', $data);
            return true;
        }catch(Exception $ex){
            return false;
        }
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
	
	public function getBookingData($booking_id = 0) {
		$sql = "SELECT bh.*, bd.adults, bd.children, bd.is_select_extra_bed FROM booking_header bh LEFT JOIN booking_detail bd ON
bh.booking_id = bd.booking_id WHERE bh.booking_id=".$booking_id." GROUP BY bd.booking_id ";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
	}
	
	public function get_payable_amt($booking_id = 0) {
		$sql = "SELECT SUM(room_net_amount) AS payable_amt FROM booking_detail WHERE booking_id=".$booking_id." GROUP BY booking_id ";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
	}
	
	public function update_booking_header_to_history($booking_id) {
		$sql = "INSERT INTO booking_header_hist(booking_header_hist_id, booking_id, booking_no, edit_count, invoice_no, txnid, order_id, property_id, room_count, customer_id, booking_ref_no, invoice_generated, check_in, check_out, disc_coupon_code, disc_coupon_id, booking_for, customer_title, first_name, middle_name, last_name, gender, age, email, mobile_country_code, mobile, personal_address, company_name, company_email, company_phone, gst_number, company_address, company_city, company_pincode, company_state_id, company_country_id, special_request, room_base_price, room_total_discount_perc, room_total_discount, room_price_before_tax, room_total_cgst, room_total_sgst, room_total_igst, room_payable_amount, net_payable_amount, cancellation_charge, booking_status, is_refunded, remarks, cancellation_remarks, created_by, created_user_type, created_ts, updated_by, updated_user_type, updated_ts, total_discount, folio_no, coupon_code, bank_ref_no, bank_ref_date, checked_in, booking_source, search_text, settle_ref_no, hist_created_ts, operation_type)
		
		SELECT '',booking_id, booking_no, edit_count, invoice_no, txnid, order_id, property_id, room_count, customer_id, booking_ref_no, invoice_generated, check_in, check_out, disc_coupon_code, disc_coupon_id, booking_for, customer_title, first_name, middle_name, last_name, gender, age, email, mobile_country_code, mobile, personal_address, company_name, company_email, company_phone, gst_number, company_address, company_city, company_pincode, company_state_id, company_country_id, special_request, room_base_price, room_total_discount_perc, room_total_discount, room_price_before_tax, room_total_cgst, room_total_sgst, room_total_igst, room_payable_amount, net_payable_amount, cancellation_charge, booking_status, is_refunded, remarks, cancellation_remarks, created_by, created_user_type, created_ts, updated_by, updated_user_type, updated_ts, total_discount, folio_no, coupon_code, bank_ref_no, bank_ref_date, checked_in, booking_source, search_text, settle_ref_no,'".date('Y-m-d H:i:s')."','E' FROM booking_header  WHERE booking_id = '".$booking_id."' ";
		$rs = $this->db->query($sql);
	}
	
	public function update_booking_detail_to_history($booking_id) {
		/*$sql = "INSERT INTO booking_detail_hist(booking_detail_hist_id, booking_detail_id, booking_id, accommodation_id, rate_category_id, no_of_rooms, in_date, out_date, adults, children, infants, extra_bed_cnt, rate_id, allotment_status, cancelled_by, cancelled_usertype, cancelled_date, extra_bed_rate, room_rate, room_charge, room_discount_percent, room_discount_amount, room_taxable_amount, room_cgst, room_sgst, room_igst, room_cgst_percent, room_sgst_percent, room_igst_percent, room_net_amount, check_in_id, check_in_detail_id, same_line_item, hist_created_ts, operation_type) 
		
		SELECT '',booking_detail_id, booking_id, accommodation_id, rate_category_id, no_of_rooms, in_date, out_date, adults, children, infants, extra_bed_cnt, rate_id, allotment_status, cancelled_by, cancelled_usertype, cancelled_date, extra_bed_rate, room_rate, room_charge, room_discount_percent, room_discount_amount, room_taxable_amount, room_cgst, room_sgst, room_igst, room_cgst_percent, room_sgst_percent, room_igst_percent, room_net_amount, check_in_id, check_in_detail_id, same_line_item,'".date('Y-m-d H:i:s')."','D' FROM booking_detail WHERE booking_id = '".$booking_id."' ";
		$rs = $this->db->query($sql);
		if($rs){
			$sql_del = "DELETE FROM booking_detail WHERE booking_id = '".$booking_id."' ";
			$rs_del = $this->db->query($sql_del);
		}*/
		
		$sql_del = "DELETE FROM booking_detail WHERE booking_id = '".$booking_id."' ";
		$rs_del = $this->db->query($sql_del);
	}
	
	public function get_pos_details($booking_id = 0)
	{
		$sql = "SELECT psh.*, SUM(psd.payable_amount) AS net_bill_amount, ccm.cost_center_name
				FROM pos_sale_header psh
				
				LEFT JOIN pos_sale_detail psd ON
				psh.sale_order_id = psd.sale_order_id
				
				LEFT JOIN cost_center_master ccm ON
				psh.cost_center_id = ccm.cost_center_id

				WHERE psh.booking_id = ".$booking_id."

				GROUP BY psd.sale_order_id ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function getDataFromBookingPaymentListingView($booking_id = 0){
        
		$sql = "SELECT *
        FROM booking_payment_listing_view
        WHERE booking_id = ".$booking_id." AND (status = 'Success' OR status = 'Successful') "; 
        $query = $this->db->query($sql);
        return $query->row_array();

    }
	
	public function get_booking_detail_sum_data($where = array()){
        $this->db->select('SUM(room_charge) AS tot_room_charge, SUM(room_discount_amount) AS tot_room_discount_amount, SUM(room_taxable_amount) AS tot_room_taxable_amount, SUM(room_cgst) AS tot_room_cgst, SUM(room_sgst) AS tot_room_sgst, SUM(room_igst) AS tot_room_igst, SUM(room_net_amount) AS tot_room_net_amount');
        $this->db->from('booking_detail');
		if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->row_array();
    }
	
}