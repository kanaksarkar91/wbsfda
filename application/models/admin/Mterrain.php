<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mterrain extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_terrain(){
        $this->db->select('terrain_master.*');
        $this->db->from('terrain_master');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit_terrain($data){
        $this->db->insert('terrain_master', $data);
        return $this->db->insert_id();
    }

    public function edit_terrain($terrain_id){
        $this->db->select('terrain_master.*');
        $this->db->from('terrain_master');
		$this->db->where('terrain_id',$terrain_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_terrain($condition, $data){
        $result=$this->db->update('terrain_master', $data, $condition);
        return $result;
    }

    public function delete_terrain($condition,$data){
        $result=$this->db->update('terrain_master', $data, $condition);
        return $result;
    }
}