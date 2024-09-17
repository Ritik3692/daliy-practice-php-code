<?php
session_start();
if (!isset($_SESSION['success_message'])) {
    header("Location: log.php");
    exit();
}

echo "Welcome to the protected page!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to your dashboard!</h1>
     <button> log out</button>
</body>
</html>
