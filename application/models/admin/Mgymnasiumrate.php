<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgymnasiumrate extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_gymnasium_rates($sports_facilities_id = null){
        $this->db->select('gr.*,mey.effective_year');
        $this->db->from('gymnasium_rates gr');
        $this->db->join('master_effective_year mey', 'mey.effective_year_id = gr.effective_year_id', 'inner');
        $this->db->where('gr.status','0');
        if($sports_facilities_id){
            
            $this->db->where('gr.sports_facilities_id',$sports_facilities_id);

        }
		$this->db->order_by('gr.gymnasium_rate_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }  

    public function submit_gymnasiumrate($data){
        $this->db->insert('gymnasium_rates', $data);
        return $this->db->insert_id();
    }

    public function edit_rate($rate_id){
        $this->db->select('gr.*,mey.effective_year');
        $this->db->from('gymnasium_rates gr');
        $this->db->join('master_effective_year mey', 'mey.effective_year_id = gr.effective_year_id', 'inner');
        $this->db->where('gr.status','0');
		$this->db->where('gr.gymnasium_rate_id',$rate_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    

    public function update_rate($condition,$data){
        $result=$this->db->update('gymnasium_rates', $data, $condition);
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

    public function get_gymnasiums($location_id,$slug){
        $this->db->select('*');
        $this->db->from('sports_facilities');
        $this->db->where('status','0');
        $this->db->where('location_id',$location_id);
        $this->db->where('slug',$slug);
		$this->db->order_by('sports_facilities_name','ASC');
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
    
    public function gymnasium_rate_count($sports_facilities_id,$effective_year_id,$user_type){
        $this->db->select('gymnasium_rate_id');
        $this->db->from('gymnasium_rates');
        $this->db->where('user_type',$user_type);
        $this->db->where('sports_facilities_id',$sports_facilities_id);
        $this->db->where('effective_year_id',$effective_year_id);
        $query=$this->db->get();
        $ret = $query->num_rows();
        return $ret;
    }

    public function gymnasium_schedule_count($rate_id){
        $this->db->select('gymnasium_schedule_id');
        $this->db->from('gymnasium_schedule');
        $this->db->where('gymnasium_rate_id',$rate_id);
        $query=$this->db->get();
        $ret = $query->num_rows();
        return $ret;
    }
}