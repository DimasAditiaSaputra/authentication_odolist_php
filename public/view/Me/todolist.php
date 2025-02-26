<!DOCTYPE html>
<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\models\todolist\TodoList;
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['is_logged_in'], $_SESSION['gmail'])) {
    header("Location: http://localhost:8080/view/auth/login.php");
    exit;
}

$todo = new TodoList();
$todolist = $todo->getAllTodoByUserId($_SESSION["user_id"]);

// create todo
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "task"){
    $userId = $_SESSION["user_id"];
    $task = $todo->createTodo($userId, $_POST["task"]);
    header("Location: todolist.php");
    exit;
}

// delete todo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
    $id = (int) $_POST["id"];
    $todo->deleteTodo($id);

    // Redirect untuk me-reload halaman setelah delete
    header("Location: todolist.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/todolist.css">
    <title>My Tasks - TodoList</title>
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
            <a href="dashboard.php">Dashboard</a>
            <a href="todolist.php" class="active">My Tasks</a>
            <a href="../auth/logout.php">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="todo-card">
            <h2>My To-Do List</h2>
            
            <form class="todo-form" action="todolist.php" method="POST">
                <input type="hidden" name="action" value="task">
                <input type="text" name="task" class="todo-input" placeholder="Add a new task..." required>
                <button type="submit" class="add-btn">Add</button>
            </form>
            
            <?php if (empty($todolist)): ?>
                <div class="empty-list">
                    You don't have any tasks yet. Add one to get started!
                </div>
            <?php else: ?>
                <ul class="todo-list">
                    <?php foreach ($todolist as $task): ?>
                        <li class="todo-item">
                                <input type="checkbox" class="todo-checkbox">
                            <span class="todo-text"><?= htmlspecialchars($task["task"]) ?></span>
                            <div class="todo-actions">
                                <form action="todolist.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                    <button type="submit" class="todo-btn delete-btn">🗑️</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <div class="action-buttons">
                <a href="dashboard.php" class="btn">Back to Dashboard</a>
            </div>
        </div>
    </div>
    
    <footer class="footer">
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }
        
        // Add event listeners for checkboxes (you may want to add AJAX functionality here)
        document.querySelectorAll('.todo-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const todoText = this.nextElementSibling;
                if (this.checked) {
                    todoText.style.textDecoration = 'line-through';
                    todoText.style.color = '#999';
                } else {
                    todoText.style.textDecoration = 'none';
                    todoText.style.color = '#333';
                }
            });
        });

    </script>
</body>
</html>