<?php    
	$db = new DB();
    $rq = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(isset($_POST['METHOD_ACTION'])){
        $id = $_POST['id'];
        $name = $_POST['METHOD_NAME']; 
        $action = $_POST['METHOD_ACTION'];
        
        if($id == 0){
            $sql = "INSERT INTO MENU_CLASSES (ID, NAME, FUNCT) VALUES (SEQ_DIR_METHOD.nextval, '$name', '$action')";
        }else{
            $sql = "update MENU_CLASSES set NAME = '$name', FUNCT = '$action' where ID = $id";
        }
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    if(isset($_POST['deleted'])){
        $sql = 'delete from MENU_CLASSES where id = '.$_POST['deleted'];
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    $sql = "select * from MENU_CLASSES order by id";
    $dan = $db->Select($sql);
?>