<?php
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
        'styles/css/plugins/select2/select2.min.css'
    );    

    
    $db = new DB();
    
    //табель
    $sql_timesheet = "select * from TABLE_OTHER order by WEEK_DAY";
    $list_timesheet = $db -> Select($sql_timesheet);
    
    //департаменты
    $sqlDepartments = "select * from DIC_Department order by id";
    $listDepartments = $db -> Select($sqlDepartments);
    
    //филиалы
    $sql_branch_name = "select RFBN_ID, NAME from DIC_BRANCH where ASKO is NULL";
    $list_branch_name = $db->Select($sql_branch_name);
    
    //статусы сотрудников
    $sqlState = "select * from DIC_PERSON_STATE order by id";
    $listState = $db -> Select($sqlState);
    
    //guys at depart
    if(isset($_POST['dep_id_for_table']))
    {
        $dep_id_for_table = $_POST['dep_id_for_table'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and  trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and trivial.STATE = 4) order by JOB_POSITION";
        if($_POST['branch_id'] != 0){
            $branch_id = $_POST['branch_id'];
            $sql_guys = "select LASTNAME,ID from sup_person";
            $dep_id_for_table = '';
        }
        //echo $sql_guys;
        $list_guys = $db -> Select($sql_guys);
        
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 373 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
        //echo $sql_guy;
    }
    
    if(isset($_POST['id_table'])){
        //обновляем данные
        $table_id = $_POST['id_table'];
        $table_val = $_POST['table_state'];
        $sql_upd_val = "update TABLE_OTHER SET VALUE = '$table_val' where id = $table_id";
        $list_upd_val = $db -> Select($sql_upd_val);
        
        $dep_id_for_table = $_POST['dep_id_for_table_up'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where dolzh.ID = trivial.JOB_POSITION and trivial.STATE = 2 order by JOB_POSITION";
        if($dep_id_for_table == 0){
            $branch_id = $_POST['branch_id_up'];
            $sql_guys = "select LASTNAME,ID from sup_person";
            $dep_id_for_table = '';
        }
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 373 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
        
        $list_guys = $db -> Select($sql_guys);
    }
    
    $db = new DB();
    
    $mail = trim($_SESSION['insurance']['other']['mail'][0]);
    $sql_for_init = "select * from sup_person where EMAIL = '$mail'";
    $list_sql_for_init = $db -> Select($sql_for_init);
    $dep_id = $list_sql_for_init[0]['JOB_SP'];
    $branch_id = $list_sql_for_init[0]['BRANCHID'];
    
    
    $sql_for_cur = "select dolzh.D_NAME, SUBSTR(trivial.FIRSTNAME, 1, 1) ||'. '|| SUBSTR(trivial.MIDDLENAME, 1, 1) ||'. '|| TRIVIAL.LASTNAME FIO from curators cur, sup_person trivial, DIC_DOLZH dolzh where TRIVIAL.ID = CUR.CURATORS_ID and DOLZH.ID = TRIVIAL.JOB_POSITION and CUR.DEP_ID = $dep_id_for_table";
    $list_for_cur = $db -> Select($sql_for_cur);
    
    $sql_for_dir = "select SUBSTR(trivial.FIRSTNAME, 1, 1) ||'. '|| SUBSTR(trivial.MIDDLENAME, 1, 1) ||'. '|| TRIVIAL.LASTNAME FIO from DIC_CHIEFS chiefs, sup_person trivial where TRIVIAL.ID = chiefs.ID_DIR and chiefs.ID_DEPARTMENT = $dep_id";                        
    $list_for_dir = $db -> Select($sql_for_dir);
    
    $sql_for_dep_name = "select * from DIC_DEPARTMENT where ID = '$dep_id_for_table'";
    $list_for_dep_name = $db -> Select($sql_for_dep_name);
    
    $curator = $list_for_cur[0]['FIO'];
    $curatots_pos = $list_for_cur[0]['D_NAME'];
    $director = $list_for_dir[0]['FIO'];
    $dep_name = $list_for_dep_name[0]['NAME'];
?>