<?php
	class BI_REPORT
    {
        private $db;
        private $ajax = false;
        private $array;
        private $page = '';
        private $result_bool = false;
        
        public $result;
        public $html;
        
        public function __construct()
        {
            $this->db = new DB3();
            
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
                $this->ajax = true;                    
            }
            
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();
            if($this->ajax){exit;}
        }
        
        private function GET()
        {
            
            if(count($_GET) <= 0){
                $this->index();
            }else{
                if(!$this->ajax){$this->index();}                
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){                        
                        $this->$k($v);
                    }else{
                        $this->array[$k] = $v;
                    }
                }                
            }            
            $this->loadPage();    
            $this->on_ajax();        
        }
        
        private function POST()
        {
            if(count($_POST) > 0){                
                $this->array = $_POST;
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){                        
                        $this->$k($v); 
                    }
                }                
            }
            $this->on_ajax();
        }
        
        private function on_ajax()
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    exit;
                }
            }
        }
        
        /**
         * Загрузка страницы при GET запросе
         * @return html;
        */
        
        private function loadPage()
        {            
            $filename = $this->page;
            if($filename !== ''){
                $dan = $this->result;                
                if($this->ajax == false){
                    $this->html = $this->getTemplate($filename);                   
                }else{                    
                    require_once $filename;
                }
            }            
        }
        
        /**
         * Загрузка определенного файла как текст
         * @return html;
        **/
        private function getTemplate($filename) {
            ob_start();
            include ($filename);
            $text = ob_get_clean();
            return $text;
        }
        
        /**
         * Список отчетов
         * @return $result['reports'];
        */
        private function index()
        {
            $this->result['reports'] = $this->db->Select("select * from bi_reports order by id"); 
        }
        
        /**
         * Форма для создания отчета
         * @return html;
        **/
        private function create_report()
        {
            $this->result['title'] = 'Создание нового отчета';
            $this->result['id'] = 0;
            $this->result['text'] = '';
            $this->page = __DIR__."/create_report.php";
        }
        
        /**
         * Форма по редактированию отчетов
         * @return html;
        */        
        private function edit_report($id)
        {            
            $this->result['title'] = 'Редактирование отчета';
            $this->result['id'] = $id;
            $text = '';
            $q = $this->db->Select("select * from bi_reports where id = $id");
            $text = $q[0]['NAME'];            
            $this->result['text'] = $text;
            $this->page = __DIR__."/create_report.php";
        }
        
        /**
         * Сохранение нового отчета
        */        
        private function new_bi_reports($text)
        {
            $id = $this->array['id'];
            if($id == 0){
                $q = $this->db->Select("select * from BI_REPORTS where upper(name) = upper('$text')");
                if(count($q) > 0){
                    echo ALERTS::ErrorMin('Отчет с данным именем уже существует');
                    exit;
                }else{
                    $sql = "INSERT INTO BI_REPORTS (ID, NAME) VALUES (SEQ_BI_REPORTS.nextval, '$text')";
                }
            }else{
                $sql = "update BI_REPORTS set NAME = '$text' where ID = $id";
            }
            if($this->db->Execute($sql)){
                echo "<script>window.location.href = 'bi';</script>";
            }else{
                echo ALERTS::ErrorMin($this->db->message);
            }
        }
        
        
        /**
         * При нажатии на отчет 
         * @return html;
         * Функция пока не определена
        */
        private function report($id)
        {
            $this->page = __DIR__."/report.php";            
            $this->result['id'] = $id;
            $q = $this->db->Select("select * from bi_reports where id = $id");
                        
            $this->result['title'] = $q[0]['NAME'];            
            $q = $this->db->Select("select * from BI_REPORTS_BLOCK where id_report = $id order by num_pp");
            $this->result['blocks'] = $q;
            
            $prst = $this->db->Select("select max(id) id, name, type, text from BI_REPORTS_PARAMS where id_report = $id 
            group by name, type, text order by id");
            foreach($prst as $p=>$t){
                if(trim($v['SQL_TEXT']) !== ''){
                    $prst[$p]['SQL_RESULT'] = $this->db->Select($v['SQL_TEXT']);                         
                }
            }
            $this->result['params'] = $prst;
            foreach($q as $k=>$v){                                                
                $this->result['blocks'][$k]['table']['thead'] = $this->db->Select("select * from BI_REPORTS_TABLE where type_head = 'thead' and id_report = $id and id_block = ".$v['ID']." order by col_class, row_class");
                $this->result['blocks'][$k]['table']['tbody'] = $this->db->Select("select * from BI_REPORTS_TABLE where type_head = 'tbody' and id_report = $id and id_block = ".$v['ID']." order by col_class, row_class");
                
                $this->result['blocks'][$k]['result'] = '';
            }            
        }
        
        /**
         * Форма для создания блока
         * @return html;
        */
        
        private function create_block($id)
        {
            $this->list_tables();
            $this->page = __DIR__.'/create_block.php';
        }
        
        
        private function execSql($sql, $ds = array())
        {
            $q = $this->db->Select($sql, $ds);            
            $html = '<table class="table table-bordered"><thead><tr>';
            foreach($q[0] as $k=>$v){
                $html .= '<th>'.$k.'</th>';
            }
            $html .= '</tr></thead> <tbody>';
            
            foreach($q as $k=>$v){                
                $html .= '<tr>';
                foreach($v as $i=>$t){
                    $html .= '<td>'.$t.'</td>';
                }
                $html .= '</tr>';
            }            
            $html .= '</tbody></table>';
            if($this->result_bool){
                return $html;
            }else{
                echo $html;
            }            
        }
        
        private function exesSQLJSON($sql)
        {
            $q = $this->db->Select($sql);
            echo json_encode($q);
            return $q;
        }
                
        private function create_table()
        {
            $dan = $_POST;
            $dan['id'] = $_POST['create_table'];
            $cols = $_POST['cols'];
            $rows = $_POST['rows'];
            
            $html = '<table class="table table-bordered" id="T'.$dan['id'].'">';
            if($rows > 1){
                $html .= "<thead><tr>";
                for($c = 0;$c<$cols;$c++){
                    $html .= "<th></th>";
                }
                $html .= "</tr></thead><tbody>";
                --$rows;
            }
                        
            for($r = 0; $r < $rows; $r++){
                $html .= '<tr>';
                for($c = 0; $c < $cols; $c++){
                    $ids = "c$c:r$r";                                        
                    $html .= '<td class="cr c'.$c.' r'.$r.'" id="'.$ids.'"></td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';
            $dan['table'] = $html;
            require_once __DIR__.'/table_edit.php';
        }
        
        private function set_table_sql($sql)
        {
            $dan['id'] = $_POST['id'];
            $type = $_POST['type']; //Если 0 тогда возврат табличного значения, иначе вернет переменную для вставки в таблицу
            
            
            $params = $this->params_from_sql($sql);
            $prs = array();
            if(count($params) > 0){
                foreach($params as $v){
                    $prs[$v] = '';
                }
            }
            
            $q = $this->db->Select($sql, $prs); 
            $cols = $this->db->list_columns;
            
            $html = '<table class="table table-bordered" id="T'.$dan['id'].'"><thead><tr>';
            foreach($cols as $k=>$v){
                $c = $k+1;
                $ids = "c$c:r1";
                $html .= '<td class="cr c'.$c.' r1" id="'.$ids.'">'.$v.'</td>';
            }            
            $html .= '</tr></thead><tbody>';
            
            foreach($cols as $k=>$v){
                $c = $k+1;
                $ids = "c$c:r2";
                $html .= '<td class="cr c'.$c.' r2" id="'.$ids.'">{{'.$v.'}}</td>';
            }   
            $html .= '</tbody></table>';            
            $dan['others'] = '<div class="alert alert-success">            
            <h5>SQL '.$dan['id'].'</h5><span class="sql_text" id="'.$dan['id'].'">'.$sql.'</span></div>
            <textarea style="display: none" class="sql_text_area" id="'.$dan['id'].'">'.$sql.'</textarea>
            ';            
            $dan['table'] = $html;
            
            
            $res = array();                        
            $test = $this->getObtain(__DIR__."/table_edit.tpl");                    
            $test = str_replace('{%id%}', $dan['id'], $test);
            $test = str_replace('{%others%}', $dan['others'], $test);
            $test = str_replace('{%table%}', $dan['table'], $test);
            $res['html'] = $test;
            
            $res['params'] = '';            
            if(count($params) > 0){
                foreach($params as $name){
                    $test = $this->getObtain(__DIR__."/form_params_admin.tpl");                    
                    $res['params'] .= str_replace('{%name%}', $name, $test);                      
                }
            }
            
            $res['params'] .= '<input type="hidden" name="params_json" value="'.htmlspecialchars(json_encode($params)).'">';
            
            echo json_encode($res);
            //require_once __DIR__.'/table_edit.php';                        
        }
        
        private function getParams()
        {
            $dan = $_POST;
            $ds = array();
            foreach($dan['name'] as $k=>$v){
                $ds[$k] = $dan['value'][$k];
            }
            echo json_encode($ds);            
        }
        
        /**
         * Вызывается когда нажимают кнопку выполнить с параметрами
        */
        private function sql($sql)
        {            
            $dan = $_POST;
            $sql = $dan['sql'];
            unset($dan['sql']);
            $ds = array();
            foreach($dan['name'] as $k=>$v){
                $ds[$k] = $dan['value'][$k];
            }
            
            $this->result_bool = true;
            $result['table'] = $this->execSql($sql, $ds);
                        
            $result['params'] = '';
            $i = 0;
            foreach($dan['name'] as $k=>$name){                
                $text = '<input type="text" class="form-control" name="value[{%name%}]"/>';
                
                if($dan['type'][$k] == 'D'){
                    $text = '<input type="text" class="form-control" name="value[{%name%}]" data-mask="99.99.9999" value="'.$dan['value'][$k].'"/>';
                }
                
                if($dan['type'][$k] == 'S'){
                    $q = $this->db->Select($dan['sql_text'][$k]);
                    $text = '<select class="form-control" name="value[{%name%}]">';
                    foreach($q as $t=>$d){
                        $S = '';
                        if($d['ID'] == $dan['value'][$k]){
                            $S = 'selected="selected"';
                        }
                        $text .= '<option value="'.$d['ID'].'" '.$S.'>'.$d['NAME'].'</option>';
                    }
                    $text .= '</select>';
                }
                
                $htm = $this->getObtain(__DIR__."/form_params_admin.tpl");
                $htm = str_replace('<input type="text" class="form-control" name="value[{%name%}]"/>', $text, $htm);
                $htm = str_replace('<option value="'.$dan['type'][$k].'">', '<option value="'.$dan['type'][$k].'" selected>', $htm);                                
                $htm = str_replace('{%name%}', $name, $htm);
                $result['params'] .= $htm;
            }
            $result['dan'] = $dan;            
            echo json_encode($result);                      
        }
        
        private function params_from_sql($sql)
        {
            $params = array();
            $qs = explode(':', $sql);            
            if(count($qs) > 1){
                for($i=1;$i<count($qs);$i++){
                    $ds = explode(' ', $qs[$i]);
                    $qs[$i] = $ds[0];
                    
                    $ds = explode(',', $qs[$i]);
                    $qs[$i] = $ds[0];
                                        
                    $ds = explode('(', $qs[$i]);
                    $qs[$i] = $ds[0];
                    
                    $ds = explode(')', $qs[$i]);
                    $qs[$i] = $ds[0];
                    $qs[$i] = str_replace(' ', '', $qs[$i]);
                    $qs[$i] = str_replace("\n", '', $qs[$i]);
                    array_push($params, $qs[$i]);                    
                }
                unset($qs[0]);
            }
            return $params;
        }
        
        private function chartname($id)
        {
            $name = '';
            switch ($id){
                case 0: $name = '';
                        break;
                case 1: $name = 'data-graph-container-before="1" data-graph-type="column"';
                        break;
                case 2: $name = 'data-graph-container-before="1" data-graph-type="line" data-graph-point-callback="callbackForPoint"';
                        break;
                case 3: $name = 'data-graph-container-before="1" data-graph-type="column"';
                        break;
                case 4: $name = 'data-graph-container-before="1" data-graph-type="column" data-graph-yaxis-1-stacklabels-enabled="1"';
                        break;
                case 5: $name = 'data-graph-container-before="1" data-graph-type="pie" data-graph-datalabels-enabled="1" data-graph-color-1="#999"';
                        break;                
            }
            return $name;            
        }
        
        private function get_report($id)
        {
            $dan = $_POST;
            unset($dan['get_report']);
            echo '<hr />';
            $scripts = '';
            
            $q = $this->db->Select("select * from BI_REPORTS_BLOCK where id_report = $id order by num_pp");            
            foreach($q as $k=>$v){                
                if($v['ID_CHART'] !== '0'){
                    $scripts .= "$('.highchart_".$v['ID']."').highchartTable(); \n\t\r";
                }
                
                $chartname = $this->chartname($v['ID_CHART']);
                $view = '';
                if($v['DONT_VIEW_TABLE'] == '1'){
                    $view = 'style="display: none;"';
                }
                
                $sql = $v['SQL_TEXT'];
                $qb = $this->db->Select($sql, $dan);
                if(count($qb) <= 0){
                    foreach($dan as $d=>$n){
                        $sql = str_replace(":$d", "'$n'", $sql);
                    }
                    $qb = $this->db->Select($sql);
                }
                
                echo '<div class="col-lg-'.$v['SIZE_BLOCK'].'"><div class="panel panel-default"><div class="panel-body">';                                        
                echo '<table class="table table-bordered highchart_'.$v['ID'].'" '.$chartname.' '.$view.'><thead><tr>';    
                $thead = $this->db->Select("select * from BI_REPORTS_TABLE where id_report = $id and type_head = 'thead' and id_block = ".$v['ID']." order by id");
                foreach($thead as $tr=>$td){
                    $colspan = '';
                    $rowspan = '';                    
                    echo '<th class="'.$td['COL_CLASS'].' '.$td['ROW_CLASS'].'" '.$colspan.' '.$rowspan.'>'.$td['HTML_TEXT'].'</th>';
                }
                echo '</tr></thead><tbody>';
                                
                if(count($qb) > 0){                            
                    foreach($qb as $k=>$p){                        
                        echo '<tr>';
                            foreach($p as $t=>$td){
                                echo '<td>'.$td.'</td>';
                            }
                        echo '</tr>';                        
                    }
                }
                
                echo '</tbody></table>';  
                echo '<button class="btn btn-default btn-xs pull-right" id="view_table_rest" data="highchart_'.$v['ID'].'"><i class="fa fa-table"></i></button>';
                echo '</div></div></div>';
                                                
            }
            if($scripts !== ''){
                echo '<script>'.$scripts.'</script>';        
            }                     
        }
        
        private function view_result_chart($d)
        {               
            $dan = json_decode($d);
            require_once __DIR__.'/view_result_chart.php';            
        }
                
        private function sql_editor_block()
        {
            global $css_loader;
            global $js_loader;
            global $othersJs;
            
            array_push($css_loader,
                "styles/js/codemirror/codemirror.css",
                "styles/js/codemirror/show-hint.css",
                "styles/css/plugins/steps/jquery.steps.css"
            );
            
            array_push($js_loader,
                "styles/js/codemirror/codemirror.js",
                "styles/js/codemirror/sql.js",
                "styles/js/codemirror/show-hint.js",
                "styles/js/codemirror/sql-hint.js",
                "styles/js/demo/bi_sql_editor.js"
            );
                        
            $this->list_tables();            
            $othersJs .= "<script>
              var tbls = JSON.parse('".$this->result['tables']."');
            </script>";
            
            $this->page = __DIR__.'/sql_editor_block.php';
        }
        
        private function execSql_block($sql)
        {
            $params = array();
            if(isset($_POST['params'])){
                $params = $_POST['params'];    
            }
            
            $qs = explode(':', $sql);            
            if(count($qs) > 1){
                for($i=1;$i<count($qs);$i++){
                    $ds = explode(' ', $qs[$i]);
                    $qs[$i] = $ds[0];
                    
                    $ds = explode(',', $qs[$i]);
                    $qs[$i] = $ds[0];
                                        
                    $ds = explode('(', $qs[$i]);
                    $qs[$i] = $ds[0];
                    
                    $ds = explode(')', $qs[$i]);
                    $qs[$i] = $ds[0];
                    $qs[$i] = str_replace(' ', '', $qs[$i]);
                    $qs[$i] = str_replace("\n", '', $qs[$i]);                    
                }
                unset($qs[0]);
            }else{
                $qs = array();
            }
            $dan['params'] = $qs;
            
            $dsp = array();
            if(count($qs) > 0){
                foreach($qs as $k=>$v){
                    $dsp[$v] = 'NULL';
                }
            }
            
            if(count($params) > 0){
                $dsp = $params;
                foreach($params as $k=>$v){
                    $id = $v['name'];
                    $dsp[$id] = $v['value'];
                    
                    if(isset($v['sql'])){
                        $qs = $this->db->Select($v['sql']);
                        if(count($qs) > 0){
                             $dsp[$id] = $qs[0]['ID'];
                        }
                    }
                }
            }
            
            $dan['sql'] = $sql;            
            $q = $this->db->Select($sql, $dsp);
            
            $html = '<table class="table table-bordered"><thead><tr>';
            foreach($this->db->list_columns as $k=>$v){                
                $html .= '<td>'.$v.'</td>';
            }            
            $html .= '</tr></thead><tbody>';
            
            foreach($q as $k=>$v){
                $html .= '<tr>';
                foreach($this->db->list_columns as $t=>$c){
                    $html .= '<td>'.$v[$c].'</td>';
                }
                $html .= '</tr>';
            }   
            $html .= '</tbody></table>';
            
            $dan['result'] = $html;
            $dan['columns'] = $this->db->list_columns;
            echo json_encode($dan);
            exit;
        }
        
        private function proverka_sql($sql)
        {
            $dan['sql'] = $sql;
            $dan['params'] = array();
            $dan['html'] = '';
            
            $params = $this->params_from_sql($sql);
            if(count($params) > 0){
                $dan['params'] = $params;
                foreach($params as $name){
                    $test = $this->getObtain(__DIR__."/form_params_admin.tpl");                    
                    $dan['html'] .= str_replace('{%name%}', $name, $test);                      
                }
                $dan['html'] .= '<input type="hidden" name="sql" value="'.htmlspecialchars($sql).'" />';
            }
                        
            echo json_encode($dan);
            exit;            
        }
        
        private function getObtain($tpl)
        {            
            $myfile = fopen($tpl, "r") or die("Unable to open file!");
            $test = fread($myfile, filesize($tpl));
            fclose($myfile);
             
            return $test;
        }
                
        private function exesSQlParams($sql)
        {
            $this->execSql_block($sql);
            exit;
        }
                
        private function list_tables()
        {
            $q = $this->db->Select("select table_name, column_name, column_id from all_tab_columns a where owner = 'INSURANCE' order by table_name, column_id");
            $dan = array();
            foreach($q as $k=>$v){
                $table = $v['TABLE_NAME'];
                $dan[$table][] = $v['COLUMN_NAME'];                
            }
            $this->result['tables'] = json_encode($dan);            
        }
        
        private function set_block($id)
        {            
            $title = $_POST['title'];
            $sql_text = $_POST['sql'];
            $cols = $_POST['cols'];
            $params = $_POST['params'];
            
            $a = array("SQL"=>$sql_text);
            if($id == 0){
                $sql = "INSERT INTO BI_SQL_BLOCKS (TITLE, SQL) VALUES ('$title', :SQL)";
            }else{
                $sql = "UPDATE BI_SQL_BLOCKS SET TITLE = :TITLE, SQL = :SQL WHERE ID = $id";
            }
            
            $this->db->ExecProc($sql, $a);
            if($id == 0){
                $q = $this->db->Select("select max(id) id from BI_SQL_BLOCKS");
                $id = $q[0]['ID'];
            }else{
                $this->db->Execute("delete from BI_SQL_BLOCKS_COLS where id_block = $id");
                $this->db->Execute("delete from BI_SQL_BLOCKS_PARAMS where id_block = $id");                                
            }
            
            foreach($cols as $k){
                $this->db->Execute("insert into BI_SQL_BLOCKS_COLS(id_block, name) values($id, '$k')");
            }
            
            foreach($params as $k=>$v){
                $a = array("SQL_TEXT"=>$v['sql']);
                $this->db->ExecProc("INSERT INTO BI_SQL_BLOCKS_PARAMS (ID_BLOCK, NAME, SQL_TEXT, TITLE, TYPE) 
                VALUES($id, '".$v['name']."', :SQL_TEXT, '".$v['title']."', '".$v['type']."')", $a);
            }
            echo $id;            
            exit;
        }
        
        private function get_blocks_sql()
        {
            $dan = array();
            $dan['block'] = $this->db->Select("select * from BI_SQL_BLOCKS");
            foreach($dan['block'] as $k=>$v){
                $dan['block'][$k]['cols'] = $this->db->Select("select * from BI_SQL_BLOCKS_COLS where id_block = ".$v['ID']);
                $dan['block'][$k]['params'] = $this->db->Select("select * from BI_SQL_BLOCKS_PARAMS where id_block = ".$v['ID']);
            }
            echo json_encode($dan);
        }
        
        private function save_block_report($id)
        {       
            $result = array(
                "id"=>0,
                "message"=>""
            );
            $b = true;
            $dan = $_POST['data'];
            $num_pp = 1;
            $dont_view_table = BoolToInt($dan['dont_view_table']);                                    
            
            $q = $this->db->Select("select nvl(max(num_pp), 0)+1 num_pp from BI_REPORTS_BLOCK where ID_REPORT = $id");
            
            if(count($q) > 0){
                if($q[0]['NUM_PP'] !== ''){
                    $num_pp = $q[0]['NUM_PP'];
                }
            }
                        
            $id_block = $this->array['data']['id_block']; 
            $sqltext = str_replace("\n", '', $dan['sql']);
            $params = json_encode($dan['params']);
                        
            $array_sql = array(
                "TABLE_TEXT"=>htmlspecialchars(json_encode($dan['table'])),
                "SQL_TEXT"=>$sqltext
            );
            
            if($id_block == '0'){
                $sql = "INSERT INTO BI_REPORTS_BLOCK 
                    (ID_REPORT, NUM_PP, SIZE_BLOCK, ID_CHART, DONT_VIEW_TABLE, PARAMS_TEXT, SQL_TEXT, TABLE_TEXT) 
                VALUES 
                    ($id, $num_pp, '".$_POST['size_panel_report']."', '".$dan['chart']."', '$dont_view_table', '$params', :SQL_TEXT, :TABLE_TEXT)";
            }else{
                unset($array_sql['ID_REPORT']);
                $sql = "UPDATE BI_REPORTS_BLOCK SET
                NUM_PP          = $num_pp,
                SIZE_BLOCK      = '".$_POST['size_panel_report']."',
                ID_CHART        = :ID_CHART,
                SQL_TEXT        = :SQL_TEXT,
                DONT_VIEW_TABLE = :DONT_VIEW_TABLE,
                PARAMS_TEXT     = :PARAMS_TEXT,
                TABLE_TEXT      = :TABLE_TEXT                
                where
                ID              = $id_block";
            }            
            $txt = $this->db->ExecProc($sql, $array_sql);
            
            if(!$this->db->ExecProc($sql, $array_sql)){
                $result['message'] = $this->db->message;
                echo json_encode($result);                
                exit;
                $b = false;
            }
            
            
            if($id_block == '0'){
                $q = $this->db->Select("select max(id) id from BI_REPORTS_BLOCK where id_report = $id");
                $id_block = $q[0]['ID'];                
            }
            
            $result['id'] = $id_block;
            $result['id_report'] = $id;
            
            
            //Сохраняем параметры
            $param = array();
            if(count($dan['params']) > 0){
                //Создаем массив 
                foreach($dan['params'] as $k=>$v){
                    if(substr($v['name'], 0, 4) == 'name'){                             
                        $param[$v['value']] = array(); 
                    }
                }
                
                foreach($dan['params'] as $k=>$v){
                    $s = explode('[', $v['name']);
                    $t = $s[0];
                    foreach($param as $ts=>$tt){
                        if($v['name'] == $t."[$ts]"){
                            $param[$ts][$t]=$v['value'];
                        }
                    }
                }
                
                //Сохраняем входящие параметры
                foreach($param as $k=>$v){
                    $sql = "INSERT INTO BI_REPORTS_PARAMS (ID_REPORT, ID_BLOCK, NAME, TYPE, TEXT, SQL_TEXT) 
                    VALUES ($id, $id_block, '".$v['name']."', '".$v['type']."', '".$v['text']."', '".htmlspecialchars($v['sql'])."')";
                    if(!$this->db->Execute($sql)){
                        $result['message'] .= $this->db->message;
                        echo json_encode($result);                
                        exit;
                    }
                }
            }                            
            //Конец сохрания параметров
                                
            //Сохраняем таблицу
            $thead = $dan['table']['thead'];
            $tbody = $dan['table']['tbody'];
            
            foreach($dan['table'] as $name=>$tdan){
                foreach($tdan as $tr=>$tcol){
                    foreach($tcol as $tc=>$td){
                    
                        $col = $td['col'];
                        $row = $td['row'];
                        $block = BoolToInt($rd['block']);
                        $text = htmlspecialchars($td['text']);
                        $colspan = $td['colspan'];
                        $rowspan = $td['rowspan'];
                        $style = '';
                        if(isset($td['style'])){
                            $style = $td['style'];
                        }
                        
                        $sql = "INSERT INTO BI_REPORTS_TABLE (ID_REPORT, ID_BLOCK, TYPE_HEAD, ID_TR, ID_NUM, COL_CLASS, ROW_CLASS, BLOCK, 
                        HTML_TEXT, COLSPAN, ROWSPAN, STYLE) 
                        VALUES ($id, $id_block, '$name', $tr, $tc, '$col', '$row', '$block', '$text', '$colspan', '$rowspan', '$style')";                    
                        
                        if(!$this->db->Execute($sql)){
                            $result['message'] .= $this->db->message;
                            echo json_encode($result);                
                            exit;
                        }
                    }
                }
            }
            //Конец сохранения таблиц
            
            echo json_encode($result);            
        }
                        
    }
?>