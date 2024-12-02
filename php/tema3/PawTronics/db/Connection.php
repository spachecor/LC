<?php

/**
 * Clase Connection, que define como se realiza la conexión con la base de datos y las funciones necesarias para el
 * funcionamiendo de la conexión.
 * @author Selene
 * @version 1.0
 */
class Connection {
    private string $host;
    private string $db;
    private string $user;
    private string $pass;
    private string $dns;
    private ?PDO $connection;

    function __construct()
    {
        $this->host = "localhost";
        $this->db = "ventas_comerciales";
        $this->user = "dam";
        $this->pass = "hlc";
        $this->dns = "mysql:host=".$this->host.";dbname=".$this->db;
        $this->connection = new PDO($this->dns,$this->user,$this->pass);
        //ponemos el modo en el que nos podrá lanzar excepciones
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Functión que se encarga de destruir la conexión cuando ésta ya no sea necesaria
     */
    function __destruct()
    {
        $this->connection = null;
    }

    /**
     * Función que nos devuelve el objeto PDO que permite la conexión
     * @return PDO El objeto PDO que permite la conexión
     */
    function getConnection(): PDO
    {
        return $this->connection;
    }
}
