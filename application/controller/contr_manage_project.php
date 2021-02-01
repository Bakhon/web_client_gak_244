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
    
    if(isset($_POST['id_project'])){
        $id_project = $_POST['id_project'];
    }
    
    
    if(isset($_POST['quest'])) {
  //  $db = new DB();
  /*  $name = $_POST['name'];
    $id_project = $_POST['id_project'];
    $id_rasp = $_POST['id_rasp'];
    $sql_add_questions = "Insert into QUESTIONS (id, id_project, name, id_rasp) values (seq_questions.nextval, '$id_project', '$name', '$id_rasp')";
    $list_add_questios = $db -> Select($sql_add_questions);
    
    $sql_result_questions = "INSERT INTO RESULT_QUESTIONS (id, id_quest, name, otvet) VALUES (SEQ_RESULT_QUESTIONS, '$id_quest', '$name', '$otvet')";
    $list_result_questions = $db -> select($sql_result_questions); */
    $quest = $_POST['quest'];
    $ans_1 = $_POST['ans_1'];
    $ans_2 = $_POST['ans_2']; 
    $ans_3 = $_POST['ans_3'];
    $ans_4 = $_POST['ans_4'];
    $db = new DB();
    $sql_quest_project = "INSERT INTO QUESTIONS_PROJECT(ID,QUEST,ANS_1,ANS_2,ANS_3,ANS_4,TRUE_OTVET) VALUES (SEQ_QUESTIONS_PROJECT.NEXTVAL,'$quest','$ans_1', '$ans_2', '$ans_3', '$ans_4', '$true_otvet')";
    $list_quest_project = $db -> Select($sql_quest_project);
    
    $sql_project_quest = "INSERT INTO QUESTIONS(ID, ID_PROJECT, NAME, ID_RASP) VALUES (SEQ_QUESTIONS.NEXTVAL,'$id_project', '$name', '$id_rasp')";
 //   echo $list_quest_project;
 //   exit;
    }
    ?>