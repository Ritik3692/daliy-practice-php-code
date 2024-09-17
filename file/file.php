<?php
session_start();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['Phone'] ?? '';
    $email = $_POST['email_ID'] ?? '';
    $languages = $_POST['languages'] ?? [];
    $date = $_POST['date'] ?? '';

    if (empty($name)) {
        $error_message = "Please enter name";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "Please enter a valid 10-digit phone number";
    } elseif (empty($languages)) {
        $error_message = "Please select a programming language";
    } elseif (empty($date)) {
        $error_message = "Please enter a date";
    } else {


        $host = "localhost";
        $username = "root";
        $password = '';
        $database = "ritik";

        $conn = new mysqli($host, $username, $password, $database);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $stmt = $conn->prepare("INSERT INTO `student-table` (`Name`, `email`, `Phone`, `languages`, `date`) VALUES (?, ?, ?, ?, ?)");


        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $languages_str = implode(',', $languages);
        $stmt->bind_param("sssss", $name, $email, $phone, $languages_str, $date);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Data inserted successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }


        $stmt->close();
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
    <link rel="stylesheet" href="style.css">
    <title>Form with Date and Checkbox</title>
</head>

<body>
    <div class="form-box-mean">
        <div class="form-box-inner">
            <form method="post">

                <br>
                <input type="text" class="yo" placeholder="Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>">
                <br>
                <input type="text" class="yo" placeholder="Email ID" name="email_ID" value="<?php echo htmlspecialchars($_POST['email_ID'] ?? '') ?>">
                <br>
                <input type="text" class="yo" placeholder="Phone" name="Phone" maxlength="10" value="<?php echo htmlspecialchars($_POST['Phone'] ?? '') ?>">
                <br>

                <label><input type="checkbox" class="to" name="languages[]" value="Java"> Java</label>

                <label><input type="checkbox" class="to" name="languages[]" value="C++"> C++</label>

                <label><input type="checkbox" class="to" name="languages[]" value="PHP"> PHP</label>
                <br>

                <label>Date:</label>
                <input type="date" name="date" class="done" value="<?php echo htmlspecialchars($_POST['date'] ?? '') ?>">
                <br>
               <br>
                <div class="button-box">
                <button type="submit" name="btn">Done</button>
                </div>
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
            </form>
        </div>
    </div>
</body>

</html>