<?php
    //phpinfo();
    array_push($js_loader,        
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_pa.js'
                
        );        
    
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css'
    );
    
    $othersJs = "<script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                'dom': 'lTfigt',
                'tableTools': {
                    'sSwfPath': 'js/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.html', {
                'callback': function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                'submitdata': function ( value, settings ) {
                    return {
                        'row_id': this.parentNode.getAttribute('id'),
                        'column': oTable.fnGetPosition( this )[2]
                    };
                },

                'width': '90%',
                'height': '100%'
            } );

        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                'Custom row',
                'New row',
                'New row',
                'New row',
                'New row' ] );

        }
    </script>";
    
    $db = new DB();
    $Ldap_Users = ACTION::LdapAllListGAK();
    
    if(count($_POST) > 0){
        //Добавление пользователя
        if(isset($_POST['user_login'])){
        
            $ul = array();
            for($i = 0;$i<$Ldap_Users['count'];$i++){
                if($Ldap_Users[$i]['samaccountname'][0] == $_POST['user_login'])
                {
                    $ul = $Ldap_Users[$i];
                }
            }
            
            if(count($ul) > 0){
                if($_POST['user_id'] == 0){
                    $login = $ul['samaccountname'][0];
                    $lastname = $ul['sn'][0];
                    $firstname = $ul['givenname'][0];
                    $email = $ul['mail'][0];
                    $branch = $_POST['account'];
                    $role = $_POST['role'];
                    
                    $sql = "begin webclient.SaveUser('$login', '$lastname', '$firstname', '$email', '$branch', $role); end;"; 
                                                                                                                                   
                    if($db->ExecProc($sql)){
                        $msg .= ALERTS::SuccesMin("Сотрудник успешно добавлен в БД");
                    }
                    
                } 
            }else{
                $msg .= ALERTS::ErrorMin('Неудачное сохранение пользователя! Не найден пользователь в домене! ');
            }                                            
        }
        
        
        
        if(isset($_POST['list_regions'])){
            $db->ClearParams();
            $id = $_POST['list_regions'];
                        
            $rs = $db->Select("select * from dir_role where id = $id");
            
            if($rs[0]['ID_TYPE'] == 0){
                $s = " is null";
            }else{
                $s = " = ".$rs[0]['ID_TYPE'];
            }
            $db->ClearParams();
            $row = $db->Select("select * from dic_branch where asko $s order by 1");
            $htm = '<select class="form-control m-b" name="account">';
            foreach($row as $k=>$v){
                $htm .= '<option value="'.$v['RFBN_ID'].'">'.$v['NAME'].'</option>'; 
            }
            $htm .= "</select>";
            echo $htm;
            exit;
        }
        
        if(isset($_POST['user_dan']))
        {            
            $d = array();
            $p = ACTION::UserdanBase($_POST['user_dan']);
            if(count($p) > 0){
                $d = $p[0]; 
                $d['role'] = ACTION::UserRole($_POST['user_dan']);
            }
            $ul = array();
            
            for($i = 0;$i<$Ldap_Users['count'];$i++){
                if($Ldap_Users[$i]['samaccountname'][0] == $_POST['user_dan'])
                {
                    $ul = $Ldap_Users[$i];
                }
            }     
            $avatar = ''; 
            if(isset($d['AVATAR'])){
                $avatar = $d['AVATAR'];
            }
            
?>
<div class="row m-b-lg">
    <div class="col-lg-6 text-center">
        <h2><?php echo $ul['sn'][0]." ".$ul['givenname'][0]; ?></h2>
        <div class="m-b-sm">
            <img alt="image" class="img-circle" src="<?php echo HTTP_URL_image_user($avatar); ?>" style="width: 62px">
        </div>
    </div>
    <div class="col-lg-6">  
        <?php if($ul['useraccountcontrol'][0] !== '514'){ 
            if(!isset($d['EMP_ID'])){ ?>
        <!--<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#add_user_base"><i class="fa fa-database"></i> Добавить в базу</button>-->
        <?php } ?>
        <button type="button" data-toggle="modal" data-target="#add_message" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-envelope"></i> Отправить сообщение</button>
        <?php if(isset($d['EMP_ID'])){ ?>
        <!--<button type="button" class="btn btn-danger btn-sm btn-block"><i class="fa fa-envelope"></i> Заблокировать</button>-->
        <?php 
            if(count($d['role']) > 0){
                //ECHO '<button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-envelope"></i> Добавить роль</button>';
            }
        }        
        }else{
            echo '<strong><lable class="label label-danger">Данный пользователь заблокирован</lable></strong>';
        } ?>
    </div>
</div>
<div class="client-detail">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">
        <strong>Данные пользователя в домене</strong>
        <ul class="list-group clear-list">
            <li class="list-group-item fist-item">
                <span class="pull-right"> <?php if(isset($ul['department'][0])){echo $ul['department'][0];} ?></span>Департамент
            </li>
            
            <li class="list-group-item">
                <span class="pull-right"> <?php if(isset($ul['title'][0])){echo $ul['title'][0];} ?></span>Должность
            </li>
            
            <li class="list-group-item">
                <span class="pull-right"> <?php if(isset($ul['physicaldeliveryofficename'][0])){echo $ul['physicaldeliveryofficename'][0];} ?></span>Кабинет
            </li>
            
            <li class="list-group-item">
                <span class="pull-right"> <?php if(isset($ul['telephonenumber'][0])){echo $ul['telephonenumber'][0];} ?></span>Телефон
            </li>
            
            <li class="list-group-item">
                <span class="pull-right"> <?php if(isset($ul['mail'][0])){echo $ul['mail'][0];} ?></span>Почта
            </li>
            
            <li class="list-group-item">
                <span class="pull-right"> <?php if(isset($d['NAME'])){echo $d['NAME'];} ?></span>Регион
            </li>
            
            <li class="list-group-item">
                Роль 
                <?php if(isset($d['EMP_ID'])){ ?>                
                <span class="pull-right"> 
                <?php                     
                  if(count($d['role']) > 0){                    
                    foreach($d['role'] as $k=>$v){
                        echo $v['NAME']."<br />";
                    }
                  } 
                ?></span>
                
                <?php }?>
            </li>
        </ul>                
    </div>                                             
</div>
</div>

<?php 
if(!isset($d['EMP_ID'])){
?>
<div class="modal inmodal fade in" id="add_user_base" tabindex="-1" role="dialog" aria-hidden="false" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Новый пользователь</h4>
                <small class="font-bold">Добавление пользователя в Базу Данных</small>
            </div>
            <div class="modal-body">                        
                <form method="POST" class="form-horizontal" id="save_db_user">
                <?php
                    $db->ClearParams();
                    $br = $db->Select("select rfbn_id id, name text from dic_branch order by 1");   
                            
                    $db->ClearParams();
                    $role = $db->Select("select d.*, t.name type_proc from DIR_ROLE d, dir_type_proc t where t.id = d.id_type order by 1");           
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Роль</label>
                    <div class="col-sm-10">
                        <select class="form-control m-b" name="role" id="role">
                        <?php 
                            foreach($role as $k=>$v){
                                echo '<option value="'.$v['ID'].'">'.$v['TYPE_PROC']." - ".$v['NAME'].'</option>';
                            }
                        ?>                
                        </select>                                      
                    </div>
                </div>
                                                        
                <div class="form-group" id="dic_branch">
                    <label class="col-sm-2 control-label">Регион</label>
                    <div class="col-sm-10" id="list_regions">
                        <select class="form-control m-b" name="account">
                        <?php 
                            foreach($br as $k=>$v){
                                echo '<option value="'.$v['ID'].'">'.$v['TEXT'].'</option>';
                            }
                        ?>                
                        </select>                                      
                    </div>
                </div>
                <input type="hidden" name="user_id" value="0"/>
                <input type="hidden" name="user_login" value="<?php echo $_POST['user_dan']; ?>"/>
                                        
                </form>                         
            </div>
            <div class="modal-footer">      
                      
                <button type="button" class="btn btn-primary" onclick="$('#save_db_user').submit();">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>            
        </div>
    </div>
</div>
<?php   
        }
        exit;   
    }
    
}

    if(isset($_POST['docType'])){
        switch($_POST['docType']) {
            case 1:
                ?>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Номер удостоверения личности</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Кем выдан</label>
                        <select id="docTypeSelect" name="doctype " class="select2_demo_1 form-control">
                            <option></option>
                            <option value="1">МЮ РК </option>
                            <option value="2">МВД РК</option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">ИИН</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес проживания</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес прописки</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    
                <?php
                break;
            case 2:
                ?>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Номер удостоверения личности</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Кем выдан</label>
                        <select id="docTypeSelect" name="doctype " class="select2_demo_1 form-control">
                            <option></option>
                            <option value="1">МЮ РК </option>
                            <option value="2">МВД РК</option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">ИИН</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес проживания</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес прописка</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                <?php
                break;
            case 3:
                ?>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Номер вида на жительство</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny">
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Кем выдан</label>
                        <select id="docTypeSelect" name="doctype" class="select2_demo_1 form-control">
                            <option></option>
                            <option value="1">МЮ РК </option>
                            <option value="2">МВД РК</option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">ИИН</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny" required/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес проживания</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny" required/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Адрес прописка</label>
                        <input id="sertNumber" type="text" placeholder="" class="form-control stepenViny" required/>
                    </div>
                <?php
                break;
    }exit;}
    
    
    if(isset($_POST['forajax'])){
        $sql = "insert into sup_person (ID, FIRSTNAME, LASTNAME, MIDDLENAME, TAB_NUM, IIN) VALUES (SUP_PERSON_SEQ.nextval, 'TEST2', 'TEST2', 'TEST2', 111, 222)";
        $listEmployee = $db -> Execute($sql);
        echo '777';
        exit;
    }
    //echo '<pre>';
    //print_r($Ldap_Users);
    //echo '</pre>';
    
    $Ldap_Departments = ACTION::LdapListForDepartments();
    
?>