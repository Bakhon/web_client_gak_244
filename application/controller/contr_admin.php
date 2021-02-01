<?php
	$page_title = 'Справочники';
    $panel_title = 'Справочник статуса аннуитета';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник статуса аннуитета';
    
    
    if(count($_POST) > 0){
        $users = $_POST['user_send_conference'];
        $url = $_POST['url_conf'];
        $lg = $_SESSION[USER_SESSION]['login'].'@gak.kz';
        $db = new DB();
        
        $q = $db->Select("select firstname||' '||lastname fio from sup_person where email = '$lg'");
        $user_send  = $q[0]['FIO'];
        
        $message_send = 'Приглашение на видео-конференцию. '.$user_send.' приглашает Вас на видео-конференцию. Перейдите по ссылке '.$url;
        foreach($users as $v){
            $sql = "begin send_mail.mail('$v', 'Приглашение на видео-конференцию', '$message_send'); end;";                         
            $db->Execute($sql);               
        }
              
        print_r($_POST);
        exit;
    }
?>