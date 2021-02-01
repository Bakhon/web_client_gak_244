<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <?php
                    $i = 0; 
                    foreach($hlp as $k=>$v){
                        $s = '';
                        if($i == 0){$s = 'active';}
                        if($v['TYPE'] == '0'){
                            $t = 'Общий';
                        }else $t = $v['TYPE'];
                        echo '<li class="'.$s.'"><a data-toggle="tab" href="#hlp_'.$v['ID'].'" aria-expanded="false">'.$t.' 
                        <span class="label label-warning edit_hlp" id="'.$v['ID'].'"><i class="fa fa-edit"></i></span>
                        </a></li>';
                    } 
                ?>
            </ul>
            <div class="tab-content">
                <?php
                  $i = 0; 
                  foreach($hlp as $k=>$v){
                    $s = '';
                    if($i == 0){$s = 'active';}
                ?>                
                <div id="hlp_<?php echo $v['ID']; ?>" class="tab-pane <?php echo $s; ?>">
                    <div class="panel-body">
                        <strong><?php echo $v['OPIS']; ?></strong>                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Меню</h5>                                        
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table table-hover no-margins">                                            
                                            <tbody>
                                            <?php 
                                                $tree = tree_for_help($v['ID']);
                                                foreach($tree as $i=>$tr){
                                            ?>
                                                <tr>
                                                <td><span class="label label-warning">Canceled</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                                <td>Monica</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                                </tr>
                                            <?php
                                                }                                                
                                            ?>     
                                            <tr>
                                                <td><span class="label label-warning">Canceled</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                                <td>Monica</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                                </tr>                                                                                   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-lg-9"></div>
                        </div>                        
                    </div>
                </div>
                <?php } ?>                            
            </div>
        </div>                            
    </div>                 
</div> 


<style>
.edit_hlp{
    cursor: pointer;
}
</style>