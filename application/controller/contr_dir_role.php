<?php
	$db = new DB();
    $rq = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    if(isset($_POST['NAME'])){
        $id = $_POST['id'];
        $name = $_POST['NAME']; 
        $id_type = $_POST['type_proc'];
        if($id == 0){
            $sql = "INSERT INTO DIR_ROLE (ID, NAME, ID_TYPE) VALUES (SEQ_ROLE.nextval, '$name', $id_type)";
        }else{
            $sql = "update DIR_ROLE set NAME = '$name', ID_TYPE = $id_type where ID = $id";
        }
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    
    $db->ClearParams();
    $list_type = $db->Select("select * from dir_type_proc");
    $ls = array();
    foreach($list_type as $k=>$v){
        $ls[$k]['id'] = $v['ID'];
        $ls[$k]['text'] = $v['NAME']; 
    }
    
    
    $sql = "select d.*, t.name type_proc from DIR_ROLE d, dir_type_proc t where t.id = d.id_type order by 1";        
    $db->ClearParams();
    $dan = $db->Select($sql);    
?>