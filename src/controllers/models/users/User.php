<?php
namespace Dimas\TodolistPhp\controllers\models\users;

require_once __DIR__ . "/../../../../vendor/autoload.php";

use Dimas\TodolistPhp\controllers\config\Database;
use PDO;

class User {

    public function db(): PDO {
        $database = new Database();
        return $database->connect(); 
    }

    private function getAllUsers(): array{
        $stmt = self::db()->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserById($id): array|false {
        $stmt = self::db()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindParam("id", $id);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(){}
}

$db = new User();
var_dump($db->db());
// var_dump($db->getAllUsers());
var_dump($db->getUserById(1));
?>
