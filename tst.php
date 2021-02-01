<?php
  phpinfo();
  exit;
    require_once __DIR__.'/methods/xmpp.php';
    
    $j = new JABBER();
    $j->send_message('a.saleev@gak.kz', 'HELLO');