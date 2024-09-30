<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgst_slab extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_gst_slab(){
        $this->db->select('hotel_gst_slab.*, hsn_sac_master.hsn_sac_code');
        $this->db->from('hotel_gst_slab');
		$this->db->join('hsn_sac_master', 'hotel_gst_slab.hsn_sac_code = hsn_sac_master.hsn_sac_id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_gst_slab($data){
        $this->db->insert('hotel_gst_slab', $data);
        return $this->db->insert_id();
    }

    public function edit_gst_slab($tax_id){
        $this->db->select('hotel_gst_slab.*');
        $this->db->from('hotel_gst_slab');
		$this->db->where('hotel_gst_slab_id',$tax_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_gst_slab($condition, $data){
        $result=$this->db->update('hotel_gst_slab', $data, $condition);
        return $result;
    }

    public function delete_gst_slab($condition,$data){
        $result=$this->db->update('hotel_gst_slab', $data, $condition);
        return $result;
    }
}