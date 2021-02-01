<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                    
                    <div class="pull-right">     
                        <a href="reins_fakultativ" class="btn btn-success btn-sm" style="color: #fff;">Договора</a>                        
                        <a href="reins_fakultativ?lists=2" class="btn btn-success btn-sm" style="color: #fff;">Доп соглашения</a>
                        <a href="reins_fakultativ?transh" class="btn btn-success btn-sm"  style="color: #fff;">Транши</a>
                        <a href="reins_fakultativ?nestade_list" class="btn btn-default btn-sm"  style="color: #fff;">Нестандартные договора</a>
                        <a href="reins_fakultativ?list_contracts" style="color: #fff;" class="btn btn-warning btn-sm">Список договоров</a>
                    </div>
                    <h3>Список нестандартных факультативных договоров</h3>                                        
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2"><center>#</center></th>                                
                                <th rowspan="2">Наименование страхователя</th>
                                <th rowspan="2">№ договора страхования</th>                                
                                <th rowspan="2"><center>Дата договора</center></th>
                                <th colspan="2"><center>Период действия</center></th>
                                <th rowspan="2"><center>Страховая премия</center></th>                                
                                <th rowspan="2"><center>Страховая выплата</center></th>
                                <th rowspan="2">Регион</th>
                            </tr>              
                            <tr>
                                <th><center>Дата начала</center></th>
                                <th><center>Дата окончания</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            foreach($reins->dan['list'] as $k=>$v){
                                echo '<tr>
                                    <td><button class="btn btn-sm btn-info set_reins" id="'.$v['CNCT_ID'].'" data-toggle="modal" data-target="#modal_reins">Сформировать</button></td>                                    
                                    <td><a href="/contragents?view='.$v['ID_INSUR'].'" target="_blank">'.$v['STRAH'].'</a></td>
                                    <td><a href="/contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                    <td>'.$v['CONTRACT_DATE'].'</td>
                                    <td>'.$v['DATE_BEGIN'].'</td>                                    
                                    <td>'.$v['DATE_END'].'</td>
                                    <td>'.$v['PAY_SUM_P'].'</td>
                                    <td>'.$v['PAY_SUM_V'].'</td>
                                    <td>'.$v['REGION'].'</td>                                    
                                </tr>';
                                $i++;
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
                            <select class="form-control" name="reins_name">
                                <?php 
                                    foreach($reins->dan['list_reins'] as $k=>$v){
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
                <input type="hidden" id="id_uv" value="2" name="id_uv">
            </div>
            </form>
        </div>
    </div>
</div>

<script>
var on_contract_num = false;
$('.set_reins').click(function(){
    var cnct = $(this).attr('id');
    on_contract_num = false;
    console.log(cnct);
    $('#not-view-contr_num').val(cnct);
});
    
function GenNum(){
    var d = $('.cnt_date').val();    
    var s = d.split('.');
    if(s[2] >= 2000){
        if(on_contract_num == false){
            if($('input[name=contract_num]').val() == ''){
                $.post('reins_fakultativ', {"gen_reins_num": d}, function(data){
                    on_contract_num = true;
                    console.log(data);
                    $('input[name=contract_num]').val(data.trim());
                });
            }
        }
    }
}    
    
$('#contract_date').change(function(){ 
    if(on_contract_num == false){        
        GenNum();
        on_contract_num = true;
    }
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