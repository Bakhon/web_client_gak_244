<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
                    <form method="post" class="form-horizontal" >
                            <div class="ibox float-e-margins">                         
                                            <div class="ibox-content">
                                                <div class="row">
                                                <div class="col-lg-6">
                                                    <h3>Общие данные</h3>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Фамилия</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="surname" id="surnameID" value="<?php echo $v['LASTNAME'];?>" placeholder="Введите фамилию для поиска.." required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Имя</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="firstname" id="firstnameID" value="<?php echo $v['FIRSTNAME'];?>" required />
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Отчество</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="middlename" id="middlenameID" value="<?php echo $v['MIDDLENAME'];?>" required/>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">
                                                            <div class="col-lg-4">
                                                                
                                                            </div>
                                                            <div class="col-lg-8" id="placeForButton">    
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="col-lg-4 control-label">Дата Рождения *</label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date ">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control dateOform" name="BIRTHDATE" data-mask="99.99.9999" id="BIRTHDATEid" value="<?php echo $v['BIRTHDATE']?>" required/>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label"></label>
                                                            <div class="col-lg-8">
                                                            <div class="i-checks">
                                                                    <label> <input type="radio" id="iSEX_ID" name="7" value="8" <?php if($v['SEX']==1){echo 'checked=""';}?> required/> <i></i> Мужской</label>
                                                            </div>
                                                            <div class="i-checks">
                                                                    <label> <input type="radio" id="iSEX_ID" name="7" value="8" <?php if($v['SEX']==0){echo 'checked=""';}?> required/> <i></i> Женский</label>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Место рождения</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Национальность</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Номер удостоверения личности</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Кем выдан</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Дата выдачи *</label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date ">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control dateOform" name="BIRTHDATE" data-mask="99.99.9999" id="BIRTHDATEid" value="<?php echo $v['BIRTHDATE']?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">ИИН</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Адрес проживания</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label">Адрес прописки</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" class="form-control" name="middlename" id="middlenameID" value="" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label"></label>
                                                            <div class="col-lg-8">        
                                                                <div class="i-checks">
                                                                    <label> <input type="checkbox" id="resident" name="resident" <?php if($v['RESIDENT']==1){echo 'checked=""';} ?> /> <i></i>Больничный</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />
                                    
                                                        <h4>Образование</h4>
                                                            <a id="checkEdu" class="btn btn-primary btn-xs">Добавить образование</a>
                                                            <table class="table table-hover margin bottom">
                                                                <thead>
                                                                <tr>
                                                                    <th style="width: 1%" class="text-center">#</th>
                                                                    <th>ВУЗ</th>
                                                                    <th class="text-center">Год окончания</th>
                                                                    <th class="text-center">Специальность</th>
                                                                    <th class="text-center">Квалификация</th>
                                                                    <th class="text-center">Номер диплома</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="place_for_edu">
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td> МГУ </td>
                                                                    <td class="text-center">2016</td>
                                                                    <td class="text-center">Юриспруденция</td>
                                                                    <td class="text-center">Юрист</td>
                                                                    <td class="text-center small">123456789</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        <hr />
                                                        <h3>Стаж</h3>   
                                                            <a id="formAddJob"class="btn btn-primary ">Добавить рабочее место</a>
                                                            <table class="table table-hover margin bottom">
                                                                <thead>
                                                                <tr>
                                                                    <th style="width: 1%" class="text-center">#</th>
                                                                    <th>Организация</th>
                                                                    <th class="text-center">Должность</th>
                                                                    <th class="text-center">Дата начала сотрудничества</th>
                                                                    <th class="text-center">Дата конца сотрудничества</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="place_for_formAddJob">
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td> Apple </td>
                                                                    <td class="text-center">Охранник</td>
                                                                    <td class="text-center small">16 Июль 2014</td>
                                                                    <td class="text-center small">16 Июль 2014</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        <hr />
                                                        <h3>Таблица с оборудованием</h3>
                                                                    <a id="formAddThings" class="btn btn-primary ">Добавить оборудование</a>
                                                                    <table class="table table-hover margin bottom">
                                                                        <thead>
                                                                        <tr>
                                                                            <th style="width: 1%" class="text-center">#</th>
                                                                            <th>Оборудование</th>
                                                                            <th class="text-center">Инвентарный номер</th>
                                                                            <th class="text-center">Количество</th>
                                                                            <th class="text-center">Мат.ответвенность</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="placeAddThings">
                                                                        <tr>
                                                                            <td class="text-center">1</td>
                                                                            <td> Клавиатура </td>
                                                                            <td class="text-center">123456789</td>
                                                                            <td class="text-center">1</td>
                                                                            <td class="text-center small"><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text-center">2</td>
                                                                            <td> Мышь </td>
                                                                            <td class="text-center">123456789</td>
                                                                            <td class="text-center">1</td>
                                                                            <td class="text-center small"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                        <h3>Семья</h3>
                                                                <hr />
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Семейное положение</label>
                                                                    <div class="col-lg-8">
                                                                                <select name="doctype " class="select2_demo_1 form-control" required>
                                                                                    <option></option>
                                                                                    <option value="1">Холост</option>
                                                                                    <option value="2">Женат/Замужем</option>
                                                                                </select>
                                                                    </div>
                                                                </div>
                                                                <hr />     
                                                                <a id="addFamilyMember" onclick="fnClickAddRow();" class="btn btn-primary ">Добавить члена семьи</a>
                                                                <table class="table table-hover margin bottom">
                                                                    <thead>
                                                                    <tr>
                                                                        <th style="width: 1%" class="text-center">#</th>
                                                                        <th>ФИО</th>
                                                                        <th class="text-center">Позиция родства</th>
                                                                        <th class="text-center">Дата рождения</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="777">
                                                                    <tr>
                                                                        <td class="text-center">1</td>
                                                                        <td> Иванов </td>
                                                                        <td class="text-center">Сын</td>
                                                                        <td class="text-center small">16 Июль 2014</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                    <hr />
                                    
                                    <h3>Воинский учет</h3>
                                    <?php
                                        echo FORMS::FormHorizontalEdit(4, 8, 'Группа учета', 'telnum', $v['PHONE'], '', '', '');
                                        echo FORMS::FormHorizontalEdit(4, 8, 'Категория учета', 'fax', $v['FAX'], '', '', '');
                                        echo FORMS::FormHorizontalEdit(4, 8, 'Состав', 'email', $v['EMEIL'], '', '', '');
                                    ?>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Воинское звание</label>
                                            <div class="col-lg-8">
                                                        <select name="marital_status" class="select2_demo_1 form-control" required>
                                                            <option></option>
                                                            <option value="1">Рядовой</option>
                                                            <option value="2">Ефрейтор</option>
                                                            <option value="3">Младший сержант</option>
                                                            <option value="4">Сержант</option>
                                                            <option value="1">Старший сержант</option>
                                                            <option value="2">Сержант третьего класса</option>
                                                            <option value="3">Сержант второго класса</option>
                                                            <option value="4">Сержант первого класса</option>
                                                            <option value="1">Штаб-сержант</option>
                                                            <option value="2">Мастер-сержант</option>
                                                            <option value="3">Лейтенант</option>
                                                            <option value="4">Старший лейтенант</option>
                                                            <option value="1">Капитан</option>
                                                            <option value="2">Майор</option>
                                                            <option value="3">Подполковник</option>
                                                            <option value="4">Полковник</option>
                                                            <option value="2">Генерал-майор</option>
                                                            <option value="3">Генерал-лейтенант</option>
                                                            <option value="4">Генерал-полковник</option>
                                                            
                                                            <option value="4">Генерал-армии</option>
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Военно-учетная специальность</label>
                                            <div class="col-lg-8">
                                                        <select name="marital_status" class="select2_demo_1 form-control" required>
                                                            <option></option>
                                                            <option value="1">Младший специалист Сухопутных войск</option>
                                                            <option value="2">Младший специалист войск радиационной, химической и биологической защиты (специалисты РХБЗ)</option>
                                                            <option value="3">Младший специалист по ремонту средств инженерного вооружения</option>
                                                            <option value="4">Младший специалист по ремонту средств связи</option>
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-lg-4 control-label">Название районного военкомата</label>
                                                <div class="col-lg-8">
                                                   <select name="marital_status" class="select2_demo_1 form-control" required>
                                                        <option></option>
                                                        <option value="1">тест</option>
                                                    </select>                        
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-lg-4 control-label">Состоит на спец. учете</label>
                                                <div class="col-lg-8">
                                                                <div class="switch noUiSlider">
                                                                    <div class="onoffswitch">
                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="example1" name="badsluch" onclick="showTitle()">
                                                                        <label class="onoffswitch-label" for="example1">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                                   
                                            </div></div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Годность к ВС</label>
                                            <div class="col-lg-8">
                                                <select name="marital_status" class="select2_demo_1 form-control" required>
                                                    <option></option>
                                                    <option value="1">Годен </option>
                                                    <option value="2">Не годен </option>
                                                    <option value="3">Годен к не строевой службе</option>
                                                </select>
                                            </div>
                                        </div>
                                            </div>
                                
                                <div class="col-lg-6">
                                    <h3>Отпуск</h3>
                                        <a id="formAddHoliday"  onclick="fnClickAddRow();" class="btn btn-primary ">Добавить отпуск</a>
                                        <table class="table table-hover margin bottom">
                                            <thead>
                                            <tr>
                                                <th style="width: 1%" class="text-center">#</th>
                                                <th>Дата отпуска</th>
                                                <th class="text-center">Количество дней</th>
                                                <th class="text-center">Леч.пособие</th>
                                            </tr>
                                            </thead>
                                            <tbody id="placeAddHoliday">
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td >16 Июль 2014 - 16 Июль 2014</td>
                                                <td class="text-center">15</td>
                                                <td class="text-center small"><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                                <label class="col-lg-4 control-label">&nbsp;</label>
                                                <div class="col-lg-8">
                                                    <div class="statistic-box">
                                                        <div class="row text-center">
                                                            <div class="col-lg-6">
                                                                <canvas id="doughnutChart" width="200" height="78"></canvas>
                                                                <h5 >Количество отпускных дней</h5>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <canvas id="polarChart" width="200" height="80"></canvas>
                                                                <h5 >Остатки отпускных дней</h5>
                                                            </div>
                                                        </div>
                                                    </div>                      
                                            </div>
                                        </div>
                                        <hr />
                                        <h3>Командировки</h3>
                                            <a id="formAddTrip" class="btn btn-primary ">Добавить командировку</a>
                                            <table class="table table-hover margin bottom">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 1%" class="text-center">#</th>
                                                        <th>Страна</th>
                                                        <th>Город</th>
                                                        <th class="text-center">Дата командировки</th>
                                                        <th class="text-center">Транспорт</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="placeAddTrip">
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td> Казахстан </td>
                                                        <td> Актау </td>
                                                        <td class="text-center small">16 Июль 2014</td>
                                                        <td class="text-center small">16 Июль 2014</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                        <div class="form-group">
                                                <label class="col-lg-4 control-label">Результаты аттестации за последние 6 лет</label>
                                                    <div class="col-lg-8">
                                                        <div id="place_for_chart_edu">
                                                            
                                                        </div>                   
                                                    </div>
                                        </div>
                                        <hr />
                                        <div class="form-group">
                                                            <label class="col-lg-4 control-label"></label>
                                                            <div class="col-lg-8">        
                                                                <div class="i-checks">
                                                                    <label> <input type="checkbox" id="resident" name="resident"/> <i></i>Рекомендован на новую должность</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <hr />  
                                        <div class="col-lg-9"></div>
                                        <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Сохранить</button></div>
                                            
                                </div>
                                </div>
                                    </div>
                                    
                        </div>
                    </div>
                </form> 
            </div>
        </div>



<script>    
    $('.osnVidDeyatelnosty_contr').change(function() {        
        var oked = $(this).val();        
        $.post('new_contract', {
            "osn_vid_deyatel": oked
        }, function(data){                    
            var j = JSON.parse(data);            
            $('#oked').val(j.OKED); 
            //$('#vd').val(j.NAME);
            $('#risk').val(j.RISK_ID);                       
        });
    });
    
    $('#region').change(function(){
        var id = $(this).val();
        $.post("contragents", {
            "list_citys": id
        }, function(data){                    
            $('#city_reg').html(data);                       
        });
    });
    
    function ViewIp(b)
    {        
        $('#ip_control').attr('style', 'display: '+b+';');
    }            
</script>

<script>
    $('#addFamilyMember').click(
        function(){
            $('#777').append('<tr><td class="text-center">1</td><td> Иванов </td><td class="text-center">Сын</td><td class="text-center small">16 Июль 2014</td></tr>');
        }
    )
</script>
            
<script>
    function add_transport(){
        console.log('777');
        //var transport = $('#transport').val();
        var transport = '777';
        $.post('create_employee', {"transport": transport}, function(d){
                    $('#place_for_transport').append(d);
                });
            }
</script>

<script>
    $('#formAddHoliday').click(
        function(data){
             $('#placeAddHoliday').append('<tr><td class="text-center">1</td><td >16 Июль 2014 - 16 Июль 2014</td><td class="text-center">15</td><td class="text-center small"><a href="#"><i class="fa fa-check text-navy"></i></a></td></tr>');
        });
</script>

<script>
    $('#formAddTrip').click(
        function(data){
             $('#placeAddTrip').append('<tr><td class="text-center">1</td><td> Казахстан </td><td> Актау </td><td class="text-center small">16 Июль 2014</td><td class="text-center small">16 Июль 2014</td></tr>');
        });
</script>

<script>
    $('#checkEdu').click(
        function(data){
             $('#place_for_edu').append('<tr><td class="text-center">1</td><td> МГУ </td><td class="text-center">2016</td><td class="text-center">Юриспруденция</td><td class="text-center">Юрист</td><td class="text-center small">123456789</td></tr>');
        });
</script>

<script>
    $('#formAddThings').click(
        function(data){
             $('#placeAddThings').append('<tr><td class="text-center">2</td><td> Мышь </td><td class="text-center">123456789</td><td class="text-center">1</td><td class="text-center small"></td></tr>');
        });
</script>

<script>
    $('#formAddJob').click(
        function(){
            $('#place_for_formAddJob').append('<tr><td class="text-center">1</td><td> Apple </td><td class="text-center">Охранник</td><td class="text-center small">16 Июль 2014</td><td class="text-center small">16 Июль 2014</td></tr>');

        }
    )
</script>



<script>
    $('document').ready(function(){
        var forAjax = 'forAjax';
        $.post('chart_edu', {"forAjax": forAjax}, 
            function(d){
                            //$('#place_for_chart_edu').html(d);
                        }
          )})
    
</script>

<script>
    $('document').ready(function(){
        var forAjax = 'forAjax';
    $.post('chart_effect', {"forAjax": forAjax}, 
            function(d){
                            //$('#place_for_chart_effect').html(d);
                        }
          )})
    
</script>
       
<?php
    //echo '<pre>';
    //print_r ($editClientsSicidList);
    //echo '</pre>';
?>

        <script>
            $('#surnameID').keyup(function(){
                   $('#placeForButton').html('<a data-toggle="modal" class="btn btn-block btn-primary" href="#modal-form" id="searchButtonId"><i class="fa fa-search"></i>Найти</a>');
                   var text = $('#surnameID').val();
                   console.log(text);
                   if(text==''){
                      $('#placeForButton').html('');
                   }
            })
        </script>
        <script>
            $('body').on('click', '#searchButtonId', function(){
                console.log('searchButtonId');
                var surname = $('#surnameID').val();
                var firstname = $('#firstnameID').val();
                var middlename = $('#middlenameID').val();
                    $.post('clients_edit', {"surnameForAjax": surname,
                                            "firstname": firstname,
                                            "middlename": middlename
                                                    }, function(d){
                            $('#placeForList').html(d);
                            }    
                        )}
            )
        </script>
<div id="modal-form" class="modal fade in" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" id="placeForList">    select * from gbdfl.gbl_person_new where Upper(SURNAME) LIKE upper ('%ВАВАКИН%') and firstname like upper ('%ВЛАДИМИР%') and SECONDNAME like upper ('%НИКОЛАЕВИЧ%') and rownum &lt; 100<div class="form-horizontal scrolltab" style="height: 600px;" id="clientsTable">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                    <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                    </tr>
                    </thead>
                    <tbody><tr class="gradeX" data="450930300366">
                            <td>ВАВАКИН</td>
                            <td>ВЛАДИМИР</td>
                            <td>НИКОЛАЕВИЧ</td>
                            <td>30.09.1945</td>
                        </tr></tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addInfoAboutClientFromGBDFL();">Добавить выбранного</button>
            </div>
                    <script>
            function addInfoAboutClientFromGBDFL(){
                var iinForAjax = $('#idIIN').val();
                $.post('clients_edit', {"iinForAjax": iinForAjax}, function(d){
                            console.log(JSON.parse(d));
                            var dsp = JSON.parse(d);
                            $('#surnameID').val(dsp.SURNAME);
                            $('#firstnameID').val(dsp.FIRSTNAME);
                            $('#middlenameID').val(dsp.SECONDNAME);
                            $('#BIRTHDATEid').val(dsp.BIRTH_DATE);
                            $('#idSic').val(dsp.SIC);
                            $('#DEATH_DATEid').val(dsp.DEATH_DATE);
                            $('#DEATH_SVID_BEGIN_DATEid').val(dsp.DEATH_SVID_BEGIN_DATE);
                            $('#DEATH_SVID_ISSUE_ORG_NAMEid').val(dsp.DEATH_SVID_ISSUE_ORG_NAME);
                            $('#DEATH_SVID_NUMBERid').val(dsp.DEATH_SVID_NUMBER);
                        })
                    }
        </script>
        <script>
        $('#clientsTable tr').click(function(){
                var tr = $(this);
                $('.gradeX').attr('class', 'gradeX');
                tr.attr('class', 'gradeX active');
                var s = tr.attr('data');
                console.log($(this).attr('data'));
                console.log(s);
                $('#idIIN').val(s);
                });
        </script>
        </div>
            </div>
        </div>
    </div>
</div>
                            