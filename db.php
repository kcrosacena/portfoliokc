<?php
// Database configuration
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "kesyportfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>
