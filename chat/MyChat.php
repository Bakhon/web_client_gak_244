<?php
    namespace MyApp;
    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;
    
    class Chat implements MessageComponentInterface{
        protected $clients;
        protected $activeUsers;
        protected $db;

        public function __construct(){
            $this->clients = new \SplObjectStorage; 
            global $db;
            $this->db = $db;           
        }

        /**
         * When a new connection is opened it will be passed to this method
         * @param ConnectionInterface $conn The socket/connection that just connected to your application
         * @throws \Exception
         */
        function onOpen(ConnectionInterface $conn)
        {
            $this->clients->attach($conn);
            echo "New connect (".$conn->resourceId.")";
        }

        /**
         * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
         * @param ConnectionInterface $conn The socket/connection that is closing/closed
         * @throws \Exception
         */
        function onClose(ConnectionInterface $conn)
        {
            $this->clients->detach($conn);
            echo "User disconnect (".$conn->resourceId.")";
            unset($this->activeUsers[$conn->resourceId]);
        }

        /**
         * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
         * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
         * @param ConnectionInterface $conn
         * @param \Exception $e
         * @throws \Exception
         */
        function onError(ConnectionInterface $conn, \Exception $e)
        {
            $this->SetLog("Error: ".$e->getMessage());
            echo "Error: ".$e->getMessage();
            $conn->close();
        }

        /**
         * Triggered when a client sends data through the socket
         * @param \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
         * @param string $msg The message received
         * @throws \Exception
         */
        function onMessage(ConnectionInterface $from, $msg)
        {
            $message = json_decode($msg, true);                        
            if(isset($message['type'])){
                if($message['type'] == 'online'){
                    $this->activeUsers[$from->resourceId]['id'] = $message['id_user'];
                    $send_mess['type'] = 'online';
                    $send_mess['users'] = array();
                    foreach($this->activeUsers as $users){
                        array_push($send_mess['users'], $users['id']);
                    }
                    foreach($this->clients as $client){
                        $client->send(json_encode($send_mess));                        
                    }
                }
                
                if($message['type'] == 'message'){
                    $from = $message['user_from'];
                    $to = $message['user_to'];
                    $text = base64_encode($message['msg']);
                    
                    $sql = "INSERT INTO CHAT (ID_USER_FROM, ID_USER_TO, DATE_SEND, MSG, ONREAD) 
                    VALUES ('$from', '$to', sysdate, '$text', 0)";
                    
                    if(!$this->db->Execute($sql)){
                        echo $this->db->message;
                    }
                    
                    foreach($this->clients as $client){
                        echo $client->resourceId;
                            //$client->send(json_encode($send_mess));                        
                    }
                }
            }
            
                   
            echo "New Message: ".$msg."\n";
            /*
            foreach($this->clients as $client){
                $client->send($msg);
                //if($from !== $client){}
            }
            */
        }
        
        private function SetLog($txt)
        {
            $current = file_get_contents(__DIR__."/log.txt");
            $text = $current."\n".date("d.m.T H:i:s").' - '.$txt."\n----------------\n";
            file_put_contents(__DIR__."/log.txt", $text);            
        }
    }