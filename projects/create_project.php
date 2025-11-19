<?php
// FIX: Correct include path depending on folder structure
include '../db.php'; // change this if db.php is inside main or root folder

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $finish_date = $_POST['finish_date']; // FIXED: correct variable name

    // Handle Image Upload
    $imageName = $_FILES['image']['name'];
    $imageTmp  = $_FILES['image']['tmp_name'];

    // Create uploads folder if not existing
    $uploadDir = "../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Full path to save image
    $imagePath = $uploadDir . $imageName;

    // Move uploaded file to uploads directory
    if (move_uploaded_file($imageTmp, $imagePath)) {

        // Insert using prepared statement
        $stmt = $conn->prepare(
            "INSERT INTO projects (title, description, finish_date, image_path)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $title, $description, $finish_date, $imageName); // FIXED

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Project added successfully!</p>";
        } else {
            echo "<p style='color:red;'>❌ Database Error: " . $stmt->error . "</p>";
        }

    } else {
        echo "<p style='color:red;'>❌ Failed to upload image!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>

<h2>Create a New Project</h2>

<form action="create_project.php" method="POST" enctype="multipart/form-data">

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="finish_date">Finish Date:</label><br>
    <input type="date" id="finish_date" name="finish_date" required><br><br>

    <label for="image">Image:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>

    <input type="submit" value="Create Project">
</form>

<br>

<form action="view_project.php" method="get">
    <button type="submit">View Projects</button>
</form>

</body>
</html>
