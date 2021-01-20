<?php 
Class Database
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->db = "movieXDatabase";
    }
    public function connect()
    {
        $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db.";", $this->user, $this->pass);
        $conn->exec("set names utf8");
        return $conn;
    }
}
?>