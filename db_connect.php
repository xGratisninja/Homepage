<script src="js/ErrorHandler.js"></script>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homepage";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check for connection

if (mysqli_connect_error()) {
    $ErrorMessage = ("Connection failed: " . mysqli_connect_error());
    echo "<script>Error('$ErrorMessage','alert');</script>";
}
?>