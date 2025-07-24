<!DOCTYPE html>
<html>
<head>
    <title>SmartLearn- Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="register.php" onsubmit="return validateForm()">
        <label>Username:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" id="confirm_password" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="">-- Select Role --</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="loginForm.php">Login here</a></p>

    <script src="assets/form.js"></script>
</body>
</html>
