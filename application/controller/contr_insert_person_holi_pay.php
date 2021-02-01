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
    
    $sql_persons = "select triv.ID, dep.NAME DEP_NAME, triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio, dolzh.D_NAME from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep where triv.JOB_POSITION = dolzh.ID and triv.JOB_SP = dep.ID and triv.STATE = 2 order by fio";
    $list_persons = $db -> Select($sql_persons);
    
    
    
        if(isset($_POST['CREATE_TABLE_FOR_ONE_PERS_ID'])){
        
        //создаем табель для нового сотрудника
        $CREATE_TABLE_FOR_ONE_PERS_ID = $_POST['CREATE_TABLE_FOR_ONE_PERS_ID'];
        $period = $_POST['period'];                
                
        $sql_check = "select count(*) c from person_holi_pay where year = $period and emp_id = $CREATE_TABLE_FOR_ONE_PERS_ID";
        $list_check = $db->select($sql_check);       
        
        if($list_check[0]['C'] <= 0) {
        
        $sql = "INSERT INTO PERSON_HOLI_PAY (YEAR, STATE, EMP_ID) VALUES ($period, 0, $CREATE_TABLE_FOR_ONE_PERS_ID)";
        $list_sql = $db->Execute($sql);
        }
        else {
            echo 'Запись уже существует';
            }
            
            
            
    /*        
        foreach($CREATE_TABLE_FOR_ONE_PERS_ID as $t => $v)  
        {      
        $sql = "INSERT INTO PERSON_HOLI_PAY (YEAR, STATE, EMP_ID) VALUES ($period, 0, $v)";
        $list_sql = $db->Execute($sql);
         } 
      */   

    }
    
    
    
    
    
    ?>