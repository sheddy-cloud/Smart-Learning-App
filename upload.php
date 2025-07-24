<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    die("Unauthorized access.");
}

$title = $_POST['title'];
$description = $_POST['description'];
$subject = $_POST['subject'];

$uploadDir = "uploads/";
$filename = basename($_FILES["material"]["name"]);
$targetFile = $uploadDir . time() . "_" . $filename;

$allowedTypes = ['pdf', 'docx', 'pptx', 'mp4', 'webm', 'png', 'jpg'];
$fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (!in_array($fileExt, $allowedTypes)) {
    die("Unsupported file type.");
}

if (move_uploaded_file($_FILES["material"]["tmp_name"], $targetFile)) {
    // Save metadata to database (you can skip this if no DB for now)
    echo "<p>Material uploaded successfully.</p>";
    echo "<a href='uploadForm.php'>Upload Another</a> | <a href='teacher.php'>Back to Dashboard</a>";
} else {
    echo "Failed to upload file.";
}
?>
