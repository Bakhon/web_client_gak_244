<?php
	class REINS_NS
    {
        private $db;        
        private $array;
        
        public $dan = array();
        public $page;
        public $title = '';
        private $filter = '';
        private $alert;
        
        public function __construct()
        {
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];                           
            $this->$method();  
            $this->alert = new ALERTS();
        }
        
        private function GET()
        {
            if(count($_GET) <= 0){
                $this->init();                
            }else{            
                foreach($_GET as $k=>$v){
                    $this->$k($v);
                }
            }                        
        }
        
        private function POST()
        {
            if(count($_POST) <= 0){
                $this->dan = array();
            }else{                
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->array = $_POST;
                        $this->$k($v); 
                    }
                }
            }
            
            $this->onAjax();
        }
        
        private function onAjax()
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    header('Content-Type: application/json');
                    echo json_encode($this->dan);
                    exit;
                }   
            }
        }
        
        private function init()
        {
            $this->page = 'main';
            $filter = '';            
            if($this->filter !== ''){
                $filter = 'where '.$this->filter;
            }
            $sql = "SELECT * FROM REINS_DEB_NS $filter order by date_deb";
            //echo $sql;
            
            $this->dan['filter_1'] = $this->db->Select("SELECT sicid id, fio name FROM REINS_DEB_NS group by sicid, fio order by 2");
            $this->dan['filter_2'] = $this->db->Select("SELECT id_insur id, strahovatel name FROM REINS_DEB_NS group by id_insur, strahovatel order by 2");
            
            $this->dan['list'] = $this->db->select($sql);
        }
        
        private function sicid($id)
        {
            $this->filter = 'sicid = '.$id;
            $this->init();
        }
        
        private function id_insur($id)
        {
            $this->filter = 'id_insur = '.$id;
            $this->init();
        }
        
        private function set_kvitov_ns($id)
        {
            $mhmh = $this->array['mhmh'];
            exit;
        }
        
        private function search_plat_kvit()
        {            
            $sql_type = 'p_type in(1, 3)';
            if(isset($_POST['tmst_id'])){
                $sql_type = 'tmst_id = '.$_POST['tmst_id'];
                unset($_POST['tmst_id']);
            }
            
            $sql = "
            select  bank_name_plat(mfo_pbank) p_bank, bank_name_plat(mfo_rbank) r_bank, pd.*  
            from gak_pay_doc pd  
            where $sql_type 
            ";
            //echo $sql;
            $b = false;
            foreach($_POST as $k=>$v){
                if(trim($v) !== ''){
                    $b = true;
                }
            }
            
            if($b == false){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            if($_POST['date_begin'] !== ''){
                if($_POST['date_end'] !== ''){
                    $sql .= " and pd.doc_DATE BETWEEN to_date('".$_POST['date_begin']."', 'dd.mm.yyyy') AND to_date('".$_POST['date_end']."', 'dd.mm.yyyy') ";
                }
            }
            
            if($_POST['pay_sum'] !== ''){
                $sql .= " and pd.pay_sum = '".$_POST['pay_sum']."'";
            }
            
            if($_POST['bin'] !== ''){
                $sql .= " and pd.p_bin like '%".$_POST['bin']."%'";
            }
            
            if(isset($_POST['skvit'])){
                if($_POST['skvit'] !== ''){
                    if($_POST['skvit'] == '1'){
                        $sql .= " and SKVIT is null";
                    }else{
                        $sql .= " and SKVIT is not null";
                    }
                }
            }
            
            if(isset($_POST['doc_nmb'])){
                if($_POST['doc_nmb'] !== ''){
                    $sql .= " and doc_nmb like '%".$_POST['doc_nmb']."%'";
                }
            }
            //echo $sql;
            $q = $this->db->Select($sql);            
            if(count($q) <= 0){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            echo '            
            <table class="table table-bordered" id="table_kvit">
            <thead>
                <tr>
                    <th>Выбор</th>
                    <th>№ плат. поруч.</th>
                    <th>Дата плат.</th>
                    <th>Сумма</th>                    
                    <th>Сумма взятия в доход</th>
                    <th>Отправитель</th>
                    <th>РНН отправителя</th>
                    <th>Банк</th>
                    <th>Назначение платежа</th>
                </tr>
            </thead>
            <tbody>';
            foreach($q as $k=>$v){
                echo '<tr>
                    <td>
                        <input type="checkbox" class="set_kvit_check" id="'.$v['MHMH_ID'].'" data="'.$v['PAY_SUM'].'">                                                
                    </td>
                    <td>'.$v['DOC_NMB'].'</td>
                    <td>'.$v['DOC_DATE'].'</td>
                    <td><b>'.$v['PAY_SUM'].'</b></td>
                    <td id="cn_'.$v['MHMH_ID'].'"><b>'.$v['PAY_SUM'].'</b></td>
                    <td>'.htmlspecialchars($v['P_NAME']).'</td>
                    <td>'.$v['R_IIK'].'</td>
                    <td>'.htmlspecialchars($v['P_BANK']).'</td>
                    <td>'.htmlspecialchars($v['DOC_ASSIGN']).'</td>
                </tr>';
            }
            echo '</tbody></table>';                        
            //echo $sql;
            exit;
        }
        
        public function save_kvit($id)
        {
            //print_r($_POST);
            //exit;
            $mh = $this->array['edit_kvit'];
            $date_dohod = $this->array['date_dohod_kvit'];
            
            $q = $this->db->Select("select * from REINS_DEB_NACH where id = $id");
            $id_ns = $q[0]['ID_NS'];
            $sql = '';
            $pay_sum = 0;
            foreach($mh as $k=>$v){
                $sql .= "INSERT INTO REINS_DEB_POG (ID, ID_NACH, ID_NS, SUM_DEB, DATE_DOHOD, OTPRAV, MHMH_ID) 
                VALUES (REINS_DEB_POG_SEQ.nextval, $id, '$id_ns', $v, to_date('$date_dohod', 'dd.mm.yyyy'), 0, '$k');
                ";    
            }
            
            $sql .= "update 
                REINS_DEB_NACH 
                set state = 2,
                sum_pog = (select sum(sum_deb) from REINS_DEB_POG where id_nach = $id) 
                where id = $id;
            ";
            
            $this->db->Execute("begin $sql end;");
            unset($_POST);
            header("Refresh:0");
            exit;
        }
        
        public function save_raschet($id)
        {
            $sum = $_POST['raschet_pay_sum'];
            $sql = "update REINS_DEB_NACH set sum_deb = $sum where id = $id";
            
            if(!$this->db->Execute($sql)){
                global $msg;
                $msg = $this->alert->ErrorMin($this->db->message);
                $this->init();
                return false;                
            }
            
            header("Refresh:0");
            exit;
        }
        
        public function save_kvit_1c($id)
        {
            $ed = $_POST['edit_kvit'];
            foreach($ed as $k=>$v);
            
            $sql = "update REINS_DEB_NACH set state = 1, mhmh_id = $k, rasp_id = 9 where id = $id";
            if(!$this->db->Execute($sql)){
                global $msg;
                $msg = $this->alert->ErrorMin($this->db->message);
            }                        
            unset($_POST);
            header("Refresh:0");
            exit;
        }
        
        /**
         * 
        */
        public function dic_files($id_type)
        {
            $q = $this->db->Select("select * from BORDERO_TYPE_FILES where id_type = $id_type");
            return $q;
        }
        
        public function contract_files($id)
        {
            $type_file = 1;
            $ps = $this->db->Select("SELECT * FROM REINS_DEB_NS where id = $id");
            if($ps[0]['PRICHINA'] == 'Смерть'){
                $type_file = 2;
            }
            
            $q = $this->dic_files($type_file);
            
            foreach($q as $k=>$v){
                $q[$k]['list_files'] = $this->db->Select("select * from REINS_DEB_FILES where id_type = ".$v['ID']." and id_ns = $id");                
            }
            header('Content-Type: application/json');
            echo json_encode($q);
            exit;
        }
        
        private function set_file($id_contract, $id_type)
        {            
            if(!isset($_FILES['upload'])){
                return false;
            }
                                    
            $files = $_FILES['upload'];
            $path = 'reinsurance/reins_ns_'.$id_contract;
            
            $uploaddir = '/upload/';
            $uploadfile = $uploaddir . basename(iconv('utf-8', 'windows-1251', $files['name']));            
            
            $ch = chmod($uploaddir, 777);
            var_dump($ch);
             
            $s = move_uploaded_file($files['tmp_name'], $uploadfile);
            var_dump($s);
            exit;
            
            if (move_uploaded_file($files['tmp_name'], $uploadfile)) {
                $localfile = $uploadfile;                                                
            } else {                  
                $msg = $this->alert->ErrorMin('Ошибка загрузки файла');
                return false;
            }
            
            
            
            
            $ftp = new FTP();
            $filename = $files['name'];
            
            
            if(!$ftp->check_path($path)){
                $ftp->create_path($path);
            }
            $fs = $ftp->uploadfile2($path.'/', $filename, $localfile);
            unlink($localfile);
            
            $sql = "INSERT INTO REINS_DEB_FILES (ID_NS, FILENAME, DATE_SET, ID_TYPE) 
            VALUES ($id_contract, '$fs', sysdate, $id_type)";
            $this->db->Execute($sql);
            exit;
        }
        
        public function set_new_contract_file($id)
        {
            error_reporting(E_ALL);
            $this->set_file($_POST['contract_file_id'], $id);            
            //header("Location: ".$_SERVER['REQUEST_URI']);
        }
        
        public function delete_file($id)
        {
            $q = $this->db->Select("select * from REINS_DEB_FILES where id = $id");
            $filename = $q[0]['FILENAME'];
            $ftp = new FTP();
            $b = $ftp->deleteFile($filename);
            if($b){
                $this->db->Execute("delete from REINS_DEB_FILES where id = $id");
            }
            $this->contract_files($q[0]['ID_CONTRACTS']);
        }
        
        private function reins_soglasen($id)
        {
            global $msg;
            $sql = "begin bordero.ReinsSogl($id); end;";
            if(!$this->db->Execute($sql)){
                $msg = $this->alert->ErrorMin($this->db->message);
                $this->init();
                return false;                
            }else{
                header("Location: reins_ns");
            }
        }
        
        private function print_mail($id)
        {
            $dan = array();            
            $q = $this->db->Select("select r.*, tlsc.money_word(r.sum_deb) sum_deb_text from REINS_DEB_NS r where r.id = $id");            
            $dan['main'] = $q[0];
            
            $q = $this->db->Select("select fio, bordero.komy(fio_ruk) komy, bordero.gospod(fio_ruk) gospod from BORDERO_PODPIS where 
            id_reins = (select id_reins from REINS_DEB_NACH where id = $id)
            and date_begin <= sysdate and (date_end >= sysdate or date_end is null)");
                        
            if(count($q) <= 0){
                $q = $this->db->Select("select dir_dolgnost fio, bordero.komy(dir_name) fio_ruk, bordero.gospod(dir_name) gospod from dic_reinsurance where id =  (select id_reins from REINS_DEB_NACH where id = $id)");
            }
            $dan['podpis'] = $q[0];
            
            $q = $this->db->Select("select pay_sum_v, pay_sum_p, tlsc.money_word(pay_sum_v) pay_sum_v_rus, tlsc.money_word(pay_sum_p) pay_sum_p_rus 
            from contracts where cnct_id = (select cnct_id from REINS_DEB_NACH where id = $id)");
            $dan['contract'] = $q[0];
            
            
            $q = $this->db->Select("select * from clients where sicid = ".$dan['main']['SICID']);
            $dan['client'] = $q[0];
                        
            $q = $this->db->Select("select * from BORDERO_PODPIS where 
            id_reins = 0 and date_begin <= sysdate and (date_end >= sysdate or date_end is null) order by id desc");
            $dan['podpis_gak'] = $q[0];
                        
            require_once VIEWS."reins_ns/print_mail.php";
            
            $sql = "update REINS_DEB_NACH set date_otpr_reins = sysdate where id = $id";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
                echo $this->alert->ErrorMin($this->db->message);
            }
            exit;
        }
        
        private function downloadfile($id)
        {
            $q = $this->db->Select("select * from REINS_DEB_FILES where id = $id");
            $link_filename = $q[0]['FILENAME'];
            $f = downloadftp(FTP_SERVER, FTP_USER, FTP_PASS, $link_filename);
            if($f == false){
                global $msg;
                $msg = $this->alert->ErrorMin('Файл не найден<br />'.$link_filename);
                $this->init();
            }            
        }
    }
    
    $title = 'Уведомления об НС для перестрахования';
    $reins = new REINS_NS();    
    
    array_push($js_loader, 
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',        
        'styles/js/demo/reinsurance.js'        
    );
        
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css'        
    );        
        
    array_push($js_loader, 'styles/js/plugins/daterangepicker/daterangepicker.js','styles/js/plugins/datapicker/bootstrap-datepicker.js');
    array_push($css_loader, 'styles/css/plugins/datapicker/datepicker3.css', 'styles/css/plugins/daterangepicker/daterangepicker-bs3.css');
                
    $othersJs = "<script>$('.input-group.date').datepicker({
        todayBtn: 'linked',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });</script>";