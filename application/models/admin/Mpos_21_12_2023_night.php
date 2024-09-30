<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpos extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_pos_list($where = array()){
        $this->db->select('cost_center_master.*,property_master.property_name');
        $this->db->from('cost_center_master');
        $this->db->join('property_master', 'property_master.property_id = cost_center_master.property_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('cost_center_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	public function get_pos_list_property_id($property_id = ''){
        $this->db->select('cost_center_master.*, property_master.property_name');
        $this->db->from('cost_center_master');
        $this->db->join('property_master', 'property_master.property_id = cost_center_master.property_id', 'LEFT');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('cost_center_master.property_id', $property_id);
            }else{
                $this->db->where('cost_center_master.property_id', $property_id);
            }
        }
		$this->db->order_by('cost_center_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
	
	public function get_pos_category_list($where = array()){
        $this->db->select('category_master.*,property_master.property_name');
        $this->db->from('category_master');
        $this->db->join('property_master', 'property_master.property_id = category_master.property_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('category_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	public function get_pos_category_list_property_id($property_id = ''){
        $this->db->select('*,property_name');
        $this->db->from('category_master');
        $this->db->join('property_master', 'property_master.property_id = category_master.property_id', 'LEFT');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('category_master.property_id', $property_id);
            }else{
                $this->db->where('category_master.property_id', $property_id);
            }
        }
		$this->db->order_by('category_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
	
	public function get_product_service_list($where = array()){
        $this->db->select('*,property_name,category_flag,uom_name');
        $this->db->from('product_service_master');
        $this->db->join('property_master', 'property_master.property_id = product_service_master.property_id', 'LEFT');
		$this->db->join('category_master', 'category_master.category_id = product_service_master.category_id', 'LEFT');
		$this->db->join('uom_master', 'uom_master.uom_id = product_service_master.uom_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('product_service_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	public function get_product_service_list_property_id($property_id = ''){
        $this->db->select('*,property_name,category_flag,uom_name');
        $this->db->from('product_service_master');
        $this->db->join('property_master', 'property_master.property_id = product_service_master.property_id', 'LEFT');
		$this->db->join('category_master', 'category_master.category_id = product_service_master.category_id', 'LEFT');
		$this->db->join('uom_master', 'uom_master.uom_id = product_service_master.uom_id', 'LEFT');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('product_service_master.property_id', $property_id);
            }else{
                $this->db->where('product_service_master.property_id', $property_id);
            }
        }
		$this->db->order_by('product_service_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
	
	
	public function get_product_service_sale_rate_list($where = array()){
        $this->db->select('*,product_service_name,cost_center_name');
        $this->db->from('product_service_sale_rate');
        $this->db->join('product_service_master', 'product_service_master.product_service_id = product_service_sale_rate.product_service_id', 'LEFT');
		$this->db->join('cost_center_master', 'cost_center_master.cost_center_id = product_service_sale_rate.cost_center_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('product_service_sale_rate.product_service_sale_rate_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	public function checkSaleRateData($post_data = array()){
		
		if(intval($post_data['product_service_sale_rate_id']) != 0) {
			$sql_condition = " AND product_service_sale_rate_id != " . $post_data['product_service_sale_rate_id'];
		}
		
		if($post_data['eff_end_date'] == '') {
			$sql = "SELECT COUNT(1) cnt FROM product_service_sale_rate WHERE product_service_id = " . decode_url($post_data['product_service_id']) . " AND cost_center_id = ".$post_data['cost_center_id']." AND ((eff_end_date >= '" . $post_data['eff_start_date'] . "') OR (eff_end_date = '0000-00-00'))" . $sql_condition;
		}
		else {
			$sql = "SELECT COUNT(1) cnt FROM product_service_sale_rate WHERE product_service_id = " . decode_url($post_data['product_service_id']) . " AND cost_center_id = ".$post_data['cost_center_id']." AND ((eff_start_date <= '" . $post_data['eff_start_date'] . "' AND eff_end_date >= '" . $post_data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $post_data['eff_start_date'] . "' AND '" . $post_data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $post_data['eff_start_date'] . "' AND '" . $post_data['eff_end_date'] . "') OR (eff_start_date <= '" . $post_data['eff_end_date'] . "' AND eff_end_date = '0000-00-00'))" . $sql_condition;
		}
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
	
	public function product_count($category_id = 0)
	{
		$sql = "SELECT COUNT(*) AS tot_product FROM product_service_master WHERE category_id = ".$category_id." ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
	
	public function getProductServiceList($cost_center_id = 0, $query = '', $category_id = 0)
	{
		if($query != ''){
			$sql_cond = " AND psm.product_service_name LIKE '%$query%' ";
		}
		if($category_id != 0){
			$sql_cond .= " AND psm.category_id = ".$category_id." ";
		}
		
		$sql = "SELECT pssr.*, psm.*, uom_master.uom_name FROM product_service_sale_rate pssr
				LEFT JOIN product_service_master psm ON pssr.product_service_id = psm.product_service_id
				LEFT JOIN uom_master ON psm.uom_id = uom_master.uom_id
				WHERE pssr.cost_center_id = ".$cost_center_id." 
				AND IF(pssr.eff_end_date != '0000-00-00', pssr.eff_end_date >= CURDATE(), pssr.eff_end_date < CURDATE()) " .$sql_cond;
				
		$sql .= " ORDER BY psm.product_service_name ASC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function getCatagories($property_id = 0, $query = '', $cost_center_id = 0)
	{
		if($query != ''){
			$sql_cond = " AND category_master.category_name LIKE '%$query%' ";
		}
		
		$sql = "SELECT category_master.* FROM category_master LEFT JOIN product_service_master ON category_master.category_id = product_service_master.category_id
				WHERE product_service_master.category_id IS NOT NULL AND category_master.cost_center_id = ".$cost_center_id." AND category_master.property_id = ".$property_id." " .$sql_cond;
		$sql .= " GROUP BY product_service_master.category_id ORDER BY category_name asc";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_product_sale_rate($product_service_id = 0, $cost_center_id = 0)
	{
		$sql = "SELECT pssr.*, tax_master.tax_percentage, tax_master.cgst_percentage, tax_master.sgst_percentage FROM product_service_sale_rate pssr LEFT JOIN tax_master ON pssr.tax_id = tax_master.tax_id WHERE pssr.product_service_id = ".$product_service_id." AND pssr.cost_center_id = ".$cost_center_id." ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
	
	public function get_hold_pos($cost_center_id = 0)
	{
		$sql = "SELECT SUM(psd.payable_amount) AS net_bill_amount, psh.sale_order_id, psh.order_no, psh.cost_center_id, psh.table_no 
				FROM pos_sale_detail psd
				
				LEFT JOIN pos_sale_header psh ON
				psd.sale_order_id = psh.sale_order_id

				WHERE psh.cost_center_id = ".$cost_center_id." AND psh.open_status = '0'

				GROUP BY psd.sale_order_id ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_folder_details($sale_order_id = 0)
	{
		$sql = "SELECT sale_detail_id, sale_order_id, psd.product_service_id, psd.quantity, psd.uom_id, psd.rate, psm.product_service_name FROM pos_sale_detail psd INNER JOIN product_service_master psm on psm.product_service_id=psd.product_service_id WHERE sale_order_id = ".$sale_order_id." ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_open_folio($property_id = 0)
	{
		$sql = "SELECT bh.booking_id, GROUP_CONCAT(DISTINCT(cd.room_no)) room_no,bh.folio_no, concat(ifnull(bh.first_name,''),' ',ifnull(bh.middle_name,''),' ',ifnull(bh.last_name,'')) as customer_name,bh.email,bh.mobile FROM booking_header bh 
	INNER JOIN booking_detail bd ON bh.booking_id = bd.booking_id
	INNER JOIN check_in_detail cd ON cd.booking_detail_id=bd.booking_detail_id
	WHERE bh.property_id = ".$property_id." AND bh.booking_status = 'A' AND bd.allotment_status IN ('I', 'O') group by bh.booking_id ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_pos_header_details($sale_order_id = 0)
	{
		$sql = "SELECT psh.*, pm.property_name, pm.address_line_1, pm.address_line_2, pm.city, pm.pincode, pm.phone_no, pm.email, pm.gst_no, ccm.cost_center_name, ccm.fssai, district_master.district_name, state_master.state_name, state_master.state_code
				FROM pos_sale_header psh 
				LEFT JOIN property_master pm ON psh.property_id = pm.property_id
				LEFT JOIN cost_center_master ccm ON psh.cost_center_id = ccm.cost_center_id
				LEFT JOIN district_master ON pm.district_id = district_master.district_id
				LEFT JOIN state_master ON pm.state_id = state_master.state_id
				WHERE psh.sale_order_id = ".$sale_order_id." ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
	
	public function get_pos_details($sale_order_id = 0, $cost_center_id = 0)
	{
		$sql = "SELECT psd.*, psm.product_service_name, tm.tax_percentage, scm.sac_code FROM pos_sale_detail psd
				LEFT JOIN product_service_master psm ON psd.product_service_id = psm.product_service_id
				LEFT JOIN product_service_sale_rate pssr ON psm.product_service_id = pssr.product_service_id
				LEFT JOIN tax_master tm ON pssr.tax_id = tm.tax_id
				LEFT JOIN sac_code_master scm ON pssr.sac_code_id = scm.sac_code_id
				WHERE psd.sale_order_id = ".$sale_order_id." AND pssr.cost_center_id = ".$cost_center_id." GROUP BY pssr.cost_center_id,pssr.product_service_id ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_pos_invoice_list($property_id = 0)
	{
		$sql = "SELECT SUM(psd.payable_amount) AS net_bill_amount, ccm.cost_center_name, psh.sale_order_id, psh.order_no, psh.cost_center_id, psh.table_no, ifnull(DATE_FORMAT(psh.order_generate_time,'%d/%m/%Y'),'N/A') order_generate_time, psh.invoice_no, ifnull(bp.payment_mode,'') payment_mode,
		(select ifnull(sum(amount), 0) from booking_payment where sale_order_id=psh.sale_order_id)as paid_amount
				FROM pos_sale_detail psd
				
				LEFT JOIN pos_sale_header psh ON psd.sale_order_id = psh.sale_order_id
				LEFT JOIN booking_payment bp ON psh.sale_order_id = bp.sale_order_id
				LEFT JOIN cost_center_master ccm ON psh.cost_center_id = ccm.cost_center_id
				WHERE psh.property_id = ".$property_id." AND psh.sale_flag = '1' AND psh.booking_id is Null AND psh.invoice_no is not Null

				GROUP BY psd.sale_order_id ORDER BY psh.order_generate_time DESC ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function __get_pos_invoice_list($property_id = 0, $cost_center_id = 0)
	{
		$sql = "SELECT SUM(psd.payable_amount) AS net_bill_amount, ccm.cost_center_name, psh.sale_order_id, psh.order_no, psh.cost_center_id, psh.table_no, ifnull(DATE_FORMAT(psh.order_generate_time,'%d/%m/%Y'),'N/A') order_generate_time, psh.invoice_no, ifnull(bp.payment_mode,'') payment_mode,
		(select ifnull(sum(amount), 0) from booking_payment where sale_order_id=psh.sale_order_id AND booking_payment.status = 'SUCCESS')as paid_amount
				FROM pos_sale_detail psd
				
				LEFT JOIN pos_sale_header psh ON psd.sale_order_id = psh.sale_order_id
				LEFT JOIN booking_payment bp ON psh.sale_order_id = bp.sale_order_id
				LEFT JOIN cost_center_master ccm ON psh.cost_center_id = ccm.cost_center_id
				WHERE psh.property_id = ".$property_id." AND psh.cost_center_id = ".$cost_center_id." AND psh.sale_flag = '1' AND psh.booking_id is Null AND psh.invoice_no is not Null

				GROUP BY psd.sale_order_id ORDER BY psh.order_generate_time DESC ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_receivable_invoice_details($sale_order_id = 0)
	{
		$sql = "SELECT psh.*, SUM(psd.payable_amount) AS net_bill_amount, ccm.cost_center_name, betm.edc_terminal_id, betm.PAYTM_MID, betm.PAYTM_MERCHANT_KEY
				FROM pos_sale_header psh
				
				LEFT JOIN pos_sale_detail psd ON
				psh.sale_order_id = psd.sale_order_id
				
				LEFT JOIN cost_center_master ccm ON
				psh.cost_center_id = ccm.cost_center_id
				
				LEFT JOIN bank_edc_terminal_master betm ON
				ccm.cost_center_id = betm.cost_center_id

				WHERE psh.sale_order_id = ".$sale_order_id."

				GROUP BY psd.sale_order_id ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
	
	public function get_pos_invoice_list_for_cancel($where = array(),$order_by = '', $property_ids = array(), $group_by = null){ 
        $sql = $this->db->select('SUM(psd.payable_amount) AS net_bill_amount, ccm.cost_center_name, psh.sale_order_id, psh.order_no, psh.cost_center_id, psh.table_no, ifnull(DATE_FORMAT(psh.order_generate_time,"%d/%m/%Y"),"N/A") order_generate_time, psh.invoice_no, ifnull(bp.payment_mode,"") payment_mode,
		(select ifnull(sum(amount), 0) from booking_payment where sale_order_id=psh.sale_order_id AND booking_payment.status = "SUCCESS")as paid_amount')
                                ->from('pos_sale_detail psd')
                                ->join('pos_sale_header psh', 'psd.sale_order_id = psh.sale_order_id')
								->join('booking_payment bp', 'psh.sale_order_id = bp.sale_order_id', 'LEFT')
								->join('cost_center_master ccm', 'psh.cost_center_id = ccm.cost_center_id')
								->where('psh.sale_flag = "1" AND psh.booking_id is Null AND psh.invoice_no is not Null');
								
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($property_ids) && is_array($property_ids)){
            $this->db->where_in('psh.property_id', $property_ids);
        }
        if (!is_null($group_by)) {
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
            $this->db->order_by($order_by,null);
        }
		
        return $result = $sql->get()->result();
    }
	
	public function user_wise_pos($property_id = 0, $user_id = 0)
	{
		$sql = "SELECT user_pos_mapping.*, cost_center_master.cost_center_name
				FROM user_pos_mapping
				
				LEFT JOIN cost_center_master ON
				user_pos_mapping.cost_center_id = cost_center_master.cost_center_id

				WHERE user_pos_mapping.property_id = ".$property_id." AND user_pos_mapping.user_id = ".$user_id." ";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}

}