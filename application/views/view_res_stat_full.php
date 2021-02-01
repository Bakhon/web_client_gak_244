<?php

$project_id = $_GET['project_id'];

?>
<div class="row">
    <div class="col-lg-12" id="osn-panel"> 
        <div class="ibox-title"><h3 align="center">Результаты анкетирования</h3>
            </div>                                     
        <div class="ibox-content" id="table_with_data">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th rowspan="2">№ п/п</th>
                        <th rowspan="2">Вопрос </th>
                        <th colspan="2">Ответ:</th>   
                  <!--      <th rowspan="2">Примечание</th>     -->                  
                    </tr>
                <tr>
                    <th>Да</th>                
                    <th>нет</th>
                </tr> 
                </thead>
        <tbody> 
   
 <?php $list_question = $db->select("select * from Question_p where id_project = $project_id order by id ASC"); 
 
  $list_project =$db->select("select * from PROJECT where id = $project_id");
  
   $today_date = date('d.m.Y');
   $i = 1;
 foreach($list_question as $k => $v) {
    $z = $v['ID'];
    $list_rs = $db -> select("select count(ANSWER) from users_result u, result_p res, question_p q where u.id_quest = q.id and u.id_result = res.id and res.ID_QUESTION = q.id and u.id_project = $project_id and res.ANSWER = 'Да' and u.id_quest =$z ");
    $list_rs1 = $db -> select("select count(ANSWER) from users_result u, result_p res, question_p q where u.id_quest = q.id and u.id_result = res.id and res.ID_QUESTION = q.id and u.id_project = $project_id and res.ANSWER = 'Нет' and u.id_quest =$z ");
 ?>
         <tr>          
                <td>
                   <?php echo $i; ?> 
                </td>
                <td>
                  <?php echo $v['QUESTION']; ?>   
                </td>
                <td>
                   <?php echo $list_rs[0]['COUNT(ANSWER)']; ?> 
                </td>   
                <td>
                   <?php echo $list_rs1[0]['COUNT(ANSWER)']; ?>  
                </td>
                
            </tr> 
  <?php $i++; }   ?>     
        </tbody>  
        </table>               
        </div>
        
        <form target="_blank" name="pdf" id="table_form" method="post" action="print_timesheet">
                    <input name="dep_id" value="" style="display: none;">
                    <div id="head_of_doc" hidden="">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">Тема: <?php echo $list_project[0]['NAME']; ?> </h3>
                                    </strong>
                                </div>
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;"></h3>
                                    </strong>
                                </div>
                                <hr/>
                        </div>
                        
                       
                           
                    </div>
                    <div id="foot_of_doc" hidden="">
                    
                    <div style="text-align: left;">
                          <h3 style="color: #676a6c;"><?php echo $today_date; ?></h3>
                        </div>
                    
                    </div>
                    <textarea name="content" id="area_for_print" hidden=""></textarea>
                     
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <a id="submit_and_print" class="btn btn-primary pull-right">
                                <i class="fa fa-check-square-o"></i> 
                                    Отправить на печать
                            </a>
                        </div>
                    </div>
                </form>
        
        
        
    </div>
</div>


<script>
    $('#submit_and_print').click
    (function() 
        {
            var head_of_doc = $('#head_of_doc').html();                        
            var table_with_data = $('#table_with_data').html();
            var foot_of_doc = $('#foot_of_doc').html();
            $('#area_for_print').html(head_of_doc+table_with_data+foot_of_doc);
            $('#table_form').submit();
        }
    )
</script>