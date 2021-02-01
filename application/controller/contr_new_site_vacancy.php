<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    

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
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
    );

    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css',
        'styles/css/animate.css'
    );
    
    if(isset($_POST['SLIDE_HEAD_KAZ']))
    {        
        print_r($_POST);
        $ITEM_NAME_RU = $_POST['SLIDE_HEAD_KAZ'];
        $ITEM_NAME_KAZ = $_POST['SLIDE_TEXT_KAZ'];
        $SLIDE_HEAD_RU = $_POST['SLIDE_HEAD_RU'];
        $SLIDE_TEXT_RU = $_POST['SLIDE_TEXT_RU'];
        $ITEM_NAME_ENG = $_POST['SLIDE_HEAD_ENG'];
        $SLIDE_TEXT_ENG = $_POST['SLIDE_TEXT_ENG'];
        $SLIDE_TEXT_KAZ = $_POST['SLIDE_TEXT_KAZ'];
        
        $emp_id = $_POST['emp_id'];  
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        
        $ps = array(
            'CONTENT_RU'=>$SLIDE_TEXT_RU,
            'CONTENT_KAZ'=>$SLIDE_TEXT_KAZ,            
            'CONTENT_ENG'=>$SLIDE_TEXT_ENG           
        );  
        
        
        $sql_to_slide = "INSERT INTO CORP_SITE_VACANCY (ID, ITEM_NAME_RU, CONTENT_RU, ITEM_NAME_KAZ, ITEM_NAME_ENG, CONTENT_KAZ, CONTENT_ENG)
                         VALUES (SEQ_CORP_SITE_VACANCY.nextval, '$ITEM_NAME_RU', EMPTY_CLOB(), '$ITEM_NAME_KAZ', '$ITEM_NAME_ENG', EMPTY_CLOB(), EMPTY_CLOB())
                         RETURNING CONTENT_RU, CONTENT_KAZ, CONTENT_ENG INTO :CONTENT_RU, :CONTENT_KAZ, :CONTENT_ENG";
                         
        echo $sql_to_slide;                 
                
        $t = $db->AddClob($sql_to_slide, $ps);
        
        //echo $sql_to_slide;
    }
    
    if(isset($_POST['ID_UPD']))
    {       
        
        $ID_UPD = $_POST['ID_UPD'];
        $SLIDE_HEAD_KAZ = str_replace("'", '"', $_POST['SLIDE_HEAD_KAZ_UPD']);
        $SLIDE_TEXT_KAZ = str_replace("'", '"', $_POST['SLIDE_TEXT_KAZ_UPD']);
        $SLIDE_HEAD_RU = str_replace("'", '"', $_POST['SLIDE_HEAD_RU_UPD']);
        $SLIDE_TEXT_RU = str_replace("'", '"', $_POST['SLIDE_TEXT_RU_UPD']);
        $SLIDE_HEAD_ENG = str_replace("'", '"', $_POST['SLIDE_HEAD_ENG_UPD']);
        $SLIDE_TEXT_ENG = str_replace("'", '"', $_POST['SLIDE_TEXT_ENG_UPD']);
        $BTN_TEXT_KAZ = $_POST['BTN_TEXT_KAZ_UPD'];
        $BTN_TEXT_RU = $_POST['BTN_TEXT_RU_UPD'];
        $BTN_TEXT_ENG = $_POST['BTN_TEXT_ENG_UPD'];
        $BTN_URL = $_POST['BTN_URL_UPD'];  
        $ORDER_ID = $_POST['ORDER_ID'];     
        $update_emp_id = $_POST['upd'];
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        
        $sql_to_slide = "UPDATE SITE_MAIN_SLIDER set SLIDE_HEAD_KAZ = '$SLIDE_HEAD_KAZ', SLIDE_TEXT_KAZ = '$SLIDE_TEXT_KAZ', SLIDE_HEAD_RU = '$SLIDE_HEAD_RU', SLIDE_TEXT_RU = '$SLIDE_TEXT_RU', SLIDE_HEAD_ENG = '$SLIDE_HEAD_ENG', SLIDE_TEXT_ENG = '$SLIDE_TEXT_ENG', BTN_TEXT_KAZ = '$BTN_TEXT_KAZ', BTN_TEXT_RU = '$BTN_TEXT_RU', BTN_TEXT_ENG = '$BTN_TEXT_ENG', BTN_URL_RU = '$BTN_URL', UPDATE_EMP_ID = '$update_emp_id', UPDATE_DATA = sysdate, UPDATE_TIME = '$now_time', ORDER_ID = '$ORDER_ID' WHERE ID = $ID_UPD";
       // echo $sql_to_slide;        
        $db->Execute($sql_to_slide);
 
        
        
                $db->Execute("
                insert into SITE_MAIN_SLIDER_ARC
                select * from SITE_MAIN_SLIDER where id = $ID_UPD
            ");
        
        
        
        header('site_panel');
    }
    
    if(isset($_POST['delete_slide']))
    {
        $delete_slide_id = $_POST['delete_slide'];
        $update_emp_id = $_POST['emp_update'];
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        
        $sql_to_slide_upd = "UPDATE SITE_MAIN_SLIDER set UPDATE_EMP_ID = '$update_emp_id', UPDATE_DATA = '$today_date', UPDATE_TIME = '$now_time' WHERE ID = $delete_slide_id";
       // echo $sql_to_slide_upd;
                        $db->Execute("
                insert into SITE_MAIN_SLIDER_ARC
                select * from SITE_MAIN_SLIDER where id = $delete_slide_id
            ");
        
        $sql_to_slide = "delete SITE_MAIN_SLIDER where ID = '$delete_slide_id'";
       // echo $sql_to_slide;
        $db->Execute($sql_to_slide);
    }
    
    //постоянные запросы
    $today_date = date('d.m.Y');
    $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 15, date('Y')));
    
    $sql_slider = "select * from CORP_SITE_VACANCY order by id";
    $list_slider = $db -> Select($sql_slider);
?>


