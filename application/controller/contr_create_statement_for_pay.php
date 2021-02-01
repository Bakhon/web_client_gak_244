<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    
    //echo '<pre>';
    //print_r($_SESSION);
    //echo '<pre>';
    //echo $emp_mail;

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    
    /*if(count($_FILES) > 0)
    {
        foreach($_FILES as $file)
        {
            //$t = explode('/', $file['type']);
            $filename = basename($file['name']);
            print_r($_FILES);
            //exit;
            //$ftp->uploadfile('Persons/doc_syst/', 'test', $_FILES['app']['tmp_name']);
            
            $conn_id = ftp_connect(FTP_SERVER);
            $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
            
            ftp_put($conn_id, 'Persons/test' , 'app_for_job' , FTP_BINARY);
            $ftp->create_path('Persons/doc_syst2');
            $ftp->uploadfile('Persons/test/', 'job_contract', $_FILES['app']['tmp_name']);
            echo $_FILES['app']['tmp_name'];
        }
        exit;
    }*/
    
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
                    
    if(isset($_POST['CREATE_MAIL'])){
        $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
        //echo $id;
        //print_r($_POST);
        $KIND = $_POST['KIND'];
        $type = $_POST['TYPE'];
        $state = $_POST['STATE'];
        $REG_NUM = $_POST['REG_NUM'];
        $HEAD_TEXT = $_POST['HEAD_TEXT'];
        $SENDER = trim($_POST['SENDER']);
        $SENDER_MAIL = trim($_POST['SENDER_MAIL']);
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        $i = 1;
        foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
        {   
            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time')";
            $list_reciep = $db -> Select($sql_reciep);
            $i++;
        }
        $DATE_START = $_POST['DATE_START'];
        $DATE_END = $_POST['DATE_END'];
        $LINK_FROM = $_POST['LINK_FROM'];
        $SHORT_TEXT = $_POST['SHORT_TEXT'];
        
        if($LINK_FROM == 0){
            $DOC_LINK = $id;
        }else{
            $DOC_LINK = $LINK_FROM;
        }
        //print_r($_POST['doc_b64']);
        
        if(isset($_POST['doc_b64'])){
            //создание директории по id
            if(!$ftp->create_path("doc_syst/$id"))
                    {
                        //$msg .= ALERTS::WarningMin("Ошибка создания папки!");
                        echo "Ошибка создания папки!";
                    }
            $i = 1;
            foreach ($_POST['doc_b64'] as $key=>$doc_to_mail_in_B64)
            {
                $format = substr($doc_to_mail_in_B64, -4);
                $file = base64_decode($doc_to_mail_in_B64);
                $handle = fopen($doc_to_mail_in_B64, 'r');
                //echo $file.'<br>';
                //echo $format.'<br>';
                
                //создание файла по имени id
                if(count($_FILES) > 0)
                {                
                    if(!$ftp->uploadfile("doc_syst/$id/", "$i$format", $handle))
                    {
                        echo "Ошибка создания файла!";
                    }
                }
                $i++;
            }
        }
        //echo '<pre>';
        //print_r($_POST);
        //echo '<pre>';
                
        $sql_create_mail = "INSERT INTO DOCUMENTS(ID, TYPE, STATE, REG_NUM, HEAD_TEXT, SENDER, SENDER_MAIL, DATE_START, DATE_END, LINK_FROM, SHORT_TEXT, KIND, DOC_LINK) VALUES ($id, '$type', '$state', '$REG_NUM', '$HEAD_TEXT', '$SENDER', '$SENDER_MAIL', '$DATE_START', '$DATE_END', '$LINK_FROM', '$SHORT_TEXT', '$KIND', '$DOC_LINK')";
        
        $bool = $db->ExecProc($sql_create_mail, $array);
        
        //echo $sql_create_mail;
    }
    
    //постоянные запросы
    //виды документов
    $sql_kind = "select * from DIC_DOC_KIND order by id";
    $list_kind = $db -> Select($sql_kind);
    
    //статусы документов
    $sql_state = "select * from DIC_DOC_STATE order by id";
    $list_sql_state = $db -> Select($sql_state);
    
    //департаменты
    $sql_dep = "select * from DIC_DEPARTMENT order by id";
    $list_dep = $db -> Select($sql_dep);
    
    //сотрудники
    $sql_persons = "select triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio from sup_person triv  where triv.JOB_SP = 23 OR triv.JOB_SP = 24 OR  triv.JOB_SP = 14";
    $list_persons = $db -> Select($sql_persons);
    
    
    $today_date = date('d.m.Y');
    $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));
?>

