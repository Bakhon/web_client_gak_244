<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                    
                    <div class="ibox-tools" style="text-align: left;">
                            <?php 
                            if($dep == 13||$dep = 11){
                            ?>
                            <a class="btn btn-sm btn-info pull-left" style="color: #fff;" id="set_reins" data-toggle="modal" data-target="#modal_reins">Перестраховать</a>
                            <?php } ?>
                            <!--<a class="btn btn-sm btn-danger pull-left" style="color: #fff;" id="del_list">Убрать из списка</a>-->
                            
                            <!--
                            <?php 
                                if(count($_GET) > 0){
                                    echo '<a href="reins_fakultativ" class="btn btn-sm btn-warning" style="color: #fff;"><i class="fa fa-remove"></i></a>';
                                }
                            ?>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="pull-left">Период с:&nbsp;</label>                                
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control date_begin input-sm" data-mask="99.99.9999" value="<?php if(isset($_GET['date_begin'])){echo date("d.m.Y", strtotime($_GET['date_begin']));} ?>" required="">
                                    </div>                                
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="pull-left">По:&nbsp;</label>                                
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control date_end input-sm" data-mask="99.99.9999" value="<?php if(isset($_GET['date_end'])){echo date("d.m.Y", strtotime($_GET['date_end']));} ?>" required="">                                
                                    </div>
                                </div>
                            </div>                                                                                
                            <a class="btn btn-sm btn-danger filter_date" style="color: #fff;"><i class="fa fa-filter"></i></a>
                            -->
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_filter" style="color: #fff;"><i class="fa fa-filter"></i></a>
                            
                            <div class="pull-right">     
                                <a href="reins_fakultativ" class="btn btn-success btn-sm" style="color: #fff;">Договора</a>                        
                                <a href="reins_fakultativ?lists=2" class="btn btn-success btn-sm" style="color: #fff;">Доп соглашения</a>
                                <a href="reins_fakultativ?transh" class="btn btn-success btn-sm"  style="color: #fff;">Транши</a>
                                <a href="reins_fakultativ?nestade_list" class="btn btn-success btn-sm"  style="color: #fff;">Нестандартные договора</a>
                                <a href="reins_fakultativ?list_contracts" style="color: #fff;" class="btn btn-warning btn-sm">Список договоров</a>
                            </div>
                                                                                                                                                                     
                    </div>                    
                </div>                
                <div class="ibox-content" id="spisok_not_reinsurance">
                <table class="table table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>  
                            <th>
                                <center><input type="checkbox" class="check_all"/></center> 
                            </th>                          
                            <th>№ договора</th>
                            <th>№ основного договора перестрахования</th>                            
                            <th>Дата договора</th>
                            <th>Период начала</th>
                            <th>Период конец</th>
                            <th>Наименование</th>
                            <th>БИН</th>
                            <th>Страховая премия</th>
                            <th>Страховая сумма</th>                            
                            <th>Регион</th>
                            <th>Резидент Да/Нет</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($reins->dan as $k=>$v){
                            $res = 'Да';
                            $btns = '';
                            $btns_del = '';
                            if($dep == 13||$dep = 11){
                                $btns = '<a class="btn btn-sm btn-info btn-block set_reins" style="color: #fff;" id="'.$v['CNCT_ID'].'" data-toggle="modal" data-target="#modal_reins">Перестраховать</a>';
                                $btns = '<center><input type="checkbox" class="check" data="'.$v['CNCT_ID'].'" id="sl'.$v['CNCT_ID'].'"/></center>';
                                $btns_del = '<a class="btn btn-sm btn-danger btn-block del_list" style="color: #fff;" id="'.$v['CNCT_ID'].'">Убрать из списка</a>';
                            }
                            if($v['RESIDENT'] !== '1')$res = 'Нет';
                            echo '<tr data="'.$v['CNCT_ID'].'">
                                <td>
                                    '.$btns.'                                                                        
                                    <!--<center><input type="checkbox" class="check" data="'.$v['CNCT_ID'].'" id="sl'.$v['CNCT_ID'].'"/></center>-->
                                </td>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                <td><a href="reins_export?contract_num='.$v['ID_REINS_OSN'].'&&export=html" target="_blank">'.$v['CONTRACT_NUM_OSN'].'</a></td>
                                <td>'.$v['CONTRACT_DATE'].'</td>
                                <td>'.$v['DATE_BEGIN'].'</td>
                                <td>'.$v['DATE_END'].'</td>                                
                                <td>'.$v['STRAHOVATEL'].'</td>
                                <td>'.$v['BIN'].'</td>
                                <td>'.$v['PAY_SUM_P'].'</td>
                                <td>'.$v['PAY_SUM_V'].'</td>                                
                                <td>'.$v['REGION'].'</td>                            
                                <td>'.$res.'</td>
                                <td>
                                    '.$btns_del.'
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
</div>        

<div class="modal inmodal fade" id="modal_filter" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 40px;"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Установить фильтр</h4>                
            </div>            
                <div class="modal-body">
                    <div class="form-horizontal">
                        
                        <div class="form-group">
                            <label class="col-lg-3">Период с:&nbsp;</label>
                            <div class="col-lg-9">                                
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_begin" class="form-control date_begin input-sm" data-mask="99.99.9999" value="<?php if(isset($_GET['date_begin'])){echo date("d.m.Y", strtotime($_GET['date_begin']));} ?>" required="">
                                </div>
                            </div>                                
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-3">По:&nbsp;</label>     
                            <div class="col-lg-9">                           
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_end" class="form-control date_end input-sm" data-mask="99.99.9999" value="<?php if(isset($_GET['date_end'])){echo date("d.m.Y", strtotime($_GET['date_end']));} ?>" required="">                                
                                </div>
                            </div>
                        </div>
                                                                              
                    </div>
                </div>
    
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-primary filter_date">Применить</button>                
                </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="modal_reins" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 40px;"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Создание договора по перестрахованию</h4>                
            </div>
            <form method="post" id="save_form">
            <div class="modal-body">
                <div class="form-horizontal">                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Перестраховщик</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="reins_name">
                                <?php 
                                    foreach($reins->list_reins as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['R_NAME'].'</option>';
                                    }
                                ?>
                            </select>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Вид перестрахования</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="reins_vid">                                
                                <!--<option value="2">Облигаторный непропорциональный</option>-->
                                <option value="3">Факультатив пропорциональный</option>
                                <option value="4">Факультатив непропорциональный</option>
                                <option value="1">Облигаторный пропорциональный</option>                                
                            </select>                            
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Дата договора</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input name="contract_date" id="contract_date" type="text" class="form-control cnt_date" data-mask="99.99.9999" value="" required="">
                            </div>                                                        
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">№ договора</label>
                        <div class="col-lg-9">
                            <input type="text" name="contract_num" enabled class="form-control">                            
                        </div>
                    </div>                                                         
                </div>
            </div>

            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary " id="save">Далее</button>                
            </div>
            <div class="not-view" style="display: none;">
                <input type="hidden" id="not-view-contr_num" value="" name="contr_num[]">
            </div>
            </form>
        </div>
    </div>
</div>
        
<script>
/*
$('tr').click(function(){
    var id = $(this).attr('data');
    var ch = $('#sl'+id+'.check').prop('checked');
    var b = true;
    if(ch == true){b = false;}
    $('#sl'+id+'.check').prop('checked', b);
});
*/
var not_contract_num = false;
$('.check_all').click(function(){
    var ch = $(this).prop('checked');
    $('.check').each(function(){
        $(this).prop('checked', ch);
    })
})

$('#set_reins').click(function(){
    /*
    var cnct = $(this).attr('id');
    console.log(cnct);
    $('#not-view-contr_num').val(cnct);
    */
    
    $('.not-view').html('');
    var b = false;
    var pc = [];    
    $('.check').each(function(){
      
      if($(this).prop('checked') == true){ 
        b = true;
        pc.push($(this).attr('data'));
        $('.not-view').append('<input type="hidden" value="'+$(this).attr('data')+'" name="contr_num[]">')
      }
    })
    console.log(pc);
    
    if(b == false){
      alert('Выберите договор для перестрахования');
      return false;
    }
    
    $.post(window.location.href, {"fs_prov": pc}, function(data){
        console.log(data);
        var j = JSON.parse(data.trim());
        if(j.message !== ''){
            alert(j.message);
            $('.close').click();            
            return;
        }else{
            if(typeof j.contract_num !== 'undefined'){
                $('input[name=contract_num]').val(j.contract_num);
                $('select[name=reins_name] option[value='+j.reins_name+']').prop('selected', true);
                $('.not-view').prepend('<input type="hidden" name="id_head" value="'+j.id_head+'">');
                not_contract_num = true;
            }
        }
    });   
    
});



$('.filter_date').click(function(){
   var date_begin = $('.date_begin').val(); 
   var date_end = $('.date_end').val();
   if(date_begin.trim() == ''){
      alert('Период "С" не может быть пустым');
      return;
   }
   if(date_end.trim() == ''){
      alert('Период "По" не может быть пустым');
      return;
   }   
   
   var url = location.href;
   var urls = url.split('?');      
   window.location.href = 'reins_fakultativ?date_begin='+date_begin+'&&date_end='+date_end+'&'+urls[1];
});

$('.cnt_date').change(function(){
    var d = this.value;    
    var s = d.split('.');
    if(s[2] >= 2000){
        if(not_contract_num == false){
            $.post(window.location.href, {"gen_reins_num": d}, function(data){
                $('input[name=contract_num]').val(data.trim());
            });
        }
    }
});
/*
$('#del_list').click(function(){
    var s = [];
    var i = 0;
    $('.check').each(function(){      
      if($(this).prop('checked') == true){ 
        s[i] = $(this).attr('data');
        i++;        
      } 
    });
    if(s.length > 0){
        $.post(window.location.href, {'own_cnct': s}, function(data){
            if(data.trim() == ''){
                window.location.reload();
            }    
        });    
    }else{
        alert('Необходимо выбрать хотя бы один договор');
    }
});
*/
$('.del_list').click(function(){
    var id = $(this).attr('id'); 
    var s = [];
    s[0] = id;
           
    $.post(window.location.href, {'own_cnct': s}, function(data){
        if(data.trim() == ''){
            window.location.reload();
        }    
    });
});


$('#save').click(function(e){
     e.preventDefault();
     var s = $('input[name=contract_num]').val();
     if(s.trim() == ''){
        alert('Номер договора не может быть пустым');
        return false;
     }
     var s = $('input[name=contract_date]').val();
     if(s.trim() == ''){
        alert('Дата договора не может быть пустым');
        return false;
     }
     
     
     $('#save_form').submit();
});
</script>

<style>
.btn{
    color: #fff;
}
</style>