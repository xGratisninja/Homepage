<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homepage";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check for connection
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>