<div class="ibox">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row">            
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Основные данные клиента</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </div>
                                </div>
                                
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <strong>Фамилия</strong><br><?php echo $row[0]['LASTNAME']; ?>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <strong>Имя</strong><br>
                                            <div id="idName"><?php echo $row[0]['FIRSTNAME']; ?></div>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <strong>Отчество</strong><br><?php echo $row[0]['MIDDLENAME']; ?>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <strong>Дата рождения</strong><br><?php echo $row[0]['BIRTHDATE']; ?>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <strong>Пол</strong><br><?php if($row[0]['SEX'] == 1) {echo 'Муж.';} else {echo 'Жен.';};?>
                                        </div>
                                        <div class="col-lg-2"><strong>Резидент</strong><br>
                                            <div class="i-checks">
                                                <label><input type="checkbox" <?php if($row[0]['RESIDENT'] == 1){echo 'checked=""';} else { echo '';}; ?> disabled=""><i></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-3"><strong>Документ</strong><br><?php echo $row[0]['DOCUMENTS_DAN']; ?></div>
                                        <div class="col-lg-3"><strong>Адрес(Рус)</strong><br><?php echo $row[0]['ADDRES_RUS']; ?></div>
                                        <div class="col-lg-3"><strong>Адрес(Каз)</strong><br><?php echo $row[0]['ADDRES_KAZ']; ?></div>                        
                                        <div class="col-lg-3"><strong>Адрес при конвертации</strong><br><?php echo $row[0]['ADDR_CONV']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-4"><strong>СИК</strong><br><?php echo $row[0]['SIC']; ?></div>
                                        <div class="col-lg-4"><strong>ИИН</strong><br><?php echo $row[0]['IIN']; ?></div>
                                        <div class="col-lg-4"><strong>РНН</strong><br><?php echo $row[0]['RNN']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-4"><strong>Телефон</strong><br><?php echo $row[0]['PHONE']; ?></div>
                                        <div class="col-lg-4"><strong>EMAIL</strong><br><?php echo $row[0]['EMEIL']; ?></div>
                                        <div class="col-lg-4"><strong>Факс</strong><br><?php echo $row[0]['FAX']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-4"><strong>Профессия</strong><br><?php echo $row[0]['PROFFESION']; ?></div>
                                        <div class="col-lg-4"><strong>Семейное положение</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                                        <div class="col-lg-4"><strong>Фонд</strong><br><?php echo $row[0]['FOND']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-4"><strong>Инспектор</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                                        <div class="col-lg-4"><strong>Отделение</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-lg-2"><strong>Дата смерти</strong><br><?php echo $row[0]['DEATH_DATE']; ?></div>
                                        <div class="col-lg-3"><strong>Дата выдачи свидетельсвта о смерти</strong><br><?php echo $row[0]['DEATH_SVID_BEGIN_DATE']; ?></div>
                                        <div class="col-lg-3"><strong>Номер свидетельсвта о смерти</strong><br><?php echo $row[0]['DEATH_SVID_NUMBER']; ?></div>
                                        <div class="col-lg-4"><strong>Кем выдан</strong><br><?php echo $row[0]['DEATH_SVID_ISSUE_ORG_NAME']; ?></div>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <a class="btn btn-primary pull-right" href="clients_edit?sicid=<?php echo $row[0]['SICID'] ?>"><i class="fa fa-search"></i>Редактировать</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Данные по ПОД/ФТ</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </div>
                                </div>
                                
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-3"><label>Цель установления деловых отношений</label></div>
                                        <div class="col-lg-9">
                                            <span class="form-control">
                                                <?php echo $row['podft']['FT_CUDO']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Источник финансирования операций</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <span class="form-control">
                                                <?php echo $row['podft']['FT_IFO']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <center><label>Бенефициарный собственник</label></center>
                                        </div>
                                        
                                        <div class="col-lg-2"><label>ФИО</label></div>
                                        <div class="col-lg-4">
                                            <span class="form-control">
                                                <?php echo $row['podft']['FT_BC_FIO']; ?>
                                            </span>
                                        </div>
                                        
                                        <div class="col-lg-2"><label>ИИН</label></div>                                        
                                        <div class="col-lg-4">
                                            <span class="form-control">
                                                <?php echo $row['podft']['FT_BC_IIN']; ?>
                                            </span>
                                        </div>                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Договора</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </div>
                                </div>
                                
                                <div class="ibox-content">
                                
                                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Номер договора</th>
                                            <th>Дата договора</th>
                                            <th>Аннуитет</th>
                                            <th>Программа страхования</th>
                                            <th>Статус</th>
                                            <th data-hide="all">Получатель</th>
                                            <th data-hide="all">Вид страхования</th>
                                            <th data-hide="all">Дата назначения</th>
                                            <th data-hide="all">Дата окончания</th>
                                            <th data-hide="all">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                
                                        <?php
                                        if(count($dbDog) > 0){ 
                                            foreach($dbDog as $k => $v){                                    
                                                echo '<tr class="trka">
                                                    <td>'.$v['CONTRACT_NUM'].'</td>
                                                    <td>'.$v['CONTRACT_DATE'].'</td>
                                                    <td>'.$v['ANNUIT'].'</td>
                                                    <td>'.$v['PROGR_NAME'].'</td>
                                                    <td>'.$v['STATE_NAME'].'</td>
                                                    <td>'.$v['POLUCH_NAME'].'</td>
                                                    <td>'.$v['STRAH_NAME'].'</td>
                                                    <td>'.$v['DATE_BEGIN'].'</td>
                                                    <td>'.$v['DATE_END'].'</td>
                                                    <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'">подробнее...</a></td>
                                                </tr>';
                                            }
                                        }
                                        ?>                                
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>                                
                                </table>                            
                            </div>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<pre>
<?php 
  print_r($row);  
?>
</pre>