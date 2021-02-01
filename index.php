<?php        
  // exit;
    session_start();
    //ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'ses_path/');           
    //ini_set('session.gc_maxlifetime', 120960);
    //ini_set('session.cookie_lifetime', 120960);
    date_default_timezone_set('Asia/Almaty');
    //echo date("d.m.Y H:i:s");
 
  //  ini_set('display_errors', 1);
    //ini_set('MAX_EXECUTION_TIME', 10000);
   // error_reporting(E_ALL);
   error_reporting(0);
    //error_reporting(E_NOTICE);
    ini_set('upload_max_filesize', '10M');
  //  echo '<center><br /><br /><h1>По техническим причинам <br />сервис временно не работает!</h1></center>';
  //  exit;
    require_once __DIR__."/vendor/autoload.php";
    require_once __DIR__.'/application/app.php';
