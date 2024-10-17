

//2.Write a PHP dynamic script for login page with appropriate validations.
//register2.php, register2_process.php,login.php, dashboard.php,logout.phps

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="register2_process.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br><br>

        <input type="submit" name="register" value="Register">
    </form>

    <!-- Display error messages if any -->
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color:red;">' . $_GET['error'] . '</p>';
    }
    if (isset($_GET['success'])) {
        echo '<p style="color:green;">Registration successful! You can <a href="login.php">login</a> now.</p>';
    }
    ?>
</body>
</html>
