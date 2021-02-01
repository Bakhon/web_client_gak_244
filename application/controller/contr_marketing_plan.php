<?php
	/**
     * Controller     
     * */
          
    $page_title = 'Маркетинг';
    $panel_title = 'Планы по прадажам';
        
    $breadwin[] = 'Маркетинг';
    $breadwin[] = 'Планы по прадажам';
    $breadwin[] = '<a href="marketing_edit_plan"><i class="fa fa-edit"></i> Редактирование плана</a>';
    
    require_once 'methods/marketing_plan.php';
    $method = new MARKET_PLAN();
    $dan = $method->dan;
    array_push($js_loader, 'styles/js/demo/marketing_plan.js');                
?>