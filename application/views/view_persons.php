<div class="wrapper wrapper-content  animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12" id="osn-panel">
                            <div class="ibox-content">
                                    <div class="">
                                    
                                    </div>
                                    <table class="table table-striped table-bordered table-hover " id="editable">
                                    <thead>
                                    <tr>
                                        <th>Аватар</th>
                                        <th>ФИО</th>
                                        <th>Должность</th>
                                        <th>Департамент</th>
                                        <th>Почта</th>
                                        <th>Телефон(внешний)</th>
                                        <th>Телефон (внутренний)</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <?
                                                                for($i = 0;$i<$Ldap_Users['count'];$i++){
                                                                    $s = '';
                                                                    $b = false;
                                                                    
                                                                    foreach($_GET as $t=>$y);
                                                                    if(empty($t)){$b = true;}
                                                                    
                                                                    $u = ACTION::UserdanBase($Ldap_Users[$i]['samaccountname'][0]);
                                                                    if(count($u) <= 0){
                                                                        $s = 'label-inverse';                                                                                            
                                                                    }else{
                                                                        if($u[0]['BDISABLED'] == '2'){
                                                                            $s = 'label-warning';
                                                                        }
                                                                    }
                                                                    
                                                                    if ($Ldap_Users[$i]['useraccountcontrol'][0] == '514'){
                                                                        $s = 'label-danger';
                                                                        if(isset($_GET['blockeds'])){$b = true;}
                                                                    }
                                                                    
                                                                    if(isset($_GET['current'])){
                                                                        if(count($u) > 0)
                                                                        $b = true;
                                                                    }
                                                                    
                                                                    if(isset($_GET['not_current'])){
                                                                        if(count($u) <= 0){
                                                                            $b = true;
                                                                        }
                                                                    }
                                                                    
                                                                    if($b){
                                                            ?>
                                                            <tr ondblclick="$(location).attr('href','person_info?login=<?php echo $Ldap_Users[$i]['userprincipalname'][0]; ?>');" class="gradeX view_user_dan" data="<?php echo $Ldap_Users[$i]['samaccountname'][0]; ?>">
                                                                <td class="client-avatar"><img alt="image" src="<? echo HTTP_NO_IMAGE_USER; ?>"/></td>
                                                                <td><?php echo $Ldap_Users[$i]['sn'][0]." ".$Ldap_Users[$i]['givenname'][0]; ?></td>
                                                                <td> <? echo $Ldap_Users[$i]['title'][0];?>
                                                                </td>
                                                                <td><?php echo $Ldap_Users[$i]['department'][0]; ?></td>
                                                                <td><?php echo $Ldap_Users[$i]['userprincipalname'][0]; ?></td>
                                                                <td><? echo $Ldap_Users[$i]['telephonenumber'][0]?></td>
                                                                <td><? echo $Ldap_Users[$i]['telephonenumber'][0]?></td>
                                                                <td class="client-status"><span class="label label-danger">Offline</span></td>
                                                            </tr>
                                                            <?
                                                                }
                                                            }
                                                            ?>
        </tbody>
        </table>
        <a data-toggle="modal" data-target="#addEmp" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
        </div>                      
        </div>            
    </div>
</div>
    
<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="addEmp" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление нового сотрудника</h4>
                <small class="font-bold">Добавление учебных заведений оконченных работником</small>
            </div>
            <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Фамилия</label>
                        <input id="lastname" type="text" placeholder="" class="form-control fio" id="fio" required="">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Имя</label>
                        <input id="name" type="text" placeholder="" class="form-control fio" id="fio" required="">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Отчество</label>
                        <input id="middlename" type="text" placeholder="" class="form-control fio" id="fio" required="">
                    </div>
                    <div class="form-group">
                    <label class="font-noraml">Дата Рождения *</label>
                    <div class="input-group date ">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control dateOform" name="BIRTHDATE" data-mask="99.99.9999" id="BIRTHDATEid" value="<?php echo $v['BIRTHDATE']?>" required/>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="i-checks">
                                <label> <input type="radio" id="iSEX_ID" name="7" value="8" <?php if($v['SEX']==1){echo 'checked=""';}?> required/> <i></i> Мужской</label>
                        </div>
                        <div class="i-checks">
                                <label> <input type="radio" id="iSEX_ID" name="7" value="8" <?php if($v['SEX']==0){echo 'checked=""';}?> required/> <i></i> Женский</label>
                        </div>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Место рождения</label>
                        <select id="" name="doctype " class="select2_demo_1 form-control" required>
                            <option></option>
                            <option value="1">Test </option>
                            <option value="2">Test</option>
                            <option value="3">Test </option>
                        </select>    
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Национальность</label>
                        <select id="" name="doctype " class="select2_demo_1 form-control" required>
                            <option></option>
                            <option value="1">Test </option>
                            <option value="2">Test</option>
                            <option value="3">Test </option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тип документа</label>
                        <select id="docTypeSelect" name="doctype " class="select2_demo_1 form-control" required>
                            <option></option>
                            <option value="1">Удостоверение личности </option>
                            <option value="2">Удостоверение личности оралмана</option>
                            <option value="3">Вид на жительство </option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Дата выдачи</label>
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" name="BIRTHDATE" data-mask="99.99.9999" id="BIRTHDATEid" value="<?php echo $v['BIRTHDATE']?>" required/>
                        </div>
                    </div>
                    <div id="placeForDoInf">
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button id="saveFound" type="submit" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<script>
    $('#bornPlace').keyup(
        function(){
            var box = $('#bornPlace').val();
            var textLenght = (box.length);
                if(textLenght > 3){
                    console.log(textLenght);
                    
                }
        }
    )
</script>

<script>
    $('#docTypeSelect').change(
        function(){
            var docType = $('#docTypeSelect').val();
                    $.post("persons", {"docType": docType},
                    function(data){
                            $('#placeForDoInf').html(data);
                        });
        }
    )
</script>

<script>
    $('#saveFound').click(
        function(){
            var forajax = 'forajax';
             $.post('persons', {"forajax": forajax}, function(d){
                alert(d);
            });
        }
    )
</script>
















