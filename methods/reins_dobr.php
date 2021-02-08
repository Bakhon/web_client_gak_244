<?php

class REINS_DOBR
{
        private $db;
        private $date_begin;
        private $date_end;
        public $array;
        public $dan = array();
        public $list_reins;   
        public $message = ''; 
        public $html;
        private $state_f;   
        private $vid; 
        private $sql_text;
        
        public function __construct()
        {                        
            $this->db = new DB3();            
            $method = $_SERVER['REQUEST_METHOD'];                           
            $this->$method();
        }
        
        private function GET()
        {
            if(count($_GET) <= 0){
                $this->lists();                                
            }else{            
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){                        
                        $this->$k($v);
                    }else{
                        $this->dan[$k] = $v;
                    }
                }
            }                                    
        }
        
        private function POST()
        {
            
            //print_r($_POST);exit;
            
            if(count($_POST) <= 0){
                $this->dan = array();
            }else{                
                $i = 0;
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){
                        $i++;
                        $this->array = $_POST;                        
                        $this->$k($v); 
                    }
                }
                if($i == 0){
                    exit;
                }
                
                $this->onAjax();
            }            
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
        
        private function date_begin($dan)
        {
            $this->date_begin = $dan;
        }
        
        private function date_end($dan)
        {
            $this->date_end = $dan;
        }
        
        private function state($dan)
        {
            $this->state_f = $dan;
        }
        
        private function main_dog()
        {
            $this->vid = '';
        }
        
        private function obligator(){
            $this->obligator = '1';
        }
        
        private function fakultativ(){
            $this->fakultativ = '2';
        }
        
        private function dop_dog()
        {
            $this->vid = 'not';
        }
        
        private function filter()
        {
            $filter = "";            
            if(isset($this->date_begin)){
                $filter = " bd.contract_date between '".date("d.m.Y", strtotime($this->date_begin))."' and '".date("d.m.Y", strtotime($this->date_end))."'";
            }                        
            return $filter;
        }
        
        
   
                private function lists($vid = 1)
        {
            $this->list_reins = $this->db->Select("select * from DIC_REINSURANCE");
            
            $lst = "12, 32";
            if($vid == 2){
                $lst = "12, 32, 18";
            }
            $pay = "'0902000001'";
            if($vid == 2){
                $pay = "'0902000001', '1401000001'";
            }
            
            $filter = $this->filter();
            $sql = "select
                    case
                        when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then client_name(D.ID_STRAHOVATEL)
                        else fond_name(D.ID_STRAHOVATEL)
                      end strahovatel,
                      branch_name(d.branch_id) branch_name,
                      nvl((select cn.bin from CONTR_AGENTS cn where cn.id = d.id_strahovatel), (select cs.iin  from CLIENTS cs where cs.SICID = d.id_strahovatel)) iin,
                      nvl((select c.resident from CONTR_AGENTS c where c.id = d.id_strahovatel), (select cl.resident from clients cl where cl.sicid = d.id_strahovatel)) resident,
                     d.state,d.paym_code,  d.*
                    from dobr_dogovors d
                    where d.paym_code in (0601000001, 0401000001)
                    and d.state in (12, 32)
                    and D.ID_NUM not in (select cnct_id from dobr_dogovors_own) 
                    and d.id_num not in (select CNCT_ID from BORDERO_DOBR_DOGOVORS_LIST)
                    order by D.ID_NUM ASC
";            
            //echo '<pre>'.$sql.'</pre>';
               
            //echo '<pre>'.$sql.'</pre>';
            $list = $this->db->Select($sql);
            $this->dan = $list;
            
            
  
            
            global $js_loader, $css_loader, $othersJs;
            array_push($js_loader, 
                'styles/js/plugins/dataTables/jquery.dataTables.js',
                'styles/js/plugins/dataTables/dataTables.bootstrap.js',
                'styles/js/plugins/dataTables/dataTables.responsive.js',
                'styles/js/plugins/dataTables/dataTables.tableTools.min.js'
            );
                
            array_push($css_loader, 
                'styles/css/plugins/dataTables/dataTables.bootstrap.css',
                'styles/css/plugins/dataTables/dataTables.responsive.css',
                'styles/css/plugins/dataTables/dataTables.tableTools.min.css'        
            );        
            
            $othersJs = "<script>
                $(document).ready(function() {
                    $('.dataTables-example').DataTable();                        
                    var oTable = $('#editable').DataTable();            
                });        
            </script>";  
            
        }
        
        
        private function calc($d){
            $id = $_POST['calc'];
            $sql = "select * from LIST_DOBR_DOGOVORS_CLIENTS where cnct_id = $id order by 1";
            $q = $this->db->select($sql);
            $age = $q[0]['AGE'];
            $sex = $q[0]['SEX'];
            $dop_pokr = $q[0]['DOP_POKR'];
            if($sex == '1'){
                $col = 'MALE';
            }
            if($sex == '0'){
                $col = 'FEMALE';
            }
                                    
             $id_annuit = $q[0]['ID_ANNUIT'];            
             $sql_dobr_dogovors = "select case when TYPE_STRAHOVATEL = 0 or TYPE_STRAHOVATEL is null then 1 else 2 end type_strah from list_dobr_dogovors where cnct_id = $id";           
             $list_dobr_dogovors = $this->db->select($sql_dobr_dogovors);           
             $type_strahovatel = $list_dobr_dogovors[0]['TYPE_STRAH'];
             
             
            
             
             if($dop_pokr) {
             $sql = "select * from DOBR_DOGOVORS_CLIENTS where cnct_id = 137";
             $list = $this->db->select($sql);
             $num_dop_pokr = $list[0]['DOP_POKRITIE'];
           
             $sql_type_dop_pokr  = "select * from DOBR_DIC_POKR where id = $num_dop_pokr";
            
             $list_type_dop_pokr = $this->db->select($sql_type_dop_pokr);
            
             $title_pokr = $list_type_dop_pokr[0]['ID'];
             $sql_dop_pokr = "select * from DOBR_DIC_TARIF_HANNOVER_DOPFIZ where age = $age and TYPE_DOP_POKR = $type_strahovatel and ID_DOBR_DIC_POKR = $title_pokr";
            
             $list_dop_pokr = $this->db->select($sql_dop_pokr);
             }
             
         //   $sql2 = "select dc.NAGRUZ, AGE, MALE SEX from DOBR_DIC_TARIF_HANNOVER_OSN d, DOBR_DOGOVORS_CLIENTS_CALC dc where d.AGE = $age and d.type = 1 and d.TYPE_POKR = 1 and dc.cnct_id = $id";
             $sql2 = "select AGE, $col SEX from DOBR_DIC_TARIF_HANNOVER_OSN where AGE = $age and type = $type_strahovatel";    
          //   echo $sql2;                  
             $q2 = $this->db->select($sql2);
             $q2['NAGRUZ'] = $this->db->select("select     
                    case 
                        when d.type_pokr = 0 then 'Основное покрытие' 
                        else 'Дополнительное покрытие' 
                    end name_type_pokr,
                    (select name from dobr_dic_pokr where id = d.id_pokr) name_pokr,                    
                    d.*
                from 
                    DOBR_DOGOVORS_CLIENTS_CALC d 
                where 
                    cnct_id = $id
                    and d.sicid = $id_annuit order by d.type_pokr"); 
              $q2['PERIOD'] = $this->db->select("select * from LIST_DOBR_DOGOVORS_CLIENTS where cnct_id = $id order by 1"); 
              $q2['DOP_POKR'] = $list_dop_pokr;                    
              echo json_encode($q2);
              exit;
            
        }
        
        
                private function fs_prov($d)
        {    
            
            $s = '';
            $i = 0;
            $dan = array();
            $dan['message'] = '';
            foreach($_POST['fs_prov'] as $k=>$v) {
                $sql = "select * from dobr_dogovors where id_num = $v";
               $q = $this->db->select($sql);
            }
            
            $id_annuit = $q[0]['ID_STRAHOVATEL'];
            // если страховая сумма меньше то ставим Hannover
            if($q[0]['INS_SUMMA'] <= '10000000'){                
                $dan['reins_name'] = 36;
                $dan['reins_vid'] = 1;
                $qs = $this->db->select("select * from dic_reinsurance where id =".$dan['reins_name']);
                $qs2 = $this->db->select("select * from LIST_DOBR_DOGOVORS_CLIENTS where cnct_id = $v and DOP_POKR like '2 - Cмерть Застрахованного в результате несчастного случая'");
                if(count($qs2) > 0){
                    if($qs2[0]['STR_SUM'] <= '20000000'){
                         $dan['reins_name'] = 36;
                    }else{
                         $dan['reins_name'] = '';
                    }
                }            
                $dan['contract_date'] = $qs[0]['CONTRACT_DATE'];
                $dan['contract_num'] = $qs[0]['CONTRACT_NUM'];                
            }
            
     /*       
            $sql = "select     
                    case 
                        when d.type_pokr = 0 then 'Основное покрытие' 
                        else 'Дополнительное покрытие' 
                    end name_type_pokr,
                    (select name from dobr_dic_pokr where id = d.id_pokr) name_pokr,                    
                    d.*
                from 
                    DOBR_DOGOVORS_CLIENTS_CALC d 
                where 
                    cnct_id = $v
                    and d.sicid = $id_annuit order by d.type_pokr";
                    
                    $qs2 = $this->db->select($sql);
                    $dan['nagruz'] = $qs2[0]['NAGRUZ']; */
            
        /*     $sql = "select * from LIST_DOBR_DOGOVORS_CLIENTS where cnct_id = $id order by 1";
             $qs = $this->db->select($sql);
             $id_annuit = $qs[0]['ID_ANNUIT'];
                
             $sqlst = "select * from DOBR_DOGOVORS_CLIENTS_NAGRUS where cnct_id = $cnct and id_annuit = $id_annuit order by id_type";   */
            
            echo json_encode($dan);
            exit;
            
            
           
            
      /*      
              if($this->proverkaBlockBase() == false){
                $dan['message'] = "База заблокированна САРиА! <br />Идет расчет резервов";
                echo json_encode($dan);
                exit;
            }
            
            $s = '';
            $i = 0;
            $dan = array();
            $dan['message'] = '';
            foreach($d as $k){
                if($i > 0){
                    $s .= ",";
                }
                $s .= $k;
                $i++;
            }
            
            $vid = $this->db->Select("select vid from contracts where cnct_id in ($s) group by vid");
            
            if(count($vid) > 1){
                $dan['message'] = 'Вы выбрали 2 типа договоров основной и дополнительно соглашение';
            }
            
            if($vid[0]['VID'] == "2"){
                $sql = "select r.contract_num, R.REINSUR_ID from reinsurance r  where 
                r.cnct_id in(select id_head from contracts where cnct_id in($s))
                group by r.contract_num, R.REINSUR_ID ";
                                
                $q = $this->db->Select($sql);
                
                if(count($q) > 1){
                    $dan['message'] = 'Для заведения дополнительного соглашения 
                    <br />необходимо выбрать договора подходящие к 1 договору перестрахования';
                }else{
                    $sql = "
                    select 
                        r.contract_num, 
                        R.REINSUR_ID,
                        (select count(*) + 1 from contracts d, reinsurance rs 
                            where rs.cnct_id = d.cnct_id and d.id_head = r.cnct_id 
                            and rs.contract_num like '%Д%') cnt,
                        (select min(id) from bordero_contracts 
                        where contract_num = r.contract_num and id_head is null) id_head                         
                    from 
                        reinsurance r 
                    where 
                        r.cnct_id in(select id_head from contracts where cnct_id in($s))";
                                                                
                    $q = $this->db->Select($sql);
                    $dan['reins_name'] = $q[0]['REINSUR_ID'];                    
                    $dan['contract_num'] = $q[0]['CONTRACT_NUM']."/Д".$q[0]['CNT'];
                    $dan['id_head'] = $q[0]['ID_HEAD'];
                }                
            }
            echo json_encode($dan);
            exit;
         */  
        }

        
        
                private function list_contracts()
        {            
            
            $filter = '';
           
            if(isset($this->date_begin)){
              /*  if($this->date_begin !== ''){
                    $filter = ' and bd.CONTRACT_DATE';
                } */
                
                if(isset($this->date_end)){
                    if($this->date_end  !== ''){
                        $filter .= " bd.contract_date between to_date('$this->date_begin', 'dd.mm.yyyy') and to_date('$this->date_end', 'dd.mm.yyyy')";
                    }
                }
            }
            if(isset($this->state_f)){
                if($this->state_f !== ''){
                    $filter .= " and bd.state = $this->state_f";
                }
            }
            
            if(isset($this->vid)){
                $filter .= " and bd.id_head is $this->vid null";                
            }
            
            if(isset($this->obligator)){
                $filter .= "and bd.typ = $this->obligator";
            }
            
            if(isset($this->fakultativ)){
                $filter .= "and bd.typ = $this->fakultativ";
            }
                       
                              
            if($filter == ''){
                $filter .= " BD.CONTRACT_DATE between ADD_MONTHS(sysdate, -3) and sysdate";
            }
         
            $sql = "
            select (select count(*) from bordero_dobr_dogovors_list l where L.ID_CONTRACTS = bd.id) CNT, STATE_NAME_BORDERO(bd.state) state_name, bd.* from bordero_dobr_dogovors bd  where
            $filter            
             order by bd.id ASC
          ";
          
                                       
            $ldan = $this->db->Select($sql);            
            $dan = array();
           
            foreach($ldan as $k=>$v){
                $sql = "select case
                            when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then client_name(D.ID_STRAHOVATEL)
                            else fond_name(D.ID_STRAHOVATEL)
                          end STRAH_NAME, 
                          (select sum(bl.PAY_SUM) from bordero_dobr_dogovors_list bl where bl.id_contracts = ".$v['ID'].") PAY_SUM_LIST,
                          (select count(*) from bordero_dobr_dogovors_list l where L.ID_CONTRACTS = bd.id) CNT_ALL,
                          (select DR.NAME from DIC_REINSURANCE_VID dr where DR.ID = r.vid) TYPE, 
                          DR.R_NAME NAME, d.*, bl.*, bd.contract_date, bd.contract_num, bd.ID BORDERO_ID 
                          from dobr_dogovors d, bordero_dobr_dogovors_list bl, bordero_dobr_dogovors bd, reinsurance r, dic_reinsurance dr 
                          where bd.id = bl.id_contracts and bl.id_contracts = ".$v['ID']." and bl.cnct_id = d.id_num and d.id_num  = R.ID_DOBR and R.REINSUR_ID = dr.id";
             
                $q = $this->db->Select($sql);                    
                
                $dan[$k] = $ldan[$k];
                $dan[$k]['lists'] = $q;
                $dan[$k]['list_fak'] = $qs;
            } 
               
            $this->dan['list_contracts'] = $dan;
             $this->dan['list_states'] = $this->db->Select("select id, id||' - '||name name from bordero_state order by id");
           // $this->dan['list_states'] = $this->db->Select("select id, id||' - '||name name from bordero_state order by id");
           // $this->dan['filter'] = $filter;
           
        }
        
        private function reins_vid($dan){
            $this->reins_vid = $dan;
        }
        
               
        private function contr_num($dan)
        {
            $cn = '';
            $i = 0;
           $filter = '';
            foreach($dan as $k=>$v){
                if($i > 0){$cn .= ',';}
                $cn .= $v;  
                $i++;          
            }                         
           if($this->reins_vid == '3'){
            $filter = 'and rownum < 2';
           }
            $sql = "select
                    case
                        when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then client_name(D.ID_STRAHOVATEL)
                        else fond_name(D.ID_STRAHOVATEL)
                      end strahovatel,
                      branch_name(d.branch_id) branch_name,
                       (SELECT id || ' - ' || naimen
                                FROM DOBR_SPR_OSN_P
                               WHERE id = ldc.osn_pokritie)
                                osn_pokr,
                             (SELECT id || ' - ' || naimen
                                FROM DOBR_DOP_STRAH
                               WHERE id = ldc.dop_pokritie)
                                dop_pokr,
                      nvl((select cn.bin from CONTR_AGENTS cn where cn.id = d.id_strahovatel), (select cs.iin  from CLIENTS cs where cs.SICID = d.id_strahovatel)) iin,
                      nvl((select c.resident from CONTR_AGENTS c where c.id = d.id_strahovatel), (select cl.resident from clients cl where cl.sicid = d.id_strahovatel)) resident,
                     d.state,d.paym_code,  d.*
                    from dobr_dogovors d, LIST_DOBR_DOGOVORS_CLIENTS ldc
                    where
                    d.id_num in ($cn)
                    and d.paym_code in (0601000001, 0401000001)
                    and d.state in (12, 32)
                    and d.id_num = ldc.cnct_id
                    and D.ID_NUM not in (select cnct_id from dobr_dogovors_own) $filter order by D.ID_NUM ASC";     
                                
            $this->dan = $this->db->Select($sql);
            
            $r = $this->db->Select("select * from dic_reinsurance where id = ".$_POST['reins_name']);            
            $this->list_reins = $r[0];//['R_NAME'];
            
        }
        
        
        
                private function contract_num($dan)
        {
            if($this->sql_text == ''){                            
                $sql = "
                select 
                    rownum,
                    d.contract_num, 
                    'Новый' status_reins, 
                    C.NAME,
                    C.BIN,
                    branch_name(d.branch_id) region,
                    case 
                      when d.vid = 1 then d.contract_date 
                      else (select contract_date from contracts where cnct_id = d.id_head)
                    end contract_date,
                    O.RISK_ID,
                    d.date_begin,
                    d.date_end,
                    nvl(R.DATE_BEGIN, d.date_begin) reins_DATE_BEGIN, 
                    nvl(R.DATE_end, d.date_end) reins_DATE_end,
                    case
                      when nvl((select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id), 0) = 0 then  O.CNT_AUP+O.CNT_PP+o.CNT_VP 
                      else (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id)
                    end cnt,
                    d.pay_sum_v,
                    A.TARIF,
                    R.PERC_S_GAK,
                    R.SUM_S_GAK,
                    R.PERC_S_STRAH,
                    R.SUM_S_STRAH,
                    D.PAY_SUM_P,
                    R.PERC_P_STRAH,
                    R.SUM_P_STRAH_all,
                    R.SUM_P_STRAH SUM_P_STRAHs,
                    trim(substr(D.PERIODICH, 2)) PERIODICH,
                    reins_transh_html(d.cnct_id, r.PERC_P_STRAH) primechanie
                from 
                    REINSURANCE r, 
                    contracts d,
                    contr_agents c,
                    osns_calc o,
                    DIC_OKED_AFN a 
                where  
                    d.cnct_id = r.cnct_id
                    and A.ID = D.OKED_ID
                    and o.cnct_id = d.cnct_id 
                    and R.CONTRACT_NUM = '$dan'
                    and C.ID = d.id_insur
                    and d.state <> 13";
                                            
                if(isset($_GET['cnct_id'])){
                    $sql .= " and d.cnct_id = ".$_GET['cnct_id'];
                }
                $this->sql_text = $sql;
            }
            
            $q = $this->db->Select($this->sql_text);
            $this->q_dan1 = $q;
            
            $html = '';
            $html .= '<style type="text/css">        
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
                background-color: #F5F5F6;
            }            
            </style>';
                        
            $html .= '<div style="float: left; width: 100%;"><table border="1"><thead>
                        <tr>
                            <th rowspan="2">№</th>
                            <th rowspan="2">№ договора страхования</th>                            
                            <th rowspan="2">Статус бизнеса</th>
                            <th rowspan="2">Страхователь</th>
                            <th rowspan="2">БИН</th>
                            <th rowspan="2">Регион Страхователя</th>
                            <th rowspan="2">Дата заключения основного договора</th>
                            <th rowspan="2">Класс профессионального риска</th>
                            <th rowspan="2">Начало действия договора страхования</th>
                            <th rowspan="2">Окончание действия договора страхования</th>
                            <th rowspan="2">Начало действия периода перестрахования</th>
                            <th rowspan="2">Окончание действия перестрахования</th>
                            <th rowspan="2">Количество работников</th>                            
                            <th rowspan="2">Страховая сумма</th>
                            <th rowspan="2">Оригинальный страховой тариф</th>                            
                            <th colspan="2">Собственное удержание </th>
                            <th colspan="2">Ответственность перестраховщика</th>
                            <th rowspan="2">Страховая премия по договору</th>
                            <th colspan="2">Перестраховочная премия</th>
                            <th rowspan="2">Перестраховочная премия к оплате</th>
                            <th rowspan="2">Условия оплаты страховой премии</th>
                            <th rowspan="2">Примечание</th>
                        </tr>
                        <tr>                                                        
                            <th>%</th>
                            <th>Сумма</th>
                            <th>%</th>
                            <th>Сумма</th>                            
                            <th>%</th>
                            <th>Сумма</th>                                                                                    
                        </tr>
                    </thead>
                    <tbody>';
            foreach($q as $k=>$v)
            {
                $html .= '<tr>';
                foreach($v as $i=>$d)
                {                     
                    if(substr($d, 0, 1) == ','){
                        $html .= '<td><center>0'.$d.'</center></td>';
                    }elseif(substr($d, 0, 1) == '.'){
                        $html .= '<td><center>0'.$d.'</center></td>';
                    }else{
                        $html .= '<td><center>'.$d.'</center></td>';    
                    }
                }
                $html .= '</tr>';
            }
            
            $ds = $this->db->Select("select 
                sum(case when nvl((select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id), 0) = 0 then  O.CNT_AUP+O.CNT_PP+o.CNT_VP else (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) end) cnt,
                sum(d.pay_sum_v) pay_sum_v,
                null TARIF,
                null PERC_S_GAK,
                sum(R.SUM_S_GAK) SUM_S_GAK,
                null PERC_S_STRAH,
                sum(R.SUM_S_STRAH) SUM_S_STRAH,
                sum(D.PAY_SUM_P) PAY_SUM_P,
                null PERC_P_STRAH,
                sum(R.SUM_P_STRAH_all) SUM_P_STRAH,
                sum(R.SUM_P_STRAH) SUM_P_STRAHs,
                null PERIODICH,
                null primechanie
            from 
                REINSURANCE r, 
                contracts d,
                contr_agents c,
                osns_calc o,
                DIC_OKED_AFN a 
            where  
                d.cnct_id = r.cnct_id
                and A.ID = D.OKED_ID
                and o.cnct_id = d.cnct_id 
                and R.CONTRACT_NUM = '$dan'
                and C.ID = d.id_insur
                and d.state <> 13");
                
            $this->q_dan2 = $ds;
            
            foreach($ds as $k=>$v){
                $html .= '<tr>
                    <td colspan="11"></td>
                    <td><center>Итого:</center></td>';
                foreach($v as $i=>$d){
                    $html .= '<td><center>'.$d.'</center></td>';
                }
                
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';                        
            return $html;
        }
        
                private function own_cnct($dan)
        {
            foreach($dan as $k=>$v){
                if(!$this->db->Execute("insert into DOBR_DOGOVORS_OWN (cnct_id, date_add) values ($v, sysdate)")){
                    $this->message .= 'Ошибка #1. Обратитесь в ДИТ';
                }
            }            
            echo $this->message;
            exit;
        }
        
        private function own_list()
        {
            $sql = "select
                        case
                        when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then client_name(D.ID_STRAHOVATEL)
                        else fond_name(D.ID_STRAHOVATEL)
                      end strahovatel,
                      branch_name(d.branch_id) branch_name,
                      nvl((select cn.bin from CONTR_AGENTS cn where cn.id = d.id_strahovatel), (select cs.iin  from CLIENTS cs where cs.SICID = d.id_strahovatel)) iin,
                      nvl((select c.resident from CONTR_AGENTS c where c.id = d.id_strahovatel), (select cl.resident from clients cl where cl.sicid = d.id_strahovatel)) resident,
                     d.state,d.paym_code,  d.*
                    from dobr_dogovors d
                    where d.paym_code in (0601000001, 0401000001)
                    and d.state in (12, 32)
                    and D.ID_NUM in (select cnct_id from dobr_dogovors_own)";
            $list = $this->db->select($sql);
            $this->dan = $list;            
        }
        
        private function return_cnct($dan){
             foreach($dan as $k=>$v){
                if(!$this->db->Execute("DELETE DOBR_DOGOVORS_OWN where cnct_id = $v")){
                    $this->message .= 'Ошибка #1. Обратитесь в ДИТ';
                }
            }            
            echo $this->message;
            exit;
        }  
        
        private function save_reins_contr_num($dan){
            
            global $active_user_dan;
            
             $q = $this->db->Select("select SEQ_BORDERO_CONTRACTS.nextval id from dual");
             $id_contracts = $q[0]['ID'];
             
             $dsp = $dan[0];
             print_r($dan);
            
            foreach($dan as $k=>$v){
                $sql = "select * from DOBR_DOGOVORS where id_num = ".$v['cnct_id'];
                $contracts = $this->db->select($sql);   
                $cn =  $contracts[0];      
                $qr = $this->db->select(" select DOP_POKR from list_dobr_dogovors_clients where cnct_id =".$v['cnct_id']);     
             //   print_r($contracts);
                $dop_pokr = $qr[0]['DOP_POKR'];
                
                $sql_reinsurance = "INSERT INTO REINSURANCE(ID, ID_DOBR,  OSNS_SUMV,  OSNS_SUMP,  REINSUR_ID, CONTRACT_NUM,  CONTRACT_date,
                          DATE_BEGIN,  DATE_END, PERC_s_STRAH,  PERC_p_STRAH ,
                          PERC_s_gak,  PERC_p_gak,  SUM_s_STRAH,  SUM_p_STRAH, SUM_s_gak,  SUM_p_gak,
                          SKIDKA,  TARIF,  PERC_AGENT,  PERC_OT_PRIB, vid, sum_p_gak_all, sum_p_strah_all) 
                          VALUES(sq_reinsurance.nextval, '".$v['cnct_id']."', ".str_replace(',', '.', $v['gak_summa']).", '".$cn['INS_PREMIYA']."', '".$v['reins_id']."', '".$v['contract_num']."',
                          '".$v['contract_date'].".', '".$cn['VIPLAT_BEGIN']."', '".$cn['VIPLAT_END']."', ".str_replace(',', '.', $v['reins_proc']).", ".str_replace(',', '.', $v['reins_prem_proc']).", ".$v['gak_proc'].", ".$v['gak_proc'].", ".$v['reins_summa'].", ".$v['reins_prem_summa'].",  ".str_replace(',', '.', $v['gak_summa']).",
                            ".str_replace(',', '.',$v['reins_prem_summa']).", '', '".$v['tarif_fak']."', '', '', '".$v['vid']."', '', ''
                            )";
                $list_reinsurance = $this->db->execute($sql_reinsurance);
               
                               $qs = $this->db->Select("
                select                    
                  d.*,r.*
                from 
                    dobr_dogovors d,         
                    reinsurance r                
                where
                    r.id_dobr = d.id_num
                    AND R.id_dobr = ".$v['cnct_id']
                ); 
                 
            
              $sql_list = "insert into BORDERO_DOBR_DOGOVORS_LIST(ID, ID_CONTRACTS, CNCT_ID, PAY_SUM, PAY_SUM_OPL, sum_s_strah) 
                values(
                seq_bordero_contract_list.nextval, 
                $id_contracts, 
                ".$v['cnct_id'].", 
                ".$v['prs_prem_summa'].", 
               ".$v['prs_prem_summa'].",
                ".$v['reins_summa'].")"; 
                
             $this->db->execute($sql_list); 
             
             
                                           
            }
          /*  $DDS = $this->db->Select("select sum(pay_sum) pay_sum, sum(pay_sum_opl) pay_sum_opl, SUM(sum_s_strah) sum_s_strah 
            from bordero_contracts_list where id_contracts = $id_contracts"); */
            
             $DDS = $this->db->Select("select sum(pay_sum) pay_sum, sum(pay_sum_opl) pay_sum_opl, SUM(sum_s_strah) sum_s_strah 
            from BORDERO_DOBR_DOGOVORS_LIST where id_contracts = $id_contracts");
            
            $pay_sum = $DDS[0]['PAY_SUM'];
            $pay_sum_OPL = $DDS[0]['PAY_SUM_OPL'];
            $SUM_S_STRAH = $DDS[0]['SUM_S_STRAH'];
            
            $sql_bordero = "insert into BORDERO_DOBR_DOGOVORS
            (ID, CONTRACT_NUM, CONTRACT_DATE, EMP_ID, DATE_CREATE, PAY_SUM, PAY_SUM_OPL, STATE, ID_REINS, OTPR, TYP, SUM_S_STRAH, ID_UV) values
            ($id_contracts, 
            '".$dsp['contract_num']."', 
            sysdate, 
            '".$active_user_dan['emp']."', 
            sysdate,             
            '$pay_sum',
            '$pay_sum_OPL',             
            0, 
            '".$dsp['reins_id']."', 0, ".$v['type_dog'].", '$SUM_S_STRAH', '0')"; 
            
                                                        
            $this->db->Execute($sql_bordero); 
            
            if(trim($this->message) == ''){
                
                echo "<script>alert('Данные сохранены успешно!');</script>";
            }
            
           //  header('location: reins_dobr');                                                   
          /*  echo '<pre>';
            echo $sql_reinsurance;
            echo '</pre>'; */
            exit;
           
        }
        
        
        private function set_state($id)
        {
            //$mail = new MAIL();            
            //sendmail('a.saleev@gak.kz', 'test', '<b>HELLO</b>');
            
            $type = $this->array['type']; //Кнопка нажатия 0 - утвердить 1 - отклонить
            $note = $this->array['note']; //Примечание
            $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz"; //Эмаил текущего пользователя
             $email = 'e.zhanaberdinova@gak.kz';
            //Узнаем статус договора бордеро
            $q = $this->db->Select("select state from BORDERO_DOBR_DOGOVORS where id = $id");
            $state = $q[0]['STATE'];
            
            //Данный блог при переходе на другую базу переделать
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";  
                                             
            $db = new DB();                        
            $dsp = $db->Select($sql);
                        
            
            $dep = $dsp[0]['JOB_SP']; //Департамент
            $dolzh = $dsp[0]['JOB_POSITION']; //Должность                        
            
            //$sql = "select * from BORDERO_STATE_PROC_OTHER_OTHER where state_begin = $state and DEPARTMENT_BEGIN = $dep and type_btn = $type";
            $sql = "select * from BORDERO_DOBR_STATE_PROC_OTHER where state_begin = $state and DEPARTMENT_BEGIN = $dep and type_btn = $type";            
            // echo $sql;         
            $q = $this->db->Select($sql);
            
                                    
            if(count($q) == 0){
                echo 'Вы не можете Утверждать или Отклонять данный договор<br />';
                exit;
            }
            
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
            
            //$dan = $q[0];
            $new_state = $dan['STATE_END'];     
            
            if($new_state !== "8"){
                if(trim($dan['DOLZH_BEGIN']) !== ''){
                    if(trim($dan['DOLZH_BEGIN']) !== $dolzh){
                        echo 'Ошибка! Вы не можете Утверждать или Отклонять данный договор';
                        exit;
                    }
                }
            }
            //Если поле процедура не пустая тогда выполняем ее 
            //Во все процедуры необходиом завязать только ID контракта и все
            
         /*  
         // Интеграция с 1С
          if(trim($dan['FUNCT_PROV']) !== ''){                
                $proc = $dan['FUNCT_PROV'];
                if(!$this->db->Execute("begin $proc($id); end;")){
                    echo $this->db->message;
                    exit;   
                }
            }    */                     
            
            $this->db->Execute("
                insert into BORDERO_DOBR_DOGOVORS_ARC 
                select * from BORDERO_DOBR_DOGOVORS where id = $id
            ");
            
            //$this->db->Execute("INSERT INTO SIAP_ACT_PRT (ACTP_ID, SICID, RFBN_ID, EMP_ID, ACT_ID, CNCT_ID, DATE_OP, NOTES, DATE_CALC, IP_PC) 
            //VALUES ( /* ACTP_ID */, /* SICID */, /* RFBN_ID */, /* EMP_ID */, /* ACT_ID */, /* CNCT_ID */, /* DATE_OP */, /* NOTES */, /* DATE_CALC */, /* IP_PC */ )");
                        
                   
            $sql = "update BORDERO_DOBR_DOGOVORS set state = $new_state, note = '$note' where id = $id";
            $b = $this->db->Execute($sql);
            if($b !== true){
                echo $b;
            }     
            
            //Узнаем текст статуса
            $st = $this->db->Select("select name from bordero_state where id = $new_state");
            $state_text = $st[0]['NAME'];
            
            $message_send = "Для согласования договора по перестрахованию бордеро. Статус $state_text; http://192.168.5.244/reins_dobr?form_setstate=$id";
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
                $message_send = $state_text." - http://192.168.5.244/reins_dobr?form_setstate=$id";
                $next_depart = '13';
                $next_dolzh = '50';
            }
            
            //Находим пользователей в департаменте по должности
            if(trim($next_dolzh) !== ''){
                $ss = "and JOB_POSITION in($next_dolzh)";
            }
            
            $q = $db->Select("select EMAIL from SUP_PERSON where id not in(418, 698) and JOB_SP = $next_depart $ss");
                        
            //Отправляем сообщение по пандиону
            require_once 'methods/xmpp.php';
            $j = new JABBER();
            
            foreach($q as $k=>$v){
                $j->send_message($v['EMAIL'], $message_send);
            }
                      
            echo '';
            exit;
        }
                
                private function form_setstate($id)
        {            
            if($id == ''){exit;}            
            
            $qs = $this->db->Select("select typ from BORDERO_DOBR_DOGOVORS where id = $id");            
            $typ = $qs[0]['TYP'];
            
            $this->html = '';
            
            $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz";            
            $email = 'e.zhanaberdinova@gak.kz';
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";
            //echo $sql;
            $db = new DB();                        
            $dsp = $db->Select($sql);            
                                                
            $dep = $dsp[0]['JOB_SP']; //Департамент
            $dolzh = $dsp[0]['JOB_POSITION']; //Должность                                    
            
            $s = $this->db->Select("select b.*, emp_name(b.emp_id) empname, state_name_bordero(b.state) state_name, reins_name(b.id_reins) reinsname, 
            (select count(*) from BORDERO_DOBR_DOGOVORS_LIST where id_contracts = b.id) cn_count from BORDERO_DOBR_DOGOVORS b where b.id = $id");
            //echo $this->db->sql;
                        
            $v = $s[0];
            $state = $v['STATE'];
            
            $btn_set_state = 'set_note';
                        
            if($state == 2){$btn_set_state = 'set_note_rasp';}            
            if($state == 14){$btn_set_state = 'set_note_rasp';}
            
            $this->html .= '<div class="col-lg-6 well">';
            $this->html .= '<p><b>№ договора: </b>'.$v['CONTRACT_NUM'].'</p>';
            $this->html .= '<p><b>Дата договора: </b>'.$v['CONTRACT_DATE'].'</p>';
            $this->html .= '<p><b>Перестраховщик: </b>'.$v['REINSNAME'].'</p>';
            $this->html .= '<p><b>№ распоряжения: </b>'.$v['NUM_RASP'].'</p>';
            $this->html .= '<p><b>Дата распоряжения: </b>'.$v['DATE_RASP'].'</p>';
            $this->html .= '</div>';
            $this->html .= '<div class="col-lg-6 well">';
            $this->html .= '<p><b>Количество договоров: </b>'.$v['CN_COUNT'].'</p>';
            $this->html .= '<p><b>Страховая сумма: </b>'.$v['PAY_SUM'].'</p>';            
            $this->html .= '<p><b>Статус: </b>'.$v['STATE_NAME'].'</p>';
            $this->html .= '<p><b>№ счета: </b><a href="ftp://upload:Astana2014@192.168.5.2/'.$v['FILE_SCHET'].'" target="_blank" download>'.$v['NUM_SCHET'].'</a></p>';
            $this->html .= '<p><b>Дата счета: </b>'.$v['DATE_SCHET'].'</p>';
            $this->html .= '</div>';
            
            $this->html .= '<div class="col-lg-12">';
            $q = $this->db->Select("select * from BORDERO_DOBR_STATE_PROC_OTHER where DEPARTMENT_BEGIN = $dep and DOLZH_BEGIN = $dolzh and state_begin = $state order by TYPE_BTN");
       
                        
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
                        BORDERO_DOBR_STATE_PROC_OTHER 
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
                foreach($q as $k=>$t){   
                    $btn = 'btn-info';
                    $text = 'Утвердить';                
                    if($t['TYPE_BTN'] == 1){
                        $btn = 'btn-danger';
                        $text = 'Отклонить';                    
                    }                                
                    
                    $this->html .= '<button class="btn '.$btn.' btn-sm hts set_note pull-left" data-toggle="modal" data-target="#'.$btn_set_state.'" id="'.$id.'" data="'.$t['TYPE_BTN'].'">'.$text.'</button> ';
                }    
            }
            
            
            $this->html .= '<div class="pull-right">
                                <a href="reins_export?dobr_formstate='.$id.'&&export=html" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-html5"></i></a>                                
                                <a href="reins_export?dobr_formstate='.$id.'&&export=pdf" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                <a href="reins_export?dobr_formstate='.$id.'&&export=xls" target="_blank" class="btn btn-default"><i class="fa fa-2x fa-file-excel-o"></i></a>
                            </div>';
                            
            $this->html .= '</div>';   
            
            $this->html .= '<div style="height: 600px;overflow: auto;float: left;width: 100%;">';
                        
            if($typ == '3'){
                $this->html .= $this->contract_num_transh($id);                
            }else{
                $this->sql_text = "select  
                        rownum, 
                        d.NUM_DOG,    
                          case
                            when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then client_name(D.ID_STRAHOVATEL)
                            else fond_name(D.ID_STRAHOVATEL)
                          end strahovatel,                                               
                        nvl((select cn.bin from CONTR_AGENTS cn where cn.id = d.id_strahovatel), (select cs.iin  from CLIENTS cs where cs.SICID = d.id_strahovatel)) iin,  
                        d.date_dog, 
                        R.DATE_BEGIN, 
                        R.DATE_END,
                        nvl(R.DATE_BEGIN, d.VIPLAT_BEGIN) reins_DATE_BEGIN,
                        nvl(R.DATE_end, d.VIPLAT_END) reins_DATE_end,
                         case
                         when D.TYPE_STRAHOVATEL = 0 or D.TYPE_STRAHOVATEL is null then '1'
                         else '(select count(*) as cnct from list_dobr_dogovors_clients where cnct_id = d.id_num)'
                        end cnct,
                        D.INS_SUMMA, 
                        R.PERC_S_GAK,
                        R.SUM_S_GAK,
                        R.PERC_S_STRAH,
                        R.SUM_S_STRAH,
                        D.INS_PREMIYA,
                        R.PERC_P_STRAH,
                        R.SUM_P_STRAH,
                        R.SUM_P_STRAH SUM_P_STRAHs,
                        trim(substr(dc.PERIODICH, 1)) PERIODICH
                        from dobr_dogovors d , DOBR_DOGOVORS_CLIENTS dc,reinsurance R, BORDERO_DOBR_DOGOVORS bd, BORDERO_DOBR_DOGOVORS_LIST bdl
                        where bd.id = $id and BDL.ID_CONTRACTS = bd.id and BDL.CNCT_ID = d.id_num and  D.ID_NUM  = R.ID_DOBR and D.ID_NUM = dc.cnct_id";
             /*  echo '<pre>';
               echo $this->sql_text;
               echo '</pre>'; */
               $q = $this->db->Select($this->sql_text);
               $this->q_dan1 = $q;
            
                $html = '';
                $html .= '<style type="text/css">        
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
                    background-color: #F5F5F6;
                }            
                </style>';
                            
                $html .= '<div style="float: left; width: 100%;"><table border="1"><thead>
                            <tr>
                                <th rowspan="2">№</th>
                                <th rowspan="2">№ договора страхования</th>                                                            
                                <th rowspan="2">Страхователь</th>
                                <th rowspan="2">БИН/ИИН</th>                                
                                <th rowspan="2">Дата заключения основного договора</th>                                
                                <th rowspan="2">Начало действия договора страхования</th>
                                <th rowspan="2">Окончание действия договора страхования</th>
                                <th rowspan="2">Начало действия периода перестрахования</th>
                                <th rowspan="2">Окончание действия перестрахования</th>
                                <th rowspan="2">Кол-во застрахованных</th>                            
                                <th rowspan="2">Страховая сумма</th>                                                           
                                <th colspan="2">Собственное удержание </th>
                                <th colspan="2">Ответственность перестраховщика</th>
                                <th rowspan="2">Страховая премия по договору</th>
                                <th colspan="2">Перестраховочная премия</th>
                                <th rowspan="2">Перестраховочная премия к оплате</th>
                                <th rowspan="2">Условия оплаты страховой премии</th>                                
                            </tr>
                            <tr>                                                        
                                <th>%</th>
                                <th>Сумма</th>
                                <th>%</th>
                                <th>Сумма</th>                            
                                <th>%</th>
                                <th>Сумма</th>                                                                                    
                            </tr>
                        </thead>
                        <tbody>';
                foreach($q as $k=>$v)
                {
                    $html .= '<tr>';
                    foreach($v as $i=>$d)
                    {                     
                        if(substr($d, 0, 1) == ','){
                            $html .= '<td><center>0'.$d.'</center></td>';
                        }elseif(substr($d, 0, 1) == '.'){
                            $html .= '<td><center>0'.$d.'</center></td>';
                        }else{
                            $html .= '<td><center>'.$d.'</center></td>';    
                        }
                    }
                    $html .= '</tr>';
                }
                
                $ds = $this->db->Select("select sum(d.INS_SUMMA) strah_sum,
                null per, 
                sum(r.sum_s_gak) sum_s_gak, 
                null per_s_gak,
                sum(r.SUM_S_STRAH) sum_s_strah, 
                sum(r.OSNS_SUMP) strah_pay,
                null st,
                sum(bdl.PAY_SUM) pay_sum,
                sum(bdl.PAY_SUM_OPL) pay_sum_opl,
                null periodich
                from dobr_dogovors d, reinsurance r, bordero_dobr_dogovors_list bdl, bordero_dobr_dogovors bd
                where D.ID_NUM = R.ID_DOBR and d.id_num = BDL.CNCT_ID and BDL.ID_CONTRACTS = bd.id and bd.id = $id");
                
                $this->q_dan2 = $ds;                
                foreach($ds as $k=>$v){
                    $html .= '<tr>
                        <td colspan="1"></td>
                        <td><center>Итого:</center></td>
                        <td colspan="8"></td>
                        ';                                                
                    foreach($v as $i=>$d){
                        $html .= '<td><center>'.$d.'</center></td>';                                              
                    }
                    
                    $html .= '</tr>';
                }
                $html .= '</tbody></table>';
               
           
                $this->html .= $html; //$this->contract_num($v['CONTRACT_NUM']);    
            }                        
            $this->html .= '</div>';                                
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
                        if(!$ftp->uploadfile("reinsurance/shet_opl_for_dobr/", $files, $handle))
                        {                        
                            echo "Ошибка создания файла!";
                        }
                        $fst = 'reinsurance/shet_opl_for_dobr/'.$files;
                    }
                }                                
                
                $sql = "update BORDERO_DOBR_DOGOVORS set num_rasp = '$inum_rasp', date_rasp = to_date('$idate_rasp', 'dd.mm.yyyy'), 
                num_schet = '$inum_shet', date_schet = to_date('$idate_schet', 'dd.mm.yyyy'), file_schet = '$fst' where id = $id";
                
                if(!$this->db->Execute($sql)){
                    print_r($this->db->message);
                    exit;   
                }               
                
                $this->array['type'] = 0;
                $this->array['note'] = $note;
                 
                $this->set_state($id);                   
                header("Location: reins_dobr?form_setstate=$id");
                exit;
            }                            
        }   
        
                private function send_replace($id)
        {
            $q = $this->db->Select("select * from BORDERO_DOBR_STATE_PROC_OTHER where state_end = (select state from BORDERO_DOBR_DOGOVORS where id = $id)");            
            $id_pers = $q[0]['DOLZH_END'];
                        
            $sql = "select s.lastname||' '||s.firstname||' '||s.middlename fio, S.ID, S.JOB_SP, S.JOB_POSITION, S.EMAIL from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and s.date_layoff is null and S.JOB_POSITION = $id_pers";  
                                             
            $db = new DB();                        
            $dsp = $db->Select($sql);            
            
            require_once 'methods/xmpp.php';
            $j = new JABBER();
            $message_send = "Повторное уведомление для утверждения договора по добровольному перестрахованию - http://192.168.5.244/reins_dobr?form_setstate=$id";
            
            $users = '';
             
            foreach($dsp as $k=>$v){                
                $j->send_message($v['EMAIL'], $message_send);
                $users .= $v['FIO']." ";    
            }
            echo 'Повторное уведомление отправлено '.$users; 
            exit;
        }   
        
                private function delete_contracts($id)
        {
            $q = $this->db->Select("select * from BORDERO_DOBR_DOGOVORS where id = $id");            
            $this->dan['ps'] = $q[0];
          /*  $sql = "select
              d.contract_num,
              D.CONTRACT_DATE,
              fond_name(d.id_insur) strahovatel,
              bl.*   
            from 
              BORDERO_DOBR_DOGOVORS bc, 
              BORDERO_DOBR_DOGOVORS_LIST bl,
              contracts d
            where 
              bl.id_contracts = bc.id
              and bl.cnct_id = d.cnct_id
              and bc.id = $id"; */
              
              $sql = "select
              d.num_dog,
              d.date_dog,              
              bl.*   
            from 
              BORDERO_DOBR_DOGOVORS bc, 
              BORDERO_DOBR_DOGOVORS_LIST bl,
              dobr_dogovors d
            where 
              bl.id_contracts = bc.id
              and bl.cnct_id = d.id_num
              and bc.id = $id";
            
            $this->dan['list'] = $this->db->Select($sql);            
        }    
        
        
                /**
         * Удаление договора страхования из договора перестрахования
        */        
        public function delcnct($d)
        {           
            global $msg;            
            $sql = 'begin';
            foreach($d as $dan){
                $ds = explode('|', $dan);
                $cnct = $ds[0];
                $id = $ds[1];
                $tr = $ds[2];
                if($ds[2] == ''){
                    $tr = 'null';
                }
                $sql .= "
                BORDERO_DOBR_DOGOVORS_PACK.DeleteCnctFromContract($id, $cnct); 
                ";                                
            }
            $sql .= " 
            end;";
            if(!$this->db->Execute($sql)){              
                $msg .= ALERTS::ErrorMin($this->db->message);
            }else{
                header("Refresh:0");
            }
        }  
        
                public function dic_files()
        {
            $q = $this->db->Select("select * from BORDERO_TYPE_FILES where id_type = 0");
            return $q;
        }
        
        
        //Файлы
               public function contract_files($id)
        {
            $q = $this->dic_files();
            foreach($q as $k=>$v){
                $q[$k]['list_files'] = $this->db->Select("select * from bordero_dobr_files where id_type = ".$v['ID']." and id_contracts = $id");                
            }
            $this->dan_array = $q;
            return $q;
        }    
        
        //Распечатка распоряжения
              public function print_rasp($id)
        {
            $q = $this->db->Select("
           select 
                b.*, 
                B.PAY_SUM_OPL pay_sum_opl1, 
                tlsc.money_word(b.pay_sum_opl) pay_sum_opl_text,
                nvl(D.R_NAME_KRAT, D.R_NAME) name_reins 
            from 
                bordero_dobr_dogovors b, dic_reinsurance d 
            where 
               d.id = B.ID_REINS
                and b.id = $id");            
            $dan = $q[0];
            require_once 'application/views/reins_dobr_forms/form_rasporyazh.php';
            exit;
        }  
        
          public function set_new_contract_file($id)
        {
            error_reporting(E_ALL);
            $this->set_file($_POST['contract_file_id'], $id);            
            header("Location: ".$_SERVER['REQUEST_URI']);
        }  
        
            private function set_file($id_contract, $id_type)
        {            
            if(!isset($_FILES['upload'])){
                return false;
            }
                        
            $files = $_FILES['upload'];
            $path = 'reinsurance_dobr/reins_'.$id_contract;
            
            $uploaddir = 'upload/';
            $uploadfile = $uploaddir . basename($files['name']);
            
            if (move_uploaded_file($files['tmp_name'], $uploadfile)) {
                $localfile = $uploadfile;                                                
            } else {
                $msg = ALERTS::ErrorMin('Ошибка загрузки файла');
                return false;
            }
            
            $ftp = new FTP();
            $filename =$files['name'];
            
            if(!$ftp->check_path($path)){
                $ftp->create_path($path);
            }
            $fs = $ftp->uploadfile2($path.'/', $filename, $localfile);
            unlink($localfile);
            
            $sql = "INSERT INTO bordero_dobr_files (ID_CONTRACTS, FILENAME, DATE_SET, ID_TYPE) 
            VALUES ($id_contract, '$fs', sysdate, $id_type)";
            $this->db->Execute($sql);
        } 
        
              /**
         * Удаление файла из договора перестрахования
        */
        public function delete_file($id)
        {
            $q = $this->db->Select("select * from bordero_dobr_files where id = $id");
            $filename = $q[0]['FILENAME'];
            $ftp = new FTP();
            $b = $ftp->deleteFile($filename);
            if($b){
                $this->db->Execute("delete from bordero_dobr_files where id = $id");
            }
            $this->contract_files($q[0]['ID_CONTRACTS']);
        }
        
              private function downloadfile($id)
        {
            $q = $this->db->Select("select * from bordero_dobr_files where id = $id");
            $link_filename = $q[0]['FILENAME'];
            $f = downloadftp(FTP_SERVER, FTP_USER, FTP_PASS, $link_filename);
            if($f == false){
                global $msg;
                $msg = $this->alert->ErrorMin('Файл не найден<br />'.$link_filename);              
            }            
        }  
        
            public function pereraschet($id)
        {                     
            $sql = "begin BORDERO_DOBR_DOGOVORS_PACK.PereraschetContract($id); end;";            
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
            }else{
                echo '';
            }
            exit;
        }
        
               private function move_contract($id)
        {
            $sql = "  select 
              b.contract_num contract_num_reins,
              d.num_dog,
            --  fond_name(d.id_insur) strah,
              reins_name(b.id_reins) reinsname,
              d.VIPLAT_BEGIN,
              d.VIPLAT_END,
              bl.*
            from 
              bordero_dobr_dogovors b,
              bordero_dobr_dogovors_list bl,
              dobr_dogovors d,
              reinsurance r
            where 
              bl.id_contracts = b.id
              and d.id_num = bl.cnct_id
              and r.id_dobr = d.cnct_id
              and b.id = $id";
            
            $q = $this->db->Select($sql);
            $this->dan_array['list'] = $q;
            $this->dan_array['num'] = $q[0]['CONTRACT_NUM_REINS'];
            $this->dan_array['id'] = $id;          
        }
        
        
               private function search_move_contracts($text)
        {
            $id = $_GET['move_contract'];
            $sql = "select id, contract_num, contract_date, reins_name(id_reins) reinsname from bordero_dobr_dogovors where upper(contract_num) like upper('%$text%') and id <> $id";
//            $sql = "select id, contract_num, contract_date, reins_name(id_reins) reinsname from bordero_contracts where upper(contract_num) like upper('%$text%') and id <> $id";
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
          
            $qst = $this->db->Select("select * from bordero_dobr_dogovors where id = $old_id");
            $type_dog = $qst[0]['TYP'];          
            
            $lists = $this->array['move_cnct'];
            $new_id = $this->array['new_id_move'];
            
            $sql = "begin ";
            foreach($lists as $l){ 
              
                $sql .= " 
                  BORDERO_DOBR_DOGOVORS_PACK.BorderoCnctMove($old_id, $new_id, $l); 
                ";
            }
            $sql .= " end;";
            global $msg;
            if(!$this->db->Execute($sql)){
                $msg = 'Ошибка перемещения!';
                return false;
            }
            if($type_dog == '1'){
                header("Location: reins_dobr?list_contracts");
            }else{
                header("Location: reins_dobr?list_contracts");
            }
        } 
        
        
                /**
         * Создание возврата на 1 договор страхования
         * Входящие параметры
         * @vozvrat - ID договора перестрахования
         * @vozvrat_cnct - ID договора страхования
         * @vozvrat_contract_num - № договора перестрахования
         * @vozvrat_date_contract - Дата возврата 
         * @vozvrat_pay_sum_opl - Сумма к оплате
         * @vozvrat_sum_s_strah - Обязательства перестраховщика
        */
        public function vozvrat($id)
        {
            if($id == ''){
                return false;
            }
            $q = $this->db->Select("select * from bordero_dobr_dogovors where id = $id");
            
            $cnct = $this->array['vozvrat_cnct'];
            $contract_num = $this->array['vozvrat_contract_num'];
            $date_contract = $this->array['vozvrat_date_contract'];
            $pay_sum_opl = $this->array['vozvrat_pay_sum_opl'];
            $sum_s_strah = $this->array['vozvrat_sum_s_strah'];            
            $id_reins = $q[0]['ID_REINS'];
            
            $qs = $this->db->Select("select seq_bordero_contracts.nextval ids from dual");
            $id_contract = $qs[0]['IDS'];
            
            $sql_all = '';
            
            $sql = "INSERT INTO bordero_dobr_dogovors(
              id, 
              contract_num, 
              contract_date, 
              emp_id, 
              date_create,
              pay_sum, 
              state, 
              id_reins, 
              otpr, 
              typ, 
              id_head, 
              pay_sum_opl, 
              sum_s_strah
            ) VALUES(
              '$id_contract', 
              '$contract_num', 
              '$date_contract', 
              '".$q[0]['EMP_ID']."', 
              sysdate,
              '$pay_sum_opl', 
              0,                
              '$id_reins',
              0, 
              1, 
              '$id', 
              '$pay_sum_opl', 
              '$sum_s_strah'
            )";
            $sql_all .= $sql."\r\t\n";
                             
            if(!$this->db->Execute($sql)){
                echo $this->db->message;   
                echo $sql_all;             
                exit;
            }
            
            
            $sql1 = "INSERT INTO bordero_dobr_dogovors_list (ID, ID_CONTRACTS, CNCT_ID, PAY_SUM, PAY_SUM_OPL, SUM_S_STRAH) 
            VALUES (seq_BORDERO_CONTRACT_LIST.nextval, '$id_contract', '$cnct', '$pay_sum_opl', '$pay_sum_opl', '$sum_s_strah')";            
            
            $sql_all .= $sql1."\r\t\n";
            
            if(!$this->db->Execute($sql1)){
                $sql_all .= "delete from bordero_dobr_dogovors where id = $id_contract"."\r\t\n";
                
                $this->db->Execute("delete from bordero_dobr_dogovors where id = $id_contract");
                echo $this->db->message;   
                echo $sql_all;             
                exit;
            }
                        
            //echo $sql_all;
            echo 'Операция прошла успешно! Обновите страницу!';            
            exit;
        }
}