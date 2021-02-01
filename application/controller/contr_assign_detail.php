<?php
    $db = new DB();
    $document = new Document();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    if(isset($_GET['step_id']))
    {
    $step_id = $_GET['step_id'];
    }
    if(isset($_GET['state_id'])){
    $state_id = $_GET['state_id'];}
    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');
    $doc_id = $_GET['doc_id'];

    $conn_id = ftp_connect(FTP_SERVER);      
    $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

    $select_author_id = "select ID, JOB_POSITION from sup_person where EMAIL = '$emp_mail'";
    $list_author_id = $db -> Select($select_author_id);
    $emp_author_id = $list_author_id[0]['ID'];

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
  if(isset($_GET['dest_id'])) {   $dest_id =  $_GET['dest_id']; }

 /*   $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);

    $trip_id = $list_sender_mail[0]['TRIP_ID'];

    $step_info = $document->get_next_and_prev_step($trip_id, $step_id);
    $prev_step_id = $step_info[0]['ID_PREV'];
    $next_step_id = $step_info[0]['ID_NEXT'];
*/
    if(isset($_POST['HEAD_TEXT']))
    {
        $doc_id = $_POST['DOC_ID'];
        $HEAD_TEXT = $_POST['HEAD_TEXT'];
        $DATE_END = $_POST['DATE_END'];
        $DATE_START = $_POST['DATE_START'];
        $COMMENT_TO_ASSIGN = $_POST['COMMENT_TO_ASSIGN_MOD'];
        $DATE_PROD = $_POST['DATE_PROD'];
        $sql_upd_state = "update DOCUMENTS set HEAD_TEXT = '$HEAD_TEXT', DATE_END = '$DATE_END', DATE_START = '$DATE_START', DATE_PROD = '$DATE_PROD' where ID = '$doc_id'";
        $list_upd_state = $db -> Select($sql_upd_state);
        $sql_upd_state = "update DOC_ASSIGNMENT set COMMENT_TO_ASSIGN = '$COMMENT_TO_ASSIGN' where MAIL_ID = '$doc_id'";
        $list_upd_state = $db -> Select($sql_upd_state);
    }

    if(isset($_POST['DOC_ASSIGN_STATE']))
    {
        $doc_id = $_POST['DOC_ASSIGN_STATE'];
        $sql_upd_state = "update DOCUMENTS set STATE = '15' where ID = '$doc_id'";
        $list_upd_state = $db -> Select($sql_upd_state);
    }

    if(isset($_POST['COMMENT_TO_ASSIGN']))
    {
        $COMMENT_TO_ASSIGN = $_POST['COMMENT_TO_ASSIGN'];
        $ASSIGN_MAIL = $_POST['ASSIGN_MAIL'];
        $ASSIGN_SENDER = $_POST['ASSIGN_SENDER'];

        $sql_reciep = "INSERT INTO DOC_ASSIGNMENTS_COMMENTS (ID, DATE_OF_COMMENT, EMP_ID, STATE, TEXT, MAIL_ID, TIME_OF_COMMENT)
                       VALUES (SEQ_DOC_ASSIGNMENT.NEXTVAL,
                                '$today_date',
                                '$emp_author_id',
                                '1',
                                '$COMMENT_TO_ASSIGN',
                                '$doc_id',
                                '$now_time')";
        $list_reciep = $db -> Select($sql_reciep);

        $sql_all_assigners = "select RECIEPMENTS_MAIL from DOC_ASSIGN_RECIEPMENTS where MAIL_ID = '$doc_id'";
        $list_all_assigners = $db -> Select($sql_all_assigners);
        //таблица комментариев
        foreach ($list_all_assigners as $key=>$reciep_mail)
        {
            foreach ($reciep_mail as $key2=>$reciep_mail2)
            {
                $document->sendmail($reciep_mail2, 'Уведомление СЭД', "Сотрудник $ASSIGN_SENDER добавил комментарий $COMMENT_TO_ASSIGN к поручению. Для ознакомления, пройдите по ссылке http://192.168.5.244/assign_detail?doc_id=$doc_id&get_file=$doc_id");
             //   mail("$reciep_mail2", 'Уведомление СЭД', "Сотрудник $ASSIGN_SENDER добавил комментарий '$COMMENT_TO_ASSIGN' к поручению. Для ознакомления, пройдите по ссылке http://192.168.5.244/assign_detail?doc_id=$doc_id&get_file=$doc_id");
            }
        }
    }

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
        
        
        $sql_mail = "select * from DOCUMENTS where id = $doc_id";
        $list_mail = $db -> Select($sql_mail);
        if(isset($_GET['rec_id '])) { $rec_id = $_GET['rec_id'];
        $sql_state = "select * from DOC_RECIEPMENTS where ID = '$rec_id'";
        $list_state = $db -> Select($sql_state);
        $doc_state = $list_state[0]['STATE'];
        }
        $list_mail_state = get_all_assign_property($doc_id);
        foreach($list_mail as $k => $v)
        {
            
        }
    }
    $sql_assign = 
                "select doc.* from DOC_ASSIGNMENT doc where doc.MAIL_ID = '$doc_id' ORDER BY COMMENT_TO_ASSIGN";
    $list_assign = $db -> Select($sql_assign);
    
    $sql_compliance_recomendation = "select doc.*, document.TYPE  from DOC_ASSIGNMENT doc, DOCUMENTS document where doc.MAIL_ID = document.ID and document.ID = '$doc_id'";
    $list_compliance_recomendation = $db -> select($sql_compliance_recomendation);

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

    function get_all_assign_property($doc_id)
    {
        $db = new DB();
        $sql_mail_state = 
                "SELECT 
                     reciep.*,
                     triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio
                FROM DOC_ASSIGNMENTS_COMMENTS reciep,
                     SUP_PERSON triv
                WHERE
                     reciep.MAIL_ID = $doc_id
                     AND triv.ID = reciep.EMP_ID
                ORDER BY RECIEP.ID";
        $list_mail_state = $db -> Select($sql_mail_state);
        return $list_mail_state;
    }
?>


