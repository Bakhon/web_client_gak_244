<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">
                <div id="jstree1">
                    <ul>
                    <?php 
                        foreach($dan as $k=>$v){
                            echo '<li class="jstree-open">'.$v['NAME'];
                            if(isset($v['departments'])){
                                echo '<ul>';
                                foreach($v['departments'] as $a=>$d)
                                {
                                    echo '<li class="jstree-open">'.$d['NAME'].'<ul>';                                    
                                    foreach($d['dolzh'] as $i=>$z){
                                        echo "<li onclick='set_emp_id(".$z['ID'].");' data-jstree='{".'"type":"dolzh"'."}'>".$z['D_NAME']."</li>";
                                    }
                                    echo '</ul></li>';
                                }
                                echo '</ul>';
                            }else{
                                echo '<ul>';
                                foreach($v['dolzh'] as $a=>$d){
                                    echo "<li data-jstree='{".'"type":"dolzh"'."}'>".$d['D_NAME']."</li>";
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    ?>
                    </ul>
                </div>                       
            </div>
        </div> 
        
    </div>
    
    <div class="col-lg-6">
        <form method="post">
        <input id="position_id" name="position_id" style="display: none;"/>
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="ibox float-e-margins">
            <div id="place_for_privilege" class="ibox-content" style="height:820px;overflow: auto;">
                <?php
                    foreach($list_events as $k => $v){
                ?>
                <p>
                    <label>
                        <input name="item[]" type="checkbox" value="<?php echo $v['ID']; ?>"/> <?php echo $v['ITEM_NAME']; ?>
                    </label>
                </p>
                <hr/>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-sm btn-primary">Сохранить</button>
        </div>
            </div>
        </div>
        </form>
    </div>    
</div>
<script>
    function set_emp_id(emp_id){
        $('#position_id').val(emp_id);
        var position_id_get_privelege = $('#position_id').val();
        $.post
        ('docs_privilege', 
            {"get_docs_privilege" : 'get_docs_privilege',
            "position_id_get_privelege" : position_id_get_privelege},
            function(d){
                $('#place_for_privilege').html(d);
            }
        )
    }
</script>