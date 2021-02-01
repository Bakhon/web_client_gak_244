<?php
    class SPEEK
    {
        private $db;
        private $result;
        public function __construct(){
            $this->db = new DB3();
            $this->result = array(
                "alert" => "",
                "url" => "",
                "html" =>""
            );
        }
        
        public function init($text = ''){
            if($text == ''){
                return json_encode($this->result);
            }
            
            $email = $_SESSION[USER_SESSION]['login'];
            $q = $this->db->Select("select * from sup_person@db_sup where email = '$email@gak.kz'");
            $name = $q[0]['FIRSTNAME'];
            
            $txt = $text;
            $text = strtolower($text);            
            if(strpos($text, 'Привет') !== false){
                $txt = 'Добрый день '.$name;                 
            }
            
            $this->result['html'] = strtoupper($text);
            $this->result['alert'] = $txt;
            return json_encode($this->result);
        }
    }
        
    if(isset($_POST['text'])){
        $speek = new SPEEK();
        $s = $speek->init($_POST['text']);
        echo $s;
    }	
exit;
?>