<?php
// $coun_questions = 15;
      $p_id =  $_GET['project_id'];
      $coun_questions = $db->select("select count(*) from Question_p where ID_PROJECT = $p_id");
  //    print_r($coun_questions);
      $coun_questionss = $coun_questions[0]['COUNT(*)'];
     $user_id = $_GET['user_id'];
     if($p_id == 300) {
        $coun_questionss = 40;
     }
$count_correct_answer = $db->select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $user_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER = 1 and u.id_project = $p_id");
$count_incorrect_answer = $db -> select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $user_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER != 1 and u.id_project = $p_id");
 $count_correct_answer_percent = ($count_correct_answer[0]['COUNT(*)']/$coun_questionss)*100;  
 
   $sql_dan = $db->Select("select * from sup_person where id = $user_id");
 
?>


<div class="row">
    <div class="col-lg-12" id="osn-panel">   
            <div class="ibox-title"><h3 align="center">Результаты тестирования сотрудника "<?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?>" </h3>
            </div>
            <div class="ibox-content">
            <div class="row">
            <div class="col-md-6">
                            <div class="form-group col-md-6">
                              <p>Количество вопросов:&nbsp;<?php echo $coun_questionss ?></p>
                            </div>
                            
                            <div class="form-group col-md-6">
                                 <p>Количество правильных: &nbsp; <?php echo $count_correct_answer[0]['COUNT(*)']; ?></p>
                            </div>
            </div>
            
                     <div class="col-md-6">
                            <div class="form-group col-md-6">
                              <p>Количество неправильных ответов: &nbsp;<?php echo $count_incorrect_answer[0]['COUNT(*)'] ?></p>
                            </div>
                            
                            <div class="form-group col-md-6">
                                  <p>Количество правильных ответов в(%): &nbsp;<?php echo round($count_correct_answer_percent) ?></p>
                            </div>
                        </div>                                                                       
            </div>  
          </div>                                              
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                     <!--   <th>Сотрудник</th> -->
                        <th>Вопрос </th>
                        <th>Ваш ответ</th>   
                        <th>Правильный ответ</th> 
                      <!--  <th>Департамент</th> -->                                          
                    </tr>
                </thead>
        <tbody> 
     <?php  
     $p_id =  $_GET['project_id'];
     $user_id = $_GET['user_id'];
     
    // $list_up = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER from users_result u, question_p q, result_p r where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $project_id ORDER BY ID ASC");
       $list_up2 = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER, r.correct_answer, d.name, d.id id_dep, d.short_name from users_result u, question_p q, result_p r, sup_person sp, dic_department d where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $p_id and u.id_user = $user_id and sp.id = u.id_user and SP.JOB_SP = d.id ORDER BY id ASC");
       
       
       
       foreach($list_up2 as $t=>$y) {
                $z = $y['ID_QUEST'];
                $list_correct = $db -> select("select res.id, res.answer from users_result u, question_p q, result_p res, project p where u.id_project = p.id and p.id = $p_id and res.id_question = q.id and u.id_quest = $z and u.id_quest = q.id  and q.id_project = p.id and res.correct_answer = 1 group by RES.ANSWER, res.id");                                 
                $dan = $y['ID_USER'];
                $sql_dan = $db->select("select s.lastname, substr(s.firstname, 1, 1) fname from sup_person s where id = $dan");                
            
               $correct_ans = $y['CORRECT_ANSWER'];
               if($correct_ans == '0')
               {
                $class = 'danger';
               } else { $class ='';}
        ?>   
         <tr class="<?php echo $class; ?>">                          
                <td>
                     <?php echo $y['QUESTION']; ?>
                </td>
                <td > 
                     <em> <?php echo $y['ANSWER']; ?> </em>
                </td> 
                <td >
              <?php echo $list_correct[0]['ANSWER']; ?>
                </td>   
           <!--     <td>
                     <?php echo $y['SHORT_NAME']; ?>
                </td> -->
        </tr> 
            <?php }  ?>    
        </tbody>  
        </table>               
        </div>
    </div>
</div>
 