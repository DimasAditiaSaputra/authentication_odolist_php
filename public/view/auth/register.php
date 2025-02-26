<!DOCTYPE html>
<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\models\users\User;
use Ramsey\Uuid\Uuid;

session_start();

// Inisialisasi variabel
$uuid = Uuid::uuid4();
$user = new User();
$message = "";
$messageType = "";

// Proses form register
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "register") {
    // Sanitasi input
    $uuid = trim(htmlspecialchars($_POST["uuid"]));
    $username = trim(htmlspecialchars($_POST["username"]));
    $gmail = trim(filter_var($_POST["gmail"], FILTER_SANITIZE_EMAIL));
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Validasi input
    $isValid = true;
    
    if(empty($uuid) || empty($username) || empty($gmail) || empty($password)) {
        $message = "Semua field harus diisi";
        $messageType = "error";
        $isValid = false;
    } else if($password !== $confirm_password) {
        $message = "Password tidak cocok";
        $messageType = "error";
        $isValid = false;
    } else if(strlen($password) < 8) {
        $message = "Password minimal 8 karakter";
        $messageType = "error";
        $isValid = false;
    }
    
    if($isValid) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        try {
            // Buat akun
            $user->createAccount($uuid, $username, $gmail, $hashedPassword);
            
            // Set pesan sukses dalam session
            $_SESSION['register_success'] = true;
            $_SESSION['message'] = "Registrasi berhasil! Silahkan login.";
            $_SESSION['message_type'] = "success";
            
            // Redirect ke halaman yang sama untuk reset form
            header("Location: register.php");
            exit();
        } catch (Exception $e) {
            $message = "Terjadi kesalahan: " . $e->getMessage();
            $messageType = "error";
        }
    }
}

// Cek apakah ada pesan sukses dari session
if(isset($_SESSION['register_success']) && $_SESSION['register_success']) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['message_type'];
    
    // Hapus pesan dari session agar tidak muncul lagi saat refresh
    unset($_SESSION['register_success']);
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/register.css">
    <title>Register - TodoList</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo">TodoList</div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-links" id="navLinks">
            <a href="/">Home</a>
            <a href="#">Features</a>
            <a href="#">About</a>
            <a href="login.php">Login</a>
            <a href="register.php" class="active">Register</a>
        </div>
    </nav>
    
    <div class="container">
        <h2>Create an Account</h2>
        
        <?php if(!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="register.php" id="registerForm">
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="uuid" value="<?= $uuid->toString(); ?>">
            <input type="text" name="username" placeholder="Full Name" required>
            <input type="email" name="gmail" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required minlength="8">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required minlength="8">
            <button type="submit">Register</button>
            <div class="redirect">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </form>
    </div>
    
    <footer class="footer">
        &copy; 2025 TodoList. All rights reserved.
    </footer>
    
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }
        
        // Form validation
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message error';
                messageDiv.textContent = 'Passwords do not match';
                
                // Remove any existing error messages
                const existingMessages = document.querySelectorAll('.message');
                existingMessages.forEach(msg => msg.remove());
                
                // Insert the error message before the form
                form.parentNode.insertBefore(messageDiv, form);
            }
        });
        
        // Auto-hide success message after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.message.success');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>
</html>