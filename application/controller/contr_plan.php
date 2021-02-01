<?php
	class PLAN
    {
        private $db;        
        public $result;
        public $on_edit = false;  
        private $status = 0;
        private $onme = false;
              
        private $dir_files = 'plan';
        
        public function __construct()
        {            
            $this->db = new DB3();
            
            if(count($_REQUEST) <= 0){
                $this->index();
            }else{                
                foreach($_REQUEST as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
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
        
        
        public function index()
        {
            $user = $this->user_dan();
            $id_dep = $user['JOB_SP'];
            $id_user = $user['ID'];
            
            if($user['ONEDIT'] == 1){$this->on_edit = true;}
            
            $sql = " select p.*, plan_state_name(p.state) state_name, (select default_name from plan_files where id = id_file) filename,
            (select count(*) from PLAN_USER_EXAMPLE where id_plan = p.id and id_user = $id_user) onex         
            from plan p ";
            if($this->status > 0){
                $sql .= " where p.state = $this->status";
            }
            
            if($this->onme){
                $sql .= " where p.id in(
                    select id_plan from PLAN_USER_EXAMPLE where id_user = $id_user
                )";
            }
            $sql .= "order by num_pp";
         
            $db = new DB();
            
            $q = $this->db->Select($sql);
            foreach($q as $k=>$v){
                $d = $this->db->Select("select dd.* from dic_department@DB_SUP dd, PLAN_DEP p where p.id_dep = dd.id and p.id_plan = ".$v['ID']);
                $u = $db->Select("select s.id, s.lastname||' '||s.firstname fio from sup_person s, PLAN_USER_EXAMPLE@DB_INSUR p where p.id_user = s.id and p.id_plan = ".$v['ID']);
                $q[$k]['DEPS'] = $d;
                $q[$k]['USERS'] = $u;
            }
            
            $this->result['list'] = $q;
            $this->result['users'] = $this->list_users($id_dep);
            $this->result['dep'] = $this->db->Select("select * from dic_department@DB_SUP order by id");
            $this->result['states'] = $this->db->Select("select * from plan_state order by id");
            
            $ps = $this->db->Select("select nvl(max(num_pp), 0)+1 pp from plan");
            $this->result['num_pp_next'] = $ps[0]['PP'];
        }
        
        private function plan_dan($id)
        {
            $sql = " select p.*, plan_state_name(p.state) state_name, (select default_name from plan_files where id = id_file) filename                     
            from plan p where id = $id";
            $q = $this->db->Select($sql);
            $dan['plan'] = $q[0];
            
            $q = $this->db->Select("select * from PLAN_DEP where id_plan = $id");
            $dan['deps'] = $q;
            
            $q = $this->db->Select("select * from PLAN_USER_EXAMPLE where id_plan = $id");
            $dan['users'] = $q;
            
            echo json_encode($dan);
            exit;
        }
        
        private function step_top($id)
        {
            $q = $this->db->Select("select * from plan where id = $id");   
            $num_pp_act = $q[0]['NUM_PP'];
            $num_pp_top = $num_pp_act-1;
            $q = $this->db->Select("select id from plan where num_pp = $num_pp_top");
            $ids = $q[0]['ID'];
            
            $sql = "
            declare 
                its number;
            begin
                update plan set num_pp = $num_pp_top where id = $id;
                update plan set num_pp = $num_pp_act where id = $ids;
                
                its:= 1;
                for i in(
                    select * from plan order by num_pp
                )loop
                    update plan set num_pp = its where id = i.id;
                    its:= its+1;
                end loop;
            end;
            ";
            $this->db->Execute($sql);
            
            $this->index();
            $onedit = $this->on_edit;
            $list = $this->result['list'];            
            require_once '/application/views/plan/table.php';
            exit;
        }
        
        private function step_bottom($id)
        {            
            $q = $this->db->Select("select * from plan where id = $id");   
            $num_pp_act = $q[0]['NUM_PP'];
            $num_pp_top = $num_pp_act+1;
            $q = $this->db->Select("select id from plan where num_pp = $num_pp_top");
            $ids = $q[0]['ID'];
            
            $sql = "
            declare 
              its number;
            begin
              update plan set num_pp = $num_pp_top where id = $id;
              update plan set num_pp = $num_pp_act where id = $ids;
              its:= 1;
              for i in(
                select * from plan order by num_pp
              )loop
                update plan set num_pp = its where id = i.id;
                its:= its+1;
              end loop;
                        
            end;
            ";
            $this->db->Execute($sql);
            
            $this->index();
            $onedit = $this->on_edit;
            $list = $this->result['list'];
            require_once '/application/views/plan/table.php';
            exit;
        }
        
        private function save($id)
        {
            $q = $this->user_dan();            
            $id_dep = $q['JOB_SP'];            
            $name = htmlspecialchars($_POST['name']);
            if($_POST['date_plan'] == ''){
                $date_plan = 'null';
            }else{
                $ds = date('d.m.Y', strtotime($_POST['date_plan']));
                $date_plan = "to_date('$ds', 'dd.mm.yyyy')";    
            }
            
            $plan_out = 0;
            if(isset($_POST['plan_out'])){
                $plan_out = 1;
            }
            
            $id_file = 'null';            
            if(isset($_FILES['tz'])){
                $id_file = $this->load_file($_FILES['tz']);
                if($id_file == false){
                    $id_file = 'null';
                }
            }
            
            $num_pp = $_POST['num_pp'];
            
            $sql = "
            declare 
              id number;
              cnt number;
              its number;
            begin
            id:= PLAN_SEQ.nextval;
            select count(*) into cnt from plan where NUM_PP = $num_pp;
            if cnt > 0 then
              its:= $num_pp+1;
              for i in(
                select * from plan where num_pp >= $num_pp order by num_pp
              )loop
                update plan set num_pp = its where id = i.id;
                its:= its+1;
              end loop;
            end if;
            INSERT INTO PLAN (ID, NAME, DATE_SET, ID_DEP_SET, ID_FILE, STATE, NUM_PP, DATE_PLAN, PLAN_OUT) 
            VALUES (id, '$name', sysdate, $id_dep, $id_file, 1, $num_pp, $date_plan, $plan_out);
            ";
            
            foreach($_POST['dep'] as $k=>$v){
                $sql .= "INSERT INTO PLAN_DEP (ID_PLAN, ID_DEP) VALUES (id, $v);
                ";
            }
            foreach($_POST['users'] as $k=>$v){
                $sql .= "INSERT INTO PLAN_USER_EXAMPLE (ID_PLAN, ID_USER) VALUES (id, $v);
                ";
            }
            
            if(floatval($id) > 0){
                $q = $this->db->Select("select * from plan where id = $id");
                $q = $q[0];
                if($q['ID_FILE'] !== ''){
                    if($id_file !== 'null'){
                        $id_file = $q['ID_FILE'];
                    }
                }
                
                $sql = "
                declare
                    cnt number;
                    its number;            
                begin                    
                    insert into plan_arc select * from plan where id = $id;
                    
                    select count(*) into cnt from plan where NUM_PP = $num_pp;
                    if cnt > 0 then
                      its:= $num_pp+1;
                      for i in(
                        select * from plan where num_pp >= $num_pp order by num_pp
                      )loop
                        update plan set num_pp = its where id = i.id;
                        its:= its+1;
                      end loop;
                    end if;
                    
                    update plan set NAME = '$name', NUM_PP = $num_pp, ID_FILE = $id_file, DATE_PLAN = $date_plan, PLAN_OUT = $plan_out where id = $id;
                    delete from PLAN_DEP where ID_PLAN = $id;
                    delete from PLAN_USER_EXAMPLE where ID_PLAN = $id;
                ";
                
                foreach($_POST['dep'] as $k=>$v){
                    $sql .= "INSERT INTO PLAN_DEP (ID_PLAN, ID_DEP) VALUES ($id, $v);
                    ";
                }
                foreach($_POST['users'] as $k=>$v){
                    $sql .= "INSERT INTO PLAN_USER_EXAMPLE (ID_PLAN, ID_USER) VALUES ($id, $v);
                    ";
                }
            }
            
            
            $sql .= "
            commit;
            end;";
                        
            //echo '<pre>'.$sql;exit;
                                    
            if(!$this->db->Execute($sql)){
                echo $sql;
                exit;
            }                        
            header("Location: plan");
        }
        
        private function load_file($f)
        {
            $name = $f['name'];
            $def_name = $f['name'];
            $type = $f['type'];
            $size = $f['size'];
                    
            $tmp = $f['tmp_name'];
            
            $ps = explode('.', $name);
            $i = count($ps)-1;
            $rs = $ps[$i];
            
            $name = date("YmdHis").'.'.$rs;
            
            $uploaddir = '\\\192.168.5.2\insurance_life_files\plan\\';         
            $uploadfile = $uploaddir . $name;                        
            
            if(move_uploaded_file($tmp, $uploadfile)){
                $sql = "INSERT INTO PLAN_FILES (FILE_TYPE, FILE_SIZE, FILE_NAME, DEFAULT_NAME) VALUES ('$type', '$size', '$name', '$def_name')";
                if($this->db->Execute($sql)){
                    $q = $this->db->Select("select max(id) id from PLAN_FILES");
                    return $q[0]['ID'];
                }else{
                    return false;
                }
            }else{                
                return false;
            } 
        }
        
        private function user_dan()
        {
            $email = $_SESSION[USER_SESSION]['login'].'@gak.kz';
            $db = new DB();            
            $q = $db->Select("select ID, LASTNAME||' '||FIRSTNAME||' '||MIDDLENAME fio, (select name from DIC_DEPARTMENT where id = JOB_SP) dep,
            JOB_SP, job_position,
            case when JOB_SP in(11, 19) then 1 else 0 end onedit 
            from sup_person where email = '$email'");                                    
            return $q[0];
        }
        
        private function list_users($id_dep)
        {
            $db = new DB();            
            $q = $db->Select("select ID, LASTNAME||' '||FIRSTNAME||' '||MIDDLENAME fio, (select name from DIC_DEPARTMENT where id = JOB_SP) dep            
            from sup_person where state in(2, 3) and JOB_SP = $id_dep");                                    
            return $q;
        }
        
        private function state($id)
        {
            $this->status = $id;
            $this->index();
        }
        
        private function for_me()
        {
            $this->onme = true;
            $this->index();
        }
        
        private function set_isp($id)
        {
            $state = $_GET['state'];
            $sql = "begin
            insert into plan_arc select * from plan where id = $id;
            update plan set state = $state where id = $id;
            commit;
            end; 
            ";  
            //echo $sql; exit;                      
            $this->db->Execute($sql);
            header("Location: plan");
        }
        
        private function set_isp_last($id)
        {
            $note = htmlspecialchars($_POST['comment_example']);
            $date = $_POST['date_example'];
            $user = $this->user_dan();
            $id_user = $user['ID'];
            $sql = "begin
            insert into plan_arc select * from plan where id = $id;
            update plan set state = 4, id_user_example = '$id_user', date_example = to_date('$date', 'dd.mm.yyyy'), comment_example = '$note' where id = $id; 
            end;";
            $this->db->Execute($sql);
            header("Location: plan");
        }
        
        private function delete($id)
        {
            $sql = "
            declare 
              its number;
            begin
                insert into plan_arc select * from plan where id = $id;                
                delete from plan where id = $id;
                
                its:= 1;
                for i in(
                    select * from plan order by num_pp
                )loop
                    update plan set num_pp = its where id = i.id;
                    its:= its+1;
                end loop;
            end;
            ";
            $this->db->Execute($sql);
            header("Location: plan");
        }
        
        private function loadfile($id)
        {
            $q = $this->db->Select("select * from plan_files where id = $id");
            $q = $q[0];
            $conn_id = ftp_connect(FTP_SERVER);
            $login_result = ftp_login($conn_id, FTP_USER, FTP_PASS);
            if($login_result){
                ftp_pasv($conn_id, true);
            }else{
                echo 'Ошибка подключения';
                exit;
            }
            
            $local_file = $q['FILE_NAME'];
            
            $e = ftp_get($conn_id, $local_file, '/plan/'.$q['FILE_NAME'], FTP_BINARY);            
            if($e){
                header("Content-type: ".$q['FILE_TYPE']);
                header("Content-Disposition: attachment;Filename=".$q['FILE_NAME']);        
                header('Content-Length: ' . $q['FILE_SIZE']);
                        
                readfile($q['FILE_NAME']);                
            }else{
                echo '<center><h1>Файл не найден</h1></center>';
            }
            
            if(file_exists($q['FILE_NAME'])){
                unlink($q['FILE_NAME']);
            }
            exit;
        }
        
        private function print_plan()
        {
            $year = date('Y');
            if(isset($_GET['excel'])){
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="plan_'.$year.'.xls"');
            }
            
            $css = array(
            'styles/css/bootstrap.min.css',
            //'styles/css/plugins/dataTables/dataTables.bootstrap.css',
            //'styles/css/plugins/dataTables/dataTables.responsive.css',
            //'styles/css/plugins/dataTables/dataTables.tableTools.min.css'
            );
            echo '<!DOCTYPE html><html><head><meta charset="utf-8">';
            foreach($css as $s){
                echo '<link href="'.$s.'" rel="stylesheet">';
            }
            echo '<style>body {-webkit-print-color-adjust:exact;}</style>';
            echo '</head><body>';
            
            $this->index();
                                    
            echo '
            <center><h1>План автоматизации на '.$year.' год</h1></center>
            <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>№</th>
                    <th>Задание</th>                                
                    <th>Заказчик</th>                    
                    <th>Статус</th>
                    <th>Исполнитель</th>
                    <th>Срок выполнения</th>
                    <th>Фактическая дата выполнения</th>
                    <th>Комментарий</th>
                </tr>
            </thead>
            <tbody>';                                                                             
            foreach($this->result['list'] as $k=>$v){ 
                $n = $k+1;
                $cls = '';
                if($v['DATE_EXAMPLE'] <> ''){
                    $cls = 'class="success"';
                }
                echo '<tr '.$cls.'>
                    <td>'.$n.'</td>                                    
                    <td>'.$v['NAME'].'</td>
                    <td>';
                    foreach($v['DEPS'] as $dep){
                        echo $dep['NAME'].'<br />';
                    }                                        
                echo '</td><td>'.$v['STATE_NAME'].'</td>
                <td>';
                    foreach($v['USERS'] as $user){
                        echo $user['FIO'].'<br />';
                    }
                echo '</td>
                    <td>'.$v['DATE_PLAN'].'</td>
                    <td>'.$v['DATE_EXAMPLE'].'</td>
                    <td>'.$v['COMMENT_EXAMPLE'].'</td>                                
                </tr>';
            }
            echo '</tbody></table></body></html>';
            exit;
        }
        
        public function act($id)
        {
            $dan = array();
            $q = $this->db->Select("select p.*, TLSC.DATE2STR(p.date_example) date_text  from plan p where id = $id");
            $dan['plan'] = $q[0];
            
            $dan['pd'] = $this->db->Select("select 
    dd.name,
    substr(sp.firstname, 1, 1)||'. '||sp.lastname fio,
    dolzh_name@db_sup(sp.job_position) dolzhname,
    bordero.vlice(sp.lastname||' '||substr(sp.firstname, 1, 1)||'.'||substr(sp.middlename, 1, 1))fio_komy        
from 
    dic_department@DB_SUP dd,
    sup_person@DB_SUP sp,
    PLAN_DEP p 
where 
    p.id_dep = dd.id     
    and sp.state = 2
    and sp.job_sp = p.id_dep    
    and p.id_plan = $id    
    and sp.job_position = (select min(dd.id) from dic_dolzh@DB_SUP dd, sup_person@DB_SUP ssp where dd.id_department = ssp.job_sp and ssp.state = 2 and dd.id_department = p.id_dep)");
            
            require_once __DIR__.'/../views/plan/act.php';
            exit;
        }
        
        
  
        
                private function set_file($id_contract)
        {            
            if(!isset($_FILES['upload'])){
                return false;
            }
                        
            $files = $_FILES['upload'];
            $path = 'plan/plan_'.$id_contract;
            
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
            
            $sql = "INSERT INTO PLAN_FILES (FILE_TYPE, FILE_SIZE, FILE_NAME, DEFAULT_NAME, ID_PLAN, POST_DATE)
            VALUES ('', '', '$fs', '$filename', '$id_contract', sysdate)";
            
            $this->db->Execute($sql);
        }
        
              public function set_new_contract_file($id)
        {
            error_reporting(E_ALL);
            $this->set_file($_POST['contract_file_id']);            
            header("Location: ".$_SERVER['REQUEST_URI']);
        }
  
        
            public function contract_files($id)
        {
            
            $q['q']['list_files'] = $this->db->Select("select * from PLAN_FILES where ID_PLAN = $id");                
             
            $this->dan_array = $q;
            return $q;
        }
        
        
               public function delete_file($id)
        {
            $q = $this->db->Select("select * from PLAN_FILES where id = $id");
            $filename = $q[0]['FILE_NAME'];
            $ftp = new FTP();
            $b = $ftp->deleteFile($filename);
            if($b){
                $this->db->Execute("delete from PLAN_FILES where id = $id");
            }
            $this->contract_files($q[0]['ID_PLAN']);
        }
  
        
             private function downloadfile($id)
        {
            $q = $this->db->Select("select * from PLAN_FILES where ID = $id");
            $link_filename = $q[0]['FILE_NAME'];
            $f = downloadftp(FTP_SERVER, FTP_USER, FTP_PASS, $link_filename);
            if($f == false){
                global $msg;
                $msg = $this->alert->ErrorMin('Файл не найден<br />'.$link_filename);
                $this->index();
            }            
        }
        
        /**
         * POST запрос внесения файла
        */
     
        
        
    }
    
    $plan = new PLAN();
    
    array_push
    ($js_loader,
        'styles/js/inspinia.js',        
        'styles/js/plugins/pace/pace.min.js',
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/demo/plan.js'
    );

    array_push
    ($css_loader,
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css'
    );                    
?>