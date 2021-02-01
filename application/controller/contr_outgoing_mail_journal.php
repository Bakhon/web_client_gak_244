<?php
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
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
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
    
    class OUTGOING_JOURNAL{
        
        private $db;
        public $list = array();
        
        public function __construct()
        {
            $this->db = new DB();
            
            
            $method = $_SERVER['REQUEST_METHOD'];
            if(method_exists($this, $method)){
                $this->$method();
            }
        }
        
        private function GET()
        {            
            if(count($_GET) <= 0){
                $this->main();
            }else{
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($_GET);
                    }
                }
            }
            $this->ajax();
        }
        
        private function POST()
        {
            foreach($_POST as $k=>$v){
                if(method_exists($this, $k)){
                    $this->$k($_POST);
                }
            }
            
            $this->ajax();
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
        
        public function main()
        {
            $q = $this->db->select("select * from dic_department");
            $this->list['dep'] = $q;  
        }
        
        private function show_journal(){
            $timesheet_date_start = $_POST['timesheet_date_start'];
            $timesheet_date_end = $_POST['timesheet_date_end'];
            $dep_id_for_table = $_POST['dep_id_for_table'];
            
            if(isset($_POST['dep_id_for_table']) and $_POST['dep_id_for_table'] != '')
            {
            $dep_id_for_table = $_POST['dep_id_for_table'];
            $sql = "
            select d.*, s.email, job_sp_name(s.job_sp) depname, DS.POST_DATE, DS.POST_TIME from documents d, sup_person s, DOC_RECIEPMENTS_SIGNATURE ds  where type = 1 and 
            d.SENDER_MAIL != 'd.nurkeibekova@gak.kz' and 
            d.date_start >= '$timesheet_date_start' and 
            d.date_end <= '$timesheet_date_end' and d.sender_mail = s.email and s.job_sp = $dep_id_for_table and d.id = DS.MAIL_ID and ds.post_date is not null order by d.id desc
                ";
            }else{
            $sql = "select d.*, job_sp_name(s.job_sp) depname, DS.POST_DATE, DS.POST_TIME  from documents d, sup_person s, DOC_RECIEPMENTS_SIGNATURE ds where type = 1 and 
            d.SENDER_MAIL != 'd.nurkeibekova@gak.kz' and 
            d.date_start >= '$timesheet_date_start' and 
            d.date_end <= '$timesheet_date_end' and d.sender_mail = s.email and d.id = DS.MAIL_ID and ds.post_date is not null order by d.id desc";
            }
            
            $this->list['journal'] = $this->db->select($sql);
            $this->main();
        }
        
        public function dep_name($dep_id)
        {
            if($dep_id != '')
           {
            $sql = $this->db->select("select id, name from dic_department where id = $dep_id");
            return $sql;
            }
        }
        
    }
    
    $outgoing_j = new OUTGOING_JOURNAL();
    $dan = $outgoing_j->list;
    $title = 'Журнал регистрации исходящей корреспонденции';
    // $dep = $_POST['dep_id_for_table'];
    if(isset($_POST['dep_id_for_table'])) {
    $dep = $_POST['dep_id_for_table'];
    $dep_named = $outgoing_j->dep_name($dep);
    }else{ 
        $dep_named[0] = array('NAME' => 'ВСЕ');
    }
    
    
    ?>