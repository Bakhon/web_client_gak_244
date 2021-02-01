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
                            
                            <?php 
                                if(count($_GET) > 0){
                                    echo '<a href="reins_fakultativ" class="btn btn-sm btn-warning" style="color: #fff;"><i class="fa fa-remove"></i></a>';
                                }
                            ?>
                        
                         <!--   <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_filter" style="color: #fff;"><i class="fa fa-filter"></i></a> -->
                            
                            <div class="pull-right">     
                                <a href="reins_dobr" class="btn btn-success btn-sm" style="color: #fff;">Договора</a>                                                                                        
                                <a href="reins_dobr?own_list" class="btn btn-warning btn-sm"  style="color: #fff;">Собственное удержание</a>
                                <a href="reins_dobr?list_contracts" style="color: #fff;" class="btn btn-primary btn-sm">Список договоров</a>
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
                            <th>Дата договора</th>
                            <th>Период начала</th>
                            <th>Период конец</th>
                            <th>Наименование</th>
                            <th>БИН/ИИН</th>
                            <th>Страховая премия</th>
                            <th>Страховая сумма</th>                            
                            <th>Регион</th>
                            <th>Резидент Да/Нет</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($reins->dan as $k=>$v){
                            $res = 'Да';
                            $btns = '';
                            $btns_del = '';
                            if($v['INS_SUMMA'] <= '10000000'){
                                $success = '&#10004';
                            }else{
                                $success = '';
                            }
                            if($dep == 13||$dep = 11){
                                $btns = '<a class="btn btn-sm btn-info btn-block set_reins" style="color: #fff;" id="'.$v['CNCT_ID'].'" data-toggle="modal" data-target="#modal_reins">Перестраховать</a>';
                                $btns = '<center><input type="checkbox" class="check" data="'.$v['CNCT_ID'].'" id="sl'.$v['CNCT_ID'].'"/></center>';
                                if($v['INS_SUMMA'] <= '10000000'){
                                   $btns_del = '<a class="btn btn-sm btn-danger btn-block del_list" style="color: #fff;" id="'.$v['CNCT_ID'].'">Взять на удержание</a>'; 
                                }else{
                                   $btns_del = '<a class="btn btn-sm btn-danger btn-block del_list" style="color: #fff;" id="'.$v['CNCT_ID'].'">Перевести в облигатор</a>';
                                }                                
                            }
                            if($v['RESIDENT'] !== '1')$res = 'Нет';
                            echo '<tr data="'.$v['CNCT_ID'].'">
                                <td>
                                    '.$btns.'                                                                        
                                    <!--<center><input type="checkbox" class="check" data="'.$v['CNCT_ID'].'" id="sl'.$v['CNCT_ID'].'"/></center>-->
                                </td>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['NUM_DOG'].'</a></td>                                
                                <td>'.$v['DATE_DOG'].'</td>
                                <td>'.$v['VIPLAT_BEGIN'].'</td>
                                <td>'.$v['VIPLAT_END'].'</td>                                
                                <td>'.$v['STRAHOVATEL'].'</td>
                                <td>'.$v['IIN'].'</td>
                                <td>'.$v['INS_PREMIYA'].'</td>
                                <td>'.$v['INS_SUMMA'].'</td>                                
                                <td>'.$v['BRANCH_NAME'].'</td>                            
                                <td>'.$res.'</td>
                                <td>
                                    '.$btns_del.'
                                </td>
                                <td>'.$success.'	
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
                            <select id="reins_name" class="form-control" name="reins_name">
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
                        <label class="col-lg-3 control-label">№ договора перестрахования</label>
                        <div class="col-lg-9">
                            <input type="text" name="contract_num" enabled class="form-control">                            
                        </div>
                    </div>
                    
                      
                    <div class="form-group">
                        <label class="col-lg-3 control-label">№ договора бордеро</label>
                        <div class="col-lg-9">
                            <input type="text" name="bordero_num" enabled class="form-control">                            
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


var not_contract_num = false;
$('.check_all').click(function(){
    var ch = $(this).prop('checked');
    $('.check').each(function(){
        $(this).prop('checked', ch);
    })
})

$('#set_reins').click(function(){

    $('.not-view').html('');
    var b = false;
    var pc = [];    
    var ts = [];
    $('.check').each(function(){
      
      if($(this).prop('checked') == true){
        ts = $(this).attr('data')
        b = true;
        pc.push($(this).attr('data'));
        $('.not-view').append('<input type="hidden" value="'+$(this).attr('data')+'" name="contr_num[]">')
      }
    })
    console.log(ts);
    console.log(pc);
    
    if(b == false){
      alert('Выберите договор для перестрахования');
      return false;
    }
    
    $.post(window.location.href, {"fs_prov": pc}, function(data){
        console.log(data);
        var j = JSON.parse(data.trim());                     
               
                 $('input[name=contract_num]').val(j.contract_num);
                  $('input[name=contract_date]').val(j.contract_date);
                $('select[name=reins_name] option[value='+j.reins_name+']').prop('selected', true); 
                // $('#reins_name').prop('disabled', true);
                $('select[name=reins_vid] option[value='+j.reins_vid+']').prop('selected', true);           
                not_contract_num = true;          
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