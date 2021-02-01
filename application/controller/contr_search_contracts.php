<?php
    class SEARCH
    {
        public $dan;
        public $html;
        private $db;
        private $array;
        private $branch;        
        
        public function __construct()
        {
            $this->db = new DB3();
            $this->dan = array();
            $this->html = '';
            
            global $active_user_dan;
            global $msg;
            
            $this->branch = $active_user_dan['brid'];
            
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();                        
        }
        
        private function GET()
        {
            foreach($_GET as $k=>$v){
                if(method_exists($this, $k)){
                    $this->array = $_GET;
                    $this->$k($v);
                }                                
            }
        }
        
        
        private function POST()
        {
            foreach($_POST as $k=>$v){
                if(method_exists($this, $k)){
                    $this->array = $_POST;
                    $this->$k($v);
                }
            }
        }
        
        private function date_begin()
        {
            $date_begin = $this->array['date_begin'];
            $date_end  = $this->array['date_end'];
            $pa = 0;
            $osor = 0;
            $osns = 0;
            $dobr = 0; 
            
            if($date_begin == ''){
                $this->html = ALERTS::ErrorMin('Не выбрана дата');
                return;
            }
            
            foreach($this->array['dog'] as $v=>$k){                
                if($k == '01'){$pa = -1;}
                if($k == '02'){$osor = -1;}
                if($k == '07'){$osns = -1;}
                if($k == '06'){$dobr = -1;}
            }
            
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID from table(SEARCH_CONTRACTS.DATE_SEARCH('$date_begin', '$date_end', $pa, $osor, $osns, $dobr, substr('$this->branch', 1, 2) ))";
            //echo '<pre>'.$sql.'</pre>';
            $this->result($sql);
        }
        
        private function search_state($id)
        {
            if($id == ''){
                $this->html = ALERTS::ErrorMin('Не выбран статус');
                return;
            } 
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.state($id, substr('$this->branch', 1, 2) ))";
            $this->result($sql);
            
        }
        
        private function contract_num($text)
        {
            if($text == ''){
                $this->html = ALERTS::ErrorMin('Номер договора не может быть пустым');
                return;
            }
            
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.contract_num(upper('$text'), substr('$this->branch', 1, 2) ))";
            $this->result($sql);
        }
        
        private function search_insur($text)
        {
            if($text == ''){
                $this->html = ALERTS::ErrorMin('Наименование страхователя не может быть пустым');
                return; 
            }
            global $active_user_dan;            
            $branch = substr($active_user_dan['brid'], 1, 2);
            
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.contragents(upper('$text'), '$branch'))";
            $this->result($sql);
        }
        
        private function raschet_state($id)
        {
            if($id < 0){
                $this->html = ALERTS::ErrorMin('Не выбран статус расчета');
                return;
            }
            
            $sql = "
             SELECT Decode(vid, 1, 'Договор', 'Доп соглашение') vid,
                           d.contract_num,
                           d.contract_date,
                           Progr_name(d.paym_code) progr_name,
                           Decode(Substr(d.paym_code, 1, 2), '07', Fond_name(id_insur), Client_name(d.id_annuit)) l_name,
                           State_name(d.state) state_name,
                           d.pay_sum_v,
                           d.pay_sum_p,
                           Branch_name(d.branch_id) BRANCH_name,
                           Esbd_name(d.in_esbd) ESBD_NAME,
                           d.cnct_id
                    FROM   contracts d,
                           clients cl,
                           recalc r
                    WHERE  d.paym_code LIKE '02%'
                           AND d.id_annuit = cl.sicid
                           AND d.cnct_id = r.cnct_id
                           AND r.cnct_new IS NULL  
                           and r.state = $id
            ";
                        
            $this->result($sql);
        }
        
        private function sicid($method)
        {            
            $method = trim($method);
            if($this->array['lastname'] == ''){
                $this->html = ALERTS::ErrorMin('Поле Фамилия не может быть пустой');
                return;
            }
            
            if(method_exists($this, $method)){
                $this->$method();
            }
        }
        
        private function id_annuit()
        {
            global $active_user_dan;
            $emp = $active_user_dan['emp'];
            if($emp == ''){
                $emp  = 0;
            }
            $lastname = $this->array['lastname'];
            $firstname = $this->array['firstname'];
            $middlename = $this->array['middlename'];
            $old = 0;
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.clients(upper('$lastname'), upper('$firstname'), upper('$middlename'), substr('$this->branch', 1, 2), 0, $emp))";
            //echo $sql;
            $this->result($sql);
        }
        
        private function ID_paym()
        {
            $lastname = $this->array['lastname'];
            $firstname = $this->array['firstname'];
            $middlename = $this->array['middlename'];
            $old = 0;
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.clients_paym(upper('$lastname'), upper('$firstname'), upper('$middlename'), substr('$this->branch', 1, 2), 0))";
            $this->result($sql);
        }
        
        private function ID_BREAD_WIN()
        {
            $lastname = $this->array['lastname'];
            $firstname = $this->array['firstname'];
            $middlename = $this->array['middlename'];
            $old = 0;
            $sql = "select VID, CONTRACT_NUM, CONTRACT_DATE, PROGR_NAME, L_NAME, STATE_NAME, PAY_SUM_V, PAY_SUM_P, BRANCH_NAME, ESBD_NAME, CNCT_ID 
            from table(SEARCH_CONTRACTS.clients_bread(upper('$lastname'), upper('$firstname'), upper('$middlename'), substr('$this->branch', 1, 2), 0))";
            $this->result($sql);
        }
        
        private function result($sql)
        {
            //echo $sql;
            global $msg;
            $table = new TABLE($this->db);
            $table->colViews = array(                
                "VID"           => "Вид", 
                "CONTRACT_NUM"  => "№ договора",
                "CONTRACT_DATE" => "Дата",
                "PROGR_NAME"    => "Программа",
                "L_NAME"        => "ФИО/Наименование страхователя",
                "STATE_NAME"    => "Статус", 
                "PAY_SUM_V"     => "Страховая сумма",
                "PAY_SUM_P"     => "Страховая премия",
                "BRANCH_NAME"   => "Регион",                   
                "ESBD_NAME"     => "Статус ЕСБД",
                "CNCT_ID"       => "ID"        
            );
            
            $table->notColViews = array("CNCT_ID");   
            $table->indexCol = 'CNCT_ID';     
            $table->arrayname = "search_result";        
            $table->sql = $sql; 
                        
            $table->URLOnDbClick = 'contracts';
        
            $table->ViewResult();
            $msg .= $table->message; 
            $colaps = 'collapsed';
            $this->html = $table->html;
        }
        
        
    }
    
    array_push($js_loader, 
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/others/datepicker.js',
        'styles/js/plugins/iCheck/icheck.min.js');
        
    array_push($css_loader, 
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css'        
    );        
    
    $breadwin[] = 'Договора';
    $breadwin[] = 'Поиск';    
    $title = 'Поиск и просмотр договоров';     
    $sql = '';
    
    $db = new DB3();
    $states = $db->Select("select state, state || ' - '|| name states from sims_maket_state order by state");    
    
    $s = new SEARCH();
    
    
    /*
    $table = new TABLE($db);
    $colaps = '';
    
    if(count($GETS) > 0){
        
        
        
        $b = false;
        $s = '';
        $dopsql = '';
        if(isset($active_user_dan['brid']))
        {
            $brid = $active_user_dan['brid'];
            if($brid !== '0000'){
                $dopsql = " substr(B.RFBN_ID, 1, 2) = substr('$brid', 1, 2) and "; 
            }
            if($active_user_dan['role_type'] > 0){
                $dopsql .= " b.asko = ".$active_user_dan['role_type']." and";
            }
        }
        
        //Задаем первоначальные параметры SQL тескта
        $sql = "select                                
                decode(vid,1,'Договор','Доп соглашение') vid,  
                d.contract_num,
                d.contract_date,
                progr_name(d.paym_code) progr_name,
                decode(substr(d.paym_code,1,2),'07', FOND_name(id_insur), client_name(d.id_annuit)) l_name,  
                state_name(d.state) state_name,
                d.pay_sum_v,
                d.pay_sum_p,
                BRANCH_name(d.branch_id) BRANCH_name,                                   
                ESBD_NAME(d.in_esbd) ESBD_NAME,
                d.cnct_id";        
        $ss1 = " from contracts_maket d, dic_branch b where B.RFBN_ID = D.BRANCH_ID and ".$dopsql;
        $ss2 = " from contracts d , dic_branch b where B.RFBN_ID = D.BRANCH_ID and ".$dopsql;
        
        if(isset($GETS['lastname'])){                                    
            $s = " d.".$GETS['sicid']." in(select sicid from clients cl where 
            cl.lastname like upper('".$GETS['lastname']."%') 
            and cl.firstname like upper('".$GETS['firstname']."%') 
            and cl.middlename like upper('".$GETS['middlename']."%')
            )";
                        
            $b = true;
            if(trim($GETS['lastname']) == ''){
                $msg = ALERTS::ErrorMin('Фамилия не может быть пустой');
                $b = false;                
            }            
        }
        
        if(isset($GETS['contract_num'])){            
            $s = " d.contract_num like '".$GETS['contract_num']."%'";                         
            $b = true;
            
            if(trim($GETS['contract_num']) == ''){
                $msg = ALERTS::ErrorMin('Номер договора не может быть пустым'); 
                $b = false;               
            }            
        }
        
        if(isset($GETS['search_insur'])){
            $s = " d.paym_code like '07%' and d.id_insur in (select id from CONTR_AGENTS where upper(NAME) like upper('%".$GETS['search_insur']."%'))";                         
            $b = true;
            
            if(trim($GETS['search_insur']) == ''){
                $msg = ALERTS::ErrorMin('Наименование страхователя не может быть пустым'); 
                $b = false;
            }            
        }
        
        if(isset($GETS['date_begin']))
        {
            $s = " d.contract_date between to_date('".$GETS['date_begin']."','dd.mm.yyyy') and  to_date('".$GETS['date_end']."','dd.mm.yyyy')";
            if(isset($GETS['dog'])){
                $s .= " and substr(paym_code,1,2) in (";
                $i = 0;
                foreach($GETS['dog'] as $k=>$v){
                    if($i > 0){
                        $s .= ",";
                    }
                    $s .= "'$v'";
                    $i++;
                }     
                $s .= ")";                           
            }
            //and substr(paym_code,1,2) in ('01')                         
            $b = true;
            if(trim($GETS['date_begin'] == ''||trim($GETS['date_end'])) == ''){
                $msg = ALERTS::ErrorMin('Даты "С" и "По" не могут быть пустыми'); 
                $b = false;
            }              
        }
        
        if(isset($GETS['search_state'])){
            $s = ' d.state = '.$GETS['search_state'];
            $b = true;
            if(trim($GETS['search_state'] == '')){
                $msg = ALERTS::ErrorMin('Не выбран статус'); 
                $b = false;
            }            
        }
        
        $sql = $sql.$ss1.$s." union all ".$sql.$ss2.$s;
        //echo $sql;
        
        if(isset($GETS['raschet_state'])){
            $sql = "
             SELECT Decode(vid, 1, 'Договор', 'Доп соглашение')                  vid,
                           d.contract_num,
                           d.contract_date,
                           Progr_name(d.paym_code)                                     progr_name,
                           Decode(Substr(d.paym_code, 1, 2), '07', Fond_name(id_insur),
                                                             Client_name(d.id_annuit)) l_name,
                           State_name(d.state)                                         state_name,
                           d.pay_sum_v,
                           d.pay_sum_p,
                           Branch_name(d.branch_id)                                    BRANCH_name,
                           Esbd_name(d.in_esbd)                                        ESBD_NAME,
                           d.cnct_id
                    FROM   contracts d,
                           clients cl,
                           recalc r
                    WHERE  d.paym_code LIKE '02%'
                           AND d.id_annuit = cl.sicid
                           AND d.cnct_id = r.cnct_id
                           AND r.cnct_new IS NULL  
            ";
            
            if($GETS['raschet_state'] !== '-1'){
                $sql .= " and r.state = ".$GETS['raschet_state'];
            }            
            $b = true;            
            if(trim($GETS['raschet_state'] == '')){
                $msg = ALERTS::ErrorMin('Не выбран статус расчета'); 
                $b = false;
            }            
        }
                                
        if($b){            
            $table->colViews = array(                
                "vid"           => "Вид", 
                "contract_num"  => "№ договора",
                "contract_date" => "Дата",
                "progr_name"    => "Программа",
                "l_name"        => "ФИО/Наименование страхователя",
                "state_name"    => "Статус", 
                "pay_sum_v"     => "Страховая сумма",
                "pay_sum_p"     => "Страховая премия",
                "BRANCH_name"   => "Регион",                   
                "ESBD_NAME"     => "Статус ЕСБД",
                "CNCT_ID"       => "ID"        
            );
            
            $table->notColViews = array("CNCT_ID");   
            $table->indexCol = 'CNCT_ID';     
            $table->arrayname = "search_result";        
            $table->sql = $sql; 
                        
            $table->URLOnDbClick = 'contracts';
        
            $table->ViewResult();
            $msg .= $table->message; 
            $colaps = 'collapsed';                                                    
        }
        
        
    
    }   
    */
    $othersJs .= "
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('.ranges').children('ul').children('.active').attr('class', '');                
            });
        </script>";               
?>