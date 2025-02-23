<?php
$inputPassword = "dimasaditia123"; // Password yang dimasukkan user
$hashedPasswordFromDB = '$2b$10$PJps8mImy4OHUgVqbH9kdOU82CNc41tbStHIO1KhiVfxs/2DPx4Ui'; // Hash dari database (dibuat dengan bcrypt di npm)

if (password_verify($inputPassword, $hashedPasswordFromDB)) {
    echo "Login sukses!";
} else {
    echo "Password salah!";
}