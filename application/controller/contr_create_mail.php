<?php
    $db = new DB();
    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    $step_id = $_GET['step_id'];

    $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);
    $trip_id = $list_sender_mail[0]['TRIP_ID'];

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
        'styles/css/animate.css',
        'styles/css/plugins/steps/jquery.steps.css',
        'styles/css/plugins/jsTree/style.min.css'
    );
    
    if(isset($_POST['get_reciepment'])){
        $dep_id = $_POST['dep_id'];
        $sql_reciep = "select sup.EMAIL, sup.LASTNAME from DIC_CHIEFS chief, sup_person sup where chief.ID_DEPARTMENT = $dep_id and sup.ID = chief.ID_DIR";
        $list_reciep = $db -> Select($sql_reciep);
        $sql_curat = "select sup.EMAIL, sup.LASTNAME from CURATORS cur, sup_person sup where cur.DEP_ID = $dep_id and sup.ID = cur.CURATORS_ID";
        $list_curat = $db -> Select($sql_curat);
        //echo $sql_reciep;
        //print_r($list_reciep);
    ?>
        <div class="form-group" id="data_1">
            <label class="font-noraml">Директор</label>
            <input name="RECIPIENT[]" placeholder="" class="form-control" id="director" value="<?php echo $list_reciep[0]['LASTNAME']; ?>"/>
            <label class="font-noraml">Почта директора</label>
            <input name="RECIPIENT[]" placeholder="" class="form-control" id="director_email" value="<?php echo $list_reciep[0]['EMAIL']; ?>"/>
            <label class="font-noraml">Куратор</label>
            <input name="RECIPIENT[]" placeholder="" class="form-control" id="curator" value="<?php echo $list_curat[0]['LASTNAME']; ?>"/>
            <label class="font-noraml">Почта куратора</label>
            <input name="RECIPIENT[]" placeholder="" class="form-control" id="curator_email" value="<?php echo $list_curat[0]['EMAIL']; ?>"/>
        </div>    
    <?php
        exit;
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
    $sql_persons = "select dep.NAME DEP_NAME, triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio, dolzh.D_NAME from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep where triv.JOB_POSITION = dolzh.ID and triv.JOB_SP = dep.ID order by fio";
    $list_persons = $db -> Select($sql_persons);
    
    if(isset($_GET['mail_id']))
    {
        $mail_id = $_GET['mail_id'];
        $sql_mail = "select * from documents where id = $mail_id";
        $list_mail = $db -> Select($sql_mail);
        
        $today_date = $list_mail[0]['DATE_START'];
        $today_date_plus_15 = $list_mail[0]['DATE_END'];
        $head_text = $list_mail[0]['HEAD_TEXT'];
        $REG_NUM = $list_mail[0]['REG_NUM'];
        $SHORT_TEXT = $list_mail[0]['SHORT_TEXT'];
        $KIND = $list_mail[0]['KIND'];
        $TYPE = $list_mail[0]['TYPE'];
        $DOC_LINK = $list_mail[0]['DOC_LINK'];
        $DESTINATION = $_POST['DESTINATION'];
        
        $CURRENT_STEP = $_POST['CURRENT_STEP'];
        $NEXT_STEP = $_POST['NEXT_STEP'];
        $PREV_STEP = $_POST['PREV_STEP'];
        
        $conn_id = ftp_connect(FTP_SERVER);
        
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        
        if(isset($_POST['RECIPIENT'])){
            require_once ('methods/xmpp.php');
            $jabber = new JABBER();
            
            foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
            {   
                $jabber->send_message("$reciep_mail", "К Вам, от $emp_fio, пришло письмо в системе электронного документооборота, для прочтения, пройдите по ссылке http://192.168.5.244/inbox");
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$mail_id', '$reciep_mail', '0', '$emp_mail', '$DESTINATION')";
                $list_reciep = $db -> Select($sql_reciep);
                
                $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$step_id', NEXT_STEP_ID = '$NEXT_STEP', PREV_STEP_ID = '$CURRENT_STEP' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);
                
                if(isset($_GET['rec_id'])){
                    $rec_id = $_GET['rec_id'];
                    $comment = $_POST['COMMENT'];
                    $sql_upd_state = "update DOC_RECIEPMENTS set STATE = '2', COMMENT_TO_DOC = '$comment', POST_DATE = '$today_date', POST_TIME = '$now_time' where ID = '$rec_id'";
                    $list_upd_state = $db -> Select($sql_upd_state);
                }else{
                    echo 'ID письма отсутствует';
                    exit;
                }
            }
        }
        
        if($DOC_LINK != ''){
            $contents = ftp_nlist($conn_id, "doc_syst/$DOC_LINK/");
        }
    }else{
        $today_date = date('d.m.Y');
        $today_date_plus_15 = date("d.m.Y", mktime(0, 0, 0, date('m'), date('d') + 15, date('Y')));
        
        $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
        $type = $_POST['TYPE'];
        $state = $_POST['STATE'];
        $REG_NUM = $_POST['REG_NUM'];
        $HEAD_TEXT = $_POST['HEAD_TEXT'];
        $SENDER = trim($_POST['SENDER']);
        $SENDER_MAIL = trim($_POST['SENDER_MAIL']);
        $i = 1;
        foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
        {   
            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, POST_DATE, POST_TIME) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$id', '$reciep_mail', '1', '$today_date', '$now_time')";
            $i++;
        }
        $DATE_START = $_POST['DATE_START'];
        $DATE_END = $_POST['DATE_END'];
        $LINK_FROM = $_POST['LINK_FROM'];
        $SHORT_TEXT = $_POST['SHORT_TEXT'];
        $content = $_POST['CONTENT'];
        
        if($LINK_FROM == 0){
            $DOC_LINK = $id;
        }else{
            $DOC_LINK = $LINK_FROM;
        }
        
        $array = array('html'=>$content);
        
        $sql_create_mail = "INSERT INTO DOCUMENTS(ID, TYPE, STATE, REG_NUM, HEAD_TEXT, SENDER, DATE_START, DATE_END, LINK_FROM, SHORT_TEXT, SENDER_MAIL, DOC_LINK, CONTENT) VALUES ($id, '$type', '$state', '$REG_NUM', '$HEAD_TEXT', '$SENDER', '$DATE_START', '$DATE_END', '$LINK_FROM', '$SHORT_TEXT', '$SENDER_MAIL', '$DOC_LINK', :html)";
        
        header('Location: create_mail');
    }
    
    if(isset($_GET['LINKED_DOC'])){
        $linked_doc = $_GET['LINKED_DOC'];
        $sql_doc = "select * from DOCUMENTS where id = '$linked_doc'";
        $list_doc = $db -> Select($sql_doc);
        
        $id = $list_doc[0]['ID'];
        $type = $list_doc[0]['TYPE'];
        $state = $list_doc[0]['STATE'];
        $REG_NUM = $list_doc[0]['REG_NUM'];
        $HEAD_TEXT = $list_doc[0]['HEAD_TEXT'];
        $SENDER = $list_doc[0]['SENDER'];
        $reciepment = $list_doc[0]['RECIPIENT'];
        $DATE_START = $list_doc[0]['DATE_START'];
        $DATE_END = $list_doc[0]['DATE_END'];
        $LINK_FROM = $list_doc[0]['LINK_FROM'];
        $SHORT_TEXT = $list_doc[0]['SHORT_TEXT'];
        $content = $list_doc[0]['CONTENT'];
        
        $contents = ftp_nlist($conn_id, "doc_syst/$id/");
    }
    
?>

