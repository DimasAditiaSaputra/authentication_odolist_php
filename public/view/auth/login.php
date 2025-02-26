<!DOCTYPE html>
<?php 
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\auth\AuthUser;
session_start();

$auth = new AuthUser();

if (isset($_SESSION['user_id'], $_SESSION['is_logged_in'], $_SESSION['gmail'])) {
    header("Location: http://localhost:8080/view/Me/dashboard.php");
    exit;
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $result = $auth->login($_POST['gmail'], $_POST['password']);
    
    if ($result['status']) {
        header('Location: http://localhost:8080/view/Me/dashboard.php'); 
        exit;
    }
    $loginError = $result['message'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Login - TodoList</title>
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
            <a href="http://localhost:8080">Home</a>
            <a href="#">Features</a>
            <a href="#">About</a>
            <a href="login.php" class="active">Login</a>
            <a href="register.php">Register</a>
        </div>
    </nav>
    
    <div class="container">
        <h2>Login to TodoList</h2>
        <div id="errorMessage" class="error-message" style="display: none;"></div>
        <form method="POST" action="login.php">
            <input type="hidden" name="action" value="login">
            <input type="email" name="gmail" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <div class="redirect">
                Don't have an account? <a href="register.php">Register</a>
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
        
        // Display error message if needed
        function showError(message) {
            const errorElement = document.getElementById('errorMessage');
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
        
        // Check for PHP error messages
        <?php if (isset($loginError)): ?>
            showError('<?php echo addslashes($loginError); ?>');
        <?php endif; ?>
    </script>
</body>
</html>