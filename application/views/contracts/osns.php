<?php 
    $forms = new FORMS();
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins">                         
                <div class="ibox-content">                                        
                    <div class="row">  
                        <div class="col-lg-12">         
                            <div class="wrapper wrapper-content animated fadeInRight">            
                                <div class="row">
                
                                    <div class="col-lg-12">
                                        <div class="tabs-container">                    
                                            <ul class="nav nav-tabs" role="tablist" id="contract-tabs">
                                            <?php                                 
                                                foreach($dan as $k=>$v){
                                                    $act = '';
                                                    if($v['CNCT_ID'] == $cnct_id){$act = 'active';}
                                                    echo '<li role="presentation" class="'.$act.'"><a data-toggle="tab" href="#'.$v['CNCT_ID'].'"> '.$v['ISFILE'].' № '.$v['CONTRACT_NUM'].'</a></li>';                                    
                                                }
                                            ?>                        
                                            </ul>
                                            
                                            <div class="tab-content">
                                            <?php                                  
                                                foreach($dan as $k=>$v){
                                                    $act = '';
                                                    if($v['CNCT_ID'] == $cnct_id){$act = 'active';}
                                            ?>
                        
                                            <div id="<?php echo $v['CNCT_ID'] ?>" class="tab-pane <?php echo $act; ?>">
                                                <div class="panel-body form-horizontal">                                                                       
                                                    <div class="row">                                                                                                                                                                  
                                                    <?php
                                                        echo $forms->formGroup2(4, 'Номер договора', $v['CONTRACT_NUM']);
                                                        echo $forms->formGroup2(4, 'Номер заявления', $v['ZV_NUM']);
                                                    ?>
                                                    
                                                    <div class="col-lg-4" title="Наличие индексации страховых выплат">
                                                    <br/>
                                                    <div class="i-checks"> <input type="checkbox" checked="" disabled=""/>
                                                        <label><div id="chekBoxPadding">Отсутствие страх.дела</div></label>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                            <?php
                                                echo $forms->formGroup2(4, 'Дата договора', $v['CONTRACT_DATE']);
                                                echo $forms->formGroup2(4, 'Дата заявление', $v['ZV_DATE']);
                                    
                                                $statname = $v['STATE_NAME'];
                                                $statFirstSimbol = trim($statname[0].$statname[1]);
                                                //echo $forms->ContractsMenu(4, $v['CNCT_ID'], $v['PAYM_CODE']);
                                            ?>
                                            
                                            <script src="styles/js/jquery-ui-1.10.4.min.js"></script>
                                            <script src="styles/js/jquery.printPage.js"></script>
                                            
                                            <div class="col-lg-4" >
                                                <strong data-toggle="tooltip" data-placement="buttom" title="Меню">Меню</strong>
                                                    <div class="btn-group" style="width: 100%;">
                                                        <button data-toggle="dropdown" class="btn btn-white" aria-expanded="false" style="width: 100%;border-radius: 5px;color: #FFF;background: #848688;border: 1px solid #CECECE;padding: 1px 6px;">Выбор функции <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <?php 
                                                            if($v['STATE'] == 12||$v['STATE'] == 11){ 
                                                                echo '<li><a href="#" data-toggle="modal" data-target="#new_reason_dop_'.$v['CNCT_ID'].'">Регистрация дополнительного соглашения</a></li>';
                                                            }
                                                            ?>
                                                            <!--<li><a href="printdog?cnct_id=<?php echo $v['CNCT_ID']; ?>" class="printBtn">Печать договора</a></li>-->
                                                            <li><a href="loadpdf?cnct_id=<?php echo $v['CNCT_ID']; ?>" target="_blank">Печать договора (PDF)</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="rep?id=2022&&<?php echo $v['CNCT_ID']; ?>" class="printBtn">Заявка на андерайтинг</a></li>
                                                            <li><a href="rep?id=2022&&<?php echo $v['CNCT_ID']; ?>&&export" class="printBtn">"Экспорт Заявки на андерайтинг в Excel</a></li>
                                                            <li class="divider"></li>                                                                                                                                                                    
                                                            <li><a href="print_zav_osns?cnct=<?php echo $v['CNCT_ID']; ?>" target="_blank">Печать заявления</a></li>
                                                            <li class="divider"></li>
                                                            <?php
                                                                if($statFirstSimbol == 0 or $statFirstSimbol == 5 or $statFirstSimbol == 6 or $statFirstSimbol == 9 or $statFirstSimbol == 19 
                                                                    or $statFirstSimbol == 20 or $statFirstSimbol == 24 or $statFirstSimbol == 27 or $statFirstSimbol == 28){
                                                                        $url = 'new_contract?CNCT_ID='.$v['CNCT_ID'].'&&paym_code='.$v['PAYM_CODE'];
                                                                        if(trim($v['REASON_DOPS']) !== ''){
                                                                            $url = 'reason_dop?CNCT_ID='.$v['CNCT_ID'].'&&edit';
                                                                        }
                                                                    echo '<li><a href="'.$url.'">Редактирование</a></li>';
                                                                }
                                                                
                                                                if($v['STATE'] !== 12||$v['STATE'] !== 11){ 
                                                                    echo '<li><a href="#" data-toggle="modal" data-target="#move_arhive_contracts_'.$v['CNCT_ID'].'">Перенести в архив</a></li>';
                                                                }                                                                                                                                                                                                 
                                                                if($v['STATE'] > 2){ 
                                                            ?>
                                                            <li>
                                                                <a class="schet_opl" data="<?php echo $v['CNCT_ID']; ?>">Печать счета на оплату</a>
                                                                <a href="printdog?cnct_id=<?php echo $v['CNCT_ID']; ?>&other=1" class="printBtn" id="cnct_<?php echo $v['CNCT_ID']; ?>" style="display: none;"></a>
                                                            </li>
                                                            <li>
                                                                <a href="printdog?cnct_id=<?php echo $v['CNCT_ID']; ?>&other=2" class="printBtn">Печать Акта выполенных работ</a>
                                                            </li>
                                                            <?php } ?>
                                                            <li class="divider"></li>                                                                                        
                                                            <li><a href="contracts_files?cnct_id=<?php echo $v['CNCT_ID']; ?>">Документы страхового дела</a></li>
                                                            <?php
                                                                if($active_user_dan['role'] !== 21){
                                                                    echo '<li><a href="accidents?id_ins='; echo $v['ID_INSUR'].'&CNCT_ID='.$v['CNCT_ID']; echo '">Регистрация несчастного случая</a></li>';
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>                                                                                                
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-12" title="Наличие индексации страховых выплат"  style="padding-right: 25px;padding-left: 0px;"><br />
                                </div>
                        </div>
                        <!--row 1 finish-->
                                     
                        <!--row 2 start-->
                        <div class="row">
                            <div class="hr-line-dashed"></div>
                            <?php 
                                echo $forms->formGroup2(12, 'Страхователь', $v['CONTAG_NAME']);
                                echo $forms->formGroup2(9, 'Основной вид деятельности', $v['VED_NAME']);
                                echo $forms->formGroup2(3, 'Класс проф. риска', $v['RISK_ID']);
                                echo $forms->formGroup2(3, 'ОКЭД по заявлению', $v['OKED']);
                                echo $forms->formGroup2(9, '', $v['OKED_NAME']);                                                                                                                                                                                    
                                echo $forms->formGroup2(4, 'Степень аффилированности', $v['AFFILIR']);
                                echo $forms->formGroup2(4, 'Категория', $v['CATEG_OSNS']);
                                echo $forms->formGroup2(4, 'Несчастные случаи на предприятии', $v['SUM_P_SOBST']);
                                echo $forms->formGroup2(5, 'Агент', $v['AGENT_DAN'][0]['FIO']);
                                echo $forms->formGroup2(5, 'Основание', $v['AGENT_DAN'][0]['DOGOVOR']);
                                echo $forms->formGroup2(2, 'Комиссия', $v['AGENT_DAN'][0]['PERCENT_OSNS']); 
                                if(count($v['AGENT_COMMIS'])>0){
                                    echo $forms->formGroup2(3, 'Сумма', $v['AGENT_COMMIS']['0']['SUM_PREM_COM']);                                                  
                                    echo $forms->formGroup2(3, 'Номер акта', $v['AGENT_COMMIS']['0']['NOM_ACT']);
                                    echo $forms->formGroup2(3, 'Процент', $v['AGENT_COMMIS']['0']['COMMIS_PERC']);
                                    echo $forms->formGroup2(3, 'Дата акта', $v['AGENT_COMMIS']['0']['DATE_ACT']);                                        
                                };
                            ?>  
                        </div>
                        <!--row 2 finish-->
                                    
                        <!--row 3 start-->
                        <div class="row">
                            <div class="hr-line-dashed"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9" id="osnsNew">
                                
                                    <?php
                                    if(count($v['OSNS_CALC_NEW'])>0){ 
                                        $new_calc = $v['OSNS_CALC_NEW'];   
                                        echo '<table class="table table-bordered dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Наименование</th>
                                                            <th>Численность</th>
                                                            <th>ГФОТ</th>
                                                            <th>Страховая сумма</th>
                                                            <th>Страховой тариф</th>
                                                            <th>Страховая премия</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';                                                                                     
                                        foreach($new_calc as $vcalc=>$ycalc){
                                            echo '
                                                <tr class="gradeX">
                                                    <td>'.$ycalc['NAME'].'</td>
                                                    <td>'.$ycalc['CNT'].'</td>
                                                    <td>'.$ycalc['GFOT'].'</td>
                                                    <td>'.$ycalc['STR_SUM'].'</td>
                                                    <td>'.StrToFloat($ycalc['TARIF']).'</td>
                                                    <td>'.$ycalc['PAY_SUM'].'</td>
                                                </tr>';    
                                        }
                                        echo '</tbody></table>';
                                    }
                                    ?>
                             
                                <?php
                                    if(count($v['OSNS_CALC_NEW'])==0){
                                    echo '
                                        <table class="table table-bordered dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Категория</th>
                                                <th>Количество</th>
                                                <th>ГФОТ</th>
                                                <th>Страховая сумма</th>
                                                <th>Тариф</th>
                                                <th>Прошлогодний тариф</th>
                                                <th>Тариф с надбавкой</th>
                                                <th>Старховая премия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                        <tr class="gradeX">
                                            <td>'.$v['PRIL2'][0]['NAME'].'</td>
                                            <td>'.$v['PRIL2'][0]['CNT'].'</td>
                                            <td>'.StrToFloat($v['PRIL2'][0]['GFOT']).'</td>
                                            <td>'.StrToFloat($v['PRIL2'][0]['STR_SUM']).'</td>
                                            <td>'.StrToFloat($v['TARIF_AUP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_LAST_AUP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_S_NADB_AUP']).'</td>
                                            <td>'.StrToFloat($v['PREM_AUP']).'</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>'.$v['PRIL2'][1]['NAME'].'</td>
                                            <td>'.$v['PRIL2'][1]['CNT'].'</td>
                                            <td>'.StrToFloat($v['PRIL2'][1]['GFOT']).'</td>
                                            <td>'.StrToFloat($v['PRIL2'][1]['STR_SUM']).'</td>
                                            <td>'.StrToFloat($v['TARIF_PP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_LAST_PP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_S_NADB_PP']).'</td>
                                            <td>'.StrToFloat($v['PREM_PP']).'</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>'.$v['PRIL2'][2]['NAME'].'</td>
                                            <td>'.$v['PRIL2'][2]['CNT'].'</td>
                                            <td>'.StrToFloat($v['PRIL2'][2]['GFOT']).'</td>
                                            <td>'.StrToFloat($v['PRIL2'][2]['STR_SUM']).'</td>
                                            <td>'.StrToFloat($v['TARIF_VP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_LAST_VP']).'</td>
                                            <td>'.StrToFloat($v['TARIF_S_NADB_VP']).'</td>
                                            <td>'.StrToFloat($v['PREM_VP']).'</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td><strong>Итого</strong></td>
                                            <td>'.$v['CNT_ALL'].'</td>
                                            <td>'.StrToFloat($v['GFOT_ALL']).'</td>
                                            <td>'.StrToFloat($v['PAY_SUM_V']).'</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>'.$v['PREM_ALL'].'</td>
                                        </tr>
                                    </tbody>
                                </table>
                                        ';
                                    }                                ?>
                             </div>
                             <?php
                                echo $forms->formGroup2(3, 'Дата расчета', $v['DATE_CALC'])
                             ?>
                             <div class="col-lg-4">
                                
                             </div>                          
                        </div>
                        <div class="row">
                                <div class="hr-line-dashed"></div>
                                <?php
                                    echo $forms->formGroup2(3, 'Страховая премия', $v['PAY_SUM_P']);
                                    echo $forms->formGroup2(3, 'Страховая премия по доп. соглашению', $v['PREM_S_ZP']);
                                    echo $forms->formGroup2(3, 'Поправочный коэффициент', $v['KOEF_PP']);
                                    echo $forms->formGroup2(3, 'Коэффициент увеличения', $v['KOEF_UV'])
                                    .'</div><div class="row">
                                    <div class="hr-line-dashed"></div>';
                                    echo $forms->formGroup2(3, 'Период страхования при подписании с', $v['DATE_BEGIN_FIRST']);
                                    echo $forms->formGroup2(3, 'по', $v['DATE_END_FIRST']);
                                    echo $forms->formGroup2(3, 'Периодичность', $v['PERIODICH']);
                                    echo $forms->formGroup2(3, 'Численность пострадавших', $v['SGCHP'])
                                    .'</div><div class="row">
                                    <div class="hr-line-dashed"></div>';
                                    echo $forms->formGroup2(3, 'Фактический период страхования с', $v['DATE_BEGIN']);
                                    echo $forms->formGroup2(3, 'по', $v['DATE_END']);
                                    echo $forms->formGroup2(3, 'Оплатить по', $v['DATE_OPL_DO']);
                                    echo $forms->formGroup2(3, 'Количество гарант. выплат', $v['CNT_GARANT_VIPL'])
                                    .'</div><div class="row">
                                    <div class="hr-line-dashed"></div>';
                                    echo $forms->formGroup2(3, 'Период страховой защиты', $v['DATE_BEGIN']);
                                    echo $forms->formGroup2(3, 'по', $v['DATE_END']);    
                                    echo $forms->formGroup2(3, 'Подлежит возврату', '');
                                    echo $forms->formGroup2(3, 'Уровень принятия решения', $v['LEVEL_NAME'])    
                                    .'</div><div class="row"><div class="hr-line-dashed"></div>';
                                ?>
                            </div>
                            
                            <!--row 3 finish-->
                            <div class="row">
                                <div class="hr-line-dashed"></div>
                                    <?php 
                                        echo $forms->formGroup2(12, 'Примечание', $v['NOTE']);
                                        echo $forms->formGroup2(6, 'Отделение', $v['BRANCH_NAME']);
                                        echo $forms->formGroup2(3, 'Инспектор', $v['EMP_NAME']);
                                        echo $forms->formGroup2(3, 'Ответственное лицо', $v['OTV_LICO']);
                                        echo $forms->formGroup2(6, 'Статус', $v['STATE_NAME']);
                                        echo $forms->formGroup2(6, 'Договор приостановлен', '');
                                    ?>
                                                                       
                                    <!--innner table start-->
                                    <div class="col-lg-12">
                                        <div class="hr-line-dashed"></div>
                                            <div class="tabs-container">
                                                <div class="tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <?php 
                                                        $active = 'active';
                                                        
                                                        if(count($v['REINSURANCE']) > 0){
                                                            echo '<li class="'.$active.'"><a data-toggle="tab" href="#reinsure'.$v['CNCT_ID'].'">Данные перестрахования</a></li>'; 
                                                            $active = '';
                                                        }
                                                        
                                                        if(count($v['PRIL2']) > 0){
                                                            echo
                                                            '<li class="'.$active.'"><a data-toggle="tab" href="#pril'.$v['CNCT_ID'].' ">Приложение 2</a></li>';
                                                            $active = '';
                                                            }
                                                        
                                                        if(count($v['TRANSH']) > 0){
                                                            echo
                                                            '<li class=""><a data-toggle="tab" href="#transh'.$v['CNCT_ID'].' ">Транши</a></li>';
                                                            $active = '';
                                                            }
                                                        
                                                        if(count($v['ACT_N1']) > 0){
                                                            echo
                                                            '<li class=""><a data-toggle="tab" href="#act'.$v['CNCT_ID'].' ">Акт Н1</a></li>';
                                                            $active = '';
                                                            }
                                                         
                                                        if(count($v['BAD_SLUCH_LIST']) > 0){
                                                            echo
                                                            '<li class=""><a data-toggle="tab" href="#nesch'.$v['CNCT_ID'].'">Статистика несчастных случаев</a></li>';
                                                            $active = '';
                                                            }
                                                        
                                                        if(count($v['VID']) !== 1){
                                                            echo
                                                            '<li class=""><a data-toggle="tab" href="#dopSogl'.$v['CNCT_ID'].' ">Данные по доп.соглашению</a></li>';
                                                            $active = '';
                                                            }                                                        
                                                        ?>                                                       
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php                                                             
                                                            if(count($v['REINSURANCE']) > 0){                                                                
                                                            echo '<div id="reinsure'.$v['CNCT_ID'].'" class="tab-pane active">';                                                                    
                                                                      echo '<div class="panel-body">';
                                                                      echo $forms->formGroup2(12, 'Перестраховщик', $v['REINSURANCE']['0']['CONTAG_NAME']);
                                                                      
                                                                      echo $forms->formGroup2(3, 'Номер договора перестраховки', $v['REINSURANCE']['0']['CONTRACT_NUM']);
                                                                      echo $forms->formGroup2(3, 'Дата договора', $v['REINSURANCE']['0']['CONTRACT_DATE']);
                                                                      echo $forms->formGroup2(3, 'Рейтинг агентство', $v['REINSURANCE']['0']['RAG_NAME']);
                                                                      echo $forms->formGroup2(3, 'Оценка', $v['REINSURANCE']['0']['ESTIMATION']);
                                                                      
                                                                      echo $forms->formGroup2(3, 'Дата начала действия', $v['REINSURANCE']['0']['DATE_BEGIN']);
                                                                      echo $forms->formGroup2(3, 'Доля страховой суммы страховщика', $v['REINSURANCE']['0']['PERC_S_STRAH']);
                                                                      echo $forms->formGroup2(6, '(Тенге)', $v['REINSURANCE']['0']['SUM_S_STRAH']);
                                                                      
                                                                      echo $forms->formGroup2(3, 'Дата окончания', $v['REINSURANCE']['0']['DATE_END']);
                                                                      echo $forms->formGroup2(3, 'Доля премии перестраховщика', $v['REINSURANCE']['0']['PERC_P_STRAH']);
                                                                      echo $forms->formGroup2(3, '(Тенге)', $v['REINSURANCE']['0']['SUM_P_STRAH']);
                                                                      echo $forms->formGroup2(3, 'Общая', $v['REINSURANCE']['0']['SUM_P_STRAH_ALL']);
                                                                      
                                                                      echo $forms->formGroup2(3, 'КДП', $v['REINSURANCE']['0']['SKIDKA']);
                                                                      echo $forms->formGroup2(3, 'Доля страховой суммы ГАК', $v['REINSURANCE']['0']['PERC_S_GAK']);
                                                                      echo $forms->formGroup2(6, '(Тенге)', $v['REINSURANCE']['0']['SUM_S_GAK']);
                                                                      
                                                                      echo $forms->formGroup2(3, 'Тариф перестраховщика', $v['REINSURANCE']['0']['TARIF']);
                                                                      echo $forms->formGroup2(3, 'Доля страховой премии ГАК', $v['REINSURANCE']['0']['PERC_P_GAK']);
                                                                      echo $forms->formGroup2(3, '(Тенге)', $v['REINSURANCE']['0']['SUM_P_GAK']);
                                                                      echo $forms->formGroup2(3, 'Общая', $v['REINSURANCE']['0']['SUM_P_GAK_ALL']);
                                                                      
                                                                      echo $forms->formGroup2(6, 'Комиссия от прибыли перестраховщика', $v['REINSURANCE']['0']['PERC_OT_PRIB']);
                                                                      //echo $forms->formGroup2(3, 'Комиссия агента от страховщика', $v['REINSURANCE']['0']['PERC_AGENT']);
                                                                      echo $forms->formGroup2(3, '№ Бордеро', '<a href="reins_bordero?form_setstate='.$v['REINSURANCE']['0']['BORDERO_ID'].'" target="_blank">'.$v['REINSURANCE']['0']['BORDERO_NUM'].'</a>');
                                                                    echo '</div> </div>';
                                                            }
                                                        ?>
                                                          
                                                        <div id="pril<?php echo $v['CNCT_ID']; ?>" class="tab-pane <?php if(count($v['REINSURANCE']) == 0) {echo'active';}?>">
                                                            <?php echo'
                                                                <div class="panel-body">
                                                                        <div class="col-lg-12">
                                                                                <table class="table table-bordered dataTables-example" >
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Наименование</th>
                                                                                        <th>Должности</th>
                                                                                        <th>Численность</th>
                                                                                        <th>Класс проф. риска</th>
                                                                                        <th>Оклад</th>
                                                                                        <th>СМЗП</th>
                                                                                        <th>ГФОТ</th>
                                                                                        <th>Страх сумма</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    ';
                                                                                        $pril2 = $v['PRIL2'];
                                                                                        
                                                                                        foreach($pril2 as $vig=>$y){
                                                                                        echo '<tr class="gradeX">
                                                                                        <td>'.$y['NAME'].'</td>
                                                                                        <td>'.$y['D_NAME'].'</td>
                                                                                        <td>'.$y['CNT'].'</td>
                                                                                        <td>'.$y['RISK'].'</td>
                                                                                        <td>'.$y['OKLAD'].'</td>
                                                                                        <td>'.$y['SMZP'].'</td>
                                                                                        <td>'.$y['GFOT'].'</td>
                                                                                        <td>'.$y['STR_SUM'].'</td>
                                                                                    </tr>';    
                                                                                    }                                                                                
                                                                                    echo '
                                                                                    </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>'?>
                                                                </div>
                                                        <div id="transh<?php echo $v['CNCT_ID']; ?>" class="tab-pane <?php if(count($v['REINSURANCE'] and $v['PRIL2']) == 0) {echo 'active';}?>">
                                                            <div class="panel-body">
                                                                <table class="table table-bordered table-hover dataTables-example" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Сумма</th>
                                                                        <th>Дата план</th>
                                                                        <th>Сумма факт</th>
                                                                        <th>Дата факт</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php 
                                                                    foreach($v['TRANSH'] as $vtransh=>$ytransh){
                                                                        echo '<tr class="gradeX">
                                                                            <td>'.$ytransh['PAY_SUM'].'</td>
                                                                            <td>'.$ytransh['DATE_PL'].'</td>
                                                                            <td>'.$ytransh['SUM_FACT'].'</td>
                                                                            <td>'.$ytransh['DATE_F'].'</td>
                                                                        </tr>';    
                                                                    }                                                                                
                                                                ?>
                                                                </tbody>
                                                                <?php 
                                                                //print_r($v['TRANSH']);
                                                                ?>
                                                            </table>    
                                                            </div> 
                                                        </div>
                                                        <div id="act<?php echo $v['CNCT_ID']; ?>" class="tab-pane <?php if(count($v['REINSURANCE'] and $v['PRIL2'] and $v['TRANSH']) == 0) {echo 'active';}?>">
                                                                <?php echo '<div class="panel-body">
                                                                            <table class="table table-bordered table-hover dataTables-example" >
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Категория</th>
                                                                                        <th>ФИО</th>
                                                                                        <th>Номер акта</th>
                                                                                        <th>Дата акта</th>
                                                                                        <th>Причина</th>
                                                                                        <th>Сред. зп</th>
                                                                                        <th>Возраст</th>
                                                                                        <th>Вина работодателя</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                                     
                                                                                        $act = $v['ACT_N1'];
                                                                                        
                                                                                        foreach($act as $va=>$ya){
                                                                                        echo '<tr class="gradeX">
                                                                                        <td>'.$ya['NAME'].'</td>
                                                                                        <td>'.$ya['FIO'].'</td>
                                                                                        <td>'.$ya['ACT_NOM'].'</td>
                                                                                        <td>'.$ya['ACT_DATE'].'</td>
                                                                                        <td>'.$ya['REASON'].'</td>
                                                                                        <td>'.$ya['AVG_ZP'].'</td>
                                                                                        <td>'.$ya['AGE'].'</td>
                                                                                        <td>'.$ya['VINA'].'</td>
                                                                                     </tr>';    
                                                                                    } 
                                                                                    ?>
                                                                                    </tbody>
                                                                                </table>  </div>  
                                                        </div>
                                                        <div id="nesch<?php echo $v['CNCT_ID']; $id = $v['CNCT_ID']; ?>" class="tab-pane<?php if(count($v['REINSURANCE'] and $v['PRIL2'] and $v['TRANSH'] and $v['ACT_N1']) == 0) {echo 'active';}?>">
                                                                <?php echo '<div class="panel-body">
                                                                                <table class="table table-bordered table-hover dataTables-example" >
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Категория</th>
                                                                                        <th>Год</th>
                                                                                        <th>Численность застрахованных</th>
                                                                                        <th>УПТ со сроком</th>
                                                                                        <th>УПТ бессрочно</th>
                                                                                        <th>Смертность</th>
                                                                                        <th>Численность пост</th>
                                                                                        <th>Сумма премий</th>
                                                                                        <th>Сумма выплат</th>
                                                                                        <th>Коэф. надбавки</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                                     
                                                                                        $act = $v['BAD_SLUCH_LIST'];
                                                                                        
                                                                                        foreach($act as $u=>$y)
                                                                                        {
                                                                                        echo '<tr class="gradeX">
                                                                                        <td>'.$y['NAME'].'</td>
                                                                                        <td>'.$y['GOD'].'</td>
                                                                                        <td>'.$y['CNT_ALL'].'</td>
                                                                                        <td>'.$y['UPT_SROK'].'</td>
                                                                                        <td>'.$y['UPT_BES_SROK'].'</td>
                                                                                        <td>'.$y['DEATH'].'</td>
                                                                                        <td>'.$y['CNT_POSTR'].'</td>
                                                                                        <td>'.$y['SUM_P'].'</td>
                                                                                        <td>'.$y['SUM_V'].'</td>
                                                                                        <td>'.$y['KOEF_NADB'].'</td>
                                                                                     </tr>';    
                                                                                    }                                                                                
                                                                                    echo ''?>
                                                                                    </tbody>
                                                                                </table></div>    
                                                        </div>
                                                        <div id="dopSogl<?php echo $id; ?>" class="tab-pane <?php if(count($v['REINSURANCE'] and $v['PRIL2'] and $v['TRANSH'] and $v['ACT_N1'] and $v['BAD_SLUCH_LIST']) == 0) {echo 'active';}?>">
                                                        <?php           
                                                        
                                                                        echo '<div class="panel-body"><div class="col-lg-4">';
                                                                              echo $forms->formGroup2(12, 'Кол-во дней действия основного договора', $v['KOL_D_YEAR']);
                                                                              echo $forms->formGroup2(12, 'Кол-во прошедших до изменения дней', $v['KOL_PROSH_D']);
                                                                              echo $forms->formGroup2(12, 'Оставшийся срок действия договора', $v['KOL_OST_D']); 
                                                                              echo $forms->formGroup2(12, 'Заработанная страховая премия по доп. соглашению', $v['ZARAB_P']);
                                                                              echo $forms->formGroup2(12, 'Общая заработанная страх. премия', $v['ZARAB_P_ALL']);
                                                                              echo $forms->formGroup2(12, 'Не заработанная премия', $v['NEZARAB_P']); 
                                                                        echo '</div>';
                                                                        echo '<div class="col-lg-8">';
                                                                        echo '<table class="table table-bordered table-hover dataTables-example" >
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Наименование</th>
                                                                                        <th>Численность уволенных</th>
                                                                                        <th>Численность принятых</th>
                                                                                        <th>Численность изм. оклад</th>
                                                                                        <th>Кол-во изм. категорию</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                                     
                                                                                        $act = $v['BAD_SLUCH_LIST'];                                                                                        
                                                                                        foreach($act as $u=>$y){
                                                                                        echo '<tr class="gradeX">
                                                                                        <td>'.$y['NAME'].'</td>
                                                                                        <td>'.$y['GOD'].'</td>
                                                                                        <td>'.$y['CNT_ALL'].'</td>
                                                                                        <td>'.$y['UPT_SROK'].'</td>
                                                                                        <td>'.$y['UPT_BES_SROK'].'</td>
                                                                                     </tr>';    
                                                                                    }                                                                                
                                                                                    echo ''?>
                                                                                    </tbody>
                                                                                </table>             
                                                                         </div></div>
                                                                </div>
                                                                <div id="zhurn<?php echo $id; ?>" class="tab-pane <?php if(count($v['REINSURANCE'] && $v['PRIL2'] && $v['TRANSH'] && $v['ACT_N1'] && $v['BAD_SLUCH_LIST'] && $v['KOL_D_YEAR']) == 0) {echo 'active';}?>">
                                                                <?php echo '<div class="panel-body">
                                                                                <table class="table table-bordered table-hover dataTables-example" >
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>ФИО</th>
                                                                                        <th>Номер заключения</th>
                                                                                        <th>Дата заключения</th>
                                                                                        <th>Номер акта Н1</th>
                                                                                        <th>Дата акта Н1</th>
                                                                                        <th>Справка МСЭ</th>
                                                                                        <th>Дата справки МСЭ</th>
                                                                                        <th>СУПТ</th>
                                                                                        <th>Сумма выплат</th>
                                                                                        <th>Диагноз</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                                     
                                                                                        $actn = $x['BAD_SLUCH_LIST'];
                                                                                        
                                                                                        foreach
                                                                                        ($actn as $x=>$z)
                                                                                        {
                                                                                        echo '<tr class="gradeX">
                                                                                        <td>'.$z['NAME'].'</td>
                                                                                        <td>'.$y['GOD'].'</td>
                                                                                        <td>'.$y['CNT_ALL'].'</td>
                                                                                        <td>'.$y['UPT_SROK'].'</td>
                                                                                        <td>'.$y['UPT_BES_SROK]'].'</td>
                                                                                        <td>'.$y['DEATH'].'</td>
                                                                                        <td>'.$y['CNT_POSTR'].'</td>
                                                                                        <td>'.$y['SUM_V'].'</td>
                                                                                        <td>'.$y['KOEF_NADB'].'</td>
                                                                                        <td>'.$y['AVG_ZP'].'</td>
                                                                                     </tr>';    
                                                                                    }                                                                                
                                                                                    ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>    
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-12" style="text-align: center; margin-top: 15px;">                                                    
                                                        <a class="btn btn-info set_state" state="<?php echo $v['STATE']; ?>" id="1" data="<?php if($v['ISFILE'] == 'Договор'){ echo 'D';}else{echo 'M';}?>" data-mod="<?php echo $v['CNCT_ID']; ?>">Утвердить</a>
                                                        <a class="btn btn-danger set_state" id="2" data="<?php if($v['ISFILE'] == 'Договор'){ echo 'D';}else{echo 'M';}?>" data-mod="<?php echo $v['CNCT_ID']; ?>">Отклонить</a>                                                        
                                                    </div>
                                                </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <!--innner table finish-->                                                                                    
                                </div>                                                                
                            </div>
                            
                            
                            
<div class="modal inmodal" id="move_arhive_contracts_<?php echo $v['CNCT_ID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <form method="post">
            <div class="modal-header">                
                <h4 class="modal-title">Причина отправки в архив</h4>                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <textarea name="prichina_arhive" class="form-control"></textarea>
                        <input type="hidden" name="cnct_id_arhive" value="<?php echo  $v['CNCT_ID']; ?>"/>
                        <input type="hidden" name="isfile_arhive" value="<?php echo  $v['ISFILE']; ?>"/>
                    </div>
                </div>
            </div>            
            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="new_reason_dop_<?php echo $v['CNCT_ID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">            
            <div class="modal-header">                
                <h4 class="modal-title">Регистрация дополнительного соглашения</h4>   
                <small class="font-bold">Выберите причину</small>             
            </div>
            <div class="modal-body">
                <?php 
                    $id_head = $v['ID_HEAD'];
                    if($v['ID_HEAD'] == "0"){
                        $id_head = $v['CNCT_ID'];
                    }
                ?>
                <a href="reason_dop?id_head=<?php echo $id_head; ?>&&reason_dop=41" class="btn btn-primary btn-block btn-outline">Стандартное дополнительное соглашение</a>
                <a href="reason_dop?id_head=<?php echo $id_head; ?>&&reason_dop=42" class="btn btn-primary btn-block btn-outline">Расторжение договора ОСНС без возврата части страховой премии</a>
                <a href="reason_dop?id_head=<?php echo $id_head; ?>&&reason_dop=43" class="btn btn-primary btn-block btn-outline">Расторжение договора ОСНС с возвратом части страховой премии</a>                                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="move" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <form method="post">
            <div class="modal-header">                
                <h4 class="modal-title">Причина отправки в архив</h4>                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <textarea name="prichina_arhive" class="form-control"></textarea>
                        <input type="hidden" name="cnct_id_arhive" value="<?php echo  $v['CNCT_ID']; ?>"/>
                        <input type="hidden" name="isfile_arhive" value="<?php echo  $v['ISFILE']; ?>"/>
                    </div>
                </div>
            </div>            
            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
            </form>
        </div>
    </div>
</div>
                            
                            
                            <?php } ?>
                           
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

$('.set_state').click(function(){
    var icn = $(this).attr('data-mod');
    var typ = $(this).attr('data');    
    var btncl = $(this).attr('id');
    var state = $(this).attr('state');        
    
    if(btncl == '1'){
        if(state == 0||state == 7){
        swal({
            title: "Предупреждение!",
            text: "Пожалуйста проверьте правильность введенных Вами данных, т.к. дальнейшее изменение будет невозможным!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да подтверждаю!",
            closeOnConfirm: false
        }, function () {
            setstate(icn, typ, btncl);
        });    
    }else{             
        setstate(icn, typ, btncl);
    }
    }else{
        setstate(icn, typ, btncl);
    }
});

function setstate(icn, typ, btncl)
{
    var url = window.location.href;
    $.post(url, {
            "set_state":"",
            "cnct_id": icn,
            "type": typ,
            "btncl": btncl
        }, function(data){
            if(data == true){
                location.reload();
            }else{
                var s = data.replace('&quot;', '');
                alert(s);
            }
        });
}

$('.schet_opl').click(function(event){      
    event.stopPropagation();
    event.preventDefault(); 
    var obj = $(this);    
    var cnct = obj.attr('data');    
    $.post(window.location.href, {"prov_shet": cnct}, function(data){
        console.log(data);
        var j = JSON.parse(data);
        console.log(data);
        var alrt = j.alert; 
        if(alrt.trim() == ''){
            $('#cnct_'+cnct).attr('href', j.href);
            $('#cnct_'+cnct).click();
        }else{
            alert(j.alert);
        }       
    });
});
</script>