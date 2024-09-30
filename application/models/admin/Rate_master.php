<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate_master extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($where = array()){
        $this->db->select('rm.*, acc.accommodation_name, pm.property_name, rcm.rate_category_name');
        $this->db->from('rate_master rm');
        $this->db->join('accommodation acc', 'acc.accommodation_id = rm.accommodation_id', 'LEFT');
        $this->db->join('property_master pm', 'pm.property_id = rm.property_id', 'LEFT');
        $this->db->join('rate_category_master rcm', 'rcm.rate_category_id = rm.rate_category_id', 'LEFT');
        $this->db->where($where);
        $query=$this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result();
    }

    public function get_filter_rates($where = array()){
        $this->db->from('rate_master');
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function add($data = array())
    {
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM rate_master WHERE property_id = " . $data['property_id'] . " AND accommodation_id = " . $data['accommodation_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31'))";
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM rate_master WHERE property_id = " . $data['property_id'] . " AND accommodation_id = " . $data['accommodation_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31'))";
        }
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{
            $this->db->insert('rate_master', $data);
			//echo $this->db->last_query(); die;
            return $this->db->insert_id();
        }
    }

    public function update($rate_id = '', $data = array())
    {
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM rate_master WHERE property_id = " . $data['property_id'] . " AND accommodation_id = " . $data['accommodation_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM rate_master WHERE property_id = " . $data['property_id'] . " AND accommodation_id = " . $data['accommodation_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{
            $this->db->where('rate_id', $rate_id)->update('rate_master', $data);
            return TRUE;
        }
    }

}