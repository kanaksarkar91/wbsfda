<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
    function getGstPercentage($amount = 0){
        $CI =& get_instance();
        $CI->db->select('hotel_gst_slab.*');
        $CI->db->from('hotel_gst_slab');
        $CI->db->where('hotel_gst_slab.startg_price <=', $amount);
		$CI->db->where('hotel_gst_slab.ending_price >=', $amount);
        $CI->db->where('hotel_gst_slab.is_active', 1);
        return $result=$CI->db->get()->row_array();
    }
	
	function getSafariGstPercentage($amount = 0){
        $CI =& get_instance();
        $CI->db->select('safari_gst_slab.*');
        $CI->db->from('safari_gst_slab');
        $CI->db->where('safari_gst_slab.startg_price <=', $amount);
		$CI->db->where('safari_gst_slab.ending_price >=', $amount);
        $CI->db->where('safari_gst_slab.is_active', 1);
        return $result=$CI->db->get()->row_array();
    }
