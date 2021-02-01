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
<div class="row">
<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Список проектов</h5>           
        </div>
       <div class="ibox-content ibox-heading"></div>                               
        <?php foreach($list_project as $y => $z) 
              {
        ?>
            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-3 date">
                     <?php if($z['ID_TYPE'] == 1) 
                            {
                    ?>                
                      <i class="fa fa-briefcase"></i> <?php if($z['ID_TYPE'] == 2) { ?>
                      <i class="fa fa-chevron-up"></i>
                       <?php } 
                        } 
                        ?>
                         <?php if($z['ID_TYPE'] == 1) { echo $z['TIME_RESULT']; } ?>
                        <br/>
                        <small class="text-navy">  <?php echo $z['DATE_CLOSE'];?></small>
                    </div>
                    <div class="col-xs-7 content no-top-border">
                        <p class="m-b-xs"><strong><a href="list_otvet?proj_id=<?php echo $z['ID']; ?>"><?php echo $z['NAME']; ?></a></strong></p>
                        <p><?php  echo $z['ID_TYPE']; ?>  </p>
                        <p class="m-b-xs"><strong><?php echo $z['DATE_CLOSE'];?></strong></p>                        
                    </div>
                </div>
            </div>  
            
        <?php } ?>
        </div>
      </div>         
 <div class="col-lg-8" id="osn-panel"> 
   <div class="ibox-content">
  <div class="">
      <form method="post" name="Form">
          <div class="modal-body">
          
          <div class="form-group">
            <label class="font-noraml">Выберите проект</label>
            <select id="id_p" name="id_p" class="select2_demo_1 form-control">
                    <option></option>
                    <?php
                        foreach($list_project as $t => $y){
                    ?>
                        <option value="<?php echo $y['ID']; ?>"><?php echo $y['NAME']; ?></option>
                    <?php
                        }
                    ?>
            </select>
          </div>                                                                         
            <div class="form-group">
            <label class="font-noraml">Введите свой вопрос</label>                                             
            <input name="name_rasp" type="text"  placeholder="" class="form-control" id="name_rasp"  required>                                         
          </div>
                                    
            <div class="form-group">
              <div id="DynamicExtraFieldsContainer">
                   <div id="addDynamicField">
                       <input type="button" id="addDynamicExtraFieldButton" value="Добавить ответ" name="" >
                   </div>
               <div class="DynamicExtraField">
                   <br/>
               <label for="DynamicExtraField">Введите свой ответ</label> <input value="Удаление" type="button" class="DeleteDynamicExtraField">
                   <br/>
                  <textarea name="ans[]" cols="50" ></textarea>    
          
               </div>
                 </div>
             </div>           
            <div class="modal-footer"> 
             <button type="submit" class="btn btn-primary">Сохранить</button>             
            </div>                     
      </div>
  </form>       
</div>
</div>
</div>
</div>

<div>
<script>
$('#addDynamicExtraFieldButton').click(function(event) {
    addDynamicExtraField();
    return false;
 });
function addDynamicExtraField() {
    var div = $('<div/>', {
        'class' : 'DynamicExtraField'
    }).appendTo($('#DynamicExtraFieldsContainer'));
    var br = $('<br/>').appendTo(div);
    var label = $('<label/>').html("Введите свой ответ ").appendTo(div);
    var input = $('<input/>', {
        value : 'Удаление',
        type : 'button',
        'class' : 'DeleteDynamicExtraField'
    }).appendTo(div);
    input.click(function() {
        $(this).parent().remove();
    });
    var br = $('<br/>').appendTo(div);
    var textarea = $('<textarea/>', {
        name : 'ans[]',
        cols : '50',
        rows : '3'
    }).appendTo(div);
}
//Для удаления первого поля
$('.DeleteDynamicExtraField').click(function(event) {
                $(this).parent().remove();
                return false;
            });

</script>

</div>