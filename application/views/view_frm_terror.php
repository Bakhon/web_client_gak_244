<div class="row">
    <div class="col-lg-12" id="osn-panel">        
        <div class="ibox-content">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <?php 
                        foreach($dan as $k=>$v){
                            $s = '';
                            if($terror->active_tab == $v['ID']){ $s = 'active';}
                            echo '<li class="'.$s.'"><a id="'.$v['ID'].'" data-toggle="tab" href="#tab-'.$v['ID'].'"> '.$v['NAME'].'</a></li>';
                        }
                    ?>
                    <li class="<?php if($terror->active_tab == 'option'){ echo 'active';} ?>"><a id="option" data-toggle="tab" href="#tab-option">Опции</a></li>
                </ul>
                
                <div class="tab-content">
                    <?php 
                        foreach($dan as $t=>$s){
                            $typ = $s['TYP'];                            
                    ?>
                    <div id="tab-<?php echo $s['ID']; ?>" class="tab-pane <?php if($terror->active_tab == 1){ echo 'active';} ?>">
                        <div class="panel-body">                            
                            <table class="table table-striped table-bordered table-hover " id="editable" >
                            <?php 
                                if($typ == '1'){
                            ?>
                            <thead>
                                <tr>
                                    <th>№ п\п</th>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Отчество</th>
                                    <th>Дата рождения</th>                                                                        
                                    <th>ИИН</th>
                                    <th>Другие данные</th>
                                    <th>Дата включения</th>
                                    <th>Дата исключения</th>
                                    <th colspan="2">Опции</th>                                    
                                </tr>
                            </thead>
                            <?php
                                }else{
                            ?>
                            <thead>
                                <tr>
                                    <th>№ п\п</th>
                                    <th>Наименование на русском</th>
                                    <th>Наименование на др. языке</th>
                                    <th>Другие данные</th>
                                    <th colspan="2">Опции</th>                                    
                                </tr>
                            </thead>
                            <?php
                                }
                            ?>
                            
                            <tbody>
                            <?php                                 
                                $i = 1;
                                foreach($s['list'] as $k=>$v){
                                    if($typ == 1){
                                    echo '<tr class="gradeX">
                                        <td>'.$i.'</td>
                                        <td>'.$v['LASTNAME'].'</td>
                                        <td>'.$v['FIRSTNAME'].'</td>
                                        <td>'.$v['MIDDLENAME'].'</td>
                                        <td>'.$v['BIRTHDAY'].'</td>
                                        <td>'.$v['IIN_BIN'].'</td>                                                                                                            
                                        <td>'.$v['OTHERS_DAN'].'</td>
                                        <td>'.$v['DATESET'].'</td>
                                        <td>'.$v['DATE_END'].'</td>
                                        <td>
                                            <button class="btn btn-warning btn-xs ed_ter" data-toggle="modal" data-target="#md_fiz" id="'.$v['ID'].'"><i class="fa fa-edit"></i> Edit</button>                                        
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-xs del_ter" id="'.$v['ID'].'"><i class="fa fa-trash"></i> Del</button>
                                        </td>
                                        </tr>';                                    
                                    }else{
                                        echo '<tr class="gradeX">
                                        <td>'.$i.'</td>
                                        <td>'.$v['LASTNAME'].'</td>
                                        <td>'.$v['FIRSTNAME'].'</td>   
                                        <td>'.$v['OTHERS_DAN'].'</td>  
                                        <td>
                                            <button class="btn btn-warning btn-xs ed_ter" data-toggle="modal" data-target="#md_ur" id="'.$v['ID'].'"><i class="fa fa-edit"></i> Edit</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-xs del_ter" id="'.$v['ID'].'"><i class="fa fa-trash"></i> Del</button>
                                        </td>                                                                                                     
                                        </tr>';
                                    }
                                    $i++;
                                }
                            ?>
                            </tbody>
                            </table>                                                        
                        </div>
                    </div>
                    <?php
                        }
                    ?>   
                                                                             
                    <div id="tab-option" class="tab-pane <?php if($terror->active_tab == 'option'){ echo 'active';} ?>">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <a href="#" class="btn btn-info btn-block" id="load_btn">Загрузить файл XLS</a>       
                                    <form method="post" id="form_terror" enctype="multipart/form-data">
                                        <input type="file" id="load_terror" name="load_xls" style="display: none;"/>
                                        <input type="hidden" name="upload_xls"/>
                                    </form>
                                    <br />
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#md_fiz">Добавить Физ.Лицо</button>
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#md_ur">Добавить ЮР.Лицо</button>                                    
                                    <br />
                                    <button type="button" class="btn btn-warning btn-block edit_type_terror" data="0" data-toggle="modal" data-target="#md_type">Добавить тип террористов</button>
                                    <br />
                                    
                                    <button type="button" class="btn btn-light btn-block replace_auto" data="0" data-toggle="modal" data-target="#md_replace">Обновить все списки</button>                                    
                                </div>
                                <div class="col-lg-9">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Список типов террористов</h5>
                                        </div>
                                        <div class="ibox-content">                                                                                            
                                            <?php 
                                                foreach($dan as $k=>$v){
                                            ?>
                                            <a href="#" class="btn btn-primary btn-sm pull-right edit_type_terror" data-toggle="modal" data-target="#md_type" data="<?php echo $v['ID']; ?>"><i class="fa fa-edit"></i></a>
                                            <legend><?php echo $v['NAME']; ?></legend>                                            
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Ссылка на XML файл</label>
                                                <div class="col-lg-9">  
                                                    <div class="input-group">                                                  
                                                        <input type="text" name="url_xml" id="set_xml_<?php echo $v['ID']; ?>" class="form-control" value="<?php echo $v['URL_XML']; ?>">
                                                        <span class="input-group-btn"> 
                                                            <button class="btn btn-primary save_xml" data="<?php echo $v['ID']; ?>"><i class="fa fa-save"></i></button> 
                                                        </span>                  
                                                    </div>                                                                                       
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">
                                                <!--Ссылка на файл Microsoft Excel-->
                                                </label>
                                                <div class="col-lg-9">
                                                    <!--
                                                    <div class="input-group">                                                    
                                                        <input type="text" name="url_xml" id="set_xls_<?php echo $v['ID']; ?>" class="form-control" value="<?php echo $v['URL_XLS']; ?>">
                                                        <span class="input-group-btn"> 
                                                            <button class="btn btn-primary save_xls" data="<?php echo $v['ID']; ?>"><i class="fa fa-save"></i></button> 
                                                        </span>
                                                    </div>
                                                    -->
                                                    <?php 
                                                        $checked = '';
                                                        if($v['SET_AUTH_SAITS'] == '1'){
                                                            $checked = 'checked';
                                                        }
                                                    ?>
                                                    <label>
                                                        <input type="checkbox" id="set_auth_<?php echo $v['ID']; ?>" <?php echo $checked; ?>/> Требуется авторизация пользователя
                                                    </label>
                                                    <br />
                                                    <br />
                                                    <span class="form-text m-b-none">Данная ссылка необходима для автоматического обновления справочника "<?php echo $v['NAME']; ?>"</span>
                                                </div>                                                                                                
                                            </div>                                            
                                            <hr />
                                            <br />
                                            <?php
                                                }
                                            ?>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="upload_terrorists">                                                                        
                                    <?php 
                                        if(isset($dan['xls'])){
                                            print_r($dan);
                                    ?>
                                    <div class="tabs-container">                                                                                      
                                        <div class="tab-content">                                            
                                            <table class="table table-striped table-bordered table-hover " id="editable" >
                                            <thead>
                                                <tr>
                                                    <th>№ п\п</th>
                                                    <th>Наименование</th>
                                                    <th>Наименование2</th>
                                                    <th>Другие данные</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $i = 0;
                                                foreach($dan['xls'] as $k => $v){
                                                echo '<tr class="gradeX">
                                                    <td>'.$i.'</td>
                                                    <td>'.$v['LASTNAME'].'</td>
                                                    <td>'.$v['FIRSTNAME'].'</td>   
                                                    <td>'.$v['OTHERS_DAN'].'</td>                                                                                                       
                                                    </tr>';
                                                $i++;
                                            }?>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>    
            </div>                
        </div>
    </div>            
</div>


<div class="modal inmodal" id="md_fiz" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                <h4 class="modal-title">Добавление Физических лиц</h4>                
            </div>
            <div class="modal-body">
                <form method="post" id="set_fiz_lic">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" name="LASTNAME" value="" placeholder="Фамилия"/>
                    <label>Имя</label>
                    <input type="text" class="form-control" name="FIRSTNAME" value="" placeholder="Имя"/>
                    <label>Отчество</label>
                    <input type="text" class="form-control" name="MIDDLENAME" value="" placeholder="Отчество"/>
                    
                    <label>Дата рождения</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="BIRTHDAY" data-mask="99.99.9999">
                    </div>
                                
                    <!--<input type="date" class="form-control" name="birthday" value="" data-mask="99.99.9999" placeholder="Дата рождения"/>-->
                    <label>Тип</label>
                    <select class="form-control" name="set_terror">
                    <?php 
                        foreach($dan as $k=>$v){
                            if($v['TYP'] == 1){
                                echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                            }
                        }
                    ?>
                    </select>                                        
                    <input type="hidden" name="set_terror_id" value="0"/>
                    
                    <label>ИИН</label>
                    <input type="text" class="form-control" name="IIN_BIN" value="" placeholder="ИИН"/>
                    
                    <label>Другие данные</label>
                    <input type="text" class="form-control" name="OTHERS_DAN" value="" placeholder="Описание"/>
                    
                    <label>Дата внесения</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="DATESET" data-mask="99.99.9999">
                    </div>
                    
                    <label>Дата исключения</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="DATE_END" data-mask="99.99.9999">
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="save_fiz">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="md_ur" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                <h4 class="modal-title">Добавление Юридических лиц</h4>                
            </div>
            <div class="modal-body">
                <form method="post" id="set_ur_lic">
                    <label>Наименование</label>
                    <input type="text" class="form-control" name="LASTNAME" value="" placeholder="Наименование на русском"/>
                    <label>Наименование на др. языке</label>
                    <input type="text" class="form-control" name="FIRSTNAME" value="" placeholder="Наименование на др. языке"/>
                    
                    <label>Тип</label>
                    <select class="form-control" name="set_terror">
                    <?php 
                        foreach($dan as $k=>$v){
                            if($v['TYP'] == 2){
                                echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                            }
                        }
                    ?>
                    </select>                                        
                    <label>Другие данные</label>
                    <input type="text" class="form-control" name="OTHERS_DAN" value="" placeholder="Другие данные"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_ur">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal" id="md_type" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                <h4 class="modal-title">Добавление типа террористов</h4>                
            </div>
            <div class="modal-body">
                <form method="post" id="set_type_terror">
                    <label>Наименование</label>
                    <input type="text" class="form-control" name="set_type_terror_name" value="" placeholder="Наименование типа террористов"/>
                    <label>Выберите тип </label>
                    <select class="form-control" name="set_type_terror_type">
                        <option value="1">Физ. лицо</option>
                        <option value="2">Юр. лицо</option>
                    </select>     
                    <input type="hidden" name="set_type_terror_id" value="0"/>               
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_type">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal" id="md_replace" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                <h4 class="modal-title">Автоматическое обновление списков террористов</h4>                
            </div>
            <div class="modal-body" id="auto_replace">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<textarea id="jsondan" style="display: none;">
<?php echo json_encode($dan['xls']); ?>
</textarea>

<script>

$('#save_type').click(function(){
    $('#set_type_terror').submit();
});

$('#load_btn').click(function(){
    $('#load_terror').click();
});

$('#load_terror').change(function(){
    $('#form_terror').submit();
});

$('.del_row').click(function(){
    var s = $(this).attr('data');
    var id = $(this).attr('id');            
    $('tbody#tbd'+s).children('#tr'+id).remove();
    var j = JSON.parse($('#jsondan').val());    
    delete j[s].dan[id];
    $('#jsondan').val(JSON.stringify(j));
})

$('.ed_ter').click(function(){
    var id = $(this).attr('id');
    $.post(window.location.href, {"get_dan":id}, function(data){        
        var j = JSON.parse(data);
        console.log(j);
        $.each(j, function(i, e){
            $('input[name="'+i+'"]').val(e);            
        });
        $('input[name="set_terror_id"]').val(j.ID);
        $('input[name="set_terror"]').val(j.VID);        
    }); 
});

$('.btn_prov').click(function(){
    var s = $(this).attr('data');
    var ps = [];
    var sl = $('thead#thd'+s).children('tr').children('th').children('select');
    console.log(sl);
    return false;
    
    $('tbody#tbd'+s).children('tr').each(function(){
        var tr = [];        
        
        $(this).children('td').each(function(){            
            var col = $(this).children('div').attr('data-col');
            if($('thead#thd'+s).children('tr').children('th').children('select#sl'+col).length > 0){            
                var vls = $('thead#thd'+s).children('tr').children('th').children('select#sl'+col).val();                        
                if(vls !== ''){                                        
                    var pps = {
                        "cell":vls,
                        "row": $(this).children('div').attr('data-row'),
                        "text": $(this).children('div').html()
                    }                    
                    tr.push(pps);                    
                }
            }
        })
        ps.push(tr);        
    });
    $.post(window.location.href, {"list_prov":ps}, function(data){
        console.log(data);
        /*
        var j = JSON.parse(data);
        //console.log(j);
        for(var i=0; i<j.length;i++){            
            var b = 'Нет';
            if(j[i].proverka > 0){
                b = 'Да';
            }
            var idsp = j[i][0].row;
            $('tbody#tbd'+s).children('#tr'+idsp).children('#db'+idsp).html(b);   
            //console.log(j[i]);         
        };
        */
    })
    //console.log(ps);
})

$('#save_fiz').click(function(){
    $.post(window.location.href, $('#set_fiz_lic').serialize(), function(data){
        alert(data);
        setTimeout(function(){
            location.reload();
        }, 2000);        
    })
});


$('#save_ur').click(function(){
    $.post(window.location.href, $('#set_ur_lic').serialize(), function(data){
        console.log(data);
    })
});

$('.del_ter').click(function(){
   var id = $(this).attr('id');
   $.post(window.location.href, {"del_terror":id}, function(data){
      if(data.trim() !== ''){
        alert(data);
      }else{
        window.location.reload();
      }
   }) 
});


$('.edit_type_terror').click(function(){
   var id = $(this).attr('data');
   if(id == '0'){
      $('input[name=set_type_terror_name]').val('');
      $('select[name=set_type_terror_type]').val('1');
      $('input[name=set_type_terror_id]').val('0');        
   }else{
    $.post(window.location.href, {"edit_type_terror":id}, function(data){
      var j = JSON.parse(data);
      $('input[name=set_type_terror_name]').val(j.NAME);
      $('select[name=set_type_terror_type]').val(j.TYP);
      $('input[name=set_type_terror_id]').val(id);
   }); 
   }
    
});

$('.save_xml').click(function(){
   var id = $(this).attr('data');
   var urls = $('#set_xml_'+id).val();
   var set_auth = '0';
   var ch = $('#set_auth_'+id).prop('checked');
   if(ch == true){
      set_auth = '1';
   }
   $.post(window.location.href, {"set_xml":id, "set_xml_url":urls, "set_auth": set_auth}, function(data){
      if(data.trim() !== ''){
        alert(data);
      }else{
        alert('Данные сохранены успешно!');        
      }
   });    
});

$('.save_xls').click(function(){
   var id = $(this).attr('data');
   var urls = $('#set_xls_'+id).val();
   
   var set_auth = '0';
   var ch = $('#set_auth_'+id).prop('checked');
   if(ch == true){
      set_auth = '1';
   }
   
   $.post(window.location.href, {"set_xls":id, "set_xls_url":urls, "set_auth": set_auth}, function(data){
      if(data.trim() !== ''){
        alert(data);
      }else{
        alert('Данные сохранены успешно!');        
      }
   });    
});

function postAjax(id)
{
    $.post(window.location.href, {"auto_replace":id}, function(data){
        return data;
    });
}

$('.replace_auto').click(function(){    
    $('#auto_replace').html('<h1>Идет обработка данных пожалуйста подождите!</h1>');
    $.post(window.location.href, {"auto_replace":'0'}, function(data){
        $('#auto_replace').html(data);
    });    
});


</script>