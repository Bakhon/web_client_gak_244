<div class="modal_ajax">    
    <a data-toggle="modal" data-target="#new_contract" data-acive="contracts" class="click_modal" style="display: none;"></a>
    <div class="modal inmodal fade" id="new_contract" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-umbrella modal-icon"></i>
                    <h4 class="modal-title">Выбор продукта</h4>
                    <small class="font-bold">Выберите один из продуктов страхования для заведения нового договора</small>
                </div>
                <div class="modal-body">
                <p>
                <?php
                    $db = new DB3();                
                    $r = $db->Select("select p.id, p.code, p.name, p.id_parent, p.code code_v, p.name name_v, p.note from dic_payments p where p.type = 2 and p.in_prog = 1");    
                    foreach($r as $k=>$v){
                        $db->ClearParams();
                        $s = $db->Select("select * from dic_reason where paym_code = '".$v['CODE']."'");
                        if(count($s) > 0){
                            echo '<div class="btn-group btn-block"><button data-toggle="dropdown" class="btn btn-primary btn-block btn-outline dropdown-toggle">
                            '.$v['NAME'].'<span class="caret"></span></button> <ul class="dropdown-menu">';
                            
                            foreach($s as $f=>$st)
                            {
                                echo '<li><a href="new_contract?paym_code='.$v['CODE'].'?prichina='.$st['ID'].'">'.$st['NAME'].'</a></li>';                
                            }
                            echo '</ul></div>';
                            
                        }else{
                            echo '<a href="new_contract?paym_code='.$v['CODE'].'" class="btn btn-primary btn-block btn-outline">'.$v['NAME'].'</a>';   
                        }        
                    }    
                ?>
                </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.click_modal').click();
        $('.close_modal').click(function(){
            $('.modal_ajax').remove();
        });
    </script>
</div>
<?php  
    exit; 
?>