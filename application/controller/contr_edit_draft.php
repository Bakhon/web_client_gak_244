<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];

    $step_id = $_GET['step_id'];
    $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);
    $trip_id = $list_sender_mail[0]['TRIP_ID'];
    

    $select_author_id = "select ID, JOB_POSITION from sup_person where EMAIL = '$emp_mail'";
    $list_author_id = $db -> Select($select_author_id);
    $emp_author_id = $list_author_id[0]['ID'];
    $job_sp_id = $list_author_id[0]['JOB_POSITION'];
    $select_author_jobsp_group = "select POS_GROUP from DIC_DOLZH where ID = '$job_sp_id'";
    $list_author_jobsp_group = $db -> Select($select_author_jobsp_group);
    $pos_grp_id = $list_author_jobsp_group[0]['POS_GROUP'];

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    if(isset($_GET['trip_id']))
    {
        $trip_id = $_GET['trip_id'];
    }
        else
    {
        $trip_id = '0';
    }

    $SQL_TRIP_RECIEPMENTS = "select POS_GROUP from DOC_TRIP_RECIEPMENTS where TRIP_ID = $trip_id";
    $LIST_TRIP_RECIEPMENTS = $db -> Select($SQL_TRIP_RECIEPMENTS);
    //print_r($LIST_TRIP_RECIEPMENTS);

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

    if(isset($_POST['CREATE_MAIL']))
    {
        $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
        $NEXT_STEP_ID = $_POST['NEXT_STEP'];
        $CURRENT_STEP_ID = $_POST['CURRENT_STEP'];
        $NEXT_STEP_ID = $_POST['NEXT_STEP'];
        $PREV_STEP_ID = $_POST['PREV_STEP'];

        //require_once ('methods/xmpp.php');
        //$jabber = new JABBER();
        $KIND = $_POST['KIND'];
        $type = $_POST['TYPE'];
        $state = $_POST['STATE'];
        $REG_NUM = $_POST['REG_NUM'];
        $HEAD_TEXT = $_POST['HEAD_TEXT'];
        $SENDER = trim($_POST['SENDER']);
        $SENDER_MAIL = trim($_POST['SENDER_MAIL']);
        $DESTINATION = $_POST['DESTINATION'];
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        $i = 1;
        $DATE_START = $_POST['DATE_START'];
        $DATE_END = $_POST['DATE_END'];
        $LINK_FROM = $_POST['LINK_FROM'];
        $SHORT_TEXT = $_POST['SHORT_TEXT'];
        $TRIP = $_POST['TRIP'];

        if($state == '0')
        {
            $sql_reciep = "DELETE DOC_RECIEPMENTS_PROJECT WHERE MAIL_ID = '$LINK_FROM'";
            $list_reciep = $db -> Select($sql_reciep);

            $sql_reciep = "DELETE DOC_OTHER_DOC_LINK WHERE MAIL_ID = '$LINK_FROM'";
            $list_reciep = $db -> Select($sql_reciep);

            $sql_reciep = "DELETE DOCUMENTS WHERE ID = '$LINK_FROM'";
            $list_reciep = $db -> Select($sql_reciep);

            //таблица согласований
            foreach ($_POST['RECIPIENT_AGREEMENT'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME, TRIP) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', 'RECIPIENT_AGREEMENT', $TRIP)";
                $list_reciep = $db -> Select($sql_reciep);
            }

            //таблица поручений
            foreach ($_POST['RECIPIENT_ASSIGNMENT'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME, TRIP) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', 'RECIPIENT_ASSIGNMENT', $TRIP)";
                $list_reciep = $db -> Select($sql_reciep);
            }

            //таблица регистраций
            foreach ($_POST['RECIPIENT_REGISTRATION'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME, TRIP) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', 'RECIPIENT_REGISTRATION', $TRIP)";
                $list_reciep = $db -> Select($sql_reciep);
            }

            //таблица резолюций
            foreach ($_POST['RECIPIENT_RESOLUTION'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME, TRIP) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', 'RECIPIENT_RESOLUTION', $TRIP)";
                $list_reciep = $db -> Select($sql_reciep);
            }

            //таблица адресатов
            foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME, TRIP) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$id', '$reciep_mail', '$state_rec', '$emp_mail', '$today_date', '$now_time', 'RECIPIENT', $TRIP)";
                $list_reciep = $db -> Select($sql_reciep);
            }

            //таблица файлов с черновика
            foreach ($_POST['DOC_OTHER_DOC_LINK'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_OTHER_DOC_LINK (ID, MAIL_ID, NAME) VALUES (SEQ_OTHER_DOC_LINK.NEXTVAL, '$id', '$reciep_mail')";
                $list_reciep = $db -> Select($sql_reciep);
            }
        }

        $sql_create_mail = "INSERT INTO DOCUMENTS(ID, TYPE, STATE, REG_NUM, HEAD_TEXT, SENDER, SENDER_MAIL, DATE_START, DATE_END, LINK_FROM, SHORT_TEXT, KIND, DOC_LINK, CURRENT_STEP_ID, NEXT_STEP_ID, PREV_STEP_ID) VALUES ($id, '$type', '$state', '$REG_NUM', '$HEAD_TEXT', '$SENDER', '$SENDER_MAIL', '$DATE_START', '$DATE_END', '$LINK_FROM', '$SHORT_TEXT', '$KIND', '$DOC_LINK', '$CURRENT_STEP_ID', '$NEXT_STEP_ID', '$PREV_STEP_ID')";
        $bool = $db->ExecProc($sql_create_mail, $array);

        if(isset($_POST['doc_b64']))
        {
            //создание директории по id
            if(!$ftp->create_path("doc_syst/$id"))
                    {
                        //$msg .= ALERTS::WarningMin("Ошибка создания папки!");
                        echo "Ошибка создания папки!";
                    }
            $i = 1;
            foreach ($_POST['doc_b64'] as $key=>$doc_to_mail_in_B64)
            {
                $str = explode('.', $doc_to_mail_in_B64);
                $format = end($str);
                $filename = $str[1];
                $file = base64_decode($doc_to_mail_in_B64);
                $handle = fopen($doc_to_mail_in_B64, 'r');
                
                //создание файла по имени id
                if(count($_FILES) > 0)
                {
                    if(!$ftp->uploadfile("doc_syst/$id/", "$filename.$format", $handle))
                    {
                        echo "Ошибка создания файла!";
                    }
                }
                $i++;
            }
        }
        header('Location: on_inbox_new');
    }

    //постоянные запросы
    //виды документов
    $sql_kind = "select * from DIC_DOC_KIND order by id";
    $list_kind = $db -> Select($sql_kind);

    //статусы документов
    $sql_state = "select * from DIC_DOC_STATE order by id";
    $list_sql_state = $db -> Select($sql_state);

    //департаменты
    $sql_dep = "select dep.ID, dep.NAME, DEP_CHIEFS.ID_DIR, TRIVIAL.EMAIL from DIC_DEPARTMENT dep, DIC_CHIEFS dep_chiefs, SUP_PERSON trivial where DEP_CHIEFS.ID_DEPARTMENT = DEP.ID and TRIVIAL.ID = DEP_CHIEFS.ID_DIR order by id";
    $list_dep = $db -> Select($sql_dep);

    //destinations
    $sql_dest = "select * from DIC_DOC_DESTINATION order by id";
    $list_dest = $db -> Select($sql_dest);

    $i = 1;
    //сотрудники
    $sql_persons .= "select dep.NAME DEP_NAME, triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio, dolzh.D_NAME from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep where triv.JOB_POSITION = dolzh.ID and triv.JOB_SP = dep.ID and triv.STATE = 2";
    /*
    foreach($LIST_TRIP_RECIEPMENTS as $k => $v)
    {
        $pos_grp_id = $v['POS_GROUP'];
        $sql_persons .= " dolzh.POS_GROUP = $pos_grp_id ";
        if(count($LIST_TRIP_RECIEPMENTS) != $i)
        {
            $sql_persons .= ' or ';
            $i++;
        }
    }
    */
    $sql_persons .= " order by fio";
    $list_persons = $db -> Select($sql_persons);

    $today_date = date('d.m.Y');
    $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));

    $sql_trip = "select dc_trip.* from DOC_TRIP dc_trip WHERE dc_trip.TRIP_TYPE = 2 order by dc_trip.ID";
    $list_trip = $db -> Select($sql_trip);
?>
    
