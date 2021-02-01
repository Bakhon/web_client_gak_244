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

    //департаменты
    $sqlDepartments = "select * from DIC_Department order by id";
    $listDepartments = $db -> Select($sqlDepartments);

    //филиалы
    $sql_branch_name = "select RFBN_ID, NAME from DIC_BRANCH where ASKO is NULL";
    $list_branch_name = $db->Select($sql_branch_name);

    //статусы сотрудников
    $sqlState = "select * from DIC_PERSON_STATE order by id";
    $listState = $db -> Select($sqlState);

    //сотрудники
    $sql_persons = "select triv.ID, dep.NAME DEP_NAME, triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio, dolzh.D_NAME from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep where triv.JOB_POSITION = dolzh.ID and triv.JOB_SP = dep.ID and triv.state in (2,3,6,9,4)  order by fio";
    $list_persons = $db -> Select($sql_persons);
    
    $list_guy = '';
    $list_guys  = '';
    $timesheet_date_start = '';
    $timesheet_date_end = '';
    $dep_id_for_table = '';
    $curatots_pos = '';
    $dep_name = '';
   /* 
        $mail = trim($_SESSION['insurance']['other']['mail'][0]);
    $sql_for_init = "select * from sup_person where EMAIL = '$mail' and STATE = '2'";
    $list_sql_for_init = $db -> Select($sql_for_init);
    $dep_id = $list_sql_for_init[0]['JOB_SP'];
    
        $sql_for_cur = "select dolzh.D_NAME, SUBSTR(trivial.FIRSTNAME, 1, 1) ||'. '|| SUBSTR(trivial.MIDDLENAME, 1, 1) ||'. '|| TRIVIAL.LASTNAME FIO from curators cur, sup_person trivial, DIC_DOLZH dolzh where TRIVIAL.ID = CUR.CURATORS_ID and DOLZH.ID = TRIVIAL.JOB_POSITION and CUR.DEP_ID = $dep_id order by JOB_POSITION";
    $list_for_cur = $db -> Select($sql_for_cur);
    
    
        $curator = $list_for_cur[0]['FIO'];
    $curatots_pos = $list_for_cur[0]['D_NAME'];
    $director = $list_for_dir[0]['FIO'];
    $dep_name = $list_for_dep_name[0]['NAME'];
    $accepter_pos = $list_for_dir[0]['D_NAME'];  */
    
    
    
    //update between date
    if(isset($_POST['UPDATE_TABLE_FOR_ONE_PERS_ID']))
    {
        $pers_id = $_POST['UPDATE_TABLE_FOR_ONE_PERS_ID'];
        $table_val = $_POST['val_between'];
        $val_start_day = $_POST['val_start_day'];
        $val_end_day = $_POST['val_end_day'];
        $sql_upd_val = "update TABLE_OTHER SET VALUE = '$table_val' where EMP_ID = '$pers_id' and DAY_DATE between '$val_start_day' and '$val_end_day'";
        $list_upd_val = $db -> Select($sql_upd_val);

        if(isset($_POST['holi_set']))
        {
            set_all_holi($pers_id, $val_start_day, $val_end_day);
        }
    }

    //guys at depart
    if(isset($_POST['dep_id_for_table']))
    {
        $dep_id_for_table = $_POST['dep_id_for_table'];
        
        $list_dp = $db->select("select name from DIC_DEPARTMENT where id = $dep_id_for_table");
        $name_dep = $list_dp[0]['NAME'];
        
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 6) order by JOB_POSITION";
        if($_POST['branch_id'] != '')
        {
            $branch_id = $_POST['branch_id'];
            //$sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 6) order by JOB_POSITION";
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
            order by 2";
        }
        
        $list_guys = $db -> Select($sql_guys);

        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 and ACCOUNT_STATE = '1' order by DAY_DATE";
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
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 2 OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 6) order by JOB_POSITION";
        if($dep_id_for_table == '')
        {
            $branch_id = $_POST['branch_id_up'];
            
            //$sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 6) order by JOB_POSITION";
            $sql_guys = "select 
                dolzh.D_NAME, 
                trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID 
            from sup_person trivial, 
            DIC_DOLZH dolzh 
            where 
            dolzh.ID = trivial.JOB_POSITION 
            and BRANCHID = '$branch_id' 
            and trivial.STATE in(2, 9, 4, 5, 3, 6)
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
            order by 2";
        }
        
        $list_guys = $db -> Select($sql_guys);

        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 1481 and ACCOUNT_STATE = '1' order by DAY_DATE";        
        $list_guy = $db -> Select($sql_guy);
    }

    //create table
    if(isset($_POST['CREATE_TABLE_FOR_ONE_PERS_ID'])){
        //создаем табель для нового сотрудника
        $CREATE_TABLE_FOR_ONE_PERS_ID = $_POST['CREATE_TABLE_FOR_ONE_PERS_ID'];
        $work_start_day = $_POST['work_start_day'];
        
        $post_day_list = explode('.', $work_start_day);
        $post_day = $post_day_list[0];
        
        $post_withuot_day = '.'.$post_day_list[1].'.'.$post_day_list[2];
        create_other_table("$post_withuot_day", $CREATE_TABLE_FOR_ONE_PERS_ID, $post_day);
        
        for($i = $post_day_list[1]+1; $i <= 12; $i++){
            if($i<10){
                $post_withuot_day = '.0'.$i.'.'.$post_day_list[2];
                create_other_table_for_this_year("$post_withuot_day", $CREATE_TABLE_FOR_ONE_PERS_ID, '01');
            }else{
                $post_withuot_day = '.'.$i.'.'.$post_day_list[2];
                create_other_table_for_this_year("$post_withuot_day", $CREATE_TABLE_FOR_ONE_PERS_ID, '01');
            }
        }
    }

    //holidays
    if(isset($_POST['holyday_date'])){
        $holyday_date = $_POST['holyday_date'];
        $change_val = $_POST['change_val'];
        $value = $_POST['holyday_val'];
        $sql_holy = "update table_other set value = '$value' where EMP_ID in (select ID from sup_person where state = 2) and DAY_DATE = '$holyday_date' and value = '$change_val'";
        $list_upd_val = $db -> Select($sql_holy);
    }

    //functions
    function create_other_table($date_my, $emp_id, $start_date)
    {
        for($i = 1; $i <= date("t",strtotime('01'.$date_my)); $i++)
            {
                if($start_date < 10){
                    $start_date = str_replace('0', '', $start_date);
                }
                $db = new DB();
                $weekend = date("w",strtotime($i.$date_my));
                if($i < $start_date)
                    {
                        $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', ' ', '$emp_id', '$i$date_my', 1)";
                        $list_sql = $db->Execute($sql);
                    }
                else
                    {
                        if($weekend==0 || $weekend==6)
                            {
                                $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', 'В', '$emp_id', '$i$date_my', 1)";
                                $list_sql = $db->Execute($sql);
                            }
                        else 
                            {
                                $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', '8', '$emp_id', '$i$date_my', 1)";
                                $list_sql = $db->Execute($sql);
                            }
                    }
            }
    }

    function create_other_table_for_this_year($date_my, $emp_id, $start_date)
    {
        for($i = 1; $i <= date("t",strtotime('01'.$date_my)); $i++)
            {
                if($start_date < 10){
                    $start_date = str_replace('0', '', $start_date);
                }
                $db = new DB();
                $weekend = date("w",strtotime($i.$date_my));

                if($weekend==0 || $weekend==6)
                    {
                        $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', 'В', '$emp_id', '$i$date_my', 1)";
                        $list_sql = $db->Execute($sql);
                    }
                else 
                    {
                        $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', '8', '$emp_id', '$i$date_my', 1)";
                        $list_sql = $db->Execute($sql);
                    }
            }
    }

    //добавляет выходные
    function set_all_holi($emp_id, $date_event_start, $date_event_end)
    {
        $db = new DB();
        $sql_all_holi_between_two_date = "select DATE_HOL from HOLIDAYS where DATE_HOL between '$date_event_start' and '$date_event_end'";
        $list_all_holi_between_two_date = $db -> Select($sql_all_holi_between_two_date);

        foreach($list_all_holi_between_two_date as $k => $v)
        {
            $DATE_HOL = $v['DATE_HOL'];
            $sql_change_day_state = "update TABLE_OTHER set VALUE = 'В' where EMP_ID = '$emp_id' and DAY_DATE = '$DATE_HOL'";
            $list_change_day_state = $db -> Execute($sql_change_day_state);
        }
    }
    

?>

