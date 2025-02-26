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
    
    public function getAllTodoByUserId(int $id): array{
        $stmt = self::db()->prepare("SELECT * FROM todolist WHERE user_id = ?");
        $stmt->bindParam("user_id", $id);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createTodo(int $user_id, string $task): bool {
        $stmt = self::db()->prepare("INSERT INTO todolist (user_id, task) VALUES (:user_id, :task)");
        return $stmt->execute(['user_id' => $user_id, 'task' => $task]);
    }

    public function checkTodo(string $status, int $id): void{
        $sql = "UPDATE todolist SET status=? WHERE id=?";
        $stmt = self::db()->prepare($sql);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("id", $id);
        $stmt->execute([$status, $id]);
    }

    public function deleteTodo(int $id): void{
        $sql = "DELETE  FROM todolist WHERE id = ?";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([$id]);
        echo "berhasil delete";
    }
}

// $td = new TodoList();
// $td->db();
// $td->deleteTodo(7);
// var_dump($td->getAllTodoByUserId(1));

?>