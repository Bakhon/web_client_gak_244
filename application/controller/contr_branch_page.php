<?php
    $db = new DB();
    $branch_id = $_GET['branch_id'];

    if(isset($_POST['DIRECTOR_ID']))
    {
        $id = $_POST['ID'];
        $branch_id = $_POST['branch_id'];
        $DIRECTOR_ID = $_POST['DIRECTOR_ID'];
        $DEPUTY_ID = $_POST['DEPUTY_ID'];
        $sql = "update DIC_BRANCH set CHIEF_ID = '$DIRECTOR_ID' where RFBN_ID = $branch_id";
        $list = $db -> Execute($sql);
    }

    if(isset($_POST['DEPUTY_ID']))
    {
        $id = $_POST['ID'];
        $branch_id = $_POST['branch_id'];
        $DEPUTY_ID = $_POST['DEPUTY_ID'];
        $DIRECTOR_ID = $_POST['DIRECTOR_ID'];
        $sql = "update DIC_BRANCH set ID_DEPUTY = '$DEPUTY_ID' where RFBN_ID = $branch_id";
        $list = $db -> Execute($sql);
    }

    if(isset($_POST['DIC_DEPARTMENT']))
    {
        $branch_id = $_GET['branch_id'];
        $NAME_KAZ = $_POST['NAME_KAZ'];
        $NAME = $_POST['NAME'];
        $BRANCH_ID = $_POST['BRANCH_ID'];
        $sql = "update DIC_BRANCH set NAME_KAZ = '$NAME_KAZ', NAME = '$NAME', BRANCH_ID = '$BRANCH_ID' where RFBN_ID = $branch_id";
        $list_dep = $db -> Execute($sql);
    }

    if(isset($_GET['branch_id']))
    {
        $branch_id = $_GET['branch_id'];
        $sql_dep = "select branch.* from DIC_BRANCH branch where branch.RFBN_ID = $branch_id";
        $list_dep = $db -> Select($sql_dep);
    }

    $sql = "select ID, SUBSTR(FIRSTNAME, 1, 1) || '. ' || SUBSTR(MIDDLENAME, 1, 1) || '. ' || LASTNAME FIO from sup_person where JOB_SP = 14 order by id";
    $list_chiefs = $db -> Select($sql);

    $sql = "select ID, LASTNAME || ' ' || FIRSTNAME || ' ' || MIDDLENAME  FIO from sup_person where STATE = '2' order by LASTNAME";
    $list_pers = $db -> Select($sql);
    
    $sql = "select * from DIC_BRANCH order by NAME";
    $list_branch_list = $db -> Select($sql);

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
?>

