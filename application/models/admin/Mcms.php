<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcms extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_cms(){
        $this->db->select('*');
        $this->db->from('master_cms');
        $this->db->where('status <>','2');
		$this->db->order_by('cms_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_cms($data){
        $this->db->insert('master_cms', $data);
        return $this->db->insert_id();
    }

    public function edit_cms($cms_id){
        $this->db->select('*');
        $this->db->from('master_cms');
		$this->db->where('cms_id',$cms_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_cms($condition,$data){
        $result=$this->db->update('master_cms', $data, $condition);
        return $result;
    }

    public function delete_cms($condition,$data){
        $result=$this->db->update('master_cms', $data, $condition);
        return $result;
    }
}