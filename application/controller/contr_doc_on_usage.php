<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];   
    $emp_fio = $_SESSION['insurance']['fio'];

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

    $sql_sp = "select * from sup_person where EMAIL = '$emp_mail'";
    $list_sp = $db -> Select($sql_sp);
    $job_sp = $list_sp[0]['JOB_SP'];

    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');
    
    $doc_id = $_GET['doc_id'];
    
    array_push
    ($js_loader,
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

    array_push
    ($css_loader, 
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
        'styles/css/plugins/steps/jquery.steps.css',
        'styles/css/animate.css'
    );

    //сотрудники
    $sql_persons = "select triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio from sup_person triv where triv.STATE = 2 order by fio";
    $list_persons = $db -> Select($sql_persons);



        $conn_id = ftp_connect(FTP_SERVER);

        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        
        
        $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
        
                    
        $list = $db->select("select * from DOC_ON_USAGE where DOC_ID =  $doc_id");
                          
        $kind_id = $list[0]['ID'];
      
/*
 if(isset($_GET['doc_id']))
        {
        $doc_id = $_GET['doc_id'];            
        if($doc_id != ''){
        $contents = ftp_nlist($conn_id, "doc_syst/$doc_id/");
            }                                                
        }
        
        if(isset($_POST['DESTINATION']))
        {
            $dest = $_POST['DESTINATION'];
            $state = $_POST['STATE'];
            $reciep = $_POST['RECIPIENT'];
            $SENDER_MAIL = $_POST['SENDER_MAIL'];
            $SENDER = $_POST['SENDER'];
           
            
            $sql_i = "INSERT INTO DOCUMENTS(ID, TYPE, HEAD_TEXT, SHORT_TEXT,   STATE,  SENDER, SENDER_MAIL, DATE_START, KIND) VALUES ($id, 0, 'На ознакомление', 'На ознакомление', 16,  '$SENDER', '$SENDER_MAIL', '$today_date', $kind_id)";
            $sql_insert = $db->Execute($sql_i);
                
                                
            foreach($reciep as $k=>$v){
                $sql = "insert into DOC_RECEIP_USAGE (ID, MAIL_ID,  RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION, LINK_FILE) values (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$id', '$v', '$state', '$emp_mail', '$today_date', '$now_time', '$dest', '$doc_id')";               
                $list_sql = $db->execute($sql);
            }
            
            
        }
        */
        
        //test
        
        $PERSONAL_EMAIL = 'i.gabdusheva@gak.kz';
        
        
    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');
        
         $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
         $list_seq = $db -> Select($sql_id);
         $id = $list_seq[0]['NEXTVAL'];
        
        
         $sql_i = "INSERT INTO DOCUMENTS(ID, TYPE, HEAD_TEXT, SHORT_TEXT,   STATE,  SENDER, SENDER_MAIL, DATE_START, KIND) VALUES ($id, 0, 'На ознакомление', 'На ознакомление', 16,  'СУП', 'a.ibrayeva@gak.kz', '$today_date', 15)";
         $sql_insert = $db->Execute($sql_i);
            
            
         $sql = "insert into DOC_RECEIP_USAGE (ID, MAIL_ID,  RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION, LINK_FILE) values (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$id', '$PERSONAL_EMAIL', '0', 'a.ibrayeva@gak.kz', '$today_date', '$now_time', '1', '10761')";               
         $list_sql = $db->execute($sql);
         
         
        mail("$PERSONAL_EMAIL", 'Уведомление в СЭД', "Вам поступило письмо на ознакомление. Для ознакомления пройдите по ссылке http://192.168.5.244/on_inbox_new.", "From: Система электронного документооборота"); 
         
      //   mail('a.auganbaeva@gak.kz', 'Заявка на создание нового сотрудника', "ФИО: $lastname $firstname $middlename \r\nФилиал: $branch_name \r\nДепартамент: $dep_name \r\nДолжность: $dolzh_name \r\nПочта: $PERSONAL_EMAIL", 'From: hr@gak.kz');
        
        
        
        
        
        
        
        
        

?>
