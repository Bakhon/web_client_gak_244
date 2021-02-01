<?php
$project_id = $_GET['project_id'];
$qs = $db -> select("select u.id_project, p.name, p.ID_TYPE from project p, users_result u where u.id_project = $project_id and p.id = u.id_project");
foreach($qs as $k => $v) {
    if($v['ID_TYPE'] == '1') {
?>


    <?php foreach($list_project as $t=>$y) if($y['ID'] == $project_id) { ?>
       <div class="ibox-title" id=""><h3 align="center">Результаты проекта <?php echo $y['NAME']; ?></h3> 
       </div>
<?php } ?>





               <div class="row">
                  <div class="col-lg-12">
                     <div class="tabs-container">
                        <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#tab-2"> Головной офис </a></li>
                           <li class=""><a data-toggle="tab" href="#tab-1"> Филиалы </a></li>
                        </ul>
                      

<div class="tab-content">
<div id="tab-1" class="tab-pane">
    <div class="col-lg-12" id="osn-panel">
     
    <div class="ibox-content" id="table_with_data">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead >
                    <tr >
                        <th>ID</th>
                        <th>Сотрудник</th>
                        <th >Департамент</th>
                        <th>Количество вопросов</th>
                        <th>количество правильных</th>
                        <th>количество неправильных</th>
                        <th>Количество правильно отвечанных(%)</th>                    
                    </tr>
                </thead>
                <tbody>
                
    <?php $i = 1; foreach($list_res as $n => $m) { 
        
        $branch_id = $m['BRANCH_ID'];
                $dan = $m['ID_USER'];
                $sql_dan = $db->select ("select * from sup_person where id = $dan");
                $sup_person_id = $sql_dan[0]['ID'];
                $count_correct_answer = $db->select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER = 1 and u.id_project = $project_id");
                $count_incorrect_answer = $db -> select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER != 1 and u.id_project = $project_id");
                $coun_questions = $db->select("select count(*) from Question_p where ID_PROJECT = $project_id"); // Количество вопросов
                $coun_questionss = $coun_questions[0]['COUNT(*)'];
            //    $coun_questions = 15;
            if($project_id == 285) {
                $coun_questionss = 40;
                }

                $count_correct_answer_percent = ($count_correct_answer[0]['COUNT(*)']/$coun_questionss)*100;                                               
                 
     ?>
                    <tr ondblclick="$(location).attr('href','res_full_test?project_id=<?php echo $m['ID']; ?>&user_id=<?php echo $dan; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                           <?php echo $i; ?>
                        </td>
                        <td align="center">
                           <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?> 
                        </td>
                        <td align="center" >
                           <?php echo $m['NAME']; ?>
                        </td>
                        <td align="center">
                        <?php echo  $coun_questionss;?>
                        </td>
                <!---        <td>
                            <?php echo $coun_questions[0]['COUNT(*)'];  ?>
                        </td> --->
                        <td align="center">
                            <?php echo $count_correct_answer[0]['COUNT(*)']; ?>
                        </td>        
                        <td align="center">
                            <?php echo $count_incorrect_answer[0]['COUNT(*)']; ?>
                        </td>
                        <td align="center"> 
                            <?php echo round($count_correct_answer_percent)."%"; ?>
                        </td>
                    </tr>                    
                <?php $i++; }  ?>   
                </tbody>
            </table>
            <br />
            
        </div>
        
         <form target="_blank" name="pdf" id="table_form" method="post" action="print_test">
                    <input name="dep_id" value="" style="display: none;">
                    <div id="head_of_doc" hidden="">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">Результаты теста</h3>
                                    </strong>
                                </div>                               
                                <hr>
                        </div>
                    </div>
                    <div id="foot_of_doc" hidden="">
                    </div>
                    <textarea name="content" id="area_for_print" hidden=""></textarea>
                    <div class="ibox-content">
                        <div class="table-responsive">
                          <div class="col-md-2">
                                <div class="table-responsive pull-right">
                                    <button type="button" data-toggle="modal" data-target="#table_for_one" class="btn btn-w-m btn-warning">Распечатать одного человека</button>
                                </div>
                            </div>
                            <a id="submit_and_print" class="btn btn-primary pull-right">
                                <i class="fa fa-check-square-o"></i> 
                                    Отправить на печать
                            </a>
                        </div>
                    </div>
                </form>
        
        
    
</div>
 </div> 
 
 <div id="tab-2"  class="tab-pane active">
    <div class="col-lg-12" id="osn-panel">

    <div class="ibox-content" id="table_with_data1">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead >
                    <tr >
                        <th>ID</th>
                        <th>Сотрудник</th>
                        <th >Департамент</th>
                        <th>Количество вопросов</th>
                        <th>количество правильных</th>
                        <th>количество неправильных</th>
                        <th>Количество правильно отвечанных(%)</th>                    
                    </tr>
                </thead>
                <tbody>
    <?php $i = 1;  foreach($list_res_upd as $n => $m) { 
        $branch_id = $m['BRANCH_ID'];
                $dan = $m['ID_USER'];
                $sql_dan = $db->select ("select * from sup_person where id = $dan");
                $sup_person_id = $sql_dan[0]['ID'];
                $count_correct_answer = $db->select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER = 1 and u.id_project = $project_id");
                $count_incorrect_answer = $db -> select("select count(*) from users_result u, RESULT_P res  where u.ID_USER = $sup_person_id and u.ID_QUEST = res.ID_QUESTION and u.ID_RESULT = res.ID and res.CORRECT_ANSWER != 1 and u.id_project = $project_id");
                $coun_questions = $db->select("select count(*) from Question_p where ID_PROJECT = $project_id"); // Количество вопросов
                $coun_questionss = $coun_questions[0]['COUNT(*)'];
            //    $coun_questions = 15;
            if($project_id == 285) {
                $coun_questionss = 40;
                }

                $count_correct_answer_percent = ($count_correct_answer[0]['COUNT(*)']/$coun_questionss)*100;                                               
                 
     ?>
                    <tr ondblclick="$(location).attr('href','res_full_test?project_id=<?php echo $m['ID']; ?>&user_id=<?php echo $dan; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                           <?php echo $i;?>
                        </td>
                        <td align="center">
                           <?php echo $sql_dan[0]['LASTNAME'].' '.$sql_dan[0]['FIRSTNAME'].' '.$sql_dan[0]['MIDDLENAME']; ?> 
                        </td>
                        <td align="center" >
                           <?php echo $m['SHORT_NAME']; ?>
                        </td>
                        <td align="center">
                        <?php echo  $coun_questionss;?>
                        </td>
                <!---        <td>
                            <?php echo $coun_questions[0]['COUNT(*)'];  ?>
                        </td> --->
                        <td align="center">
                            <?php echo $count_correct_answer[0]['COUNT(*)']; ?>
                        </td>        
                        <td align="center">
                            <?php echo $count_incorrect_answer[0]['COUNT(*)']; ?>
                        </td>
                        <td align="center"> 
                            <?php echo round($count_correct_answer_percent)."%"; ?>
                        </td>
                    </tr>                    
                <?php $i++; }  ?>   
                </tbody>
            </table>
            <br />
            
        </div>
        
         <form target="_blank" name="pdf" id="table_form1" method="post" action="print_test">
                    <input name="dep_id" value="" style="display: none;">
                    <div id="head_of_doc1" hidden="">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">Результаты теста</h3>
                                    </strong>
                                </div>                               
                                <hr>
                        </div>
                    </div>
                    <div id="foot_of_doc" hidden="">
                    </div>
                    <textarea name="content" id="area_for_print1" hidden=""></textarea>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <div class="col-md-2">
                                <div class="table-responsive pull-right">
                                    <button type="button" data-toggle="modal" data-target="#table_for_one" class="btn btn-w-m btn-warning">Распечатать одного человека</button>
                                </div>
                            </div>
                            <a id="submit_and_print1" class="btn btn-primary pull-right">
                                <i class="fa fa-check-square-o"></i> 
                                    Отправить на печать
                            </a>
                        </div>
                    </div>
                </form>
        
        
    
</div>
 </div>
 </div>
 
   
 </div>
 </div>    
</div>
<?php } break;} ?>
