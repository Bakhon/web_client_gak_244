<?php	
    if(count($_POST) > 0){
        require_once VIEWS.'reins_dobr/edit.php';
    }else{
        if(count($_GET) > 0){
            foreach($_GET as $k=>$v);
            if(file_exists(VIEWS.'reins_dobr/'.$k.'.php')){
                require_once VIEWS.'reins_dobr/'.$k.'.php';
            }else{
                require_once VIEWS.'reins_dobr/list.php';
            }
        }else{
            require_once VIEWS.'reins_dobr/list.php';
        }
        
    }
?>