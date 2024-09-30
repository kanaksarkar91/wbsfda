<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrevenue extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

	public function property_list($curUser){  

		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == '20' || $this->admin_session_data['role_id'] == '21'){
        	$sql = "SELECT property_id, property_name FROM property_master WHERE is_active = '1' AND is_deleted = '0' AND p_type = 'H' ORDER BY property_name ASC"; 
		} else {
			$sql = "SELECT a.property_id, b.property_name FROM user_property_mapping a LEFT JOIN property_master b ON a.property_id = b.property_id WHERE a.user_id = ".$curUser." ORDER BY b.property_name ASC"; 
		}       
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	/*public function revenue_list($propertyId, $billingMonth){  

		$result = array();

        $sql = "SELECT a.*, b.property_name FROM revenue_transaction_header a LEFT JOIN property_master b ON a.property_id = b.property_id WHERE a.property_id = '".$propertyId."' AND a.billing_month_year = '".$billingMonth."'";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		$i = 0;
		foreach($rows as $row){

			$tsql = "SELECT a.*, b.head_title FROM revenue_transaction_details a LEFT JOIN revenue_head_master b ON a.header_id = b.head_id WHERE transaction_header_id = '".$row['transaction_header_id']."'";
			$tquery = $this->db->query($tsql);
        	$trows = $tquery->result_array();

			$result[$i] = $row;
			$result[$i]['transaction_details'] = $trows;

			$i++;

		}


		//echo "<pre>"; print_r($result); die;

		return $result;

    }*/


	public function revenue_list($propertyId, $billingMonth){  

		$result = array();

       	//$sql = "SELECT * FROM revenue_transactions WHERE transaction_type <> 'RC' AND harbour_id = '".$propertyId."' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$billingMonth."' ORDER BY transaction_date ASC";         
		//$sql = "SELECT a.transaction_date, a.harbour_product_id, b.harbour_product_name, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = a.harbour_product_id AND payment_mode = 'Cash' GROUP BY harbour_product_id) as total_cash_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = a.harbour_product_id AND payment_mode = 'Cash' GROUP BY harbour_product_id) as total_cash_total, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = a.harbour_product_id AND payment_mode = 'Credit' GROUP BY harbour_product_id) as total_credit_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = a.harbour_product_id AND payment_mode = 'Credit' GROUP BY harbour_product_id) as total_credit_total FROM revenue_transactions a LEFT JOIN harbour_products_master b ON a.harbour_product_id = b.harbour_product_id WHERE a.transaction_type <> 'RC' AND a.harbour_id = '".$propertyId."' AND DATE_FORMAT(a.transaction_date, '%Y-%m') = '".$billingMonth."' GROUP BY a.harbour_product_id";
        //$query = $this->db->query($sql);
        //$rows = $query->result_array();


		/*$sql = "SELECT a.*, b.uom_name FROM harbour_products_master a LEFT JOIN uom_master b ON a.uom_id = b.uom_id WHERE a.is_active = '1'";       
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		$i = 0;
		foreach($rows as $row){

			if($row['harbour_product_id'] == '1'){
				$chqsql = "SELECT SUM(qty) as hsd_total_cash_qty FROM revenue_transactions WHERE transaction_type = 'PS' AND harbour_product_id = '".$row['harbour_product_id']."' AND payment_mode = 'Cash' AND harbour_id = '".$propertyId."' AND DATE_FORMAT(transaction_date, '%Y-%m') = '".$billingMonth."' GROUP BY transaction_date";
				$chqquery = $this->db->query($chqsql);
        		$chqrow = $chqquery->row_array();
			}

			



			$result[$i] = $chqrow;

			$i++;
		}*/


		/*$sql = "SELECT a.transaction_date, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 1 AND payment_mode = 'Cash' THEN qty END) AS total_hsd_cash_qty, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 1 AND payment_mode = 'Cash' THEN total_amount END) AS total_hsd_cash_amount, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 1 AND payment_mode = 'Credit' THEN qty END) AS total_hsd_credit_qty, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 1 AND payment_mode = 'Credit' THEN total_amount END) AS total_hsd_credit_amount, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 2 AND payment_mode = 'Cash' THEN qty END) AS total_ice_cash_qty, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 2 AND payment_mode = 'Cash' THEN total_amount END) AS total_ice_cash_amount, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 2 AND payment_mode = 'Credit' THEN qty END) AS total_ice_credit_qty, SUM(CASE WHEN transaction_type = 'PS' AND harbour_product_id = 2 AND payment_mode = 'Credit' THEN total_amount END) AS total_ice_credit_amount FROM revenue_transactions a WHERE a.transaction_type <> 'RC' AND a.harbour_id = '".$propertyId."' AND DATE_FORMAT(a.transaction_date, '%Y-%m') = '".$billingMonth."' ORDER BY a.transaction_date ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();*/

		$sql = "SELECT a.transaction_date, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = 1 AND payment_mode = 'Cash' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_hsd_cash_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = 1 AND payment_mode = 'Cash' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_hsd_cash_amount, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = 1 AND payment_mode = 'Credit' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_hsd_credit_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = 1 AND payment_mode = 'Credit' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_hsd_credit_amount, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = 2 AND payment_mode = 'Cash' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_ice_cash_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = 2 AND payment_mode = 'Cash' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_ice_cash_amount, (SELECT SUM(qty) FROM revenue_transactions WHERE harbour_product_id = 2 AND payment_mode = 'Credit' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_ice_credit_qty, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = 2 AND payment_mode = 'Credit' AND transaction_type = 'PS' AND transaction_date = a.transaction_date) AS total_ice_credit_amount, (SELECT SUM(total_amount) FROM revenue_transactions WHERE payment_mode = 'Cash' AND transaction_type = 'RC' AND transaction_date = a.transaction_date) AS total_recovary_sale_amount FROM revenue_transactions a WHERE a.harbour_id = '".$propertyId."' AND DATE_FORMAT(a.transaction_date, '%Y-%m') = '".$billingMonth."' GROUP BY a.transaction_date ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		$usql = "SELECT * FROM harbour_products_master WHERE product_type <> 'P' AND is_active = '1'";       
        $uquery = $this->db->query($usql);
        $urows = $uquery->result_array();
		
		foreach($urows as $urow){

			//$sql1 = "SELECT a.transaction_date, SUM(CASE WHEN transaction_type = 'OS' AND harbour_product_id = '".$urow['harbour_product_id']."' THEN total_amount END) AS total_cash_amount FROM revenue_transactions a WHERE a.transaction_type <> 'RC' AND a.harbour_id = '".$propertyId."' AND DATE_FORMAT(a.transaction_date, '%Y-%m') = '".$billingMonth."' ORDER BY a.transaction_date ASC";         
			$sql1 = "SELECT a.transaction_date, (SELECT SUM(total_amount) FROM revenue_transactions WHERE harbour_product_id = '".$urow['harbour_product_id']."' AND transaction_date = a.transaction_date) AS total_cash_amount FROM revenue_transactions a WHERE a.transaction_type <> 'RC' AND a.harbour_id = '".$propertyId."' AND DATE_FORMAT(a.transaction_date, '%Y-%m') = '".$billingMonth."' GROUP BY a.transaction_date ASC"; 
        	$query1 = $this->db->query($sql1);
        	$rows1[] = $query1->result_array();

		}

		$i = 0;
		foreach($rows as $row){

			$result[$i] = $row;
			$result[$i]['os_product'] = $rows1;

			$i++;
		}		

		//echo "<pre>"; print_r($result); die;

		return $result;

    }


	public function head_list(){  

        //$sql = "SELECT * FROM revenue_head_master WHERE is_active = '1'";  
		$sql = "SELECT a.*, b.uom_name FROM harbour_products_master a LEFT JOIN uom_master b ON a.uom_id = b.uom_id WHERE a.is_active = '1'";       
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	public function check_transaction_details($propertyId, $billingMonth, $billingDate){  

        $sql = "SELECT * FROM revenue_transaction_header WHERE property_id = '".$propertyId."' AND billing_month_year = '".$billingMonth."' AND billing_date = '".$billingDate."'";         
        $query = $this->db->query($sql);
        //$rows = $query->result_array();
		$num = $query->num_rows();

		if($num > 0){
			return true;
		} else {
			return false;
		}

    }


	public function transaction_header_insert($transHeaderarray){
        $this->db->insert('revenue_transaction_header', $transHeaderarray);
        return $this->db->insert_id();
    }


	public function transaction_details_insert($transDetailsarray) {

        $sql = $this->db->insert_batch('revenue_transaction_details', $transDetailsarray);

        if($sql){

			return true;

        } else {
			return false;
		}

    }


	public function product_list_product(){  

        $sql = "SELECT a.*, b.uom_name FROM harbour_products_master a LEFT JOIN uom_master b ON a.uom_id = b.uom_id WHERE a.product_type = 'P' AND a.is_active = '1'";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	public function facility_product_list(){  

        $sql = "SELECT a.*, b.uom_name FROM harbour_products_master a LEFT JOIN uom_master b ON a.uom_id = b.uom_id WHERE a.product_type = 'F' AND a.is_active = '1' ORDER BY a.harbour_product_name ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	public function product_buyer_list($propertyId){  

        $sql = "SELECT a.harbour_buyer_id, b.harbour_buyer_name FROM buyer_harbour_map a LEFT JOIN harbour_buyer_master b on a.harbour_buyer_id = b.harbour_buyer_id WHERE a.harbour_id = '".$propertyId."' AND b.buyer_type = 'B' ORDER BY b.harbour_buyer_name ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }

	public function product_licencee_list($propertyId){  

        $sql = "SELECT a.harbour_buyer_id, b.harbour_buyer_name FROM buyer_harbour_map a LEFT JOIN harbour_buyer_master b on a.harbour_buyer_id = b.harbour_buyer_id WHERE a.harbour_id = '".$propertyId."' AND b.buyer_type = 'L' ORDER BY b.harbour_buyer_name ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }

	public function product_sales_insert($transarray){
        $this->db->insert('revenue_transactions', $transarray);
        if($this->db->insert_id()){

			if($transarray['payment_mode'] == 'Credit'){

				$sql = "SELECT * FROM buyer_credit_balance WHERE harbour_buyer_id = '".$transarray['harbour_buyer_id']."'";         
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$num = $query->num_rows();

				if($num > 0){

					$currentOutstanding = $row['oustanding_amount'] + $transarray['total_amount'];

					$usql = "UPDATE buyer_credit_balance SET oustanding_amount = '".$currentOutstanding."' WHERE harbour_buyer_id = '".$transarray['harbour_buyer_id']."'";
					$uquery = $this->db->query($usql);

					if($uquery){
						return true;
					}

				} else {

					$isql = "INSERT INTO buyer_credit_balance (harbour_buyer_id, oustanding_amount) VALUES ('".$transarray['harbour_buyer_id']."', '".$transarray['total_amount']."')";
					$iquery = $this->db->query($isql);

					if($iquery){
						return true;
					}

				}

			} else{
				return true;
			}

		}
    }


	public function outstanding_amount($buyerId){  

        $sql = "SELECT oustanding_amount FROM buyer_credit_balance WHERE harbour_buyer_id = '".$buyerId."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		return $row['oustanding_amount'];

    }


	public function recovery_sales_insert($transarray,$oustandingAmount){
        $this->db->insert('revenue_transactions', $transarray);
        if($this->db->insert_id()){

			$currentOutstanding = $oustandingAmount - $transarray['total_amount'];

			$usql = "UPDATE buyer_credit_balance SET oustanding_amount = '".$currentOutstanding."' WHERE harbour_buyer_id = '".$transarray['harbour_buyer_id']."'";
			$uquery = $this->db->query($usql);

			if($uquery){
				return true;
			}

		}
    }


	public function agreement_list($property_id){  

        $sql = "SELECT a.*, b.property_name, c.harbour_buyer_name, d.harbour_product_name FROM agreement_master a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_buyer_master c ON a.licencee_id = c.harbour_buyer_id LEFT JOIN harbour_products_master d ON a.facility_id = d.harbour_product_id WHERE a.harbour_id = '".$property_id."' ORDER BY a.start_date DESC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		//echo "<pre>"; print_r($rows); die;

		return $rows;

    }


	public function agreement_insert($agreementarray){
        $this->db->insert('agreement_master', $agreementarray);
        if($this->db->insert_id()){
			return true;
		}
    }


	public function agreement_details($propertyId,$productId,$buyerId){  

        $sql = "SELECT a.*, b.property_name, c.harbour_buyer_name, d.harbour_product_name FROM agreement_master a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_buyer_master c ON a.licencee_id = c.harbour_buyer_id LEFT JOIN harbour_products_master d ON a.facility_id = d.harbour_product_id WHERE a.harbour_id = '".$propertyId."' AND a.licencee_id = '".$buyerId."' AND a.facility_id = '".$productId."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		//echo "<pre>"; print_r($row); die;

		return $row;

    }


	public function list_agreement_details($agreementId){  

        $sql = "SELECT a.*, b.property_name, c.harbour_buyer_name, d.harbour_product_name FROM agreement_master a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_buyer_master c ON a.licencee_id = c.harbour_buyer_id LEFT JOIN harbour_products_master d ON a.facility_id = d.harbour_product_id WHERE a.agreement_id = '".$agreementId."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		//echo "<pre>"; print_r($row); die;

		return $row;

    }


	public function othersale_insert($salearray){
        $this->db->insert('revenue_transactions', $salearray);
        if($this->db->insert_id()){
			return true;
		}
    }


	public function transaction_list($harbourId,$transDate){  

        //$sql = "SELECT a.*, b.property_name, c.harbour_product_name, d.uom_name, d.uom_code, e.harbour_buyer_name FROM revenue_transactions a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_products_master c ON a.harbour_product_id = c.harbour_product_id LEFT JOIN uom_master d ON c.uom_id = d.uom_id LEFT JOIN harbour_buyer_master e ON a.harbour_buyer_id = e.harbour_buyer_id WHERE a.harbour_id = '".$harbourId."' AND DATE_FORMAT(a.created_ts, '%Y-%m-%d') = '".$transDate."'";
		$sql = "SELECT a.*, b.property_name, c.harbour_product_name, d.uom_name, d.uom_code, e.harbour_buyer_name FROM revenue_transactions a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_products_master c ON a.harbour_product_id = c.harbour_product_id LEFT JOIN uom_master d ON c.uom_id = d.uom_id LEFT JOIN harbour_buyer_master e ON a.harbour_buyer_id = e.harbour_buyer_id WHERE a.harbour_id = '".$harbourId."' AND a.transaction_date = '".$transDate."' ORDER BY b.property_name ASC";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		//echo "<pre>"; print_r($rows); die;

		return $rows;

    }


	public function transaction_details($transactionId){  

        $sql = "SELECT a.*, b.property_name, c.harbour_product_name, d.uom_name, d.uom_code, e.harbour_buyer_name FROM revenue_transactions a LEFT JOIN property_master b ON a.harbour_id = b.property_id LEFT JOIN harbour_products_master c ON a.harbour_product_id = c.harbour_product_id LEFT JOIN uom_master d ON c.uom_id = d.uom_id LEFT JOIN harbour_buyer_master e ON a.harbour_buyer_id = e.harbour_buyer_id WHERE a.transaction_id = '".$transactionId."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();

		//echo "<pre>"; print_r($rows); die;

		return $row;

    }


}
