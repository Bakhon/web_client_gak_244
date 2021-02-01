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
                        <div id="search_result_strahovatel">
                        <?php 
                                if($edit){
                                    echo '<label>Страхователь</label>
                                <h3>'.$dan['contract']['STRAHOVATEL'].'</h3>
                                <input type="hidden" name="id_client" value="'.$dan['contract']['ID_STRAHOVATEL'].'">
                                <input type="hidden" name="type_client" value="'.$dan['contract']['TYPE_STRAHOVATEL'].'">';                            
                                }
                            ?>
                        </div>
                        
                        <div class="col-lg-12" id="search_panel">
                            <?php 
                                if(!$edit){
                            ?>
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
                            <?php } ?>                                                        
                            <div class="list-group table-of-contents" id="search_result">
                                                                                    
                            </div>
                            <div class="hr-line-dashed"></div>                                                                                 
                        </div>
                        
                        
                        <!-- Главная панель ввода данных -->
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
                                    <input type="text" class="form-control" name="date_begin" id="date_begin" value="<?php echo $dan['contract']['VIPLAT_BEGIN']; ?>" data-mask="99.99.9999">
                                </div>
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="date_end" id="date_end" value="<?php echo $dan['contract']['VIPLAT_END']; ?>" data-mask="99.99.9999">
                                </div>                             
                            </div>
                            <div class="col-lg-3">
                                <label>№ заявления</label>
                                <input type="text" name="zv_num" id="zv_num" class="form-control" value="<?php echo $dan['contract']['ZV_NUM']; ?>" readonly/>
                                
                                <label>Дата заявления</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="ZV_DATE" id="ZV_DATE" value="<?php echo $dan['contract']['ZV_DATE']; ?>" data-mask="99.99.9999">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>№ договора</label>
                                <input type="text" id="contract_num" class="form-control" value="<?php echo $dan['contract']['NUM_DOG']; ?>" readonly/>
                                
                                <label>Дата договора</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="CONTRACT_DATE" value="<?php echo $dan['contract']['DATE_DOG']; ?>" data-mask="99.99.9999">
                                </div>                                
                            </div>
                            <div class="col-lg-3">
                                <?php 
                                    $sch = array("1"=>"checked", "2"=>"");
                                    if(isset($dan['contract']['TYPE_STR'])){
                                        if($dan['contract']['TYPE_STR'] == '2'){
                                            $sch = array("1"=>"", "2"=>"checked");
                                        }
                                    }
                                ?>                                
                                <label>Тип страхования</label><br />
                                <label>
                                    <input type="radio" name="type_strah[]" value="1" <?php echo $sch[1]; ?> /> Индивидуальный
                                </label><br />
                                <label>
                                    <input type="radio" name="type_strah[]" value="2" <?php echo $sch[2]; ?> /> Групповой
                                </label>                                
                            </div>
                            
                            <div class="col-lg-12">
                                <br />
                                <div class="hr-line-dashed"></div>
                            </div>    
                                                        
                            <div class="col-lg-8">
                                
                                <label>Агент</label>
                                <select name="id_agent_select" id="id_agent_select" class="form-control">
                                    <option value="1620" selected>БЕЗ АГЕНТА</option>
                                    <?php                                     
                                    //if($edit){echo '<option value="'.$dan['contract']['SICID_AGENT'].'" selected>'.$dan['contract']['AGENT'].'</option>';}
                                    $label = '';
                                    foreach($dan['AGENT'] as $k=>$v){
                                        $s = '';
                                        if($edit){
                                            if($v['KOD'] == $dan['contract']['SICID_AGENT']){
                                                $s = 'selected';
                                                $label = '<br /><label>Основание: Договор № '.$v['CONTRACT_NUM'].' от '.$v['CONTRACT_DATE_BEGIN'].' г.</label>';
                                            }
                                        }
                                        echo '<option value="'.$v['KOD'].'" data-num="'.$v['CONTRACT_NUM'].'" data-date="'.$v['CONTRACT_DATE_BEGIN'].'" '.$s.'>'.$v['NAME'].'</option>';  
                                    }
                                    ?>                                    
                                </select>
                                <div class="agent_dan">
                                    <?php 
                                        if($edit){
                                            echo $label;
                                        }
                                    ?>
                                </div>
                            </div>  
                            
                            <div class="col-lg-4">                                
                                <label>Агентские расходы (%)</label>
                                <?php 
                                    $AGENT_TARIF = 0;
                                    if($edit){
                                        $AGENT_TARIF = $dan['clients'][0]['RASHOD_AGENT'];
                                    }                               
                                ?>
                                <input type="number" class="form-control" min="0" max="90" id="m_rashod" name="m_rashod" value="<?php echo $AGENT_TARIF; ?>"/>
                            </div>
                                                        
                            <div class="col-lg-12">
                                <br />
                                <div class="hr-line-dashed"></div>
                                <h3>Введите основные данные для расчета</h3>
                            </div>  
                            
                            <?php 
                                $per = array();
                                $per[0] = '';
                                $per[1] = '';
                                $per[2] = '';
                                $per[3] = '';
                                $per[4] = '';
                                if($edit){
                                    if($dan['contract']['PERIOD_VIPLAT'] == 'Единовременно'){
                                        $per[0] = 'selected';
                                    }
                                    if($dan['contract']['PERIOD_VIPLAT'] == 'Ежегодно'){
                                        $per[1] = 'selected';
                                    }
                                    if($dan['contract']['PERIOD_VIPLAT'] == 'Раз в пол года'){
                                        $per[2] = 'selected';
                                    }
                                    if($dan['contract']['PERIOD_VIPLAT'] == 'Ежеквартально'){
                                        $per[3] = 'selected';
                                    }
                                    if($dan['contract']['PERIOD_VIPLAT'] == 'Ежемесячно'){
                                        $per[4] = 'selected';
                                    }
                                }
                            ?>
                            
                            <div class="col-lg-4">
                                <label>Периодность</label>
                                <select class="form-control" id="set_m_periodich">
                                    <option value="0" <?php echo $per[0]; ?>>Единовременно</option>
                                    <option value="1" <?php echo $per[1]; ?>>Ежегодно</option>
                                    <option value="2" <?php echo $per[2]; ?>>Раз в пол года</option>
                                    <option value="4" <?php echo $per[3]; ?>>Ежеквартально</option>
                                    <option value="12" <?php echo $per[4]; ?>>Ежемесячно</option>                                                                                
                                </select>
                                
                                <label>Срок страхования</label>
                                <input type="number" class="form-control" id="set_m_srok" value="<?php echo $dan['contract']['SROK_INS']; ?>" />
                            </div>
                            
                            <div class="col-lg-8">
                                <label>Основное покрытие</label>                                                                
                                <select class="form-control" id="set_main_pokr" name="set_main_pokr">
                                <?php 
                                    $tts = array();
                                    if($edit){
                                        foreach($dan['clients'][0]['CALC'] as $ds){
                                            if($ds['TYPE_POKR'] == 0){
                                                $tts[] = $ds['ID_POKR'];
                                            }
                                        }
                                    }
                                    
                                    foreach($dan['osn_product'] as $k=>$v){
                                        $s = '';
                                        foreach($tts as $ts){
                                            if($v['ID'] == $ts){
                                                $s = 'selected';
                                            }
                                        }
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';      
                                    }
                                ?>                                
                                </select>
                                    
                                <label>Дополнительное покрытие</label>
                                <select data-placeholder="Выберите 1 и более дополнительных покрытий" style="width:100%;" multiple class="chosen-select" tabindex="5" id="set_dop_pokr_main">                                
                                <?php 
                                    $tts = array();
                                    if($edit){
                                        foreach($dan['pokritiya'] as $k=>$ds){                                            
                                            $tts[] = $ds['ID_POKR'];
                                        }
                                    }
                                                                        
                                    foreach($dan['dop_product'] as $k=>$v){
                                        $s = '';
                                        foreach($tts as $ts){
                                            if($v['ID'] == $ts){
                                                $s = 'selected';
                                            }
                                        }
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';      
                                    }
                                ?>
                                </select>
                            </div>
                            
                            
                                         
                            <div class="col-lg-12">
                                <br />
                                <div class="hr-line-dashed"></div>
                                <button class="btn btn-info pull-right nextpage" id="panel0" data="#page1" data-old="#page0">Далее <i class="fa fa-long-arrow-right"></i></button>
                            </div>                            
                        </div>
                        <!-- Конец Главной панели -->
                        
                        
                        <!-- панель ввода данных клиентов-->                        
                        <div id="page1" style="display: none;">
                            <div class="col-lg-12">
                                <center><h1>Список застрахованных лиц</h1></center>
                                <?php 
                                if($edit){
                                    echo ALERTS::InfoMin("<b>Обратите внимание!</b> При редактировании и сохранении данных договора, будет произведен перерасчет без учета нагрузок");
                                }
                                ?>
                                
                                <button class="btn btn-info" data-toggle="modal" data-target="#set_client" id="set_client_btn" ><i class="fa fa-plus-square"></i> Выбрать застрахованное лицо</button>
                                <?php 
                                    if($edit){
                                        echo '<button class="btn btn-info" id="recalc_all" data="'.$dan['contract']['CNCT_ID'].'"><i class="fa fa-calculator"></i> Пересчитать всех</button>';
                                    }
                                ?>                                <!--
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
                                    <div class="tabs-left col-lg-3" style="overflow: auto;max-height: 500px;min-height: 450px;">
                                        <ul class="nav nav-tabs" id="tabs_users" style="width: 100%;">
                                        <?php                                             
                                            foreach($dan['clients'] as $k=>$v){
                                                $s = '';
                                                if($k == 0){$s = 'active';}
                                                echo '<li class="'.$s.'"><a data-toggle="tab" id="client_'.$v['ID_ANNUIT'].'" href="#user_tab_'.$v['ID_ANNUIT'].'">'.$v['FIO_MIN'].'</a></li>';                                                
                                            }                                            
                                        ?>
                                        </ul>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="tab-content" id="body_users">                                            
                                            <?php                                            
                                            foreach($dan['clients'] as $k=>$v){
                                                $s = '';
                                                if($k == 0){$s = 'active';}                                                                                                                                       
                                            ?>
                                            <div id="user_tab_<?php echo $v['ID_ANNUIT']; ?>" class="tab-pane user_tab_<?php echo $v['ID_ANNUIT'].' '.$s; ?>">
                                                <div class="panel-body">                                                                        
                                                    <div class="row">                        
                                                        <div class="col-lg-12" style="margin-top: -30px;">                                                        
                                                        <button class="btn btn-xs btn-danger pull-right delete_user" id="<?php echo $v['ID_ANNUIT']; ?>"><i class="fa fa-trash"></i></button>                                                        
                                                        <button style="margin-right: 10px;" data-toggle="modal" data-target="#set_client" class="btn btn-xs btn-warning pull-right edit_user" id="<?php echo $v['ID_ANNUIT']; ?>"><i class="fa fa-edit"></i></button>
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
                                                                        <th>Вид нагрузки</th>       
                                                                        <th>Наименование</th>                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>                                                                                                                                            
                                                                        <?php 
                                                                            foreach($v['NAGRUZ_TABLE'] as $t=>$r){
                                                                                $name = '';
                                                                                foreach($dan['DIC_SPR'] as $d=>$t){
                                                                                    if($t['ID'] == $r['ID_TYPE']){
                                                                                        $name = $t['NAME'];
                                                                                    }
                                                                                }
                                                                                echo '
                                                                                <tr>
                                                                                <td>'.$name.'</td>
                                                                                <td>'.$r['NAME'].'</td>
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
                                                                            <td>'.StrToFloat($r['BRUTTO_TARIF_R']).'</td>
                                                                            <td>'.StrToFloat($r['NAGRUZ']).'</td>                                                                            
                                                                            <td>'.StrToFloat($r['BRUTTO_P_R']).'</td>
                                                                        </tr>
                                                                        ';
                                                                        $TARIF += $r['TARIF'];
                                                                        $NAGRUZ += $r['NAGRUZ'];                                                                        
                                                                        $PAY_SUM_P += $r['BRUTTO_P_R'];
                                                                    }
                                                                    echo '
                                                                    <tr>
                                                                        <td colspan="2"><b>Итого: </b></td>                    
                                                                        <td><b>'.$TARIF.'</b></td>
                                                                        <td><b>'.$NAGRUZ.'</b></td>                                                                        
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
                                                    //if($edit){echo '<option value="'.$dan['contract']['BANK_ID'].'" data="'.$dan['contract']['BANK_CHET'].'" selected>'.$dan['contract']['BANK_NAME'].'</option>';}
                                                    foreach($dan['banks'] as $k=>$v){
                                                        $s = '';
                                                        if($edit){
                                                            if($v['KOD'] == $dan['contract']['BANK_ID']){
                                                                $s = 'selected';
                                                            }
                                                        }
                                                        echo '<option value="'.$v['KOD'].'" data="'.$v['SCHET'].'" '.$s.'>'.$v['NAME'].'</option>';
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
                                            <input type="hidden" name="agent_procent" value="'.$AGENT_TARIF.'"/>
                                            <input type="hidden" name="date_begin" value="'.$dan['contract']['DATE_BEGIN_FIRST'].'"/>
                                            <input type="hidden" name="date_end" value="'.$dan['contract']['DATE_END_FIRST'].'"/>
                                            <input type="hidden" name="contract_num" value="'.$dan['contract']['CONTRACT_NUM'].'"/>
                                            <input type="hidden" name="zv_num" value="'.$dan['contract']['ZV_NUM'].'"/>
                                            <input type="hidden" name="contract_date" value="'.$dan['contract']['CONTRACT_DATE'].'"/>
                                            <input type="hidden" name="zv_date" value="'.$dan['contract']['ZV_DATE'].'"/>
                                            <input type="hidden" name="type_strah" value="'.$dan['contract']['TYPE_STR'].'"/>
                                            <input type="hidden" name="periodich" value="'.$dan['contract']['PV_KOD'].'"/>
                                            <input type="hidden" name="srok_strah" value="'.$dan['contract']['SROK_INS'].'"/>                                            
                                            <input type="hidden" name="branch_id" value="'.$dan['contract']['BRANCH_ID'].'"/>
                                            ';
                                                                                        
                                            foreach($dan['clients_list'] as $k=>$v){
                                                echo '<input type="hidden" name="list_users['.$k.']" id="client_'.$k.'" value="'.$v.'" />';
                                            }                                            
                                        }else{
                                    ?>                                    
                                        <input type="hidden" name="icnct" value="0"/>
                                        <input type="hidden" name="id_head" value="0"/>
                                        <input type="hidden" name="id_insur" value=""/>
                                        <input type="hidden" name="type_insur" value=""/>
                                        <input type="hidden" name="id_agent" value="1620"/>
                                        <input type="hidden" name="agent_procent" value="0"/>
                                        <input type="hidden" name="date_begin" value=""/>
                                        <input type="hidden" name="date_end" value=""/>
                                        <input type="hidden" name="contract_num" value=""/>
                                        <input type="hidden" name="zv_num" value=""/>
                                        <input type="hidden" name="contract_date" value=""/>
                                        <input type="hidden" name="zv_date" value=""/>
                                        <input type="hidden" name="type_strah" value=""/>
                                        <input type="hidden" name="periodich" value="0"/>
                                        <input type="hidden" name="srok_strah" value="0"/>
                                        <input type="hidden" name="branch_id" value="0"/>
                                    <?php } ?>
                                        <input type="hidden" name="save" value=""/>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-warning pull-left nextpage" data="#page1" data-old="#page2"><i class="fa fa-long-arrow-left"></i> Назад</button>
                                <?php 
                                    //if(!isset($dan['contract'])){
                                    //    echo '<button class="btn btn-success pull-right" data-toggle="modal" data-target="#print_zav" id="print_zav_btn">Печать заявления<i class="fa fa-print"></i></button>';
                                    //} 
                                ?>
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

<!-- Модальное окно по добавлению клиентов-->
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
                        <input type="hidden" id="date_calc"     name="m_date_calc"  value=""/>
                        <input type="hidden" id="type_str"      name="m_type_str"   value=""/>
                        <input type="hidden" id="m_sicid"       name="m_sicid"      value="0"/>                    
                        <input type="hidden" id="m_date_begin"  name="m_date_begin" value=""/>
                        <input type="hidden" id="m_date_end"    name="m_date_end"   value=""/>                                     
                        <input type="hidden" id="iedit"         name="iedit"        value="0"/>  
                                          
                        <input type="hidden" id="m_rashod_agent" name="m_rashod_agent" value="0"/>
                        <input type="hidden" id="m_main_pokr"   name="m_main_pokr"  value="1"/>
                        <input type="hidden" id="m_periodich"   name="m_periodich"  value="0"/>
                        <input type="hidden" id="m_srok"        name="m_srok"       value="0"/>                        
                        <select id="m_dop_pokr" name="m_dop_pokr[]" style="display: none;" multiple>
                            <?php 
                                foreach($dan['dop_product'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';      
                                }
                            ?>                            
                        </select>
                        
                        <label>Фамилия Имя Отчество и Дата Рождения застрахованного лица</label>
                        <input type="text" id="m_fio" name="m_fio" class="form-control" readonly/>    
                                                                            
                    <div class="row">                        
                        <div class="col-lg-4">
                            <label>Рост</label>
                            <input type="number" class="form-control" id="m_rost" name="m_rost"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Вес</label>
                            <input type="number" class="form-control" id="m_ves" name="m_ves"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Возраст</label>
                            <input type="number" class="form-control" id="m_vozrast" name="m_vozrast"/>
                        </div>
                    </div>                                      
                    
                    <div class="row">                        
                        <div class="col-lg-4">
                            <label>Годовой доход</label>
                            <input type="number" class="form-control" id="m_dohod" name="m_dohod"/>                                                        
                        </div>
                        
                        <div class="col-lg-4">
                            <label>Страховая сумма</label>
                            <input type="number" class="form-control" id="m_pay_sum_v" name="m_pay_sum_v"/>                                                        
                        </div>
                        <div class="col-lg-4">
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
                            <label>Выберите вид нагрузки</label>
                            <select class="form-control" id="type_nagruz">
                                <?php 
                                    foreach($dan['spr_ander_nagruz'] as $t=>$r){
                                        echo '<option value="'.$r['ID'].'">'.$r['NAME'].'</option>';
                                    }
                                ?>                                                                
                            </select>
                            
                            <label>Введите наименование нагрузки</label>
                            <input type="text" class="form-control" id="name_nagruz" value=""/>
                            
                            <div style="text-align: right; margin-top: 10px;">                            
                                <span class="btn btn-success btn-sm" id="add_risk_ander"><i class="fa fa-plus"></i> Добавить</span>
                            </div>
                            <hr />
                            
                            <label>Список андерайтинговых нагрузок</label>
                            <div id="list_risk_ander" class="row">
                                
                            </div>
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


<?php
/*
if($edit){
    echo '<pre>';
    print_r($dan);
    echo '</pre>';
}
*/	
?>
