<?php
	require_once 'methods/reinsurance.php';
    $r = new REINSURANCE();
    $dan = $r->listNot_transh();
?>
<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h2>Список договоров, по которым не была произведена оплата траншей</h2>
            </div>
            
            <div class="ibox-content"> 
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2"><center>Данные по страхователю</center></th>
                        <th colspan="2"><center>Данные по договору страхования</center></th>
                        <th colspan="2"><center>Данные по договору Перестрахования</center></th>
                        <th rowspan="2"><center>Дата начала</center></th>
                        <th rowspan="2"><center>Дата окончания</center></th>                        
                        <th rowspan="2"><center>№ транша</center></th>
                        <th rowspan="2"><center>Сумма транша</center></th>
                        <th rowspan="2"><center>Дата транша</center></th>
                    </tr>
                    <tr>
                        <th><center>Страхователь</center></th>
                        <th><center>БИН</center></th>
                        
                        <th><center>№ договора</center></th>
                        <th><center>Дата договора</center></th>
                        
                        
                        <th><center>№ договора</center></th>
                        <th><center>Дата договора</center></th>                                                
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dan as $k=>$v){
                            echo '<tr>
                                <td><a href="contragents?view='.$v['ID_INSUR'].'" target="_blank">'.$v['NAME'].'</a></td>
                                <td>'.$v['BIN'].'</td>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                <td>'.$v['CONTRACT_DATE'].'</td>
                                <td><a href="reins_bordero?form_setstate='.$v['ID_BORDERO'].'" target="_blank">'.$v['CN_REINS'].'</a></td>
                                <td>'.$v['CD_REINS'].'</td>
                                <td>'.$v['DATE_BEGIN'].'</td>
                                <td>'.$v['DATE_END'].'</td>
                                <td>'.$v['NOM'].'</td>
                                <td>'.$v['PAY_SUM'].'</td>
                                <td>'.$v['DATE_PL'].'</td>
                            </tr>';
                        }
                    ?>
                </tbody>
                </table>                                
            </div>
        </div>
    </div>
</div>
                    
         
              