<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccount extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_user_details($user_id){
        $this->db->select('ma.*');
        $this->db->from('master_admin ma');
		$this->db->where('ma.user_id',$user_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function get_district(){
        $this->db->select('district_id,district_name');
        $this->db->from('district_master');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_state(){
        $this->db->select('state_id,state_name');
        $this->db->from('state_master');
        $this->db->where('is_active',1);
        $query=$this->db->get();
        return $query->result_array();
    }

}