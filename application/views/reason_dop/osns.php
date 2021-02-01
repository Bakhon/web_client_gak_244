<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">            
        <form method="post" id="main_form">            
            <div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <div class="row">
                        <?php 
                            echo FORMS::InputText(12, 'Страхователь', '', '', '', 'form-control', htmlspecialchars($dan['STRAHOVATEL']), true);
                        ?>                                           
                    </div>                    
                    <div class="hr-line-dashed"></div>
                    <div class="row">  
                    <?php                            
                        echo FORMS::InputText(3, 'Номер договора', 'CONTRACT_NUM', '', '', 'form-control', $dan['CONTRACT_NUM'], true);
                        echo FORMS::InputText(3, 'Номер Заявления', 'ZV_NUM', 'iZV_NUM', '', 'form-control', $dan['ZV_NUM'], true);
                    ?>
                        <div class="col-lg-4">                            
                            <label class="font-noraml">Отделение (Определяется автоматически)</label>                            
                            <select name="BRANCH_ID" id="branch" class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php        
                                    echo '<option value="'.$dan['BRANCH_ID'].'" selected>'.$dan['BRANCH_ID'].' - '.$dan['REGION'].'</option>';                                                                                                             
                                    foreach($dan['list_branch'] as $k=>$v){                                        
                                        echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>
                            </select>                               
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">&nbsp;</label>
                            <div class="i-checks">
                                <label class="form-control" style="border: solid 0px;"> 
                                    <?php
                                    $S = ''; 
                                    $D = 'checked';
                                    
                                    IF($D !== 1){
                                        $D = '';
                                    }
                                    ?>
                                    <input checked="" name="typ_dog" type="checkbox" value="" <?php ECHO $D; ?>> <i></i>  Типовой
                                </label>
                            </div>
                        </div>
                        <?php                                                  
                            echo FORMS::InputDate(3, 'Дата договора', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', $dan['CONTRACT_DATE'], false, array(),  'required');                        
                            echo FORMS::InputDate(3, 'Дата заявления', 'iZV_DATE', 'IZV_DATE', 'form-control', $dan['ZV_DATE'], false, array("data"=>$dan['PAYM_CODE']),  'required');
                        ?>
                        <div class="col-lg-5">
                            <label class="font-noraml">Ответственное лицо (можно добавить, нажав (+))</label>
                            <select name="otv_lico" class="select2_demo_1 form-control" id="person_select">
                                <option value="">Не выбрано</option>
                                <?php                                   
                                   foreach ($dan['listPersonKos'] as $k => $v){
                                        echo '<option value="'.$v['ID'].'">'.$v['LASTNAME'].' '.$v['FIRSTNAME'].' '.$v['MIDDLENAME'].'</option>';
                                   }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label class="font-noraml">&nbsp;</label>
                                <div class="tooltip-demo">
                                    <a data-toggle="modal" data-target="#new_person" class="btn btn-default form-control"><i class="fa fa-plus"></i></a>
                                </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-5">                            
                            <label class="font-noraml">Агент</label>                                                     
                            <select name="iSICID_AGENT" id="ISICID_AGENT" class="select2_demo_1 form-control chosen-select">
                            <option value="0">Не выбрано</option>
                            <?php                                
                                foreach($dan['listAgents'] as $k => $v){
                                    $s = '';                                                                        
                                    if($dan['SICID_AGENT'] == $v['KOD']){
                                        $s = 'selected';
                                    }
                                    echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
                                }                                        
                            ?>
                            </select>                               
                        </div>
                        <?php                             
                            echo FORMS::InputText(5, 'Основание', 'base', 'base', '', 'form-control osnov_agent', $dan['agent_dan']['OSNOVANIE'], true);                                                        
                            echo FORMS::InputText(2, 'Комиссия посредника', 'mediator_comiss', 'mediator_comiss', '', 'form-control persent_agent', $dan['agent_dan']['PERCENT_OSNS'], true);
                        ?>                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row"> 
                        <?php
                            echo FORMS::InputDate(3, 'Начало периода страхования', 'idate_begin', '', 'form-control', $dan['DATE_BEGIN'], false, array(),  'required');                                                        
                            echo FORMS::InputDate(3, 'Конец периода страхования', 'idate_end', '', 'form-control', $dan['DATE_END'], false, array(),  'required');
                        ?>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">                       
                        <h4>По классу проф. риска (постановление правительства РК №652)</h4>
                        <div class="ibox-tools"></div> 
                        <?php                             
                            echo FORMS::InputText(9, 'Основной вид деятельности', '', 'vd', 'Это поле заполнится автоматически...', 'form-control', $dan['osn_vid_deytel']['NAME'], true);                                                                                    
                            echo FORMS::InputText(2, 'Класс проф.риска', 'irisk_id', 'risk', '', 'form-control', $dan['osn_vid_deytel']['RISK_ID'], true);                                                        
                            echo FORMS::InputText(1, 'ОКЭД', 'IOKED', 'oked', '', 'form-control', $dan['osn_vid_deytel']['OKED'], true);
                        ?>
                                                
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <h4>По заявлению страхователя</h4>
                        <div class="ibox-tools"></div>
                        
                        <div class="col-lg-9">
                            <label id="SelectId" class="font-noraml">Основной вид деятельности (<strong>Шаг 5:</strong> Для изменения вида деятельности, выберите нужный вариант из списка)</label>
                            <select name="ioked_id" class="select2_demo_1 form-control chosen-select osnVidDeyatelnosty">
                            <?php                                
                                echo '<option value="0">Не выбрано</option>';
                                foreach($dan['vid_deyat'] as $k => $v){      
                                    $s = '';                                    
                                    if($dan['OKED_ID'] == $v['ID']){
                                        $s = 'selected';
                                    }                                    
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['OKED'].' - '.$v['VED_NAME'].'</option>';                                    
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="font-noraml">Степень аффилированности (<strong>Шаг 6</strong>)</label>
                            <?php 
                                if(isset($dan['osns_calc']['AFFILIR'])){
                                    $D = $dan['osns_calc']['AFFILIR'];
                                }ELSE{
                                    $D = '';
                                }
                            ?>
                            <select name="AFFILIR" class="select2_demo_1 form-control">
                                <option></option>
                                <option value="A" <?php if($D == 'A'){echo 'selected';} ?>>A</option>
                                <option value="B" <?php if($D == 'B'){echo 'selected';} ?>>B</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- АКТ Н1 -->
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Были ли несчастные случаи на предприятии?</label>
                                <div class="col-sm-4">
                                    <div class="switch noUiSlider">
                                        <div class="onoffswitch">
                                            <?php 
                                                $D = '';
                                                $aktn1_view = 'hidden';
                                                if(count($dan['osns_ns']) > 0){
                                                    $aktn1_view = '';
                                                    $D = 'checked';
                                                }                                                
                                            ?>
                                            <input type="checkbox" class="onoffswitch-checkbox" <?php echo $D; ?> id="example1" name="badsluch" onclick="showTitle()">
                                            <label class="onoffswitch-label" for="example1">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="hr-line-dashed"></div>
                    <div class="row" id="strahTitle" <?php echo $aktn1_view; ?>>
                        <h4>Страховые случаи за последние 5 лет (от 5% до 29% утраты профессиональной трудоспособности)</h4>
                        <a class="btn btn-primary " id="addRow" data-toggle="modal" data-target="#myModal5">Добавить</a>
                        <table class="table table-bordered inputs" id="aktn1" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Должность</th>
                                <th>ФИО</th>
                                <th>Номер акта N1</th>
                                <th>Дата акта N1</th>
                                <th>Причина</th>
                                <th>СМЗП</th>
                                <th>Возраст</th>
                                <th>Степень вины</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($dan['akt1'])){                                    
                                    foreach($dan['akt1'] as $k=>$v){
                                        echo CONTRACTS::Tables_AktN1($v['DOLZHN'], $v['FIO'], $v['ACT_NOM'], $v['ACT_DATE'], $v['REASON'], $v['AVG_ZP'], $v['AGE'], $v['VINA'], $v['ID']);
                                    }
                                }                                
                            ?>
                            <!--here rows-->
                        </tbody>
                        </table>
                    </div>    
                    
                <!-- Приложение 2 -->            
                <div class="hr-line-dashed"></div>    
                <div class="row">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Приложение 2</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Расчет</a></li>
                            <li class="" id="statVkladka" style="
                            <?php                             
                                if(count($dan['bad_sluch']) > 0 ){
                                    echo 'display:block;';
                                }else echo 'display:none;';
                            ?>"><a data-toggle="tab" href="#tab-3">Статистика несчастных случаев на производстве</a></li>
                            <li class="" id="transh" style="
                            <?php 
                                if(substr($dan['PERIODICH'], 0, 1) == 1){ 
                                    echo 'display: none;';
                                }else{
                                    echo 'display: block;';
                                } ?>"><a data-toggle="tab" href="#tabtransh">Транши</a></li>
                            <li class="dopki" style="<?php if($dan['KOL_PROSH_D'] == '0'){echo 'display:none;';} ?>"><a data-toggle="tab" href="#dopki">Данные по доп соглашению</a></li>
                        </ul>
                        
                        <!-- Приложение 2 -->
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body" style="height: 450px;overflow-x: auto;" id="pril2">
                                    <table class="table table-bordered" id="pril2_table" >
                                        <thead>
                                        <tr>
                                            <th>
                                                <a class="btn btn-success btn-sm" id="add_pril2" data-toggle="modal" data-target="#modal_pril2"><i class="fa fa-plus"></i> Добавить <br />сотрудника</a>
                                            </th>
                                            <th>Наименование</th>
                                            <th>Наименование должности</th>
                                            <th>Численность</th>
                                            <th>Класс проф. риска</th>
                                            <th>Оклад (тг)</th>
                                            <th>СМЗП(тг)</th>
                                            <th>ГФОТ(тг)</th>
                                            <th>Страх сумма</th>
                                        </tr>
                                        </thead>
                                        <tbody> 
                                            <?php 
                                                if(isset($dan['osns_pril2'])){
                                                    foreach($dan['osns_pril2'] as $k=>$v){
                                                        echo OSNS::Tables_Pril2($v['ID_FILIAL'], htmlspecialchars($v['NAME']), htmlspecialchars($v['D_NAME']), $v['CNT'], $v['RISK'], $v['OKLAD'], $v['SMZP'], $v['GFOT'], $v['STR_SUM'], $v['OKED'], $v['ID']);
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        </table>                                    
                                </div>
                            </div>
                        
                        <!-- Расчетная часть -->
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body" style="height: 450px;" id="calc">
                                    <div id="other_message"></div>
                                    <div class="col-lg-2">                                        
                                        <label class="font-noraml">Страховая сумма</label>                                        
                                        <input type="text" class="form-control" name="vPAY_SUM_V" value="<?php echo $dan['PAY_SUM_V']; ?>" id="pay_sum_v">
                                                                                
                                        <label class="font-noraml">Страховая премия</label>
                                        <input type="text" class="form-control" name="vPAY_SUM_P" value="<?php echo $dan['PAY_SUM_P']; ?>" id="pay_sum_p">
                                                                                
                                        <label class="font-noraml">ПП. Коэффициент</label>
                                        <input type="text" class="form-control" name="koef_pp" value="<?php echo $dan['osns_calc']['KOEF_PP']; ?>" id="koef_pp">
                                                                                                                        
                                        <label class="font-noraml">СГЧП</label>
                                        <input type="text" class="form-control" name="sgchp" value="<?php echo $dan['osns_calc']['SGCHP']; ?>" id="sgchp">
                                                                                
                                        <label class="font-noraml">Коэффициент ув.</label>
                                        <input type="text" class="form-control" name="ikoef_uv" value="<?php echo $dan['osns_calc']['KOEF_UV']; ?>" id="koef_uv">
                                                                                                       
                                        <label class="font-noraml">Порядок уплаты</label>
                                        <select class="select2_demo_1 form-control" name="iPERIODICH" id="iPERIODICH">
                                            <option value="1 Единовременно" <?php if(substr($dan['PERIODICH'], 0, 1) == 1){echo 'selected';} ?>>1 Единовременно</option>
                                            <option value="2 В рассрочку" <?php if(substr($dan['PERIODICH'], 0, 1) == 2){echo 'selected';} ?>>2 В рассрочку</option>
                                        </select>
                                    
                                        <label class="font-noraml"></label>
                                        <a class="btn btn-primary btn-block" id="calculat"><i class="fa fa-calculator"></i> Расчитать</a>
                                    </div>
                                    
                                    <div class="col-lg-10" style="height: 450px;overflow-x: auto;">
                                        <table class="table table-bordered table-hover " id="table_calc_osns" >
                                    <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Численность работников</th>
                                        <th>ГФОТ</th>
                                        <th>Страховая сумма</th>
                                        <th>Страховой тариф</th>
                                        <th>Страховая премия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(isset($dan['osns_calc_new'])){
                                            foreach($dan['osns_calc_new'] as $k=>$v){
                                                echo OSNS::Table_OSNS_CALC_NEW(htmlspecialchars($v['NAME']), $v['ID_FILIAL'], $v['CNT'], $v['GFOT'], $v['STR_SUM'], $v['TARIF'], $v['PAY_SUM']);                                                
                                            }
                                        }
                                    ?>                                 
                                    </tbody>
                                    </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <!-- Статистика несчастных случаев -->
                            <div class="tab-pane" id="tab-3">
                                <div class="panel-body" style="height: 450px;overflow-x: auto;">                                    
                                    <table class="table table-bordered" id="ns_table" >
                                    <thead>
                                    <tr>
                                        <th>
                                            <a class="btn btn-success btn-sm" id="add_ns" data-toggle="modal" data-target="#modal_ns"><i class="fa fa-plus"></i></a>
                                        </th>
                                        <th>Наименование</th>
                                        <th>Год</th>
                                        <th>Численность застрахованных</th>
                                        <th>УПТ со сроком</th>
                                        <th>УПТ без срочно</th>
                                        <th>Смертность</th>
                                        <th>Численность пострадавших</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(isset($dan['bad_sluch'])){
                                            foreach($dan['bad_sluch'] as $k=>$v){
                                                echo OSNS::Table_bad_sluch($v['ID_FILIAL'], htmlspecialchars($v['NAME']), $v['GOD'], $v['CNT_ALL'], $v['UPT_SROK'], $v['UPT_BES_SROK'], $v['DEATH'], $v['CNT_POSTR'], $v['ID']);                                                                                                
                                            }
                                        }
                                    ?>
                                    </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <!-- Транши -->
                            <div class="tab-pane" id="tabtransh">
                                <div class="panel-body" style="height: 450px;overflow-x: auto;">                                    
                                    <table class="table table-bordered" id="table_transh" >
                                    <thead>
                                    <tr>
                                        <th>
                                            <a class="btn btn-success btn-sm" id="add_transh" data-toggle="modal" data-target="#modal_transh"><i class="fa fa-plus"></i></a>
                                        </th>                                        
                                        <th>Сумма план</th>
                                        <th>Дата план</th>
                                        <th>Дата факт</th>
                                        <th>Сумма факт</th>
                                        <th>Дата взятия в доход</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(isset($dan['transh'])){
                                            foreach($dan['transh'] as $k=>$v){
                                                echo OSNS::TableTransh($v['PAY_SUM'], $v['DATE_PL'], $v['DATE_F'], $v['SUM_FACT'], $v['MHMH_ID'], $v['DATE_DOHOD'], $v['ID']);                                            
                                            }
                                        }
                                    ?>                                                                
                                    </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="dopki">
                                <div class="panel-body" style="height: 450px;overflow-x: auto;">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Кол-во дней действия основного договора:</label>
                                            <input type="text" class="form-control" name="ikol_d_year" value="<?php echo $dan['osns_calc']['KOL_D_YEAR']; ?>"/>  
                                            
                                            <label>Кол-во прошедших до изменения дней</label>
                                            <input type="text" class="form-control" name="ikol_prosh_d" value="<?php echo $dan['osns_calc']['KOL_PROSH_D']; ?>"/>
                                            
                                            <label>Оставшийся срок действия договора</label>
                                            <input type="text" class="form-control" name="ikol_ost_d" value="<?php echo $dan['osns_calc']['KOL_OST_D']; ?>"/>
                                                                                        
                                            <label>Заработанная страховая премия</label>
                                            <input type="text" class="form-control" name="izarab_p" value="<?php echo $dan['osns_calc']['ZARAB_P']; ?>"/>
                                            
                                            <label>Не заработанная премия:</label>
                                            <input type="text" class="form-control" name="inezarab_p" value="<?php echo $dan['osns_calc']['NEZARAB_P']; ?>"/>
                                                                                        
                                            
                                            <label class="vozv_opl label-danger block">Подлежит к оплате или возврату</label>
                                            <input type="text" class="form-control" name="sum_itog" value="<?php echo $dan['SUM_VOZVR']; ?>"/>
                                            
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="col-lg-6">
                                                <label>Общий размер страховой премий с учетом допсоглашении без заработанной премии</label>
                                                <input type="text" class="form-control" name="prem_new1" value="<?php echo $dan['osns_calc']['PREM_NOT_ZP']; ?>"/>
                                            </div>
                                            
                                            <div class="col-lg-6" style="margin-bottom: 15px;">
                                                <label>Общий размер страховой премий с учетом допсоглашении с заработанной премией</label>
                                                <input type="text" class="form-control" name="prem_new2" value="<?php echo $dan['osns_calc']['PREM_S_ZP']; ?>"/>
                                            </div>
                                            <br />
                                            
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><span class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal_dop_dan"><i class="fa fa-plus-square"></i></span></th>
                                                    <th>Наименование</th>
                                                    <th>Кол-во уволенных</th>
                                                    <th>Кол-во принятых</th>
                                                    <th>Кол-во изм. оклад</th>
                                                    <th>Кол-во изм. категорий</th>
                                                </tr>
                                                </thead>
                                                <tbody id="raschet_dop">
                                                
                                                </tbody>
                                            </table>    
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div></div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="form-group">                            
                            <!--<a href="#" class="btn btn-primary pull-right" id="submit">Сохранить</a>-->                              
                            <?php 
                                foreach($dan['others'] as $k=>$v){
                                    echo '<input type="hidden" name="'.$k.'" value="'.$v.'"/>';
                                }
                            ?>
                            <input type="submit" class="btn btn-primary pull-right" name="save_osns" value="Сохранить"/>                              
                        </div>
                    </div>
                </div>                
            </div>
        </div>
                
        </form>
            
            </div>
            </div>

<!-- модальные окна -->

<!-- Акт N1 -->
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление работника</h4>
                <small class="font-bold">Добавление работника имеющего акт N1</small>
            </div>
            <div class="modal-body">
                <form>
                    <label class="font-noraml">Категория должностей</label>
                    <select class="select2_demo_1 form-control specCategor">
                        <option value="1">Aдминистративно управленческий персонал</option>
                        <option value="2">Производственный персонал</option>
                        <option value="3">Вспомогательный персонал</option>
                    </select>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">ФИО</label>
                        <input type="text" placeholder="" class="form-control fio" id="fio">
                    </div>
                    <p id="contenFio"></p>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Номер акта N1</label>
                        <input type="text" placeholder="" class="form-control actNumber" id="actNumber">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Дата оформления акта N1</label>
                        <div class="input-group date">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" value="03/04/2014" />
                        </div>
                    </div>
                    
                    <label class="font-noraml">Причина оформления акта N1</label>
                    <select class="select2_demo_1 form-control oformReason">
                        <option value="1">Проф. заболевание</option>
                        <option value="2">Смерть</option>
                        <option value="3">Трудовое увечье</option>
                    </select>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Средняя месячная заработная плата</label>
                        <input type="text" placeholder="" class="form-control sredZarplata">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Возраст</label>
                        <input type="text" placeholder="" class="form-control vozrast">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Степень вины работодателя</label>
                        <input type="text" placeholder="" class="form-control stepenViny">
                    </div>                                                                                              
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="add" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="modal_pril2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление сотрудника</h4>
                <small class="font-bold">Добавление сотрудника во вкладку Приложение 2</small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">
                    <label class="font-noraml">Наименование (Страхователь или Филиал)</label>
                    <select class="select2_demo_1 form-control pril2_naimen" name="pril2_dolg">                        
                        
                    </select>
                    <div class="form-group">
                        <label class="font-noraml">Должность</label>
                        <input type="text" placeholder="" class="form-control pril2_name">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Численность</label>
                        <input type="number" placeholder="" class="form-control pril2_chisl">
                    </div>                   
                    <div class="form-group">
                        <label class="font-noraml">Класс Проф. Риска</label>
                        <input type="text" placeholder="" class="form-control pril2_risk">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Оклад</label>
                        <div class="input-group m-b">                             
                            <input type="number" placeholder="" class="form-control pril2_oklad">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" id="calc_smzp"><i class="fa fa-calculator"></i> Расчитать</button> 
                            </span>
                        </div>                                                                        
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Средняя месячная заработная плата</label>
                        <input type="number" placeholder="" class="form-control pril2_smzp">
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">ГФОТ</label>
                        <input type="number" placeholder="" class="form-control pril2_gfot">
                    </div>                    
                    
                    <div class="form-group">
                        <label class="font-noraml">Страховая сумма</label>
                        <input type="number" placeholder="" class="form-control pril2_strsum">
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_pril2" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_ns" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление статистики</h4>
                <small class="font-bold">Добавление статистики несчастных случаев на производстве</small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">
                    <label class="font-noraml">Наименование (Страхователь или Филиал)</label>
                    <select class="select2_demo_1 form-control ns_naimen" name="ns_naimen">                        
                        
                    </select>
                    <div class="form-group">
                        <label class="font-noraml">Год</label>
                        <input type="number" placeholder="" class="form-control ns_god">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Численность застрахованных</label>
                        <input type="number" placeholder="" class="form-control ns_chisl">
                    </div>                   
                    <div class="form-group">
                        <label class="font-noraml">УПТ со сроком</label>
                        <input type="text" placeholder="" class="form-control ns_upt_s">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">УПТ без срочно</label>                                                     
                        <input type="number" placeholder="" class="form-control ns_upt_not_s">                                                                    
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Смертность</label>
                        <input type="number" placeholder="" class="form-control ns_death">
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Численность пострадавших</label>
                        <input type="number" placeholder="" class="form-control ns_postr">
                    </div>                                                            
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-ns"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_ns" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="modal_transh" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">                    
                    <div class="form-group">
                        <label class="font-noraml">Планируеммая сумма</label>
                        <input type="number" placeholder="" class="form-control transh_summa">
                    </div>     
                    
                    <div class="form-group">
                        <label class="font-noraml">Планируемая дата</label>                                    
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control transh_data" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-transh"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_transh" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="new_person" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ответственное лицо</h4>
                <small class="font-bold">Добавление ответственного лица</small>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Фамилия</label>
                    <input id="secondname_otvetstvennoe" type="text" placeholder="" class="form-control ns_chisl">
                </div>
                <div class="form-group">
                    <label class="font-noraml">Имя</label>
                    <input id="firstname" type="text" placeholder="" class="form-control ns_chisl">
                </div> 
                <div class="form-group">
                    <label class="font-noraml">Отчество</label>
                    <input id="middlename" type="text" placeholder="" class="form-control ns_chisl">
                </div> 
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-transh"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_new_person" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="modal_dop_dan" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Данные по доп соглашению</h4>
                <small class="font-bold">Внесите разницу</small>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Наименование</label>
                    <select class="form-control" id="dop_naimen" name="">
                        
                    </select>                    
                </div>
                
                <div class="form-group">
                    <label class="font-noraml">Кол-во уволенных</label>
                    <input id="dop_uv" type="number" class="form-control">
                </div>
                 
                <div class="form-group">
                    <label class="font-noraml">Кол-во принятых</label>
                    <input id="dop_pr" type="number" placeholder="" class="form-control">
                </div> 
                
                <div class="form-group">
                    <label class="font-noraml">Кол-во изм. оклад</label>
                    <input id="dop_oklad" type="number" placeholder="" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="font-noraml">Кол-во изм. категорий</label>
                    <input id="dop_kateg" type="number" placeholder="" class="form-control">
                </div>
            </div>
            
            
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-dop"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_modal_dop_dan" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<script src="styles/js/demo/contracts_osns_dop.js"></script>
<script>
/*
    pril2_inc = 0;
    $('.pril2_save').each(function(){
        pril2_main_dan[pril2_inc] = $(this).val();
        pril2_inc++;         
    });
    
    pril2_inc = 0;
    $('.pril2_edit').each(function(){
        pril2_main_strah[pril2_inc] = $(this).val();
        pril2_inc++;         
    });
*/        
    $('#save_new_person').click(
       function(){
            var secondname_otvetstvennoe = $('#secondname_otvetstvennoe').val();
            var firstname = $('#firstname').val();
            var middlename = $('#middlename').val();
            var sql = $('#sql').val();
            
            $.post('new_contract', {"secondname_otvetstvennoe": secondname_otvetstvennoe, 
                                     "firstname": firstname,
                                     "middlename": middlename, 
                                     "sql": sql 
                                    }, function(d){
                    console.log(d);
            })
       }
    )

    $('#save_new_person').click(
        function(){
            var secondname_otvetstvennoe = $('#secondname_otvetstvennoe').val();
            var firstname = $('#firstname').val();
            var middlename = $('#middlename').val();
            $('#person_select').append('<option value="777">'+secondname_otvetstvennoe+' '+firstname+' '+middlename+'</option>');
        }
    )


    $('#main_form').submit(function(){
        var ISICID_AGENT = $('#ISICID_AGENT').val();
        if(ISICID_AGENT == 0){
            alert( "Выберите агента!" );
            event.preventDefault();
        }
        
        var select_ins_id = $('#id_insur').val();
        if(select_ins_id == 0){
              alert( "Выберите страхователя!" );
              event.preventDefault();
            }
        var pril2_table = $('#pril2_table tbody').html().trim();
        if(pril2_table == ''){
              alert( "'Приложение 2 не может быть пустым!" );
              event.preventDefault();
        }
        
        var raschet = $('#pay_sum_v').val();
        if(raschet == ''){
            alert( "Не произведено расчета во вкладке 'Расчет'!" );
            event.preventDefault();
        }
    });
  
    var list_insur_filials = [];
    var transh_inc = 0;
<?php     
        $r = OSNS::FilialsIdInsur($dan['ID_INSUR']);
?>
    var opt = '';
    list_insur_filials = JSON.parse('<?php echo $r; ?>');    
    for(var i=0; i< list_insur_filials.length; i++){
        var p = list_insur_filials[i];
        opt = opt+'<option value="'+p.ID+'">'+p.NAME+'</option>';
    }                    
    
    $('#dop_naimen').html(opt);
        
    $('.pril2_naimen').html(opt);
            
    $('.ns_naimen').html('');
    $('.ns_naimen').html(opt);
                           
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter41117204 = new Ya.Metrika({
                    id:41117204,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ut:"noindex"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/41117204?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter41117739 = new Ya.Metrika({
                    id:41117739,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ut:"noindex"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/41117739?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
    $('#oked').click(
        function(){
            alert('ОКЭД нельзя ввести! ОКЭД генерируется автоматически! для этого выберите страхователя в выпадающем списке "Страхователь"');
        }
    )
    
    $('#risk').click(
        function(){
            alert('Класс проф.риска нельзя ввести! Класс проф.риска генерируется автоматически! для этого выберите страхователя в выпадающем списке "Страхователь"');
        }
    )
    
    $('#iCONTRACT_NUM').click(
        function(){
            alert('Номер договора нельзя ввести! Номер договора генерируется автоматически! для этого выберите Дату договора');
        }
    )
    
    $('#iZV_NUM').click(
        function(){
            alert('Номер заявления нельзя ввести! Номер заявления генерируется автоматически! для этого выберите Дату заявления');
        }
    )
    
    $('#mediator_comiss').click(
        function(){
            alert('Комиссию посредника нельзя ввести! Комиссия посредника генерируется автоматически! для этого выберите агента');
        }
    )
    
    $('#base').click(
        function(){
            alert('Основание нельзя ввести! Основание генерируется автоматически! для этого выберите агента');
        }
    )
</script>