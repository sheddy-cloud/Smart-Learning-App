<!DOCTYPE html>
<html>
<head>
    <title>EduLearn - Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="registerForm.php">Register here</a></p>
</body>
</html>
