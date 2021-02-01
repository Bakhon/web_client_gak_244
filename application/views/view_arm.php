<div class="row wrapper wrapper-content">
    <div class="row">
    <?php
    	$page = 'index'; 
        foreach($_GET as $k=>$v){
            if(file_exists(VIEWS."arm/$k.php")){
                $page = $k;
            }
        }           
        require_once VIEWS."arm/$page.php";
    ?>        
    </div>
</div>    
            