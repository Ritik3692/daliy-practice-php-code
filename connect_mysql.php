<?php
// session_start();
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $name = $_POST['name'] ?? '';
//     $phone = $_POST['Phone'] ?? '';
//     $email = $_POST['email_ID'] ?? '';

//     // Validate inputs
//     if (empty($name)) {
//         $_SESSION['error_message'] = "Please enter name";
//     } else {
//         // Database connection parameters
//         $host = "localhost";
//         $username = "root";
//         $password = '';
//         $database = "ritik";

//         // Create connection
//         $conn = new mysqli($host, $username, $password, $database);

//         // Check connection
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Prepare and execute SQL query
//         $stmt = $conn->prepare("INSERT INTO `user` (`Name`, `Phone`, `email`) VALUES (?, ?, ?)");
//         $stmt->bind_param("sss", $name, $phone, $email);

//         if ($stmt->execute()) {
//             echo "Data inserted successfully.<br>";
//         } else {
//             echo "Error: " . $stmt->error . "<br>";
//         }

//         // Close statement and connection
//         $stmt->close();
//         $conn->close();
//     }
// }

?>

<!-- <form method="post">
    <input type="text" placeholder="Name" name="name"> -->
    <!-- <?php
    
    // echo  $_SESSION['error_message']
     ?> -->
    <!-- <br>
    <input type="text" placeholder="Email ID" name="email_ID">
    <br>
    <input type="text" placeholder="Phone" name="Phone" maxlength="10">
    <button type="submit" name="btn">Done</button>
</form> -->
<?php
session_start();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['Phone'] ?? '';
    $email = $_POST['email_ID'] ?? '';

    // Validate inputs
    if (empty($name)) {
        $error_message = "Please enter name";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "Please enter a valid 10-digit phone number";
    } else {
        // Database connection parameters
        $host = "localhost";
        $username = "root";
        $password = '';
        $database = "ritik";

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query
        $stmt = $conn->prepare("INSERT INTO `user` (`Name`, `Phone`, `email`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $email);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Data inserted successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    // Set the error message in the session if there is one
    if (!empty($error_message)) {
        $_SESSION['error_message'] = $error_message;
    }
}

?>

<form method="post">
<br>
   
   <br>
<?php
    if (isset($_SESSION['error_message'])) {
        echo htmlspecialchars($_SESSION['error_message']);
        unset($_SESSION['error_message']); // Clear the error message after displaying it
    }
    
    if (isset($_SESSION['success_message'])) {
        echo htmlspecialchars($_SESSION['success_message']);
        unset($_SESSION['success_message']); // Clear the success message after displaying it
    }
    ?>
      <br>
    <input type="text" placeholder="Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>">
    <br>
    <input type="text" placeholder="Email ID" name="email_ID" value="<?php echo htmlspecialchars($_POST['email_ID'] ?? '') ?>">
    <br>
    <input type="text" placeholder="Phone" name="Phone" maxlength="10" value="<?php echo htmlspecialchars($_POST['Phone'] ?? '') ?>">
    <br>
    <button type="submit" name="btn">Done</button>
</form>

