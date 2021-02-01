<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                    
                                             
                   <a href="reins_dobr" class="btn btn-default pull-right btn-sm">Назад</a>   
                   <h3>Список договоров на собственном удержании</h3>                                                                                                                                                                                                                                        
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
                                $btns_del = '<a class="btn btn-sm btn-danger btn-block return_list" style="color: #fff;" id="'.$v['CNCT_ID'].'">Вернуть в список</a>';
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

<script>

$('.return_list').click(function(){
    var id = $(this).attr('id'); 
    var s = [];
    s[0] = id;
           
    $.post(window.location.href, {'return_cnct': s}, function(data){
        if(data.trim() == ''){
            window.location.reload();
        }    
    });
});


</script>