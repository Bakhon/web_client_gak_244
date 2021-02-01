<?php
/*
	class JABBER
    {
        private $webi;
        
        public function __construct()
        {
            
            include_once(__DIR__."/xmpp/xmpp.class.php");
            $this->webi = new XMPP($webi_conf);
            $this->webi->connect();
            
            //$webi->sendStatus('text status','chat'); // установка статуса                        
        }
        
        public function send_message($user, $msg)
        {
            $this->webi->sendMessage($user, $msg);
        }
    }

*/

require_once __DIR__."/../application/config.php";
require_once __DIR__."/../application/units/other.php";
require_once __DIR__."/../application/units/database3.php";

class JABBER
{    
    private $db;
    public function __construct()
    {     
        $this->db = new DB3();
    }
    
    public function send_message($user, $msg, $title = "244 Новое ссообщение")
    {
        $sql = "begin send_mail.mail@DB_SUP('$user', '$title', '$msg'); end;";
        $this->db->Execute($sql);        
    }
}
    
    /*
    $jabber = new JABBER();
    $jabber->send_message('i.akhmetov@gak.kz', 'HELLO');
    */