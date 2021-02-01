<div class="row">
    <div class="ibox">
        <form method="post">
        <div class="ibox-title">
            <h3>Удаление договоров страхования из договора перестрахования
            <span class="text-danger">
            № 
            <?php echo $reins->dan['ps']['CONTRACT_NUM'] ?> от
            <?php echo $reins->dan['ps']['CONTRACT_DATE'] ?> г.
            </span> 
            </h3>
        </div>
        <div class="ibox-content">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" class="check_all"/></th>
                <th>№ договора</th>
                <th>Дата договора</th>
                <th>Страхователь</th>
                <th>Перестраховочная Премия</th>
                <th>Сумма к оплате</th>
                <th>Комиссия перестраховщика</th>
                <th>Сумма перестраховщика</th>
                <th>Транш <br />Да/Нет</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($reins->dan['list'] as $k=>$v){ 
            $transh = 'Нет';
            if(trim($v['ID_TRANSH']) !== ''){
                $transh = 'Да';
            }
            echo '<tr>
            <td><input type="checkbox" class="check" name="delcnct[]" value="'.$v['CNCT_ID'].'|'.$v['ID_CONTRACTS'].'|'.$v['ID_TRANSH'].'"/></td>
            <td><a target="_blank" href="contracts?CNCT_ID='.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</a></td>
            <td>'.$v['CONTRACT_DATE'].'</td>
            <td>'.$v['STRAHOVATEL'].'</td>
            <td>'.$v['PAY_SUM'].'</td>
            <td>'.$v['PAY_SUM_OPL'].'</td>
            <td>'.$v['KOMIS_REINS'].'</td>
            <td>'.$v['SUM_S_STRAH'].'</td>
            <td>'.$transh.'</td>
        </tr> ';
        } ?>
        </tbody>
        </table>
        </div>
        
        <div class="ibox-footer">
            <center>
                <input type="submit" class="btn btn-success" value="Сохранить"/>
                <a href="reins_fakultativ?list_contracts" class="btn btn-danger">Отмена</a>
            </center>
        </div>
        </form>
    </div>
</div>
<script>
$('.check_all').click(function(){
   var b = $(this).prop('checked');
   $('.check').prop('checked', b);
});
</script>