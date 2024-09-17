<?php
$host = "localhost";
$username = "root";
$password = '';
$database = "ritik";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
    // Update the record
    $id = $_POST['update_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $languages = $_POST['languages'];
    $date = $_POST['date'];

    $update_stmt = $conn->prepare("UPDATE `student-table` SET `name`=?, `phone`=?, `email`=?, `languages`=?, `date`=? WHERE `SNo`=?");
    $update_stmt->bind_param("sssssi", $name, $phone, $email, $languages, $date, $id);

    if ($update_stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $update_stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM `student-table`");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border=1>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Languages</th>
                <th>Date</th>
                <th>Action</th>
            </tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($row as $col) {
            echo "<td>$col</td>";
        }
        echo "<td><a href='?update_id=" . $row['SNo'] . "'>Update</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

$stmt->close();
$conn->close();
?>

<?php
if (isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM `student-table` WHERE `SNo`=?");
    $stmt->bind_param("i", $update_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

        <form method="POST">
            <input type="hidden" name="update_id" value="<?php echo $row['SNo']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
            Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br>
            Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
            Languages: <input type="text" name="languages" value="<?php echo $row['languages']; ?>"><br>
            Date: <input type="date" name="date" value="<?php echo $row['date']; ?>"><br>
            <input type="submit" value="Update">
        </form>

<?php
    } else {
        echo "Record not found.";
    }
 
    $stmt->close();
    $conn->close();
}
?>