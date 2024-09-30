<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtrainingcenterrate extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_training_center_rates($sports_facilities_id = null){
        $this->db->select('tr.*,mey.effective_year');
        $this->db->from('trainingcenter_rates tr');
        $this->db->join('master_effective_year mey', 'mey.effective_year_id = tr.effective_year_id', 'inner');
        $this->db->where('tr.status','0');
        if($sports_facilities_id){
            
            $this->db->where('tr.sports_facilities_id',$sports_facilities_id);

        }
		$this->db->order_by('tr.trainingcenter_rate_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_trainingcenterrate($data){
        $this->db->insert('trainingcenter_rates', $data);
        return $this->db->insert_id();
    }

    public function edit_rate($rate_id){
        $this->db->select('tr.*,mey.effective_year');
        $this->db->from('trainingcenter_rates tr');
        $this->db->join('master_effective_year mey', 'mey.effective_year_id = tr.effective_year_id', 'inner');
        $this->db->where('tr.status','0');
		$this->db->where('tr.trainingcenter_rate_id',$rate_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    

    public function update_rate($condition,$data){
        $result=$this->db->update('trainingcenter_rates', $data, $condition);
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

    public function get_trainingcenters($location_id,$slug){
        $this->db->select('*');
        $this->db->from('sports_facilities');
        $this->db->where('status','0');
        $this->db->where('location_id',$location_id);
        $this->db->where('slug',$slug);
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
    
    public function get_effective_years(){
        $this->db->select('*');
        $this->db->from('master_effective_year');
        $this->db->where('status','0');
		$this->db->order_by('effective_year','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }
    

    
}