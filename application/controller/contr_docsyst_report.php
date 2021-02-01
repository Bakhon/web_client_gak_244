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

    //guys at depart
    if(isset($_POST['dep_id_for_table']))
    {
        $dep_id_for_table = $_POST['dep_id_for_table'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select dolzh.D_NAME, trivial.EMAIL, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and JOB_SP = '$dep_id_for_table' and  trivial.STATE = 6) order by JOB_POSITION";
        if($_POST['branch_id'] != '')
        {
            $branch_id = $_POST['branch_id'];
            $sql_guys = "select dolzh.D_NAME, trivial.EMAIL, trivial.JOB_POSITION, trivial.FIRSTNAME, trivial.MIDDLENAME, trivial.LASTNAME, trivial.ID from sup_person trivial, DIC_DOLZH dolzh where (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 2) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 9) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 4) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 5) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 3) OR (dolzh.ID = trivial.JOB_POSITION and BRANCHID = '$branch_id' and trivial.STATE = 6) order by JOB_POSITION";
        }
        $list_guys = $db -> Select($sql_guys);

        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 373 and ACCOUNT_STATE = '1' order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
    }
?>

