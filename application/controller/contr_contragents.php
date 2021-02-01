<?php    
    $page_title = 'Справочники';
    $panel_title = 'Контрагенты страховой задачи';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = '<a href="contragents">Контрагенты страховой задачи</a>';
    
    
    require_once 'methods/contragents.php';
    $contragents = new CONTRAGENT();
    $dan = $contragents->dan;
    
    array_push($js_loader, 
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js', 
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js', 
        'styles/js/plugins/select2/select2.full.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        
        'styles/js/demo/contragents.js');
        
    array_push($css_loader, 
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css', 
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css'
    );
            
    $colaps = '';
    $load_page = $contragents->load_page;
    /*
    $load_page = 'search';
    if(count($_GET) > 0){;
        foreach($_GET as $k=>$v);        
        $load_page = $k;
    }
    */
         
?>