<?php
    array_push($js_loader,
        'styles/js/plugins/chosen/chosen.jquery.js',        
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
        'styles/js/others/jquery.printElement.js'
    );        
    
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',        
        'styles/css/plugins/chosen/bootstrap-chosen.css',
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
    
    //$sqlDicPersonKos = "select * from dic_person_kos where BRANCH_ID = ".$active_user_dan['brid']." order by id";    
    //$listlDicPersonKos = $db->Select($sqlDicPersonKos);
    
    $paym_code = $_GET['paym_code'];
    if($paym_code == ''){
        exit;
    }
    
    if(substr($paym_code, 0, 2) == '01'){          
        require_once 'methods/new_contract/pa.php';
        $load_page = 'pa';          
        array_push($js_loader, 'styles/js/demo/pa.js');        
    }
    
    if(substr($paym_code, 0, 2) == '02'){        
        require_once 'methods/new_contract/osor.php';
        $load_page = 'osor';
        array_push($js_loader, 'styles/js/demo/contracts_osor.js');
        array_push($js_loader, 'styles/js/plugins/Ilyas/osorQueries.js');
        array_push($js_loader, 'styles/js/plugins/Ilyas/sredZarPl.js');
    }
    
    if(substr($paym_code, 0, 2) == '07'){
        require_once 'methods/new_contract/osns.php';   
        $load_page = 'osns';     
    }
        
    if(substr($paym_code, 0, 2) == '06'){
        require_once 'methods/new_contract/hranitel.php';        
        $load_page = 'hranitel';
        //array_push($js_loader, 'styles/js/demo/contracts_hranitel.js');         
    }   
    
     if(substr($paym_code, 0, 2) == '20'){
        require_once 'methods/new_contract/nszh.php';        
        $load_page = 'nszh';
        //array_push($js_loader, 'styles/js/demo/contracts_hranitel.js');         
    }  
    /*
    if(!file_exists('methods/new_contract/'.$load_page.'.php')){
        echo 'Не найден файл';
        exit;
    }
    */  
    //require_once 'methods/new_contract/'.$load_page.'.php';    
    $NewC = new NEW_CONTRACT();
    $dan = $NewC->dan;