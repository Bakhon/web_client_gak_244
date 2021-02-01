<?php
    if(count($_POST) <= 0){        
        exit;
    }

    require_once '/methods/xmpp.php';
    
    $j = new JABBER();        
    $msg = $_POST['message'];
    $j->send_message(trim($_POST['user']), $msg);    
    
    //echo 'Sending...';
    //print_r($_POST);    
	exit;
?>