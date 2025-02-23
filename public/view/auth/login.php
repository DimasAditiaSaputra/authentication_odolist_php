<!DOCTYPE html>
<?php 
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\auth\AuthUser;

session_start();
$auth = new AuthUser();

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $result = $auth->login($_POST['gmail'], $_POST['password']);
    
    if ($result['status']) {
        header('Location: /dashboard.php'); // Arahkan ke dashboard setelah login
        exit;
    }
    $loginError = $result['message'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <div class="container" id="login">
        <h2>Login</h2>
        <?php if (isset($loginError)): ?>
            <div class="error-message"><?php echo htmlspecialchars($loginError); ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="hidden" name="action" value="login">
            <input type="email" name="gmail" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <!-- <p class="switch">Belum punya akun? <a href="#" onclick="toggleForm()">Register</a></p> -->
        </form>
    </div>
    <script src="../../javascript/login.js"></script>
</body>
</html>
