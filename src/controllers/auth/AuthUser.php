<?php
namespace Dimas\TodolistPhp\controllers\auth;
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\config\Database;
use PDO;
use PDOException;

class AuthUser{

    public function db(): PDO {
        $database = new Database();
        return $database->connect(); 
    }

    public function login(string $gmail, string $password): array {
        try {
            // Cek credentials
            $sql = "SELECT * FROM users WHERE gmail = :gmail";
            $statement = $this->db()->prepare($sql);
            $statement->execute([':gmail' => $gmail]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Set session jika login berhasil
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['gmail'] = $user['gmail'];
                $_SESSION['is_logged_in'] = true;

                return [
                    'status' => true,
                    'message' => 'Login berhasil',
                    'user' => [$user["uuid"], $user["gmail"]]
                ];
            }

            return [
                'status' => false,
                'message' => 'Username atau password salah'
            ];

        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

   public function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: http://localhost:8080/view/auth/login.php');
        exit;
    }

}

// $auth = new AuthUser();
// $result = $auth->login("dimasaditia@gmail.com", "dimasaditia123");
// var_dump($result);

?>