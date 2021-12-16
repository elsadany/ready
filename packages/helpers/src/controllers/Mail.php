<?php

namespace ElsayedNofal\Helpers\controllers;

class Mail {

    static function send($from,$to,$subject,$message,$replay_to=''){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	    $headers .= 'From: '.$from . "\r\n";
	    //$headers .= 'Bcc: sayed.nofal@media-sci.com' . "\r\n";
        if($replay_to!=''){
            $headers.='Reply-To: '.$replay_to. "\r\n" ;
        }
	    $headers.='X-Mailer: PHP/' . phpversion();
        
        $mail=  mail($to, $subject, $message, $headers);
        if($mail){
            return TRUE;
        }
        return FALSE;
    }

}