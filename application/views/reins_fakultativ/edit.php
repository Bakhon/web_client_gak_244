<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">    
            
                <div class="ibox-title">                    
                    <div class="ibox-tools" style="text-align: left;">                          
                        <?php                            
                            echo '<b>'.$reins->list_reins['R_NAME'].'</b><br />';
                            echo 'Вид <b>Новый</b><br />';
                            echo '№ договора по перестрахованию <b>'.$_POST['contract_num'].'</b><br />';
                            echo 'Дата договора по перестрахованию <b>'.$_POST['contract_date'].'</b><br />';                            
                            echo 'Скидка перестраховщика <b class="skidka">'.$reins->list_reins['SKIDKA'].'</b><br />';
                            if(isset($_POST['id_head'])){
                                $id_head = $_POST['id_head'];
                            }
                        ?>
                        <input type="hidden" class="id_head" value="<?php echo $id_head; ?>"/>
                    </div>
                </div>
                           
                <div class="ibox-content" style="overflow: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">№ договора страхования</th>                            
                            <th rowspan="2">Статус бизнеса</th>
                            <th rowspan="2">Страхователь</th>
                            <th rowspan="2">Страховая сумма</th>
                            <th colspan="2">Собственное удержание </th>
                            <th colspan="2">Ответственность перестраховщика</th>
                            <th rowspan="2">Страховая премия по договору</th>
                            <th colspan="2">Перестраховочная премия</th>
                            <th rowspan="2">Перестраховочная премия к оплате</th>
                            <th rowspan="2">Условия оплаты страховой премии</th>
                            <th rowspan="2">Примечание</th>
                        </tr>
                        <tr>                                                        
                            <th>%</th>
                            <th>Сумма</th>
                            <th>%</th>
                            <th>Сумма</th>                            
                            <th>%</th>
                            <th>Сумма</th>                                                                                    
                        </tr>
                    </thead>
                    <tbody>                    
                    <?php 
                        $prim = '';
                        if(isset($_POST['id_uv'])){
                            if($_POST['id_uv'] == '2'){
                                $prim = 'Нестандартный договор';
                            }
                        }
                        foreach($reins->dan as $k=>$v){
                            echo '
                            <tr class="reins_dog" data="'.$v['CNCT_ID'].'">
                                <td>'.$v['CONTRACT_NUM'].'</td>                        
                                <td>Новый</td>
                                <td>'.$v['STRAHOVATEL'].'</td>
                                <td style="width: 100px;" class="pay_sum_v" id="'.$v['CNCT_ID'].'">'.StrToFloat($v['PAY_SUM_V']).'</td>
                                <td style="width: 100px;">
                                    <input type="number" data="'.$v['CNCT_ID'].'" min="'.$v['MIN_PP'].'" max="100" id="'.$v['CNCT_ID'].'" class="form-control gak_proc" value="0">
                                </td>
                                <td style="width: 130px;" class="gak_summa" id="'.$v['CNCT_ID'].'">0</td>
                                <td style="width: 70px;" class="reins_proc" id="'.$v['CNCT_ID'].'">0</td>
                                <td style="width: 130px;" class="reins_summa" id="'.$v['CNCT_ID'].'">0</td>
                                <td style="width: 130px;"class="pay_sum_p" id="'.$v['CNCT_ID'].'">'.$v['PAY_SUM_P'].'</td>
                                <td style="width: 100px;">
                                    <input type="number" class="form-control prs_prem_proc" min="'.$v['MIN_PP'].'" max="100" id="'.$v['CNCT_ID'].'" value="0">
                                </td>
                                <td style="width: 100px;"class="prs_prem_summa" id="'.$v['CNCT_ID'].'">0</td>
                                <td style="width: 130px;"class="prs_prem_opls" id="'.$v['CNCT_ID'].'">0</td>
                                <td class="type_periodich" id="'.$v['CNCT_ID'].'"  data="'.$v['PR'].'">'.$v['PERIODICH'].'</td> 
                                <td class="prim" id="'.$v['CNCT_ID'].'">'.$prim.'</td>
                            </tr>
                            ';
                        }
                    ?>
                    </tbody>
                </table>
                </div>
                <div class="ibox-footer" style="text-align: right;">
                    <button class="btn btn-success" id="save_reins">Утвердить</button>
                </div>
            </div>            
        </div>
    </div>
</div>
<script>

function rasr(num){
    return num;
    //return num.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
}

$('.gak_proc').keyup(function(e){      
    var id = $(this).attr('data');    
    var type_period = $('#'+id+'.type_periodich').attr('data');
    var id_uv = 0;
    <?php 
        if(isset($_POST['id_uv'])){
            echo 'id_uv = '.$_POST['id_uv'].';';
        }
    ?>
    var p = $(this).val(); 
    if(p >= 100){
        alert('Вы задали неверный диапазон');
        return false;
    }        
    
    var vs = parseFloat($('#'+id+'.pay_sum_v').html().replace(/^\s+/, ""));
    var ps = parseFloat($('#'+id+'.pay_sum_p').html());        
    var res = 100 - p;
    var skidka = $('.skidka').html();
    if(skidka == ''){
        skidka = 0;
    }
    var res = res-(res*(skidka / 100));    
    var reins_summa = vs * (res / 100);    
    var gak_summa = vs * (p / 100);
    var pay_sum_p = ps * (res / 100);
    console.log(ps+' * '+'('+res+' / 100)');
                           
    $('#'+id+'.reins_proc').html(rasr(res.toFixed(2)));
    $('#'+id+'.prs_prem_proc').val(rasr(res.toFixed(2)));    
    $('#'+id+'.reins_summa').html(rasr(reins_summa.toFixed(2)));
    $('#'+id+'.gak_summa').html(rasr(gak_summa.toFixed(2)));    
    $('#'+id+'.prs_prem_summa').html(rasr(pay_sum_p.toFixed(2)));
    
    if(id_uv == 2){
        $('#'+id+'.prs_prem_opls').html(0);
    }else{
        $('#'+id+'.prs_prem_opls').html(rasr(pay_sum_p.toFixed(2)));    
    }
        
    if(type_period == 2){        
        var s = {
            "id": id,
            "proc": res
        };
        
        $.post(window.location.href, {"reins_transh": s}, function(data){
            if(data.trim() !== ''){
                $('#'+id+'.prim').html(data);
            }
        });        
    }            
});


$('#save_reins').click(function(){
    var dan = [];
    var i = 0;
    var c = $('.reins_dog').length;  
         
    $('.reins_dog').each(function(){
        var id = $(this).attr('data');        
        var ds = new Object();
        ds.cnct_id = id;
        ds.vid = '<?php echo $_POST['reins_vid']; ?>';
        ds.reins_id = '<?php echo $_POST['reins_name']; ?>';
        ds.contract_num = '<?php echo $_POST['contract_num']; ?>';
        ds.contract_date = '<?php echo $_POST['contract_date']; ?>';
        
        ds.gak_proc = $('#'+id+'.gak_proc').val();
        ds.gak_summa = $('#'+id+'.gak_summa').html();
        ds.reins_proc = $('#'+id+'.reins_proc').html();
        ds.reins_summa = $('#'+id+'.reins_summa').html();        
        ds.reins_prem_proc = $('#'+id+'.prs_prem_proc').val();
        ds.reins_prem_summa = $('#'+id+'.prs_prem_opls').html();                                
        ds.skidka = $('.skidka').html();
        dan.push(ds);        
    });
     var id_head = $('.id_head').val();
     var res = JSON.stringify(dan);   
     var id_uv = 0;
     <?php 
        if(isset($_POST['id_uv'])){
            echo 'id_uv = '.$_POST['id_uv'].';';
        }
     ?>  
     $.post(window.location.href, {"id_head": id_head, "save_reins_contr_num": dan, "id_uv":id_uv}, function(data){
        $('.wrapper-content').prepend(data);
        //ExecuteScript(data);        
     });
});
</script>

<style>
.cssload-thecube{
    left: 48%;
}

input{
    min-width: 55px;
}
</style>