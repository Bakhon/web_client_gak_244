<?php
    class DINAMIC
    {
        private $db;
        private $array;
        public $dan;
        
        public $d1;
        public $d2;
        public $region;
        public $asko;
                
        public function __construct()
        {
            $this->d1 = '01.01.'.date("Y");
            $this->d2 = date("d.m.Y");            
            $this->db = new DB3();
            $this->region = '';
            $this->asko = '';
            
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();
        }
        
        private function GET()
        {            
            if(count($_GET) > 0){                                         
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->array = $_GET;
                        $this->$k($v);
                    }
                }
            }            
            $this->index();
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
        
        private function index()
        {
            $this->dan['list_asko'] = $this->db->Select("select * from DIR_TYPE_PROC where id <> 1");
            $this->dan['list_regions'] = $this->db->Select("select rfrg_id id, name3 name from RFRG_REGION order by 1");
            
            $where_asko = '';
            if($this->asko !== ''){
                $col_asko = 'asko,';
                $where_asko = $this->asko;
            }
            
            $sql = "
            select  
              to_char(count(*), '999G999G999G999G999G999') cnt,  
              to_char(sum(pay_sum_p), '999G999G999G999G999G999') pay_sum_p,
              branch_id, 
              name,   
              to_char(sum(pay_sum_strah), '999G999G999G999G999G999') pay_sum_strah,
              $col_asko
              to_char((select sum(P.SUM_PLAN) sum_plan from PLAN_BRANCH_NEW p where  P.RFPM_ID = '07' and P.PERIOD between to_date('$this->d1', 'dd.mm.yyyy') and to_date('$this->d2', 'dd.mm.yyyy') and P.RFBN_ID = branch_id), '999G999G999G999G999G999') sum_plan,
              to_char(sum(case when asko > 0 then 0 else 1 end), '999G999G999G999G999G999') cnt_filials,
              to_char(sum(case when asko > 0 then 0 else pay_sum_p end), '999G999G999G999G999G999') pay_sum_filials,
              to_char(sum(case when asko > 0 then 0 else pay_sum_strah end), '999G999G999G999G999G999') pay_sum_strah_filials,
              to_char(sum(case when asko = 0 then 0 else 1 end), '999G999G999G999G999G999') cnt_kos,
              to_char(sum(case when asko = 0 then 0 else pay_sum_p end), '999G999G999G999G999G999') pay_sum_kos,
              to_char(sum(case when asko = 0 then 0 else pay_sum_strah end), '999G999G999G999G999G999') pay_sum_strah_kos     
            from(
            select 
                p.pay_sum_d pay_sum_p,                
                'Филиал по '||dr.name2 name,
                DR.RFRG_ID branch_id,
                nvl(b.asko, 0) asko,                
                (nvl((select R.PERC_P_STRAH from reinsurance r where r.cnct_id = d.cnct_id), 0) / 100) * p.pay_sum_d pay_sum_strah 
            from 
                contracts d,
                osns_calc o,
                dic_branch b,
                RFRG_REGION dr,
                plat_to_1c p
            where 
                d.state = 12
                and p.cnct_id = d.cnct_id
                and B.RFBN_ID = nvl(D.BRANCH2, d.branch_id)
                and o.cnct_id = d.cnct_id
                and DR.RFRG_ID = substr(nvl(D.BRANCH2, d.branch_id), 1, 2)
                and d.paym_code like '07%'
                and DR.RFRG_ID like '%$this->region%'
                and d.date_begin between to_date('$this->d1', 'dd.mm.yyyy') and to_date('$this->d2', 'dd.mm.yyyy')  
                and d.state = 12
            union all
            select 
                p.pay_sum_d pay_sum_p,                
                'Филиал по '||dr.name2 name,
                DR.RFRG_ID branch_id,
                nvl(b.asko, 0) asko,
                (nvl((select R.PERC_P_STRAH from reinsurance r where r.cnct_id = d.cnct_id), 0) / 100) * p.pay_sum_d pay_sum_strah
            from 
                contracts d,
                osns_calc o,
                dic_branch b,
                RFRG_REGION dr,
                plat_to_1c p
            where 
                d.state = 12
                and p.cnct_id = d.cnct_id
                and B.RFBN_ID = nvl(D.BRANCH2, d.branch_id)
                and o.cnct_id = d.cnct_id
                and DR.RFRG_ID = substr(nvl(D.BRANCH2, d.branch_id), 1, 2)
                and d.paym_code like '07%'
                and DR.RFRG_ID like '%$this->region%'
                and P.DATE_DOHOD between to_date('$this->d1', 'dd.mm.yyyy') and to_date('$this->d2', 'dd.mm.yyyy')  
                and d.state = 12
                and d.cnct_id in(select cnct_id from transh)
            )
            where asko like '%$where_asko%' 
            group by branch_id, $col_asko name            
            order by 3, 5
            ";
            //echo $sql;
            $q = $this->db->Select($sql);
            
            foreach($q as $k=>$v){                
                $a = floatval($v['SUM_PLAN']);
                $b = floatval($v['PAY_SUM_P']);
                                
                $proc = round(($b / $a) * 100);
                $q[$k]['PROC_PLAN'] = $proc;
            }
                        
            $this->dan['table'] = $q;
            return $q;
        }
        
        private function period_begin($d1)
        {
            $this->d1 = date("d.m.Y", strtotime($d1));
        }
        
        private function period_end($d2)
        {
            $this->d2 = date("d.m.Y", strtotime($d2));
        }
        
        private function asko($id)
        {
            $this->asko = $id;
        }
        
        private function region($id)
        {
            $this->region = $id;
        }

    }
        
	$page_title = 'Маркетинг';
    $panel_title = 'Динамика заключения договоров';
    
    $breadwin[] = 'Маркетинг';
    $breadwin[] = 'Динамика заключения договоров';
    $d = new DINAMIC();
    $dan = $d->dan;
?>