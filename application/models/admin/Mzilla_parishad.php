<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mzilla_parishad extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
    public function get_zilla_parishad_list(){
        $this->db->select('property_unit_master.*,district_master.district_name');
        $this->db->from('property_unit_master');
        $this->db->join('district_master', 'district_master.district_id = property_unit_master.district_id', 'LEFT');
		$this->db->where('property_unit_master.unit_level', '1');
		$this->db->order_by('property_unit_master.unit_name', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_zilla_parishad($data){
        $this->db->insert('property_unit_master', $data);
        return $this->db->insert_id();
    }

    public function edit_zilla_parishad($id){
        $this->db->select('*');
        $this->db->from('property_unit_master');
		$this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_zilla_parishad($condition,$data){
        $result=$this->db->update('property_unit_master', $data, $condition);
        return $result;
    }

}