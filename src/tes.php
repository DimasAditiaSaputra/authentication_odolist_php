<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Ramsey\Uuid\Uuid;
$uuid = Uuid::uuid4();
echo $uuid->toString() . PHP_EOL;


$password = "mypassword"; // Password asli
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

echo $hashedPassword . PHP_EOL;

$inputPassword = "mypassword"; // Password yang diinput user
if (password_verify($inputPassword, $hashedPassword)) {
    echo "Password benar!";
} else {
    echo "Password salah!";
}