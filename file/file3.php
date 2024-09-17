<?php
$host = "localhost";
$username = "root";
$password = '';
$database = "ritik";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_stmt = $conn->prepare("DELETE FROM `student-table` WHERE SNo = ?");
    $delete_stmt->bind_param("i", $delete_id);
    $delete_stmt->execute();
    $delete_stmt->close();
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
                  <th>Action</th>
                </tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($row as $col) {
            echo "<td>";
            echo  $col;
            echo "</td>";
        }
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='delete_id' value='" . $row['SNo'] . "'>
                    <input type='submit' value='Delete'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

$stmt->close();
$conn->close();
?>