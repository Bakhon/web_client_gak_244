<div class="row">
<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список форм распределения</h5>                
            </div>
            <div class="ibox-content">                
                <table class="table table-bordered">                                     
                    <?php 
                        foreach($role as $t=>$y){
                            $s = '';
                            if($y['ID'] == $id_role){
                                $s = 'active';
                            }
                        echo '<tr class="'.$s.'" onclick="window.location.href='."'app_menu_role?id=".$y['ID']."'".'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['NAME'].'</td>
                            <td>'.$y['NAME_TYPE'].'</td>
                            </tr>';
                        }
                    ?>                    
                </table>                                                
            </div>                                    
        </div>
    </div>
    
     <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Список меню</h5>               
            </div>
            <div class="ibox-content">            
                <div class="panel-group dirFormsTable" id="accordion">
                    <form method="post">                        
                        <table class="table table-bordered">
                            <?php 
                                foreach($menu_role as $k=>$v){
                                    $s = '';
                                    if($v['CH'] !== '0'){$s = 'checked';}
                                    
                                    echo '<tr>
                                        <td><input type="checkbox" name="id_menu[]" value="'.$v['ID'].'" '.$s.'/></td>
                                        <td>'.$v['NAME'].'</td>
                                        <td>'.$v['FUNCT'].'</td>
                                    </tr>';
                                }
                            ?>                            
                        </table>
                        <input type="hidden" name="id_role" value="<?php echo $id_role; ?>"/>
                        <input type="submit" class="btn btn-success" value="Сохранить"/>
                    </form>
                </div>                                                
            </div>                                    
        </div>
    </div>
    
</div>

</div>