<?php
class Mparking extends CI_Model {
    
	function __construct(){
        parent::__construct(); 
    }
	
	public function get_parking_items($where = array()){
		$this->db->select('master_parking_item.*,property_master.property_name, uom_master.uom_name');
        $this->db->from('master_parking_item');
        $this->db->join('property_master', 'property_master.property_id = master_parking_item.property_id', 'INNER');
		$this->db->join('uom_master', 'uom_master.uom_id = master_parking_item.uom_id', 'INNER');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('item_name', 'ASC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}
	
	public function get_user_property($where = array()){
		$this->db->select('user_property_mapping.*');
        $this->db->from('user_property_mapping');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->limit(1);
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->row_array();
	}
      
}
