<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];    
    $emp_fio = $_SESSION['insurance']['fio'];
    $step_id = $_GET['step_id'];
    $state_id = $_GET['state_id'];

    $conn_id = ftp_connect(FTP_SERVER);      
    $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    $dest_id = $_GET['dest_id'];

    $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);

    $trip_id = $list_sender_mail[0]['TRIP_ID'];

    $step_info = $document->get_next_and_prev_step($trip_id, $step_id);
    $prev_step_id = $step_info[0]['ID_PREV'];
    $next_step_id = $step_info[0]['ID_NEXT'];
    
    $doc_id = $_GET['doc_id'];
    


    if(isset($_GET['get_file']))
    {
        $dir_name = $_GET['get_file'];
            
		$contents = ftp_nlist($conn_id, "doc_syst/$dir_name/");

     /*   $ftp_get = ftp_get($conn_id, 'C:\Users\User\Downloads\app_for_job', 'ftp://192.168.5.2/Persons/test/job_contract', FTP_BINARY);
		if(!ftp_get($conn_id, 'app_for_job', '/Persons/test/./job_contract', FTP_BINARY))
        {
			//echo 'NO';
		} */

        $sql_upd_state = "select * from DOC_OTHER_DOC_LINK where MAIL_ID = '$doc_id'";
        $contents_added = $db -> Select($sql_upd_state);
    }
        else
    {
        echo 'Ошибка!';
    }

    if(isset($_GET['set_state']))
    {
        $setting_state = $_GET['set_state'];
        $doc_id = $_GET['doc_id'];
        if(isset($_GET['rec_id']))
        {
            $rec_id = $_GET['rec_id'];
            $sql_upd_state = "update DOC_RECIEPMENTS set STATE = '$setting_state' where ID = '$rec_id'";
            $list_upd_state = $db -> Select($sql_upd_state);
            $sql_sender_mail = "select SENDER_MAIL from DOC_RECIEPMENTS where ID = '$rec_id'";
            $list_sender_mail = $db -> Select($sql_sender_mail);
            $sender_mail = $list_sender_mail[0]['SENDER_MAIL'];
        }
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if(isset($_POST['get_file']))
    {
        $conn_id = ftp_connect(FTP_SERVER);
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        $s = explode('/', 'app_for_job');
        $t = count($s);
        $local_file = $s[$t-1];

        ftp_get($conn_id, $local_file, 'Persons/test/', FTP_BINARY);
        exit;
    }

    if(isset($_GET['doc_id']))
    {
        $doc_id = $_GET['doc_id'];
        $rec_id = $_GET['rec_id'];
        $sql_mail = "select * from DOCUMENTS where id = $doc_id";
        $list_mail = $db -> Select($sql_mail);
        $sql_state = "select * from DOC_RECIEPMENTS where ID = '$rec_id'";
        $list_state = $db -> Select($sql_state);
        $doc_state = $list_state[0]['STATE'];
        $sql_upd_control = $db->execute("Update DOC_RECIEPMENTS_CONTROL set STATE = 1 where RECIEP_MAIL = '$emp_mail' and MAIL_ID = $doc_id");        
        $list_mail_state = get_all_property($doc_id);
        foreach($list_mail as $k => $v)
        {
            
        }
    }

    if(isset($_POST['COMMENT']))
    {        
        print_r($_POST);
        $doc_id = $_GET['doc_id'];
        $mail_id = $_GET['doc_id'];
        $REC_ID = $_POST['REC_ID'];
        $comment = $_POST['COMMENT'];
        $state = $_POST['STATE'];
        $comment_date = $_POST['COMMENT_DATE'];
        $comment_time = $_POST['COMMENT_TIME'];
        $reg_num = $_POST['REG_NUM'];
        $order_num = $_POST['ORDER_NUM'];
        $short_text = $_POST['SHORT_TEXT'];
        $author = $_POST['AUTHOR'];

        $SENDER_MAIL_COMMENT = $_POST['SENDER_MAIL_COMMENT'];

        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');

        if(isset($_POST['REG_NUM']))
        {
            $reg_num = $_POST['REG_NUM'];
            $sql_reg_num = "update DOCUMENTS set REG_NUM = '$reg_num' where ID = '$doc_id'";
            $list_reg_num = $db -> Select($sql_reg_num);
        }

        //отозвать
        if($state == 12)
        {
            reject_mail($doc_id);
            $table_name_eng = $_GET['table_name_eng'];

            $sql_change_step = "UPDATE $table_name_eng SET COMMENT_TO_DOC = '$comment', STATE = 6 WHERE ID = '$REC_ID'";
            $list_change_step = $db -> Select($sql_change_step);

            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '', NEXT_STEP_ID = '', PREV_STEP_ID = '', STATE = '0' WHERE ID = '$mail_id'";
            $list_change_step = $db -> Select($sql_change_step);

            $list_reciepments_mail = get_all_mail_reciepments($mail_id);
            foreach($list_reciepments_mail as $k => $v)
            {
                $rec_mail = $v['RECIEP_MAIL'];
                $document->sendmail($rec_mail, 'Отзыв в СЭД', "Письмо с коротким описанием $short_text было отозвано автором $author");
             //   mail("$rec_mail", 'Отзыв в СЭД', "Письмо с коротким описанием '$short_text' было отозвано автором $author", "From: Система электронного документооборота");
            }
        }

        if($state == 20)
        {
            $document = new Document();
            $document->sendmail('b.abdisamat@gak.kz', 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - $comment, date - $today_date, time - $now_time, sender - $emp_fio");
            mail("i.akhmetov@gak.kz", 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio", "From: Система электронного документооборота");
            mail("i.gabdusheva@gak.kz", 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio", "From: Система электронного документооборота");
        }
        header('Location: on_inbox_new');
    }

    //сотрудники
    $sql_persons = "select triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio from sup_person triv  where STATE = 2 ORDER BY triv.LASTNAME";
    $list_persons = $db -> Select($sql_persons);

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
        "styles/css/plugins/steps/jquery.steps.css",
        'styles/css/animate.css'
    );

    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                  </script>";

    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');

    //отклонение документа
    function reject_mail($doc_id)
    {
        $db = new DB();

        //смена статуса во всех таблицах на отозвано
        $sql_state = "update DOC_RECIEPMENTS_ASSIGNMENT set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_AGREEMENT set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_SIGNATURE set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_RESOLUTION set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_CONTROL set STATE = '6' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //перенос в проекты
        set_to_project($doc_id, 'DOC_RECIEPMENTS', 'RECIPIENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_AGREEMENT', 'RECIPIENT_AGREEMENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_ASSIGNMENT', 'DOC_RECIEPMENTS_ASSIGNMENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_REGISTRATION', 'RECIPIENT_REGISTRATION');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_RESOLUTION', 'RECIPIENT_RESOLUTION');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_SIGNATURE', 'DOC_RECIEPMENTS_SIGNATURE');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_CONTROL', 'DOC_RECIEPMENTS_CONTROL');
    }

    //все письма с этим ID
    function get_all_mail_reciepments($doc_id)
    {
        $db = new DB();

        //смена статуса во всех таблицах на отклонено
        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS_ASSIGNMENT where MAIL_ID = '$doc_id'";
        $list_mail_all = $db -> Select($sql_state);

        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id'";
        $list_mail = $db -> Select($sql_state);
        $list_mail_all = array_merge($list_mail, $list_mail_all);

        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS where MAIL_ID = '$doc_id'";
        $list_mail = $db -> Select($sql_state);
        $list_mail_all = array_merge($list_mail, $list_mail_all);

        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS_SIGNATURE where MAIL_ID = '$doc_id'";
        $list_mail = $db -> Select($sql_state);
        $list_mail_all = array_merge($list_mail, $list_mail_all);

        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS_RESOLUTION where MAIL_ID = '$doc_id'";
        $list_mail = $db -> Select($sql_state);
        $list_mail_all = array_merge($list_mail, $list_mail_all);

        $sql_state = "SELECT RECIEP_MAIL FROM DOC_RECIEPMENTS_CONTROL where MAIL_ID = '$doc_id'";
        $list_mail = $db -> Select($sql_state);
        $list_mail_all = array_merge($list_mail, $list_mail_all);

        return $list_mail_all;
    }

    function set_to_project($doc_id, $table_name, $table_name_for_insert)
    {
        $db = new DB();

        $sql_state = "SELECT reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               doc_state.NAME STATE,
                               '$table_name' table_name
                            FROM $table_name reciep,
                               DIC_DOC_RECIEPMENT_STATE doc_state
                            WHERE DOC_STATE.ID = RECIEP.STATE
                              AND reciep.STATE = '6'
                              AND reciep.MAIL_ID = $doc_id
                            ORDER BY RECIEP.ID";
        $list_all_reciep = $db -> Select($sql_state);
        //echo $sql_state.'<br /><br />';
        foreach($list_all_reciep as $k => $v)
        {
            $reciep_mail = $v['RECIEP_MAIL'];
            $emp_mail = $v['SENDER_MAIL'];
            $today_date = $v['POST_DATE'];
            $now_time = $v['POST_TIME'];
            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$doc_id', '$reciep_mail', '$emp_mail', '$today_date', '$now_time', '$table_name_for_insert')";
            $list_reciep = $db -> Select($sql_reciep);
        }
    }

    function get_all_property($doc_id)
    {
        $db = new DB();
        $sql_mail_state = 
                "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                       triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                       reciep.SENDER_MAIL,
                       reciep.ID,
                       reciep.POST_DATE,
                       reciep.POST_TIME,
                       reciep.SENDER_MAIL,
                       reciep.COMMENT_TO_DOC,
                       reciep.RECIEP_MAIL,
                       RECIEP.STATE,
                       doc_state.STATE_NAME,
                       reciep.RECIEP_DATE,
                       reciep.RECIEP_TIME,
                FROM DOC_RECIEPMENTS reciep,
                     DIC_DOC_STATE doc_state,
                     SUP_PERSON triv,
                     SUP_PERSON triv2
                WHERE triv2.EMAIL = reciep.SENDER_MAIL
                  AND triv.EMAIL = reciep.RECIEP_MAIL
                  AND DOC_STATE.ID = RECIEP.STATE
                  AND reciep.STATE != '4'
                  AND reciep.MAIL_ID = $doc_id
                ORDER BY RECIEP.ID";
        $list_mail_state = $db -> Select($sql_mail_state);

        //проверка всех адресатов
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               doc_state.NAME STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               'Адресат' table_name
                        FROM DOC_RECIEPMENTS reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_all_reciep = $db -> Select($sql_state);
        $list_all_reciep = $list_all_reciep;

        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'Канцелярия (исходящее)' table_name
                        FROM DOC_RECIEPMENTS_REGIST_OUT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'Поручение' table_name
                        FROM DOC_RECIEPMENTS_ASSIGNMENT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех согласований
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_AGREEMENT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        
        
        // проверка на контроль
                $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'На контроле' table_name
                        FROM DOC_RECIEPMENTS_CONTROL reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
                $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep); 
        
                                
        //проверка всех резолюций
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_RESOLUTION reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех подписантов
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               'Подписание' table_name
                        FROM DOC_RECIEPMENTS_SIGNATURE reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        return $list_all_reciep;
    }
?>


