<?php	
    if(count($_POST) > 0){
        require_once VIEWS.'reins_fakultativ/edit.php';
    }else{
        if(count($_GET) > 0){
            foreach($_GET as $k=>$v);
            if(file_exists(VIEWS.'reins_fakultativ/'.$k.'.php')){
                require_once VIEWS.'reins_fakultativ/'.$k.'.php';
            }else{
                require_once VIEWS.'reins_fakultativ/list.php';
            }
        }else{
            require_once VIEWS.'reins_fakultativ/list.php';
        }
        
    }
?>
