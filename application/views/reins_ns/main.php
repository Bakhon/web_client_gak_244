<div class="ibox float-e-margins">        
    <?php 
        if($reins->title !== ''){
            echo '<div class="ibox-title"><h3>'.$reins->title.'</h3></div>';
        }
    ?>    
    <div class="ibox-title">
        <div class="row">            
            <div class="col-lg-1">
                <?php 
                    if(count($_GET) > 0){
                ?>
                <a href="/reins_ns" class="btn btn-info btn-sm btn-block"><i class="fa fa-filter"></i> Снять фильтр</a>
                <?php } ?>
                <a href="#" data-toggle="modal" data-target="#draw" class="btn btn-info"><i class="fa fa-info"></i></a>
                
            </div>
        </div>
    </div>
    <div class="ibox-content" style="overflow: auto; min-height: 500px;">
        <table class="table table-bordered" style="font-size: 11px;">
        <thead>
            <tr>
                <th rowspan="3">#</th>
                <th colspan="4">Данные по пострадавшему клиенту</th>        
                <th colspan="3">Данные по Страхователю</th>
                <th colspan="4">Данные по Перестрахованию</th>
                <th colspan="8">Данные по дебиторской задолжности</th>
            </tr>
            <tr>
                <th rowspan="2">
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">ФИО аннуитета<i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php 
                                foreach($reins->dan['filter_1'] as $k=>$v){
                                    echo '<li><a class="dropdown-item" href="/reins_ns?sicid='.$v['ID'].'">'.$v['NAME'].'</a></li>';
                                }
                            ?>                                                
                        </ul>
                    </div>
                </th>
                <th rowspan="2">ФИО получателя</th>        
                <th rowspan="2">№ и дата договора</th>                
                <th rowspan="2">Причина НС</th>
                
                <th rowspan="2">
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">Наименование<i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php 
                                foreach($reins->dan['filter_2'] as $k=>$v){
                                    echo '<li><a class="dropdown-item" href="/reins_ns?id_insur='.$v['ID'].'">'.$v['NAME'].'</a></li>';
                                }
                            ?>                                                
                        </ul>
                    </div>
                </th>
                <th rowspan="2">№ договора</th>
                <th rowspan="2">Дата договора</th>
                
                <th rowspan="2">Наименование</th>
                <th rowspan="2">№ договора</th>
                <th rowspan="2">Дата договора</th>
                <th rowspan="2">Доля %</th>                
                
                <th colspan="2">Данные по выплате</th>
                <th colspan="3">Данные по начислению</th>
                <th colspan="2">Данные по погашению</th>        
            </tr>
            <tr>
                <th>Сумма</th>
                <!--<th>Дата</th>-->
                <th>Премия</th>

                <th>Сумма</th>
                <th>Дата</th>
                <th>Дата предъявления перестраховщику</th>
                        
                <th>Сумма</th>
                <th>Дата</th>                                
            </tr>
        </thead>
        <tbody>
        <!--
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#kvitovanie" class="btn_plat">Сквитовать</a>
                </li>
            </ul>
        </div>
        -->
        <?php 
            foreach($reins->dan['list'] as $k=>$v){
                
               echo '
               <tr>
                    <td>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">'.$v['ID'].' <i class="fa fa-cog"></i> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        
                        <li>
                            <a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#edit_dan" class="edit_dan">Редактировать расчетные данные</a>
                        </li> 
               ';
               if($v['STATE_RDN'] == '0'){
                   echo '             <li>
                                    <a href="reins_ns?reins_soglasen='.$v['ID'].'">Согласовано в части начисления</a>
                                </li>                                                               
                   ';
               }else{
                   echo '
                                <li>
                                    <a href="reins_ns?print_mail='.$v['ID'].'" target="_blank">Печать письма</a>
                                </li>
                                
                                <li>
                                    <a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#kvitovanie" class="btn_plat">Погасить</a>
                                </li>
                   ';
               }
               echo '
                            <li>
                                <a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#modal_files" class="contracts_files">Файлы</a>
                            </li>
                        </ul>
                    </div>
                    </td>
                    <td>'.$v['FIO'].'</td>
                    <td>'.$v['POLUCH'].'</td>
                    <td>
                        <a href="contracts?CNCT_ID='.$v['CNCT_ID_OSOR'].'" target="_blank">
                        '.$v['CONTRACT_NUM'];
                    if(trim($v['CONTRACT_DATE']) !== ''){
                    echo '<br /> от '.$v['CONTRACT_DATE'];    
                    }
                    echo '</a>                        
                    </td>
                    <td>'.$v['PRICHINA'].'</td>
                    <td><a href="contragents?view='.$v['ID_INSUR'].'" target="_blank">'.$v['STRAHOVATEL'].'</a></td>
                    <td><a href="contracts?CNCT_ID='.$v['CNCT_ID_OSNS'].'" target="_blank">'.$v['CONTRACT_NUM_OSNS'].'</a></td>
                    <td>'.$v['CONTRACT_DATE_OSNS'].'</td>
                    <td>'.$v['REINSNAME'].'</td>
                    <td>'.$v['CONTRACT_NUM_REINS'].'</td>
                    <td>'.$v['CONTRACT_DATE_REINS'].'</td>
                    <td>'.$v['PERC_S_STRAH'].'</td>
                    
                    <td>'.$v['SUM_PAY'].'</td>';
                    //<td>'.$v['PAY_DATE'].'</td>
                    echo '<td>'.$v['PAY_SUM_P'].'</td>
                    <td class="pay_sum_'.$v['ID'].'">'.$v['SUM_DEB'].'</td>
                    <td>'.$v['DATE_DEB'].'</td>
                    <td>'.$v['DATE_OTPR_REINS'].'</td>                    
                    <td>'.$v['SUM_NACH'].'</td>
                    <td>'.$v['DATE_NACH'].'</td>
                </tr>'; 
            }
        ?>
        </tbody>
        </table>
    </div>
</div>


<div class="modal inmodal fade" id="draw" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Схема работы</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <img src="images/reins_ns.png" width="100%"/>
            </div>
        </div>
    </div>
</div>    

<div class="modal inmodal fade" id="kvitovanie" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Погашение дебиторской задолжности</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">
                    <form class="col-lg-12" id="search_kvit_form">
                        <h3>Поиск</h3>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label>Дата платежа с</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_begin" class="form-control" value="" data-mask="99.99.9999" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_end" class="form-control" value="" data-mask="99.99.9999" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label>Сумма</label>
                                <input type="number" name="pay_sum" class="form-control">                            
                            </div>
                            <div class="col-lg-3">
                                <label>БИН</label>
                                <input type="text" name="bin" class="form-control">
                            </div>
                            <div class="col-lg-3"> 
                                <label>Сквитован Да/нет</label>                           
                                <select name="skvit" class="form-control">
                                    <option value=""></option>
                                    <option value="0">Сквитован</option>
                                    <option value="1">Не сквитован</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-3">
                                <label>&nbsp;</label>
                                <button class="btn btn-success btn-block" id="search_kvit"><i class="fa fa-search"></i> Найти</button>
                            </div>
                            
                            <input type="hidden" name="search_plat_kvit" value="">
                            <input type="hidden" name="mhmh_id_vozvr" id="mhmh_id_vozvr" value="0">
                            <input type="hidden" name="id_transh" id="id_transh" value="0">
                        </div>
                    </form>
                    <div class="col-lg-12">
                        <hr>                                                        
                        <h3 class="pull-left">Результат поиска</h3>
                        <form method="post" id="form_kvit" style="max-height: 400px;overflow: auto; width:100%">
                            
                            <div style="float: right;width: 50%;position: absolute;right: 5px;top: 30px;" id="div_date_dohod">
                                <label class="col-lg-3">Дата взятия в доход</label>
                                <div class="col-lg-9">                    
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="date_dohod_kvit" class="form-control" value="<?php echo date("d.m.Y"); ?>" data-mask="99.99.9999">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="view_plat">
                            
                            </div>
                            <input type="hidden" name="save_kvit" id="save_kvit_edit" value="0"/>
                        </form>                        
                    </div>                    
                </div>                                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="save_kvit">Сквитовать</button>
                <button type="button" class="btn btn-white" id="close_btn_kvit" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="edit_dan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактирование расчетных данных</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">
                    <form class="col-lg-12" id="edit_raschet_dan" method="post">
                        <label>Введите верную сумму расчета</label>
                        <input type="number" name="raschet_pay_sum" class="form-control">
                        <input type="hidden" name="save_raschet" value="0">
                    </form>                                      
                </div>                                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="save_edit_raschet">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<?php 
    require_once __DIR__.'/../reinsurance/modal_files.php'
?>

<script>    

$('.btn_plat').click(function(){
    var id = $(this).attr('data');        
    $('#save_kvit_edit').val(id);
});

$('.btn_plat_1с').click(function(){
    var id = $(this).attr('data');    
    $('#save_kvit_edit_1c').val(id);
});

$('#search_kvit').click(function(e){
    e.preventDefault();        
    $.post(window.location.href, $('#search_kvit_form').serialize(), function(data){        
       $('#view_plat').html(data);
    });        
});
/*
$('#search_kvit_1c').click(function(e){
    e.preventDefault();        
    $.post(window.location.href, $('#search_kvit_form_1c').serialize(), function(data){        
       $('#view_plat_1c').html(data);
    });        
});
*/

$('body').on('click', '.btn_kvit', function(e){
    e.preventDefault();
    var id = $(this).attr('id');    
    var id_contract = $('#view_plat').attr('data');    
    $.post(window.location.href, {"set_kvitov_ns":id_contract, "mhmh":id}, function(data){
        console.log(data);
    });      
});

$('body').on('click', '.set_kvit_check', function(){
    var id = $(this).attr('id');
    var pay = $(this).attr('data').replace(',', '.');
    var b = $(this).prop('checked');
    if(b == true){
        $('#cn_'+id).html('<input type="number" class="kvit_check" name="edit_kvit['+id+']" value="'+pay+'">');
    }else{
        $('#cn_'+id).html(pay.replace('.', ','));
    }    
});

$('body').on('click', '#save_kvit', function(){
    $('#form_kvit').submit();
})
$('body').on('click', '#save_kvit_1c', function(){
    $('#form_kvit_1c').submit();
});

$('body').on('click', '.edit_dan', function(){
   var id = $(this).attr('data');
   var sums = $('.pay_sum_'+id).html();
   $('input[name=raschet_pay_sum]').val(sums.replace(',', '.'));
   $('input[name=save_raschet]').val(id);   
});

$('#save_edit_raschet').click(function(){
    $('#edit_raschet_dan').submit();
});
</script>
<style>
th{
    text-align: center;
}

.dropdown-menu{    
    max-height: 250px;
    overflow: auto;
}
</style>