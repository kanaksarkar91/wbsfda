<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodations extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($where = array()){
        $this->db->select('*');
        $this->db->from('accommodation');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->result();
    }

}