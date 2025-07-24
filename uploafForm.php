<?php
session_start();

// Allow only teachers
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: loginForm.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Material - SmartLearn</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Upload Learning Material</h2>

   <form method="post" action="upload.php" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Subject:</label><br>
    <input type="text" name="subject" required><br><br>

    <label>Select Material (PDF, DOCX, MP4, etc.):</label><br>
    <input type="file" name="material" required><br><br>

    <button type="submit">Upload</button>
</form>


        <button type="submit">Upload</button>
    </form>
</div>
</body>
</html>
