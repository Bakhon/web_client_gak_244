<?php    
session_start();
require_once __DIR__.'/../application/config.php';
require_once __DIR__.'/../application/units/other.php';
require_once __DIR__.'/../application/units/database.php';

require_once __DIR__.'/client.php';
$ch = new ClientChat();

if(isset($_GET['list_msg'])){
    $dan = $ch->ListMsg($_GET['list_msg']);
    require_once __DIR__.'/msg_body.php';
}

if(isset($_POST['new_message'])){    
    $ds = $ch->SaveMessage($_POST['user_from'], $_POST['user_to'], $_POST['new_message']);
    if(isset($_POST['listmsg'])){
        $dan = $ch->ListMsg($_POST['listmsg']);
        require_once __DIR__.'/msg_body.php';
    }
}

exit;
