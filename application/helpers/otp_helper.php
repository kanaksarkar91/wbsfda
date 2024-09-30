<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/*function sendsms($otp,$phoneno){
        $error = '';
        $data = array();
        $ch = curl_init(); 
        $baseurl = 'http://dndopen.jhaveritechno.com/api/v4/?api_key=Acbb9b01166125066737f7170c4f573d3';
        $message = "OTP for Login Transaction on SYSCENTRIC is ".$otp.". Do not share this OTP to anyone for security reasons.";
        $url = $baseurl.'&method=sms&message='.$message.'&to='.$phoneno.'&sender=SYSCNT&entity_id=1301163999688234159&template_id=1507165971342532874';
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
        return $data;
    }

	function generateotp($phone){
        $data = array();
        $otp = random_int(100000, 999999);
        $data= sendsms($otp,$phone);
        $data['otp'] = $otp;
        return $data;
    }*/
	
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);
	}
	
	function generateotp($phone, $type)
	{
        $data = array();
        $otp = rand_string(6);
        $data= sendsms($otp, $phone, $type);
        $data['otp'] = $otp;
        return $data;
    }

	function sendsms($otp, $phoneno, $type)
	{
        $error = '';
        $data = array();
        $ch = curl_init(); 
        $baseurl = 'http://dndopen.jhaveritechno.com/api/v4/?api_key='.SMS_API_KEY.'';
		
		$message = '';
		
		switch ($type) {
			case 'login':
				$message = "OTP%20for%20Login%20Transaction%20on%20S.F.D.C%20LTD.%20is%20".$otp.".%20Do%20not%20share%20this%20OTP%20to%20anyone%20for%20security%20reasons.";
				$template_id = "1207170210524565160";
				break;
				
			case 'register':
				$message = "OTP%20for%20Registration%20on%20S.F.D.C%20LTD%20is%20".$otp.".%20Do%20not%20share%20this%20OTP%20to%20anyone%20for%20security%20reasons.WBSFDCLTD";
				$template_id = "1207170210271176051";
				break;
				
			default:
				$message = "";
				$template_id = "";
				break;
		}
        
        $url = $baseurl.'&method=sms&message='.$message.'&to='.$phoneno.'&sender='.SMS_SENDER.'&entity_id='.SMS_ENTITY_ID.'&template_id='.$template_id.'';
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
		//echo $error; die;
		return $data;
    }
?>