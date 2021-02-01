<?php
    $db = new DB();
    $db3 = new DB3();

    //построение обьекта Employee
    $ssdId = $_GET['SSD_ID'];

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];

    $today_date = date('d.m.Y');
    $current_year = date("Y");    

    $select_author_id = "select ID from sup_person where EMAIL = '$emp_mail'";
    $list_author_id = $db -> Select($select_author_id);
    $emp_author_id = $list_author_id[0]['ID'];

    //request info
    $shep_requests = "select
                             shep_data.STATE,
                             gbul.IINBIN BIN,
                             gbul.ORGFULLNAMEKZ,
                             gbfl.PHONENUMBER,
                             gbul.ORGFULLNAMEEN, gbul.JURADDRESS,
                             gbul.ISREZIDENT, gbul.ORGSHORTNAMERU,
                             gbul.ORGSHORTNAMEKZ,
                             gbul.ORGSHORTNAMEEN,
                             gbul.BENEFICIARY,
                             gbul.INCCOUNTRY,
                             gbul.ENTERPRISESUBJ,
                             gbul.REGDATE,
                             gbul.AGENCY,
                             gbul.ORGFORM,
                             gbul.FORMOFLAW,
                             gbul.COMMERCEORG,
                             gbul.TYPICALCHARTER,
                             gbul.OWNERSHIP,
                             gbul.ENTERPRISESUBJ,
                             gbul.PRIVATEENTERPRISETYPE,
                             gbul.OKED,
                             gbul.LEADERPERSON,
                             gbul.REGISTERINGDEPARTMENT,
                             gbul.FOREIGNINVEST,
                             gbul.FOUNDERS,
                             gbul.REGISTERINGDEPARTMENT,
                             gbfl.BIRTHDATE,
                             nationality.NAMERU,
                             s.ID,
                             s.SSD_ID,
                             s.REQUESTNUMBER,
                             s.REQUESTOR,
                             s.GBDULFULLINFO,
                             s.GBDFLRESPONSE,
                             gbul.ORGFULLNAMERU,
                             gbfl.SURNAME,
                             gbfl.NAME,
                             gbfl.PATRONYMIC,
                             shep_data.MESSAGEDATE,
                             shep_data.MESSAGETYPE,
                             gbfl.*
                             from SHEP.NATIONALITY nationality, SHEP_DATA_DAN shep_data, SHEP.GBDFLRESPONSE gbfl, SHEP.TABLE_DAN s, SHEP.GBDULFULLINFO gbul where gbul.ID_P = s.GBDULFULLINFO and s.GBDFLRESPONSE = gbfl.ID_P and shep_data.CORELLATIONID = s.SSD_ID and shep_data.CORELLATIONID = '$ssdId' and nationality.ID_P = gbfl.NATIONALITY";
    $shep_requests_list = $db3 -> Select($shep_requests);

    //response info
    $shep_response = "select * from SHEP_DATA_DAN where CORELLATIONID = '$ssdId'";
    $shep_response = $db3 -> Select($shep_response);

    //contragent info
    $bin = $shep_requests_list[0]['BIN'];
    $shep_contragent = "select * from CONTR_AGENTS where BIN = '$bin'";
    $shep_contragent = $db3 -> Select($shep_contragent);
    if(!empty($shep_contragent))
    {
        $state_label = '<div class="form-group has-success"><label class="control-label">Контрагент найден в базе</label></div>';
    }
        else
    {
        $state_label = '<div class="form-group has-error"><label class="control-label">Контрагент не найден в базе</label></div>';
    }
    /*
    echo '<pre>';
    print_r($shep_requests_list);
    echo '<pre>';
    */
    require_once 'methods/new_contract/osns.php';
    $osns = new NEW_CONTRACT();
    $dan = $osns->dan;    
    //region    
    $shep_region_list = $dan['REGION'];

    //agents    
    $shep_agents_list = $dan['AGENT'];

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
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js',
        'styles/js/plugins/footable/footable.all.min.js'
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
        'styles/css/plugins/footable/footable.core.css'
    );

    $othersJs .= "<script>

                        $(document).ready(function () {
                    
                            $('.demo1').click(function(){
                                swal({
                                    title: 'Welcome in Alerts',
                                    text: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
                                });
                            });
                    
                            $('.demo2').click(function(){
                                swal({
                                    title: 'Сохранено!',
                                    text: 'Информация ушла в базу данных!',
                                    type: 'success'
                                });
                            });
                    
                            $('.demo3').click(function () {
                                swal({
                                    title: 'Are you sure?',
                                    text: 'You will not be able to recover this imaginary file!',
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#DD6B55',
                                    confirmButtonText: 'Yes, delete it!',
                                    closeOnConfirm: false
                                }, function () {
                                    swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                                });
                            });
                    
                            $('.demo4').click(function () {
                                swal({
                                            title: 'Are you sure?',
                                            text: 'Your will not be able to recover this imaginary file!',
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#DD6B55',
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'No, cancel plx!',
                                            closeOnConfirm: false,
                                            closeOnCancel: false },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                                            } else {
                                                swal('Cancelled', 'Your imaginary file is safe :)', 'error');
                                            }
                                        });
                            });
                    
                    
                        });
                    
                    </script>
                    <script>
                        $(document).ready(function() {
                
                            $('.footable').footable();
                            $('.footable2').footable();
                        });
                    </script>";
?>


