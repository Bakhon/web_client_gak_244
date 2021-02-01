<?php 
    $edit = false;
    $block = 'none';
    if(isset($dan['contract'])){
        $edit = true;
        $block = 'block';
    }
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
        
            <div class="ibox float-e-margins">                                      
                <div class="ibox-content">
                    <div class="row">  
                        <div id="search_result_strahovatel"></div>
                        
                        <div class="col-lg-12" id="search_panel">
                            <label>Начните вводить "Наименование, Фамилия Имя Отчество, БИН или ИИН" клиента</label>
                            <div class="input-group m-b">
                                <span class="input-group-btn">
                                    <button class="dropdown-toggle btn btn-success" data-toggle="dropdown"><i class="fa fa-plus"></i> Создать</button>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="contragents?edit=0" target="_blank">Юридическое лицо</a></li>
                                        <li><a href="clients?edit=0" target="_blank">Физическое лицо</a></li>
                                    </ul>
                                </span>
                                <input type="text" class="form-control" id="search_clients" value="">
                                <span class="input-group-btn">
                                    <button id="btn_search" class="btn btn-primary">Найти</button>                                     
                                </span>                                
                            </div>
                            <div id="search_text"></div>                                                        
                            <div class="list-group table-of-contents" id="search_result">
                            <?php 
                                if($edit){
                                    echo '<label>Страхователь</label>
                                <h3>'.$dan['contract']['STRAHOVATEL'].'</h3>
                                <input type="hidden" name="id_client" value="'.$dan['contract']['ID_STRAHOVATEL'].'">
                                <input type="hidden" name="type_client" value="'.$dan['contract']['TYPE_STRAHOVATEL'].'">';                            
                                }
                            ?>                                                        
                            </div>
                            <div class="hr-line-dashed"></div>                                                                                 
                        </div>                        
                        <div id="page0" style="display: <?php echo $block; ?>;">
                            <div class="col-lg-12">
                                <label>Регион</label>
                                <select class="form-control" id="branch_id">
                                    <?php 
                                        foreach($dan['regions'] as $k=>$v){
                                            $s = '';
                                            if($active_user_dan['brid'] == $v['RFBN_ID']){
                                                $s = 'selected';
                                            }
                                            if($edit){
                                                if($v['RFBN_ID'] == $dan['contract']['BRANCH_ID']){
                                                    $s = 'selected';
                                                }
                                            }
                                            echo '<option value="'.$v['RFBN_ID'].'" '.$s.'>'.$v['NAME'].' ('.$v['SHORT_NAME'].')</option>';
                                        }
                                    ?>                                    
                                </select>
                                <br />
                            </div>
                            
                            <div class="col-lg-3">                                
                                <label>Период страховой защиты c</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="date_begin" value="<?php echo $dan['contract']['VIPLAT_BEGIN']; ?>" data-mask="99.99.9999">
                                </div>
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="date_end" value="<?php echo $dan['contract']['VIPLAT_END']; ?>" data-mask="99.99.9999">
                                </div>                             
                            </div>
                            <div class="col-lg-3">
                                <label>№ заявления</label>
                                <input type="text" id="zv_num" class="form-control" value="<?php echo $dan['contract']['ZV_NUM']; ?>" readonly/>
                                <label>Дата заявления</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="ZV_DATE" value="<?php echo $dan['contract']['ZV_DATE']; ?>" data-mask="99.99.9999">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>№ договора</label>
                                <input type="text" id="contract_num" class="form-control" value="<?php echo $dan['contract']['CONTRACT_NUM']; ?>" readonly/>
                                
                                <label>Дата договора</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="CONTRACT_DATE" value="<?php echo $dan['contract']['CONTRACT_DATE']; ?>" data-mask="99.99.9999">
                                </div>                                
                            </div>
                            <div class="col-lg-3">                                
                                <label>Тип страхования</label><br />
                                <label>
                                    <input type="radio" name="type_strah[]" value="1" <?php if($dan['contract']['TYPE_STR'] == '1'){ echo 'checked'; } ?> /> Индивидуальный
                                </label><br />
                                <label>
                                    <input type="radio" name="type_strah[]" value="2" <?php if($dan['contract']['TYPE_STR'] == '2'){ echo 'checked'; } ?> /> Групповой
                                </label>                                
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="hr-line-dashed"></div>
                                <label>Агент</label>
                                <select name="id_agent" id="id_agent" class="form-control">
                                    <?php 
                                    if($edit){
                                        echo '<option value="'.$dan['contract']['SICID_AGENT'].'" selected>'.$dan['contract']['AGENT'].'</option>';
                                    }
                                    foreach($dan['AGENT'] as $k=>$v){                                                                                
                                        echo '<option value="'.$v['KOD'].'" data-num="'.$v['CONTRACT_NUM'].'" data-date="'.$v['CONTRACT_DATE_BEGIN'].'">'.$v['NAME'].'</option>';  
                                    }
                                    ?>                                    
                                </select>
                                <div class="agent_dan">
                                    <?php 
                                        if($edit){
                                            echo '<label>Основание:  '.$dan['contract']['DOGOVOR'].'</label>';
                                        }
                                    ?>
                                </div>
                            </div>  
                            
                            <div class="col-lg-12" id="set_group_dan" style="display: none;">
                                <hr />                                
                                <h3>Введите основные данные для расчета</h3>
                                
                                <div class="col-lg-5">
                                    <label>Дополнительное покрытие</label>
                                    <select data-placeholder="Выберите 1 и более дополнительных покрытий" style="width:100%;" multiple class="chosen-select" tabindex="5" id="set_dop_pokr_main">                                
                                        <?php 
                                            foreach($dan['dop_product'] as $k=>$v){
                                                echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';      
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label>Периодность</label>
                                    <select class="form-control" id="set_m_periodich">
                                        <option value="1">Ежегодно</option>
                                        <option value="2">Раз в пол года</option>
                                        <option value="4">Ежеквартально</option>
                                        <option value="12">Ежемесячно</option>                                        
                                        <option value="0">Единовременно</option>                        
                                    </select>
                                </div>
                                <div class="col-lg-3">                        
                                    <label>Срок страхования</label>
                                    <input type="number" class="form-control" id="set_m_srok" readonly/>
                                </div>
                                
                            </div>
                                                      
                            <div class="col-lg-12">
                                <div class="hr-line-dashed"></div>
                                <button class="btn btn-info pull-right nextpage" id="panel0" data="#page1" data-old="#page0">Далее <i class="fa fa-long-arrow-right"></i></button>
                            </div>                            
                        </div>
                        
                        <div id="page1" style="display: none;">
                            <div class="col-lg-12">
                                <center><h1>Список застрахованных лиц</h1></center>
                                <button class="btn btn-info" data-toggle="modal" data-target="#set_client" id="set_client_btn" ><i class="fa fa-plus-square"></i> Выбрать застрахованное лицо</button>
                                <!--
                                <label>
                                    <button class="btn btn-danger" onclick="$('#load_xls').click()">Загрузить файл Microsoft Excel для проверки данных</button>                                    
                                    <input type="file" style="display: none;" id="load_xls" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>                                    
                                </label>
                                <span class="upload_text"></span>
                                <button class="btn btn-warning btn-xs pull-right" id="back_to_add" style="display: none;">Назад к списку</button>
                                -->
                            </div>
                            <div class="col-lg-12" id="prov_div" style="display: none;">
                            
                            </div>
                            <div class="col-lg-12" id="list_clients" style="display: block;">                                
                                <div class="tabs-container">
                                    <div class="tabs-left">
                                        <ul class="nav nav-tabs" id="tabs_users">
                                        <?php                                             
                                            foreach($dan['clients'] as $k=>$v){
                                                $s = '';
                                                if($k == 0){$s = 'active';}
                                                echo '<li class="'.$s.'"><a data-toggle="tab" href="#user_tab_'.$v['ID_ANNUIT'].'">'.$v['FIO_MIN'].'</a></li>';                                                
                                            }                                            
                                        ?>
                                        </ul>
                                        <div class="tab-content" id="body_users">
                                            <?php 
                                            foreach($dan['clients'] as $k=>$v){
                                                $s = '';
                                                if($k == 0){$s = 'active';}
                                            ?>
                                            <div id="user_tab_<?php echo $v['ID_ANNUIT']; ?>" class="tab-pane user_tab_ <?php echo $v['ID_ANNUIT'].' '.$s; ?>">
                                                <div class="panel-body">                    
                                                    <div class="row">                        
                                                        <div class="col-lg-12" style="margin-top: -30px;">
                                                        <button class="btn btn-xs btn-danger pull-right delete_user" id="<?php echo $v['ID_ANNUIT']; ?>"><i class="fa fa-trash"></i></button>
                                                        <div class="form-horizontal">
                                                            <h3>Данные клиента</h3>                                                        
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">ФИО (Дата Рождения)(ИИН)</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="<?php echo $v['ANNUIT'].' ('.$v['IIN'].')'; ?>" readonly="">                                                                                                                                         
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">Возраст</label>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control" value="<?php echo $v['AGE']; ?>" readonly="">                                                                     
                                                                </div>                                                                
                                                            
                                                                <label class="col-lg-1 control-label">Вес</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" value="<?php echo $v['VES']; ?>" readonly="">                                                                     
                                                                </div>
                                                            
                                                                <label class="col-lg-1 control-label">Рост</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" value="<?php echo $v['ROST']; ?>" readonly="">                                                                     
                                                                </div>
                                                            </div>
                                                                                        
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">Агентские расходы</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="<?php echo $v['AGENT_TARIF']; ?>" readonly="">                                                                     
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">Периодичность</label>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control" value="<?php echo $v['PERIODICH']; ?>" readonly="">                                                                     
                                                                </div>
                                                                
                                                                <label class="col-lg-3 control-label">Срок страхования</label>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control" value="<?php echo $v['SROK_STRAH']; ?>" readonly="">                                                                     
                                                                </div>
                                                            </div>
                                                            <div class="form-group">                                                                
                                                                <label class="col-lg-3 control-label">Годовой доход</label>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control" value="<?php echo $v['GOD_DOHOD']; ?>" readonly="">                                                                     
                                                                </div>
                                                            
                                                                <label class="col-lg-3 control-label">Страховая сумма</label>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control" value="<?php echo $v['STR_SUM']; ?>" readonly="">                                                                     
                                                                </div>
                                                            </div>
                                                            <?php                                                                 
                                                                if(count($v['NAGRUZ']) > 0){                                                                                                                                    
                                                            ?>
                                                            <hr>
                                                            <h3>Нагрузки</h3>
                                                            <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Тип</th>
                                                                    <th>Наименование</th>                        
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($v['NAGRUZ_TABLE'] as $t=>$r){
                                                                    echo '<tr>
                                                                    <td>'.$r['NAME_TYPE'].'</td>
                                                                    <td>'.$r['NAIMEN'].'</td>
                                                                </tr>';    
                                                                } 
                                                                ?>
                                                            </tbody>
                                                            </table>
                                                            <?php } ?>
                                                            <hr>
                                                            
                                                            <h3>Расчетные данные</h3>
                                                            <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Тип</th>
                                                                    <th>Наименование</th>
                                                                    <th>Тариф</th>
                                                                    <th>Нагрузка</th>
                                                                    <th>Страховая выплата</th>                                                                                
                                                                    <th>Страховая премия</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $TARIF = 0;
                                                                    $NAGRUZ = 0;
                                                                    $PAY_SUM_V = 0;
                                                                    $PAY_SUM_P = 0;
                                                                    foreach($v['CALC'] as $t=>$r){
                                                                        echo '
                                                                        <tr>
                                                                            <td>'.$r['NAME_TYPE_POKR'].'</td>
                                                                            <td>'.$r['NAME_POKR'].'</td>
                                                                            <td>'.$r['TARIF'].'</td>
                                                                            <td>'.$r['NAGRUZ'].'</td>
                                                                            <td>'.$r['PAY_SUM_V'].'</td>
                                                                            <td>'.$r['PAY_SUM_P'].'</td>
                                                                        </tr>
                                                                        ';
                                                                        $TARIF += $r['TARIF'];
                                                                        $NAGRUZ += $r['NAGRUZ'];
                                                                        $PAY_SUM_V += $r['PAY_SUM_V'];
                                                                        $PAY_SUM_P += $r['PAY_SUM_P'];
                                                                    }
                                                                    echo '
                                                                    <tr>
                                                                        <td colspan="2"><b>Итого: </b></td>                    
                                                                        <td><b>'.$TARIF.'</b></td>
                                                                        <td><b>'.$NAGRUZ.'</b></td>
                                                                        <td><b>'.$PAY_SUM_V.'</b></td>
                                                                        <td><b>'.$PAY_SUM_P.'</b></td>
                                                                    </tr>';
                                                                ?>                                                                                                                                                                                               
                                                            </tbody></table>
                                                            <?php 
                                                                if(count($v['obtain']) > 0){
                                                                                                                                    
                                                            ?>
                                                            <hr><h3>Выгодопреобретатели</h3>
                                                            <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Фамилия Имя Отчество</th>
                                                                    <th>Процент(%)</th>                        
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    foreach($v['obtain'] as $t=>$r){
                                                                        echo '<tr>
                                                                            <td>'.$r['LASTNAME'].' '.$r['FIRSTNAME'].' '.$r['MIDDLENAME'].'</td>
                                                                            <td>'.$r['V_PERS'].'</td>                        
                                                                        </tr>';
                                                                    }
                                                                ?>                                                                
                                                            </tbody>
                                                            </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-warning pull-left nextpage" data="#page0" data-old="#page1"><i class="fa fa-long-arrow-left"></i> Назад</button>
                                <button class="btn btn-info pull-right nextpage panel_save" id="panel11" data="#page2" data-old="#page1">Далее <i class="fa fa-long-arrow-right"></i></button>
                            </div>
                        </div>
                        
                        <div id="page2" style="display: none;">
                            <div class="col-lg-12">
                                <form method="post" class="form-horizontal" id="form_result">
                                    <h3>Банковские данные</h3>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Наименование банка</label>
                                        <div class="col-lg-9">
                                            <select name="bank_id" class="form-control">
                                                <option value="0">Не выбран</option>
                                                <?php 
                                                    if($edit){
                                                        echo '<option value="'.$dan['contract']['BANK_ID'].'" data="'.$dan['contract']['BANK_CHET'].'" selected>'.$dan['contract']['BANK_NAME'].'</option>';
                                                    }
                                                    foreach($dan['banks'] as $k=>$v){
                                                        echo '<option value="'.$v['KOD'].'" data="'.$v['SCHET'].'">'.$v['NAME'].'</option>';
                                                    }
                                                ?>                                                
                                            </select>                                                                                                                                         
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Тип счета</label>
                                        <div class="col-lg-9">
                                            <select name="bank_type_schet" class="form-control">
                                                <option value="0" <?php if($dan['contract']['BANK_TYPE_CHET'] == 0){echo 'selected';} ?>>Не выбран</option>
                                                <option value="1" <?php if($dan['contract']['BANK_TYPE_CHET'] == 1){echo 'selected';} ?>>Лицевой</option>
                                                <option value="2" <?php if($dan['contract']['BANK_TYPE_CHET'] == 2){echo 'selected';} ?>>Карточный</option>
                                                <option value="3" <?php if($dan['contract']['BANK_TYPE_CHET'] == 3){echo 'selected';} ?>>Транзитный</option>
                                                <option value="4" <?php if($dan['contract']['BANK_TYPE_CHET'] == 4){echo 'selected';} ?>>Депозитный</option>                                                                                                                                               
                                            </select>                                                                                                                                         
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Номер счета</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="bank_schet" value="<?php echo $dan['contract']['BANK_CHET']; ?>"/>                                                                                                                                                                                     
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">ИИК</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="bank_iik" value="<?php echo $dan['contract']['BANK_IIK']; ?>"/>                                                                                                                                                                                     
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Наличие льгот по налогооблажению</label>
                                        <div class="col-lg-9">
                                            <select name="bank_lgot" class="form-control">                                                
                                                <option value="1" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '1'){ echo 'selected';} ?>>Не имеет льгот</option>
                                                <option value="2" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '2'){ echo 'selected';} ?>>Инвалид I группы</option>
                                                <option value="3" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '3'){ echo 'selected';} ?>>Инвалид II группы</option>
                                                <option value="4" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '4'){ echo 'selected';} ?>>Инвалид III группы</option>                                                                                                                                               
                                                <option value="5" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '5'){ echo 'selected';} ?>>Инвалид с детства</option>
                                                <option value="6" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '6'){ echo 'selected';} ?>>Один из родителей инвалида с детства</option>
                                                <option value="7" <?php if(substr($dan['contract']['BANK_LGOT'], 0, 1) == '7'){ echo 'selected';} ?>>Участник ВОВ и лица приравненные к ним</option>
                                            </select>                                                                                                                                         
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Срок действия льгот с</label>
                                        <div class="col-lg-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" name="bank_date_lgot_begin" value="<?php echo $dan['contract']['BANK_LGOT_SROK_S']; ?>" data-mask="99.99.9999">
                                            </div>
                                        </div>
                                        <label class="col-lg-3 control-label">по</label>
                                        <div class="col-lg-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" name="bank_date_lgot_end" value="<?php echo $dan['contract']['BANK_LGOT_SROK_PO']; ?>" data-mask="99.99.9999">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Действует до </label>
                                        <div class="col-lg-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" name="bank_date_do" value="<?php echo $dan['contract']['KART_DEISTVIE']; ?>" data-mask="99.99.9999">
                                            </div>
                                        </div>
                                        <label class="col-lg-3 control-label">Номер справки</label>
                                        <div class="col-lg-3">                                            
                                            <input type="text" class="form-control" name="bank_num_sprav" value="<?php echo $dan['contract']['BANK_NUM_SPR']; ?>">                                            
                                        </div>
                                    </div>
                                    
                                    <div id="list_users_json" style="display: none;">    
                                    <?php 
                                        if($edit){
                                            echo '
                                            <input type="hidden" name="icnct" value="'.$dan['contract']['CNCT_ID'].'"/>
                                            <input type="hidden" name="id_head" value="'.$dan['contract']['ID_HEAD'].'"/>
                                            <input type="hidden" name="id_insur" value="'.$dan['contract']['ID_STRAHOVATEL'].'"/>
                                            <input type="hidden" name="type_insur" value="'.$dan['contract']['TYPE_STRAHOVATEL'].'"/>
                                            <input type="hidden" name="id_agent" value="'.$dan['contract']['SICID_AGENT'].'"/>
                                            <input type="hidden" name="date_begin" value="'.$dan['contract']['DATE_BEGIN_FIRST'].'"/>
                                            <input type="hidden" name="date_end" value="'.$dan['contract']['DATE_END_FIRST'].'"/>
                                            <input type="hidden" name="contract_num" value="'.$dan['contract']['CONTRACT_NUM'].'"/>
                                            <input type="hidden" name="zv_num" value="'.$dan['contract']['ZV_NUM'].'"/>
                                            <input type="hidden" name="contract_date" value="'.$dan['contract']['CONTRACT_DATE'].'"/>
                                            <input type="hidden" name="zv_date" value="'.$dan['contract']['ZV_DATE'].'"/>
                                            <input type="hidden" name="type_strah" value="'.$dan['contract']['TYPE_STR'].'"/>';
                                            
                                            $AGENT_TARIF = 15;
                                            if($v['AGENT_TARIF'] == '25% - Базовый'){$AGENT_TARIF = 25;}
                                            if($v['AGENT_TARIF'] == '50% - Максимальный'){$AGENT_TARIF = 50;}
                                            
                                            foreach($dan['clients'] as $k=>$v){
                                                $ds = array(
                                                    "sicid"=>$v['ID_ANNUIT'],
                                                    "age"=>$v['AGE'],
                                                    "ves"=>$v['VES'],
                                                    "rost"=>$v['ROST'],
                                                    "rashod" =>$AGENT_TARIF,
                                                    "periodich" =>$v['PERIODICH'],                                                    
                                                    "srok" =>$v['SROK_STRAH'],
                                                    "year_dohod" =>$v['GOD_DOHOD'],
                                                    "str_sum" =>$v['STR_SUM'],
                                                    "main_pokr" =>$v['OSN_POKRITIE']
                                                );
                                                
                                                foreach($v['CALC'] as $t=>$c){
                                                    if($c['TYPE_POKR'] !== '0'){
                                                        $ds["dop_pokr"][] = $c['ID_POKR'];
                                                    }
                                                }
                                                
                                                $ds["dat_calc"] = $v['REGDATE'];
                                                
                                                
                                                $zabolevaniya = array();
                                                $professiya = array();
                                                $sport = array();
                                                
                                                foreach($v['NAGRUZ'] as $i=>$n){
                                                    if(trim($n['ID_ZABOLEV']) !== ''){$zabolevaniya[] = $n['ID_ZABOLEV'];}
                                                    if(trim($n['ID_PROFES']) !== ''){$professiya[] = $n['ID_PROFES'];}
                                                    if(trim($n['ID_SPORT']) !== ''){$sport[] = $n['ID_SPORT'];}
                                                }
                                                
                                                $ds["risks"] = array(
                                                        "zabolevaniya"=>$zabolevaniya,
                                                        "professiya"=>$professiya,
                                                        "sport"=>$sport,
                                                        "country"=>$v['ID_CITY'],
                                                        "country_uslov"=>$v['USL_PROG']
                                                );
                                                
                                                foreach($v['CALC'] as $i=>$c){
                                                    $ds["raschet"][] = array(
                                                        "ID_TYPE"   => $c['TYPE_POKR'],
                                                        "ID_POKR"   => $c['ID_POKR'],
                                                        "TYPE_NAME" => $c['NAME_TYPE_POKR'],
                                                        "NAME"      => $c['NAME_POKR'],
                                                        "TARIF"     => $c['TARIF'],
                                                        "NAGRUZ"    => $c['NAGRUZ'],
                                                        "PAY_SUM_V" => $c['PAY_SUM_V'],
                                                        "PAY_SUM_P" => $c['PAY_SUM_P'],
                                                        "ERROR"     => ''
                                                    );
                                                }
                                                
                                                    
                                                $ds["pay_sum_v"] = $v['STR_SUM'];
                                                $ds["pay_sum_p"] = $v['PAY_SUM_P'];
                                                
                                                foreach($v['obtain'] as $i=>$o){                                                    
                                                    $ds["poluchatel"][$o['SICID']] = $o['V_PERS'];
                                                }
                                                
                                                
                                                echo '<textarea name="list_users[]" id="client_'.$v['ID_ANNUIT'].'">'.json_encode($ds).'</textarea>';   
                                            }                                            
                                        }else{
                                    ?>                                    
                                        <input type="hidden" name="icnct" value="0"/>
                                        <input type="hidden" name="id_head" value="0"/>
                                        <input type="hidden" name="id_insur" value=""/>
                                        <input type="hidden" name="type_insur" value=""/>
                                        <input type="hidden" name="id_agent" value=""/>
                                        <input type="hidden" name="date_begin" value=""/>
                                        <input type="hidden" name="date_end" value=""/>
                                        <input type="hidden" name="contract_num" value=""/>
                                        <input type="hidden" name="zv_num" value=""/>
                                        <input type="hidden" name="contract_date" value=""/>
                                        <input type="hidden" name="zv_date" value=""/>
                                        <input type="hidden" name="type_strah" value=""/>
                                    <?php } ?>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-warning pull-left nextpage" data="#page1" data-old="#page2"><i class="fa fa-long-arrow-left"></i> Назад</button>
                                <?php 
                                if(!isset($dan['contract'])){
                                ?>
                                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#print_zav" id="print_zav_btn">Печать заявления<i class="fa fa-print"></i></button>
                                <?php } ?>
                                <button class="btn btn-info pull-right" id="save">Сохранить <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                                                                  
                    </div>                                   
                </div>
            </div>
        
        </div>        
    </div>
</div>

<style>
#search_result{
    max-height: 200px;
    overflow: auto;
}
</style>                        

<div class="modal inmodal fade" id="print_zav" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Печать заявления</h4>                
            </div>
            <div class="modal-body" id="print_zav_body">
                
            </div>
        </div>
    </div>
</div>    


<div class="modal inmodal fade" id="set_client" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить клиента</h4>
                <small class="font-bold">Добавление клиента в договор</small>
            </div>
            <div class="modal-body">
                <div class="search_input">
                    <label>Найти клиента по ФИО или ИИН</label>
                    <div class="input-group m-b">
                        <span class="input-group-btn">
                            <a href="clients?edit=0" class="btn btn-success" target="_blank">Создать</a>                            
                        </span>
                        <input type="text" class="form-control" id="search_fiz_client" value=""/>                        
                        <span class="input-group-btn">
                            <button id="btn_search_fiz" class="btn btn-primary">Найти</button> 
                        </span>                                
                    </div>
                    <div class="search_input_result"></div>
                </div>
                
                <div class="search_user_dan" style="display: none;">
                    <form method="post" id="m_form">
                    <input type="hidden" id="date_calc" name="m_date_calc" value=""/>
                    <input type="hidden" id="type_str" name="m_type_str" value=""/>
                    <input type="hidden" id="m_sicid" value="0" name="m_sicid"/>                    
                    <input type="hidden" id="m_date_begin" value="" name="m_date_begin"/>
                    <input type="hidden" id="m_date_end" value="" name="m_date_end"/>                    
                    <label>Фамилия Имя Отчество и Дата Рождения застрахованного лица</label>
                    <input type="text" id="m_fio" name="m_fio" class="form-control" readonly/>    
                    <hr />                                                        
                    <div class="row">
                        <div class="col-lg-3">                        
                            <label>Агентские расходы (%)</label>
                            <input type="number" class="form-control" min="0" max="90" id="m_rashod" name="m_rashod" value="0"/>                            
                        </div>
                        <div class="col-lg-3">
                            <label>Рост</label>
                            <input type="number" class="form-control" id="m_rost" name="m_rost"/>
                        </div>
                        <div class="col-lg-3">
                            <label>Вес</label>
                            <input type="number" class="form-control" id="m_ves" name="m_ves"/>
                        </div>
                        <div class="col-lg-3">
                            <label>Возраст</label>
                            <input type="number" class="form-control" id="m_vozrast" name="m_vozrast"/>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Основное покрытие</label>
                            <select class="form-control" id="m_main_pokr" name="m_main_pokr">
                                <?php 
                                    foreach($dan['osn_product'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';      
                                    }
                                ?>                                
                            </select>                                                        
                        </div>
                        <div class="col-lg-12">
                            <label>Дополнительное покрытие</label>
                            <select data-placeholder="Выберите 1 и более дополнительных покрытий" style="width:100%;" multiple class="chosen-select" tabindex="5" id="m_dop_pokr" name="m_dop_pokr[]">                                
                                <?php 
                                    foreach($dan['dop_product'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';      
                                    }
                                ?>
                            </select>
                        </div>                                                
                    </div>                    
                    <hr />
                    <div class="row">
                        <!--<center><h3>Расчет</h3></center>-->
                        <div class="col-lg-4">
                            <label>Периодность</label>
                            <select class="form-control" id="m_periodich" name="m_periodich">
                                <option value="1">Ежегодно</option>
                                <option value="2">Раз в пол года</option>
                                <option value="4">Ежеквартально</option>
                                <option value="12">Ежемесячно</option>
                                <option value="0">Единовременно</option>                        
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Годовой доход</label>
                            <input type="number" class="form-control" id="m_dohod" name="m_dohod"/>                                                        
                        </div>                        
                        <div class="col-lg-4">                        
                            <label>Срок страхования</label>
                            <input type="number" class="form-control" id="m_srok" name="m_srok"/>
                        </div>
                        
                        <div class="col-lg-6">
                            <label>Страховая сумма</label>
                            <input type="number" class="form-control" id="m_pay_sum_v" name="m_pay_sum_v"/>                                                        
                        </div>
                        <div class="col-lg-6">
                            <label>Страховая премия/взнос</label>
                            <input type="number" class="form-control" id="m_pay_sum_p" name="m_pay_sum_p"/>                                                        
                        </div>
                    </div>                                                                                                       
                    <hr />                    
                    <div class="ibox float-e-margins border-bottom">
                        <div class="ibox-title">                            
                            <div class="ibox-tools">                                
                                <a class="collapse-link" id="collapse-link">                                    
                                    <h5 style="color: black;">Риски и надбавки</h5>
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="ibox-content" style="display: none;">
                            <label>Заболевания</label>
                            <select data-placeholder="Выберите 1 и более заболевание" style="width:100%;" multiple class="chosen-select" tabindex="1" id="m_zabolevaniya" name="m_zabolevaniya[]">
                                <option value="0">Не выбрано</option>
                                <?php 
                                    foreach($dan['spr_zab'] as $k=>$v){;
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>                                
                            </select>
                            <label>Профессии</label>
                            <select data-placeholder="Выберите 1 и более профессий" style="width:100%;" multiple class="chosen-select" tabindex="2" id="m_professiya" name="m_professiya[]">
                                <option value="0">Не выбрано</option>
                                <?php 
                                    foreach($dan['spr_prof'] as $k=>$v){;
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>
                            </select>
                            <label>Спорт</label>
                            <select data-placeholder="Выберите 1 и более занятия спортом" style="width:100%;" multiple class="chosen-select" tabindex="3" id="m_sport" name="m_sport[]">
                                <option value="0">Не выбрано</option>
                                <?php 
                                    foreach($dan['spr_sport'] as $k=>$v){;
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>
                            </select>
                            
                            <hr />
                            <h3>Страна пребывания</h3>
                            <label>Выберите страну</label>
                            <select class="form-control" id="m_country" name="m_country">                                
                                <option value="0">Не выбрано</option>
                                <?php 
                                    foreach($dan['spr_city'] as $k=>$v){;
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>
                            </select>
                            <label>Условия проживания</label>
                            <select class="form-control" id="m_country_uslov" name="m_country_uslov">  
                                <option value="0">Не выбрано</option>
                                <option value="1">A  - <= 12 месяцев</option>
                                <option value="2">A  - >  12 месяцев</option>
                                <option value="3">B1 - <= 12 месяцев</option>
                                <option value="4">B2 - >  12 месяцев</option>
                                <option value="5">C1 - <= 12 месяцев</option>
                                <option value="6">C3 - >  12 месяцев</option>   
                            </select>
                        </div>
                    </div>
                    
                    <hr />                    
                    <div class="ibox float-e-margins border-bottom">
                        <div class="ibox-title">                            
                            <div class="ibox-tools">
                                <a class="collapse-link" id="collapse-link">
                                    <h5 style="color: black;">Выгодоприобретатели</h5>
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="ibox-content" style="display: none;">
                            <div class="search_input_vigoda">
                                <label>Найти клиента по ФИО или ИИН</label>
                                <div class="input-group m-b">
                                    <span class="input-group-btn">
                                        <a href="clients?edit=0" class="btn btn-success" target="_blank">Создать</a>                            
                                    </span>
                                    <input type="text" class="form-control" id="search_vigoda_client" value="">                        
                                    <span class="input-group-btn">
                                        <span id="btn_search_vigoda" class="btn btn-primary">Найти</span> 
                                    </span>                                
                                </div>
                                <div class="search_input_result_vogoda"></div>
                            </div>
                            <div class="row">
                                <div class="list_clients_vigoda">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>                                
            </div>
            <div class="modal-footer">
                <button type="button" id="add" class="btn btn-primary" data-dismiss="modal">Добавить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>
<pre>
<?php 
    print_r($dan);
?>
</pre>

<style>
.excel_table td{
    background-color: #fff;
}
.excel_table td:hover{
    background-color: #E2E2E2;
}
.set{
    cursor: pointer;
}

.set:hover{
    color: #0080FF;
}

.chosen-container-single{
    width: 100%;    
}

.search_input_result{
    max-height: 300px;
    overflow: auto;
}

.search_input_result_vogoda{
    max-height: 300px;
    overflow: auto;
}
</style>
<script src="styles/js/demo/contracts_hranitel.js"></script>
