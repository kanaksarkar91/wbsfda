<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function signup($phoneno)
	{
        $error = '';
        $data = array();
        $ch = curl_init(); 
        $baseurl = 'https://2factor.in/API/R1/';
		
		$message = "Thank you for singing up. Please login to www.prdtourism.in  for booking and other details. -PRD Department";
        
        $postfields = 'module=TRANS_SMS&apikey=7724f759-3a60-11ed-9c12-0200cd936042&to=' . $phoneno . '&from=WBPNRD&msg=' . $message;
        curl_setopt($ch, CURLOPT_URL, $baseurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $data['error'] = $error;
        $data['response'] = json_decode($result);
        //echo "<pre>"; print_r($data);
        return $data;
    }
	
	function payment_confirmed($phoneno, $property_name, $bookingDates, $booking_no)
	{
		$data = array();
		$ch = curl_init(); 
		$baseurl = 'http://dndopen.jhaveritechno.com/api/v4/?api_key='.SMS_API_KEY.'';
		
		$message = "Sir/Madam,%20Your%20booking%20with%20S.F.D.C%20LTD.%20at%20%20".str_replace(' ', '%20', $property_name)."%20Complex,%20is%20Confirmed%20for%20dates%20".$bookingDates."%20vide%20booking%20no%20".$booking_no.".";
		
		$url = $baseurl.'&method=sms&message='.$message.'&to='.$phoneno.'&sender='.SMS_SENDER.'&entity_id='.SMS_ENTITY_ID.'&template_id=1207170210477641825';
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$error = 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$data['error'] = $error;
		$data['response'] = json_decode($result);
		//echo "<pre>"; print_r($data);
		//print_r(curl_getinfo($ch)); die;
		return $data;
    }
	
	function payment_cancelled($phoneno, $booking_no, $refundPer)
	{
        $data = array();
		$ch = curl_init(); 
		$baseurl = 'http://dndopen.jhaveritechno.com/api/v4/?api_key='.SMS_API_KEY.'';
		
		$message = "Sir/Madam%20Your%20cancellation%20application%20for%20booking%20number%20".$booking_no."%20has%20been%20accepted.%20".$refundPer."%20of%20the%20booking%20amount%20(excluding%20GST)%20will%20be%20refunded.%20Kindly%20refer%20email.%20Team%20S.F.D.C%20LTD.";
		
		$url = $baseurl.'&method=sms&message='.$message.'&to='.$phoneno.'&sender='.SMS_SENDER.'&entity_id='.SMS_ENTITY_ID.'&template_id=1207170210923547115';
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$error = 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$data['error'] = $error;
		$data['response'] = json_decode($result);
		//echo "<pre>"; print_r($data);
		//print_r(curl_getinfo($ch)); die;
		return $data;
    }
	
	function payment_cancelled_by_admin($phoneno, $booking_no)
	{
        $data = array();
		$ch = curl_init(); 
		$baseurl = 'http://dndopen.jhaveritechno.com/api/v4/?api_key='.SMS_API_KEY.'';
		
		$message = "Sir/Madam%20Owing%20to%20certain%20unavoidable%20reasons,%20your%20booking%20".$booking_no."%20has%20been%20canceled.%20The%20full%20booking%20amount%20would%20be%20refunded.%20We%20deeply%20regret%20the%20discomfort%20caused%20to%20you.%20Kindly%20refer%20email.%20Team%20S.F.D.C%20LTD.";
		
		$url = $baseurl.'&method=sms&message='.$message.'&to='.$phoneno.'&sender='.SMS_SENDER.'&entity_id='.SMS_ENTITY_ID.'&template_id=1207170210921146641';
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$error = 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$data['error'] = $error;
		$data['response'] = json_decode($result);
		//echo "<pre>"; print_r($data);
		//print_r(curl_getinfo($ch)); die;
		return $data;
    }
	
?>