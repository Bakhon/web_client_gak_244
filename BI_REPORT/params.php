<?php
	class PARAMS_BI
    {
        private $mnt = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        private $mnv = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        public $db;
                
        public function __construct()
        {
            $this->db = new DB3();
        }
        
        public function getParams($id_report)
        {
            $q = $this->db->Select("
            select 
                p.id, p.title, p.name, p.name_col, d.type, d.name name_param, d.sql_text 
            from 
                BI_REPORT_PARAMS p, BI_DIC_PARAMS d 
            where 
                P.ID_PARAMS = d.id     
                and p.id_page in(select id from bi_report_page where id_report = $id_report)
                order by id_type
            "); 
            
            foreach($q as $k=>$v){
                $p = array();
                $name = trim($v['NAME_PARAM']);
                if(method_exists($this, $name)){
                    $p = $this->$name($v['NAME'], $v['NAME_COL'], $v['SQL_TEXT']);
                    $title = $v['TITLE'];
                                        
                    $this->result['filter'][$name] = array(
                        "title"=>$title,
                        "dan"=>$p
                    );
                }
            }

            //$this->result['active_filter'] = $this->datenow();
        }
        
        public function DME($name, $name_col, $sql)
        {
            $res = array();
            $yend = date("Y");
            $ybegin = $yend - 5;
            $date_sel = date("t.m.Y");
            if(count($this->params) > 0){
                if(isset($this->params['DME'])){
                    $date_sel = $this->params['DME'];
                }
            }
            
            for($i=$ybegin;$i<=$yend;$i++){
                foreach($this->mnv as $k=>$v){
                    $dt = date("t", strtotime("$i/$v/01"));
                    $res[$i][] = array(
                        "month"=>$v,
                        "month_name"=>$this->mnt[$k],
                        "year"=>$i,
                        "date"=>"$dt.$v.$i"
                    );
                }
            };
            $this->params['DME'] = array(
                "name"=>$name,
                "name_col"=>$name_col,
                "result"=>"to_date('$date_sel', 'dd.mm.yyyy')"
            );
            
            //$qs = $this->db->Select("select to_date('$date_sel', 'dd.mm.yyyy') dd from dual");
            $this->result['active_filter'] = $date_sel;
            return $res;
        }
        
        public function DMBM($name, $name_col, $sql)
        {
            $res = array();
            $yend = date("Y");
            $ybegin = $yend - 5;
            $date_sel = '01.'.date("m.Y");
            if(count($this->params) > 0){
                if(isset($this->params['DMBM'])){
                    $date_sel = $this->params['DMBM'];
                }
            }
            
            for($i=$ybegin;$i<=$yend;$i++){
                foreach($this->mnv as $k=>$v){                    
                    $res[$i][] = array(
                        "month"=>$v,
                        "month_name"=>$this->mnt[$k],
                        "year"=>$i,
                        "date"=>"01.$v.$i"
                    );
                }
            };
            
            $this->params['DMBM'] = array(
                "name"=>$name,
                "name_col"=>$name_col,
                "result"=>"to_date('$date_sel', 'dd.mm.yyyy')-1"
            );
            //$qs = $this->db->Select("select to_date('$date_sel', 'dd.mm.yyyy')-1 dd from dual");
            $this->result['active_filter'] = $date_sel;
            return $res;
        }
        
        public function L_DIC_BRANCH_R($name, $name_col, $sql)
        {
            if($sql == ''){
                $sql = 'select substr(RFBN_ID, 1, 2) ID, MAIN_REG NAME from dic_branch where MAIN_REG is not null group by substr(RFBN_ID, 1, 2), MAIN_REG order by 1';
            }
            return $this->getsql($sql);
        }
        
        public function L_DIC_LEVEL($name, $name_col, $sql)
        {
            if($sql == ''){
                $sql = 'select id, name_other name from dic_level order by 1';
            }
            return $this->getsql($sql);
        }
        
        /*--------------------------------------------*/
        private function getsql($sql)
        {
            $q = $this->db->Select($sql);
            return $q;
        }
        
        private function datenow($dst = null)
        {
            $text = '';
            if($dst !== null){
                $m = date("m", strtotime($dst));
                $y = date("Y", strtotime($dst));
            }else{
                $m = date("m");
                $y = date("Y");
            }
            $key = 0;
            foreach($this->mnv as $k=>$v){
                if($v == $m){
                    $key = $k;
                }
            }
            return $this->mnt[$key].' '.$y;
        }                        
    }