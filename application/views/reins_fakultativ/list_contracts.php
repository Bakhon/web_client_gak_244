<style>
    .hts{margin-right: 15px;border-right: solid 1px;padding-right: 10px;}
</style>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                    
                    <h3>                    
                    <a href="reins_fakultativ" class="btn btn-default pull-right btn-sm">Назад</a>                    
                    <a href="#" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#filter" style="margin-right: 15px;"><i class="fa fa-filter"></i></a>
                    <?php 
                        if($reins->dan['filter'] !== ''){
                    ?>
                    <a href="reins_fakultativ?list_contracts" class="btn btn-danger btn-sm pull-right" style="margin-right: 15px;"><i class="fa fa-close"></i></a>
                    <?php } ?>
                    Список факультативных договоров</h3>
                    
                </div>
                <div class="ibox-content">
                    <div class="panel-group" id="accordion">
                    <?php 
                        $i = 0;
                        foreach($reins->dan['list_contracts'] as $k=>$v){
                            $i++;
                            $note = '<i style="margin-left: 15px;">'.$v['NOTE'].'</i>';
                                                        
                            $btn_set_state = 'set_note';
                            if($v['STATE'] == '2'){$btn_set_state = 'set_note_rasp';}            
                            if($v['STATE'] == '14'){$btn_set_state = 'set_note_rasp';}
                            
                            echo '
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                    
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="print?id='.$v['ID'].'" target="_blank"><i class="fa fa-2x fa-file-text-o"></i> Печать договора</a></li>
                                                <li><a href="reins_export?contract_num='.$v['ID'].'&&export=html" target="_blank"><i class="fa fa-2x fa-html5"></i> HTML</a></li>
                                                <li><a href="reins_export?contract_num='.$v['ID'].'&&export=pdf" target="_blank"><i class="fa fa-2x fa-file-pdf-o"></i> PDF</a></li>
                                                <li><a href="reins_export?contract_num='.$v['ID'].'&&export=xls" target="_blank"><i class="fa fa-2x fa-file-excel-o"></i> EXCEL</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" class="pereraschet" data="'.$v['ID'].'"><i class="fa fa-2x fa-calculate"></i> Пересчитать</a></li>
                                                ';
                                                if(trim($v['NUM_RASP']) !== ''){
                                                  echo '<li class="divider"></li>
                                                    <li><a href="reins_bordero?print_rasp='.$v['ID'].'" target="_blank">Печать распоряжения</a></li>';    
                                                }
                                                echo '<li class="divider"></li>
                                                <li><a href="#" data-toggle="modal" class="contracts_files" data="'.$v['ID'].'" data-target="#modal_files"><i class="fa fa-file-o"></i> Файлы</a></li>
                                                <li class="divider"></li>
                                                
                                                <li><a href="#" class="btn-info set_note" data-toggle="modal" data-target="#'.$btn_set_state.'" id="'.$v['ID'].'" data="0"><i class="fa fa-check"></i> Утвердить</a></li>
                                                <li><a href="#" class="btn-danger set_note" data-toggle="modal" data-target="#set_note" id="'.$v['ID'].'" data="1"><i class="fa fa-close"></i> Отклонить</a></li>
                                                
                                                <li class="divider"></li>
                                                <li><a href="reins_fakultativ?form_setstate='.$v['ID'].'" target="_blank">Показать в отдельном окне</a></li>
                                                ';
                                                if($v['STATE'] > 0){
                                                    echo '<li><a href="javascript:;" class="send_replace" id="'.$v['ID'].'">Повторно уведомить</a></li>';
                                                }
                                                if($v['STATE'] !== '8'){
                                                    echo '<li><a href="reins_bordero?move_contract='.$v['ID'].'" target="_blank">Создать перенос договоров</a></li>';
                                                    echo '
                                                    <li class="divider"></li>
                                                    <li><a href="reins_fakultativ?delete_contracts='.$v['ID'].'">Удалить договора страхования</a></li>                                        
                                                    <li><a href="javascript:;" class="delete_contract" id="'.$v['ID'].'">Удалить договор перестрахования</a></li>
                                                    ';
                                                }else{
                                                    if($v['PAY_SUM'] > 0){
                                                        echo '
                                                        <li class="divider"></li>
                                                        <li><a href="#" class="set_vozvrat_reins" data="'.$v['ID'].'" data-toggle="modal" data-target="#vozvrat_cnct">Создать возврат</a></li>                                            
                                                        ';
                                                    }
                                                }
                                                
                                                if($v['PAY_SUM'] < 0){
                                                    echo  '
                                                        <li class="divider"></li>
                                                        <li><a href="reins_fakultativ?shet_opl='.$v['ID'].'" target="_blank">Печать счета на оплату</a></li>                                            
                                                        ';
                                                    if(($v['STATE'] == '8')&&($v['MHMH_ID'] == '')){                                            
                                                        echo '<li><a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#kvitovanie" class="btn_plat">Привязать платежное поручение</a></li>';
                                                    }
                                                }
                            echo '</ul>
                                        </div>
                                                            
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="false" class="">
                                            <span class="hts">№ договора: <span class="text-danger">'.$v['CONTRACT_NUM'].'</span></span>
                                            <span class="hts">Дата: <span class="text-danger">'.$v['CONTRACT_DATE'].'</span></span>
                                            <span class="hts">Сумма: <span class="text-danger">'.$v['PAY_SUM'].'</span></span>                                
                                            <span class="hts">Кол-во: <span class="text-danger">'.$v['CNT'].'</span></span>';
                                            
                                            if(trim($v['MAIN_DOG']) !== ''){
                                                echo '<span class="hts">№ осн. договора: <span class="text-succes"><a target="_blank" href="reins_fakultativ?form_setstate='.$v['ID_HEAD'].'">'.$v['MAIN_DOG'].'</a></span></span> ';
                                            } 
                                            
                                            echo '<span>Статус: <span class="text-danger">'.$v['STATE_NAME'].'</span></span>'.
                                            $note.'
                                        </a>                            
                                    </h5>
                                </div>
                                <div id="collapse'.$i.'" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">
                            ';                                                                                    
                            ?>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th style="width: 5%;">№ п\п</th>
                                <th style="width: 15%;">Наименование</th>
                                <th style="width: 25%;">Наименование страхователя</th>
                                <th>№ договора страхования</th>
                                <th>№ договора</th>
                                <th>Дата договора</th>
                                <th>Сумма</th>                                
                                <th>Сумма к оплате</th>
                                <th style="width: 5%;">Тип</th>                                
                                </tr>              
                            </thead>
                            <tbody>
                            <?php 
                                foreach($v['lists'] as $t=>$d){                                
                                    $txt = '<div class="btn-group">
                                            <span data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="false">'.$d['ID'].' <span class="caret"></span></span>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="vozvrat" data-toggle="modal" data-target="#vozvrat_cnct" data="'.$v['ID'].'" data-cnct="'.$d['CNCT_ID'].'"><i class="fa fa-2x"></i> Создать возврат</a></li>
                                            </ul>
                                            </div>';
                                    if($d['PAY_SUM_OPL'] <= 0){
                                        $txt = $v['ID'];
                                    }
                                echo '<tr>
                                    <td>'.$txt.'</td>                    
                                    <td>'.$d['NAME'].'</td>
                                    <td><a href="contracts?CNCT_ID='.$d['CNCT_ID'].'" target="_blank">'.$d['STRAH_NAME'].'</a></td>
                                    <td><a href="contracts?CNCT_ID='.$d['CNCT_ID'].'" target="_blank">'.$d['CONTRACT_NUM_DOGOVOR'].'</a></td>                                                                        
                                    <td>'.$d['CONTRACT_NUM'].'</td>
                                    <td>'.$d['CONTRACT_DATE'].'</td>
                                    <td>'.$d['PAY_SUM'].'</td>
                                    <td>'.$d['PAY_SUM_OPL'].'</td>
                                    <td>'.$d['TYPE'].'</td>
                                </tr>';
                                }
                            ?>
                            </tbody>
                            </table>
                            <?php                            
                            echo "</div></div></div>";
                        }                        
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


<div class="modal inmodal fade" id="filter" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Поиск и фильтрация</h4>
            </div>
            <form method="get">
            <div class="modal-body">
                <div class="form-horizontal">
                    <h3>Показать за период</h3>                    
                    <div class="form-group">
                        <label class="col-lg-2">C</label>
                        <div class="input-group date col-lg-10">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="date_begin" class="form-control input-sm" data-mask="99.99.9999" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2">По</label>
                        <div class="input-group date date col-lg-10"">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="date_end" class="form-control input-sm" data-mask="99.99.9999" value="">
                        </div>
                    </div>
                    <hr />
                    <h3>По статусу</h3>                    
                    <div class="form-group">  
                        <select class="form-control" name="state">
                            <option value="">Не выбран</option>
                            <?php 
                                foreach($reins->dan['list_states'] as $k=>$v)
                                {
                                    echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">  
                        <label><input type="checkbox" name="main_dog"/>Основной договор</label>                        
                        <label><input type="checkbox" name="dop_dog"/>Дополнительное соглашение</label>
                    </div>
                    
                    <input type="hidden" name="list_contracts"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default set_filter">Применить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
            </div>
            </form>
        </div>
    </div>
</div>    

<div class="modal inmodal fade" id="set_note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Комментарий</h4>
            </div>
            <div class="modal-body">
                <p><textarea class="form-control note"></textarea></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default set_state" id="" data=""></button>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once __DIR__.'/../reinsurance/modal_vozvrat.php';
    require_once __DIR__.'/../reinsurance/modal_kvit.php';
    require_once __DIR__.'/../reinsurance/modal_note_rasp.php';
    require_once __DIR__.'/../reinsurance/modal_files.php';
?>

<script>
$('.set_filter').click(function(){
    var date_begin =  $('input[name=date_begin]').val();
    var date_end =  $('input[name=date_end]').val();
    var state =  $('').val();    
});
</script>