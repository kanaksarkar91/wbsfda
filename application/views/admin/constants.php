<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('ROLE_SUPERADMIN', 2);
define('ROLE_NODAL', 10);
define('EMAIL_FROM_NAME', 'WBSFDC');

define('RUN_DATE',date('Y-m-d'));
//define('RUN_DATE','2023-02-27');
define('BANK_RESPONSE_DATA_VALUE_COUNT', 16);

define('SMS_API_KEY','A9cc25445fbfc5771eeef47cdb08e2507');
define('SMS_SENDER','WBSFDC');
define('SMS_ENTITY_ID','1201170124747205609');

define('DB_PASS',base64_decode('Q18jV2J4SSQjcTBYQFVK'));
define('DB_USER',base64_decode('dTkyNjAyMTQzOF9XYnNmZGNsdEQ='));
define('DB_NAME',base64_decode('dTkyNjAyMTQzOF93YnNmZGNsdGQ='));


/*define('TEST_CCAVENUE_MERCHANT_DATA', '2825880');
define('TEST_CCAVENUE_WORKING_KEY', '8D998B20F6199C11B7F5039F930C104E');
define('TEST_CCAVENUE_ACCESS_CODE', 'AVAT09KI22AB88TABA');
define('TEST_CCAVENUE_BASE_URL', 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction');
define('TEST_CCAVENUE_API_BASE_URL', 'https://apitest.ccavenue.com/apis/servlet/DoWebTrans');*/


//define('STAGING_PAYTM_MID','test2P31646591591214');
//define('STAGING_PAYTM_MERCHANT_KEY','1hQr2VbJ2eI4k0@%');
define('STAGING_PAYTM_CHANNEL_ID','EDC');
define('STAGING_PAYTM_SALE_API_URL','https://securegw-stage.paytm.in/ecr/payment/request');
define('STAGING_PAYTM_STATUS_API_URL','https://securegw-stage.paytm.in/ecr/V2/payment/status');
define('STAGING_PAYTM_VOID_API_URL','https://securegw-stage.paytm.in/ecr/void');
define('PAYTM_PAYMENT_RESPONSE_WAITING_TIME', 330);
