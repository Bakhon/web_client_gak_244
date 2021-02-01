<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Список таблиц в БД</h5>
                </div>
                <div class="ibox-content">                 
                    <div class="list-group table-of-contents list_tables white-bg">
                        <?php 
                            foreach($dan['TABLES'] as $k=>$v){
                                echo '<a href="#'.$v['NAME'].'" class="list-group-item table_db">'.$v['NAME'].'</a>';      
                            }
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Таблица: <span class="tablename"></span></h5>
                </div>
                <div class="ibox-content">  
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Меты таблицы</label>
                            <div class="col-lg-8">
                                <input type="text" id="TABLE_META" placeholder="Меты таблицы" class="form-control">                                 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Описание таблицы</label>
                            <div class="col-lg-8">
                                <textarea id="TABLE_DECRIPT" class="form-control"></textarea>                                 
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Привязка таблицы (UNION ALL)</label>
                            <div class="col-lg-8">
                                <input type="text" id="TABLE_UNIONALL" placeholder="Введите имя таблицы на английском языке" class="form-control">                                 
                            </div>
                        </div>
                        <input type="hidden" id="ID_TABLE" value="0"/>
                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-8">
                                <button class="btn btn-primary" id="save_meta_table">Сохранить</button>                                 
                            </div>
                        </div>                                               
                    </div>                    
                </div>
            </div>
            
            
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Колонки в таблице: <span class="tablename"></span></h5>
                    <span class="pull-right">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_new_meta_table"><i class="fa fa-plus-circle"></i> Создать мету</button>
                    </span>
                </div>
                <div class="ibox-content">
                    <label class="col-lg-3"></label>  
                    <label class="col-lg-3">Наименование</label>
                    <label class="col-lg-3">Функция</label>
                    <label class="col-lg-3">Описание</label>                    
                    <div class="form-horizontal">
                        <div id="list_columns">                        
                            
                        </div>                                                                   
                    </div>                    
                </div>
            </div>
            
        </div>
    </div>
</div>    


<div class="modal inmodal fade" id="add_new_meta_table" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Создать новую мету</h4></div>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">                
                <div class="row">                    
                    <div class="form-group">                        
                        <label>Наименование</label>                                
                        <input id="NAME_NEWMETA" type="text" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Функция или Select</label>                        
                        <input id="FUNCT_NEWMETA" type="text" class="form-control" value="">
                        <span class="help-block text-info">
                            <b>Пример Функции:</b> client_name(id_annuit) fio <br />
                            <b>Пример Select:</b> (select contract_num from contracts where cnct_id = id_head) osn_contract_num 
                        </span>
                    </div>
                    <div class="form-group"> 
                        <label>Описание</label>                                                   
                        <input id="DESC_NEWMETA" type="text" class="form-control" value="">                                
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">                
                <button id="save_newmeta" class="btn btn-success" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>                  
        </div>        
    </div>                                    
</div>        

<script>
    
    var h = $(window).height() - 400;
    $('.list_tables').attr('style', 'height: '+h+'px;overflow: auto;');
    
    $('.table_db').click(function(){
        $('.list_tables').children('.active').removeClass('active');
        $(this).addClass('active');
        var name = $(this).html();
        $.post(window.location.href, {"table_db":name}, function(data){
            var j = JSON.parse(data);
            console.log(j);
            $('.tablename').html(j.TABLENAME); 
            $("#TABLE_META").val(j.META_TABLE['TABLE_META']);
            $("#TABLE_DECRIPT").val(j.META_TABLE['DESCRIPT']);
            $("#ID_TABLE").val(j.META_TABLE['ID']);
            $("#TABLE_UNIONALL").val(j.META_TABLE['UNIONALL']);
            $('#list_columns').html('');            
                        
            var cl = j.COLUMNS;                        
            for(var i=0;i<cl.length;i++){
                var mc_btn = '';
                if(cl[i]['MC'] !== '0'){
                    mc_btn = '<button data="'+cl[i]['ID']+'" title="Удалить запись" class="btn btn-danger del_meta"><i class="fa fa-trash"></i></button>';
                }
                var html = '<div class="form-group" id="G'+cl[i]['ID']+'"><label class="col-lg-3 control-label">'+cl[i]['COLUMN_NAME']+' ('+cl[i]['DATA_TYPE_RUS']+')</label>'+
                '<div class="col-lg-3">'+
                '<input id="'+cl[i]['COLUMN_NAME']+'" data="'+cl[i]['ID']+'" type="text" class="form-control" value="'+cl[i]['COL_META']+'">'+
                '</div>'+
                
                '<div class="col-lg-3">'+
                '<input id="F_'+cl[i]['COLUMN_NAME']+'" data="'+cl[i]['ID']+'" type="text" class="form-control" value="'+cl[i]['FUNCT']+'">'+
                '</div>'+
                                
                '<div class="col-lg-3"><div class="input-group">'+
                '<input id="DS_'+cl[i]['COLUMN_NAME']+'" data="'+cl[i]['ID']+'" type="text" class="form-control" value="'+cl[i]['DESCRIPT']+'">'+
                '<span class="input-group-btn">'+
                    '<button data="'+cl[i]['COLUMN_NAME']+'" title="Сохранить данные" class="btn btn-primary save_col_table"><i class="fa fa-check"></i></button>'+
                    mc_btn+                    
                '</span></div></div></div>';                
                $('#list_columns').append(html);
            }  
                                            
        }); 
    });
    
    $('#save_meta_table').click(function(){
        var id = $('#ID_TABLE').val();
        var table_name = $('.tablename').html();
        var table_meta = $('#TABLE_META').val();
        var descr = $('#TABLE_DECRIPT').val();
        var unionall = $('#TABLE_UNIONALL').val();
        if(table_name.trim() == ''){
            alert('Не выбрана таблица');
            return;
        }
        
        if(table_meta.trim() == ''){
            alert('Мета таблицы не может быть пустой');
            return;
        }
        
        $.post(window.location.href, {
            "save_meta_table":id,
            "table_name":table_name, 
            "table_meta":table_meta,
            "table_unionall": unionall,
            "descr":descr
        }, function(data){
            var j = JSON.parse(data);
            if(j.msg.trim() !== ''){
                alert(j.msg);
                return;
            }
            $('#ID_TABLE').val(j.id);            
        });                 
    });
    
    $('body').on('click', '.save_col_table', function(){         
       var id = $(this).attr('data');
       var meta = $('#'+id).val();
       var desc = $('#DS_'+id).val();
       var funct = $('#F_'+id).val();
       var table_id = $('#ID_TABLE').val();
       
       if(table_id.trim() == '0'){
          alert('Необходимо сначала сохранить таблицу');
          return;
       }
              
       $.post(window.location.href, {"save_meta_col":id, "id_table":table_id, "meta":meta, "desc":desc, "funct":funct}, function(data){
          if(data.trim() !== ''){
            alert(data);
          }
       });       
    });
    
    $('body').on('click', '.del_meta', function(){
        var id = $(this).attr('data');        
        $.post(window.location.href, {"del_meta":id}, function(data){
           if(data.trim() !== ''){
              alert(data);
           }else{
              $('#G'+id).remove();
           }
        });
    })
    
    
    var url = window.location.href;
    var u = url.split('#');
    if(u.length > 1){
        var ps = u[1];    
        $('.table_db').each(function(){
            if($(this).attr('href') == '#'+ps){
                $(this).addClass('active');
                $(this).click();
            }
        });    
    }
    
    
    
    $('#save_newmeta').click(function(){
        var 
            id_table = $('#ID_TABLE').val(),
            name = $('#NAME_NEWMETA').val(),
            funct = $('#FUNCT_NEWMETA').val(),
            desc = $('#DESC_NEWMETA').val();
        $.post(window.location.href, {"new_meta":id_table, "name":name, "funct":funct, "desc":desc}, function(data){
            console.log(data);
            
            var j = JSON.parse(data);
            if(j.msg.trim() !== ''){
                alert(j.msg);
                return;
            }
            
            $('#list_columns').append(j.res);            
        });
    });
</script>