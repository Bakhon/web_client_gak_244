<?php
    //echo '<pre>';
   // print_r($_SESSION);
    //echo '</pre>';
 //   print_r($list_add_project);
   /*  echo  $list_add_project['EMP_ID'];
     $sql_ad = "Select * from PROJECT";
     $list_ad = $db -> Select($sql_ad);
     print_r($list_ad); */
?>

<div class="wrapper wrapper-content  animated fadeInRight">
<div class="row">
  <div class="col-lg-12" id="osn-panel">
   <div class="ibox-content">
   <div class="modal-body">     
        <a href="create_project"> <button type="submit" class="btn btn-primary">Создать проект</button></a>                   
         <a href="list_project"> <button type="submit" style="" class="btn btn-primary">Список проектов</button></a>                    
          <a href="result_project"> <button type="submit" style="" class="btn btn-primary">Результат тестирования</button></a>         
     </div>
   </div>
  </div>
 </div> 
</div>

<h3 align="center">Создать проект</h3>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox-content">
                <!--<a data-toggle="modal" data-target="#addEmp" class="btn btn-sm btn-primary"><i class="fa fa-plus">Принять на работу</i></a>-->
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-noraml">Название проекта</label>
                                <input name="test_name" type="text" placeholder="" class="form-control" id="test_name" required>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Автор теста</label>
                                <input type="text" placeholder="" class="form-control" value="<?php echo $_SESSION[USER_SESSION]['fio']; ?>"  readonly/>
                            </div>
                            <input type="hidden" name="emp_id" value="<?php echo $_SESSION[USER_SESSION]['uid']; ?>"/>
                                                                                    
                            <div class="form-group">
                                <label class="font-noraml">Тип теста</label>
                                                                
                                <select name="id_type" class="select2_demo_1 form-control" id="id_type" required>
                                    <option value=""></option>
                                    <?php 
                                        foreach($list_dic_type_project as $y => $u) {
                                            echo '<option value="'.$u['ID'].'">'.$u['NAME'].'</option>';
                                        } 
                                    ?>                                    
                                </select>
                            </div>
                            
                            <div class="form-group" id="time_test" style="display: none;">
                                <label class="font-noraml">Время для выполнения теста (минут)</label>
                                <input name="time_result" type="number" placeholder="" value="0" class="form-control" id="time_result" required>
                            </div>
                                                                                    
                             <div class="form-group">
                                <label class="font-noraml">Статус теста</label>
                                <select name="state" class="select2_demo_1 form-control" id="state" required>
                                    <option value=""></option>
                                    <option value="2" selected >Активен</option>
                                    <option value="1">Не активен</option>
                                </select>
                            </div>                            
                                                                                                                                                                                             
                            <div class="form-group">
                                <label class="font-noraml">Дата закрытия теста</label>
                                <input name="date_close" type="text" placeholder="" class="form-control" id="date_close" value="<?php  echo date("d.m.Y", strtotime("+1 month")); ?>" required>
                            </div>
                         
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>             
                    </div>
                </form>
            </div>                
        </div>           
    </div>
</div>
<script>
    $('#id_type').change(function(){
        var id = $(this).val();
        if(id == '1'){
            $('#time_test').css('display', 'block');            
        }else{
            $('#time_test').css('display', 'none');
        }
        $('#time_result').val('0');
    });
</script>