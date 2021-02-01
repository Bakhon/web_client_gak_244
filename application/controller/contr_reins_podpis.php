<?php
    class REINS_PODPIS
    {
        private $db;
        public $result;
        
        public function __construct()
        {
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            if(method_exists($this, $method)){
                $this->$method();
            }                        
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
            
            $this->ajax();
        }
        
        private function POST()
        {            
            if(count($_POST) > 0){                
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($_POST);
                    }
                }
            }
            
            $this->ajax();
            $this->GET();
        }
        
        private function ajax()
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    echo json_encode($this->result);
                    exit;
                }
            }
        }
        
        private function edit_podpisant($dan)
        {            
            $id = $dan['edit_podpisant'];
            if($id == 0){
                $ds = array(
                    "ID"=>"0",
                    "ID_REINS"=>"0",
                    "DATE_BEGIN"=>"",
                    "DATE_END"=>"",
                    "FIO"=>"",
                    "OSNOV_TYPE"=>"Доверенности",
                    "OSNOV_NUM"=>"",
                    "OSNOV_DATE"=>"",
                    "DOLGNOST"=>"",
                    "FIO_RUK"=>""
                );
            }else{
                $q = $this->db->Select("select * from BORDERO_PODPIS where id = $id");
                $ds = $q[0];
                $ds['DATE_BEGIN'] = date("Y-m-d", strtotime($ds['DATE_BEGIN']));
                $ds['DATE_END'] = date("Y-m-d", strtotime($ds['DATE_END']));
                $ds['OSNOV_DATE'] = date("Y-m-d", strtotime($ds['OSNOV_DATE']));
            }           
            echo json_encode($ds);
            exit;
        }
        
        private function index()
        {
            $q = $this->db->Select("select b.*, case when b.id_reins = 0 then 'ГАК' else reins_name(b.id_reins) end reinsname 
            from BORDERO_PODPIS b order by date_begin");
            
            $this->result['list'] = $q;
            $this->result['list_reins'] = $this->db->Select("select id, r_name name from dic_reinsurance order by 2");            
        }
        
        private function save_podpisant($dan)
        {
            $id = $dan['id'];
            $dolgnost = $dan['dolgnost'];
            $fio_ruk = $dan['fio_ruk'];
            $id_reins = $dan['reins_company'];
            $fio = $dan['fio'];
            
            $date_begin = 'null';
            if($dan['date_begin'] !== ''){
                $ds = date("d.m.Y", strtotime($dan['date_begin']));
                $date_begin = "to_date('$ds', 'dd.mm.yyyy')";                 
            } 
            
            $date_end = 'null';
            if($dan['date_end'] !== ''){
                $ds = date("d.m.Y", strtotime($dan['date_end']));
                $date_end  = "to_date('$ds', 'dd.mm.yyyy')";                 
            }
            
            $reins_osn_date = 'null';
            if($dan['reins_osn_date'] !== ''){
                $ds = date("d.m.Y", strtotime($dan['reins_osn_date']));
                $reins_osn_date = "to_date('$ds', 'dd.mm.yyyy')";
            }
            
            $reins_osn_type = $dan['reins_osn_type'];
            $reins_osn_num = $dan['reins_osn_num'];
            
            if($id == "0"){
                $sql = "INSERT INTO BORDERO_PODPIS (
                ID_REINS, 
                DATE_BEGIN, 
                DATE_END, 
                FIO, 
                OSNOV_TYPE, OSNOV_NUM, 
                OSNOV_DATE, DOLGNOST, FIO_RUK) 
                VALUES (
                '$id_reins', $date_begin, $date_end, '$fio', '$reins_osn_type', '$reins_osn_num', 
                $reins_osn_date, '$dolgnost', '$fio_ruk')";
            }else{
                $sql = "UPDATE BORDERO_PODPIS
                SET    
                       ID_REINS   = '$id_reins',
                       DATE_BEGIN = $date_begin,
                       DATE_END   = $date_end,
                       FIO        = '$fio',
                       OSNOV_TYPE = '$reins_osn_type',
                       OSNOV_NUM  = '$reins_osn_num',
                       OSNOV_DATE = $reins_osn_date,
                       DOLGNOST   = '$dolgnost',
                       FIO_RUK    = '$fio_ruk'
                where ID         = $id";
            }
            
            if(!$this->db->Execute($sql)){                
                $this->result['error'] = $this->db->message;
                return false;
            }
            header("Location: reins_podpis");            
        }
        
        private function del_podpis($dan)
        {
            $id = $dan['del_podpis'];
            
            $s = $this->db->Execute("update BORDERO_PODPIS set DATE_END = null where id = (select max(id) from BORDERO_PODPIS where id < $id)");
            if($s !== true){
                $this->result['error'] = $s;
                return false;
            }
            
            $s = $this->db->Execute("delete from BORDERO_PODPIS WHERE ID = $id");
            if($s !== true){
                $this->result['error'] = $s;
                return false;
            }
                        
            $this->result['error'] = null;
        }
    }
    
    $podpis = new REINS_PODPIS();
    $dan = $podpis->result;
    
	array_push($js_loader,        
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
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_pa.js'
                
        );        
    
    array_push($css_loader, 
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