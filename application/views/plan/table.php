<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>№</th>
        <th style="width: 40%;">Задание</th>
        <th style="width: 16%;">Заказчик</th>
        <th>Статус</th>
        <th>Исполнитель</th>
        <th>Срок выполнения</th>
        <th>Фактическая дата выполнения</th>        
        <th>Комментарий</th>
        <?php 
            if($onedit){
                echo "<th></th>";      
            }
        ?>        
    </tr>
</thead>

<tbody>                                                    
<?php 
    function GetClass($state){
        $s = array(
            0=>"",
            1=>"",
            2=>"danger",
            3=>"warning",
            4=>"success"
        );
        return $s[$state];
    }
    $cnt = count($list)-1;
    $ns = 0;
    foreach($list as $k=>$v){
        $ns++;
?>
    <tr class="<?php echo GetClass($v['STATE']); ?>">
        <td style="text-align: center;">
                                                                                                
                    <?php 
                    if($v['STATE'] !== '4'){
                        echo '
                        <div class="btn-group dropright">
                        <button data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                        <ul class="dropdown-menu">';
                        
                        if($onedit){
                            //if($v['STATE'] == 1){
                                echo '<li><a href="#" class="edit_plan" data-toggle="modal" data-target="#edit" id="'.$v['ID'].'"><i class="fa fa-edit"></i> Редактировать</a></li>';
                            //}
                            if($v['ONEX'] > 0){                                
                                if($v['STATE'] == 1){
                                    echo '
                                    <li><a href="plan?set_isp='.$v['ID'].'&state=2"><i class="fa fa-bolt"></i> Взять в работу</a></li>
                                    <li class="divider"></li>                                    
                                    <li><a href="plan?delete='.$v['ID'].'"><i class="fa fa-trash"></i> Удалить</a></li>
                                    ';
                                }
                                
                                if($v['STATE'] == 2){
                                    echo '<li><a href="plan?set_isp='.$v['ID'].'&state=3"><i class="fa fa-bolt"></i> Отправить на тестирование</a></li>';
                                }                                                                
                            }
                        }
                        if($v['STATE'] == 3){
                            echo '<li><a href="#" class="set_last_state" data-toggle="modal" data-target="#set_last_state" id="'.$v['ID'].'"><i class="fa fa-bolt"></i> Исполнен</a></li>';
                        }
                        echo '</ul>
                        </div>
                        ';
                    }else{
                        //echo '<i class="fa fa-2x fa-check"></i>';
                        
                        echo '<div class="btn-group dropright">
                        <button data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>';
                        echo '<ul class="dropdown-menu">';
                        echo '<li><a href="#" class="edit_plan" data-toggle="modal" data-target="#edit" id="'.$v['ID'].'"><i class="fa fa-edit"></i> Редактировать</a></li>';
                        echo '<li><a href="plan?act='.$v['ID'].'" target="_blank" title="Печать акта"><i class="fa fa-print fa-2x"></i>Печать акта</a></li>';
                        echo '<li><a href="#" class="contracts_files" data="'.$v['ID'].'" data-toggle="modal" data-target="#add_act" id="'.$v['ID'].'"><i class="fa fa-plus"></i> Добавить и просмотр акт-приема передач </a></li>';                        
                         echo '</ul>
                        </div>
                        ';
                    }
                    ?>                                                            
        </td>
        <td>
            <?php 
                //echo '<xmp wrap="soft">'.str_replace('&quot;', '"', trim($v['NAME'])).'</xmp>';
                echo nl2br(trim($v['NAME']));
                if($v['ID_FILE'] !== ''){
                    echo '<br /><a href="plan?loadfile='.$v['ID_FILE'].'" target="_blank">'.$v['FILENAME'].'</a>';
                }
            ?>
        </td>
        <td><?php
        foreach($v['DEPS'] as $dep){
            echo $dep['NAME'].'<br />';
        }                                     
        ?></td>                                
        <td><?php echo $v['STATE_NAME']; ?></td>
        <td><?php
         foreach($v['USERS'] as $user){
            echo $user['FIO'].'<br />';
         }                                      
        ?></td>
        <td><?php echo $v['DATE_PLAN']; ?></td>
        <td><?php echo $v['DATE_EXAMPLE']; ?></td>
        <td><?php echo $v['COMMENT_EXAMPLE']; ?></td>
        <?php 
            if($onedit){
        ?>
        <td>
            <div class="vote-actions">
                <?php 
                if($k !== 0){
                    echo '<a href="#" class="step_top" id="'.$v['ID'].'"><i class="fa fa-chevron-up"> </i></a>';                    
                }                
                ?>                
                <div><?php echo $v['NUM_PP']; ?></div>
                <?php 
                    if($k !== $cnt){
                        echo '<a href="#" class="step_bottom" id="'.$v['ID'].'"><i class="fa fa-chevron-down"> </i></a>';
                    }
                ?>
            </div>
        </td>
        <?php } ?>
    </tr>
<?php } ?>
</tbody>
</table>