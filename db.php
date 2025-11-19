<?php
// Database configuration
$servername = "db.fr-pari1.bengt.wasmernet.com";
$username   = "d18e7e487197800051256c9ed580";
$password   = "0691d18e-7e48-7347-8000-47fa02254b0b";
$dbname     = "kesyportfolio";
$port      = 10272;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>
