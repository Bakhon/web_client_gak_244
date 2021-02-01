<div class="row">
    <div class="col-lg-12" id="osn-panel">   
            <div class="ibox-title"><h3 align="center">Результаты анкетирования сотрудника <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?>  </h3>
            </div>                                      
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>Сотрудник</th>
                        <th>Вопрос </th>
                        <th>Ответ</th>   
                        <th>Департамент</th>                       
                    </tr>
                </thead>
        <tbody> 
     <?php  
     $p_id =  $_GET['p_id'];
     $user_id = $_GET['user_id'];
    // $list_up = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER from users_result u, question_p q, result_p r where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $project_id ORDER BY ID ASC");
       $list_up2 = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER, d.name, d.id id_dep from users_result u, question_p q, result_p r, sup_person sp, dic_department d where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $p_id and u.id_user = $user_id and sp.id = u.id_user and SP.JOB_SP = d.id ORDER BY id ASC");                                 
       foreach($list_up2 as $t=>$y) {
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
                <td>
                      <?php echo $y['ANSWER']; ?>
                </td>   
                <td>
                     <?php echo $y['NAME']; ?>
                </td>
        </tr> 
            <?php }   ?>    
        </tbody>  
        </table>               
        </div>
    </div>
</div>
 