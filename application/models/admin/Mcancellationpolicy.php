<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcancellationpolicy extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($where = array()){
        $this->db->select('*');
        $this->db->from('cancellation_policy');
        $this->db->where('is_active <>', 2);
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('day_from');
        $query=$this->db->get();
        return $query->result();
    }

    public function add($data){
        $this->db->insert('cancellation_policy', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data){
        $result=$this->db->where('cancellation_policy_id', $id)->update('cancellation_policy', $data);
        return $result;
    }
    
}