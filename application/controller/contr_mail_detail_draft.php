<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    $step_id = $_GET['step_id'];
    $state_id = $_GET['state_id'];
    $state_table_name = $_GET['table_name_eng'];

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
    
               $sql_mail = "select
                        doc.ID,
                        doc.TYPE,
                        doc.KIND,
                        doc.STATE,
                        doc.REG_NUM,
                        doc.HEAD_TEXT,
                        doc.SENDER,
                        doc.DATE_START,
                        doc.DATE_END,
                        doc.LINK_FROM,
                        doc.SHORT_TEXT,
                        doc.SENDER_MAIL,
                        doc.DOC_LINK,
                        doc.CURRENT_STEP_ID,
                        doc.NEXT_STEP_ID,
                        doc.PREV_STEP_ID,
                        doc.ORDER_NUM,
                        doc.ORG_SENDER,
                        doc.SENDER_REG_NUM,
                        doc.SENDER_KIND,
                        doc.ADDRESS,
                        rec.RECIEP_MAIL,
                        rec.TABLE_NAME,
                        rec.TRIP
                    from
                        DOCUMENTS doc,
                        DOC_RECIEPMENTS_PROJECT rec
                    where
                        doc.id = '$doc_id' and
                        doc.id = rec.MAIL_ID";
        $trip_ishod = $db -> Select($sql_mail);
        $ishod = $trip_ishod[0]['TRIP'];        
                
    if(isset($_POST['GET_DOCUMENT_DATA']))
    {
        $doc_id = $_POST['GET_DOCUMENT_DATA'];
        get_draft_by_id($doc_id);
    }

    if(isset($_POST['GET_DOCUMENT_FILE']))
    {
        $doc_id = $_POST['GET_DOCUMENT_FILE'];
        get_draft_mail_doc($doc_id);
    }

    if(isset($_GET['doc_id']))
    {
        $doc_id = $_GET['doc_id'];
        $sql_mail = "select * from DOCUMENTS where id = $doc_id";
        $list_mail = $db -> Select($sql_mail);
        $list_mail_state = get_all_property($doc_id);
        foreach($list_mail as $k => $v)
        {
            
        }
    }

    if(isset($_GET['get_file']))
    {
        $dir_name = $_GET['get_file'];

		$contents = ftp_nlist($conn_id, "doc_syst/$dir_name/");

        $ftp_get = ftp_get($conn_id, 'C:\Users\User\Downloads\app_for_job', 'ftp://192.168.5.2/Persons/test/job_contract', FTP_BINARY);
		if(!ftp_get($conn_id, 'app_for_job', '/Persons/test/./job_contract', FTP_BINARY)){
			//echo 'NO';
		}
    }
        else
    {
        echo 'Ошибка!';
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

    function complete_mail($mail_id, $next_step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$mail_id' and (STATE = 4 OR STATE = 0 OR STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $errors_count = count($list_state);
        if($errors_count == 0)
        {
            $sql_read = "update DOCUMENTS set CURRENT_STEP_ID = '$next_step_id', STATE = 2 where ID = '$mail_id'";
            $list_read = $db -> Select($sql_read);
        }
    }

    function approve_mail($mail_id, $next_step_id, $SENDER_MAIL_COMMENT, $emp_fio)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$mail_id' and (STATE = 4 OR STATE = 0 OR STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $errors_count = count($list_state);
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');

        if($errors_count == 0)
        {
            $sql_read = "update DOCUMENTS set CURRENT_STEP_ID = '$next_step_id', STATE = 2 where ID = '$mail_id'";
            $list_read = $db -> Select($sql_read);

            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$mail_id', '$SENDER_MAIL_COMMENT', '0', 'robot_doc_syst', '$today_date', '$now_time', '9')";
            $list_reciep = $db -> Select($sql_reciep);

            /*
            require_once ('methods/xmpp.php');
            $jabber = new JABBER();
            $jabber->send_message("$SENDER_MAIL_COMMENT", "Ваше письмо согласовано, для ознакомления пройдите по ссылке http://192.168.5.244/completed");
            */
        }
    }

    //проверяет на наличие других согласований
    function check_other_agreement($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);

        if(empty($list_state))
        {
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id' WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
            /*
            require_once ('methods/xmpp.php');
            $jabber = new JABBER();
            $jabber->send_message("$SENDER_MAIL_COMMENT", "Ваше письмо согласовано, для ознакомления пройдите по ссылке http://192.168.5.244/completed");
            */
        }
            else
        {
            //echo 'Не все согласовали';
        }
        //exit;
    }

    //проверяет на наличие других согласований
    function check_other_reciepments($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_ASSIGNMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_RESOLUTION where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        /*
        echo '<pre>';
        print_r($list_all_reciep);
        echo '<pre>';
        */
        if(empty($list_all_reciep))
        {
            //echo 'Все согласовано';
            $next_step_id = get_next_step($doc_id);
            //echo '<br />'.$next_step_id;
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id', STATE = '7' WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }
            else
        {
            //echo 'Не все согласовали';
        }
        //exit;
    }

    //проверяет на наличие других согласований
    function check_other_assignment($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_ASSIGNMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_RESOLUTION where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        if(empty($list_all_reciep))
        {
            //echo 'Все поручения исполнены';
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id', STATE = 7 WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }
            else
        {
            //echo 'Не все поручения исполнены';
        }
        //exit;
    }

    //возвращает следующий шаг
    function get_next_step($doc_id)
    {
        $db = new DB();
        //проверка всех поручений
        //$sql_state = "select reciep.*,'DOC_RECIEPMENTS_ASSIGNMENT' table_name from DOC_RECIEPMENTS_ASSIGNMENT reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        //$list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        //проверка всех согласований
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_AGREEMENT' table_name from DOC_RECIEPMENTS_AGREEMENT reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;
        //$list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех подписантов
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_SIGNATURE' table_name from DOC_RECIEPMENTS_SIGNATURE reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех адресатов
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS' table_name from DOC_RECIEPMENTS reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех исходящих из компании
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_REGIST_OUT' table_name from DOC_RECIEPMENTS reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        $last_elem = end($list_all_reciep);
        $next_step = $last_elem['TABLE_NAME'];
        return $next_step;
    }

    function get_state_by_name($next_step_id)
    {
        $db = new DB();
        //пполучение айди по названию таблицы шага
        $sql_state = "select state.ID, state.STATE_NAME from DIC_DOC_STATE state where state.TABLE_NAME = '$next_step_id'";
        $list_state = $db -> Select($sql_state);
        return $list_state[0]['ID'];
    }

    //меняем статус документа
    function change_docs_state($doc_id, $state, $next_step_table)
    {
        $db = new DB();
        //активируем следующий шаг
        $sql_state = "update $next_step_table set STATE = '0' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        send_mail($next_step_table, $doc_id);

        //обновление статуса документа
        $sql_state = "update DOCUMENTS set STATE = '$state' where ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //все документы на контроле в завершено
        $sql_state = "update DOC_RECIEPMENTS_CONTROL set STATE = '2' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
    }

    function reject_mail($doc_id)
    {
        $db = new DB();
        //проверка всех поручений
        $sql_state = "update DOC_RECIEPMENTS_ASSIGNMENT set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //проверка всех согласований
        $sql_state = "update DOC_RECIEPMENTS_AGREEMENT set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //проверка всех адресатов
        $sql_state = "update DOC_RECIEPMENTS set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //проверка всех адресатов
        $sql_state = "update DOC_RECIEPMENTS_SIGNATURE set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
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
                       doc_state.STATE_NAME
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

    function set_resolution($doc_id)
    {
        $db = new DB();
        //обновление статуса документа
        $sql_state = "update DOCUMENTS set STATE = '3' where ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
    }

    function send_mail($next_step_table, $doc_id)
    {
        $db = new DB();
        
        //проверка всех подписантов
        $sql_state = "SELECT 
                        doc.*,
                        reciep.*
                        FROM $next_step_table reciep,
                        DOCUMENTS doc
                        WHERE 
                        reciep.MAIL_ID = $doc_id
                        and doc.ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        //echo '<pre>';
        //print_r($list_state);
        //echo '<pre>';
        $reciep_mail = $list_state[0]['RECIEP_MAIL'];
        $SHORT_TEXT = $list_state[0]['SHORT_TEXT'];
        $SENDER = $list_state[0]['SENDER'];
        //mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "К Вам, в СЭД пришло новое.", "From: Система электронного документооборота");
        $document->sendmail($reciep_mail, 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника $SENDER пришло письмо с коротким описанием $SHORT_TEXT. Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new");
      //  mail("$reciep_mail", 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника $SENDER пришло письмо с коротким описанием '$SHORT_TEXT'. Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new", "From: Система электронного документооборота");        
    }

    function get_draft_by_id($doc_id)
    {
        $db = new DB();
        $sql_mail = "select
                        doc.ID,
                        doc.TYPE,
                        doc.KIND,
                        doc.STATE,
                        doc.REG_NUM,
                        doc.HEAD_TEXT,
                        doc.SENDER,
                        doc.DATE_START,
                        doc.DATE_END,
                        doc.LINK_FROM,
                        doc.SHORT_TEXT,
                        doc.SENDER_MAIL,
                        doc.DOC_LINK,
                        doc.CURRENT_STEP_ID,
                        doc.NEXT_STEP_ID,
                        doc.PREV_STEP_ID,
                        doc.ORDER_NUM,
                        doc.ORG_SENDER,
                        doc.SENDER_REG_NUM,
                        doc.SENDER_KIND,
                        doc.ADDRESS,
                        rec.RECIEP_MAIL,
                        rec.TABLE_NAME,
                        rec.TRIP
                    from
                        DOCUMENTS doc,
                        DOC_RECIEPMENTS_PROJECT rec
                    where
                        doc.id = '$doc_id' and
                        doc.id = rec.MAIL_ID";
        $list_mail = $db -> Select($sql_mail);
        if(empty($list_mail))
        {
            $sql_mail = "select
                            doc.ID,
                            doc.TYPE,
                            doc.KIND,
                            doc.STATE,
                            doc.REG_NUM,
                            doc.HEAD_TEXT,
                            doc.SENDER,
                            doc.DATE_START,
                            doc.DATE_END,
                            doc.LINK_FROM,
                            doc.SHORT_TEXT,
                            doc.SENDER_MAIL,
                            doc.DOC_LINK,
                            doc.CURRENT_STEP_ID,
                            doc.NEXT_STEP_ID,
                            doc.PREV_STEP_ID,
                            doc.ORDER_NUM,
                            doc.ORG_SENDER,
                            doc.SENDER_REG_NUM,
                            doc.SENDER_KIND,
                            doc.ADDRESS
                        from
                            DOCUMENTS doc
                        where
                            doc.id = '$doc_id' and
                            doc.STATE = '6'";
            $list_mail = $db -> Select($sql_mail);
        }
        //echo $sql_mail;
        echo json_encode($list_mail);
        exit;
    }

    function get_draft_mail_doc($dir_name)
    {
        $db = new DB();
        $sql_upd_state = "select * from DOC_OTHER_DOC_LINK where MAIL_ID = '$dir_name'";
        $contents_added = $db -> Select($sql_upd_state);
        //print_r($contents_added);        

        //$conn_id = ftp_connect(FTP_SERVER);
        //$login_result = ftp_login($conn_id, 'upload', 'Astana2014');

        //загрузка документа
        //$ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

		//$contents = ftp_nlist($conn_id, "doc_syst/$dir_name/");
?>
        <div class="attachment fadeInRight">
                <?php
                    $i = 1;            
                    foreach($contents_added as $k => $c)
                    {
                ?>
                <div class="file-box draft_doc<?php echo $i; ?>">
                    <div class="file">
                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>">
                            <span class="corner"></span>
                            <div class="icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="file-name">
                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>" target="_blank"><?php $exp_str = explode('/', $c['NAME']); echo $name_of_file = end($exp_str); ?></a>
                                <br/>
                                <button class="btn btn-danger btn-xs" onclick="remove_doc('draft_doc<?php echo $i; ?>');"><i class="fa fa-times-rectangle" aria-hidden="true"></i> Удалить</button>
                            </div>
                        </a>
                    </div>
                </div>
                <script>
                    $('#text_areas_in_base64').append('<input style="display: none;" type="text" class="form-control draft_doc<?php echo $i; ?>" name="DOC_OTHER_DOC_LINK[]" required="" value="<?php echo $c['NAME']; ?>"/>');
                </script>
                <?php
                    $i++;
                    }
                ?>
            <div class="clearfix"></div>
        </div>
<?php
        $conn_id = ftp_connect(FTP_SERVER);
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

        //загрузка документа
        $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

		$contents = ftp_nlist($conn_id, "doc_syst/$dir_name/");
?>
        <div class="attachment fadeInRight">
                <?php
                    $i = 1;            
                    foreach($contents as $k => $c)
                    {
                ?>
                <div class="file-box draft_doc<?php echo $i; ?>">
                    <div class="file">
                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>">
                            <span class="corner"></span>
                            <div class="icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="file-name">
                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>" target="_blank"><?php $exp_str = explode('/', $c); echo $name_of_file = end($exp_str); ?></a>
                                <br/>
                                <button class="btn btn-danger btn-xs" onclick="remove_doc('draft_doc<?php echo $i; ?>');"><i class="fa fa-times-rectangle" aria-hidden="true"></i> Удалить</button>
                            </div>
                        </a>
                    </div>
                </div>
                <script>
                    $('#text_areas_in_base64').append('<input style="display: none;" type="text" class="form-control draft_doc<?php echo $i; ?>" name="DOC_OTHER_DOC_LINK[]" required="" value="<?php echo $c; ?>"/>');
                </script>
                <?php
                    $i++;
                    }
                ?>
            <div class="clearfix"></div>
        </div>      
        <script>
            function remove_doc(draft_doc)
            {
                $('.'+draft_doc).remove();
                            
            }            
        </script>                
<?php
    exit;
    }
?>



