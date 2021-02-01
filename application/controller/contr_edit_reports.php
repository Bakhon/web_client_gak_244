<?php
	$db = new DB();
    
    $dan = array();
        
    $sql = "select * from REPORTS_HTML";
    if(isset($_GET['id'])){
        $sql .= " where ID = ".$_GET['id'];
    }
    
    $db->ClearParams();
    $dan = $db->Select($sql);
    
    foreach($dan as $k=>$v){
        $db->ClearParams();
        $dan[$k]['others'] = $db->Select("select * from REPORT_HTML_OTHER where id = ".$v['ID']);
    }
    
?>