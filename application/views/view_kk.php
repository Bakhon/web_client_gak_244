<?php
    echo $kk->msg;    
	foreach($_GET as $k=>$v){
        if(file_exists(__DIR__."/kk/$k.php")){
            require_once __DIR__."/kk/$k.php";        
        }
    }
?>