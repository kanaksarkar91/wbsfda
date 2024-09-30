<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menquiry extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_enquiry(){
        $this->db->select('*');
        $this->db->from('enquiry_details');
		$this->db->order_by('enquiry_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
	
	public function update_data($condition, $data){
        $result=$this->db->update('enquiry_details', $data, $condition);
        return $result;
    }

}