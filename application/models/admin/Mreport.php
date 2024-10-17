<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreport extends CI_Model {

    public function __construct() {
		
        parent::__construct();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		
    }
	
	
	public function get_occupancy_report($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('a.accommodation_id, a.accommodation_name, a.no_of_accomm, a.is_dormitory, pm.property_id, pm.property_name, rm.base_price')
                                ->from('accommodation a')
                                ->join('property_master pm', 'a.property_id = pm.property_id')
								->join('rate_master rm', 'a.accommodation_id = rm.accommodation_id');
								
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
	
	public function get_booking($where = array()){
		$sql = "SELECT COUNT(*) AS total_count FROM (SELECT SUM(bh.room_count) AS total_booking
				FROM booking_header bh
				
				LEFT JOIN booking_detail bd ON
				bh.booking_id = bd.booking_id
				
				WHERE bh.check_in >= '".$where['start_date']."' AND bh.check_in <= '".$where['end_date']."'
				AND bd.accommodation_id = ".$where['accommodation_id']."
				
				GROUP BY bd.booking_id) AS temp";
		
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>';
        return $query->row_array();
	}
	
	public function getAccomNumRow(){
		$sql = "SELECT COUNT(*) AS total_accom FROM accommodation
				LEFT JOIN property_master ON
				accommodation.property_id = property_master.property_id
				GROUP BY accommodation.property_id
				ORDER BY property_master.property_name ASC ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>';
        return $query->result_array();
	}
	
	
	public function get_cancellation_lists($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('bh.*, CONCAT(ifnull(bh.customer_title,""), " ", ifnull(bh.first_name,""), " ", ifnull(bh.middle_name,""), " ", bh.last_name) customer_name, pm.property_name, get_accomm_names(bh.booking_id) accommodation_name, crt.created_ts AS cancellation_date, crt.cancel_refund_request_id, crt.refunded_amount')
                                ->from('booking_header bh')
                                ->join('property_master pm', 'pm.property_id=bh.property_id')
								->join('cancel_request_tbl crt', 'crt.booking_id=bh.booking_id');
								
								
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
	
	public function payment_summary_data($property_id = '', $cost_center_id = '', $where_mode = '', $value = '', $property_ids = array(), $modes = array()){ 
        $sql = $this->db->select('SUM(a.amount) AS total')
                                ->from('booking_payment a')
                                ->join('booking_header b', 'a.booking_id=b.booking_id', 'LEFT')
								->join('pos_sale_header c', 'a.sale_order_id=c.sale_order_id', 'LEFT');
								
								
        $this->db->where('(a.status = "Success" OR a.status = "success" OR a.status = "SUCCESS")');
		if($cost_center_id != ''){
			$this->db->where('c.cost_center_id', $cost_center_id);
		}
		else{
            $this->db->where('b.property_id', $property_id);
        }
		
		if($where_mode != ''){
			$this->db->where('a.payment_mode', $where_mode);
		}
		if($value != ''){
			$this->db->where('DATE(a.payment_date)', $value);
		}
        if(!empty($property_ids) && is_array($property_ids)){
            if($cost_center_id == ''){
				$this->db->where_in('b.property_id', $property_ids);
			}
        }
		if(!empty($modes) && is_array($modes)){
            //$this->db->where_in('a.payment_mode', $modes);
			$this->db->where('a.payment_mode !=', 'Cash');
			$this->db->where('a.payment_mode !=', 'Standalone EDC');
        }
		
        return $result = $sql->get()->row();
    }
	
	public function get_revenue_details($period){

        $result = array();
		
		foreach ($period as $dt) {
			$showingMonth =  $dt->format("F y");
			$queryMonth = $dt->format("m");
			$queryYear = $dt->format("Y");
			
			$sql = "SELECT temp.*, SUM(revenue) AS total_revenue FROM (SELECT pm.*,
					(SELECT SUM(booking_payment.amount) FROM booking_payment WHERE booking_payment.booking_id = bh.booking_id 
					AND (booking_payment.status = 'success' OR booking_payment.status = 'Success') AND MONTH(booking_payment.payment_date) = ".$queryMonth." AND YEAR(booking_payment.payment_date) = ".$queryYear."  GROUP BY booking_payment.booking_id) AS revenue 
					
					FROM property_master pm
					
					LEFT JOIN booking_header bh ON
					pm.property_id = bh.property_id
					
					LEFT JOIN booking_payment bp ON
					bh.booking_id = bp.booking_id
					
					) AS temp
					
					WHERE temp.is_active = 1
					
					GROUP BY property_id 
					ORDER BY property_id ASC";
					
			$query = $this->db->query($sql);
        	$rows = $query->result_array();
			
			if(!empty($rows)){
				foreach($rows as $row){
					$result[$showingMonth][] = array(
						'show_month' => $showingMonth,
						'property_name' => $row['property_name'],
						'total_revenue' => $row['total_revenue']
					);
				}
			}
			else {
				$result = '';
			}
			
			
		}

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }
	
	public function get_revenue_details_property_id($period, $property_ids = ''){

        $result = array();
		
		foreach ($period as $dt) {
			$showingMonth =  $dt->format("F y");
			$queryMonth = $dt->format("m");
			$queryYear = $dt->format("Y");
			
			$sql = "SELECT temp.*, SUM(revenue) AS total_revenue FROM (SELECT pm.*,
					(SELECT SUM(booking_payment.amount) FROM booking_payment WHERE booking_payment.booking_id = bh.booking_id 
					AND (booking_payment.status = 'success' OR booking_payment.status = 'Success') AND MONTH(booking_payment.payment_date) = ".$queryMonth." AND YEAR(booking_payment.payment_date) = ".$queryYear."  GROUP BY booking_payment.booking_id) AS revenue 
					
					FROM property_master pm
					
					LEFT JOIN booking_header bh ON
					pm.property_id = bh.property_id
					
					LEFT JOIN booking_payment bp ON
					bh.booking_id = bp.booking_id
					
					) AS temp
					
					WHERE temp.is_active = 1
					
					";
			
			if($property_ids != ''){
				if(is_array($property_ids)){
					$pIds = implode(',', $property_ids);
					$sql .= " AND property_id IN (".$pIds.")";
				}
			}
			
			$sql .= " GROUP BY property_id ORDER BY property_name ASC"; 
					
			$query = $this->db->query($sql);
			//echo $this->db->last_query(); die;
        	$rows = $query->result_array();
			
			if(!empty($rows)){
				foreach($rows as $row){
					$result[$showingMonth][] = array(
						'show_month' => $showingMonth,
						'property_name' => $row['property_name'],
						'total_revenue' => $row['total_revenue']
					);
				}
			}
			else {
				$result = '';
			}
			
			
		}

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }
	
	public function get_food_sale_details($period){

        $result = array();
		
		foreach ($period as $dt) {
			$showingMonth =  $dt->format("F y");
			$queryMonth = $dt->format("m");
			$queryYear = $dt->format("Y");
			
			$sql = "SELECT * FROM cost_center_master WHERE is_active = 1 ";
			
			/*$sql = "SELECT temp.*, SUM(revenue) AS total_food_revenue FROM (SELECT ccm.*,
					(SELECT SUM(booking_payment.amount) FROM booking_payment WHERE booking_payment.sale_order_id = psh.sale_order_id 
					AND (booking_payment.status = 'success' OR booking_payment.status = 'Success' OR booking_payment.status = 'SUCCESS') AND MONTH(booking_payment.payment_date) = ".$queryMonth." AND YEAR(booking_payment.payment_date) = ".$queryYear.") AS revenue 
					
					FROM cost_center_master ccm
					
					LEFT JOIN pos_sale_header psh ON
					ccm.cost_center_id = psh.cost_center_id
					
					LEFT JOIN booking_payment bp ON
					psh.sale_order_id = bp.sale_order_id
					
					) AS temp
					
					GROUP BY cost_center_id
					
					ORDER BY cost_center_id ASC ";*/
					
			$query = $this->db->query($sql);
        	$rows = $query->result_array();
			
			if(!empty($rows)){
				foreach($rows as $row){
					
					$sql_withoutGst = "SELECT SUM(psd.price) AS bill_amount_without_gst, ccm.cost_center_name, psh.cost_center_id
										FROM pos_sale_detail psd
										
										LEFT JOIN pos_sale_header psh ON psd.sale_order_id = psh.sale_order_id
										LEFT JOIN cost_center_master ccm ON psh.cost_center_id = ccm.cost_center_id
										LEFT JOIN booking_payment bp ON psh.sale_order_id = bp.sale_order_id
										
										WHERE psh.cost_center_id = ".$row['cost_center_id']."
										AND bp.status = 'Success'
										AND MONTH(bp.payment_date) = ".$queryMonth." AND YEAR(bp.payment_date) = ".$queryYear." ";
					
					$query = $this->db->query($sql_withoutGst);
        			$rowWithoutGst = $query->row_array();
					
					
					$sql_withGst = "SELECT SUM(booking_payment.amount) AS bill_amount_with_gst, cost_center_master.cost_center_name
										FROM booking_payment
										
										INNER JOIN pos_sale_header ON
										booking_payment.sale_order_id = pos_sale_header.sale_order_id
										
										INNER JOIN cost_center_master ON
										pos_sale_header.cost_center_id = cost_center_master.cost_center_id
										
										WHERE pos_sale_header.cost_center_id = ".$row['cost_center_id']."
										AND booking_payment.status = 'Success'
										AND MONTH(booking_payment.payment_date) = ".$queryMonth." AND YEAR(booking_payment.payment_date) = ".$queryYear." ";
					
					$query = $this->db->query($sql_withGst);
        			$rowWithGst = $query->row_array();
					
					$result[$showingMonth][] = array(
						'show_month' => $showingMonth,
						'ccs_name' => $row['cost_center_name'],
						'total_food_revenue' => $rowWithGst['bill_amount_with_gst'],
						'total_food_revenue_without_gst' => $rowWithoutGst['bill_amount_without_gst']
					);
				}
			}
			else {
				$result = '';
			}
			
			
		}

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }
	
	public function get_sale_categories($property_id = 0, $cost_center_id = '', $start_date = '', $end_date = ''){
		$sql = "SELECT a.*, c.category_id, d.category_name

				FROM pos_sale_detail a
				
				LEFT JOIN pos_sale_header b ON
				a.sale_order_id = b.sale_order_id
				
				LEFT JOIN product_service_master c ON
				a.product_service_id = c.product_service_id
				
				LEFT JOIN category_master d ON
				c.category_id = d.category_id
				
				WHERE b.property_id = ".$property_id." ";
		
		if($cost_center_id != ''){
			$sql .= " AND b.cost_center_id = ".$cost_center_id." ";
		}
		if($start_date != '' && $end_date != ''){
			$sql .= " AND DATE(b.created_ts) >= '".$start_date."' AND DATE(b.created_ts) <= '".$end_date."' ";
		}
		
		$sql .= " GROUP BY category_id ORDER BY category_name ASC";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>'; die;
        return $query->result_array();
	}
	
	public function get_sale_products($property_id = 0, $cost_center_id = '', $category_id = '', $start_date = '', $end_date = ''){
		$sql = "SELECT a.*, c.product_service_name, c.category_id, d.category_name

				FROM pos_sale_detail a
				
				LEFT JOIN pos_sale_header b ON
				a.sale_order_id = b.sale_order_id
				
				LEFT JOIN product_service_master c ON
				a.product_service_id = c.product_service_id
				
				LEFT JOIN category_master d ON
				c.category_id = d.category_id
				
				WHERE a.sale_detail_id != '' ";
		
		if($property_id != 0){
			$sql .= " AND b.property_id = ".$property_id."";
		}
		if($cost_center_id != ''){
			$sql .= " AND b.cost_center_id = ".$cost_center_id." ";
		}
		if($category_id != ''){
			$sql .= " AND c.category_id = ".$category_id." ";
		}
		if($start_date != '' && $end_date != ''){
			$sql .= " AND DATE(b.created_ts) >= '".$start_date."' AND DATE(b.created_ts) <= '".$end_date."' ";
		}
		
		$sql .= " GROUP BY product_service_id ORDER BY product_service_name ASC";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>'; die;
        return $query->result_array();
	}
	
	public function get_product_wise_revenue($product_service_id = '', $start_date = '', $end_date = ''){
		$sql = "SELECT SUM(quantity) AS tot_qty, SUM(price) AS tot_price, SUM(igst) AS tot_gst, product_service_master.product_service_name, product_service_master.category_id
				FROM pos_sale_detail
				
				LEFT JOIN pos_sale_header ON
				pos_sale_detail.sale_order_id = pos_sale_header.sale_order_id
				
				LEFT JOIN product_service_master ON
				pos_sale_detail.product_service_id = product_service_master.product_service_id
				
				WHERE pos_sale_detail.sale_detail_id != '' AND pos_sale_header.sale_flag = 1 ";
		
		if($product_service_id != ''){
			$sql .= " AND pos_sale_detail.product_service_id = ".$product_service_id."";
		}
		if($start_date != '' && $end_date != ''){
			$sql .= " AND DATE(pos_sale_header.created_ts) >= '".$start_date."' AND DATE(pos_sale_header.created_ts) <= '".$end_date."' ";
		}
		
		$sql .= " GROUP BY pos_sale_detail.product_service_id";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>'; die;
        return $query->row_array();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_unit_summary_report() {
		$stored_procedure = "CALL get_unit_summary_report();";
		$data = array();
		
        $result = $this->db->query($stored_procedure, $data);
		
        if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result( $this->db->conn_id);
			
            return $response;
        }
        return FALSE;
	}
    function getVendorPayDetails($condn=null){
		$this->db->select("a.transaction_type,a.bene_code,a.bene_acc_no,a.instrument_amount,left(a.bene_name,40) bene_name,a.drawee_location,a.print_location,a.bene_address_1,a.bene_address_2,a.bene_address_3,a.bene_address_4,a.bene_address_5,a.instruction_ref_no,a.customer_ref_no,a.payment_details_1,a.instruction_ref_no,a.customer_ref_no,a.payment_details_1,a.payment_details_2,a.payment_details_3,a.payment_details_4,a.payment_details_5,a.payment_details_6,a.payment_details_7,a.cheque_no,date_format(a.trn_value_date,'%d/%m/%Y') trn_value_date,a.micr_no,a.ifsc_code,a.bene_bank_name,a.bene_bank_branch_name,a.bene_email_id");
		$this->db->from('bank_forward_feed_dtl a');
		$this->db->join('bank_forward_feed b', 'a.feed_id = b.feed_id', 'INNER');
        if(!empty($condn))
            $this->db->where($condn);
 	     else 
	    $this->db->where('b.rundt=>'.date('y-m-d'));

        $query=$this->db->get();		
        return $query->result_array();

    }
	
	public function get_booking_details_summary_by_sp($property_id, $start_date, $end_date, $booking_source, $type,$canceled_by)
    {
        $query = $this->db->query("call booking_details_summary_proc($property_id, '$start_date','$end_date', '$booking_source', $type,'$canceled_by')");
        if ($query !== NULL) {
			$response = $query->result_array();			
			$query->free_result();
			mysqli_next_result( $this->db->conn_id);			
            return $response;

        }
        return FALSE;
    }
	
	public function get_invoice_data($where = array()){
        $this->db->select('SUM(room_taxable_amount) AS invoice_amount_before_gst, SUM(room_igst) AS invoice_gst, SUM(room_net_amount) AS invoice_amount_after_gst, SUM(extra_bed_rate) AS tot_extra_bed_amt');
        $this->db->from('booking_detail');
		if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->row_array();
    }

    public function get_ledge_statement_by_sp($property_id, $start_date, $end_date)
    {
        $query = $this->db->query("call ledge_statement_proc($property_id, '$start_date','$end_date')");
        if ($query !== NULL) {
			$response = $query->result_array();			
			$query->free_result();
			mysqli_next_result( $this->db->conn_id);			
            return $response;

        }
        return FALSE;
    }

	 function checkFileNameExists($condn=null){
		$this->db->select('bank_response_upload.file_name');
		$this->db->from('bank_response_upload');
        $this->db->where($condn);

        $query=$this->db->get();		
        return $query->result_array();

    }
    function getCutoffDates($condn=null){
        $query = $this->db->distinct()->select('cutoff_date')->get_where('transfer_details', $condn);
        return $query->result_array();
    }

    function getTransferDetailsByFilters($condn=null){
		$this->db->select('transfer_details.*');
		$this->db->from('transfer_details');
        $this->db->where($condn);
        $this->db->order_by('transfer_details.payment_date ASC');
        $query=$this->db->get();		
        return $query->result_array();

    }

    public function process_response_data_by_sp($p_fileName)
    {
        $query = $this->db->query("call process_response_data_proc($p_fileName)");
        if ($query !== NULL) {
			$response = $query->result_array();			
			$query->free_result();
			mysqli_next_result( $this->db->conn_id);			
            return $response;

        }
        return FALSE;
    }
    public function write_activity_log_by_sp($p_process_name ,$p_log_desc)
    {
        $query = $this->db->query("call write_activity_log_proc($p_process_name ,$p_log_desc)");
        if ($query !== NULL) {
			$response = $query->result_array();			
			$query->free_result();
			mysqli_next_result( $this->db->conn_id);			
            return $response;

        }
        return FALSE;
    }


	public function creditsale_list($property_id,$product_id,$financial_year,$billing_month)
    {

		if($billing_month >= '01' && $billing_month <= '03'){ //2023-2024		

			$fYear = $financial_year + 1;
			$fMonth = sprintf("%02d", $billing_month);

			if($billing_month == '01'){
				$prevMonth = '12';
				$prevYear = $financial_year;
			} else if($billing_month > '01' && $billing_month <= '03') {
				$prevMonth = sprintf("%02d", ($billing_month - 1));
				$prevYear = $financial_year + 1;
			}

		} else if($billing_month > '03' && $billing_month <= '12') {

			$fYear = $financial_year;
			$fMonth = sprintf("%02d", $billing_month);

			$prevMonth = sprintf("%02d", ($billing_month - 1));
			$prevYear = $financial_year;

		}

		$yearMonth = $fYear.'-'.$fMonth;
		$prevyearMonth = $prevYear.'-'.$prevMonth;

		//DATE_FORMAT(transaction_date, '%Y-%m') = '".$billingMonth."'

		$sql = "SELECT a.harbour_buyer_id, b.harbour_buyer_name, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_id = a.harbour_id AND harbour_buyer_id = a.harbour_buyer_id AND transaction_type = 'PS' AND harbour_product_id = '".$product_id."' AND payment_mode = 'Credit' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$prevyearMonth."') as total_credit_last, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_id = a.harbour_id AND harbour_buyer_id = a.harbour_buyer_id AND transaction_type = 'RC' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$prevyearMonth."') as total_collection_last, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_id = a.harbour_id AND harbour_buyer_id = a.harbour_buyer_id AND transaction_type = 'PS' AND harbour_product_id = '".$product_id."' AND payment_mode = 'Credit' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$yearMonth."') as total_credit_current, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_id = a.harbour_id AND harbour_buyer_id = a.harbour_buyer_id AND transaction_type = 'RC' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$yearMonth."') as total_collection_current FROM revenue_transactions a LEFT JOIN harbour_buyer_master b ON a.harbour_buyer_id = b.harbour_buyer_id WHERE a.harbour_id = '".$property_id."' AND a.payment_mode = 'Credit' AND b.buyer_type = 'B' AND b.is_active = '1' GROUP BY a.harbour_buyer_id";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		//echo "<pre>"; print_r($rows); die;

		return $rows;

	}


	public function property_details($property_id)
    {

		$sql = "SELECT a.property_name, a.address_line_1, a.city, b.district_name, c.state_name, a.pincode FROM property_master a LEFT JOIN district_master b ON a.district_id = b.district_id LEFT JOIN state_master c ON a.state_id = c.state_id WHERE a.property_id = '".$property_id."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		//echo "<pre>"; print_r($row); die;

		return $row;

	}


	public function product_details($product_id)
    {

		$sql = "SELECT harbour_product_name FROM harbour_products_master WHERE harbour_product_id = '".$product_id."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		return $row;

	}


	public function creditsale_statement($property_id,$bill_from_date,$bill_to_date)
    {

		$result = array();

		//$sql = "SELECT a.harbour_product_id, b.harbour_product_name FROM revenue_transactions a LEFT JOIN harbour_products_master b ON a.harbour_product_id = b.harbour_product_id WHERE a.harbour_id = '".$property_id."' AND a.harbour_product_id != '' AND (a.transaction_date >= '".$bill_from_date."' OR a.transaction_date <= '".$bill_to_date."') GROUP BY a.harbour_product_id ASC";         
		$sql = "SELECT harbour_product_id, harbour_product_name FROM harbour_products_master ORDER BY harbour_product_id ASC"; 
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		$i = 0;
		foreach($rows as $row){

			$sql1 = "SELECT SUM(qty) as total_cash_qty, SUM(total_amount) as total_cash_amount FROM revenue_transactions WHERE harbour_id = '".$property_id."' AND harbour_product_id = '".$row['harbour_product_id']."' AND (transaction_date >= '".$bill_from_date."' OR transaction_date <= '".$bill_to_date."') AND payment_mode = 'Cash'";
			$query1 = $this->db->query($sql1);
        	$row1 = $query1->result_array();

			$sql2 = "SELECT SUM(qty) as total_credit_qty, SUM(total_amount) as total_credit_amount FROM revenue_transactions WHERE harbour_id = '".$property_id."' AND harbour_product_id = '".$row['harbour_product_id']."' AND (transaction_date >= '".$bill_from_date."' OR transaction_date <= '".$bill_to_date."') AND payment_mode = 'Credit'";
			$query2 = $this->db->query($sql2);
        	$row2 = $query2->result_array();			

			$mergedArray = array_merge($row1, $row2);

			$result[$i] = $row;
			$result[$i]['statement_list'] = $mergedArray;

			$i++;
		}

		//echo "<pre>"; print_r($result); die;

		return $result;

	}


	public function creditsale_recovary($property_id,$bill_from_date,$bill_to_date)
    {

		$sql3 = "SELECT SUM(total_amount) as total_recovary_sale_amount FROM revenue_transactions WHERE harbour_id = '".$property_id."' AND (transaction_date >= '".$bill_from_date."' OR transaction_date <= '".$bill_to_date."') AND payment_mode = 'Cash' AND transaction_type = 'RC'";
		$query3 = $this->db->query($sql3);
		$row3 = $query3->row_array();

		//echo "<pre>"; print_r($row3); die;

		return $row3;

	}
	
	function getGuestHouseCollection($condn=array(), $where=null){
		$this->db->select("bp.booking_payment_id, bp.booking_id, bp.customer_id, bp.payment_date, bp.txnid, bp.order_id, bp.device_id, bp.transaction_ref_id, bp.bank_ref_num, bp.amount, bp.payment_mode, bp.response_txt, bp.cheque_no, bp.cheque_date, bp.cheque_bank_name, bp.transfar_bank_id, bp.money_receipt_no, bp.money_receipt_date, bp.edc_terminal, bp.remarks, bp.error_message, bp.status, bp.created_by, bp.created_ts, bp.updated_by, bp.updated_ts, bp.sale_order_id, bp.cronjob_data, bp.cronjob_status, bp.cronjob_start_time, bp.cronjob_end_time, bh.booking_no, bh.property_id, bh.invoice_no AS bh_invoice_no, bh.booking_source, pm.property_name, ccm.cost_center_name, psh.invoice_no, psh.booking_id AS psh_booking_id, ch.check_in_id");
		$this->db->from('booking_payment bp');
		$this->db->join('booking_header bh', 'bp.booking_id = bh.booking_id', 'LEFT');
		$this->db->join('property_master pm', 'bh.property_id = pm.property_id', 'LEFT');
		$this->db->join('pos_sale_header psh', 'bp.sale_order_id = psh.sale_order_id', 'LEFT');
		$this->db->join('cost_center_master ccm', 'psh.cost_center_id = ccm.cost_center_id', 'LEFT');
		$this->db->join('check_in_header ch', 'bh.booking_id = ch.booking_id', 'LEFT');
        if(!empty($condn)){
            if($condn['cost_center_id'] != ''){
				$this->db->where('psh.cost_center_id', $condn['cost_center_id']);
			}else{
				$this->db->where('bh.property_id', $condn['property_id']);
			}
			
		}
		if(!empty($where)){
			$this->db->where($where);
			$this->db->where('(bp.status = "Success" OR bp.status = "SUCCESSFUL" )');
		}

        $query=$this->db->get();
		//echo nl2br($this->db->last_query()); die;		
        return $query->result_array();

    }
	
	function getPosTransaction($where=null){
		$this->db->select("psh.sale_order_id, psh.order_no, psh.invoice_no, psh.cost_center_id, psh.property_id, psh.table_no, psh.customer_name, psh.mobile_no, psh.customer_gstin, psh.sale_flag, psh.cancel_remarks, psh.no_of_item, psh.open_status, psh.payment_option, psh.booking_id, psh.created_by, psh.created_ts, psh.updated_by, psh.updated_ts, psh.order_generate_time, pm.property_name, ccm.cost_center_name");
		$this->db->from('pos_sale_header psh');
		$this->db->join('property_master pm', 'psh.property_id = pm.property_id', 'LEFT');
		$this->db->join('cost_center_master ccm', 'psh.cost_center_id = ccm.cost_center_id', 'LEFT');
		if(!empty($where)){
			$this->db->where($where);
		}

        $query=$this->db->get();
		//echo nl2br($this->db->last_query()); die;		
        return $query->result_array();

    }
	
	function getPosSaleDetailHeaderWise($where=null){
		 $this->db->select('SUM(price) AS amt_before_gst, SUM(igst) AS gst, SUM(payable_amount) AS amt_after_gst');
        $this->db->from('pos_sale_detail');
		if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->row_array();

    }
	
	function getSubsidiaryTransaction($where=null){
		$this->db->select("psh.sale_order_id, psh.order_no, psh.invoice_no, psh.cost_center_id, psh.property_id, psh.table_no, psh.customer_name, psh.mobile_no, psh.customer_gstin, psh.sale_flag, psh.cancel_remarks, psh.no_of_item, psh.open_status, psh.payment_option, psh.booking_id, psh.created_by, psh.created_ts, psh.updated_by, psh.updated_ts, psh.order_generate_time, pm.property_name, ccm.cost_center_name, bh.first_name, bh.booking_no, bh.check_in, bh.check_out");
		$this->db->from('pos_sale_header psh');
		$this->db->join('property_master pm', 'psh.property_id = pm.property_id', 'LEFT');
		$this->db->join('cost_center_master ccm', 'psh.cost_center_id = ccm.cost_center_id', 'LEFT');
		$this->db->join('booking_header bh', 'psh.booking_id = bh.booking_id', 'LEFT');
		if(!empty($where)){
			$this->db->where($where);
		}

        $query=$this->db->get();
		//echo nl2br($this->db->last_query()); die;		
        return $query->result_array();

    }
	
	function getHarbourSaleProduct($where=null){
		$sql = "SELECT temp.property_name, temp.harbour_product_name, SUM(total_amount) AS total_income FROM (SELECT rt.harbour_id, rt.transaction_date, rt.harbour_product_id, rt.total_amount, pm.property_name, hpm.harbour_product_name
FROM revenue_transactions rt
LEFT JOIN property_master pm ON rt.harbour_id = pm.property_id
LEFT JOIN harbour_products_master hpm ON rt.harbour_product_id = hpm.harbour_product_id ) AS temp WHERE temp.harbour_product_id !='' ";
		if(!empty($where)){
			foreach($where as $key => $value){
				$sql .= " AND ".$key." '".$value."'";
			}
		}
		$sql .= " GROUP BY temp.harbour_product_id";
		
        $query=$this->db->query($sql);
		//echo nl2br($this->db->last_query()); die;		
        return $query->result_array();

    }
	
	public function get_budget_particulars($property_id = 0, $financial_year = '', $start_month = '', $end_month = ''){
		$sql = "SELECT SUM(a.actual_expenditure_amount) AS tot_amount, c.particular_title, d.property_name

				FROM budget_details a
				
				LEFT JOIN budget_header b ON
				a.budget_header_id = b.budget_header_id
				
				LEFT JOIN budget_particular_master c ON
				a.particulars_id = c.particular_id
				
				LEFT JOIN property_master d ON
				b.property_id = d.property_id
				
				WHERE a.budget_header_id != '' ";
		
		if($property_id != 0){
			$sql .= " AND b.property_id = '".$property_id."' ";
		}
		if($financial_year != ''){
			$sql .= " AND b.financial_year = '".$financial_year."' ";
		}
		if($start_month != '' && $end_month != ''){
			$sql .= " AND b.expense_month >= '".$start_month."' AND  b.expense_month <= '".$end_month."' ";
		}
		
		$sql .= " GROUP BY particulars_id ORDER BY particular_title ASC";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); echo '<br>'; die;
        return $query->result_array();
	}


	public function venue_list($propertyId){

		$sql = "SELECT * FROM master_venue WHERE property_id = '".$propertyId."'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		return $rows;

	}


	public function booking_report($propertyId,$venueId,$startDate,$endDate){

		if($venueId == '0'){
			$subQuery = "";
		} else {
			$subQuery = "AND a.single_venue_id = '".$venueId."'";
		}

		/*$sql1 = "SELECT a.rate_id, b.property_name, c.venue_name, d.booking_id, d.user_id, d.order_id, d.booking_start_date, d.booking_end_date, d.is_indivisual, d.indivisual_contact_no, d.business_contact_no, d.contact_person_contact_no, d.net_amount, d.status as booking_status, d.booking_from, d.booked_by, e.receipt_no, e.payment_date, e.txnid, e.order_id, e.transaction_ref_id, e.amount as payment_amount, e.payment_mode, e.status as payment_status, e.created_by as initiated_by, f.first_name as customer_name, f.gst_number, g.first_name as booked_customer_name, h.full_name as booked_admin_name FROM venue_rate_master a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN master_venue c ON a.single_venue_id = c.venue_id LEFT JOIN venue_booking d ON a.rate_id = d.rate_id LEFT JOIN venue_payment e ON d.booking_id = e.booking_id LEFT JOIN customer_master f ON d.user_id = f.customer_id LEFT JOIN customer_master g ON e.created_by = g.customer_id LEFT JOIN master_admin h ON e.created_by = h.user_id WHERE a.property_id = '".$propertyId."' ".$subQuery." AND (d.status <> '5' AND d.status <> '6') AND (DATE_FORMAT(e.payment_date, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(e.payment_date, '%Y-%m-%d') <= '".$endDate."')";*/

		$sql1 = "SELECT a.rate_id, b.property_name, c.venue_name, d.booking_id, d.user_id, d.order_id, d.booking_start_date, d.booking_end_date, d.is_indivisual, d.indivisual_contact_no, d.business_contact_no, d.contact_person_contact_no, d.net_amount, d.status as booking_status, d.booking_from, d.booked_by, e.receipt_no, e.payment_date, e.txnid, e.order_id, e.transaction_ref_id, e.amount as payment_amount, e.payment_mode, e.status as payment_status, e.created_by as initiated_by, f.first_name as customer_name, f.gst_number, g.first_name as booked_customer_name, h.full_name as booked_admin_name FROM venue_rate_master a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN master_venue c ON a.single_venue_id = c.venue_id LEFT JOIN venue_booking d ON a.rate_id = d.rate_id LEFT JOIN venue_payment e ON d.booking_id = e.booking_id LEFT JOIN customer_master f ON d.user_id = f.customer_id LEFT JOIN customer_master g ON e.created_by = g.customer_id LEFT JOIN master_admin h ON e.created_by = h.user_id WHERE a.property_id = '".$propertyId."' ".$subQuery." AND (d.status <> '5' AND d.status <> '6') AND (DATE_FORMAT(d.created_at, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(d.created_at, '%Y-%m-%d') <= '".$endDate."')";
		$query1 = $this->db->query($sql1);
		$rows = $query1->result_array();

		return $rows;

	}


	public function cancel_booking_report($propertyId,$venueId,$startDate,$endDate){

		$result = array();

		if($venueId == '0'){
			$subQuery = "";
		} else {
			$subQuery = "AND a.single_venue_id = '".$venueId."'";
		}

		$sql = "SELECT a.rate_id, b.property_name, c.venue_name, d.booking_id, d.user_id, d.order_id, d.booking_start_date, d.booking_end_date, d.is_indivisual, d.indivisual_contact_no, d.business_contact_no, d.contact_person_contact_no, d.total_rate, d.gst_amount, d.net_amount, d.status as booking_status, d.booking_from, d.booked_by, d.cancelled_by, d.cancelled_ts as cancel_initiated_on, (SELECT SUM(amount) FROM venue_payment WHERE booking_id = d.booking_id) as payment_amount, (SELECT COUNT(amount) FROM venue_payment WHERE booking_id = d.booking_id) as total_payment_count, f.first_name as customer_name, f.gst_number, g.first_name as booked_customer_name, h.full_name as booked_admin_name, i.first_name as cancelled_customer_name, j.full_name as cancelled_admin_name FROM venue_rate_master a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN master_venue c ON a.single_venue_id = c.venue_id LEFT JOIN venue_booking d ON a.rate_id = d.rate_id LEFT JOIN venue_payment e ON d.booking_id = e.booking_id LEFT JOIN customer_master f ON d.user_id = f.customer_id LEFT JOIN customer_master g ON e.created_by = g.customer_id LEFT JOIN master_admin h ON e.created_by = h.user_id LEFT JOIN customer_master i ON d.cancelled_by = i.customer_id LEFT JOIN master_admin j ON d.cancelled_by = j.user_id WHERE a.property_id = '".$propertyId."' ".$subQuery." AND d.status = '6' AND (DATE_FORMAT(d.cancelled_ts, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(d.cancelled_ts, '%Y-%m-%d') <= '".$endDate."') GROUP BY d.booking_id";
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		$current_date = time();
		$i = 0;
		foreach($rows as $row){

			$check_in_date = strtotime($row['booking_start_date']);
			$datediff = $check_in_date - $current_date;

			$dateDiff = round($datediff / (60 * 60 * 24));

			$sql1 = "SELECT cancellation_per FROM venue_cancellation_policy  WHERE ('".$dateDiff."' >= day_to AND '".$dateDiff."' <= day_from) AND is_active = 1";
        	$query1 = $this->db->query($sql1);
        	$row1 = $query1->row_array();

			$result[$i] = $row;
			$result[$i]['cancellation_percentage'] = $row1['cancellation_per'];

			$i++;
		}

		return $result;

	}
	
	function get_safari_booking($where = [], $order_by = '') {
		$this->db->select('a.*, b.service_definition, b.start_point, b.end_point, b.reporting_place, c.slot_desc, c.start_time, c.end_time, c.reporting_time, sc.cat_name');
		$this->db->from('safari_booking_header a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'LEFT');
		$this->db->join('safari_service_period_slot_detail c', 'a.period_slot_dtl_id = c.period_slot_dtl_id', 'LEFT');
		$this->db->join('safari_category_master sc', 'a.safari_cat_id = sc.safari_cat_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		$query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        $rows = $query->result_array();
		
		if(!empty($rows)){
			$ids = array_column($rows, 'booking_id');
			$booking_ids = implode(',', $ids);
		}
		
		if(!empty($rows)){
			$i = 0;
			$this->db->select('bd.*');
			$this->db->from('safari_booking_detail bd');
			$this->db->where_in('booking_id', $booking_ids, false);
			$query1=$this->db->get();
			//echo nl2br($this->db->last_query());die;
			$rows1 = $query1->result_array();
			
			$result[$i] = $rows;
			$result[$i]['details'] = $rows1;
	
			if($result){
				return $result;
			} else {
				return false;
			}
		}
    }

}