<?php

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
        'styles/css/plugins/select2/select2.min.css'        
    );
    
    $db = new DB3();
    
    $id = $_GET['id'];     

    $sql_t = "select dic.ID, dic.name, dic.ID_DIC_CONTRACTS, d.name name_1 from DIC_CONTRACTS_INSURANCE dic, DIC_CONTRACT d where d.id = dic.ID_DIC_CONTRACTS and dic.ID_DIC_CONTRACTS = $id";
    $list_t_s = $db -> select($sql_t);        
    
    

    
    if(isset($_POST['id_condition'])) {
    $idr = $_POST['subject'];
    print_r($_POST);
    
    $dan['list_type_contracts'] = $db->Select("select * from DIC_CONTRACT_CONDITION where ID_CONDITION_CONTR = $idr and SOCHETANIE = 0 order by id");  
    $q['list_type_contracts'] = $dan['list_type_contracts'];
    $dan['list_type_contracts2'] = $db->Select("select * from DIC_CONTRACT_CONDITION where ID_CONDITION_CONTR = $idr and SOCHETANIE = 1 order by id");
    $q['list_type_contracts2'] = $dan['list_type_contracts2'];
    $dan = $q[0];
    echo json_encode($dan);                                                                 
    exit; 
    }
                            
?>