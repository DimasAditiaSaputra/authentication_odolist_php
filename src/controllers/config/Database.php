<?php
namespace Dimas\TodolistPhp\controllers\config;

use PDO;
use PDOException;

class Database {

    public function __construct(
        private string $servername = "localhost",
        private string $username = "root",
        private string $password = "dimasroot123",
        private string $database = "todolist_db"
    ) {}

    public function connect(): ?PDO {
        try {
            $conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public static function tes(): void {
        echo "hello";
    }
}

// $db = new Database("localhost", "root", "dimasroot123", "todolist_db");
// $db->connect();
?>
