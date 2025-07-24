<?php
session_start();
include 'includes/db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginForm.php");
    exit();
}

$role = $_SESSION['role'];
$userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>SmartDashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #003f8a;
            color: #fff;
            padding: 20px;
            flex-shrink: 0;
        }

        .sidebar h2 {
            margin-top: 0;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            margin: 15px 0;
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background: #f0f2f5;
            overflow-y: auto;
        }

        .header {
            background: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        .header span {
            float: right;
        }

        .material {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Smart Learn</h2>
    <p>Welcome, <strong><?= htmlspecialchars($role) ?></strong></p>
    <a href="dashboard.php">Dashboard</a>
    <?php if ($role === 'teacher'): ?>
        <a href="upload.php">Upload Material</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <div class="header">
        <h3>Dashboard</h3>
        <span>Role: <?= ucfirst($role) ?></span>
    </div>

    <?php
    if ($role === 'teacher') {
        echo "<h3>My Uploaded Materials</h3>";

        $stmt = $conn->prepare("SELECT * FROM materials WHERE teacher_id = ? ORDER BY uploaded_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $materials = $stmt->get_result();

        while ($row = $materials->fetch_assoc()) {
            echo "<div class='material'>";
            echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
            echo "<a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View</a>";
            echo "</div>";
        }

    } elseif ($role === 'student') {
        echo "<h3>Available Materials</h3>";

        $result = $conn->query("SELECT * FROM materials ORDER BY uploaded_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='material'>";
            echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
            if ($row['file_type'] === 'pdf') {
                echo "<a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View PDF</a>";
            } elseif (strpos($row['file_type'], 'video') !== false) {
                echo "<video width='320' controls><source src='" . htmlspecialchars($row['file_path']) . "' type='" . htmlspecialchars($row['file_type']) . "'></video>";
            } else {
                echo "<a href='" . htmlspecialchars($row['file_path']) . "'>Download File</a>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>Unknown role. Contact support.</p>";
    }
    ?>
</div>

</body>
</html>
