<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpanchayat_samity extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
    public function get_panchayat_samity_list(){
        $this->db->select('panchayat_samity.*,panchayat_samity.unit_name panchayat_samity_name, zilla_parishad.unit_name zilla_parishad_name');
        $this->db->from('property_unit_master panchayat_samity');
        $this->db->join('property_unit_master zilla_parishad','panchayat_samity.parent_unit_id = zilla_parishad.id','inner');
		$this->db->where('panchayat_samity.unit_level', '2');
		$this->db->order_by('panchayat_samity.unit_name', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_panchayat_samity($data){
        $this->db->insert('property_unit_master', $data);
        return $this->db->insert_id();
    }

    public function edit_panchayat_samity($id){
        $this->db->select('property_unit_master.*,district_master.district_name');
        $this->db->from('property_unit_master');
        $this->db->join('district_master', 'district_master.district_id = property_unit_master.district_id', 'LEFT');
		$this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_panchayat_samity($condition,$data){
        $result=$this->db->update('property_unit_master', $data, $condition);
        return $result;
    }

    public function fetch_district($zilla_parishad){
        $this->db->select('property_unit_master.*,district_master.district_name');
        $this->db->from('property_unit_master');
        $this->db->join('district_master', 'district_master.district_id = property_unit_master.district_id', 'LEFT');
		$this->db->where('property_unit_master.unit_level', '1');
		$this->db->where('property_unit_master.id', $zilla_parishad);
        $query=$this->db->get();
        return $query->row_array();
    }

}