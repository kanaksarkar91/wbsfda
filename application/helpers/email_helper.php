<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    function email_config(){
        
        $config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.hostinger.com',
			'smtp_port' => 587,
			'smtp_user' => 'helpdesk@wbsfdcltd.com', // change it to yours
			'smtp_pass' => '2ed<zWhVm!wD:>*$', // change it to yours
			'mailtype'  => 'html', 
			'charset'   => 'utf-8',
            'email_from'=> 'helpdesk@wbsfdcltd.com'
		  );

        return $config;

    }


    


?>