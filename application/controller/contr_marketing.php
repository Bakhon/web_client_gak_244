<?php
	$page_title = 'Маркетинг';
    $panel_title = '';
    
    $breadwin[] = 'Маркетинг';
    require_once 'methods/marketing.php';    
    $method = new MARKETING();    
    $dan = $method->dan;
?>