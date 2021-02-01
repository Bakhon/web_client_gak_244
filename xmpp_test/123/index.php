<?php
	require_once 'class_Jabber.php';
    
    $jabber = new Jabber();
    $jabber->_username = 'a.saleev';
    $jabber->_password = 'Cfkttd83';
    $jabber->_server_ip = '192.168.5.204';
    $jabber->_server_port = '5222';
    $jabber->_connect_timeout = 15;
    
    $con = $jabber->connect('192.168.5.204', 5222, null, true);
    var_dump($con);
    
    //$con = $jabber->_connect_socket();
    //var_dump($con);  
?>