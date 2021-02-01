<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable" >
                <thead>
                    <tr>
                        <th>AUTH_CODE</th>
                        <th>PASSWORD</th>
                        <th>PASS_WITHOUT_HASH</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($listEmployee as $k => $v){
                    ?>
                    <tr class="gradeX">
                        <td><?php echo $v['AUTH_CODE'];?></td>
                        <td><?php echo $v['PASSWORD'];?></td>
                        <td><?php echo $v['PASS_WITHOUT_HASH'];?></td>
                        <td><?php echo $v['EMAIL'];?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <button data-toggle="modal" data-target="#add_user" type="button" class="btn btn-primary">Новый пользователь</button>
        </div>
    </div>
</div>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_user" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить пользователя</h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
            <form method="POST">            
                <div class="panel-body form-horizontal payment-form">
                 <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" name="emp_id" value="<?php echo $id_user;?>"/>
                
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тип пользователя</label>
                        <select id="USER_TYPE" name="USER_TYPE" class="select2_demo_1 form-control" onchange="change_label();">
                            <option></option>
                            <option value="1">Физ.лицо</option>
                            <option value="2">Юр.лицо</option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml" id="username">Имя</label>
                        <input name="NAME" type="text" placeholder="" class="form-control" id="NAME" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml" id="authcode">ИИН</label>
                        <input name="AUTH_CODE" type="text" placeholder="" data-mask="999999999999" class="form-control" id="AUTH_CODE" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Телефон</label>
                        <input name="TEL_NUM" type="tel" data-mask ="+7-999-999-99-99" placeholder="" class="form-control" id="TEL_NUM" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Почта</label>
                        <input name="EMAIL" type="email" placeholder="" class="form-control" id="EMAIL" required=""/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save_pos" type="submit" class="btn btn-primary">Сохранить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    function change_label(){
        var usertype = $('#USER_TYPE').val();
        if(usertype == 1){
            $('#username').html('Имя');
            $('#authcode').html('ИИН');
        }else if(usertype == 2){
            $('#username').html('Название компании');
            $('#authcode').html('БИН');
        }
    }
</script>











