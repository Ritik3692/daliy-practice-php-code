<?php

// session_start();
// $error_message = '';
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $first_name = $_POST['first_name'] ?? '';
//     $sec_name = $_POST['sec_name'] ?? '';
//     $email = $_POST['email'] ?? '';
//     $phone = $_POST['phone'] ?? '';
//     $password = $_POST['password'] ?? '';
//     $password_confirmation = $_POST['new_password'] ?? '';

//     if (empty($first_name)) {
//         $error_message = "Please enter first_name";
//     } elseif (empty($sec_name)) {
//         $error_message = "Please enter sec_name";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $error_message = "Please enter a valid email address";
//     } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
//         $error_message = "Please enter a valid 10-digit phone number";
//     } elseif (empty($password )) {
//         $error_message = "Please select a new password";
//     } elseif (empty($password_confirmation )) {
//         $error_message = "Please enter password";
//     } else {

//         $host = "localhost";
//         $username = "root";
//         $password = "";
//         $database = "log_info";

//         $conn = new mysqli($host, $username, $password, $database);
//         if ($conn->connect_error) {

//             die("connection failed" . $conn->connect_error);
//         }
//         $db = $conn->prepare("INSERT INTO `user_info` (`first_name`, `sec_name`, `email`, `phone`, `new_password`, `password`) VALUES (?, ?, ?, ?, ?, ?);");


//         if ($db === false) {
//             die("Prepare failed: " . $conn->error);
//         }

//         $db->bind_param("ssssss", $first_name, $sec_name, $email, $phone, $new_password, $password);
//         if ($db->execute()) {
//             $_SESSION['success_message'] = "data inserted successfully";
//         } else {
//             $error_message = "error" . $db->error;
//         }

//         $db->close();
//         $conn->close();
//         header("Location" . $_SERVER['REQUEST_URI']);
//         exit();
//     }
//     if (!empty($error_message)) {
//         $_SESSION['error_message'] = $error_message;
//     }
// }
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="mean-signup-box">
        <form  method="POST">
            <br><br>
        <?php
        // if (isset($_SESSION['error_message'])) {
        //     echo htmlspecialchars($_SESSION['error_message']);
        //     unset($_SESSION['error_message']);
        // }

        // if (isset($_SESSION['success_message'])) {
        //     echo htmlspecialchars($_SESSION['success_message']);
        //     unset($_SESSION['success_message']);
        // }

        ?>
            <div class="signup-box">
                <input type="text" placeholder=" first name" name="first_name"><br><br>
                <input type="text" placeholder="sec name" name="sec_name"><br>
                <input type="text" placeholder="email" name="email"><br>
                <input type="text" placeholder="phone number" name="phone"><br>
                <input type="text" placeholder="new password" type="password" name="password"><br>
                <input type="text" placeholder="password" type="password" name="new_password"><br>
                <a src="./log.php"><button>Login </button></a>
                <button>sign Up</button>

            </div>
        </form>
    </div>
</body>

</html> -->


<?php
session_start();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $sec_name = $_POST['sec_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirmation = $_POST['new_password'] ?? '';

    if (empty($first_name)) {
        $error_message = "Please enter first name";
    } elseif (empty($sec_name)) {
        $error_message = "Please enter second name";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "Please enter a valid 10-digit phone number";
    } elseif (empty($password)) {
        $error_message = "Please enter a password";
    } elseif ($password !== $password_confirmation) {
        $error_message = "Passwords do not match";
    } else {
        // $host = "localhost";
        // $username = "root";
        // $db_password = ""; 
        // $database = "log_info";

        // $conn = new mysqli($host, $username, $db_password, $database);

        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
        include "./conn.php";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $db = $conn->prepare("INSERT INTO `user_info` (`first_name`, `sec_name`, `email`, `phone`, `password`) VALUES (?, ?, ?, ?, ?);");

        if ($db === false) {
            die("Prepare failed: " . $conn->error);
        }

        $db->bind_param("sssss", $first_name, $sec_name, $email, $phone, $hashed_password);
        if ($db->execute()) {
            $_SESSION['success_message'] = "Data inserted successfully";
        } else {
            $error_message = "Error: " . $db->error;
        }

        $db->close();
        $conn->close();
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
        
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
    <title>Registration</title>
    
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

    <div class="mean-signup-box ">
        <form method="POST">
             <h3>SIGN UP</h3>
            <div class="signup-box">
                <input type="text" placeholder="First Name" name="first_name">
               
                <input type="text" placeholder="Second Name" name="sec_name"><br>
                
                <input type="email" placeholder="Email" name="email"><br>
                <input type="text" placeholder="Phone Number" name="phone"><br>
                <input type="password" placeholder="Password" name="password"><br>
                <input type="password" placeholder="Confirm Password" name="new_password"><br>
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
                <div class="button-box">
                <button type="submit" class="">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>