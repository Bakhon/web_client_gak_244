<?php print_r($_POST); ?>
        <div class="wrap">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Список тестов</h5>
            </div>
            <div class="ibox-content inspinia-timeline">
                <?php foreach($list_project as $k=>$v){                              
             ?>
                <p>
                    <a href="?proj_id=<?php echo $v['ID'];?>">
                        <?php echo $v['NAME']; ?>
                    </a>
                </p>
                <?php } ?>
            </div>
        </div>
</div>

    <div class="wrap">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Ваши результаты</h5>   
         </div> 
          <div class="ibox-content inspinia-timeline">                        
        <table width="100%" border="1">
    <tbody>
        <tr>
            <td align="left"><strong>Тест. задание</strong></td>
            <td align="center"><strong>Кол-во вопросов</strong></td>
            <td align="center"><strong>Набрано</strong></td>
            
            <td align="center"><strong>Результат в процентах</strong></td>
        </tr>
        <tr>
                        <?php         
                        foreach($list_name_project as $k=>$v){                              
             ?>
            <td align="left"><?php echo $v['NAME']; ?></td>
            <?php } ?>
            <td align="center"><?php echo $list_count[0]['Q']; ?></td>
            <td align="center"><?php echo $list_prav_otvet[0]['C'];;?></td>
           
            <td align="center"><?php echo $res_percent; ?></td>
        </tr>
    </tbody>
</table>
            
    </div>
</div>
</div>


<div class="project-data">
<?php 
                foreach($l_que as $k => $v) 
                {                    
                    $q_id = $v['ID'];
                ?>
                <div class="question" data-id="<?php echo $v['ID'];?>" id="question-<?php echo $v['ID'];?>"></div>
                        <p class="q">
                         <?php echo $v['QUESTION']; ?>   
                        </p>
                        <?php
                    $options = "select * From RESULT_P where ID_QUESTION = $q_id";
                    $l_options = $db -> select($options);
                    foreach($l_options as $q => $r)
                    {
                ?>          
                            <p class="a" >
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

</div>
