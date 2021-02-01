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
    <div class="col-lg-8">
      <div class="ibox-content">
       <p><strong>Общее количество вопросов:</strong><br /><?php echo $count; ?></p>
       <p><strong>Количество правильных ответов:</strong><br /><?php echo $list_prav_otvet['0']['C']; ?></p>
       <p><strong>Количество неправильных ответов:</strong><br /><?php echo $list_neprav_otvet['0']['C']; ?></p>
       <p><strong>Набрано(в процентах)</strong><br /><?php echo $percent; ?>%</p>
    </div>
    </div>
    
    
     <div class="col-lg-4">
        <div class="ibox-content">
            <p><strong>Список проектов</strong></p>
         </div>
         
         
     </div>
    </div>  