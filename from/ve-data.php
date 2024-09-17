<?php
session_start();
$error_message = '';

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['Phone'] ?? '';
    $email = $_POST['email_ID'] ?? '';
    $languages = $_POST['languages'] ?? [];
    $id = $_POST['id'] ?? null;

    // Validate inputs
    if (empty($name)) {
        $error_message = "Please enter name";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "Please enter a valid 10-digit phone number";
    } elseif (empty($languages)) {
        $error_message = "Please select a programming language";
    } else {
        // Prepare and execute SQL query
        $languages_str = implode(',', $languages); // Convert array to comma-separated string
        if ($id) {
            // Update existing record
            $stmt = $conn->prepare("UPDATE `user` SET `Name` = ?, `Phone` = ?, `email` = ?, `languages` = ? WHERE `id` = ?");
            $stmt->bind_param("ssssi", $name, $phone, $email, $languages_str, $id);
        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO `user` (`Name`, `Phone`, `email`, `languages`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $phone, $email, $languages_str);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Data inserted/updated successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();

        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    // Set the error message in the session if there is one
    if (!empty($error_message)) {
        $_SESSION['error_message'] = $error_message;
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM `user` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success_message'] = "Data deleted successfully.";

    // Redirect to the same page to prevent form resubmission
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Fetch all records from the database
$result = $conn->query("SELECT * FROM `user`");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Handling</title>
    <script>
        function populateForm(id, name, email, phone, languages) {
            document.querySelector('input[name="id"]').value = id;
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('input[name="email_ID"]').value = email;
            document.querySelector('input[name="Phone"]').value = phone;
            
            var languageCheckboxes = document.querySelectorAll('input[name="languages[]"]');
            languageCheckboxes.forEach(function(checkbox) {
                checkbox.checked = languages.includes(checkbox.value);
            });
        }
    </script>
</head>
<body>
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
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id'] ?? '') ?>">
    <input type="text" placeholder="Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>">
    <br>
    <input type="text" placeholder="Email ID" name="email_ID" value="<?php echo htmlspecialchars($_POST['email_ID'] ?? '') ?>">
    <br>
    <input type="text" placeholder="Phone" name="Phone" maxlength="10" value="<?php echo htmlspecialchars($_POST['Phone'] ?? '') ?>">
    <br>
    <label><input type="checkbox" name="languages[]" value="Java" <?php if (isset($_POST['languages']) && in_array('Java', $_POST['languages'])) echo 'checked'; ?>> Java</label>
    <br>
    <label><input type="checkbox" name="languages[]" value="C++" <?php if (isset($_POST['languages']) && in_array('C++', $_POST['languages'])) echo 'checked'; ?>> C++</label>
    <br>
    <label><input type="checkbox" name="languages[]" value="PHP" <?php if (isset($_POST['languages']) && in_array('PHP', $_POST['languages'])) echo 'checked'; ?>> PHP</label>
    <br>
    <button type="submit" name="btn">Done</button>
</form>

<h2>Data &  Update from Database</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Languages</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Phone']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['languages']); ?></td>
            <td>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                <a href="#" onclick="populateForm('<?php echo $row['id']; ?>', '<?php echo $row['Name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['Phone']; ?>', '<?php echo $row['languages']; ?>')">Edit</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
