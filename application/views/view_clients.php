<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">        
            <?php 
                if(isset($dan['error'])){                    
                    echo $dan['error'];                    
                }
                require_once __DIR__.'/clients/'.$client->page.'.php'                
            ?>
        </div>
    </div>
</div>    