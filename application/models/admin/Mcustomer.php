<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcustomer extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_customer(){
        $this->db->select('*');
        $this->db->from('customer_master');
        $this->db->where('is_active','1');
		$this->db->order_by('customer_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_banner($data){
        $this->db->insert('master_banner', $data);
        return $this->db->insert_id();
    }

    public function edit_customer($customer_id){
        $this->db->select('*');
        $this->db->from('customer_master');
		$this->db->where('customer_id',$customer_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_customer($condition,$data){
        $result=$this->db->update('customer_master', $data, $condition);
        return $result;
    }

    public function delete_banner($condition,$data){
        $result=$this->db->update('master_banner', $data, $condition);
        return $result;
    }
}