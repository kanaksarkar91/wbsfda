<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlocation extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    

    public function get_fieldunit(){ 
        $this->db->select('*');
        $this->db->from('master_fieldunit');
        $this->db->where('status','0');
		$this->db->order_by('fieldunit_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_location(){
        $this->db->select('master_location.*,master_fieldunit.fieldunit_name');
        $this->db->from('master_location');
        $this->db->join('master_fieldunit','master_fieldunit.fieldunit_id=master_location.fieldunit_id');
        $this->db->where('master_location.status <>','2');
		$this->db->order_by('master_location.location_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_location($data){
        $this->db->insert('master_location', $data);
        return $this->db->insert_id();
    }

    public function edit_location($location_id){
        $this->db->select('fieldunit_id,location_id,location_name,status');
        $this->db->from('master_location');
		$this->db->where('location_id',$location_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_location($condition,$data){
        $result=$this->db->update('master_location', $data, $condition);
        return $result;
    }

    public function delete_location($condition,$data){
        $result=$this->db->update('master_location', $data, $condition);
        return $result;
    }
}