<?php
	$page_title = 'АРМ';
    $panel_title = 'Страховой надзор';
    
    $breadwin[] = 'Автоматизация рабочего места';
    $breadwin[] = '<a href="arm">Страховой надзор</a>'; 
    
    array_push($js_loader, 'styles/js/plugins/daterangepicker/daterangepicker.js','styles/js/plugins/datapicker/bootstrap-datepicker.js');
    array_push($css_loader, 'styles/css/plugins/datapicker/datepicker3.css', 'styles/css/plugins/daterangepicker/daterangepicker-bs3.css');
    $othersJs = "<script>$('.input-group.date').datepicker({
        todayBtn: 'linked',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });</script>";
    
    require_once 'methods/arm.php';
    
    $arm = new ARM();
    $dan = $arm->dan;