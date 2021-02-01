<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
<form method="post" class="form-horizontal" name="createNewAccident">
<div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <div class="row">  
    <?php
    foreach($rsClientInfo as $t => $w){
        
    }
    ?>
    <div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <label class="col-lg-2 control-label">Страхователь</label>
                <div class="col-lg-10">
                    <input name="insured" type="text" class="form-control" id="surnameID" value='<? echo $v['NAME']; ?>'/>
                </div>
            </div>
    </div>
    <div class="col-lg-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Причина НС</label>
                <div class="col-lg-8">
                            <select name="reason" class="select2_demo_1 form-control">
                                <option value="1">Профессиональное заболевание</option>
                                <option value="2">Смерть</option>
                                <option value="3">Трудовое увечье</option>
                            </select>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-lg-4 control-label">Застрахованный</label>
                <div class="col-lg-8">
                    <input type="text" data-toggle="modal" href="#modal-form" class="form-control" name="insurant" id="insurantInpId" value="<?php echo $w['LASTNAME'].' '.$w['FIRSTNAME'].' '.$w['MIDDLENAME'].' '.$w['BIRTHDATE']; ?>"/>
                    <input hidden="" name="sicIdInpName" id="sicIdInp"/>
                    <input hidden="" name="dateOfBirthInpName" id="dateOfBirthIdInp"/>
                </div>
            </div>
       <div class="form-group">
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-8" id="placeForButton">    
                
            </div>
        </div>
        <div class="form-group">
                <label class="col-lg-4 control-label">Выготоприобретатели</label>
                <div class="col-lg-8">
                    <input class="form-control" name="purchasers" value=""/>
                    <input hidden="" name="purchasersIdInpName" id="purchasersIdInp"/>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
                <label class="col-lg-4 control-label">Дата несчастного случая</label>
                <div class="col-lg-8">
                    <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input name="accident_date" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999"/>
                                </div>
            </div>
        </div>
            <?php
                echo FORMS::FormHorizontalEdit(4, 8, 'Порядковый номер в журнале', 'ordinalnum', $v['DOCNUM']);
            ?>
        <div class="form-group">
            <label class="col-lg-4 control-label"></label>
            <div class="col-lg-8">        
                
                    <input id="courtsDecision" type="checkbox"/> <i></i>Выплата по решению суда
                    
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4 control-label"></label>
            <div class="col-lg-8">        
                <div class="i-checks">
                    <label> <input type="checkbox" id="entity" name="resident" <?php if($v['RESIDENT']==1){echo 'checked=""';} ?>/> <i></i>Юр. лицо</label>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $("#courtsDecision").change(function(){
                 if($(this).is(":checked")) {
                        $('#disNum').attr('style','display: block');
                        $('#accidDate').attr('style','display: block');
                        $('#paymentReas').attr('style','display: block');
                    }else{
                        $('#disNum').attr('style','display: none');
                        $('#accidDate').attr('style','display: none');
                        $('#paymentReas').attr('style','display: none');
                    }}
                    )
    </script>
    <div class="hr-line-dashed"></div>
    <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Регистрация уведомления об НС</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Регистарция НС</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3">Несчастные случаи</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="col-lg-4">
                                            <div class="form-group">
                                                    <label class="col-lg-4 control-label">Дата вход. документ</label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="iCONTRACT_DATE" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                    </div>
                                            </div>
                                            
                                    <?php
                                        echo FORMS::FormHorizontalEdit(4, 8, 'Степень вины работодателя', 'guiltDegree', $v['DOCNUM']);
                                    ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Номер вход. документа', 'docEntNum', $v['DOCTYPE']);        
                                    ?>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Степень тяжести</label>
                                                    <div class="col-lg-9">
                                                                <select name="degreeSeverity " class="select2_demo_1 form-control">
                                                                    <option value="1">Легкая</option>
                                                                    <option value="2">Средняя</option>
                                                                    <option value="3">Тяжелая</option>
                                                                    <option value="4">Умер (погиб)</option>
                                                                </select>
                                                    </div>
                                                </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Возраст пострадавшего</label>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" name="ageVictim" id="ageVictimID"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label"></label>
                                        <div class="col-lg-8">        
                                            <div class="i-checks">
                                                <label> <input type="checkbox" name="disabilityTemp" <?php if($v['RESIDENT']==1){echo 'checked=""';} ?>/> <i></i>Временная нетрудоспособность</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label"></label>
                                        <div class="col-lg-8">        
                                            <div class="i-checks">
                                                <label> <input type="checkbox" name="hospital" <?php if($v['RESIDENT']==1){echo 'checked=""';} ?>/> <i></i>Госпитализация</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Профессия', 'profess', $v['DOCTYPE']);              
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Средняя ЗП за 12 мес.', 'salary', $v['DOCNUM']);
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Должность', 'position', $v['DOCTYPE']);              
                                        echo FORMS::FormHorizontalEdit(3, 9, 'ЗП в соответствии с заявкой на андеррайтинг', 'salaryOfficial', $v['DOCNUM']);
                                    ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Краткое описание вреда здоровью</label>
                                            <div class="col-lg-12">
                                                <textarea name="shortDesc" class="form-control" placeholder="Краткое описание вреда здоровью..."></textarea>
                                            </div>
                                    </div>        
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                                    <label class="col-lg-4 control-label">Дата причинения вреда здоровью</label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="harmDate" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Место причинения вреда здоровью', 'accidentPlace', $v['DOCNUM']);
                                    ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Краткое описание обстоятельства причинения вреда здоровью</label>
                                            <div class="col-lg-12">
                                                <textarea name="shortDescAboutCircs" class="form-control" placeholder="Краткое описание вреда здоровью..."></textarea>
                                            </div>
                                    </div>        
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"> Тип персонала</label>
                                        <div class="col-lg-9">
                                                    <select name="personalType" class="select2_demo_1 form-control">
                                                        <option value="1">Административно-управленческий персонал</option>
                                                        <option value="2">Производственный персонал</option>
                                                        <option value="3">Вспомогательный</option>
                                                    </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Родственные отношения', 'relatives', '', '', 'Родственные отношения иждевенца к застрахованному');
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" id="disNum" style="display: none;">
                                        <label class="col-lg-4 control-label">Номер постановления</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" name="NOM_SUD" id="NOM_SUDID"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" id="accidDate" hidden="">
                                            <label class="col-lg-3 control-label">Дата постановления суда</label>
                                            <div class="col-lg-9">
                                                <div class="input-group date">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                <input name="DATE_SUD" data="0701000001" id="DATE_SUDid" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" id="paymentReas" hidden="">
                                        <label class="col-lg-2 control-label">Основание для выплаты по суду</label>
                                            <div class="col-lg-12">
                                                <textarea name="paymentReasInpName" class="form-control" placeholder="Краткое описание вреда здоровью..."></textarea>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                        echo FORMS::FormHorizontalEdit(3, 9, 'Расходы страховщика на урегулирование убытка', 'insuranceCosts', $v['DOCNUM']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="form-group" id="diagnosis">
                                        <label class="col-lg-2 control-label">Диагноз</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" name="diagnoz" placeholder="Диагноз"></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Номер заявления о возмещении</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="statementNum" id="surnameID"/>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Номер акта</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="actNum" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">От</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="iCONTRACT_DATEstatementNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">От</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="iCONTRACT_DATEactNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                <h3>Регресс</h3>
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Сумма</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="sumRegress" id="surnameID"/>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Дата оплаты</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="dateRegress" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#reg-tab-1">Инвалидность</a></li>
                                        <li class=""><a data-toggle="tab" href="#reg-tab-2">Смерть</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="reg-tab-1" class="tab-pane active">
                                            <div class="panel-body">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                            <label class="col-lg-4 control-label">Номер заключения НЦГТиПЗ</label>
                                                            <div class="col-lg-8">
                                                                    <input type="text" class="form-control" name="ncgtipzNum" id="surnameID"/>
                                                            </div>
                                                    </div>
                                                    <div class="form-group">
                                                            <label class="col-lg-4 control-label">Номер справки МСЭ</label>
                                                            <div class="col-lg-8">
                                                                    <input type="text" class="form-control" name="mseNum" id="surnameID"/>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                            <label class="col-lg-4 control-label">От</label>
                                                            <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="iCONTRACT_DATEncgtipzNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                            </div>
                                                    </div>
                                                    <div class="form-group">
                                                            <label class="col-lg-4 control-label">От</label>
                                                            <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="iCONTRACT_DATEmseNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                            <label class="col-lg-2 control-label">Дата утраты трудоспособности</label>
                                                            <div class="col-lg-5">
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="iCONTRACT_DATEdisablementFrom" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                    <label class="col-lg-2 control-label">по</label>
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input name="iCONTRACT_DATEdisablementTo" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                    </div>
                                                            </div>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                                <label class="col-lg-4 control-label">СУПТ (%)</label>
                                                                <div class="col-lg-8">
                                                                        <input type="text" class="form-control" name="supt" id="surnameID"/>
                                                                </div>
                                                    </div>
                                                </div>
                                        </div>
                                        </div>
                                        <div id="reg-tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                        <label class="col-lg-4 control-label">Номер свидетельства о смерти</label>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="deathDateAct" id="surnameID"/>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                        <label class="col-lg-4 control-label">Дата выдачи свидетельства о смерти</label>
                                                        <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                    <input name="iCONTRACT_DATEdeathDateAct" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                                </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                        <label class="col-lg-2 control-label">Кем выдан</label>
                                                        <div class="col-lg-10">
                                                                <input type="text" class="form-control" name="issuedBy" id="surnameID"/>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                            <label class="col-lg-2 control-label">Совокупный размер выплат</label>
                                            <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="allPaymentsSum" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Доля перестраховщика в убытке</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="reinsurPart" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Доля убытка на собственном удержании</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="reinsurPartOwn" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" id="diagnosis">
                                        <label class="col-lg-2 control-label">Вредный производственный фактор</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" placeholder="Краткое описание вреда здоровью..." name="harmfulFactor"></textarea>
                                            </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Номер заключения</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="conclusionNum" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">от</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="iCONTRACT_DATEconclusionNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Номер акта N1</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="actN1Num" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">от</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="iCONTRACT_DATEactN1Num" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Номер справки МСЭ</label>
                                            <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="mseConcNum" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">от</label>
                                            <div class="col-lg-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="iCONTRACT_DATEmseConcNum" data="0701000001" id="CONTRACT_DATE" type="text" class="form-control" data-mask="99.99.9999" value="">
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                <h3>Регресс</h3>
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                            <label class="col-lg-1 control-label">Банк</label>
                                            <div class="col-lg-11">
                                                    <input type="text" class="form-control" name="bank" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-3 control-label">ИИК</label>
                                            <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="iik" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-3 control-label">Тип счета</label>
                                            <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="invoiceType" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-3 control-label">Счет</label>
                                            <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="invoice" id="surnameID"/>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="placeForList2">
                
            </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="col-lg-9"></div>
    <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Сохранить</button></div>
    <input type="hidden" name="isegmentinsur_id" value="0"/>
    <input type="hidden" name="ivid" value="new"/>
    <input type="hidden" name="emp" value="<?php echo $active_user_dan['emp']; ?>"/>
    <input type="hidden" name="iid" value="0"/>
    
    </div></div></div>
</form>

        </div>
    </div>            
</div>

    <div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-12">
                                    <input id="sic_idInp"/>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2" class="sr-only">Фамилия</label>
                                        <input type="text" placeholder="Фамилия" id="lastname"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword2" class="sr-only">Имя</label>
                                        <input type="text" placeholder="Имя" id="firstname"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword2" class="sr-only">Отчество</label>
                                        <input type="text" placeholder="Отчество" id="middlename"
                                            class="form-control"/>
                                    </div>
                                    <button class="btn btn-info" onclick="window.location.href='clients_edit?sicid=0&create_type=3'">Добавить нового клиента</button>
                                    <button class="btn btn-primary" id="insurantSearch">Найти существующего</button>
                                    
                                <div class="form-horizontal scrolltab" style="height: 600px;">
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="clientsTable" data-page-size="8" data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>Имя</th>
                                        <th data-hide="phone,tablet">Отчество</th>
                                        <th data-hide="phone,tablet">Дата рождения</th>
                                    </tr>
                                    </thead>
                                    <tbody id="placeForList">
                                            
                                    </tbody>
                                            
                                    </table>
                                </div>
                                </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addInfoAboutClient();">Добавить выбранного</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input hidden="" id="id_insId" value="<?php echo $_GET['id_ins']; ?>"/>
            <script>
                function addInfoAboutClient(){
                    var sic_id = $('#sic_idInp').val();
                    $.post('accidents', {"sic_id": sic_id}, function(d){
                            console.log(sic_id);
                            console.log(JSON.parse(d));
                            var dsp = JSON.parse(d);
                            $('#insurantInpId').val(dsp.LASTNAME+' '+dsp.FIRSTNAME+' '+dsp.MIDDLENAME+' '+dsp.BIRTHDATE);
                            $('#dateOfBirthIdInp').val(dsp.BIRTHDATE);
                            $('#sicIdInp').val(dsp.SICID);
                            setAge(dsp.BIRTHDATE);
                    })
                }
                
                function setAge(BIRTHDATE){
                    console.log(BIRTHDATE);
                    arrBIRTHDATE = BIRTHDATE.split('.');
                    var day = arrBIRTHDATE[0];
                    var month = arrBIRTHDATE[1];
                    var year = arrBIRTHDATE[2];
                    console.log(day+'.'+month+'.'+year);
                    $('#ageVictimID').val(getAge(year+'/'+month+'/'+day));
                }
                
                function getAge(dateString) 
                {
                    var today = new Date();
                    var birthDate = new Date(dateString);
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
                    {
                        age--;
                    }
                    return age;
                }
            </script>
            <script>
                $('#insurantSearch').click(
                    function(){
                        var lastname = $('#lastname').val();
                        var firstname = $('#firstname').val();
                        var middlename = $('#middlename').val();
                        console.log(lastname, firstname, middlename);
                        $.post('accidents', {"lastname": lastname, 
                                             "firstname": firstname,
                                             "middlename": middlename
                                                }, function(d){
                            $('#placeForList').html(d);
                        }
                    )
                })
            </script>
            
            
            <script>
                $(document).ready(function(){
                    var id_ins = $('#id_insId').val();
                    $.post('accidents', {"id_ins": id_ins}, function(d){
                        $('#surnameID').val(d);
                    })
                })
            </script>
            
            
            
            