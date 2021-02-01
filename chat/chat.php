<?php 
    require_once __DIR__.'/client.php';
    $ClientChat = new ClientChat();
        
?>
<div id="small-chat">
    <span class="badge badge-warning float-right"><?php echo $ClientChat->CountNoReadMSG(); ?></span>
    <a class="open-small-chat" data-toggle="modal" data-target="#chat_modal">
        <i class="fa fa-comments"></i>
    </a>
</div>

<div class="modal inmodal fade" id="chat_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 75%;">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div class="row">
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="search_chat_users" placeholder="Поиск собеседника..."/>
                    </div>
                    <div class="col-lg-8" style="text-align: left;">
                        <span id="active_user_dolg" style="float: right;"></span>
                        <h3 id="active_fio_user"></h3>                        
                    </div>
                </div>                                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row" style="height: 50em;">
                    <div class="col-lg-3">                                                                                        
                        <div class="list_users" style="width: 103%; margin-top: 10px;height: 50em; overflow: auto;">
                        <?php                  
                            $ds =  $ClientChat->ListUsers();         
                            foreach($ds as $k=>$v){
                                echo '
                                <div class="feed-activity-list">
                                    <div class="feed-element">
                                <label class="cart_deps" id="'.$k.'">
                                    <i class="fa fa-caret-down"></i>'.$v['DEP_NAME'].'</label> 
                                <div id="cart_deps_'.$k.'">                             
                                ';
                                foreach($v['users'] as $user){
                                    echo '
                                        <div class="media-body well onchat" data="'.$user['ID'].'">                                                 
                                            <span class="badge badge-danger pull-right">0</span>                                                                           
                                            <strong class="h4 fio_user" data="'.$user['ID'].'">'.$user['LASTNAME'].' '.$user['FIRSTNAME'].'</strong>
                                            <br>
                                            <small class="text-muted">'.$user['DOLZHNOST'].'</small>
                                            <br />
                                            <small class ="last_message" data="'.$user['ID'].'"></small>                                        
                                        </div>
                                    ';
                                }
                                echo '</div></div></div>';
                            }
                        ?>
                        </div>
                       
                    </div>
                    <div class="col-lg-9">
                        <div id="chat_users">                            
                        </div>
                    </div>
                </div>                                
            </div>                        
        </div>
    </div>
</div>

<style>
.cart_deps{
    cursor: pointer;
}

.onchat{
    cursor: pointer;
}

.onchat.activ{
    background: #03a9f470;
}

</style>
<script>
var iduser = <?php echo $ClientChat->id_user; ?>;
</script>
<script src="/styles/js/demo/chat.js"></script>