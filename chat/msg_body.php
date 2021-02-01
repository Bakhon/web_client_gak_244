<?php 
    function MsgText($fio, $text, $datetime, $left = true){
        $l = 'left';
        if($left == false){$l = 'right';}
        
        return '
            <div class="chat_msg_">
                <div class="'.$l.'">
                    <div class="author-name">'.$fio.' <small class="chat-date">'.$datetime.'</small></div>
                    <div class="chat-message active">
                        '.$text.'
                    </div>
                </div>
            </div>';
    }    
?>
<div class="well active_chat_panel" style="height: 40em;overflow: auto;">
    <?php
        foreach($dan['chat'] as $k=>$v){
            $pos = true;
            $f = $dan['user']['FIO'];
            if($dan['user']['ID'] == $v['ID_USER_TO']){
                $pos = false;
                $f = $dan['my']['FIO'];
            }
            echo MsgText($f, base64_decode($v['MSG']), date("d.m.Y H:i", strtotime($v['DATE_SEND'])), $pos);
        }
    /*
        $t = false;
        for($i=0;$i<=10;$i++){
            if($t == true){
                $f = $dan['user']['FIO'];
            }else{
                $f = $dan['my']['FIO'];
            }
            echo MsgText($f, 'Hello'.$i, date("H:i"), $t);
            
            if($t == true){
                $t = false;
            }else{
                $t = true;
            }
        }
        
        print_r($dan['chat']);
        */
    ?>
</div>


<div class="well">
    <button class="btn btn-success" id="send_msg" data="<?php echo $dan['user']['ID']; ?>" style="float: right;" onclick="SendMessage();">
        <i class="fa fa-paper-plane"></i>
    </button>
    <div id="msg_text" contenteditable="true">
        <span id="onplaceholder">Введите текст сообщения... (Ctrl+Enter - Отправка сообщения)</span>
    </div>
</div>
<style>
#msg_text{
    width: 90%;
    background-color: #fff;
    height: 70px;
    overflow: auto;
    border: solid 1px #000;
}

.chat_msg_{
    width: 100%;
    float: left;
}

.chat_msg_>div{
    border: solid 1px;
    border-radius: 10px;
    padding: 7px;
    background-color: #fff;
    margin-bottom: 15px;
    min-width: 20%;    
    max-width: 75%;
}
.chat_msg_>div.right{
    float: right;
}
.chat_msg_>div.left{
    float: left;
}

.author-name{
    border-bottom: solid 1px silver;
}
.chat-date{
    float: right;
}

</style>

<script>
SetHeader('<?php echo $dan['user']['FIO']; ?>', '<?php echo $dan['user']['DEP_NAME']; ?>');
$('.active_chat_panel').scrollTop($('.active_chat_panel').height());
</script>