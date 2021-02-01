<?php            
    if(!isset($_GET['CNCT_ID'])){exit;}
        
    $db = new DB3();    
    $load_page = '';
    $cnct_id = $_GET['CNCT_ID'];
    $sql = "
    select ID_INSUR, cnct_id, paym_code, progr_name(paym_code) progr_name, level_r from contracts where cnct_id = $cnct_id
    union all
    select ID_INSUR, cnct_id, paym_code, progr_name(paym_code) progr_name, level_r from contracts_maket where cnct_id = $cnct_id
    ";
    
    $r = $db->Select($sql);
    if(count($r) <= 0){
        $r = $db->Select("select D.*, progr_name(paym_code) progr_name from dobr_dogovors D where cnct_id = $cnct_id");
    }
    $r = $r[0];
        
    $files = $db->Select("select d.*, level_name(d.ID_ROLE) level_name, r.NAME otvetstv, c.id id_cf, c.CNCT_ID, c.ID_FILES, c.FILENAME, C.NOTE 
    from  dic_fails d, dir_role r, CONTRACTS_FILES c  where  d.ID_ROLE = r.ID and c.ID_FILES(+) = d.ID 
    and c.CNCT_ID(+) = $cnct_id
    and d.PAYM_CODE = substr('".$r['PAYM_CODE']."', 1, 2) 
    and d.LEVEL_R = ".$r['LEVEL_R']." order by d.ID");
    
    $sqls = new SQLS();
    if(substr($r['PAYM_CODE'], 0, 2) == '01'){
        $load_page = 'pa';
        $dan = $sqls->PA($cnct_id);        
    }
    if(substr($r['PAYM_CODE'], 0, 2) == '02'){
        $load_page = 'osor';
        $dan = $sqls->OSOR($cnct_id);
    }
    if(substr($r['PAYM_CODE'], 0, 2) == '07'){
        $load_page = 'osns';
        $dan = $sqls->OSNS($cnct_id, $db); 
    }
    
    if(substr($r['PAYM_CODE'], 0, 2) == '06'){        
        $load_page = 'hranitel';                            
        require_once 'methods/new_contract/hranitel.php';                        
        $contract = new NEW_CONTRACT();
        $dan = $contract->dan;
        //$dan = $sqls->HRANITEL($cnct_id);        
    }
    
    if(substr($r['PAYM_CODE'], 0, 2) == '04'){        
        $load_page = 'hranitel';                            
        require_once 'methods/new_contract/hranitel.php';                        
        $contract = new NEW_CONTRACT();
        $dan = $contract->dan;
        //$dan = $sqls->HRANITEL($cnct_id);        
    }
    
    if(count($_POST) > 0){
        if(isset($_POST['set_state'])){
            $cnct_id = $_POST['cnct_id'];
            $type = $_POST['type'];
            $role = $active_user_dan['role'];
            $btncl = $_POST['btncl'];
            $sql = "begin card.Setstate_new('$cnct_id','$role','$type', $btncl,''); end;";            
            $r = $db->Execute($sql);
            
            $r = str_replace('&quot;', '', $r);
            echo $r;
            exit;
        }
        if(isset($_POST['prichina_arhive'])){            
            OSNS::move_arhive($_POST['cnct_id_arhive'], $_POST['isfile_arhive'], $_POST['prichina_arhive']);                        
        }
        
        if(isset($_POST['prov_shet'])){
            $d = OSNS::prov_schet_opl($_POST['prov_shet']); 
            echo json_encode($d);            
            exit;
        }
        
        /*
        if(isset($_POST['new_schet_opl'])){
            echo CONTRACTS::new_shet_opl($_POST['new_schet_opl'], $active_user_dan['emp']);            
            exit;
        }
        */
    }
        
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
        'styles/js/others/jquery.printElement.js',        
        'styles/js/others/jquery.scrolltabs.js',
        'styles/js/others/jquery.mousewheel.js',
        'styles/js/plugins/Ilyas/osnsDropDown.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
        );
    
    if(substr($r['PAYM_CODE'], 0, 2) == '06'){
        array_push($js_loader,
        'styles/js/demo/contracts_hranitel_view.js',
        'styles/js/jquery.printPage.js'
        );
    }
    
    if(substr($r['PAYM_CODE'], 0, 2) == '04'){
        array_push($js_loader,
        'styles/js/demo/contracts_hranitel_view.js'        
        );
    }
    
    array_push($css_loader, 
        'styles/css/scrolltabs.css',
        'styles/css/plugins/Ilyas/osnsDropDown.css',
        'styles/css/plugins/sweetalert/sweetalert.css',
        
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
            
    
    $others_js = "
    <script>
    $(document).ready(function(){
        $('.list').scrollTabs();
    });
    </script>";

    
    $page_title = 'Программа страхования';
    $panel_title = $r['PROGR_NAME'];
    
    $breadwin[] = 'Программа страхования';
    $breadwin[] = $r['PROGR_NAME'];         
?>