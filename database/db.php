<?php
class Database {
    private $host = "localhost";
    private $db_name = "websiteDB";
    private $username = "root";
    private $password = "";
    public $pdo;

    public function getConnection() {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo("Chyba pripojenia k databáze: " . $e->getMessage());
        }
        return $this->pdo;
    }
}
?>