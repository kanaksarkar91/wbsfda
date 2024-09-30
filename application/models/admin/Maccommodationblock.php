<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccommodationblock extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($where = array()){
        $this->db->select('blocked_accommodation.*, property_master.property_name, accommodation.accommodation_name');
        $this->db->from('blocked_accommodation');
        $this->db->join('property_master', 'property_master.property_id = blocked_accommodation.property_id');
        $this->db->join('accommodation', 'accommodation.accommodation_id = blocked_accommodation.accommodation_id', 'LEFT');
        if(!empty($where)){
            $this->db->where($where);
        }
		$this->db->order_by('blocked_id');
        $query=$this->db->get();
        return $query->result();
    }

    public function add($data){
        $this->db->insert('blocked_accommodation', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data){
        $result=$this->db->where('blocked_id', $id)->update('blocked_accommodation', $data);
        return $result;
    }

    public function get_accommodation_block_list_property_id($property_id = array()){
        $this->db->select('blocked_accommodation.*, property_master.property_name, accommodation.accommodation_name');
        $this->db->from('blocked_accommodation');
        $this->db->join('property_master', 'property_master.property_id = blocked_accommodation.property_id');
        $this->db->join('accommodation', 'accommodation.accommodation_id = blocked_accommodation.accommodation_id', 'LEFT');
        if(!empty($property_id)){
            $this->db->where_in('blocked_accommodation.property_id', $property_id);
        }
		$this->db->order_by('blocked_id');
        $query=$this->db->get();
        return $query->result();
    }

    public function get_accommodation_status($data = array(), $id = ''){
        $f_date = date('Y-m-d', strtotime($data['from_date']));
        $to_date = date('Y-m-d', strtotime($data['to_date']));

        $this->db->select('*');
        $this->db->from('blocked_accommodation');
        if(!empty($id)){
            $this->db->where('blocked_id !=', $id);
        }
        $this->db->where('property_id', $data['property_id']);
        $this->db->where('accommodation_id', $data['accommodation_id']);
        $this->db->group_start();
        $this->db->where('from_date BETWEEN "'. $f_date. '" and "'. $to_date.'"');
        $this->db->or_where('to_date BETWEEN "'. $f_date. '" and "'. $to_date.'"');
        $this->db->group_end();
		$this->db->order_by('blocked_id');
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result();
    }
    
}