<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtax extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_tax(){
        $this->db->select('tax_master.*');
        $this->db->from('tax_master');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_tax($data){
        $this->db->insert('tax_master', $data);
        return $this->db->insert_id();
    }

    public function edit_tax($tax_id){
        $this->db->select('tax_master.*');
        $this->db->from('tax_master');
		$this->db->where('tax_id',$tax_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_tax($condition, $data){
        $result=$this->db->update('tax_master', $data, $condition);
        return $result;
    }

    public function delete_tax($condition,$data){
        $result=$this->db->update('tax_master', $data, $condition);
        return $result;
    }
}