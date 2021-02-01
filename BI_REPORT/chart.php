<?php
	class BI_CHART
    {
        private $db;
        private $sql;
        private $dan;
        
        private $dan_chart;
        private $dan_block;
        
        /*
        public $table = array();
        public $params;
        public $fn;
        public $colname;
        */
        
        
        public function __construct($sql, $dan_chart, $dan_block)
        {
            $this->db = new DB3();            
            $this->sql = $sql;            
            $this->dan_chart = $dan_chart;
            $this->dan_block = $dan_block;                        
        }
        
        public function init($fn)
        {                        
            if(method_exists($this, $fn)){
                $this->dan = $this->dan_chart;
                $this->$fn();
            }
            return $this->dan;
        } 
        
        /**
         * Список колонок исходя из SQL запроса
         * Пока не активна ни где
        */
        private function columnsFromSQL($sql)
        {
            $sql = str_replace('where', 'where rownum = 1 and ', $sql);
            $sql = str_replace('WHERE', 'where rownum = 1 and ', $sql);                
            $q = $this->db->Select($sql);                            
            $columns = $this->db->list_columns;
            return $columns;
        }
                
        /**
         * Показать карту с определенными данные из селекта
        */
        public function map_region()
        {
            $kode = '';
            $table = '';
                        
            if($this->sql !== ''){
                $col_name = $this->dan_block['COL_NAME'];
                $fn = $this->dan_block['BIG_FN'];
                
                $sqls = "select substr($col_name, 1, 2) id, region_name(substr($col_name, 1, 2)) name, $fn from($this->sql) group by substr($col_name, 1, 2)";
                
                $res = $this->db->Select($sqls);
                //consolExit($res);
                
                $cols = '';
                $table = '<table class="table table-bordered"><thead>';
                $table .= '<tr><th>Регион</th>';
                
                foreach($this->db->list_columns as $k=>$v){
                    if($v !== 'ID'){
                        if($v !== 'NAME'){
                            $table .= '<th>'.$v.'</th>';
                        }
                    }
                }
                                                 
                $table .= '</tr></thead><tbody>';
                foreach($res as $k=>$v){
                    $kode .= ',{"id":"'.$v["ID"].'","title":"'.$v["NAME"].'<br><b>';
                    foreach($this->db->list_columns as $t=>$c){
                        if($c !== 'ID'){
                            if($c !== 'NAME'){
                                $kode .=$c.' = '.$v[$c].'<br />';                                
                            }
                        }
                    }
                    $kode .='</b>",
                    "data":"substr('.$col_name.', 1, 2)"
                    }';
                    
                    $table .= '<tr><td><a class="mdl" href="javasript:;" data="substr('.$col_name.', 1, 2)" data-page="'.$this->dan_block['ID_PAGE'].'" id="'.$v["ID"].'">'.$v['NAME'].'</a></td>';
                    
                    foreach($this->db->list_columns as $t=>$c){
                        if($c !== 'ID'){
                            if($c !== 'NAME'){
                                $table .= '<td>'.$v[$c].'</td>';
                            }
                        }                    
                    }
                    
                    $table .= '</tr>';
                }
                $table .= '</tbody></table>';
            }
            $this->dan['CODE_END'] = str_replace('{%CODE%}', $kode, $this->dan['CODE_END']);            
            $this->dan['table'] = $table;
            return true;
        }
        
        public function columns()
        {
            $id = 'highchart_'.rand(0, 10000000).date("YmdHis");
            $kode = '';
            
            //consolExit($this->dan_block);
            
            if($this->sql !== ''){                
                $col_name = $this->dan_block['COL_NAME'];                
                $fn = $this->dan_block['BIG_FN'];
                
                $sqls = "select $col_name, $fn from($this->sql) group by $col_name order by 1";                
                $res = $this->db->Select($sqls);
                //consolExit($res);
                
                //Делаем Шапку для отображения
                $kode .= '<thead><tr>';
                foreach($this->db->list_columns as $k=>$v){
                    if($v !== $col_name){
                        if(trim(strtoupper($v)) == trim(strtoupper($col_name))){                        
                            $kode .= '<th>'.$this->dan_block['TITLE'].'</th>';
                        }else{
                            $kode .= '<th>'.$v.'</th>';
                        }
                    }
                }
                
                //consolExit($this->db->list_columns);
                
                $kode .= '</tr><thead><tbody>';                
                $table = '<table class="table table-bordered">'.$kode;
                
                foreach($res as $r=>$v)
                {
                    $kode .= '<tr>';
                    $table .= '<tr>';
                    foreach($this->db->list_columns as $i=>$t){
                        if($t !== $col_name){
                            $kode .= '<td>'.$v[$t].'</td>';
                            $table .= '<td><a class="mdl" href="javasript:;" data="'.$col_name.'" data-page="'.$this->dan_block['ID_PAGE'].'" id="'.$v[$col_name].'">'.$v[$t].'</a></td>';
                        }
                    }
                    $kode .= '</tr>';
                    $table .= '</tr>';
                } 
                $kode .= '</tbody>';
                $table .= '</tbody></table>';
                
                $this->dan['CODE_START'] = str_replace('{%ID%}', $id, $this->dan['CODE_START']);
                $this->dan['CODE_END'] = str_replace('{%ID%}', $id, $this->dan['CODE_END']);
                $this->dan['HTML_FORM'] = str_replace('{%ID%}', $id, $this->dan['HTML_FORM']);
                
                $this->dan['HTML_FORM'] = str_replace('{%CODE%}', $kode, $this->dan['HTML_FORM']);
                $this->dan['table'] = $table;
            }
            //consolExit($this->dan);
            return true;
        }
        
        public function lines()
        {
            $id = 'highchart_'.rand(0, 10000000).date("YmdHis");
            $kode = '';
            
            //consolExit($this->dan_block);
            
            if($this->sql !== ''){
                $col_name = $this->dan_block['COL_NAME'];                
                $fn = $this->dan_block['BIG_FN'];
                
                //$sqls = "select $col_name, $fn from($this->sql) group by $col_name order by 1";
                $order = '1';
                if($this->dan_block['SQL_ORDERBY'] !== ''){
                    $order = $this->dan_block['SQL_ORDERBY'];
                }
                
                $group = $col_name;
                if($this->dan_block['SQL_GROUPBY'] !== ''){
                    $group = $this->dan_block['SQL_GROUPBY'];
                }
                
                
                $sqls = "select $col_name, $fn from($this->sql) group by $group order by $order";    
                //consolExit($sqls);
                                
                $res = $this->db->Select($sqls);    
                //consolExit($res);
                
                //Делаем Шапку для отображения
                $kode .= '<thead><tr>';
                foreach($this->db->list_columns as $k=>$v){
                    if($v !== $col_name){
                        if(trim(strtoupper($v)) == trim(strtoupper($col_name))){                        
                            $kode .= '<th>'.$this->dan_block['TITLE'].'</th>';
                        }else{
                            $kode .= '<th>'.$v.'</th>';
                        }
                    }
                }                
                
                //consolExit($this->db->list_columns);
                
                $kode .= '</tr><thead><tbody>';                
                $table = '<table class="table table-bordered">'.$kode;
                
                foreach($res as $r=>$v)
                {
                    $kode .= '<tr>';
                    $table .= '<tr>';
                    foreach($this->db->list_columns as $i=>$t){
                        if($t !== $col_name){
                            $kode .= '<td>'.$v[$t].'</td>';
                            $table .= '<td><a class="mdl" href="javasript:;" data="'.$col_name.'" data-page="'.$this->dan_block['ID_PAGE'].'" id="'.$v[$col_name].'">'.$v[$t].'</a></td>';
                        }
                    }
                    $kode .= '</tr>';
                    $table .= '</tr>';
                } 
                $kode .= '</tbody>';
                $table .= '</tbody></table>';
                
                $this->dan['CODE_START'] = str_replace('{%ID%}', $id, $this->dan['CODE_START']);
                $this->dan['CODE_END'] = str_replace('{%ID%}', $id, $this->dan['CODE_END']);
                $this->dan['HTML_FORM'] = str_replace('{%ID%}', $id, $this->dan['HTML_FORM']);
                
                $this->dan['HTML_FORM'] = str_replace('{%CODE%}', $kode, $this->dan['HTML_FORM']);
                $this->dan['table'] = $table;
            }
            //consolExit($this->dan);
            return true;
        }
        
        public function tables()
        {
            //consolExit($this->dan_block);
            if($this->sql !== ''){
                $col_name = $this->dan_block['COL_NAME'];                
                //$fn = $this->dan_block['FN'];
                
                //if(trim($this->dan_block['BIG_FN']) !== ''){
                    $fn = $this->dan_block['BIG_FN'];
                //}
                
                $order = '1';
                if($this->dan_block['SQL_ORDERBY'] !== ''){
                    $order = $this->dan_block['SQL_ORDERBY'];
                }
                
                $group = $col_name;
                if($this->dan_block['SQL_GROUPBY'] !== ''){
                    $group = $this->dan_block['SQL_GROUPBY'];
                }
                
                
                $sqls = "select $fn from($this->sql) group by $group order by $order";    
                //consolExit($sqls);                
                $res = $this->db->Select($sqls);
                
                $kode .= '<thead><tr>';
                
                //consolExit($this->db->list_columns);
                
                foreach($this->db->list_columns as $k=>$v){                    
                    if(trim(strtoupper($v)) == trim(strtoupper($col_name))){                        
                        $kode .= '<th>'.$this->dan_block['TITLE'].'</th>';
                    }else{
                        $kode .= '<th>'.$v.'</th>';
                    }                    
                }
                
                $kode .= '</tr><thead><tbody>';
                
                foreach($res as $r=>$v)
                {
                    $kode .= '<tr>';
                    $table .= '<tr>';
                    foreach($this->db->list_columns as $i=>$t){
                        $kode .= '<td>'.$v[$t].'</td>';
                        //$table .= '<td><a class="mdl" href="javasript:;" data="'.$col_name.'" id="'.$v[$col_name].'">'.$v[$t].'</a></td>';
                    }
                    $kode .= '</tr>';
                } 
                $kode .= '</tbody>';
                
                //$this->dan['CODE_START'] = str_replace('{%ID%}', $id, $this->dan['CODE_START']);
                //$this->dan['CODE_END'] = str_replace('{%ID%}', $id, $this->dan['CODE_END']);
                //$this->dan['HTML_FORM'] = str_replace('{%ID%}', $id, $this->dan['HTML_FORM']);                
                $this->dan['HTML_FORM'] = str_replace('{%CODE%}', $kode, $this->dan['HTML_FORM']);
                $this->dan['table'] = '';
                
                //consolExit($this->dan);
            }
        }
    }