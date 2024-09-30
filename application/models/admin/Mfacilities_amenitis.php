<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfacilities_amenitis extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_facilities_amenitis(){
        $this->db->select('*');
        $this->db->from('facility_master');
        // $this->db->where('status <>','2');
		$this->db->order_by('facility_id','DESC');
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function submit_facilities_amenitis($data){
        $this->db->insert('facility_master', $data);
        return $this->db->insert_id();
    }

    public function edit_facilities_amenitis($facilities_amenitis_id){
        $this->db->select('facility_id,facility_name,status,facility_type');
        $this->db->from('facility_master');
		$this->db->where('facility_id',$facilities_amenitis_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_facilities_amenitis($condition,$data){
        $result=$this->db->update('facility_master', $data, $condition);
        return $result;
    }

    public function delete_facilities_amenitis($condition,$data){
        $result=$this->db->update('facility_master', $data, $condition);
        return $result;
    }
}