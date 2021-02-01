<div class="wrapper wrapper-content">
    <div class="row">
                
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <legend>Список</legend>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">        
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" class="">
                                    <i class="fa fa-filter"></i> Фильтрация                                                                                                  
                                </a>                                
                            </h5>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-4">
                                        <label>Показать по филиалам</label>
                                        <select class="form-control" id="filter_branch">
                                            <option value="0">Все филиалы</option>
                                            <?php 
                                                foreach($dan['list_region'] as $k=>$v){
                                                    $s = '';
                                                    if($v['ID'] == $method->branch){
                                                        $s = 'selected';
                                                    }
                                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['TYPE_NAME'].' - '.$v['NAME'].'</option>';
                                                }
                                            ?>
                                        </select>  
                                    </div>
                                    <?php 
                                        $btn_agent = 'btn-success';
                                        $btn_insp = 'btn-success';                                        
                                        if($dan['active_btn']['agent']){
                                            $btn_agent = 'btn-default';
                                        }
                                        if($dan['active_btn']['insp']){
                                            $btn_insp = 'btn-default';
                                        }
                                    ?>
                                    <div class="col-lg-1">
                                        <label>&nbsp;</label>
                                        <button class="btn <?php echo $btn_agent; ?>" id="agents"><i class="fa fa-group"></i> По агентам</button>
                                    </div>
                                    <div class="col-lg-1">
                                        <label>&nbsp;</label>
                                        <button class="btn <?php echo $btn_insp; ?>" id="insp"><i class="fa fa-group"></i> По инспекторам</button>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true">1 КВАРТАЛ</a></li>
                                    <li><a href="#tab-2" data-toggle="tab" aria-expanded="true">2 КВАРТАЛ</a></li>
                                    <li><a href="#tab-3" data-toggle="tab" aria-expanded="true">3 КВАРТАЛ</a></li>
                                    <li><a href="#tab-4" data-toggle="tab" aria-expanded="true">4 КВАРТАЛ</a></li>
                                    <li class="pull-right">
                                        <button class="btn btn-primary" id="print"><i class="fa fa-print"></i></button>
                                    </li>                                    
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">   
                                <?php 
                                    for($t=0;$t<4;$t++){
                                        $act = '';
                                        if($t == 0){
                                            $act = 'active';
                                        }
                                        $c_begin = $t*3;
                                        $c_end = $c_begin+3;
                                ?>                                
                                <div class="tab-pane <?php echo $act; ?>" id="tab-<?php echo $t+1; ?>">
                                    <?php 
                                        for($i=$c_begin;$i<$c_end;$i++){
                                            foreach($dan['kvartal'][$i] as $k=>$v);
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins well">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right"><i class="fa fa-pie-chart"></i> <?php echo $v['PROC']; ?></span>
                                                <h5><?php echo $v['MONTH_NAME']; ?></h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins"><?php echo str_replace(",", " ", $v['ALL_SUM']); ?></h1>
                                                <div class="stat-percent font-bold text-success"><i class="fa fa-group"></i> <?php echo str_replace(",", " ", $v['RESULT']); ?></div>
                                                <small><i class="fa fa-money"></i> Страховая премия</small>
                                            </div>
                                        </div>
                                        
                                        
                                        <?php  
                                            foreach($dan['agents'][$i] as $k=>$v){
                                                $label = 'label-success';
                                                if($v['ALL_SUM'] < 0){
                                                    $label = 'label-danger';
                                                }
                                        ?>                                                    
                                        <div class="contact-box">
                                            <div class="col-sm-12">
                                                <h3 class="view_contracts" data="<?php echo $v['DATE_VIEW']; ?>" view="<?php echo $v['VIEW_USER']; ?>" id_user="<?php echo $v['ID_AGENT']; ?>"><strong><?php echo $v['AGENT']; ?></strong></h3>
                                                <table class="table no-margins">
                                                    <tr class="<?php echo $label; ?>">
                                                        <td>Общая сумма</td>
                                                        <td><span class="font-bold"><i class="fa fa-money"></i> <?php echo str_replace(",", " ", $v['ALL_SUM']); ?></span></td>
                                                        <td><span class="font-bold pull-right"><i class="fa fa-group"></i> <?php echo str_replace(",", " ", $v['RESULT']); ?></span></td>                                                        
                                                    </tr>
                                                    <?php 
                                                    foreach($v['list_products'] as $l=>$c){
                                                    echo '
                                                    <tr>
                                                        <td>'.$c['PRODUCT'].'</td>
                                                        <td><span class="font-bold"><i class="fa fa-money"></i> '.str_replace(",", " ", $c['ALL_SUM']).'</span></td>
                                                        <td><span class="font-bold text-success pull-right"><i class="fa fa-group"></i> '.str_replace(",", " ", $c['RESULT']).'</span></td>                                                        
                                                    </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </table>                                                                                                
                                            </div>                                            
                                            <div class="clearfix"></div>                                                            
                                        </div>
                                        <?php } ?>                                            
                                    </div>                                                                        
                                    <?php
                                        }
                                        echo '</div>';
                                        }
                                    ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>          
    </div>
</div>    
   
   
   
<button type="button" id="modal_view"  style="display: none;" data-toggle="modal" data-target="#view_contracts"></button>

<div class="modal inmodal fade" id="view_contracts" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modal_title">Список договоров</h4>
                <small class="font-bold" id="modal_opis"></small>
            </div>
            <div class="modal-body" id="modal_body">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary">Печать</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>   


<script>    
    function Filter(){
        var id = $('#filter_branch').val();        
        var ss = 'user_view=agent';
        if($('#insp').attr('class') == 'btn btn-default'){
            ss = 'user_view=insp';
        }
        if(id !== '0'){
            var s = '?filter_branch='+id+'&'+ss;
        }else{
            var s = '?'+ss;
        }
        window.location.href = 'marketing'+s;
    }
    
    $('#filter_branch').change(function(){
        Filter();
    });    
    
    $('#insp').click(function(){
       $('#insp').attr('class', 'btn btn-default');
       $('#agents').attr('class', 'btn-success'); 
       Filter();
    });
    
    $('#agents').click(function(){
       $('#agents').attr('class', 'btn btn-default');
       $('#insp').attr('class', 'btn-success'); 
       Filter();
    });
    
    $('#print').click(function(){
        var id = $('.tab-pane.active').attr('id');
        var html_to_print = $('head').html()+$('#'+id).html();
        var iframe=$('<iframe id="print_frame">'); // создаем iframe в переменную
        $('body').append(iframe);
        
        var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
        var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];        
        doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
        win.print();
        $('iframe').remove();
    });
    
    $('.view_contracts').click(function(){
       var id_user = $(this).attr('id_user');
       var dates = $(this).attr('data');
       var view = $(this).attr('view'); 
       var fio = $(this).html();
       var date = dates.split('.');
       var month = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];              
       
       $.post(window.location.href, {"view_contracts":id_user, "data":dates, "user":view}, function(data){            
            $('#modal_opis').html(fio+'<p>'+month[parseInt(date[1])]+' '+date[2]+' г.</p>');
            $('#modal_body').html(data);    
            $('#modal_view').click();    
       });       
    });
</script>

<style>
    .view_contracts{
        cursor: pointer;
    }
</style>