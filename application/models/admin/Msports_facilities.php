<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msports_facilities extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_sports_facilities($page_type){
        $this->db->select('sf.*,mf.fieldunit_name,ml.location_name');
        $this->db->from('sports_facilities sf');
        $this->db->join('master_fieldunit mf', 'mf.fieldunit_id = sf.fieldunit_id', 'inner');
        $this->db->join('master_location ml', 'ml.location_id = sf.location_id', 'inner');
        $this->db->where('sf.status <>','2');
        $this->db->where('sf.page_type',$page_type);
		$this->db->order_by('sf.sports_facilities_id','DESC');
        $query=$this->db->get();
        // echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function submit_sports_facilities($data){
        $this->db->insert('sports_facilities', $data);
        return $this->db->insert_id();
    }

    public function edit_sports_facilities($sports_facilities_id){
        $this->db->select('*');
        $this->db->from('sports_facilities');
		$this->db->where('sports_facilities_id',$sports_facilities_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function get_sports_facilities_amenitis($sports_facilities_id){
        $this->db->select('*');
        $this->db->from('sports_facilities_amenitis');
		$this->db->where('sports_facilities_id',$sports_facilities_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_sports_facilities_infrastructure($sports_facilities_id){
        $this->db->select('*');
        $this->db->from('sports_facilities_infrastructure');
		$this->db->where('sports_facilities_id',$sports_facilities_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_sports_facilities_images($sports_facilities_id){
        $this->db->select('*');
        $this->db->from('sports_facilities_images');
		$this->db->where('sports_facilities_id',$sports_facilities_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function update_sports_facilities($condition,$data){
        $result=$this->db->update('sports_facilities', $data, $condition);
        return $result;
    }

    public function delete_sports_facilities_amenitis($condition){
        $result=$this->db->where($condition)->delete('sports_facilities_amenitis');
        return $result;
    }

    public function delete_sports_facilities_infrastructure($condition){
        $result=$this->db->where($condition)->delete('sports_facilities_infrastructure');
        return $result;
    }

    public function delete_sports_facilities_images($condition){
        $result=$this->db->where($condition)->delete('sports_facilities_images');
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
}