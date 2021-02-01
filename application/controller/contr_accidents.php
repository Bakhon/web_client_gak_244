<?php
    array_push($js_loader,  
        'styles/js/plugins/select2/select2.full.min.js',
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
        'styles/js/demo/contracts_osns.js'
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
    
    $cnctid = $_GET['CNCT_ID'];
    $id_insure = $_GET['id_ins'];
    $sic_id = $_POST['sicIdInpName'];
    $age = $_POST['ageVictim'];
    $reason = $_POST['reason'];
    $accident_date = $_POST['accident_date'];
    $ordinalnum = $_POST['ordinalnum'];
    $iCONTRACT_DATE = $_POST['iCONTRACT_DATE'];
    $guiltDegree = $_POST['guiltDegree'];
    
    $profess = $_POST['profess'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $salaryOfficial = $_POST['salaryOfficial'];
    $shortDesc = $_POST['shortDesc'];
    $harmDate = $_POST['harmDate'];
    $accidentPlace = $_POST['accidentPlace'];
    
    $diagnoz = $_POST['diagnoz'];
    $conclusionNum = $_POST['conclusionNum'];
    $iCONTRACT_DATEconclusionNum = $_POST['iCONTRACT_DATEconclusionNum'];
    $actN1Num = $_POST['actN1Num'];
    $iCONTRACT_DATEactN1Num = $_POST['iCONTRACT_DATEactN1Num'];
    $mseConcNum = $_POST['mseConcNum'];
    $iCONTRACT_DATEmseConcNum = $_POST['iCONTRACT_DATEmseConcNum'];
    
    $supt = $_POST['supt'];
    
    $harmfulFactor = $_POST['harmfulFactor'];
    
    $NOM_SUD = $_POST['NOM_SUD'];
    $DATE_SUD = $_POST['DATE_SUD'];
    $paymentReasInpName = $_POST['paymentReasInpName'];
    
    $relatives = $_POST['relatives'];
    
    if(isset($_POST['insurant'])){
    $sql = "begin payments.save_ns(
                    null,".
                    $cnctid.",
                    ".$id_insure.",
                    ".$sic_id.",
                    22020,
                    ".$age.",
                    $reason,
                    '$accident_date',
                    $ordinalnum,
                    '$iCONTRACT_DATE',
                    '01/12/2010',
                    $guiltDegree,
                    'Тяжелая',
                    0,
                    0,
                    '$profess',
                    '$position',
                    $salary,
                    $salaryOfficial,
                    '$shortDesc',
                   ' $harmDate',
                    '$accidentPlace',
                    '$shortDescAboutCircs',
                    '$diagnoz',
                    $conclusionNum,
                    '$iCONTRACT_DATEconclusionNum',
                    $actN1Num,
                     '$iCONTRACT_DATEactN1Num',
                    $mseConcNum,
                     '$iCONTRACT_DATEmseConcNum',
                    $supt,
                    777777,
                    $harmfulFactor,
                    0,
                    $NOM_SUD,
                    '$DATE_SUD',
                    '$paymentReasInpName',
                    2,
                    $relatives,
                    777,
                     ' 01/12/2010',
                    77,
                    null,
                    null,
                    1160,
                    null,
                    null,
                    null,
                    011,
                    null,
                    null,
                    null,
                   ' 01/12/2010',
                   ' 01/12/2010'
);
       end;";
    
    echo $sql;
    
    $db = new DB3();
    $rs = $db->ExecProc($sql);
    }
    
    if(isset($_POST['lastname'])){
        $ss1 = '';
        $ss2 = '';
        $db = new DB3();
        if($_POST['lastname'] == ''){
            echo 'Введите фамилию!';
            exit;
        }else{$lastname = $_POST['lastname'];}
        $sql = "SELECT * from clients WHERE LASTNAME LIKE upper ('%$lastname%')";
        if($_POST['firstname'] !== ''){
            $ss1 = "AND FIRSTNAME LIKE upper ('%".$_POST['firstname']."%')";
        }
        if($_POST['middlename'] !== ''){
            $ss2 = "AND MIDDLENAME LIKE upper ('%".$_POST['middlename']."%')";
        }
        $rsClients = $db->Select($sql.$ss1.$ss2);
        if(count($rsClients) > 0){
    foreach($rsClients as $k => $v){
    ?>        
                    <tr class="gradeX" data="<?php echo $v['SICID']; ?>">
                            <td><?php echo $v['LASTNAME']; ?></td>
                            <td><?php echo $v['FIRSTNAME']; ?></td>
                            <td><?php echo $v['MIDDLENAME']; ?></td>
                            <td><?php echo $v['BIRTHDATE']; ?></td>
                    </tr>
            
        
    <?php
        }
    ?>
        <script>
            $(document).on('click','tr',function(){
                  var text = $(this).text(); // получаем значение со строки "td"
                  //$('#insurantInpId').val(text);
                  console.log(text);
            });
        </script>
        <script>
            $('#clientsTable tr').click(function(){
                var tr = $(this);
                $('.gradeX').attr('class', 'gradeX');
                tr.attr('class', 'gradeX active');
                var s = tr.attr('data');
                console.log($(this).attr('data'));
                $('#sic_idInp').val(s);
                });
        </script>
    <?php
        exit;
        }else{?>
            <h1>Ничего не найдено!</h1>
            <button class="btn btn-sm btn-primary" onclick="window.location.href='clients_edit?sicid=0&create_type=3'"><strong>Добавить клиента</strong></button>;
        <?php    exit;
        }
    }
    
    if(isset($_POST['sic_id'])){
        $sql = "SELECT * from clients where SICID = ".$_POST['sic_id'];
        $db = new DB3();
        $rsClientInfo = $db->Select($sql);
        echo json_encode($rsClientInfo[0]);
        exit;
    }
    
    if(isset($_GET['sicid'])){
        $db = new DB3();
        $sql = "SELECT * from clients where SICID = 777777";
        $rsClientInfo = $db->Select($sql);
    }

    if(isset($_POST['id_ins'])){
        $dbStrahovatelname = new DB3();
        $sqlStrahovatelname = "select name from contr_agents where id =".$_POST['id_ins'];
        $listDbStrahovatelname = $dbStrahovatelname->Select($sqlStrahovatelname);
        foreach($listDbStrahovatelname as $k => $v){
            echo $v['NAME'];
        }
        exit;
    }
?>

                                
                        
                        
                        