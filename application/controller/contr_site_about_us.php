<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    
    $item_id = 1;
    if(isset($_GET['item_id'])){
        $item_id = $_GET['item_id'];
    }
    $item_lang = 'KAZ';
    if(isset($_GET['lang'])){
        $item_lang = $_GET['lang'];
    }
    
    //загрузка документа
    $ftp_site = new FTP(FTP_SITE_SERVER, FTP_SITE_USER, FTP_SITE_PASS);
    
    array_push($js_loader,
        'styles/js/inspinia.js',  
        'styles/js/plugins/pace/pace.min.js', 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',     
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js'
        );   

    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/animate.css'
    );
    
    if(isset($_POST['content'])){
        $p['CONTENT'] = $_POST['content'];
        $item_name = $_POST['ITEM_NAME'];
        $sql_to_slide = "UPDATE SITE_ABOUT_US_MENU SET ITEM_NAME_$item_lang = '$item_name', CONTENT_$item_lang = EMPTY_CLOB() WHERE ID = $item_id
                        RETURNING CONTENT_$item_lang INTO :CONTENT";
                
        $t = $db->AddClob($sql_to_slide, $p);
        //echo $sql_to_slide;
    }
    
    //постоянные запросы
    $today_date = date('d.m.Y');
    
    $sql_about_us = "select * from SITE_ABOUT_US_MENU order by ID";
    $list_about_us = $db -> Select($sql_about_us);
    
    $sql_item = "select ITEM_NAME_$item_lang, CONTENT_$item_lang from SITE_ABOUT_US_MENU where ID = $item_id";
    $list_item = $db -> Select($sql_item);
?>

