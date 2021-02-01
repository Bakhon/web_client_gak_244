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
    
    $emp_id = $_SESSION[USER_SESSION]['uid'];
    $result = array();
     
    $db = new DB();
    $sql_list_project = "select * from PROJECT where emp_id = $emp_id order by id";
    $list_project = $db -> Select($sql_list_project);
    
    foreach($list_project as $k=>$v){        
        $sql_question = "select * from QUESTION_P where id_project = ".$v['ID']." order by id";
        $list_question = $db -> Select($sql_question);
        
        foreach($list_question as $l=>$q)
        {
            
        }
        
        $list_project[$k]['list_question'] = $list_question;
    }
    
//    $sql_QUEST_RASP = "select * from QUEST_RASP order by id";
//    $list_QUEST_RASP = $db -> Select($sql_QUEST_RASP);

    $sql_RESULT_QUEST = "select * from RESULT_P order by id";
    $list_RESULT_QUEST = $db -> Select($sql_RESULT_QUEST);

    //$sql_question = "select * from QUESTION_P order by id";
    //$list_question = $db -> Select($sql_question);

    
    if(isset($_POST['id_p'])) 
    {
           $id = $_POST['id_p'];
           $id_project = $_POST['name'];
           $name_rasp = $_POST['name_rasp'];
                           
           $sql_ad = "Insert into QUESTION_P(ID, ID_PROJECT, QUESTION) values (SEQ_QUEST.NEXTVAL, '$id', '$name_rasp')";
           $list_ad = $db -> execute($sql_ad);

     }

     if(isset($_POST['ans']))
     {
        $id_quest = $db -> select("select * from (select * from QUESTION_P order by ID desc) where rownum = 1");
       
        
        foreach($id_quest as $kk => $vv) {
            $z = $vv['ID'];
        }       
        foreach($_POST['ans'] as $k => $m)
        {
            $sql_add_options = "Insert into RESULT_P(ID, ID_QUESTION, ANSWER) values (SEQ_RES.NEXTVAL, '$z', '$m')";
            $list_add_options = $db -> execute($sql_add_options);
        }
     }
 ?>
 
 