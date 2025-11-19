<?php
include '../db.php'; // Database connection

// ✅ Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Optional: delete project file if it exists
    $result = $conn->query("SELECT image_path FROM projects WHERE id = $id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file = $row['image_path'];
        if (file_exists($file)) {
            unlink($file); // remove file
        }
    }

    // Delete project from database
    $conn->query("DELETE FROM projects WHERE id = $id");

    // Redirect back to view_projects.php
    header("Location: view_projects.php");
    exit;
}

// ✅ Fetch all projects
$sql = "SELECT * FROM projects ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Projects</title>
<link rel="stylesheet" href="project.css">
</head>
<body>

<h2>All Projects</h2>

<div class="top-buttons">
    <a href="../main/home.php"><button>🏠 Home</button></a>
    <a href="create_project.php"><button>⬅ Back to Form</button></a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date Finished</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['finish_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['image_path']) . "</td>";
            echo "<td>
                    <a href='view_projects.php?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this project?');\">
                        <button class='delete-btn'>Delete</button>
                    </a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No projects found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
