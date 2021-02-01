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
        'styles/js/demo/contracts_pa.js'    
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
    
                        
    if(isset($_GET['res_id'])){
        $res_id = $_GET['id'];
    }
    
    if(isset($_GET['project_id']))
    {
    $project_id = $_GET['project_id'];
    }
    else{
        $project_id = $_GET['pid'];
    }
    
                
    $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';                                                            
    $q = $db->Select("select * from sup_person where email = '$em'");       
    $id_user = $q[0]['ID']; 
    $fam_user = $q[0]['LASTNAME'];
    $fam_user1 = $q[0]['FIRSTNAME'];
    $fam_user2 = $q[0]['MIDDLENAME'];
    
     
    $sql_users_res = "select u.id, u.ID_USER, u.ID_QUEST, u.ID_RESULT, u.DATE_OTVET, u.ID_PROJECT, d.name, sp.job_sp  from USERS_RESULT u, sup_person sp, dic_department d where ID_PROJECT = $project_id and sp.id =u.id_user and SP.JOB_SP = d.id ORDER BY ID ASC";
    $list_users_res = $db->select($sql_users_res);
    


     
 /*    foreach($list_users_res as $n => $m) { 
        $dan = $m['ID_USER'];
        $sql_dan = $db->select ("select * from sup_person where id = $dan"); 
        $sup_person_id = $sql_dan[0]['ID'];
                   
    $count_correct_answer = $db->select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER = 1 and u.id_project = $project_id");
    }
            
    $coun_questions = $db->select("select count(*) from Question_p where ID_PROJECT = $project_id"); // Количество вопросов
    
    if($count_correct_answer[0]['COUNT(*)'] == '0') { 
       $count_incorrect_answer = 0;
       }
    else{
    $count_incorrect_answer = $coun_questions[0]['COUNT(*)'] - $count_correct_answer[0]['COUNT(*)'];        
     }
    
    $count_correct_answer_percent = ($count_correct_answer[0]['COUNT(*)']/$coun_questions[0]['COUNT(*)'])*100;
    */
    
    if(isset($_POST['MISS_PERSON_ID'])){
        $pid = $_GET['pid'];
        $person_id = $_POST['MISS_PERSON_ID'];
        $list_res_upd = $db -> select("select u.id_user, d.name, D.SHORT_NAME, d.BRANCH_ID, p.id from USERS_RESULT u, sup_person sp, dic_department d, project p where  u.id_user = $person_id and  u.id_user = sp.id and u.ID_PROJECT = $pid and SP.JOB_SP = d.id and u.id_project = p.id group by u.id_user, d.name, d.short_name, d.BRANCH_ID, p.id order by d.name");
       // header("location: /");                                
    }
    
    foreach($list_users_res as $n => $m) {
                $dan = $m['ID_USER'];
                $sql_dan = $db->select("select * from sup_person where id = $dan");
                $sup_person_id = $sql_dan[0]['ID'];  }
    
    $sql_list_project = "select * from Project where emp_id = $id_user order by id";
    $list_project = $db->Select($sql_list_project); 
    
    $sql_dic_department = "select * from DIC_DEPARTMENT order by id ";
    $list_department = $db -> select($sql_dic_department);
    
    $list_person = $db->select("select sp.id, sp.lastname, sp.firstname, sp.middlename from USERS_RESULT u, sup_person sp where u.ID_PROJECT = $project_id and u.id_user = sp.id group by sp.id, sp.lastname, sp.firstname, sp.middlename order by sp.lastname");
    
    

    $list_res = $db -> select("select u.id_user, d.name, d.BRANCH_ID, p.id from USERS_RESULT u, sup_person sp, dic_department d, project p where u.id_user = sp.id and u.ID_PROJECT = $project_id and SP.JOB_SP = d.id and u.id_project = p.id and D.BRANCH_ID = '0' group by u.id_user, d.name, d.BRANCH_ID, p.id order by d.name");
  
      $list_res1 = $db -> select("select u.id_user, d.name, p.id from USERS_RESULT u, sup_person sp, dic_department d, project p where u.id_user = sp.id and  u.ID_PROJECT = $project_id and SP.JOB_SP = d.id and u.id_project = p.id group by u.id_user, d.name, p.id");
      if(isset($_GET['project_id']))   {
      $list_res_upd = $db -> select("select u.id_user, d.name, D.SHORT_NAME, d.BRANCH_ID, p.id from USERS_RESULT u, sup_person sp, dic_department d, project p where u.id_user = sp.id and u.ID_PROJECT = $project_id and SP.JOB_SP = d.id and u.id_project = p.id and D.BRANCH_ID = '0000' group by u.id_user, d.name, d.short_name, d.BRANCH_ID, p.id order by d.name");
            }
    ?>