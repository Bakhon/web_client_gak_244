<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins"> 
                <div class="ibox-title">                                    
                    <h3>Резиденты США</h3>
                    
                </div>                   
                <div class="ibox-content">
                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">№ п\п</th>
                            <th rowspan="2">№ договора</th>
                            <th rowspan="2">Дата договора</th>
                            <th colspan="3"><center>ФИО клиента</center></th>
                            <th rowspan="2"></center>Премия</center></th>
                            <th rowspan="2"></center>Выплата</center></th>
                            <th colspan="2"></center>Период действия</center></th>
                            <th rowspan="2"></center>Дата закрытия</center></th>                            
                        </tr>
                        <tr>
                            <td>Фамилия</td>
                            <td>Имя</td>
                            <td>Отчество</td>
                            
                            <td>Начало</td>
                            <td>Конец</td>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php 
                            foreach($kk->result as $k=>$v){                            
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td>                                
                                <a href="contracts?CNCT_ID=<?php echo $v['CNCT_ID']; ?>" target="_blank"><?php echo $v['CONTRACT_NUM']; ?></a>
                            </td>
                            <td><?php echo $v['CONTRACT_DATE']; ?></td>
                            <td><a href="clients?view=<?php echo $v['SICID']; ?>" target="_blank"><?php echo $v['LASTNAME']; ?></a></td>
                            <td><a href="clients?view=<?php echo $v['SICID']; ?>" target="_blank"><?php echo $v['FIRSTNAME']; ?></a></td>
                            <td><a href="clients?view=<?php echo $v['SICID']; ?>" target="_blank"><?php echo $v['MIDDLENAME']; ?></a></td>
                            <td><?php echo NumberRas($v['PAY_SUM_P']); ?></td>
                            <td><?php echo NumberRas($v['PAY_SUM_V']); ?></td>   
                            <td><?php echo $v['DATE_BEGIN']; ?></td>
                            <td><?php echo $v['DATE_END']; ?></td>
                            <td><?php echo $v['DATE_CLOSE']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>