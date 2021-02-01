<?php
// echo $_SESSION[insurance][login];
// print_r($_SESSION);
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
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Список проектов</h5>
                </div>
                <div class="ibox-content ibox-heading"></div>
                <?php foreach($list_project as $y => $z) { ?>
                <div class="timeline-item">
                    <div class="row">
                        <div class="col-xs-3 date">
                            <?php if($z['ID_TYPE'] == 1) {  ?> <i class="fa fa-briefcase"></i>
                            <?php if($z['ID_TYPE'] == 2) { ?>
                            <i class="fa fa-chevron-up"></i>
                            <?php } ?>
                            <?php  } ?>
                            <?php if($z['ID_TYPE'] == 1) { echo $z['TIME_RESULT']; } ?>
                            <br/>
                            <small class="text-navy">  <?php echo $z['DATE_CLOSE'];?></small>
                        </div>
                        <div class="col-xs-7 content no-top-border">
                            <p class="m-b-xs"><strong><a href="?project=<?php echo $z['ID']; ?>"><?php echo $z['NAME']; ?></a></strong></p>
                            <p><?php  echo $z['ID_TYPE'];?></p>
                            <p class="m-b-xs"><strong><?php echo $z['DATE_CLOSE'];?></strong></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-8" id="osn-panel">
            <div class="ibox-content">
                <div id="" class="">
                    <p>Всего вопросов=
                        <?php echo count($l_que); ?>
                    </p>
                    <hr />
                <form method="post" action="feedback_form">
                        <?php 
                foreach($l_que as $k => $v) 
                {
                    $q_id = $v['ID'];
                ?>
                        <p id="qs">
                            <?php echo $v['QUESTION']; ?>
                        </p>
                        <?php
                    $options = "select * From RESULT_P where ID_QUESTION = $q_id";
                    $l_options = $db -> select($options);
                    foreach($l_options as $q => $r)
                    {
                ?>          
                            <p class="">
                                <input type="radio" id="<?php echo $r['ID']; ?>" name="<?php echo $r['ID_QUESTION']; ?>" value="<?php echo $r['ID']; ?>" required>
                                <label><?php echo $r['ANSWER']; ?></label>
                            </p>
                            <?php
                    }
                ?>
                                <hr />
                                <?php                                                                                                                                                                                         
                                 } 
                                ?>    
                                
                                                                                                          
            <div class="modal-footer">            
            <a href="list_otvet?proj_id=<?php echo $z['ID']; ?>"><?php echo $z['NAME']; ?></a>
             <button type="submit" name="endtest" class="btn btn-primary">Завершить тест</button>             
            </div>  
                 </form>
            </div>
        </div>
    </div>
 </div>
 
 <div>
 
 
 </div>

