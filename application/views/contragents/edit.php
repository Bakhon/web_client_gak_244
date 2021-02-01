<form method="post" id="edit_contr_agents" class="form-horizontal">

<div class="ibox float-e-margins">                         
<div class="ibox-content">
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 15px;">
        <button id="submit" class="btn btn-success" ><i class="fa fa-save"></i> Сохранить</button>            
        <a href="contragents" class="btn btn-danger" ><i class="fa fa-close"></i> Отмена</a>            
        <button  id="submit_edit" class="btn btn-success" ><i class="fa fa-save"></i> Сохранить и продолжить</button>                   
        <span  id="history" class="btn btn-warning" data-toggle="modal" data-target="#protokol"><i class="fa fa-save"></i> История изменений</span>
        <input type="submit" style="display: none;" name="save_contr_agents" id="save"/>
    </div>
    
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Общие данные</a></li>
            <li><a data-toggle="tab" href="#tab-2"> Адресные данные</a></li>
            <li><a data-toggle="tab" href="#tab-3"> Реквизиты</a></li>            
            <li><a data-toggle="tab" href="#tab-5"> ОКЭД</a></li>
            <li><a data-toggle="tab" href="#tab-6"> Данные по руководству</a></li>
            <li><a data-toggle="tab" href="#tab-7"> Прочие данные</a></li>
        </ul>
        
        <div class="tab-content">        
            <!-- Основные данные-->
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label"></label>
                        <div class="col-lg-8">                        
                            <label>
                                <input checked="" type="radio" id="ur" name="NATURAL_PERSON_BOOL" value="0" <?php if($dan['CN']['NATURAL_PERSON_BOOL'] == '0'){echo 'checked';} ?> onclick="ViewIp('none');"/> 
                                <i></i> Юридическое лицо
                            </label>                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label"></label>
                        <div class="col-lg-8">        
                            <label> 
                                <input type="radio" id="ip" name="NATURAL_PERSON_BOOL" value="1" onclick="ViewIp('block');"> 
                                <i></i> Индивидуальный предприниматель
                            </label>                        
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">ОПФ</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" name="OPF_ID">
                            <?php 
                                foreach($dan['OPF'] as $k=>$v){ 
                                    $s = '';
                                    if($v['KOD'] == $dan['CN']['OPF_ID']){
                                        $s = 'checked';
                                    }
                                    echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
                                }
                            ?>                    
                            </select>
                        </div>
                    </div>
                    
                    <?php 
                        $view = 'none';                        
                    ?>
                    <div id="ip_control" style="display: <?php echo $view; ?>;">
                    <hr />
                        <h3>Данные препринимателя</h3>
                        <?php                             
                            echo FORMS::FormHorizontalEdit(4, 8, 'Фамилия', 'LASTNAME', $dan['CN']['LASTNAME']);                             
                            echo FORMS::FormHorizontalEdit(4, 8, 'Имя', 'FIRSTNAME', $dan['CN']['FIRSTNAME']);                            
                            echo FORMS::FormHorizontalEdit(4, 8, 'Отчество', 'MIDDLENAME', $dan['CN']['MIDDLENAME']);                            
                        ?>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Дата Рождения</label>
                            <div class="col-lg-8">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="BIRTHDATE" value="<?php echo date("d.m.Y", strtotime($dan['CN']['BIRTHDATE'])) ?>" data-mask="99.99.9999">
                                </div>                                
                            </div>
                        </div>                                                
                        
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Пол </label>
                            <div class="col-lg-8">
                                <div class="onoffswitch1">
                                    <input type="checkbox" name="SEX_ID" class="onoffswitch1-checkbox" id="myonoffswitch1" <?php echo SetChecked($dan['CN']['SEX_ID']); ?>>
                                    <label class="onoffswitch1-label" for="myonoffswitch1">
                                        <span class="onoffswitch1-inner"></span>
                                        <span class="onoffswitch1-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Тип документа</label>
                            <div class="col-lg-8">
                                <?php 
                                    $s = array("1"=>"", "2"=>"","3"=>"","4"=>"","5"=>"");
                                    $s[$dan['CN']['DOCTYPE']] = 'selected';
                                ?>
                                <select class="select2_demo_1 form-control chosen-select" name="DOCTYPE">
                                    <option value="1" <?php echo $s["1"]; ?>>ПАСПОРТ РК</option>
                                    <option value="2" <?php echo $s["2"]; ?>>УДОСТОВЕРЕНИЕ ЛИЧНОСТИ РК</option>
                                    <option value="3" <?php echo $s["3"]; ?>>ВИД НА ЖИТЕЛЬСТВО РК</option>
                                    <option value="4" <?php echo $s["4"]; ?>>СВИДЕТЕЛЬСТВО О РОЖДЕНИИ</option>
                                    <option value="5" <?php echo $s["5"]; ?>>ЛИЦО БЕЗ ГРАЖДАНСТВА РК</option>                    
                                </select>
                            </div>
                        </div>
                        <?php
                            echo FORMS::FormHorizontalEdit(4, 8, 'Номер документа', 'DOCNUM', $dan['CN']['DOCNUM']);                            
                            echo FORMS::FormHorizontalEdit(4, 8, 'Кем выдан', 'DOCPLACE', $dan['CN']['DOCPLACE']);                                                        
                        ?>
                                                
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Дата выдачи</label>
                            <div class="col-lg-8">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="DOCDATE" value="<?php echo date("d.m.Y", strtotime($dan['CN']['DOCDATE'])); ?>" data-mask="99.99.9999">
                                </div>                                
                            </div>
                        </div>
                        <hr />
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Полное наименование (рус)*</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="NAME" class="form-control NAME" value="<?php echo htmlspecialchars($dan['CN']['NAME']); ?>" placeholder="" required="">
                            <span class="help-block text-success m-b-none">Пример: Инженерно-космическая станция (без ТОО, ИП и т.д.)</span>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Полное наименование (каз)*</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="NAME_KAZ" class="form-control NAME_KAZ" value="<?php echo htmlspecialchars($dan['CN']['NAME_KAZ']); ?>" placeholder="" required="">                            
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Краткое наименование</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="SHORTNAME" class="form-control ishortname" value="<?php echo htmlspecialchars($dan['CN']['SHORTNAME']); ?>" placeholder="">
                        </div>
                    </div>
                
                    <?php                                                                                                                                                                                       
                        $type_contr = array();
                        $type_contr[] = array("id"=>"1", "text"=>"Организация"); 
                        $type_contr[] = array("id"=>"2", "text"=>"Пенсионный фонд");
                        $type_contr[] = array("id"=>"3", "text"=>"Частное лицо");
                        $type_contr[] = array("id"=>"4", "text"=>"Перестраховщик");
                        $type_contr[] = array("id"=>"5", "text"=>"Первичные страховщики (СК)");
                                                
                        echo FORMS::FormHorizontalSelect(4, 8, 'Тип контрагента', 'TYPE', $type_contr, '', $dan['CN']['TYPE']);                                                                                                                                           
                    ?>                                        
                </div>
            </div>
            <!-- Конец основных данных-->
            
            <!-- Адресные данные -->
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <div class="form-group">                    
                        <label class="col-lg-4 control-label"></label>
                        <div class="col-lg-8">                        
                            <div class="onoffswitch">
                                <input type="checkbox" name="RESIDENT" class="onoffswitch-checkbox" id="myonoffswitch" <?php SetChecked($dan['CN']['RESIDENT']); ?>>
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>              
                        </div>
                    </div>
                                        
                    <div class="form-group" id="strana" style="display: none">
                        <label class="col-lg-4 control-label">Страна</label>
                        <div class="col-lg-8">                
                            <select class="select2_demo_1 form-control chosen-select" id="icountry" name="COUNTRY_ID">
                                <?php 
                                    foreach($dan['STRANA'] as $k=>$v){
                                        $s = '';
                                        if($v['ID'] == $dan['CN']['COUNTRY_ID']){
                                            $s = 'selected';
                                        }
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div> 
                    
                    <div class="form-group" id="search_address">
                        <label class="col-lg-4 control-label">Найти адрес</label>     
                        <div class="col-lg-8">                   
                            <div class="input-group">
                                <input type="text" id="search_post" class="form-control"> 
                                    <span class="input-group-btn"> 
                                    <button type="button" id="search_post_btn"  class="btn btn-primary"><i class="fa fa-search"></i></button> 
                                </span>
                            </div>
                        </div>
                    </div>                    
                    
                    <div class="list-group table-of-contents" id="search_result">   
                                                    
                    </div>
                    <hr />  
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Область *</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="region" name="REGION_NAME" value="<?php echo $dan['SI']['REGION_NAME']; ?>" required />                           
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Район</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="RAION" class="form-control RAION" value="<?php echo $dan['SI']['RAION']; ?>" placeholder="">
                        </div>
                    </div>                                   
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Вид населенного пункта *</label>
                        <div class="col-lg-8" id="city_reg">
                            <input type="text" name="TYPE_CITY" class="form-control" value="<?php echo $dan['SI']['TYPE_CITY']; ?>" placeholder="ГОРОД, АУЛ, СЕЛО" required />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Населенный пункт *</label>
                        <div class="col-lg-8" id="city_reg">
                            <input type="text" class="form-control" id="icity_id" name="CITY_NAME" placeholder="Наименование города, Села" value="<?php echo $dan['SI']['CITY_NAME']; ?>" required/>                            
                        </div>
                    </div>
                    <?php                          
                        echo FORMS::FormHorizontalEdit(4, 8, 'Почтовый индекс', 'POSTCODE', $dan['CN']['POSTCODE']);                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Улица *', 'STREET', $dan['SI']['STREET'], '', '', '', 'required');                                                           
                        echo FORMS::FormHorizontalEdit(4, 8, 'Дом *', 'HOME_NUM', $dan['SI']['HOME_NUM'], '', '', '', 'required');                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Офис', 'OFICE', $dan['SI']['OFICE']);                                                                                    
                    ?>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Телефон</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="PHONE" class="form-control iphone" value="<?php echo htmlspecialchars($dan['CN']['PHONE']); ?>" placeholder="+7(123) 123-45-67" > <!-- data-mask="+7(999) 999-99-99"-->
                        </div>
                    </div>    
                    <hr />  
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Адрес (рус)*</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="ADDRESS" class="form-control iaddress" value="<?php echo htmlspecialchars($dan['CN']['ADDRESS']); ?>" placeholder="" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Адрес (каз) *</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="ADDRESS_KAZ" class="form-control iaddress_kaz" value="<?php echo htmlspecialchars($dan['CN']['ADDRESS_KAZ']); ?>" placeholder="" required>
                        </div>
                    </div>                                        
                </div>
            </div>
            <!-- Конец Адресные данные -->
            
            <!-- Реквизиты -->
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">БИН/ИИН *</label>
                        <div class="col-lg-8">
                            <input data-mask="999999999999" onblur="checkBIN();" name="BIN" class="form-control" id="ibin" value="<?php echo $dan['CN']['BIN']; ?>" required/>
                            <div id="answer">
                                
                            </div>
                        </div>
                    </div>
                                        
                    <?php
                        echo FORMS::FormHorizontalSelect(4, 8, 'Категория', 'KATEGOR', $dan['KATEGORY'], '', $dan['SI']['KATEGOR']);                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Расшифровка БИН', 'BIN_RASHIFR', $dan['SI']['BIN_RASHIFR']);                                                                                    
                    ?>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Степень аффилированности</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" name="AFFILIR">
                                <option value="A" <?php if($dan['SI']['AFFILIR'] == 'A'){echo 'selected';} ?>>A</option>
                                <option value="B" <?Php if($dan['SI']['AFFILIR'] == 'B'){echo 'selected';} ?>>B</option>                                     
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Входит в группу? *</label>
                        <div class="col-lg-8">
                            <div class="onoffswitch2">
                                <input type="checkbox" name="STRUCTURE" class="onoffswitch2-checkbox" id="myonoffswitch2" <?php if($dan['SI']['STRUCTURE'] !== 'C')echo "checked"; ?>>
                                <label class="onoffswitch2-label" for="myonoffswitch2">
                                    <span class="onoffswitch2-inner"></span>
                                    <span class="onoffswitch2-switch"></span>
                                </label>
                            </div>                                                                                    
                        </div>
                    </div>
                    
                    <div class="form-group" id="group_company_div" style="display: none;">
                        <label class="col-lg-4 control-label">Выберите группу *</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select"  name="GROUP_COMPANY" id="igroup" required>
                                <option>Не выбрана группа</option>
                                <?php 
                                    foreach($dan['GROUP_COMPANY'] as $k=>$v){
                                        $s = '';
                                        if($v['ID_GROUP'] == 6){$s = 'selected';}
                                        if($v['ID_GROUP'] ==$dan['SN']['GROUP_ID']){$s = 'selected';}                                        
                                        echo '<option value="'.$v['ID_GROUP'].'" '.$s.'>'.$v['GROUP_NAME'].'</option>';
                                    }
                                ?>                                
                            </select>
                        </div>
                    </div>                                                          
                </div>
                
                <div class="panel-body">
                    <h3>Банковские данные</h3>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Банк</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" id="ibank_id" name="BANK_NAME">
                                <option value="">-Не выбрано</option>
                                <?php 
                                    foreach($dan['BANKS'] as $k=>$v){
                                        $s = '';         
                                        if($v['KOD'] == $dan['CN']['BANK_ID']){
                                            $s = 'selected';
                                        }                       
                                        echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Банковский счет</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="P_ACCOUNT" id="ip_account" value="<?php echo $dan['CN']['P_ACCOUNT']; ?>">
                        </div>
                    </div>                                        
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Примечание</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="NOTE" class="form-control NOTE" value="<?php echo $dan['CN']['NOTE']; ?>" placeholder="">
                        </div>
                    </div>                                    
                </div>
            </div>
            <!-- Конец Реквизиты -->                        
            
            <!-- ОКЕД -->
            <div id="tab-5" class="tab-pane">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Основной вид деятельности *</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" id="osnVidDeyatelnosty_contr" name="OKED_ID" required>
                                <option></option>
                                <?php 
                                    foreach($dan['OKED'] as $k=>$v){
                                        $s = '';
                                        if($v['ID'] == $dan['OKED_DAN']['ID']){
                                            $s = 'selected';
                                        }                                        
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['OKED'].' - '.$v['VED_NAME'].'</option>';
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">ОКЭД</label>
                        <div class="col-lg-8">                
                            <input type="text" readonly class="form-control" id="OKED" value="<?php echo $dan['OKED_DAN']['OKED']; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Класс проф. риска</label>
                        <div class="col-lg-8">
                            <input type="text" readonly class="form-control" id="RISK_ID" value="<?php echo $dan['OKED_DAN']['RISK_ID']; ?>">
                        </div>
                    </div>
                    
                    <hr />
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Сектор экономики *</label>
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" name="SEC_ECONOM" id="isec_econom" required>
                                <option></option>
                                <?php                         
                                    foreach($dan['KOD_SECTOR'] as $k=>$v){
                                        $s = '';                    
                                        if($v['CODE'] == $dan['CN']['SEC_ECONOM']){
                                            $s = 'selected';
                                        }                                            
                                        echo '<option value="'.$v['CODE'].'" '.$s.'>'.$v['NAME'].'</option>';
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Вид деятельности (для ЕСБД) *</label>            
                        <div class="col-lg-8">
                            <select class="select2_demo_1 form-control chosen-select" id="IVED_ID" name="VED_ID" required>
                                <option></option>
                                <?php 
                                    foreach($dan['OKED_ESBD'] as $k=>$v){
                                        $s = '';
                                        if($v['ID'] == $dan['CN']['VED_ID']){
                                            $s = 'selected';
                                        }
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['ID'].' - '.$v['NAME'].'</option>';
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Период осущ. эконом. деятель.</label>
                        <div class="col-lg-8">
                            <input id="" type="text" name="PERIOD_DEY" class="form-control PERIOD_DEY" value="<?php echo $dan['CN']['PERIOD_DEY']; ?>" placeholder="">
                        </div>
                    </div>                    
                </div>
            </div>            
            <!-- Конец ОКЕД -->
            
            <!-- Данные по руководству -->
            <div id="tab-6" class="tab-pane">
                <div class="panel-body">
                    <?php                         
                        echo FORMS::FormHorizontalEdit(4, 8, 'Руководитель *', 'CHIEF', $dan['CN']['CHIEF'], '', 'Иванов (пример)', '', 'required');                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Руководитель (в родительном падеже)', 'CHIEF2', $dan['CN']['CHIEF2'], '', 'Иванова (пример)', '', 'required');
                        echo '<hr>';                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Должность руководителя', 'CHIEF_DOLZH', $dan['CN']['CHIEF_DOLZH'], '', 'Председатель (пример)', '', 'required');                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Должность (в родительном падеже)', 'CHIEF_DOLZH2', $dan['CN']['CHIEF_DOLZH2'], '', 'Председателя (пример)', '', 'required');
                        echo '<hr>';                        
                        echo FORMS::FormHorizontalEdit(4, 8, 'Должность руководителя (каз)', 'CHIEF_DOLZH_KAZ', $dan['CN']['CHIEF_DOLZH_KAZ'], '', 'Торага (пример)');
                        echo '<hr>';                        
                        echo FORMS::FormHorizontalEdit(4, 8, 'Действующий на основании (каз)', 'OSNOVANIE_KAZ', $dan['CN']['OSNOVANIE_KAZ'], '', 'Устава (пример)');                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Действующий на основании (рус) *', 'OSNOVANIE', $dan['CN']['OSNOVANIE'], '', 'Устава (пример)', '', 'required');            
                        echo '<hr>';                        
                        echo FORMS::FormHorizontalEdit(4, 8, 'Главный бухгалтер', 'MAINBK', $dan['CN']['MAINBK']);                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Главный бухгалтер (тел)', 'GL_BUH', $dan['CN']['GL_BUH']);                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Первый руководитель', 'FIRST_RUK', $dan['CN']['FIRST_RUK']);                                                
                        echo FORMS::FormHorizontalEdit(4, 8, 'Контактное лицо', 'KONTACT_FACE', $dan['CN']['KONTACT_FACE']);   
                    ?>
                </div>
            </div>
            <!-- Данные по руководству -->
                        
            <div id="tab-7" class="tab-pane">
                <div class="panel-body">
                    <h3>Данные по сегментированию</h3>        
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Филиал *</label>
                        <div class="col-lg-8">            
                            <select class="select2_demo_1 form-control chosen-select" name="BRANCH_ID">
                                <?php 
                                    foreach($dan['FILIAL'] as $k=>$v){
                                        $s = '';
                                        if($v['KOD'] == $dan['SI']['BRANCH_ID']){
                                            $s = 'selected';
                                        }
                                        echo '<option value="'.$v['KOD'].'" '.$s.'>'.$v['NAME'].'</option>';
                                        
                                    }
                                ?>                    
                            </select>
                        </div>
                    </div>                                        
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Способ закупа</label>
                        <div class="col-lg-8">                           
                            <select class="select2_demo_1 form-control chosen-select" name="SPOSOB_ZAKUP">
                            <?php 
                                foreach($dan['ZAKUP'] as $k=>$v){
                                    $s = '';
                                    if($k == $dan['SI']['SPOSOB_ZAKUP']){
                                        $s = 'selected';
                                    }                                    
                                    echo '<option value="'.$k.'" '.$s.'>'.$v.'</option>';
                                }
                            ?>                                                                        
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Дата закупа</label>
                        <div class="col-lg-8">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="DATE_V" value="<?php echo $dan['CN']['DATE_V']; ?>" data-mask="99.99.9999">
                            </div>                                
                        </div>
                    </div> 
                                                                                                    
                </div>                                    
            </div>
            
        </div>
    </div>
            
    </div></div></div>
    <input type="hidden" name="ID" value="<?php echo $dan['ID']; ?>"/>
</form>






<div class="modal inmodal fade" id="protokol" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">История изменений </h4>                
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Кто внес изменение</th>
                        <th>Наименование поля</th>
                        <th>Старое значение</th>                        
                        <th>Новое значение</th>                        
                        <th>Дата и время</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php         
                        $i = 0;                
                        foreach($dan['PROTOKOL'] as $k=>$v){
                            //$date = date("d-m-Y", strtotime($v['date']));                            
                            if(count($v) > 0){
                                if($i>0)
                                if($v['id'] !== $t){
                                    echo '
                                    <tr style="background-color: rgba(255, 0, 0, 0.23);">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>'; 
                                }
                                
                                echo '
                                <tr>
                                    <td>'.$v['id'].'</td>
                                    <td><a href="#'.$v['user_id'].'">'.$v['user'].'</a></td>
                                    <td>'.$v['col'].'</td>
                                    <td>'.$v['old_text'].'</td>
                                    <td>'.$v['text'].'</td>
                                    <td>'.$v['date'].'</td>
                                </tr>';                                 
                                $t = $v['id'];  
                                $i++;                             
                            }
                        }
                    ?>                    
                </tbody>                    
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<style>
#protokol .modal-dialog{
    width: 80%;
}

#search_result{    
    position: absolute;
    z-index: 1000;
    right: 20px;
    width: 64.5%;
    background-color: #ececec;
    padding: 10px;
    display: none;
    height: 50%;
    overflow: auto;
}

.onoffswitch {
    position: relative; width: 200px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #E3E3E3; 
    border-radius: 42px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 37px; padding: 0; line-height: 37px;
    font-size: 20px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Резидент";
    padding-left: 28px;
    background-color: #1AB394; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "Не резидент";
    padding-right: 28px;
    background-color: #FF0000; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 28px; margin: 4.5px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 159px;
    border: 2px solid #E3E3E3; border-radius: 42px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}


.onoffswitch1 {
    position: relative; width: 200px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch1-checkbox {
    display: none;
}
.onoffswitch1-label {
    display: block; overflow: hidden; cursor: pointer;    
    border-radius: 42px;
}
.onoffswitch1-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch1-inner:before, .onoffswitch1-inner:after {
    display: block; float: left; width: 50%; height: 37px; padding: 0; line-height: 37px;
    font-size: 20px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch1-inner:before {
    content: "Мужской";
    padding-left: 28px;
    background-color: #1AB394; color: #FFFFFF;
}
.onoffswitch1-inner:after {
    content: "Женский";
    padding-right: 28px;
    background-color: #FF0000; color: #FFFFFF;
    text-align: right;
}
.onoffswitch1-switch {
    display: block; width: 28px; margin: 4.5px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 159px;
    border: 2px solid #E3E3E3; border-radius: 42px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-inner {
    margin-left: 0;
}
.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-switch {
    right: 0px; 
}


.onoffswitch2 {
    position: relative; width: 100px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch2-checkbox {
    display: none;
}
.onoffswitch2-label {
    display: block; overflow: hidden; cursor: pointer;    
    border-radius: 42px;
}
.onoffswitch2-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch2-inner:before, .onoffswitch2-inner:after {
    display: block; float: left; width: 50%; height: 37px; padding: 0; line-height: 37px;
    font-size: 20px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch2-inner:before {
    content: "Нет";
    padding-left: 18px;
    background-color: #1AB394; color: #FFFFFF;
}
.onoffswitch2-inner:after {
    content: "Да";
    padding-right: 28px;
    background-color: #5BADFF; color: #FFFFFF;
    text-align: right;
}
.onoffswitch2-switch {
    display: block; width: 28px; margin: 4.5px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 60px;
    border: 2px solid #E3E3E3; border-radius: 42px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label .onoffswitch2-inner {
    margin-left: 0;
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label .onoffswitch2-switch {
    right: 0px; 
}


</style>