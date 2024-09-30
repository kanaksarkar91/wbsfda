<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdistrict extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_district(){
        $this->db->select('district_master.*,state_master.state_name');
        $this->db->from('district_master');
        $this->db->join('state_master','state_master.state_id=district_master.state_id','inner');
        $this->db->where('district_master.is_active','1');
		$this->db->order_by('district_master.district_name','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_district($data){
        $this->db->insert('district_master', $data);
        return $this->db->insert_id();
    }

    public function update_district($condition,$data){
        $result=$this->db->update('district_master', $data, $condition);
        return $result;
    }

    public function edit_district($district_id){
        $this->db->select('district_master.*,state_master.state_name');
        $this->db->from('district_master');
        $this->db->join('state_master','state_master.state_id=district_master.state_id','inner');
        $this->db->where('district_master.is_active','1');
        $this->db->where('district_master.district_id',$district_id);
		$this->db->order_by('district_master.district_name','ASC');
        $query=$this->db->get();
        return $query->row_array();
    }

    // public function update_district_images($condition,$data){
    //     $result=$this->db->update('district_master', $data, $condition);
    //     return $result;
    // }

}