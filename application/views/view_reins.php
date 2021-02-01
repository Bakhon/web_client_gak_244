<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <?php 
                    if(isset($_GET['id'])){
                        require_once VIEWS.'reins/edit.php';
                    }else{
                        require_once VIEWS.'reins/list.php';
                    }
                ?>                             
            </div>            
        </div>
    </div>
</div>            