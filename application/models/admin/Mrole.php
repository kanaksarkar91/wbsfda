<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrole extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_role(){
        $this->db->select('a.*,1 role_count');
        $this->db->from('master_role a');
        $this->db->where('status <>','2');
		$this->db->where('role_id !=','2');
		$this->db->where('role_id !=','10');
		/*$this->db->group_by('role_name');*/
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_role($data){
        $this->db->insert('master_role', $data);
        return $this->db->insert_id();
    }

    public function edit_role($role_id){
        $this->db->select('role_id,role_name,status');
        $this->db->from('master_role');
		$this->db->where('role_id',$role_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_role($condition,$data){
        $result=$this->db->update('master_role', $data, $condition);
        return $result;
    }

    public function delete_role($condition,$data){
        $result=$this->db->update('master_role', $data, $condition);
        return $result;
    }
}