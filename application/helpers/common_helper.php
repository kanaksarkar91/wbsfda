<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function createBookingNo($type)
	{
        //$booking_no = $type.date('Ymd') . rand_string(6);
		$booking_no = $type.date('YmdHis') . mt_rand(100000, 999999);
        return $booking_no;
    }

	
?>