<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
<?php
	if($reins->page == ''){
	   require_once __DIR__.'/reins_ns/main.php';
	}else{
	   require_once __DIR__.'/reins_ns/'.$reins->page.'.php';
	}
?>              
        </div>                       
    </div>
</div>