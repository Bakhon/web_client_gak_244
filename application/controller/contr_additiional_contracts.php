<?php    
    $db = new DB();
    $dan = array();
    
    if(isset($_POST['iCONTRACT_NUM_ADDIT'])){
        $sql_set_addit_doc = "";
        
    }
    
    if(isset($_GET['CNCT_ID'])){
        $CNCT_ID = $_GET['CNCT_ID'];
    }
    $doc_num = $_GET['DOC_NUM'];
    //проверка наличия допок
    $sql_inspection = "select 
                          contract_num
                        from 
                          contracts 
                        where 
                          CONTRACT_NUM LIKE '%$doc_num%'";
    $list_inspection = $db -> Select($sql_inspection);
    $addit_num = '/Д'.count($list_inspection);
    //echo $addit_num.'<br>';
    //echo '<pre>';
    //print_r($list_inspection);
    //echo '<pre>';
    //if($list_inspection == ''){
        //$last_addit_contract_num = 'Д1';
    //}
    
    if(isset($_POST['secondname_otvetstvennoe'])){
        $secondname = $_POST['secondname_otvetstvennoe'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $sqlInj = $_POST['sql'];
        $sql = "insert into dic_person_kos (id, lastname, firstname, middlename, branch_id) values (SEQ_dic_person_kos.nextval, '$secondname', '$firstname', '$middlename', '".$active_user_dan['brid']."')";
        $listPersonKos = $db -> Select ($sql);
        exit;
        
        //0000"; $sql = "insert into dic_person_kos (id, lastname, firstname, middlename, branch_id) values (SEQ_dic_person_kos.nextval, 'sql', 'sql', 'sql', 0000)"; $listPersonKos = $db -> Select ($sql);         exit;
    }
    
    /*список фирм в алерте хранителя*/
    if(isset($_POST['fizLitsoInp'])){
            $lastname = '';
            $name = '';
            $middlename = '';
            $ss = explode(' ', $_POST['fizLitsoInp']);            
            //echo $ss[0];
            //sicid, lastname||' '||firstname||' '||middlename fio, birthdate, get_age(sysdate, birthdate) vozrast
            $sqlStrahovatel = "select sicid KOD, lastname||' '||firstname||' '||middlename name, get_age(sysdate, birthdate) vozrast from clients 
            where upper(lastname) like upper('".$ss[0]."%')";
            
            //if(isset($ss[0])){$lastname = $ss[0];}            
            
            if(isset($ss[1])){
               $name = $ss[1];
               $sqlStrahovatel .= " and upper(firstname) like upper ('%$name%')";   
            }
            if(isset($ss[2])){
               $middlename = $ss[2];
               $sqlStrahovatel .= " and upper(middlename) like upper ('%$middlename%')";
            }
            
            
        
        /*if(isset($_POST['ur_lico'])){
            $ss = $_POST['ur_lico'];             
            $sql = "select id KOD, name, '' birthdate  from contr_agents where upper(name) like upper('%$ss%')";
        }*/        
                
        $dbAnnuitSearch = $db->Select($sqlStrahovatel);
        if (empty($dbAnnuitSearch)){
            echo '<h1>Ничего не найдено</h1>';
            exit;
        }
        else
        {
        foreach($dbAnnuitSearch as $k => $v){
           echo '<tr class="gradeX" data="'.$v['NAME'].'" title="'.$v['VOZRAST'].'" contextmenu="'.$v['KOD'].'">
                     <td>'.$v['KOD'].'</td>
                     <td>'.$v['NAME'].'</td>
                     <td>'.$v['VOZRAST'].'</td>
                 </tr>';
                };
        }
        exit;
        }
             
    /*Данные страхователя*/
    if(isset($_POST['id_insur_dan'])){
        $dan = array();         
        $sql = "select 0 id, null id_filial, c.id id_insur, 'Страхователь' name, d.oked, c.oked_id, d.risk_id, d.tarif from contr_agents c, dic_oked_afn d where d.id(+) = c.oked_id and  C.ID = ".$_POST['id_insur_dan'];
        $db->ClearParams();
        $db->Select($sql);
        $dan['oked_id'] = $db->row[0]['OKED_ID'];
               
        $st = $db->row;
        
        $db->ClearParams();
        $sql = "select * from CONTR_AGENTS_FILIAL where id_insur = ".$_POST['id_insur_dan'];
        $r = $db->Select($sql);   
        if(count($r) > 0){
            foreach($r as $k=>$v){
                array_push($st, $v);
            }
        }        
        $dan['filials'] = $st;
        
        echo json_encode($dan); 
        exit;
    }
        
    if(isset($_POST['AKTN1TABLE'])){
        echo OSNS::Tables_AktN1($_POST['DOLZHN'], $_POST['FIO'], $_POST['ACT_NOM'], $_POST['ACT_DATE'], $_POST['REASON'], $_POST['AVG_ZP'], $_POST['AGE'], $_POST['VINA'], $_POST['id']);
        exit;
    }
    
    /*Выбор основного вида деятельности*/
    if(isset($_POST['osn_vid_deyatel'])){
        $id = $_POST['osn_vid_deyatel'];
        $sqlOsnVidDeyat = "SELECT id, name_oked ved_name, oked, risk_id, NAME, t_min, t_max FROM dic_oked_afn where id = '$id' ORDER  BY oked";    
        $db->ClearParams();
        $dbOsnVidDeyat = $db->Select($sqlOsnVidDeyat);
        echo json_encode($dbOsnVidDeyat[0]); 
        exit;
    }
    
    /*Данные агента*/
    if(isset($_POST['agent_dan'])){
        $db->ClearParams();
        $r = $db->Select("select 'Договор № '||a.CONTRACT_NUM||' от '||a.CONTRACT_DATE_BEGIN osnovanie, A.PERCENT_OSNS, A.PERCENT, A.PERCENT_OSOR  from agents a where a.id = ".$_POST['agent_dan']);        
        echo json_encode($r[0]);        
        exit;
    }   
    
    /*Расчетная часть калькулятора*/
    if(isset($_POST['calc_osns_new'])){
        OSNS::Calc_osns_new();
        exit;
    }
    
    /*Некоторые параметры которые не будут видны в договорах*/    
    $others_params = array();    
    $others_params['ihead'] = 0;
    $others_params['icnct'] = 0;
    $others_params['ireason_dop'] = '';
    $others_params['istate'] = 0; 
    $others_params['iPAYM_CODE'] = $paym_code;                 
    $others_params['iDATE_CALC'] = date("d/m/Y");
    $others_params['iEMP_ID'] = $active_user_dan['role']; 
    
        
    if(isset($_GET['CNCT_ID'])){    
        $cnct_id = $_GET['CNCT_ID'];
        
        $db->ClearParams();
        $contracts = $db->Select("select * from contracts where CNCT_ID = $cnct_id 
        union all 
        select * from contracts_maket where CNCT_ID = $cnct_id");
        
        $db->ClearParams();
        $osns_calc = $db->Select("select * from OSNS_CALC where CNCT_ID = $cnct_id");
        
        $db->ClearParams();
        $akt1 = $db->Select("select * from OSNS_ACT_N1 where CNCT_ID = $cnct_id");
        
        $db->ClearParams();
        $osns_calc_new = $db->Select("select case when o.id_filial = 0 then 'Страхователь' else c.name end name, o.* 
        from osns_calc_new o, CONTR_AGENTS_FILIAL c where o.id_filial = c.id(+) and o.cnct_id = $cnct_id");
        
        $db->ClearParams();
        $osns_pril2 = $db->Select("select 
            case 
                when o.id_filial = 0 then 'Страхователь' 
                else c.name 
            end name,
            case 
                when o.id_filial = 0 then (select oked from contracts_maket where cnct_id = o.cnct_id union all select oked from contracts where cnct_id = o.cnct_id)
                else c.oked
            end oked, 
            o.* 
        from OSNS_PRIL2 o, CONTR_AGENTS_FILIAL c where o.id_filial = c.id(+) and o.cnct_id = $cnct_id");
        
        $db->ClearParams();
        $transh = $db->Select("select * from TRANSH where CNCT_ID = $cnct_id");
        
        $db->ClearParams();
        $agent = $db->Select("select 'Договор № '||a.CONTRACT_NUM||' от '||a.CONTRACT_DATE_BEGIN osnovanie, A.PERCENT_OSNS, A.PERCENT, A.PERCENT_OSOR  from agents a where a.id = ".$contracts[0]['SICID_AGENT']);
        
        $db->ClearParams();
        $oked_dan = $db->Select("select * from dic_oked_afn where id = ".$contracts[0]['OKED_ID']);
        
        $db->ClearParams();
        $bad_sluch = $db->Select("select case 
                                        when o.id_filial = 0 then 'Страхователь' 
                                        else (select name from CONTR_AGENTS_FILIAL where id = o.id_filial) 
                                    end name, o.* from OSNS_STAT_ACCIDENT o where o.cnct_id = $cnct_id");
        
        $dan['contracts'] = $contracts;
        $dan['osns_calc'] = $osns_calc;
        $dan['osns_calc_new'] = $osns_calc_new;
        $dan['osns_pril2'] = $osns_pril2;
        $dan['akt1'] = $akt1;
        $dan['transh'] = $transh;
        $dan['agent_dan'] = $agent[0];
        $dan['oked_dan'] = $oked_dan[0];
        $dan['bad_sluch'] = $bad_sluch;
        
        $others_params['ihead'] = $contracts[0]['ID_HEAD'];
        $others_params['icnct'] = $contracts[0]['CNCT_ID'];
        $others_params['ireason_dop'] = $contracts[0]['ID_REASON'];
        $others_params['istate'] = $contracts[0]['STATE'];
        $others_params['iPAYM_CODE'] = $contracts[0]['PAYM_CODE'];                 
        $others_params['iDATE_CALC'] = $contracts[0]['DATE_CALC'];
        $others_params['iEMP_ID'] = $contracts[0]['EMP_ID'];
        
        //$paym_code = $r[0]['PAYM_CODE'];  
        
        $page_title = 'Договора';
        $panel_title = 'Редактирование договора';
    
        $breadwin[] = 'Договора';
        $breadwin[] = 'Редактирование договора';    
        $breadwin[] = 'ОСНС';  
        
    }else{
        $page_title = 'Договора';
        $panel_title = 'Регистрация нового договора';
    
        $breadwin[] = 'Договора';
        $breadwin[] = 'Регистрация нового договора';    
        $breadwin[] = 'ОСНС';
        $cnct_id = 0;
    }
    
    
    if(count($_POST) > 0){  
        if(isset($_POST['save_osns'])){
            OSNS::SaveOSNS($_POST);  
            $dan = $_POST;
        }else{
            exit;   
        }        
    }
        
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
    
    //Задаем первоначальные параметры SQL тескта    
    $sqlStrahovatel = "SELECT id kod, NAME, ved_id, group_id, bin FROM contr_agents WHERE type IN (1,3 )";
    if(isset($active_user_dan['role_type'])){
        if($active_user_dan['role_type'] !== '0'){
            $sqlStrahovatel .= ' and asko = '.$active_user_dan['role_type'];
        }        
    }
    
    $db->ClearParams();           
    $dbStrahChose = $db->Select($sqlStrahovatel);
    $dbAnnuitSearch = $db->Select($sqlStrahovatel);
    
    $sqlOsnVidDeyat = "SELECT id, name_oked ved_name, oked, risk_id, NAME, t_min, t_max FROM dic_oked_afn ORDER  BY oked";    
    $db->ClearParams();
    $dbOsnVidDeyat = $db->Select($sqlOsnVidDeyat);    
    $br = $active_user_dan['brid'];
    $sqlAgent = "
        select a.id kod, decode(a.vid,1,lastname || ' '|| firstname||' '||middlename,a.org_name) name, a.CONTRACT_NUM, a.CONTRACT_DATE_BEGIN, a.PERCENT_OSNS 
        from agents a where a.state = 7 and a.date_close is null and a.vid not in (4, 5) 
        and A.BRANCHID = '$br'
        union all 
        select a.id kod, decode(a.vid,1,lastname || ' '|| firstname||' '||middlename,a.org_name) name, a.CONTRACT_NUM, a.CONTRACT_DATE_BEGIN, a.PERCENT_OSNS 
        from agents_branch_other b, agents a where a.id = b.id and a.state = 7 and a.vid not in (4, 5) and a.date_close is null and b.branchid = '$br'
        union all
        select a.id kod, decode(a.vid,1,lastname || ' '|| firstname||' '||middlename,a.org_name) name, a.CONTRACT_NUM, a.CONTRACT_DATE_BEGIN, a.PERCENT_OSNS
        from agents a where a.state = 7 and a.date_close is null and a.vid not in (4, 5) 
        and a.id = 1620
    ";    
                
    $db->ClearParams();
    $dbAgent = $db->Select($sqlAgent);
    
    $asko = 'is null';
    if(isset($active_user_dan['role_type'])){
        if((trim($active_user_dan['role_type']) !== '0')or(trim($active_user_dan['role_type']) !== '')){
            $asko = ' = '.$active_user_dan['role_type'];
        }
    }
    
    $sqlAffiliate = "SELECT rfbn_id kod, rfbn_id||' - '|| NAME NAME FROM dic_branch WHERE asko $asko ORDER  BY NAME";    
    $db->ClearParams();
    $dbAffiliate = $db->Select($sqlAffiliate);
    
    $sqlFund = "SELECT id kod, NAME, ved_id, group_id FROM contr_agents WHERE  type = 2 AND actual = 1";
    $db->ClearParams();
    $dbFund = $db->Select($sqlFund);
    
    $sqlPrevKszh = "SELECT id kod, NAME FROM contr_agents WHERE type = 5 AND actual = 1";    
    $db->ClearParams();
    $dbPrevKszh = $db->Select($sqlPrevKszh);
    
    $sqlBank = "SELECT bank_id kod, NAME, kor_account FROM dic_banks WHERE status = 0";    
    $db->ClearParams();
    $dbBank = $db->Select($sqlBank);
    
    $sqlDisease = "SELECT num_id kod, naimen NAME FROM dobr_spr_zab";    
    $db->ClearParams();
    $dbDisease = $db->Select($sqlDisease);
    
    $sqlProfessional = "SELECT num_id kod, naimen NAME FROM dobr_spr_prof";    
    $db->ClearParams();
    $dbProfessional = $db->Select($sqlProfessional);
    
    $sqlSport = "SELECT num_id kod, naimen NAME FROM dobr_spr_sport";    
    $db->ClearParams();
    $dbSport = $db->Select($sqlSport);
    
    $sqlCountry = "SELECT num_id kod, naimen NAME FROM dobr_country";    
    $db->ClearParams();
    $dbCountry = $db->Select($sqlCountry); 
    
    $default_branch = '';
    
    if(isset($active_user_dan['brid'])){
        $default_branch = $active_user_dan['brid'];
    }

   ?>     
   
