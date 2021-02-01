<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Перенос договоров № <?php echo $bordero->dan_array['num']; ?></h3>
                </div>
                <div class="ibox-content">
                    <form method="post">
                    <input type="hidden" name="move_contract_id" value="<?php echo $bordero->dan_array['id']; ?>"/>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2"><input type="checkbox" class="check_all"/></th>
                            <th rowspan="2">№ договора</th>
                            <th rowspan="2">Страхователь</th>
                            <th rowspan="2">Перестраховщик</th>
                            <th colspan="2"><center>Период защиты</center></th>
                            <th rowspan="2"><center>Премия</center></th>
                            <th rowspan="2"><center>К Оплате</center></th>
                            <th rowspan="2"><center>Коммиссия</center></th>
                            <th rowspan="2"><center>Сумма</center></th>
                            <th rowspan="2"><center>Траншевый <br />Да/Нет</center></th>
                        </tr>
                        <tr>                            
                            <th><center>Дата начала</center></th>
                            <th><center>Дата окончания</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($bordero->dan_array['list'] as $k=>$v){
                    ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="move_cnct[]" value="<?php echo $v['CNCT_ID']; ?>"/></td>
                        <td><?php echo $v['CONTRACT_NUM'] ?></td>
                        <td><?php echo $v['STRAH'] ?></td>
                        <td><?php echo $v['REINSNAME'] ?></td>
                        <td><center><?php echo $v['DATE_BEGIN'] ?></center></td>
                        <td><center><?php echo $v['DATE_END'] ?></center></td>
                        <td><center><?php echo $v['PAY_SUM'] ?></center></td>
                        <td><center><?php echo $v['PAY_SUM_OPL'] ?></center></td>
                        <td><center><?php echo $v['KOMIS_REINS'] ?></center></td>
                        <td><center><?php echo $v['SUM_S_STRAH'] ?></center></td>
                        <td><center><?php if($v['ID_TRANSH'] !== ''){echo 'Да';}else echo 'Нет'; ?></center></td>
                    </tr>
                    <?php  
                        }                         
                    ?>                    
                    </tbody>
                    </table>
                    
                    <div class="row">
                        <h3>Поиск договора перестрахования</h3>
                        <div class="col-lg-5">
                            <input type="text" id="search_text" class="form-control" placeholder="Введите № договора перестрахования"/>
                        </div>
                        <div class="col-lg-1">
                            <a class="btn btn-success btn-block" id="search_reins_contract"><i class="fa fa-search"></i>Найти</a>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary pull-right" type="submit" name="set_move_contract">Перенести</button>
                        </div>
                        <div class="col-lg-12" id="search_result">
                            
                        </div>
                    </div>
                    
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('.check_all').click(function(){
    var s = $(this).prop('checked');
    $('.checkbox').each(function(){
        $(this).prop('checked', s);
    });    
})

$('#search_reins_contract').click(function(){
    var t = $('#search_text').val();
    var id = $('input[name=move_contract_id]').val(); 
    if(t == ''){
        alert('Поисковое поле не может быть пустым');
        return false;
    }
    
    $.post(window.location.href, {"search_move_contracts": t}, function(data){
        var h = $('#search_result');
        h.html('');
        var j = JSON.parse(data);
        console.log(j);
        if(j.message !== ''){
            alert(j.message);
            return false;
        }                        
        $.each(j.list, function(i, e){
            h.append('<hr />');
            h.append('<div class="row">');
            h.append('<div class="col-lg-3"><label><input type="radio" name="new_id_move" value="'+e.ID+'"> '+e.CONTRACT_NUM+' от '+e.CONTRACT_DATE+' г.</label></div>');                
            h.append('<div class="col-lg-6"><label>'+e.REINSNAME+'</label></div>');
            h.append('</div>');
        });        
    })
});
</script>