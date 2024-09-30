<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mvenue extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

  
    public function get_venue_list(){
        $this->db->select('master_venue.*,property_master.property_name as property_name');
        $this->db->from('master_venue');
        $this->db->join('property_master', 'property_master.property_id = master_venue.property_id', 'LEFT');
		$this->db->order_by('venue_id', 'DESC');
        $query=$this->db->get();
                //echo $this->db->last_query();die;

        return $query->result_array();
    }

    public function get_property_details(){
        $this->db->select('property_id,property_name');
        $this->db->from('property_master');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function submit_venue($data){
        $this->db->insert('master_venue', $data);
        //echo $this->db->last_query();die;
        return $this->db->insert_id();
    }

    public function edit_venue($venue_id){
        $this->db->select('*');
        $this->db->from('master_venue');
		$this->db->where('venue_id',$venue_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_venue($condition,$data){
        $result=$this->db->update('master_venue', $data, $condition);
               // echo $this->db->last_query();die;

        return $result;
    }

    public function get_venue_list_property_id($property_id = ''){
        $this->db->select('master_venue.*,property_master.property_name as property_name');
        $this->db->from('master_venue');
        $this->db->join('property_master', 'property_master.property_id = master_venue.property_id', 'LEFT');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('master_venue.property_id', $property_id);
            }else{
                $this->db->where('master_venue.property_id', $property_id);
            }
        }
		$this->db->order_by('venue_id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

        // Add this method to your Mproperty class
    public function get_active_hourly_booking_options() {
        $this->db->select('*');
        $this->db->from('venue_hourly_master');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getVenuesByPropertyId($property_id) {
        $this->db->select('*');
        $this->db->from('master_venue');
        $this->db->where('property_id', $property_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function isCombinationExists($property_id, $selected_venues) {
        // Convert selected venues to a comma-separated string in ascending order
        sort($selected_venues);
        $selected_venues_string = implode(',', $selected_venues);
        
        // Query to get venue_ids for the provided property_id, ordered by venue_id
        $this->db->select('venue_id');
        $this->db->where('property_id', $property_id);
        $this->db->where('is_active', 1);
        $this->db->order_by('venue_id', 'asc');
        $query = $this->db->get('venue_property_mapping');
        
        if ($query->num_rows() > 0) {
            // Get venue_ids from the query result and convert to a comma-separated string
            $existing_venue_ids = array_column($query->result_array(), 'venue_id');
            sort($existing_venue_ids);
            $existing_venue_ids_string = implode(',', $existing_venue_ids);
            
            // Compare the two strings to check if the combination exists
            return $selected_venues_string === $existing_venue_ids_string;
        } else {
            // No existing records for the provided property_id
            return false;
        }
    }

    public function isCombinationMultiVenueExists($property_id, $selected_venues) {
        // Convert selected venues to a comma-separated string in ascending order
        sort($selected_venues);
        $selected_venues_string = implode(',', $selected_venues);
        
        // Query to get venue_ids for the provided property_id, ordered by venue_id
        $this->db->select('multiple_venue_ids');
        $this->db->where('property_id', $property_id);
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
    
    public function saveVenueMapping($property_id, $selected_venues,$uniqueID) {
        // Assuming you have a column named 'property_id' and 'venue_id' in the venue_property_mapping table
        $data = array();
        foreach ($selected_venues as $venue_id) {
            $data[] = array('property_id' => $property_id, 'venue_id' => $venue_id,'mapping_unique_id'=>$uniqueID);
        }
        
        $this->db->insert_batch('venue_property_mapping', $data);
    }

    public function getPropertyWiseVenues() {
        $this->db->select('vp.mapping_unique_id, GROUP_CONCAT(vm.venue_id) AS venue_ids, GROUP_CONCAT(vm.venue_name) AS venue_names, pm.property_id as property_id, pm.property_name as property_name');
        $this->db->from('venue_property_mapping vp');
        $this->db->join('master_venue vm', 'vp.venue_id = vm.venue_id ');
        $this->db->join('property_master pm', 'vp.property_id = pm.property_id');
        $this->db->where('vp.is_active', 1);
        $this->db->group_by('vp.mapping_unique_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function getPropertyWiseVenuesByPropertyId($property_id = '') {
        $this->db->select('vp.mapping_unique_id as mapping_unique_id, GROUP_CONCAT(vm.venue_id) AS venue_ids, GROUP_CONCAT(vm.venue_name) AS venue_names, pm.property_id as property_id, pm.property_name as property_name');
        $this->db->from('venue_property_mapping vp');
        $this->db->join('master_venue vm', 'vp.venue_id = vm.venue_id ');
        $this->db->join('property_master pm', 'vp.property_id = pm.property_id');
        if($property_id != ''){
            if(is_array($property_id)){
                $this->db->where_in('vp.property_id', $property_id);
            }else{
                $this->db->where('vp.property_id', $property_id);
            }
        }
        $this->db->where('vp.is_active', 1);
        $this->db->group_by('vp.mapping_unique_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMappingByUniqueId($mappingUniqueId) {
        $this->db->select('mapping_unique_id, property_id, GROUP_CONCAT(venue_id) AS venue_ids');
        $this->db->where('mapping_unique_id', $mappingUniqueId);
        $this->db->where('is_active', 1);
        $this->db->group_by('mapping_unique_id');
        $query = $this->db->get('venue_property_mapping');
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }
    public function update_venueMapping($condition,$data){
        $result=$this->db->update('venue_property_mapping', $data, $condition);
               // echo $this->db->last_query();die;
        return $result;
    }

    public function isVenueMappedAndActive($venueId, $propertyId) {
        $this->db->select('venue_id');
        $this->db->where('venue_id', $venueId);
        $this->db->where('property_id', $propertyId);
        $this->db->where('is_active', 1);
        $query = $this->db->get('venue_property_mapping');
        return $query->num_rows() > 0;
    }


}