<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    $product_id = $_GET['product_id'];
     
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
    
    if(isset($_POST['doc_b64']))
    {
        $SLIDE_TEXT = $_POST['SLIDE_TEXT'];
        $SLIDE_SMALL_TEXT = $_POST['SLIDE_SMALL_TEXT'];
        $SLIDE_TEXT_KAZ = $_POST['SLIDE_TEXT_KAZ'];
        $SLIDE_SMALL_TEXT_KAZ = $_POST['SLIDE_SMALL_TEXT_KAZ'];
        $SLIDE_TEXT_ENG = $_POST['SLIDE_TEXT_ENG'];
        $SLIDE_SMALL_TEXT_ENG = $_POST['SLIDE_SMALL_TEXT_ENG'];
        $emp_id = $_POST['emp_id'];
        
        $p['IMG_BASE'] = $_POST['doc_b64']; 
        $sql_to_slide = "insert into SITE_PRODUCTS_SLIDER (ID, PRODUCT_ID, SLIDE_TEXT_RU, SLIDE_SMALL_TEXT_RU, SLIDE_TEXT_KAZ, SLIDE_SMALL_TEXT_KAZ, SLIDE_TEXT_ENG, SLIDE_SMALL_TEXT_ENG, IMG_BASE64, CREATE_DATE, EMP_ID) values (SEQ_SITE_PRODUCTS_SLIDER.nextval, $product_id, '$SLIDE_TEXT', '$SLIDE_SMALL_TEXT', '$SLIDE_TEXT_KAZ', '$SLIDE_SMALL_TEXT_KAZ', '$SLIDE_TEXT_ENG', '$SLIDE_SMALL_TEXT_ENG', EMPTY_CLOB(), sysdate, $emp_id)
                        RETURNING IMG_BASE64 INTO :IMG_BASE";
                
        $t = $db->AddClob($sql_to_slide, $p);
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['ID_UPD']))
    {
        $ID_UPD = $_POST['ID_UPD'];
        $SLIDE_SMALL_TEXT_UPD_RU = $_POST['SLIDE_SMALL_TEXT_UPD_RU'];
        $SLIDE_TEXT_RU = str_replace("'", '"', $_POST['SLIDE_TEXT_UPD_RU']);
        $SLIDE_SMALL_TEXT_UPD_KAZ = $_POST['SLIDE_SMALL_TEXT_UPD_KAZ'];
        $SLIDE_TEXT_KAZ = str_replace("'", '"', $_POST['SLIDE_TEXT_UPD_KAZ']);
        $SLIDE_SMALL_TEXT_UPD_ENG = $_POST['SLIDE_SMALL_TEXT_UPD_ENG'];
        $SLIDE_TEXT_ENG = str_replace("'", '"', $_POST['SLIDE_TEXT_UPD_ENG']);
        $emp_upd = $_POST['emp_upd'];
        $data = date('d.m.Y');
        $time = date('H:i:s');
        
        $sql_to_slide = "UPDATE SITE_PRODUCTS_SLIDER SET SLIDE_TEXT_RU = '$SLIDE_TEXT_RU', SLIDE_SMALL_TEXT_RU = '$SLIDE_SMALL_TEXT_UPD_RU', SLIDE_TEXT_KAZ = '$SLIDE_TEXT_KAZ', SLIDE_SMALL_TEXT_KAZ = '$SLIDE_SMALL_TEXT_UPD_KAZ', SLIDE_TEXT_ENG = '$SLIDE_TEXT_ENG', SLIDE_SMALL_TEXT_ENG = '$SLIDE_SMALL_TEXT_UPD_ENG', EMP_UPD = '$emp_upd', DATA_UPD = '$data', TIME_UPD = '$time' WHERE ID = $ID_UPD";
        $db->Execute($sql_to_slide);
        //echo $sql_to_slide;
        
        $db->Execute("
                insert into SITE_PRODUCTS_SLIDER_ARC
                select * from SITE_PRODUCTS_SLIDER where id = $ID_UPD
            ");
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['delete_slide'])){
        $delete_slide_id = $_POST['delete_slide'];
        
        $db->Execute("
                insert into SITE_PRODUCTS_SLIDER_ARC
                select * from SITE_PRODUCTS_SLIDER where id = $delete_slide_id
            ");
        
        $sql_to_slide = "delete SITE_PRODUCTS_SLIDER where ID = '$delete_slide_id'";
        $db->Execute($sql_to_slide);
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['ABOUT_PROD_RU']))
    {
        $ABOUT_PROD_RU = $_POST['ABOUT_PROD_RU'];
        $ABOUT_PROD_KAZ = $_POST['ABOUT_PROD_KAZ'];
        $ABOUT_PROD_ENG = $_POST['ABOUT_PROD_ENG'];
        $emp_id = $_POST['emp_id'];        
        $data = date('d.m.Y');
        $time = date('H:i:s');
        $sql_to_slide = "UPDATE SITE_PRODUCTS SET ABOUT_PROD_RU = '$ABOUT_PROD_RU', ABOUT_PROD_KAZ = '$ABOUT_PROD_KAZ', ABOUT_PROD_ENG = '$ABOUT_PROD_ENG', EMP_UPD = '$emp_id', DATE_UPD = '$data', TIME_UPD = '$time' WHERE ID = $product_id";
        $db->Execute($sql_to_slide);
        
         $db->Execute("
                insert into SITE_PRODUCTS_ARC
                select * from SITE_PRODUCTS where id = $product_id
            ");
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['ITEM_TITLE_RU'])){
        
        $ITEM_TITLE_RU = $_POST['ITEM_TITLE_RU'];
        $ITEM_TEXT_RU = $_POST['ITEM_TEXT_RU'];
        $ITEM_TITLE_KAZ = $_POST['ITEM_TITLE_KAZ'];
        $ITEM_TEXT_KAZ = $_POST['ITEM_TEXT_KAZ'];
        $ITEM_TITLE_ENG = $_POST['ITEM_TITLE_ENG'];
        $ITEM_TEXT_ENG = $_POST['ITEM_TEXT_ENG'];
        $emp_id = $_POST['emp_id'];
        
        $sql_to_condition = "INSERT INTO SITE_CONDITIONS (ID, PRODUCT_ID, ITEM_TITLE_RU, ITEM_TEXT_RU, ITEM_TITLE_KAZ, ITEM_TEXT_KAZ, ITEM_TITLE_ENG, ITEM_TEXT_ENG, EMP_ID, CREATE_DATA) VALUES (SEQ_SITE_CONDITIONS.NEXTVAL, $product_id, '$ITEM_TITLE_RU', '$ITEM_TEXT_RU', '$ITEM_TITLE_KAZ', '$ITEM_TEXT_KAZ', '$ITEM_TITLE_ENG', '$ITEM_TEXT_ENG', $emp_id, sysdate)";
        $db->Execute($sql_to_condition);
        //echo $sql_to_condition;
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['ITEM_TITLE_UPD_RU'])){
        $ID_UPD = $_POST['ID_UPD'];
        $ITEM_TITLE_UPD_RU = $_POST['ITEM_TITLE_UPD_RU'];
        $ITEM_TEXT_UPD_RU = $_POST['ITEM_TEXT_UPD_RU'];
        $ITEM_TITLE_UPD_KAZ = $_POST['ITEM_TITLE_UPD_KAZ'];
        $ITEM_TEXT_UPD_KAZ = $_POST['ITEM_TEXT_UPD_KAZ'];
        $ITEM_TITLE_UPD_ENG = $_POST['ITEM_TITLE_UPD_ENG'];
        $ITEM_TEXT_UPD_ENG = $_POST['ITEM_TEXT_UPD_ENG'];
        $emp_upd = $_POST['emp_upd'];
        $data = date('d.m.Y');
        $time = date('H:i:s');
        $sql_to_condition = "UPDATE SITE_CONDITIONS SET ITEM_TITLE_RU = '$ITEM_TITLE_UPD_RU', ITEM_TEXT_RU = '$ITEM_TEXT_UPD_RU', ITEM_TITLE_KAZ = '$ITEM_TITLE_UPD_KAZ', ITEM_TEXT_KAZ = '$ITEM_TEXT_UPD_KAZ', ITEM_TITLE_ENG = '$ITEM_TITLE_UPD_ENG', ITEM_TEXT_ENG = '$ITEM_TEXT_UPD_ENG', EMP_UPD = '$emp_upd', DATA_UPD = '$data', TIME_UPD = '$time' WHERE ID = $ID_UPD";
        $db->Execute($sql_to_condition);
        
        $db->Execute("
                insert into SITE_CONDITIONS_ARC
                select * from SITE_CONDITIONS where id = $ID_UPD
            ");
        
        header("site_products?product_id=$product_id");
    }
    
    if(isset($_POST['delete_condition'])){
        $delete_condition_id = $_POST['delete_condition'];
        
        $db->Execute("
                insert into SITE_CONDITIONS_ARC
                select * from SITE_CONDITIONS where id = $delete_condition_id
            ");
        
        $sql_to_slide = "delete SITE_CONDITIONS where ID = '$delete_condition_id'";
        $db->Execute($sql_to_slide);
        
        
        
        header("site_products?product_id=$product_id");
    }
    
    //постоянные запросы
    $today_date = date('d.m.Y');
    $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 15, date('Y')));
    
    $sql_prod = "select * from SITE_PRODUCTS where ID = $product_id order by id";
    $list_prod = $db -> Select($sql_prod);
    
    $sql_all_prod = "select * from SITE_PRODUCTS order by id";
    $list_all_prod = $db -> Select($sql_all_prod);
    
    $sql_prod_slider = "select * from SITE_PRODUCTS_SLIDER where PRODUCT_ID = $product_id order by id";
    $list_prod_slider = $db -> Select($sql_prod_slider);
    
    $sql_accord = "SELECT * FROM SITE_CONDITIONS WHERE PRODUCT_ID = '$product_id'";
    $list_accord = $db -> Select($sql_accord);  
?>

