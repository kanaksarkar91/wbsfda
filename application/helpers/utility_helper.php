<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



// --------------------------------------------------------------------

/**
 * Returns the global CI object
 *
 * @return 	object
 */
if (!function_exists('CI'))
{
	function CI() {
	    if (!function_exists('get_instance')) return FALSE;

	    $CI =& get_instance();
	    return $CI;
	}
}

if (!function_exists('daysBetween'))
{
	function daysBetween($dt1, $dt2) {
		return date_diff(
			date_create($dt2),  
			date_create($dt1)
		)->format('%a');
	}
}

if (!function_exists('get_period_from_date'))
{
	function get_period_from_date($date){
		$CI =& get_instance();
		$CI->load->model('mcommon');
		
		$splitDate = explode('-', $date);
		$monthDay = $splitDate[1].'-'.$splitDate[2];
		// Define today's date in mm-dd format
		$today = $date != '' ? $monthDay : date('m-d'); // Example: '10-17' for October 17th
		
		// Define service periods
		$periods = $CI->mcommon->getDetails('safari_service_period_master', ['is_active' => 1]);
		
		// Loop through each period to find the matching range
		foreach ($periods as $period) {
			$start_date = $period['start_date'];
			$end_date = $period['end_date'];
		
			// Check if the period includes today's date
			if (($start_date <= $today && $today <= $end_date) || ($start_date > $end_date && ($today >= $start_date || $today <= $end_date))) {
				return $period['service_period_master_id'];
				break;
			}
		}
	}
}

if (!function_exists('get_cancellation_percentage'))
{
	function get_cancellation_percentage($date){
		$CI =& get_instance();
		$CI->load->model('frontend/query');
		
		$booking_date=date_create($date);
		$current_date=date_create(date('Y-m-d'));
		//print_r($current_date);die;
		$diff_booking=date_diff($current_date,$booking_date);
		$diff_booking_date = $diff_booking->format("%R%a");
		//echo $diff_booking_date;die;
		$cancellation_details = $CI->query->getCancellationDetails($diff_booking_date);
		
		return $cancellation_details;
	}
}

if (!function_exists('get_cancellation_details'))
{
	function get_cancellation_details($booking_id = 0, $cancellation_details = [], $ticket_count = 0){
		$CI =& get_instance();
		$CI->load->model('mcommon');
		$response = [];
		
		$bookingData = $CI->mcommon->getRow('safari_booking_header', ['booking_id' => $booking_id]);
		
		if($ticket_count >= $bookingData['booking_time_visitor_count']){
			$basePrice = $bookingData['total_price'];
		}
		else{
			$basePrice = (($bookingData['total_price'] / $bookingData['booking_time_visitor_count']) * $ticket_count);
		}
		
		if (!empty($cancellation_details)) {
			$cancel_percent = $cancellation_details['cancellation_per'];
			$cancel_charge = intval((($basePrice * $cancellation_details['cancellation_per']) / 100) * 100) / 100;
			$refund_amt = $ticket_count >= $bookingData['booking_time_visitor_count'] ? intval(($basePrice - $cancel_charge) * 100) / 100 : intval(($basePrice - $cancel_charge) * 100) / 100;
		}
		
		$response['cancel_percent'] = $cancel_percent;
		$response['cancel_charge'] = $cancel_charge;
		$response['refund_amt'] = $refund_amt;
		
		return $response;
	}
}

// --------------------------------------------------------------------

/**
 * Capture content via an output buffer
 *
 * @param	boolean	turn on output buffering
 * @param	string	if set to 'all', will clear end the buffer and clean it
 * @return 	string	return buffered content
 */
if (!function_exists('capture'))
{
	function capture($on = TRUE, $clean = 'all')
	{
		$str = '';
		if ($on)
		{
			ob_start();
		}
		else
		{
			$str = ob_get_contents();
			if (!empty($str))
			{
				if ($clean == 'all')
				{
					ob_end_clean();
				}
				else if ($clean)
				{
					ob_clean();
				}
			}
			return $str;
		}
	}
}

// --------------------------------------------------------------------

/**
 * Format true value
 *
 * @param	mixed	possible true value
 * @return 	string	formatted true value
 */
if (!function_exists('is_true_val'))
{
	function is_true_val($val)
	{
		$val = strtolower($val);
		return ($val == 'y' || $val == 'yes' || $val === 1  || $val == '1' || $val== 'true' || $val == 't');
	}
}

// --------------------------------------------------------------------

/**
 * Boolean check to determine string content is serialized
 *
 * @param	mixed	possible serialized string
 * @return 	boolean
 */
if (!function_exists('is_serialized_str'))
{
	function is_serialized_str($data)
	{
		if ( !is_string($data))
			return false;
		$data = trim($data);
		if ( 'N;' == $data )
			return true;
		if ( !preg_match('/^([adObis]):/', $data, $badions))
			return false;
		switch ( $badions[1] ) :
		case 'a' :
		case 'O' :
		case 's' :
			if ( preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data))
				return true;
			break;
		case 'b' :
		case 'i' :
		case 'd' :
			if ( preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data))
				return true;
			break;
		endswitch;
		return false;
	}
}

// --------------------------------------------------------------------

/**
 * Boolean check to determine string content is a JSON object string
 *
 * @param	mixed	possible serialized string
 * @return 	boolean
 */
if (!function_exists('is_json_str'))
{
	function is_json_str($data)
	{
		if (is_string($data))
		{
			$json = json_decode($data, TRUE);
			return ($json !== NULL AND $data != $json);
		}
		return NULL;
	}
}

// --------------------------------------------------------------------

/**
 * Logs an error message to logs file
 *
 * @param	string	Error message
 * @return 	void
 */
if (!function_exists('log_error'))
{
	function log_error($error) 
	{
		log_message('error', $error);
	}
}

// --------------------------------------------------------------------

/**
 * Returns whether the current environment is set for development
 *
 * @return 	boolean
 */
if (!function_exists('is_dev_mode'))
{
	function is_dev_mode()
	{
		return (ENVIRONMENT != 'production');
	}
}

// --------------------------------------------------------------------

/**
 * Returns whether the current environment is equal to the passed environment
 *
 * @return 	boolean
 */
if (!function_exists('is_environment'))
{
	function is_environment($environment)
	{
		return (strtolower(ENVIRONMENT) == strtolower($environment));
	}
}

if (!function_exists('daysBetween'))
{
	function daysBetween($dt1, $dt2) {
		return date_diff(
			date_create($dt2),  
			date_create($dt1)
		)->format('%a');
	}
}

if (!function_exists('getFinancialYear'))
{
	function getFinancialYear($inputDate,$format="Y",$formatTo="y"){
		$date=date_create($inputDate);
		if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
			$financial_year = (date_format($date,$format)) . '-' . (date_format($date,$formatTo)+1);
		} else {//On or Before March (FY is previous year - current year)
			$financial_year = (date_format($date,$format)-1) . '-' . date_format($date,$formatTo);
		}
	
		return $financial_year;
	} 
}

if (!function_exists('getFinancialStartYear'))
{
	function getFinancialStartYear($date) {
		$dateObj = new DateTime($date);
		$month = $dateObj->format('m');
		$year = $dateObj->format('y');
	
		if ($month >= 4) {
			$startYear = $year;
			$endYear = $year + 1;
		} else {
			$startYear = $year - 1;
			$endYear = $year;
		}
	
		return $startYear;
	}
}

if (!function_exists('date_range'))
{
	function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {
	
		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
	
		while( $current <= $last ) {
	
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
	
		return $dates;
	}
}

if (!function_exists('json_headers'))
{
	function json_headers($no_cache = TRUE)
	{
		if ($no_cache)
		{
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		}
		header('Content-type: application/json');
	}
}

if(!function_exists('char_separated')){

	function char_separated($array,$char=','){
		$char_separated = implode($char, $array);
		return $char_separated;
	}
}


if(!function_exists('char_separated_to_array')){

	function char_separated_to_array($string,$char=','){
		$char_separated_to_array = explode($char, $string);
		return $char_separated_to_array;
	}
}

if(!function_exists('ordinal')){
	function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
	}
}
	
if(!function_exists('uniqidReal')){
	function uniqidReal($lenght = 13) {
	    // uniqid gives 13 chars, but you could adjust it to your needs.
	    if (function_exists("random_bytes")) {
	        $bytes = random_bytes(ceil($lenght / 2));
	    } elseif (function_exists("openssl_random_pseudo_bytes")) {
	        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
	    } else {
	        throw new Exception("no cryptographically secure random function available");
	    }
	    return substr(bin2hex($bytes), 0, $lenght);
	}
}


if(!function_exists('post_data')){
	function post_data($post_var){
		return remove_invisible_characters(xss_clean(strip_javascript(strip_whitespace(encode_php_tags(CI()->input->post($post_var))))));
	}
}

if(!function_exists('get_data')){
	function get_data($get_var){
		return remove_invisible_characters(xss_clean(strip_javascript(strip_whitespace(encode_php_tags(CI()->input->get($post_var))))));
	}
}

if(!function_exists('clean_data')){
	function clean_data($data){
		return html_escape($data);
	}
}



function _user_agent()
{
	if( CI()->ua->is_browser() ){
		$agent = CI()->ua->browser() . ' ' . CI()->ua->version();
	}else if( CI()->ua->is_robot() ){
		$agent = CI()->ua->robot();
	}else if( CI()->ua->is_mobile() ){
		$agent = CI()->ua->mobile();
	}else{
		$agent = 'Unidentified User Agent';
	}

	$platform = CI()->ua->platform();

	return $platform 
		? $agent . ' on ' . $platform 
		: $agent; 
}

//------------------------------------------------------------------

/*=================================================================
=            			EMAIL HELPER           	 				=
=================================================================*/

if( ! function_exists('sendmail')){


	function sendmail($mail_data=array(),$mail_type='html'){

		CI()->load->library('email');

		CI()->email->from($mail_data['from'], $mail_data['from_name']);
		CI()->email->to($mail_data['to']);

		if(isset($mail_data['cc'])){
			CI()->email->cc($mail_data['cc']);
		}

		if(isset($mail_data['bcc'])){
			CI()->email->bcc($mail_data['bcc']);
		}

		CI()->email->subject($mail_data['subject']);

		if(isset($mail_data['has_attachment']) && $mail_data['has_attachment']==FALSE){
			CI()->email->attach($mail_data['attachment']);
		}

		if($mail_type=='text'){	
			$message=$mail_data['data'];
		}else if($mail_type=='html'){
			//$message=CI()->load->view($mail_data['view'],$mail_data['data']);
			$message=CI()->theme->view($mail_data['view'],$mail_data['data'],true);
		}

		CI()->email->message($message);

		if(!CI()->email->send()){
			CI()->email->print_debugger(array('headers'));
		}
	}
}



/*=================================================================
=            			ASSETS COMMON           	 				=
=================================================================*/


if( ! function_exists('assets_url')){

	function assets_url(){
		return base_url().'common/assets/';
	}
}

if(!function_exists('delete_files')){

	function delete_files($target) {
	    if(is_dir($target)){
	        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

	        foreach( $files as $file ){
	            delete_files( $file );      
	        }
	        if(isset($target) && is_dir($target)){
	        	rmdir( $target );
	        }
	       
	    } elseif(is_file($target)) {
	        unlink( $target );  
	    }
	}	
}

if(!function_exists('isHomogenous')){

	function isHomogenous($arr) {
	    $firstValue = current($arr);
	    foreach ($arr as $val) {
	        if ($firstValue !== $val) {
	            return false;
	        }
	    }
	    return true;
	}


	// function isHomogenous(array $arr, $testValue = null) {
	//     // If they did not pass the 2nd func argument, then we will use an arbitrary value in the $arr.
	//     // By using func_num_args() to test for this, we can properly support testing for an array filled with nulls, if desired.
	//     // ie isHomogenous([null, null], null) === true
	//     $testValue = func_num_args() > 1 ? $testValue : current($arr);
	//     foreach ($arr as $val) {
	//         if ($testValue !== $val) {
	//             return false;
	//         }
	//     }
	//     return true;
	// }

}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

if(!function_exists('addtoString')){
	function addtoString($str, $item) {
	    $parts = explode(',', $str);
	    $parts[] = $item;

	    return implode(',', $parts);
	}
}


if(!function_exists('removeFromString')){
	function removeFromString($str, $item) {
	    $parts = explode(',', $str);

	    while(($i = array_search($item, $parts)) !== false) {
	        unset($parts[$i]);
	    }

	    return implode(',', $parts);
	}
}

if(!function_exists('removeDuplicate')){
	function removeDuplicate($dep) {
	    return implode(',', array_keys(array_flip(explode(',', $dep))));
	}	
}
function encode_url($string, $key="", $url_safe=TRUE)
{
    if($key==null || $key=="")
    {
        $key="tyz_mydefaulturlencryption";
    }

    $CI =& get_instance();
    
    if (version_compare(PHP_VERSION, '5.7', '>=')){
    	$ret = $CI->encryption->encrypt($string);
    }else{
    	$ret = $CI->encrypt->encode($string, $key);
    }
    

    if ($url_safe)
    {
        $ret = strtr(
                $ret,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
    }

    return $ret;
}
function decode_url($string, $key="")
{
     if($key==null || $key=="")
    {
        $key="tyz_mydefaulturlencryption";
    }
        $CI =& get_instance();
    	$string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );

        if (version_compare(PHP_VERSION, '5.7', '>=')){
	    	return $CI->encryption->decrypt($string);
	    }else{
	    	return $CI->encrypt->decode($string, $key);
	    }

    
}


function build_short($str){

	

	$words=array('a','an','the','of','for','to','from','in','at','on','by','or');




}

function advanced_replace($searchStart, $searchEnd, $replace, $subject, &$assignValue = array(), $addValue = false, $inReplace = false, $valueKey = "") {
    $strlen = strlen( $subject );
    $open = 0;
    $ob = false;
    $ob_message = "";
    $message = "";
    for( $i = 0; $i <= $strlen; $i++ ) {
        $char = substr( $subject, $i, 1 );

        if ($char == $searchStart) {
            $open++;
            $ob = true;
        }
        if ($ob) {
            $ob_message .= $char;
        } else {
            $message .= $char;
        }
        if ($char == $searchEnd) {
            $open--;
            if ($open == 0) {
                $ob = false;
                $message .= ($replace.($addValue!== false && $inReplace?$addValue:""));
                $assignValue[$valueKey.($addValue!== false?$addValue:"")] = $ob_message;
                $ob_message = "";
                if ($addValue !== false) $addValue++;
            }
        }
    }
    return $message; 
}

if(!function_exists('remove_special_character')){
	function remove_special_character($string) {
	 
	    $t = $string;
	 
	    $specChars = array(
	        ' ' => '-',    '!' => '',    '"' => '',
	        '#' => '',    '$' => '',    '%' => '',
	        '&amp;' => '',    '\'' => '',   '(' => '',
	        ')' => '',    '*' => '',    '+' => '',
	        ',' => '',    '₹' => '',    '.' => '',
	        '/-' => '',    ':' => '',    ';' => '',
	        '<' => '',    '=' => '',    '>' => '',
	        '?' => '',    '@' => '',    '[' => '',
	        '\\' => '',   ']' => '',    '^' => '',
	        '_' => '',    '`' => '',    '{' => '',
	        '|' => '',    '}' => '',    '~' => '',
	        '-----' => '-',    '----' => '-',    '---' => '-',
	        '/' => '',    '--' => '-',   '/_' => '-',   
	         
	    );
	 
	    foreach ($specChars as $k => $v) {
	        $t = str_replace($k, $v, $t);
	    }
	 
	    return $t;
	}
}



if(!function_exists('get_avatar')){
    function get_avatar($str){
        $acronym;
        $word;
        $words = preg_split("/(\s|\-|\.)/", $str);

        if(count($words)>1){
        	foreach($words as $w) {
	            $acronym .= substr($w,0,1);
	        }
	        $word = $word . $acronym ;
        }else{	        
        	$acronym .=substr($words[0],0,3);
        	$word = $word . $acronym ;
        }

        return $word;
    }
}


function acronym($s,$no){
	$pattern = '~(?:(\()|(\[)|(\{))(?(1)(?>[^()]++|(?R))*\))(?(2)(?>[^][]++|(?R))*\])(?(3)(?>[^{}]++|(?R))*\})~';
	$new_string=trim(strtolower(preg_replace($pattern , '', $s)));
	$exploded=explode(' ', $new_string);
	$ignore=array('aboard','about','above','across','after','against','along','amid','among','anti','around','as','at','before','behind','below','beneath','beside','besides','between','beyond','but','by','concerning','considering','despite','down','during','except','excepting','excluding','following','for','from','in','inside','into','like','minus','near','of','off','on','onto','opposite','outside','over','past','per','plus','regarding','round','save','since','than','through','to','toward','towards','under','underneath','unlike','until','up','upon','versus','via','with','within','without','and','but','or','also');
	$array = array_diff($exploded, $ignore);
	$new_string=implode(' ',$array);

	$new_string2=(get_avatar(strtoupper($new_string))).'-'.str_pad($no,4, 0, STR_PAD_LEFT);

	return $new_string2;
}



function SKU_gen($string, $id = null, $l = 2){
    $results = ''; // empty string
    $vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
    preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
    foreach($m[0] as $substring){
        $substring = str_replace($vowels, '', strtolower($substring)); // String to lower case and remove all vowels
        $results .= preg_replace('/([a-z]{'.$l.'})(.*)/', '$1', $substring); // Extract the first N letters.
    }
    $results .= '-'. str_pad($id, 4, 0, STR_PAD_LEFT); // Add the ID
    return $results;
}

function number_format_short( $n, $precision = 1 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}
  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}
	return $n_format . $suffix;
}

function number_format_short2( $n ) {
	if ($n > 0 && $n < 1000) {
		// 1 - 999
		$n_format = floor($n);
		$suffix = '';
	} else if ($n >= 1000 && $n < 1000000) {
		// 1k-999k
		$n_format = floor($n / 1000);
		$suffix = 'K+';
	} else if ($n >= 1000000 && $n < 1000000000) {
		// 1m-999m
		$n_format = floor($n / 1000000);
		$suffix = 'M+';
	} else if ($n >= 1000000000 && $n < 1000000000000) {
		// 1b-999b
		$n_format = floor($n / 1000000000);
		$suffix = 'B+';
	} else if ($n >= 1000000000000) {
		// 1t+
		$n_format = floor($n / 1000000000000);
		$suffix = 'T+';
	}

	return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
}


	

function alphaID($in, $to_num = false, $pad_up = false, $pass_key = null)
{
	$out   =   '';
	$index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$base  = strlen($index);

	if ($pass_key !== null) {
		// Although this function's purpose is to just make the
		// ID short - and not so much secure,
		// with this patch by Simon Franz (http://blog.snaky.org/)
		// you can optionally supply a password to make it harder
		// to calculate the corresponding numeric ID

		for ($n = 0; $n < strlen($index); $n++) {
			$i[] = substr($index, $n, 1);
		}

		$pass_hash = hash('sha256',$pass_key);
		$pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

		for ($n = 0; $n < strlen($index); $n++) {
			$p[] =  substr($pass_hash, $n, 1);
		}

		array_multisort($p, SORT_DESC, $i);
		$index = implode($i);
	}

	if ($to_num) {
		// Digital number  <<--  alphabet letter code
		$len = strlen($in) - 1;

		for ($t = $len; $t >= 0; $t--) {
			$bcp = bcpow($base, $len - $t);
			$out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
		}

		if (is_numeric($pad_up)) {
			$pad_up--;

			if ($pad_up > 0) {
				$out -= pow($base, $pad_up);
			}
		}
	} else {
		// Digital number  -->>  alphabet letter code
		if (is_numeric($pad_up)) {
			$pad_up--;

			if ($pad_up > 0) {
				$in += pow($base, $pad_up);
			}
		}

		for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
			$bcp = bcpow($base, $t);
			$a   = floor($in / $bcp) % $base;
			$out = $out . substr($index, $a, 1);
			$in  = $in - ($a * $bcp);
		}
	}

	return $out;
}



if(!function_exists('menu_active')){

	function menu_active(){

		$routes=CI()->uri->uri_string();

		if($routes=='candidates/create' || $routes=='candidates'){
			$a='if';
		}else{
			$a='else';
		}

		return $a;
	}
}


if(!function_exists('get_percentage')){

	function get_percentage($m,$v){
		return (($m*$v)/100);
	}
}

if(!function_exists('shuffle_assoc')){
	function shuffle_assoc($my_array)
	{
	    $keys = array_keys($my_array);

	    shuffle($keys);

	    foreach($keys as $key) {
	        $new[$key] = $my_array[$key];
	    }

	    $my_array = $new;

	    return $my_array;
	}
}



if(!function_exists('calculate_age')){
	function calculate_age($birthDate){
		$now = time();
		$dob = strtotime($birthDate);
		$difference = $now - $dob;
		$age = floor($difference / 31556926);
		return $age;
	}
}



function check($number){ 
    if($number % 2 == 0){ 
        return "Even";  
    } 
    else{ 
        return "Odd"; 
    } 
}

//indian number format---------------------------------------------------

function IND_money_format($number){        
    $decimal = (string)($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for($i=0;$i<$length;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
            $delimiter .=',';
        }
        $delimiter .=$money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);

    if( $decimal != '0'){
        $result = $result.$decimal;
    }

    return $result;
}

if(!function_exists('formatIndianCurrency')){
	function formatIndianCurrency($amount) {
		// Ensure the number always has two decimal places
   		 $amount = number_format($amount, 2, '.', '');
		
		// Convert the number to a string and check if it has a decimal point
		$parts = explode('.', $amount);
		
		// Format the part before the decimal
		$integerPart = $parts[0];
		$decimalPart = isset($parts[1]) ? '.' . $parts[1] : '';
		
		// If the integer part is less than 1000, return it as is (no comma needed)
		if ($integerPart < 1000) {
			return $integerPart . $decimalPart;
		}
		
		// Apply comma to the first three digits and then after every two digits
		$lastThree = substr($integerPart, -3);
		$remaining = substr($integerPart, 0, -3);
		
		// Format the remaining part with commas every two digits
		if ($remaining != '') {
			$remaining = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $remaining);
		}
		
		// Combine the formatted remaining part with the last three digits
		$formatted = $remaining . ',' . $lastThree;
		
		return '₹' . $formatted . $decimalPart;
	
	}
}


//no to word--------------------------------------------------------------------------------------------
function no_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
    if($no == 0)
        return ' ';
    else {
	$novalue='';
	$highno=$no;
	$remainno=0;
	$value=100;
	$value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
           }
    }
}


function getIndianCurrencyNumberToWord(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? ucwords($Rupees) . 'Rupees Only' : '') . $paise;


}



function countChar($str, $x)  
{  
    $count = 0;  
    $n = 10; 
    for ($i = 0; $i < strlen($str); $i++)  
        if ($str[$i] == $x)  
            $count++;  
  
    // atleast k repetition are required  
    $repititions = (int)($n / strlen($str));  
    $count = $count * $repititions;  
  
    // if n is not the multiple of  
    // the string size check for the  
    // remaining repeating character.  
    for ($i = 0; $i < $n % strlen($str); $i++)  
    {  
        if ($str[$i] == $x)  
            $count++;  
    }  
  
    return $count;  
}

function countt($s, $c) 
{ 
      
    // Count variable 
    $res = 0; 
  
    for ($i = 0; $i < strlen($s); $i++) 
  
        // checking character in string 
        if ($s[$i] == $c) 
            $res++; 
  
    return $res; 
}

if(!function_exists('get_domain')){
	function get_domain(){
		$server_data=CI()->input->server(array('SERVER_PROTOCOL','REQUEST_URI','REQUEST_SCHEME','SERVER_NAME'));
		$domain=$server_data['REQUEST_SCHEME'].'://'.$server_data['SERVER_NAME'].'/';
		return $domain;
	}
}
	




function get_ipgeo_data(){
	$user_ip = CI()->input->ip_address();
	$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
	return $geo;



	// $json     = file_get_contents("http://ipinfo.io/$user_ip/geo");
	// $json     = json_decode($json, true);

	// return $json;
}


function get_ip_detail($ip){
   $ip_response = file_get_contents('http://ip-api.com/json/'.$ip);
   $ip_array=json_decode($ip_response);
   return  $ip_array;
}

function grabIpInfo($ip)
{

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, "https://api.ipgeolocationapi.com/geolocate/" . $ip);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  $returnData = curl_exec($curl);

  curl_close($curl);

  return $returnData;

}


function getEncodedVideoString($type, $file) {
   return 'data:video/' . $type . ';base64,' . base64_encode(file_get_contents($file));
}


function getYouTubeVideoID($url) {
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    if (isset($params['v']) && strlen($params['v']) > 0) {
        return $params['v'];
    } else {
        return "";
    }
}
	


function sendGCM($message, $id) {


    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
                'registration_ids' => array (
                    $id
                ),
                'data' => array (
                    "title"=>'माय नाम इस wwe',
                    "body"=>'माय नाम इस 122',
                    "Room"=>"PortugalVSDenmark"
                )
            );
    $fields = json_encode ( $fields );

    $headers = array (
        'Authorization: key=' . "AIzaSyAQXBA6NPNNNOA49DX44mwgisR9icbwKuE",
        'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
   // echo $result;
    curl_close ( $ch );
}


if(!function_exists('get_total_month')){
	function get_total_month($date1, $date2)
	{
		$begin = new DateTime( $date1 );
		$end = new DateTime( $date2 );
		$end = $end->modify( '+1 month' );
	
		$interval = DateInterval::createFromDateString('1 month');
	
		$period = new DatePeriod($begin, $interval, $end);
		$counter = 0;
		foreach($period as $dt) {
			$counter++;
		}
	
		return $counter;
	}
}


function calculateFiscalYearForDate($month)
{
	if($month > 4)
	{
		$y = date('Y');
		$pt = date('Y', strtotime('+1 year'));
		$fy = $y."-04-01".":".$pt."-03-31";
	}
	else
	{
		$y = date('Y', strtotime('-1 year'));
		$pt = date('Y');
		$fy = $y."-04-01".":".$pt."-03-31";
	}
	return $fy;
}


function random_strings($length_of_string)
{
 
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}



/* End of file utility_helper.php */
/* Location: ./helpers/utility_helper.php */
