<?php 
    $active_branch = '';
    if(isset($dan['active_branch'])){
        $active_branch = $dan['active_branch'];
    }
?>
<div class="row">
    <div class="col-lg-12">&nbsp;</div>                        
    <div class="col-lg-12">
        <div class="ibox float-e-margins well">
            <div class="ibox-title">
                <h5>План на 
                    <span class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle"><?php echo $method->year; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">                        
                        <?php 
                            foreach($dan['list_year'] as $k=>$v){
                                echo '<li><a href="marketing_edit_plan?view_year='.$v.'">'.$v.'</a></li>';
                            }
                        ?>
                    </ul>
                    </span>
                г.</h5>                
            </div>
            <div class="ibox-content">
                <div class="tabs-container">
                    <div class="tabs-left">
                        <ul class="nav nav-tabs">
                            <?php 
                                $i = 0;
                                foreach($dan['plan'] as $k=>$v){
                                    $s = '';
                                    if($active_branch == ''){
                                        if($i == 0){$s = 'active';}
                                    }else{
                                        if($active_branch == $v['id']){
                                            $s = 'active';
                                        }
                                    }
                                    
                                    echo '<li class="'.$s.'"><a data-toggle="tab" href="#tab-'.$v['id'].'">'.$v['name'].'</a></li>';
                                    $i++;
                                }
                            ?>
                        </ul>
                        
                        <div class="tab-content ">
                            <?php 
                                $i = 0;
                                foreach($dan['plan'] as $k=>$v){
                                    $s = '';
                                    if($active_branch == ''){
                                        if($i == 0){$s = 'active';}
                                    }else{
                                        if($active_branch == $v['id']){
                                            $s = 'active';
                                        }
                                    }
                                    
                                    echo '<div id="tab-'.$v['id'].'" class="tab-pane '.$s.'"><div class="panel-body">';                                    
                                    foreach($v['product'] as $t=>$d){
                                        echo '
                                        <div class="col-lg-3">
                                            <div class="ibox float-e-margins well">
                                                <div class="ibox-title">
                                                    <h5>'.$d['name'].'</h5> 
                                                    <button class="btn btn-success btn-xs pull-right edit_plan" data-toggle="modal" data-target="#myModal6">
                                                        <span class="label label-success edit_span">
                                                            <span class="edit" region_name="'.$v['name'].'" pr_name="'.$d['name'].'"  sumplan="0" region="'.$v['id'].'" product="'.$d['id'].'" id="0"><i class="fa fa-plus"></i></span>
                                                        </span>
                                                    </button>                                               
                                                </div>
                                                <div class="ibox-content">
                                                    <ul class="list-group clear-list m-t">';
                                                    $pay_sum = 0;
                                                    foreach($d['plan'] as $l=>$p){
                                                        echo '<li class="list-group-item fist-item edit_plan" style="cursor: pointer;" data-toggle="modal" data-target="#myModal6">
                                                            <span class="pull-right">
                                                                <strong>'.number_format($p['SUM_PLAN'], 0, ',', ' ').'</strong>
                                                            </span>
                                                            <span class="label label-success edit_span">
                                                                <span class="edit" region_name="'.$v['name'].'" pr_name="'.$d['name'].'"  sumplan="'.$p['SUM_PLAN'].'" region="'.$v['id'].'" product="'.$d['id'].'" id="'.$p['ID'].'">'.$p['MONTH_INT'].'</span>
                                                            </span> 
                                                            <span>'.$dan['month_name'][$p['MONTH_INT']-1].'</span>
                                                        </li>';
                                                        $pay_sum += $p['SUM_PLAN'];
                                                    }                                                                                        
                                                    echo '</ul><hr /><h3>Итого: '.$pay_sum.'</h3>
                                                </div>';                                                
                                            echo ' </div>
                                        </div>';
                                    }
                                    echo '</div></div>';
                                    $i++;
                                }
                            ?>                                                        
                        </div>                                                                        
                    </div>
                </div>
                    
                    
            </div>
        </div>                                                                
    </div>                                                       
</div>      


<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактирование плана на <?php echo $method->year; ?></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="set_plan" method="post">   
                    <input type="hidden" name="set_year" value="<?php echo $method->year; ?>"/>
                    <input type="hidden" name="id_plan" value=""/>
                    <input type="hidden" name="region" value=""/>
                    <input type="hidden" name="product" value=""/>
                    
                    <h3>Регион: <span id="region" class="label-success"></span></h3>
                    <hr />                    
                    <h3>Продукт: <span id="product" class="label-success"></span></h3>
                    <hr />
                                        
                    <label>Месяц</label>
                    <select class="form-control" name="month" id="month">
                        <?php 
                            for($i=0; $i<12;$i++){
                                echo '<option value="'.$i.'">'.$dan['month_name'][$i].'</option>';
                            }
                        ?>                        
                    </select>
                    <label>Сумма по плaну</label>
                    <input type="number" name="sum_plan" class="form-control" value=""/>
                </form>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary set_plan">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs li.active{
    background-color: #1c84c6;
    color: #fff;
}        
</style>

<script>
    $('.edit_plan').click(function(){
        var s = $(this).children('.edit_span').children('.edit');
        var sumplan = s.attr('sumplan');
        var region = s.attr('region');
        var product = s.attr('product');
        var id = s.attr('id');
        var month = s.html();
        if(month == ''){
            month = 1;
        }
        
        $('input[name=id_plan]').val(id);
        $('input[name=region]').val(region);
        $('input[name=product]').val(product);
        $('input[name=sum_plan]').val(sumplan);
        $('#month').val(month-1);
        
        $('#region').html(s.attr('region_name'));
        $('#product').html(s.attr('pr_name'));             
    });
        
    $('.set_plan').click(function(){
        $('#set_plan').submit();
    })
</script>
               