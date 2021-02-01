<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Список типов документов для печати</h5>
                    <button class="btn btn-primary btn-xs pull-right" id="create"><i class="fa fa-plus"></i></button>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Основная таблица</th>
                            <th>Колонка для определения</th>
                            <th>Объедененная таблица(UNION ALL)</th>
                            <th>Определяющий параметр</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            foreach($dan['list'] as $k=>$v){
                        ?>
                        <tr>
                            <td><?php echo $v['NAME']; ?></td>
                            <td><?php echo $v['TABLE_NAME']; ?></td>
                            <td><?php echo $v['COL_NAME']; ?></td>
                            <td><?php echo $v['UNION_TABLE']; ?></td>
                            <td><?php echo $v['DEF_PARAM']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-xs btnedit" id="<?php echo $v['ID']; ?>"><i class="fa fa-edit"></i></button>                                
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>            
            </div>        
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Редактор</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal">
                        <label>Наименование</label>
                        <input type="text" class="form-control" id="NAME" value=""/>
                        
                        <label>Основная таблица</label>
                        <select class="form-control" id="TABLE_NAME">
                            <option value="">Не выбран</option>
                            <?php 
                                foreach($dan['tables'] as $k=>$v){
                                    echo '<option value="'.$v['NAME'].'">'.$v['NAME'].'</option>';
                                }
                            ?>                            
                        </select>
                        
                        <label>Основная колонка</label>
                        <select class="form-control" id="COL_NAME">
                            <option value="">Не выбран</option>                            
                        </select>
                        
                        <label>Объедененная таблица(UNION ALL)</label>
                        <select class="form-control" id="UNION_TABLE">
                            <option value="">Не выбран</option>
                            <?php 
                                foreach($dan['tables'] as $k=>$v){
                                    echo '<option value="'.$v['NAME'].'">'.$v['NAME'].'</option>';
                                }
                            ?>
                        </select>
                        <label>Определяющий параметр</label>
                        <input type="text" class="form-control" id="DEF_PARAM"/>
                        <input type="hidden" id="ID_DOC" value="0"/>
                        <label></label>
                        <button class="btn btn-success btn-block" id="save">Сохранить</button>
                        <button class="btn btn-warning btn-block" id="clear">Очистить</button>
                    </div>
                </div>            
            </div>        
        </div>
    </div>
</div>

<script>
    $('.btnedit').click(function(){
        var id = $(this).attr('id');
        $.post(window.location.href, {"edit":id}, function(data){
            $('#UNION_TABLE').val('');
            var j = JSON.parse(data);            
            var res = j.res;
            var res_col = j.res_col;
            $('#ID_DOC').val(res.ID);
            $('#NAME').val(res.NAME);
            $('#TABLE_NAME option[value="'+res.TABLE_NAME+'"]').attr('selected','selected');
            $('#UNION_TABLE option[value="'+res.UNION_TABLE+'"]').attr('selected','selected');            
            $('#DEF_PARAM').val(res.DEF_PARAM);
            
            $('#COL_NAME').empty();
            for(var i=0;i<res_col.length;i++){
                var r = res_col[i];
                $('#COL_NAME').append('<option value="'+r.COLUMN_NAME+'">'+r.COLUMN_NAME+' ('+r.COL_META+')</option>')             
            }     
            $('#COL_NAME option[value='+res.COL_NAME+']').attr('selected','selected');      
        });
    });
    
    $('#save').click(function(){            
         var j = [];
         j["NAME"] = $('#NAME').val();
         j["TABLE_NAME"] = $('#TABLE_NAME').val();
         j["COL_NAME"] = $('#COL_NAME').val();
         j["UNION_TABLE"] = $('#UNION_TABLE').val();
         j['ID_DOC'] = $('#ID_DOC').val();
         j['DEF_PARAM'] = $('#DEF_PARAM').val();
                  
         $.post(window.location.href, {
                "NAME": j["NAME"], 
                "TABLE_NAME": j["TABLE_NAME"],
                "COL_NAME": j["COL_NAME"],
                "UNION_TABLE": j["UNION_TABLE"],
                "ID_DOC": j['ID_DOC'],
                "DEF_PARAM": j["DEF_PARAM"]
         }, function(data){
            if(data.trim() !== ''){
                alert(data);
                return;
            }
            
            location.reload();
         });
    });
    
    $('#create').click(function(){
        $('#ID_DOC').val('0');
        $('#NAME').val('');
        $('#TABLE_NAME option[value=""]').attr('selected','selected');
        $('#UNION_TABLE option[value=""]').attr('selected','selected');
        $('#COL_NAME').empty();
        $('#COL_NAME').append('<option value="">Не выбран</option>');
        $('#DEF_PARAM').val('');
    });
    
    $('#TABLE_NAME').change(function(){
        var ts = $(this).val();
        $.post(window.location.href, {"list_cols": ts}, function(data){
            res_col = JSON.parse(data);
            $('#COL_NAME').empty();
            for(var i=0;i<res_col.length;i++){
                var r = res_col[i];
                $('#COL_NAME').append('<option value="'+r.COLUMN_NAME+'">'+r.COLUMN_NAME+' ('+r.COL_META+')</option>')             
            }
        });
    })
    
    $('#clear').click(function(){
        $('#create').click();                
    });    
</script>