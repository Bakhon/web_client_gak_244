<?php 
    $forms = new FORMS();
    
    if(!isset($dan['CN']['OPF_ID'])){
        $dan['CN']['OPF_ID'] = 0;
    }
    
    if(!isset($dan['CN']['NOTE'])){
        $dan['CN']['NOTE'] = '';
    }
    
    if(!isset($dan['CN']['GL_BUH'])){
        $dan['CN']['GL_BUH'] = '';
    }
    
    if(!isset($dan['CN']['FIRST_RUK'])){
        $dan['CN']['FIRST_RUK'] = '';
    }
        
    if(!isset($dan['CN']['KONTACT_FACE'])){
        $dan['CN']['KONTACT_FACE'] = '';
    } 
    
    if(!isset($dan['CN']['DATE_V'])){
        $dan['CN']['DATE_V'] = '';
    }
?>
<div class="form-horizontal">

<div class="ibox float-e-margins">                         
<div class="ibox-content">
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 15px;">                    
        <a href="javascript:;" class="btn btn-danger" onclick="history.back(1);" ><i class="fa fa-close"></i> Назад</a>
        <a href="contragents?edit=<?php echo $dan['ID']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Редактировать</a>
        <span  id="history" class="btn btn-warning" data-toggle="modal" data-target="#protokol"><i class="fa fa-save"></i> История изменений</span>        
    </div>
    
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Общие данные</a></li>
            <li><a data-toggle="tab" href="#tab-2"> Адресные данные</a></li>
            <li><a data-toggle="tab" href="#tab-3"> Реквизиты</a></li>            
            <li><a data-toggle="tab" href="#tab-5"> ОКЭД</a></li>
            <li><a data-toggle="tab" href="#tab-6"> Данные по руководству</a></li>
            <li><a data-toggle="tab" href="#tab-8"> ПОД/ФТ</a></li>
            <li><a data-toggle="tab" href="#tab-7"> Прочие данные</a></li>            
        </ul>
        
        <div class="tab-content">        
            <!-- Основные данные-->
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">     
                    <?php 
                        $view = 'none';
                        if($dan['CN']['NATURAL_PERSON_BOOL'] == '0'){
                            echo $forms->FormHorizontalEdit(4, 8, '', '', 'Юридическое лицо', '', '', '', 'readonly');    
                        }else{
                            echo $forms->FormHorizontalEdit(4, 8, '', '', 'Индивидуальный предприниматель', '', '', '', 'readonly');
                            $view = 'block';
                        } 
                            
                        
                        foreach($dan['OPF'] as $k=>$v){                             
                            if($v['KOD'] == $dan['CN']['OPF_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'ОПФ', '', $v['NAME'], '', '', '', 'readonly');
                            }                            
                        }                                                                        
                    ?>
                    <div id="ip_control" style="display: <?php echo $view; ?>;">
                    <hr />
                        <h3>Данные препринимателя</h3>
                        <?php                             
                            echo $forms->FormHorizontalEdit(4, 8, 'Фамилия', '', $dan['CN']['LASTNAME'], '', '', '', 'readonly');                             
                            echo $forms->FormHorizontalEdit(4, 8, 'Имя', '', $dan['CN']['FIRSTNAME'], '', '', '', 'readonly');                            
                            echo $forms->FormHorizontalEdit(4, 8, 'Отчество', '', $dan['CN']['MIDDLENAME'], '', '', '', 'readonly');                            
                            echo $forms->FormHorizontalEdit(4, 8, 'Дата Рождения', '', date("d.m.Y", strtotime($dan['CN']['BIRTHDATE'])), '', '', '', 'readonly');
                            if($dan['CN']['SEX_ID'] == '1'){
                                echo $forms->FormHorizontalEdit(4, 8, 'Пол', '', 'Мужской', '', '', '', 'readonly');    
                            }else{
                                echo $forms->FormHorizontalEdit(4, 8, 'Пол', '', 'Женский', '', '', '', 'readonly');
                            }
                            
                            $s = array(
                                "1"=>"ПАСПОРТ РК", 
                                "2"=>"УДОСТОВЕРЕНИЕ ЛИЧНОСТИ РК",
                                "3"=>"ВИД НА ЖИТЕЛЬСТВО РК",
                                "4"=>"СВИДЕТЕЛЬСТВО О РОЖДЕНИИ",
                                "5"=>"ЛИЦО БЕЗ ГРАЖДАНСТВА РК"
                            );
                            echo $forms->FormHorizontalEdit(4, 8, 'Тип документа', '', $s[$dan['CN']['DOCTYPE']], '', '', '', 'readonly');

                            echo $forms->FormHorizontalEdit(4, 8, 'Номер документа', '', $dan['CN']['DOCNUM'], '', '', '', 'readonly');                            
                            echo $forms->FormHorizontalEdit(4, 8, 'Кем выдан', '', $dan['CN']['DOCPLACE'], '', '', '', 'readonly');
                            echo $forms->FormHorizontalEdit(4, 8, 'Дата выдачи', '', date("d.m.Y", strtotime($dan['CN']['DOCDATE'])), '', '', '', 'readonly');                                                                                    
                        ?>                        
                        <hr />
                    </div>
                    <?php 
                       echo $forms->FormHorizontalEdit(4, 8, 'Полное наименование (рус)', '', htmlspecialchars($dan['CN']['NAME']), '', '', '', 'readonly'); 
                       echo $forms->FormHorizontalEdit(4, 8, 'Полное наименование (каз)', '', htmlspecialchars($dan['CN']['NAME_KAZ']), '', '', '', 'readonly');
                       echo $forms->FormHorizontalEdit(4, 8, 'Краткое наименование', '', htmlspecialchars($dan['CN']['SHORTNAME']), '', '', '', 'readonly');
                                             
                       $type_contr = array(
                        "1"=>"Организация",
                        "2"=>"Пенсионный фонд",
                        "3"=>"Частное лицо",
                        "4"=>"Перестраховщик",
                        "5"=>"Первичные страховщики (СК)"
                       );
                       echo $forms->FormHorizontalEdit(4, 8, 'Тип контрагента', '', $type_contr[$dan['CN']['TYPE']], '', '', '', 'readonly');
                    ?>   
                    <hr />
                    
                    <?php 
                        echo $forms->FormHorizontalEdit(4, 8, 'Вид документа подтверждающего регистрацию', '', $dan['CN']['FT_VDPR'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, '№ и дата выдачи документа', '', $dan['CN']['FT_VDPR_DOC'].' от '.$dan['CN']['FT_VDPR_DATE'].' г.', '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Наименование регистрирующего органа', '', $dan['CN']['FT_REG_NAME'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Место и дата регистрации', '', $dan['CN']['FT_REG_MESTO'].' ('.$dan['CN']['FT_REG_DATE'].'г.)', '', '', '', 'readonly');
                    ?>                                     
                </div>
            </div>
            <!-- Конец основных данных-->
            
            <!-- Адресные данные -->
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <?php                                                                        
                       if($dan['CN']['RESIDENT'] == '1'){
                            echo $forms->FormHorizontalEdit(4, 8, 'Признак резидентства', '', 'Резидент', '', '', '', 'readonly');
                       }else{
                            echo $forms->FormHorizontalEdit(4, 8, 'Признак резидентства', '', 'Не резидент', '', '', '', 'readonly');                            
                       }
                       foreach($dan['STRANA'] as $k=>$v){                            
                            if($v['ID'] == $dan['CN']['COUNTRY_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Страна', '', $v['NAME'], '', '', '', 'readonly');
                            }                            
                        }
                        
                        echo $forms->FormHorizontalEdit(4, 8, 'Область', '', $dan['SI']['REGION_NAME'], '', '', '', 'readonly');                         
                        echo $forms->FormHorizontalEdit(4, 8, 'Район', '', $dan['SI']['RAION'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Вид населенного пункта', '', $dan['SI']['TYPE_CITY'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Наименование города, Села', '', $dan['SI']['CITY_NAME'], '', '', '', 'readonly');                                                                      
                        echo $forms->FormHorizontalEdit(4, 8, 'Почтовый индекс', '', $dan['CN']['POSTCODE'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Улица', '', $dan['SI']['STREET'], '', '', '', 'readonly');                                                           
                        echo $forms->FormHorizontalEdit(4, 8, 'Дом', '', $dan['SI']['HOME_NUM'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Офис', '', $dan['SI']['OFICE'], '', '', '', 'readonly');  
                        echo $forms->FormHorizontalEdit(4, 8, 'Телефон', '', htmlspecialchars($dan['CN']['PHONE']), '', '', '', 'readonly');                        
                        echo '<hr />';
                        echo $forms->FormHorizontalEdit(4, 8, 'Адрес (рус)', '', htmlspecialchars($dan['CN']['ADDRESS']), '', '', '', 'readonly');                                                                                                              
                        echo $forms->FormHorizontalEdit(4, 8, 'Адрес (каз)', '', htmlspecialchars($dan['CN']['ADDRESS_KAZ']), '', '', '', 'readonly');
                    ?>
                </div>
            </div>
            <!-- Конец Адресные данные -->
            
            <!-- Реквизиты -->
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    <?php 
                        echo $forms->FormHorizontalEdit(4, 8, 'БИН/ИИН', '', htmlspecialchars($dan['CN']['BIN']), '', '', '', 'readonly');                    
                        echo $forms->FormHorizontalEdit(4, 8, 'Категория', '', $dan['SI']['KATEGOR'], '', '', '', 'readonly');                        
                        //echo $forms->FormHorizontalSelect(4, 8, 'Категория', 'KATEGOR', $dan['KATEGORY'], '', $dan['SI']['KATEGOR']);                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Расшифровка БИН', '', $dan['SI']['BIN_RASHIFR'], '', '', '', 'readonly');                                                                                    
                        echo $forms->FormHorizontalEdit(4, 8, 'Степень аффилированности', '', $dan['SI']['AFFILIR'], '', '', '', 'readonly');
                        
                        foreach($dan['GROUP_COMPANY'] as $k=>$v){                                                        
                            if($v['ID_GROUP'] == $dan['CN']['GROUP_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Входит в группу компании', '', $v['GROUP_NAME'], '', '', '', 'readonly');
                            }                            
                        }                        
                    ?>
                </div>
                
                <div class="panel-body">
                    <h3>Банковские данные</h3>
                    <?php 
                        foreach($dan['BANKS'] as $k=>$v){                                     
                            if($v['KOD'] == $dan['CN']['BANK_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Банк', '', $v['NAME'], '', '', '', 'readonly');
                            }
                        }
                        echo $forms->FormHorizontalEdit(4, 8, 'Банковский счет', '', $dan['CN']['P_ACCOUNT'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Примечание', '', $dan['CN']['NOTE'], '', '', '', 'readonly');
                    ?>
                </div>
            </div>
            <!-- Конец Реквизиты -->                        
            
            <!-- ОКЕД -->
            <div id="tab-5" class="tab-pane">
                <div class="panel-body">
                    <?php 
                        foreach($dan['OKED'] as $k=>$v){                            
                            if($v['ID'] == $dan['OKED_DAN']['ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Основной вид деятельности', '', $v['VED_NAME'], '', '', '', 'readonly');
                            }
                        }  
                        echo $forms->FormHorizontalEdit(4, 8, 'ОКЭД', '', $dan['OKED_DAN']['OKED'], '', '', '', 'readonly');                      
                        echo $forms->FormHorizontalEdit(4, 8, 'Класс проф. риска', '', $dan['OKED_DAN']['RISK_ID'], '', '', '', 'readonly');
                        echo '<hr />';
                        
                        foreach($dan['KOD_SECTOR'] as $k=>$v){                                              
                            if($v['CODE'] == $dan['CN']['SEC_ECONOM']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Сектор экономики', '', $v['NAME'], '', '', '', 'readonly');
                            }
                        }
                        
                        foreach($dan['OKED_ESBD'] as $k=>$v){
                            if($v['ID'] == $dan['CN']['VED_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Вид деятельности (для ЕСБД)', '', $v['NAME'], '', '', '', 'readonly');
                            }                            
                        }
                        echo $forms->FormHorizontalEdit(4, 8, 'Период осущ. эконом. деятель.', '', $dan['CN']['PERIOD_DEY'], '', '', '', 'readonly');
                    ?>                                                                                
                </div>
            </div>            
            <!-- Конец ОКЕД -->
            
            <!-- Данные по руководству -->
            <div id="tab-6" class="tab-pane">
                <div class="panel-body">
                    <?php                         
                        echo $forms->FormHorizontalEdit(4, 8, 'Руководитель', '', $dan['CN']['CHIEF'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Руководитель (в родительном падеже)', '', $dan['CN']['CHIEF2'], '', '', '', 'readonly');
                        echo '<hr>';                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Должность руководителя', '', $dan['CN']['CHIEF_DOLZH'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Должность (в родительном падеже)', '', $dan['CN']['CHIEF_DOLZH2'], '', '', '', 'readonly');
                        echo '<hr>';                        
                        echo $forms->FormHorizontalEdit(4, 8, 'Должность руководителя (каз)', '', $dan['CN']['CHIEF_DOLZH_KAZ'], '', '', '', 'readonly');
                        echo '<hr>';                        
                        echo $forms->FormHorizontalEdit(4, 8, 'Действующий на основании (каз)', '', $dan['CN']['OSNOVANIE_KAZ'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Действующий на основании (рус) *', '', $dan['CN']['OSNOVANIE'], '', '', '', 'readonly');            
                        echo '<hr>';                        
                        echo $forms->FormHorizontalEdit(4, 8, 'Представитель Юр. Лица', '', $dan['CN']['MAINBK'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Телефон', '', $dan['CN']['GL_BUH'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Первый руководитель', '', $dan['CN']['FIRST_RUK'], '', '', '', 'readonly');                                                
                        echo $forms->FormHorizontalEdit(4, 8, 'Контактное лицо', '', $dan['CN']['KONTACT_FACE'], '', '', '', 'readonly');   
                    ?>
                </div>
            </div>
            
            <!-- Данные по руководству -->
            
            <div id="tab-8" class="tab-pane">
                <div class="panel-body">                      
                    <?php 
                        echo $forms->FormHorizontalEdit(4, 8, 'Цель установления деловых отношений', '', $dan['CN']['FT_CUDO'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Источник финансирования', '', $dan['CN']['FT_IFO'], '', '', '', 'readonly');
                        echo '<h3>Бенефициарный собственник</h3>';
                        foreach($dan['BENEFIC'] as $k=>$v){
                            echo $forms->FormHorizontalEdit(4, 8, 'ФИО и ИИН', '', $v['FIO'].' - '.$v['IIN'].' ('.$v['RESIDENT'].' '.$v['COUNTRYNAME'].')', '', '', '', 'readonly');
                        }
                        echo '<h3>Отметка о проверке достоверности сведений</h3>';
                        echo $forms->FormHorizontalEdit(4, 8, 'Свидетельство о гос регистрации (Справка)', '', $dan['CN']['FT_SGR'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Устав', '', $dan['CN']['FT_USTAV'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Документ уд.л. должностного лица', '', $dan['CN']['FD_LDL'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Документ подтверждения полномочий', '', $dan['CN']['FT_PDL'], '', '', '', 'readonly');
                        echo $forms->FormHorizontalEdit(4, 8, 'Риск клиента', '', $dan['CN']['FT_RISK'], '', '', '', 'readonly');
                    ?>
                </div>                                    
            </div>
                                    
            <div id="tab-7" class="tab-pane">
                <div class="panel-body">
                    <h3>Данные по сегментированию</h3>  
                    <?php 
                        foreach($dan['FILIAL'] as $k=>$v){                            
                            if($v['KOD'] == $dan['SI']['BRANCH_ID']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Филиал', '', $v['NAME'], '', '', '', 'readonly');
                            }                            
                        }
                        
                        foreach($dan['ZAKUP'] as $k=>$v){                            
                            if($k == $dan['SI']['SPOSOB_ZAKUP']){
                                echo $forms->FormHorizontalEdit(4, 8, 'Филиал', '', $v, '', '', '', 'readonly');
                            }
                        }
                        echo $forms->FormHorizontalEdit(4, 8, 'Дата закупа', '', $dan['CN']['DATE_V'], '', '', '', 'readonly');                    
                        echo $forms->FormHorizontalEdit(4, 8, 'ФИО лица ответственного за заключение договора', '', $dan['CN']['AGENTNAME'], '', '', '', 'readonly');
                    ?>
                </div>                                    
            </div>
            
        </div>
    </div>
            
    </div></div></div>    
</div>






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
<!--
<pre>
<?php 
//    print_r($dan['CN']);
?>
</pre>
-->
<style>
#protokol .modal-dialog{
    width: 80%;
}
</style>