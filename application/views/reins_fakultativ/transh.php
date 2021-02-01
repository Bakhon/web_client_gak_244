<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                    
                    <div class="ibox-tools" style="text-align: left;">
                            <?php if($dep == 13){ ?>
                            <a class="btn btn-sm btn-info pull-left" style="color: #fff;" id="set_reins">Создать уведомление</a>
                            <a id="reins_modal" data-toggle="modal" data-target="#modal_reins" style="display: none;"></a>
                            <a class="btn btn-sm btn-danger pull-left" style="color: #fff;" id="del_list">Убрать из списка</a>
                            <?php } ?>
                                                        
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_filter" style="color: #fff;"><i class="fa fa-filter"></i></a>
                            
                            <div class="pull-right">     
                                <a href="reins_fakultativ" class="btn btn-success btn-sm" style="color: #fff;">Договора</a>                        
                                <a href="reins_fakultativ?lists=2" class="btn btn-success btn-sm" style="color: #fff;">Доп соглашения</a>
                                <a href="#" class="btn btn-success btn-sm disabled"  style="color: #fff;">Транши</a>
                                
                                <a href="reins_fakultativ?list_contracts" style="color: #fff;" class="btn btn-warning btn-sm">Список договоров</a>
                            </div>
                                                                                                                                                                     
                    </div>                    
                </div>                
                <div class="ibox-content" id="spisok_not_reinsurance">
                <table class="table table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>  
                            <th><center><input type="checkbox" class="check_all"/></center> </th>                          
                            <th>№ договора</th>
                            <th>№ договора перестрахования</th>
                            <th>Дата договора</th>
                            <th>Наименование</th>
                            <th>№ транша</th>
                            <th>Сумма начисления</th>                            
                            <th>Дата начисления</th>
                            <th>Регион</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php                                         
                        foreach($reins->dan as $k=>$v){                            
                            echo '<tr data="'.$v['CNCT_ID'].'">
                                <td><center>
                                    <input type="checkbox" class="check" data="'.$v['ID_TRUNSH'].'" id="sl_'.$v['CNCT_ID'].'_'.$v['ID_TRUNSH'].'"/>
                                </center></td>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                <td><a href="reins_export?contract_num='.$v['ID'].'&&export=html" target="_blank">'.$v['CONTRACT_NUM_OSN'].'</a></td>
                                <td>'.$v['CONTRACT_DATE'].'</td>
                                <td>'.$v['STRAHOVATEL'].'</td>
                                <td>'.$v['NOM'].'</td>
                                <td>'.$v['PAY_SUM_D'].'</td>                                
                                <td>'.$v['DATE_DOHOD'].'</td>
                                <td>'.$v['REGION'].'</td>                            
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
                <h4 class="modal-title">Создать уведомление</h4>                
            </div>
            <form method="post" id="save_form">
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Перестраховщик</label>
                        <div class="col-lg-9">
                            <label class="form-control" id="name_reins"></label>                            
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">E-Mail перестраховщика</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" placeholder=""/>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Дата уведомления</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input name="contract_date" id="contract_date" type="text" class="form-control cnt_date" data-mask="99.99.9999" value="" required="">
                            </div>                                                        
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">№ уведомления</label>
                        <div class="col-lg-9">
                            <input type="text" name="contract_num" enabled class="form-control">                            
                        </div>
                    </div>                                                         
                                        
                </div>
            </div>

            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary " id="save">Отправить</button>                
            </div>
            <div class="not-view" style="display: none;">
                
            </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn{
    color: #fff;
}
</style>


<script>
    $('.check_all').click(function(){
       var  ch = $(this).prop('checked');
       $('.check').each(function(){
            $(this).prop('checked', ch);
       })         
    });
    
    $('#del_list').click(function(){
        var del_list = [];
        $('.check').each(function(){
            if($(this).prop('checked') == true){                
                del_list.push($(this).attr('id'));
            }
       })
       
       $.post(window.location.href, {"del_transh": del_list}, function(data){
            if(data.trim() !== ''){
                alert(data);
            }else{
                location.reload();
            }
       });
    });
    
    $('#set_reins').click(function(){
        var b = false;
        var pc = [];   
        $('.not-view').html(''); 
        $('.check').each(function(){          
          if($(this).prop('checked') == true){ 
            b = true;
            pc.push($(this).attr('data'));
            $('.not-view').append('<input type="hidden" value="'+$(this).attr('data')+'" name="uved_transh[]">')
          }
        })         
       
        if(b == false){
          alert('Выберите договор для перестрахования');
          return false;
        }        
        
        $.post(window.location.href, {"prov_transh_uved": pc}, function(data){
            var s = JSON.parse(data);
            console.log(s);
            if(s.message !== ''){                
                alert(s.message);                
                return false;
            }else{            
                $('input[name=contract_num]').val(s.CONTRACT_NUM);
                $('.not-view').append('<input type="hidden" value="'+s.ID_REINS+'" name="bordero_transh_id_reins">')
                $('.not-view').append('<input type="hidden" value="'+s.ID_CONTRACTS+'" name="bordero_transh_head">')                
                $('#name_reins').html(s.R_NAME);  
                $('#reins_modal').click();              
            } 
        });
    });
</script>