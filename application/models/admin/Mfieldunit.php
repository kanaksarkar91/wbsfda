<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfieldunit extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_fieldunit(){
        $this->db->select('*');
        $this->db->from('master_fieldunit');
        $this->db->where('status <>','2');
		$this->db->order_by('fieldunit_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_fieldunit($data){
        $this->db->insert('master_fieldunit', $data);
        return $this->db->insert_id();
    }

    public function edit_fieldunit($fieldunit_id){
        $this->db->select('fieldunit_id,fieldunit_name,billing_unit_no,status');
        $this->db->from('master_fieldunit');
		$this->db->where('fieldunit_id',$fieldunit_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_fieldunit($condition,$data){
        $result=$this->db->update('master_fieldunit', $data, $condition);
        return $result;
    }

    public function delete_fieldunit($condition,$data){
        $result=$this->db->update('master_fieldunit', $data, $condition);
        return $result;
    }
}