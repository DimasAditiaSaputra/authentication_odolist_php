<?php
namespace Dimas\TodolistPhp\controllers\models\todolist;

require_once __DIR__ . "/../../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\config\Database;
use PDO;

class TodoList{

    public function db(): PDO {
        $database = new Database();
        return $database->connect(); // Simpan koneksi ke $db
    }

    public function getAllTodo(): array{
        $stmt = self::db()->prepare("SELECT * FROM todolist");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

$td = new TodoList();
$td->db();
// var_dump($td->getAllTodo());

?>