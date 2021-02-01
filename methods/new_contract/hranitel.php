<?php            
	class NEW_CONTRACT
    {
        private $db;
        private $array;
        private $user_dan;
        public $dan = array();
        private $filename_load;
        
        public function __construct()
        {
            global $js_loader;
            global $active_user_dan;
            $this->user_dan = $active_user_dan;
            
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();
        }
        
        private function POST()
        {
            //print_r($_POST);exit;
            
            if(count($_FILES) > 0){
                
                if(isset($_FILES['upload_hranitel_file'])){
                    $this->upload_hranitel_file($_FILES['upload_hranitel_file']);                    
                }
                /*
                if($this->file($_FILES)){
                    $this->parse_excel($this->filename_load);
                }
                exit;
                */
            }
            
            if(count($_POST) > 0){                
                $this->array = $_POST;
                foreach($_POST as $k=>$v){                                
                    if(method_exists($this, $k)){                                                                
                        $this->$k($v); 
                    }
                }
            }
        }                
        
        private function GET()
        {            
            $this->array = $_GET;            
            unset($this->array['paym_code']);                        
            if(count($this->array) <= 0){
                //global $load_page;
                //$load_page = 'hranitel_new';
                $this->index();                
            }else{
                foreach($this->array as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
                }
            }             
        }
        
        private function upload_hranitel_file($files)
        {
            global $msg;
            
            foreach($files['name'] as $k=>$v);            
            $id = $k;            
            
            if(!isset($_GET['CNCT_ID']))return false;
            
            $cnct = $_GET['CNCT_ID'];            
            if($id == '')return false;
            if($id == '0')return false;
            if($cnct == '')return false;
            if($cnct == '0')return false;
            
            $q = $this->db->Select("select d.*, level_name(d.ID_ROLE) level_name, r.NAME otvetstv, 
            c.id id_cf, c.CNCT_ID, c.ID_FILES, c.FILENAME, c.NOTE 
            from
            dic_fails d, dir_role r, DOBR_DOGOVORS_FILES c 
            where  
            d.ID_ROLE = r.ID and c.ID_FILES(+) = d.ID 
            and c.CNCT_ID(+) = $cnct and d.PAYM_CODE = '06' 
            and d.LEVEL_R = nvl((select level_r from dobr_dogovors where cnct_id = $cnct and state <> 13), 0) 
            and d.ID = $id");
            $ds = $q[0];
                        
            $uploaddir = 'upload/';
            $uploadfile = $uploaddir . basename($files['name'][$id]);
                        
            if (move_uploaded_file($files['tmp_name'][$id], $uploadfile)) {
                $localfile = $uploadfile;                                                
            } else {
                $msg = ALERTS::ErrorMin('Ошибка загрузки файла');
                return false;
            }
            
            $ftp = new FTP();
            $filename =$files['name'][$id];
            
            if(!$ftp->check_path($cnct)){
                $ftp->create_path($cnct);
            }
            $fs = $ftp->uploadfile2($cnct.'/', $filename, $localfile);
            unlink($filename);
            
            $sql_ins = "INSERT INTO DOBR_DOGOVORS_FILES (ID, CNCT_ID, ID_FILES, FILENAME) 
                VALUES (SEQ_DOBR_DOGOVORS_FILES.nextval, $cnct, $id, '$fs')";
            if(trim($ds['ID_CF']) !== ''){
                $sql = "begin
                delete from DOBR_DOGOVORS_FILES where id = ".$ds['ID_CF'].";
                $sql_ins;
                end;
                ";
            }else{
                $sql = $sql_ins;
            }
                        
            if(!$this->db->Execute($sql)){
                $msg = $this->db->message;
                return false;
            }
            header("Location: contracts?CNCT_ID=$cnct");
            exit;
        }
        
        private function raznica_date()
        {
            $d1 = $this->array['date_begin'];
            $d2 = $this->array['date_end'];
            
            $q = $this->db->Select("select round((to_date('$d2', 'dd.mm.yyyy') - to_date('$d1', 'dd.mm.yyyy')) / 365) ds from dual");
            echo json_encode($q[0]);
            exit;
        }
        
        private function set_age_raschet($d1)
        {
            $cnt = $this->array['cnt_year'];
            $q = $this->db->Select("select add_months(to_date('$d1', 'dd.mm.yyyy'), 12*$cnt)-1 st from dual");
            echo json_encode($q[0]);
            exit;
        }
        
        private function set_arhive($cnct)
        {
            $qs = $this->db->ExecProc("begin voluntary.move_archive($cnct, ''); end;", array());
            echo json_encode($qs);
            exit;            
        }
        
        private function set_state($cnct)
        {
            $btn = $this->array['set_state_btn'];
            global $active_user_dan;                                    
            $role = $active_user_dan['role'];
            
            $result = array(
                "exec" => true,
                "error" => ''
            );
            $qs = $this->db->ExecProc("begin voluntary.NewState($cnct, '$role', '$btn', null); end;", array());
            echo $qs['error'];
            exit;
        }
        
        private function file($f)
        {
            ini_set('display_errors','On');
            error_reporting(E_ALL | E_STRICT);
                        
            $fileName = basename($f["file"]["name"]);              
            $p = explode('.', $fileName);
            $s = count($p);            
            $fileName = time().'.'.$p[$s-1];              

            define ('SITE_ROOT', realpath(dirname(__FILE__)));            
            $targetFilePath = SITE_ROOT.'/../../upload/'.$fileName;
                        
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);                        
            $allowTypes = array('csv','xls','xlsx');
                  
            if(in_array($fileType, $allowTypes)){
                //chmod(SITE_ROOT.'/../../upload/', 0755);
                if(move_uploaded_file($f["file"]["tmp_name"], "upload/".$fileName)){
                    $this->filename_load = "upload/".$fileName;
                    return true;
                }else{
                    $this->filename_load = '';
                    return false;
                }
            }else{
                $this->filename_load = '';
                return false;
            }
            
            exit;
        }
        
        private function parse_excel($file_name)
        {
            $html = '<div class="tabs-container" style="over">';
                        
            if(file_exists('methods/Excel/PHPExcel/IOFactory.php')){
                require_once 'methods/Excel/PHPExcel/IOFactory.php';            
                
                $sheet = array();
                $tabs = array();
                $ul = '<ul class="nav nav-tabs">';
                $tabs = '<div class="tab-content ">';
                $i = 0;
                
                $xls = PHPExcel_IOFactory::load($file_name);                
                $s = $xls->getSheetNames();
                foreach($s as $k=>$v){
                    $s = '';
                    if($i == 0){$s = 'active';}
                    $ul .= '<li class="'.$s.'"><a data-toggle="tab" href="#sheet-'.$i.'">'.$v.'</a></li>';
                    $tabs .= '<div id="sheet-'.$i.'" class="tab-pane '.$s.'"><div class="panel-body">';
                    $tabs .= '<table class="table table-bordered excel_table">';
                    
                    $sheet[$k]['sheetname'] = $v;
                    $xls->setActiveSheetIndex($k);                    
                    $sh = $xls->getActiveSheet();
                    
                    for ($i = 1; $i <= $sh->getHighestRow(); $i++) {
                        $tabs .= '<tr class="row_'.$i.'">';
                        $nColumn = PHPExcel_Cell::columnIndexFromString($sh->getHighestColumn());                         
                        for ($j = 0; $j < $nColumn; $j++) {                            
                            $value = $sh->getCellByColumnAndRow($j, $i)->getValue();
                            $sheet[$k]['cells'][$i][$j] = $value;
                            
                            $ssp = '<li><a href="#" class="prov_user">Проверить</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="del_row">Удалить строку</a></li>
                                    <li><a href="#" class="del_col">Удалить колонку</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="set_fio">Установить как ФИО</a></li>
                                    <li><a href="#" class="set_birthday">Установить как Дата рождения</a></li>
                                    <li><a href="#" class="set_iin">Установить как ИИН</a></li>';
                            if(trim($value) == ''){
                                $ssp = '<li><a href="#" class="del_row">Удалить строку</a></li>
                                    <li><a href="#" class="del_col">Удалить колонку</a></li>';
                            }
                            $tabs .= '<td class="column_'.$j.'">                            
                            <div class="btn-group">
                                <a data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false"><span class="caret"></span></a>
                                <ul class="dropdown-menu">'.$ssp.'</ul>
                            </div>
                            <span title="Клик для проверки по ФИО в БД" class="set">'.$value.'</span>
                            </td>';
                        }
                        $tabs .= '</tr>';
                    }
                    $tabs .= '</table></div></div>';
                    $i++;
                }
                //echo json_encode($sheet);
                unlink($file_name);                                                                
            }else{
                echo '';
                exit;
            }
            $ul .= '</ul>';
            $tabs .= '</div>';
            
            $html .= $ul.$tabs;
            $html .= '</div>';
            echo $html;
            exit;
        }
        
        private function index()
        {
            global $page_title, $panel_title, $breadwin;
            
            $page_title = 'Новый договор';
            $panel_title = 'Хранитель';
    
            $breadwin[] = 'Регистрация нового договора';
            $breadwin[] = '"Хранитель"';
            
            $branch = $this->user_dan['brid'];
            
            $sql = "select a.id kod,  decode(a.vid,1,lastname ||' '|| firstname||' '||middlename, a.org_name) name, 
            a.CONTRACT_NUM, a.CONTRACT_DATE_BEGIN
            from agents a where a.state = 7 and a.date_close is null  and a.vid not in (4, 5)";
            
            if($branch !== '0000'){
                $sq = substr($branch, 0, 2);
                $sql .= " and a.branchid like '%$sq%'";
            }
            
            $sql .= " or a.id in (select b.id from agents_branch_other b where b.branchid = '$branch')";
                                    
            $this->dan['AGENT'] = $this->db->Select($sql);               
            //echo "select * from DIC_BRANCH where nvl(asko, 0) = 0 and rfbn_id <> '0000' order by 1";
            $this->dan['regions'] = $this->db->Select("select * from DIC_BRANCH where nvl(asko, 0) = 0 and rfbn_id <> '0000' order by 1");            
                        
            $this->dan['osn_product'] = $this->db->Select("SELECT id, name FROM dobr_dic_pokr WHERE  active = 1 and pmain = 1");
            $this->dan['dop_product'] = $this->db->Select("SELECT id, name FROM dobr_dic_pokr WHERE  active = 1 and pmain = 0");
            
            /*
            $this->dan['spr_zab'] = $this->db->Select("select num_id id, naimen name from DOBR_SPR_ZAB");
            $this->dan['spr_prof'] = $this->db->Select("select num_id id, naimen name from DOBR_SPR_PROF");
            $this->dan['spr_sport'] = $this->db->Select("select num_id id, naimen name from DOBR_SPR_SPORT");
            
            $this->dan['spr_zab'] = $this->db->Select("select id, name from DOBR_DIC_NAGRUZ where id_spr = 3");
            $this->dan['spr_prof'] = $this->db->Select("select id, name from DOBR_DIC_NAGRUZ where id_spr = 2");
            $this->dan['spr_sport'] = $this->db->Select("select id, name from DOBR_DIC_NAGRUZ where id_spr = 1");
            */
            $this->dan['spr_ander_nagruz'] = $this->db->Select("select * from DOBR_DIC_SPR order by id");
            
            //$this->dan['spr_city'] = $this->db->Select("select id, naimen name from DOBR_COUNTRY");
            $this->dan['banks'] = $this->db->Select("select bank_id kod, name, kor_account schet from dic_banks where status = 0");            
        }
        
        private function CNCT_ID($cnct)
        {
            $f = substr($_SERVER['REQUEST_URI'], 0, 13);            
            if($f == '/new_contract'){
                $this->edit($cnct);
            }else{
                $this->viewcnct($cnct);    
            }            
            
        }
        
        private function viewcnct($cnct)
        {
            $db = new DB();            
            $q = $db->Select("
            select 
                case 
                    when job_sp in(7, 11, 19) then 1
                    else 0
                 end ps
            from 
                SUP_PERSON 
                where
                job_sp is not null 
                and email = '".trim($_SESSION[USER_SESSION]['login'])."@gak.kz'");    
                                
            $this->dan['pereraschet'] = false;
            
            //Открываем доступ на перерасчет и добавлении нагрузки
            if($q[0]['PS'] == '1'){
                $this->dan['pereraschet'] = true;
            } 
            
            $q = $this->db->Select("select * from sup_person@db_sup where email = '".trim($_SESSION[USER_SESSION]['login'])."@gak.kz'");
            $this->dan['active_user'] = $q[0];
            
            $q = $this->db->Select("select * from LIST_DOBR_DOGOVORS where cnct_id = $cnct");                        
            $this->dan['contract'] = $q[0];
            
            $q = $this->db->Select("select * from DOBR_TABLES_ID where ID_DOGOVOR = $cnct and ID_TABLE = 2");            
            $this->dan['date_rass'] = $q[0];
            
            
            $q_reinsurance = $this->db->select("select bd.contract_num CONTRACT_NUM_R, BD.CONTRACT_DATE CONTRACT_DATE_R, bd.id_reins, bdl.*, r.osns_sumv, r.contract_num, r.date_begin date_begin_r, r.date_end date_end_r, r.perc_s_strah, R.PERC_P_STRAH, R.PERC_S_GAK, R.PERC_P_GAK, R.SUM_P_STRAH sum_p_strah_re, r.sum_p_strah sum_re_p_strah, r.sum_s_gak, sum_p_gak, 
dr.* from BORDERO_DOBR_DOGOVORS bd, BORDERO_DOBR_DOGOVORS_LIST bdl, reinsurance r, dic_reinsurance dr where bd.id = BDL.ID_CONTRACTS and BDL.CNCT_ID = R.ID_DOBR and R.REINSUR_ID = dr.id and r.id_dobr = $cnct");
            $this->dan['reinsurance_new'] = $q_reinsurance[0];
            
            $this->dan['reinsurance_clients'] = $this->db->select("select l.fio, l.age, L.BIRTHDATE, l.cnct_id, L.ID_ANNUIT, l.tarif, l.STR_SUM, r.osns_sumv, r.osns_sump, r.perc_s_strah, l.PAY_SUM_P,  
case 
when r.vid in (3,4) then r.perc_p_strah
else 0
end perc_p_strah,
r.perc_s_gak, r.perc_p_gak, r.sum_s_strah, r.sum_p_strah, R.SUM_S_GAK, r.sum_p_gak, r.vid from LIST_DOBR_DOGOVORS_CLIENTS l, reinsurance r where l.cnct_id = $cnct and l.cnct_id = R.ID_DOBR order by 1");
            
            $this->dan['clients'] = $this->db->Select("select * from LIST_DOBR_DOGOVORS_CLIENTS where cnct_id = $cnct order by 1");
            
            $this->dan['DIC_SPR'] = $this->db->Select("select * from DOBR_DIC_SPR order by id");            
            $this->dan['DIC_POKR'] = $this->db->Select("select * from DOBR_DIC_POKR order by id");
            
            $this->dan['UMENSH'] = $this->db->Select("select * from DOBR_TABLES_ID where id_dogovor = $cnct and id_table = 6");
            
            foreach($this->dan['clients'] as $k=>$v){
                $this->dan['clients'][$k]['obtain'] = $this->db->Select("
                select d.*, C.LASTNAME, C.FIRSTNAME, C.MIDDLENAME, C.IIN, C.BIRTHDATE, C.ADDRESS_RUS, C.SIC, C.RNN 
                from DOBR_OBTAIN d, clients c where c.sicid = d.sicid and d.cnct_id = $cnct and d.sicid_client = ".$v['ID_ANNUIT']);
                                
                $id_annuit = $v['ID_ANNUIT'];
                
                $sqlst = "select * from DOBR_DOGOVORS_CLIENTS_NAGRUS where cnct_id = $cnct and id_annuit = $id_annuit order by id_type";                 
                $this->dan['clients'][$k]['NAGRUZ'] = $this->db->Select($sqlst);
                $this->dan['clients'][$k]['NAGRUZ_TABLE'] = $this->db->Select($sqlst);
                
                $sqlst = "select 
                   dn.id id_nagruz, 
                   dc.id id_calc,
                   dn.cnct_id,
                   dn.id_type,     
                   dn.id_annuit, 
                   dn.name,
                   nvl((select dp.proc from DOBR_DOGOVORS_CLIENTS_N_PROC dp where dp.id_nagruz = DN.ID and dp.id_pokr = DC.ID), 0) proc
                from 
                  DOBR_DOGOVORS_CLIENTS_NAGRUS dn,
                  DOBR_DOGOVORS_CLIENTS_CALC dc
                where 
                  dc.cnct_id = dn.cnct_id  
                  and DC.SICID = DN.ID_ANNUIT  
                  and dn.cnct_id = $cnct 
                  and dn.id_annuit = $id_annuit
                order by dn.id, dn.name";
                $this->dan['clients'][$k]['PROC_NAGRUZ'] = $this->db->Select($sqlst);
                                                
                $this->dan['clients'][$k]['CALC'] = $this->db->Select("select     
                    case 
                        when d.type_pokr = 0 then 'Основное покрытие' 
                        else 'Дополнительное покрытие' 
                    end name_type_pokr,
                    (select name from dobr_dic_pokr where id = d.id_pokr) name_pokr,                    
                    d.*
                from 
                    DOBR_DOGOVORS_CLIENTS_CALC d 
                where 
                    cnct_id = $cnct
                    and d.sicid = ".$v['ID_ANNUIT']." order by d.type_pokr");
                                
                $this->dan['clients'][$k]['ns_docs'] = $this->db->Select("select * from DOBR_DOGOVORS_FILES where id_files = 0 and cnct_id = $cnct and id_annuit = $id_annuit");
                $this->dan['clients'][$k]['ns_check'] = $this->db->Select("select s.id, s.id_file, dd.name 
                from DOBR_DOGOVORS_CLIENTS_NS_DOCS s, DOBR_DIC_DOCUMENTS dd where dd.id = s.ID_FILE and s.cnct_id = $cnct
                and s.sicid = $id_annuit");
                
                $q = $this->db->Select("
                select count(*) cn from DOBR_DIC_DOCUMENTS where id_type in(
                    select  distinct(dp.type_ns) type_ns from DOBR_DOGOVORS_CLIENTS_NS dn, DOBR_DIC_POKR dp 
                    where dn.id_ns = dp.id and cnct_id = $cnct and sicid = $id_annuit
                    union all
                    select 0 type_ns from dual
                )
                ");
                $this->dan['clients'][$k]['count_ns_docs'] = $q[0]['CN'];
                $this->dan['clients'][$k]['list_ns'] = $this->db->Select("select 
                    d.id, 
                    d.id_ns,
                    (select name from DOBR_DIC_POKR where id = d.id_ns) ns_name,
                    d.proc_ns,
                    d.pay_sum
                from 
                    DOBR_DOGOVORS_CLIENTS_NS d 
                where 
                    d.cnct_id = $cnct 
                    and d.sicid = $id_annuit");
                
            }
            
            $this->dan['reinsurance'] = $this->db->Select("
                select s.id ||' - '||s.r_name contag_name, reyting_ag__name(s.estimation, 1) RAG_NAME,
                reyting_ag__name(s.estimation, 2) ESTIMATION, r.* from reinsurance r, dic_REINSURANCE s
                where r.cnct_id = $cnct
                and r.REINSUR_ID = s.ID"
            );
            
             $this->dan['reinsurance_agent_name'] = $this->db->Select("
                select s.id ||' - '||s.r_name contag_name, reyting_ag__name(s.estimation, 1) RAG_NAME,
                reyting_ag__name(s.estimation, 2) ESTIMATION, r.* from reinsurance r, dic_REINSURANCE s
                where r.id_dobr = $cnct
                and r.REINSUR_ID = s.ID"
            );
                       
            
            $this->dan['list_files'] = $this->db->Select("select d.*, level_name(d.ID_ROLE) level_name, r.NAME otvetstv, 
            c.id id_cf, c.CNCT_ID, c.ID_FILES, c.FILENAME, c.NOTE 
            from
            dic_fails d, dir_role r, DOBR_DOGOVORS_FILES c 
            where  
            d.ID_ROLE = r.ID and c.ID_FILES(+) = d.ID 
            and c.CNCT_ID(+) = $cnct and d.PAYM_CODE = '06' 
            and d.LEVEL_R = nvl((select level_r from dobr_dogovors where cnct_id = $cnct and state <> 13), 0) order by d.ID"); 
            
            $this->dan['reason_dops'] = $this->db->Select("select id, reason name from DIC_REASON_DOPS where VID_DOG = '06' and actual = 1");
            
            $q = $this->db->Select("select d.type_strahovatel, d.id_strahovatel from dobr_dogovors d where cnct_id = $cnct");            
            $id_client = $q[0]['ID_STRAHOVATEL'];
            
            if($q[0]['TYPE_STRAHOVATEL'] == '0'){                
                $sqll = "
                    select contract_num, cnct_id from contracts where id_annuit = $id_client 
                    union all 
                    select contract_num, cnct_id from contracts_maket where id_annuit = $id_client
                    union all
                    select num_dog contract_num, cnct_id from dobr_dogovors where id_strahovatel = $id_client
                    ";  
            }else{                
                $sqll = "
                    select contract_num, cnct_id from contracts where id_insur = $id_client 
                    union all 
                    select contract_num, cnct_id from contracts_maket where id_insur = $id_client
                    union all
                    select num_dog contract_num, cnct_id from dobr_dogovors where id_strahovatel = $id_client
                    ";  
            }
            
            $this->dan['list_contract'] = $this->db->Select($sqll);
            
            global $active_user_dan;
            $db = new DB();
            $email = $_SESSION[USER_SESSION]['login'].'@gak.kz';
            $qs = $db->Select("select job_sp from SUP_PERSON where email = '$email'");
            
            $vbtn = false;
            $btn_vikup_sum = false;
            $btn_rastorzh = false;
            if($qs > 0){
                if($qs[0]['JOB_SP'] == '11'){ //ДИТ
                    $vbtn = true;
                    $btn_vikup_sum = true;
                    $btn_rastorzh = true;
                } 
                if($qs[0]['JOB_SP'] == '22'){$vbtn = true;} //ССУ - Кнопка взятие в доход
                
                if($qs[0]['JOB_SP'] == '7'){$btn_vikup_sum = true;} //ДА - кнопка расчет выкупной суммы
                if($qs[0]['JOB_SP'] == '28'){$btn_rastorzh = true;} //СРРиСК - Кнопка расторжение договора
            }
            
            $this->dan['kvitov']['view_btn'] = $vbtn;
            $this->dan['vikup_sum']['view_btn'] = $btn_vikup_sum;
            $this->dan['vikup_sum']['view_btn_rastorzh'] = $btn_rastorzh;
            /*
            $this->dan['kvitov']['list_viplat'] = $this->db->Select("select P.DOC_NMB, P.DOC_DATE, T.NOM,d.* from 
            dobr_kvit d, gak_pay_doc p, transh t where P.MHMH_ID(+) = D.MHMH_ID and D.ID_NUM = $cnct
            and t.cnct_id(+) = d.id_num and T.ID(+) = D.ID_TRANSH");
            */
            $this->dan['grafik'] = $this->db->Select("
                select 
                    t.*,
                    (select count(*) from dobr_kvit where id_transh = t.id) btn_view,
                    pay_sum - nvl((select sum(summa) from dobr_kvit where id_transh = t.id), 0) opl_sum,
                    (select max(mhmh_id) from dobr_kvit where id_transh = t.id) mhmh_id_kvit  
                from 
                    transh t 
                where t.cnct_id = $cnct order by nom");
        }
        
        private function edit($cnct)
        {
            $this->index();
            $this->viewcnct($cnct);     
            $sql = "begin voluntary.SetTempEdit($cnct, :itxt); end;";
            $q = $this->db->ExecuteReturn($sql, array('itxt'));
            $t = explode(',', $q['itxt']);
            $clients  = array();
            foreach($t as $tv){
                $p = explode(':', $tv);
                $clients[$p[0]] = $p[1];
            }
            //print_r($q);                        
            $this->dan['clients_list'] = $clients;
            
            $q = $this->db->Select("select id_pokr from DOBR_DOGOVORS_CLIENTS_CALC where cnct_id = $cnct and type_pokr = 1 group by id_pokr");
            $this->dan['pokritiya'] = $q;
        }
        
        private function reason_dops($id)
        {
            $q = $this->db->Select("select * from dic_reason_dops where id = $id");
            
        }
        
        private function search_fiz_client($text)
        {
            $date = $this->array['date_begin'];
            $q = $this->db->Select("select sicid, lastname||' '||firstname||' '||middlename fio, birthdate, iin, get_age(to_date('$date', 'dd.mm.yyyy'), BIRTHDATE) age from clients 
            where concat(upper(lastname||' '||firstname||' '||middlename), iin) like upper('%$text%')");
            echo json_encode($q);
            exit; 
        }
        
        private function prov_user($text)
        {
            $q = $this->db->Select("select sicid, lastname||' '||firstname||' '||middlename fio, birthdate, iin from clients 
            where concat(upper(lastname||' '||firstname||' '||middlename), iin) like upper('%$text%')");
            echo json_encode($q);
            exit;
        }
        
        private function search_clients($s)
        {
            $b = true;
            if($this->user_dan['brid'] == '0000'){$b = false;}
            if(trim($this->user_dan['brid']) == ''){$b = false;}
            if($this->user_dan['brid'] == '1701'){$b = false;}
            
            $ssq = '';
            $ssl = '';
            if($b){
                $ssq = " and emp_id in(select emp_id from gs_emp where substr(branch_id, 1, 2) = substr('".$this->user_dan['brid']."', 1, 2))";
                $ssl = " and substr(branchid, 1, 2) = substr('".$this->user_dan['brid']."', 1, 2)";
            }
            
            $sql = "select * from(
            select id, name||' ('||bin||') (Юридическое лицо)' name, 1 type_client from contr_agents where concat(upper(name), bin) like upper('%$s%') $ssq 
            union all
            select C.SICID id, C.LASTNAME||' '||C.FIRSTNAME||' '||C.MIDDLENAME||' ('||iin||') (Физическое лицо)' name, 0 type_client from clients c where 
            concat(upper(lastname||' '||firstname||' '||middlename), iin) like upper('%$s%') $ssl
            order by 3
            ) where rownum <= 500";   
                     
            //echo $sql;
            $q = $this->db->Select($sql);
            $q['sql'] = $sql;
            echo json_encode($q);
            exit;
        }
        
        private function gen_zv_num($d)
        {            
            $branch = $this->array['branch'];
            $role = $this->user_dan['role'];        
            $r = $this->db->Select("select gen_zv_num('$branch', '0601000001', '$role') cn from dual");                
            echo trim($r[0]['CN']);        
            exit;
        }
        
        private function gen_contract_num($d)
        {
            $branch = $this->array['branch'];            
            $role = $this->user_dan['role'];            
            $r = $this->db->Select("select gen_contract_num('$d', '$branch', '0601000001', 0, '$role') cn from dual");                    
            echo trim($r[0]['CN']);        
            exit;
        }
        
        private function m_sicid($id)
        {            
            $result = array();                        
            $result['sicid'] = $id;
            
            /*
            $result['error'] = json_encode($_POST);
            echo json_encode($result);
            exit;
            */
            
            $result['error'] = '';
            if(trim($this->array['m_periodich']) == ''){
                $result['error'] = 'Пустое поле "Страховая сумма"!';    
            }
                        
            if(trim($this->array['m_pay_sum_v']).trim($this->array['m_pay_sum_p']) == ''){
                $result['error'] = 'Поле "Страховая сумма" или "Страховая премия" не могут быть пустыми!';    
            }
            
            if(trim($this->array['m_srok']) == ''){
                $result['error'] = 'Пустое поле "Срок страхования"!';    
            }
            
            if(trim($this->array['m_vozrast']) == ''){
                $result['error'] = 'У Данного клиента неопределен возраст. "Расчет не возможен"!';    
            }
            
            //Если у выгодопреобретателя процент стоит ноль            
            //Если имеется ошибка при внесении данных клиента тогда выдаем ее и все...
            if($result['error'] !== ''){
                echo json_encode($result);
                exit;
            }
            
            //-------------------------------------------- Новое сохранение данных--------------------------------------------
            
            //Риски и надбавки
            $risk =  '';
            foreach($this->array['set_risk_ander'] as $k=>$v){
                if($risk !== ''){
                    $risk .= ',';
                }
                foreach($v as $idp=>$name);
                $risk .= $idp.":".$name;
            }
            
            
            //Выгодопреобретатели
            $vogodo_proc = '';
            foreach($this->array['vogodo_proc'] as $k=>$v){
                if($vogodo_proc !== ''){
                    $vogodo_proc .= ',';
                }
                
                $vogodo_proc .= $k.":".$v;
            }
            
            //доп покрытия
            $dop_pokr = '';
            foreach($this->array['m_dop_pokr'] as $s=>$t){
                if($s > 0){
                    $dop_pokr .= ',';
                }
                $dop_pokr .= $t;
            }
            
            $sql = "begin
              voluntary.SetClientTemp(
              to_date('".$this->array['m_date_calc']."', 'dd.mm.yyyy'),               
              '".$this->array['m_type_str']."', 
              '".$this->array['m_sicid']."', 
              to_date('".$this->array['m_date_begin']."', 'dd.mm.yyyy'),
              to_date('".$this->array['m_date_end']."', 'dd.mm.yyyy'),
              '".$this->array['m_rashod_agent']."',
              '".$this->array['m_main_pokr']."',
              '$dop_pokr',
              '".$this->array['m_periodich']."',
              '".$this->array['m_srok']."',
              '".$this->array['m_rost']."',
              '".$this->array['m_ves']."',
              '".$this->array['m_dohod']."',
              '".$this->array['m_pay_sum_v']."',
              '".$this->array['m_pay_sum_p']."',              
              '$risk',
              '$vogodo_proc',
              null,
              :id
              );
            end;";
            
            $q = $this->db->ExecuteReturn($sql, array("id"));
            if($this->db->message !== ''){                
                $result['error'] = $this->db->message;
                echo json_encode($result);
                exit;
            }
            
            $ids = $q['id'];
            
            $dan = array();                        
            foreach($this->array as $k=>$v){
                $ks = substr($k, 2);
                $dan[$ks] = $v;
            }
            
            $form_dan = $dan;
            $q = $this->db->Select("SELECT name FROM DOBR_DIC_POKR WHERE id = ".$dan['main_pokr']);
            $form_dan['main_pokr_name'] = $q[0]['NAME'];
                                                
            $form_dan['rashod_agent_name'] = $this->array['m_rashod_agent'];
                                    
            $periodich_ar = array(
                "0" => "Единовременно",
                "1" => "Ежегодно",
                "2" => "Раз в пол года",
                "4" => "Ежеквартально",
                "12" => "Ежемесячно"
            );
            
            $periodich = $periodich_ar[$this->array['m_periodich']];
            $sql = "select * from table(voluntary.calc_new(
            to_date('".$this->array['m_date_calc']."', 'dd.mm.yyyy'), 
            to_date('".$this->array['m_date_begin']."', 'dd.mm.yyyy'),
            to_date('".$this->array['m_date_end']."', 'dd.mm.yyyy'),
            '$id', 
            '$periodich', 
            '".$this->array['m_pay_sum_v']."',
            '".$this->array['m_pay_sum_p']."',
            '".$this->array['m_srok']."', 
            '".$this->array['m_rashod_agent']."',
            '".$this->array['m_type_str']."', 
            '".$this->array['m_main_pokr']."', 
            '$dop_pokr', 
            '', 
            '', 
            '', 
            '', 
            '0'
            ))";
            $raschet_table = $this->db->Select($sql);
            
            $form_dan['rashet_table'] = $raschet_table;                        
            $form_dan['nagruzki'] = array();
            $form_dan['poluchatel'] = $this->db->Select("select client_name2(sicid_obtain) fio, proc from DOBR_CLIENTS_OBTAIN_TEMP where id_temp = $ids");                
            
            $form_dan['set_risk_ander'] = $this->array['set_risk_ander'];            
            $result['form'] = $this->user_form($form_dan, $this->array['iedit']);
            //$result['form'] .= $sql;   
            
            $result['user_dan'] = $ids;
            
            $q = $this->db->Select("select lastname||' '||substr(firstname, 1, 1)||'. '||substr(middlename, 1,1) fio, c.* from clients c where sicid = $id");            
            $result['tab'] = '<li class="active"><a data-toggle="tab" href="#user_tab_'.$id.'">'.$q[0]['FIO'].'</a></li>';
            
            echo json_encode($result);
            exit;
        }
        
        private function user_form($dan, $iedit = 0)
        {
            $periodich_ar = array(
                "1"=>"Ежегодно",
                "2"=>"Раз в пол года",
                "4"=>"Ежеквартально",
                "12"=>"Ежемесячно",
                "0"=>"Единовременно"
            );
            
            $btn = '';
            if($iedit > 0){
                $btn = '<button style="margin-right: 10px;" data-toggle="modal" data-target="#set_client" class="btn btn-xs btn-warning pull-right edit_user" id="'.$dan['sicid'].'"><i class="fa fa-edit"></i></button>';
            }
            
            $html = '
            <div id="user_tab_'.$dan['sicid'].'" class="tab-pane user_tab_'.$dan['sicid'].' active">
                <div class="panel-body">                    
                    <div class="row">                        
                        <div class="col-lg-12" style="margin-top: -30px;">
                        <button class="btn btn-xs btn-danger pull-right delete_user" id="'.$dan['sicid'].'"><i class="fa fa-trash"></i></button>
                        '.$btn.'                        
                        <div class="form-horizontal">
                            <h3>Данные клиента</h3>                                                        
                            <div class="form-group">
                                <label class="col-lg-2 control-label">ФИО (Дата Рождения)(ИИН)</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" value="'.$dan['fio'].'" readonly>                                                                                                                                         
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Возраст</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['vozrast'].'" readonly>                                                                     
                                </div>                                                                
                            
                                <label class="col-lg-2 control-label">Вес</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['ves'].'" readonly>                                                                     
                                </div>
                            
                                <label class="col-lg-2 control-label">Рост</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['rost'].'" readonly>                                                                     
                                </div>
                            </div>
                                                        
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Агентские расходы</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['rashod_agent_name'].'" readonly>                                                                     
                                </div>
                                
                                <label class="col-lg-2 control-label">Периодичность</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$periodich_ar[$dan['periodich']].'" readonly>                                                                     
                                </div>
                                
                                <label class="col-lg-2 control-label">Срок страхования</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['srok'].'" readonly>                                                                     
                                </div>
                            </div>
                            
                            <div class="form-group">                                                                
                                <label class="col-lg-2 control-label">Годовой доход</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['dohod'].'" readonly>                                                                     
                                </div>
                                                                                            
                                <label class="col-lg-2 control-label">Страховая сумма</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['rashet_table'][0]['PAY_SUM_V'].'" readonly>                                                                     
                                </div>
                                
                                <label class="col-lg-2 control-label">Страховая премия/взнос</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="'.$dan['rashet_table'][0]['PAY_SUM'].'" readonly>                                                                     
                                </div>
                            </div>';
            
            if(count($dan['nagruzki']) > 0){
                $html .= '<hr /><h3>Нагрузки</h3>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Тип</th>
                            <th>Наименование</th>                        
                        </tr>
                    </thead>
                    <tbody>';
                foreach($dan['nagruzki'] as $k=>$v){
                    $html .= '<tr><td>'.$v['TYPE_NAME'].'</td><td>'.$v['NAME'].'</td></tr>';
                }                        
                $html .= '</tbody></table>';
            }
            
            if(count($dan['set_risk_ander']) > 0){                
                $html .= '<hr /><h3>Нагрузки</h3>
                    <table class="table table-bordered">
                    <thead>
                        <tr>                     
                            <th>Вид нагрузки</th>       
                            <th>Наименование</th>                        
                        </tr>
                    </thead>
                    <tbody>';
                foreach($dan['set_risk_ander'] as $k=>$v){
                    foreach($v as $p=>$ts){
                        if($ts !== ''){
                            $qs = $this->db->Select("select * from DOBR_DIC_SPR where id = $p");                            
                            $html .= '<tr>
                                <td>'.$qs[0]['NAME'].'</td>
                                <td>'.$ts.'</td>
                            </tr>';
                        }
                    }
                }                        
                $html .= '</tbody></table>';
            }              
            
            if(count($dan['rashet_table']) > 0){
                $html .= '<hr /><h3>Расчетные данные</h3>
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Тип</th>
                        <th>Наименование</th>
                        <th>Тариф</th>
                        <th>Нагрузка</th>                        
                        <th>Страховая премия</th>
                    </tr>
                </thead>
                <tbody>';
                                
                foreach($dan['rashet_table'] as $k=>$v){
                $html .= '
                    <tr>
                        <td>'.$v['TYPE_NAME'].'</td>
                        <td>'.$v['NAME'].'</td>
                        <td>'.StrToFloat($v['BRUTTO_TARIF_R']).'</td>
                        <td>'.$v['NAGRUZ'].'</td>                        
                        <td>'.$v['BRUTTO_P_R'].'</td>
                    </tr>';                    
                }                
                $html .= '</tbody></table>';    
            }
            
            if(count($dan['poluchatel']) > 0){
                $html .= '<hr /><h3>Выгодоприобретатели</h3>
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Фамилия Имя Отчество</th>
                        <th>Процент(%)</th>                        
                    </tr>
                </thead>
                <tbody>';
                                                
                foreach($dan['poluchatel'] as $k=>$v){
                $html .= '
                    <tr>
                        <td>'.$v['FIO'].'</td>
                        <td>'.$v['PROC'].'</td>                        
                    </tr>';                    
                }                                
                $html .= '</tbody></table>';  
            }
            
            $html .= '</div></div></div></div></div>';
                        
            return $html;
        }
        
        private function print_zayav($cnct)
        {
            $this->CNCT_ID($cnct);
            
            $this->array['bank_schet']           = $this->dan['contract']['BANK_CHET'];
            $this->array['bank_iik']             = $this->dan['contract']['BANK_IIK'];
            $this->array['bank_date_lgot_begin'] = $this->dan['contract']['BANK_LGOT_SROK_S'];
            $this->array['bank_date_lgot_end']   = $this->dan['contract']['BANK_LGOT_SROK_PO'];
            $this->array['bank_date_do']         = $this->dan['contract']['KART_DEISTVIE'];
            $this->array['bank_num_sprav']       = $this->dan['contract']['BANK_NUM_SPR'];
            $this->array['id_insur']             = $this->dan['contract']['ID_STRAHOVATEL'];
            $this->array['type_insur']           = $this->dan['contract']['TYPE_STRAHOVATEL'];
            $this->array['id_agent']             = $this->dan['contract']['SICID_AGENT'];
            $this->array['date_begin']           = $this->dan['contract']['DATE_BEGIN_FIRST'];
            $this->array['date_end']             = $this->dan['contract']['DATE_END_FIRST'];
            $this->array['contract_num']         = $this->dan['contract']['CONTRACT_NUM'];
            $this->array['zv_num']               = $this->dan['contract']['ZV_NUM'];
            $this->array['contract_date']        = $this->dan['contract']['CONTRACT_DATE'];
            $this->array['zv_date']              = $this->dan['contract']['TYPE_STR'];
            $this->array['type_strah']           = $this->dan['contract'][''];
            
            foreach($this->dan['clients'] as $k=>$v){
                $ds = array(
                    "sicid"=>$v['ID_ANNUIT'],
                    "age"=>$v['AGE'],
                    "ves"=>$v['VES'],
                    "rost"=>$v['ROST'],
                    "rashod" =>$AGENT_TARIF,
                    "periodich" =>$v['PERIODICH'],                                                    
                    "srok" =>$v['SROK_STRAH'],
                    "year_dohod" =>$v['GOD_DOHOD'],
                    "str_sum" =>$v['STR_SUM'],
                    "main_pokr" =>$v['OSN_POKRITIE']
                );
                
                foreach($v['CALC'] as $t=>$c){
                    if($c['TYPE_POKR'] !== '0'){
                        $ds["dop_pokr"][] = $c['ID_POKR'];
                    }
                }
                
                $ds["dat_calc"] = $v['REGDATE'];
                
                
                $zabolevaniya = array();
                $professiya = array();
                $sport = array();
                
                foreach($v['NAGRUZ'] as $i=>$n){
                    if(trim($n['ID_ZABOLEV']) !== ''){$zabolevaniya[] = $n['ID_ZABOLEV'];}
                    if(trim($n['ID_PROFES']) !== ''){$professiya[] = $n['ID_PROFES'];}
                    if(trim($n['ID_SPORT']) !== ''){$sport[] = $n['ID_SPORT'];}
                }
                
                $ds["risks"] = array(
                        "zabolevaniya"=>$zabolevaniya,
                        "professiya"=>$professiya,
                        "sport"=>$sport,
                        "country"=>$v['ID_CITY'],
                        "country_uslov"=>$v['USL_PROG']
                );
                
                foreach($v['CALC'] as $i=>$c){
                    $ds["raschet"][] = array(
                        "ID_TYPE"   => $c['TYPE_POKR'],
                        "ID_POKR"   => $c['ID_POKR'],
                        "TYPE_NAME" => $c['NAME_TYPE_POKR'],
                        "NAME"      => $c['NAME_POKR'],
                        "TARIF"     => $c['TARIF'],
                        "NAGRUZ"    => $c['NAGRUZ'],
                        "PAY_SUM_V" => $c['PAY_SUM_V'],
                        "PAY_SUM_P" => $c['PAY_SUM_P'],
                        "ERROR"     => ''
                    );
                }
                
                    
                $ds["pay_sum_v"] = $v['STR_SUM'];
                $ds["pay_sum_p"] = $v['PAY_SUM_P'];
                $dsp = array();
                foreach($v['obtain'] as $i=>$o){
                    $q = $this->db->Select("select * from clients where sicid = ".$o['SICID']);
                    $dsp = $q[0];
                    $dsp['procent'] = $o['V_PERS'];
                    $ds["poluchatel"][] = $dsp;
                }
                
                $this->array['print_zayavlenie'][] = json_encode($ds);       
             }
             $this->print_zayavlenie();   
        }
        
        private function print_zayavlenie()
        {
            $i = 0;
            foreach($this->array['print_zayavlenie'] as $k=>$v){                
                $js = json_decode($v);
                $this->array['print_zayavlenie'][$k] = $js;
            }             
            
            $dan = $this->array;
           
            if($dan['type_insur'] == '1'){
                $q = $this->db->Select("select c.*, oked_name(C.OKED_ID) oked_name from contr_agents c where c.id = ".$dan['id_insur']);
                $this->array['type_strah'] = '2';                
            }else{
                $q = $this->db->Select("select * from clients where sicid = ".$dan['id_insur']);
                $this->array['type_strah'] = '1';                
            }
            $dan['strahovatel'] = $q[0];
            
            $dan['spr_dop'] = $this->db->Select("select id, name from DOBR_DIC_POKR where pmain = 0 and active =  1");                        
            
            if($this->array['type_strah'] == '1'){
                $req = 'hranitel_zav_ind.php';
            }else{
                $req = 'hranitel_zav_group.php';
            }
           
            $dan['max_strah_god'] = $dan['print_zayavlenie'][0]->srok;
            
            $pay_sum_p_all = 0;
            $pay_sum_v_all = 0;
            foreach($dan['print_zayavlenie'] as $k=>$v){
                $pay_sum_p_all += floatval($v->pay_sum_p);
                $pay_sum_v_all += floatval($v->pay_sum_v);
            }
                        
            $q = $this->db->Select("select $pay_sum_p_all pay_sum_p_all, tlsc.money_word($pay_sum_p_all) pay_sum_p_text,  
            $pay_sum_v_all pay_sum_v_all, tlsc.money_word($pay_sum_v_all) pay_sum_v_text from dual");
            $dan['PAY_SUM_P_ALL'] = $q[0]['PAY_SUM_P_ALL'];
            $dan['PAY_SUM_P_TEXT'] = $q[0]['PAY_SUM_P_TEXT'];
            $dan['PAY_SUM_V_ALL'] = $q[0]['PAY_SUM_V_ALL'];
            $dan['PAY_SUM_V_TEXT'] = $q[0]['PAY_SUM_V_TEXT'];
            
            foreach($dan['print_zayavlenie'][0]->dop_pokr as $k=>$v){                
                //$q = $this->db->Select("select naimen from DOBR_DOP_STRAH where id = $v and active = 0");
                $q = $this->db->Select("select name from DOBR_DIC_POKR where id = $v");
                $dan['dop_pokr'][] = $q[0]['NAME'];
            }
                        
            $dan['clients_obtain'] = array();
            $dan['god_dohod'] = 0;
            
            foreach($dan['print_zayavlenie'] as $k=>$v){
                $q = $this->db->Select("select * from clients where sicid = ".$v->sicid);
                $dan['clients'][] = $q[0];
                
                $dan['god_dohod'] += $v->year_dohod;
                    
                if(isset($v->poluchatel[0])){                    
                    $dan['clients_obtain'] = $this->db->Select("select lastname||' '||firstname||' '||middlename fio, ADDR_CONV, D.V_PERS procent, docum(d.sicid) documents, iin  
                    from clients c, dobr_obtain d where  d.sicid = c.sicid and d.CNCT_ID = ".$dan['print_zayav']);                                        
                }else{
                    foreach($v->poluchatel as $t=>$d){                        
                        if(!isset($dan['clients_obtain'][$t])){
                          $q = $this->db->Select("select lastname||' '||firstname||' '||middlename fio, ADDR_CONV, '$d%' procent, docum(sicid) documents, iin  from clients where sicid = ".$t);                      
                          $dan['clients_obtain'][$t] = $q[0];
                        }
                    }                    
                }
            }
            
            $q = $this->db->Select("select tlsc.money_word(".$dan['god_dohod'].") GD from dual");
            
            $dan['god_dohod_text'] = $q[0]['GD'];
                                            
            require_once 'methods/print/'.$req;        
            exit;            
        }
                
        private function download_file($filename)
        {
            $filename = base64_decode($filename);                        
            //ini_set('max_execution_time', 6000);
            // define some variables
                        
            $fs = explode("/", $filename);
            $fst = $filename;//$fs[count($fs)-1];
            
            $local_file = __DIR__.$fst;
            $server_file = $filename; // Change this target dir
            $ftp_server = '192.168.5.2';
            $ftp_user_name = 'upload';
            $ftp_user_pass = 'Astana2014';
            // set up basic connection
            $conn_id = ftp_connect($ftp_server);
            // login with username and password
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
            // try to download $server_file and save to $local_file
            if (ftp_fget($conn_id, $local_file, $server_file, FTP_BINARY)) {
                echo "Successfully written to $local_file\n";
            } else {
                echo "There was a problem\n";
            }
            // close the connection
            ftp_close($conn_id);
            exit;
        }
        
        private function set_ander_risk_id()
        {
            $id = $this->array['set_ander_risk_id'];
            $name = $this->array['set_ander_risk_name'];
            if(trim($name) == ''){                
                exit;
            }
            
            $d = date()+rand(0, 500000);
            $q = $this->db->Select("select * from DOBR_DIC_SPR where id = $id");
            
            echo '<div class="row" id="'.$d.'">                
                <label class="col-lg-4">'.$q[0]['NAME'].'</label>
                <div class="input-group col-lg-8">                
                    <input type="text" class="form-control" readonly="true" name="set_risk_ander[]['.$id.']" value="'.$name.'"/> 
                    <span class="input-group-btn"> 
                        <span type="button" class="btn btn-danger del_risk_ander" data="'.$d.'"><i class="fa fa-trash"></i></span> 
                    </span>
                </div>
            </div>';            
            exit;
        }
        
        private function save()
        {
            //print_r($this->array);
            //exit;
            
            global $active_user_dan;
            $list_user = '';
            foreach($this->array['list_users'] as $k=>$v){
                $list_user .= "$k:$v;";
            }
            
            if($this->array['date_begin'] == ''){
                $result['error'] = 'Дата начала не может быть пустой!';
                echo json_encode($result); exit;
            }
            
            if($this->array['date_end'] == ''){
                $result['error'] = 'Дата окончания не может быть пустой!';
                echo json_encode($result); exit;
            }
            
            if($this->array['zv_num'] == ''){
                $result['error'] = 'Пустое поле номер заявления!';
                echo json_encode($result); exit;
            }
            
            if($this->array['zv_date'] == ''){
                $result['error'] = 'Пустое поле дата заявления!';
                echo json_encode($result); exit;
            }
            
            if($this->array['contract_num'] == ''){
                $result['error'] = 'Пустое поле Номер договора!';
                echo json_encode($result); exit;
            }
            
            if($this->array['contract_date'] == ''){
                $result['error'] = 'Пустое поле Дата договора!';
                echo json_encode($result); exit;
            }
            
            if($this->array['srok_strah'] == ''){
                $result['error'] = 'Пустое поле Срок страхования!';
                echo json_encode($result); exit;
            }
            
            $sql = "
            begin
            voluntary.SaveContract(
              ".$this->array['icnct'].",
              ".$this->array['id_head'].",
              121,
              ".$this->array['id_insur'].",
              ".$this->array['type_insur'].",              
              '".$this->array['branch_id']."',
              to_date('".$this->array['date_begin']."', 'dd.mm.yyyy'),
              to_date('".$this->array['date_end']."', 'dd.mm.yyyy'),
              '".$this->array['zv_num']."',
              to_date('".$this->array['zv_date']."', 'dd.mm.yyyy'),
              '".$this->array['contract_num']."',
              to_date('".$this->array['contract_date']."', 'dd.mm.yyyy'),
              '".$this->array['type_strah']."',
              '".$this->array['id_agent']."',
              '".$this->array['periodich']."',
              '".$this->array['srok_strah']."',
              '$list_user',
              '".$this->array['bank_id']."',  
              '".$this->array['bank_type_schet']."',
              '".$this->array['bank_schet']."',
              '".$this->array['bank_iik']."',
              '".$this->array['bank_lgot']."',
              '".$this->array['bank_date_lgot_begin']."',
              '".$this->array['bank_date_lgot_end']."',
              '".$this->array['bank_date_do']."',
              '".$this->array['bank_num_sprav']."',
              '".$active_user_dan['emp']."',
              :ICNCT
            );
            end;";
                        
            $result['error'] = '';            
            $q = $this->db->ExecuteReturn($sql, array("ICNCT"));
            
            if(isset($q['error'])){
                $result['sp'] = json_encode($q);
                $result['error'] = $q['message'];
                echo json_encode($result);
                exit;
            }
                        
            $result['cnct'] = $q['ICNCT'];
            
            echo json_encode($result);
            exit;            
        }
        
        private function deleteDogovor($cnct)
        {
            $sql1 = "delete from DOBR_DOGOVORS where CNCT_ID = $cnct";
            $sql2 = "delete from DOBR_DOGOVORS_CLIENTS_CALC where CNCT_ID = $cnct";
            $sql3 = "delete from DOBR_OBTAIN where CNCT_ID = $cnct";
            $sql4 = "delete from DOBR_DOGOVORS_CLIENTS where CNCT_ID = $cnct";
            $sql5 = "delete from DOBR_DOGOVORS_CLIENTS_NAGRUS where CNCT_ID = $cnct";
            if(!$this->db->Execute($sql1)){return false;}            
            if(!$this->db->Execute($sql2)){return false;}
            if(!$this->db->Execute($sql3)){return false;}
            if(!$this->db->Execute($sql4)){return false;}
            if(!$this->db->Execute($sql5)){return false;}
            return true;
        }
        
        private function search_plat_kvit()
        {
            $sql = "select  bank_name_plat(mfo_pbank) p_bank, bank_name_plat(mfo_rbank) r_bank, pd.*  
            from gak_pay_doc pd  where tmst_id = 1 ";
            
            $cnct = $_POST['search_plat_kvit'];
            
            unset($_POST['search_plat_kvit']);
            
            $b = false;
            foreach($_POST as $k=>$v){
                if(trim($v) !== ''){
                    $b = true;
                }
            }
            
            if($b == false){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            if($_POST['date_begin'] !== ''){
                if($_POST['date_end'] !== ''){
                    $sql .= " and pd.doc_DATE BETWEEN to_date('".$_POST['date_begin']."', 'dd.mm.yyyy') AND to_date('".$_POST['date_end']."', 'dd.mm.yyyy') ";
                }
            }
            
            if($_POST['pay_sum'] !== ''){
                $sql .= " and pd.pay_sum = '".$_POST['pay_sum']."'";
            }
            
            if($_POST['bin'] !== ''){
                $sql .= " and pd.p_bin like '%".$_POST['bin']."%'";
            }
            
            if($_POST['skvit'] !== ''){
                if($_POST['skvit'] == '1'){
                    $sql .= " and SKVIT is null";
                }else{
                    $sql .= " and SKVIT is not null";
                }
            }
            
            echo $sql;
            $q = $this->db->Select($sql);            
            if(count($q) <= 0){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            echo '            
            <table class="table table-bordered" id="table_kvit">
            <thead>
                <tr>
                    <th>Выбор</th>
                    <th>№ плат. поруч.</th>
                    <th>Дата плат.</th>
                    <th>Сумма</th>                    
                    <th>Сумма взятия в доход</th>
                    <th>Отправитель</th>
                    <th>РНН отправителя</th>
                    <th>Банк</th>
                    <th>Назначение платежа</th>
                </tr>
            </thead>
            <tbody>';
            foreach($q as $k=>$v){
                echo '<tr>
                    <td><input type="checkbox" class="check_kvit" id="'.$v['MHMH_ID'].'" data="'.$v['PAY_SUM'].'"/></td>
                    <td>'.$v['DOC_NMB'].'</td>
                    <td>'.$v['DOC_DATE'].'</td>
                    <td><b>'.$v['PAY_SUM'].'</b></td>
                    <td class="cn_'.$v['MHMH_ID'].'"><b>'.$v['PAY_SUM'].'</b></td>
                    <td>'.htmlspecialchars($v['P_NAME']).'</td>
                    <td>'.$v['R_IIK'].'</td>
                    <td>'.htmlspecialchars($v['P_BANK']).'</td>
                    <td>'.htmlspecialchars($v['DOC_ASSIGN']).'</td>
                </tr>';
            }
            echo '</tbody></table>
            <input type="hidden" name="kvitov_cnct" value="'.$cnct.'">
            <input type="hidden" name="id_transh" value="'.$_POST['id_transh'].'">
            ';            
            //echo $sql;            
            exit;
        }
        
        private function set_kvitov_plat($ar)
        {
            global $active_user_dan;
            $emp_id = $active_user_dan['emp'];
            
        	$cnct = $_POST['kvitov_cnct'];
            $id_transh = $_POST['id_transh'];
            $date_dohod = $_POST['date_dohod'];
            
            
        	if(count($ar) <= 0){
				echo 'Ошибка! Не выбрана ни одна платежка!';
				exit;
			}
			$html = '';
        	foreach($ar as $k=>$v){
				$html.= $k.'-'.$v.';';
			}
            //echo "voluntary.set_kvitov_plat('$cnct', '$date_dohod', '$id_transh', '$html', '$emp_id');";
            //exit;
            
			if(!$this->db->ExecProc("begin voluntary.set_kvitov_plat('$cnct', '$date_dohod', '$id_transh', '$html', '$emp_id'); end;")){
				echo $this->db->message;
				exit;
			}
			
			echo 'Квитование прошло успешно!';
			exit;            
		}
        
        private function set_bco($text)
        {
            $cnct = $_POST['id'];
            if(trim($text) == ''){
                echo '№ БСО не может быть пустым!';
                exit;                
            }
            
            $sql = "update DOBR_DOGOVORS set BCO = '$text' where cnct_id = $cnct";            
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
                exit;
            }
            exit;
        }
        
        private function dannye_po_plategke($id)
        {
            $q = $this->db->Select("select  bank_name_plat(mfo_pbank) p_bank, bank_name_plat(mfo_rbank) r_bank, pd.*  
            from gak_pay_doc pd  where mhmh_id = $id");
            
            if(count($q) <= 0){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            echo '            
            <table class="table table-bordered" id="table_kvit">
            <thead>
                <tr>                    
                    <th>№ плат. поруч.</th>
                    <th>Дата плат.</th>
                    <th>Сумма</th>                    
                    <th>Сумма взятия в доход</th>
                    <th>Отправитель</th>
                    <th>РНН отправителя</th>
                    <th>Банк</th>
                    <th>Назначение платежа</th>
                </tr>
            </thead>
            <tbody>';
            foreach($q as $k=>$v){
                echo '<tr>                    
                    <td>'.$v['DOC_NMB'].'</td>
                    <td>'.$v['DOC_DATE'].'</td>
                    <td><b>'.$v['PAY_SUM'].'</b></td>
                    <td class="cn_'.$v['MHMH_ID'].'"><b>'.$v['PAY_SUM'].'</b></td>
                    <td>'.htmlspecialchars($v['P_NAME']).'</td>
                    <td>'.$v['R_IIK'].'</td>
                    <td>'.htmlspecialchars($v['P_BANK']).'</td>
                    <td>'.htmlspecialchars($v['DOC_ASSIGN']).'</td>
                </tr>';
            }
            echo '</tbody></table>';
            exit;
        }
        
        private function set_vikup_sum($id)
        {
            $cnct = $id;
            require_once VIEWS.'contracts/others/vikup_form.php';
            exit;
        }
        
        private function set_rastorg_dogovor($id)
        {
            $cnct = $id;
            require_once VIEWS.'contracts/others/rastorg_form.php';
            exit;
        }
        
        private function set_ns($id)
        {
            $cnct = $id;
            $id_user = $this->array['id_user_ns'];
            $dan['spr_pokr_for_dogovors'] = $this->db->Select("select id, pmain, type_ns_docs, name from DOBR_DIC_POKR where 
            id in(select id_pokr from DOBR_DOGOVORS_CLIENTS_CALC where cnct_id = $cnct and sicid = $id_user group by id_pokr) order by id");
            $dan['list_documents'] = $this->db->Select("select * from DOBR_DIC_DOCUMENTS order by id, id_type");   
            
            $dan['check']['pokr_ns'] = $this->db->Select("select * from DOBR_DOGOVORS_CLIENTS_NS where cnct_id = $cnct and sicid = $id_user");
            $dan['check']['docs_ns'] = $this->db->Select("select * from DOBR_DOGOVORS_CLIENTS_NS_DOCS where cnct_id = $cnct and sicid = $id_user");
            
            require_once VIEWS.'contracts/others/uved_ns.php';
            //print_r($dan);
            exit;
        }
        
        private function set_ns_cnct($cnct)
        {
            $id_annuit = $this->array['set_ns_id_annuit'];
            
            global $msg;            
            $ftp = new FTP();
            $path = 'dobr_'.$cnct.'/'.$id_annuit.'/';
            $b = $ftp->scandir($path);
            
            if($b == false){
                $b = $ftp->scandir('dobr_'.$cnct.'/');
                if($b == false){
                    $b = $ftp->create_path('dobr_'.$cnct.'/');
                }
                $b = $ftp->create_path($path);
            }
                        
            if(empty($_FILES['files_ns'])){                
                $msg = ALERTS::ErrorMin('Вы не выбрали файл для загрузки');
                $this->GET();
                return false;
            }
            $filename = $_FILES['files_ns']['name'];
            $filepath = $_FILES['files_ns']['tmp_name'];
            $ftp_file = $ftp->uploadfile2($path, $filename, $filepath);            
            
            $sql_ftp = "
            INSERT INTO DOBR_DOGOVORS_FILES (ID, CNCT_ID, ID_FILES, FILENAME, ID_ANNUIT) 
            VALUES (SEQ_DOBR_DOGOVORS_FILES.nextval, $cnct, 0, '$ftp_file', '$id_annuit');
            ";
            
            $id_reasons = $this->array['ns_reason'];
            $docs = $this->array['ns_doc'];
                        
            $sql = "BEGIN 
            DELETE FROM DOBR_DOGOVORS_CLIENTS_NS WHERE CNCT_ID = $cnct AND SICID = $id_annuit;
            DELETE FROM DOBR_DOGOVORS_CLIENTS_NS_DOCS WHERE CNCT_ID = $cnct AND SICID = $id_annuit;
            ";
            foreach($id_reasons as $k=>$v){
                $sql .= " 
                INSERT INTO DOBR_DOGOVORS_CLIENTS_NS (CNCT_ID, SICID, ID_NS) VALUES ($cnct, $id_annuit, $v); 
                ";    
            }
            
            foreach($docs as $k=>$v){
                $sql .= " 
                INSERT INTO DOBR_DOGOVORS_CLIENTS_NS_DOCS (CNCT_ID, SICID, ID_FILE) VALUES ($cnct, $id_annuit, $v); 
                ";    
            }
            $sql .= $sql_ftp;
            $sql .= 'END;';
                        
            if(!$this->db->Execute($sql)){
                $msg = ALERTS::ErrorMin($this->db->message);                
            }
            unset($_POST);
            $this->GET();
        }
        
        private function raschet_vikup($cnct)
        {
            global $msg;
            global $active_user_dan;
            $emp_id = $active_user_dan['emp'];
            
            $num = $_POST['vikup_num'];
            $date = $_POST['vikup_date'];
            $summa = $_POST['vikup_sum'];
            
            $q = $this->db->Select("select * from dobr_dogovors where cnct_id = $cnct");
            $b = true;
            
            if(count($q) <= 0){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Не найден договор!"); 
                $b = false;               
            }
            
            $qs = $q[0];
            if(trim($qs['BANK_ID']) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />У данного договора пустые Банковские реквизиты"); 
                $b = false;
            }
            
            if(trim($qs['BANK_CHET']) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />У данного договора пустые Банковские реквизиты"); 
                $b = false;
            }
            
            if(trim($qs['BANK_TYPE_CHET']) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />У данного договора пустые Банковские реквизиты"); 
                $b = false;
            }
                                    
            if(trim($num) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Поле № заявления не может быть пустым!");
                $b = false;
            }
            
            if(trim($date) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Поле Дата заявления не может быть пустым!");
                $b = false;
            }
            
            if(trim($summa) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Поле Выкупная сумма не может быть пустым!");
                $b = false;
            }
            
            if($b){
                $date = date('d.m.Y', strtotime($date));
                $sql = "
                begin
                  voluntary.SetVikupSum($cnct, '$num', to_date('$date', 'dd.mm.yyyy'), '$summa');
                end;
                "; 
                //echo $sql;                
                
                if(!$this->db->Execute($sql)){
                    $msg = ALERTS::ErrorMin("Ошибка!<br />".$this->db->message);
                }
            }
            $this->GET();
            return $b;                        
        }
        
        private function rastorg_dogovor($cnct)
        {
            global $msg;
            global $active_user_dan;
            $emp_id = $active_user_dan['emp'];
            
            $b = true;
            $num = $_POST['rastorg_num_prik'];
            $date = $_POST['rastorg_date_prik'];
            
            if(trim($num) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Поле № приказа не может быть пустым");
                $b = false;
            }
            
            if(trim($date) == ''){
                $msg = ALERTS::ErrorMin("Ошибка!<br />Поле Дата приказа не может быть пустым");
                $b = false;
            }
            
            $date = date("d.m.Y", strtotime($date));
            
            if($b){
                $sql = "begin payments.vikup_sum_dobr('$cnct', '$num', to_date('$date', 'dd.mm.yyyy'), $emp_id); end;";                
                if(!$this->db->ExecProc($sql)){
                    $msg = ALERTS::ErrorMin("Ошибка!<br />".$this->db->message);
                }else{
                    header("Location: contracts?CNCT_ID=$cnct");                    
                }
            }            
            return $b;
        }
        
        private function create_rasp($cnct)
        {
            $q = $this->db->Select("select * from LIST_DOBR_DOGOVORS where cnct_id = $cnct");
            if(count($q) <= 0){
                echo 'Не найден договор!';  
                exit;              
            }
            $state = $q[0]['STATE'];
            $cnt = $q[0]['CNT_PNPT'];
            $cnt_rasp = $q[0]['CNT_RASP'];
            
            if($state !== '18'){
                echo "Договор имеет стутс $state! Создание распоряжения не возможно!";
                exit;
            }
            
            if($cnt == '0'){                
                echo "На данный договор нельзя сформировать распоряжение!";
                exit;
            }
            
            if($cnt == '1'){
                if($cnt_rasp == '1'){
                    echo "На данный договор уже сформировано распоряжение!";
                    exit;
                }
            }
            
            $sql = "begin volunatary.CreateRaspDobr($cnct); end;";
            if(!$this->db->ExecProc($sql)){
                echo $this->db->message;
                exit;
            }
            
            exit;
        }
        
        private function set_nagruz_ander()
        {
            
            //echo json_encode($_POST);
            //exit;
            $url = "http://192.168.5.244:8081/?id_calc=60&type_result=json&C2=Дата_расчета&D3=Тип_договора_(1_-_Индивидуальный,_2_-_Коллективный)&C4=№_покрытия&F4=Страховая_сумма&C5=Дата_рождения&C7=Пол_(Мужской,_женский)&D8=Периодичность&D9=Дата_начала&C10=Агентские&D10=Дата_окончания&C12=Андерайтинговая_нагрузка";
            
            
            $b = false;
            $sql = "BEGIN ";
            $cnct = $_GET['CNCT_ID']; 
            
            foreach($_POST['set_nagruz_ander'] as $k=>$v){
                $id_pokr = $k;
                foreach($v as $k1=>$v1){
                    
                    $id_nagruz = $k1;
                    
                    foreach($v1 as $k2=>$v2){
                        $sicid = $k2;
                        $proc  = $v2;
                        
                        if($b == false){
                            $sql .= "
                                delete from DOBR_DOGOVORS_CLIENTS_N_PROC where cnct_id = $cnct and SICID = $sicid;
                            ";
                            $b = true;
                        }                        
                        $sql .= "
                        INSERT INTO DOBR_DOGOVORS_CLIENTS_N_PROC (CNCT_ID, SICID, ID_NAGRUZ, ID_POKR, PROC) 
                        VALUES ($cnct, $sicid, $id_nagruz, $id_pokr, $proc);
                        ";
                    }
                }
            }
            $sql .= "  
            commit;
            voluntary.calc_new_nagruz($cnct, $sicid);
            END;
            "; 
            //echo $sql;exit;
            $b = $this->db->Execute($sql);             
            if(!$b){
                echo $this->db->message;
            }
            exit;
        }
        
        public function get_user_dan($id_user)
        {
            $date_begin = $this->array['d1'];
            $date_end = $this->array['d2'];
                                    
            $cnct = $_GET['CNCT_ID'];             
            $dan = array();
            $q = $this->db->Select("select 
                dc.cnct_id,
                c.sicid,    
                c.lastname||' '||c.firstname||' '||c.firstname||' ('||C.BIRTHDATE||' г.р.) ('||c.iin||')'  fio,
                DC.RASHOD_AGENT,
                DC.ROST,
                DC.VES,
                get_age(DC.DATE_CALC, C.BIRTHDATE) age,
                DC.PERIODICH,
                DC.GOD_DOHOD,                
                case 
                  when dc.set_prem = 1 then 0 else DC.STR_SUM 
                end STR_SUM,
                case 
                  when dc.set_prem <> 1 then 0 else DC.PAY_SUM_P 
                end PAY_SUM_P,                
                get_age('$date_end', '$date_begin') srok,
                dc.set_prem,
                dc.date_calc
            from 
                dobr_dogovors_clients dc, 
                clients c 
            where 
                dc.cnct_id = $cnct 
                and dc.id_annuit = $id_user 
                and c.sicid = dc.id_annuit");
                            
            $dan['sql'] = $this->db->sql;
            $dan["user"] = $q[0];
            $dan['calc'] = $this->db->Select("select * from DOBR_DOGOVORS_CLIENTS_CALC where cnct_id = $cnct and sicid =  $id_user");
            $q = $this->db->Select("select d.name, d.id_type, (select s.name from DOBR_DIC_SPR s where s.id = d.id_type) typename 
            from DOBR_DOGOVORS_CLIENTS_NAGRUS d where d.cnct_id = $cnct
            and d.id_annuit = $id_user order by d.id");
            $dan['sql'] = $this->db->sql;
            
            $dan['risk'] = '';
            foreach($q as $k=>$v){
                $ids = rand(1, 10000000);
                $dan['risk'] .= '<div class="row" id="'.$ids.'">                
                    <label class="col-lg-4">'.$v['TYPENAME'].'</label>
                    <div class="input-group col-lg-8">
                        <input type="text" class="form-control" readonly="true" name="set_risk_ander[]['.$v['ID_TYPE'].']" value="'.$v["NAME"].'"/> 
                        <span class="input-group-btn">
                            <span type="button" class="btn btn-danger del_risk_ander" data="'.$ids.'"><i class="fa fa-trash"></i></span> 
                        </span>
                    </div>
                </div>';                
            }
            
            
            $dan['obtain'] = '';
            $q = $this->db->Select("select d.*, client_name(D.SICID) fio from DOBR_OBTAIN d where cnct_id = $cnct and sicid_client = $id_user order by id");
            foreach($q as $k=>$v){
                $dan['obtain'] .= '
                <div class="col-lg-12" id="list_poluchatel_'.$v['SICID'].'">
                    <div class="col-lg-8">
                        <input type="text" class="form-control vogodo_name" value="'.$v['FIO'].'" readonly="">
                    </div>
                    <div class="col-lg-3">
                        <input type="number" min="0" max="100" class="form-control vogodo_proc" name="vogodo_proc['.$v['SICID'].']" value="'.$v['V_PERS'].'">
                    </div>
                    <div class="col-lg-1">
                        <span class="btn btn-block btn-danger del_vigoda" id="'.$v['SICID'].'"><i class="fa fa-trash"><i></i></i></span>
                    </div>
                </div>';
            }
            
            head::json($dan, true);            
        }
        
        public function send_dobr_ns($cnct)
        {            
            $sicid = $this->array['sicid'];
            $sql = "begin voluntary.send_dobr_ns($cnct, $sicid);  end;";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;                
            }
            exit;
        }
        
        public function set_otkaz_ns($cnct)
        {
            $sicid = $this->array['sicid'];
            $sql = "begin voluntary.set_otkaz_ns($cnct, $sicid);  end;";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;                
            }
            exit;
        }
        
        public function set_viplat_ns_form($cnct)
        {                        
            $sicid = $this->array['sicid'];
            
            $q = $this->db->Select("select client_name2(id_annuit) fio, str_sum 
            from dobr_dogovors_clients where cnct_id = $cnct and id_annuit = $sicid");
            
            $dan['client'] = $q[0];
            
            $dan['ns'] = $this->db->Select("
            select 
                d.*, 
                case 
                    when d.ns_proc = 0 then 0 
                    else d.str_sum * (d.ns_proc / 100) 
                end  sum_ns_proc from(
                select 
                  d.*,
                  (select name from dobr_dic_pokr where id = d.id_ns) pokr_name,
                  (select ns_proc from dobr_dic_pokr where id = d.id_ns) ns_proc,
                  dc.str_sum
                from DOBR_DOGOVORS_CLIENTS_NS d, dobr_dogovors_clients dc
                where dc.cnct_id = d.cnct_id and dc.id_annuit = d.sicid
                and d.cnct_id = $cnct and d.sicid = $sicid
            ) d
            ");
            
            require_once VIEWS.'contracts/others/set_viplat_ns_form.php';            
            exit;
        }
        
        public function set_viplat_ns($cnct)
        {
            $sicid = $this->array['sicid'];
            $sums = '';
            foreach($this->array['proc_ns'] as $k=>$v){
                $sums .= "$k,$v,".$this->array['sum_ns'][$k].";";
            }
            
            $sql = "begin voluntary.set_viplat_ns($cnct, $sicid, '$sums');  end;";            
            if(!$this->db->Execute($sql)){
                echo $this->db->message;                
            }
            header("Location: contracts?CNCT_ID=$cnct");
        }
        
        public function recalc_all()
        {
            $cnct = $this->array['icnct'];
            $proc = $this->array['agent_procent'];
            $periodich = $this->array['periodich'];
            $srok = $this->array['srok_strah'];
            $dop_pokr = $this->array['dop_pokr'];
            $date_begin = $this->array['date_begin'];
            $date_end = $this->array['date_end'];
            $type_strah = $this->array['type_strah'];
            $id_main_pokr = $this->array['id_main_pokr'];
            $id_dop_pokr = $this->array['id_dop_pokr'];
            
            $users_temp = '';
            $i = 0;
            foreach($this->array['list_users'] as $k=>$v){
                if($i > 0){
                    $users_temp .= ",";
                }
                $users_temp .= $v;
                $i++;
            }
            
            $res = array();            
            $res['msg'] = '';
            
            $sql = "begin VOLUNTARY.recalc_all('$proc', '$periodich', '$srok', to_date('$date_begin', 'dd.mm.yyyy'), to_date('$date_end', 'dd.mm.yyyy'), 
            '$users_temp', '$type_strah', '$id_main_pokr', '$id_dop_pokr', :list);  end;";
                         
            $q = $this->db->ExecuteReturn($sql, array("list"));
            if($this->db->message !== ''){
                $res['msg'] = $this->db->message;
                echo json_encode($res);
                exit;                                
            }else{
                $list = $q['list'];
                
                $res['tabs_users'] = '';
                $res['body_users'] = '';
                
                $res['list_users_json'] = '
                <input type="hidden" name="icnct" value="'.$this->array['icnct'].'">
                <input type="hidden" name="id_head" value="'.$this->array['id_head'].'">
                <input type="hidden" name="id_insur" value="'.$this->array['id_insur'].'">
                <input type="hidden" name="type_insur" value="'.$this->array['type_insur'].'">
                <input type="hidden" name="id_agent" value="'.$this->array['id_agent'].'">
                <input type="hidden" name="agent_procent" value="'.$this->array['agent_procent'].'">
                <input type="hidden" name="date_begin" value="'.$this->array['date_begin'].'">
                <input type="hidden" name="date_end" value="'.$this->array['date_end'].'">
                <input type="hidden" name="contract_num" value="'.$this->array['contract_num'].'">
                <input type="hidden" name="zv_num" value="'.$this->array['zv_num'].'">
                <input type="hidden" name="contract_date" value="'.$this->array['contract_date'].'">
                <input type="hidden" name="zv_date" value="'.$this->array['zv_date'].'">
                <input type="hidden" name="type_strah" value="'.$this->array['type_strah'].'">
                <input type="hidden" name="periodich" value="'.$this->array['periodich'].'">
                <input type="hidden" name="srok_strah" value="'.$this->array['srok_strah'].'">                                            
                <input type="hidden" name="branch_id" value="'.$this->array['branch_id'].'">
                ';
                     
                $qs = $this->db->Select("select 
                        dt.*, 
                        c.lastname||' '||substr(c.firstname, 1, 1)||'. '||substr(c.middlename, 1, 1) fio_min,
                        client_name(c.sicid)||' ('||c.iin||')' fio,
                        get_age('$date_begin', c.BIRTHDATE) age,
                        c.sicid
                        from DOBR_CLIENTS_TEMP dt, clients c where c.sicid = dt.id_annuit and dt.id in($list)");
                
                
                                
                foreach($qs as $k=>$ss){                    
                    $s = '';
                    if($k == 0){
                        $s = 'active';
                    }
                    
                    $res['list_users_json'] .= '
                    <input type="hidden" name="list_users['.$ss['SICID'].']" id="client_'.$ss['SICID'].'" value="'.$ss['ID'].'">';
                    
                    $res['tabs_users'] .= '<li class="'.$s.'"><a data-toggle="tab" id="client_'.$ss['SICID'].'" href="#user_tab_'.$ss['SICID'].'">'.$ss['FIO_MIN'].'</a></li>
                    ';
                    
                    $res['body_users'] .= '
                    <div id="user_tab_'.$ss['SICID'].'" class="tab-pane user_tab_'.$ss['SICID'].' '.$s.'">
                        <div class="panel-body">                                                                        
                            <div class="row">                        
                                <div class="col-lg-12" style="margin-top: -30px;">                                                        
                                    <button class="btn btn-xs btn-danger pull-right delete_user" id="'.$ss['SICID'].'"><i class="fa fa-trash"></i></button>                                                        
                                    <button style="margin-right: 10px;" data-toggle="modal" data-target="#set_client" class="btn btn-xs btn-warning pull-right edit_user" id="'.$ss['SICID'].'"><i class="fa fa-edit"></i></button>
                                    <div class="form-horizontal">
                                        <h3>Данные клиента</h3>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ФИО (Дата Рождения)(ИИН)</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="'.$ss['FIO'].'" readonly="">                                                                                                                                         
                                            </div>
                                        </div>
                                        <div class="form-group">                                            
                                            <label class="col-lg-3 control-label">Возраст</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="'.$ss['AGE'].'" readonly="">                                                                     
                                            </div>                                                                
                                            
                                            <label class="col-lg-1 control-label">Вес</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" value="'.$ss['VES'].'" readonly="">                                                                     
                                            </div>
                                            
                                            <label class="col-lg-1 control-label">Рост</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" value="'.$ss['ROST'].'" readonly="">                                                                     
                                            </div>
                                        </div>
                                                                                        
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Агентские расходы</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="'.$ss['RASHOD_AGENT'].'%" readonly="">                                                                     
                                            </div>
                                        </div>
                                                            
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Периодичность</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="'.$ss['PERIODICH'].'" readonly="">                                                                     
                                            </div>
                                                                
                                            <label class="col-lg-3 control-label">Срок страхования</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="'.$ss['SROK_STRAH'].'" readonly="">                                                                     
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">                                                                
                                            <label class="col-lg-3 control-label">Годовой доход</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="'.$ss['GOD_DOHOD'].'" readonly="">                                                                     
                                            </div>
                                                            
                                            <label class="col-lg-3 control-label">Страховая сумма</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="'.$ss['STR_SUM'].'" readonly="">                                                                     
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Расчетные данные</h3>
                                        
                                        <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Тип</th>
                                                <th>Наименование</th>
                                                <th>Тариф</th>
                                                <th>Нагрузка</th>                                                                                
                                                <th>Страховая премия</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        
                                        $rs = $this->db->Select("select 
                                                case when type_pokr = 0 then 'Основное покрытие' else 'Дополнительное покрытие' end type_name, 
                                            (select name from dobr_dic_pokr where id = id_pokr) name_pokr, 
                                            brutto_tarif_r, nagruz, brutto_p_r from DOBR_CLIENTS_CALC_TEMP where id_temp = ".$ss['ID']."
                                        union all
                                        select
                                            '<b>Итого</b>' type_name, 
                                            null name_pokr, 
                                            sum(brutto_tarif_r) brutto_tarif_r, sum(nagruz) nagruz, sum(brutto_p_r) brutto_p_r 
                                            from DOBR_CLIENTS_CALC_TEMP where id_temp = ".$ss['ID']);
                                            
                                        foreach($rs as $kts=>$v){
                                        $res['body_users'] .= '<tr>
                                                <td>'.$v['TYPE_NAME'].'</td>
                                                <td>'.$v['NAME_POKR'].'</td>
                                                <td>'.$v['BRUTTO_TARIF_R'].'</td>
                                                <td>'.$v['NAGRUZ'].'</td>                                                                            
                                                <td>'.$v['BRUTTO_P_R'].'</td>
                                            </tr>';
                                        }
                                                                                                                                                                                                                                       
                                        $res['body_users'] .= '</tbody>
                                        </table></div></div></div></div></div>';                     
                    $i++;                   
                }
                $res['list_users_json'] .= '<input type="hidden" name="save" value="">';                
            }
            
            echo json_encode($res);
            exit;
        }
    }