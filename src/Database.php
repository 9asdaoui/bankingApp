<?php
class DatabaseConnection
{
    private $host = 'localhost';
    private $db = 'customerdb';
    private $user = 'root';
    private $pass = 'redaader@2000';
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db}";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Connection failed: " . $ex->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}

?>
