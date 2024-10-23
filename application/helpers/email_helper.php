<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    function email_config(){
        
        $config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.hostinger.com',
			'smtp_port' => 587,
			'smtp_user' => 'easy.ticketing@devserv.in', // change it to yours
			'smtp_pass' => 'B}jjm,hJ29m4ewa?tk>g', // change it to yours
			'mailtype'  => 'html', 
			'charset'   => 'utf-8',
			'email_from'=> 'easy.ticketing@devserv.in'
		  );

        return $config;

    }


    


?>