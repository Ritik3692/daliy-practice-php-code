<?php

session_start();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (empty($password)) {
        $error_message = "Please enter a password";
    } else {
       
        
        include("./conn.php");

        $db = $conn->prepare("SELECT password FROM `user_info` WHERE email =?");
      


        if ($db === false) {
            die("Prepare failed: " . $conn->error);
        }
       
        $db->bind_param("s", $email);
        $db->execute();
        $db->bind_result($hashed_password_from_db);
        $db->fetch();

        if (password_verify($password, $hashed_password_from_db)) {
            $_SESSION['success_message'] = "Login successful";

            header("Location: tutut.php");
            exit();
        } else {
            $error_message = "Invalid email or password";
        }

        $db->close();
        $conn->close();
    }

    if (!empty($error_message)) {
        $_SESSION['error_message'] = $error_message;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stlye.css">
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Hidden brand</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./log.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="./signup.php">sign up</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="login-mean-box">
        <div class="login-box">
            <form method="POST" class="form-box">
               <h2>Login </h2>
                <input type="email" placeholder="Email" name="email"><br><br>
                <input type="password" placeholder="Password" name="password"><br><br>
                <?php
                if (isset($_SESSION['error_message'])) {
                    echo htmlspecialchars($_SESSION['error_message']);
                    unset($_SESSION['error_message']);
                }

                if (isset($_SESSION['success_message'])) {
                    echo htmlspecialchars($_SESSION['success_message']);
                    unset($_SESSION['success_message']);
                }
                ?>
                <div class="button-box"> <button type="submit">Login</button></div>
        </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>