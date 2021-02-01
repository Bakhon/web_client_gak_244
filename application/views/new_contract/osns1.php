<?php
    $ds = array();    
	if(count($_POST) > 0){
	   $ds = $_POST;
	   //print_r($_POST);
    }
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">            
        <form method="post" id="main_form">            
            <div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-11">                            
                            <label class="font-noraml">Страхователь (<strong>Шаг 1:</strong> Выберите страхователя, если его нет в списке, добавьте, нажав кнопку (+), редактирование страхователя (Справочники->Контрагенты->Поиск->Редактировать))</label>
                            <select name="iID_INSUR" id="id_insur" class="select2_demo_1 form-control chosen-select" required>
                            <option value="0">Не выбрано</option>
                            <?php
                                foreach($NewC->dan['strah_list'] as $k=>$v){
                                    $s = '';
                                    if(isset($dan['contracts'][0]['ID_INSUR'])){$D = $dan['contracts'][0]['ID_INSUR'];}ELSE{$D = '';}
                                    if(isset($ds['iID_INSUR'])){$D = $dan['iID_INSUR'];}                                    
                                    if($D == $v['KOD']){$s = 'selected';}                                    
                                    echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].' (БИН: '.$v['BIN'].')</option>';
                                }
                            ?>
                            </select>                               
                        </div>
                        
                        <?php
                        if(isset($_GET['create_type'])){
                        ?>
                           <script>
                            $(document).ready(function(){
                                var id = $('#contrAgetnsId').val();
                                $('#id_insur [value='+id+']').attr("selected", "selected");
                                console.log(id);
                                                      
                                        if(id !== ''){
                                            $.post('new_contract', 
                                                {"id_insur_dan": id},
                                            function(data){                
                                                var s = JSON.parse(data);                
                                                var id_oked = s.oked_id;
                                                
                                                //Если есть ОКЕД тогда вставляем его автоматически
                                                if(s.oked_id !== null){
                                                    $('.osnVidDeyatelnosty').val(id_oked);
                                                    $('.osnVidDeyatelnosty').change();
                                                    var osn_text = $('.osnVidDeyatelnosty :selected').html();
                                                    $('.osnVidDeyatelnosty').next('.chosen-container').children('a').children('span').html(osn_text)
                                                }
                                                
                                                //Вставляем Филиалы Контрагента
                                                var fl = $('.pril2_naimen');
                                                fl.html('');                
                                                var opt = '';
                                                var j = s.filials;
                                                
                                                //Вносим в переменную все филиалы включая саму организацию
                                                list_insur_filials = j;                
                                                
                                                for(var i=0; i< j.length; i++){
                                                    var p = j[i];
                                                    opt = opt+'<option value="'+p.ID+'">'+p.NAME+'</option>';
                                                }                    
                                                    
                                                fl.html(opt);
                                                
                                                $('.ns_naimen').html('');
                                                $('.ns_naimen').html(opt);
                                                $('#pril2_table tbody').html('');
                                            });
                                        }
                            })
                           </script>
                        <?php
                            }
                        ?>
                        <div class="col-lg-1">
                            <label class="font-noraml">&nbsp;</label>
                                <div class="tooltip-demo">
                                    <a href="<?php echo "contragents?paym_code=".$_GET['paym_code']."&create_type=2&edit=0";?>" class="btn btn-default form-control"><i class="fa fa-plus"></i></a>
                                </div>
                        </div>
                    </div>                    
                    <div class="hr-line-dashed"></div>
                    <div class="row">  
                    <input hidden="" value="<?php echo $listLastContragents[0]['ID']; ?>" id="contrAgetnsId"/>

                        <?php
                            $D = '';
                            if(isset($dan['contracts'][0]['CONTRACT_NUM'])){$D = $dan['contracts'][0]['CONTRACT_NUM'];}
                            if(isset($ds['iCONTRACT_NUM'])){$D = $dan['iCONTRACT_NUM'];}
                            echo FORMS::InputText(3, 'Номер договора', 'iCONTRACT_NUM', 'iCONTRACT_NUM', '', 'form-control', $D, true);
                            
                            $D = '';                            
                            if(isset($dan['contracts'][0]['ZV_NUM'])){$D = $dan['contracts'][0]['ZV_NUM'];}
                            if(isset($ds['iZV_NUM'])){$D = $dan['iZV_NUM'];}
                            echo FORMS::InputText(3, 'Номер Заявления', 'iZV_NUM', 'iZV_NUM', '', 'form-control', $D, true);
                        ?>                        
                                                
                        <div class="col-lg-4">                            
                            <label class="font-noraml">Отделение (Определяется автоматически)</label>                            
                            <select name="iBRANCH_ID" id="branch" class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php                                                                                                                    
                                    foreach($NewC->dan['branch_list'] as $k => $v){
                                        $s = '';
                                        $D = $default_branch;
                                        if(isset($dan['contracts'][0]['BRANCH_ID'])){
                                            $D = $dan['contracts'][0]['BRANCH_ID'];
                                        }
                                        if(isset($ds['iBRANCH_ID'])){
                                            $D = $dan['iBRANCH_ID'];
                                        }
                                        if($D == $v['KOD']){
                                            $s = 'selected';
                                        }
                                        echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
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
                                    if(isset($dan['contracts'][0]['CONTRACT_TYPE'])){$D = $dan['contracts'][0]['CONTRACT_TYPE'];}
                                    if(isset($ds['typ_dog'])){$D = $dan['typ_dog'];}
                                    IF($D !== 1){
                                        $D = '';
                                    }
                                    ?>
                                    <input checked="" name="typ_dog" type="checkbox" value="" <?php ECHO $D; ?>> <i></i>  Типовой
                                </label>
                            </div>
                        </div>
                        <?php 
                            if(isset($dan['contracts'][0]['CONTRACT_DATE'])){$D = $dan['contracts'][0]['CONTRACT_DATE'];}ELSE{$D = '';}     
                            if(isset($ds['iCONTRACT_DATE'])){$D = $dan['iCONTRACT_DATE'];}                       
                            echo FORMS::InputDate(3, 'Дата договора (<strong>Шаг 2</strong>)', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', $D, false, array("data"=>$_GET['paym_code']),  'required');
                            
                            if(isset($dan['contracts'][0]['ZV_DATE'])){$D = $dan['contracts'][0]['ZV_DATE'];}ELSE{$D = '';}
                            if(isset($ds['iZV_DATE'])){$D = $dan['iZV_DATE'];}
                            echo FORMS::InputDate(3, 'Дата заявления (<strong>Шаг 2</strong>)', 'iZV_DATE', 'IZV_DATE', 'form-control', $D, false, array("data"=>$_GET['paym_code']),  'required');
                        ?>
                        <!--
                        <div class="col-lg-5">
                            <label class="font-noraml">Ответственное лицо (можно добавить, нажав (+))</label>
                            <select name="otv_lico" class="select2_demo_1 form-control" id="person_select">
                                <option value="">Не выбрано</option>
                                <?php                                   
                                   //foreach ($listlDicPersonKos as $k => $v){
                                   //     echo '<option value="'.$v['ID'].'">'.$v['LASTNAME'].' '.$v['FIRSTNAME'].' '.$v['MIDDLENAME'].'</option>';
                                   //}
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label class="font-noraml">&nbsp;</label>
                                <div class="tooltip-demo">
                                    <a data-toggle="modal" data-target="#new_person" class="btn btn-default form-control"><i class="fa fa-plus"></i></a>
                                </div>
                        </div>
                        -->
                        <div class="col-lg-6"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-5">                            
                            <label class="font-noraml">Агент (<strong>Шаг 3:</strong> Выберите агента)</label>                                                     
                            <select name="iSICID_AGENT" id="ISICID_AGENT" class="select2_demo_1 form-control chosen-select">
                            <option value="0">Не выбрано</option>
                            <?php                                
                                foreach($NewC->dan['agents_list'] as $k => $v){
                                    $s = '';
                                    if(isset($dan['contracts'][0]['SICID_AGENT'])){$D = $dan['contracts'][0]['SICID_AGENT'];}ELSE{$D = '';}                                    
                                    if($D == $v['KOD']){$s = 'selected';}
                                    echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
                                }                                        
                            ?>
                            </select>                               
                        </div>
                        <?php 
                            if(isset($dan['agent_dan']['OSNOVANIE'])){$D = $dan['agent_dan']['OSNOVANIE'];}ELSE{$D = '';}
                            echo FORMS::InputText(5, 'Основание', 'base', 'base', '', 'form-control osnov_agent', $D, true);
                            
                            if(isset($dan['agent_dan']['PERCENT_OSNS'])){$D = $dan['agent_dan']['PERCENT_OSNS'];}ELSE{$D = '';}
                            echo FORMS::InputText(2, 'Комиссия посредника', 'mediator_comiss', 'mediator_comiss', '', 'form-control persent_agent', $D, true);
                        ?>                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row"> 
                        <?php 
                            if(isset($dan['contracts'][0]['DATE_BEGIN'])){$D = $dan['contracts'][0]['DATE_BEGIN'];}ELSE{$D = '';}
                            echo FORMS::InputDate(3, 'Начало периода страхования (<strong>Шаг 4:</strong> Обозначьте период страхования)', 'idate_begin', '', 'form-control', $D, false, array(),  'required');
                            
                            if(isset($dan['contracts'][0]['DATE_END'])){$D = $dan['contracts'][0]['DATE_END'];}ELSE{$D = '';}
                            echo FORMS::InputDate(3, 'Конец периода страхования (<strong>Шаг 4:</strong> Обозначьте период страхования)', 'idate_end', '', 'form-control', $D, false, array(),  'required');
                        ?>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">                       
                        <h4>По классу проф. риска (постановление правительства РК №652)</h4>
                        <div class="ibox-tools"></div> 
                        <?php 
                            if(isset($dan['oked_dan']['NAME'])){$D = $dan['oked_dan']['NAME'];}ELSE{$D = '';}
                            echo FORMS::InputText(9, 'Основной вид деятельности', '', 'vd', 'Это поле заполнится автоматически...', 'form-control', $D, true);
                                                        
                            if(isset($dan['osns_calc'][0]['RISK_ID'])){$D = $dan['osns_calc'][0]['RISK_ID'];}ELSE{$D = '';}
                            echo FORMS::InputText(2, 'Класс проф.риска', 'irisk_id', 'risk', '', 'form-control', $D, true);
                            
                            if(isset($dan['contracts'][0]['OKED'])){$D = $dan['contracts'][0]['OKED'];}ELSE{$D = '';}
                            echo FORMS::InputText(1, 'ОКЭД', 'IOKED', 'oked', '', 'form-control', $D, true);
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
                                foreach($NewC->dan['osn_vid_list'] as $k => $v){      
                                    $s = '';
                                    if(isset($dan['contracts'][0]['OKED_ID'])){$D = $dan['contracts'][0]['OKED_ID'];}ELSE{$D = '';}
                                    if($D == $v['ID']){$s = 'selected';}
                                    
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['OKED'].' - '.$v['VED_NAME'].'</option>';                                    
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="font-noraml">Степень аффилированности (<strong>Шаг 6</strong>)</label>
                            <?php 
                                if(isset($dan['osns_calc'][0]['AFFILIR'])){
                                    $D = $dan['osns_calc'][0]['AFFILIR'];
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
                                                if(isset($dan['contracts'][0]['BAD_SLUCH'])){
                                                    if($dan['contracts'][0]['BAD_SLUCH'] == '1'){
                                                        $D = 'checked';
                                                        $aktn1_view = '';
                                                    }
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
                            <li class="" id="statVkladka" style="<?php 
                            if(isset($dan['contracts'][0]['BAD_SLUCH'])){
                                if($dan['contracts'][0]['BAD_SLUCH'] !== '1'){
                                    echo 'display:none;';
                                }
                            }else echo 'display:none;';
                            ?>"><a data-toggle="tab" href="#tab-3">Статистика несчастных случаев на производстве</a></li>
                            <li class="" id="transh" style="
                            <?php 
                                if(isset($dan['contracts'][0]['PERIODICH'])){
                                    if(substr($dan['contracts'][0]['PERIODICH'], 0, 1) == 1)
                                    { 
                                        echo 'display: none;';
                                    }
                                }else{
                                    echo 'display: none;';
                                } ?>"><a data-toggle="tab" href="#tabtransh">Транши</a></li>
                        </ul>
                        
                        <!-- Приложение 2 -->
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body" style="height: 450px;overflow-x: auto;" id="pril2">
                                    <table class="table table-bordered" id="pril2_table" >
                                        <thead>
                                        <tr>
                                            <th>
                                                <a class="btn btn-success btn-sm" id="add_pril2" data-toggle="modal" data-target="#modal_pril2"><i class="fa fa-plus"></i>Добавить сотрудника</a>
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
                                                        echo OSNS::Tables_Pril2($v['ID_FILIAL'], $v['NAME'], $v['D_NAME'], $v['CNT'], $v['RISK'], $v['OKLAD'], $v['SMZP'], $v['GFOT'], $v['STR_SUM'], $v['OKED'], $v['ID']);
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
                                        <?php if(isset($dan['contracts'][0]['PAY_SUM_V'])){$D = $dan['contracts'][0]['PAY_SUM_V'];}ELSE{$D = '';} ?>
                                        <label class="font-noraml">Страховая сумма</label>                                        
                                        <input type="text" class="form-control" name="vPAY_SUM_V" value="<?php echo $D; ?>" id="pay_sum_v">
                                        
                                        <?php if(isset($dan['contracts'][0]['PAY_SUM_P'])){$D = $dan['contracts'][0]['PAY_SUM_P'];}ELSE{$D = '';} ?>
                                        <label class="font-noraml">Страховая премия</label>
                                        <input type="text" class="form-control" name="vPAY_SUM_P" value="<?php echo $D; ?>" id="pay_sum_p">
                                        
                                        <?php if(isset($dan['osns_calc'][0]['KOEF_PP'])){$D = $dan['osns_calc'][0]['KOEF_PP'];}ELSE{$D = '';} ?>
                                        <label class="font-noraml">ПП. Коэффициент</label>
                                        <input type="text" class="form-control" name="koef_pp" value="<?php echo $D; ?>" id="koef_pp">
                                                                                
                                        <?php if(isset($dan['osns_calc'][0]['SGCHP'])){$D = $dan['osns_calc'][0]['SGCHP'];}ELSE{$D = '';} ?>
                                        <label class="font-noraml">СГЧП</label>
                                        <input type="text" class="form-control" name="sgchp" value="<?php echo $D; ?>" id="sgchp">
                                        
                                        <?php if(isset($dan['osns_calc'][0]['KOEF_UV'])){$D = $dan['osns_calc'][0]['KOEF_UV'];}ELSE{$D = '';} ?>
                                        <label class="font-noraml">Коэффициент ув.</label>
                                        <input type="text" class="form-control" name="ikoef_uv" value="<?php echo $D; ?>" id="koef_uv">
                                        
                                        <?php if(isset($dan['contracts'][0]['PERIODICH'])){$D = $dan['contracts'][0]['PERIODICH'];}ELSE{$D = '';} ?>                                        
                                        <label class="font-noraml">Порядок уплаты</label>
                                        <select class="select2_demo_1 form-control" name="iPERIODICH" id="iPERIODICH">
                                            <option value="1 Единовременно" <?php if(substr($D, 0, 1) == 1){echo 'selected';} ?>>1 Единовременно</option>
                                            <option value="2 В рассрочку" <?php if(substr($D, 0, 1) == 2){echo 'selected';} ?>>2 В рассрочку</option>
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
                                                echo OSNS::Table_OSNS_CALC_NEW($v['NAME'], $v['ID_FILIAL'], $v['CNT'], $v['GFOT'], $v['STR_SUM'], $v['TARIF'], $v['PAY_SUM']);                                                
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
                                                echo OSNS::Table_bad_sluch($v['ID_FILIAL'], $v['NAME'], $v['GOD'], $v['CNT_ALL'], $v['UPT_SROK'], $v['UPT_BES_SROK'], $v['DEATH'], $v['CNT_POSTR'], $v['ID']);
                                                
                                                /*
                                                [ID] => 25461
                                                [CNCT_ID] => 65064
                                                [DOLZHN] => 
                                                [GOD] => 2010
                                                [CNT_ALL] => 30
                                                [UPT_SROK] => 1
                                                [UPT_BES_SROK] => 2
                                                [DEATH] => 
                                                [CNT_POSTR] => 
                                                [SUM_P] => 
                                                [SUM_V] => 
                                                [KOEF_NADB] => 
                                                [ID_FILIAL] => 0
                                                */
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
                        </div>
                        
                    </div></div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="form-group">                            
                            <!--<a href="#" class="btn btn-primary pull-right" id="submit">Сохранить</a>-->  
                            <?php 
                                foreach($others_params as $k=>$v){
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

<script>
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
    if(isset($dan['contracts'][0]['ID_INSUR'])){
        $r = OSNS::FilialsIdInsur($dan['contracts'][0]['ID_INSUR']);
?>
        var opt = '';
        list_insur_filials = JSON.parse('<?php echo $r; ?>');    
        for(var i=0; i< list_insur_filials.length; i++){
            var p = list_insur_filials[i];
            opt = opt+'<option value="'+p.ID+'">'+p.NAME+'</option>';
        }                    
                    
        $('.pril2_naimen').html(opt);
                
        $('.ns_naimen').html('');
        $('.ns_naimen').html(opt);
                   
        <?php        
    }
?>
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