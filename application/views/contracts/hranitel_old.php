<?php 
    $periodich = array(
        "1"=>"Ежегодно",
        "2"=>"Раз в пол года",
        "4"=>"Ежеквартально",
        "12"=>"Ежемесячно",
        "0"=>"Единовременно"
    );        
?>
<input type="hidden" id="CNCT_ID" value="<?php echo $dan['contract']['CNCT_ID']; ?>"/>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">                 
                <div class="ibox-title">
                    <h5><?php echo $dan['contract']['CONTRACT_NUM']; ?></h5>
                    <div class="ibox-tools">
                        <a style="color: black;" class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <?php echo $dan['contract']['CONTRACT_NUM'].' от '.$dan['contract']['CONTRACT_DATE']; ?>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user" style="max-height: 350px; overflow: auto;">
                            <?php 
                            foreach($dan['list_contract'] as $k=>$v){
                                $clas = '';
                                if($v['CNCT_ID'] == $dan['contract']['CNCT_ID']){
                                    $clas = 'class="active"';
                                }
                                
                                echo '<li '.$clas.'><a href="#" class="get_contract" data="'.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</a></li>';
                            }
                            ?>                            
                        </ul>
                    </div>
                    <!--
                    <div class="btn-group">
                        <?php 
                            foreach($dan['list_contract'] as $k=>$v){
                                $clas = 'btn-white';
                                if($v['CNCT_ID'] == $dan['contract']['CNCT_ID']){
                                    $clas = 'btn-primary';
                                }
                                echo '<button class="btn '.$clas.' get_contract" type="button" data="'.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</button>';
                            }
                        ?>  
                                              
                    </div>   
                    -->                 
                </div>
            </div>
            
            <div class="ibox float-e-margins">                 
                <div class="ibox-title">
                    <div class="pull-right" style="width: 20%;">                                                                                                
                    <?php                     
                        if($dan['contract']['STATE'] !== '12'){
                            echo '
                            <div class="input-group">
                                <input type="text" class="form-control" id="text_bco" value="'.$dan['contract']['BCO'].'" placeholder="Введите № БСО"/>
                                <span class="input-group-btn"> 
                                    <button type="button" data="'.$dan['contract']['CNCT_ID'].'" class="btn btn-primary" id="btn_bco"><i class="fa fa-save"></i></button> 
                                </span>
                            </div>
                            ';
                        }else{
                            echo '<b class="text-danger">'.$dan['contract']['BCO'].'</b>';
                        }                    
                    ?>
                    </div>
                    <h4 class="pull-right">№ БСО:</h4>
                    <h3 id="title_program"><?php echo $dan['contract']['PROGR_NAME']; ?> (Просмотр договора)</h3>
                    
                    
                </div>                        
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>№ и Дата полиса</label></div>
                        <div class="col-sm-3">
                            <span  class="form-control" readonly><?php echo $dan['contract']['CONTRACT_NUM']; ?></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $dan['contract']['CONTRACT_DATE']; ?></span>
                        </div>
                        <div class="col-sm-4">
                            <span class="form-control" readonly>Инспектор: <?php echo $dan['contract']['EMP_NAME']; ?></span>
                        </div>
                    </div>                    
                    <br />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>№ и Дата заявления</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $dan['contract']['ZV_NUM']; ?></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $dan['contract']['ZV_DATE']; ?></span>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Страхователь</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" style="height: auto;" readonly><?php echo $dan['contract']['STRAHOVATEL']; ?></span>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Агент</label></div>
                        <div class="col-sm-5">
                            <span class="form-control" readonly><?php echo $dan['contract']['AGENT']; ?></span>
                        </div>
                        <div class="col-sm-5">
                            <span class="form-control" readonly><?php echo $dan['contract']['DOGOVOR']; ?></span>
                        </div>                                           
                    </div>                                        
                    <br />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Отделение</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo $dan['contract']['BRANCH_NAME']; ?></span>
                        </div>                                                   
                    </div>
                                        
                    <hr />
                    <div class="row">
                        <div class="col-sm-4 text-right"><label>Период действия страховой защиты</label></div>
                        <div class="col-sm-4">
                            <span class="form-control" readonly><?php echo $dan['contract']['VIPLAT_BEGIN']; ?></span>
                        </div>
                        <div class="col-sm-4">
                            <span class="form-control" readonly><?php echo $dan['contract']['VIPLAT_END']; ?></span>
                        </div>                                           
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-4 text-right"><label>Период действия страхового полиса</label></div>
                        <div class="col-sm-4">
                            <span class="form-control" readonly><?php echo $dan['contract']['DATE_BEGIN_FIRST']; ?></span>
                        </div>
                        <div class="col-sm-4">
                            <span class="form-control" readonly><?php echo $dan['contract']['DATE_END_FIRST']; ?></span>
                        </div>                                           
                    </div>                    
                </div>
            </div>
            
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">
                    <h5>Банковские данные</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div>
                </div>
                
                <div class="ibox-content" style="display: none;">
                    <div class="row">
                        <div class="col-sm-2"><label>Банк</label></div>
                        <div class="col-sm-10">                                                
                            <span class="form-control" readonly><?php echo $dan['contract']['BANK_NAME']; ?></span>
                        </div>
                        
                        <hr />
                        <div class="col-sm-2"><label>ИИК</label></div>
                        <div class="col-sm-2">
                            <span class="form-control" readonly><?php echo $dan['contract']['BANK_IIK']; ?></span>
                        </div>
                        
                        <div class="col-sm-1"><label>Счет</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $dan['contract']['P_ACCOUNT']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Тип счета</label></div>
                        <div class="col-sm-2">
                            <span class="form-control" readonly><?php echo $dan['contract']['ACC_TYPE']; ?></span>
                        </div>
                        <p>&nbsp;</p>
                    </div>
                    
                    <div class="row">      
                        <div class="col-sm-2"><label>Наличие льгот</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $dan['contract']['LGOT_NAME']; ?></span>
                        </div>
                        
                        <div class="col-sm-3"><label>Период действия льгот</label></div>
                        <div class="col-sm-2"><span class="form-control" readonly><?php echo $dan['contract']['LGOT_BEGIN_DATE']; ?></span></div>
                        <div class="col-sm-2"><span class="form-control" readonly><?php echo $dan['contract']['DATE_END_LGOT']; ?></span></div>
                        
                        <hr />
                        <div class="col-sm-2"><label>Дата окончания карточки</label></div>
                        <div class="col-sm-4"><span class="form-control" readonly><?php echo $dan['contract']['DATE_CARD_END']; ?></span></div>
                        
                        <div class="col-sm-2"><label>Номер льгота</label></div>
                        <div class="col-sm-4"><span class="form-control" readonly><?php echo $dan['contract']['LGOT_NUMBER']; ?></span></div>
                         
                    </div>
                </div>
            </div>
            
            <?php 
                //if($dan['contract']['STATE'] == '11'){
            ?>
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">
                    <h5>График</h5>
                    <div class="ibox-tools">
                        <?php 
                            if($dan['kvitov']['view_btn']){
                                if(count($dan['grafik']) == 0){
                        ?>
                            <a class="btn btn-info btn-xs kvitovanie" data-toggle="modal" data-target="#kvitovanie" data="0" style="color: #fff;"><i class="fa fa-money"></i> Взять в доход</a>
                        <?php }
                        }
                        ?>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div>
                </div>
                
                <div class="ibox-content" style="display: none;">
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<th>Сумма план</th>
                			<th>Дата план</th>
                			<th>Сумма факт</th>
                			<th>Дата факт</th>
                			<th>Дата взятия в доход</th>
                            <th>&nbsp;</th>
                		</tr>	
                	</thead>
                	<tbody>
                		<?php 
               			  foreach($dan['grafik'] as $k=>$v){
                		      $btn_view = '&nbsp;';
                			  if($v['BTN_VIEW'] == '0'){
                			     $btn_view = '<a class="btn btn-block btn-info btn-xs kvitovanie" data-toggle="modal" data-target="#kvitovanie" data="'.$v['ID'].'" style="color: #fff;"><i class="fa fa-money"></i> Взять в доход</a>';
               			      }else{
               			          if($v['OPL_SUM'] > 0){
               			              $btn_view = '<a class="btn btn-block btn-info btn-xs kvitovanie" data-toggle="modal" data-target="#kvitovanie" data="'.$v['ID'].'" style="color: #fff;"><i class="fa fa-money"></i> Взять в доход</a>';     
               			          }else{
               			              if(trim($v['MHMH_ID_KVIT']) !== ''){
               			                  $btn_view = '<button class="btn btn-block btn-success btn-xs dannye_po_plategke" data-toggle="modal" data-target="#others_dannye" data="'.$v['MHMH_ID_KVIT'].'" style="color: #fff;"><i class="fa fa-check"></i> Данные по платежке</button>';
               			              }else{
               			                  $btn_view = 'Операция проведена в ручную';
               			              }
               			          }
               			      }
			                  echo '<tr>
		                			<td>'.NumberRas($v['PAY_SUM']).'</td>
		                			<td>'.$v['DATE_PL'].'</td>
		                			<td>'.NumberRas($v['SUM_FACT']).'</td>
		                			<td>'.$v['DATE_F'].'</td>
		                			<td>'.$v['DATE_DOHOD'].'</td>
                                    <td>'.$btn_view.'</td>
      		                  </tr>';
							}
                		?>	                		
                	</tbody>
                </table>
                </div>
            </div>
            <?php //} ?>
            
            <!-- Список застрахованных людей -->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Данные по застрахованным</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div>
                </div>
                
                <div class="ibox-content">                    
                    <div class="tabs-container">
                            <div class="tab-content">
                                <?php 
                                    $i = 0;                                    
                                    foreach($dan['clients'] as $k=>$v){
                                        $s = '';
                                        if($i == 0){$s = 'active';}
                                ?>
                                <div id="user_tab_<?php echo $v['ID_ANNUIT']; ?>" class="tab-pane <?Php echo $s; ?>">
                                    <div class="panel-body">                    
                                        <div class="row">                        
                                            <div class="col-lg-12">                                                
                                                <div class="form-horizontal">                                                                                                            
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">ФИО (Дата Рождения)(ИИН)</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['FIO']; ?> (<?php echo $v['BIRTHDATE']; ?> г.р.) (<?php echo $v['IIN']; ?>)" readonly="">                                                                                                                                         
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Возраст</label>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['AGE']; ?>" readonly="">                                                                     
                                                        </div>                                                                
                                                    
                                                        <label class="col-lg-1 control-label">Вес</label>
                                                        <div class="col-lg-2">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['VES']; ?>" readonly="">                                                                     
                                                        </div>
                                                    
                                                        <label class="col-lg-1 control-label">Рост</label>
                                                        <div class="col-lg-2">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['ROST']; ?>" readonly="">                                                                     
                                                        </div>
                                                    </div>
                                                                                
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Агентские расходы</label>
                                                        <div class="col-lg-2">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['AGENT_TARIF']; ?>" readonly="">                                                                     
                                                        </div>
                                                    
                                                        <label class="col-lg-2 control-label">Периодичность</label>
                                                        <div class="col-lg-2">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['PERIODICH']; ?>" readonly="">                                                                     
                                                        </div>
                                                        
                                                        <label class="col-lg-2 control-label">Срок страхования</label>
                                                        <div class="col-lg-1">
                                                            <input type="text" class="form-control" readonly value="<?php echo $v['SROK_STRAH']; ?>" readonly="">                                                                     
                                                        </div>
                                                    </div>
                                                    <div class="form-group">                                                                
                                                        <label class="col-lg-3 control-label">Годовой доход</label>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" readonly value="<?php echo NumberRas($v['GOD_DOHOD']); ?>" readonly="">                                                                     
                                                        </div>
                                                    
                                                        <label class="col-lg-3 control-label">Страховая сумма</label>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" readonly value="<?php echo NumberRas($v['STR_SUM']); ?>" readonly="">                                                                     
                                                        </div>
                                                    </div>
                                                    
                                                    <hr>
                                                    <?php 
                                                        if(count($v['NAGRUZ']) > 0){
                                                    ?>
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
                                                    <hr>
                                                    <?php } ?>
                                                                                                        
                                                    <h3>Расчетные данные</h3>
                                                    <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Тип</th>
                                                            <th>Наименование</th>
                                                            <th>Тариф</th>
                                                            <th>Нагрузка</th>                                                                                                                                            
                                                            <th>Страховой взнос</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            foreach($v['CALC'] as $t=>$dds){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $dds['NAME_TYPE_POKR']; ?></td>
                                                            <td><?php echo $dds['NAME_POKR']; ?></td>
                                                            <td><?php echo StrToFloat($dds['BRUTTO_TARIF_R']); ?></td>
                                                            <td><?php echo $dds['NAGRUZ']; ?></td>
                                                            <td><?php echo NumberRas($dds['BRUTTO_P_R']); ?></td>                                                        
                                                        </tr>
                                                       <?php } ?>
                                                        <tr>
                                                            <td colspan="2"><b>Итого: </b></td>
                                                            <td><b><?php echo StrToFloat($v['TARIF']); ?></b></td>
                                                            <td><b></b></td>                                                            
                                                            <td><b><?php echo NumberRas($v['PAY_SUM_P']); ?></b></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
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
                                                            foreach($v['obtain'] as $t=>$dds){
                                                            echo '
                                                            <tr>
                                                                <td>'.$dds['LASTNAME'].' '.$dds['FIRSTNAME'].' '.$dds['MIDDLENAME'].'</td>
                                                                <td>'.$dds['V_PERS'].'</td>                        
                                                            </tr>';
                                                            } 
                                                        ?>
                                                    </tbody>
                                                    </table>
                                                    <?php 
                                                        }
                                                    ?>
                                                </div>                                        
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php 
                                    if($dan['contract']['STATE'] == 12){
                                    ?>
                                    <div class="panel-footer">
                                        <?php 
                                            $b = false;
                                            if(count($v['ns_check']) > 0){
                                                echo '<h4>Список собранных документов по НС</h4>';
                                                echo '<ul class="list-group clear-list m-t">';
                                                foreach($v['ns_check'] as $n=>$f){
                                                    echo '<li class="list-group-item">'.$f['NAME'].'</li>';
                                                }
                                                echo '</ul>';
                                                
                                                echo '<h4>Файлы для скачивания</h4>';
                                                $np = 1;
                                                echo '<ul class="list-group clear-list m-t">';
                                                foreach($v['ns_docs'] as $n=>$f){
                                                    echo '<li class="list-group-item">
                                                    <span class="label label-default">'.$np.'</span>
                                                    <a download target="_blank" href="ftp://upload:Astana2014@192.168.5.2'.$f['FILENAME'].'">Скачать файл</a>
                                                    </li>';
                                                    $np++;
                                                }
                                                echo '</ul>';
                                                
                                                
                                                if($v['count_ns_docs'] == count($v['ns_check'])){
                                                    $b = true;
                                                    echo '<span class="text-success pull-right">Пакет документов собран полностью</span>';
                                                }else{
                                                    echo '<span class="text-danger pull-right">Собран не полный пакет документов</span>                                                                                                        
                                                    ';
                                                }
                                                                                            
                                            }
                                            if($b == false){
                                                echo '<button class="btn btn-danger btn-sm set_ns" data-toggle="modal" data-target="#others_dannye" data="'.$cnct_id.'" sicid="'.$v['ID_ANNUIT'].'">Наступление НС</button>';
                                            }else{
                                                echo '<button class="btn btn-success btn-sm set_gak_ns" data="'.$cnct_id.'" sicid="'.$v['ID_ANNUIT'].'">Отправить пакет документов в ГО</button>';
                                            } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php 
                                    $i++;
                                    } 
                                ?>
                             </div>
                        </div>
                    </div>
                </div>                
        </div>
                
        <div class="col-lg-4">
            <div class="ibox-title">
                <div class="btn-group btn-block">
                    <button data-toggle="dropdown" class="btn btn-success btn-sm btn-block dropdown-toggle">Меню <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php 
                        if(trim($dan['contract']['BCO']) == ''){
                            echo '<li><a href="javascript:alert('."'Введите номер БСО'".');">Печать полиса</a></li>';    
                        }else{
                            echo '<li><a target="_blank" data-bco="'.$dan['contract']['BCO'].'" href="rep_frx?cnct='.$dan['contract']['CNCT_ID'].'&other=6">Печать полиса</a></li>';
                        }
                        ?>                        
                        <li><a class="printBtn" href="rep?id=3022&&<?php echo $dan['contract']['CNCT_ID']; ?>">Печать заключения</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data="<?php echo $dan['contract']['CNCT_ID']; ?>" data-target="#print_zav" class="print_zav_btn">Печать заявления</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#list_files">Просмотр и добавление документов страхового дела</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal_reason_dops">Регистрация Доп. соглашения</a></li>
                        <li><a href="new_contract?paym_code=0601000001&&CNCT_ID=<?php echo $dan['contract']['CNCT_ID']; ?>">Редактировать</a></li>
                        <li><a href="#" id="set_arhive" data="<?php echo $dan['contract']['CNCT_ID']; ?>">Перенсети в архив</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="label-success newstate" data="1" data-cnct="<?php echo $dan['contract']['CNCT_ID']; ?>"><span style="color: #fff;">Утвердить</span></a></li>
                        <li><a href="#" class="label-danger newstate" data="0" data-cnct="<?php echo $dan['contract']['CNCT_ID']; ?>"><span style="color: #fff;">Отклонить</span></a></li>                                                                                                
                        <li class="divider"></li>
                        <?php 
                            if($dan['vikup_sum']['view_btn'] == true)
                            {
                                if($dan['contract']['STATE'] == '12')                                    
                                    echo '<li><a href="#" data-toggle="modal" data="'.$dan['contract']['CNCT_ID'].'" data-target="#others_dannye" class="set_vikup_sum">Расчет выкупной суммы</a></li>';
                                
                                if($dan['contract']['STATE'] == '14')                                    
                                    echo '<li><a href="#" data-toggle="modal" data="'.$dan['contract']['CNCT_ID'].'" data-target="#others_dannye" class="set_rastorg_dogovor">Расторжение договора</a></li>';
                            }
                            
                                
                        ?>
                    </ul>
                </div>                
            </div>
            <div class="ibox float-e-margins">                                         
                <div class="ibox-content">                    
                    <label>Тип страхователя</label>                                        
                    <span class="form-control" readonly><?php echo $dan['contract']['TYPE_STRAH']; ?></span>
                    
                    <label>Тип страхования</label>
                    <span class="form-control" readonly><?php echo $dan['contract']['TYPE_STR_TEXT']; ?></span>
                    
                    <label>Уровень принятия решения</label>
                    <span class="form-control" readonly><?php echo $dan['contract']['LEVEL_NAME']; ?></span>
                    
                    <label>Статус</label>
                    <span class="form-control" readonly><?php echo $dan['contract']['STATE_NAME']; ?></span>
                    <br />    
                    <center><h3>Расчетные данные</h3></center>
                    <label>Страховой взнос по основному покрытию</label>
                    <span class="form-control" readonly><?php echo NumberRas($dan['contract']['SP_OSN_POKR_ALL']); ?></span>
                    
                    <label>Страховой взнос по дополнительному покрытию</label>
                    <span class="form-control" readonly><?php echo NumberRas($dan['contract']['SP_DOP_POKR_ALL']); ?></span>
                    
                    <label>Размер страхового взноса</label>
                    <span class="form-control" readonly><?php echo NumberRas($dan['contract']['SP_OSN_POKR_ALL']+$dan['contract']['SP_DOP_POKR_ALL']); ?></span>
                    
                    <hr />
                    <label class="text-danger">Общая страховая премия</label>
                    <span class="form-control" readonly><?php echo NumberRas($dan['contract']['INS_PREMIYA']); ?></span>                    
                    <label class="text-danger">Страховая сумма</label>
                    <span class="form-control" readonly><?php echo NumberRas($dan['contract']['INS_SUMMA']); ?></span>
                </div>
            </div>  
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <center><h4>Список застрахованных клиентов</h4></center>
                </div>                         
                <div class="ibox-content" style="max-height: 43em;overflow: auto;">
                    <?php 
                        $i = 0;                                    
                        foreach($dan['clients'] as $k=>$v){
                            $s = 'default';
                            if($i == 0){$s = 'info';}
                            echo '<a class="btn tab_view btn-'.$s.' btn-block" data-toggle="tab" href="#user_tab_'.$v['ID_ANNUIT'].'">'.$v['FIO_MIN'].' </a>';
                            $i++;
                        }
                    ?>
                </div>
            </div>
            
        </div>        
                                       
    </div>
</div>



<div class="modal inmodal" id="list_files" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                <span class="h4">Документы страхового дела</span>                
            </div>           
            <div class="modal-body" style="background: #fff;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Подразделение</th>
                            <th>Файл</th>
                            <th>Комментарий</th>
                            <th></th>
                        </tr>
                    </thead>                
                    <tbody>
                        <?php 
                        foreach($dan['list_files'] as $k=>$v){
                            //<a target="_blank" href="contracts?download_file='.base64_encode($v['FILENAME']).'&&CNCT_ID='.$v['CNCT_ID'].'">'.$v['FILENAME'].'</a>
                            echo '
                            <tr>
                                <td>'.$v['NAIMEN'].'</td>
                                <td>'.$v['OTVETSTV'].'</td>
                                <td>                                    
                                    <a download href="ftp://upload:Astana2014@192.168.5.2'.$v['FILENAME'].'" target="_blank">'.$v['FILENAME'].'</a>                                    
                                </td>
                                <td>'.$v['NOTE'].'</td>
                                <td><span class="btn btn-xs btn-info load_file" ID_FILES="'.$v['ID_FILES'].'" ID_CF="'.$v['ID_CF'].'"><i class="fa fa-download"></i></span></td>
                            </tr>';      
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


<div class="modal inmodal fade" id="modal_reason_dops" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Выберите причину</h4>
                <small class="font-bold">Выберите причину регистрации дополнительного соглашения</small>
            </div>
            <div class="modal-body">
                <form method="get" action="new_contract" id="create_reason_dop">
                    <input type="hidden" name="paym_code" value="0601000001"/>
                    <input type="hidden" name="id_head" value="<?php 
                        if($dan['contract']['ID_HEAD'] == '0'){
                            echo $dan['contract']['CNCT_ID'];
                        }else{
                            echo $dan['contract']['ID_HEAD'];
                        }
                    ?>"/>
                    <select class="form-control" name="reason_dops">
                        <?php 
                          foreach($dan['reason_dops'] as $k=>$v){
                            echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                          }
                        ?>                        
                    </select>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="$('#create_reason_dop').submit();"  class="btn btn-primary">Выбрать</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="print_zav" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Печать заявления</h4>                
            </div>
            <div class="modal-body" id="print_zav_body" style="background: #fff;">
                
            </div>
        </div>
    </div>
</div> 

<div class="modal inmodal fade" id="others_dannye" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="others_dannye_title"></h4>                
            </div>
            <div class="modal-body" id="others_dannye_body" style="background: #fff;">
                
            </div>
            <div class="modal-footer">
                <button type="button" style="display: none;" class="btn btn-success save_btns" id="">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>  

<div class="modal inmodal fade" id="kvitovanie" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Квитование платежей (Поиск)</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">
                    <form class="col-lg-12" id="search_kvit_form">
                        <h3>Поиск</h3>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label>Дата платежа с</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_begin" class="form-control" value="" data-mask="99.99.9999">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_end" class="form-control" value="" data-mask="99.99.9999">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label>Сумма</label>
                                <input type="number" name="pay_sum" class="form-control"/>                            
                            </div>
                            <div class="col-lg-3">
                                <label>БИН</label>
                                <input type="text" name="bin" class="form-control"/>
                            </div>
                            <div class="col-lg-3"> 
                                <label>Сквитован Да/нет</label>                           
                                <select name="skvit" class="form-control">
                                    <option value=""></option>
                                    <option value="0">Сквитован</option>
                                    <option value="1">Не сквитован</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>&nbsp;</label>
                                <button class="btn btn-success btn-block" id="search_kvit"><i class="fa fa-search"></i> Найти</button>
                            </div>
                            <input type="hidden" name="search_plat_kvit" value="<?php echo $dan['contract']['CNCT_ID']; ?>"/>
                            <input type="hidden" name="id_transh" id="id_transh" value="0"/>
                        </div>
                    </form>
                    <div class="col-lg-12">
                        <hr />
                        <form id="set_kvitov_plat" method="post">
                            <div style="float: right; width: 50%;" class="well">
                                <label class="col-lg-3">Дата взятия в доход</label>
                                <div class="col-lg-9">                    
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="date_dohod" class="form-control" value="<?php echo date("d.m.Y"); ?>" data-mask="99.99.9999">
                                    </div>
                                </div>
                            </div>
                                
                            <h3 class="pull-left">Результат поиска</h3>
                            <div id="view_plat" style="max-height: 400px;overflow: auto; width:100%">
                                
                            </div>
                        </form>
                    </div>                    
                </div>                                
            </div>
            
            <div class="modal-footer">                
                <button type="button" class="btn btn-success" id="btn_kvit" disabled>Сквитовать</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div> 

<style>
.dropdown-menu > li > a {
    border: solid 1px;
}
</style>