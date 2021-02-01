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
                        <div class="indented_text">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php 
                                $i = 0;
                                foreach($dan as $k=>$v){
                                    $act = '';
                                    if($v['CNCT_ID'] == $cnct_id){$act = 'active';}                                    
                                    echo '<li role="presentation" class="'.$act.'"><a data-toggle="tab" href="#'.$v['CNCT_ID'].'"> '.$v['ISFILE'].' № '.$v['CONTRACT_NUM'].'</a></li>';
                                    $i++;
                                }
                            ?>                        
                        </ul>
                        </div>
                        <div class="tab-content">
                            
                            <?php 
                                $i = 0; 
                                foreach($dan as $k=>$v){
                                    $act = '';
                                    if($v['CNCT_ID'] == $cnct_id){$act = 'active';}                                    
                            ?>
                            <div id="<?php echo $v['CNCT_ID'] ?>" class="tab-pane <?php echo $act; ?>">
                                <div class="panel-body form-horizontal">                                                                       
                                    <div class="row">                                                                                    
                                         
                                            <?php
                                                echo FORMS::formGroup2(3, 'Номер договора', $v['CONTRACT_NUM']); 
                                                //echo FORMS::FormGroup(6, 'Номер договора', 6, $v['CONTRACT_NUM']);
                                                
                                                echo FORMS::formGroup2(3, 'Номер заявления', $v['ZV_NUM']); 
                                                //echo FORMS::FormGroup(6, 'Номер заявления', 6, $v['ZV_NUM']);
                                                
                                                echo '<div class="col-lg-3" title="Наличие индексации страховых выплат">
                                                                     <strong></strong><br>
                                                                        <div class="i-checks"> <input type="checkbox"'?> <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">Наличие индексации страховых выплат</div></label></div>
                                                                     </div>';
                                                echo '<div class="col-lg-3" title="С наследованием">
                                                                     <strong></strong><br>
                                                                        <div class="i-checks"> <input type="checkbox"'?> <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">С наследованием</div></label></div>
                                                                     </div>';
                                                ?>
                                    </div>
                                    <div class="row">
                                                <?php
                                                
                                                echo FORMS::formGroup2(3, 'Дата договора', $v['CONTRACT_DATE']);
                                                //echo FORMS::FormGroup(6, 'Дата договора', 6, $v['CONTRACT_DATE']);
                                                
                                                echo FORMS::formGroup2(3, 'Дата заявление', $v['ZV_DATE']);
                                                //echo FORMS::FormGroup(6, 'Дата заявление', 6, $v['ZV_DATE']);
                                               
                                                echo '<div class="col-lg-3" title="Наличие индексации страховых выплат">
                                                                     <strong></strong><br>
                                                                        <div class="i-checks"> <input type="checkbox"'?> <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">Согласие на обработку данных</div></label></div>
                                                                     </div>';
                                                
                                                echo '<div class="col-lg-3" title="Наличие индексации страховых выплат">
                                                                     <strong></strong><br>
                                                                        <div class="i-checks"> <input type="checkbox"'?> <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">Отсутствие страх.дела</div></label></div>
                                                                     </div>';
                                                
                                            ?>
                                                                                        
                                    </div>
                                        <!--row 1 finish-->
                                         
                                        <!--row 2 start-->
                                        <div class="row">
                                        <div class="hr-line-dashed"></div>
                                        
                                                
                                                        <?php 
                                                                echo FORMS::formGroup2(6, 'Аннуитент', $v['ANNUIT']);
                                                                //echo FORMS::FormGroup(3, 'Аннуитент', 9, $v['ANNUIT']);
                                                                echo FORMS::formGroup2(3, 'Основание работы агента', '');
//                                                                echo FORMS::FormGroup(3, 'Основание работы агента', 9, '');
                                                                echo FORMS::formGroup2(3, 'Инспектор', $v['EMP_NAME']);
//                                                                echo FORMS::FormGroup(3, 'Инспектор', 9, $v['EMP_NAME']);
                                                                echo FORMS::formGroup2(6, 'Получатель', $v['POLUCH_NAME']);
//                                                                echo FORMS::FormGroup(3, 'Получатель', 9, $v['POLUCH_NAME']);
                                                                echo FORMS::formGroup2(6, 'Агент', '');
//                                                                echo FORMS::FormGroup(3, 'Работник', 9, '');
                                                                echo FORMS::formGroup2(6, 'Отделение', $v['BRANCH_NAME']);
//                                                                echo FORMS::FormGroup(3, 'Отделение', 9, $v['BRANCH_NAME']);?>  
                                                                
                                                          
                                                                <div class="col-lg-3" title="Наличие индексации страховых выплат">
                                                                     <strong></strong><br>
                                                                        <div class="i-checks"> <input type="checkbox" <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> disabled="" <i></i><label><div id="chekBoxPadding">Опекун</div></label></div>
                                                                     </div>
                                    </div>
                                    <!--row 2 finish-->
                                    
                                    <!--row 3 start-->
                                    <div class="row">
                                       
                                        <div class="hr-line-dashed"></div>
                                                        <?php 
                                                                echo '<div class="col-lg-12">
                                                                             <strong>Страхователь</strong><br>
                                                                             <div class="formForData">'.
                                                                                $v['CONTAG_NAME'].'
                                                                            </div>
                                                                        </div>
                                                                            </div><div class="row">
                                                                        <div class="hr-line-dashed"></div>';
                                                                echo FORMS::formGroup2(3, 'Возраст аннуителя', $v['AGE']);
                                                                echo FORMS::formGroup2(3, 'Периодичность', $v['PERIODICH']);
                                                                echo FORMS::formGroup2(3, 'Средний месячный размер дохода', $v['SUM_ALL_AVG']);
                                                                echo FORMS::formGroup2(3, 'Дата договора с ОСНС', $v['DATE_OSNS'])
                                                                .'</div><div class="row">
                                                                    <div class="hr-line-dashed"></div>';
                                                                echo FORMS::formGroup2(12, 'Первичный страховщик', $v['FIRST_INSUR'])
                                                                .'</div><div class="row">
                                                                    <div class="hr-line-dashed"></div>';
                                                                
                                                                echo FORMS::formGroup2(3, 'Начало выплат по 1-й справке в пред. КСЖ', $v['DATE_KSZH']);
                                                                echo FORMS::formGroup2(3, 'Дата начала выплат', $v['DATE_BEGIN_DOGOV']);
                                                                echo FORMS::formGroup2(3, 'Дата окончания', $v['DATE_END']);
                                                                echo FORMS::formGroup2(3, 'Дата расчета', $v['DATE_CALC'])
                                                                .'</div><div class="row">
                                                                    <div class="hr-line-dashed"></div>';
                                                                echo FORMS::formGroup2(3, 'Оплатить до', $v['PAY_SUM_V']); 
                                                                echo FORMS::formGroup2(3, 'Страховая выплата', $v['PAY_SUM_V']);
                                                                echo FORMS::formGroup2(3, 'Страховая премия', $v['SUM_P_F']);
                                                                echo FORMS::formGroup2(3, 'Выплата ГФСС', $v['SUM_P_F'])
                                                                .'</div><div class="row">
                                                                    <div class="hr-line-dashed"></div>';
                                                                echo FORMS::formGroup2(3, 'АФ', $v['AF']);
                                                                //echo FORMS::formGroup2(3, 'АФ2', $v['AF2']);
                                                                echo FORMS::formGroup2(3, 'От премии', $v['AF']);
                                                                echo FORMS::formGroup2(3, 'От выплаты', $v['AF2']);
                                                        ?>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="hr-line-dashed"></div>
                                                       <?php    
                                                                echo FORMS::formGroup2(12, 'Расчитан по калькулятору', $v['CALC_NAME']);
                                                                echo '</div><div class="row">
                                                                    <div class="hr-line-dashed"></div>';
                                                                echo FORMS::formGroup2(6, 'Статус', $v['STATE_NAME']);
                                                                
                                                                echo FORMS::formGroup2(6, 'Уровень принятия решения', $v['LEVEL_NAME']);echo '</div><div class="row">
                                                                    ';
                                                                ?>     
                                    <!--row 3 finish-->
                                        <div class="hr-line-dashed"></div>
                                                    
                                                <?php echo FORMS::formGroup2(12, 'Примечание', $v['NOTE']);?>
                                          
                                       
                                                                       
                                    <!--innner table start-->
                                            <div class="col-lg-12">
                                                <div class="hr-line-dashed"></div>
                                                <div class="tabs-container">
                                                <div class="tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <?php if(isset($v['IZHD_STATE'])){
                                                            echo '<li class="active"><a data-toggle="tab" href="#prich'.$v['CNCT_ID'].'">Причина</a></li>'; 
                                                        }?>                                                        
                                                        <li><a data-toggle="tab" href="#bank<?php echo $v['CNCT_ID']; ?>">Банковские данные, наличие льгот</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php 
                                                            
                                                            if(isset($v['IZHD_STATE'])){
                                                                
                                                            echo '<div id="prich'.$v['CNCT_ID'].'" class="tab-pane active">
                                                            
                                                            <div class="form-horizontal">
                                                                <div class="panel-body">';
                                                                    echo FORMS::formGroup2(6, 'Причина', $v['REASON_NAME']);
                                                                    echo FORMS::formGroup2(3, 'Степень утраты проф. трудоспособности', $v['UTR_TRUD']);
                                                                    echo FORMS::formGroup2(3, 'Возраст млад. ребенка', $v['CHILD_STAGE']);
                                                                    
                                                                    echo FORMS::formGroup2(6, 'Статус иждевенца', $v['IZHD_STATE']);
                                                                    echo FORMS::formGroup2(3, 'Вина работодателя', $v['VINA']);
                                                                    echo FORMS::formGroup2(3, 'Дата начала учебы', $v['DATE_BEG_STUDY']);
                                                                    
                                                                    echo FORMS::formGroupForDate(6, 'Дата утраты труд-ти', $v['DATE_BEGIN'], $v['DATE_END']);
                                                                    echo FORMS::formGroup2(3, 'Группа инвалидности', $v['INV_GROUP']);
                                                                    echo FORMS::formGroup2(3, 'Дата окончания учебы', $v['DATE_END_STUDY']);
                                                                    
                                                                    echo FORMS::formGroup2(12, 'Диагноз', $v['DIAGNOS'])
                                                                .'</div> 
                                                            </div>
                                                        </div>'
                                                        ;}?>
                                                          
                                                        <div id="bank<?php echo $v['CNCT_ID']; ?>" class="tab-pane <?php ?>">
                                                            <?php echo'<div class="panel-body">
                                                                <div class="col-lg-4">';
                                                                        
                                                                        echo FORMS::formGroup2(12, 'Банк', $v['BANK_NAME']);
                                                                        echo FORMS::formGroup2(12, 'Тип счета', $v['ACC_TYPE']);
                                                                        echo FORMS::formGroup2(12, 'Счет', $v['P_ACCOUNT'])
                                                                        
                                                                        //echo FORMS::FormGroup(3, 'Банк', 9, $v['BANK_NAME']);
                                                                        //echo FORMS::FormGroup(3, 'Тип счета', 9, $v['ACC_TYPE']);
                                                                        //echo FORMS::FormGroup(3, 'Счет', 9, $v['P_ACCOUNT'])
                                                                        .'
                                                                     
                                                                </div>
                                                                <div class="col-lg-4">';
                                                                            echo FORMS::formGroupForDate(12, 'Дата начала льгот', $v['LGOT_BEGIN_DATE'], $v['DATE_END_LGOT']);
                                                                            echo FORMS::formGroup2(12, 'Наличие льгот по налогооблажению', $v['LGOT_NAME'])
                                                                            
                                                                            //echo FORMS::FormGroup(3, 'Наличие льгот по налогооблажению', 9, $v['LGOT_NAME']);
                                                                            //echo FORMS::FormGroup(3, 'ИИК', 9, '')
                                                                            
                                                                       .'
                                                                    
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    
                                                                        ';
                                                                            echo FORMS::formGroup2(12, 'Размер пособия на погребение', $v['POGREB_PAY']);
                                                                            echo FORMS::formGroup2(12, 'Номер справки', $v['LGOT_NUMBER'])
                                                                            
                                                                            //echo FORMS::FormGroup(3, 'Размер пособия на погребение', 9, '');
                                                                            //echo FORMS::FormGroup(3, 'Номер справки', 9, '')
                                                                        .'
                                                                    
                                                                </div>
                                                                </div></div>'?>
                                                            </div>
                                                        </div>
                                            </div></div>  
                                        </div>
                                        <!--innner table finish-->
                                         
                                </div>
                                
                                        
                                
                            </div>
                            <?php $i++; } ?>
                           
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div>
        
            
            </div>
            </div>
            </div>
            </div>
            
            </div>
            </div>