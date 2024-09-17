<?php
$host = "localhost";
$username = "root";
$password = '';
$database = "ritik";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
                </tr>";
    foreach ($result as $row) {
        // print_r($row); 
        echo "<tr>";
        foreach ($row as  $col) {
            echo "<td>";
            echo  $col;
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}


$stmt->close();
$conn->close();

?>
