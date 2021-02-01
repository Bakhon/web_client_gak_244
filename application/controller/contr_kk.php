<?php
    $title = 'Комплаенс контролер';
    require_once 'methods/kk.php';
    $kk = new KK();
    
    array_push($js_loader, 
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/metisMenu/jquery.metisMenu.js'
    );
        
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css'        
    );        
        
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