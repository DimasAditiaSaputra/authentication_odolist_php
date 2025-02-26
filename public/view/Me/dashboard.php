<?php
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['is_logged_in'], $_SESSION['gmail'])) {
    header("Location: http://localhost:8080/view/auth/login.php");
    exit;
}

$uuid = $_SESSION['user_id'];
$gmail = $_SESSION['gmail'];
$is_login = $_SESSION['is_logged_in'];

$data = "uuid: " . htmlspecialchars($uuid) . " gmail: " . htmlspecialchars($gmail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>Dashboard - TodoList</title>
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
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="todolist.php">My Tasks</a>
            <a href="../auth/logout.php">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="welcome-card">
            <h1>Welcome to Your Dashboard</h1>
            <h3><?php echo $data; ?></h3>
            <div class="action-buttons">
                <a href="todolist.php" class="btn">View My Tasks</a>
                <a href="../auth/logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>
        
        <div class="stats-card">
            <h2 class="stats-title">Your Activity</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Tasks Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Tasks Pending</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Days Active</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>