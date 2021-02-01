<?php    
    require_once __DIR__.'/buttons_href.php';
    require_once __DIR__.'/chart.php';
    require_once __DIR__.'/blocks.php';    
    require_once __DIR__.'/params.php';
    //error_reporting(E_ALL);
class BI extends PARAMS_BI
{
    protected $params = array(); //Все параметры или фильтрация вноятся в данный массив        
    public $result;
    public $page;
    public $sql;
    public $GP_DAN;
    
    private $block;
    
    public function __construct()
    {           
        parent::__construct();
        $method = $_SERVER['REQUEST_METHOD'];
        if(method_exists($this, $method)){
            $this->$method();
        }else{
            require_once 'application/blocks/404.php';
        }
        /*
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
            exit;                    
        }
        */
    }
                
    private function GET()
    {        
        if(count($_GET) <= 0){
            $this->main();
        }else{
            foreach($_GET as $k=>$v){
                if(method_exists($this, $k)){
                    $this->$k($v);
                }
            }
            //$this->init($_GET);    
        }
    }
    
    private function main()
    {                   
        $this->result = $this->db->Select("select * from BI_REPORTS");        
        $this->page = 'main';
    }
    
    private function POST()
    {
        if(count($_POST) > 0){
            foreach($_POST as $k=>$v){
                if(method_exists($this, $k)){
                    $this->GP_DAN = $_POST;
                    unset($this->GP_DAN[$k]);
                    $this->$k($v);
                }
            }
        }
        
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                exit;
            }
        }
    }
    
    private function init($dan)
    {
        //print_r($dan);
        //if(isset($dan)){if(count($dan) > 0)print_r($dan);}
        $this->report($dan);
    }
    
    private function report($id)
    {
        $this->result['id_report'] = $id;
        $this->getParams($id);        
        $this->block = new BI_BLOCKS();
        $this->block->params = $this->params;        
        $this->result['blocks'] = $this->block->report($id);        
        $this->page = 'report';
    }
    
    private function sql($ss)
    {        
        //1. Узнаем что за отчет        
        $id = $_GET['report'];
        $id_page = '1';
        
        $this->getParams($id);
        
        require_once 'BI/tablesSQL.php';
        $tables = new table_sql();
        $tables->params = $this->params; 
        $tst = $tables->sql($id, $ss, $id_page);
                
        echo $tst;
    }
    
    private function set_filter($dan)
    {
        print_r($dan);
        exit;
    }
}