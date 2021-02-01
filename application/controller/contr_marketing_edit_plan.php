<?php
	$page_title = 'Маркетинг';
    $panel_title = '';
    
    $breadwin[] = 'Маркетинг';
    $breadwin[] = 'Редактирование плана';
    
    require_once 'methods/marketing_edit_plan.php';    
    $method = new MARKETING_EDIT_PLAN();    
    $dan = $method->dan;
?>