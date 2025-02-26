<?php
require_once __DIR__ . "./vendor/autoload.php";
use Ramsey\Uuid\Uuid;
$uuid = Uuid::uuid4();
echo $uuid->toString();

$inputPassword = "dimasaditia123"; // Password yang dimasukkan user
$hashedPasswordFromDB = '$2b$10$PJps8mImy4OHUgVqbH9kdOU82CNc41tbStHIO1KhiVfxs/2DPx4Ui'; // Hash dari database (dibuat dengan bcrypt di npm)

if (password_verify($inputPassword, $hashedPasswordFromDB)) {
    echo "Login sukses!";
} else {
    echo "Password salah!";
}


