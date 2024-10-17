<?php

include('connection.php');

// Check if form is submitted
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Input validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        header("Location: register2.php?error=All fields are required");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: register2.php?error=Passwords do not match");
        exit();
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register2.php?error=Username already taken");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        // Registration success, redirect to login page
        header("Location: login.php?success=Registration successful! Please log in.");
        exit();
    } else {
        header("Location: register2.php?error=Registration failed. Please try again");
        exit();
    }
}
?>
