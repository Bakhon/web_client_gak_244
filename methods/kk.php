<?php
/*
kk?risk
*/
	class KK
    {
        private $db;   
        public $msg;     
        public $result;
        
        public function __construct()
        {
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();
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
            if(count($_POST) > 0){
                foreach($_POST as $k=>$v){                                
                    if(method_exists($this, $k)){                                        
                        $this->array = $_POST;
                        $this->$k($v); 
                    }
                }
            }
        }   
        
        public function risk_lists($ds)
        {
            $year = date("Y");
            if(isset($_GET['year'])){
                $year = $_GET['year'];
            }
            $d1 = date('d.m.Y', strtotime('31.12.'.$year));
            if(method_exists($this, $ds)){
                $dan = $this->$ds($d1, 1);                
            }
                                                      
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                require_once 'application/views/kk/risk_lists.php';
                exit;
            }
                       
            return $dan;
        }   
        
        public function countryes($d1)
        {
            $id_c = 0;            
            if(count($_POST) > 0){
                if(isset($_POST['lists'])){
                    $id_c = $_POST['lists'];
                }                
            }
            
            if($d1 == ''){
                $d1 = date("Y");
            }
            $year = $d1;
            $columns = "
            E.NAME, 
                count(*) cnt, 
                sum(
                case         
                    when (select count(*) from contracts where id_head = d.cnct_id and contract_date between '01.01.$year' and '31.12.$year') > 0 then
                    (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.cnct_id and contract_date between '01.01.$year' and '31.12.$year')) 
                    else D.PAY_SUM_V
                end    
                ) PAY_SUM_V,
                E.ID 
            ";
            $group = "group by E.NAME, E.ID";
            
            if($id_c > 0){
                $columns = "
                    d.contract_num,
                    d.contract_date,
                    c.name,    
                    d.pay_sum_p,
                    d.pay_sum_v,
                    d.date_begin,
                    d.date_end,
                    d.date_close,
                    E.NAME name_country,
                    d.cnct_id,
                    c.id
                ";
                $group = ' and E.ID = '.$id_c;
            }
            
            $sql = "select
                $columns
            from 
                contr_agents c, 
                contracts d,
                DIC_COUNTRIES_ESBD e      
            where 
                d.id_insur = c.id
                and d.paym_code like '07%'    
                and d.contract_date between '01.01.$year' and '31.12.$year'
                and d.vid = 1
                and E.ID = C.COUNTRY_ID
                and E.BLOCKED = 1
            $group";
            //echo $sql;
            
            $q = $this->db->Select($sql);
            $this->result = $q;
            
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                $dan = $this->result;
                require_once '/application/views/kk/countryes_lists.php';                
                exit;
            }
            return $q;            
        }
                
        public function allsql($d1, $params, $cols = 0)
        {
            $year = date("Y", strtotime($d1));
            
            $columns = "count(*) cnt, 
                nvl(sum(
                case         
                    when (select count(*) from contracts where id_head = d.cnct_id and contract_date between '01.01.$year' and '31.12.$year') > 0 then
                    (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.cnct_id and contract_date between '01.01.$year' and '31.12.$year')) 
                    else D.PAY_SUM_V
                end    
                ), 0) PAY_SUM_V";
            if($cols !== 0){
                $columns = "
                    d.contract_num,
                    d.contract_date,
                    c.name,    
                    d.pay_sum_p,
                    d.pay_sum_v,
                    d.date_begin,
                    d.date_end,
                    d.date_close,
                    d.cnct_id,
                    c.id
                ";
            }
            $sql = "select 
                 $columns
            from 
                contr_agents c, 
                contracts d  
            where 
                d.id_insur = c.id
                and d.paym_code like '07%'    
                and d.contract_date between to_date('01.01.$year', 'dd.mm.yyyy') and to_date('31.12.$year', 'dd.mm.yyyy')
                and d.vid = 1
                $params";
            
            $q = $this->db->Select($sql);
            if($this->db->message !== ''){
                $this->msg = ALERTS::ErrorMin($this->db->message);
                return array();
            } 
            return $q;
        }
        
        //иностранные публичные должностные лица (клиент сам в заявлении анкете будет отмечать подобную графу относится или нет)
        public function ipdl($d1, $cols = 0)
        {
            $params = " and C.FT_IPDL = 0 ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //микрофинансовые организации
        public function mo($d1, $cols = 0)
        {
            $params = " and upper(c.name) like '%МИКРОФИНАНС%' ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //юридические лица, зарегистрированные в качестве ломбардов
        public function lombard($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%ломбард%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //организаторы игорного бизнеса, а также лица, предоставляющие услуги либо получающие доходы от деятельности онлайн-казино за пределами Республики Казахстан
        public function kazino($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name) like upper('%азарт%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //лица, предоставляющие туристские услуги, а также иные услуги, связанные с интенсивным оборотом наличных денег
        public function turisty($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%турист%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //брокеры-дилеры, управляющие инвестиционным портфелем (за исключением дочерних организаций банков второго уровня, которые соблюдают требования по ПОД/ФТ, установленные банками второго уровня)
        public function brokers($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%брокер%') and upper(name) like upper('%финанс%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //лица, предоставляющие услуги по финансовому лизингу (за исключением дочерних организаций банков второго уровня, которые соблюдают требования по ПОД/ФТ, установленные банками второго уровня)
        public function lizing($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%лизинг%') and upper(name_oked) like upper('%финанс%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //кредитные товарищества
        public function kredit($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%кредит%') and upper(name) like upper('%финанс%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //лица, осуществляющие посредническую деятельность по купле-продаже недвижимости
        public function nedvigimost($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%недвижим%') and upper(name_oked) like upper('%продаж%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //лица, деятельность которых связана с производством и (или) торговлей оружием, взрывчатыми веществами
        public function orugie($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%взрывчат%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //лица, деятельность которых связана с добычей и (или) обработкой, а также куплей-продажей драгоценных металлов, драгоценных камней либо изделий из них
        public function metal($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%драгоц%')) ";
            $dan = $this->allsql($d1, $params, $cols);
            return $dan;
        }
        
        //некоммерческие организации, в организационно-правовой форме фондов, религиозных объединений
        public function relig($d1, $cols = 0)
        {
            $params = " and D.OKED_ID in(select id from dic_oked_afn where upper(name_oked) like upper('%религ%')) ";
            $dan = $this->allsql($d1, $params, $cols);          
            return $dan;
            
        }
        
        public function usa()
        {
            $q = $this->db->Select("select 
                d.contract_num, 
                d.contract_date,  
                c.lastname,
                c.firstname,
                c.middlename,
                d.pay_sum_p,
                d.pay_sum_v,
                d.state,
                d.date_begin,
                d.date_end,
                d.date_close,
                c.sicid,
                d.cnct_id       
            from 
                clients c, contracts d
            where 
                d.id_annuit = c.sicid
                and d.paym_code like '01%'
                and c.REG_ADDRESS_COUNTRY_ID = 6
                and d.state <> 13");            
            $this->result = $q;
        }
        
        public function high_risk()
        {
            $sql = "select 
                c.id,
                d.cnct_id,
                c.NAME,
                c.bin,
                d.contract_num,
                d.contract_date,
                d.date_begin,
                d.date_end,
                branch_name(d.branch_id) region,
                country_name(c.country_id) country
            from 
                contr_agents c, 
                contracts d
            where 
                upper(c.ft_risk) = 'ВЫСОКИЙ'
                and d.id_insur = c.id
                and d.state <> 13
                and d.date_close is null";
                
            $this->result = $this->db->Select($sql);
        }
    }
?>