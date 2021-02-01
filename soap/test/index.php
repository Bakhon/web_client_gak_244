<?php
	require_once 'Base.php';
    require_once 'client.php';
    
    $client = new Client("wss://127.0.0.1:13579/");
    $client->send("Hello WebSocket.org!");

    echo $client->receive();