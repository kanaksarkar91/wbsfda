<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgram_panchayat extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
    public function get_gram_panchayat_list(){
        $this->db->select('gram_panchayat.*,gram_panchayat.unit_name gram_panchayat_name, panchayat_samiti.unit_name panchayat_samiti_name');
        $this->db->from('property_unit_master gram_panchayat');
        $this->db->join('property_unit_master panchayat_samiti','gram_panchayat.parent_unit_id = panchayat_samiti.id','inner');
		$this->db->where('gram_panchayat.unit_level', '3');
		$this->db->order_by('gram_panchayat.unit_name', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_gram_panchayat($data){
        $this->db->insert('property_unit_master', $data);
        return $this->db->insert_id();
    }

    public function edit_gram_panchayat($id){
        $this->db->select('property_unit_master.*,district_master.district_name');
        $this->db->from('property_unit_master');
        $this->db->join('district_master', 'district_master.district_id = property_unit_master.district_id', 'LEFT');
		$this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_gram_panchayat($condition,$data){
        $result=$this->db->update('property_unit_master', $data, $condition);
        return $result;
    }

}