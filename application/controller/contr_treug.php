<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
phpinfo();
$serverName = "192.168.5.211";
$connectionInfo = array( "Database"=>"stragdb", "UID"=>"program", "PWD"=>"Qaz12345");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {      
     echo "Соединение удалось.<br />";
}else{
     echo "Соединение не удалось, ошибка:";
    die( print_r( sqlsrv_errors(), true));
}






?>