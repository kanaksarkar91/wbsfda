<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhsn_sac extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_hsn_sac(){
        $this->db->select('hsn_sac_master.*, tax_master.tax_name');
        $this->db->from('hsn_sac_master');
		$this->db->join('tax_master', 'hsn_sac_master.tax_id = tax_master.tax_id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_hsn_sac($data){
        $this->db->insert('hsn_sac_master', $data);
        return $this->db->insert_id();
    }

    public function edit_hsn_sac($tax_id){
        $this->db->select('hsn_sac_master.*');
        $this->db->from('hsn_sac_master');
		$this->db->where('hsn_sac_id',$tax_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_hsn_sac($condition, $data){
        $result=$this->db->update('hsn_sac_master', $data, $condition);
        return $result;
    }

    public function delete_hsn_sac($condition,$data){
        $result=$this->db->update('hsn_sac_master', $data, $condition);
        return $result;
    }
}