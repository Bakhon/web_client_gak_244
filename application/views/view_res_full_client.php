<?php
$project_id = $_GET['project_id'];
$qs = $db -> select("select u.id_project, p.name, p.ID_TYPE from project p, users_result u where u.id_project = $project_id and p.id = u.id_project");
foreach($qs as $k => $v) {
    if($v['ID_TYPE'] == '1') {
?>

<div class="row">
    <div class="col-lg-12" id="osn-panel">
    <?php foreach($list_project as $t=>$y) if($y['ID'] == $project_id) { ?>
       <div class="ibox-title"><h3 align="center">Результаты проекта <?php echo $y['NAME']; ?></h3> <?php } ?>
       </div>

    <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Департамент</th>
                        <th>Количество вопросов</th>
                        <th>количество правильных</th>
                        <th>количество неправильных</th>
                        <th>Количество правильно отвечанных(%)</th>                    
                    </tr>
                </thead>
                <tbody>
    <?php foreach($list_res as $n => $m) { 
                $dan = $m['ID_USER'];
                $sql_dan = $db->select ("select * from sup_person where id = $dan");
                $sup_person_id = $sql_dan[0]['ID'];
                $count_correct_answer = $db->select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER = 1 and u.id_project = $project_id");
                $count_incorrect_answer = $db -> select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER != 1 and u.id_project = $project_id");
        //        $coun_questions = $db->select("select count(*) from Question_p where ID_PROJECT = $project_id"); // Количество вопросов
                $coun_questions = 15;

                $count_correct_answer_percent = ($count_correct_answer[0]['COUNT(*)']/$coun_questions)*100;                                               
                 
     ?>
                    <tr ondblclick="$(location).attr('href','res_full_test_client?project_id=<?php echo $m['ID']; ?>&user_id=<?php echo $dan; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                           <?php echo $m['ID_USER'];?>
                        </td>
                        <td>
                           <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?> 
                        </td>
                        <td>
                           <?php echo $m['NAME']; ?>
                        </td>
                        <td>
                        <?php echo  $coun_questions;?>
                        </td>
                <!---        <td>
                            <?php echo $coun_questions[0]['COUNT(*)'];  ?>
                        </td> --->
                        <td>
                            <?php echo $count_correct_answer[0]['COUNT(*)']; ?>
                        </td>        
                        <td>
                            <?php echo $count_incorrect_answer[0]['COUNT(*)']; ?>
                        </td>
                        <td>
                            <?php echo $count_correct_answer_percent."%"; ?>
                        </td>
                    </tr>                    
                <?php  }  ?>   
                </tbody>
            </table>
            <br />
            
        </div>
    
</div>
 </div> 
<?php } break;} ?>

<?php
$project_id = $_GET['project_id'];
$qs = $db -> select("select u.id_project, p.name, p.ID_TYPE from project p, users_result u where u.id_project = $project_id and p.id = u.id_project");
foreach($qs as $k => $v) {
    if($v['ID_TYPE'] == '2') { ?>
                
     <?php       
    //   $list_opr = $db -> select("select u.id_project, q.QUESTION, r.ANSWER from users_result u, question_p q, result_p r where u.id_project = $project_id and U.ID_USER = $sup_person_id and U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id");
     ?>
      
<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <?php foreach($list_project as $o=>$p) if($p['ID'] == $project_id) { ?>
       <div class="ibox-title"><h3 align="center">Результаты проекта <?php echo $p['NAME']; ?></h3> <?php } ?> </div>
                                      
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>Сотрудник</th>
              <!---          <th>Вопрос </th>
                        <th>Ответ</th>   -->
                        <th>Департамент</th>                       
                    </tr>
                </thead>
        <tbody> 
     <?php   
    // $list_up = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER from users_result u, question_p q, result_p r where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $project_id ORDER BY ID ASC");
       $list_up2 = $db -> select("select u.id, u.id_user, u.id_quest,u.id_result,  u.id_project, q.QUESTION, r.ANSWER, d.name, d.id id_dep from users_result u, question_p q, result_p r, sup_person sp, dic_department d where U.ID_PROJECT = q.ID_PROJECT and U.ID_QUEST = q.id and U.ID_RESULT = r.id and u.id_project = $project_id and sp.id =u.id_user and SP.JOB_SP = d.id ORDER BY id ASC");                                
       foreach($list_res1 as $t=>$y) {
                $dan = $y['ID_USER'];
                $sql_dan = $db->select("select * from sup_person where id = $dan");
        ?>   
         <tr ondblclick="$(location).attr('href','res_full_opros?user_id=<?php echo $dan; ?>&p_id=<?php echo $y['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">          
                <td>
                     <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?>
                </td>
     <!---           <td>
                     <?php echo $y['QUESTION']; ?>
                </td>
                <td>
                      <?php echo $y['ANSWER']; ?>
                </td>   -->
                <td>
                     <?php echo $y['NAME']; ?>
                </td>
            </tr> 
            <?php } break;  ?>    
        </tbody>  
        </table>               
        </div>
    </div>
</div>
 <?php  }}
  ?>

 