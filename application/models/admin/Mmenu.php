<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmenu extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_permission_menu(){
        $this->db->select('*');
        $this->db->from('menu_master');
        $this->db->where('is_active', 1);
		$this->db->order_by('menu_rank', 'ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_menu_by_condition($where = array()){
        $this->db->select('*');
        $this->db->from('menu_master');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where('is_active', 1);
		$this->db->order_by('menu_rank', 'ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

}