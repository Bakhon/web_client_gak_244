<?php
	$title = 'Связи таблиц';    
    array_push($js_loader, 'styles/js/plugins/daterangepicker/daterangepicker.js','styles/js/plugins/datapicker/bootstrap-datepicker.js');
    array_push($css_loader, 'styles/css/plugins/datapicker/datepicker3.css', 'styles/css/plugins/daterangepicker/daterangepicker-bs3.css');
    
	require_once 'methods/table_links.php';    
    $links = new TABLE_LINKS();    
    $dan = $links->dan;
    