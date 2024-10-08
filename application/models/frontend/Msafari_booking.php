<?php

class Msafari_booking extends CI_Model {
    
	public function __construct(){
        parent::__construct();
    }
	
	public function get_booking_slot_list($safari_type_id = 0, $division_id = 0, $safari_service_header_id = 0, $saf_booking_date = '', $safari_cat_id = 0) {
		$stored_procedure = "CALL get_safari_search_data_proc(?,?,?,?,?);";
        $data = array('p_service_type_id' => $safari_type_id, 'p_division_id' => $division_id, 'p_safari_service_header_id ' => $safari_service_header_id, 'p_booking_date' => $saf_booking_date, 'p_safari_cat_id' => $safari_cat_id);
		
        $result = $this->db->query($stored_procedure, $data);
		//echo $this->db->last_query(); die;
		
        if ($result !== NULL) {
			$response = $result->result_array();
			$result->free_result();
			mysqli_next_result( $this->db->conn_id);
			
            return $response;
        }
        return FALSE;
	}
	
	public function get_service_data($where = []){
        $this->db->select('a.*, b.division_name, c.type_name');
        $this->db->from('safari_service_header a');
		$this->db->join('division_master b', 'a.division_id = b.division_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->row_array();
    }
	
	public function get_gst_slab($amount = 0){
        $this->db->select('a.*');
        $this->db->from('hotel_gst_slab a');
        $this->db->where("$amount BETWEEN startg_price AND ending_price");
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->row_array();
    }
	
	public function bookingDetailBatchInsert($getArray) {
        $sql = $this->db->insert_batch('safari_booking_detail', $getArray);
        if($sql){
            return true;
        }

    }
	function get_booking_payment_info($condn = null)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('safari_booking_payment a');
		$this->db->join('safari_booking_header b', 'a.booking_id = b.booking_id', 'INNER');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_payment_id','DESC');
        $query=$this->db->get();
        //echo nl2br($this->db->last_query());die;
        return $query->row_array();
	}
	function move_booking_to_failed($booking_id){
		
		$this->db->trans_start(); # Starting Transaction

		$move_booking_header_failed_qry = "CALL move_safari_booking_to_failed(".$booking_id.")";
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
	function get_booking_payment($condn = null) {
		//print_r ($condn);
		$this->db->select('safari_booking_payment.*, safari_booking_header.booking_number');
		$this->db->from('safari_booking_payment');
		$this->db->join('safari_booking_header', 'safari_booking_payment.booking_id = safari_booking_header.booking_id', 'INNER');
		foreach ($condn as $key => $value)
			$this->db->where($key, $value);
		$this->db->order_by('booking_payment_id','ASC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query;
	}
	
	
}