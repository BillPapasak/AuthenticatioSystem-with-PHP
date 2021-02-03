<?php
//class that create an pdo connection

require_once("Connection.php");

class PdoConnection implements Connection {
    
    public function createConnection()  {
        $config = include('Credentials.php');

        try {
            return new PDO("mysql:host={$config['HOST']};dbname={$config['DATABASE']}", $config['USERNAME'], $config['PASSWORD']);
            //$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch( Exception $e) {
            echo "Error:".$e->getMessage();
        }
    }
}
?>