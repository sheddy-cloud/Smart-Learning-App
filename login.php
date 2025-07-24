<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and password is valid
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'student') {
                header("Location: student.php");
                exit();
            } elseif ($user['role'] === 'teacher') {
                header("Location: teacher.php");
                exit();
            } else {
                echo "Invalid role assigned. Contact admin.";
            }
        } else {
            echo "Incorrect password. <a href='loginForm.php'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='loginForm.php'>Try again</a>";
    }
} else {
    header("Location: loginForm.php");
    exit();
}
