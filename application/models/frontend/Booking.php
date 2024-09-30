<?php

class Mbooking extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function get_booking_property_list($property_type_id = '', $search_string = '', $from_date = '', $to_date = '', $adult_pax = '', $child_pax = '', $property_district = '', $hotel_types = '', $facilities = '', $rate_category_id = '') {
		$stored_procedure = "CALL search_property_proc(?,?,?,?,?,?,?,?,?,?);";
        $data = array('p_property_type_id' => $property_type_id, 'p_search_string' => $search_string, 'p_from_date' => $from_date, 'p_to_date ' => $to_date, 'p_adult_pax' => $adult_pax, 'p_child_pax' => $child_pax, 'p_district_id' => $property_district, 'p_hotel_types' => $hotel_types, 'p_facilities' => $facilities, 'p_rate_category_id' => $rate_category_id);
        $result = $this->db->query($stored_procedure, $data);
        if ($result !== NULL) {
            return $result;
        }
        return FALSE;
	}
}