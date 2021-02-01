<?php
    echo $bordero->msg;
    foreach($_GET as $k=>$v);        
    if(file_exists("application/views/reins_bordero/$k.php")){
        require_once "application/views/reins_bordero/$k.php";        
    }else{
        require_once "application/views/reins_bordero/index.php";
    }
    
?>