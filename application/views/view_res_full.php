<?php
if(isset($_GET['project_id']))
{
$project_id = $_GET['project_id'];
}
else{
    $project_id = $_GET['pid'];
}
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
<?php if(!isset($_GET['pid'])) { ?>
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
            if($project_id == 300) {
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
<?php } ?>
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
            if($project_id == 300) {
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
                                <hr/>
                        </div>
                    </div>
                    <div id="foot_of_doc" hidden="">
                    </div>
                    <textarea name="content" id="area_for_print1" hidden=""></textarea>
                    <div class="ibox-content">
                        <div class="table-responsive">
                      <?php if(!isset($_GET['pid'])) { ?>  
                        <div class="col-md-2">
                                <div class="table-responsive pull-right">
                                 <button type="button" data-toggle="modal" data-target="#table_for_one" class="btn btn-w-m btn-warning">Распечатать одного человека</button>                         
                                </div>
                        </div>
                        <?php } ?>    
                            
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

<?php
if(isset($_GET['project_id']))
{
$project_id = $_GET['project_id'];
}
else{
    $project_id = $_GET['pid'];
}
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
  


<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="table_for_one" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Результат на одного сотрудника</h4>
                <small class="font-bold">Выберите имя сотрудника</small>
            </div>
            <div class="modal-body">
            <form method="post"  target = "_blank" action="res_full?pid=<?php echo $project_id; ?>">                                        
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Сотрудник</label>
                        <select onchange="" name="MISS_PERSON_ID" id="MISS_PERSON_ID" class="select2_demo_1 form-control">
                            <option></option>
                            <?php
                                foreach($list_person as $k => $l){
                            ?>
                            <option value="<?php echo $l['ID']; ?>"><?php echo $l['LASTNAME'].' '.$l['FIRSTNAME']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="save_pos" type="submit" class="btn btn-primary">Сохранить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                  
            </div>
            </form>
        </div>
    </div>
</div>  
  

<script>
    $('#submit_and_print').click
    (function() 
        {
            var head_of_doc = $('#head_of_doc').html();                        
            var table_with_data = $('#table_with_data').html();
            $('#area_for_print').html(head_of_doc+table_with_data);
            $('#table_form').submit();
        }
    )
    
    $('#submit_and_print1').click
    (function() 
        {
            var head_of_doc = $('#head_of_doc1').html();                        
            var table_with_data = $('#table_with_data1').html();
            $('#area_for_print1').html(head_of_doc+table_with_data);
            $('#table_form1').submit();
        }
    )
    
   
     $('#filter').change(function(){
        var id = $(this).val();        
        if(id == 0){
            $('#test').css('display', '');
        }else{
            $('#test').each(function(){
                if($(this).attr('data') !== id){
                    $(this).css('display', 'none');        
                }else{
                    $(this).css('display', '');
                }
            });                                    
        }        
    })
    
    
    /*        $('#filter').change(function(){
        var id = $(this).val();
        console.log(id);
        $.post(window.location.href, {"branch_id":id}, function(data){
           $('#test').html(data);
            $('#test').change(); 
        });         
    });
    
  */  
    
    
    
    
    
</script>

<style>


.nav-tabs > li > a {
  color: #A7B1C2;
  font-weight: 600;
  padding: 10px 700px 10px 25px;
}



</style>


 