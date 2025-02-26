<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Home - TodoList</title>
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
            <a href="#index.php">Home</a>
            <a href="#">Features</a>
            <a href="#">About</a>
            <a href="http://localhost:8080/view/auth/login.php">Login</a>
            <a href="http://localhost:8080/view/auth/register.php">Register</a>
        </div>
    </nav>
    
    <div class="hero">
        <h1>Welcome to TodoList</h1>
        <p>Ini adalah website TodoList yang membantu Anda mengelola tugas sehari-hari dengan mudah dan efisien. Mulai organisir tugas Anda sekarang juga!</p>
        <a href="register.html" class="btn">Mulai Sekarang</a>
    </div>
    
    <footer class="footer">
        &copy; 2025 TodoList. All rights reserved.
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>