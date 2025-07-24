<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user from DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check user existence and password match
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect to dashboard (shared for both roles)
            header("Location: dashboard.php");
            exit();
        } else {
     $_SESSION['login_error'] = "Invalid credentials.";
header("Location: loginForm.php");
exit();

        }
    } else {
        echo "User not found. <a href='loginForm.php'>Try again</a>";
    }
} else {
    header("Location: loginForm.php");
    exit();

}if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    // Set cookie if remember me checked
    if (!empty($_POST['remember'])) {
        setcookie("user_id", $user['id'], time() + (86400 * 30), "/"); // 30 days
    }

    header("Location: dashboard.php");
    exit();
}

