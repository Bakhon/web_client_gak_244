<?php
	class SITE_ABOUT
    {
        private $db;
        private $params;
        public $dan;
        
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
                $this->dan = $this->index();
            }else{                
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->dan = $this->$k($v);
                    }
                }
            }
        }
        
        private function POST()
        {        
            $this->params = $_POST;
            
            foreach($_POST as $k=>$v){
                if(method_exists($this, $k)){
                     $this->$k($v);
                }
            }   
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    exit;
                }
            }
            $this->GET();         
        }
        
        
        private function index()
        {
            $qs = $this->db->Select("select * from CORP_SITE_ABOUT_TABS order by id");
            
            foreach($qs as $qst=>$t){
                $sql = "select ID, ITEM_NAME_RU name from CORP_SITE_ABOUT_US_MENU where id_tab = ".$t['ID']." order by ID";
                $q = $this->db->select($sql);
                
                $qs[$qst]['child'] = $q;
            }                        
            return $qs;
        }
        
        private function getdan()
        {
            $id = $this->params['id'];
            $q = $this->db->Select("select * from CORP_SITE_ABOUT_US_MENU where id = $id");
            require_once VIEWS.'site/site_about_child.php';                                  
        }
        
        private function content($id)
        {               
            $ln = trim($_GET['lang']);
            $q = $this->db->Select("select * from CORP_SITE_ABOUT_US_MENU where id = $id");
            $content = $q[0][$ln];      
                  
            echo '<link rel="stylesheet" href="/application/views/site/sait_style/css/bootstrap.min.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/font-awesome-4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/slick/slick.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/slick/slick-theme.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/css/fonts.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/css/jquery-simple-mobilemenu-slide.css">
            <link rel="stylesheet" href="/application/views/site/sait_style/css/style.css" >
            <link rel="stylesheet" href="/application/views/site/sait_style/css/media.css">';
            echo '<div id="'.$ln.'" class="tab-content" contenteditable="">'.$content.'</div>';
            //print_r($_GET);
            //print_r($q[0]);
            exit;
        }
    }
    
    $result = new SITE_ABOUT();    