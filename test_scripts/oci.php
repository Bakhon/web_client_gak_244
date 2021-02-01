<?php
    class PDOConnection {

        private $dbh;
    
        function __construct() {
            try {
    
                $server         = "192.168.5.3";
                $db_username    = "INSURANCE";
                $db_password    = "insurance";
                $service_name   = "ORCL";
                $sid            = "ORCL";
                $port           = 1521;
                $dbtns          = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $server)(PORT = $port)) (CONNECT_DATA = (SERVICE_NAME = $service_name) (SID = $sid)))";
    
                //$this->dbh = new PDO("mysql:host=".$server.";dbname=".dbname, $db_username, $db_password);
    
                $this->dbh = new PDO("oci:dbname=" . $dbtns . ";charset=utf8", $db_username, $db_password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public function select($sql) {
            $result = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);                         
            return $result;
        }
    
        public function insert($sql) {
            $sql_stmt = $this->dbh->prepare($sql);
            try {
                $result = $sql_stmt->execute();
            } catch (PDOException $e) {
                trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
            }
            if ($result) {
                return $sql_stmt->rowCount();
            }
        }
    
        function __destruct() {
            $this->dbh = NULL;
        }
    
    }
    
    $dbh = new PDOConnection();
    
    $select_sql = "select * from dic_branch";
    $q = $dbh->select($select_sql);
    echo '<pre>';
    print_r($q);
    exit;
    //$dbh->insert($insert_sql);