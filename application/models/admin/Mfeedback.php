<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfeedback extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_feedback(){
        $this->db->select('uf.*,cm.customer_title,cm.first_name,cm.middle_name,cm.last_name,cm.mobile_country_code,cm.mobile');
        $this->db->from('user_feedback uf');
        $this->db->join('customer_master cm', 'cm.customer_id = uf.created_by', 'inner');
		$this->db->order_by('uf.feedback_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

}