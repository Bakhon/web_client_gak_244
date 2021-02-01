<?php

class REINS_DOBR_FAKULTATIV
{
        private $db;
        private $date_begin;
        private $date_end;
        public $array;
        public $dan = array();
        public $list_reins;   
        public $message = ''; 
        public $html;
        private $state_f;   
        private $vid; 
        private $sql_text;
        
        public function __construct()
        {                        
            $this->db = new DB3();            
            $method = $_SERVER['REQUEST_METHOD'];                                     
            $this->$method();
        }
        
        private function GET()
        {
            if(count($_GET) <= 0){
              //  $this->lists();                                
            }else{            
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){                        
                        $this->$k($v);
                    }else{
                        $this->dan[$k] = $v;
                    }
                }
            }                                    
        }
        
        private function POST()
        {
            
            //print_r($_POST);exit;
            
            if(count($_POST) <= 0){
                $this->dan = array();
            }else{                
                $i = 0;
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){
                        $i++;
                        $this->array = $_POST;                        
                        $this->$k($v); 
                    }
                }
                if($i == 0){
                    exit;
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
  }      

?>