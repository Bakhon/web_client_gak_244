<?php
	$title = 'Метаданные для типовых форм';
    array_push($js_loader, 'styles/js/plugins/daterangepicker/daterangepicker.js','styles/js/plugins/datapicker/bootstrap-datepicker.js');
    array_push($css_loader, 'styles/css/plugins/datapicker/datepicker3.css', 'styles/css/plugins/daterangepicker/daterangepicker-bs3.css');
    
	require_once 'methods/meta.php';
    $meta = new META();
    $dan = $meta->dan;
    
    $othersJs = "<script>$('.input-group.date').datepicker({
        todayBtn: 'linked',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });</script>";