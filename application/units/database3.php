<?php
	class DB3
    {
        public $DB;        
        public $message = '';        
        public $row = array();
        public $bind_param = array();
        public $sql = '';
        public $connect_text = '';   
        public $count_cols = 0;
        public $list_columns = array();
        public $format_date = 'dd.mm.yyyy';
        private $user;     
    
	    public function __constructor()
        {
            $this->connect_text = "(DESCRIPTION =
            (ADDRESS_LIST =
                (ADDRESS = (PROTOCOL = TCP)(HOST = ".DB_HOST2.")(PORT = 1521))
            )
                (CONNECT_DATA =
                (SID = ".DB_DATABASE2.")
                (SERVER = DEFAULT)
                )
            )
            ";            

            //$this->DB = OCILogon(DB_USERNAME2, DB_PASS2, $this->connect_text, DB_CHARSET2);// or die(oci_error());
             
            $this->DB = oci_connect(DB_USERNAME2, DB_PASS2, $this->connect_text, DB_CHARSET2) or die(oci_error());            
            if(!$this->DB) 
            {
                $e = oci_error();                
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            $this->OpenSession();
        }

        public function OpenSession()
        {
            $stmt = oci_parse ($this->DB, "BEGIN 
            dbms_application_info.set_action (:action);
            execute immediate 'alter session set NLS_NUMERIC_CHARACTERS = '', '''; 
            END;");
            oci_bind_by_name ($stmt, ':action', $_SERVER["REMOTE_ADDR"]);
            oci_execute($stmt);
        }

        public function Connect()
        {
            $this->connect_text = "(DESCRIPTION =
            (ADDRESS_LIST =
                (ADDRESS = (PROTOCOL = TCP)(HOST = ".DB_HOST2.")(PORT = 1521))
            )
                (CONNECT_DATA =
                (SID = ".DB_DATABASE2.")
                (SERVER = DEFAULT)
                )
            )
            ";
            
            try {
                $this->DB = oci_connect(DB_USERNAME2, DB_PASS2, $this->connect_text, DB_CHARSET2);// or die(oci_error());      
                //$this->DB = OCILogon(DB_USERNAME2, DB_PASS2, $this->connect_text, DB_CHARSET2);// or die(oci_error());      
                //$this->DB = oci_pconnect(DB_USERNAME2, DB_PASS2, $this->connect_text, DB_CHARSET2);// or die(oci_error());
            } catch (Exception $e) {
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }            
                        
            if(!$this->DB)
            {
                $e = oci_error();
                var_dump($e);                
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }    
            $this->OpenSession();   
            
            global $active_user_dan;            
            $this->user = $active_user_dan;     
        }
                                
        function kill_session()
        {                        
            $nyip = $_SERVER["REMOTE_ADDR"];        
            $stmt = oci_parse($this->DB, '
                begin 
                    for x in ( 
                        select sid, serial#, machine, program from v$session where action = '."'$nyip'".' 
                    )loop
                        execute immediate '."Alter System Kill Session '''|| x.Sid || ',' || x.Serial# || ''' IMMEDIATE'".';
                    end loop;
                end;');
            oci_execute($stmt);                                 
        }
        
        public function Select($sql, $params = array())
        {
            $this->message = '';
            $this->ClearParams();            
            $this->sql = $sql; 
                                    
            if(empty($this->DB)){            
                $this->Connect();                
            }
            
            
            
            $q = oci_parse($this->DB, "ALTER SESSION SET NLS_DATE_FORMAT='$this->format_date'");
            oci_execute($q);
            
            
            
            $query = oci_parse($this->DB, $sql);
            if(count($params) > 0){
                foreach($params as $k=>$v){
                    oci_bind_by_name($query, ":$k", $v);
                }
            }
            
            if(!oci_execute($query)){
                //echo $sql."<br />";
                //exit;
                $e = oci_error($query); 
                $text = htmlentities($e['message'])."\n<pre>\n".htmlentities($e['sqltext']).printf("\n%".($e['offset']+1)."s", "^")."\n</pre>\n";                                               
                $this->message = $text; //htmlentities($e['message']);
                //$this->SetError($this->user['emp'], $text);
                return array();
            }
            
            //Список колонок  
            $ncol = oci_num_fields($query);                      
            $this->count_cols = $ncol;
            
            $this->list_columns = array();
            for ($i = 1; $i <= $ncol; $i++) {
                $column_name  = oci_field_name($query, $i);
                $column_type  = oci_field_type($query, $i);                
                $this->list_columns[] = $column_name;                                
            }
              
            while($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS+OCI_RETURN_LOBS))
            {
                $dan = array();                
                foreach($row as $k=>$v){
                    $dan[$k] = str_replace_kaz($v);
                }
                $this->row[] = $dan;
            }
            //oci_close($this->DB);
            return $this->row;   
        }
        
        
        public function Select2($sql)
        {
            $this->ClearParams();
            
            $this->sql = $sql;
            if(empty($this->DB)){            
                $this->Connect();    
            } 
            //$q = oci_parse($this->DB, "ALTER SESSION SET NLS_DATE_FORMAT='dd.mm.yyyy'");
            //oci_execute($q);     
            
            $q = oci_parse($this->DB, "ALTER SESSION SET NLS_CHARACTERSET=".DB_CHARSET2);
            oci_execute($q);
                               
            
            $query = oci_parse($this->DB, htmlspecialchars($sql));
            if(!oci_execute($query)){                
                $e = oci_error($query); 
                $text = htmlentities($e['message'])."\n<pre>\n".htmlentities($e['sqltext']).printf("\n%".($e['offset']+1)."s", "^")."\n</pre>\n";                                               
                $this->message = $text;
                $this->SetError($this->user['emp'], $text);
                return array();
            }                        
            while($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS+OCI_RETURN_LOBS))
            {
                $dan = array();
                foreach($row as $k=>$v){
                    $dan[$k] = str_replace_kaz($v);
                }
                $this->row[] = $dan;
            }
            //oci_close($this->DB);
            return $this->row;   
        }
        
        public function ExecProc($sql, $dan = array())
        {      
            if(empty($this->DB)){
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            if(count($dan) > 0){
                foreach($dan as $k=>$v){
                    oci_bind_by_name($stid, ':'.$k, $v);
                }
            }
            $result = array();
            $result['error'] = '';
            $result['exec'] = true;
            
            $exes = oci_execute($stid);
            if (!$exes) { 
                $e = oci_error($stid);
                $result['error'] = $e['message'];//."<br />".htmlentities($e['sqltext']);
                $result['exec'] = false;
                $this->SetError($this->user['emp'], htmlentities($e['message']));
            }
                        
            oci_free_statement($stid);
            //oci_close($this->DB);            
            return $result;
        }
        
        public function Execute($sql)
        {
            if(empty($this->DB)){            
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            $exes = oci_execute($stid);
            if (!$exes) { 
                $e = oci_error($stid);
                $msg = $e['message'];
                
                if($this->user['emp'] == 1191){
                    $msg .= "<br /><br />$sql";
                }
                
                $this->SetError($this->user['emp'], $msg);
                return false;// htmlentities($e['message']);                                            
            }
            //oci_close($this->DB);
            return true;
        }     
        
        public function AddClob($sql, $param){
            if(empty($this->DB)){            
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            $clob = oci_new_descriptor($this->DB, OCI_D_LOB);  
            foreach($param as $k=>$v);          
            oci_bind_by_name($stid, ":$k", $clob, -1, OCI_B_CLOB);            
            oci_execute($stid, OCI_NO_AUTO_COMMIT);
            $clob->save($v);
            oci_commit($this->DB);
            
            /*
            $stid = oci_parse($this->DB, $sql);
            $clob = oci_new_descriptor($this->DB, OCI_D_LOB);  
            foreach($param as $k=>$v){
                if(strlen($v) > 500){
                    oci_bind_by_name($stid, ":$k", $clob, -1, OCI_B_CLOB);                        
                    oci_execute($stid, OCI_NO_AUTO_COMMIT);
                    $clob->save($v);
                }else{
                    oci_bind_by_name($stid, ':'.$k, $v);
                }
            }
            oci_commit($this->DB);
            */            
            return true;
        }    
        
        public function ClearParams()
        {
            $this->sql = '';
            $this->row = array();
            $this->bind_param = array();
            $this->message = '';
        }
        
        public function ExecuteReturn($sql, $res)
        {
            if(empty($this->DB)){            
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            $d = array();
            
            
            foreach($res as $k){
                if($res[$k] !== ''){
                    oci_bind_by_name($stid, ":".$k, $v);
                }
            }
            
            foreach($res as $k){
                oci_bind_by_name($stid, ":".$k, $d[$k], 5000);                
            }
            
            $exes = oci_execute($stid);
            
            if (!$exes) { 
                $e = oci_error($stid);
                $d['error'] = ALERTS::WarningMin(htmlentities($e['message'])."<br />".htmlentities($e['sqltext']));
                $d['message'] = $e['message'].'<br /><textarea class="form-control" rows="10" readonly>'.trim($e['sqltext']).'</textarea>';
                $d['exec'] = true;
                $this->SetError($this->user['emp'], htmlentities($e['message']));                
            }
            
            oci_free_statement($stid);
            //oci_close($this->DB);            
            return $d;
        }
        
        public function ExecReturn($sql, $res)
        {
            if(empty($this->DB)){
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            if(!is_array($res)){
                oci_bind_by_name($stid, $res, $result, 100000);    
            }else{
                foreach($res as $r){
                    oci_bind_by_name($stid, $res[$r], $result, 100000);
                }   
            }        
            $exes = oci_execute($stid);
            
            if (!$exes) { 
                $e = oci_error($stid);
                $result['error'] = ALERTS::WarningMin(htmlentities($e['message'])."<br />".htmlentities($e['sqltext']));
                $result['exec'] = true;
            }
                      
            oci_free_statement($stid);                        
            return $result;
        }
        
        public function ExecReturn3($sql, $res)
        {
            if(empty($this->DB)){
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            if(!is_array($res)){
                oci_bind_by_name($stid, $res, $result, 100000);    
            }else{
                if(count($res) > 0){                    
                    $result = array();
                    foreach($res as $r){                        
                        $result[$r] = '';
                        oci_bind_by_name($stid, ':'.strtoupper($res[$r]), $result[$r], 10000);
                    }
                }
            }
            
            $exes = oci_execute($stid);             
            if (!$exes) {
                $e = oci_error($stid);
                $result['error'] = ALERTS::WarningMin(htmlentities($e['message'])."<br />".htmlentities($e['sqltext']));
                $result['exec'] = true;
            }
            
            oci_free_statement($stid);                        
            return $result;
        }
        
        public function ExecReturn2($sql, $res)
        {
            if(empty($this->DB)){
                $this->Connect();    
            }
            
            $stid = oci_parse($this->DB, $sql);
            $blob=oci_new_descriptor($this->DB, OCI_DTYPE_LOB);
            
            oci_bind_by_name($stid, ':'.strtoupper($res), $blob, -1, OCI_B_CLOB);
            $exes = oci_execute($stid, OCI_NO_AUTO_COMMIT);            
            oci_commit($this->DB);
            
            if (!$exes) {
                $e = oci_error($stid);
                $result['error'] = ALERTS::WarningMin(htmlentities($e['message'])."<br />".htmlentities($e['sqltext']));
                $result['exec'] = true;                            
            }            
            $result = $blob->load();                        
            $blob->free();
            oci_free_statement($stid);                                   
            return $result;
        }
        
        private function SetError($id_user, $text)
        {
            $sql = "INSERT INTO ERROR_INSUR (EMP_ID, ERROR_TEXT, DATE_ADD) VALUES ('$id_user', :ERROR_TEXT, sysdate)";            
            $param['ERROR_TEXT'] = $text;
            $this->message = $text;
            $this->AddClob($sql, $param);
        }
        
        public function ReplaceKZ_to_num($text)
        {            
            $this->message = '';
            $this->ClearParams();
            if(empty($this->DB)){            
                $this->Connect();
            }
            
            $q = oci_parse($this->DB, "ALTER SESSION SET NLS_DATE_FORMAT='dd.mm.yyyy'");
            oci_execute($q);
            
            $query = oci_parse($this->DB, "select * from KZ_BUKV");            
            if(!oci_execute($query)){
                $e = oci_error($query);
                $this->message = htmlentities($e['message'])."\n<pre>\n".htmlentities($e['sqltext']).printf("\n%".($e['offset']+1)."s", "^")."\n</pre>\n";                
                return $text;
            }
            
            $rs = array();
            while($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS+OCI_RETURN_LOBS))
            {
                $dan = array();                
                foreach($row as $k=>$v){
                    $dan[$k] = str_replace_kaz($v);
                }
                $rs[] = $dan;
            }
            
            
            $txt = $text;            
            foreach($rs as $k=>$v){
                $txt = str_replace($v['KZ'], '{%'.$v['ID'].'%}', $txt);
            } 
            return $txt;
        }
        /*
        public function __destruct()
        {
            oci_close($this->DB);
        }
        */
	}