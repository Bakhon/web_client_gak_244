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
    
    $list_curators = $db->select("select * from sup_person where job_sp in (14, 23) and state = 2");

    //сотрудники
    $sql_persons = "select triv.ID, dep.NAME DEP_NAME, triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio, dolzh.D_NAME from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep where triv.JOB_POSITION = dolzh.ID and triv.JOB_SP = dep.ID and triv.state in (2,6,9,4)  order by fio";
    $list_persons = $db -> Select($sql_persons);
    
    $list_guy = '';
    $list_guys  = '';
    $timesheet_date_start = '';
    $timesheet_date_end = '';
    $dep_id_for_table = '';
    $curatots_pos = '';
    $dep_name = '';
    
    if(isset($_POST['curid']))
    {
    $curid = $_POST['curid'];
    $list_cur = $db->select("select s.lastname, substr(s.middlename, 1, 1) middlename , substr(s.firstname, 1 ,1) firstname, D.D_NAME from sup_person s, dic_dolzh d where s.id = $curid and S.JOB_POSITION = d.id");
    $cur_pos = $list_cur[0]['D_NAME'];
    $curlastname  = $list_cur[0]['LASTNAME'];
    $curfirstname =  $list_cur[0]['FIRSTNAME']; 
    $curmiddlename =  $list_cur[0]['MIDDLENAME'];
    }
    
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
    
    


    //guys at depart
    if(isset($_POST['curid']))
    {
        $curid = $_POST['curid'];        
       // $dep_id_for_table = $_POST['dep_id_for_table'];
        
      //  $list_dp = $db->select("select name from DIC_DEPARTMENT where id = $dep_id_for_table");
        $name_dep = $list_dp[0]['NAME'];
        
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
      //  $sql_guys = "select s.*, d.id id_dp, d.name, d.SHORT_NAME , C.CURATORS_ID, C.DEP_ID, dolzh.id dolzhid,  DOLZH.D_NAME from sup_person s, dic_department d, curators c, dic_dolzh dolzh where S.JOB_SP = d.id and d.id = C.DEP_ID and C.CURATORS_ID = $curid and s.state in (2,3.5, 4, 9 ,6) and S.JOB_POSITION = dolzh.id order by c.dep_id, dolzh.id ASC";
        $sql_guys = "select s.*, s.branchid,
case when  s.branchid = '0000' then job_sp_name(s.job_sp) else BRANCH_name(s.branchid) end podrazd_name,
d.id id_dp, d.name, d.SHORT_NAME , C.CURATORS_ID, C.DEP_ID, dolzh.id dolzhid,  DOLZH.D_NAME 
from sup_person s, dic_department d, curators c, dic_dolzh dolzh where S.JOB_SP = d.id and d.id = C.DEP_ID 
and C.CURATORS_ID = $curid and s.state in (2,3, 5, 4, 9 ,6)
 and S.JOB_POSITION = dolzh.id order by podrazd_name,  s.branchid, dolzh.id ASC";
       // $sql_guys = "select dolzh.D_NAME, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 6) order by JOB_POSITION";
   /*     if($_POST['branch_id'] != '')
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
        } */
        
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
    }



    //holidays
    if(isset($_POST['holyday_date'])){
        $holyday_date = $_POST['holyday_date'];
        $change_val = $_POST['change_val'];
        $value = $_POST['holyday_val'];
        $sql_holy = "update table_other set value = '$value' where EMP_ID in (select ID from sup_person where state = 2) and DAY_DATE = '$holyday_date' and value = '$change_val'";
        $list_upd_val = $db -> Select($sql_holy);
    }






    

?>

