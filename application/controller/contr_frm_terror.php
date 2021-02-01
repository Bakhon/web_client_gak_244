<?php        
    array_push($js_loader,
        'styles/js/plugins/chosen/chosen.jquery.js',        
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
        'styles/js/others/jquery.printElement.js',
        'styles/js/demo/all.js'
    );        
    
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',        
        'styles/css/plugins/chosen/bootstrap-chosen.css',
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
    
    $page_title = 'Справочники';
    $panel_title = 'Справочник террористов';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник террористов'; 
  
    //Задаем первоначальные параметры SQL тескта
//require_once 'methods/Excel/PHPExcel.php';
//require_once 'methods/Excel/PHPExcel/IOFactory.php';     
  
class TERROR
{
    private $db;
    public $dan;
    public $active_tab = 1;
    public function __construct()
    {
        $this->db = new DB3();
        $method = $_SERVER['REQUEST_METHOD'];
        $this->$method();
    }
    
    private function GET()
    {        
        if(count($_GET) <= 0){
            $this->index();
        }else{
            foreach($_GET as $k=>$v){
                if(method_exists($this, $k)){
                    $this->$k($v);
                }
            }   
        }        
        
    }
    
    private function POST()
    {
        foreach($_POST as $k=>$v){
            if(method_exists($this, $k)){
                $this->$k($v);
            }
        }        
    }
    
    private function index()
    {
        $this->dan = $this->db->Select("select * from DIC_TERRORISTS_VID");
        foreach($this->dan as $k=>$v){
            $this->dan[$k]['list'] = $this->db->Select("select * from DIC_TERRORISTS where vid = ".$v['ID']);
        }                
        
        /*
        $sql = "
            SELECT d.*,
                CASE
                     WHEN d.sicid_annuit IS NULL THEN 'НЕТ'
                     ELSE 'ДА'
                   END db_clients,
                   CASE
                     WHEN d.vid = 1 THEN 'ЧЕЛОВЕК'
                     ELSE 'организация'
                   END vid_p
            FROM   dic_terrorists d where d.vid = 1
            ORDER  BY 2, 3  ";
       $this->dan['people'] = $this->db->Select($sql);              
       
       
       $sql = "
            SELECT d.*,
                CASE
                     WHEN d.sicid_annuit IS NULL THEN 'НЕТ'
                     ELSE 'ДА'
                   END db_clients,
                   CASE
                     WHEN d.vid = 1 THEN 'ЧЕЛОВЕК'
                     ELSE 'организация'
                   END vid_p
            FROM   dic_terrorists d where d.vid = 2
            ORDER  BY d.id  ";
       $this->dan['org'] = $this->db->Select($sql);
       */
    }
    
    
    private function upload_xls($d)
    {        
        $this->index();
        $this->active_tab = 1;
                
        $targetdir = 'upload/';
        $file_load = 'terror.xlsx';
                
        //$targetfile = $targetdir.$_FILES['load_xls']['name'];
        $targetfile = $targetdir.$file_load;
        $this->dan['xls'] = array();
        if (move_uploaded_file($_FILES['load_xls']['tmp_name'], $targetfile)) {            
            $sql = "begin terrorists.Load_terror_from_xls('$file_load'); end;";            
            $a = array("maxid", "msg");
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
            }else{
                $dan['xls'] = $this->db->Select("select * from DIC_TERRORISTS");                
            }
            //unlink($targetfile);
        }        
                
    }
    
    private function list_prov($dan)
    {             
        $dsp = array();
        foreach($dan as $k=>$v){
            $sql1 = "select count(*) cnt from DIC_TERRORISTS where ";
            $sql2 = " ";
            foreach($v as $i=>$t){
                if($i > 0){
                    $sql2 .= " and ";
                }
                $sql2 .= $t['cell']." = '".$t['text']."'";                
            }
            $sql = $sql1.$sql2;
            $q = $this->db->Select($sql);
            
            $dan[$k]['proverka'] = $q[0]['CNT'];
        }
        //print_r($dan);
        echo json_encode($dan);        
        exit;
    }
    
    private function set_terror($vid)
    {
        $dan = $_POST;
        $id = $_POST['set_terror_id'];
        
        unset($dan['set_terror']);
        unset($dan['set_terror_id']);
        
        if(isset($dan['birthday'])){
            $dan['birthday'] = date("d/m/Y", strtotime($dan['birthday']));
        }
        
        if($id == 0){
            $sql1 = "INSERT INTO DIC_TERRORISTS (ID, VID";
            $sql2 = " VALUES (SIQ_TERROR.Nextval, $vid";
            foreach($dan as $k=>$v){
                $sql1 .= ",$k";                
                $sql2.= $this->db->ReplaceKZ_to_num(",replace_kz('$v')");
            }
            $sql = $sql1.')'.$sql2.')';
            echo $sql;                                    
        }else{
            $sql = "begin 
            insert into DIC_TERRORISTS_HISTORY select * from DIC_TERRORISTS where id = $id;
            
            update DIC_TERRORISTS set VID = $vid";
            foreach($dan as $k=>$v){
                $sql .= ", $k = ".$this->db->ReplaceKZ_to_num("replace_kz('$v')");
            }
            $sql .= " where id = $id;
            end;";
            $id_t = $id;
        }
        
                
        if(!$this->db->Execute($sql)){
            echo $this->db->message;
            exit;
        }
        
        if($id == 0){
            $q = $this->db->Select("select max(id) id from DIC_TERRORISTS");
            $id_t = $q[0]['ID'];
        }
        
        if($vid == 1){
            $q = $this->db->Select("select terrorists.prov_terror_procent_fiz($id_t) pr from dual");
            echo 'Процент совпадения нахождения в БД Физических лиц<h3>'.$q[0]['PR'].' %</h3>';
        }
            
        if($vid == 2){
            $q = $this->db->Select("select terrorists.prov_terror_procent_ur($id_t) pr from dual");
            echo 'Процент совпадения нахождения в БД Юридических лиц<h3>'.$q[0]['PR'].' %</h3>';                
        }        
        exit;
    }
    
    private function get_dan($id)
    {
        $q = $this->db->Select("select * from DIC_TERRORISTS where id = $id");
        echo json_encode($q[0]);        
        exit;
    }
    
    private function del_terror($id)
    {
        $sql = "begin
        insert into DIC_TERRORISTS_HISTORY
        select * from DIC_TERRORISTS where id = $id;
        
        delete from DIC_TERRORISTS where id = $id;
        end;";
        
        if(!$this->db->Execute($sql)){
            echo $this->db->message;
        }
        
        exit;
    }
    
    private function set_type_terror_name($name)
    {
        global $msg;
        $type = $_POST['set_type_terror_type'];
        $id = $_POST['set_type_terror_id'];
        
        if(trim($name) == ''){
            $msg = 'Наименование типа террористов не может быть пустым!';
            return false;
        }
        
        $q = $this->db->Select("select * from DIC_TERRORISTS_VID where upper(name) = upper('$name')");
        if(count($q) > 0){
            $msg = 'Данный тип террористов имеется в БД!';
            return false;
        }
        
        
        if($id == '0'){
            $qs = $this->db->Select("select max(id)+1 ids from DIC_TERRORISTS_VID");
            $ids = $qs[0]['IDS'];
            $sql = "insert into DIC_TERRORISTS_VID(id, name, typ) values($ids, '$name', '$type')";
        }else{
            $sql = "update DIC_TERRORISTS_VID set name = '$name', typ = '$type' where id = $id";
        }
                
        if(!$this->db->Execute($sql)){
            $msg = $this->db->message;
            return false;
        }                
    }
    
    private function edit_type_terror($id)
    {
        $q = $this->db->Select("select * from DIC_TERRORISTS_VID where id = $id");
        echo json_encode($q[0]);
        exit;
    }
    
    private function set_xml($id)
    {
        $name = $_POST['set_xml_url'];
        $auth = $_POST['set_auth'];
        $sql = "update DIC_TERRORISTS_VID set url_xml = '$name', set_auth_saits = '$auth' where id = $id";
        if(!$this->db->Execute($sql)){
            echo $this->db->message;
        }
        exit;
    }
    
    private function set_xls($id)
    {
        $name = $_POST['set_xls_url'];
        $auth = $_POST['set_auth'];
        $sql = "update DIC_TERRORISTS_VID set url_xls = '$name', set_auth_saits = '$auth' where id = $id";
        if(!$this->db->Execute($sql)){
            echo $this->db->message;
        }
        exit;
    }
    
    private function auto_replace()
    {
        error_reporting(E_ALL);
        $login =  '';
        $pass = '';
        if(isset($_POST['login_auto'])){
            $login = $_POST['login_auto'];
        }
        
        if(isset($_POST['pass_auto'])){
            $pass = $_POST['pass_auto'];
        }
        
        $b = true;
        $q = $this->db->Select("select * from DIC_TERRORISTS_VID where url_xml is not null");
        foreach($q as $k=>$v){
            if($b == true){
                if($v['SET_AUTH_SAITS'] == '1'){
                    if($login == ''){
                        $b = false;
                    }
                }
            }
        }
        
        if($b == false){
            require_once 'application/views/frm_terror/modal_login.php';
            exit;
        }
                
        foreach($q as $k=>$v){
            $sn = $this->get_web_page($v['URL_XML']);
            echo '<pre>';
            print_r($sn);
            exit;
            
            if( $curl = curl_init($v['URL_XML'])) {
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HEADER, true);
                $out = curl_exec($curl);                
                curl_close($curl);
                
                if(!$out){
                    echo 'Ошибка интеграции XML запроса!';
                    exit;
                }
                                
                $dan = new SimpleXMLElement($out);
                $fiz = $dan->persons;
                $ur = $dan->organisations;
                $ur_sng = $dan->organisationscis;
                
                $this->db->Execute("delete from DIC_TERRORIST_LOAD");
                
                foreach($fiz->person as $t=>$f){
                   $lastname = '';
                   $firstname = '';
                   $middlename = '';
                   $birthdate = '';
                   $iin = '';
                   $note = '';
                   
                   $lastname = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->lname)."')");
                   $firstname = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->fname)."')");
                   $middlename = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->mname)."')");
                   $birthdate = $f->birthdate;
                   $iin = htmlspecialchars($f->iin);
                   $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
                   
                   $sql = "INSERT INTO DIC_TERRORIST_LOAD (LNAME, FNAME, MNAME, BIRTHDATE, IIN, NOTE, VID) 
                   VALUES ($lastname, $firstname, $middlename, '$birthdate', '$iin', $note, 1)";
                   
                   echo $sql;
                             
                   if(!$this->db->Execute($sql)){
                    echo $this->db->message;
                    exit;
                   }
                }
                
                foreach($ur->org as $t=>$f){
                    $org_name = '';
                    $note = '';
                    
                    $org_name = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name)."')");
                    $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
                    
                    $sql = "INSERT INTO DIC_TERRORIST_LOAD (ORG_NAME, NOTE, VID) VALUES ($org_name, $note, 2)";
                    if(!$this->db->Execute($sql)){
                        echo $this->db->message;
                        exit;
                    }
                }
                
                foreach($ur_sng->org as $t=>$f){
                    $org_name = '';
                    $org_name_en = '';
                    $note = '';
                    
                    $org_name = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name)."')");
                    $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
                    $org_name_en = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name_en)."')");
                    
                    $sql = "INSERT INTO DIC_TERRORIST_LOAD (ORG_NAME, ORG_NAME_EN, NOTE, VID) 
                    VALUES ($org_name, $org_name_en, $note, 3)";
                    if(!$this->db->Execute($sql)){
                        echo $this->db->message;
                        exit;
                    }
                }
                
                $qs = $this->db->Select("select * from DIC_TERRORIST_LOAD");
                echo '<pre>';
                print_r($qs);
                echo '</pre>';
                
            }else{
                echo 'Ошибка подключения к XML файлу!';
                exit;
            }
        }
                       
        exit;
    }
    
    private function parse_xml_from_kfm($out)
    {
        $dan = new SimpleXMLElement($out);
        $fiz = $dan->persons;
        $ur = $dan->organisations;
        $ur_sng = $dan->organisationscis;
        
        $this->db->Execute("delete from DIC_TERRORIST_LOAD");
        
        foreach($fiz->person as $t=>$f){
           $lastname = '';
           $firstname = '';
           $middlename = '';
           $birthdate = '';
           $iin = '';
           $note = '';
           
           $lastname = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->lname)."')");
           $firstname = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->fname)."')");
           $middlename = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->mname)."')");
           $birthdate = $f->birthdate;
           $iin = htmlspecialchars($f->iin);
           $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
           
           $sql = "INSERT INTO DIC_TERRORIST_LOAD (LNAME, FNAME, MNAME, BIRTHDATE, IIN, NOTE, VID) 
           VALUES ($lastname, $firstname, $middlename, '$birthdate', '$iin', $note, 1)";
           
           echo $sql;
                     
           if(!$this->db->Execute($sql)){
            echo $this->db->message;
            exit;
           }
        }
        
        foreach($ur->org as $t=>$f){
            $org_name = '';
            $note = '';
            
            $org_name = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name)."')");
            $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
            
            $sql = "INSERT INTO DIC_TERRORIST_LOAD (ORG_NAME, NOTE, VID) VALUES ($org_name, $note, 2)";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
                exit;
            }
        }
        
        foreach($ur_sng->org as $t=>$f){
            $org_name = '';
            $org_name_en = '';
            $note = '';
            
            $org_name = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name)."')");
            $note = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->note)."')");
            $org_name_en = $this->db->ReplaceKZ_to_num("replace_kz('".htmlspecialchars($f->org_name_en)."')");
            
            $sql = "INSERT INTO DIC_TERRORIST_LOAD (ORG_NAME, ORG_NAME_EN, NOTE, VID) 
            VALUES ($org_name, $org_name_en, $note, 3)";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
                exit;
            }
        }
        
        $qs = $this->db->Select("select * from DIC_TERRORIST_LOAD");
        echo '<pre>';
        print_r($qs);
        echo '</pre>';
    }
    
    private function get_web_page( $url )
    {
      $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";
    
      $ch = curl_init( $url );
    
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
      curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
      curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
      curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
      curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
    
      $content = curl_exec( $ch );
      $err     = curl_errno( $ch );
      $errmsg  = curl_error( $ch );
      $header  = curl_getinfo( $ch );
      curl_close( $ch );
    
      $header['errno']   = $err;
      $header['errmsg']  = $errmsg;
      $header['content'] = $content;
      return $header;
    }
}

$terror = new TERROR();
$dan = $terror->dan;
?>