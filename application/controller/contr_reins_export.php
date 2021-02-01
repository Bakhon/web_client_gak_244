<?php
	$title = 'Перестрахование - Действия';

    require_once 'methods/reins_export.php';
    $_this = new REINS_EXPORT();
    
    array_push($js_loader, 'styles/js/plugins/daterangepicker/daterangepicker.js','styles/js/plugins/datapicker/bootstrap-datepicker.js');
    array_push($css_loader, 'styles/css/plugins/datapicker/datepicker3.css', 'styles/css/plugins/daterangepicker/daterangepicker-bs3.css');
                
    $othersJs = "<script>$('.input-group.date').datepicker({
        todayBtn: 'linked',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });</script>";
?>