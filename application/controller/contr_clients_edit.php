<?php    
    $page_title = 'Клиенты';
    $panel_title = 'Регистрация клиентов';    
    
    $breadwin[] = 'Клиенты';
    $breadwin[] = '<a href="clients_edit">Регистрация клиентов</a>';
    
    $colaps = '';
    $load_page = 'search';
    
        
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
        'styles/js/plugins/select2/select2.full.min.js',
        'styles/js/plugins/Ilyas/addClients.js'
                
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
        'styles/css/plugins/select2/select2.min.css',
        'styles/css/style.css'
    );
    
    $othersJs .= '<script>$(".osnVidDeyatelnosty_contr").select2(); $(document).ready(function () {$(".i-checks").iCheck({checkboxClass: "icheckbox_square-green",radioClass: "iradio_square-green",});});</script>';
    
    $dbNewClient = new DB3();
    
    $ivid = 0;
    $seqNextVal = $_GET['sicid'];
        if($_GET['sicid'] == 0){
           $ivid = 1;
           $seqOracle = $dbNewClient -> Select("select seq_clients.nextval from dual");
           $seqNextVal = $seqOracle[0]['NEXTVAL'];
           //$seqNextVal = $_GET['sicid'];
        }
    //
    if(isset($_POST['areaForAjax'])){
        $dbArea = new DB();
        $sqlArea = "select id, code kod, ru_name name from dic_districts";
        $listDbArea = $dbArea->Select($sqlArea);
        echo '<table class="table dataTables-example" id="areaTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Область</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbArea as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    //
    if(isset($_POST['cityForAjax'])){
        $dbCity = new DB();
        $sqlCity = "select id, code kod, ru_name name from dic_region order by name";
        $listDbCity = $dbCity->Select($sqlCity);
        echo '<table class="table dataTables-example" id="cityTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Район</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbCity as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    //
    if(isset($_POST['iinForCheck'])){
        $DBForIIN =  new DB();
        $sqlForIIN = "select IIN from clients where IIN = '".$_POST['iinForCheck']."'";
        $sqlForIINList = $DBForIIN -> Select($sqlForIIN);
        if(isset($sqlForIINList[0]['IIN'])){
            echo 'ИИН уже есть в базе. Проверьте правильность ввода';
        }else{
            echo '7';
        }
        exit;
    }
    //
    if(isset($_POST['countryForAjax'])){
        $dbCountry = new DB();
        $sqlCountry = "select id, code kod, name from DIC_COUNTRIES_ESBD";
        $listDbCountry = $dbCountry->Select($sqlCountry);
        echo '<table class="table dataTables-example" id="countryTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>SURNAME</th>
                        <th>SURNAME</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbCountry as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    
    if(isset($_POST['surnameForAjax'])){
        $dbPerson = new DB();
        $surname = $_POST['surnameForAjax'];
        $sqlLastname = '';
        $sqlMiddlename = '';
        $sqlFin = ' and rownum < 100';
        //echo $surname;
        
        $sqlSurname = "select * from gbdfl.gbl_person_new where Upper(SURNAME) LIKE upper ('%$surname%')";
        if($_POST['firstname'] !== ''){
            $firstname = $_POST['firstname'];
            $sqlFirstname = " and firstname like upper ('%$firstname%')";
            //echo $firstname;
        }
        if($_POST['middlename'] !== ''){
            $middlename = $_POST['middlename'];
            $sqlMiddlename = " and SECONDNAME like upper ('%$middlename%')";
            
        }
        //$sqlSurname = "select *  from gbdfl.gbl_person_new where Upper(SURNAME) LIKE upper ('ИВАНОВ') AND Upper(FIRSTNAME) LIKE upper ( 'авдей') AND Upper(SECONDNAME) LIKE upper ('НИФОНОВИЧ') and rownum < 100";
        $personDB = $dbPerson->Select($sqlSurname.$sqlFirstname.$sqlMiddlename.$sqlFin);
        $allSql = $sqlSurname.$sqlFirstname.$sqlMiddlename.$sqlFin;
        //echo $allSql;
        echo '<div class="form-horizontal scrolltab" style="height: 600px;" id="clientsTable">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                    <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($personDB as $k=>$v){
                    echo '<tr class="gradeX" data="'.$v['IIN'].'">
                            <td>'.$v['SURNAME'].'</td>
                            <td>'.$v['FIRSTNAME'].'</td>
                            <td>'.$v['SECONDNAME'].'</td>
                            <td>'.$v['BIRTH_DATE'].'</td>
                        </tr>';
                    }
        echo '</tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addInfoAboutClientFromGBDFL();">Добавить выбранного</button>
            </div>
            ';
        //print_r ($personDB);
        //echo '</pre>';
        //echo $_POST['surname'];
        ?>
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
        <?
        exit;
    }
    
    if(isset($_GET['sicid'])){
        $editClientsSicidDB = new DB();
        $editClientsSicidSql = "select * from clients where sicid = ".$_GET['sicid'];
        $editClientsSicidList = $editClientsSicidDB -> Select($editClientsSicidSql);
        
    }else{
        $editClientsSicidDB = new DB();
        $editClientsSicidSql = "select * from clients where sicid = 1";
        $editClientsSicidList = $editClientsSicidDB -> Select($editClientsSicidSql);
    }
    //
    if(isset($_POST['iinForAjax'])){
        $dbCountry = new DB();
        $sqlFullInfoAboutclients = "select * from gbdfl.gbl_person_new where IIN = ".$_POST['iinForAjax'];
        $listDbFullInfoAboutclients = $dbCountry->Select($sqlFullInfoAboutclients);
        echo json_encode($listDbFullInfoAboutclients[0]);
        exit;
    }
    
    if(isset($_POST['surname'])){
        
        $dbNewClient = new DB();
        
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $BIRTHDATE = $_POST['BIRTHDATE'];
        $SIK = $_POST['SIK'];
        $RNN = $_POST['RNN'];
        $IIN = $_POST['IIN'];
        $docdate = $_POST['docdate'];
        $docissued = $_POST['docissued'];
        $area = $_POST['area'];
        $region = $_POST['region'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $blockNumber = $_POST['blockNumber'];
        $country = $_POST['country'];
        $adresskaz = $_POST['adresskaz'];
        $adressrus = $_POST['adressrus'];
        $doctype = $_POST['doctype'];
        $docseries = $_POST['docseries'];
        $docnum = $_POST['docnum'];
        $telnum = $_POST['telnum'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $profess = $_POST['profess'];
        $marital_status = $_POST['marital_status'];
        $pension_fund = $_POST['pension_fund'];
        $death_date = $_POST['death_date'];
        $death_date_check = $_POST['death_date_check'];
        $death_check_number = $_POST['death_check_number'];
        $death_issued = $_POST['death_issued'];
        
        
        
        $sqlNewClient = "
                        begin card.new_client(
                $ivid,
                $seqNextVal,
                '$surname',
                '$firstname',
                '$middlename',
                '$BIRTHDATE',
                '11.11.1111',
                '1',
                '$SIK',
                '$IIN',
                '$RNN',
                '1',
                '$doctype',
                '$docdate',
                '$docseries',
                '$docnum',
                '$docissued',
                '1',
                '$death_check_number',
                '$death_date_check',
                '$death_issued',
                '1',
                '$region',
                '$city',
                '$street',
                '$blockNumber',
                '$adresskaz',
                '$adressrus',
                '$telnum',
                '$fax',
                '$email',
                '$profess',
                '$marital_status',
                '1',
                '1',
                '1'
                           );
                end;";
        
        $listDbNewClient = $dbNewClient->Execute($sqlNewClient);
        
        echo $sqlNewClient;
        
        if(isset($_GET['create_type'])){
            Header("Location: accidents?sicid=777777");
        }
            
    }    