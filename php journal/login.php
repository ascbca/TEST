<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center><h2>Login Form</h2></center>
    <center><form action="login2_process.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" name="login" value="Login">
    </form>
	</center>

    <!-- Display error or success messages -->
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color:red;">' . $_GET['error'] . '</p>';
    }
    
    if (isset($_GET['success'])) {
        echo '<p style="color:green;">' . $_GET['success'] . '</p>';
    }
    ?>

    <p>Don't have an account? <a href="register2.php">Register here</a></p>
</body>
</html>
