<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
echo "<h2>Welcome, Teacher!</h2>";
?>

<a href="logout.php">Logout</a>
<h3>Upload a new material</h3>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    File: <input type="file" name="material" required><br>
    <button type="submit">Upload</button>
</form>

<h3>Your uploaded materials:</h3>
<?php
$result = $conn->query("SELECT * FROM materials WHERE teacher_id = $user_id ORDER BY uploaded_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<h4>{$row['title']}</h4>";
    echo "<a href='{$row['file_path']}' target='_blank'>View</a><br>";
}
