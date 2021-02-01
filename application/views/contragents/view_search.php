<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">Данные контрагента</a></li>
        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Договора страхования</a></li>
    </ul>
    
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">    
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        
                        <div class="col-lg-12" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Полное наименование</strong><br>
                            <div class="formForData" id="DEYAT_NAME"><?php echo $dan[0]['NAME']; ?></div>
                        </div>
                        
                        <div class="col-lg-6" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Адрес</strong><br>
                            <div class="formForData" id="DEYAT_NAME"><?php echo $dan[0]['ADDRESS']; ?></div>
                        </div>
                        
                        <div class="col-lg-6" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Телефон</strong><br>
                            <div class="formForData" id="PHONE"><?php echo $dan[0]['PHONE']; ?></div>
                        </div>
                        
                        <div class="col-lg-6" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Руководитель</strong><br>
                            <div class="formForData" id="CHIEF"><?php echo $dan[0]['CHIEF']; ?></div>
                        </div><?php if($dan[0]['RESIDENT'] == "1"){$res  = 'Да';}else $res  = 'Нет';?>                
                        
                        <div class="col-lg-2" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Резидент</strong><br>
                            <div class="formForData"><?php echo $res; ?></div>
                        </div>
                        
                        <div class="col-lg-4" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">БИН\ИИН</strong><br>
                            <div class="formForData" id="DEYAT_NAME"><?php echo $dan[0]['BIN']; ?></div>
                        </div>
                        
                        <div class="col-lg-12" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Основной вид деятельности</strong><br>
                            <div class="formForData" id="DEYAT_NAME"><?php echo $ok[0]['NAME']; ?></div>
                        </div>                
                        
                        <div class="col-lg-4" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Сектор экономики</strong><br>
                            <div class="formForData" id="SEC_ECONOM"><?php echo $dan[0]['SEC_ECONOM']; ?></div>
                        </div>
                        
                        <div class="col-lg-4" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Банк</strong><br>
                            <div class="formForData" id="BANK_NAME"><?php echo $dan[0]['BANK_NAME']; ?></div>
                        </div>               
                        
                        <div class="col-lg-4" title="text">
                            <strong data-toggle="tooltip" data-placement="buttom" title="title">Счет</strong><br>
                            <div class="formForData" id="P_ACCOUNT"><?php echo $dan[0]['P_ACCOUNT']; ?></div>
                        </div>
                                           
                    </div>        
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="ibox float-e-margins">
                <div class="ibox-content">                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>№ договора</th>
                                <th>Дата договора</th>
                                <th>Статус</th>                        
                                <th>Страховая премия</th>
                                <th>Страховая сумма</th>                        
                                <th>Тип договора</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            foreach($contracts as $k=>$v){
                                echo '<tr>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                <td>'.$v['CONTRACT_DATE'].'</td>
                                <td>'.$v['STATE'].'</td>                        
                                <td>'.$v['PAY_SUM_P'].'</td>
                                <td>'.$v['PAY_SUM_V'].'</td>        
                                <td>'.$v['PROGNAME'].'</td>
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