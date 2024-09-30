<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mparking_item extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_item_list($where = array()){
        $this->db->select('master_parking_item.*,property_master.property_name');
        $this->db->from('master_parking_item');
        $this->db->join('property_master', 'property_master.property_id = master_parking_item.property_id', 'INNER');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('item_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	public function get_item_list_property_id($property_id = ''){
        $this->db->select('*,property_name');
        $this->db->from('master_parking_item');
        $this->db->join('property_master', 'property_master.property_id = master_parking_item.property_id', 'INNER');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('master_parking_item.property_id', $property_id);
            }else{
                $this->db->where('master_parking_item.property_id', $property_id);
            }
        }
		$this->db->order_by('item_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
	

}