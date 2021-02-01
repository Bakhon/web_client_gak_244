<?php
    $db = new DB();
    
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
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js'
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
    
        $sql_list_project = "select * from PROJECT order by id";
        $list_project = $db -> Select($sql_list_project);
    
    if($_GET['proj_id'])
    {
        $id_project = $_GET['proj_id'];
        
        $sql_question = "select * from QUESTION_P where ID_PROJECT = $id_project";
        $list_question = $db -> Select($sql_question);
        
        $que = "select * From Question_p q where ID_PROJECT = $id_project";
        $l_que = $db -> select($que);
        
        foreach($l_que as $k => $v)
        {
            $q_id = $v['ID'];
        //    $ques_by_id = "select * From Question_p where ID = $q_id";
        //    $l_ques_by_id = $db -> select($ques_by_id);
        //    echo $v['QUESTION'];
        //    echo '<br>';                        
            $options = "select * From RESULT_P where ID_QUESTION = $q_id";
            $l_options = $db -> select($options);
            foreach($l_options as $q => $r)
            {
           //     echo $r['ANSWER'];
          //      echo '//';
            }
          //  echo '<br>';
        //    echo '<br>';
        }
    } 
 
 ?>