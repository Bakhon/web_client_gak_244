<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <button class="btn btn-info btn-block edit" data="0" data-toggle="modal" data-target="#modal_edit">Создать</button>
                </div>
                <div class="ibox-content">
                    <ul class="list-group clear-list m-t">
                        <li class="list-group-item fist-item">
                            Количество договоров <span class="pull-right"><?php echo $dan['info']['CNT']; ?></span>                            
                        </li>
                        <li class="list-group-item fist-item">
                            Активных <span class="pull-right"><?php echo $dan['info']['ACT']; ?></span>                            
                        </li>
                        <li class="list-group-item fist-item">
                            В разработке <span class="pull-right"><?php echo $dan['info']['NO_ACT']; ?></span>                            
                        </li>
                        <li class="list-group-item fist-item">
                            Удаленных <span class="pull-right">0</span>                            
                        </li>
                    </ul>
                    
                    <div>
                        <center><label>Фильтрация</label></center>
                        <select class="form-control">
                            <?php 
                            foreach($dan['forms_type'] as $k=>$v){
                                echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                            }
                            ?>                            
                        </select>
                    </div>
                </div>            
            </div>        
        </div>
        <div class="col-lg-9">
            <h2>Список типовых форм для договоров страхования</h2>
                               
            <?php foreach($dan['table'] as $k=>$v){ ?>
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">                                                            
                    <h5 style="margin-top: 5px;"><?php echo $v['NAME']; ?></h5> 
                    <span class="label label-primary" style="margin-top: 5px;"><?php echo $v['VERS']; ?></span>
                    <div class="ibox-tools tooltip-demo">
                        <button class="btn btn-primary btn-outline set_params" data="<?php echo $v['ID']; ?>" data-toggle="modal" data-target="#modal_options"><i class="fa fa-sign-in"></i> Параметры</button>
                        <a href="typical_forms?id=<?php echo $v['ID']; ?>" class="btn btn-primary"><i class="fa fa-code"></i> Форма</a>                                     
                        <a href="#" class="dropdown-toggle btn btn-danger btn-outline" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i> Меню
                        </a>                        
                        <ul class="dropdown-menu dropdown-user">                            
                            <li><a class="edit" data="<?php echo $v['ID']; ?>" data-toggle="modal" data-target="#modal_edit" style="cursor: pointer;">Редактировать</a></li>
                            <li><a style="cursor: pointer;">Удалить</a></li>
                        </ul>     
                        <a class="collapse-link btn btn-success"><i class="fa fa-chevron-up"></i></a>                           
                    </div>                                        
                </div>
                <div class="ibox-content" style="display: none;">
                    <h5>Период действия с: <span class="text-info"><?php echo $v['DATE_BEGIN']; 
                        if($v['DATE_END'] !== ''){
                            echo ' по '.$v['DATE_END'];
                        } 
                    ?></span></h5>                    
                    <h5><?php echo $v['DESCRIPT']; ?></h5>     
                    <hr />
                    <h4>Параметры для выбора текущего договора</h4>
                    <div class="row">
                        <?php foreach($v['LIST_CONDIT'] as $l=>$c) 
                        { 
                            echo '
                                <div class="col-lg-12" id="pr_'.$c['ID'].'">                                
                                <div class="col-lg-6">
                                    <button id="'.$c['ID'].'" class="btn btn-danger btn-xs trash_param"><i class="fa fa-trash"></i></button>
                                    <label>'.$c['TABLE_META'].' - '.$c['COL_META'].' '.$c['NAME'].' '.$c['RES'].'</label>
                                </div>
                                <div class="col-lg-6"><label>'.$c['TABLE_NAME'].'.'.$c['COL_NAME'].' '.$c['CONDT'].' '.$c['RES'].'</label></div>
                                </div>                                
                            ';
                        } 
                        ?>                                                     
                    </div>                  
                </div>
            </div>                                                                                    
            <?php } ?>                
        </div>
    </div>
</div>  

<div class="modal inmodal fade" id="modal_edit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактор типовых форм</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form">
                    <input type="hidden" name="edit_form" id="ID" value="0"/>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Наименование</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="" name="NAME" id="NAME"/>                            
                            <label><input type="checkbox" value="1" name="ACTIVE" id="ACTIVE"> Активный</label>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Версия</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="" name="VERS" id="VERS"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Дата начала</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="DATE_BEGIN" type="text" class="form-control" name="DATE_BEGIN" data-mask="99.99.9999" value="">
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Дата окончания</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="DATE_END" type="text" class="form-control" name="DATE_END" data-mask="99.99.9999" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Тип документа</label>
                        <div class="col-lg-9">                            
                            <select class="form-control" name="TYP" id="TYP">                                
                            <?php 
                                foreach($dan['dic_forms'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                }
                            ?>    
                            </select>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Описание</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="DESCRIPT" id="DESCRIPT"></textarea>                            
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="save_form">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>  



<div class="modal inmodal fade" id="modal_options" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактор типовых форм</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form_params">
                    <input type="hidden" name="set_params" value="0"/>                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Таблицы</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_TABLE" id="PARAMS_TABLE">                                
                                <?php 
                                    foreach($dan['list_tables'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['TABLE_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_TABLE">
                                <?php echo $dan['list_tables'][0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
                    </div>
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Колонки</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_COLUMNS" id="PARAMS_COLUMNS">                                
                                <?php 
                                    foreach($dan['list_columns'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['COL_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_COLUMNS">
                                <?php echo $dan['list_columns'][0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
                    </div>     
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Условие</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_CONDIT" id="PARAMS_CONDIT">
                            <?php 
                                foreach($dan['list_condit'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIT'].'">'.$v['NAME'].' ('.$v['CONDT'].')</option>';
                                }
                            ?>
                            </select> 
                            <span class="help-block m-b-none"> Описание: 
                                <span class="text-info" id="H_PARAMS_CONDIT"><?php echo $dan['list_condit'][0]['DESCRIT']; ?></span> 
                            </span>                         
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Входящий параметр</label>
                        <div class="col-lg-9">
                            <input type="text" name="PARAMS_RES" class="form-control" value=""/>
                            <span class="help-block m-b-none">
                                Введите необходимый параметр для будущего определения и выбора текущей типовой формы  
                            </span>                          
                        </div>                         
                    </div>                                                                          
                </form>
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="save_form_params">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>  


<script>
    $('#save_form').click(function(){
       $('#form').submit(); 
    });
    
    $('#save_form_params').click(function(){
        $('#form_params').submit();
    })
    
    $('.edit').click(function(){
        var id = $(this).attr('data');
        $.post(window.location.href, {"form_dan":id}, function(data){
           var j = JSON.parse(data);           
           $.each(j, function(ind, text){
            if(ind == 'ACTIVE'){
                if(text == "1"){
                    $('#ACTIVE').prop("checked", true);
                }else{
                    $('#ACTIVE').prop("checked", false);
                }
            }else{
                $('#'+ind).val(text);    
            }                          
           });
        });
    });
    
    $('.set_params').click(function(){
        var id = $(this).attr('data');
        $('input[name=set_params]').val(id);
    })
    
    $('#PARAMS_TABLE').change(function(){
        var id = $(this).val();
        $.post(window.location.href, {"list_params_col_table":id}, function(data){
           $('#PARAMS_COLUMNS').html(data);
            $('#PARAMS_COLUMNS').change(); 
        });         
    });
    
    $('.st_help').change(function(){
       var text = $('option:selected', this).attr('data');
       var id = $(this).attr('id');
       $('#H_'+id).html(text);       
    });
    
    $('.trash_param').click(function(){
        var id = $(this).attr('id');
        $.post(window.location.href, {"del_param":id}, function(data){
           if(data.trim() == ''){
            $('#pr_'+id).remove(); 
           }else{
              alert(data);
           }            
        });        
    })
</script>