<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];

    $step_id = $_GET['step_id'];
    $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);
    $trip_id = $list_sender_mail[0]['TRIP_ID'];

    $step_info = $document->get_next_and_prev_step($trip_id, $step_id);
    $prev_step_id = $step_info[0]['ID_PREV'];
    $next_step_id = $step_info[0]['ID_NEXT'];

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

    $sql_sp = "select * from sup_person where EMAIL = '$emp_mail'";
    $list_sp = $db -> Select($sql_sp);
    $job_sp = $list_sp[0]['JOB_SP'];

    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');

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
    $sql_persons = "select triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio from sup_person triv where triv.STATE = 2 order by fio";
    $list_persons = $db -> Select($sql_persons);

    if(isset($_GET['mail_id']))
    {
        $mail_id = $_GET['mail_id'];
        $sql_mail = "select * from documents where id = $mail_id";
        $list_mail = $db -> Select($sql_mail);
        $today_date_plus_15 = $list_mail[0]['DATE_END'];
        $head_text = $list_mail[0]['HEAD_TEXT'];
        $REG_NUM = $list_mail[0]['REG_NUM'];
        $SHORT_TEXT = $list_mail[0]['SHORT_TEXT'];
        $KIND = $list_mail[0]['KIND'];
        $TYPE = $list_mail[0]['TYPE'];
        $DOC_LINK = $list_mail[0]['DOC_LINK'];
        $DESTINATION = $_POST['DESTINATION'];
        $comment = $_POST['COMMENT'];

        $conn_id = ftp_connect(FTP_SERVER);

        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

        $mail_id = $_GET['mail_id'];

        if(isset($_POST['RECIPIENT']))
        {
            foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_ASSIGNMENT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, DESTINATION, COMMENT_TO_DOC, RECIEP_DATE, RECIEP_TIME) VALUES (SEQ_DOC_RECIEPMENTS_ASSIGNMENT.NEXTVAL, '$mail_id', '$reciep_mail', '0', '$emp_mail', '$DESTINATION', '$comment', '$today_date', '$now_time')";
                $list_reciep = $db -> Select($sql_reciep);
                $document->sendmail($reciep_mail, 'Уведомление в СЭД', "Сотрудник $emp_fio прислал письмо на согласование с комментарием $comment.");
              //  mail("$reciep_mail", 'Уведомление в СЭД', "Сотрудник $emp_fio прислал письмо на согласование с комментарием '$comment'.", "From: Система Электронного Документооборота");
            }
            header('Location: on_inbox_new');
        }

        if($DOC_LINK != '')
        {
            $contents = ftp_nlist($conn_id, "doc_syst/$DOC_LINK/");
        }
    }
?>

