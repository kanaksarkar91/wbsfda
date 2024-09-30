<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccommodation extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_accommodation_list($where = array()){
        $this->db->select('accommodation.*,property_name,accomm_type_name,accomm_class_name,property_master.is_active AS p_is_active');
        $this->db->from('accommodation');
        $this->db->join('property_master', 'property_master.property_id = accommodation.property_id', 'LEFT');
        $this->db->join('accomm_class_master', 'accomm_class_master.accomm_class_id = accommodation.accomm_class_id', 'LEFT');
		$this->db->join('accomm_type_master', 'accomm_type_master.accomm_type_id = accommodation.accomm_type_id', 'LEFT');
		if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('accommodation_id', 'DESC');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function get_property_details(){
        $this->db->select('property_id,property_name');
        $this->db->from('property_master');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_accomm_class(){
        $this->db->select('accomm_class_id,accomm_class_name');
        $this->db->from('accomm_class_master');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_accomm_type(){
        $this->db->select('accomm_type_id,accomm_type_name');
        $this->db->from('accomm_type_master');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_property_facility($condn = null){
        $this->db->select('facility_master.*');
        $this->db->from('facility_master');
		$this->db->where($condn);
		$this->db->order_by('facility_id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_accommodation($data){
        $this->db->insert('accommodation', $data);
        return $this->db->insert_id();
    }

    public function edit_accommodation($accommodation_id){
        $this->db->select('*');
        $this->db->from('accommodation');
		$this->db->where('accommodation_id',$accommodation_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_accommodation($condition,$data){
        $result=$this->db->update('accommodation', $data, $condition);
        return $result;
    }

    public function delete_facilities_amenitis($condition,$data){
        $result=$this->db->update('accommodation', $data, $condition);
        return $result;
    }

    public function get_facilities(){
        $this->db->select('facility_id,facility_name');
        $this->db->from('facility_master');
        $this->db->where('facility_type =','R');
        $this->db->where('status =','1');
        $query=$this->db->get();
        // echo '<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }

    public function get_accommodation_list_property_id($property_id = ''){
        $this->db->select('*,property_name,accomm_type_name,accomm_class_name');
        $this->db->from('accommodation');
        $this->db->join('property_master', 'property_master.property_id = accommodation.property_id', 'LEFT');
        $this->db->join('accomm_class_master', 'accomm_class_master.accomm_class_id = accommodation.accomm_class_id', 'LEFT');
		$this->db->join('accomm_type_master', 'accomm_type_master.accomm_type_id = accommodation.accomm_type_id', 'LEFT');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('accommodation.property_id', $property_id);
            }else{
                $this->db->where('accommodation.property_id', $property_id);
            }
        }
		$this->db->order_by('accommodation_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_property_accomm_availability($property_id = '', $accommodation_id = '', $from_date = '', $to_date = '')
    {
        $result = $this->db->query("call get_property_accomm_availability_proc($property_id, $accommodation_id,'$from_date','$to_date')");
        //echo $this->db->last_query(); die;
		//return $result->result_array();
		
		if ($result !== NULL) {
			$response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id);
			
            return $response;
        }
        return FALSE;
    }

}