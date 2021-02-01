<?php
	$page = 'index';
    
    if(count($_GET) > 0){
        $page = 'edit';    
    }
    require_once VIEWS."typical_forms/$page.php";
?>