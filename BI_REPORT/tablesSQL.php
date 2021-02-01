<?php
	class table_sql
    {
        private $db;
        public $params;
        
        public function __construct()
        {
            $this->db = new DB3();
        }
        
        public function sql($id, $ss, $id_page)
        {
            //1. Узнаем что за отчет
            //$id = 2;//$_GET['report'];
            //$id = $_GET['report'];
            
            //2. Находим параметры по умолчанию       
            //$this->getParams($id);
            //consolExit($ss);
                        
            $cn = $this->db->Select("select * from BI_REPORT_PAGE_COLNAMES where id_page = $id_page");
            $colnames_rus = array();
            foreach($cn as $k=>$v){            
                $colnames_rus[$v['COLNAME']] = $v['COLNAME_RUS'];
            }
            
            $q = $this->db->Select("select * from bi_report_page where id = $id_page");
            //print_r($q);
            $sqls = $q[0]['SQL_TEXT'];
            
            foreach($this->params as $kk=>$vv){
                $sqls = str_replace(':'.$vv['name'], $vv['result'], $sqls);
            }
            
            $not_view = $this->Not_viewColumns($id_page);
            
            $sql = "select * from($sqls) where $ss";
            $tst = $this->TableForSql($sql, $not_view, $colnames_rus);
            return $tst;
        }
        
        private function TableForSql($sql, $not_view, $colnames = array())
        {
            $q = $this->db->Select($sql);
            $html = '<table class="table table-bordered table-hover">';
            
            $columns = $this->db->list_columns;
            $html .= '<thead><tr>';
            foreach($columns as $k=>$v){
                $b = true;
                foreach($not_view as $view){
                    if($view == $v){
                        $b = false;
                    }
                }
                if($b){
                    $cname = $v;
                    if(isset($colnames[$v])){
                        $cname = $colnames[$v];
                    }                
                    $html .= '<th>'.$cname.'</th>';
                }
            }
            $html .= '<th></th></tr></thead><tbody>';
            
            foreach($q as $k=>$v){
                
                $btns = $this->buttons_get($this->db->list_columns, $v);
                
                foreach($not_view as $view){
                    unset($v[$view]);
                }
                
                $html .= '<tr>';
                foreach($v as $i=>$t){
                    $html .= '<td>'.$t.'</td>';
                }
                                        
                $html .= '<td>'.$btns.'</td>';
                $html .= '</tr>';
            }
            $html .= '<tbody></table>';
            return $html;
        }
        
        private function Not_viewColumns($id_page)
        {
            $q = $this->db->Select("select COLNAME from BI_REPORT_NOTCOL where id_page = $id_page");
            $ns = array();
            foreach($q as $k=>$v){
                array_push($ns, $v['COLNAME']);
            }
            return $ns;
        }
        
        private function buttons_get($btns, $res)
        {        
            $html = '<div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-info btn-xs dropdown-toggle" aria-expanded="false">Открыть <span class="caret"></span></button>
                                <ul class="dropdown-menu">';
                    foreach($btns as $k=>$v){                    
                        $btn_class = new BTN_HREF(trim($v), $res[$v]);                    
                        $href = $btn_class->rest();
                        if($href !== ''){
                            $html .= '<li><a href="'.$href['href'].'" target="_blank">'.$href['title'].'</a></li>';
                        }
                    }                        
            $html .= '</ul></div>';
            return $html;
        }
        
    }
?>