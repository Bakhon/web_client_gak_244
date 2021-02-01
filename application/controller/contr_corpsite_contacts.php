<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    $product_id = $_GET['contact_id'];
    
    if($product_id == '')
    {
    $sql_prod = "select * from INSURANCE2.dic_branch2 where RFBN_ID = $product_id";
    $list_prod = $db -> Select($sql_prod);            
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
    
    
 /*   if(isset($_POST['ITEM_TITLE_RU'])){
        
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
    } */
    
    if(isset($_POST['NAME_RU'])){
        $id_upd = $_POST['id_upd'];
        $NAME = $_POST['NAME_RU'];
        $NAME_KZ = $_POST['NAME_KZ'];
        $PHONE = $_POST['PHONE'];
        $GR_JOB = $_POST['GR_JOB'];
        $GR_JOB_KZ = $_POST['GR_JOB_KZ'];
        $ADDRESS = $_POST['ADDRESS'];
        $ADDRESS_KZ = $_POST['ADDRESS_KZ'];
              
        $emp_upd = $_POST['emp_upd'];
        $data = date('d.m.Y');
        $time = date('H:i:s');
        $sql_to_condition = "UPDATE INSURANCE2.dic_branch2 SET NAME = '$NAME', NAME_KZ = '$NAME_KZ', PHONE = '$PHONE', GR_JOB = '$GR_JOB', GR_JOB_KZ = '$GR_JOB_KZ', ADDRESS = '$ADDRESS', ADDRESS_KZ = '$ADDRESS_KZ' WHERE RFBN_ID = $id_upd";       
        $db->Execute($sql_to_condition);
    
        
        header("corpsite_contacts?product_id=$id_upd");
    }
   
    
    //постоянные запросы
    $today_date = date('d.m.Y');
    $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 15, date('Y')));
    
    $sql_prod = "select * from INSURANCE2.dic_branch2 where RFBN_ID = $product_id";
    $list_prod = $db -> Select($sql_prod);
    
    $sql_all_prod = "select * from SITE_PRODUCTS order by id";
    $list_all_prod = $db -> Select($sql_all_prod);
    
    $sql_prod_slider = "select * from SITE_PRODUCTS_SLIDER where PRODUCT_ID = $product_id order by id";
    $list_prod_slider = $db -> Select($sql_prod_slider);
    
    $sql_accord = "SELECT * FROM SITE_CONDITIONS WHERE PRODUCT_ID = '$product_id'";
    $list_accord = $db -> Select($sql_accord);  
    
    $sql_contact = "select * from INSURANCE2.dic_branch2 where RFBN_ID != 0000 and RFBN_ID != 1601 and nvl(asko, 0) = 0 order by 1 DESC";
    $list_contact = $db->select($sql_contact);
?>

