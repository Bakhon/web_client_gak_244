<?php
    if(isset($_GET['rfbn_id'])){
        require_once VIEWS.'filial/edit.php';
    }else{
	   require_once VIEWS.'filial/list.php';
    }
    
    if(count($_POST) > 0){
        print_r($_POST);
    }
?>