<table class="table table-bordered">
<thead>
    <tr>
        <th>№ п/п</th>
        <th>№ договора</th>
        <th>Дата договора</th>
        <th>Наименование</th>
        <th>Страховая премия</th>
        <th>Страховая выплата</th>
        <th>Дата начала</th>
        <th>Дата окончания</th>
        <th>Страна</th>
        <th>Дата закрытия договора</th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        foreach($dan as $k=>$v){
            echo '
            <tr>
                <td>'.$i.'</td>
                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                <td>'.$v['CONTRACT_DATE'].'</td>
                <td>'.$v['NAME_COUNTRY'].'</td>
                <td><a href="contragents?view='.$v['ID'].'" target="_blank">'.$v['NAME'].'</a></td>
                <td>'.NumberRas($v['PAY_SUM_P']).'</td>
                <td>'.NumberRas($v['PAY_SUM_V']).'</td>
                <td>'.$v['DATE_BEGIN'].'</td>
                <td>'.$v['DATE_END'].'</td>                
                <td>'.$v['DATE_CLOSE'].'</td>
            </tr>
            ';
            $i++;
        }
    ?>    
</tbody>
</table>