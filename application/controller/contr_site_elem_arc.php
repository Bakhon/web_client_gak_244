<?php
    $db = new DB();
    
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
        'styles/js/plugins/sweetalert/sweetalert.min.js'
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
                    
                    </script>";


        $sql_words = "select * from SITE_ELEMS_ARC order by DATA_UPD";
        $list_words = $db -> Select($sql_words);
?>


