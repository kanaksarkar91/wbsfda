<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdashboard extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_guest_house_booking_property_id($property_id = ''){
        $this->db->select('COUNT(booking_id) AS total_booking');
        $this->db->from('booking_header');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('booking_header.property_id', $property_id);
            }else{
                $this->db->where('booking_header.property_id', $property_id);
            }
        }
		//$this->db->order_by('cost_center_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->row_array();
    }
	
	public function get_guest_house_revenue_property_id($property_id = '', $type = ''){
        $sql = "SELECT SUM(amount) AS total_revenue FROM(SELECT booking_payment.*, booking_header.property_id
				FROM booking_payment
				LEFT JOIN booking_header ON
				booking_payment.booking_id = booking_header.booking_id
				WHERE booking_payment.status='Success' OR booking_payment.status='SUCCESS' OR booking_payment.status='success') AS temp";
        if($property_id != ''){
            if(is_array($property_id)){
				$property_ids = implode(',', $property_id);
                $sql .= " WHERE temp.property_id IN (".$property_ids.") ";
            }else{
                $sql .= " WHERE temp.property_id = ".$property_id." ";
            }
        }
		
		if($type == 'booking'){
			$sql .= " AND temp.booking_id != 0";
		}
		else if($type == 'pos'){
			$sql .= " AND temp.sale_order_id IS NOT NULL ";
		}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
    }
	
	public function get_restaurant_revenue_property_id($property_id = ''){
        $sql = "SELECT SUM(amount) AS total_revenue FROM(SELECT booking_payment.*, pos_sale_header.property_id FROM booking_payment LEFT JOIN pos_sale_header ON booking_payment.sale_order_id = pos_sale_header.sale_order_id WHERE booking_payment.status='Success' OR booking_payment.status='SUCCESS' OR booking_payment.status='success') AS temp";
        if($property_id != ''){
            if(is_array($property_id)){
				$property_ids = implode(',', $property_id);
                $sql .= " WHERE temp.property_id IN (".$property_ids.") ";
            }else{
                $sql .= " WHERE temp.property_id = ".$property_id." ";
            }
        }
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
    }
	
	public function get_dashboard_details(){
        
		$sql = "SELECT (SELECT COUNT(property_id) FROM property_master WHERE is_active = '1') AS total_guest_house, 
				(SELECT COUNT(venue_id) FROM master_venue WHERE is_active = '1') AS total_venue,
				(SELECT COUNT(booking_id) FROM booking_header WHERE booking_id != '') AS total_booking,
				(SELECT COUNT(customer_id) FROM customer_master WHERE is_active = '1') AS total_customer";
				
		$query = $this->db->query($sql);
        return $query->row_array();
    }
	
	public function get_total_revenue(){
        
		$sql = "SELECT SUM(amount) AS total_revenue FROM booking_payment WHERE (status = 'success' OR status = 'Success' OR status = 'SUCCESS') ";
				
		$query = $this->db->query($sql);
        $row = $query->row_array();
		return $row['total_revenue'];
    }
	
	public function get_revenue_details($period = '', $property_id = ''){

        $result = array();
		
		foreach ($period as $dt) {
			$showingMonth =  $dt->format("M y");
			$queryMonth = $dt->format("m");
			$queryYear = $dt->format("Y");
			
			$sql = "SELECT temp.property_name, SUM(revenue) AS total_revenue FROM (SELECT pm.*,
					(SELECT SUM(booking_payment.amount) FROM booking_payment WHERE booking_payment.booking_id = bh.booking_id 
					AND (booking_payment.status = 'success' OR booking_payment.status = 'Success') AND MONTH(booking_payment.payment_date) = ".$queryMonth." AND YEAR(booking_payment.payment_date) = ".$queryYear."  GROUP BY booking_payment.booking_id) AS revenue 
					
					FROM property_master pm
					
					LEFT JOIN booking_header bh ON
					pm.property_id = bh.property_id
					
					LEFT JOIN booking_payment bp ON
					bh.booking_id = bp.booking_id
					
					WHERE (bp.status = 'success' OR bp.status = 'Success' OR bp.status = 'SUCCESS')
					
					) AS temp
					
					WHERE property_id = ".$property_id."
					
					GROUP BY property_id 
					ORDER BY property_id ASC";
					
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
	
	
	public function get_booking_details($period = '', $property_id = ''){

        $result = array();
		
		foreach ($period as $dt) {
			$showingMonth =  $dt->format("M y");
			$queryMonth = $dt->format("m");
			$queryYear = $dt->format("Y");
			
			$sql = "SELECT COUNT(*) AS total_booking FROM booking_header
					WHERE MONTH(check_in) = ".$queryMonth." AND YEAR(check_in) = ".$queryYear."
					AND property_id = ".$property_id." AND booking_status != 'C'
					GROUP BY property_id 
					ORDER BY property_id ASC";
			//echo $sql.'<br>';		
			$query = $this->db->query($sql);
        	$rowB = $query->row_array();
			
			$result[$showingMonth][] = array(
				'show_month' => $showingMonth,
				'total_booking' => $rowB['total_booking']
			);
			
			
		}
		

        //echo "<pre>"; print_r($result); die;

        return $result;
        
    }


}