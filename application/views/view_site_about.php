<?php    	
    $dan = $result->dan;
?>    
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                
                    <ul class="nav nav-tabs">
                        <?php
                            foreach($dan as $k=>$v){
                                $s = '';
                                if($k == 0){
                                    $s = 'active';
                                }
                                echo '
                                    <li class="'.$s.'">
                                        <a data-toggle="tab" href="#tab_'.$k.'">'.$v['NAME_RU'].'</a>
                                    </li>
                                ';
                            }
                        ?>                                
                    </ul>                    
                    <div class="tab-content" id="myTabContent">
                    <?php
                        foreach($dan as $k=>$v){
                            $s = '';
                            if($k == 0){
                                $s = 'active';
                            }
                        ?>
                        
                        <div class="row tab-pane <?php echo $s; ?>" id="tab_<?php echo $k; ?>">
                            <br />
                            <div class="col-lg-3">                                                                                
                                <br />
                                <div class="list-group">
                                    <?php 
                                        foreach($v['child'] as $t=>$c){                                    
                                            echo '<a class="list-group-item list-group-item-action" data="'.$v['ID'].'" data-id="'.$c['ID'].'" href="#">'.$c['NAME'].'</a>';
                                        }
                                    ?>
                                </div>
                            </div>                                                                                                 
                            <div class="col-lg-9" id="panel_<?php echo $v['ID'] ?>">
                            
                            </div>                                                        
                        </div>
                        <?php                    
                        }
                    ?>            
                    </div>
                </div>      
            </div>
        </div>    
    </div>
</div>    

<script>
    $('.list-group-item').click(function(){
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('data-id'),
            ids = $(this).attr('data');
        
        $.post(window.location.href, {"getdan":null, "id":id}, function(data){
           $('#panel_'+ids).html(data); 
        });
    });
</script>