<?php
// Database configuration
$servername = "localhost";
$db_username = "root";  // Update if necessary
$db_password = "";      // Update if necessary
$dbname = "cadibel";

// Create database connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
