<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msportsfacilitiesrate extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_sports_facilities_rates($sports_facilities_id = null,$organization_category_id = null){
        $this->db->select('*');
        $this->db->from('sports_facilities_rates');
        $this->db->where('status','0');
        if($sports_facilities_id){
            
            $this->db->where('sports_facilities_id',$sports_facilities_id);

        }
        if($organization_category_id){
            
            $this->db->where('organization_type',$organization_category_id);

        }
		$this->db->order_by('rate_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_sports_facilities_previous_rate($sports_facilities_id,$organization_category_id){
        $this->db->select('*');
        $this->db->from('sports_facilities_rates');
        $this->db->where('status','0');
        if($sports_facilities_id){
            
            $this->db->where('sports_facilities_id',$sports_facilities_id);

        }
        if($organization_category_id){
            
            $this->db->where('organization_type',$organization_category_id);

        }
		$this->db->order_by('rate_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    

    public function submit_rate($data){
        $this->db->insert('sports_facilities_rates', $data);
        return $this->db->insert_id();
    }

    public function edit_rate($rate_id){
        $this->db->select('*');
        $this->db->from('sports_facilities_rates');
		$this->db->where('rate_id',$rate_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    

    public function update_rate($condition,$data){
        $result=$this->db->update('sports_facilities_rates', $data, $condition);
        return $result;
    }

    

    public function get_location($fieldunit_id){
        $this->db->select('location_id,location_name');
        $this->db->from('master_location');
        $this->db->where('status','0');
        $this->db->where('fieldunit_id',$fieldunit_id);
		$this->db->order_by('location_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_fieldunit(){
        $this->db->select('*');
        $this->db->from('master_fieldunit');
        $this->db->where('status','0');
		$this->db->order_by('fieldunit_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_sportsfacilities($location_id,$slug = null){ 
        $this->db->select('*');
        $this->db->from('sports_facilities');
        $this->db->where('status','0');
        $this->db->where('location_id',$location_id);
        if(!empty($slug)){
            
            $this->db->where('slug',$slug);
            
        }
		$this->db->order_by('sports_facilities_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }


    public function get_organization_category(){
        $this->db->select('*');
        $this->db->from('organization_category');
        $this->db->where('status','0');
		$this->db->order_by('organization_category_id','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }
    

    

    
}