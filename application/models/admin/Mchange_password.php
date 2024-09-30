<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mchange_password extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function update_password($condition,$data){
        $result=$this->db->update('master_admin', $data, $condition);
        return $result;
    }

    public function check_old_password($old_password,$user_id){
        $this->db->select('user_id');
        $this->db->from('master_admin');
        //$this->db->where('password', $old_password);
        $this->db->where('user_id', $user_id);
        $query=$this->db->get();
		$row = $query->row_array();
		if (password_verify($old_password, $row['password'])) {
			$ret = $query->num_rows();
			return $ret;
		}
		else{
			return 0;
		}
    }

}