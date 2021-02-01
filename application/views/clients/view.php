<?php
    $cl = $client->result['dan'];
    $ft = array();
    if(isset($client->result['podft'][0])){
        if($client->result['podft'][0] > 0){
            $ft = $client->result['podft'][0];
        }
    }
?>
<div class="ibox float-e-margins">                         
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6">
                <label>Фамилия Имя Отчество</label>
                <label class="form-control"><?php echo $cl['LASTNAME'].' '.$cl['FIRSTNAME'].' '.$cl['MIDDLENAME']; ?></label>
            </div>
            
            <div class="col-lg-3">
                <label>Дата рождения</label>
                <label class="form-control"><?php echo $cl['BIRTHDATE'].' г.р.'; ?></label>
            </div>
            
            <div class="col-lg-3">
                <label>Пол</label>
                <label class="form-control"><?php if($cl['SEX'] == '1'){echo 'Мужской';}else{echo 'Женский';}; ?></label>
            </div>            
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <label>ИИН</label>
                <label class="form-control"><?php echo $cl['IIN']; ?></label>
            </div>
            
            <div class="col-lg-4">
                <label>СИК</label>
                <label class="form-control"><?php echo $cl['SIC']; ?></label>
            </div>
            
            <div class="col-lg-4">
                <label>РНН</label>
                <label class="form-control"><?php echo $cl['RNN']; ?></label>
            </div>
        </div>
    </div>
</div>

<div class="ibox float-e-margins">                         
    <div class="ibox-content">        
        <div class="row">
            <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Документы</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> Адресные данные</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false"> Личные данные</a></li>            
                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false"> Данные о смерти</a></li>                    
                    <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false"> ПОД/ФТ</a></li>
                </ul>
                                        
                <div class="tab-content">
                
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                        
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Тип документа</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DOCTYPE_TEXT']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Серия № от</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DOC_SER']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Кем выдан</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DOCPLACE']; ?></label>
                                </div>
                            </div>
                            
                        </div>                    
                    </div>
                    
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Страна</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['COUNTRY_NAME']; ?></label>
                                    
                                    <label> 
                                        <div class="icheckbox_square-green <?php echo SetChecked($cl['RESIDENT']); ?> disabled">                                            
                                            <ins class="iCheck-helper"></ins>
                                        </div> 
                                        <i></i> Резидент 
                                    </label>                                                                        
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Область</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['O_NAME']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Регион</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['R_NAME']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Город</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['REG_ADDRESS_CITY']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Улица</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['REG_ADDRESS_STREET']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">№ дома</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['REG_ADDRESS_BUILDING']; ?></label>
                                </div>
                            </div>
                            <hr />
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Адрес на казахском языке</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['ADDRES_KAZ']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Адрес на русском языке</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['ADDRESS_RUS']; ?></label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Телефон сотовый</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['PHONE']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Дополнительный телефон</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['FAX']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Email</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['EMEIL']; ?></label>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Профессия</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['PROFFESION']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Семейное положение</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['FAMIL_NAME']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Пенсионный фонд</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly></label>
                                </div>
                            </div>                                                        
                        </div>
                    </div>
                    
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                        
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Дата смерти</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DEATH_DATE']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Номер видетельства о смерти</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DEATH_SVID_NUMBER']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Дата выдачи свидетельства о смерти</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DEATH_SVID_BEGIN_DATE']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Кем выдан</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php echo $cl['DEATH_SVID_ISSUE_ORG_NAME']; ?></label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!--ПОД/ФТ-->
                    <div id="tab-5" class="tab-pane">
                        <div class="panel-body row">
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Место рождения</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['PLACE_BIRTH']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Цель установления деловых отношений</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['FT_CUDO']; ?></label>
                                </div>
                            </div>                            
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Источник финансирования операций</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['FT_IFO']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Риск клиента</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['RISK']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Бенефициарный собственник</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['FT_BC_FIO']; ?></label>
                                    <label> 
                                        <div class="icheckbox_square-green <?php if(count($ft) > 0)echo SetChecked($ft['NALOG_USA']); ?> disabled">                                            
                                            <ins class="iCheck-helper"></ins>
                                        </div> 
                                        <i></i> Является налоговым резидентом США 
                                    </label>                                    
                                </div>
                            </div>
                            <br />
                            <hr />
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Относится ли первый руководитель или член исполнительного органа к ИПДЛ</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)if($ft['FT_ONE_IPDL'] = 1){echo 'Не относится';}else{echo 'Относится';} ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-12 control-label readonly">Сведения о физ лице иностранце (Руководитель или член органа ИПДЛ)</label>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">ФИО</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['FT_ONE_IPDL_FIO']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Документ (№, дата, срок действия)</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo '№ '.$ft['FT_ONE_IPDL_DOCNUM'].' от '.$ft['FT_ONE_IPDL_DOC_DATE'].' г. ('.$ft['FT_ONE_IPDL_DOC_DATE_END'].' г.)'; ?></label>
                                </div>
                            </div>
                            <hr />
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Относятся ли члены семьи и близкие родственники к ИПДЛ</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)if($ft['FT_TWO_IPDL'] = 1){echo 'Не относится';}else{echo 'Относится';} ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-12 control-label readonly">Сведения о физ лице иностранце (Член семьи и близкий родственник ИПДЛ)</label>                                
                            </div>
                                                        
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">ФИО</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['FT_TWO_IPDL_FIO']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Документ (№, дата, срок действия)</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo '№ '.$ft['FT_TWO_IPDL_DOCNUM'].' от '.$ft['FT_TWO_IPDL_DOC_DATE'].' г. ('.$ft['FT_TWO_IPDL_DOC_DATE_END'].' г.)'; ?></label>
                                </div>
                            </div>
                            <hr />
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">Отметка о сверке достоверности сведений</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['OTMETKA']; ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label text-right">ФИО лица ответсственного за заключение договора</label>
                                <div class="col-lg-8">
                                    <label class="form-control" readonly><?php if(count($ft) > 0)echo $ft['ID_AGENT']; ?></label>
                                </div>
                            </div>                            
                        </div>                        
                    </div>
                    <!-- ПОД/ФТ КОНЕЦ-->
                    
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
<!--
<pre>
<?php
	//print_r($client->result);
?>
</pre>
-->

<style>
.control-label.readonly{
    background-color: #E9E9E9;
}
</style>