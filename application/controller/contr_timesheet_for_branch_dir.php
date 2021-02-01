<?php
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
        'styles/css/plugins/select2/select2.min.css'
    );

    $db = new DB();
    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');
    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];

    $mail = trim($_SESSION['insurance']['other']['mail'][0]);
    $sql_for_init = "select * from sup_person where EMAIL = '$mail' and state = 2";
    $list_sql_for_init = $db -> Select($sql_for_init);
    $dep_id = $list_sql_for_init[0]['JOB_SP'];
    $branch_id = $list_sql_for_init[0]['BRANCHID'];
    
        $list_guy = '';
    $list_guys  = '';
    $timesheet_date_start = '';
    $timesheet_date_end = '';
    $dep_id_for_table = '';
    $curatots_pos = '';
    $dep_name = '';

    //департаменты
    $sqlDepartments = "select * from DIC_Department order by id";
    $listDepartments = $db -> Select($sqlDepartments);

    //филиалы
    $sql_branch_name = "select RFBN_ID, NAME from DIC_BRANCH where ASKO is NULL";
    $list_branch_name = $db->Select($sql_branch_name);

    //статусы сотрудников
    $sqlState = "select * from DIC_PERSON_STATE order by id";
    $listState = $db -> Select($sqlState);

    //отправляем в документооборот уведомление
    if(isset($_POST['MIS_DESCRIPTION']))
    {
        $MIS_DESCRIPTION = $_POST['MIS_DESCRIPTION'];
        $MIS_DATE = $_POST['MIS_DATE'];
        $AUTHOR_EMP_ID = $_POST['AUTHOR_EMP_ID'];
        $CRITICAL_LEVEL = $_POST['CRITICAL_LEVEL'];
        $sql_mistake = "insert into MISTAKES (ID, MIS_DATE, AUTHOR_EMP_ID, CRITICAL_LEVEL, DESCRIPTION) values (SEQ_MISTAKES.nextval, '$MIS_DATE', '$AUTHOR_EMP_ID', '$CRITICAL_LEVEL', '$MIS_DESCRIPTION')";
        $list_mistake = $db -> Execute($sql_mistake);
        
        require_once ('methods/xmpp.php');
        $jabber = new JABBER();
        $jabber->send_message("b.abdisamat@gak.kz", "$MIS_DESCRIPTION");
        $sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
        $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$id', 'i.akhmetov@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '6')";
        $list_reciep = $db -> Select($sql_reciep);
        $sql_create_mail = "INSERT INTO DOCUMENTS(ID, TYPE, STATE, REG_NUM, HEAD_TEXT, SENDER, SENDER_MAIL, DATE_START, DATE_END, LINK_FROM, SHORT_TEXT, KIND, DOC_LINK) VALUES 
                                                ($id, '6', '0', '', 'Ошибке в СУП (уровень критичности $CRITICAL_LEVEL)', '$AUTHOR_EMP_ID', '$emp_mail', '$MIS_DATE', '$MIS_DATE', '', '$MIS_DESCRIPTION', '11', '0')";
        $list_reciep_mail = $db -> Select($sql_create_mail);

        $branch_id = $_POST['branch_id_mis'];
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];

        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 6) order by JOB_POSITION";
        $list_guys = $db -> Select($sql_guys);

        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
    }

    //табель с данными
    if(isset($_POST['branch_id']))
    {
        $dep_id_for_table = $_POST['dep_id_for_table'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 6) order by JOB_POSITION";
        if($_POST['branch_id'] != 0000)
        {
            $branch_id = $_POST['branch_id'];
            //$sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 6) order by JOB_POSITION";
            $sql_guys = "select 
                    dolzh.D_NAME, 
                    trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID 
                from sup_person trivial, 
                DIC_DOLZH dolzh 
                where 
                dolzh.ID = trivial.JOB_POSITION 
                and BRANCHID = '$branch_id' 
                and trivial.STATE in(2, 9, 4, 5, 3, 6)   
                and (trivial.DATE_POST < '$timesheet_date_start' or trivial.DATE_POST < '$timesheet_date_end')             
                order by 2";
            $dep_id_for_table = '';
        }
        
        
        /*
        union all
                select 
                    dolzh.D_NAME, 
                    trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID        
                from sup_person trivial, 
                DIC_DOLZH dolzh 
                where 
                dolzh.ID = trivial.JOB_POSITION 
                and BRANCHID = '$branch_id' 
                and trivial.STATE = 7 
                and TRIVIAL.DATE_LAYOFF between to_date('$timesheet_date_start', 'dd.mm.yyyy') and to_date('$timesheet_date_end', 'dd.mm.yyyy')
        
        */
        
        $list_guys = $db -> Select($sql_guys);        
        
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
    }

    //табель на одного человека
    if(isset($_POST['MISS_PERSON_ID']))
    {
        $MISS_PERSON_ID = $_POST['MISS_PERSON_ID'];
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where trivial.ID = '$MISS_PERSON_ID' and dolzh.ID = TRIVIAL.JOB_POSITION";
        $list_guys = $db -> Select($sql_guys);
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
    }

    if(isset($_POST['id_table']))
    {
        //обновляем данные
        $table_id = $_POST['id_table'];
        $table_val = $_POST['table_state'];
        $sql_upd_val = "update TABLE_OTHER SET VALUE = '$table_val' where id = $table_id";
        $list_upd_val = $db -> Select($sql_upd_val);
        
        $dep_id_for_table = $_POST['dep_id_for_table_up'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 6) order by JOB_POSITION";
        if($dep_id_for_table == 0000)
        {
            $branch_id = $_POST['branch_id_up'];
            $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and  trivial.STATE = 6) order by JOB_POSITION";
            $dep_id_for_table = '';
        }
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);

        $list_guys = $db -> Select($sql_guys);
    }

    $sql_branch_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id'";
    $list_branch_guys = $db -> Select($sql_branch_guys);

    $sql_for_dir = "select DOLZH.D_NAME, SUBSTR(pers.FIRSTNAME, 1, 1) ||'. '|| SUBSTR(pers.MIDDLENAME, 1, 1) ||'. '|| pers.LASTNAME FIO from SUP_PERSON pers, DIC_DOLZH dolzh where DOLZH.ID = PERS.JOB_POSITION and pers.EMAIL = '$mail'";                        
    $list_for_dir = $db -> Select($sql_for_dir);

    $sql_for_branch_name = "select * from DIC_BRANCH where RFBN_ID = '$branch_id'";
    $list_for_branch_name = $db -> Select($sql_for_branch_name);

  //  $curator = "Амерходжаев Г. Т.";
  //  $curatots_pos = "Председатель Правления";
    $curator = "Акажанов А. А.";
    $curatots_pos = "Заместитель Председателя Правления";
    $director = $list_for_dir[0]['FIO'];
    $dep_name = $list_for_branch_name[0]['NAME'];
    $accepter_pos = $list_for_dir[0]['D_NAME'];
?>