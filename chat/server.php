<?php
    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
    
    require_once __DIR__.'/../application/config.php';
    
    
    $tns = "(DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = ".DB_HOST.")(PORT = 1521))
        )
            (CONNECT_DATA =
            (SID = ".DB_DATABASE.")
            (SERVER = DEFAULT)
            )
        )";
        
        try {
            $conn = new PDO("oci:dbname=".$tns, DB_USERNAME, DB_PASS);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    exit;
        
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/MyChat.php';    
    
    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use MyApp\Chat;

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        )
        ,8080
    );

    $server->run();