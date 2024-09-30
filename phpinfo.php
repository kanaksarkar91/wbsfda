<?php
//echo "OS User:".exec('whoami');
echo $_SERVER['SERVER_NAME']."<br>";

$urls = explode("/",$_SERVER['REQUEST_URI']);
$http_host=$_SERVER['SERVER_NAME']."/".$urls[1];
echo "HOST path=".$http_host."<br>";

$urls = explode("/",$_SERVER['REQUEST_URI']);
$http_host=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/" ;
echo "Host name=".$http_host."<br>";


if (trim($_SERVER['SERVER_NAME']) == 'sportlogin.ch'){
  $p_base_code="teamvg";  
} else {
	$p_base_code="teamvg";
}
echo $p_base_code."<br>";
$tz = new DateTimeZone("Asia/Kolkata");
print_r($tz->getLocation());
print_r(timezone_location_get($tz));

    echo date_default_timezone_get();
    echo "Default The time is " . date("Y-m-d h:i:sa");
    
  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  //$today = date("Y-m-d h:i:sa");
  //echo "The time is " . $today ;
  
  echo date_default_timezone_get();
  phpinfo();

$indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;

echo '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
    }
    else {
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
    }
}
echo '</table>' ; 
?>