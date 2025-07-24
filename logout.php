<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Optional: clear session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to landing page or login
header("Location: index.php"); // or loginForm.php if you prefer
exit();
