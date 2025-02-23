<?php
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['is_logged_in'], $_SESSION['gmail'])) {
    header("Location: http://localhost:8080/view/auth/login.php");
    exit;
}

$uuid = $_SESSION['user_id'];
$gmail = $_SESSION['gmail'];
$is_login = $_SESSION['is_logged_in'];

$message = "uuid: " . htmlspecialchars($uuid) . " gmail: " . htmlspecialchars($gmail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello</h1>
    <h3><?php echo $message; ?></h3>
</body>
</html>
