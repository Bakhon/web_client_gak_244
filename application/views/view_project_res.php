<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Список проектов</h5>
            <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#modal_new_project" data="0" id="create_project"><i class="fa fa-plus"></i> Создать проект</button>
        </div>
        <div class="ibox-content inspinia-timeline">
            <?php 
                foreach($project->result['projects'] as $k=>$v){
            ?>
                
            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-3 date">
                        <?php 
                            if($v['ID_TYPE'] == '1') 
                            {
                                echo '<i class="fa fa-line-chart"></i><br /><small class="text-navy">Тестирование '.$v['TIME_RESULT'].' мин</small>';
                            }else{
                                echo '<i class="fa fa-question-circle"></i><br /><small class="text-navy">Опросник</small>';
                            }
                        ?>
                        <!--<br />
                        <a href="#" class="btn btn-info btn-xs edit_project" data="<?php echo $v['ID']; ?>"><i class="fa fa-pencil-square-o"></i></a>-->
                    </div>                    
                    <div class="col-lg-7 content no-top-border view_quest" data-type="<?php echo $v['ID_TYPE']; ?>" data="<?php echo $v['ID']; ?>" style="cursor: pointer;" id="list_projects">
                        <p class="m-b-xs">
                            <strong><?php echo $v['NAME']; ?></strong>
                        </p>
                        <p>Кол-во вопросов: <?php  echo count($v['list_quest']); ?></p>
                        <p class="m-b-xs"><strong><?php echo $v['DATE_CLOSE'];?></strong></p>                        
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>        
    </div>
</div>
