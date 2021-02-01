<?php
	class PRINTING
    {
        private $db;
        public $export = '';
        public $result;
        public $id_reins = 0;
        
        public function __construct()
        {
            $this->db = new DB3();
        }
        
        public function init($id)
        {
            $b1 = $this->db->Select("select b.*, b.contract_date+15 opl_do from bordero_contracts b where b.id = $id");
            $this->id_reins = $b1[0]['ID_REINS'];
            $q = $this->db->Select("select * from dic_reinsurance where id = $this->id_reins");
            $this->result['reins'] = $q[0];
            
            $cn = $this->db->Select("
            select 
                d.cnct_id,
                C.NAME, 
                C.ADDRESS,
                oked_name2(C.OKED_ID) okedname,
                O.RISK_ID,
                C.BIN,
                (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) cnt_people,
                D.DATE_BEGIN,
                D.DATE_END,
                D.CONTRACT_NUM,
                D.CONTRACT_DATE,
                D.PAY_SUM_V||' '||TLSC.MONEY_WORD(D.PAY_SUM_V) pay_sum_v_text,
                D.PAY_SUM_V,
                D.PAY_SUM_P||' '||TLSC.MONEY_WORD(D.PAY_SUM_P) pay_sum_P_text,
                D.PAY_SUM_P,
                R.PERC_S_GAK,
                R.SUM_S_GAK||' '||TLSC.MONEY_WORD(R.SUM_S_GAK) SUM_S_GAK,
                R.PERC_S_STRAH,
                R.SUM_S_STRAH||' '||TLSC.MONEY_WORD(R.SUM_S_STRAH) SUM_S_STRAH,
                R.SUM_P_STRAH_ALL||' '||TLSC.MONEY_WORD(R.SUM_P_STRAH_ALL) SUM_P_STRAH,                
                (select max(tarif) from osns_calc_new where cnct_id = d.cnct_id) tarif,
                bank_name(d.bank_id) bankname, 
                d.p_account
            from 
                contracts d, 
                contr_agents c,
                osns_calc o,
                reinsurance r
            where 
                C.ID = D.ID_INSUR
                and r.cnct_id = d.cnct_id
                and o.cnct_id = d.cnct_id 
                and d.cnct_id in(select cnct_id from bordero_contracts_list where id_contracts = $id)  
            ");
            //echo $this->db->sql;
            $this->result['contracts'] = $cn[0];
            
            $sql = "select    
              case 
                when t.nom = 1 then (select contract_date +15 from bordero_contracts where id = $id)
                else date_pl+15 
              end opl_do,
              round(T.PAY_SUM * (R.PERC_S_STRAH / 100), 2) PAY_SUM   
            from 
                bordero_contracts b, 
                bordero_contracts_list bl,
                reinsurance r,
                transh t
            where
                t.cnct_id = bl.cnct_id
                and r.cnct_id = t.cnct_id
                and b.id = bl.id_contracts
                and b.id = $id        
                and t.id <> (select max(id) from transh where cnct_id = t.cnct_id)
            union all
            select  
              case 
                when t.nom = 1 then (select contract_date +15 from bordero_contracts where id = $id)
                else date_pl+15 
              end opl_do,
              B.PAY_SUM - (
                select 
                  sum(round(Tr.PAY_SUM * (Rr.PERC_S_STRAH / 100), 2)) 
                from 
                  transh tr, 
                  reinsurance rr 
                where 
                  rr.cnct_id = tr.cnct_id 
                  and tr.cnct_id = t.cnct_id 
                  and tr.id <> (select max(id) from transh where cnct_id = t.cnct_id)
              ) PAY_SUM   
            from 
                bordero_contracts b, 
                bordero_contracts_list bl,
                reinsurance r,
                transh t
            where
                t.cnct_id = bl.cnct_id
                and r.cnct_id = t.cnct_id
                and b.id = bl.id_contracts
                and b.id = $id        
                and t.id = (select max(id) from transh where cnct_id = t.cnct_id)
            order by 1";
            
            $this->result['transh'] = $this->db->Select($sql);
            /*
            "
            select  
              case 
                when t.nom = 1 then (select contract_date +15 from bordero_contracts where id = $id)
                else date_pl+15 
              end opl_do,
              round(T.PAY_SUM * (R.PERC_S_STRAH / 100), 2) PAY_SUM   
            from 
                bordero_contracts b, 
                bordero_contracts_list bl,
                reinsurance r,
                transh t
            where
                t.cnct_id = bl.cnct_id
                and r.cnct_id = t.cnct_id
                and b.id = bl.id_contracts
                and b.id = $id
                and bl.id <> (select max(id) from bordero_contracts_list where id_contracts = $id)
            order by t.date_pl
            " 
            */
            $this->podpisant($b1[0]['CONTRACT_DATE'], 0);
            $this->podpisant($b1[0]['CONTRACT_DATE'], $this->id_reins);
            $this->result['B1'] = $b1[0];                        
        }
        
        private function podpisant($date, $id = 0)
        {
            $q = $this->db->Select("select * from BORDERO_PODPIS where date_begin <= '$date' 
            and (date_end > '$date' or date_end is null) and id_reins = $id");
            if(count($q) <= 0){
                $q = array();                
            }
            if($id == 0){
                $this->result['podpis']['gak'] = $q[0];
            }else{
                $this->result['podpis']['reins'] = $q[0];
            }
        }
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
                
        $print = new PRINTING();
        if(isset($_GET['export'])){
            $print->export = $_GET['export'];
        }
        
        $print->init($id);
        $dan = $print->result;
                        
        if(file_exists("methods/print/reins_$print->id_reins.php")){
            require_once "methods/print/reins_$print->id_reins.php";
        }else{
            header("Location: type_form?id=$id");
        }
    }
    exit;
?>