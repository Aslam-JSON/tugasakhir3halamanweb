<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tugas_akhir";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
