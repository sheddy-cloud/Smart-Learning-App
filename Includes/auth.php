<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
echo "<h2>Welcome, Student!</h2>";

// Show materials
$result = $conn->query("SELECT * FROM materials ORDER BY uploaded_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<h4>{$row['title']}</h4>";
    if ($row['file_type'] === 'pdf') {
        echo "<a href='{$row['file_path']}' target='_blank'>View PDF</a><br>";
    } else {
        echo "<video width='320' controls><source src='{$row['file_path']}' type='video/mp4'></video><br>";
    }
}
?>
<a href='logout.php'>Logout</a>
