<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msafari_service extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
	
	public function get_services($where = []){
        $this->db->select('a.*, b.division_name, c.type_name');
        $this->db->from('safari_service_header a');
		$this->db->join('division_master b', 'a.division_id = b.division_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		/*if (isset($param['company_ids']) && $param['company_ids'] != '' && $param['company_ids'] != '0') {
			$this->db->where_in('a.company_id', $param['company_ids'], false);
		}*/
		$this->db->order_by('a.safari_service_header_id','DESC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function getSeasonsServiceWise($where = []){
        $this->db->select('a.service_period_master_id, b.showing_desc');
        $this->db->from('safari_service_period_slot_mapping a');
		$this->db->join('safari_service_period_master b', 'a.service_period_master_id = b.service_period_master_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('b.service_period_master_id','ASC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function capacityBatchInsert($getArray) {
        $sql = $this->db->insert_batch('safari_service_slot_capacity_mapping', $getArray);
        if($sql){
            return true;
        }

    }
	public function get_service_capacities($where = []){
        $this->db->select('a.*, b.service_definition, c.type_name, d.division_name, e.showing_desc');
        $this->db->from('safari_service_slot_capacity_mapping a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
		$this->db->join('division_master d', 'b.division_id = d.division_id', 'INNER');
		$this->db->join('safari_service_period_master e', 'a.service_period_master_id = e.service_period_master_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->group_by('a.safari_service_header_id, a.service_period_master_id');
		$this->db->order_by('DATE(a.created_ts)','DESC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function get_service_capacity_details($where = []){
        $this->db->select('a.*, b.service_definition, c.type_name, d.division_name, e.showing_desc, f.quota, g.slot_desc, g.start_time, g.end_time');
        $this->db->from('safari_service_slot_capacity_mapping a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
		$this->db->join('division_master d', 'b.division_id = d.division_id', 'INNER');
		$this->db->join('safari_service_period_master e', 'a.service_period_master_id = e.service_period_master_id', 'INNER');
		$this->db->join('safari_quota_master f', 'a.safari_quota_id = f.safari_quota_id', 'INNER');
		$this->db->join('safari_service_period_slot_detail g', 'a.period_slot_dtl_id = g.period_slot_dtl_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function pricingBatchInsert($getArray) {
        $sql = $this->db->insert_batch('safari_service_slot_price_mapping', $getArray);
        if($sql){
            return true;
        }

    }
	public function get_service_pricing($where = []){
        $this->db->select('a.*, b.service_definition, c.type_name, d.division_name, e.showing_desc');
        $this->db->from('safari_service_slot_price_mapping a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
		$this->db->join('division_master d', 'b.division_id = d.division_id', 'INNER');
		$this->db->join('safari_service_period_master e', 'a.service_period_master_id = e.service_period_master_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->group_by('a.safari_service_header_id, a.service_period_master_id');
		$this->db->order_by('DATE(a.created_ts)','DESC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function get_service_pricing_details($where = []){
        $this->db->select('a.*, b.service_definition, c.type_name, d.division_name, e.showing_desc, f.cat_name, g.slot_desc, g.start_time, g.end_time');
        $this->db->from('safari_service_slot_price_mapping a');
		$this->db->join('safari_service_header b', 'a.safari_service_header_id = b.safari_service_header_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
		$this->db->join('division_master d', 'b.division_id = d.division_id', 'INNER');
		$this->db->join('safari_service_period_master e', 'a.service_period_master_id = e.service_period_master_id', 'INNER');
		$this->db->join('safari_category_master f', 'a.safari_cat_id = f.safari_cat_id', 'INNER');
		$this->db->join('safari_service_period_slot_detail g', 'a.period_slot_dtl_id = g.period_slot_dtl_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->group_by('a.safari_service_header_id, a.period_slot_dtl_id');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function get_cat_price_detail($where = []){
        $this->db->select('a.*, b.cat_name');
        $this->db->from('safari_service_slot_price_mapping a');
		$this->db->join('safari_category_master b', 'a.safari_cat_id = b.safari_cat_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function get_services_home($where = []){
        $this->db->select('a.*, b.division_name, c.type_name');
        $this->db->from('safari_service_header a');
		$this->db->join('division_master b', 'a.division_id = b.division_id', 'INNER');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'INNER');
        if(!empty($where)){
            $this->db->where($where);
        }
		/*if (isset($param['company_ids']) && $param['company_ids'] != '' && $param['company_ids'] != '0') {
			$this->db->where_in('a.company_id', $param['company_ids'], false);
		}*/
		$this->db->group_by('a.division_id');
		$this->db->order_by('a.safari_service_header_id','DESC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	public function get_booking($where = array(),$order_by = '', $safari_service_header_ids = array(), $group_by = null){ 
        $sql = $this->db->select('a.*, b.first_name, b.mobile, c.type_name, sc.cat_name, d.division_name, e.service_definition, s.slot_desc, s.start_time, s.end_time, p.payment_date, (SELECT COUNT(safari_booking_detail_id) FROM safari_booking_detail WHERE a.booking_id=safari_booking_detail.booking_id AND is_free=1) AS child_count')
                                ->from('safari_booking_header a')
								->join('customer_master b', 'a.customer_id = b.customer_id', 'LEFT')
								->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'LEFT')
								->join('safari_category_master sc', 'a.safari_cat_id = sc.safari_cat_id', 'LEFT')
								->join('division_master d', 'a.division_id = d.division_id', 'LEFT')
								->join('safari_service_period_slot_detail s', 'a.period_slot_dtl_id = s.period_slot_dtl_id', 'LEFT')
								->join('safari_service_header e', 'a.safari_service_header_id = e.safari_service_header_id', 'LEFT')
								->join('safari_booking_payment p', 'a.booking_id = p.booking_id AND p.status = "Captured" ', 'LEFT');
								
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($safari_service_header_ids)){
            $this->db->where_in('a.safari_service_header_id', $safari_service_header_ids, false);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }
	public function getSlotsASC($where = []){
        $sql = "SELECT a.* FROM safari_service_period_slot_detail a WHERE safari_service_header_id=".$where['safari_service_header_id']." AND  service_period_master_id = ".$where['service_period_master_id']." ORDER BY STR_TO_DATE(start_time, '%h:%i %p') ASC ";
        //echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
	public function get_block_booking($table = '', $where = array(),$order_by = '', $safari_service_header_ids = array(), $group_by = null, $userIdField = ''){ 
        $sql = $this->db->select('a.*, c.type_name, d.division_name, e.service_definition, s.slot_desc, s.start_time, s.end_time, p.showing_desc, ma.full_name')
                                ->from($table.' a')
								->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'LEFT')
								->join('division_master d', 'a.division_id = d.division_id', 'LEFT')
								->join('safari_service_header e', 'a.safari_service_header_id = e.safari_service_header_id', 'LEFT')
								->join('safari_service_period_slot_detail s', 'a.period_slot_dtl_id = s.period_slot_dtl_id', 'LEFT')
								->join('safari_service_period_master p', 's.service_period_master_id = p.service_period_master_id', 'LEFT')
								->join('master_admin ma', 'a.'.$userIdField.' = ma.user_id', 'LEFT');
								
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($safari_service_header_ids)){
            $this->db->where_in('a.safari_service_header_id', $safari_service_header_ids, false);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }
	public function get_user_wise_service($safari_service_header_ids = []){
        $this->db->select('a.*');
        $this->db->from('safari_service_header a');
        if(!empty($safari_service_header_ids)){
            $this->db->where_in('a.safari_service_header_id', $safari_service_header_ids, false);
        }
		$this->db->order_by('a.service_definition','ASC');
        $query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }
	function get_safari_booking_details($where = []) {
		$this->db->select('a.*, c.type_name, d.division_name, e.service_definition, e.start_point, e.end_point, e.reporting_place, s.slot_desc, s.start_time, s.end_time, s.reporting_time, s.ticket_sale_closing_flag, s.ticket_sale_closing_time, p.showing_desc, f.cat_name, cu.first_name, cu.email, cu.mobile, , (SELECT COUNT(safari_booking_detail_id) FROM safari_booking_detail WHERE a.booking_id=safari_booking_detail.booking_id AND is_free=1) AS child_count');
		$this->db->from('safari_booking_header a');
		$this->db->join('safari_type_master c', 'a.safari_type_id = c.safari_type_id', 'LEFT');
		$this->db->join('division_master d', 'a.division_id = d.division_id', 'LEFT');
		$this->db->join('safari_service_header e', 'a.safari_service_header_id = e.safari_service_header_id', 'LEFT');
		$this->db->join('safari_service_period_slot_detail s', 'a.period_slot_dtl_id = s.period_slot_dtl_id', 'LEFT');
		$this->db->join('safari_service_period_master p', 's.service_period_master_id = p.service_period_master_id', 'LEFT');
		$this->db->join('safari_category_master f', 'a.safari_cat_id = f.safari_cat_id', 'LEFT');
		$this->db->join('customer_master cu', 'a.customer_id = cu.customer_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        $rows = $query->result_array();
		
		if(!empty($rows)){
			$i = 0;
			foreach($rows as $row){
				$this->db->select('bd.*');
				$this->db->from('safari_booking_detail bd');
				$this->db->where('bd.booking_id', $row['booking_id']);
				$query1=$this->db->get();
				//echo nl2br($this->db->last_query());die;
				$rows1 = $query1->result_array();
				
				$result[$i] = $row;
				$result[$i]['booking_details'] = $rows1;
	
				$i++;
			}
			
			if($result){
				return $result;
			} else {
				return false;
			}
		}
    }
	function get_safari_booking_payment_details($where = []) {
		$this->db->select('a.*');
		$this->db->from('safari_booking_payment a');
		if(!empty($where)){
            $this->db->where($where);
        }
		$query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->row_array();
    }
	function get_safari_booking_cancellation_details($where = []) {
		$this->db->select('a.*, IF(a.created_user_type = "C", c.first_name, u.full_name) AS created_by_name');
		$this->db->from('cancel_request_tbl a');
		$this->db->join('customer_master c', 'a.created_user_type = "C" AND a.created_by = c.customer_id', 'LEFT');
		$this->db->join('master_admin u', 'a.created_user_type = "U" AND a.created_by = u.user_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('DATE(a.created_ts)','DESC');
		$query=$this->db->get();
		//echo nl2br($this->db->last_query());die;
        return $query->result_array();
    }

}