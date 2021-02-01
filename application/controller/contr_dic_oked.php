<?php
	class OKED
    {
        private $db;
        private $array;
        public $dan;
        
        public function __construct()
        {
            global $active_user_dan;
            $this->role_type = $active_user_dan['role_type'];
            $this->role_branch = $active_user_dan['brid'];
            $this->role_emp = $active_user_dan['emp'];
            
            require_once 'application/units/database3.php';
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
                    }else{
                        $this->array[$k] = $v;
                    }
                }
            }                        
        }
        
        private function POST()
        {
            if(count($_POST) > 0){                
                foreach($_POST as $k=>$v){                                
                    if(method_exists($this, $k)){                    
                        $this->array = $_POST;
                        $this->$k($v); 
                    }
                }
            }            
            $this->GET();             
        }
        
        private function index()
        {
            $q = $this->db->Select("select * from dic_oked_afn order by oked");
            $this->dan = $q;
        }
        
        private function dan($id)
        {
            $q = $this->db->Select("select * from dic_oked_afn where id = $id");
            echo json_encode($q[0]);
            exit;
        }
        
        private function OKED()
        {
            $id = $this->array['ID'];
            unset($this->array['ID']);
            
            if($id == '0'){
                $cols = '';                
                $value = '';
                $i = 0;
                
                foreach($this->array as $k=>$v){
                    if($i > 0){
                        $cols .= ",";
                        $value .= ",";
                    }
                    $cols .= $k;
                    $value .= "'$v'";
                    $i++;
                }
                                
                $sql = "insert into dic_oked_afn(ID, $cols) values(SEQ_OKED.nextval, $value)";
            }else{
                $text = '';
                $i = 0;
                foreach($this->array as $k=>$v){
                    if($i > 0){
                        $text .= ",";
                    }
                    if($k == 'TARIF'){
                        $text .= "$k=$v";
                    }else{
                        $text .= "$k='$v'";    
                    }
                    $i++;
                }
                
                //$this->db->Execute("");
                
                $sql = "begin 
                insert into dic_oked_afn_arc 
                    select * from dic_oked_afn where id = $id;
                update dic_oked_afn set $text where id = $id;
                end;";
            }            
            echo $sql;
            
            if(!$this->db->Execute($sql)){
                global $msg;
                $msg = ALERTS::ErrorMin($this->db->message);
            }
        }
        
        /*
        [ID] => 6 
        [OKED] => 01133 
        [NAME] => 
        [NAME_OKED] => 
        [RISK_ID] => 6 [TARIF] => .53 [ID_OKED] => 1.3.3 [NOM_PP] => 10 [ID_NBRK] => 1 )
        */
    }
    
    $oked = new OKED();
    $dan = $oked->dan;
    
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
    
    $othersJs = "<script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                'dom': 'lTfigt',
                'tableTools': {
                    'sSwfPath': 'js/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            

        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                'Custom row',
                'New row',
                'New row',
                'New row',
                'New row' ] );

        }
    </script>";
?>