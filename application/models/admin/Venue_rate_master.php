<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venue_rate_master extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($where = array()){
        $this->db->select('vrm.*, v.venue_name, pm.property_name, rcm.rate_category_name');
        $this->db->from('venue_rate_master vrm');
        $this->db->join('master_venue v', 'v.venue_id = vrm.single_venue_id');
        $this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
        $this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->result();
    }

    public function get_filter_rates($where = array()){
        $this->db->from('venue_rate_master');
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function add($data = array())
    {    
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND single_venue_id = " . $data['single_venue_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31'))";
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND single_venue_id = " . $data['single_venue_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31'))";
        }
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{
            $this->db->insert('venue_rate_master', $data);
            return $this->db->insert_id();
        }
    }

    public function update($rate_id = '', $data = array())
    {
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND single_venue_id = " . $data['single_venue_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND single_venue_id = " . $data['single_venue_id'] . " AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{
            $this->db->where('rate_id', $rate_id)->update('venue_rate_master', $data);
            return TRUE;
        }
    }

    
    public function addMulti($data = array())
    {    
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND multiple_venue_ids =' " . $data['multiple_venue_ids'] . "' AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31'))";
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND multiple_venue_ids = '" . $data['multiple_venue_ids'] . "' AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31'))";
        }
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{
            $this->db->insert('venue_rate_master', $data);
            return $this->db->insert_id();
        }
    }

    public function updateMulti($rate_id = '', $data = array())
    {
        if($data['eff_end_date'] == '') {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND multiple_venue_ids = '" . $data['multiple_venue_ids'] . "' AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_end_date >= '" . $data['eff_start_date'] . "') OR (eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        else {
            $sql = "SELECT COUNT(1) cnt FROM venue_rate_master WHERE property_id = " . $data['property_id'] . " AND multiple_venue_ids = '" . $data['multiple_venue_ids'] . "' AND rate_category_id = " . $data['rate_category_id'] . " AND ((eff_start_date <= '" . $data['eff_start_date'] . "' AND eff_end_date >= '" . $data['eff_end_date'] . "') OR (eff_start_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_end_date BETWEEN '" . $data['eff_start_date'] . "' AND '" . $data['eff_end_date'] . "') OR (eff_start_date <= '" . $data['eff_end_date'] . "' AND eff_end_date = '9999-12-31')) AND rate_id != " . $rate_id;
        }
        //echo $sql;
        $result = $this->db->query($sql)->row_array();
        if(!empty($result) &&  $result['cnt']>0 ){
            return FALSE;
        }else{

            $this->db->where('rate_id', $rate_id)->update('venue_rate_master', $data);
            //echo $this->db->last_query();die;

            return TRUE;
        }
    }

    public function getMultiVenueRate($where = array()) {
        // Select columns from venue_rate_master table
        $this->db->select('vrm.*, GROUP_CONCAT(v.venue_name) AS venue_names, pm.property_name, rcm.rate_category_name');
    
        // Specify the main table to query from
        $this->db->from('venue_rate_master vrm');
    
        // Join with other tables
        $this->db->join('master_venue v', 'FIND_IN_SET(v.venue_id, vrm.multiple_venue_ids)');
        $this->db->join('property_master pm', 'pm.property_id = vrm.property_id');
        $this->db->join('rate_category_master rcm', 'rcm.rate_category_id = vrm.rate_category_id');
    
        // Apply the provided filter conditions
        $this->db->where($where);
    
        // Group the result by other columns
        $this->db->group_by('vrm.rate_id');
    
        // Execute the query
        $query = $this->db->get();
        //echo $this->db->last_query();die;

        // Return the query result as an array of objects
        return $query->result();
    }

    public function isCombinationMultiVenueExists($property_id, $selected_venues,$rate_id) {
        // Convert selected venues to a comma-separated string in ascending order
        sort($selected_venues);
        $selected_venues_string = implode(',', $selected_venues);
        
        // Query to get venue_ids for the provided property_id, ordered by venue_id
        $this->db->select('multiple_venue_ids');
        $this->db->where('property_id', $property_id);
        $this->db->where('rate_id <>',$rate_id);
        $this->db->where('is_active', 1);
        $this->db->where('is_multiple_venues', 1);
        $query = $this->db->get('venue_rate_master');
        
        if ($query->num_rows() > 0) {
            // Get venue_ids from the query result and convert to a comma-separated string
            $existing_venue_ids = array_column($query->result_array(), 'multiple_venue_ids');            
            // Compare the two strings to check if the combination exists
            return $selected_venues_string === $existing_venue_ids;
        } else {
            // No existing records for the provided property_id
            return false;
        }
    }
    
}