<?php
    $xml_array = array();
    $xml_file = __DIR__."/users.xml";
    if(file_exists($xml_file)){
        $xmlfile = file_get_contents($xml_file);  
        $new = simplexml_load_string($xmlfile);
        $con = json_encode($new); 
        $xml_array = json_decode($con, true);
    }
    
    
	if(isset($_POST['myip'])){
	   $ds = array();
       $ds['ip'] = $_POST['myip'];
       $ds['port'] = $_POST['port'];
       $ds['login'] = $_POST['login'];
       $ds['user_id'] = 0;
       if(isset($_POST['id'])){
            $ds['user_id'] = $_POST['id'];
       }
       array_push($xml_array, $ds);
	}
    
    $xml_text = '<?xml version="1.0" encoding="UTF-8"?>';
    
    foreach($xml_array as $k=>$v){
        $xml_text .= '<user>';
        $xml_text .= '  <ip>'.$v['ip'].'</ip>';
        $xml_text .= '  <port>'.$v['port'].'</port>';
        $xml_text .= '  <login>'.$v['login'].'</login>';
        $xml_text .= '  <user_id>'.$v['user_id'].'</user_id>';
        $xml_text .= '</user>';
    }
    
    
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xmlString);    
    $dom->save($xml_file);
    
    Header('Content-type: text/xml');
    
    $dom->formatOutput = TRUE;
    echo $dom->saveXml();
    exit;