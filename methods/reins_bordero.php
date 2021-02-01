<?php
    require_once __DIR__.'/reinsurance.php';
	class BORDERO extends REINSURANCE
    {
        private $db;        
        public $array;
        public $html = '';
        public $msg = '';
        public $dan_array = array();
        private $sql_all;
        private $sqls = "select 
              dr.id,
              case 
                when nvl(d.id_head, 0) > 0 then 'Доп соглашение'
                else 'Договор' 
              end type_dog,
              null id_transh,              
              d.cnct_id,  
              d.contract_num,
              fond_name(d.id_insur) strahovatel,
              dr.r_name,
              agent_name(d.sicid_agent) agentname,
              d.date_begin,
              d.date_end,
              bordero_sum(d.cnct_id) pay_sum_v,  
              bordero_pay_sum_p(d.cnct_id) pay_sum_p,
              100 -  R.PERC_P_STRAH dol_p_reins_perc,
              R.PERC_P_STRAH dol_p_perc,
              round(bordero_sum(d.cnct_id) * ((100 -  R.PERC_S_STRAH) / 100)) otv_reins10,
              round(bordero_sum(d.cnct_id) * (R.PERC_S_STRAH / 100)) otv_reins90,
              round(bordero_pay_sum_p(d.cnct_id) * (R.PERC_P_STRAH / 100), 2) brutto,    
            ROUND(
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) * (nvl(r.skidka, 0) / 100), 2) komis_reins,        
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) -
            ROUND(
                round(
                    case 
                      when d.vid = 2 then d.sum_vozvr
                      when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                      else bordero_pay_sum_p(d.cnct_id)
                    end * (R.PERC_P_STRAH / 100)
                , 2) * (nvl(r.skidka, 0) / 100)           
            , 2) netto_prem_reins,            
              nvl(r.skidka, 0) skidka,
              state_name(d.state) state_name,
              null id_contracts
            from
              contracts d,  
              contr_agents ag, 
              osns_calc os, 
              osns_calc_new os2,
              reinsurance r,
              dic_reinsurance dr
            where  
                d.paym_code like '07%'                
                and dr.id = r.reinsur_id
                and d.id_insur = ag.id
                and d.cnct_id = os.cnct_id
                and d.cnct_id = os2.cnct_id                
                and dr.vid in(1, 2)                
                and d.cnct_id = r.cnct_id(+)   
                --and d.sicid_agent <> 1620
                and (d.sicid_agent <> 1620 or dr.id = 96 or dr.id = 216)
                and nvl(d.note, '1') not like '%согласно п.4 договора%'
                and d.cnct_id in(
                    select cnct_id from plat_to_1c where id_plat is not null and nvl(pay_sum_d, 0) <> 0
                    union all                    
                    select cnct_id from pnpd_document where substr(rfpm_id, 1, 4) = '0902'
                )
                ";
                
        private $sqls_transh = "select 
              dr.id,
              'Транш ('||t.nom||')' type_dog,
              t.id id_transh,
              d.cnct_id,  
              d.contract_num,
              fond_name(d.id_insur) strahovatel,
              dr.r_name,
              agent_name(d.sicid_agent) agentname,
              d.date_begin,
              d.date_end,
              0 pay_sum_v,  
              0 pay_sum_p,
              100 -  R.PERC_P_STRAH dol_p_reins_perc,
              R.PERC_P_STRAH dol_p_perc,
              0 otv_reins10,
              0 otv_reins90,
              0 brutto,    
                ROUND(
                round(
                    case 
                      when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                      else bordero_pay_sum_p(d.cnct_id)
                    end * (R.PERC_P_STRAH / 100)
                , 2) * (nvl(r.skidka, 0) / 100), 2) komis_reins,        
                round(
                    case 
                      when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                      else bordero_pay_sum_p(d.cnct_id)
                    end * (R.PERC_P_STRAH / 100)
                , 2) -
                ROUND(
                    round(
                        case 
                          when d.vid = 2 then d.sum_vozvr  
                          when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                          else bordero_pay_sum_p(d.cnct_id)
                        end * (R.PERC_P_STRAH / 100)
                    , 2) * (nvl(r.skidka, 0) / 100)           
                , 2) netto_prem_reins,            
                  0 skidka,
                  state_name(d.state) state_name,
              null id_contracts
                from 
                    bordero_contracts bc, 
                    bordero_contracts_list bl, 
                    transh t, 
                    plat_to_1c p, 
                    contracts d,
                    reinsurance r,
                    dic_reinsurance dr
                where
                    bl.id_contracts = bc.id
                    and d.cnct_id = bl.cnct_id
                    and p.cnct_id = t.cnct_id
                    and r.cnct_id = d.cnct_id
                    and DR.ID = BC.ID_REINS
                    and P.ID_TRUNSH = T.ID
                    and bl.cnct_id = t.cnct_id
                    and P.ID_TRUNSH not in(
                        select id_transh from bordero_contracts_transh
                        union all
                        select bl.id_transh from bordero_contracts b, bordero_contracts_list bl where b.id = bl.id_contracts and b.typ = 1 and bl.id_transh is not null
                    )                
                    and bc.typ = 1
                    and T.NOM > 1
                    and P.PAY_SUM_D <> 0
                    and t.id not in(select id_transh from BORDERO_CONTRACTS_TRANSH_OWN)
                    and d.sicid_agent <> 1620
                    and nvl(d.note, '1') not like '%согласно п.4 договора%'
                    ";
                //--and d.date_begin >= '01.01.2017'
        
        private $transh_others = "select 
              dr.id,
              'Транш ('||t.nom||')' type_dog,
              t.id id_transh,              
              d.cnct_id,  
              d.contract_num,
              fond_name(d.id_insur) strahovatel,
              dr.r_name,
              agent_name(d.sicid_agent) agentname,
              d.date_begin,
              d.date_end,
              bordero_sum(d.cnct_id) pay_sum_v,  
              bordero_pay_sum_p(d.cnct_id) pay_sum_p,
              100 -  R.PERC_P_STRAH dol_p_reins_perc,
              R.PERC_P_STRAH dol_p_perc,
              round(bordero_sum(d.cnct_id) * ((100 -  R.PERC_S_STRAH) / 100)) otv_reins10,
              round(bordero_sum(d.cnct_id) * (R.PERC_S_STRAH / 100)) otv_reins90,
              round(bordero_pay_sum_p(d.cnct_id) * (R.PERC_P_STRAH / 100), 2) brutto,    
            ROUND(
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) * (nvl(r.skidka, 0) / 100), 2) komis_reins,        
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) -
            ROUND(
                round(
                    case 
                      when d.vid = 2 then d.sum_vozvr
                      when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                      else bordero_pay_sum_p(d.cnct_id)
                    end * (R.PERC_P_STRAH / 100)
                , 2) * (nvl(r.skidka, 0) / 100)           
            , 2) netto_prem_reins,            
              nvl(r.skidka, 0) skidka,
              state_name(d.state) state_name,
              null id_contracts
            from
              contracts d,  
              contr_agents ag, 
              osns_calc os, 
              osns_calc_new os2,
              reinsurance r,
              dic_reinsurance dr,
              transh t,
              plat_to_1c p
            where  
                d.paym_code like '07%'
                and r.otpr <> '1'
                and dr.id = r.reinsur_id
                and d.id_insur = ag.id
                and d.cnct_id = os.cnct_id
                and d.cnct_id = os2.cnct_id                
                and dr.vid in(1, 2)                
                and d.cnct_id = r.cnct_id(+)
                and p.cnct_id = d.cnct_id
                and t.cnct_id = d.cnct_id
                and P.ID_TRUNSH = t.id  
                and d.sicid_agent <> 1620
                and T.NOM > 1
                and nvl(d.note, '1') not like '%согласно п.4 договора%'                                                                    
                and d.cnct_id not in(
                    select t.cnct_id from transh t, BORDERO_CONTRACTS_TRANSH_OWN b where B.ID_TRANSH = T.ID
                    union all 
                    select bl.cnct_id from bordero_contracts b, bordero_contracts_list bl where BL.ID_CONTRACTS = b.id
                    and BL.ID_TRANSH is not null
                )";
        
        public function __construct()
        {
            parent::__construct();
            
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();
        }
        
        public function list_agents()
        {
            $q = $this->db->Select("select id, decode(vid,1,lastname || ' '|| firstname||' '||middlename, org_name) name from agents where state = 7 and vid = 3"); //not in(4, 5)
            return $q;
        }
        
        private function GET()
        {
            if(count($_GET) <= 0){
                $this->html = $this->tsp('');
            }else{            
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }else{
                        $this->array[$k] = $v;
                    }
                }
            }
        }
        
        private function POST()
        {            
            //print_r($_POST);exit;
            
            if(count($_POST) > 0){
                foreach($_POST as $k=>$v){                                
                    if(method_exists($this, $k)){                         
                        $this->array = $_POST;
                        $this->$k($v); 
                    }
                }
            }
            
            $this->onAjax();
        }
        
        private function onAjax()
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    header('Content-Type: application/json');
                    echo json_encode($this->dan_array);
                    exit;
                }   
            }
        }
        
        private function set_num_rasp($id)
        {
            $rsp = $this->db->ExecuteReturn("begin :irasp_nom := payments.getraspnum('RR_RASP'); end;", array('irasp_nom'));
            $inum_rasp = $rsp['irasp_nom'];                    
                              
            $idate_rasp = $this->array['idate_rasp'];
            $inum_shet = $this->array['inum_shet'];
            $idate_schet = $this->array['idate_schet'];
            $note = $this->array['note'];            
            
            unset($this->array);
            
            $b = true;
            
            if(trim($idate_rasp) == ''){
                $b = false;
                $this->msg .= 'Не задана дата распоряжения';
            }
            
            if($b){
                $fst = '';
                if(isset($_FILES['ischet_fail'])){                    
                    $file = $_FILES['ischet_fail'];
                    if($file['tmp_name'] !== ''){
                        $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
                        $s = explode(".", $file['name']);
                        $is = count($s);
                        $file_type = $s[$is-1]; 
                        
                        $files = $id.".".$file_type;
                        $handle = $handle = fopen($file['tmp_name'], 'r');
                        if(!$ftp->uploadfile("reinsurance/shet_opl/", $files, $handle))
                        {                        
                            echo "Ошибка создания файла!";
                        }
                        $fst = 'reinsurance/shet_opl/'.$files;
                    }
                }
                
                $sql = "update BORDERO_CONTRACTS set num_rasp = '$inum_rasp', date_rasp = to_date('$idate_rasp', 'dd.mm.yyyy'), 
                num_schet = '$inum_shet', date_schet = to_date('$idate_schet', 'dd.mm.yyyy'), file_schet = '$fst' where id = $id";
                
                if(!$this->db->Execute($sql)){
                    print_r($this->db->message);
                    exit;   
                }               
                
                $this->array['type'] = 0;
                $this->array['note'] = $note;
                 
                $this->set_state($id);                   
                header("Location: ".$_SERVER['REQUEST_URI']);
                exit;
            }
        }
                
        private function set_state($id)
        {
            //$mail = new MAIL();            
            //sendmail('a.saleev@gak.kz', 'test', '<b>HELLO</b>');
            
            $type = $this->array['type']; //Кнопка нажатия 0 - утвердить 1 - отклонить
            $note = $this->array['note']; //Примечание
            $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz"; //Эмаил текущего пользователя
            
            //Узнаем статус договора бордеро
            $q = $this->db->Select("select state, typ from bordero_contracts where id = $id");
            $state = $q[0]['STATE'];
            $typ = $q[0]['TYP'];
            
            //Данный блог при переходе на другую базу переделать
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";  
                             
            $db = new DB();                                                
            $dsp = $db->Select($sql);
                        
            $dep = $dsp[0]['JOB_SP']; //Департамент
            $dolzh = $dsp[0]['JOB_POSITION']; //Должность                        
            
            $sql = "select * from BORDERO_STATE_PROC_OTHER where state_begin = $state and DEPARTMENT_BEGIN = $dep and type_btn = $type";            
                           
            $q = $this->db->Select($sql);
            
                                    
            if(count($q) == 0){
                echo 'Вы не можете Утверждать или Отклонять данный договор<br />';
                exit;
            }
            
            $b = false;
            
            foreach($q as $k=>$v){                
                if(trim($v['DOLZH_BEGIN']) == $dolzh){
                    $dan = $v;
                    $b = true;
                }
            }
            
            //$dan = $q[0];
            if(trim($dan['DOLZH_BEGIN']) !== ''){
                if($b == false){
                    echo 'Ошибка! Вы не можете Утверждать или Отклонять данный договор';
                    exit;
                }
            }
            
            //Если не транши тогда выполняем процедуру отправки в интеграцию
            if($typ < 3){
                //Если поле процедура не пустая тогда выполняем ее 
                //Во все процедуры необходиом завязать только ID контракта и все
                if(trim($dan['FUNCT_PROV']) !== ''){
                    $proc = $dan['FUNCT_PROV'];
                    if(!$this->db->Execute("begin $proc($id); end;")){
                        echo $this->db->message;
                        exit;   
                    }
                }
            }
            $this->db->Execute("
                insert into bordero_contracts_arc 
                select * from bordero_contracts where id = $id
            ");
            
            //$this->db->Execute("INSERT INTO SIAP_ACT_PRT (ACTP_ID, SICID, RFBN_ID, EMP_ID, ACT_ID, CNCT_ID, DATE_OP, NOTES, DATE_CALC, IP_PC) 
            //VALUES ( /* ACTP_ID */, /* SICID */, /* RFBN_ID */, /* EMP_ID */, /* ACT_ID */, /* CNCT_ID */, /* DATE_OP */, /* NOTES */, /* DATE_CALC */, /* IP_PC */ )");
                        
            $new_state = $dan['STATE_END'];            
            $sql = "update bordero_contracts set state = $new_state, note = '$note' where id = $id";
            $b = $this->db->Execute($sql);
            if($b !== true){
                echo $b;
            }     
            
            //Узнаем текст статуса
            $st = $this->db->Select("select name from bordero_state where id = $new_state");
            $state_text = $st[0]['NAME'];
            
            $message_send = "Для согласования договора по перестрахованию бордеро. Статус $state_text; http://192.168.5.244/reins_bordero?form_setstate=$id";
            //Узнаем кто Должен следующий утверждать
            
            if($new_state !== "8"){
                $next_depart = $q[0]['DEPARTMENT_END'];
                $next_dolzh = '';
                $i = 0;
                foreach($q as $k=>$v){
                    if($i > 0){
                        $next_dolzh .= ','; 
                    }
                    $next_dolzh .= $v['DOLZH_END'];
                    $i++;
                }                
            }else{
                $message_send = $state_text." - http://192.168.5.244/reins_bordero?form_setstate=$id";
                $next_depart = '13';
                $next_dolzh = '50';
            }
            
            //Находим пользователей в департаменте по должности
            if(trim($next_dolzh) !== ''){
                $ss = "and JOB_POSITION in($next_dolzh)";
            }
            
            $q = $db->Select("select EMAIL from SUP_PERSON where id not in(418, 698, 630, 527, 839) and JOB_SP = $next_depart $ss");
            //Отправляем сообщение по пандиону 
            
            require_once 'methods/xmpp.php';            
            $j = new JABBER();
            
            foreach($q as $k=>$v){
                $j->send_message($v['EMAIL'], $message_send);    
            }
                      
            echo '';
            exit;
        }
        
        
        private function new_contract($d)
        {            
            $prov = $this->db->Select("select get_block_mode('0701000001') iblock from dual");
            
            if($prov[0]['IBLOCK'] == '1'){
                echo "<h1>База заблокированна САРиА! <br />Идет расчет резервов</h1>";
                exit;
            }
                        
            $s = '';
            foreach($d as $k=>$v)
            {                
                if($k > 0){
                    $s .= ",";
                }
                $s .= $v;
            }
                        
            $q = $this->db->Select("select reinsur_id, reins_name(reinsur_id) rname, c_num from reinsurance r, dic_reinsurance dr 
            where dr.id = R.REINSUR_ID and r.cnct_id in($s) group by r.reinsur_id, dr.c_num");
            
            $html = '';
                                                
            foreach($q as $v)
            {
                $cncts = '';                                
                $cn = $this->db->Select("select val+1 CN from RASP_NOM where vid = 'reins_".$v['REINSUR_ID']."'");
                $cnc = '';
                if(count($cn) > 0){
                    $cnc = $cn[0]['CN'];
                }
                
                $num = $v['C_NUM']."/".date("Y")."/".$cnc;
                $c_date = date("d.m.Y");
                
                //print_r($v);
                
                $html .= '
                <div class="form-group">
                    <label class="col-lg-12">'.$v['RNAME'].'</label>
                    <label class="col-lg-3">№ договора</label> 
                    <div class="input-group date col-lg-9">                               
                        <input type="text" name="contr_num['.$v['REINSUR_ID'].']" class="form-control" value="'.$num.'">
                    </div>
                </div>
                <div class="form-group">                    
                     <label class="col-lg-3">Дата договора</label>
                     <div class="input-group date col-lg-9">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="contr_date['.$v['REINSUR_ID'].']" class="form-control date_begin input-sm" data-mask="99.99.9999" value="'.$c_date.'">
                     </div>                              
                </div>';
                $ds = $this->db->Select("select cnct_id from osns_calc where cnct_id in($s) and reins_id = ".$v['REINSUR_ID']);                
                foreach($ds as $t=>$f)
                {
                    $html .= '<input type="hidden" name="list_contracts['.$v['REINSUR_ID'].'][]" value="'.$f['CNCT_ID'].'">';
                    foreach($d as $dst=>$vtr){
                        if(isset($vtr['data'])){
                            if($vtr['id'] == $f['CNCT_ID']){
                                $html .= '<input type="hidden" name="list_contracts_transh['.$v['REINSUR_ID'].']['.$f['CNCT_ID'].'][]" value="'.$vtr['data'].'">';
                            }
                        }
                    }
                }
                $html .='<HR />';
            }
                        
            echo $html;
            exit;
        }
        
        private function save_contr_bordero($dan)
        {
            $d = $this->array;            
            //echo  json_encode($d);           
            //exit;
                        
            //unset($d['save_contr_bordero']);
            foreach($d['contr_num'] as $k=>$v)
            {
                $id = $k;
                $contr_num = $v;
                $contr_date = $d['contr_date'][$id];    
                $NETTO_PREM_REINS = 0;
                $BRUTTO = 0;
                $KOMIS = 0;
                $SUM_S_STRAH = 0;
                $cn = $this->db->Select("select SEQ_BORDERO_CONTRACTS.nextval c from dual");
                $id_contract = $cn[0]['C']; 
                
                foreach($d['list_contracts'][$id] as $t=>$p){
                    /*
                    $sql = "select * from(". 
                    $this->sqls." and d.cnct_id not in(select cl.cnct_id from BORDERO_CONTRACTS_LIST cl, BORDERO_CONTRACTS b 
                    where B.ID = CL.ID_CONTRACTS and B.STATE <> 13) 
                    and d.cnct_id = ".$p.
                    " union all ".$this->sqls_transh." and d.cnct_id = ".$p.
                    ") group by 
                    id, type_dog, id_transh, cnct_id, contract_num, strahovatel, r_name, agentname, date_begin, date_end, pay_sum_v,pay_sum_p,
                    dol_p_reins_perc, dol_p_perc, otv_reins10, otv_reins90, brutto, komis_reins, netto_prem_reins, skidka, state_name";
                    
                    $sql = str_replace("and d.sicid_agent <> 1620", "", $sql);                    
                    $sql = str_replace("and bl.cnct_id = t.cnct_id", "and bl.cnct_id(+) = t.cnct_id", $sql);
                    $sql = str_replace("and bl.cnct_id = d.cnct_id", "and bl.cnct_id(+) = d.cnct_id", $sql);                                        
                    $lc = $this->db->Select($sql);                    
                    */
                    
                    $sk_transh = '';
                    if(isset($d['list_contracts_transh'][$id][$p])){
                        $sk_transh = $d['list_contracts_transh'][$id][$p].' id_transh';
                    }
                    
                    $sql = "select 
                      case 
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then
                          case 
                            when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                            else round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                          end
                        when d.vid = 2 and (select max(nom) from transh where cnct_id = d.cnct_id and mhmh_id is not null) = 1 then
                            round(D.SUM_VOZVR * (R.PERC_P_STRAH / 100), 2)
                        when (select max(nom) from transh where cnct_id = d.cnct_id and mhmh_id is not null) = 1 then 
                            round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else 
                          case 
                            when (select count(*) from bordero_contracts_list where cnct_id = d.cnct_id) <= 0 then
                            round(nvl(D.SUM_VOZVR, d.pay_sum_p) * (R.PERC_P_STRAH / 100), 2) else
                            0
                          end
                      end pay_sum,
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round((select sum_fact from transh where cnct_id = d.cnct_id and id = (select max(id) from transh where cnct_id = d.cnct_id and mhmh_id is not null)) * (R.PERC_P_STRAH / 100), 2)    
                      end - ( 
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round((select sum_fact from transh where cnct_id = d.cnct_id and id = (select max(id) from transh where cnct_id = d.cnct_id and mhmh_id is not null)) * (R.PERC_P_STRAH / 100), 2)    
                      end * (nvl(R.SKIDKA, 0) / 100 )  
                      ) pay_sum_opl,
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round((select sum_fact from transh where cnct_id = d.cnct_id and id = (select max(id) from transh where cnct_id = d.cnct_id and mhmh_id is not null)) * (R.PERC_P_STRAH / 100), 2)    
                      end * (nvl(R.SKIDKA, 0) / 100 ) komis_reins,
                      case
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then round(d.pay_sum_v * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) > 0 then 
                            round( 
                            case 
                              when (select count(*) from contracts where id_head = d.id_head and cnct_id < d.cnct_id) = 0 then d.pay_sum_v - (select pay_sum_v from contracts where cnct_id = d.id_head)
                              else d.pay_sum_v - (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id))
                            end * (R.PERC_P_STRAH / 100), 2)   
                        else round(d.pay_sum_v * (R.PERC_P_STRAH / 100), 2)
                      end sum_s_strah, 
                      (select max(id) from transh where cnct_id = d.cnct_id and mhmh_id is not null) id_transh  
                    from 
                      contracts d,
                      reinsurance r
                    where 
                      r.cnct_id = d.cnct_id
                      and d.cnct_id = $p
                      ";
                                        
                    if(isset($d['list_contracts_transh'][$id][$p])){
                        $sk_transh = '';
                        $i = 0;
                        foreach($d['list_contracts_transh'][$id][$p] as $dst=>$pst){
                            if($i > 0){
                                $sk_transh .=',';                                
                            }
                            $sk_transh .= $pst;
                            $i++;
                        }
                        $sql = "select 
                      case 
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then
                          case 
                            when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                            else round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                          end
                        when d.vid = 2 and (select max(nom) from transh where cnct_id = d.cnct_id and mhmh_id is not null) = 1 then
                            round(D.SUM_VOZVR * (R.PERC_P_STRAH / 100), 2)
                        when (select max(nom) from transh where cnct_id = d.cnct_id and mhmh_id is not null) = 1 then 
                            round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else 0
                      end pay_sum,
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round(t.sum_fact * (R.PERC_P_STRAH / 100), 2)    
                      end - ( 
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round(t.sum_fact * (R.PERC_P_STRAH / 100), 2)    
                      end * (nvl(R.SKIDKA, 0) / 100 )  
                      ) pay_sum_opl,
                      case 
                        when nvl(D.ID_HEAD, 0) > 0 then round(D.SUM_VOZVR  * (R.PERC_P_STRAH / 100), 2)
                        when (select count(*) from transh where cnct_id = d.cnct_id) = 0 then round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then  round(d.pay_sum_p * (R.PERC_P_STRAH / 100), 2)
                        else round(t.sum_fact * (R.PERC_P_STRAH / 100), 2)    
                      end * (nvl(R.SKIDKA, 0) / 100 ) komis_reins,
                      case
                        when nvl(D.ID_HEAD, 0) = 0 and (select max(nom) from transh where cnct_id = d.cnct_id) = 1 then round(d.pay_sum_v * (R.PERC_P_STRAH / 100), 2)
                        when nvl(D.ID_HEAD, 0) > 0 then 
                            round( 
                            case 
                              when (select count(*) from contracts where id_head = d.id_head and cnct_id < d.cnct_id) = 0 then d.pay_sum_v - (select pay_sum_v from contracts where cnct_id = d.id_head)
                              else d.pay_sum_v - (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id))
                            end * (R.PERC_P_STRAH / 100), 2)   
                        else round(d.pay_sum_v * (R.PERC_P_STRAH / 100), 2)
                      end sum_s_strah, 
                      t.id id_transh
                    from 
                      contracts d,
                      reinsurance r,
                      transh t
                    where 
                      r.cnct_id = d.cnct_id
                      and d.cnct_id = $p
                      and t.cnct_id = d.cnct_id
                      and t.id in($sk_transh) 
                      ";                                                
                    }
                    
                    
                    $lc = $this->db->Select($sql);                                                                           
                    foreach($lc as $pst=>$vst){
                        /*
                        $pay_sum = $lc[0]['BRUTTO'];
                        $pay_sum_opl = $lc[0]['NETTO_PREM_REINS'];    
                        $komis_reins = $lc[0]['KOMIS_REINS']; 
                        $sum_strah = $lc[0]['OTV_REINS90'];
                        $id_transh = $lc[0]['ID_TRANSH'];
                        */
                        
                        $pay_sum = $vst['PAY_SUM'];
                        $pay_sum_opl = $vst['PAY_SUM_OPL'];    
                        $komis_reins = $vst['KOMIS_REINS']; 
                        $sum_strah = $vst['SUM_S_STRAH'];
                        $id_transh = $vst['ID_TRANSH'];
                        if($pay_sum > 0){
                            $id_transh = '';
                        }
                        
                        $m = $this->db->Execute("
                            INSERT INTO BORDERO_CONTRACTS_LIST 
                                (ID, ID_CONTRACTS, CNCT_ID, PAY_SUM, PAY_SUM_OPL, KOMIS_REINS, SUM_S_STRAH, ID_TRANSH) 
                            VALUES 
                                (SEQ_BORDERO_CONTRACT_LIST.nextval, $id_contract, $p, '$pay_sum', '$pay_sum_opl', 
                                '$komis_reins', '$sum_strah', '$id_transh')"
                        );
                        $NETTO_PREM_REINS += $pay_sum_opl;
                        $BRUTTO += $pay_sum;
                        $KOMIS += $komis_reins;
                        $SUM_S_STRAH += $sum_strah;   
                    }                    
                }
                
                $this->db->Execute("
                INSERT INTO BORDERO_CONTRACTS 
                (ID, CONTRACT_NUM, CONTRACT_DATE, EMP_ID, DATE_CREATE, STATE, PAY_SUM, PAY_SUM_OPL, KOMIS_REINS, ID_REINS, OTPR, typ, SUM_S_STRAH) 
                VALUES ($id_contract, '$contr_num', '$contr_date', '$dan', sysdate,  0, '$BRUTTO', '$NETTO_PREM_REINS', '$KOMIS', $id, 0, 1, '$SUM_S_STRAH')");
                
                $ps = $this->db->Select("select val+1 vals from RASP_NOM where vid = reins_$id");
                $v = $ps[0]['VALS'];
                
                $this->db->Execute("update RASP_NOM set val = $v where vid = reins_$id");
                $this->db->Execute("begin bordero.PereraschetContract($id_contract); end;");
            }
            $alerts = new ALERTS();
            $this->html = $alerts->SuccesMin('Данные сохранены успешно');
            $this->array = $_GET;
            $this->search();            
        }
                
        private function tsp($ss = '', $ss_transh = '', $ss_transh_other = '')
        {
            $b = false;
            if(isset($_GET['list_contracts'])){$b = true;}
            $tss = '';
            if($b == false){
                $tss = "and d.date_begin >= '01.01.2017' and d.cnct_id not in(select cnct_id from bordero_contracts_list union all select cnct_id from bordero_own)";
            }
            $sql = $this->sqls.$tss." $ss ";//and d.note <> 'Расторгнут автоматом в связи с отсутствием оплаты договора в течении 30 дней (согласно п.4 договора)' ";
            
            
            if($b == false){				
                $sql .= " union all ".$this->sqls_transh;//." $ss_transh and d.note <> 'Расторгнут автоматом в связи с отсутствием оплаты договора в течении 30 дней (согласно п.4 договора)' ";
            }
            
            $sql .= " union all ".$this->transh_others." $ss_transh_other ";//and d.note <> 'Расторгнут автоматом в связи с отсутствием оплаты договора в течении 30 дней (согласно п.4 договора)' ";            
            $sql .= "order by 6";
            
            //echo '<pre>'.$sql.'</pre>';
         //   echo $sql;
            $this->sql_all = $sql;
            $dan = $this->db->Select($sql);   
            
        /*    echo '<pre>';
             print_r($dan);
            echo '</pre>'; */
                               
            
            //echo $this->db->sql;
            
            $tr1 = '№ п/п';
            if($b == false){
                $tr1 = '<input type="checkbox" class="check_all">';
            }
                        
            $html = '
            <style>
                td{
                    font-size: 11px;
                }
            </style>
            <table class="table table-bordered tps">
            <thead style="font-size: 10px;">
                <tr>
                    <th rowspan="2">'.$tr1.'</th>
                    <th rowspan="2">№ договора страхования</th>
                    <th rowspan="2">Страхователь</th>
                    <th rowspan="2">Перестраховщик</th>
                    <th rowspan="2">Тип договора</th>
                    <th rowspan="2">Агент</th>
                    <th colspan="2">Период действия страхования</th>                    
                    <th rowspan="2">Страховая сумма</th>
                    <th rowspan="2">Страховая премия</th>                                        
                    <th colspan="2">Доля ответственности Перестрахователя</th>                    
                    <th colspan="2">Доля ответственности Перестраховщика</th>
                    <th rowspan="2">Брутто премия перестраховщика</th>
                    <th rowspan="2">Коммиссионный доход от перестраховщика </th>
                    <th rowspan="2">Нетто премия Перестраховщика</th>                    
                    <th rowspan="2">Скидка</th>                    
                    <th rowspan="2">Статус договора</th>
                </tr>     
                <tr>
                    <th>Дата начала</th>                
                    <th>Дата окончания</th>
                    <th>%</th>                                       
                    <th>Сумма</th>
                    <th>%</th>                                       
                    <th>Сумма</th>
                </tr>         
            </thead>
            <tbody>
            ';
            $i = 0;
            
            foreach($dan as $k=>$v)
            {                
                $i++;
                $tr = $i;
                if($b == false){
                    $tr = '<input type="checkbox" class="check" id="'.$v['CNCT_ID'].'" transh="'.$v['ID_TRANSH'].'">';
                }
                
                if(isset($_GET['list_contracts'])){
                    $tr = '<div class="btn-group">
                        <span data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="false">'.$v['ID_CONTRACTS'].' <span class="caret"></span></span>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="vozvrat" data-toggle="modal" data-target="#vozvrat_cnct" data="'.$v['ID_CONTRACTS'].'" data-cnct="'.$v['CNCT_ID'].'"><i class="fa fa-2x"></i> Создать возврат</a></li>
                        </ul>
                    </div>';
                    
                    if($v['BRUTTO'] < 0){$tr = $v['ID_CONTRACTS'];}
                }
                
                
                
                //if(isset($_GET['list_contracts'])){$tr = 'HELLO';}
                
                $html .= '<tr>
                    <td>'.$tr.'</td>
                    <td><a target="_blank" href="contracts?CNCT_ID='.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</a></td>                    
                    <td>'.$v['STRAHOVATEL'].'</td>
                    <td>'.$v['R_NAME'].'</td>
                    <td>'.$v['TYPE_DOG'].'</td>
                    <td>'.$v['AGENTNAME'].'</td>
                    <td>'.$v['DATE_BEGIN'].'</td>
                    <td>'.$v['DATE_END'].'</td>
                    <td>'.$v['PAY_SUM_V'].'</td>
                    <td>'.$v['PAY_SUM_P'].'</td>
                    <td>'.$v['DOL_P_REINS_PERC'].'</td>
                    <td>'.$v['OTV_REINS10'].'</td>
                    <td>'.$v['DOL_P_PERC'].'</td>
                    <td>'.$v['OTV_REINS90'].'</td>
                    <td>'.$v['BRUTTO'].'</td>  
                    <td>'.$v['KOMIS_REINS'].'</td>
                    <td>'.$v['NETTO_PREM_REINS'].'</td>
                    <td>'.$v['SKIDKA'].'</td>                    
                    <td>'.$v['STATE_NAME'].'</td>
                </tr>';
            }
            $html .= "</tbody></table>";            
            return $html;
        }
        
        private function search()
        {
            $date_begin = $this->array['date_begin'];
            $date_end = $this->array['date_end'];
            $id_agent = $this->array['id_agent'];
            
            $transh = '';
            $ss = '';
            
            if($id_agent !== ''){
                if($id_agent > 0){
                    $ss = 'and d.sicid_agent = '.$id_agent;
                    $transh .= $ss;
                }
            }
            if($date_begin !== ''){
                if($date_end !== ''){
                    $ss .= " and d.cnct_id in (select cnct_id from plat_to_1c where date_dohod between '$date_begin' and '$date_end')";
                    $transh .= " and P.DATE_DOHOD between '$date_begin' and '$date_end'";
                }else{
                    $ss .= " and d.cnct_id in (select cnct_id from plat_to_1c where date_dohod >= '$date_begin')";
                    $transh .= " and P.DATE_DOHOD >= '$date_begin'";
                }
            }else{
                if($date_end !== ''){
                    $ss .= " and d.cnct_id in (select cnct_id from plat_to_1c where date_dohod <= '$date_begin')";
                }
            }
            
            $ss_transh = $ss;
            
            $ss .= " and d.state in(12, 32) and d.cnct_id not in(select cl.cnct_id from BORDERO_CONTRACTS_LIST cl, BORDERO_CONTRACTS b where B.ID = CL.ID_CONTRACTS and B.STATE <> 13)";
            
            $this->html .= $this->tsp($ss, $ss_transh, $transh);                                                  
        } 
        
        private function send_replace($id)
        {
            $q = $this->db->Select("select * from BORDERO_STATE_PROC_OTHER where state_end = (select state from BORDERO_CONTRACTS where id = $id)");            
            $id_pers = $q[0]['DOLZH_END'];
                        
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION, S.EMAIL from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and s.date_layoff is null and S.JOB_POSITION = $id_pers";  
                                             
            $db = new DB();                        
            $dsp = $db->Select($sql);            
            
            require_once 'methods/xmpp.php';
            $j = new JABBER();
            $message_send = "Повторное уведомление для утверждения договора по перестрахованию - http://192.168.5.244/reins_bordero?form_setstate=$id";
            
            foreach($dsp as $k=>$v){
                $j->send_message($v['EMAIL'], $message_send);    
            }
            echo 'Повторное уведомление отправлено Успешно!'; 
            exit;
        }
        
        private function list_contracts()
        {            
            $and = '';
            $date_begin = '';
            $date_end = '';
            if(isset($this->array['date_begin'])){
                $date_begin = $this->array['date_begin'];
                $and = " and b.date_create >= to_date('$date_begin', 'dd.mm.yyyy')";
            }
            
            if(isset($this->array['date_end'])){
                $date_end = $this->array['date_end'];
                $and = " and b.date_create <= to_date('$date_end', 'dd.mm.yyyy')";
            }
            
            
            if($date_begin !== '' && $date_end !== ''){
                $date_begin = $this->array['date_begin'];
                $date_end = $this->array['date_end'];
                $and = " and b.date_create between to_date('$date_begin', 'dd.mm.yyyy') and to_date('$date_end', 'dd.mm.yyyy')";
            }else{
                $and = '';
            }
            
            if(isset($this->array['state'])){
                $state = $this->array['state'];
                if($state !== ''){                    
                    $and .= " and b.state = $state";
                }
            }
            
            $this->dan_array['list_states'] = $this->db->Select("select id, id||' - '||name name from bordero_state order by id");
            
            if($and == ''){
                $and = ' and b.date_create between ADD_MONTHS(sysdate, -1) and sysdate ';
            }
             
            $sql = "select b.*, emp_name(b.emp_id) empname, state_name_bordero(b.state) state_name, 
            (select count(*) from BORDERO_CONTRACTS_LIST where id_contracts = b.id) cn_count 
            from BORDERO_CONTRACTS b where (b.typ = 1 or B.ID_UV = 1) $and order by date_create";
            
            /*
            echo '<pre>';
            echo $sql;
            exit;   
            */          
            $q = $this->db->Select($sql);
                        
            $this->html = '
            <style>
            .hts{margin-right: 15px;border-right: solid 1px;padding-right: 10px;}
            </style>
            <div class="panel-group" id="accordion">';
            
            $i = 0;
            foreach($q as $k=>$v){
                $i++;
                $btn_set_state = 'set_note';
                if($v['STATE'] == 2){
                    $btn_set_state = 'set_note_rasp';                    
                }
                
                $this->html .= '                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="reins_bordero?export_html='.$v['ID'].'" target="_blank"><i class="fa fa-file-text-o"></i> HTML</a></li>
                                    <li><a href="reins_bordero?export_pdf='.$v['ID'].'" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                    <li><a href="reins_bordero?export_xls='.$v['ID'].'" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                    <li class="divider"></li>
                                                <li><a href="#" class="pereraschet" data="'.$v['ID'].'"><i class="fa fa-2x fa-calculate"></i> Пересчитать</a></li>
                                    ';
                                    if(trim($v['NUM_RASP']) !== ''){
                                      $this->html .= '<li class="divider"></li>
                                        <li><a href="reins_bordero?print_rasp='.$v['ID'].'" target="_blank">Печать распоряжения</a></li>';    
                                    }
                                    $this->html .= '<li class="divider"></li>
                                    <li><a href="#" data="'.$v['ID'].'" class="contracts_files" data-toggle="modal" data-target="#modal_files"><i class="fa fa-file-o"></i> Файлы</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="btn-info set_note" data-toggle="modal" data-target="#'.$btn_set_state.'" id="'.$v['ID'].'" data="0"><i class="fa fa-check"></i> Утвердить</a></li>
                                    <li><a href="#" class="btn-danger set_note" data-toggle="modal" data-target="#set_note" id="'.$v['ID'].'" data="1"><i class="fa fa-close"></i> Отклонить</a></li>
                                    <li class="divider"></li>
                                    <li><a href="reins_bordero?form_setstate='.$v['ID'].'" target="_blank">Показать в отдельном окне</a></li>                                    
                                    ';
                                    if($v['STATE'] > 0){
                                        $this->html .=  '<li><a href="javascript:;" class="send_replace" id="'.$v['ID'].'">Повторно уведомить</a></li>';                                        
                                    }
                                    
                                    if(($v['STATE'] !== '8')&&($v['STATE'] !== '10')){
                                        $this->html .= '<li><a href="reins_bordero?move_contract='.$v['ID'].'" target="_blank">Создать перенос договоров</a></li>';
                                        $this->html .=  '
                                        <li class="divider"></li>
                                        <li><a href="#" class="add_contracts" id="'.$v['ID'].'" data-toggle="modal" data-target="#all_modal">Добавить договора страхования</a></li>
                                        <li class="divider"></li>
                                        <li><a href="reins_bordero?delete_contracts='.$v['ID'].'">Удалить договора страхования</a></li>                                        
                                        <li><a href="javascript:;" class="delete_contract" id="'.$v['ID'].'">Удалить договор перестрахования</a></li>
                                        ';
                                    }else{
                                        if($v['PAY_SUM_OPL'] > 0){
                                            $this->html .=  '
                                            <li class="divider"></li>
                                            <li><a href="#" class="set_vozvrat_reins" data="'.$v['ID'].'" data-toggle="modal" data-target="#vozvrat_cnct">Создать возврат</a></li>                                            
                                            ';
                                        }
                                    }
                                    
                                    if($v['PAY_SUM_OPL'] < 0){
                                        $this->html .=  '
                                            <li class="divider"></li>
                                            <li><a href="reins_bordero?shet_opl='.$v['ID'].'" target="_blank">Печать счета на оплату</a></li>                                            
                                            ';
                                        if(($v['STATE'] == '8')&&($v['MHMH_ID'] == '')){                                            
                                            $this->html .= '<li><a href="#" data="'.$v['ID'].'" data-toggle="modal" data-target="#kvitovanie" class="btn_plat">Привязать платежное поручение</a></li>';
                                        }
                                    }
                $txt = '';      
                if($v['ID_UV'] == '1'){                    
                    $txt = '(Уведомление)';                    
                }
                $this->html .= '
                                </ul>
                            </div>
                                                        
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="false" class="">
                                <span class="hts">№ договора: <span class="text-danger">'.$v['CONTRACT_NUM'].' '.$txt.'</span></span>
                                <span class="hts">Дата: <span class="text-danger">'.$v['CONTRACT_DATE'].'</span></span>
                                <span class="hts">Сумма: <span class="text-danger">'.$v['PAY_SUM'].'</span></span>                                                       
                                <span class="hts">Кол-во: <span class="text-danger">'.$v['CN_COUNT'].'</span></span>
                                <span>Статус: <span class="text-danger">'.$v['STATE_NAME'].'</span></span>
                                                                
                            </a>                            
                        </h5>
                    </div>
                    <div id="collapse'.$i.'" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body" style="overflow: auto;max-height: 400px;">
                ';              
                
                $this->sqls = "select 
                    dr.id,
                    null type_dog, 
                    null id_transh,
                    d.cnct_id,  
                    d.contract_num,
                    fond_name(d.id_insur) strahovatel,
                    dr.r_name,
                    agent_name(d.sicid_agent) agentname,
                    d.date_begin,
                    d.date_end,
                    bordero_sum(d.cnct_id) pay_sum_v,  
                    bordero_pay_sum_p(d.cnct_id) pay_sum_p,
                    100 -  R.PERC_P_STRAH dol_p_reins_perc,
                    R.PERC_P_STRAH dol_p_perc,
                    round(bordero_sum(d.cnct_id) * ((100 -  R.PERC_S_STRAH) / 100)) otv_reins10,
                    round(bordero_sum(d.cnct_id) * (R.PERC_S_STRAH / 100)) otv_reins90,
                    BL.PAY_SUM brutto,    
                    bl.komis_reins,        
                    bl.pay_sum_opl netto_prem_reins,            
                    nvl(r.skidka, 0) skidka,
                    state_name(d.state) state_name,
                    bl.id_contracts                                                            
                from
                    contracts d,  
                    contr_agents ag,     
                    osns_calc os, 
                    osns_calc_new os2,
                    reinsurance r,
                    dic_reinsurance dr,
                    BORDERO_CONTRACTS_LIST bl
                where  
                    d.paym_code like '07%'                    
                    and dr.id = r.reinsur_id
                    and d.id_insur = ag.id
                    and d.cnct_id = os.cnct_id
                    and d.cnct_id = os2.cnct_id  
                    and bl.cnct_id = d.cnct_id              
                    and dr.vid in(1, 2)                
                    and d.cnct_id = r.cnct_id(+)";
                
                $this->html .= $this->tsp("and bl.id_contracts = ".$v['ID'], '', ' and d.cnct_id in(select cnct_id from bordero_contracts_list bl where bl.id_contracts = '.$v['ID'].' )');
                //$this->html .= $this->sql_all;                
                $this->html .='
                        </div>
                    </div>
                </div>';                
                                
            }                        
            $this->html .= '</div>';                                                
        }
                        
        public function html_report($id)
        {            
            $dsp = $this->db->Select("select * from bordero_contracts where id = $id");            
            $d = $dsp[0];            
            $html = '            
            <style>   
            body{
                font-size: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;                
            }
            table, td, th {
                border: 1px solid black;                
                font-size: 10px;
                font-family: "Times New Roman";                
            }
            
            td, th{
                padding-left: 5px;
                padding-right: 5px;
            }
            th{
                margin: 10px;
                background-color: #F5F5F6;
            }            
            </style>';
                        
            $sql = "select * from BORDERO_PRINT where id_reins = ".$d['ID_REINS'];
            
            $p = $this->db->Select($sql);            
            //echo $sql;
            
            $dic_reins = $this->db->Select('select * from dic_reinsurance where id = '.$d['ID_REINS']);
                        
            if(count($p) == 0){
                echo '<h1><center>Ошибка! Печать договора не найдена!</center></h1>';
                exit;                   
            }
            //echo $p[0]['ID'];
            $head_table = $p[0]['HTML_TABLE'];            
            $sql_text = $p[0]['SQL_TEXT'];
            $param = $p[0]['PARAM'];
            
            $sql_text = str_replace(":$param", $id, $sql_text);
            
            /*
            echo '<pre>';
            echo $sql_text;
            echo '</pre>';
            exit;
            */
            
            //$sql_text .= ' order by 27';
            
            // С поправочным кожффицентом
            $list_poprovochniy = $this->db->select("select os.KOEF_PP,  substr(d.periodich, 2) periodich 
            from osns_calc os, contracts d, bordero_contracts b, bordero_contracts_list bl 
            where
            bl.cnct_id = d.cnct_id
            and d.cnct_id = os.cnct_id      
            and b.id = bl.id_contracts    
            and bl.id_contracts = $id");
    
           $pp_koef = $list_poprovochniy['KOEF_PP'];
            
            $diana_rodstv = '';
            $rst_diana = array();            
            if($id == 2505){                
                $diana_rodstv = '-';
                $rst_diana = array("CNT"=>"", "PAY_SUM_V"=>"", "SUM_S_GAK"=>"", "SUM_S_STRAH"=>"", "PAY_SUM_P"=>"");
            }
                                                
            $q = $this->db->Select($sql_text);            
            
            $id_bordero = $q[0]['ID_BORDERO'];
            $tsts = $this->db->Select("select * from bordero_contracts where id = $id_bordero"); 
            $id_reins = $tsts[0]['ID_REINS'];           
            $type = $tsts[0]['ID_UV'];
            $contract_date_r = $tsts[0]['CONTRACT_DATE'];
            
          /*  echo '<pre>';
            print_r($q);
            exit; */
            
            
            foreach($q as $k=>$v)
            { 
                $vid = 1;
                if($v['CNCT_ID'] !== ''){
                    $qw = $this->db->Select("select vid from contracts where cnct_id = ".$v['CNCT_ID']);
                    if(count($qw) > 0){
                       $vid = $qw[0]['VID'];
                    }
                }
                //print_r($qw);
                
                  
                $html .= '<tr>';
                foreach($v as $i=>$t){
                    if($i !=='ID_BORDERO'){                        
                        if($i !== 'CNCT_ID'){
                            $html .= '<td>';                            
                            if(isset($rst_diana["$i"])){
                                $html .= '-';
                            }
                            $html .= $t;
                            $html .= "</td>";
                                                        
                        }
                    }
                }
                $html .= '</tr>';
                $b = false;
                
                
                if(isset($v['DATA_TRANSH']) && $vid == 1 && $id_reins !== '216'){  
                   
                //if((trim($v['DATA_TRANSH']) !== '')||($v['CNCT_ID'] !== '')||(trim($v['PERIODICH']) == 'В рассрочку')){                    
                if(trim($v['PERIODICH']) == 'В рассрочку'){
                     
                    $sqlss = "select nom from transh where id = (select id_transh from bordero_contracts_list where cnct_id = ".$v['CNCT_ID']." and id_contracts = ".$v['ID_BORDERO'].")";                      
                    $pr = $this->db->Select($sqlss); 
                                                    
                    if(count($pr) == 0){
                        $sqlss = "select nom from transh where cnct_id = ".$v['CNCT_ID']."order by nom asc";
                        $pr = $this->db->Select($sqlss);
                        
                    }
                                        
                    $mx_pr = $this->db->Select("select max(nom) from transh where cnct_id = ".$v['CNCT_ID']);
               //  $pr[0]['NOM'] = 1;
                    if(isset($pr[0]['NOM'])){
                    if($pr[0]['NOM'] == '1'){  
                        $num = 1;
                        $sqlst = "select 
                        tr.pay_sum pay_sum_transh,
                        DATE_PL + 
                            case 
                                when to_date('$contract_date_r', 'dd.mm.yyyy') >= to_date('14.11.2019', 'dd.mm.yyyy') then 15
                                when to_date('$contract_date_r', 'dd.mm.yyyy') >= to_date('06.06.2019', 'dd.mm.yyyy') then 10
                                else 0
                            end DATE_PL,
                        case 
                            when tr.nom = (select max(nom) from transh where cnct_id = tr.cnct_id) then 
                            '".$v['SUM_P_STRAH']."' - (
                                select 
                                    sum(round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2)) 
                                    from 
                                        transh 
                                    where 
                                        cnct_id = tr.cnct_id 
                                        and nom < (select max(nom) from transh where cnct_id = tr.cnct_id)
                                )                                        
                        else round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2) 
                        end PAY_SUM  
                    from 
                        transh tr 
                    where 
                        cnct_id = ".$v['CNCT_ID']." order by DATE_PL ASC";
                        //."and nom > 1";
                        
                     
                       
                        $tr = $this->db->Select($sqlst);
                        foreach($tr as $h=>$transh){
                            $html .= '<tr>';
                            foreach($v as $i=>$t){
                                if($i !=='ID_BORDERO'){
                                    if($i !== 'CNCT_ID'){
                                        $text = '';
                                        
                                        if($i == 'IDNUM'){
                                            $text = $t.'.'.$num;                                        
                                        }
                                        
                                        if($i == 'DATA_TRANSH'){
                                            $text = $transh['DATE_PL'];
                                        }
                                        
                                        if($i == 'SUMMA_TRANSH'){
                                            $text = $transh['PAY_SUM'];
                                        }
                                        
                                        if($i == 'PAY_SUM_P'){
                                            $text = $transh['PAY_SUM_TRANSH'];
                                        }
                                        
                                        $html .= "<td>$text</td>";
                                    }
                                }
                            }
                            $html .= '</tr>';
                            $num++;                
                        }
                    
                    }
                    }
                }
                }
                
                
                
          if(isset($v['DATA_TRANSH']) && $vid == 1 && $id_reins == '216'){  
                //if((trim($v['DATA_TRANSH']) !== '')||($v['CNCT_ID'] !== '')||(trim($v['PERIODICH']) == 'В рассрочку')){                    
                if(trim($v['PERIODICH']) == 'В рассрочку'){

                    $sqlss = "select nom from transh where id = (select id_transh from bordero_contracts_list where cnct_id = ".$v['CNCT_ID']." and id_contracts = ".$v['ID_BORDERO'].")";                      
                    $pr = $this->db->Select($sqlss); 
                                                    
                    if(count($pr) == 0){
                        $sqlss = "select nom from transh where cnct_id = ".$v['CNCT_ID']."order by id ASC";
                        $pr = $this->db->Select($sqlss);
                    }
                                        
                    $mx_pr = $this->db->Select("select max(nom) from transh where cnct_id = ".$v['CNCT_ID']);
               //  $pr[0]['NOM'] = 1;
                    if(isset($pr[0]['NOM'])){
                    if($pr[0]['NOM'] == '1'){  
                        $num = 1;
                        $sqlst = "select 
                        tr.pay_sum pay_sum_transh,
                        DATE_PL + 
                            case 
                                when to_date('$contract_date_r', 'dd.mm.yyyy') >= to_date('14.11.2019', 'dd.mm.yyyy') then 15
                                when to_date('$contract_date_r', 'dd.mm.yyyy') >= to_date('06.06.2019', 'dd.mm.yyyy') then 10
                                else 0
                            end DATE_PL,
                        case 
                            when tr.nom = (select max(nom) from transh where cnct_id = tr.cnct_id) then 
                            '".$v['SUM_P_STRAH']."' - (
                                select 
                                    sum(round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2)) 
                                    from 
                                        transh 
                                    where 
                                        cnct_id = tr.cnct_id 
                                        and nom < (select max(nom) from transh where cnct_id = tr.cnct_id)
                                )                                        
                        else round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2) 
                        end PAY_SUM  
                    from 
                        transh tr 
                    where 
                        cnct_id = ".$v['CNCT_ID']." order by DATE_PL ASC";
                        //."and nom > 1";
                       
                        $tr = $this->db->Select($sqlst);
                        foreach($tr as $h=>$transh){
                            $html .= '<tr>';
                            foreach($v as $i=>$t){
                                if($i !=='ID_BORDERO'){
                                    if($i !== 'CNCT_ID'){
                                        $text = '';
                                        
                                        if($i == 'IDNUM'){
                                            $text = $t.'.'.$num;                                        
                                        }
                                        
                                        if($i == 'PERIODICH'){
                                            $text = $transh['DATE_PL'];
                                        }
                                        
                                        if($i == 'SUMMA_TRANSH'){
                                            $text = $transh['PAY_SUM'];
                                        }
                                        
                                        if($i == 'PAY_SUM_P'){
                                            $text = $transh['PAY_SUM_TRANSH'];
                                        }
                                        
                                        $html .= "<td>$text</td>";
                                    }
                                }
                            }
                            $html .= '</tr>';
                            $num++;                
                        }
                    
                    }
                    }
                }
                }
                
            }
            
         
            $head_table = str_replace("{%HTML%}", $html, $head_table);
            if($type !== '1' && $id_reins !== '216'){
                $head_table = '<div style="text-align: center;"><h4>БОРДЕРО ПРЕМИЙ № '.$d['CONTRACT_NUM'].' от '.$d['CONTRACT_DATE'].' года 
                к Договору облигаторного-факультативного пропорционального перестрахования № '.$dic_reins[0]['CONTRACT_NUM'].' от '.$dic_reins[0]['CONTRACT_DATE'].' г.</h4></div>'.$head_table;
            
                $qs = $this->db->Select("select * from dic_reinsurance where id = ".$d['ID_REINS']);
                
                $pst = $this->db->Select("select * from bordero_contracts where id = ".$id);
                
                $date = $pst[0]['CONTRACT_DATE']; //$dic_reins[0]['CONTRACT_DATE'];
                $sql_gak = "select * from BORDERO_PODPIS where id_reins = 0 
                and date_begin <= to_date('$date', 'dd.mm.yyyy') and (date_end >= to_date('$date', 'dd.mm.yyyy') or date_end is null)
                order by id desc
                ";
                
                $q_gak = $this->db->Select($sql_gak);            
                
                $q_reis = $this->db->Select("select * from BORDERO_PODPIS where id_reins = ".$d['ID_REINS']." and date_begin <= '$date' and (date_end >= '$date' or date_end is null)");
                
                $qst = array("DOLGNOST","FIO_RUK");
                if(count($q_reis) > 0){
                    $qst['DOLGNOST'] = $q_reis[0]['DOLGNOST'];
                    $qst['FIO_RUK'] = $q_reis[0]['FIO_RUK'];
                }else{
                    $qst['DOLGNOST'] = $qs[0]['DIR_DOLGNOST'].' '.str_replace('(Облигатор)', '', $qs[0]['R_NAME']);
                    $qst['FIO_RUK'] = $qs[0]['DIR_NAME'];
                }
                
                
                $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">'.$q_gak[0]['DOLGNOST'].'<br />'.$q_gak[0]['FIO_RUK'].'</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
                
                
                
                
                /*
                 $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">Управляющий директор АО "КСЖ "ГАК"<br />Акажанов  А.А.</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
                
                */
                
                
                
            /*    
                $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">Председатель Правления АО "КСЖ "ГАК"<br />Амерходжаев Г.Т.</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
             */   
            
            //<div style="float: right; width: 45%; text-align: right; font-size: 12px;"><br />'.$qs[0]['DIR_DOLGNOST'].' '.str_replace('(Облигатор)', '', $qs[0]['R_NAME']).' <br />'.$qs[0]['DIR_NAME'].' _______________</div>
            }
                        elseif($type !== '1' && $id_reins == '216'){
                $head_table = '<div style="text-align: center;"><h4>БОРДЕРО ПРЕМИЙ № '.$d['CONTRACT_NUM'].' от '.$d['CONTRACT_DATE'].' года 
                к Договору облигаторного-факультативного пропорционального перестрахования № '.$dic_reins[0]['CONTRACT_NUM'].' от '.$dic_reins[0]['CONTRACT_DATE'].' г. по договорам Обязательного страхования работников от несчастных случаев при исполнении им трудовых (служебных) обязанностей</h4></div>'.$head_table;
            
                $qs = $this->db->Select("select * from dic_reinsurance where id = ".$d['ID_REINS']);
                
                $pst = $this->db->Select("select * from bordero_contracts where id = ".$id);
                
                $date = $pst[0]['CONTRACT_DATE']; //$dic_reins[0]['CONTRACT_DATE'];
                $sql_gak = "select * from BORDERO_PODPIS where id_reins = 0 
                and date_begin <= to_date('$date', 'dd.mm.yyyy') and (date_end >= to_date('$date', 'dd.mm.yyyy') or date_end is null)
                order by id desc
                ";
                
                $q_gak = $this->db->Select($sql_gak);            
                
                
                $q_reis = $this->db->Select("select * from BORDERO_PODPIS where id_reins = ".$d['ID_REINS']." and date_begin <= '$date' and (date_end >= '$date' or date_end is null)");
                
                $qst = array("DOLGNOST","FIO_RUK");
                if(count($q_reis) > 0){
                    $qst['DOLGNOST'] = $q_reis[0]['DOLGNOST'];
                    $qst['FIO_RUK'] = $q_reis[0]['FIO_RUK'];
                }else{
                    $qst['DOLGNOST'] = $qs[0]['DIR_DOLGNOST'].' '.str_replace('(Облигатор)', '', $qs[0]['R_NAME']);
                    $qst['FIO_RUK'] = $qs[0]['DIR_NAME'];
                }
                
                
                $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">'.$q_gak[0]['DOLGNOST'].'<br /> <br/>'.$q_gak[0]['FIO_RUK'].'</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
                
                
                
                
                /*
                 $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">Управляющий директор АО "КСЖ "ГАК"<br />Акажанов  А.А.</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
                
                */
                
                
                
            /*    
                $head_table .= '
                <table border=0 width="100%" style="font-size: 8px;">
                    <tr>
                        <td style="border-color: #fff;">Председатель Правления АО "КСЖ "ГАК"<br />Амерходжаев Г.Т.</td>
                        <td style="border-color: #fff;text-align:right">'.$qst['DOLGNOST'].' <br />'.$qst['FIO_RUK'].' </td>
                    </tr>
                    <tr>
                        <td style="border-color: #fff;">_______________</td>
                        <td style="border-color: #fff;text-align:right">_______________</td>
                    </tr>
                    </table> 
                ';
             */   
            
            //<div style="float: right; width: 45%; text-align: right; font-size: 12px;"><br />'.$qs[0]['DIR_DOLGNOST'].' '.str_replace('(Облигатор)', '', $qs[0]['R_NAME']).' <br />'.$qs[0]['DIR_NAME'].' _______________</div>
            }
            else{
                $head_table = str_replace("Страховая премия по Договору", "Страховая премия по Договору (Транш)", $head_table);
            }
            return $head_table;            
        }
        
        private function export_html($dan)
        {                      
            header('Content-Type: text/html; charset=utf-8');
            echo $this->html_report($dan);                                                        
            exit;
        }     
        
        private function export_pdf($dan)
        {            
            //require_once("methods/mpdf/mpdf.php");            
            //$mpdf = new mPDF();   
            
            $mpdf = new \Mpdf\Mpdf();               
            $mpdf->showImageErrors = true;       
            $mpdf->SetTitle($dan);  
            $mpdf->AddPage('L');  
            //$date = date('d.m.Y H:i:s');           
            //$mpdf->setFooter($date.' Страница - {PAGENO}');
            
                        
            $base64 = 'styles/img/logo_gak_min2.jpg';
            //Водяной знак
            
            $mpdf->SetWatermarkImage($base64);            
            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.1;
            
            //Вставить footer с картинкой
            
            $mpdf->SetHTMLFooter('            
            <div style="position: relative;float: left; width: 33%;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div> 
            <div style="position: relative;float: left; width: 33%;text-align: center;opacity: 0.5;"><img src="'.$base64.'" width="25" height="25" ></div> 
            <div style="position: relative;float: right; width: 33%;text-align: right;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div>');
                        
            $html = $this->html_report($dan);
            
            $mpdf->WriteHTML($html);                        
            $mpdf->Output();            
            exit;
        }
        
        private function export_xls($dan)
        {                  
            error_reporting(E_ALL);
            ini_set('display_errors', TRUE); 
            ini_set('display_startup_errors', TRUE); 

            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment;Filename=$dan.xls");
            echo $this->html_report($dan);                                                        
            exit;
        }     
        
        private function form_setstate($id)
        {        
            if($id == ''){exit;}            
            $qs = $this->db->Select("select typ from bordero_contracts where id = $id");            
            if($qs[0]['TYP'] == "2"){
                header("Location: reins_fakultativ?form_setstate=$id");
            }else if($qs[0]['TYP'] == "3"){
                header("Location: reins_fakultativ?form_setstate=$id");                             
            }else{                
                $this->html = '';
                
                $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz";
                
                $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
                where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";
                                                   
                $db = new DB();                        
                $dsp = $db->Select($sql);
                                                    
                $dep = $dsp[0]['JOB_SP']; //Департамент
                $dolzh = $dsp[0]['JOB_POSITION']; //Должность                        
                
                $sqls = "select b.*, emp_name(b.emp_id) empname, state_name_bordero(b.state) state_name, reins_name(b.id_reins) reinsname, 
                (select count(*) from BORDERO_CONTRACTS_LIST where id_contracts = b.id) cn_count from BORDERO_CONTRACTS b where b.id = $id";
                
                $s = $this->db->Select($sqls);
                $v = $s[0];
                $state = $v['STATE'];
                
                $btn_set_state = 'set_note';
                if($state == 2){
                    $btn_set_state = 'set_note_rasp';                
                }
                
                $this->html .= '<div class="col-lg-6 well">';
                $this->html .= '<p><b>№ договора: </b>'.$v['CONTRACT_NUM'].'</p>';
                $this->html .= '<p><b>Дата договора: </b>'.$v['CONTRACT_DATE'].'</p>';
                $this->html .= '<p><b>Перестраховщик: </b>'.$v['REINSNAME'].'</p>';
                $this->html .= '<p><b>№ распоряжения: </b>'.$v['NUM_RASP'].'</p>';
                $this->html .= '<p><b>Дата распоряжения: </b>'.$v['DATE_RASP'].'</p>';
                $this->html .= '</div>';
                $this->html .= '<div class="col-lg-6 well">';
                $this->html .= '<p><b>Количество договоров: </b>'.$v['CN_COUNT'].'</p>';
                $this->html .= '<p><b>Перестраховочная премия к оплате: </b>'.$v['PAY_SUM_OPL'].'</p>';            
                $this->html .= '<p><b>Статус: </b>'.$v['STATE_NAME'].'</p>';
                $this->html .= '<p><b>№ счета: </b><a href="ftp://upload:Astana2014@192.168.5.2/'.$v['FILE_SCHET'].'" target="_blank" download>'.$v['NUM_SCHET'].'</a></p>';
                $this->html .= '<p><b>Дата счета: </b>'.$v['DATE_SCHET'].'</p>';
                $this->html .= '</div>';
                
                $this->html .= '<div class="col-lg-12">';
                $q = $this->db->Select("select * from BORDERO_STATE_PROC_OTHER where DEPARTMENT_BEGIN = $dep and DOLZH_BEGIN = $dolzh and state_begin = $state order by TYPE_BTN");
                //echo $this->db->sql;
                
                if(count($q) == 0){                
                    $this->html .= '<label class="label-danger">Вы не можете утверждать или отклонять данный договор.</label>';
                }else{                    
                    $q = $this->db->Select("
                    select 
                        STATE_BEGIN, 
                        STATE_END, 
                        DEPARTMENT_BEGIN, 
                        DEPARTMENT_END, 
                        TYPE_BTN  
                    from 
                        BORDERO_STATE_PROC_OTHER 
                    where 
                        state_begin = $state
                    group by
                        STATE_BEGIN, 
                        STATE_END, 
                        DEPARTMENT_BEGIN, 
                        DEPARTMENT_END, 
                        TYPE_BTN      
                    order by TYPE_BTN                    
                    ");
                    
                    foreach($q as $k=>$v){   
                        $btn = 'btn-info';
                        $text = 'Утвердить';                
                        if($v['TYPE_BTN'] == 1){
                            $btn = 'btn-danger';
                            $text = 'Отклонить';                    
                        }                                
                        
                        $this->html .= '<button class="btn '.$btn.' btn-sm hts set_note pull-left" data-toggle="modal" data-target="#'.$btn_set_state.'" id="'.$id.'" data="'.$v['TYPE_BTN'].'">'.$text.'</button> ';
                    }    
                }            
                
                $this->html .= '<div class="pull-right">
                                    <a href="reins_bordero?export_html='.$id.'" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-html5"></i></a>                                
                                    <a href="reins_bordero?export_pdf='.$id.'" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                    <a href="reins_bordero?export_xls='.$id.'" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-file-excel-o"></i></a>
                                </div>';
                                
                $this->html .= '</div>';   
                
                $this->html .= '<div style="height: 600px;overflow: auto;float: left;width: 100%;">';
                $this->html .= $this->html_report($id);
                $this->html .= '</div>';        
            }                        
        }
        
        
        private function list_transh()
        {            
            //$sql = $this->sqls_transh; 
            //$sql = str_replace("and d.sicid_agent <> 1620", "", $sql);
            //$sql = str_replace("null id_contracts", "null id_contracts, (select reins_id from osns_calc where cnct_id = d.cnct_id) IDR ", $sql);
            
            $sql = "select * from BORDERO_LIST_TRANSH_1C";
            
            //echo $sql;
            $dan = $this->db->Select($sql);
            $html = '
            <style>
                td{
                    font-size: 11px;
                }
            </style>
            <table class="table table-bordered tps">
            <thead style="font-size: 10px;">
                <tr>
                    <th rowspan="2"><input type="checkbox" class="check_all"></th>
                    <th rowspan="2">№ договора страхования</th>
                    <th rowspan="2">Страхователь</th>
                    <th rowspan="2">Перестраховщик</th>
                    <th rowspan="2">Тип договора</th>
                    <th rowspan="2">Агент</th>
                    <th colspan="2">Период действия страхования</th>                    
                    <th rowspan="2">Страховая сумма</th>
                    <th rowspan="2">Страховая премия</th>                                        
                    <th colspan="2">Доля ответственности Перестрахователя</th>                    
                    <th colspan="2">Доля ответственности Перестраховщика</th>
                    <th rowspan="2">Брутто премия перестраховщика</th>
                    <th rowspan="2">Комиссия перестрахователя </th>
                    <th rowspan="2">Нетто премия Перестраховщика</th>                    
                    <th rowspan="2">Скидка</th>                       
                </tr>
                <tr>
                    <th>Дата начала</th>                
                    <th>Дата окончания</th>
                    <th>%</th>                                       
                    <th>Сумма</th>
                    <th>%</th>                                       
                    <th>Сумма</th>
                </tr>         
            </thead>
            <tbody>
            ';
            
            $i = 0;
            
            foreach($dan as $k=>$v)
            {     
                $i++;
                $tr = $i;
                /*
                if($ss == ''){
                    $tr = '<input type="checkbox" class="check" id="'.$v['CNCT_ID'].'" data="'.$v['ID_TRANSH'].'">';
                }
                
                if($v['IDR'] == 156){
                  $tr = '<button class="btn btn-block btn-info btn-xs set_uv_transh" id="'.$v['CNCT_ID'].'" data="'.$v['ID_TRANSH'].'">Уведомление</button>';  
                }
                
                if($v['IDR'] == 96){
                */
                  $tr = '<button class="btn btn-block btn-info btn-xs set_uv_transh" data-toggle="modal" data-target="#set_note_rasp_transh" id="'.$v['CNCT_ID'].'" data="'.$v['ID_TRANSH'].'">Уведомление</button>';  
                //}
                
                $html .= '<tr>
                    <td>'.$tr.'</td>
                    <td><a target="_blank" href="contracts?CNCT_ID='.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</a></td>                    
                    <td>'.$v['STRAHOVATEL'].'</td>
                    <td>'.$v['R_NAME'].'</td>
                    <td>'.$v['TYPE_DOG'].'</td>
                    <td>'.$v['AGENTNAME'].'</td>
                    <td>'.$v['DATE_BEGIN'].'</td>
                    <td>'.$v['DATE_END'].'</td>
                    <td>'.$v['PAY_SUM_V'].'</td>
                    <td>'.$v['PAY_SUM_P'].'</td>
                    <td>'.$v['DOL_P_REINS_PERC'].'</td>
                    <td>'.$v['OTV_REINS10'].'</td>
                    <td>'.$v['DOL_P_PERC'].'</td>
                    <td>'.$v['OTV_REINS90'].'</td>
                    <td>'.$v['BRUTTO'].'</td>  
                    <td>'.$v['KOMIS_REINS'].'</td>
                    <td>'.$v['NETTO_PREM_REINS'].'</td>
                    <td>'.$v['SKIDKA'].'</td>
                </tr>';
            }
            $html .= "</tbody></table>";
            $this->html = $html;
            return $html;            
        }
        
        private function set_transh_uv($id_transh)
        {
            $date_rasp = $this->array['idate_rasp'];
            $num_shet = $this->array['inum_shet'];
            $date_schet = $this->array['idate_schet'];
            $note = $this->array['note'];
            
            $fst = '';
            if(isset($_FILES['ischet_fail'])){                    
                $file = $_FILES['ischet_fail'];
                if($file['tmp_name'] !== ''){
                    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
                    $s = explode(".", $file['name']);
                    $is = count($s);
                    $file_type = $s[$is-1]; 
                    
                    $files = "tr_$id_transh.$file_type";
                    $handle = $handle = fopen($file['tmp_name'], 'r');
                    if(!$ftp->uploadfile("reinsurance/shet_opl/", $files, $handle))
                    {                        
                        echo "Ошибка создания файла!";
                        $this->GET();
                        return;
                    }
                    $fst = 'reinsurance/shet_opl/'.$files;
                }
            }
            
            $sql = "begin 
                bordero.set_uv_transh('$id_transh', to_date('$date_rasp', 'dd.mm.yyyy'), '$num_shet', to_date('$date_schet', 'dd.mm.yyyy'), '$note', '$fst'); 
            end;";            
            //echo $sql;exit;
            
            $this->db->Execute($sql);
            $q = $this->db->Select("select max(id) id from bordero_contracts");
            $id = $q[0]['ID'];
            $message_send = "Для согласования уведомления по оплате транша перестрахования бордеро. http://192.168.5.244/reins_bordero?form_setstate=$id";
            
            require_once 'methods/xmpp.php';            
            $j = new JABBER();
            $j->send_message('a.akazhanov@gak.kz', $message_send);
            return;            
        }
        
        private function del_list_bordero($dan)
        {
            $DS = json_decode($dan);  
                          
            $msg = '';                       
            foreach($DS as $k=>$v){                
                if(trim($v->id_transh) == ''){
                    $qsql = "insert into bordero_own(cnct_id, date_add) values('".$v->cnct_id."', sysdate)";
                }else{
                    $qsql = "insert into BORDERO_CONTRACTS_TRANSH_OWN(id_transh) values (".$v->id_transh.")";                                  
                }                              
                if(!$this->db->Execute($qsql)){
                    $msg .= $this->db->message."<br />";
                }                                              
            }         
                   
            echo $msg;    
            exit;            
        }
        
        private function move_contract($id)
        {
            $sql = "select 
              b.contract_num contract_num_reins,
              d.contract_num,
              fond_name(d.id_insur) strah,
              reins_name(b.id_reins) reinsname,
              d.date_begin,
              d.date_end,
              bl.*
            from 
              bordero_contracts b,
              bordero_contracts_list bl,
              contracts d,
              reinsurance r
            where 
              bl.id_contracts = b.id
              and d.cnct_id = bl.cnct_id
              and r.cnct_id = d.cnct_id
              and b.id = $id";
            
            $q = $this->db->Select($sql);
            $this->dan_array['list'] = $q;
            $this->dan_array['num'] = $q[0]['CONTRACT_NUM_REINS'];
            $this->dan_array['id'] = $id;          
        }
        
        private function search_move_contracts($text)
        {
            $id = $_GET['move_contract'];
            $sql = "select id, contract_num, contract_date, reins_name(id_reins) reinsname from bordero_contracts where upper(contract_num) like upper('%$text%') and id <> $id";
            $qs = $this->db->Select($sql);
            if(count($qs) <= 0){                
                $q['message'] = 'Не найден ни один договор!';    
            }else{
                $q['message'] = '';
                $q['list'] = $qs;
            }
            echo json_encode($q);
            exit;
        }    
        
        private function new_id_move($sss)
        {            
            $old_id = $this->array['move_contract_id'];
            
            $qst = $this->db->Select("select * from BORDERO_CONTRACTS where id = $old_id");
            $type_dog = $qst[0]['TYP'];
            
            $lists = $this->array['move_cnct'];
            $new_id = $this->array['new_id_move'];
            $sql = "begin ";
            foreach($lists as $l){
                $sql .= " 
                  bordero.BorderoCnctMove($old_id, $new_id, $l); 
                ";
            }
            $sql .= " end;";
            global $msg;
            if(!$this->db->Execute($sql)){
                $msg = 'Ошибка перемещения!';
                return false;
            }
            if($type_dog == '1'){
                header("Location: reins_bordero?list_contracts");
            }else{
                header("Location: reins_fakultativ?list_contracts");
            }
        }
        
        private function delete_contracts($id)
        {
            $q = $this->db->Select("select * from bordero_contracts where id = $id");
            $this->dan_array['ps'] = $q[0];
            $sql = "select
              d.contract_num,
              D.CONTRACT_DATE,
              fond_name(d.id_insur) strahovatel,
              bl.*   
            from 
              bordero_contracts bc, 
              bordero_contracts_list bl,
              contracts d
            where 
              bl.id_contracts = bc.id
              and bl.cnct_id = d.cnct_id
              and bc.id = $id";
            
            $this->dan_array['list'] = $this->db->Select($sql);            
        }
        
        
        private function get_add_contracts($id)
        {
            $q = $this->db->Select("select * from bordero_contracts where id = $id");
            $id_reins = $q[0]['ID_REINS'];
            $dan['ID'] = $id;
            $dan['list'] = $this->db->Select("
            select 
    d.cnct_id,
    d.contract_num,
    d.contract_date,
    fond_name(d.id_insur) strahovatel,
    bordero_sum(d.cnct_id) pay_sum_v,  
    bordero_pay_sum_p(d.cnct_id) pay_sum_p,
    round(bordero_pay_sum_p(d.cnct_id) * (R.PERC_P_STRAH / 100), 2) brutto,
    ROUND(
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) * (nvl(r.skidka, 0) / 100), 2) komis_reins,        
            round(
                case 
                  when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                  else bordero_pay_sum_p(d.cnct_id)
                end * (R.PERC_P_STRAH / 100)
            , 2) -
            ROUND(
                round(
                    case 
                      when d.vid = 2 then d.sum_vozvr
                      when (select count(*) from transh where cnct_id = d.cnct_id) > 0 then (select pay_sum from transh where cnct_id = d.cnct_id and nom = (select max(nom) from transh where cnct_id = d.cnct_id and date_f is not null))  
                      else bordero_pay_sum_p(d.cnct_id)
                    end * (R.PERC_P_STRAH / 100)
                , 2) * (nvl(r.skidka, 0) / 100)           
            , 2) netto,
    nvl(r.skidka, 0) skidka
from
    contracts d,
    reinsurance r
where 
    d.cnct_id = r.cnct_id
    and d.state in(12, 32)
    and d.date_close is null
    and d.cnct_id not in(select cnct_id from bordero_contracts_list)
    and R.REINSUR_ID = $id_reins
            ");
            require_once VIEWS.'/reins_bordero/list_other.php';
            exit;
        }
        
        private function set_contract()
        {            
            $id = $this->array['set_contract'];
            $sql = "begin
            ";
            foreach($this->array['set_add_contracts'] as $k=>$v){
                $sql .= "bordero.SetContractBordero($id, $v);
                ";
            }
            $sql .= "end; ";
            if(!$this->db->Execute($sql)){
                global $msg;
                $a = new ALERTS();
                $msg = $a ->ErrorMin($this->db->message);                
            }
            unset($_POST);
            $this->GET();
        }

        public function getjobuser()
        {
            $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz"; //Эмаил текущего пользователя
            
            //Данный блог при переходе на другую базу переделать
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";  
                             
            $db = new DB();                                                
            $dsp = $db->Select($sql);
                        
            //$dep = $dsp[0]['JOB_SP']; //Департамент
            //$dolzh = $dsp[0]['JOB_POSITION']; //Должность
            return $dsp[0];
        }
        
                        
    }
?>