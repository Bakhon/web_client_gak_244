<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox float-e-margins">    
            <div class="ibox-title">    
                <?php 
                    if($plan->on_edit){
                ?>                                           
                <div class="pull-left">
                    <button class="btn btn-info btn-sm edit_plan" data-toggle="modal" data-target="#edit" id="0"><i class="fa fa-plus"></i> Добавить</button>
                    <span class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-success btn-sm drop down-toggle" aria-expanded="false"><i class="fa fa-filter"></i> <span class="caret"></span> Фильтр</button>
                        <ul class="dropdown-menu">
                            <li><a href="plan">Снять фильтр</a></li>
                            <li class="divider"></li>
                            <?php
                            foreach($plan->result['states'] as $k=>$v){
                                echo '<li><a href="plan?state='.$v['ID'].'">'.$v['NAME'].'</a></li>';
                            }
                            ?>
                            <li class="divider"></li>
                            <li><a href="plan?for_me">Назначенные мне</a></li>                            
                        </ul>
                    </span>   
                    <a href="plan?print_plan" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Печать</a>                 
                    <a href="plan?print_plan&excel" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-excel"></i> Excel</a>
                </div>
                <?php } ?>
                <h3 style="text-align: center;">План по автоматизации ГАК</h3>
            </div>
    
            <div class="ibox-content" style="height: 65rem;overflow: auto;">
                <div class="row">
                    <div class="col-lg-12" id="panel_table">
                        <?php                             
                            $list = $plan->result['list'];
                            $onedit = $plan->on_edit;
                            require_once __DIR__.'/plan/table.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактор</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row" enctype="multipart/form-data" method="post" id="save_edit">
                    <div class="form-group">
                        <label class="col-lg-3">Краткое описание</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="15" name="name"></textarea>
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Заказчики</label>
                        <div class="col-lg-9">
                            <select data-placeholder="Департаменты" style="width:100%;" class="chosen-select md_dep" tabindex="5" name="dep[]" multiple>
                                <?php 
                                    foreach($plan->result['dep'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Исполнители</label>
                        <div class="col-lg-9">
                            <select data-placeholder="Исполнители" style="width:100%;" class="chosen-select md_user" tabindex="5" name="users[]" multiple>
                                <?php 
                                    foreach($plan->result['users'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['FIO'].'</option>';
                                    }
                                ?>                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Срок реализации до</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="date_plan" value="" data-mask="99.99.9999">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Файл с ТЗ</label>
                        <div class="col-lg-9">
                            <input type="file" name="tz"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">№ п/п</label>
                        <div class="col-lg-9">                            
                            <input type="text" name="num_pp" class="form-control" value="<?php echo $plan->result['num_pp_next']; ?>">                                                                                   
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Установить внеплана</label>
                        <div class="col-lg-9">       
                            <label>
                                <input type="checkbox" name="plan_out" id="plan_out"/>
                                Вне плана
                            </label>                                                                                                                                    
                        </div>
                    </div>
                    <input type="hidden" name="save" value="0"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="set_state">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="set_last_state" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактор</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row" method="post" id="set_isp">
                    <div class="form-group">
                        <label class="col-lg-3">Коммментарий</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="comment_example"></textarea>
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Дата выполнения</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="date_example" value="<?php echo date('d.m.Y'); ?>" data-mask="99.99.9999">
                            </div>
                        </div>                        
                    </div>           
                    <input type="hidden" name="set_isp_last" value="0"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="set_last_state_btn">Сохранить</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="add_act" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Акт приема-передач</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Наименование</th>
                            <th>Файл</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_files">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                            
                    </tbody>
                    </table>                                                                                                                                                                                                                 
                </div>                                
            </div>
            
            <div class="modal-footer">      
                <div class="row">
                    <form method="post" enctype="multipart/form-data" id="form_files">
                        <div class="col-lg-6">
                          <!--  <select name="set_new_contract_file" class="set_new_contract_file form-control pull-left"></select> -->
                            <input type="hidden" class="set_new_contract_file form-control pull-left" name="set_new_contract_file" />     
                        </div>
                        <div class="col-lg-4">
                            <input type="file" id="btn_load_file" name="upload" style="display: none;"/>
                            <span class="load_file btn btn-success btn-block">Выбрать файл и сохранить</span>
                        </div>
                        <input type="hidden" name="contract_file_id" value=""/>
                    </form>
                    
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>                                              
            </div>
        </div>
    </div>
</div>




<div class="modal inmodal fade" id="view_act" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Акт приема-передач</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Наименование</th>
                            <th>Файл</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_files">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                            
                    </tbody>
                    </table>                                                                                                                                                                                                                 
                </div>                                
            </div>
            
            <div class="modal-footer">      
                <div class="row">
                    <form method="post" enctype="multipart/form-data" id="form_files">
                        <div class="col-lg-6">
                          <!--  <select name="set_new_contract_file" class="set_new_contract_file form-control pull-left"></select> -->
                            <input type="hidden" class="set_new_contract_file form-control pull-left" name="set_new_contract_file" />     
                        </div>
                        <div class="col-lg-4">
                            <input type="file" id="btn_load_file" name="upload" style="display: none;"/>
                            <span class="load_file btn btn-success btn-block">Выбрать файл и сохранить</span>
                        </div>
                        <input type="hidden" name="view_file_id" value=""/>
                    </form>
                    
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>                                              
            </div>
        </div>
    </div>
</div>

<script>

$('.contracts_files').click(function(){
    var id = $(this).attr('data');   
    $('input[name=contract_file_id]').val(id);
    $('.set_new_contract_file').html('');
    $('#table_files').html('');
    var html = '';
    var num = 0;
    $.post(window.location.href, {"contract_files":id}, function(data){
        console.log(data);
        $.each(data, function(i, e){                 
            if(e.list_files.length > 0){                   
                $.each(e.list_files, function(n, d){
                    num++;
                    html += '<tr><td>'+num+'</td>'+
                    '<td>'+d.DEFAULT_NAME+'</td>'+
                    '<td><a download href="ftp://upload:Astana2014@192.168.5.2'+d.FILE_NAME+'" target="_blank" class="btn btn-success">Скачать(Загружен '+d.POST_DATE+' г.)</a></td>'+
                    '<td><span class="btn btn-danger del_file" id="'+d.ID+'"><i class="fa fa-trash"></i></span></td></tr>';
                });
            }
        });  
        $('#table_files').html(html);       
    }); 
});

$('.view_files').click(function(){
    var id = $(this).attr('data');   
    $('input[name=contract_file_id]').val(id);    
    $('#table_files').html('');
    var html = '';
    var num = 0;
    $.post(window.location.href, {"contract_files":id}, function(data){
        console.log(data);
        $.each(data, function(i, e){                 
            if(e.list_files.length > 0){                   
                $.each(e.list_files, function(n, d){
                    num++;
                    html += '<tr><td>'+num+'</td>'+
                    '<td>'+d.DEFAULT_NAME+'</td>'+
                    '<td><a download href="ftp://upload:Astana2014@192.168.5.2'+d.FILE_NAME+'" target="_blank" class="btn btn-success">Скачать(Загружен '+d.POST_DATE+' г.)</a></td>'+
                    '<td><span class="btn btn-danger del_file" id="'+d.ID+'"><i class="fa fa-trash"></i></span></td></tr>';
                });
            }else{
                alert('Нет прикрепленных файлов!');               
            }
        });  
        $('#table_files').html(html);       
    }); 
});

$('.load_file').click(function(){
    $('#btn_load_file').click();
});

$('#btn_load_file').on('change', function(){
    $('#form_files').submit();
});


$('body').on('click', '.del_file', function(){
    var id = $(this).attr('id');
    console.log(id);
    $.post(window.location.href, {"delete_file":id}, function(data){
        //console.log(data);
        $('#table_files').html('');
        var html = '';
        var num=0;
        $.each(data, function(i, e){
            if(e.list_files.length > 0){                
                $.each(e.list_files, function(n, d){
                    num++;
                    html += '<tr><td>'+num+'</td>'+
                    '<td>'+d.DEFAULT_NAME+'</td>'+
                    '<td><a download href="ftp://upload:Astana2014@192.168.5.2'+d.FILE_NAME+'" target="_blank" class="btn btn-success">Скачать (Загружен '+d.POST_DATE+' г.)</a></td>'+
                    '<td><span class="btn btn-danger del_file" id="'+d.ID+'"><i class="fa fa-trash"></i></span></td></tr>';
                });
            }
        }); 
        $('#table_files').html(html);                   
    }) 
});

</script>


<script>
   var max_num_pp = <?php echo $plan->result['num_pp_next']; ?>;
</script>