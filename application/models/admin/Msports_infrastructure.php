<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msports_infrastructure extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_sports_infrastructure(){
        $this->db->select('*');
        $this->db->from('master_sports_infrastructure');
        $this->db->where('status <>','2');
		$this->db->order_by('sports_infrastructure_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_sports_infrastructure($data){
        $this->db->insert('master_sports_infrastructure', $data);
        return $this->db->insert_id();
    }

    public function edit_sports_infrastructure($sports_infrastructure_id){
        $this->db->select('sports_infrastructure_id,sports_infrastructure_name,status');
        $this->db->from('master_sports_infrastructure');
		$this->db->where('sports_infrastructure_id',$sports_infrastructure_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_sports_infrastructure($condition,$data){
        $result=$this->db->update('master_sports_infrastructure', $data, $condition);
        return $result;
    }

    public function delete_sports_infrastructure($condition,$data){
        $result=$this->db->update('master_sports_infrastructure', $data, $condition);
        return $result;
    }
}