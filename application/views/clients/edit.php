<?php 
    $v = $dan['dan'];
?>
<form method="post" class="form-horizontal" name="createNewClients">
<div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <div class="row">  
    
    <div class="col-lg-6">
        <h3>ФИО</h3>
            <div class="form-group">
                <label class="col-lg-4 control-label">Фамилия</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="surname" id="surnameID" value="<?php echo $v['LASTNAME'];?>" placeholder="Вбейте фамилию для поиска.." required/>
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
                <label class="col-lg-4 control-label">СИК</label>
                <div class="col-lg-8">
                    <input class="form-control" name="SIK" value="<?php echo $v['SIC']; ?>" id="idSic"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">РНН</label>
                <div class="col-lg-8">
                    <input class="form-control" name="RNN" value="<?php echo $v['RNN']; ?>" id="idRNN"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">ИИН *</label>
                <div class="col-lg-8">
                    <input class="form-control" name="IIN" id="idIIN" value="<?php echo $v['IIN']; ?>" data-mask="999999999999" accept="" <?php if(($_GET['sicid'])==0){ echo 'onblur="checkIIN();"'; } ?>required/>
                    <div id="checkOrNotCheck"></div>
                </div>
            </div>
        <script>
            /*$('#idIIN').keyup(function(){
                console.log('keyup');
                number = $("#idIIN").val().length;
                var str = $('#idIIN').val();
                    if(str.length == 12)
                        {
                            checkIIN();
                        }
               })*/
        </script>
        
        <script>
            function checkIIN(){
                var iin = $('#idIIN').val();
                console.log(iin);
                $.post('clients_edit', {"iinForCheck": iin}, function(d){
                    if(d == 7){
                        $('#checkOrNotCheck').html('<p class="text-info">ИИН свободен.</p>');
                    } else{
                        $('#idIIN').val('');
                        $('#idIIN').focus();
                        $('#checkOrNotCheck').html('<p class="text-danger">ИИН существует в базе</p>');
                    }
                }
            )}
        </script>
        <div class="form-group">
            <label class="col-lg-4 control-label"></label>
            <div class="col-lg-8">        
                <div class="i-checks">
                    <label> <input type="checkbox" id="resident" name="resident" <?php if($v['RESIDENT']==1){echo 'checked=""';} ?> /> <i></i>Резидент</label>
                </div>
            </div>
        </div>
        <hr />
        <h4>Адрес</h4>        
        <div class="form-group">
            <label class="col-lg-4 control-label">Область *</label>
            <div class="col-lg-8" data-toggle="modal" href="#modal-formArea"  onclick="showArea();">
                <input class="form-control" name="area" value="<?php echo $v['REG_ADDRESS_DISTRICTS_ID']?>" id="areaInput" required/>
            </div>
        </div>
        <script>
            function showArea(){
                var areaForAjax = 1;
                $.post('clients_edit', {"areaForAjax": areaForAjax}, function(d){
                        $('#areaWindow').html(d);
                    })
        }
        </script>
        <div class="form-group">
            <label class="col-lg-4 control-label">Регион *</label>
            <div class="col-lg-8" data-toggle="modal" href="#modal-formCity" onclick="showCity();">
                <input class="form-control" name="region" value="<?php echo $v['REG_ADDRESS_REGION_ID']?>" id="cityInput" required/>
            </div>
        </div>
        <script>
            function showCity(){
                var cityForAjax = 3;
                $.post('clients_edit', {"cityForAjax": cityForAjax}, function(d){
                    $('#cityWindow').html(d);
                })
                console.log('showCity');
            }
        </script>
        <div class="form-group">
            <label class="col-lg-4 control-label">Город *</label>
            <div class="col-lg-8" onclick="">
                <input class="form-control" name="city" value="<?php echo $v['REG_ADDRESS_CITY']?>" required/>
            </div>
        </div>
        <?php
            echo FORMS::FormHorizontalEdit(4, 8, 'Улица', 'street', $v['REG_ADDRESS_STREET'], '', '', '');
            echo FORMS::FormHorizontalEdit(4, 8, 'Номер дома', 'blockNumber', $v['REG_ADDRESS_BUILDING'], '', '', '');
        ?>
        <div class="form-group">
            <label class="col-lg-4 control-label">Страна *</label>
            <div class="col-lg-8" data-toggle="modal" href="#modal-formCountry" onclick="showCountry();">
                <input class="form-control" name="country" id="countryInput" value="<?php $v['REG_ADDRESS_COUNTRY_ID'] ?>" required/>
            </div>
        </div>
        <script>
            function showCountry(){
                var countryForAjax = 3;
                $.post('clients_edit', {"countryForAjax": countryForAjax}, function(d){
                    $('#countryWindow').html(d);
                })
                console.log('showCountry');
            }
        </script>
        <hr />
        <h3>Версия для печати в договоре</h3>     
        <?php              
            echo FORMS::FormHorizontalEdit(4, 8, 'Адрес (каз)', 'adresskaz', $v['ADDRES_KAZ'], '', '', '');
            echo FORMS::FormHorizontalEdit(4, 8, 'Адрес (рус) *', 'adressrus', $v['ADDRESS_RUS'], '', '', '', 'required');
        ?>
        <div class="form-group">
            <div class="col-lg-4">
                
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <h3>Документ</h3>
            <div class="form-group">
                <label class="col-lg-4 control-label">Тип *</label>
                <div class="col-lg-8">
                    <select name="doctype " class="select2_demo_1 form-control" required>
                        <option></option>
                        <option value="1">Паспорт РК</option>
                        <option value="2">Удостоверение личности РК</option>
                        <option value="3">Вид на жительство РК</option>
                        <option value="4">Свидетельство о рождении</option>
                        <option value="5">Лицо без гражданства РК</option>
                        <option value="6">Паспорт РФ</option>
                        <option value="7">Иной документ</option>
                        <option value="8">$v['DOCTYPE']</option>
                    </select>
                </div>
            </div>
            <?php              
                echo FORMS::FormHorizontalEdit(4, 8, 'Серия', 'docseries', $v['DOCNUM'], '', '', '');
                echo FORMS::FormHorizontalEdit(4, 8, 'Номер *', 'docnum', $v['DOCNUM'], '', '', '', 'required');
            ?>
            <div class="form-group">
                <label class="col-lg-4 control-label">Дата выдачи *</label>
                <div class="col-lg-8">
                    <div class="input-group date ">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control dateOform" name="docdate" data-mask="99.99.9999" id="docdateId" value="<?php echo $v['DEATH_SVID_BEGIN_DATE']?>" required/>
                    </div>
                </div>
            </div>
        <?php              
            echo FORMS::FormHorizontalEdit(4, 8, 'Кем выдан', 'docissued', $v['DOCPLACE'], '', '', '');               
        ?>
        <hr />
        <h3>Личное</h3>
        <?php
            echo FORMS::FormHorizontalEdit(4, 8, 'Телефон', 'telnum', $v['PHONE'], '', '', '');
            echo FORMS::FormHorizontalEdit(4, 8, 'Факс', 'fax', $v['FAX'], '', '', '');
            echo FORMS::FormHorizontalEdit(4, 8, 'Почта', 'email', $v['EMEIL'], '', '', '');
            echo FORMS::FormHorizontalEdit(4, 8, 'Профессия', 'profess', $v['PROFFESION'], '', '', '');
        ?>
            <div class="form-group">
                <label class="col-lg-4 control-label">Семейное положение *</label>
                <div class="col-lg-8">
                            <select name="marital_status" class="select2_demo_1 form-control" required>
                                <option></option>
                                <option value="1">Холост (Не замужем)</option>
                                <option value="2">Женат (Замужем)</option>
                                <option value="3">Вдова (Вдовец)</option>
                                <option value="4">Разведен (-а)</option>
                                <option value="5">Жена военнослуж. срочной службы</option>
                            </select>
                </div>
            </div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Пенсионный фонд</label>
            <div class="col-lg-8" data-toggle="modal" href="#modal-formCountry" onclick="showInsurance();">
                <input class="form-control" name="pension_fund" id="countryInput" value="<?php $$v['FOND'] ?>"/>
            </div>
        </div>
        <hr />
        <h3>Данные о смерти</h3>        
            <div class="form-group">
                    <label class="col-lg-4 control-label">Дата смерти</label>
                    <div class="col-lg-8">
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" name="death_date" data-mask="99.99.9999" id="DEATH_DATEid" value="<?php echo $v['BIRTHDATE']?>"/>
                        </div>                        
                </div>
            </div>
            <div class="form-group">
                    <label class="col-lg-4 control-label">Дата выдачи свидетельства о смерти</label>
                    <div class="col-lg-8">
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" name="death_date_check" data-mask="99.99.9999" id="DEATH_SVID_BEGIN_DATEid" value="<?php echo $v['BIRTHDATE']?>"/>
                        </div>                        
                </div>
            </div>        
        <?php
            echo FORMS::FormHorizontalEdit(4, 8, 'Номер свидетельства о смерти', 'death_check_number', $v['DEATH_SVID_BEGIN_DATE'], '', '', 'DEATH_SVID_NUMBERid');
            echo FORMS::FormHorizontalEdit(4, 8, 'Кем выдан', 'death_issued', $v['DEATH_SVID_ISSUE_ORG_NAME'], '', '', 'DEATH_SVID_ISSUE_ORG_NAMEid');         
        ?>
        
                
    </div>
    
    <div class="col-lg-9"></div>
    <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Сохранить</button></div>
    <input type="hidden" name="isegmentinsur_id" value="0"/>
    <input type="hidden" name="ivid" value="new"/>
    <input type="hidden" name="emp" value="<?php echo $active_user_dan['emp']; ?>"/>
    <input type="hidden" name="iid" value="0"/>
    
    </div></div></div>
</form>



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

</div>


<div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" id="placeForList">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-formArea" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" id="areaWindow">
                    
                </div>
                    <a class="btn btn-block btn-primary" data-dismiss="modal" id="checkArea"><i class="fa fa-search"></i>Выбрать</a>
            </div>
        </div>
    </div>
</div>
<div id="modal-formRegion" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" id="regionWindow">
                    
                </div>
                    <a class="btn btn-block btn-primary" data-dismiss="modal" id="checkArea"><i class="fa fa-search"></i>Выбрать</a>
            </div>
        </div>
    </div>
</div>
<div id="modal-formCity" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-horizontal scrolltab" id="cityWindow" style="height: 600px;">
                    
                </div>
                    <a class="btn btn-block btn-primary" data-dismiss="modal" id="checkCity"><i class="fa fa-search"></i>Выбрать</a>
            </div>
        </div>
    </div>
</div>
<div id="modal-formCountry" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-horizontal scrolltab" id="countryWindow" style="height: 600px;">
                    
                </div>
                    <a class="btn btn-block btn-primary" data-dismiss="modal" id="checkCountry"><i class="fa fa-search"></i>Выбрать</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click', '#areaTable tr', function(){
        var tr = $(this);
        var s = tr.attr('data');
        $('.gradeX').attr('class', 'gradeX');
        tr.attr('class', 'gradeX active');
        $('#checkArea').click(function(){
            console.log(s);
            $('#areaInput').val(s);
        })
        console.log(s);
    })
    
    $('body').on('click', '#cityTable tr', function(){
        var tr = $(this);
        var s = tr.attr('data');
        $('.gradeX').attr('class', 'gradeX');
        tr.attr('class', 'gradeX active');
        $('#checkCity').click(function(){
            console.log(s);
            $('#cityInput').val(s);
        })
        console.log(s);
    })
    
    $('body').on('click', '#countryTable tr', function(){
        var tr = $(this);
        var s = tr.attr('data');
        $('.gradeX').attr('class', 'gradeX');
        tr.attr('class', 'gradeX active');
        $('#checkCountry').click(function(){
            console.log(s);
            $('#countryInput').val(s);
        })
        console.log(s);
    })
</script>
       
<?php
    //echo '<pre>';
    //print_r ($editClientsSicidList);
    //echo '</pre>';
?>