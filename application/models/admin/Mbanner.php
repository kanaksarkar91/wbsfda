<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbanner extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_banner(){
        $this->db->select('*');
        $this->db->from('master_banner');
        $this->db->where('status <>','2');
		$this->db->order_by('banner_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_banner($data){
        $this->db->insert('master_banner', $data);
        return $this->db->insert_id();
    }

    public function edit_banner($banner_id){
        $this->db->select('*');
        $this->db->from('master_banner');
		$this->db->where('banner_id',$banner_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_banner($condition,$data){
        $result=$this->db->update('master_banner', $data, $condition);
        return $result;
    }

    public function delete_banner($condition,$data){
        $result=$this->db->update('master_banner', $data, $condition);
        return $result;
    }
}