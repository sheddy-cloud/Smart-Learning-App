<!DOCTYPE html>
<html>
<head>
    <title>Login - SmartLearn</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label><input type="checkbox" name="remember"> Remember Me</label>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="registerForm.php">Register here</a></p>
    </div>
</body>
</html>
