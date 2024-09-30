<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproperty extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
	
	public function get_property_type($condn = null){
        $this->db->select('property_types.*');
        $this->db->from('property_types');
		$this->db->where($condn);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_property_terrain($condn = null){
        $this->db->select('terrain_master.*');
        $this->db->from('terrain_master');
		$this->db->where($condn);
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
	
	public function get_property_district($condn = null){
        $this->db->select('district_master.*');
        $this->db->from('district_master');
		$this->db->where($condn);
		$this->db->order_by('district_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_property_unit($condn = null){
        $this->db->select('property_unit_master.*');
        $this->db->from('property_unit_master');
		$this->db->where($condn);
		$this->db->order_by('unit_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_property_facility($condn = null){
        $this->db->select('facility_master.*');
        $this->db->from('facility_master');
		$this->db->where($condn);
		$this->db->order_by('facility_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_property($where = array()){
        $this->db->select('property_master.*, district_name as district, state_name as state,ifnull(property_types.is_hall,0) as is_hall');
        $this->db->from('property_master');
		$this->db->join('state_master', 'property_master.state_id = state_master.state_id', 'LEFT');
		$this->db->join('district_master', 'property_master.district_id = district_master.district_id', 'LEFT');
		$this->db->join('property_types', 'property_master.property_type_id = property_types.id', 'LEFT');
        $this->db->order_by('property_master.property_name');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_property($data){
        $this->db->insert('property_master', $data);
		//echo $this->db->last_query(); die;
        return $this->db->insert_id();
    }

    public function edit_property($property_id){
        $this->db->select('property_master.*, lv.*');
        $this->db->from('property_master');
		$this->db->join('property_unit_list_view lv', 'property_master.property_unit_master_id = lv.id', 'LEFT OUTER');
		$this->db->where('property_id',$property_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_property($condition, $data){
        $result=$this->db->update('property_master', $data, $condition);
        return $result;
    }

    public function delete_property($condition,$data){
        $result=$this->db->update('property_master', $data, $condition);
        return $result;
    }

    public function get_property_details_by_sp($property_id ='', $start_date='', $end_date ='')
    {
        $query = $this->db->query("call get_property_available_accomm($property_id, '$start_date', '$end_date', 0, 0, 1)");
        return $query->result();
    }
    
	public function get_user_property_details($user_id) {
		$stored_procedure = "CALL get_user_property_details(?,0);";
        $data = array('p_user_id' => $user_id);
		
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
	
	public function get_user_property_details_view($property_id = null){
        $this->db->select('property_master.*, lv.*');
        $this->db->from('property_master');
		$this->db->join('property_unit_list_view lv', 'property_master.property_unit_master_id = lv.id', 'LEFT OUTER');
		if (!is_null($property_id))
			$this->db->where('property_id', $property_id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_property_accommodation_availability($property_id, $accommodation_id = 0, $start_date, $end_date) {
		$stored_procedure = "CALL get_property_accomm_availability_proc(?,?,?,?);";
        $data = array('p_property_id' => $property_id, 'p_accom_id' => $accommodation_id, 'p_start_date' => $start_date, 'p_end_date' => $end_date);
		
        $result = $this->db->query($stored_procedure, $data);
		
        if ($result !== NULL) {
			$response = $result->result_array();
			
			$result->free_result();
			mysqli_next_result( $this->db->conn_id);
			
            return $response;
        }
        return FALSE;
	}

}