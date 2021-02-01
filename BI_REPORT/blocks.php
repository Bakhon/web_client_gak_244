<?php
    require_once __DIR__.'/tablesSQL.php';
	class BI_BLOCKS
    {
        public $db;
        public $sql;
        public $params;
        private $tablesql;
        
        public function __construct()
        {            
            $this->db = new DB3();
            $this->tablesql = new table_sql();            
        }
        
        public function report($id)
        {            
            $q = $this->db->Select("select * from bi_report_page where id_report = $id order by num_pp");                        
            
            $ds = array();                                    
            foreach($q as $k=>$v){
                $ks = array();
                $ks['title'] = $v['TITLE'];     
                $this->sql = $v['SQL_TEXT'];
                                
                foreach($this->params as $kk=>$vv){
                    $this->sql = str_replace(':'.$vv['name'], $vv['result'], $this->sql);
                }
                
                $ks['block'] = $this->block($v['ID']);
                $ks['all_dan'] = $this->getSQlTable($v['ID'], $this->sql);                
                array_push($ds, $ks);
            }
            return $ds; 
        }
        
        public function block($id_page)
        {
            $result = array();
            $q = $this->db->Select("select * from BI_REPORT_BLOCKS where id_page = $id_page and view_block = 1 order by num_pp");
            
            foreach($q as $k=>$v){
                $q[$k]['chart'] = $this->dic_chart($v['ID_CHART'], $v);//$v['FN'], $v['COL_NAME']);
            }
            return $q;
        }
        
        private function dic_chart($id_chart, $dan) //$fn, $colname)
        {
            $q = $this->db->Select("select * from BI_DIC_CHART where id = $id_chart");
                        
            $chart = new BI_CHART($this->sql, $q[0], $dan);
            $tst = $chart->init(trim($q[0]['NAME']));
                                    
            return $tst;
        }
        
        private function getSQlTable($id_page, $sql)
        {
            $cn = $this->db->Select("select * from BI_REPORT_PAGE_COLNAMES where id_page = $id_page");
            $colnames_rus = array();
            foreach($cn as $k=>$v){            
                $colnames_rus[$v['COLNAME']] = $v['COLNAME_RUS'];
            }
            
            
            $html = '<table class="table table-bordered">';            
            $q = $this->db->Select($sql);
            $columns = $this->db->list_columns;
            $qs = $this->db->Select("select COLNAME from BI_REPORT_NOTCOL where ID_PAGE = $id_page");
            foreach($qs as $k=>$v){
                $col = $v['COLNAME'];
                foreach($columns as $t=>$d){
                    if($d == $col){
                        unset($columns[$t]);
                    }
                }
            }
            
            $html .= '<thead><tr>';
            foreach($columns as $t=>$c){
                $cname = $c;
                if(isset($colnames_rus[$c])){
                    $cname = $colnames_rus[$c];
                }                
                $html .= '<th>'.$cname.'</th>';                                    
            }
            $html .= '</tr><thead><tbody>';
            
            foreach($q as $k=>$v){
                $html .= '<tr>';
                foreach($columns as $t=>$c){
                    $html .= '<td>'.$v[$c].'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';
            //consolExit($columns);
            
            return $html;
        }
                
    }