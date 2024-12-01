<?php
class Connection {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dns;
    private $connection;

    function __construct() {
        $this->host = "localhost";
        $this->db = "ventas_comerciales";
        $this->user = "dam";
        $this->pass = "hlc";
        $this->dns = "mysql:host=".$this->host.";dbname=".$this->db;
        $this->connection = new PDO($this->dns,$this->user,$this->pass);
        //ponemos el modo en el que nos podrá lanzar excepciones
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    function __destruct() {
        $this->connection = null;
    }
    function getConnection() {
        return $this->connection;
    }
}
