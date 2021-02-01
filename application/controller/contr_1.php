<?php
/*
class TEST
{
    private $db;
    private $params;
    
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
        $sql = "DECLARE
        l_array SHEP.web_back.assoc_array;
        BEGIN ";
        $i = 0;
        foreach($_GET as $k=>$v)
        {
            $sql .= " l_array($i) := '$k=$v'; ";
            $i++;
        }        
        $sql .= "SHEP.web_back.GET(l_array, :pst); END;";
        $pst = array("pst"); 
        $q = $this->db->ExecuteReturn($sql, $pst);
        echo $q['pst'];                
    }
    
}

$test = new TEST();
*/
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once 'methods/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->
exit;