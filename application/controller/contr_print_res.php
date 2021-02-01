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
        'styles/css/plugins/select2/select2.min.css',
        'styles/css/pagination.css',
        'styles/css/animate.css'
    );
    
    
    
    
    if($_GET['proj_id'])
    {
        $id_project = $_GET['proj_id'];
                
        $que = "select * from (select * from question_p order by dbms_random.value ) where rownum <= 20 and id_project = $id_project ";
        $l_que = $db -> select($que);
        
        foreach($l_que as $k => $v)
        {
            $q_id = $v['ID'];
                       
            $options = "select * From RESULT_P where ID_QUESTION = $q_id";
            $l_options = $db -> select($options);
            foreach($l_options as $q => $r)
            {
            }
        }                 
      if(isset($_POST['endtest'])){
          $dan = $_POST;
          unset($dan['endtest']);
          foreach($dan as $k=>$v){
          
          $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
          $q = $db->Select("select * from sup_person where email = '$em'"); 
           
           $id_user = $q[0]['ID'];
          
           $sql_insert = "Insert into USERS_RESULT(ID, ID_USER, ID_QUEST, ID_RESULT, ID_PROJECT) Values (SEQ_USERS_RESULT.NEXTVAL,'$id_user','$k','$v','$id_project')";
           $list_insert_users_res = $db -> execute($sql_insert);
           
               $sql_prav_otvet = "select count(*) c from result_p r, question_p q, users_result u where q.id = u.ID_QUEST and r.id = U.ID_RESULT and r.correct_answer = 1 and q.id_project = $id_project";
               $list_prav_otvet = $db -> Select($sql_prav_otvet);            

               
               $sql_neprav_otvet = "select count(*) c from result_p r, question_p q, users_result u where q.id = u.ID_QUEST and r.id = U.ID_RESULT and r.correct_answer != 1 and q.id_project = $id_project";
               $list_neprav_otvet = $db -> Select($sql_neprav_otvet);     
           
           
               $aql_users_res = "select * from USERS_RESULT where ID_USER = $id_user";
               $list_users_res = $db->select($aql_users_res);
    
               $sql_count = "select count(Question) q from Question_p where ID_PROJECT = $id_project";
               $list_count = $db->select($sql_count);         
               
               echo $list_count[0]['Q'];
               
               
               $sql_name_project = "select name from Project where id = $id_project";
               $list_name_project = $db->Select($sql_name_project);   
               
               $res_percent = round(($list_prav_otvet[0]['C']/$list_count[0]['Q'])*100, 2); 
               }    
               
           //   header("Location: /");                                                            
     }                                  
 }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    ?>