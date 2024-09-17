<?php

$host = "localhost";
$username = "root";
$db_password = "";   
$database = "log_info";

$conn = new mysqli($host, $username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
