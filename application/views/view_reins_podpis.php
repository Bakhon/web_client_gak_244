<?php 
    $alert = new ALERTS();
?>
<div class="row">
    <div class="col-lg-12">        
        <div class="ibox float-e-margins">
            <?php 
                if(isset($dan['error'])){
                    echo $alert->ErrorMin("Ошибка<br />".$dan['error']);
                }
            ?>
            <div class="ibox-title">
                <button class="btn btn-info btn-xs pull-right edit_podpis" data-toggle="modal" data-target="#modal_new" data="0"><i class="fa fa-plus"></i> Добавить</button>
                <span class="pull-right" style="width: 30%; margin-right: 15px;">
                    <select class="form-control input-sm" id="filter">
                        <option value="0">--Не выбран</option>
                        <?php 
                            foreach($dan['list_reins'] as $k=>$v){
                                echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                            }
                        ?>
                    </select>
                </span>
                                                                                
                <h4>Список</h4>                
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">Компания</th>
                        <th rowspan="2">Подписант Должность ФИО (в лице)</th>
                        <th rowspan="2">Подписант ФИО</th>
                        <th rowspan="2">Должность</th>
                        <th rowspan="2">Основание</th>
                        <th colspan="2"><center>Период действия</center></th>
                        <th rowspan="2"><center>Опции</center></th>                
                    </tr>
                    <tr>
                        <th><center>Начало</center></th>
                        <th><center>Конец</center></th>
                    </tr>
                </thead>
                <tbody>                
                <?php 
                    foreach($dan['list'] as $k=>$v){
                       echo '<tr class="reins" data="'.$v['ID_REINS'].'">
                        <td>'.$v['REINSNAME'].'</td>
                        <td>'.$v['FIO'].'</td>
                        <td>'.$v['FIO_RUK'].'</td>
                        <td>'.$v['DOLGNOST'].'</td>
                        
                        <td>'.$v['OSNOV_TYPE'].' № '.$v['OSNOV_NUM'].' от '.$v['OSNOV_DATE'].' г.</td>
                        <td><center>'.$v['DATE_BEGIN'].'</center></td>
                        <td><center>'.$v['DATE_END'].'</center></td>
                        <td>
                            <span class="btn btn-success btn-xs edit_podpis" data-toggle="modal" data-target="#modal_new" data="'.$v['ID'].'"><i class="fa fa-edit"></i> Редактировать</span>
                            <span class="btn btn-danger btn-xs del_podpis" data="'.$v['ID'].'"><i class="fa fa-trash"></i> Удалить</span>                            
                        </td>
                    </tr>'; 
                    }
                ?>
                </tbody>
                </table>                                
            </div>
        </div>                
    </div>
</div>

<div class="modal inmodal in" id="modal_new" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>                
                <h4 class="modal-title">Добавить подписанта</h4>                
            </div>            
            
            <form method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Должность</label>
                    <input name="dolgnost" type="text" placeholder="" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="font-noraml">ФИО подписанта</label>
                    <input name="fio_ruk" type="text" placeholder="" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="font-noraml">Должность и ФИО подписанта (в лице)</label>
                    <input name="fio" type="text" placeholder="" class="form-control" required>
                </div>                                                                                        
                <div class="form-group">
                    <label class="font-noraml">Выбрать компанию</label>
                    <select name="reins_company" class="select2_demo_1 form-control" required>
                        <option value="0">ГАК</option>
                        <?php 
                        foreach($dan['list_reins'] as $k=>$v){
                            echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                        }
                        ?>
                                                
                    </select>
                </div>
                                                                                                                                                                                 
                <div class="form-group">
                    <label class="font-noraml">Дата начала</label>
                    <input name="date_begin" type="date" placeholder="" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                </div>
                
                <div class="form-group">
                    <label class="font-noraml">Дата окончания </label>
                    <input name="date_end" type="date" class="form-control">                    
                </div>
                
                <legend>Основание</legend>
                
                <div class="form-group">
                    <label class="font-noraml">Тип</label>
                    <select name="reins_osn_type" class="select2_demo_1 form-control">
                        <option value="Доверенности" selected>Доверенность</option>                                                
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-noraml">№ </label>
                    <input name="reins_osn_num" type="text" class="form-control">
                </div>                                
                <div class="form-group">
                    <label class="font-noraml">От </label>
                    <input name="reins_osn_date" type="date" class="form-control">
                </div>                                
            </div>                                
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="save_podpisant">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
            
            <input type="hidden" name="id" value="0"/>
            </form>
        </div>
    </div>
</div>

<script>
    $('.edit_podpis').click(function(){
        var id = $(this).attr('data');
        $.post(window.location.href, {"edit_podpisant": id}, function(data){            
            var j = JSON.parse(data);
            $('input[name=id]').val(j.ID);
            $('input[name=dolgnost]').val(j.DOLGNOST);
            $('input[name=fio_ruk]').val(j.FIO_RUK);
            $('input[name=fio]').val(j.FIO);
                        
            $('select[name=reins_company]').val(j.ID_REINS);            
            $('input[name=date_begin]').val(j.DATE_BEGIN);
            $('input[name=date_end]').val(j.DATE_END);
            
            $('input[name=reins_osn_date]').val(j.OSNOV_DATE);
            $('input[name=reins_osn_num]').val(j.OSNOV_NUM);
            $('select[name=reins_osn_type]').val(j.OSNOV_TYPE);                                    
        })
    })
    $('.del_podpis').click(function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {"del_podpis":id}, function(data){
            var j = JSON.parse(data);
            var er = j.error;
            if($.trim(er) !== ''){
                alert(er);
            }else{
                location.reload();
            }
       });
    });
    
    $('#filter').change(function(){
        var id = $(this).val();        
        if(id == 0){
            $('.reins').css('display', '');
        }else{
            $('.reins').each(function(){
                if($(this).attr('data') !== id){
                    $(this).css('display', 'none');        
                }else{
                    $(this).css('display', '');
                }
            });                                    
        }        
    })
</script>