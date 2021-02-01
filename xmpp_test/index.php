<?php
/* UTF-8 
XMPP webi
http://webi.ru/webi_files/xmpp_webi.html

*/

include_once("xmpp.class.php");

$webi_conf = array(
    "host"=>"antivirus.gak.local",
    "port"=>5222,
    "user"=>'ins',
    "pass"=>"Astana2016",
    "domain"=>"gak.kz",
    "logtxt" => "log.txt",
    "tls_off" => 1
);
$webi = new XMPP($webi_conf);

$webi->connect(); // установка соединения...

//$webi->sendStatus('text status','chat',3); // установка статуса
$webi->sendMessage("a.saleev@gak.kz", "86542934797 23"); // отправка сообщения


$webi->getXML();

// так можно зациклить
/*

while($webi->isConnected)
{
	$webi->getXML();
}

*/


?>
