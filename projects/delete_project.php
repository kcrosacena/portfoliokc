<?php
include '../db.php'; // database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input
    if ($conn->query("DELETE FROM projects WHERE id = $id")) {
        echo "Project deleted successfully!";
    } else {
        echo "Error deleting project: " . $conn->error;
    }
}
?>

