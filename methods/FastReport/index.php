<?php
//error_reporting(0);
//ini_set('display_errors', 0);
require_once __DIR__.'/components.php';

class fastreport extends components
{
    public $xml;
    public $html;
    public $style;
    public $dataSet = array();
    public $ind = 1; 
    
    public function __construct()
    {
        parent::__construct();
        
        $this->xml = '';
        $this->html = '<div id="frx_print">';
        
        $this->style = '<style>                            
            .page{position: relative;}
            .page-main{page-break-after: always;}
            p{margin: auto;}
        ';    
    }
            
    public function loadFromFile($filename)
    {
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        $this->xml = fread($myfile,filesize($filename));            
        fclose($myfile);                        
    }
    
    public function init()
    {            
        $xml = simplexml_load_string($this->xml) or die("Error: Cannot create object");             
        $json  = json_encode($xml);
        $dan = json_decode($json, true);
        
        //echo '<pre>'; print_r($json); exit;
        
        foreach($dan as $k=>$v){
            if(method_exists($this, $k)){
                $this->$k($v);
            }
        }
                        
        $this->AddStyle('</style>');                    
        $this->AddHtml('</div>');
        return;
    }
    
    public function AddHtml($text)
    {
        $this->html .= $text.' ';
    }
    
    public function AddStyle($text)
    {
        $this->style .= $text.' ';
    }                
}