<?php        
	class IPN
    {
        private $db;
        private $sql;
        public $dan;
        public $array = array();
        
        public function __construct()
        {
            $this->db = new DB3();  
            
            $method = $_REQUEST;
            if(count($method) > 0){
                $this->array = $method;
                foreach($method as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
                }
            }          
        }
        
        public function search()
        {            
            global $active_user_dan;
            $emp = $active_user_dan['emp'];
            $brid = substr($active_user_dan['brid'], 0, 2);
            if($emp == ''){$emp = 0;}
            $c = $this->array['contract_num'];
            $l = $this->array['lastname'];
            $f = $this->array['firstname'];
            $m = $this->array['middlename'];
            $sql = "select * from table(search_contracts.ipn('$c', '$l', '$f', '$m', '$brid', $emp))";            
            $this->dan = $this->db->Select($sql);
        }
                
    }
    
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
    
    $page_title = 'Договора';
    $panel_title = 'ИПН';
    
    $breadwin[] = 'Договора';
    $breadwin[] = 'ИПН'; 
        
    $ipn = new IPN();
    $dan = $ipn->dan;    