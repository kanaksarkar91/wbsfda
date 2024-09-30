<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcoupon extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($where = array(), $with_property = false){
        $this->db->select('coupon_master.*');
        $this->db->from('coupon_master');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function submit($data){
        $this->db->insert('coupon_master', $data);
        return $this->db->insert_id();
    }
    
    public function update($condition, $data){
        $result=$this->db->update('coupon_master', $data, $condition);
        return $result;
    }

    public function delete($condition,$data){
        $result=$this->db->update('coupon_master', $data, $condition);
        return $result;
    }
}