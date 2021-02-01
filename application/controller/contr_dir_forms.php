<?php
    $breadwin[] = 'Админ панель';
    $rq = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
	$db = new DB();    
    if(count($POSTS) > 0){
        if(isset($POSTS['id'])){
            $id = $POSTS['id'];
            $name = $POSTS['NAME'];
            $url = $POSTS['URL'];
            
            if($id == 0){
                $sql = "insert into dir_forms (id, name_url, name_form) values (SEQ_DIR_FORMS.nextval, '$url', '$name')";
            }else{
                $sql = "update dir_forms set name_url = '$url', name_form = '$name' where id = $id";
            }
            $s = $db->Execute($sql);  
            if($s !== true){
                $msg = ALERTS::ErrorMin($s);
            }else{
                Header("Location: $rq");
            }
        }
        
        if(isset($POSTS['deleted'])){
            $msg .= ALERTS::WarningMin('Отсюда удалять нельзя');
        }                
    }
    
    
    $db->ClearParams();
    $dan = $db->Select("select * from dir_forms order by id");    
?>
