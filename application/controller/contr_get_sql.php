<?php
class GET_SQL
{
    private $db;
    private $result;
    private $sql;
    public $type;
    public $html;
     
    public function __construct()
    {
        $this->db = new DB3();
        if(!isset($_GET['id'])){
            echo '';
            exit;
        }
        
        $this->init($_GET['id']);
    }
    
    private function init($id)
    {
        $s = $this->db->Select("select * from s_sqls where id = $id");
        $q = $s[0];
        $this->sql = $q['SQL_TEXT'];
        $pr = $this->params();        
    }
    
    private function params()
    {        
        $q = $_GET;
        unset($q['id']);  
        
        $type = 'html';             
        if(isset($_GET['type'])){
            $type = $_GET['type'];            
        }        
        unset($q['type']);
        
        foreach($q as $k=>$v){
            $this->sql = str_replace(':'.$k, "'$v'", $this->sql);            
        }                
        $this->result = $this->db->Select($this->sql);
        $this->html = $this->set_result($type);        
        
    }
        
    private function array_to_xml( $data, &$xml_data ){
        foreach( $data as $key => $value ) {        
            if( is_numeric($key) ){
                $key = 'item';//.$key; //dealing with <0/>..<n/> issues
            }        
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
        
    public function set_result($type)
    {
        $this->type = $type;        
        if($type == 'xml'){
            $xml_data = new SimpleXMLElement('<root/>');
            $this->array_to_xml($this->result,$xml_data);                                     
            return $xml_data->asXML();            
        }
        
        if($type == 'sql'){
            return  $this->sql;            
        }
        
        if($type == 'json'){
            return true; json_encode($this->result);            
        }
        
        $s = '<pre>'.var_dump($this->result).'</pre>';
        return $s;                
    }
    
}
    
$s = new GET_SQL();
header('Content-Type: text/'.$s->type);
echo $s->html;
exit;
?>