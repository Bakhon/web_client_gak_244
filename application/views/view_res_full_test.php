<div class="row">
    <div class="col-lg-12" id="osn-panel">   
            <div class="ibox-title"><h3 align="center">Результаты тестирования сотрудника <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?>  </h3>
            </div>                                      
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>Сотрудник</th>
                        <th>Вопрос </th>
                        <th>Ответ сотрудника</th>   
                        <th>Правильный ответ</th> 
                        <th>Департамент</th>                       
                    </tr>
                </thead>
        <tbody> 
     <?php  
     $p_id =  $_GET['project_id'];
     $user_id = $_GET['user_id'];
     
    // $list_up = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER from users_result u, question_p q, result_p r where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $project_id ORDER BY ID ASC");
       $list_up2 = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER, d.name, d.id id_dep from users_result u, question_p q, result_p r, sup_person sp, dic_department d where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $p_id and u.id_user = $user_id and sp.id = u.id_user and SP.JOB_SP = d.id ORDER BY id ASC");
       
       foreach($list_up2 as $t=>$y) {
                $z = $y['ID_QUEST'];
                $list_correct = $db -> select("select res.id, res.answer from users_result u, question_p q, result_p res, project p where u.id_project = p.id and p.id = $p_id and res.id_question = q.id and u.id_quest = $z and u.id_quest = q.id  and q.id_project = p.id and res.correct_answer = 1 group by RES.ANSWER, res.id");                                 
                $dan = $y['ID_USER'];
                $sql_dan = $db->select("select * from sup_person where id = $dan");
        ?>   
         <tr>          
                 <td>
                     <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?>
                </td>
                <td>
                     <?php echo $y['QUESTION']; ?>
                </td>
                <td><em>
                      <?php echo $y['ANSWER']; ?> </em>
                </td> 
              <td><b> 
                <?php echo $list_correct[0]['ANSWER']; ?>
               </b> </td>   
                <td>
                     <?php echo $y['NAME']; ?>
                </td>
        </tr> 
            <?php }  ?>    
        </tbody>  
        </table>               
        </div>
    </div>
</div>
 