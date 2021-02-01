<?php
	$db = new DB();
    $rq = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(isset($_POST['METHOD_ACTION'])){
        $id = $_POST['id'];
        $name = $_POST['METHOD_NAME']; 
        $action = $_POST['METHOD_ACTION'];
        
        if($id == 0){
            $sql = "INSERT INTO DIR_METHOD (ID, METHOD_NAME, METHOD_ACTION) VALUES (SEQ_DIR_METHOD.nextval, '$name', '$action')";
        }else{
            $sql = "update DIR_METHOD set METHOD_NAME = '$name', METHOD_ACTION = '$action' where ID = $id";
        }
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    if(isset($_POST['deleted'])){
        $msg = ALERTS::WarningMin('Отсюда Удалять нельзя!');
        /*
        $sql = 'delete from DIR_METHOD where id = '.$_POST['deleted'];
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
        */
    }
    
    $sql = "select * from DIR_METHOD order by id";
    
    if(isset($GETS['id'])){
        $sql .= " where id = ".$GETS['id'];
    }
    
    $dan = $db->Select($sql);
    
?>