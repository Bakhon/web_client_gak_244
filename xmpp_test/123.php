<?php

function getxml($stream)
{
    sleep(1); // перед получением информации дадим паузу, чтобы сервер успел отдать информацию
    $xml=array();

    // запрашивать данные 1600 раз, но не более 15 пустых строк
    $emptyLine = 0;
    for($i=0; $i<1600; $i++)
    {
        $line = fread($stream,2048);
        var_dump($line);
        echo '<br>';
        if(strlen($line) == 0) {
            $emptyLine++;
            if($emptyLine > 15) break;
        }
        else {
            $xml[$i]= $line;
        }
    }
    if(!$xml) return false;
    return $xml;
}

$user="a.saleev"; // логин до '@'
$domain="gak.kz"; // домен после '@'
$pass="Cfkttd83"; // пароль
$host="192.168.5.204"; // jabber сервер
$port=5222; // порт
// устанавливаем соединение с сервером
$stream = fsockopen($host,$port,$errorno,$errorstr,10);

// эти настройки необходимы, чтобы при получении данных из потока не было зависания.
// иначе при обнаружении пустой строки php зависнет в длительном ожидании
stream_set_blocking($stream,0);
stream_set_timeout($stream,3600*24);

// после соединения с сервером посылаем приветствие(все как писал ранее)
$xml = '<?xml version="1.0"?>
<stream:stream xmlns:stream="http://etherx.jabber.org/streams" version="1.0" xmlns="jabber:client" to="'.$domain.'" xml:lang="en" xmlns:xml="http://www.w3.org/XML/1998/namespace">';
fwrite($stream,$xml."\n"); // отправка данных на сервер в конце ставится перенос строки \n
$xmlin=getxml($stream); // получение ответа от сервера
// обрабатываем ответ сервера, узнаем может ли сервер работать в защищенном режиме,если может переходим в защищенный режим

// посылаем команду на переход в защищенный режим
$xml = '<starttls xmlns="urn:ietf:params:xml:ns:xmpp-tls"/>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream); // получаем ответ

// если сервер подтвердил переводим поток в защищенный режим
stream_set_blocking($stream, 1); // сначала блокировку ставим в 1
stream_socket_enable_crypto($stream, TRUE, STREAM_CRYPTO_METHOD_TLS_CLIENT); // переходим в защищенный режим
stream_set_blocking($stream, 0); // блокировку обратно ставим в 0

// после перехода в защищенный режим снова посылаем приветствие
$xml = '<?xml version="1.0"?>';
$xml .= '<stream:stream xmlns:stream="http://etherx.jabber.org/streams" version="1.0" xmlns="jabber:client" to="'.$domain.'" xml:lang="en" xmlns:xml="http://www.w3.org/XML/1998/namespace">';
fwrite($stream, $xml."\n");
$xmlin=getxml($stream); // получение ответа

// теперь проходим авторизацию
$xml = '<auth xmlns="urn:ietf:params:xml:ns:xmpp-sasl" mechanism="PLAIN">';
$xml .= base64_encode("\x00".$user."\x00".$pass); // вот так кодируется логин пароль для этого типа авторизации
$xml .= '</auth>';
fwrite($stream, $xml."\n");
$xmlin=getxml($stream);

// после авторизации опять посылаем приветствие
$xml = '<?xml version="1.0"?>';
$xml .= '<stream:stream xmlns:stream="http://etherx.jabber.org/streams" version="1.0" xmlns="jabber:client" to="'.$domain.'" xml:lang="en" xmlns:xml="http://www.w3.org/XML/1998/namespace">';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream);

// сейчас устанавливаем имя ресурса (расположение вашего клиента)
$xml = '<iq type="set" id="2"><bind xmlns="urn:ietf:params:xml:ns:xmpp-bind"><resource>webi</resource></bind></iq>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream);

// пошла сессия
$xml = '<iq type="set" id="sess_2" to="'.$domain.'"><session xmlns="urn:ietf:params:xml:ns:xmpp-session"/></iq>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream);

// а теперь можно получить список контактов
$xml = '<iq type="get" id="3"><query xmlns="jabber:iq:roster"/></iq>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream); // здесь сейчас список ваших контактов

// ну и теперь выходим в онлайн и становимся видимыми для ваших контактов
$xml = '<presence><show></show><status>мой статус онлайн</status><priority>10</priority></presence>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream); // после выхода в онлайн здесь будут получены офлайн сообщения и дополнительная информация по статусам ваших контактов.
echo '<pre>';
print_r($xmlin);
echo '</pre>';
exit;
// теперь можно отправить сообщение например для контакта asd@asd.ru
// в поле from указываете полный JID вместе с ресурсом(он должен быть получен в ответе сервера при установке ресурса), в поле to - кому адресовано сообщение, если ресурс не известен, можно без указания ресурса.
$xml = '<message type="chat" from="test@ya.ru/webi" to="asd@asd.ru" id="et5r">';
$xml .= '<body>тестовое письмо</body>';
$xml .= '</message>';
fwrite($stream,$xml."\n");
$xmlin=getxml($stream);


// Если есть необходимость, можно зациклить скрипт и оставаться подключенным и получать входящие данные
/*
while(1)
{
    sleep(3); // ставим паузу в 3 секунды, чтобы не создавать большую нагрузку на php
    $xmlin=getxml($stream); // и раз в 3 секунды идет сбор данных из потока. тут будут приходить сообщения, информация о смене статусов ваших контактов и т.д.
}
*/
?>